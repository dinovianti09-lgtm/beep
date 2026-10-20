<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Sistem Akademik Mini</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Poppins', sans-serif;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float-delayed {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(5deg); }
        }
        .animate-float-delayed {
            animation: float-delayed 7s ease-in-out infinite;
            animation-delay: 1s;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 overflow-y-auto">

    <!-- Background Decorative Elements -->
    <div class="fixed top-10 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-float pointer-events-none"></div>
    <div class="fixed bottom-10 right-10 w-96 h-96 bg-pink-400/20 rounded-full blur-3xl animate-float-delayed pointer-events-none"></div>
    <div class="fixed top-1/2 left-1/2 w-64 h-64 bg-indigo-400/10 rounded-full blur-3xl animate-float pointer-events-none"></div>

    <!-- Main Card -->
    <div class="w-full max-w-md bg-white/95 backdrop-blur-xl rounded-3xl p-8 shadow-2xl shadow-black/20 relative z-10 max-h-[95vh] overflow-y-auto">
        
        <!-- Logo Section -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-3xl mb-4 shadow-xl shadow-indigo-500/30 animate-float hover:scale-110 transition-transform duration-300 p-1">
                <img src="{{ asset('images/Logo sistem akademik mini.jpeg') }}" 
                     alt="Logo Sistem Akademik" 
                     class="w-full h-full object-contain rounded-2xl bg-white p-2">
            </div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent mb-2">
                Buat Akun Baru
            </h1>
            <p class="text-sm text-slate-600 font-medium">Lengkapi data diri untuk mengakses sistem</p>
        </div>

        <!-- Pesan Error -->
        @if($errors->any())
            <div class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-r-xl mb-6 text-sm shadow-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Register -->
        <form action="{{ route('register.process') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Nama Lengkap -->
            <div class="group">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" required maxlength="100"
                       class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50/50 text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 focus:bg-white focus:outline-none transition-all duration-300 hover:border-slate-300"
                       placeholder="Masukkan nama lengkap">
            </div>

            <!-- NIS / NIP -->
            <div class="group">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">NIS / NIP <span class="text-slate-400 font-normal text-xs">(Opsional)</span></label>
                <input type="text" name="nis" maxlength="20"
                       class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50/50 text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 focus:bg-white focus:outline-none transition-all duration-300 hover:border-slate-300"
                       placeholder="Contoh: 242510441">
            </div>

            <!-- Username -->
            <div class="group">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Username</label>
                <input type="text" name="username" required maxlength="50"
                       class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50/50 text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 focus:bg-white focus:outline-none transition-all duration-300 hover:border-slate-300"
                       placeholder="Buat username unik">
            </div>

            <!-- Password -->
            <div class="group">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Password</label>
                <input type="password" name="password" required minlength="8"
                       class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50/50 text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 focus:bg-white focus:outline-none transition-all duration-300 hover:border-slate-300"
                       placeholder="Minimal 8 karakter">
            </div>

            <!-- Konfirmasi Password -->
            <div class="group">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required minlength="8"
                       class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50/50 text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 focus:bg-white focus:outline-none transition-all duration-300 hover:border-slate-300"
                       placeholder="Ulangi password">
            </div>

            <!-- Role -->
            <div class="group">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Daftar Sebagai</label>
                <div class="relative">
                    <select name="role" required
                            class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50/50 text-slate-800 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 focus:bg-white focus:outline-none transition-all duration-300 appearance-none cursor-pointer hover:border-slate-300">
                        <option value="siswa">Siswa</option>
                        <option value="guru">Guru</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Tombol Daftar -->
            <button type="submit" 
                    class="w-full bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 text-white font-bold py-3.5 rounded-xl shadow-xl shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-all duration-300 transform hover:-translate-y-1.5 active:translate-y-0 mt-6 flex items-center justify-center gap-2 group">
                <span>Daftar Sekarang</span>
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </button>
        </form>

        <!-- Link Login -->
        <p class="text-center text-sm text-slate-600 mt-6 font-medium">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:text-purple-600 hover:underline decoration-2 underline-offset-4 transition-all duration-300">
                Masuk disini
            </a>
        </p>
    </div>

</body>
</html>