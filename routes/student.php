<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentDashboardController;

Route::middleware(['auth'])
    ->name('student.')
    ->group(function () {

        Route::get('/dashboard', [StudentDashboardController::class, 'index'])
            ->name('dashboard');

    });