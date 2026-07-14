<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employer\EmployerDashboardController;
use App\Http\Controllers\Employer\InternshipController;
use App\Http\Controllers\Employer\JobController;
use App\Http\Controllers\Employer\ProjectController;
use App\Http\Controllers\Employer\StartupProfileController;


Route::middleware(['auth'])
    ->name('employer.')
    ->group(function () {

        Route::get('/dashboard', [EmployerDashboardController::class, 'index'])
            ->name('dashboard');



              // ---- Post Job ----
    //  Route::resource('jobs', JobController::class); 

        // ---- Post Internship ----
        Route::resource('internships', InternshipController::class)
            ->except(['show']);

        // ---- Post Project ----
        Route::resource('projects', ProjectController::class)
            ->except(['show']);

        // ---- Startup Profile (single profile per employer, no index/destroy) ----
        Route::get('/startup-profile', [StartupProfileController::class, 'show'])
            ->name('startup-profile.show');
        Route::get('/startup-profile/create', [StartupProfileController::class, 'create'])
            ->name('startup-profile.create');
        Route::post('/startup-profile', [StartupProfileController::class, 'store'])
            ->name('startup-profile.store');
        Route::get('/startup-profile/edit', [StartupProfileController::class, 'edit'])
            ->name('startup-profile.edit');
        Route::put('/startup-profile', [StartupProfileController::class, 'update'])
            ->name('startup-profile.update');

    // Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    // Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
});
  






    