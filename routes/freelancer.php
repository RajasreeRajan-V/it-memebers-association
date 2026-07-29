<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Freelancer\FreelancerDashboardController;

Route::middleware(['auth'])
      
    ->name('freelancer.')    
    ->group(function () {

        Route::get('/about', [FreelancerDashboardController::class, 'about'])
            ->name('about');

    });