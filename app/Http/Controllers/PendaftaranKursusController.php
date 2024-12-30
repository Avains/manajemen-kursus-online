<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranKursus;
use App\Models\Mahasiswa;
use App\Models\Kursus;
use Illuminate\Http\Request;

class PendaftaranKursusController extends Controller
{
    public function index()
    {
        $pendaftaran = PendaftaranKursus::with(['mahasiswa', 'kursus'])->get();
        return view('pendaftaran.index', compact('pendaftaran'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $kursus = Kursus::all();
        return view('pendaftaran.create', compact('mahasiswa', 'kursus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'kursus_id' => 'required|exists:kursus,id',
        ]);

        PendaftaranKursus::create($request->all());
        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran kursus berhasil ditambahkan.');
    }

    public function edit(PendaftaranKursus $pendaftaran)
    {
        $mahasiswa = Mahasiswa::all();
        $kursus = Kursus::all();
        return view('pendaftaran.edit', compact('pendaftaran', 'mahasiswa', 'kursus'));
    }

    public function update(Request $request, PendaftaranKursus $pendaftaran)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'kursus_id' => 'required|exists:kursus,id',
        ]);

        $pendaftaran->update($request->all());
        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran kursus berhasil diperbarui.');
    }

    public function destroy(PendaftaranKursus $pendaftaran)
    {
        $pendaftaran->delete();
        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran kursus berhasil di hapus.');
    }
}