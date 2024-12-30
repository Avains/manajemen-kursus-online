<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use App\Models\KategoriKursus;
use Illuminate\Http\Request;

class KursusController extends Controller
{
    public function index()
    {
        $kursus = Kursus::all();
        return view('kursus.index', compact('kursus'));
    }

    public function create()
    {
        $kategoriKursus = KategoriKursus::all();
        return view('kursus.create', compact('kategoriKursus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kursus' => 'required',
            'deskripsi' => 'required',
            'durasi' => 'required|integer',
            'kategori_id' => 'required|exists:kategori_kursus,id',
            'instruktur_id' => 'required|exists:instruktur,id', // Validasi instruktur_id
        ]);

        Kursus::create($request->all());
        return redirect()->route('kursus.index')->with('success', 'Kursus berhasil ditambahkan.');
    }

    public function edit(Kursus $kursus)
    {
        $kategoriKursus = KategoriKursus::all();
        return view('kursus.edit', compact('kursus', 'kategoriKursus'));
    }

    public function update(Request $request, Kursus $kursus)
    {
        $request->validate([
            'nama_kursus' => 'required',
            'deskripsi' => 'required',
            'durasi' => 'required|integer',
            'kategori_id' => 'required|exists:kategori_kursus,id',
            'instruktur_id' => 'required|exists:instruktur,id', // Validasi instruktur_id

        ]);

        $kursus->update($request->all());
        return redirect()->route('kursus.index')->with('success', 'Kursus berhasil diperbarui.');
    }

    public function destroy(Kursus $kursus)
    {
        $kursus->delete();
        return redirect()->route('kursus.index')->with('success', 'Kursus berhasil dihapus.');
    }
}