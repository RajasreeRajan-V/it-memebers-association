<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Mentor\MentorDashboardController;
use App\Http\Controllers\Mentor\MenteeController;
use App\Http\Controllers\Mentor\ResumeReviewController;
use App\Http\Controllers\Mentor\WebinarController;
use App\Http\Controllers\Mentor\MockInterviewController;
use App\Http\Controllers\Mentor\WebinarAttendanceController;
use App\Http\Controllers\Mentor\SessionSchedulingController;
use App\Http\Controllers\Mentor\SessionLifecycleController;
use App\Http\Controllers\Mentor\CompleteMentorshipController;

Route::middleware(['member.auth'])
    ->prefix('mentor')
    ->name('mentor.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [MentorDashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | My Mentees / Mentorship Requests
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
            '/mentees/requests/{mentorshipRequest}/accept',
            [MenteeController::class, 'acceptRequest']
        )->name('requests.accept');

        Route::post(
            '/mentees/requests/{mentorshipRequest}/reject',
            [MenteeController::class, 'rejectRequest']
        )->name('requests.reject');

        Route::post(
            '/mentees/requests/{mentorshipRequest}/suggest-time',
            [MenteeController::class, 'suggestTime']
        )->name('requests.suggest-time');


        /*
        |--------------------------------------------------------------------------
        | Complete Mentorship
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/mentees/{mentee}/complete',
            [CompleteMentorshipController::class, 'complete']
        )->name('mentees.complete');


        /*
        |--------------------------------------------------------------------------
        | Session Scheduling
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/mentees/{mentee}/sessions/create',
            [SessionSchedulingController::class, 'create']
        )->name('sessions.create');

        Route::post(
            '/mentees/{mentee}/sessions',
            [SessionSchedulingController::class, 'store']
        )->name('sessions.store');

        Route::post(
            '/sessions/{session}/reschedule',
            [SessionSchedulingController::class, 'reschedule']
        )->name('sessions.reschedule');

        Route::post(
            '/sessions/{session}/cancel',
            [SessionSchedulingController::class, 'cancel']
        )->name('sessions.cancel');


        /*
        |--------------------------------------------------------------------------
        | Session Lifecycle
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/sessions/{session}/conduct',
            [SessionLifecycleController::class, 'conduct']
        )->name('sessions.conduct');

        Route::post(
            '/sessions/{session}/notes',
            [SessionLifecycleController::class, 'storeNotes']
        )->name('sessions.notes');

        Route::post(
            '/sessions/{session}/complete',
            [SessionLifecycleController::class, 'markCompleted']
        )->name('sessions.complete');


        /*
        |--------------------------------------------------------------------------
        | Resume Reviews
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
        | Webinars
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

        Route::get(
            '/webinars/{webinar}/registrations',
            [WebinarController::class, 'registrations']
        )->name('webinars.registrations.index');


        /*
        |--------------------------------------------------------------------------
        | Webinar Attendance & Resources
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/webinars/{webinar}/attendance',
            [WebinarAttendanceController::class, 'edit']
        )->name('webinars.attendance');

        Route::put(
            '/webinars/{webinar}/attendance',
            [WebinarAttendanceController::class, 'updateAttendance']
        )->name('webinars.attendance.update');

        Route::post(
            '/webinars/{webinar}/resources',
            [WebinarAttendanceController::class, 'storeResource']
        )->name('webinars.resources.store');

        Route::delete(
            '/webinar-resources/{resource}',
            [WebinarAttendanceController::class, 'destroyResource']
        )->name('webinar-resources.destroy');


        /*
        |--------------------------------------------------------------------------
        | Mock Interviews
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