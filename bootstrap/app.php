<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))

    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->alias([

            'customer' => \App\Http\Middleware\CustomerMiddleware::class,

        ]);

        // Webhook Midtrans dikecualikan dari CSRF check,
        // karena request datang dari server Midtrans (bukan browser),
        // jadi tidak membawa CSRF token.
        $middleware->validateCsrfTokens(except: [

            'midtrans/callback',

        ]);

    })

    ->withExceptions(function (Exceptions $exceptions): void {

        //

    })->create();