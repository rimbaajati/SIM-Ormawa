<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\Auth\AuthenticatedSessionController;
=======
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
>>>>>>> 6685c1a7c51705e86f36864ff5180a4852fb1fa0

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

<<<<<<< HEAD
// ROUTE PROFILE BAWAAN LARAVEL
Route::middleware('auth')->group(function () {
=======

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
>>>>>>> 6685c1a7c51705e86f36864ff5180a4852fb1fa0
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

<<<<<<< HEAD
// ADMIN AREA
=======

/*
|--------------------------------------------------------------------------
| Role Based Routes
|--------------------------------------------------------------------------
*/

//
// ADMIN
//
>>>>>>> 6685c1a7c51705e86f36864ff5180a4852fb1fa0
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return 'ADMIN AREA';
    })->name('admin.dashboard');
});

<<<<<<< HEAD
// MANAGER AREA
Route::middleware(['auth', 'role:manager'])->group(function () {

    // Dashboard manager (hanya satu)
    Route::get('/manager/dashboard', function () {
        return view('pages.manager.manager_dashboard');
    })->name('manager.dashboard');

    // Profile manager (sekarang aman dan terproteksi)
    Route::get('/manager/profile', function () {
        return view('pages.manager.manager_profile');
    })->name('manager.profile');

    Route::get('/manager/proposals/all', function () {
        return view('pages.manager.manager_allproposal');
    })->name('manager.proposals.all');

    Route::get('/manager/organization/all', function () {
        return view('pages.manager.manager_allorganization');
    })->name('manager.organization.all');

    Route::get('/manager/schedules/all', function () {
        return view('pages.manager.manager_allschedule');
    })->name('manager.schedules.all');

    Route::get('/manager/organizations/profile', function () {
        return view('pages.manager.manager_organizationprofile');
    })->name('manager.organizations.profile');

    Route::get('/manager/mail/all', function () {
        return view('pages.manager.manager_mail');
    })->name('manager.mail.all');
});

// USER AREA
=======
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
>>>>>>> 6685c1a7c51705e86f36864ff5180a4852fb1fa0
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return 'USER AREA';
    })->name('user.dashboard');
});

Route::get('/check-session', function () {
    return session()->all();
});

<<<<<<< HEAD
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

// ROUTE AUTH BREEZE
require __DIR__.'/auth.php';
=======
Route::get('/manager/dashboard', [ManagerDashboardController::class, 'index'])->name('manager.dashboard')->middleware('auth');

require __DIR__ . '/auth.php';
>>>>>>> 6685c1a7c51705e86f36864ff5180a4852fb1fa0
