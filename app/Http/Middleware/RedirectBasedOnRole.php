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
                // Mengizinkan akses ke admin.pendaftaran untuk user
                if (in_array($request->route()->getName(), [
                    'admin.pendaftaran.index', 
                    'admin.pendaftaran.create',
                    'admin.pendaftaran.edit',
                    'admin.pendaftaran.destroy'
                ])) {
                    return $next($request);
                }

                // Pengguna biasa tidak bisa mengakses halaman admin lainnya
                return redirect()->route('user.dashboard');
            }
        }

        return $next($request); // Lanjutkan ke request berikutnya
    }
}