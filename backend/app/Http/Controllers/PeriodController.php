<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Period;

class PeriodController extends Controller
{
    public function index()
    {
        $periods = Period::latest()->get();
        return view('pages.manager.period.manager_period', compact('periods'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Contoh: 2024/2025
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after:start_date',
            'is_active'  => 'nullable' // Checkbox
        ]);

        // Logika: Jika user mencentang 'Aktif', maka periode lain harus dinonaktifkan
        if ($request->has('is_active')) {
            Period::where('is_active', true)->update(['is_active' => false]);
            $validated['is_active'] = true;
        } else {
            $validated['is_active'] = false;
        }

        Period::create($validated);

        return redirect()->route('manager.period.index')->with('success', 'Periode berhasil ditambahkan');
    }

    public function edit(Period $period)
    {
        return view('pages.manager.period.edit', compact('period'));
    }

    public function update(Request $request, Period $period)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after:start_date',
            'is_active'  => 'nullable'
        ]);

        if ($request->has('is_active')) {
            Period::where('id', '!=', $period->id)->update(['is_active' => false]);
            $validated['is_active'] = true;
        } else {
            // Kita cegah user mematikan status aktif jika dia satu-satunya yang aktif
            // (Opsional, tapi bagus untuk mencegah sistem tanpa periode aktif)
            if($period->is_active) {
                 $validated['is_active'] = true; 
            } else {
                 $validated['is_active'] = false;
            }
        }

        $period->update($validated);

        return redirect()->route('manager.period.index')->with('success', 'Periode diperbarui');
    }
    
    // Fitur tombol instan "Aktifkan"
    public function activate($id)
    {
        // Matikan semua
        Period::query()->update(['is_active' => false]);
        
        // Aktifkan yang dipilih
        $period = Period::findOrFail($id);
        $period->update(['is_active' => true]);

        return redirect()->back()->with('success', 'Periode ' . $period->name . ' sekarang AKTIF.');
    }

    public function destroy(Period $period)
    {
        if($period->is_active) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus periode yang sedang Aktif!');
        }
        $period->delete();
        return redirect()->back()->with('success', 'Periode dihapus');
    }
}
