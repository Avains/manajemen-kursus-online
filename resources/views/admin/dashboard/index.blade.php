@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Dashboard</h1>
    <p class="lead">Selamat datang, {{ Auth::user()->name }}!</p>
    <p>Anda berhasil login ke aplikasi Manajemen Kursus Online.</p>

    <div class="row">
        <div class="col-md-4 mb-4">
            <a href="{{ route('admin.mahasiswa.index') }}" class="card text-center text-decoration-none">
                <div class="card-header">
                    Data Mahasiswa
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalMahasiswa }}</h5>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="{{ route('admin.instruktur.index') }}" class="card text-center text-decoration-none">
                <div class="card-header">
                    Data Instruktur
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalInstruktur }}</h5>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="{{ route('admin.kursus.index') }}" class="card text-center text-decoration-none">
                <div class="card-header">
                    Data Kursus
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalKursus }}</h5>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="{{ route('admin.pendaftaran.index') }}" class="card text-center text-decoration-none">
                <div class="card-header">
                    Data Pendaftaran
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalPendaftaran }}</h5>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="{{ route('admin.kategori.index') }}" class="card text-center text-decoration-none">
                <div class="card-header">
                    Kategori
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalKategori }}</h5>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="{{ route('users.index') }}" class="card text-center text-decoration-none">
                <div class="card-header">
                    Data User
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalUser  }}</h5>
                </div>
            </a>
        </div>
    </div>

    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</div>
@endsection