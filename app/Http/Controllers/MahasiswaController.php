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
        'nama_mahasiswa' => 'required|string|max:255',
        'nim' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'telepon' => 'required|string|max:15',
        'alamat' => 'required|string|max:500',
        'nama_universitas' => 'required|string|max:255',
        'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->all();

    // Simpan file ke folder `storage/app/public/mahasiswa`
    if ($request->hasFile('foto_profil')) {
        $path = $request->file('foto_profil')->store('mahasiswa', 'public');
        $data['foto_profil'] = $path; // Simpan path file ke database
    }

    Mahasiswa::create($data);

    return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
}

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama_mahasiswa' => 'required|string|max:255',
        'nim' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'nama_universitas' => 'required|string|max:255',
        'telepon' => 'required|string|max:15',
        'alamat' => 'required|string|max:500',
        'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $mahasiswa = Mahasiswa::findOrFail($id);
    $mahasiswa->fill($request->except('foto_profil'));

    if ($request->hasFile('foto_profil')) {
        $path = $request->file('foto_profil')->store('mahasiswa', 'public');
        $mahasiswa->foto_profil = $path;
    }

    $mahasiswa->save();

    return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
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