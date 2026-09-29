<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Akademik Mini</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
        
        <!-- Header & Logo -->
        <div class="text-center mb-6">
            <img src="{{ asset('images/Logo sistem akademik mini.jpeg') }}" alt="Logo" class="w-24 h-24 mx-auto mb-3 object-contain rounded-xl">
            <h1 class="text-2xl font-bold text-slate-800">Sistem Akademik Mini</h1>
            <p class="text-sm text-slate-500 mt-1">Silakan masuk ke akun Anda</p>
        </div>

        <!-- Pesan Error jika Login Gagal -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form Login -->
        <form action="{{ url('/login') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Username / Email</label>
                <input type="text" name="username" required placeholder="Masukkan email" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 mr-2">
                    Ingat Saya
                </label>
                <a href="#" class="text-blue-600 hover:underline">Lupa Password?</a>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition duration-200">
                Masuk Sekarang
            </button>
        </form>

        <p class="text-center text-sm text-slate-500 mt-6">
            Belum punya akun? <a href="{{ url('/register') }}" class="text-blue-600 hover:underline font-medium">Daftar disini</a>
        </p>

    </div>

</body>
</html>