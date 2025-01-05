@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Mahasiswa</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_mahasiswa" class="form-label">Nama</label>
            <input type="text" name="nama_mahasiswa" class="form-control" id="nama_mahasiswa" value="{{ old('nama_mahasiswa', $mahasiswa->nama_mahasiswa) }}" required>
        </div>

        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control" id="nim" value="{{ old('nim', $mahasiswa->nim) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $mahasiswa->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="nama_universitas" class="form-label">Nama Universitas</label>
            <input type="text" name="nama_universitas" class="form-control" id="nama_universitas" 
                value="{{ old('nama_universitas', $mahasiswa->nama_universitas) }}" required autocomplete="off">
            <div id="universitas-list" class="dropdown-menu show" style="position: absolute; display: none; z-index: 1000;">
            </div>
        </div>

        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="text" name="telepon" class="form-control" id="telepon" value="{{ old('telepon', $mahasiswa->telepon) }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" id="alamat" rows="3" required>{{ old('alamat', $mahasiswa->alamat) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

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
        console.log(data);  // Debug untuk melihat data yang dikirimkan
        let list = $('#universitas-list');
        list.empty();
        if (data.length > 0) {
            data.forEach(function (universitas) {
                console.log(universitas);  // Cek setiap objek universitas
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
