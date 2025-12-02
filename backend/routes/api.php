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
| Semua rute API diletakkan di sini.
| Gunakan prefix otomatis: /api/... misalnya: /api/login
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Tanpa Login)
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/tracking/{id}', [TrackingController::class, 'show']);

Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/berita/{id}', [BeritaController::class, 'show']);


/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (Harus Login dengan Sanctum)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum'])->group(function () {

    // Logout & get user info
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    /*
    |--------------------------------------------------------------------------
    | USER ROUTES (role: user)
    |--------------------------------------------------------------------------
    | User hanya bisa melihat & mengedit proposal miliknya sendiri
    */
    Route::middleware(['role:user'])->group(function () {
        Route::get('/proposal/my', [ProposalApiController::class, 'myProposals']);
        Route::get('/proposal/my/{id}', [ProposalApiController::class, 'show']);
        Route::put('/proposal/my/{id}', [ProposalApiController::class, 'update']);
    });


    /*
    |--------------------------------------------------------------------------
    | ADMIN & MANAGER ROUTES
    |--------------------------------------------------------------------------
    | Admin dan manager bisa mengelola semua proposal dan berita
    */
    Route::middleware(['role:admin,manager'])->group(function () {

        // Proposal list + comment
        Route::get('/admin/proposals', [ProposalApiController::class, 'index']);
        Route::post('/admin/proposals/{id}/comment', [ProposalApiController::class, 'comment']);

        // CRUD Berita
        Route::post('/berita', [BeritaController::class, 'store']);
        Route::put('/berita/{id}', [BeritaController::class, 'update']);
        Route::delete('/berita/{id}', [BeritaController::class, 'destroy']);
    });


    /*
    |--------------------------------------------------------------------------
    | MANAGER ONLY ROUTES
    |--------------------------------------------------------------------------
    | Manager bisa approve / reject proposal
    */
    Route::middleware(['role:manager'])->group(function () {
        Route::post('/admin/proposals/{id}/status', [ProposalApiController::class, 'updateStatus']);
    });
});
