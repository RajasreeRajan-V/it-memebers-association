<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employer\EmployerDashboardController;


Route::middleware(['auth'])
    ->name('employer.')
    ->group(function () {

        Route::get('/dashboard', [EmployerDashboardController::class, 'index'])
            ->name('dashboard');

    });