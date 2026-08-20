<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Student\WebinarFeedbackController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Student\MentorController;
use App\Http\Controllers\Student\ResumeReviewController;
use App\Http\Controllers\Student\MockInterviewController;
use App\Http\Controllers\Student\WebinarController;
use App\Http\Controllers\Student\RequestController;
use App\Http\Controllers\Student\SessionController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\NotificationController;
use App\Http\Controllers\Student\SupportController;
use App\Http\Controllers\Student\SearchController;
use App\Http\Controllers\Student\CertificateController;
use App\Http\Controllers\Student\FeedbackController;


Route::middleware(['member.auth'])
    ->name('student.')
    ->group(function () {

        // =====================================================
        // DASHBOARD
        // =====================================================

        Route::get('/dashboard', [StudentDashboardController::class, 'index'])
            ->name('dashboard');


        // =====================================================
        // MENTORS
        // =====================================================

        Route::prefix('mentors')->name('mentors.')->group(function () {

            Route::get('/', [MentorController::class, 'index'])
                ->name('index');

            Route::get('/{mentor}', [MentorController::class, 'show'])
                ->name('show');

            Route::get('/{mentor}/request', [MentorController::class, 'requestForm'])
                ->name('request');

            Route::post('/{mentor}/request', [MentorController::class, 'storeRequest'])
                ->name('request.store');
        });


        // =====================================================
        // RESUME REVIEW
        // =====================================================

        Route::get('/resume-review', [ResumeReviewController::class, 'index'])
            ->name('resume-review');

        Route::get('/resume-review/create', [ResumeReviewController::class, 'create'])
            ->name('resume-review.create');

        Route::post('/resume-review', [ResumeReviewController::class, 'store'])
            ->name('resume-review.store');

        Route::get('/resume-review/{review}', [ResumeReviewController::class, 'show'])
            ->name('resume-review.show');


        // =====================================================
        // MOCK INTERVIEWS
        // =====================================================

        Route::get('/mock-interviews', [MockInterviewController::class, 'index'])
            ->name('mock-interviews');

        Route::post('/mock-interviews/{interview}/book', [MockInterviewController::class, 'book'])
            ->name('mock-interviews.book');


        // =====================================================
        // WEBINARS
        // =====================================================

        Route::get('/webinars', [WebinarController::class, 'index'])
            ->name('webinars');

        Route::post('/webinars/{webinar}/register', [WebinarController::class, 'register'])
            ->name('webinars.register');

        Route::get('/webinars/{webinar}', [WebinarController::class, 'show'])
            ->name('webinars.show');

        Route::get('/my-webinars', [WebinarController::class, 'myWebinars'])
            ->name('webinars.my');

        Route::post('/webinars/{webinar}/feedback', [WebinarFeedbackController::class, 'store'])
            ->name('webinars.feedback');

        Route::get('/webinars/{webinar}/certificate', [CertificateController::class, 'download'])
            ->name('webinars.certificate');


        
        // =====================================================
        // MENTORSHIP REQUESTS
        // =====================================================

        Route::prefix('requests')->name('requests.')->group(function () {

            Route::get('/', [RequestController::class, 'index'])
                ->name('index');

            Route::get('/pending', [RequestController::class, 'pending'])
                ->name('pending');

            Route::get('/accepted', [RequestController::class, 'accepted'])
                ->name('accepted');

            Route::delete('/{request}', [RequestController::class, 'cancel'])
                ->name('cancel');
        });


        // =====================================================
        // MENTORSHIP FEEDBACK
        // =====================================================

        Route::prefix('mentorship/{mentorship}/feedback')
            ->name('mentorship.feedback.')
            ->group(function () {

                Route::get('/', [FeedbackController::class, 'create'])
                    ->name('create');

                Route::post('/', [FeedbackController::class, 'store'])
                    ->name('store');
            });


        // =====================================================
        // MENTORSHIP SESSIONS
        // =====================================================

        Route::prefix('sessions')->name('sessions.')->group(function () {

            Route::get('/upcoming', [SessionController::class, 'upcoming'])
                ->name('upcoming');

            Route::get('/completed', [SessionController::class, 'completed'])
                ->name('completed');

            Route::post('/{session}/confirm', [SessionController::class, 'confirm'])
                ->name('confirm');
        });


        // =====================================================
        // PROFILE
        // =====================================================

        Route::get('/profile', [ProfileController::class, 'show'])
            ->name('profile');

        Route::put('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');


        // =====================================================
        // SETTINGS
        // =====================================================

        Route::get('/settings', [ProfileController::class, 'settings'])
            ->name('settings');

        Route::put('/settings', [ProfileController::class, 'updateSettings'])
            ->name('settings.update');


        // =====================================================
        // NOTIFICATIONS
        // =====================================================

        Route::get('/notifications', [NotificationController::class, 'index'])
            ->name('notifications');


        // =====================================================
        // SEARCH
        // =====================================================

        Route::get('/search', [SearchController::class, 'index'])
            ->name('search');


        // =====================================================
        // HOW IT WORKS
        // =====================================================

        Route::get('/how-it-works', function () {
            return view('students.how-it-works');
        })->name('how-it-works');


        // =====================================================
        // SUPPORT
        // =====================================================

        Route::get('/support', [SupportController::class, 'index'])
            ->name('support');

        Route::post('/support', [SupportController::class, 'store'])
            ->name('support.store');


        // =====================================================
        // LOGOUT
        // =====================================================

        Route::post('/logout', [ProfileController::class, 'logout'])
            ->name('logout');
    });