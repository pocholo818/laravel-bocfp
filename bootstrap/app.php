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

        $middleware->append([
                // some are not used atm, but kept just in case
                // \App\Laravel\Middlewares\PreventRequestsDuringMaintenance::class,
                // \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
                // \App\Laravel\Middlewares\TrimStrings::class,
                // \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
                // \App\Laravel\Middlewares\TransformInput::class,
                \Illuminate\Session\Middleware\StartSession::class,
                \Illuminate\View\Middleware\ShareErrorsFromSession::class,
                // \App\Laravel\Middlewares\Backoffice\CheckUserRoleStatus::class,

                \Illuminate\Session\Middleware\StartSession::class,
            ]
        );

        $middleware->alias([
            'backoffice.guest' => \App\Laravel\Middlewares\Backoffice\RedirectIfAuthenticated::class,
            'backoffice.auth'  => \App\Laravel\Middlewares\Backoffice\Authenticate::class,
                        
            // spatie roles
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);

        $middleware->group('web', [
            \App\Laravel\Middlewares\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
