<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SuratApiController extends Controller
{
    // ==========================================
    // 0. DATA MASTER (Dropdown Jenis Surat)
    // ==========================================
    public function getJenisSurat()
    {
        $data = JenisSurat::all();
        
        return response()->json([
            'success' => true,
            'message' => 'List Jenis Surat',
            'data'    => $data
        ]);
    }

    // ==========================================
    // 1. SURAT MASUK
    // ==========================================
    
    public function indexMasuk(Request $request)
    {
        $data = SuratMasuk::with(['jenisSurat', 'organization'])
                ->latest('tanggal')
                ->paginate(10);

        return response()->json([
            'success' => true, 
            'message' => 'List Surat Masuk', 
            'data'    => $data
        ]);
    }

    public function storeMasuk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_organization' => 'required|exists:organizations,id',
            'id_jenis_surat'  => 'required|exists:jenis_surats,id',
            'tanggal'         => 'required|date',
            'asal'            => 'required|string', // PENGIRIM
            'perihal'         => 'required|string',
            'file'            => 'required|file|mimes:pdf,jpg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('surat_masuk', 'public');
        }

        $surat = SuratMasuk::create([
            'id_organization' => $request->id_organization,
            'id_jenis_surat'  => $request->id_jenis_surat,
            'tanggal'         => $request->tanggal,
            'asal'            => $request->asal,
            'perihal'         => $request->perihal,
            'file'            => $filePath,
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Surat Masuk Berhasil Disimpan', 
            'data'    => $surat
        ], 201);
    }

    // ==========================================
    // 2. SURAT KELUAR
    // ==========================================

    public function indexKeluar(Request $request)
    {
        $data = SuratKeluar::with(['jenisSurat', 'organization'])
                ->latest('tanggal')
                ->paginate(10);

        return response()->json([
            'success' => true, 
            'message' => 'List Surat Keluar', 
            'data'    => $data
        ]);
    }

    public function storeKeluar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_organization' => 'required|exists:organizations,id',
            'id_jenis_surat'  => 'required|exists:jenis_surats,id',
            'tanggal'         => 'required|date',
            'kepada'          => 'required|string', // PENERIMA
            'perihal'         => 'required|string',
            'file'            => 'required|file|mimes:pdf,jpg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('surat_keluar', 'public');
        }

        $surat = SuratKeluar::create([
            'id_organization' => $request->id_organization,
            'id_jenis_surat'  => $request->id_jenis_surat,
            'tanggal'         => $request->tanggal,
            'kepada'          => $request->kepada,
            'perihal'         => $request->perihal,
            'file'            => $filePath,
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Surat Keluar Berhasil Disimpan', 
            'data'    => $surat
        ], 201);
    }
} 