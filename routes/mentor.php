<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Mentor\MentorDashboardController;
use App\Http\Controllers\Mentor\MenteeController;
use App\Http\Controllers\Mentor\ResumeReviewController;
use App\Http\Controllers\Mentor\WebinarController;
use App\Http\Controllers\Mentor\TrainingMaterialController;
use App\Http\Controllers\Mentor\MockInterviewController;
use App\Http\Controllers\Mentor\MentorRequestController;


Route::middleware(['auth'])
    ->prefix('mentor')
    ->name('mentor.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Home
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [MentorDashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | 1. My Mentees
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/mentees',
            [MenteeController::class, 'index']
        )->name('mentees.index');

        Route::get(
            '/mentees/{mentee}',
            [MenteeController::class, 'show']
        )->name('mentees.show');

        Route::post(
            '/mentees/{mentee}/sessions',
            [MenteeController::class, 'storeSession']
        )->name('mentees.sessions.store');


        /*
        |--------------------------------------------------------------------------
        | Mentorship Requests
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/mentees/requests/{mentorshipRequest}/accept',
            [MenteeController::class, 'acceptRequest']
        )->name('mentees.requests.accept');

        Route::post(
            '/mentees/requests/{mentorshipRequest}/reject',
            [MenteeController::class, 'rejectRequest']
        )->name('mentees.requests.reject');


        /*
        |--------------------------------------------------------------------------
        | Sessions
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/sessions/{session}/conduct',
            [MenteeController::class, 'conductSession']
        )->name('sessions.conduct');

        Route::post(
            '/sessions/{session}/notes',
            [MenteeController::class, 'storeNotes']
        )->name('sessions.notes.store');

        Route::post(
            '/sessions/{session}/complete',
            [MenteeController::class, 'markCompleted']
        )->name('sessions.complete');


        /*
        |--------------------------------------------------------------------------
        | 2. Resume Reviews
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/resume-reviews',
            [ResumeReviewController::class, 'index']
        )->name('resume-reviews.index');

        Route::get(
            '/resume-reviews/{review}',
            [ResumeReviewController::class, 'show']
        )->name('resume-reviews.show');

        Route::post(
            '/resume-reviews/{review}/submit',
            [ResumeReviewController::class, 'submit']
        )->name('resume-reviews.submit');


        /*
        |--------------------------------------------------------------------------
        | 3. Webinars & Workshops
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/webinars',
            [WebinarController::class, 'index']
        )->name('webinars.index');

        Route::get(
            '/webinars/create',
            [WebinarController::class, 'create']
        )->name('webinars.create');

        Route::post(
            '/webinars',
            [WebinarController::class, 'store']
        )->name('webinars.store');

        Route::get(
            '/webinars/{webinar}/edit',
            [WebinarController::class, 'edit']
        )->name('webinars.edit');

        Route::put(
            '/webinars/{webinar}',
            [WebinarController::class, 'update']
        )->name('webinars.update');

        Route::delete(
            '/webinars/{webinar}',
            [WebinarController::class, 'destroy']
        )->name('webinars.destroy');


        /*
        |--------------------------------------------------------------------------
        | 4. Training Materials
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/training-materials',
            [TrainingMaterialController::class, 'index']
        )->name('training-materials.index');

        Route::get(
            '/training-materials/create',
            [TrainingMaterialController::class, 'create']
        )->name('training-materials.create');

        Route::post(
            '/training-materials',
            [TrainingMaterialController::class, 'store']
        )->name('training-materials.store');

        Route::delete(
            '/training-materials/{trainingMaterial}',
            [TrainingMaterialController::class, 'destroy']
        )->name('training-materials.destroy');

        Route::get(
            '/training-materials/{trainingMaterial}/download',
            [TrainingMaterialController::class, 'download']
        )->name('training-materials.download');

        Route::post(
            '/training-materials/{trainingMaterial}/view',
            [TrainingMaterialController::class, 'incrementView']
        )->name('training-materials.view');

        Route::post(
            '/training-materials/{trainingMaterial}/rate',
            [TrainingMaterialController::class, 'rate']
        )->name('training-materials.rate');


        /*
        |--------------------------------------------------------------------------
        | 5. Mock Interviews
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/mock-interviews',
            [MockInterviewController::class, 'index']
        )->name('mock-interviews.index');

        Route::get(
            '/mock-interviews/{interview}',
            [MockInterviewController::class, 'show']
        )->name('mock-interviews.show');

        Route::post(
            '/mock-interviews/{interview}/schedule',
            [MockInterviewController::class, 'schedule']
        )->name('mock-interviews.schedule');

        Route::post(
            '/mock-interviews/{interview}/conduct',
            [MockInterviewController::class, 'conduct']
        )->name('mock-interviews.conduct');

        Route::post(
            '/mock-interviews/{interview}/feedback',
            [MockInterviewController::class, 'submitFeedback']
        )->name('mock-interviews.feedback');

    });