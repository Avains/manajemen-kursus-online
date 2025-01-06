<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Instruktur;
use App\Models\Kursus;
use App\Models\PendaftaranKursus;
use App\Models\KategoriKursus;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data total dari setiap model
        $totalMahasiswa = Mahasiswa::count();
        $totalInstruktur = Instruktur::count();
        $totalKursus = Kursus::count();
        $totalPendaftaran = PendaftaranKursus::count();
        $totalKategori = KategoriKursus::count();
        $totalUser = User::count();

        // Kirim data ke view
        return view('dashboard.index', compact(
            'totalMahasiswa',
            'totalInstruktur',
            'totalKursus',
            'totalPendaftaran',
            'totalKategori',
            'totalUser'
        ));
        
    }
    public function userDashboard(Request $request)
    {
        $search = $request->input('search'); // Ambil parameter pencarian

        // Query mahasiswa dengan fitur pencarian
        $mahasiswa = Mahasiswa::query()
            ->when($search, function ($query, $search) {
                $query->where('nama_mahasiswa', 'like', "%$search%")
                      ->orWhere('nim', 'like', "%$search%");
            })
            ->paginate(10); // Pagination 10 data per halaman

        // Kirim data ke view
        return view('layouts.user', compact('mahasiswa'));
    }
}
