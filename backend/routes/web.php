<?php

use App\Http\Controllers\ProfileController;
use App\Models\Proposal;
use App\Http\Controllers\ProposalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
  
Route::get('/', function () {
    return view('welcome');
});

// ROUTE PROFILE BAWAAN LARAVEL
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ADMIN AREA
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => 'ADMIN AREA');
});

// MANAGER AREA
Route::middleware(['auth', 'role:manager'])->group(function () {

    // Dashboard manager
    Route::get('/manager/dashboard', function () {
        return view('pages.manager.manager_dashboard');
    })->name('manager.dashboard');

    // Profile manager
    Route::get('/manager/profile', function () {
        return view('pages.manager.manager_profile');
    })->name('manager.profile');

    // Proposal
    Route::get('/manager/proposal/all', function () {
        $proposals = Proposal::all(); // ambil semua data proposal
        return view('pages.manager.manager_allproposal', compact('proposals'));
    })->name('manager.proposal.all')->middleware(['auth','role:manager']);

    Route::get('/manager/propsal/create', function () {
        return view('pages.manager.manager_createproposal');
    })->name('manager.proposal.create');



    // Organisasi, Jadwal, dll
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

}); // <-- tutup group manager

// USER AREA
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', fn() => 'USER AREA');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// ROUTE AUTH BREEZE
require __DIR__.'/auth.php';
