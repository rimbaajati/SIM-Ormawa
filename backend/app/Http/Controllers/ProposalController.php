<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    // 🟦 INDEX — list proposal (manager)
    public function index(): View
    {
        $proposals = Proposal::latest()->paginate(10);

        return view('pages.manager.manager_allproposal', compact('proposals'));
    }

    // 🟩 CREATE — tampilkan form tambah
    public function create(): View
    {
        return view('pages.manager.manager_createproposal');
    }

    // 🟩 STORE — simpan proposal baru
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'judul'         => 'required',
            'deskripsi'     => 'required',
            'waktu'         => 'required|date',
            'tempat'        => 'required',
            'anggaran'      => 'required|numeric',
            'file_proposal' => 'required|file|mimes:pdf|max:2048',
        ]);

        $file = $request->file('file_proposal')->store('proposals', 'public');

        Proposal::create([
            'judul'         => $request->judul,
            'deskripsi'     => $request->deskripsi,
            'waktu'         => $request->waktu,
            'tempat'        => $request->tempat,
            'anggaran'      => $request->anggaran,
            'file_proposal' => $file,
            'status'        => 'pending',
            'user_id'       => Auth::id(),
        ]);

        return redirect()->route('proposals.index')
            ->with('success', 'Proposal berhasil dibuat.');
    }

    // 🟧 SHOW (opsional)
    public function show(Proposal $proposal): View
    {
        $this->authorizeAccess($proposal);

        return view('pages.manager.manager_showproposal', compact('proposal'));
    }

    // 🟨 EDIT — tampilkan form edit
    public function edit(Proposal $proposal): View
    {
        $this->authorizeAccess($proposal);

        return view('pages.manager.manager_editproposal', compact('proposal'));
    }

    // 🟨 UPDATE — update data proposal
    public function update(Request $request, Proposal $proposal): RedirectResponse
    {
        $this->authorizeAccess($proposal);

        $request->validate([
            'judul'         => 'required',
            'deskripsi'     => 'required',
            'waktu'         => 'required|date',
            'tempat'        => 'required',
            'anggaran'      => 'required|numeric',
            'file_proposal' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = $request->only([
            'judul', 'deskripsi', 'waktu', 'tempat', 'anggaran'
        ]);

        if ($request->hasFile('file_proposal')) {
            Storage::disk('public')->delete($proposal->file_proposal);

            $data['file_proposal'] = $request->file('file_proposal')->store('proposals', 'public');
        }

        $proposal->update($data);

        return redirect()->route('proposals.index')
            ->with('success', 'Proposal berhasil diperbarui.');
    }

    // 🟥 DELETE — hapus proposal
    public function destroy(Proposal $proposal): RedirectResponse
    {
        $this->authorizeAccess($proposal);

        Storage::disk('public')->delete($proposal->file_proposal);
        $proposal->delete();

        return redirect()->route('proposals.index')
            ->with('success', 'Proposal berhasil dihapus.');
    }

    // 🔒 Akses hanya untuk pemilik
    private function authorizeAccess(Proposal $proposal)
    {
        if ($proposal->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }
    }
}
