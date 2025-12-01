<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TrackingController;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\ProposalApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

<<<<<<< HEAD
// --- RUTE PUBLIK ---
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/tracking/{id}', [TrackingController::class, 'show']);
Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/berita/{id}', [BeritaController::class, 'show']);

// --- RUTE TERLINDUNGI (LOGIN) ---
Route::middleware(['auth:sanctum'])->group(function () {

    // Logout & profile
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    /*
    |--------------------------------------------------------------------------
    | USER ROUTES (role: user)
    |--------------------------------------------------------------------------
    | Bisa lihat & edit proposal sendiri
    */
    Route::middleware(['role:user'])->group(function () {
        Route::get('/proposal/my', [ProposalApiController::class, 'myProposals']);
        Route::get('/proposal/my/{id}', [ProposalApiController::class, 'show']);
        Route::put('/proposal/my/{id}', [ProposalApiController::class, 'update']);
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES (role: admin & manager)
    |--------------------------------------------------------------------------
    | Bisa lihat semua proposal & memberi komentar
    */
    Route::middleware(['role:admin,manager'])->group(function () {
        Route::get('/admin/proposals', [ProposalApiController::class, 'index']);
        Route::post('/admin/proposals/{id}/comment', [ProposalApiController::class, 'comment']);

        // Berita CRUD untuk admin/manager
        Route::post('/berita', [BeritaController::class, 'store']);
        Route::put('/berita/{id}', [BeritaController::class, 'update']);
        Route::delete('/berita/{id}', [BeritaController::class, 'destroy']);
    });

    /*
    |--------------------------------------------------------------------------
    | MANAGER ROUTES (role: manager)
    |--------------------------------------------------------------------------
    | Bisa rubah status proposal (approve/reject)
    */
    Route::middleware(['role:manager'])->group(function () {
        Route::post('/admin/proposals/{id}/status', [ProposalApiController::class, 'updateStatus']);
    });

});
=======
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
>>>>>>> 9737a2584fa7e057de3d4e009e8dd97b7d41d5bc
