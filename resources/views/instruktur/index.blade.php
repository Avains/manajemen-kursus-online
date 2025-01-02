@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Instruktur</h1>
    <a href="{{ route('instruktur.create') }}" class="btn btn-primary mb-3">Tambah Instruktur</a>
    
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

<!-- Form Pencarian -->
<form method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Cari instruktur..." value="{{ request('search') }}">
        <button class="btn btn-outline-secondary" type="submit">Cari</button>
    </div>
</form>

<table class="table">
    <thead>
        <tr>
            <th>No</th>
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
                <td>{{ $instruktur->firstItem() + $loop->index }}</td> <!-- Menampilkan nomor urut -->
                <td>{{ $instr->nama_instruktur }}</td>
                <td>{{ $instr->email }}</td>
                <td>{{ $instr->telepon }}</td>
                <td>{{ $instr->alamat }}</td>
                <td>
                    <a href="{{ route('instruktur.edit', $instr->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('instruktur.destroy', $instr->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus instruktur ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
            Showing {{ $instruktur->firstItem() }} to {{ $instruktur->lastItem() }} of {{ $instruktur->total() }} entries
        </div>
        <div>
            {{ $instruktur->appends(request()->query())->links('vendor.pagination.bootstrap-5') }} <!-- Menggunakan Bootstrap 5 pagination -->
        </div>
    </div>
</div>
@endsection