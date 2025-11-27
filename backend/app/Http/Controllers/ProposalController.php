<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Auth::user()->role;

        if ($role === 'user') {
            $proposals = Proposal::where('user_id', Auth::id())->get();
        } else {
            $proposals = Proposal::latest()->get();
        }

        return view('proposal.index', compact('proposals'));
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proposal = Proposal::findOrFail($id);
        $role = Auth::user()->role;

        if ($role === 'user' && $proposal->user_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak mengakses proposal ini.');
        }

        return view('proposal.show', compact('proposal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $proposal = Proposal::findOrFail($id);
        $role = Auth::user()->role;

        if ($role === 'user' && $proposal->user_id !== Auth::id()) {
            abort(403, 'Anda hanya bisa mengedit proposal Anda sendiri.');
        }

        if ($role === 'admin' && $request->has('status')) {
            abort(403, 'Admin tidak boleh mengubah status.');
        }

        $proposal->update($request->all());

        return back()->with('success', 'Proposal berhasil diperbarui.');
    }

    /**
     * Manager update status proposal.
     */
    public function setStatus(Request $request, string $id)
    {
        $proposal = Proposal::findOrFail($id);
        $role = Auth::user()->role;

        if ($role !== 'manager') {
            abort(403, 'Hanya Manager yang dapat mengubah status proposal.');
        }

        $request->validate([
            'status' => 'required|in:approved,rejected,pending'
        ]);

        $proposal->status = $request->status;
        $proposal->save();

        return back()->with('success', 'Status proposal berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proposal = Proposal::findOrFail($id);
        $role = Auth::user()->role;

        if ($role === 'user' && $proposal->user_id !== Auth::id()) {
            abort(403, 'Anda tidak dapat menghapus proposal ini.');
        }

        $proposal->delete();

        return back()->with('success', 'Proposal berhasil dihapus.');
    }
}
