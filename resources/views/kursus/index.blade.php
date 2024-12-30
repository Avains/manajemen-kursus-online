{{-- resources/views/kursus/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Kursus</h1>
    <a href="{{ route('kursus.create') }}" class="btn btn-primary">Tambah Kursus</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Kursus</th>
                <th>Deskripsi</th>
                <th>Instruktur</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kursus as $kurs)
            <tr>
                <td>{{ $kurs->nama_kursus }}</td>
                <td>{{ $kurs->deskripsi }}</td>
                <td>{{ $kurs->instruktur ? $kurs->instruktur->nama_instruktur : 'Tidak ada instruktur' }}</td>
                <td>
                    <a href="{{ route('kursus.edit', $kurs->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('kursus.destroy', $kurs->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection