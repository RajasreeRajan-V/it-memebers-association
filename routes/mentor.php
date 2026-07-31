<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mentor\MentorDashboardController;

Route::middleware(['member.auth'])
    ->prefix('mentor')   
    ->name('mentor.')    
    ->group(function () {

        Route::get('/dashboard', [MentorDashboardController::class, 'index'])
            ->name('dashboard');

    });