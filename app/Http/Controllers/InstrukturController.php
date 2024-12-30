<?php

// app/Http/Controllers/InstrukturController.php
namespace App\Http\Controllers;

use App\Models\Instruktur;
use Illuminate\Http\Request;

class InstrukturController extends Controller
{
    public function index()
    {
        $instruktur = Instruktur::all();
        return view('instruktur.index', compact('instruktur'));
    }

    public function create()
    {
        return view('instruktur.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_instruktur' => 'required',
            'email' => 'required|email|unique:instruktur,email',
            'telepon' => 'required',
            'alamat' => 'required',
        ]);

        Instruktur::create($request->all());
        return redirect()->route('instruktur.index')->with('success', 'Instruktur berhasil ditambahkan.');
    }

    public function edit(Instruktur $instruktur)
    {
        return view('instruktur.edit', compact('instruktur'));
    }

    public function update(Request $request, Instruktur $instruktur)
    {
        $request->validate([
            'nama_instruktur' => 'required',
            'email' => 'required|email|unique:instruktur,email,' . $instruktur->id,
            'telepon' => 'required',
            'alamat' => 'required',
        ]);

        $instruktur->update($request->all());
        return redirect()->route('instruktur.index')->with('success', 'Instruktur berhasil diperbarui.');
    }

    public function destroy(Instruktur $instruktur)
    {
        $instruktur->delete();
        return redirect()->route('instruktur.index')->with('success', 'Instruktur berhasil dihapus.');
    }
}