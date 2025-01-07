<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RedirectBasedOnRole; // Pastikan namespace middleware Anda benar

// Memuat file autoloader Composer
$app = require_once __DIR__ . '/../vendor/autoload.php';

// Konfigurasi aplikasi
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php', // Route web
        commands: __DIR__ . '/../routes/console.php', // Route console
        health: '/up', // Route health check
    )
    // Menambahkan alias untuk middleware
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role.redirect' => RedirectBasedOnRole::class, // Alias untuk middleware
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Tambahkan handler untuk exceptions jika diperlukan
    })
    ->create();
