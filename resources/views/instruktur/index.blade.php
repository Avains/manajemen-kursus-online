{{-- resources/views/instruktur/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Instruktur</h1>
    <a href="{{ route('instruktur.create') }}" class="btn btn-primary">Tambah Instruktur</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($instruktur as $instr)
            <tr>
                <td>{{ $instr->nama_instruktur }}</td>
                <td>{{ $instr->email }}</td>
                <td>{{ $instr->telepon }}</td>
                <td>{{ $instr->alamat }}</td>
                <td>
                    <a href="{{ route('instruktur.edit', $instr->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('instruktur.destroy', $instr->id) }}" method="POST" style="display:inline;">
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