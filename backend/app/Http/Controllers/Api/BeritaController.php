<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BeritaController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'judul'  => 'required|string|max:255',
            'isi'    => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        // 2. Proses Upload Gambar
        $pathGambar = null;
        if ($request->hasFile('gambar')) {
            // Upload ke folder: storage/app/public/berita
            // Menggunakan hashName() agar nama file unik dan aman
            $pathGambar = $request->file('gambar')->store('berita', 'public');
        }

        // 3. Simpan ke Database
        $berita = Berita::create([
            'judul'  => $request->judul,
            'isi'    => $request->isi,
            'gambar' => $pathGambar,
        ]);

        // 4. Return Response JSON
        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil ditambahkan!',
            'data'    => $berita
        ], 201);
    }
}