<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContactusController;
use App\Http\Controllers\Admin\ApplicationController;

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

    Route::post('/registrations/approve-all-investors',[RegistrationApprovalController::class, 'approveAllInvestors'])
       ->name('registrations.approveAllInvestors');
});
});      


Route::get('/jobs', [\App\Http\Controllers\Admin\JobApprovalController::class, 'index'])->name('admin.jobs.index');
Route::post('/jobs/{id}/approve', [\App\Http\Controllers\Admin\JobApprovalController::class, 'approve'])->name('admin.jobs.approve');
Route::post('/jobs/{id}/reject', [\App\Http\Controllers\Admin\JobApprovalController::class, 'reject'])->name('admin.jobs.reject');