<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Angkringan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container py-5 text-center">
        <h1 class="text-success">Selamat Datang di Angkringan 😋</h1>
        <p class="text-muted">Kamu berhasil login sebagai <strong>Customer</strong></p>
        <a href="/logout" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="btn btn-danger mt-3">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</body>
</html>
