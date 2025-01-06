<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\KategoriKursusController;
use App\Http\Controllers\InstrukturController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PendaftaranKursusController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::middleware(['auth', 'role.redirect'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard.admin');

Route::middleware(['auth'])->get('/dashboard/user', function () {
    return view('layouts.user'); // Tampilan untuk dashboard user
})->name('dashboard.user');

Route::middleware('guest')->get('/login', function () {
    return view('auth.login');
})->name('login');


Route::middleware('auth')->get('/dashboard', function () {
    $user = Auth::user();

    if ($user->isAdmin()) {
        return redirect('/dashboard/index'); // Arahkan ke dashboard admin
    }

    if ($user->isUser()) {
        return redirect('/dashboard/user'); // Arahkan ke dashboard user
    }

    return redirect('/login'); // Jika peran tidak ditemukan, kembali ke login
})->name('dashboard');


// Route Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Resource routes
Route::resource('mahasiswa', MahasiswaController::class)->middleware('auth');
Route::resource('instruktur', InstrukturController::class)->middleware('auth');
Route::resource('kursus', KursusController::class)->middleware('auth');
Route::resource('pendaftaran', PendaftaranKursusController::class)->middleware('auth');
Route::resource('kategori', KategoriKursusController::class)->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth');

// Route tambahan
Route::get('/universitas/search', [MahasiswaController::class, 'search'])->name('universitas.search');
Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');



Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
