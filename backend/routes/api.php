<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import Controller (Pastikan Namespace Sesuai)
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TrackingController; 
use App\Http\Controllers\Api\BeritaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// --- RUTE PUBLIK (Dapat diakses tanpa login) ---

// Autentikasi
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Tracking (Publik)
// Pastikan file TrackingController ada, jika belum ada, beri komentar (//) pada baris ini
Route::get('/tracking/{id}', [TrackingController::class, 'show']);

// Berita (Publik)
// Pastikan file BeritaController ada, jika belum ada, beri komentar (//) pada baris ini
Route::apiResource('berita', [BeritaController::class, 'index']);
Route::get('berita', [BeritaController::class, 'index']); 
Route::get('berita/{id}', [BeritaController::class, 'show']);

    
    
// --- RUTE TERLINDUNGI (Hanya user login) ---
Route::middleware('auth:sanctum')->group(function () {
    
    // Auth & User
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

// Berita CRUD (Admin/Pengurus)
Route::resource('berita', BeritaController::class);
    Route::post('/berita', [BeritaController::class, 'store']);
    Route::put('/berita/{id}', [BeritaController::class, 'update']);
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy']);
});