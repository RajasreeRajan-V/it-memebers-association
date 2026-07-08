<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));

            Route::middleware('web')
                ->prefix('student')
                ->group(base_path('routes/student.php'));

            Route::middleware('web')
                ->prefix('employee')
                ->group(base_path('routes/employee.php'));

            Route::middleware('web')
                ->prefix('employer')
                ->group(base_path('routes/employer.php'));

            Route::middleware('web')
                ->prefix('freelancer')
                ->group(base_path('routes/freelancer.php'));

            Route::middleware('web')
                ->prefix('investor')
                ->group(base_path('routes/investor.php'));

            Route::middleware('web')
                ->prefix('mentor')
                ->group(base_path('routes/mentor.php'));   

        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })
    ->create();