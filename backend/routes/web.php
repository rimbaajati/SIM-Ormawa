<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('layouts.index'); })->name('dashboard');

//Manager Routes
Route::get('/manager/dashboard', function () { return view('pages.manager.manager_dashboard'); })->name('manager.dashboard');
Route::get('/manager/allproposals',function(){ return view('pages.manager.manager_allproposal');})->name('manager.proposals.all');
Route::get('/manager/allorganizations', function() { return view('pages.manager.manager_allorganization');})->name('manager.organization.all');
Route::get('manager/allorganizations/organizationsprofile', function() { return view ('pages.manager.manager_organizationsprofile');})->name('manager.organizations.profile');
Route::get('/manager/allschedules', function() { return view('pages.manager.manager_allschedule');})->name('manager.schedules.all');
Route::get('/manager/profile', function() { return view('pages.manager.manager_profile');})->name('manager.profile');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

