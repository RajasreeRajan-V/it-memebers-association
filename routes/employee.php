<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\EmployeeDashboardController;
use App\Http\Controllers\Employee\JobController;


Route::middleware(['auth'])
    ->name('employee.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])
            ->name('dashboard');

        // Jobs
        Route::get('/jobs', [JobController::class, 'index'])
            ->name('jobs.index');

        Route::get('/jobs/{job}', [JobController::class, 'show'])
            ->name('jobs.show');
    });