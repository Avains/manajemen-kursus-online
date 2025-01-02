@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-danger">Akses Ditolak</h1>
    <p>{{ session('error') ?? 'Anda tidak memiliki izin untuk mengakses halaman ini.' }}</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Beranda</a>
</div>
@endsection
