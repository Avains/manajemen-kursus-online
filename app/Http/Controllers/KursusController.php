<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use App\Models\KategoriKursus;
use Illuminate\Http\Request;
use App\Models\Instruktur;
// use Illuminate\Support\Facades\DB;

class KursusController extends Controller
{
// KursusController.php
public function index(Request $request)
{
    $search = $request->input('search');
    $sortField = $request->input('sort', 'nama_kursus'); // Default sort by 'nama_kursus'
    $sortDirection = $request->input('direction', 'asc'); // Default sort direction

    $kursus = Kursus::with('instruktur')
        ->when($search, function ($query) use ($search) {
            return $query->where('nama_kursus', 'like', "%{$search}%")
                         ->orWhere('deskripsi', 'like', "%{$search}%");
        })
        ->orderBy($sortField, $sortDirection)
        ->paginate(10);

    return view('kursus.index', compact('kursus', 'search', 'sortField', 'sortDirection'));
}

    public function create()
    {
        $kategoriKursus = KategoriKursus::all();
        $instrukturs = Instruktur::all(); // Ambil semua instruktur
        return view('kursus.create', compact('kategoriKursus', 'instrukturs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kursus' => 'required',
            'deskripsi' => 'required',
            'durasi' => 'required|integer',
            'kategori_id' => 'required|exists:kategori_kursus,id',
            'instruktur_id' => 'required|exists:instruktur,id',
        ]);

        Kursus::create($request->all());
        return redirect()->route('kursus.index')->with('success', 'Kursus berhasil ditambahkan.');
    }

    public function edit(Kursus $kursus)
    {
        $kategoriKursus = KategoriKursus::all(); // Ambil semua kategori kursus
        $instruktur = Instruktur::all(); // Ambil semua instruktur
        return view('kursus.edit', compact('kursus', 'kategoriKursus', 'instruktur'));
    }
    

    public function update(Request $request, Kursus $kursus)
    {
        $request->validate([
        'nama_kursus' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'durasi' => 'required|integer',
        'kategori_id' => 'required|exists:kategori_kursus,id',
        'instruktur_id' => 'required|exists:instruktur,id',
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