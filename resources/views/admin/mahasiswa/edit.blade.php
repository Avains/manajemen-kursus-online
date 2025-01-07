@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Mahasiswa</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_mahasiswa" class="form-label">Nama</label>
            <input type="text" name="nama_mahasiswa" class="form-control" id="nama_mahasiswa" value="{{ old('nama_mahasiswa', $mahasiswa->nama_mahasiswa) }}" required>
        </div>

        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control" id="nim" value="{{ old('nim', $mahasiswa->nim) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $mahasiswa->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="nama_universitas" class="form-label">Nama Universitas</label>
            <input type="text" name="nama_universitas" class="form-control" id="nama_universitas" 
                value="{{ old('nama_universitas', $mahasiswa->nama_universitas) }}" required autocomplete="off">
            <div id="universitas-list" class="dropdown-menu show" style="position: absolute; display: none; z-index: 1000;">
            </div>
        </div>

        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="text" name="telepon" class="form-control" id="telepon" value="{{ old('telepon', $mahasiswa->telepon) }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" id="alamat" rows="3" required>{{ old('alamat', $mahasiswa->alamat) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="foto_profil" class="form-label">Foto Profil</label>
            <input type="file" name="foto_profil" class="form-control" id="foto_profil">
            @if ($mahasiswa->foto_profil)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $mahasiswa->foto_profil) }}" alt="Foto Profil" width="100">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
