<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\KategoriKursusController;
use App\Http\Controllers\InstrukturController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PendaftaranKursusController;
use App\Models\Kursus;

// Halaman login dan autentikasi
Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('mahasiswa', MahasiswaController::class)->middleware('auth');
Route::resource('instruktur', InstrukturController::class)->middleware('auth');
Route::resource('kursus', controller: KursusController::class)->parameters(['kursus' => 'kursus'])->middleware('auth');
Route::resource('pendaftaran', PendaftaranKursusController::class)->middleware('auth');
Route::resource('kategori', controller: KategoriKursusController::class)->middleware('auth');

// Route::get('/kursus', function () {
//     $kursus = Kursus::paginate(15);
//     return view('kursus', compact('kursus'));
// });
// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Contoh rute tambahan
Route::post('kursus/hapus-semua', [KursusController::class, 'destroyAll'])->name('kursus.destroyAll')->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
