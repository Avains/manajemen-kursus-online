<?php

namespace App\Http\Controllers;

use App\Models\KategoriKursus;
use Illuminate\Http\Request;
KategoriKursus::whereNotIn('id', [512, 513, 514, 515, 516, 517])->delete();

class KategoriKursusController extends Controller
{
    public function index()
    {
        $kategoriKursus = KategoriKursus::all();
        return view('admin.kategori.index', compact('kategoriKursus'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'required',
        ]);

        KategoriKursus::create($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori kursus berhasil ditambahkan.');
    }

    public function edit(KategoriKursus $kategoriKursus)
    {
        return view('kategori.edit', compact('kategoriKursus'));
    }

    public function update(Request $request, KategoriKursus $kategoriKursus)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'required',
        ]);

        $kategoriKursus->update($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori kursus berhasil diperbarui.');
    }

    public function destroy($id)
{
    $kategori = KategoriKursus::find($id);

    if ($kategori) {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }

    return redirect()->route('kategori.index')->with('error', 'Kategori tidak ditemukan.');
}

}