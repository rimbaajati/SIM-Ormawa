<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Organization;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    // INDEX
    public function index()
    {
        $proposals = Proposal::latest()->paginate(10);
        return view('pages.manager.manager_allproposal', compact('proposals'));
    }

    // CREATE
    public function create(): View
    {
        $organizations = Organization::orderBy('name')->get();
        return view('pages.manager.manager_createproposal', compact('organizations'));
    }

    // STORE 
    public function store(Request $request): RedirectResponse {
        
        $request->validate([
            'judul'           => 'required|string|max:255',
            'organization_id' => 'required|exists:organizations,id', // Validasi ID dari form
            'deskripsi'       => 'required',
            'waktu'           => 'required|date',
            'tempat'          => 'required',
            'anggaran'        => 'required|numeric',
            'file_proposal'   => 'required|file|mimes:pdf|max:2048',
        ]);

        // 1. Cari Nama Organisasi berdasarkan ID yang dipilih
        $organization = Organization::findOrFail($request->organization_id);

        // 2. Upload File
        $file = $request->file('file_proposal')->store('proposals', 'public');

        // 3. Simpan ke Database
        Proposal::create([
            'judul'         => $request->judul,
            'organisasi'    => $organization->name, // Simpan NAMANYA, bukan ID-nya
            'deskripsi'     => $request->deskripsi,
            'waktu'         => $request->waktu,
            'tempat'        => $request->tempat,
            'anggaran'      => $request->anggaran,
            'file_proposal' => $file,
            'status'        => 'pending',
            'user_id'       => Auth::id(),
        ]);

        return redirect()->route('manager.proposal.all')
            ->with('success', 'Proposal berhasil diajukan!');
    }

    // SHOW
    public function show(Proposal $proposal): View
    {
        $this->authorizeAccess($proposal);
        return view('pages.manager.manager_showproposal', compact('proposal'));
    }

    //  EDIT
    public function edit(Proposal $proposal): View
    {
        $this->authorizeAccess($proposal);
        $organizations = Organization::orderBy('name')->get();
        return view('pages.manager.manager_editproposal', compact('proposal', 'organizations'));
    }

    //  UPDATE 
    public function update(Request $request, Proposal $proposal): RedirectResponse
    {
        $this->authorizeAccess($proposal);

        $request->validate([
            'judul'           => 'required|string|max:255',
            'organization_id' => 'required|exists:organizations,id',
            'deskripsi'       => 'required',
            'waktu'           => 'required|date',
            'tempat'          => 'required',
            'anggaran'        => 'required|numeric',
            'file_proposal'   => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Cari Nama Organisasi baru (jika user mengubah pilihan)
        $organization = Organization::findOrFail($request->organization_id);

        $data = [
            'judul'      => $request->judul,
            'organisasi' => $organization->name, // Update nama organisasi
            'deskripsi'  => $request->deskripsi,
            'waktu'      => $request->waktu,
            'tempat'     => $request->tempat,
            'anggaran'   => $request->anggaran,
        ];

        if ($request->hasFile('file_proposal')) {
            Storage::disk('public')->delete($proposal->file_proposal);
            $data['file_proposal'] = $request->file('file_proposal')->store('proposals', 'public');
        }

        $proposal->update($data);

        return redirect()->route('manager.proposal.all')
            ->with('success', 'Proposal berhasil diperbarui.');
    }

    // DELETE
    public function destroy(Proposal $proposal): RedirectResponse
    {
        $this->authorizeAccess($proposal);

        if($proposal->file_proposal) {
             Storage::disk('public')->delete($proposal->file_proposal);
        }
        
        $proposal->delete();

        return redirect()->route('manager.proposal.all')
            ->with('success', 'Proposal berhasil dihapus.');
    }

    // Authorize
    private function authorizeAccess(Proposal $proposal)
    {
        if ($proposal->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }
    }
}