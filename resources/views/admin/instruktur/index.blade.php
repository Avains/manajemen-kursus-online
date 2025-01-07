@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Instruktur</h1>
    <a href="{{ route('admin.instruktur.create') }}" class="btn btn-primary mb-3">Tambah Instruktur</a>
    
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
                <th>NPM</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($instruktur as $instr)
                <tr>
                    <td>{{ $instruktur->firstItem() + $loop->index }}</td>
                    <td>{{ $instr->nama_instruktur }}</td>
                    <td>{{ $instr->npm }}</td>
                    <td>{{ $instr->email }}</td>
                    <td>
                        <a href="{{ route('admin.instruktur.edit', $instr->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.instruktur.destroy', $instr->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus instruktur ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $instruktur->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
@endsection
