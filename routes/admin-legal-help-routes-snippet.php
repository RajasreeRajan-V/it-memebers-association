<?php

/*
|--------------------------------------------------------------------------
| Admin Legal Help routes
|--------------------------------------------------------------------------
| Add the use statement below to the top of your admin routes file, and
| paste this block inside your existing:
|   Route::middleware(['auth:admin'])->group(function () { ... });
| (the second, non-prefixed one that holds jobs/startups/articles).
*/

use App\Http\Controllers\Admin\LegalHelpController;

Route::get('legal-help', [LegalHelpController::class, 'index'])->name('admin.legal-help.index');
Route::get('legal-help/{legalRequest}', [LegalHelpController::class, 'show'])->name('admin.legal-help.show');
Route::post('legal-help/{legalRequest}/assign', [LegalHelpController::class, 'assign'])->name('admin.legal-help.assign');
Route::post('legal-help/{legalRequest}/status', [LegalHelpController::class, 'updateStatus'])->name('admin.legal-help.status');
Route::post('legal-help/{legalRequest}/notes', [LegalHelpController::class, 'addNote'])->name('admin.legal-help.notes.store');
Route::post('legal-help/{legalRequest}/messages', [LegalHelpController::class, 'sendMessage'])->name('admin.legal-help.messages.store');
Route::post('legal-help/{legalRequest}/documents', [LegalHelpController::class, 'uploadDocument'])->name('admin.legal-help.documents.store');
