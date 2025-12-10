<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PersonalTaskController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\TrackingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Tracking
Route::middleware('auth:sanctum')->get('/tracking/{id}', [TrackingController::class, 'show']);

// --- Rute Publik (Tidak perlu login) ---

// Alamat ini ( /api/register ) akan memanggil fungsi 'register' di AuthController
Route::post('/register', [AuthController::class, 'register']);

// Alamat ini ( /api/login ) akan memanggil fungsi 'login' di AuthController
Route::post('/login', [AuthController::class, 'login']);


// --- Rute Terproteksi (Wajib login / kirim token Bearer) ---
Route::middleware('auth:sanctum')->group(function () {
    
    // --- AUTH & USER ---
    // Alamat untuk mengambil data user ( /api/user )
    Route::get('/user', function (Request $request) {
        return $request->user(); 
    });

    // Alamat untuk logout ( /api/logout )
    Route::post('/logout', [AuthController::class, 'logout']);


    // --- RUTE TUGAS PRIBADI (PERSONAL TASKS) ---
    Route::get('/personal-tasks', [PersonalTaskController::class, 'index']);     // Lihat semua
    Route::post('/personal-tasks', [PersonalTaskController::class, 'store']);    // Buat baru
    Route::put('/personal-tasks/{task}', [PersonalTaskController::class, 'update']); // Edit
    Route::delete('/personal-tasks/{task}', [PersonalTaskController::class, 'destroy']); // Hapus


    // --- RUTE KELAS (ROOMS) ---
    Route::get('/rooms', [RoomController::class, 'index']);       // Lihat daftar kelas
    Route::post('/rooms', [RoomController::class, 'store']);      // Buat kelas baru
    Route::post('/rooms/join', [RoomController::class, 'join']);  // Gabung kelas pakai kode


    // --- RUTE PRODUK (Dari kode lama/Stashed) ---
    // Jika Anda masih membutuhkan fitur produk dari request sebelumnya
    Route::resource('products', ProductController::class);

});`