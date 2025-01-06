<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Tambahkan CSS khusus untuk user -->
</head>
<body>
    <header>
        <h2>User Panel</h2>
        <!-- Tombol Logout -->
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; color: blue; cursor: pointer;">Logout</button>
        </form>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <p>&copy; {{ date('Y') }} User Dashboard</p>
    </footer>
</body>
</html>
