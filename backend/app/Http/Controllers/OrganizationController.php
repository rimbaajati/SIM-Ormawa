<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends Controller
{
    // INDEX - Buat Nampilin List Ormawa UMPKU 
    public function index() : View
    {
        $organizations = Organization::latest()->get();
        return view('pages.manager.manager_allorganization', compact('organizations'));
    }

    // CREATE - Form Tambah Data
    public function create() : View
    {
        return view('pages.manager.organization.create');
    }

    // STORE - Simpan data baru
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'      =>  'required|string|max:255',
            'logo'      =>  'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' =>  'required|string',
            'kontak'    =>  'required|string',
        ]);

    // Upload Logo
        $logoPath = $request->file('logo')->store('logos', 'public');
        
        Organization::create([
            'name'      =>  $request->name,
            'logo'      =>  $logoPath,
            'deskripsi' => $request->deskripsi,
            'kontak'    => $request->kontak,
        ]);
        return redirect()->route('manager.organization.all')
            ->with('success', 'Organisasi berhasil didaftarkan!');
    }

    // EDIT - Form Edit Data
    public function edit(Organization $organization): View
    {
        return view('pages.manager.manager.organization.edit', compact('organization'));
    }

    // 🟨 UPDATE - Update data
    public function update(Request $request, Organization $organization): RedirectResponse
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Boleh kosong jika tidak ganti gambar
            'deskripsi' => 'required|string',
            'kontak'    => 'required|string|max:50',
        ]);

        $data = [
            'name'      => $request->name,
            'deskripsi' => $request->deskripsi,
            'kontak'    => $request->kontak,
        ];

        // Cek apakah user upload logo baru
        if ($request->hasFile('logo')) {
            // Hapus logo lama
            if ($organization->logo) {
                Storage::disk('public')->delete($organization->logo);
            }
            // Upload logo baru
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $organization->update($data);

        return redirect()->route('manager.organization.all')
            ->with('success', 'Organisasi berhasil diperbarui');
    }

    // DELETE - Hapus data
    public function destroy(Organization $organization): RedirectResponse
    {
        // Hapus file gambar dari storage
        if ($organization->logo) {
            Storage::disk('public')->delete($organization->logo);
        }

        $organization->delete();

        return redirect()->route('manager.organization.all')
            ->with('success', 'Organisasi berhasil dihapus');
    }
}
