@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Kursus</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kursus.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_kursus">Nama Kursus</label>
            <input type="text" class="form-control" id="nama_kursus" name="nama_kursus" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="durasi">Durasi (dalam jam)</label>
            <input type="number" class="form-control" id="durasi" name="durasi" required>
        </div>

        <div class="form-group">
            <label for="kategori_id">Kategori Kursus</label>
            <select class="form-control" id="kategori_id" name="kategori_id" required>
                <option value="">Pilih Kategori</option>
                @foreach ($kategoriKursus as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="instruktur_id">Instruktur</label>
            <select class="form-control" id="instruktur_id" name="instruktur_id" required>
                <option value="">Pilih Instruktur</option>
                @foreach ($instrukturs as $instruktur)
                    <option value="{{ $instruktur->id }}">{{ $instruktur->nama_instruktur }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.kursus.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection