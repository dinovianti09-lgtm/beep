<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistem Informasi Akademik Sekolah</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* =========================================
           ANIMASI ASLI
           ========================================= */

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float 4s ease-in-out 1.5s infinite;
        }

        .transition-bouncy {
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 600ms linear;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* =========================================
           SCROLLBAR
           ========================================= */

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* =========================================
           BACKGROUND ASLI
           ========================================= */

        .bg-wavy {
            background-color: #f8fafc;

            background-image:
                radial-gradient(
                    at 10% 10%,
                    rgba(59, 130, 246, 0.15) 0px,
                    transparent 40%
                ),
                radial-gradient(
                    at 90% 80%,
                    rgba(99, 102, 241, 0.15) 0px,
                    transparent 40%
                );
        }

        /* =========================================
           DARK MODE
           ========================================= */

        html.dark body {
            background-color: #020617 !important;
            color: #e2e8f0 !important;
        }

        /* Navbar */

        html.dark header {
            background-color: rgba(2, 6, 23, 0.90) !important;
            border-color: #1e293b !important;
        }

        html.dark header .text-slate-900 {
            color: #f8fafc !important;
        }

        html.dark header .text-slate-600 {
            color: #cbd5e1 !important;
        }

        html.dark header a:hover {
            background-color: rgba(59, 130, 246, 0.15) !important;
        }

        /* Hero */

        html.dark .bg-wavy {
            background-color: #020617 !important;

            background-image:
                radial-gradient(
                    at 10% 10%,
                    rgba(59, 130, 246, 0.12) 0px,
                    transparent 40%
                ),
                radial-gradient(
                    at 90% 80%,
                    rgba(99, 102, 241, 0.12) 0px,
                    transparent 40%
                ) !important;
        }

        html.dark .bg-wavy .text-slate-900 {
            color: #f8fafc !important;
        }

        html.dark .bg-wavy .text-slate-600 {
            color: #cbd5e1 !important;
        }

        html.dark .bg-wavy .text-slate-500 {
            color: #94a3b8 !important;
        }

        html.dark .bg-wavy .bg-white\/80 {
            background-color: rgba(15, 23, 42, 0.85) !important;
            border-color: #334155 !important;
        }

        html.dark .bg-wavy .bg-white\/70 {
            background-color: rgba(15, 23, 42, 0.75) !important;
            border-color: rgba(71, 85, 105, 0.5) !important;
        }

        /* Statistik */

        html.dark .bg-wavy .border-slate-200\/60 {
            border-color: rgba(71, 85, 105, 0.5) !important;
        }

        /* Fitur */

        html.dark #fitur {
            background-color: #0f172a !important;
        }

        html.dark #fitur .text-slate-900 {
            color: #f8fafc !important;
        }

        html.dark #fitur .text-slate-600 {
            color: #cbd5e1 !important;
        }

        html.dark #fitur .bg-white {
            background-color: #111827 !important;
        }

        html.dark #fitur [class*="border-blue-100"] {
            border-color: #1e3a5f !important;
        }

        html.dark #fitur [class*="border-indigo-100"] {
            border-color: #312e81 !important;
        }

        html.dark #fitur [class*="border-emerald-100"] {
            border-color: #064e3b !important;
        }

        /* Alur kerja */

        html.dark #cara-kerja {
            background-color: #020617 !important;
        }

        /* Footer */

        html.dark footer {
            background-color: #000000 !important;
        }

        /* Tombol mode */

        .theme-toggle {
            position: relative;
            overflow: hidden;
        }

        html.dark .theme-toggle {
            background-color: #1e293b !important;
            color: #f8fafc !important;
            border-color: #334155 !important;
        }

        html.dark .theme-toggle:hover {
            background-color: #334155 !important;
        }

        /* Transisi tema */

        body,
        header,
        section,
        footer,
        .bg-white,
        .bg-slate-50 {
            transition:
                background-color 0.3s ease,
                color 0.3s ease,
                border-color 0.3s ease;
        }
    </style>

    <!-- Cek tema sebelum halaman tampil -->
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>


<body class="bg-slate-50 text-slate-800 antialiased selection:bg-blue-500 selection:text-white">


    <!-- =========================================
         NAVBAR HEADER
         ========================================= -->

    <header class="bg-white/80 backdrop-blur-xl border-b border-blue-100 sticky top-0 z-50 transition-all duration-300">

        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <!-- LOGO -->

            <div class="flex items-center space-x-3 group cursor-pointer">

                <div class="relative">

                    <div class="absolute inset-0 bg-blue-400 rounded-xl blur opacity-20 group-hover:opacity-40 transition-opacity duration-300"></div>

                    <div class="relative w-10 h-10 rounded-xl overflow-hidden shadow-sm transition-bouncy group-hover:scale-110 bg-white">

                        <img
                            src="{{ asset('images/Logo sistem akademik mini.jpeg') }}"
                            alt="Logo Sistem Akademik Mini"
                            class="w-full h-full object-cover"
                        >

                    </div>

                </div>


                <div>

                    <span class="font-bold text-xl text-slate-900 tracking-tight">
                        Rapor Digital
                    </span>

                    <p class="text-[10px] font-semibold text-blue-500 tracking-wider">
                        SISTEM REKAPITULASI & CETAK RAPOR
                    </p>

                </div>

            </div>


            <!-- NAVIGASI -->

            <nav class="hidden md:flex items-center space-x-2 text-sm font-medium text-slate-600">

                <a
                    href="#tentang"
                    class="ripple-btn relative overflow-hidden px-4 py-2 rounded-full hover:text-blue-600 hover:bg-blue-50 transition-bouncy"
                >
                    Tentang
                </a>

                <a
                    href="#fitur"
                    class="ripple-btn relative overflow-hidden px-4 py-2 rounded-full hover:text-blue-600 hover:bg-blue-50 transition-bouncy"
                >
                    Fitur Utama
                </a>

                <a
                    href="#cara-kerja"
                    class="ripple-btn relative overflow-hidden px-4 py-2 rounded-full hover:text-blue-600 hover:bg-blue-50 transition-bouncy"
                >
                    Alur Kerja
                </a>

                <a
                    href="#kontak"
                    class="ripple-btn relative overflow-hidden px-4 py-2 rounded-full hover:text-blue-600 hover:bg-blue-50 transition-bouncy"
                >
                    Kontak
                </a>

            </nav>


            <!-- AKSI -->

            <div class="flex items-center space-x-3">

                <!-- TOMBOL DARK / LIGHT -->

                <button
                    type="button"
                    onclick="toggleTheme()"
                    class="theme-toggle relative overflow-hidden w-10 h-10 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 border border-slate-200 flex items-center justify-center transition-all duration-300"
                    aria-label="Ganti tema"
                    title="Ganti tema"
                >
                    <span id="themeIcon" class="text-base">
                        🌙
                    </span>
                </button>


                <!-- LOGIN -->

                <a
                    href="{{ route('login') }}"
                    class="ripple-btn relative overflow-hidden px-5 py-2.5 text-sm font-semibold text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-full transition-bouncy"
                >
                    Masuk
                </a>


                <!-- REGISTER -->

                <a
                    href="{{ route('register') }}"
                    class="ripple-btn relative overflow-hidden px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 rounded-full shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-1 transition-bouncy"
                >
                    Daftar Akun
                </a>

            </div>

        </div>

    </header>


    <!-- =========================================
         HERO SECTION
         ========================================= -->

    <section id="tentang" class="bg-wavy relative overflow-hidden">

        <div class="absolute top-20 left-10 w-64 h-64 bg-blue-300/20 rounded-full blur-3xl animate-float"></div>

        <div class="absolute bottom-20 right-10 w-80 h-80 bg-indigo-300/20 rounded-full blur-3xl animate-float-delayed"></div>


        <div class="max-w-7xl mx-auto px-6 pt-16 pb-20 text-center md:pt-24 md:pb-28 relative z-10">

            <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm border border-blue-100 text-blue-700 text-xs font-semibold px-5 py-2.5 rounded-full mb-8 shadow-lg shadow-blue-900/5 animate-float">

                <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>

                Sistem Informasi Pengolahan Nilai & Rapor Digital

            </div>


            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-slate-900 leading-tight tracking-tight mb-6 animate-float-delayed">

                Kelola Data Akademik Sekolah

                <br class="hidden md:inline">

                <span class="bg-gradient-to-r from-blue-600 via-indigo-500 to-blue-600 bg-clip-text text-transparent bg-[length:200%_auto]">

                    Lebih Cepat, Tepat, & Terstruktur

                </span>

            </h1>


            <p class="text-slate-600 text-base md:text-lg max-w-2xl mx-auto mb-10 leading-relaxed">

                Platform serbaguna untuk memudahkan Guru, Wali Kelas, dan Siswa dalam mengelola data master, rekapitulasi nilai harian, hingga cetak rapor digital secara efisien.

            </p>


            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16">

                <a
                    href="{{ route('login') }}"
                    class="ripple-btn relative overflow-hidden w-full sm:w-auto px-8 py-4 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-2xl shadow-xl shadow-blue-600/30 hover:shadow-2xl hover:shadow-blue-600/40 hover:-translate-y-2 active:translate-y-0 active:scale-95 transition-bouncy text-sm"
                >
                    Masuk ke Sistem
                </a>


                <a
                    href="#fitur"
                    class="ripple-btn relative overflow-hidden w-full sm:w-auto px-8 py-4 bg-white border-2 border-blue-100 hover:border-blue-300 hover:bg-blue-50 text-slate-700 font-bold rounded-2xl shadow-lg shadow-slate-200/50 hover:-translate-y-2 active:translate-y-0 active:scale-95 transition-bouncy text-sm"
                >
                    Pelajari Fitur
                </a>

            </div>


            <!-- STATISTIK -->

            <div class="max-w-4xl mx-auto bg-white/70 backdrop-blur-xl border border-white/60 rounded-[2rem] p-6 md:p-8 shadow-2xl shadow-blue-900/10 grid grid-cols-2 md:grid-cols-4 gap-6 text-center hover:-translate-y-2 transition-bouncy">

                <div class="group">

                    <div class="text-3xl font-extrabold text-blue-600 group-hover:scale-110 transition-bouncy">
                        500+
                    </div>

                    <div class="text-xs font-semibold text-slate-500 mt-1">
                        Siswa Terdaftar
                    </div>

                </div>


                <div class="border-l border-slate-200/60 group">

                    <div class="text-3xl font-extrabold text-indigo-600 group-hover:scale-110 transition-bouncy">
                        30+
                    </div>

                    <div class="text-xs font-semibold text-slate-500 mt-1">
                        Guru & Staf Pengajar
                    </div>

                </div>


                <div class="border-l border-slate-200/60 group">

                    <div class="text-3xl font-extrabold text-blue-600 group-hover:scale-110 transition-bouncy">
                        100%
                    </div>

                    <div class="text-xs font-semibold text-slate-500 mt-1">
                        Kalkulasi Akurat
                    </div>

                </div>


                <div class="border-l border-slate-200/60 group">

                    <div class="text-3xl font-extrabold text-indigo-600 group-hover:scale-110 transition-bouncy">
                        Digital
                    </div>

                    <div class="text-xs font-semibold text-slate-500 mt-1">
                        Cetak Rapor Ready
                    </div>

                </div>

            </div>

        </div>


        <!-- WAVE -->

        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none rotate-180">

            <svg
                class="relative block w-full h-[60px]"
                data-name="Layer 1"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1200 120"
                preserveAspectRatio="none"
            >

                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    class="fill-white"
                ></path>

            </svg>

        </div>

    </section>


    <!-- =========================================
         FITUR UTAMA
         ========================================= -->

    <section id="fitur" class="bg-white py-24 relative">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center max-w-xl mx-auto mb-16">

                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight animate-float">
                    Fitur Unggulan
                </h2>

                <p class="text-slate-600 text-sm mt-4 leading-relaxed">
                    Dirancang khusus untuk mempermudah pekerjaan administrasi nilai dan pengelolaan data akademik sekolah.
                </p>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- FITUR 1 -->

                <div class="group relative p-8 bg-white rounded-[2rem] border border-blue-100 shadow-[0_20px_50px_-12px_rgba(59,130,246,0.15)] hover:shadow-[0_30px_60px_-12px_rgba(59,130,246,0.3)] hover:-translate-y-3 hover:scale-[1.03] transition-bouncy">

                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full blur-2xl -z-10 group-hover:bg-blue-100 transition-colors duration-500"></div>

                    <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 text-3xl shadow-inner group-hover:scale-110 group-hover:rotate-3 transition-bouncy">
                        👥
                    </div>

                    <h3 class="font-bold text-xl text-slate-900 mb-3">
                        Manajemen Data Master
                    </h3>

                    <p class="text-slate-600 text-sm leading-relaxed">
                        Pengelolaan data pokok secara terpusat mencakup Data Siswa, Data Guru, Kelas, hingga Mata Pelajaran secara fleksibel.
                    </p>

                </div>


                <!-- FITUR 2 -->

                <div class="group relative p-8 bg-white rounded-[2rem] border border-indigo-100 shadow-[0_20px_50px_-12px_rgba(99,102,241,0.15)] hover:shadow-[0_30px_60px_-12px_rgba(99,102,241,0.3)] hover:-translate-y-3 hover:scale-[1.03] transition-bouncy">

                    <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-full blur-2xl -z-10 group-hover:bg-indigo-100 transition-colors duration-500"></div>

                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-100 to-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 text-3xl shadow-inner group-hover:scale-110 group-hover:rotate-3 transition-bouncy">
                        ✏️
                    </div>

                    <h3 class="font-bold text-xl text-slate-900 mb-3">
                        Input Nilai & Otomatisasi
                    </h3>

                    <p class="text-slate-600 text-sm leading-relaxed">
                        Pencatatan nilai Tugas, UTS, dan UAS oleh Guru. Rumus kalkulasi nilai akhir semester langsung terhitung secara otomatis.
                    </p>

                </div>


                <!-- FITUR 3 -->

                <div class="group relative p-8 bg-white rounded-[2rem] border border-emerald-100 shadow-[0_20px_50px_-12px_rgba(16,185,129,0.15)] hover:shadow-[0_30px_60px_-12px_rgba(16,185,129,0.3)] hover:-translate-y-3 hover:scale-[1.03] transition-bouncy">

                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full blur-2xl -z-10 group-hover:bg-emerald-100 transition-colors duration-500"></div>

                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-100 to-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-6 text-3xl shadow-inner group-hover:scale-110 group-hover:rotate-3 transition-bouncy">
                        🖨️
                    </div>

                    <h3 class="font-bold text-xl text-slate-900 mb-3">
                        Cetak Rapor Digital
                    </h3>

                    <p class="text-slate-600 text-sm leading-relaxed">
                        Rekapitulasi hasil belajar dapat dilihat dan dicetak langsung oleh Wali Kelas maupun Siswa dalam bentuk lembar Rapor.
                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================
         ALUR KERJA
         ========================================= -->

    <section id="cara-kerja" class="py-24 bg-slate-900 text-white relative overflow-hidden">

        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl animate-float"></div>

        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-indigo-600/10 rounded-full blur-3xl animate-float-delayed"></div>


        <div class="max-w-7xl mx-auto px-6 relative z-10">

            <div class="text-center max-w-xl mx-auto mb-16">

                <span class="text-blue-400 font-bold text-xs uppercase tracking-widest animate-pulse">
                    Alur Kerja Sistem
                </span>

                <h2 class="text-3xl md:text-4xl font-bold mt-3 tracking-tight animate-float-delayed">
                    Langkah Mudah Penggunaan
                </h2>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <div class="group p-6 rounded-[2rem] border border-slate-700/50 bg-slate-800/40 backdrop-blur-sm hover:bg-slate-800 hover:border-blue-500/50 hover:-translate-y-3 hover:scale-[1.03] transition-bouncy shadow-lg shadow-black/20">

                    <div class="text-4xl font-extrabold text-blue-500/40 group-hover:text-blue-400 mb-4 transition-bouncy">
                        01
                    </div>

                    <h4 class="font-bold text-lg mb-2 text-slate-100">
                        Autentikasi Akun
                    </h4>

                    <p class="text-slate-400 text-xs leading-relaxed">
                        Pengguna melakukan login sesuai hak akses (Admin, Guru, atau Siswa).
                    </p>

                </div>


                <div class="group p-6 rounded-[2rem] border border-slate-700/50 bg-slate-800/40 backdrop-blur-sm hover:bg-slate-800 hover:border-blue-500/50 hover:-translate-y-3 hover:scale-[1.03] transition-bouncy shadow-lg shadow-black/20">

                    <div class="text-4xl font-extrabold text-blue-500/40 group-hover:text-blue-400 mb-4 transition-bouncy">
                        02
                    </div>

                    <h4 class="font-bold text-lg mb-2 text-slate-100">
                        Kelola Data Master
                    </h4>

                    <p class="text-slate-400 text-xs leading-relaxed">
                        Admin menginputkan data awal seperti kelas, siswa, guru, dan mata pelajaran.
                    </p>

                </div>


                <div class="group p-6 rounded-[2rem] border border-slate-700/50 bg-slate-800/40 backdrop-blur-sm hover:bg-slate-800 hover:border-blue-500/50 hover:-translate-y-3 hover:scale-[1.03] transition-bouncy">

                    <div class="text-4xl font-extrabold text-blue-500/40 group-hover:text-blue-400 mb-4 transition-bouncy">
                        03
                    </div>

                    <h4 class="font-bold text-lg mb-2 text-slate-100">
                        Pengisian Nilai
                    </h4>

                    <p class="text-slate-400 text-xs leading-relaxed">
                        Guru mata pelajaran memasukkan nilai harian, ujian tengah semester, dan ujian akhir.
                    </p>

                </div>


                <div class="group p-6 rounded-[2rem] border border-slate-700/50 bg-slate-800/40 backdrop-blur-sm hover:bg-slate-800 hover:border-blue-500/50 hover:-translate-y-3 hover:scale-[1.03] transition-bouncy">

                    <div class="text-4xl font-extrabold text-blue-500/40 group-hover:text-blue-400 mb-4 transition-bouncy">
                        04
                    </div>

                    <h4 class="font-bold text-lg mb-2 text-slate-100">
                        Cetak Rapor
                    </h4>

                    <p class="text-slate-400 text-xs leading-relaxed">
                        Nilai dikalkulasi otomatis dan rapor siap dicetak oleh pihak sekolah.
                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================
         FOOTER
         ========================================= -->

    <footer
        id="kontak"
        class="bg-slate-950 text-slate-400 py-16 border-t border-slate-800 relative overflow-hidden"
    >

        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-px bg-gradient-to-r from-transparent via-blue-500/50 to-transparent"></div>


        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-12 mb-12 relative z-10">

            <!-- INFO -->

            <div>

                <h3 class="text-white font-bold text-lg mb-4 tracking-tight">
                    Sistem Akademik Mini
                </h3>

                <p class="text-xs text-slate-400 leading-relaxed max-w-xs">
                    Sistem Informasi Akademik digital berbasis web untuk efisiensi dan transparansi pengolahan data nilai siswa.
                </p>

            </div>


            <!-- KONTAK -->

            <div>

                <h4 class="text-white font-semibold text-sm mb-4 tracking-wide">
                    Kontak Sekolah
                </h4>

                <div class="space-y-3 text-xs">

                    <p class="flex items-center gap-2 hover:text-blue-400 hover:-translate-x-1 transition-bouncy cursor-default">
                        <span>📍</span>
                        Jl. Babakantiga, Kabupaten Bandung
                    </p>

                    <p class="flex items-center gap-2 hover:text-blue-400 hover:-translate-x-1 transition-bouncy cursor-default">
                        <span>📧</span>
                        smkbbc.sch.id
                    </p>

                    <p class="flex items-center gap-2 hover:text-blue-400 hover:-translate-x-1 transition-bouncy cursor-default">
                        <span>📞</span>
                        (022) 5928262
                    </p>

                </div>

            </div>


            <!-- NAVIGASI -->

            <div>

                <h4 class="text-white font-semibold text-sm mb-4 tracking-wide">
                    Navigasi Cepat
                </h4>

                <div class="flex flex-col space-y-3 text-xs">

                    <a
                        href="{{ route('login') }}"
                        class="ripple-btn relative overflow-hidden w-fit hover:text-blue-400 hover:translate-x-2 transition-bouncy flex items-center gap-2 group"
                    >
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 opacity-0 group-hover:opacity-100 transition-bouncy"></span>
                        Halaman Login
                    </a>


                    <a
                        href="{{ route('register') }}"
                        class="ripple-btn relative overflow-hidden w-fit hover:text-blue-400 hover:translate-x-2 transition-bouncy flex items-center gap-2 group"
                    >
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 opacity-0 group-hover:opacity-100 transition-bouncy"></span>
                        Pendaftaran Akun
                    </a>


                    <a
                        href="#fitur"
                        class="ripple-btn relative overflow-hidden w-fit hover:text-blue-400 hover:translate-x-2 transition-bouncy flex items-center gap-2 group"
                    >
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 opacity-0 group-hover:opacity-100 transition-bouncy"></span>
                        Fitur Utama
                    </a>

                </div>

            </div>

        </div>


        <div class="max-w-7xl mx-auto px-6 pt-8 border-t border-slate-800 text-center relative z-10">

            <p class="text-[11px] text-slate-500">
                &copy; {{ date('Y') }} Sistem Akademik Mini. Hak cipta dilindungi undang-undang.
            </p>

        </div>

    </footer>


    <!-- =========================================
         RIPPLE EFFECT
         ========================================= -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            function createRipple(event) {

                const button = event.currentTarget;

                const circle = document.createElement("span");

                const diameter = Math.max(
                    button.clientWidth,
                    button.clientHeight
                );

                const radius = diameter / 2;

                const rect = button.getBoundingClientRect();

                circle.style.width = circle.style.height = `${diameter}px`;

                circle.style.left =
                    `${event.clientX - rect.left - radius}px`;

                circle.style.top =
                    `${event.clientY - rect.top - radius}px`;


                if (
                    button.classList.contains('bg-white') ||
                    button.classList.contains('bg-slate-50') ||
                    button.classList.contains('bg-slate-800/40')
                ) {

                    circle.style.backgroundColor =
                        "rgba(59, 130, 246, 0.15)";

                } else {

                    circle.style.backgroundColor =
                        "rgba(255, 255, 255, 0.3)";

                }


                circle.classList.add("ripple-effect");


                const ripple =
                    button.getElementsByClassName('ripple-effect')[0];

                if (ripple) {
                    ripple.remove();
                }


                button.appendChild(circle);
            }


            const buttons =
                document.querySelectorAll(".ripple-btn");


            for (const button of buttons) {
                button.addEventListener("click", createRipple);
            }

        });
    </script>


    <!-- =========================================
         DARK / LIGHT MODE
         ========================================= -->

    <script>

        function updateThemeIcon() {

            const icon =
                document.getElementById('themeIcon');

            if (!icon) {
                return;
            }


            if (
                document.documentElement.classList.contains('dark')
            ) {

                icon.textContent = '☀️';

            } else {

                icon.textContent = '🌙';

            }

        }


        function toggleTheme() {

            const html =
                document.documentElement;


            if (
                html.classList.contains('dark')
            ) {

                html.classList.remove('dark');

                localStorage.setItem(
                    'theme',
                    'light'
                );

            } else {

                html.classList.add('dark');

                localStorage.setItem(
                    'theme',
                    'dark'
                );

            }


            updateThemeIcon();

        }


        updateThemeIcon();

    </script>

</body>
</html>