<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Penting untuk Auth::user()
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ManagerDashboardController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProposalController;
use App\Models\Organization; // Penting agar tidak error class not found
use App\Models\Proposal;

// === 1. PUBLIC ROUTES ===
Route::get('/', function () {
    return view('welcome');
});

// === 2. AUTH ROUTES (BREEZE) & LOGOUT ===
require __DIR__.'/auth.php';

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// === 3. MANAGER AREA (PRIORITAS UTAMA) ===
Route::middleware(['auth', 'role:manager'])->group(function () {
    
    // --- Dashboard & Profile Pribadi ---
    Route::get('/manager/dashboard', [ManagerDashboardController::class, 'index'])->name('manager.dashboard');
    Route::get('/manager/profile', fn() => view('pages.manager.manager_profile'))->name('manager.profile');

    // --- Organization Management (CRUD) ---
    Route::controller(OrganizationController::class)->group(function () {
        Route::get('/organizations', 'index')->name('manager.organization.all');
        Route::get('/manager/organization/profile/{id}', 'show')->name('manager.organization.show');
        Route::get('/organizations/create', 'create')->name('manager.organization.create');
        Route::post('/organizations', 'store')->name('organization.store');
        Route::get('/organizations/{organization}/edit', 'edit')->name('manager.organization.edit');
        Route::put('/organizations/{organization}', 'update')->name('manager.organization.update');
        Route::delete('/organizations/{organization}', 'destroy')->name('manager.organization.destroy');
    });
    // --- Organization Profile View (FIX ERROR DISINI) ---
    Route::get('/manager/organizations/{organization}/profile', function (Organization $organization) {
    return view('pages.manager.organization.manager_organizationprofile', ['org' => $organization] );
})->name('manager.organization.profile');

    // === Proposal Management ===
    Route::prefix('manager/proposal')->group(function () {
        Route::get('/all', function () {
            $proposals = Proposal::all(); 
            return view('pages.manager.proposal.manager_allproposal', compact('proposals'));
        })->name('manager.proposal.all');

        Route::get('/create', function () {
            $organizations = Organization::orderBy('name')->get();
            return view('pages.manager.proposal.manager_createproposal', compact('organizations'));
        })->name('manager.proposal.create');

        Route::post('/store', [ProposalController::class, 'store'])
            ->name('manager.proposal.store');
    });

    Route::get('/proposal/{proposal}', [ProposalController::class, 'show'])
        ->name('manager.proposal.detail');


    // --- Lain-lain (Schedules & Mail) ---
    Route::get('/manager/schedules/all', fn() => view('pages.manager.manager_allschedule'))->name('manager.schedules.all');
    Route::get('/manager/mail/all', fn() => view('pages.manager.manager_mail'))->name('manager.mail.all');
});


// =========================================================================
// === 4. ADMIN AREA ===
// =========================================================================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => 'ADMIN AREA')->name('admin.dashboard');
});


// =========================================================================
// === 5. USER AREA ===
// =========================================================================
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});


// =========================================================================
// === 6. PROFILE SETTINGS (BAWAAN LARAVEL) ===
// =========================================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});