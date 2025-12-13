<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SuratController extends Controller
{
    // 1. TAMPILKAN SURAT MASUK
    public function indexMasuk(): View
    {
        // Ambil data surat masuk, urutkan terbaru
        $suratMasuk = SuratMasuk::with(['organization', 'jenisSurat'])
                        ->latest('tanggal')
                        ->paginate(10);

       return view('pages.manager.manager_mail', compact('suratMasuk'));
    }

    // 2. TAMPILKAN SURAT KELUAR
    public function indexKeluar(): View
    {
        $suratKeluar = SuratKeluar::with(['organization', 'jenisSurat'])
                        ->latest('tanggal')
                        ->paginate(10);

        return view('pages.manager.surat.keluar_index', compact('suratKeluar'));
    }
}