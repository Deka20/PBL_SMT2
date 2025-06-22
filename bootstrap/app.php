<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Console\Commands\CleanExpiredBookings;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

    // bootstrap/app.php

$app->middleware([
    // Middleware global
]);

$app->command('bookings:clean', CleanExpiredBookings::class);

$app->routeMiddleware([
    'role' => App\Http\Middleware\CheckRole::class,
    'auth' => App\Http\Middleware\Authenticate::class,
    'admin' => \App\Http\Middleware\AdminMiddleware::class,
    'guest' => App\Http\Middleware\RedirectIfAuthenticated::class,
]);
