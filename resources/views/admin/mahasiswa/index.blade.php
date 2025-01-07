@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Mahasiswa</h1>
    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary mb-3">Tambah Mahasiswa</a>

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
            <input type="text" name="search" class="form-control" placeholder="Cari mahasiswa..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
                <th>Universitas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $mhs)
            <tr>
                <td>{{ $mahasiswa->firstItem() + $loop->index }}</td>
                <td>
                    <button type="button" class="btn btn-link" data-id="{{ $mhs->id }}" onclick="showDetail(this)">
                        {{ $mhs->nama_mahasiswa }}
                    </button>
                </td>

                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->email }}</td>
                <td>{{ $mhs->nama_universitas }}</td>
                <td>
                    <a href="{{ route('admin.mahasiswa.edit', $mhs->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.mahasiswa.destroy', $mhs->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama:</strong> <span id="detailNama"></span></p>
                <p><strong>NIM:</strong> <span id="detailNim"></span></p>
                <p><strong>Email:</strong> <span id="detailEmail"></span></p>
                <p><strong>Telepon:</strong> <span id="detailTelepon"></span></p>
                <p><strong>Alamat:</strong> <span id="detailAlamat"></span></p>
                <p><strong>Universitas:</strong> <span id="detailUniversitas"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

    <div>
        {{ $mahasiswa->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
<script>
    function showDetail(button) {
        const id = button.getAttribute('data-id');

        // Fetch data dari server
        fetch(`/admin/mahasiswa/${id}`)
            .then(response => response.json())
            .then(data => {
                // Isi data ke modal
                document.getElementById('detailNama').innerText = data.nama_mahasiswa;
                document.getElementById('detailNim').innerText = data.nim;
                document.getElementById('detailEmail').innerText = data.email;
                document.getElementById('detailTelepon').innerText = data.telepon;
                document.getElementById('detailAlamat').innerText = data.alamat;
                document.getElementById('detailUniversitas').innerText = data.nama_universitas;

                // Tampilkan modal
                new bootstrap.Modal(document.getElementById('detailModal')).show();
            })
            .catch(error => {
                console.error('Error fetching detail:', error);
                alert('Gagal mengambil detail mahasiswa.');
            });
    }
</script>

@endsection
