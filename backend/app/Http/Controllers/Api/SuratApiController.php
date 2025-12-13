<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\JenisSurat;
use App\Models\Organization; // Wajib import ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SuratApiController extends Controller
{
    public function getJenisSurat()
    {
        $data = JenisSurat::all();
        
        return response()->json([
            'success' => true,
            'message' => 'List Jenis Surat',
            'data'    => $data
        ]);
    }

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
            'asal'            => 'required|string', // PENGIRIM EKSTERNAL
            'perihal'         => 'required|string',
            'file'            => 'required|file|mimes:pdf,jpg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Upload File
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('surat_masuk', 'public');
        }

        // Simpan ke Database
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
        // 1. Validasi
        $validator = Validator::make($request->all(), [
            'id_organization' => 'required|exists:organizations,id', // Pengirim
            'id_jenis_surat'  => 'required|exists:jenis_surats,id',
            'tanggal'         => 'required|date',
            'perihal'         => 'required|string',
            'file'            => 'required|file|mimes:pdf,jpg,png|max:5120',

            // Validasi Tujuan (Internal / Eksternal)
            'tujuan_organization_id' => 'nullable|exists:organizations,id', 
            
            // Kolom 'kepada' (Text Manual) WAJIB DIISI JIKA 'tujuan_organization_id' KOSONG
            'kepada' => 'required_without:tujuan_organization_id|string|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // 2. Upload File
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('surat_keluar', 'public');
        }

        $namaPenerimaString = $request->kepada;

        // Jika user memilih Organisasi Internal, timpa namanya dengan nama Organisasi tersebut
        if ($request->tujuan_organization_id) {
            $orgTujuan = Organization::find($request->tujuan_organization_id);
            $namaPenerimaString = $orgTujuan->name; 
        }

        // 4. Simpan ke Database SURAT KELUAR (Arsip Pengirim)
        $suratKeluar = SuratKeluar::create([
            'id_organization'        => $request->id_organization,
            'id_jenis_surat'         => $request->id_jenis_surat,
            'tujuan_organization_id' => $request->tujuan_organization_id,
            'kepada'                 => $namaPenerimaString, 
            'tanggal'                => $request->tanggal,
            'perihal'                => $request->perihal,
            'file'                   => $filePath,
        ]);

        if ($request->tujuan_organization_id) {
            
            $pengirim = Organization::find($request->id_organization);

            SuratMasuk::create([
                'id_organization' => $request->tujuan_organization_id, 
                'id_jenis_surat'  => $request->id_jenis_surat,
                'tanggal'         => $request->tanggal,
                'asal'            => $pengirim->name, // Pengirimnya adalah Nama Kita
                'perihal'         => $request->perihal,
                'file'            => $filePath, // File sama, hemat storage
            ]);
        }

        return response()->json([
            'success' => true, 
            'message' => 'Surat berhasil dikirim' . ($request->tujuan_organization_id ? ' dan masuk ke inbox penerima.' : '!'), 
            'data'    => $suratKeluar
        ], 201);
    }
}