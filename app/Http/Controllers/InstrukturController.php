<?php

namespace App\Http\Controllers;

use App\Models\Instruktur;
use Illuminate\Http\Request;

class InstrukturController extends Controller
{
    
public function index(Request $request)
{
    
    $search = $request->input('search');
    $instruktur = Instruktur::when($search, function ($query) use ($search) {
        return $query->where('nama_instruktur', 'like', "%{$search}%")
                     ->orWhere('npm', 'like', "%{$search}%")
                     ->orWhere('email', 'like', "%{$search}%")
                     ->orWhere('telepon', 'like', "%{$search}%")
                     ->orWhere('alamat', 'like', "%{$search}%");
    })->paginate(10);

    return view('admin.instruktur.index', compact('instruktur', 'search'));
}

    public function create()
    {
        return view('admin.instruktur.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_instruktur' => 'required',
            'email' => 'required|email|unique:instruktur,email',
            'npm' => 'required|numeric|digits:6|unique:instruktur,npm',
            'telepon' => 'required',
            'alamat' => 'required',
        ]);

        Instruktur::create($request->all());
        return redirect()->route('admin.instruktur.index')->with('success', 'Instruktur berhasil ditambahkan.');
    }

    public function edit(Instruktur $instruktur)
    {
        return view('admin.instruktur.edit', compact('instruktur'));
    }

    public function update(Request $request, Instruktur $instruktur)
    {
        $request->validate([
            'nama_instruktur' => 'required',
            'email' => 'required|email|unique:instruktur,email,' . $instruktur->id,
            'npm' => 'required|numeric|digits:6|unique:instruktur,npm,' . $instruktur->id,
            'telepon' => 'required',
            'alamat' => 'required',
        ]);

        $instruktur->update($request->all());
        return redirect()->route('admin.instruktur.index')->with('success', 'Instruktur berhasil diperbarui.');
    }

    public function destroy(Instruktur $instruktur)
    {
        $instruktur->delete();
        return redirect()->route('admin.instruktur.index')->with('success', 'Instruktur berhasil dihapus.');
    }
}