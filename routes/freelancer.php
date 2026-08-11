<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Freelancer\FreelancerDashboardController;
use App\Http\Controllers\Freelancer\BidController;
use App\Http\Controllers\Freelancer\FreelancerWorkController;

Route::middleware(['member.auth'])
    ->name('freelancer.')
    ->group(function () {

        Route::get('/about', [FreelancerDashboardController::class, 'about'])
            ->name('about');

        Route::get('/job', [FreelancerDashboardController::class, 'job'])
            ->name('job');

        Route::get('/bid/{project}/edit', [BidController::class, 'edit'])
            ->name('bid.edit');

        Route::post('/bid/submit', [BidController::class, 'store'])->name('bid.submit');

        Route::post('/resume/upload', [FreelancerDashboardController::class, 'uploadResume'])
            ->name('resume.upload');

        Route::get('/saved-jobs', [FreelancerWorkController::class, 'savedJobs'])
            ->name('saved-jobs');

        Route::post('/saved-jobs/{project}', [FreelancerWorkController::class, 'saveJob'])
            ->name('save-job');

        Route::delete('/saved-jobs/{project}', [FreelancerWorkController::class, 'unsaveJob'])
            ->name('unsave-job');

        Route::get(
            '/applied-jobs',
            [FreelancerWorkController::class, 'appliedJobs']
        )->name('applied');

        Route::get(
            '/my-proposals',
            [FreelancerWorkController::class, 'proposals']
        )->name('proposals');

        Route::get(
            '/interviews',
            [FreelancerWorkController::class, 'interviews']
        )->name('interviews');

        Route::get(
            '/in-progress',
            [FreelancerWorkController::class, 'inProgress']
        )->name('in-progress');

        Route::get(
            '/hired',
            [FreelancerWorkController::class, 'hired']
        )->name('hired');

        Route::get(
            '/archived',
            [FreelancerWorkController::class, 'archived']
        )->name('archived');
    });