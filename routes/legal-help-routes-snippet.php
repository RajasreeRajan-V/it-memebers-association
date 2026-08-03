<?php

/*
|--------------------------------------------------------------------------
| Legal Help routes
|--------------------------------------------------------------------------
| Paste this block inside your existing:
|   Route::middleware(['auth'])->name('employee.')->group(function () { ... });
| in routes/web.php (or wherever your employee group lives).
|
| Fixed segments (create) are declared BEFORE the /{legalRequest} wildcard,
| same convention used for jobs/articles.
*/

use App\Http\Controllers\Employee\LegalHelpController;

Route::prefix('legal-help')
    ->name('legal-help.')
    ->group(function () {

        Route::get('/', [LegalHelpController::class, 'index'])
            ->name('index');

        Route::get('/create', [LegalHelpController::class, 'create'])
            ->name('create');

        Route::post('/', [LegalHelpController::class, 'store'])
            ->name('store');

        // wildcard route must come after fixed segments above
        Route::get('/{legalRequest}', [LegalHelpController::class, 'show'])
            ->name('show');

        Route::post('/{legalRequest}/messages', [LegalHelpController::class, 'sendMessage'])
            ->name('messages.store');

        Route::post('/{legalRequest}/documents', [LegalHelpController::class, 'uploadDocument'])
            ->name('documents.store');
    });
