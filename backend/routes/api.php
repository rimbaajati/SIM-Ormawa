<?php

use App\Http\Controllers\API\TrackingController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BeritaController;
// --- RUTE PUBLIK (Dapat diakses tanpa login) ---

// Autentikasi
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Tracking (Asumsi ini adalah data publik atau dapat dilihat tanpa otentikasi)
Route::get('/tracking/{id}', [TrackingController::class, 'show']);
// Rute Berita Publik (Melihat semua berita dan detail satu berita)
Route::get('/berita', [BeritaController::class, 'index']); // GET /api/berita -> Daftar Berita
Route::get('/berita/{id}', [BeritaController::class, 'show']); // GET /api/berita/1 -> Detail Berita


// --- RUTE TERLINDUNGI (Hanya dapat diakses oleh user yang sudah login melalui 'auth:sanctum') ---

Route::middleware('auth:sanctum')->group(function () {
    // Autentikasi
    Route::post('/logout', [AuthController::class, 'logout']);

    // Berita CRUD (Asumsi hanya user terautentikasi yang bisa menambah, mengubah, atau menghapus)
    // Berdasarkan file Nuxt Anda: app/pages/berita/tambah.vue
    Route::post('/berita', [BeritaController::class, 'store']);     // POST /api/berita -> Tambah Berita Baru
    Route::put('/berita/{id}', [BeritaController::class, 'update']); // PUT /api/berita/1 -> Edit Berita
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy']); // DELETE /api/berita/1 -> Hapus Berita

    // User Data (Contoh rute untuk mengambil data user yang sedang login)
    Route::get('/user', [AuthController::class, 'user']);
});

// Catatan: Saya menghapus duplikasi rute dan mengasumsikan Anda ingin menggunakan AuthController
// untuk semua proses auth (login/register/logout).