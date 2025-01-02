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
use App\Models\Kursus;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OperatorController;

// Route::middleware(['auth', 'role.user'])->group(function () {
//     Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
// });

// Halaman login dan autentikasi
Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('mahasiswa', MahasiswaController::class)->middleware('auth');
Route::resource('instruktur', InstrukturController::class)->middleware('auth');
Route::resource('kursus', controller: KursusController::class)->parameters(['kursus' => 'kursus'])->middleware('auth');
Route::resource('pendaftaran', PendaftaranKursusController::class)->middleware('auth');
Route::resource('kategori', controller: KategoriKursusController::class)->middleware('auth');
Route::resource('users', controller: UserController::class)->middleware('auth');



Route::get('/', function () {
    return view('welcome');
});

// Contoh rute tambahan
Route::post('kursus/hapus-semua', [KursusController::class, 'destroyAll'])->name('kursus.destroyAll')->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
