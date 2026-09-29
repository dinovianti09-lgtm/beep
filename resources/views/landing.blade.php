<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Akademik Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-blue-500 selection:text-white">

    <!-- Navbar Header -->
    <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="bg-gradient-to-tr from-blue-600 to-indigo-600 text-white p-2.5 rounded-xl font-bold text-xl shadow-md shadow-blue-500/20">
                    SA
                </div>
                <div>
                    <span class="font-extrabold text-xl text-slate-900 tracking-tight block leading-none">SiAkad Mini</span>
                    <span class="text-[10px] text-slate-500 font-medium tracking-wide uppercase">Sistem Akademik Digital</span>
                </div>
            </div>
            
            <nav class="hidden md:flex items-center space-x-8 text-sm font-medium text-slate-600">
                <a href="#tentang" class="hover:text-blue-600 transition">Tentang</a>
                <a href="#fitur" class="hover:text-blue-600 transition">Fitur Utama</a>
                <a href="#cara-kerja" class="hover:text-blue-600 transition">Alur Kerja</a>
                <a href="#kontak" class="hover:text-blue-600 transition">Kontak</a>
            </nav>

            <div class="flex items-center space-x-3">
                <a href="/login" class="px-5 py-2.5 text-sm font-semibold text-slate-700 hover:text-blue-600 hover:bg-slate-100 rounded-xl transition">
                    Masuk
                </a>
                <a href="/register" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-md shadow-blue-600/20 transition">
                    Daftar Akun
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="tentang" class="max-w-7xl mx-auto px-6 pt-16 pb-20 text-center md:pt-24 md:pb-28">
        <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-700 text-xs font-semibold px-4 py-2 rounded-full mb-8 shadow-sm">
            <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
            Sistem Informasi Pengolahan Nilai & Rapor Digital
        </div>
        
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-slate-900 leading-tight tracking-tight mb-6">
            Kelola Data Akademik Sekolah <br class="hidden md:inline">
            <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Lebih Cepat, Tepat, & Terstruktur</span>
        </h1>
        
        <p class="text-slate-600 text-base md:text-lg max-w-2xl mx-auto mb-10 leading-relaxed">
            Platform serbaguna untuk memudahkan Guru, Wali Kelas, dan Siswa dalam mengelola data master, rekapitulasi nilai harian, hingga cetak rapor digital secara efisien.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16">
            <a href="/login" class="w-full sm:w-auto px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-2xl shadow-lg shadow-blue-600/25 transition text-sm">
                Masuk ke Sistem
            </a>
            <a href="#fitur" class="w-full sm:w-auto px-8 py-4 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-semibold rounded-2xl transition text-sm shadow-sm">
                Pelajari Fitur
            </a>
        </div>

        <!-- Banner Ringkasan Statistik -->
        <div class="max-w-4xl mx-auto bg-white border border-slate-200/80 rounded-3xl p-6 md:p-8 shadow-xl shadow-slate-200/50 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div>
                <div class="text-3xl font-extrabold text-blue-600">500+</div>
                <div class="text-xs font-medium text-slate-500 mt-1">Siswa Terdaftar</div>
            </div>
            <div class="border-l border-slate-100">
                <div class="text-3xl font-extrabold text-indigo-600">30+</div>
                <div class="text-xs font-medium text-slate-500 mt-1">Guru & Staf Pengajar</div>
            </div>
            <div class="border-l border-slate-100">
                <div class="text-3xl font-extrabold text-blue-600">100%</div>
                <div class="text-xs font-medium text-slate-500 mt-1">Kalkulasi Akurat</div>
            </div>
            <div class="border-l border-slate-100">
                <div class="text-3xl font-extrabold text-indigo-600">Digital</div>
                <div class="text-xs font-medium text-slate-500 mt-1">Cetak Rapor Ready</div>
            </div>
        </div>
    </section>

    <!-- Fitur Utama -->
    <section id="fitur" class="bg-white py-20 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-xl mx-auto mb-16">
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Fitur Unggulan </h2>
                <p class="text-slate-600 text-sm mt-3 leading-relaxed">Dirancang khusus untuk mempermudah pekerjaan administrasi nilai dan pengelolaan data akademik sekolah.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="p-8 bg-slate-50 rounded-3xl border border-slate-200/80 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6 text-2xl">
                        👥
                    </div>
                    <h3 class="font-bold text-xl text-slate-900 mb-3">Manajemen Data Master</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Pengelolaan data pokok secara terpusat mencakup Data Siswa, Data Guru, Kelas, hingga Mata Pelajaran secara fleksibel.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="p-8 bg-slate-50 rounded-3xl border border-slate-200/80 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 text-2xl">
                        ✏️
                    </div>
                    <h3 class="font-bold text-xl text-slate-900 mb-3">Input Nilai & Otomatisasi</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Pencatatan nilai Tugas, UTS, dan UAS oleh Guru. Rumus kalkulasi nilai akhir semester langsung terhitung secara otomatis.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="p-8 bg-slate-50 rounded-3xl border border-slate-200/80 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mb-6 text-2xl">
                        🖨️
                    </div>
                    <h3 class="font-bold text-xl text-slate-900 mb-3">Cetak Rapor Digital</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Rekapitulasi hasil belajar dapat dilihat dan dicetak langsung oleh Wali Kelas maupun Siswa dalam bentuk lembar Rapor.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Kerja -->
    <section id="cara-kerja" class="py-20 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-xl mx-auto mb-16">
                <span class="text-blue-400 font-semibold text-xs uppercase tracking-widest">Alur Kerja Sistem</span>
                <h2 class="text-3xl font-bold mt-2">Langkah Mudah Penggunaan</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="bg-slate-800/60 p-6 rounded-2xl border border-slate-700/60">
                    <div class="text-3xl font-extrabold text-blue-400 mb-3">01</div>
                    <h4 class="font-bold text-lg mb-2">Autentikasi Akun</h4>
                    <p class="text-slate-400 text-xs leading-relaxed">Pengguna melakukan login sesuai hak akses (Admin, Guru, atau Siswa).</p>
                </div>
                <div class="bg-slate-800/60 p-6 rounded-2xl border border-slate-700/60">
                    <div class="text-3xl font-extrabold text-blue-400 mb-3">02</div>
                    <h4 class="font-bold text-lg mb-2">Kelola Data Master</h4>
                    <p class="text-slate-400 text-xs leading-relaxed">Admin menginputkan data awal seperti kelas, siswa, guru, dan mata pelajaran.</p>
                </div>
                <div class="bg-slate-800/60 p-6 rounded-2xl border border-slate-700/60">
                    <div class="text-3xl font-extrabold text-blue-400 mb-3">03</div>
                    <h4 class="font-bold text-lg mb-2">Pengisian Nilai</h4>
                    <p class="text-slate-400 text-xs leading-relaxed">Guru mata pelajaran memasukkan nilai harian, ujian tengah semester, dan ujian akhir.</p>
                </div>
                <div class="bg-slate-800/60 p-6 rounded-2xl border border-slate-700/60">
                    <div class="text-3xl font-extrabold text-blue-400 mb-3">04</div>
                    <h4 class="font-bold text-lg mb-2">Cetak Rapor</h4>
                    <p class="text-slate-400 text-xs leading-relaxed">Nilai dikalkulasi otomatis dan rapor siap dicetak oleh pihak sekolah.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer & Informasi Kontak -->
    <footer id="kontak" class="bg-slate-950 text-slate-400 py-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div>
                <h3 class="text-white font-bold text-lg mb-3">SiAkad Mini</h3>
                <p class="text-xs text-slate-400 leading-relaxed">Sistem Informasi Akademik digital berbasis web untuk efisiensi dan transparansi pengolahan data nilai siswa.</p>
            </div>
            <div>
                <h4 class="text-white font-semibold text-sm mb-3">Kontak Sekolah</h4>
                <p class="text-xs mb-1">📍 Jl. Raya Ciwidey, Kabupaten Bandung</p>
                <p class="text-xs mb-1">📧 info@sekolah.sch.id</p>
                <p class="text-xs">📞 (022) 12345678</p>
            </div>
            <div>
                <h4 class="text-white font-semibold text-sm mb-3">Navigasi Cepat</h4>
                <div class="flex flex-col space-y-2 text-xs">
                    <a href="/login" class="hover:text-white transition">Halaman Login</a>
                    <a href="/register" class="hover:text-white transition">Pendaftaran Akun</a>
                    <a href="#fitur" class="hover:text-white transition">Fitur Utama</a>
                </div>
            </div>
        </div>
        
    </footer>

</body>
</html>