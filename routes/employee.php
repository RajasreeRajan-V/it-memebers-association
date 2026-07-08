<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\EmployeeDashboardController;

Route::middleware(['auth'])
    ->name('employee.')
    ->group(function () {

        Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])
            ->name('dashboard');

    });