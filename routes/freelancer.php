<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Freelancer\FreelancerDashboardController;

Route::middleware(['auth'])
    ->prefix('freelancer')   
    ->name('freelancer.')    
    ->group(function () {

        Route::get('/dashboard', [FreelancerDashboardController::class, 'index'])
            ->name('dashboard');

    });