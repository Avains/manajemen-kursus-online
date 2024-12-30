{{-- resources/views/pendaftaran/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pendaftaran</h1>
    <a href="{{ route('pendaftaran.create') }}" class="btn btn-primary">Tambah Pendaftaran</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Mahasiswa</th>
                <th>Kursus</th>
                <th>Tanggal Pendaftaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendaftaran as $pend)
            <tr>
                <td>{{ $pend->mahasiswa->nama_mahasiswa }}</td>
                <td>{{ $pend->kursus->nama_kursus }}</td>
                <td>{{ $pend->created_at->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('pendaftaran.edit', $pend->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('pendaftaran.destroy', $pend->id) }}" method="POST" style="display:inline;">
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