<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user(); // Ambil pengguna yang sedang login

        if ($user) {
            // Jika admin
            if ($user->role === 'admin' && $request->is('user/*')) {
                return redirect('/admin/dashboard');
            }

            // Jika user
            if ($user->role === 'user' && $request->is('admin/*')) {
                return redirect('/user/dashboard');
            }
        }

        return $next($request); // Lanjutkan ke request berikutnya
    }
}