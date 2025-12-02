<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ManagerDashboardController;

/*
|--------------------------------------------------------------------------
| Homepage → Redirect Berdasarkan Role
|--------------------------------------------------------------------------
|
| Jika user belum login → redirect ke login.
| Jika sudah login → redirect sesuai role.
|
*/

Route::get('/', function () {
    if (!auth()->check()) {
        return redirect('/login');
    }

    $role = auth()->user()->role;

    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'manager' => redirect()->route('manager.dashboard'),
        'user' => redirect()->route('user.dashboard'),
        default => abort(403, 'Role tidak dikenali'),
    };
});


/*
|--------------------------------------------------------------------------
| Protected Routes (Auth Required)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard default (Laravel Breeze)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Role Based Routes
|--------------------------------------------------------------------------
*/

//
// ADMIN
//
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return 'ADMIN AREA';
    })->name('admin.dashboard');
});

//
// MANAGER
//
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager/dashboard', function () {
        return view('pages.manager.manager_dashboard');
    })->name('manager.dashboard');
});

//
// USER
//
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return 'USER AREA';
    })->name('user.dashboard');
});

Route::get('/check-session', function () {
    return session()->all();
});

Route::get('/manager/dashboard', [ManagerDashboardController::class, 'index'])->name('manager.dashboard')->middleware('auth');

require __DIR__ . '/auth.php';
