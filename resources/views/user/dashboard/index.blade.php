@extends('layouts.app')

@section('title', 'Dashboard Operator')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Dashboard Operator</h1>
    <p>Anda login sebagai <strong>{{ auth()->user()->name }}</strong>.</p>

    <div class="col-md-4 mb-4">
            <a href="{{ route('user.pendaftaran.index') }}" class="card text-center text-decoration-none">
                <div class="card-header">
                    Data Pendaftaran
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalPendaftaran }}</h5>
                </div>
            </a>
        </div>
</div>
@endsection
