<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

<<<<<<< HEAD
/*
|--------------------------------------------------------------------------
| Protected Routes (Auth Required)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
=======
//LOGIN AS MANAGER
Route::get('/manager/dashboard', function () {
    return view('pages.manager.manager_dashboard');
})->name('manager.dashboard')->middleware('auth');
>>>>>>> 5003ed636fdefcf3c7afa9ac035efc3825cc1597

    // --- Dashboard umum (Laravel Breeze default) ---
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // --- Profile ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Role Based Routes
|--------------------------------------------------------------------------
*/

// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return 'ADMIN AREA';
    })->name('admin.dashboard');
});

// Manager
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager/dashboard', function () {
        return 'MANAGER AREA';
    })->name('manager.dashboard');
});

// User
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return 'USER AREA';
    })->name('user.dashboard');
});

require __DIR__ . '/auth.php';
