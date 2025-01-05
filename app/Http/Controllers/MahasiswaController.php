<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{

public function index(Request $request)
{
    $search = $request->input('search');
    $mahasiswa = Mahasiswa::when($search, function ($query) use ($search) {
        return $query->where('nama_mahasiswa', 'like', "%{$search}%")
                     ->orWhere('email', 'like', "%{$search}%")
                     ->orWhere('telepon', 'like', "%{$search}%")
                     ->orWhere('alamat', 'like', "%{$search}%")
                     ->orWhere('nim', 'like', "%{$search}%")
                     ->orWhere('nama_universitas', 'like', "%{$search}%");
    })->paginate(10);

    return view('mahasiswa.index', compact('mahasiswa', 'search'));
}

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mahasiswa' => 'required',
            'nim' => 'required|string|max:255',
            'email' => 'required|email|unique:mahasiswa,email',
            'nama_universitas' => 'required|string|max:255',
            'telepon' => 'required',
            'alamat' => 'required',
        ]);

        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'email' => 'required|email',
            'nama_universitas' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        $mahasiswa->update($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }
    public function search(Request $request)
    {
        $query = $request->query('query');
        $universitas = Mahasiswa::select('nama_universitas')
            ->distinct()
            ->where('nama_universitas', 'like', '%' . $query . '%')
            ->take(10) // Batasi jumlah hasil
            ->get();
    
        return response()->json($universitas);
    }
    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return response()->json($mahasiswa);
    }
    
}