<?php

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

    ->withMiddleware(function (Middleware $middleware) {

        /*
        |--------------------------------------------------------------------------
        | WEB MIDDLEWARE GROUP
        |--------------------------------------------------------------------------
        |
        | Dipakai untuk halaman web biasa (session + view). Sanctum SPA middleware
        | masuk di sini supaya login berbasis cookie/SPA tetap jalan.
        |
        */

        $middleware->group('web', [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);


        /*
        |--------------------------------------------------------------------------
        | API MIDDLEWARE GROUP
        |--------------------------------------------------------------------------
        |
        | Untuk REST API. Sanctum token-based auth TIDAK butuh Stateful middleware,
        | tapi butuh middleware Authenticate supaya Bearer token bekerja.
        |
        */

        $middleware->group('api', [
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Illuminate\Auth\Middleware\Authenticate::class,   // ← Penting
            'throttle:api',                                     // rate limit default
        ]);


        /*
        |--------------------------------------------------------------------------
        | ALIAS MIDDLEWARE
        |--------------------------------------------------------------------------
        |
        | Supaya bisa pakai: ->middleware('auth:sanctum')
        |
        */

        $middleware->alias([
            'auth' => \Illuminate\Auth\Middleware\Authenticate::class,

            // Sanctum Token Ability Checker
            'auth:sanctum' => \Laravel\Sanctum\Http\Middleware\CheckAbilities::class,
            'abilities'    => \Laravel\Sanctum\Http\Middleware\CheckAbilities::class,

            // Email verified (optional)
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

    ->create();
