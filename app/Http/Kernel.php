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
    protected $middlewareAliases = [

        'role.redirect' => \App\Http\Middleware\RedirectBasedOnRole::class,
    ];
    
}
