<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends Controller
{
    // INDEX
    public function index() : View
    {
        $organizations = Organization::latest()->get();
        return view('pages.manager.organization.manager_allorganization', compact('organizations'));
    }

    public function show(Organization $organization): View
    {
        return view('pages.manager.organization.manager_organizationprofile', compact('organization')); 
    }

    // CREATE
    public function create() : View
    {
        return view('pages.manager.organization.manager_createorganization');
    }

    // STORE (REVISI)
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Inputan Baru
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'ketua'     => 'required|string|max:255', // Baru
            'kontak'    => 'required|string|max:50',
            'email'     => 'nullable|email|max:255',  // Baru
            'instagram' => 'nullable|string|max:255', // Baru
            'deskripsi' => 'required|string',
            'logo'      => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Upload Logo
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // 3. Handle Status Active
        // Checkbox di HTML: kalau dicentang kirim "on" / "1", kalau tidak dicentang tidak kirim apa-apa.
        // Kita paksa jadi boolean true/false.
        $validated['is_active'] = $request->has('is_active'); 
        
        // 4. Create Data (ID Organization otomatis dibuat oleh Model)
        Organization::create($validated);

        return redirect()->route('manager.organization.all')
            ->with('success', 'Organisasi berhasil didaftarkan!');
    }

    // EDIT
    public function edit(Organization $organization): View
    {
        return view('pages.manager.manager.organization.edit', compact('organization'));
    }

    // UPDATE (REVISI)
    public function update(Request $request, Organization $organization): RedirectResponse
    {
        // 1. Validasi (Logo jadi nullable)
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'ketua'     => 'required|string|max:255',
            'kontak'    => 'required|string|max:50',
            'email'     => 'nullable|email|max:255',
            'instagram' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Cek Upload Logo Baru
        if ($request->hasFile('logo')) {
            // Hapus logo lama
            if ($organization->logo) {
                Storage::disk('public')->delete($organization->logo);
            }
            // Simpan logo baru & update array data
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        } else {
            // Jika tidak upload logo, hapus key 'logo' dari array agar tidak menimpa data lama dengan null
            unset($validated['logo']);
        }

        // 3. Handle Status Active untuk Update
        // Penting: Kita cek apakah ada input bernama 'is_active'.
        $validated['is_active'] = $request->has('is_active');

        // 4. Update Data
        $organization->update($validated);

        return redirect()->route('manager.organization.all')
            ->with('success', 'Organisasi berhasil diperbarui');
    }

    // DELETE (TETAP)
    public function destroy(Organization $organization): RedirectResponse
    {
        if ($organization->logo) {
            Storage::disk('public')->delete($organization->logo);
        }

        $organization->delete();

        return redirect()->route('manager.organization.all')
            ->with('success', 'Organisasi berhasil dihapus');
    }
}