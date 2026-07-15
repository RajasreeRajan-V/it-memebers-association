<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employer\JobController;
use App\Http\Controllers\Employer\InternshipController;

Route::middleware(['auth'])
    ->prefix('employer')
    ->name('employer.')
    ->group(function () {
        // ---- Job Routes ----
        Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
        Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
        Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');

        // ---- Internship Routes ----
        Route::get('/internships', [InternshipController::class, 'index'])->name('internships.index');
        Route::get('/internships/create', [InternshipController::class, 'create'])->name('internships.create');
        Route::post('/internships', [InternshipController::class, 'store'])->name('internships.store');
        Route::get('/internships/{internship}', [InternshipController::class, 'show'])->name('internships.show');
        Route::get('/internships/{internship}/edit', [InternshipController::class, 'edit'])->name('internships.edit');
        Route::put('/internships/{internship}', [InternshipController::class, 'update'])->name('internships.update');
        Route::delete('/internships/{internship}', [InternshipController::class, 'destroy'])->name('internships.destroy');
    });