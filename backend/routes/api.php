<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProposalApiController;

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

    // Module: Proposal
    Route::get('/proposals', [ProposalApiController::class, 'index']); // List semua
    Route::get('/proposals/{id}', [ProposalApiController::class, 'show']); // Detail satu
});