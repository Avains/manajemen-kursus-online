@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Mahasiswa</h1>
    <form action="{{ route('mahasiswa.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_mahasiswa">Nama Mahasiswa</label>
            <input type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror" id="nama_mahasiswa" name="nama_mahasiswa" value="{{ old('nama_mahasiswa') }}" required>
            @error('nama_mahasiswa')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="telepon">Telepon</label>
            <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" value="{{ old('telepon') }}" required>
            @error('telepon')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nama_universitas">Nama Universitas</label>
            <input type="text" class="form-control @error('nama_universitas') is-invalid @enderror" id="nama_universitas" name="nama_universitas" value="{{ old('nama_universitas') }}" required autocomplete="off">
            <div id="universitas-list" class="dropdown-menu show" style="position: absolute; display: none; z-index: 1000;">
            </div>
            @error('nama_universitas')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('#nama_universitas').on('input', function () {
        let query = $(this).val();
        if (query.length > 2) { // Mulai pencarian setelah 2 karakter
            $.ajax({
                url: "{{ route('universitas.search') }}", // Rute untuk mencari universitas
                type: "GET",
                data: { query: query },
                success: function (data) {
                    let list = $('#universitas-list');
                    list.empty();
                    if (data.length > 0) {
                        data.forEach(function (universitas) {
                            list.append(`<div class="dropdown-item" onclick="selectUniversitas('${universitas.nama_universitas}')">${universitas.nama_universitas}</div>`);
                        });
                        list.show();
                    } else {
                        list.hide();
                    }
                },
                error: function () {
                    console.error("Terjadi kesalahan saat memuat data universitas.");
                },
            });
        } else {
            $('#universitas-list').hide();
        }
    });
});

function selectUniversitas(name) {
    $('#nama_universitas').val(name);
    $('#universitas-list').hide();
}
</script>

@endsection
