<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Freelancer\FreelancerDashboardController;
use App\Http\Controllers\Freelancer\BidController;
use App\Http\Controllers\Freelancer\FreelancerWorkController;
use App\Http\Controllers\Employer\FreelancerBidController;
use App\Http\Controllers\Freelancer\FreelancersJobController;
use App\Http\Controllers\Freelancer\FreelancerWorkReportController;
use App\Http\Controllers\Freelancer\FreelancerServiceController;    
use App\Http\Controllers\Freelancer\FreelancerServiceInquiryController;
use App\Http\Controllers\Freelancer\ArticleController as FreelancerArticleController;

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
    [FreelancersJobController::class, 'archived']
)->name('archived');

        Route::get(
        '/employer/bids/{bid}',[FreelancerBidController::class, 'show']
        )->name('employer.bids.show');

        Route::post(
            '/employer/bids/{bid}/proceed',
            [FreelancerBidController::class, 'proceed']
        )->name('employer.bids.proceed');

        Route::post(
            '/employer/bids/{bid}/reject',
            [FreelancerBidController::class, 'reject']
        )->name('employer.bids.reject');

        Route::post('/freelancer/jobs/{project}/archive', [FreelancersJobController::class, 'archiveJob'])->name('archive-job');
        
        Route::delete('/freelancer/jobs/{project}/archive', [FreelancersJobController::class, 'unarchiveJob'])->name('unarchive-job');
        Route::get('/bids/{bid}/contract/{type?}', [FreelancerWorkController::class, 'downloadContract'])
    ->where('type', 'contract|signed')
    ->name('contract.download');

    Route::post('/bids/{bid}/signed-contract', [FreelancerWorkController::class, 'uploadSignedContract'])
    ->name('contract.upload-signed');

        
    Route::get('/work-reports', [FreelancerWorkReportController::class, 'index'])->name('work-reports.index');
    Route::post('/work-reports', [FreelancerWorkReportController::class, 'store'])->name('work-reports.store');
    Route::get('/work-reports/{report}/attachment', [FreelancerWorkReportController::class, 'attachment'])->name('work-reports.attachment');
    
    Route::get('/signed-jobs', [FreelancerWorkReportController::class, 'signedJobs'])
    ->name('signed-jobs');

     Route::resource('services', FreelancerServiceController::class)->except('show');

     Route::get('/inquiries', [FreelancerServiceInquiryController::class, 'index'])
    ->name('inquiries.index');

    Route::get('/articles', [FreelancerArticleController::class, 'index'])
    ->name('articles.index');
 
Route::get('/articles/create', [FreelancerArticleController::class, 'create'])
    ->name('articles.create');
 
Route::post('/articles', [FreelancerArticleController::class, 'store'])
    ->name('articles.store');
 
Route::get('/articles/{article}', [FreelancerArticleController::class, 'show'])
    ->name('articles.show');
 
Route::post('/articles/{article}/like', [FreelancerArticleController::class, 'toggleLike'])
    ->name('articles.like');
 
Route::post('/articles/{article}/comments', [FreelancerArticleController::class, 'storeComment'])
    ->name('articles.comments.store');
 
Route::delete('/articles/comments/{comment}', [FreelancerArticleController::class, 'destroyComment'])
    ->name('articles.comments.destroy');
    });