
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Employer\JobController;
use App\Http\Controllers\Employer\InternshipController;
use App\Http\Controllers\Employer\ProjectController;
use App\Http\Controllers\Employer\StartupProfileController;
use App\Http\Controllers\Employer\ApplicantController;
use App\Http\Controllers\Employer\ArticleController as EmployerArticleController;
use App\Http\Controllers\Employer\EmployerDashboardController;
use App\Http\Controllers\Employer\CandidateInvitationController;
use App\Http\Controllers\Employer\EmployerPortalNotificationController;
use App\Http\Controllers\Admin\JobApprovalController;


/*
|--------------------------------------------------------------------------
| Employer Dashboard
|--------------------------------------------------------------------------
|
| Dashboard route
|
*/

Route::middleware(['member.auth'])->group(function () {

    Route::get('/dashboard', [
        EmployerDashboardController::class,
        'index'
    ])->name('dashboard');

});


/*
|--------------------------------------------------------------------------
| Employer Routes
|--------------------------------------------------------------------------
|
| All employer routes use:
|
| Middleware: member.auth
| URL prefix: /employer
| Route name prefix: employer.
|
*/
Route::middleware(['member.auth'])
    ->name('employer.')
    ->group(function () {


    /*
|--------------------------------------------------------------------------
| Job Routes
|--------------------------------------------------------------------------
*/

Route::get('/jobs', [
    JobController::class,
    'index'
])->name('jobs.index');

Route::get('/jobs/create', [
    JobController::class,
    'create'
])->name('jobs.create');

Route::post('/jobs', [
    JobController::class,
    'store'
])->name('jobs.store');

/*
|--------------------------------------------------------------------------
| Duplicate Job
|--------------------------------------------------------------------------
*/

Route::post('/jobs/{job}/duplicate', [
    JobController::class,
    'duplicate'
])->name('jobs.duplicate');

Route::get('/jobs/{job}', [
    JobController::class,
    'show'
])->name('jobs.show');

Route::get('/jobs/{job}/edit', [
    JobController::class,
    'edit'
])->name('jobs.edit');

Route::put('/jobs/{job}', [
    JobController::class,
    'update'
])->name('jobs.update');

Route::delete('/jobs/{job}', [
    JobController::class,
    'destroy'
])->name('jobs.destroy');

Route::patch('/jobs/{job}/toggle-active', [
    JobController::class,
    'toggleActive'
])->name('jobs.toggle-active');

Route::patch('/jobs/{job}/toggle-active', [
    JobController::class,
    'toggleActive'
])->name('jobs.toggle-active');

Route::patch('/jobs/{job}/close', [
    JobController::class,
    'close'
])->name('jobs.close');

Route::patch('/jobs/{job}/reopen', [
    JobController::class,
    'reopen'
])->name('jobs.reopen');
        /*
        |--------------------------------------------------------------------------
        | Internship Routes
        |--------------------------------------------------------------------------
        */

        Route::get('/internships', [
            InternshipController::class,
            'index'
        ])->name('internships.index');

        Route::get('/internships/create', [
            InternshipController::class,
            'create'
        ])->name('internships.create');

        Route::post('/internships', [
            InternshipController::class,
            'store'
        ])->name('internships.store');

        Route::get('/internships/{internship}', [
            InternshipController::class,
            'show'
        ])->name('internships.show');

        Route::get('/internships/{internship}/edit', [
            InternshipController::class,
            'edit'
        ])->name('internships.edit');

        Route::put('/internships/{internship}', [
            InternshipController::class,
            'update'
        ])->name('internships.update');

        Route::delete('/internships/{internship}', [
            InternshipController::class,
            'destroy'
        ])->name('internships.destroy');

        Route::patch(
            '/internships/{internship}/toggle-status',
            [InternshipController::class, 'toggleStatus']
        )->name('internships.toggle-status');


Route::get('/startup-profile/{startupProfile}/internships', [
    StartupProfileController::class,
    'internships'
])->name('startup-profile.internships');
        /*
        |--------------------------------------------------------------------------
        | Project Routes
        |--------------------------------------------------------------------------
        */

        Route::get('/projects', [
            ProjectController::class,
            'index'
        ])->name('projects.index');

        Route::get('/projects/create', [
            ProjectController::class,
            'create'
        ])->name('projects.create');

        Route::post('/projects', [
            ProjectController::class,
            'store'
        ])->name('projects.store');

        Route::get('/projects/{project}', [
            ProjectController::class,
            'show'
        ])->name('projects.show');

        Route::get('/projects/{project}/edit', [
            ProjectController::class,
            'edit'
        ])->name('projects.edit');

        Route::put('/projects/{project}', [
            ProjectController::class,
            'update'
        ])->name('projects.update');

        Route::delete('/projects/{project}', [
            ProjectController::class,
            'destroy'
        ])->name('projects.destroy');

        Route::patch(
            '/projects/{project}/toggle-status',
            [ProjectController::class, 'toggleStatus']
        )->name('projects.toggle-status');

        Route::patch('/projects/{project}/close', [ProjectController::class, 'close'])
    ->name('projects.close');

Route::patch('/projects/{project}/complete', [ProjectController::class, 'complete'])
    ->name('projects.complete');


 /*
|--------------------------------------------------------------------------
| Startup Profile Routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Startup Profile Index
|--------------------------------------------------------------------------
*/

Route::get('/startup-profile', [
    StartupProfileController::class,
    'index'
])->name('startup-profile.index');


/*
|--------------------------------------------------------------------------
| Create Startup Profile
|--------------------------------------------------------------------------
*/

Route::get('/startup-profile/create', [
    StartupProfileController::class,
    'create'
])->name('startup-profile.create');


/*
|--------------------------------------------------------------------------
| Store Startup Profile
|--------------------------------------------------------------------------
*/

Route::post('/startup-profile', [
    StartupProfileController::class,
    'store'
])->name('startup-profile.store');


/*
|--------------------------------------------------------------------------
| Show Startup Profile
|--------------------------------------------------------------------------
*/

Route::get('/startup-profile/show/{startupProfile}', [
    StartupProfileController::class,
    'show'
])->name('startup-profile.show');


/*
|--------------------------------------------------------------------------
| Edit Startup Profile
|--------------------------------------------------------------------------
*/

Route::get('/startup-profile/edit/{startupProfile}', [
    StartupProfileController::class,
    'edit'
])->name('startup-profile.edit');


/*
|--------------------------------------------------------------------------
| Update Startup Profile
|--------------------------------------------------------------------------
*/

Route::put('/startup-profile/{startupProfile}', [
    StartupProfileController::class,
    'update'
])->name('startup-profile.update');


/*
|--------------------------------------------------------------------------
| Delete Startup Profile
|--------------------------------------------------------------------------
*/

Route::delete('/startup-profile/{startupProfile}', [
    StartupProfileController::class,
    'destroy'
])->name('startup-profile.destroy');


/*
|--------------------------------------------------------------------------
| Publish / Unpublish Startup Profile
|--------------------------------------------------------------------------
*/

Route::post('/startup-profile/{startupProfile}/toggle', [
    StartupProfileController::class,
    'togglePublish'
])->name('startup-profile.toggle');


/*
|--------------------------------------------------------------------------
| Startup Profile Jobs
|--------------------------------------------------------------------------
|
| IMPORTANT:
| Do NOT define this route twice.
|
*/

Route::get('/startup-profile/{startupProfile}/jobs', [
    StartupProfileController::class,
    'jobs'
])->name('startup-profile.jobs');

/*
|--------------------------------------------------------------------------
| Applicant Routes
|--------------------------------------------------------------------------
*/

Route::get('/applicants', [
    ApplicantController::class,
    'index'
])->name('applicants.index');

Route::get('/applicants/{applicant}/details', [
    ApplicantController::class,
    'details'
])->name('applicants.details');

Route::get('/applicants/{applicant}/photo', [
    ApplicantController::class,
    'photo'
])->name('applicants.photo');

Route::get('/applicants/{applicant}', [
    ApplicantController::class,
    'show'
])->name('applicants.show');

Route::post('/applicants/{application}/status', [
    ApplicantController::class,
    'updateStatus'
])->name('applicants.updateStatus');

Route::post('/applicants/{application}/interview', [
    ApplicantController::class,
    'scheduleInterview'
])->name('applicants.scheduleInterview');

Route::post('/applicants/{application}/interview/cancel', [
    ApplicantController::class,
    'cancelInterview'
])->name('applicants.cancelInterview');
        /*
        |--------------------------------------------------------------------------
        | Project Proposal
        |--------------------------------------------------------------------------
        */

        Route::patch(
            '/proposals/{proposal}/status',
            [
                \App\Http\Controllers\Employer\ProjectApplicationController::class,
                'updateStatus'
            ]
        )->name('proposals.updateStatus');


        /*
        |--------------------------------------------------------------------------
        | Article Routes
        |--------------------------------------------------------------------------
        */

        Route::get('/articles', [
            EmployerArticleController::class,
            'index'
        ])->name('articles.index');

        Route::get('/articles/{article}', [
            EmployerArticleController::class,
            'show'
        ])->name('articles.show');

        Route::post(
            '/articles/{article}/like',
            [EmployerArticleController::class, 'toggleLike']
        )->name('articles.like');

        Route::post(
            '/articles/{article}/comments',
            [EmployerArticleController::class, 'storeComment']
        )->name('articles.comments.store');

        Route::delete(
            '/articles/comments/{comment}',
            [EmployerArticleController::class, 'destroyComment']
        )->name('articles.comments.destroy');


        /*
        |--------------------------------------------------------------------------
        | Candidate Invitation
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/candidates/{candidate}/invite',
            [
                CandidateInvitationController::class,
                'send'
            ]
        )->name('candidates.invite');


        /*
        |--------------------------------------------------------------------------
        | Employer Notification Routes
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | These routes are INSIDE the existing employer group.
        |
        | Therefore:
        |
        | /notifications
        | becomes
        | /employer/notifications
        |
        | and:
        |
        | notifications.index
        | becomes
        | employer.notifications.index
        |
        */

        Route::get('/notifications', [
            EmployerPortalNotificationController::class,
            'index'
        ])->name('notifications.index');

        Route::patch('/notifications/{id}/read', [
            EmployerPortalNotificationController::class,
            'markAsRead'
        ])->name('notifications.read');

        Route::patch('/notifications/{id}/unread', [
            EmployerPortalNotificationController::class,
            'markAsUnread'
        ])->name('notifications.unread');

        Route::patch('/notifications/read-all', [
            EmployerPortalNotificationController::class,
            'markAllAsRead'
        ])->name('notifications.readAll');

        Route::delete('/notifications/{id}', [
            EmployerPortalNotificationController::class,
            'destroy'
        ])->name('notifications.destroy');

    });


/*
|--------------------------------------------------------------------------
| Public Candidate Invitation
|--------------------------------------------------------------------------
*/

Route::get(
    '/job-invitations/{token}',
    [
        CandidateInvitationController::class,
        'open'
    ]
)->name('job.invitations.open');


/*
|--------------------------------------------------------------------------
| Admin Job Approval Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

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

    });
