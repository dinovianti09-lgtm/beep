<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Rapor Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-md text-center">
        <h1 class="text-2xl font-bold text-slate-800 mb-2">Selamat Datang di Dashboard!</h1>
        <p class="text-slate-600 mb-6">Login Berhasil. Anda masuk sebagai akun <strong>{{ auth()->user()->role ?? 'User' }}</strong>.</p>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 font-semibold">
                Logout
            </button>
        </form>
    </div>
</body>
</html>