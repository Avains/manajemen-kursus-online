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
        $user = Auth::user();

        if ($user->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.dashboard.index');
    }

    public function adminDashboard()
    {
        // Data untuk admin dashboard
        $data = [
            'totalMahasiswa' => Mahasiswa::count(),
            'totalInstruktur' => Instruktur::count(),
            'totalKursus' => Kursus::count(),
            'totalPendaftaran' => PendaftaranKursus::count(),
            'totalKategori' => KategoriKursus::count(),
            'totalUser' => User::count(),
        ];

        return view('admin.dashboard.index', $data); // Path ke view admin
    }

    public function userDashboard()
    {
        $user = Auth::user();

        if ($user->role !== 'user') {
            abort(403, 'Unauthorized action.');
        }

        return view('user.dashboard.index');
    }
}