<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\EmployeeDashboardController;
use App\Http\Controllers\Employee\JobController;

Route::middleware(['member.auth'])
    ->name('employee.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])
            ->name('dashboard');

        // Jobs — IMPORTANT: all fixed-segment routes (/jobs/saved, /jobs/applied,
        // /jobs/interviews, /jobs/in-progress, /jobs/hired, /jobs/archived) must
        // come BEFORE /jobs/{job}, otherwise {job} swallows them as a wildcard match.
        Route::get('/jobs', [JobController::class, 'index'])
            ->name('jobs.index');

        Route::get('/jobs/saved', [JobController::class, 'savedJobs'])
            ->name('jobs.saved');

        Route::get('/jobs/applied', [JobController::class, 'appliedJobs'])
            ->name('jobs.applied');

        Route::get('/jobs/interviews', [JobController::class, 'interviewJobs'])
            ->name('jobs.interviews');

        Route::get('/jobs/in-progress', [JobController::class, 'inProgressJobs'])
            ->name('jobs.inProgress');

        Route::get('/jobs/hired', [JobController::class, 'hiredJobs'])
            ->name('jobs.hired');

        Route::get('/jobs/archived', [JobController::class, 'archivedJobs'])
            ->name('jobs.archived');

        // wildcard route must be last among the /jobs/* GET routes
        Route::get('/jobs/{job}', [JobController::class, 'show'])
            ->name('jobs.show');

        Route::post('/jobs/{job}/save', [JobController::class, 'toggleSave'])
            ->name('jobs.save');

        Route::post('/jobs/{job}/apply', [JobController::class, 'apply'])
            ->name('jobs.apply');

        Route::post('/projects/{project}/apply', [\App\Http\Controllers\Employee\ProjectApplicationController::class, 'store'])
    ->name('projects.apply');

    Route::get('/projects/proposals', [\App\Http\Controllers\Employee\ProjectApplicationController::class, 'index'])
    ->name('projects.proposals');

    });