<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employer\JobController;
use App\Http\Controllers\Employer\InternshipController;
use App\Http\Controllers\Employer\ProjectController;
use App\Http\Controllers\Admin\JobApprovalController;
use App\Http\Controllers\Employer\StartupProfileController;



Route::middleware(['auth'])
    ->prefix('employer')
    ->name('employer.')
    ->group(function () {

        // ---- Job Routes ----
        Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
        Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
        Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
        Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
        Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
        Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
        Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');

        // ---- Internship Routes ----
        Route::get('/internships', [InternshipController::class, 'index'])->name('internships.index');
        Route::get('/internships/create', [InternshipController::class, 'create'])->name('internships.create');
        Route::post('/internships', [InternshipController::class, 'store'])->name('internships.store');
        Route::get('/internships/{internship}', [InternshipController::class, 'show'])->name('internships.show');
        Route::get('/internships/{internship}/edit', [InternshipController::class, 'edit'])->name('internships.edit');
        Route::put('/internships/{internship}', [InternshipController::class, 'update'])->name('internships.update');
        Route::delete('/internships/{internship}', [InternshipController::class, 'destroy'])->name('internships.destroy');

        // ---- Project Routes ----
        Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
        Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');



       Route::get('/startup-profile', [StartupProfileController::class, 'index'])->name('startup-profile.index');
       Route::get('/startup-profile/create', [StartupProfileController::class, 'create'])->name('startup-profile.create');
       Route::post('/startup-profile', [StartupProfileController::class, 'store'])->name('startup-profile.store');
       Route::get('/startup-profile/show', [StartupProfileController::class, 'show'])->name('startup-profile.show');
       Route::get('/startup-profile/edit', [StartupProfileController::class, 'edit'])->name('startup-profile.edit');
       Route::put('/startup-profile', [StartupProfileController::class, 'update'])->name('startup-profile.update');
       Route::delete('/startup-profile', [StartupProfileController::class, 'destroy'])->name('startup-profile.destroy');
    
    });




    

// ---- Admin Job Approval Routes (sibling group, NOT nested in employer) ----
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('jobs', [JobApprovalController::class, 'index'])->name('jobs.index');
        Route::post('jobs/{job}/approve', [JobApprovalController::class, 'approve'])->name('jobs.approve');
        Route::post('jobs/{job}/reject', [JobApprovalController::class, 'reject'])->name('jobs.reject');
    });