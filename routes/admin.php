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
use App\Http\Controllers\Admin\MentorshipVerificationController;

// Mentor Program Admin Controllers
use App\Http\Controllers\Admin\MentorshipManagementController;
use App\Http\Controllers\Admin\ResumeReviewManagementController;
use App\Http\Controllers\Admin\WebinarManagementController;
use App\Http\Controllers\Admin\MockInterviewManagementController;
use App\Http\Controllers\Admin\LegalHelpController;
use App\Http\Controllers\Admin\TrainingProgramManagementController;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::name('admin.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Admin Authentication
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
            'registrations/approve-all-investors',
            [RegistrationApprovalController::class, 'approveAllInvestors']
        )->name('registrations.approveAllInvestors');


        /*
        |--------------------------------------------------------------------------
        | Jobs
        |--------------------------------------------------------------------------
        */

        Route::get(
            'jobs',
            [JobApprovalController::class, 'index']
        )->name('jobs.index');

        Route::post(
            'jobs/{job}/approve',
            [JobApprovalController::class, 'approve']
        )->name('jobs.approve');

        Route::post(
            'jobs/{job}/reject',
            [JobApprovalController::class, 'reject']
        )->name('jobs.reject');


        /*
        |--------------------------------------------------------------------------
        | Startups
        |--------------------------------------------------------------------------
        */

        Route::get(
            'startups',
            [StartupApprovalController::class, 'index']
        )->name('startups.index');

        Route::post(
            'startups/{startup}/approve',
            [StartupApprovalController::class, 'approve']
        )->name('startups.approve');

        Route::post(
            'startups/{startup}/reject',
            [StartupApprovalController::class, 'reject']
        )->name('startups.reject');


        /*
        |--------------------------------------------------------------------------
        | Articles
        |--------------------------------------------------------------------------
        */

        Route::get(
            'articles',
            [ArticleApprovalController::class, 'index']
        )->name('articles.index');

        Route::post(
            'articles/{article}/approve',
            [ArticleApprovalController::class, 'approve']
        )->name('articles.approve');

        Route::post(
            'articles/{article}/reject',
            [ArticleApprovalController::class, 'reject']
        )->name('articles.reject');


        /*
        |--------------------------------------------------------------------------
        | Legal Help
        |--------------------------------------------------------------------------
        */

        Route::get(
            'legal-help',
            [LegalHelpController::class, 'index']
        )->name('legal-help.index');

        Route::get(
            'legal-help/{legalRequest}',
            [LegalHelpController::class, 'show']
        )->name('legal-help.show');

        Route::post(
            'legal-help/{legalRequest}/assign',
            [LegalHelpController::class, 'assign']
        )->name('legal-help.assign');

        Route::post(
            'legal-help/{legalRequest}/status',
            [LegalHelpController::class, 'updateStatus']
        )->name('legal-help.status');

        Route::post(
            'legal-help/{legalRequest}/notes',
            [LegalHelpController::class, 'addNote']
        )->name('legal-help.notes.store');

        Route::post(
            'legal-help/{legalRequest}/messages',
            [LegalHelpController::class, 'sendMessage']
        )->name('legal-help.messages.store');

        Route::post(
            'legal-help/{legalRequest}/documents',
            [LegalHelpController::class, 'uploadDocument']
        )->name('legal-help.documents.store');


        /*
        |--------------------------------------------------------------------------
        | 1. Mentorship Verification
        |--------------------------------------------------------------------------
        |
        | Student sends request
        |        ↓
        | Mentor accepts
        |        ↓
        | admin_verification
        |        ↓
        | Admin approves/rejects
        |
        */

        Route::prefix('mentorship')
            ->name('mentorship.')
            ->group(function () {

                /*
                | Pending Verification
                */

                Route::get(
                    'pending-verification',
                    [MentorshipVerificationController::class, 'pending']
                )->name('pending');


                /*
                | Pending Verification Details
                */

                Route::get(
                    'pending-verification/{mentorshipRequest}',
                    [MentorshipVerificationController::class, 'show']
                )->name('pending.show');


                /*
                | Approve Mentorship
                */

                Route::post(
                    '{mentorshipRequest}/approve',
                    [MentorshipVerificationController::class, 'approve']
                )->name('approve');


                /*
                | Reject Mentorship
                */

                Route::post(
                    '{mentorshipRequest}/reject',
                    [MentorshipVerificationController::class, 'reject']
                )->name('reject');


                /*
                | Active Mentorships
                */

                Route::get(
                    'active',
                    [MentorshipVerificationController::class, 'active']
                )->name('active');


                /*
                | Active Mentorship Details
                */

                Route::get(
                    'active/{mentorship}',
                    [MentorshipVerificationController::class, 'activeShow']
                )->name('active.show');

            });


        /*
        |--------------------------------------------------------------------------
        | 2. Mentorship Management
        |--------------------------------------------------------------------------
        */

        Route::get(
            'mentorship-management',
            [MentorshipManagementController::class, 'index']
        )->name('mentorship-management.index');

        Route::post(
            'mentorship-management/assign',
            [MentorshipManagementController::class, 'assign']
        )->name('mentorship-management.assign');

        Route::patch(
            'mentorship-management/{assignment}/status',
            [MentorshipManagementController::class, 'updateStatus']
        )->name('mentorship-management.status');

        Route::get(
            'mentorship-management/{assignment}/sessions',
            [MentorshipManagementController::class, 'sessions']
        )->name('mentorship-management.sessions');

        Route::delete(
            'mentorship-management/{assignment}',
            [MentorshipManagementController::class, 'destroy']
        )->name('mentorship-management.destroy');


        /*
        |--------------------------------------------------------------------------
        | 3. Resume Reviews
        |--------------------------------------------------------------------------
        */

        Route::get(
            'resume-reviews',
            [ResumeReviewManagementController::class, 'index']
        )->name('resume-reviews.index');

        Route::post(
            'resume-reviews/{review}/assign',
            [ResumeReviewManagementController::class, 'assign']
        )->name('resume-reviews.assign');


        /*
        |--------------------------------------------------------------------------
        | Resume Review Confirmation
        |--------------------------------------------------------------------------
        */

        Route::post(
            'confirmations/{confirmation}/approve',
            [ConfirmationController::class, 'approve']
        )->name('confirmations.approve');

        Route::post(
            'confirmations/{confirmation}/reject',
            [ConfirmationController::class, 'reject']
        )->name('confirmations.reject');


        /*
        |--------------------------------------------------------------------------
        | 4. Webinars
        |--------------------------------------------------------------------------
        */

        Route::get(
            'webinars',
            [WebinarManagementController::class, 'index']
        )->name('webinars.index');

        Route::post(
            'webinars/{webinar}/approve',
            [WebinarManagementController::class, 'approve']
        )->name('webinars.approve');

        Route::post(
            'webinars/{webinar}/reject',
            [WebinarManagementController::class, 'reject']
        )->name('webinars.reject');

        Route::post(
            'webinars/{webinar}/publish',
            [WebinarManagementController::class, 'publish']
        )->name('webinars.publish');


        /*
        |--------------------------------------------------------------------------
        | 5. Training Programs
        |--------------------------------------------------------------------------
        */

        Route::get(
            'trainings',
            [TrainingProgramManagementController::class, 'index']
        )->name('trainings.index');

        Route::get(
            'trainings/{training}',
            [TrainingProgramManagementController::class, 'show']
        )->name('trainings.show');

        Route::post(
            'trainings/{training}/approve',
            [TrainingProgramManagementController::class, 'approve']
        )->name('trainings.approve');

        Route::post(
            'trainings/{training}/reject',
            [TrainingProgramManagementController::class, 'reject']
        )->name('trainings.reject');

        Route::post(
            'trainings/{training}/publish',
            [TrainingProgramManagementController::class, 'publish']
        )->name('trainings.publish');

        Route::post(
            'trainings/{training}/unpublish',
            [TrainingProgramManagementController::class, 'unpublish']
        )->name('trainings.unpublish');


        /*
        |--------------------------------------------------------------------------
        | 6. Mock Interviews
        |--------------------------------------------------------------------------
        */

        Route::get(
            'mock-interviews',
            [MockInterviewManagementController::class, 'index']
        )->name('mock-interviews.index');

        Route::post(
            'mock-interviews/assign',
            [MockInterviewManagementController::class, 'assign']
        )->name('mock-interviews.assign');

        Route::get(
            'mock-interviews/{interview}',
            [MockInterviewManagementController::class, 'show']
        )->name('mock-interviews.show');

    });

});