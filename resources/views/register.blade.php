<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Sistem Akademik Mini</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">

    <!-- Card Putih Tengah Sesuai Wireframe -->
    <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-8 border border-slate-200">
        
        <!-- Header & Logo Kamu -->
        <div class="text-center mb-6">
            <div class="flex justify-center mb-3">
                <img src="{{ asset('images/Logo%20sistem%20akademik%20mini.jpeg') }}" alt="Logo Sistem Akademik" class="w-16 h-16 object-contain rounded-xl shadow-sm border p-1">
            </div>
            <h2 class="text-xl font-bold text-slate-800">Daftar Akun</h2>
            <p class="text-xs text-slate-500 mt-1">Silakan isi data diri untuk membuat akun</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 p-3 rounded-xl mb-4 text-xs">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-3">
            @csrf
            
            <!-- Nama Lengkap -->
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 text-xs">
                    <i class="fa-solid fa-user"></i>
                </span>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required
                       class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
            </div>

            <!-- Email -->
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 text-xs">
                    <i class="fa-solid fa-envelope"></i>
                </span>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required
                       class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
            </div>

            <!-- Password -->
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 text-xs">
                    <i class="fa-solid fa-lock"></i>
                </span>
                <input type="password" name="password" placeholder="Password" required
                       class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
            </div>

            <!-- Konfirmasi Password -->
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 text-xs">
                    <i class="fa-solid fa-key"></i>
                </span>
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required
                       class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
            </div>

            <!-- Tombol Daftar -->
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2.5 rounded-xl text-xs shadow-md transition duration-200 mt-2">
                Daftar
            </button>
        </form>

        <p class="text-xs text-center text-slate-500 mt-6">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-500 font-semibold hover:underline">Login</a>
        </p>
    </div>

</body>
</html>