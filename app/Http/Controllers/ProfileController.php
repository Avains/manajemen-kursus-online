<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show', ['user' => Auth::user()]);
    }

    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);
    
        $user = Auth::user();
        
        // Cek apakah objek yang diterima adalah instance dari User
        if ($user instanceof \App\Models\User) {
            $user->update($request->only('name', 'email'));
        } else {
            return redirect()->route('profile.show')->with('error', 'Pengguna tidak ditemukan.');
        }
    
        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
    }
    
}