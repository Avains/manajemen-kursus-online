<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Instruktur;
use App\Models\Kursus;
use App\Models\PendaftaranKursus;
use App\Models\KategoriKursus;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa = Mahasiswa::count();
        $totalInstruktur = Instruktur::count();
        $totalKursus = Kursus::count();
        $totalPendaftaran = PendaftaranKursus::count();
        $totalKategori = KategoriKursus::count();
        $totalUser  = User::count();

        return view('dashboard.index', compact('totalMahasiswa', 'totalInstruktur', 'totalKursus', 'totalPendaftaran', 'totalKategori', 'totalUser'));
    }
}