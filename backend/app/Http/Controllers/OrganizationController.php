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
        $organization->load('currentManagement'); 
        
        $pastEvents = $organization->events()
                        ->where('event_date', '<', now()) 
                        ->orderBy('event_date', 'desc')
                        ->get();
                        
        return view('pages.manager.organization.manager_organizationprofile', compact('organization')); 
    }

    public function create() : View
    {
        return view('pages.manager.organization.manager_createorganization');
    }

    // STORE 
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

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        Organization::create([
            'name'          => Str::upper($request->name),
            'full_name'     => $request->full_name ? Str::title($request->full_name) : null,
            'logo'          => $logoPath,
            'email'         => $request->email,
            'deskripsi'     => $request->deskripsi,
            'is_active'     => $request->has('is_active'),
            'ketua'         => $request->ketua,      
            'pembimbing'    => $request->pembimbing,
            'kontak'        => $request->kontak,     
            'instagram'     => $request->instagram, 
            'visi'          => $request->visi, 
            'misi'          => $request->misi,
        ]);

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


        $dataUpdate = [
            'name'          => Str::upper($request->name),
            'full_name'     => $request->full_name ? Str::title($request->full_name) : null,
            'email'         => $request->email,
            'deskripsi'     => $request->deskripsi,
            'is_active'     => $request->has('is_active'),
            'ketua'         => $request->ketua,
            'pembimbing'    => $request->pembimbing,
            'kontak'        => $request->kontak,
            'instagram'     => $request->instagram,
            'visi'          => $request->visi,
            'misi'          => $request->misi,
        ];

        if ($request->hasFile('logo')) {
            if ($organization->logo) {
                Storage::disk('public')->delete($organization->logo);
            }
            $dataUpdate['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $organization->update($dataUpdate);

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