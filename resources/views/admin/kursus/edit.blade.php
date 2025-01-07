@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Kursus</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.kursus.update', $kursus->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="nama_kursus">Nama Kursus</label>
        <input type="text" class="form-control @error('nama_kursus') is-invalid @enderror" id="nama_kursus" name="nama_kursus" value="{{ old('nama_kursus', $kursus->nama_kursus) }}" required>
        @error('nama_kursus')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $kursus->deskripsi) }}</textarea>
        @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
    <label for="durasi">Durasi (dalam jam)</label>
    <input type="number" class="form-control @error('durasi') is-invalid @enderror" id="durasi" name="durasi" value="{{ old('durasi', $kursus->durasi) }}" required>
    @error('durasi')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="kategori_id">Kategori Kursus</label>
    <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
        <option value="">Pilih Kategori</option>
        @foreach ($kategoriKursus as $kategori)
            <option value="{{ $kategori->id }}" {{ $kategori->id == $kursus->kategori_id ? 'selected' : '' }}>
                {{ $kategori->nama_kategori }}
            </option>
        @endforeach
    </select>
    @error('kategori_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


    <div class="form-group">
        <label for="instruktur_id">Instruktur</label>
        <select class="form-control @error('instruktur_id') is-invalid @enderror" id="instruktur_id" name="instruktur_id" required>
            <option value="">Pilih Instruktur</option>
            @foreach($instruktur as $instr)
                <option value="{{ $instr->id }}" {{ $instr->id == $kursus->instruktur_id ? 'selected' : '' }}>{{ $instr->nama_instruktur }}</option>
            @endforeach
        </select>
        @error('instruktur_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('admin.kursus.index') }}" class="btn btn-secondary">Kembali</a>
</form>
</div>
@endsection