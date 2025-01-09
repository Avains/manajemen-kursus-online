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
    
    Route::resource('mahasiswa', MahasiswaController::class)->names([
        'index' => 'admin.mahasiswa.index',
        'create' => 'admin.mahasiswa.create',
        'store' => 'admin.mahasiswa.store',
        'show' => 'admin.mahasiswa.show',
        'edit' => 'admin.mahasiswa.edit',
        'update' => 'admin.mahasiswa.update',
        'destroy' => 'admin.mahasiswa.destroy',
    ]);
    
    Route::resource('instruktur', InstrukturController::class)->names([
        'index' => 'admin.instruktur.index',
        'create' => 'admin.instruktur.create',
        'store' => 'admin.instruktur.store',
        'show' => 'admin.instruktur.show',
        'edit' => 'admin.instruktur.edit',
        'update' => 'admin.instruktur.update',
        'destroy' => 'admin.instruktur.destroy',
    ]);
    
    Route::resource('kategori', KategoriKursusController::class)->parameters([
        'kategori' => 'kategoriKursus',
    ])->names([
        'index' => 'admin.kategori.index',
        'create' => 'admin.kategori.create',
        'store' => 'admin.kategori.store',
        'show' => 'admin.kategori.show',
        'edit' => 'admin.kategori.edit',
        'update' => 'admin.kategori.update',
        'destroy' => 'admin.kategori.destroy',
    ]);
    
    Route::resource('kursus', KursusController::class)->parameters([
        'kursus' => 'kursus',
    ])->names([
        'index' => 'admin.kursus.index',
        'create' => 'admin.kursus.create',
        'store' => 'admin.kursus.store',
        'show' => 'admin.kursus.show',
        'edit' => 'admin.kursus.edit',
        'update' => 'admin.kursus.update',
        'destroy' => 'admin.kursus.destroy',
    ]);
    
    Route::resource('pendaftaran', PendaftaranKursusController::class)->names([
        'index' => 'admin.pendaftaran.index',
        'create' => 'admin.pendaftaran.create',
        'store' => 'admin.pendaftaran.store',
        'show' => 'admin.pendaftaran.show',
        'edit' => 'admin.pendaftaran.edit',
        'update' => 'admin.pendaftaran.update',
        'destroy' => 'admin.pendaftaran.destroy',
    ]);

    Route::resource('users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
});

// Rute untuk user
Route::middleware(['auth', 'role.redirect'])->prefix('user')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
    
    Route::resource('pendaftaran', PendaftaranKursusController::class)->names([
        'index' => 'user.pendaftaran.index',
        'create' => 'user.pendaftaran.create',
        'store' => 'user.pendaftaran.store',
        'show' => 'user.pendaftaran.show',
        'edit' => 'user.pendaftaran.edit',
        'update' => 'user.pendaftaran.update',
        'destroy' => 'user.pendaftaran.destroy',
    ]);
});

// Rute untuk admin dan user (akses yang sama)
Route::middleware(['auth', 'role.redirect'])->group(function () {
    // Admin dan User bisa mengakses halaman pendaftaran
    Route::get('/pendaftaran', [PendaftaranKursusController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/create', [PendaftaranKursusController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran', [PendaftaranKursusController::class, 'store'])->name('pendaftaran.store');
    Route::get('/pendaftaran/{pendaftaran}/edit', [PendaftaranKursusController::class, 'edit'])->name('pendaftaran.edit');
    Route::put('/pendaftaran/{pendaftaran}', [PendaftaranKursusController::class, 'update'])->name('pendaftaran.update');
    Route::delete('/pendaftaran/{pendaftaran}', [PendaftaranKursusController::class, 'destroy'])->name('pendaftaran.destroy');
});

// Halaman Dashboard
Route::middleware(['auth'])->get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard'); // Arahkan ke admin dashboard
    }

    if ($user->role === 'user') {
        return redirect()->route('user.dashboard'); // Arahkan ke user dashboard
    }

    return redirect()->route('login'); // Jika role tidak dikenal, kembali ke login
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
