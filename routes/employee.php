<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\EmployeeDashboardController;
use App\Http\Controllers\Employee\JobController;
use App\Http\Controllers\Employee\ArticleController;
use App\Http\Controllers\Employee\LegalHelpController;
use App\Http\Controllers\Employee\WebinarController;
use App\Http\Controllers\Employee\WebinarFeedbackController;
use App\Http\Controllers\Employee\CertificateController;

Route::middleware(['member.auth'])
    ->name('employee.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])
            ->name('dashboard');

        // Jobs — fixed-segment routes must come BEFORE /jobs/{job}
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

        Route::post('/jobs/subscribe', [JobController::class, 'subscribe'])
            ->name('jobs.subscribe');

        Route::post('/projects/{project}/apply', [\App\Http\Controllers\Employee\ProjectApplicationController::class, 'store'])
            ->name('projects.apply');

        Route::get('/projects/proposals', [\App\Http\Controllers\Employee\ProjectApplicationController::class, 'index'])
            ->name('projects.proposals');

        // Articles — same rule applies: any fixed segment (e.g. /articles/saved,
        // /articles/create) must be declared BEFORE /articles/{article}.
        Route::get('/articles', [ArticleController::class, 'index'])
            ->name('articles.index');

        Route::get('/articles/create', [ArticleController::class, 'create'])
            ->name('articles.create');

        Route::post('/articles', [ArticleController::class, 'store'])
            ->name('articles.store');

        Route::get('/articles/{article}', [ArticleController::class, 'show'])
            ->name('articles.show');

        Route::post('/articles/{article}/like', [ArticleController::class, 'toggleLike'])
            ->name('articles.like');

        Route::post('/articles/{article}/comments', [ArticleController::class, 'storeComment'])
            ->name('articles.comments.store');

        Route::delete('/articles/comments/{comment}', [ArticleController::class, 'destroyComment'])
            ->name('articles.comments.destroy');




                    // Webinars
        Route::get('/webinars', [WebinarController::class, 'index'])
            ->name('webinars');

        Route::get('/my-webinars', [WebinarController::class, 'myWebinars'])
            ->name('webinars.my');

        Route::post('/webinars/{webinar}/register', [WebinarController::class, 'register'])
            ->name('webinars.register');

        Route::get('/webinars/{webinar}', [WebinarController::class, 'show'])
            ->name('webinars.show');

        Route::post('/webinars/{webinar}/feedback', [WebinarFeedbackController::class, 'store'])
            ->name('webinars.feedback');

        Route::get('/webinars/{webinar}/certificate', [CertificateController::class, 'download'])
            ->name('webinars.certificate');

        // Legal Help — fixed segments (create) BEFORE /{legalRequest} wildcard
        Route::prefix('legal-help')
            ->name('legal-help.')
            ->group(function () {

                Route::get('/', [LegalHelpController::class, 'index'])
                    ->name('index');

                Route::get('/create', [LegalHelpController::class, 'create'])
                    ->name('create');

                Route::post('/', [LegalHelpController::class, 'store'])
                    ->name('store');

                Route::get('/{legalRequest}', [LegalHelpController::class, 'show'])
                    ->name('show');

                Route::post('/{legalRequest}/messages', [LegalHelpController::class, 'sendMessage'])
                    ->name('messages.store');

                Route::post('/{legalRequest}/documents', [LegalHelpController::class, 'uploadDocument'])
                    ->name('documents.store');
            });

    });
