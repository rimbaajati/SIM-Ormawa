<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProposalApiController;
use App\Http\Controllers\Api\SuratApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// 1. Route Public (Login)
Route::post('/login', [AuthController::class, 'login']);

// 2. Route Private (Perlu Token)
Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Auth: Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // --- MODULE PROPOSAL ---
    Route::get('/proposals', [ProposalApiController::class, 'index']); 
    Route::get('/proposals/{id}', [ProposalApiController::class, 'show']); 
    Route::post('/proposals', [ProposalApiController::class, 'store']);

    // --- MODULE SURAT ---
    Route::get('/jenis-surat', [SuratApiController::class, 'getJenisSurat']);
    Route::get('/surat-masuk', [SuratApiController::class, 'indexMasuk']);
    Route::post('/surat-masuk', [SuratApiController::class, 'storeMasuk']);
    Route::get('/surat-keluar', [SuratApiController::class, 'indexKeluar']);
    Route::post('/surat-keluar', [SuratApiController::class, 'storeKeluar']);
});