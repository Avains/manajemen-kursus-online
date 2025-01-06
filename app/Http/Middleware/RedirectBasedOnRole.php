<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    public function handle($request, Closure $next)
{
    if (Auth::check()) {
        $user = Auth::user();

        // Jika user adalah admin, arahkan ke /dashboard/index
        if ($user->isAdmin()) {
            return redirect()->route('dashboard.admin'); // Gunakan nama rute dashboard.admin
        }

        // Jika user adalah user biasa, arahkan ke /dashboard/user
        if ($user->isUser()) {
            return redirect()->route('dashboard.user'); // Gunakan nama rute dashboard.user
        }
    }

    return $next($request);
}

}
