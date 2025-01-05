@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Kursus</h1>
    <a href="{{ route('kursus.create') }}" class="btn btn-primary mb-3">Tambah Kursus</a>

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
            <input type="text" name="search" class="form-control" placeholder="Cari kursus..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>No</th> <!-- Tambahkan kolom No -->
                <th>
                    <a href="{{ route('kursus.index', ['sort' => 'nama_kursus', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}">
                        Nama Kursus
                        @if($sortField === 'nama_kursus')
                            <span class="badge">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
                <th>Deskripsi</th>
                <th>
                    <a href="{{ route('kursus.index', ['sort' => 'instruktur_id', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}">
                        Instruktur
                        @if($sortField === 'instruktur_id')
                            <span class="badge">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kursus as $kurs)
            <tr>
                <td>{{ $kursus->firstItem() + $loop->index }}</td> <!-- Menampilkan nomor urut -->
                <td>{{ $kurs->nama_kursus }}</td>
                <td>{{ $kurs->deskripsi }}</td>
                <td>{{ $kurs->instruktur ? $kurs->instruktur->nama_instruktur : 'Tidak ada instruktur' }}</td>
                <td>
                    <a href="{{ route('kursus.edit', $kurs->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('kursus.destroy', $kurs->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kursus ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $kursus->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
@endsection