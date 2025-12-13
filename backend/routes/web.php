<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ManagerDashboardController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\SuratController;
use App\Models\Organization; 
use App\Models\Proposal;
use App\Models\Period;


// === 1. PUBLIC ROUTES ===
Route::get('/', function () {
    return view('welcome');
});

// === 2. AUTH ROUTES (BREEZE) & LOGOUT ===
require __DIR__.'/auth.php';

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// === 3. MANAGER AREA (PRIORITAS UTAMA) ===
Route::middleware(['auth', 'role:manager'])->group(function () {
    
// === DASHBOARD DAN PROFILE ===
    Route::get('/manager/dashboard', [ManagerDashboardController::class, 'index'])->name('manager.dashboard');
    Route::get('/manager/profile', fn() => view('pages.manager.manager_profile'))->name('manager.profile');

// === ORGANIZATION ===
    Route::controller(OrganizationController::class)->group(function () {
        Route::get('/organizations', 'index')->name('manager.organization.all');
        Route::get('/detail/{id}', [ProposalController::class, 'show'])->name('manager.proposal.detail');
        Route::get('/organizations/create', 'create')->name('manager.organization.create');
        Route::post('/organizations', 'store')->name('organization.store');
        Route::get('/organizations/{organization}/edit', 'edit')->name('manager.organization.edit');
        Route::put('/organizations/{organization}', 'update')->name('manager.organization.update');
        Route::delete('/organizations/{organization}', 'destroy')->name('manager.organization.destroy');
    });

    // === Periode Organisasi
    Route::resource('periods', PeriodController::class)->names('manager.period'); // Route Resource untuk CRUD standar
    Route::put('/periods/activate', [PeriodController::class, 'activate'])->name('manager.period.activate'); // Route Khusus untuk tombol "Set Aktif"

// === PROPOSAL ===
  Route::prefix('manager/proposal')->middleware(['auth', 'role:manager'])->group(function () {
    // 1. READ (List & Detail)
    Route::get('/all', [ProposalController::class, 'index'])->name('manager.proposal.all'); // Pindahkan logic view ke method index()
    Route::get('/manager/proposal/detail/{proposal}', [ProposalController::class, 'show']);
    // 2. CREATE
    Route::get('/create', [ProposalController::class, 'create'])->name('manager.proposal.create'); // Pindahkan logic view ke method create()
    Route::post('/store', [ProposalController::class, 'store'])->name('manager.proposal.store');
    // 3. EDIT & UPDATE
    Route::get('/edit/{id}', [ProposalController::class, 'edit'])->name('manager.proposal.edit');
    Route::put('/update/{id}', [ProposalController::class, 'update'])->name('manager.proposal.update');
    // 4. DELETE
    Route::delete('/delete/{id}', [ProposalController::class, 'destroy'])->name('manager.proposal.delete');
    // 5. ACTION (Approve/Reject)
    Route::put('/{id}/action', [ProposalController::class, 'updateAction'])->name('manager.proposal.action');
    // 6. BUDGET & IMPORT 
    Route::post('/{id}/simpan-anggaran', [ProposalController::class, 'updateBudget'])->name('manager.proposal.update_budget');
    Route::post('/{id}/import-budget', [ProposalController::class, 'importBudget'])->name('manager.proposal.import_budget'); 
    Route::get('/download-template-budget', [ProposalController::class, 'downloadTemplate'])->name('manager.proposal.download_template');
});

    // === ROUTE SURAT MENYURAT ===
    Route::get('/mail/all', [SuratController::class, 'indexMasuk'])
        ->name('manager.mail.all');
    Route::get('/surat-masuk', [SuratController::class, 'indexMasuk'])
        ->name('manager.surat.masuk');
    Route::get('/surat-keluar', [SuratController::class, 'indexKeluar'])
        ->name('manager.surat.keluar');

    // --- Lain-lain (Schedules & Mail) ---

    Route::get('/manager/schedules/all', fn() => view('pages.manager.manager_allschedule'))->name('manager.schedules.all');
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