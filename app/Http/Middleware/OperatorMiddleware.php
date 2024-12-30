<?php

// app/Http/Middleware/OperatorMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperatorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth::user()->role !== 'operator') {
            return redirect('/home');
        }
        return $next($request);
    }
}