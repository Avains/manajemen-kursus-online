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

// Rute untuk admin
Route::middleware(['auth', 'role.redirect'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    
    // Rute untuk mahasiswa (sudah otomatis dengan resource)
    Route::resource('mahasiswa', MahasiswaController::class);
    
    // Rute lainnya
    Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show'])->name('admin.mahasiswa.show');  // Menampilkan detail mahasiswa
    Route::get('/universitas/search', [MahasiswaController::class, 'search'])->name('admin.universitas.search');  // Mencari universitas
    
    // Rute lainnya yang spesifik
    Route::resource('instruktur', InstrukturController::class);
    Route::resource('kategori', KategoriKursusController::class);
    Route::resource('kursus', KursusController::class);
    Route::resource('pendaftaran', PendaftaranKursusController::class);
    Route::resource('users', UserController::class);
});
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('admin.mahasiswa.index');

// Rute untuk user
Route::middleware(['auth', 'role.redirect'])->prefix('user')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
});

Route::middleware(['auth'])->get('/dashboard', function () {
    $user = Auth::user();

    // Periksa role dan arahkan ke dashboard yang sesuai
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard'); // Arahkan ke admin dashboard
    }

    if ($user->role === 'user') {
        return redirect()->route('user.dashboard'); // Arahkan ke user dashboard
    }

    // Jika role tidak dikenal, kembalikan ke login
    return redirect()->route('login');
})->name('dashboard');

// Rute login dan logout
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman home (welcome)
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// // Resource routes
// Route::resource('dashboard', MahasiswaController::class)->middleware('auth');
// Route::resource('mahasiswa', MahasiswaController::class)->middleware('auth');
// Route::resource('instruktur', InstrukturController::class)->middleware('auth');
// Route::resource('kursus', KursusController::class)->middleware('auth');
// Route::resource('pendaftaran', PendaftaranKursusController::class)->middleware('auth');
// Route::resource('kategori', KategoriKursusController::class)->middleware('auth');
// Route::resource('users', UserController::class)->middleware('auth');

// // Route tambahan
// Route::get('/universitas/search', [MahasiswaController::class, 'search'])->name('universitas.search');
// Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');

