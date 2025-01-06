<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Tentukan redirect berdasarkan role.
     *
     * @return string
     */


    protected function redirectTo()
    {
        // Jika role user adalah admin, arahkan ke dashboard admin
        if (Auth::user()->role === 'admin') {
            return route('dashboard.admin');  // Admin dashboard route
        }
        // Jika role user adalah user biasa, arahkan ke dashboard user
        elseif (Auth::user()->role === 'user') {
            return route('dashboard.user');  // User dashboard route
        }
    
        // Default redirect jika tidak ada role yang cocok
        return '/';
    }
    
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
