<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }



            // if (Auth::attempt($request->only('email', 'password'))) {
        //     // Redirect berdasarkan peran
        //     if (Auth::user()->role == 'admin') {
        //         return redirect()->route('admin.index');
        //     } elseif (Auth::user()->role == 'operator') {
        //         return redirect()->route('dashboard');
        //     } else {
        //         return redirect()->route('dashboard');
        //     }
        // }

}