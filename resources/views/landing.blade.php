<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#E3F0FA">
    <title>Sistem Akademik Mini</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                    colors: {
                        pastel: { 1: '#E3F0FA', 2: '#C3E0F4', 3: '#BAD1EC', 4: '#A4BFDF', 5: '#89AAD7' },
                        primary: { DEFAULT: '#5B8DB8', hover: '#4A7AA5', dark: '#3D6A91', light: '#7BA8D1' },
                        dark: {
                            bg: '#0B1220',
                            surface: '#111B2E',
                            surface2: '#162238',
                            surface3: '#1C2D47',
                            border: '#243856',
                            text: '#E2E8F0',
                            muted: '#94A3B8'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-15px); } }
        @keyframes floatSlow { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
        @keyframes slide-up { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }

        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-float-slow { animation: floatSlow 5s ease-in-out infinite; }
        .animate-slide-up { animation: slide-up 0.8s ease-out forwards; }
        .animate-fade-in { animation: fade-in 1s ease-out forwards; }

        .transition-smooth { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .transition-bouncy { transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1); }

        .clickable-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }
        .clickable-card:hover { transform: translateY(-6px); }
        .clickable-card:active { transform: translateY(-2px) scale(0.98); }

        .ripple-effect {
            position: absolute; border-radius: 50%; transform: scale(0);
            animation: ripple 600ms linear; pointer-events: none; z-index: 0;
        }
        @keyframes ripple { to { transform: scale(4); opacity: 0; } }

        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #F7FAFD; }
        ::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #5B8DB8, #89AAD7); border-radius: 10px; }
        html.dark ::-webkit-scrollbar-track { background: #0B1220; }

        .bg-grid-pattern {
            background-color: #F7FAFD;
            background-image:
                radial-gradient(at 0% 0%, rgba(91, 141, 184, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(123, 168, 209, 0.15) 0px, transparent 50%),
                linear-gradient(rgba(91, 141, 184, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(91, 141, 184, 0.05) 1px, transparent 1px);
            background-size: 100% 100%, 100% 100%, 50px 50px, 50px 50px;
        }
        html.dark .bg-grid-pattern {
            background-color: #0B1220;
            background-image:
                radial-gradient(at 0% 0%, rgba(91, 141, 184, 0.12) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(91, 141, 184, 0.1) 0px, transparent 50%),
                linear-gradient(rgba(91, 141, 184, 0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(91, 141, 184, 0.06) 1px, transparent 1px);
            background-size: 100% 100%, 100% 100%, 50px 50px, 50px 50px;
        }

        .text-gradient {
            background: linear-gradient(135deg, #5B8DB8 0%, #7BA8D1 50%, #5B8DB8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        html.dark .glass {
            background: rgba(11, 18, 32, 0.85);
            border-color: #243856 !important;
        }

        .perspective-1000 { perspective: 1000px; }
        .rotate-y-6 { transform: rotateY(-6deg) rotateX(2deg); }
        .rotate-y-6-hover:hover { transform: rotateY(0deg) rotateX(0deg); }

        /* Smooth transitions for theme switching */
        body, header, section, footer, nav, a, p, h1, h2, h3, h4, div, span, button {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        }
    </style>

    <script>
        if (localStorage.getItem('admin-theme') === 'dark' || localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>

<body class="bg-slate-50 dark:bg-dark-bg text-slate-800 dark:text-dark-text antialiased selection:bg-primary selection:text-white">

    <!-- NAVBAR -->
    <header class="glass border-b border-pastel-2 dark:border-dark-border sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 py-3.5 flex items-center justify-between">
            <a href="{{ route('landing') }}" class="flex items-center space-x-3 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-primary rounded-xl blur opacity-30 group-hover:opacity-50 transition-opacity duration-300"></div>
                    <div class="relative w-10 h-10 rounded-xl overflow-hidden shadow-lg border-2 border-primary/30 transition-bouncy group-hover:scale-110 bg-white dark:bg-dark-surface">
                        <img src="{{ asset('images/Logo sistem akademik mini.jpeg') }}" alt="Logo" class="w-full h-full object-cover">
                    </div>
                </div>
                <div>
                    <span class="font-black text-lg text-slate-900 dark:text-white tracking-tight">Sistem Akademik Mini</span>
                    <p class="text-[9px] font-bold text-primary tracking-wider uppercase">Sistem Informasi Sekolah</p>
                </div>
            </a>

            <nav class="hidden md:flex items-center space-x-1">
                <a href="#tentang" class="ripple-btn relative overflow-hidden px-4 py-2 rounded-xl text-sm font-bold text-slate-700 dark:text-slate-300 hover:text-primary hover:bg-pastel-1 dark:hover:bg-dark-surface2 transition-smooth">Beranda</a>
                <a href="#fitur" class="ripple-btn relative overflow-hidden px-4 py-2 rounded-xl text-sm font-bold text-slate-700 dark:text-slate-300 hover:text-primary hover:bg-pastel-1 dark:hover:bg-dark-surface2 transition-smooth">Fitur</a>
                <a href="#cara-kerja" class="ripple-btn relative overflow-hidden px-4 py-2 rounded-xl text-sm font-bold text-slate-700 dark:text-slate-300 hover:text-primary hover:bg-pastel-1 dark:hover:bg-dark-surface2 transition-smooth">Alur</a>
                <a href="#kontak" class="ripple-btn relative overflow-hidden px-4 py-2 rounded-xl text-sm font-bold text-slate-700 dark:text-slate-300 hover:text-primary hover:bg-pastel-1 dark:hover:bg-dark-surface2 transition-smooth">Kontak</a>
            </nav>

            <div class="flex items-center space-x-3">
                <button type="button" onclick="toggleTheme()" class="theme-toggle w-9 h-9 rounded-xl bg-pastel-1 dark:bg-dark-surface2 hover:bg-pastel-2 dark:hover:bg-dark-surface3 text-primary border-2 border-pastel-2 dark:border-dark-border flex items-center justify-center transition-smooth font-bold" aria-label="Ganti tema">
                    <span id="themeIcon" class="text-sm">🌙</span>
                </button>
                <a href="{{ route('login') }}" class="ripple-btn relative overflow-hidden hidden sm:inline-flex px-5 py-2 text-sm font-bold text-slate-700 dark:text-slate-300 hover:text-white hover:bg-primary rounded-xl border-2 border-slate-200 dark:border-dark-border hover:border-primary transition-smooth">Masuk</a>
                <a href="{{ route('register') }}" class="ripple-btn relative overflow-hidden px-5 py-2 text-sm font-bold text-white bg-primary hover:bg-primary-hover rounded-xl shadow-lg shadow-primary/30 hover:shadow-xl hover:shadow-primary/40 hover:-translate-y-0.5 transition-smooth">Daftar</a>
                <button class="md:hidden w-9 h-9 rounded-xl bg-pastel-1 dark:bg-dark-surface2 text-primary border-2 border-pastel-2 dark:border-dark-border flex items-center justify-center font-bold" onclick="toggleMenu()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
            </div>
        </div>
        <div id="mobileMenu" class="hidden md:hidden bg-white dark:bg-dark-surface border-t-2 border-pastel-2 dark:border-dark-border px-6 py-4 shadow-xl">
            <div class="flex flex-col space-y-2">
                <a href="#tentang" class="px-4 py-2.5 rounded-xl hover:bg-primary hover:text-white text-slate-700 dark:text-slate-300 font-bold transition-smooth">Beranda</a>
                <a href="#fitur" class="px-4 py-2.5 rounded-xl hover:bg-primary hover:text-white text-slate-700 dark:text-slate-300 font-bold transition-smooth">Fitur</a>
                <a href="#cara-kerja" class="px-4 py-2.5 rounded-xl hover:bg-primary hover:text-white text-slate-700 dark:text-slate-300 font-bold transition-smooth">Alur</a>
                <a href="#kontak" class="px-4 py-2.5 rounded-xl hover:bg-primary hover:text-white text-slate-700 dark:text-slate-300 font-bold transition-smooth">Kontak</a>
                <a href="{{ route('login') }}" class="px-4 py-2.5 rounded-xl bg-primary text-white font-bold text-center">Masuk</a>
            </div>
        </div>
    </header>

    <!-- HERO -->
    <section id="tentang" class="bg-grid-pattern relative overflow-hidden">
        <div class="absolute top-32 left-20 w-20 h-20 bg-primary/20 rounded-2xl blur-2xl animate-float"></div>
        <div class="absolute bottom-40 right-32 w-32 h-32 bg-pastel-4/30 rounded-full blur-3xl animate-float-slow"></div>

        <div class="max-w-7xl mx-auto px-6 pt-14 pb-16 md:pt-20 md:pb-24 relative z-10">
            <div class="grid lg:grid-cols-12 gap-10 items-center">

                <!-- LEFT -->
                <div class="lg:col-span-6 space-y-6 animate-slide-up">
                    <div class="inline-flex items-center gap-2 bg-white dark:bg-dark-surface border-2 border-primary/20 text-primary text-xs font-bold px-4 py-2 rounded-full shadow-lg">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                        </span>
                        Sistem Informasi Akademik
                    </div>

                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-black text-slate-900 dark:text-white leading-[1.05] tracking-tight">
                        Kelola Akademik<br>
                        <span class="text-gradient">Lebih Terorganisir</span>
                    </h1>

                    <p class="text-slate-600 dark:text-dark-muted text-base md:text-lg leading-relaxed font-medium max-w-xl">
                        Platform terpadu untuk pengelolaan data siswa, guru, mata pelajaran, nilai, dan rapor dalam satu sistem yang efisien.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('login') }}" class="ripple-btn relative overflow-hidden group px-7 py-3.5 bg-primary hover:bg-primary-hover text-white font-black text-sm rounded-2xl shadow-2xl shadow-primary/40 hover:shadow-primary/50 hover:-translate-y-1 transition-smooth flex items-center justify-center gap-2">
                            Masuk ke Sistem
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                        <a href="#fitur" class="ripple-btn relative overflow-hidden px-7 py-3.5 bg-white dark:bg-dark-surface border-2 border-slate-200 dark:border-dark-border hover:border-primary text-slate-800 dark:text-white font-black text-sm rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-smooth flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Lihat Fitur
                        </a>
                    </div>

                    <div class="flex items-center gap-5 pt-2">
                        <div class="flex -space-x-2">
                            <div class="w-9 h-9 rounded-full bg-primary border-2 border-white dark:border-dark-surface flex items-center justify-center text-white font-bold text-xs">A</div>
                            <div class="w-9 h-9 rounded-full bg-pastel-4 border-2 border-white dark:border-dark-surface flex items-center justify-center text-white font-bold text-xs">G</div>
                            <div class="w-9 h-9 rounded-full bg-pastel-3 border-2 border-white dark:border-dark-surface flex items-center justify-center text-white font-bold text-xs">S</div>
                        </div>
                        <div>
                            <div class="font-black text-slate-900 dark:text-white text-sm">Admin • Guru • Siswa</div>
                            <div class="text-xs text-slate-500 dark:text-dark-muted font-semibold">Akses berbasis role</div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT -->
                <div class="lg:col-span-6 perspective-1000 animate-fade-in" style="animation-delay: 0.3s;">
                    <div class="relative rotate-y-6 rotate-y-6-hover transition-smooth duration-700">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary/30 to-pastel-4/30 rounded-3xl blur-3xl"></div>

                        <div class="relative bg-white dark:bg-dark-surface rounded-3xl p-5 md:p-7 border-2 border-pastel-2 dark:border-dark-border shadow-2xl">
                            <div class="flex items-center justify-between mb-5 pb-3 border-b-2 border-pastel-2 dark:border-dark-border">
                                <div class="flex items-center gap-2">
                                    <div class="w-2.5 h-2.5 rounded-full bg-red-400"></div>
                                    <div class="w-2.5 h-2.5 rounded-full bg-yellow-400"></div>
                                    <div class="w-2.5 h-2.5 rounded-full bg-green-400"></div>
                                </div>
                                <div class="text-[11px] font-black text-slate-400 dark:text-dark-muted uppercase tracking-wider">Dashboard</div>
                            </div>

                            <div class="space-y-2.5">
                                <div class="flex items-center gap-3.5 p-3.5 bg-gradient-to-r from-pastel-1 to-pastel-2 dark:from-dark-surface2 dark:to-dark-surface3 rounded-xl border-2 border-pastel-2 dark:border-dark-border shadow-lg">
                                    <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center text-white shadow-lg shadow-primary/30 flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-black text-slate-800 dark:text-white">Master Siswa</div>
                                        <div class="text-[11px] text-slate-500 dark:text-dark-muted font-semibold">Data siswa & kelas</div>
                                    </div>
                                    <svg class="w-4 h-4 text-primary flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                </div>

                                <div class="flex items-center gap-3.5 p-3.5 bg-gradient-to-r from-pastel-1 to-pastel-2 dark:from-dark-surface2 dark:to-dark-surface3 rounded-xl border-2 border-pastel-2 dark:border-dark-border shadow-lg">
                                    <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center text-white shadow-lg shadow-primary/30 flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-black text-slate-800 dark:text-white">Data Guru</div>
                                        <div class="text-[11px] text-slate-500 dark:text-dark-muted font-semibold">Informasi pengajar</div>
                                    </div>
                                    <svg class="w-4 h-4 text-primary flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                </div>

                                <div class="flex items-center gap-3.5 p-3.5 bg-gradient-to-r from-pastel-1 to-pastel-2 dark:from-dark-surface2 dark:to-dark-surface3 rounded-xl border-2 border-pastel-2 dark:border-dark-border shadow-lg">
                                    <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center text-white shadow-lg shadow-primary/30 flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-black text-slate-800 dark:text-white">Input Nilai</div>
                                        <div class="text-[11px] text-slate-500 dark:text-dark-muted font-semibold">Penilaian siswa</div>
                                    </div>
                                    <svg class="w-4 h-4 text-primary flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                </div>

                                <div class="flex items-center gap-3.5 p-3.5 bg-gradient-to-r from-primary to-primary-hover rounded-xl border-2 border-primary shadow-lg">
                                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center text-white flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-black text-white">Rekap & Rapor</div>
                                        <div class="text-[11px] text-white/80 font-semibold">Rekapitulasi digital</div>
                                    </div>
                                    <svg class="w-4 h-4 text-white flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                </div>
                            </div>
                        </div>

                        <div class="absolute -top-3 -right-3 bg-white dark:bg-dark-surface rounded-xl p-2.5 shadow-2xl border-2 border-pastel-2 dark:border-dark-border animate-float-slow">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 bg-green-400 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                </div>
                                <div>
                                    <div class="text-[11px] font-black text-slate-800 dark:text-white">Aktif</div>
                                    <div class="text-[9px] text-slate-500 dark:text-dark-muted font-semibold">Sistem Online</div>
                                </div>
                            </div>
                        </div>

                        <div class="absolute -bottom-3 -left-3 bg-white dark:bg-dark-surface rounded-xl p-2.5 shadow-2xl border-2 border-pastel-2 dark:border-dark-border animate-float" style="animation-delay: 1s;">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 bg-primary rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                </div>
                                <div>
                                    <div class="text-[11px] font-black text-slate-800 dark:text-white">Aman</div>
                                    <div class="text-[9px] text-slate-500 dark:text-dark-muted font-semibold">Data Terjaga</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none rotate-180">
            <svg class="relative block w-full h-[60px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-white dark:fill-dark-bg"></path>
            </svg>
        </div>
    </section>

    <!-- TRUST BAR -->
    <section class="bg-white dark:bg-dark-surface border-b border-pastel-2 dark:border-dark-border py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="flex items-center gap-3 p-3 rounded-2xl hover:bg-pastel-1 dark:hover:bg-dark-surface2 transition-smooth">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary to-primary-light rounded-xl flex items-center justify-center text-white shadow-lg flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <div>
                        <div class="font-black text-slate-900 dark:text-white text-sm">Terintegrasi</div>
                        <div class="text-[11px] text-slate-500 dark:text-dark-muted font-semibold">Satu platform</div>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 rounded-2xl hover:bg-pastel-1 dark:hover:bg-dark-surface2 transition-smooth">
                    <div class="w-10 h-10 bg-gradient-to-br from-pastel-4 to-primary rounded-xl flex items-center justify-center text-white shadow-lg flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    </div>
                    <div>
                        <div class="font-black text-slate-900 dark:text-white text-sm">Cepat</div>
                        <div class="text-[11px] text-slate-500 dark:text-dark-muted font-semibold">Proses otomatis</div>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 rounded-2xl hover:bg-pastel-1 dark:hover:bg-dark-surface2 transition-smooth">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-light to-primary rounded-xl flex items-center justify-center text-white shadow-lg flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div>
                        <div class="font-black text-slate-900 dark:text-white text-sm">Aman</div>
                        <div class="text-[11px] text-slate-500 dark:text-dark-muted font-semibold">Data terjaga</div>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 rounded-2xl hover:bg-pastel-1 dark:hover:bg-dark-surface2 transition-smooth">
                    <div class="w-10 h-10 bg-gradient-to-br from-pastel-3 to-pastel-4 rounded-xl flex items-center justify-center text-white shadow-lg flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    </div>
                    <div>
                        <div class="font-black text-slate-900 dark:text-white text-sm">Digital</div>
                        <div class="text-[11px] text-slate-500 dark:text-dark-muted font-semibold">Rapor online</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES - BENTO GRID -->
    <section id="fitur" class="bg-white dark:bg-dark-surface py-20 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="inline-block px-4 py-1.5 bg-primary text-white text-xs font-black rounded-full mb-4 shadow-lg shadow-primary/30 uppercase tracking-wider">Fitur Sistem</span>
                <h2 class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight mb-4">Semua yang Kamu Butuhkan</h2>
                <p class="text-slate-600 dark:text-dark-muted text-base leading-relaxed font-medium">Fitur lengkap untuk pengelolaan akademik sekolah sesuai standar</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-6 gap-5">

                <!-- Large Card -->
                <div class="clickable-card md:col-span-4 group relative p-6 bg-gradient-to-br from-pastel-1 to-pastel-2 dark:from-dark-surface2 dark:to-dark-surface3 rounded-3xl border-2 border-pastel-2 dark:border-dark-border shadow-xl hover:shadow-2xl hover:border-primary overflow-hidden">
                    <div class="absolute top-0 right-0 w-48 h-48 bg-primary/10 rounded-full blur-3xl -mr-24 -mt-24 group-hover:bg-primary/20 transition-smooth"></div>
                    <div class="relative">
                        <div class="w-14 h-14 bg-white dark:bg-dark-surface rounded-2xl flex items-center justify-center mb-5 shadow-lg group-hover:scale-110 transition-bouncy">
                            <svg class="w-7 h-7 text-primary" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <h3 class="font-black text-xl text-slate-900 dark:text-white mb-2">Master Siswa</h3>
                        <p class="text-slate-600 dark:text-dark-muted text-sm leading-relaxed font-medium max-w-md">Kelola data siswa, NIS, kelas, dan informasi pribadi dengan terstruktur. Semua data tersimpan rapi dan mudah diakses.</p>
                    </div>
                </div>

                <!-- Small Card -->
                <div class="clickable-card md:col-span-2 group relative p-6 bg-white dark:bg-dark-surface2 rounded-3xl border-2 border-pastel-2 dark:border-dark-border shadow-xl hover:shadow-2xl hover:border-primary">
                    <div class="w-12 h-12 bg-gradient-to-br from-pastel-1 to-pastel-2 dark:from-dark-surface3 dark:to-dark-surface rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-bouncy">
                        <svg class="w-6 h-6 text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                    </div>
                    <h3 class="font-black text-lg text-slate-900 dark:text-white mb-2">Data Guru</h3>
                    <p class="text-slate-600 dark:text-dark-muted text-sm leading-relaxed font-medium">Kelola informasi guru, NIP, dan mata pelajaran yang diampu.</p>
                </div>

                <!-- Small Card -->
                <div class="clickable-card md:col-span-2 group relative p-6 bg-white dark:bg-dark-surface2 rounded-3xl border-2 border-pastel-2 dark:border-dark-border shadow-xl hover:shadow-2xl hover:border-primary">
                    <div class="w-12 h-12 bg-gradient-to-br from-pastel-1 to-pastel-2 dark:from-dark-surface3 dark:to-dark-surface rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-bouncy">
                        <svg class="w-6 h-6 text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                    </div>
                    <h3 class="font-black text-lg text-slate-900 dark:text-white mb-2">Mapel & Kelas</h3>
                    <p class="text-slate-600 dark:text-dark-muted text-sm leading-relaxed font-medium">Atur mata pelajaran, kelas, wali kelas, dan KKM pembelajaran.</p>
                </div>

                <!-- Large Card -->
                <div class="clickable-card md:col-span-4 group relative p-6 bg-gradient-to-br from-primary to-primary-hover rounded-3xl border-2 border-primary shadow-xl hover:shadow-2xl overflow-hidden">
                    <div class="absolute top-0 right-0 w-48 h-48 bg-white/10 rounded-full blur-3xl -mr-24 -mt-24"></div>
                    <div class="relative">
                        <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center mb-5 shadow-lg group-hover:scale-110 transition-bouncy">
                            <svg class="w-7 h-7 text-white" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                        </div>
                        <h3 class="font-black text-xl text-white mb-2">Input Nilai</h3>
                        <p class="text-white/90 text-sm leading-relaxed font-medium max-w-md">Input nilai harian, UTS, UAS dengan perhitungan otomatis. Sistem langsung menghitung nilai akhir berdasarkan bobot yang ditentukan.</p>
                    </div>
                </div>

                <!-- Small Card -->
                <div class="clickable-card md:col-span-3 group relative p-6 bg-white dark:bg-dark-surface2 rounded-3xl border-2 border-pastel-2 dark:border-dark-border shadow-xl hover:shadow-2xl hover:border-primary">
                    <div class="w-12 h-12 bg-gradient-to-br from-pastel-1 to-pastel-2 dark:from-dark-surface3 dark:to-dark-surface rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-bouncy">
                        <svg class="w-6 h-6 text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                    </div>
                    <h3 class="font-black text-lg text-slate-900 dark:text-white mb-2">Rekap Nilai</h3>
                    <p class="text-slate-600 dark:text-dark-muted text-sm leading-relaxed font-medium">Lihat rekapitulasi nilai siswa per mata pelajaran dan semester.</p>
                </div>

                <!-- Small Card -->
                <div class="clickable-card md:col-span-3 group relative p-6 bg-white dark:bg-dark-surface2 rounded-3xl border-2 border-pastel-2 dark:border-dark-border shadow-xl hover:shadow-2xl hover:border-primary">
                    <div class="w-12 h-12 bg-gradient-to-br from-pastel-1 to-pastel-2 dark:from-dark-surface3 dark:to-dark-surface rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-bouncy">
                        <svg class="w-6 h-6 text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </div>
                    <h3 class="font-black text-lg text-slate-900 dark:text-white mb-2">Rapor Ringkas</h3>
                    <p class="text-slate-600 dark:text-dark-muted text-sm leading-relaxed font-medium">Cetak dan lihat rapor digital hasil belajar siswa.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- WORKFLOW -->
    <section id="cara-kerja" class="bg-gradient-to-b from-pastel-1 to-white dark:from-dark-surface2 dark:to-dark-bg py-20 relative overflow-hidden">
        <div class="absolute top-20 left-10 w-60 h-60 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-80 h-80 bg-pastel-4/20 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="inline-block px-4 py-1.5 bg-white dark:bg-dark-surface text-primary text-xs font-black rounded-full mb-4 shadow-lg border-2 border-primary/20 uppercase tracking-wider">Alur Penggunaan</span>
                <h2 class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight mb-4">4 Langkah Mudah</h2>
                <p class="text-slate-600 dark:text-dark-muted text-base leading-relaxed font-medium">Cara menggunakan sistem dari awal hingga selesai</p>
            </div>

            <div class="relative">
                <div class="hidden md:block absolute top-[42px] left-0 right-0 h-1 bg-gradient-to-r from-pastel-2 via-primary to-pastel-2 dark:from-dark-border dark:via-primary dark:to-dark-border rounded-full"></div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="clickable-card group relative">
                        <div class="relative mb-5">
                            <div class="w-16 h-16 bg-white dark:bg-dark-surface rounded-2xl border-4 border-primary flex items-center justify-center mx-auto shadow-xl group-hover:scale-110 group-hover:rotate-6 transition-bouncy relative z-10">
                                <span class="text-2xl font-black text-primary">1</span>
                            </div>
                            <div class="absolute inset-0 bg-primary/20 rounded-2xl blur-xl group-hover:bg-primary/30 transition-smooth"></div>
                        </div>
                        <div class="bg-white dark:bg-dark-surface rounded-2xl p-5 border-2 border-pastel-2 dark:border-dark-border shadow-lg group-hover:border-primary group-hover:shadow-xl transition-smooth text-center">
                            <h4 class="font-black text-lg mb-1.5 text-slate-900 dark:text-white">Login</h4>
                            <p class="text-slate-600 dark:text-dark-muted text-sm leading-relaxed font-medium">Masuk sebagai Admin, Guru, atau Siswa</p>
                        </div>
                    </div>

                    <div class="clickable-card group relative">
                        <div class="relative mb-5">
                            <div class="w-16 h-16 bg-white dark:bg-dark-surface rounded-2xl border-4 border-primary flex items-center justify-center mx-auto shadow-xl group-hover:scale-110 group-hover:rotate-6 transition-bouncy relative z-10">
                                <span class="text-2xl font-black text-primary">2</span>
                            </div>
                            <div class="absolute inset-0 bg-primary/20 rounded-2xl blur-xl group-hover:bg-primary/30 transition-smooth"></div>
                        </div>
                        <div class="bg-white dark:bg-dark-surface rounded-2xl p-5 border-2 border-pastel-2 dark:border-dark-border shadow-lg group-hover:border-primary group-hover:shadow-xl transition-smooth text-center">
                            <h4 class="font-black text-lg mb-1.5 text-slate-900 dark:text-white">Kelola Data</h4>
                            <p class="text-slate-600 dark:text-dark-muted text-sm leading-relaxed font-medium">Admin mengelola data master siswa dan guru</p>
                        </div>
                    </div>

                    <div class="clickable-card group relative">
                        <div class="relative mb-5">
                            <div class="w-16 h-16 bg-white dark:bg-dark-surface rounded-2xl border-4 border-primary flex items-center justify-center mx-auto shadow-xl group-hover:scale-110 group-hover:rotate-6 transition-bouncy relative z-10">
                                <span class="text-2xl font-black text-primary">3</span>
                            </div>
                            <div class="absolute inset-0 bg-primary/20 rounded-2xl blur-xl group-hover:bg-primary/30 transition-smooth"></div>
                        </div>
                        <div class="bg-white dark:bg-dark-surface rounded-2xl p-5 border-2 border-pastel-2 dark:border-dark-border shadow-lg group-hover:border-primary group-hover:shadow-xl transition-smooth text-center">
                            <h4 class="font-black text-lg mb-1.5 text-slate-900 dark:text-white">Input Nilai</h4>
                            <p class="text-slate-600 dark:text-dark-muted text-sm leading-relaxed font-medium">Guru menginput nilai siswa</p>
                        </div>
                    </div>

                    <div class="clickable-card group relative">
                        <div class="relative mb-5">
                            <div class="w-16 h-16 bg-gradient-to-br from-primary to-primary-hover rounded-2xl border-4 border-white dark:border-dark-surface flex items-center justify-center mx-auto shadow-xl group-hover:scale-110 group-hover:rotate-6 transition-bouncy relative z-10">
                                <span class="text-2xl font-black text-white">4</span>
                            </div>
                            <div class="absolute inset-0 bg-primary/30 rounded-2xl blur-xl"></div>
                        </div>
                        <div class="bg-gradient-to-br from-primary to-primary-hover rounded-2xl p-5 border-2 border-primary shadow-xl text-center">
                            <h4 class="font-black text-lg mb-1.5 text-white">Lihat Rapor</h4>
                            <p class="text-white/90 text-sm leading-relaxed font-medium">Siswa melihat hasil belajar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <section class="py-20 bg-white dark:bg-dark-surface">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-pastel-4/20 rounded-3xl blur-3xl"></div>
                    <div class="relative bg-gradient-to-br from-pastel-1 to-pastel-3 dark:from-dark-surface2 dark:to-dark-surface3 rounded-3xl p-10 border-2 border-pastel-2 dark:border-dark-border shadow-2xl">
                        <div class="absolute top-6 right-6 w-14 h-14 bg-white/30 dark:bg-white/10 rounded-2xl blur-xl"></div>
                        <div class="absolute bottom-6 left-6 w-16 h-16 bg-primary/20 rounded-full blur-2xl"></div>

                        <div class="relative">
                            <div class="w-20 h-20 bg-gradient-to-br from-primary to-primary-hover rounded-3xl flex items-center justify-center text-white mx-auto mb-6 shadow-2xl shadow-primary/40">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                            </div>
                            <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-2 text-center">Sistem Akademik Mini</h3>
                            <p class="text-slate-600 dark:text-dark-muted text-sm font-bold text-center mb-7">UKK - Rekayasa Perangkat Lunak</p>

                            <div class="grid grid-cols-3 gap-3">
                                <div class="bg-white/60 dark:bg-dark-surface/60 rounded-2xl p-3.5 text-center backdrop-blur">
                                    <div class="text-xl font-black text-primary">3</div>
                                    <div class="text-[11px] font-bold text-slate-600 dark:text-dark-muted">Role</div>
                                </div>
                                <div class="bg-white/60 dark:bg-dark-surface/60 rounded-2xl p-3.5 text-center backdrop-blur">
                                    <div class="text-xl font-black text-primary">6</div>
                                    <div class="text-[11px] font-bold text-slate-600 dark:text-dark-muted">Fitur</div>
                                </div>
                                <div class="bg-white/60 dark:bg-dark-surface/60 rounded-2xl p-3.5 text-center backdrop-blur">
                                    <div class="text-xl font-black text-primary">1</div>
                                    <div class="text-[11px] font-bold text-slate-600 dark:text-dark-muted">Platform</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <span class="inline-block px-4 py-1.5 bg-pastel-1 dark:bg-dark-surface2 text-primary text-xs font-black rounded-full mb-4 border-2 border-primary/20 uppercase tracking-wider">Tentang Sistem</span>
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-5 leading-tight">Sistem Informasi Akademik Sekolah</h2>
                    <p class="text-slate-600 dark:text-dark-muted mb-7 leading-relaxed text-base font-medium">Aplikasi berbasis web untuk membantu sekolah dalam mengelola data akademik dan proses penilaian secara digital dan efisien.</p>

                    <div class="space-y-3">
                        <div class="flex items-start gap-3 p-3 rounded-2xl hover:bg-pastel-1 dark:hover:bg-dark-surface2 transition-smooth">
                            <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center text-white flex-shrink-0 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <div>
                                <p class="text-slate-900 dark:text-white text-sm font-black">Data terpusat</p>
                                <p class="text-slate-600 dark:text-dark-muted text-xs font-medium">Siswa dan guru dalam satu platform</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-2xl hover:bg-pastel-1 dark:hover:bg-dark-surface2 transition-smooth">
                            <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center text-white flex-shrink-0 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <div>
                                <p class="text-slate-900 dark:text-white text-sm font-black">Otomatis</p>
                                <p class="text-slate-600 dark:text-dark-muted text-xs font-medium">Perhitungan nilai otomatis</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-2xl hover:bg-pastel-1 dark:hover:bg-dark-surface2 transition-smooth">
                            <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center text-white flex-shrink-0 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <div>
                                <p class="text-slate-900 dark:text-white text-sm font-black">Digital</p>
                                <p class="text-slate-600 dark:text-dark-muted text-xs font-medium">Rapor digital per semester</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-2xl hover:bg-pastel-1 dark:hover:bg-dark-surface2 transition-smooth">
                            <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center text-white flex-shrink-0 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <div>
                                <p class="text-slate-900 dark:text-white text-sm font-black">Role-based</p>
                                <p class="text-slate-600 dark:text-dark-muted text-xs font-medium">Akses Admin, Guru, Siswa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-primary via-primary-hover to-primary-dark"></div>
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-0 left-1/4 w-80 h-80 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-80 h-80 bg-pastel-4 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-5xl font-black text-white mb-5 leading-tight">Siap Menggunakan Sistem?</h2>
            <p class="text-white/90 mb-8 max-w-xl mx-auto text-base font-medium">Login dengan akun Anda untuk mengakses fitur sesuai role dan hak akses.</p>
            <a href="{{ route('login') }}" class="ripple-btn relative overflow-hidden inline-flex items-center px-8 py-4 bg-white hover:bg-pastel-1 text-primary font-black text-base rounded-2xl shadow-2xl hover:shadow-3xl hover:-translate-y-1 transition-smooth gap-2">
                Masuk Sekarang
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
        </div>
    </section>

    <!-- FOOTER -->
    <footer id="kontak" class="bg-slate-900 dark:bg-black text-slate-400 py-16 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-primary to-transparent"></div>
        <div class="absolute top-20 right-20 w-48 h-48 bg-primary/10 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-xl overflow-hidden bg-white border-2 border-primary shadow-lg">
                            <img src="{{ asset('images/Logo sistem akademik mini.jpeg') }}" alt="Logo" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-white font-black text-xl">Sistem Akademik Mini</h3>
                    </div>
                    <p class="text-slate-400 leading-relaxed max-w-md font-medium mb-5 text-sm">Sistem informasi akademik untuk pengelolaan data sekolah yang efisien dan terorganisir.</p>
                </div>

                <div>
                    <h4 class="text-white font-black text-sm mb-5 uppercase tracking-wider">Menu</h4>
                    <div class="space-y-2.5 text-sm">
                        <a href="#tentang" class="block text-slate-400 hover:text-white hover:translate-x-1 transition-smooth font-medium">Beranda</a>
                        <a href="#fitur" class="block text-slate-400 hover:text-white hover:translate-x-1 transition-smooth font-medium">Fitur</a>
                        <a href="#cara-kerja" class="block text-slate-400 hover:text-white hover:translate-x-1 transition-smooth font-medium">Alur</a>
                        <a href="#kontak" class="block text-slate-400 hover:text-white hover:translate-x-1 transition-smooth font-medium">Kontak</a>
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-black text-sm mb-5 uppercase tracking-wider">Kontak</h4>
                    <div class="space-y-3 text-sm">
                        <p class="flex items-center gap-2.5 font-medium">
                            <svg class="w-4 h-4 text-primary flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Jl. Babakantiga, Bandung
                        </p>
                        <p class="flex items-center gap-2.5 font-medium">
                            <svg class="w-4 h-4 text-primary flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            smkbbc.sch.id
                        </p>
                        <p class="flex items-center gap-2.5 font-medium">
                            <svg class="w-4 h-4 text-primary flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            (022) 5928262
                        </p>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-800 text-center">
                <p class="text-sm text-slate-500 font-medium">&copy; {{ date('Y') }} Sistem Akademik Mini</p>
            </div>
        </div>
    </footer>

    <script>
        function updateThemeIcon() {
            const icon = document.getElementById('themeIcon');
            const isDark = document.documentElement.classList.contains('dark');
            icon.textContent = isDark ? '☀️' : '🌙';
            document.querySelector('meta[name="theme-color"]')?.setAttribute('content', isDark ? '#0B1220' : '#E3F0FA');
        }

        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            try {
                localStorage.setItem('admin-theme', isDark ? 'dark' : 'light');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
            } catch (e) {}
            updateThemeIcon();
        }

        function toggleMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        function createRipple(event) {
            const button = event.currentTarget;
            const circle = document.createElement("span");
            const diameter = Math.max(button.clientWidth, button.clientHeight);
            const rect = button.getBoundingClientRect();

            circle.style.width = circle.style.height = `${diameter}px`;
            circle.style.left = `${event.clientX - rect.left - diameter / 2}px`;
            circle.style.top = `${event.clientY - rect.top - diameter / 2}px`;
            circle.style.backgroundColor = button.classList.contains('bg-white') || button.classList.contains('dark:bg-dark-surface') ? "rgba(91, 141, 184, 0.4)" : "rgba(255, 255, 255, 0.4)";
            circle.classList.add("ripple-effect");

            const ripple = button.getElementsByClassName('ripple-effect')[0];
            if (ripple) ripple.remove();

            button.appendChild(circle);
        }

        document.querySelectorAll('.ripple-btn, .clickable-card').forEach(button => {
            button.addEventListener('click', createRipple);
        });

        updateThemeIcon();
    </script>
</body>
</html>