@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Kategori</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kategori.update', $kategoriKursus->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nama_kategori">Nama Kategori</label>
        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ $kategoriKursus->nama_kategori }}" required>
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $kategoriKursus->deskripsi }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Perbarui</button>
    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Kembali</a>
</form>

</div>
@endsection