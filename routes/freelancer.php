<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Freelancer\FreelancerDashboardController;

Route::middleware(['member.auth'])    
    ->name('freelancer.')    
    ->group(function () {

        Route::get('/about', [FreelancerDashboardController::class, 'about'])
            ->name('about');

        Route::get('/job', [FreelancerDashboardController::class, 'job'])
            ->name('job');
    });