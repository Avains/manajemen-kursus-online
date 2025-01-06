@extends('layouts.appuser')

@section('content')
<div class="container"> 
    <h1>Daftar Mahasiswa</h1>
    <!-- Form Pencarian -->
    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari mahasiswa..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </form>

    <!-- Tabel Daftar Mahasiswa -->
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Universitas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $mhs)
            <tr>
                <td>{{ $mahasiswa->firstItem() + $loop->index }}</td>
                <td>{{ $mhs->nama_mahasiswa }}</td>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->nama_universitas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div>
        {{ $mahasiswa->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
@endsection
