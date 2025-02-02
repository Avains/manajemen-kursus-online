<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('admin.mahasiswa.index', compact('mahasiswa', 'search'));
    }

//     public function createForUser()
// {
//     // \Log::info('createForUser method called');

//     $user = Auth::user();

//     // Cek apakah email sudah terdaftar di tabel mahasiswa
//     if (Mahasiswa::where('email', $user->email)->exists()) {
//         return redirect()->route('user.dashboard')->with('error', 'Email Anda sudah terdaftar sebagai mahasiswa.');
//     }

//     // Pastikan view yang dipanggil adalah milik user
//     return view('user.mahasiswa.create', ['user' => $user]);
// }


//     public function storeByUser(Request $request)
//     {
//         $user = Auth::user();
        
//         $request->validate([
//             'nama_mahasiswa' => 'required|string|max:255',
//             'nim' => 'required|string|max:20|unique:mahasiswa,nim',
//             'telepon' => 'required|string|max:15',
//             'alamat' => 'required|string|max:500',
//             'nama_universitas' => 'required|string|max:255',
//             'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//         ]);

//         $data = $request->all();
//         $data['email'] = $user->email; // Gunakan email pengguna dari tabel users

//         if ($request->hasFile('foto_profil')) {
//             $path = $request->file('foto_profil')->store('mahasiswa', 'public');
//             $data['foto_profil'] = $path;
//         }

//         Mahasiswa::create($data);

//         return redirect()->route('user.dashboard')->with('success', 'Mahasiswa berhasil didaftarkan.');
//     }

    public function create()
    {
        return view('admin.mahasiswa.create');
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

        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('mahasiswa', 'public');
            $data['foto_profil'] = $path;
        }

        Mahasiswa::create($data);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
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

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $query = $request->query('query');
        $universitas = Mahasiswa::select('nama_universitas')
            ->distinct()
            ->where('nama_universitas', 'like', '%' . $query . '%')
            ->take(10)
            ->get();
    
        return response()->json($universitas);
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return response()->json($mahasiswa);
    }
}
