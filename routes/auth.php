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

use App\Http\Controllers\DashboardController;

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post("/logout", [LoginController::class,'logout'])->name('logout');


Route::get('/membership', [CommonLoginController::class, 'login'])->name('membership');
Route::post('/do_login', [CommonLoginController::class, 'authenticate'])->name('do_login');


Route::post('/membership-logout', [CommonLoginController::class, 'logout'])->name('membership-logout');


Route::get('/registration', [RegistrationController::class, 'register'])->name('registration');
Route::post('/do_registration', [RegistrationController::class, 'store'])->name('do_registration');
Route::get('/payment/{user}', [RegistrationController::class, 'showPayment'])->name('payment.show');
Route::get('/payment/{user}/verify', [RegistrationController::class, 'verifyPayment'])->name('payment.verify');

Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');