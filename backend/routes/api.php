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

// ========================================================================
// 1. RUTE PUBLIK (Bisa diakses tanpa login)
// ========================================================================

// Autentikasi Dasar
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Tracking (Publik)
Route::get('/tracking/{id}', [TrackingController::class, 'show']);

// Berita (Publik - Semua orang bisa membaca)
Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/berita/{id}', [BeritaController::class, 'show']);


// ========================================================================
// 2. RUTE TERLINDUNGI (Wajib Login & Punya Token)
// ========================================================================
Route::middleware(['auth:sanctum'])->group(function () {

    // Umum (Semua User Login)
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    /*
    |--------------------------------------------------------------------------
    | ROLE: USER (Mahasiswa/Ormawa)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:user'])->group(function () {
        // Proposal milik sendiri
        Route::get('/proposal/my', [ProposalApiController::class, 'myProposals']);
        Route::get('/proposal/my/{id}', [ProposalApiController::class, 'show']);
        Route::put('/proposal/my/{id}', [ProposalApiController::class, 'update']);
        // Tambahkan Route::post jika user bisa buat proposal baru
        Route::post('/proposal', [ProposalApiController::class, 'store']); 
    });

    /*
    |--------------------------------------------------------------------------
    | ROLE: ADMIN & MANAGER (Pengurus)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin,manager'])->group(function () {
        // Manajemen Proposal (Melihat semua)
        Route::get('/admin/proposals', [ProposalApiController::class, 'index']);
        Route::post('/admin/proposals/{id}/comment', [ProposalApiController::class, 'comment']);

        // Manajemen Berita (CRUD Lengkap: Tambah, Edit, Hapus)
        // Ini yang digunakan oleh form upload di Nuxt kamu tadi
        Route::post('/berita', [BeritaController::class, 'store']);
        Route::put('/berita/{id}', [BeritaController::class, 'update']);
        Route::delete('/berita/{id}', [BeritaController::class, 'destroy']);
    });

    /*
    |--------------------------------------------------------------------------
    | ROLE: MANAGER (Petinggi/Dosen Pembina)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:manager'])->group(function () {
        // Approval Proposal (Approve/Reject)
        Route::post('/admin/proposals/{id}/status', [ProposalApiController::class, 'updateStatus']);
    });

});