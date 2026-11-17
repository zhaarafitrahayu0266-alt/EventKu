<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Tamu yang membuka halaman wajib-login diarahkan ke halaman masuk
        $middleware->redirectGuestsTo('/masuk');

        // Yang sudah login lalu membuka /masuk atau /daftar diarahkan ke halamannya masing-masing
        $middleware->redirectUsersTo(function (Request $request) {
            if (auth('vendor')->check()) {
                return route('vendor.pengajuan');
            }
            if (auth('admin')->check()) {
                return '/admin';
            }
            return '/';
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();