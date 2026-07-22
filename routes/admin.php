<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContactusController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\RegistrationApprovalController;
use App\Http\Controllers\Admin\JobApprovalController;
use App\Http\Controllers\Admin\StartupApprovalController;

use Illuminate\Support\Facades\Route;

Route::name('admin.')->group(function () {
    Route::post("/do-login", [LoginController::class,'doLogin'])->name('do.login');
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/admin-dashboard', [DashboardController::class, 'index'])->name('admin-dashboard');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('registrations', [RegistrationApprovalController::class, 'index'])
            ->name('registrations.index');

        Route::patch('registrations/{id}/approve', [RegistrationApprovalController::class, 'approve'])
            ->name('registrations.approve');

        Route::patch('registrations/{id}/reject', [RegistrationApprovalController::class, 'reject'])
            ->name('registrations.reject');

        Route::post('/registrations/approve-all-investors', [RegistrationApprovalController::class, 'approveAllInvestors'])
            ->name('registrations.approveAllInvestors');
    });
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/jobs', [JobApprovalController::class, 'index'])->name('admin.jobs.index');
    Route::post('/jobs/{job}/approve', [JobApprovalController::class, 'approve'])->name('admin.jobs.approve');
    Route::post('/jobs/{job}/reject', [JobApprovalController::class, 'reject'])->name('admin.jobs.reject');

    Route::get('startups', [StartupApprovalController::class, 'index'])->name('admin.startups.index');
    Route::post('startups/{startup}/approve', [StartupApprovalController::class, 'approve'])->name('admin.startups.approve');
    Route::post('startups/{startup}/reject', [StartupApprovalController::class, 'reject'])->name('admin.startups.reject');
});