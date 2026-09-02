<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Student\WebinarFeedbackController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Student\MentorController;
use App\Http\Controllers\Student\ResumeReviewController;
use App\Http\Controllers\Student\WebinarController;
use App\Http\Controllers\Student\RequestController;
use App\Http\Controllers\Student\SessionController;
use App\Http\Controllers\Student\SessionSchedulingController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\NotificationController;
use App\Http\Controllers\Student\SupportController;
use App\Http\Controllers\Student\SearchController;
use App\Http\Controllers\Student\CertificateController;
use App\Http\Controllers\Student\FeedbackController;
use App\Http\Controllers\Student\TrainingController as StudentTrainingController;
use App\Http\Controllers\Student\MockInterviewController as StudentMockInterviewController;
use App\Http\Controllers\Student\JobController as StudentJobController;
use App\Http\Controllers\Student\InternshipController as StudentInternshipController;

Route::middleware(['member.auth'])
    ->name('student.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [StudentDashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Mentors
        |--------------------------------------------------------------------------
        */

        Route::prefix('mentors')
            ->name('mentors.')
            ->group(function () {

                Route::get(
                    '/',
                    [MentorController::class, 'index']
                )->name('index');

                Route::get(
                    '/{mentor}',
                    [MentorController::class, 'show']
                )->name('show');

                Route::get(
                    '/{mentor}/request',
                    [MentorController::class, 'requestForm']
                )->name('request');

                Route::post(
                    '/{mentor}/request',
                    [MentorController::class, 'storeRequest']
                )->name('request.store');
            });


        /*
        |--------------------------------------------------------------------------
        | My Mentorship
        |--------------------------------------------------------------------------
        */

        Route::prefix('mentorship')
            ->name('mentorship.')
            ->group(function () {

                Route::get(
                    '/',
                    [RequestController::class, 'index']
                )->name('index');

                Route::get(
                    '/pending',
                    [RequestController::class, 'pending']
                )->name('pending');

                Route::post(
                    '/requests/{mentorshipRequest}/accept-suggestion',
                    [RequestController::class, 'acceptSuggestion']
                )->name('accept-suggestion');

                Route::delete(
                    '/requests/{mentorshipRequest}',
                    [RequestController::class, 'cancel']
                )->name('cancel');
            });


        /*
        |--------------------------------------------------------------------------
        | Mentorship Requests
        |--------------------------------------------------------------------------
        */

        Route::prefix('requests')
            ->name('requests.')
            ->group(function () {

                Route::get(
                    '/',
                    [RequestController::class, 'index']
                )->name('index');

                Route::get(
                    '/pending',
                    [RequestController::class, 'pending']
                )->name('pending');

                Route::get(
                    '/accepted',
                    [RequestController::class, 'accepted']
                )->name('accepted');

                Route::delete(
                    '/{request}',
                    [RequestController::class, 'cancel']
                )->name('cancel');
            });


        /*
        |--------------------------------------------------------------------------
        | Mentorship Sessions
        |--------------------------------------------------------------------------
        */

        Route::prefix('sessions')
            ->name('sessions.')
            ->group(function () {

                Route::get(
                    '/upcoming',
                    [SessionController::class, 'upcoming']
                )->name('upcoming');

                Route::get(
                    '/completed',
                    [SessionController::class, 'completed']
                )->name('completed');

                Route::get(
                    '/{session}',
                    [SessionController::class, 'show']
                )->name('show');

                Route::post(
                    '/{session}/confirm',
                    [SessionController::class, 'confirm']
                )->name('confirm');

                Route::post(
                    '/{session}/feedback',
                    [SessionController::class, 'storeFeedback']
                )->name('feedback');

                Route::post(
                    '/{session}/cancel',
                    [SessionSchedulingController::class, 'cancel']
                )->name('cancel');
            });


        /*
        |--------------------------------------------------------------------------
        | Mentorship Feedback
        |--------------------------------------------------------------------------
        */

          Route::prefix('mentorship/{mentorship}/feedback')
            ->name('mentorship.feedback.')
            ->group(function () {

                Route::get(
                    '/',
                    [FeedbackController::class, 'create']
                )->name('create');

                Route::post(
                    '/',
                    [FeedbackController::class, 'store']
                )->name('store');
            });


        /*
        |--------------------------------------------------------------------------
        | Jobs
        |--------------------------------------------------------------------------
        */

        Route::prefix('jobs')
            ->name('jobs.')
            ->group(function () {

                Route::get(
                    '/',
                    [StudentJobController::class, 'index']
                )->name('index');
            });


        /*
        |--------------------------------------------------------------------------
        | Internships
        |--------------------------------------------------------------------------
        */

        Route::prefix('internships')
            ->name('internships.')
            ->group(function () {

                Route::get(
                    '/',
                    [StudentInternshipController::class, 'index']
                )->name('index');
            });


        /*
        |--------------------------------------------------------------------------
        | Resume Review
        |--------------------------------------------------------------------------
        */

        Route::prefix('resume-review')
            ->name('resume-review.')
            ->group(function () {

                Route::get(
                    '/',
                    [ResumeReviewController::class, 'index']
                )->name('index');

                Route::get(
                    '/create',
                    [ResumeReviewController::class, 'create']
                )->name('create');

                Route::post(
                    '/',
                    [ResumeReviewController::class, 'store']
                )->name('store');

                Route::get(
                    '/{review}',
                    [ResumeReviewController::class, 'show']
                )->name('show');
            });


        /*
        |--------------------------------------------------------------------------
        | Trainings
        |--------------------------------------------------------------------------
        */

        Route::prefix('trainings')->name('trainings.')->group(function () {
            Route::get('/',                       [StudentTrainingController::class, 'index'])->name('index');
            Route::get('/my-trainings',            [StudentTrainingController::class, 'myTrainings'])->name('my-trainings');
            Route::get('/{training}',              [StudentTrainingController::class, 'show'])->name('show');
            Route::post('/{training}/enroll',      [StudentTrainingController::class, 'enroll'])->name('enroll');
            Route::get('/{training}/learn',        [StudentTrainingController::class, 'learn'])->name('learn');
            Route::post('/{training}/progress',    [StudentTrainingController::class, 'updateProgress'])->name('progress');
            Route::post('/{training}/complete',    [StudentTrainingController::class, 'complete'])->name('complete');
            Route::get('/{training}/certificate',  [StudentTrainingController::class, 'certificate'])->name('certificate');
        });


        /*
        |--------------------------------------------------------------------------
        | Mock Interviews
        |--------------------------------------------------------------------------
        | Inherits 'member.auth' middleware and the 'student.' name prefix from
        | the outer group above (no URL prefix, matching the sibling groups
        | such as 'mentors', 'mentorship', 'resume-review'). Registers as:
        |   student.mock-interviews.index  -> GET  /mock-interviews
        |   student.mock-interviews.show   -> GET  /mock-interviews/{mockInterview}
        |   etc.
        */

        Route::prefix('mock-interviews')->name('mock-interviews.')->group(function () {
            Route::get('/', [StudentMockInterviewController::class, 'index'])->name('index');
            Route::get('/create', [StudentMockInterviewController::class, 'create'])->name('create');
            Route::post('/', [StudentMockInterviewController::class, 'store'])->name('store');
            Route::get('/{mockInterview}', [StudentMockInterviewController::class, 'show'])->name('show');
            Route::patch('/{mockInterview}/cancel', [StudentMockInterviewController::class, 'cancel'])->name('cancel');
            Route::post('/{mockInterview}/feedback', [StudentMockInterviewController::class, 'storeFeedback'])->name('feedback');
        });


        /*
        |--------------------------------------------------------------------------
        | Webinars
        |--------------------------------------------------------------------------
        */

        Route::prefix('webinars')
            ->name('webinars.')
            ->group(function () {

                Route::get(
                    '/',
                    [WebinarController::class, 'index']
                )->name('index');

                Route::post(
                    '/{webinar}/register',
                    [WebinarController::class, 'register']
                )->name('register');

                Route::post(
                    '/{webinar}/feedback',
                    [WebinarFeedbackController::class, 'store']
                )->name('feedback');

                Route::get(
                    '/{webinar}/certificate',
                    [CertificateController::class, 'download']
                )->name('certificate');

                Route::get(
                    '/{webinar}',
                    [WebinarController::class, 'show']
                )->name('show');
            });

        Route::get(
            '/my-webinars',
            [WebinarController::class, 'myWebinars']
        )->name('webinars.my');


        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/profile',
            [ProfileController::class, 'show']
        )->name('profile');

        Route::put(
            '/profile',
            [ProfileController::class, 'update']
        )->name('profile.update');


        /*
        |--------------------------------------------------------------------------
        | Settings
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/settings',
            [ProfileController::class, 'settings']
        )->name('settings');

        Route::put(
            '/settings',
            [ProfileController::class, 'updateSettings']
        )->name('settings.update');


        /*
        |--------------------------------------------------------------------------
        | Notifications
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/notifications',
            [NotificationController::class, 'index']
        )->name('notifications');


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/search',
            [SearchController::class, 'index']
        )->name('search');


        /*
        |--------------------------------------------------------------------------
        | How It Works
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/how-it-works',
            function () {
                return view('students.how-it-works');
            }
        )->name('how-it-works');


        /*
        |--------------------------------------------------------------------------
        | Support
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/support',
            [SupportController::class, 'index']
        )->name('support');

        Route::post(
            '/support',
            [SupportController::class, 'store']
        )->name('support.store');


        /*
        |--------------------------------------------------------------------------
        | Logout
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/logout',
            [ProfileController::class, 'logout']
        )->name('logout');
    });