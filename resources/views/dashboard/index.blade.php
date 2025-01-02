{{-- resources/views/dashboard/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>
    <p>Anda berhasil login ke aplikasi Manajemen Kursus Online.</p>
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-primary">Kelola Mahasiswa</a>
    <a href="{{ route('instruktur.index') }}" class="btn btn-primary">Kelola Instruktur</a>
    <a href="{{ route('kursus.index') }}" class="btn btn-primary">Kelola Kursus</a>
    <a href="{{ route('pendaftaran.index') }}" class="btn btn-primary">Kelola Pendaftaran</a>
    <a href="{{ route('kategori.index') }}" class="btn btn-primary">Kategori</a>

    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</div>
@endsection