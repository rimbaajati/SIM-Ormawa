<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProposalRequest;
use App\Http\Requests\UpdateProposalRequest;

class ProposalController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        if ($role === 'admin') {
            $proposals = Proposal::where('user_id', Auth::id())->get();
        } else {
            $proposals = Proposal::latest()->get();
        }

        return view('pages.manager.manager_allproposal', compact('proposals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'waktu' => 'required',
            'tempat' => 'required|string',
            'anggaran' => 'required|numeric',
            'file_proposal' => 'nullable|file|mimes:pdf,doc,docx'
        ]);

        // Upload file
        if ($request->hasFile('file_proposal')) {
            $filename = time() . '_' . $request->file('file_proposal')->getClientOriginalName();
            $path = $request->file('file_proposal')->storeAs('proposal_files', $filename, 'public');
            $validated['file_proposal'] = $path;
        }

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        Proposal::create($validated);

        return back()->with('success', 'Proposal berhasil diajukan.');
    }

    public function show(string $id)
    {
        $proposal = Proposal::findOrFail($id);
        $role = Auth::user()->role;

        if ($role === 'user' && $proposal->user_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak mengakses proposal ini.');
        }

        return view('proposal.show', compact('proposal'));
    }

    public function update(Request $request, string $id)
    {
        $proposal = Proposal::findOrFail($id);
        $user = Auth::user();

    // USER hanya boleh edit proposal miliknya
        if ($user->role === 'user' && $proposal->user_id !== $user->id) {
            abort(403, 'Anda hanya bisa mengedit proposal Anda sendiri.');
        }

    // ADMIN juga hanya boleh edit proposal miliknya
        if ($user->role === 'admin' && $proposal->user_id !== $user->id) {
            abort(403, 'Admin hanya bisa mengedit proposal miliknya.');
        }

    // USER & ADMIN tidak boleh mengubah status
        if (in_array($user->role, ['user', 'admin']) && $request->has('status')) {
            abort(403, 'Anda tidak diperbolehkan mengubah status.');
        }

    // MANAGER bebas (termasuk status)
        $proposal->update($request->only([
            'judul',
            'deskripsi',
            'waktu',
            'tempat',
            'anggaran',
            'status', // hanya manager yang bisa lolos sampai sini
        ]));

        return back()->with('success', 'Proposal berhasil diperbarui.');
        }

    public function destroy(string $id)
    {
        $proposal = Proposal::findOrFail($id);
        $user = Auth::user();

    // USER hanya boleh hapus proposal miliknya
        if ($user->role === 'user' && $proposal->user_id !== $user->id) {
            abort(403, 'Anda tidak dapat menghapus proposal ini.');
        }

    // ADMIN juga hanya boleh hapus proposal miliknya
        if ($user->role === 'admin' && $proposal->user_id !== $user->id) {
            abort(403, 'Admin hanya dapat menghapus proposal miliknya.');
        }

    // MANAGER bebas hapus semua
        $proposal->delete();

        return back()->with('success', 'Proposal berhasil dihapus.');
        }

    public function storeAPI(Request $request){
        $validated = $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'waktu' => 'required',
            'tempat' => 'required|string',
            'anggaran' => 'required|numeric',
            'file_proposal' => 'nullable|file|mimes:pdf,doc,docx'
            ]);

        // Upload file jika ada
        if ($request->hasFile('file_proposal')) {
            $filename = time() . '_' . $request->file('file_proposal')->getClientOriginalName();
            $path = $request->file('file_proposal')->storeAs('proposal_files', $filename, 'public');
            $validated['file_proposal'] = $path;
        }

        // Set otomatis
        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        $proposal = Proposal::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Proposal berhasil diajukan.',
            'data' => $proposal
        ], 201);
    }

    public function updateAPI(Request $request, $id){
        $proposal = Proposal::findOrFail($id);
        $user = auth()->user();

        // =========================
        // 1. USER hanya boleh edit proposal miliknya
        // =========================
        if ($user->role === 'user' && $proposal->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda hanya bisa mengedit proposal Anda sendiri.'
            ], 403);
        }

        // =========================
        // 2. ADMIN juga hanya boleh edit proposal miliknya
        // =========================
        if ($user->role === 'admin' && $proposal->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Admin hanya bisa mengedit proposal miliknya.'
            ], 403);
        }

        // =========================
        // 3. USER & ADMIN tidak boleh edit status
        // =========================
        if (in_array($user->role, ['user', 'admin']) && $request->has('status')) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak diperbolehkan mengubah status.'
            ], 403);
        }

        // =========================
        // 4. Validasi Input
        // =========================
        $validated = $request->validate([
            'judul' => 'sometimes|required|string',
            'deskripsi' => 'sometimes|required|string',
            'waktu' => 'sometimes|required',
            'tempat' => 'sometimes|required|string',
            'anggaran' => 'sometimes|required|numeric',
            'status' => 'sometimes|in:approved,rejected,pending', // hanya manager yang bisa lolos
            'file_proposal' => 'nullable|file|mimes:pdf,doc,docx'
        ]);

        // =========================
        // 5. Upload File (Jika Ada)
        // =========================
        if ($request->hasFile('file_proposal')) {
            $filename = time() . '_' . $request->file('file_proposal')->getClientOriginalName();
            $path = $request->file('file_proposal')->storeAs('proposal_files', $filename, 'public');
            $validated['file_proposal'] = $path;
    }

    // =========================
    // 6. Update Data
    // =========================
    $proposal->update($validated);

    return response()->json([
        'success' => true,
        'message' => 'Proposal berhasil diperbarui.',
        'data' => $proposal
    ], 200);
    }

    public function destroyAPI($id){
        $proposal = Proposal::findOrFail($id);
        $user = auth()->user();

        // USER hanya boleh hapus proposal miliknya
        if ($user->role === 'user' && $proposal->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak dapat menghapus proposal ini.'
            ], 403);
        }

        // ADMIN juga hanya boleh hapus proposal miliknya
        if ($user->role === 'admin' && $proposal->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Admin hanya dapat menghapus proposal miliknya.'
            ], 403);
        }

        // MANAGER bebas hapus semua
        $proposal->delete();

        return response()->json([
            'success' => true,
            'message' => 'Proposal berhasil dihapus.'
        ], 200);
        }
}
