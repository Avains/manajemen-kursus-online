@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pendaftaran</h1>
    <a href="{{ route('pendaftaran.create') }}" class="btn btn-primary mb-3">Tambah Pendaftaran</a>

    <!-- Form Pencarian -->
    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari pendaftaran..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Kursus</th>
                <th>Tanggal Pendaftaran</th>
                <th>Status</th> 
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendaftaran as $pend)
            <tr>
                <td>{{ $pendaftaran->firstItem() + $loop->index }}</td>
                <td>{{ $pend->mahasiswa->nama_mahasiswa }}</td>
                <td>{{ $pend->kursus->nama_kursus }}</td>
                <td>{{ $pend->created_at->format('d-m-Y') }}</td>
                <td>{{ $pend->status }}</td> 
                <td>
                    <a href="{{ route('pendaftaran.edit', $pend->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('pendaftaran.destroy', $pend->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pendaftaran ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $pendaftaran->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
@endsection