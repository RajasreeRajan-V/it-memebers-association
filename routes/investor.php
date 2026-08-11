<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Investor\InvestorDashboardController;

Route::middleware(['member.auth'])
    ->prefix('investor')   
    ->name('investor.')    
    ->group(function () {

        Route::get('/dashboard', [InvestorDashboardController::class, 'index'])
            ->name('dashboard');

    });