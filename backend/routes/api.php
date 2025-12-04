<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PersonalTaskController;
use App\Http\Controllers\Api\AuthController; 
use App\Http\Controllers\Api\RoomController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// --- Rute Publik (Tidak perlu login) ---
// Alamat ini ( /api/register ) akan memanggil fungsi 'register' di AuthController
Route::post('/register', [AuthController::class, 'register']);

// Alamat ini ( /api/login ) akan memanggil fungsi 'login' di AuthController
Route::post('/login', [AuthController::class, 'login']);


// --- Rute Terproteksi (Wajib login / kirim token) ---
Route::middleware('auth:sanctum')->group(function () {
    
    // Alamat untuk mengambil data user ( /api/user )
    Route::get('/user', function (Request $request) {
        return $request->user(); // Ini untuk 'fetchUser' di Nuxt
    });

    // Alamat untuk logout ( /api/logout )
    Route::post('/logout', [AuthController::class, 'logout']);

    // --- Rute untuk "Tugas Pribadi" ---
    // GET /api/personal-tasks -> Panggil fungsi index()
    Route::get('/personal-tasks', [PersonalTaskController::class, 'index']);
    
    // POST /api/personal-tasks -> Panggil fungsi store()
    Route::post('/personal-tasks', [PersonalTaskController::class, 'store']);
    
    // PUT /api/personal-tasks/{task} -> Panggil fungsi update()
    Route::put('/personal-tasks/{task}', [PersonalTaskController::class, 'update']);
    
    // DELETE /api/personal-tasks/{task} -> Panggil fungsi destroy()
    Route::delete('/personal-tasks/{task}', [PersonalTaskController::class, 'destroy']);

    // --- RUTE UNTUK KELAS (ROOM) ---
    
    // 1. Lihat daftar kelas
    Route::get('/rooms', [RoomController::class, 'index']);
    
    // 2. Buat kelas baru
    Route::post('/rooms', [RoomController::class, 'store']);
    
    // 3. Gabung kelas pakai kode
    Route::post('/rooms/join', [RoomController::class, 'join']);    
});