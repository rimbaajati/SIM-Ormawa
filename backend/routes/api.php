<?php

use App\Http\Controllers\API\TrackingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\API\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});



Route::get('/tracking/{id}', [TrackingController::class, 'show']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);