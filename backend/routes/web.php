<?php

use App\Http\Controllers\ProfileController;
use App\Models\Proposal;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ManagerDashboardController;
use App\Models\Organization;


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

    // Dashboard manager pakai Controller
    Route::get('/manager/dashboard', [ManagerDashboardController::class, 'index'])
        ->name('manager.dashboard');

    // Profile manager
    Route::get('/manager/profile', function () {
        return view('pages.manager.manager_profile');
    })->name('manager.profile');

// === ROUTES PROPOSAL ===
    Route::get('/manager/proposal/all', function () {
        $proposals = Proposal::all(); 
        return view('pages.manager.manager_allproposal', compact('proposals'));
    })->name('manager.proposal.all');

    Route::get('/proposal/{proposal}', [ProposalController::class, 'show'
    ])->name('manager.proposal.detail');

    Route::get('/manager/proposal/create', function () {
        $organizations = Organization::orderBy('name')->get();
        return view('pages.manager.manager_createproposal', compact('organizations'));
    })->name('manager.proposal.create');

    Route::post('/manager/proposal/store', [ProposalController::class, 'store'])
    ->name('manager.proposal.store')
    ->middleware(['auth','role:manager']);

// === ROUTES ORGANISASI ===
    Route::get('/organizations', [OrganizationController::class, 'index'])->name('manager.organization.all');
    Route::get('/organizations/create', [OrganizationController::class, 'create'])->name('manager.organization.create');
    Route::post('/organizations', [OrganizationController::class, 'store'])->name('organization.store');
    Route::get('/organizations/{organization}/edit', [OrganizationController::class, 'edit'])->name('manager.organization.edit');
    Route::put('/organizations/{organization}', [OrganizationController::class, 'update'])->name('manager.organization.update');
    Route::delete('/organizations/{organization}', [OrganizationController::class, 'destroy'])->name('manager.organization.destroy');


    // Organisasi, Jadwal, 

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
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])
        ->name('user.dashboard');
});

// LOGOUT
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// AUTH BREEZE
require __DIR__.'/auth.php';
