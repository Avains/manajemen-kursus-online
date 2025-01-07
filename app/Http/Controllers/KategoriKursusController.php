<?php

namespace App\Http\Controllers;

use App\Models\KategoriKursus;
use Illuminate\Http\Request;

class KategoriKursusController extends Controller
{
    public function index()
    {
        $kategoriKursus = KategoriKursus::all();
        return view('admin.kategori.index', compact('kategoriKursus'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        KategoriKursus::create($request->only(['nama_kategori', 'deskripsi']));
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori kursus berhasil ditambahkan.');
    }

    public function edit(KategoriKursus $kategoriKursus)
    {
        return view('admin.kategori.edit', compact('kategoriKursus'));
    }

    public function update(Request $request, KategoriKursus $kategoriKursus)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $kategoriKursus->update($request->only(['nama_kategori', 'deskripsi']));
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori kursus berhasil diperbarui.');
    }

    public function destroy(KategoriKursus $kategoriKursus)
    {
        $kategoriKursus->delete();
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
