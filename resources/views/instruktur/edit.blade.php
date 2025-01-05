@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Instruktur</h1>
    <form action="{{ route('instruktur.update', $instruktur->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_instruktur">Nama Instruktur</label>
            <input type="text" class="form-control @error('nama_instruktur') is-invalid @enderror" id="nama_instruktur" name="nama_instruktur" value="{{ old('nama_instruktur', $instruktur->nama_instruktur) }}" required>
            @error('nama_instruktur')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
             <label for="npm">NPM</label>
            <input type="number" class="form-control @error('npm') is-invalid @enderror" id="npm" name="npm" value="{{ old('npm', $instruktur->npm) }}" required>
            @error('npm')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $instruktur->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="telepon">Telepon</label>
            <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" value="{{ old('telepon', $instruktur->telepon) }}" required>
            @error('telepon')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $instruktur->alamat) }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('instruktur.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
