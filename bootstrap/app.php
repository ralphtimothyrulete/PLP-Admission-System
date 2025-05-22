<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\CheckAdmissionPeriod;
use App\Console\Commands\CreateAdminUser;
use App\Console\Commands\DeleteUserAccounts;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
         // Register the RoleMiddleware class
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'check.admission.period' => CheckAdmissionPeriod::class,
        ]);

        // Define a custom middleware within the closure for session-based authentication
        return function (Request $request, $next) {
            if ($request->is('dashboard') && !session('is_logged_in')) {
                return redirect()->route('login.form');
            }

            return $next($request);
        };
    })
    ->withCommands([
        CreateAdminUser::class,
        DeleteUserAccounts::class, // Register the DeleteUserAccounts command
    ])
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();