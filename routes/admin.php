<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContactusController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\RegistrationApprovalController;
use App\Http\Controllers\Admin\JobApprovalController;
use App\Http\Controllers\Admin\StartupApprovalController;
use App\Http\Controllers\Admin\ArticleApprovalController;
use App\Http\Controllers\Admin\ConfirmationController;

// Mentor Program Admin Controllers
use App\Http\Controllers\Admin\MentorshipManagementController;
use App\Http\Controllers\Admin\ResumeReviewManagementController;
use App\Http\Controllers\Admin\WebinarManagementController;
use App\Http\Controllers\Admin\TrainingMaterialManagementController;
use App\Http\Controllers\Admin\MockInterviewManagementController;
use App\Http\Controllers\Admin\LegalHelpController;


/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/

Route::name('admin.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/do-login',
        [LoginController::class, 'doLogin']
    )->name('do.login');


    /*
    |--------------------------------------------------------------------------
    | Authenticated Admin Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware(['auth:admin'])->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/admin-dashboard',
            [DashboardController::class, 'index']
        )->name('admin-dashboard');


        /*
        |--------------------------------------------------------------------------
        | Logout
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/logout',
            [LoginController::class, 'logout']
        )->name('logout');


        /*
        |--------------------------------------------------------------------------
        | Registrations
        |--------------------------------------------------------------------------
        */

        Route::get(
            'registrations',
            [RegistrationApprovalController::class, 'index']
        )->name('registrations.index');

        Route::patch(
            'registrations/{id}/approve',
            [RegistrationApprovalController::class, 'approve']
        )->name('registrations.approve');

        Route::patch(
            'registrations/{id}/reject',
            [RegistrationApprovalController::class, 'reject']
        )->name('registrations.reject');

        Route::post(
            '/registrations/approve-all-investors',
            [RegistrationApprovalController::class, 'approveAllInvestors']
        )->name('registrations.approveAllInvestors');

    });

});


/*
|--------------------------------------------------------------------------
| Admin Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Jobs
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/jobs',
        [JobApprovalController::class, 'index']
    )->name('admin.jobs.index');

    Route::post(
        '/jobs/{job}/approve',
        [JobApprovalController::class, 'approve']
    )->name('admin.jobs.approve');

    Route::post(
        '/jobs/{job}/reject',
        [JobApprovalController::class, 'reject']
    )->name('admin.jobs.reject');


    /*
    |--------------------------------------------------------------------------
    | Startups
    |--------------------------------------------------------------------------
    */

    Route::get(
        'startups',
        [StartupApprovalController::class, 'index']
    )->name('admin.startups.index');

    Route::post(
        'startups/{startup}/approve',
        [StartupApprovalController::class, 'approve']
    )->name('admin.startups.approve');

    Route::post(
        'startups/{startup}/reject',
        [StartupApprovalController::class, 'reject']
    )->name('admin.startups.reject');


    /*
    |--------------------------------------------------------------------------
    | Articles
    |--------------------------------------------------------------------------
    */

    Route::get(
        'articles',
        [ArticleApprovalController::class, 'index']
    )->name('admin.articles.index');

    Route::post(
        'articles/{article}/approve',
        [ArticleApprovalController::class, 'approve']
    )->name('admin.articles.approve');

    Route::post(
        'articles/{article}/reject',
        [ArticleApprovalController::class, 'reject']
    )->name('admin.articles.reject');


    /*
    |--------------------------------------------------------------------------
    | Legal Help
    |--------------------------------------------------------------------------
    */

    Route::get(
        'legal-help',
        [LegalHelpController::class, 'index']
    )->name('admin.legal-help.index');

    Route::get(
        'legal-help/{legalRequest}',
        [LegalHelpController::class, 'show']
    )->name('admin.legal-help.show');

    Route::post(
        'legal-help/{legalRequest}/assign',
        [LegalHelpController::class, 'assign']
    )->name('admin.legal-help.assign');

    Route::post(
        'legal-help/{legalRequest}/status',
        [LegalHelpController::class, 'updateStatus']
    )->name('admin.legal-help.status');

    Route::post(
        'legal-help/{legalRequest}/notes',
        [LegalHelpController::class, 'addNote']
    )->name('admin.legal-help.notes.store');

    Route::post(
        'legal-help/{legalRequest}/messages',
        [LegalHelpController::class, 'sendMessage']
    )->name('admin.legal-help.messages.store');

    Route::post(
        'legal-help/{legalRequest}/documents',
        [LegalHelpController::class, 'uploadDocument']
    )->name('admin.legal-help.documents.store');


    /*
    |--------------------------------------------------------------------------
    | Mentor Program Management
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | 1. Mentorship Management
    |--------------------------------------------------------------------------
    */

    Route::get(
        'mentorship',
        [MentorshipManagementController::class, 'index']
    )->name('admin.mentorship.index');

    Route::post(
        'mentorship/assign',
        [MentorshipManagementController::class, 'assign']
    )->name('admin.mentorship.assign');

    Route::patch(
        'mentorship/{assignment}/status',
        [MentorshipManagementController::class, 'updateStatus']
    )->name('admin.mentorship.status');

    Route::get(
        'mentorship/{assignment}/sessions',
        [MentorshipManagementController::class, 'sessions']
    )->name('admin.mentorship.sessions');

    Route::delete(
        'mentorship/{assignment}',
        [MentorshipManagementController::class, 'destroy']
    )->name('admin.mentorship.destroy');


    /*
    |--------------------------------------------------------------------------
    | 2. Resume Review Management
    |--------------------------------------------------------------------------
    */

    Route::get(
        'resume-reviews',
        [ResumeReviewManagementController::class, 'index']
    )->name('admin.resume-reviews.index');

    Route::post(
        'resume-reviews/{review}/assign',
        [ResumeReviewManagementController::class, 'assign']
    )->name('admin.resume-reviews.assign');


    /*
    |--------------------------------------------------------------------------
    | 2A. Resume Review Admin Confirmation
    |--------------------------------------------------------------------------
    |
    | Mentor submits review
    |       ↓
    | Admin checks review
    |       ↓
    | Approve / Reject
    |       ↓
    | Approve → Student sees feedback
    | Reject  → Mentor revises
    |
    */

    Route::post(
        'confirmations/{confirmation}/approve',
        [ConfirmationController::class, 'approve']
    )->name('admin.confirmations.approve');

    Route::post(
        'confirmations/{confirmation}/reject',
        [ConfirmationController::class, 'reject']
    )->name('admin.confirmations.reject');


    /*
    |--------------------------------------------------------------------------
    | 3. Webinars
    |--------------------------------------------------------------------------
    */

    Route::get(
        'webinars',
        [WebinarManagementController::class, 'index']
    )->name('admin.webinars.index');

    Route::post(
        'webinars/{webinar}/approve',
        [WebinarManagementController::class, 'approve']
    )->name('admin.webinars.approve');

    Route::post(
        'webinars/{webinar}/reject',
        [WebinarManagementController::class, 'reject']
    )->name('admin.webinars.reject');

    Route::post(
        'webinars/{webinar}/publish',
        [WebinarManagementController::class, 'publish']
    )->name('admin.webinars.publish');


    /*
    |--------------------------------------------------------------------------
    | 4. Training Materials
    |--------------------------------------------------------------------------
    */

    Route::get(
        'training-materials',
        [TrainingMaterialManagementController::class, 'index']
    )->name('admin.training-materials.index');

    Route::post(
        'training-materials/{material}/approve',
        [TrainingMaterialManagementController::class, 'approve']
    )->name('admin.training-materials.approve');

    Route::post(
        'training-materials/{material}/reject',
        [TrainingMaterialManagementController::class, 'reject']
    )->name('admin.training-materials.reject');

    Route::post(
        'training-materials/{material}/publish',
        [TrainingMaterialManagementController::class, 'publish']
    )->name('admin.training-materials.publish');


    /*
    |--------------------------------------------------------------------------
    | 5. Mock Interviews
    |--------------------------------------------------------------------------
    */

    Route::get(
        'mock-interviews',
        [MockInterviewManagementController::class, 'index']
    )->name('admin.mock-interviews.index');

    Route::post(
        'mock-interviews/assign',
        [MockInterviewManagementController::class, 'assign']
    )->name('admin.mock-interviews.assign');

    Route::get(
        'mock-interviews/{interview}',
        [MockInterviewManagementController::class, 'show']
    )->name('admin.mock-interviews.show');

});