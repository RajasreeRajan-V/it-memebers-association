<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Student\MentorController;
use App\Http\Controllers\Student\ResumeReviewController;
use App\Http\Controllers\Student\MockInterviewController;
use App\Http\Controllers\Student\WebinarController;
use App\Http\Controllers\Student\TrainingMaterialController;
use App\Http\Controllers\Student\RequestController;
use App\Http\Controllers\Student\SessionController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\NotificationController;
use App\Http\Controllers\Student\SupportController;
use App\Http\Controllers\Student\SearchController;



Route::middleware(['auth'])
    ->name('student.')
    ->group(function () {

        // ===== Home / Dashboard =====
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])
            ->name('dashboard');

        // ===== Find Mentors =====
        Route::prefix('mentors')->name('mentors.')->group(function () {
            Route::get('/', [MentorController::class, 'index'])->name('index');
            Route::get('/{mentor}', [MentorController::class, 'show'])->name('show');
            Route::get('/{mentor}/request', [MentorController::class, 'requestForm'])->name('request');
            Route::post('/{mentor}/request', [MentorController::class, 'storeRequest'])->name('request.store');
        });

        // ===== Resume Review =====
            // ===== Resume Review =====
        Route::get('/resume-review', [ResumeReviewController::class, 'index'])
            ->name('resume-review');
        Route::get('/resume-review/create', [ResumeReviewController::class, 'create'])
            ->name('resume-review.create');
        Route::post('/resume-review', [ResumeReviewController::class, 'store'])
            ->name('resume-review.store');
        Route::get('/resume-review/{review}', [ResumeReviewController::class, 'show'])
            ->name('resume-review.show');



        // ===== Mock Interviews =====
        Route::get('/mock-interviews', [MockInterviewController::class, 'index'])
            ->name('mock-interviews');
        Route::post('/mock-interviews/{interview}/book', [MockInterviewController::class, 'book'])
            ->name('mock-interviews.book');

        // ===== Webinars =====
        Route::get('/webinars', [WebinarController::class, 'index'])
            ->name('webinars');
        Route::post('/webinars/{webinar}/register', [WebinarController::class, 'register'])
            ->name('webinars.register');

        // ===== Training Materials =====
        Route::get('/training-materials', [TrainingMaterialController::class, 'index'])
            ->name('training-materials');
        Route::get('/training-materials/{material}', [TrainingMaterialController::class, 'show'])
            ->name('training-materials.show');

        // ===== My Requests =====
        Route::prefix('requests')->name('requests.')->group(function () {
            Route::get('/', [RequestController::class, 'index'])->name('index');
            Route::get('/pending', [RequestController::class, 'pending'])->name('pending');
            Route::get('/accepted', [RequestController::class, 'accepted'])->name('accepted');
            Route::delete('/{request}', [RequestController::class, 'cancel'])->name('cancel');
        });

        // ===== Sessions (linked from "My Mentorship" sidebar) =====
        Route::prefix('sessions')->name('sessions.')->group(function () {
            Route::get('/upcoming', [SessionController::class, 'upcoming'])->name('upcoming');
            Route::get('/completed', [SessionController::class, 'completed'])->name('completed');
        });

        // ===== Account dropdown =====
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
        Route::put('/settings', [ProfileController::class, 'updateSettings'])->name('settings.update');
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
        Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');

        // ===== Misc (search bar, "How it Works" and "Contact Support" links) =====
        Route::get('/search', [SearchController::class, 'index'])->name('search');
        Route::get('/how-it-works', function () {
            return view('students.how-it-works');
        })->name('how-it-works');
        Route::get('/support', [SupportController::class, 'index'])->name('support');
        Route::post('/support', [SupportController::class, 'store'])->name('support.store');
    });
