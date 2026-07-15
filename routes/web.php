<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employer\JobController;

//MAIN WEBSITE ROUTES
Route::get('/', function () {
    return view('home.index');
})->name('home');

Route::get('/about', function () {
    return view('home.about');
})->name('about');

Route::get('/contact', function () {
    return view('home.contact');
})->name('contact');

Route::get('/members', function () {
    return view('home.member_guide');
})->name('members');

Route::get('/events', function () {
    return view('home.events');
})->name('events');

Route::get('/FAQs', function () {
    return view('home.FAQs');
})->name('FAQs');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');





Route::view('/privacy-policy', 'policies.privacy-policy')->name('privacy.policy');
Route::view('/cookie-policy', 'policies.cookie-policy')->name('cookie.policy');
Route::view('/terms-and-conditions', 'policies.terms-and-conditions')->name('terms.conditions');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/employer.php';