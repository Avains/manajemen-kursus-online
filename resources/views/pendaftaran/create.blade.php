@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pendaftaran</h1>

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

    <form action="{{ route('pendaftaran.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="mahasiswa_id">Mahasiswa</label>
            <select class="form-control @error('mahasiswa_id') is-invalid @enderror" id="mahasiswa_id" name="mahasiswa_id" required>
                <option value="">Pilih Mahasiswa</option>
                @foreach($mahasiswa as $mhs)
                    <option value="{{ $mhs->id }}">{{ $mhs->nama_mahasiswa }}</option>
                @endforeach
            </select>
            @error('mahasiswa_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="kursus_id">Kursus</label>
            <select class="form-control @error('kursus_id') is-invalid @enderror" id="kursus_id" name="kursus_id" required>
                <option value="">Pilih Kursus</option>
                @foreach($kursus as $kurs)
                    <option value="{{ $kurs->id }}">{{ $kurs->nama_kursus }}</option>
                @endforeach
            </select>
            @error('kursus_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="tanggal_daftar">Tanggal Pendaftaran</label>
            <input type="date" class="form-control @error('tanggal_daftar') is-invalid @enderror" id="tanggal_daftar" name="tanggal_daftar" value="{{ old('tanggal_daftar') }}" required>
            @error('tanggal_daftar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                <option value="">Pilih Status</option>
                <option value="aktif">Aktif</option>
                <option value="selesai">Selesai</option>
                <option value="batal">Batal</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection