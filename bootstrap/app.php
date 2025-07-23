<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
         // Global middleware (will run on every request)
    // $middleware->append([
    //     \App\Http\Middleware\GlobalActivityLogger::class,
    // ]);
        // Register your role middleware alias here
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'activity' => \App\Http\Middleware\GlobalActivityLogger::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
