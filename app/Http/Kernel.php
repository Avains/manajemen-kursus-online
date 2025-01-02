<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        // Middleware global
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        // Middleware lain
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'operator' => \App\Http\Middleware\OperatorMiddleware::class,
        // 'role.user' => \App\Http\Middleware\RoleUserMiddleware::class,
    ];
}
