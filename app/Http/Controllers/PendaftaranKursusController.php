<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranKursus;
use App\Models\Mahasiswa;
use App\Models\Kursus;
use Illuminate\Http\Request;

class PendaftaranKursusController extends Controller
{
// PendaftaranController.php
public function index(Request $request)
{
    $search = $request->input('search');
    $pendaftaran = PendaftaranKursus::with(['mahasiswa', 'kursus'])
        ->when($search, callback: function ($query) use ($search) {
            return $query->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('nama_mahasiswa', 'like', "%{$search}%");
            })->orWhereHas('kursus', function ($q) use ($search) {
                $q->where('nama_kursus', 'like', "%{$search}%");
            });
        })
        ->paginate(10);

    return view('admin.pendaftaran.index', compact('pendaftaran', 'search'));
}

    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $kursus = Kursus::all();
        return view('admin.pendaftaran.create', compact('mahasiswa', 'kursus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'kursus_id' => 'required|exists:kursus,id',
            'tanggal_daftar' => 'required|date',
            'status' => 'required|string'
        ]);

        PendaftaranKursus::create($request->all());
        return redirect()->route('admin.pendaftaran.index')->with('success', 'Pendaftaran kursus berhasil ditambahkan.');
    }

    public function edit(PendaftaranKursus $pendaftaran)
    {
        $mahasiswa = Mahasiswa::all();
        $kursus = Kursus::all();
        return view('admin.pendaftaran.edit', compact('pendaftaran', 'mahasiswa', 'kursus'));
    }

    public function update(Request $request, PendaftaranKursus $pendaftaran)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'kursus_id' => 'required|exists:kursus,id',
        ]);

        $pendaftaran->update($request->all());
        return redirect()->route('admin.pendaftaran.index')->with('success', 'Pendaftaran kursus berhasil diperbarui.');
    }

    public function destroy(PendaftaranKursus $pendaftaran)
    {
        $pendaftaran->delete();
        return redirect()->route('admin.pendaftaran.index')->with('success', 'Pendaftaran kursus berhasil di hapus.');
    }
}