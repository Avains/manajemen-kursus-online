@if (Auth::check())
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/dashboard') }}">Kursus Online</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                @if (auth()->check() && auth()->user()->role === 'admin')

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.mahasiswa.index') }}">Data Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.instruktur.index') }}">Data Instruktur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.kursus.index') }}">Data Kursus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.pendaftaran.index') }}">Data Pendaftaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.kategori.index') }}">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">Data User</a>
                    </li>
                @endif
            </ul>
        </div>

    </div>
</nav>
@endif