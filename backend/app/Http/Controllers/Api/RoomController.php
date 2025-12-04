<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room; // Pastikan Model Room dipanggil
use Illuminate\Support\Str; // Untuk membuat kode acak

class RoomController extends Controller
{
    /**
     * 1. BUAT KELAS BARU
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Kita butuh Workspace ID. 
        // Untuk tahap awal ini, kita buat logic sederhana:
        // Kita cari workspace pertama milik user, kalau belum ada kita buatkan otomatis.
        $workspace = $request->user()->workspaces()->firstOrCreate([
            'name' => 'Ruang Belajar Saya'
        ]);

        // Buat Room Baru
        $room = Room::create([
            'workspace_id' => $workspace->id,
            'owner_id' => $request->user()->id,
            'name' => $request->name,
            'invite_code' => Str::random(6), // Kode unik 6 karakter (misal: aX9kL2)
        ]);

        // Masukkan si pembuat sebagai 'owner' di tabel anggota
        $room->members()->attach($request->user()->id, ['role' => 'owner']);

        return response()->json([
            'message' => 'Kelas berhasil dibuat!',
            'room' => $room
        ], 201);
    }

    /**
     * 2. GABUNG KELAS (Pakai Kode)
     */
    public function join(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        // Cari Room yang punya kode invite tersebut
        $room = Room::where('invite_code', $request->code)->first();

        // Cek 1: Apakah kelasnya ada?
        if (!$room) {
            return response()->json(['message' => 'Kode kelas tidak ditemukan.'], 404);
        }

        // Cek 2: Apakah user SUDAH bergabung sebelumnya?
        $isMember = $room->members()
                         ->where('user_id', $request->user()->id)
                         ->exists();

        if ($isMember) {
            return response()->json(['message' => 'Anda sudah masuk di kelas ini.'], 409);
        }

        // Kalau aman, masukkan user sebagai 'member'
        $room->members()->attach($request->user()->id, ['role' => 'member']);

        return response()->json([
            'message' => 'Berhasil bergabung ke kelas!',
            'room' => $room
        ]);
    }

    /**
     * 3. LIHAT DAFTAR KELAS SAYA
     */
    public function index(Request $request)
    {
        // Ambil semua kelas di mana user terdaftar sebagai anggota
        $rooms = $request->user()->rooms()->get();

        return response()->json($rooms);
    }
}