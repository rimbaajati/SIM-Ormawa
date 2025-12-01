<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BeritaResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use validator;
use Illuminate\Validation\ValidationException;
use App\Models\Berita; // Pastikan Model Berita sudah dibuat (php artisan make:model Berita)
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;

class BeritaController extends Controller
{
    public function index(): JsonResponse
{
    $berita = Berita::latest()->get();
    // Bungkus dengan collection
    return BeritaResource::collection($berita);
}

public function show($id)
{
    $berita = Berita::find($id);
    // Bungkus single resource
    return new BeritaResource($berita);
}

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'judul' => 'required',
            'isi'   => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // 2. Handle Upload Gambar
        $pathGambar = null;
        if ($request->hasFile('gambar')) {
            // Simpan ke folder: storage/app/public/berita
            $path = $request->file('gambar')->store('public/berita');
            // Ambil nama filenya saja (hashName)
            $pathGambar = basename($path);
        }

        // 3. Simpan ke Database
        $berita = Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'ringkasan' => substr($request->isi, 0, 150) . '...',
            'gambar' => $pathGambar,
            'user_id' => $request->user()->id // Ambil ID user yg sedang login
        ]);

        return new BeritaResource($berita);

        return response()->json([
            'message' => 'Berita berhasil disimpan',
            'data' => $berita
        ]);
    }
}
