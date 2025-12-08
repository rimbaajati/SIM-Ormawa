<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends Controller
{
    public function index() : View
    {
        $organizations = Organization::latest()->get();
        return view('pages.manager.organization.manager_allorganization', compact('organizations'));
    }

    public function show(Organization $organization): View
    {
        $organization->load('currentManagement'); //1. Panggil relasi 'currentManagement' agar data kepengurusan aktif ikut terambil
        $pastEvents = $organization->events() // 2. Ambil data Event (Kode lama Anda tetap dipertahankan)
                        ->where('event_date', '<', now()) 
                        ->orderBy('event_date', 'desc')
                        ->get();
        return view('pages.manager.organization.manager_organizationprofile', compact('organization')); 
    }

    public function create() : View
    {
        return view('pages.manager.organization.manager_createorganization');
    }

    // STORE (DATA BARU)
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255', 
            'full_name'   => 'nullable|string|max:255', 
            'ketua'       => 'required|string|max:255',
            'pembimbing'  => 'nullable|string|max:255', 
            'kontak'      => 'required|string|max:50',
            'email'       => 'nullable|email|max:255',
            'instagram'   => 'nullable|string|max:255',
            'deskripsi'   => 'nullable|string', 
            'visi'        => 'nullable|string', 
            'misi'        => 'nullable|string', 
            'logo'        => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['name'] = Str::upper($request->name);
        
        if($request->filled('full_name')) {
            $validated['full_name'] = Str::title($request->full_name);
        }

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $validated['is_active'] = $request->has('is_active'); 
        
        Organization::create($validated);

        return redirect()->route('manager.organization.all')
            ->with('success', 'Organisasi berhasil didaftarkan!');
    }

    public function edit(Organization $organization): View
    {
        return view('pages.manager.organization.manager_editorganization', compact('organization'));
    }

    public function update(Request $request, Organization $organization): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'full_name'   => 'nullable|string|max:255',
            'ketua'       => 'required|string|max:255',
            'pembimbing'  => 'nullable|string|max:255', 
            'kontak'      => 'required|string|max:50',
            'email'       => 'nullable|email|max:255',
            'instagram'   => 'nullable|string|max:255',
            'deskripsi'   => 'nullable|string',
            'visi'        => 'nullable|string', 
            'misi'        => 'nullable|string', 
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $validated['name'] = Str::upper($request->name);
        if($request->filled('full_name')) {
            $validated['full_name'] = Str::title($request->full_name);
        }

        if ($request->hasFile('logo')) {
            if ($organization->logo) {
                Storage::disk('public')->delete($organization->logo);
            }
         
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        } else {
            unset($validated['logo']);
        }

        $validated['is_active'] = $request->has('is_active');
        $organization->update($validated);
        return redirect()->route('manager.organization.all')
            ->with('success', 'Data organisasi berhasil diperbarui');
    }

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