<?php

// use App\Http\Controllers\Auth\AuthenticatedSessionController;
// use App\Http\Controllers\Auth\ConfirmablePasswordController;
// use App\Http\Controllers\Auth\EmailVerificationNotificationController;
// use App\Http\Controllers\Auth\EmailVerificationPromptController;
// use App\Http\Controllers\Auth\NewPasswordController;
// use App\Http\Controllers\Auth\PasswordController;
// use App\Http\Controllers\Auth\PasswordResetLinkController;
// use App\Http\Controllers\Auth\RegisteredUserController;
// use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\CommonLoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\DashboardController;

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post("/logout", [LoginController::class,'logout'])->name('logout');


Route::get('/membership', [CommonLoginController::class, 'login'])->name('membership');
Route::post('/do_login', [CommonLoginController::class, 'authenticate'])->name('do_login');

Route::post("/member-logout", [CommonLoginController::class,'logout'])->name('member-logout');

Route::post('/membership-logout', [CommonLoginController::class, 'logout'])->name('membership-logout');


Route::get('/registration', [RegistrationController::class, 'register'])->name('registration');
Route::post('/do_registration', [RegistrationController::class, 'store'])->name('do_registration');
Route::get('/payment/{user}', [RegistrationController::class, 'showPayment'])->name('payment.show');
Route::get('/payment/{user}/verify', [RegistrationController::class, 'verifyPayment'])->name('payment.verify');

Route::middleware('member.auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('member.auth')->get('/profile', [ProfileController::class, 'profile'])->name('profile');

Route::middleware('member.auth')->group(function () {
 
    // GET /profile — shows the page in profile.profile (the view you shared)
    Route::get('/profile-edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');
 
    // PUT /profile/details — the "Save Changes" form inside #editProfileSection
    Route::put('/profile/details', [ProfileController::class, 'updateDetails'])
        ->name('profile.details.update');
 
    // POST /profile/resume — the top resume-card "Upload Resume" form
    Route::post('/profile/resume', [ProfileController::class, 'uploadResume'])
        ->name('profile.resume.upload');
 
    // POST /profile/avatar — the camera icon avatar upload
    Route::post('/profile/avatar', [ProfileController::class, 'uploadAvatar'])
        ->name('profile.avatar.upload');
 
    // PATCH /profile/toggles — the "Show to Corporates" / "Looking for Jobs" switches
    Route::patch('/profile/toggles', [ProfileController::class, 'updateToggles'])
        ->name('profile.toggles.update');

    Route::put('/profile/basic-info', [ProfileController::class, 'updateBasicInfo'])
        ->name('profile.basic.update');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
     ->name('profile.password.update');

    Route::post('/profile/picture', [ProfileController::class, 'uploadAvatar'])
        ->name('profile.picture.upload');
});