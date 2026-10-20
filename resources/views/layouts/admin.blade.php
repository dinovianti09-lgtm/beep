<?php
// File: resources/views/layouts/admin.blade.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard Admin - Sistem Akademik Mini')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        if (localStorage.getItem('admin-theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif']
                    }
                }
            }
        };
    </script>

    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: #f5f7fb;
        }

        .dark body {
            background: #0b1220;
            color: #e5e7eb;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            color: #cbd5e1;
            transition: all .2s ease;
        }

        .sidebar-link:hover {
            background: rgba(255,255,255,.08);
            color: #fff;
        }

        .sidebar-active {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            color: #fff !important;
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            box-shadow: 0 8px 20px rgba(37,99,235,.18);
        }

        .main-card {
            background: #fff;
            border: 1px solid #e8edf5;
            border-radius: 18px;
        }

        .dark .main-card {
            background: #111c2e;
            border-color: #253249;
        }

        .dark .page-surface {
            background: #0b1220;
        }

        .dark .text-slate-800,
        .dark .text-slate-900 {
            color: #f1f5f9 !important;
        }

        .dark .text-slate-600,
        .dark .text-slate-500 {
            color: #a8b4c7 !important;
        }

        .dark input,
        .dark select,
        .dark textarea {
            background-color: #0f172a;
            color: #e5e7eb;
            border-color: #334155;
        }

        .transition-smooth {
            transition: all .2s ease;
        }

        .sidebar-scroll {
            scrollbar-width: thin;
            scrollbar-color: #334155 transparent;
        }

        @media (max-width: 767px) {
            .admin-sidebar {
                width: 250px;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="min-h-screen text-slate-800">

<div class="min-h-screen md:flex">

    {{-- SIDEBAR --}}
    <aside class="admin-sidebar w-full md:w-64 bg-[#101a2d] text-white flex flex-col md:min-h-screen">

        {{-- LOGO --}}
        <div class="px-6 py-6 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center overflow-hidden flex-shrink-0">
                    <img
                        src="{{ asset('images/Logo sistem akademik mini.jpeg') }}"
                        alt="Logo Sistem Akademik Mini"
                        class="w-full h-full object-contain"
                    >
                </div>

                <div>
                    <h1 class="text-sm font-extrabold tracking-wide">Sistem Akademik</h1>
                    <p class="text-xs text-slate-400 mt-1">Mini • Administrator</p>
                </div>
            </div>
        </div>

        {{-- PROFIL SINGKAT --}}
        <div class="px-5 py-5">
            <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5 border border-white/5">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center font-bold text-white flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->username ?? 'A', 0, 1)) }}
                </div>

                <div class="min-w-0">
                    <p class="text-sm font-bold truncate">
                        {{ ucfirst(auth()->user()->username ?? 'Admin') }}
                    </p>
                    <p class="text-xs text-slate-400 mt-1">Administrator</p>
                </div>
            </div>
        </div>

        {{-- MENU NAVIGASI --}}
        <nav class="flex-1 px-4 pb-5 overflow-y-auto sidebar-scroll">

            {{-- MENU UTAMA --}}
            <p class="px-3 mb-3 text-[10px] font-extrabold tracking-[.18em] uppercase text-slate-500">
                Menu Utama
            </p>

            <a
                href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'sidebar-active' : 'sidebar-link' }} mb-2"
            >
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V10Z"/>
                </svg>
                <span class="text-sm font-medium">Dashboard</span>
            </a>

            {{-- DATA MASTER --}}
            <p class="px-3 mt-7 mb-3 text-[10px] font-extrabold tracking-[.18em] uppercase text-slate-500">
                Data Master
            </p>

            {{-- MATA PELAJARAN --}}
            <a
                href="{{ route('admin.mapel.index') }}"
                class="{{ request()->routeIs('admin.mapel.*') ? 'sidebar-active' : 'sidebar-link' }} mb-2"
            >
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21V5.5Z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 17a2.5 2.5 0 0 1 2.5-2.5H20"/>
                </svg>
                <span class="text-sm font-medium">Mata Pelajaran</span>
            </a>

            {{-- DATA GURU --}}
            <a
                href="{{ route('admin.guru.index') }}"
                class="{{ request()->routeIs('admin.guru.*') ? 'sidebar-active' : 'sidebar-link' }} mb-2"
            >
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="10" cy="7" r="4"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 8v6m-3-3h6"/>
                </svg>
                <span class="text-sm font-medium">Data Guru</span>
            </a>

            {{-- DATA KELAS --}}
            <a
                href="{{ route('admin.kelas.index') }}"
                class="{{ request()->routeIs('admin.kelas.*') ? 'sidebar-active' : 'sidebar-link' }} mb-2"
            >
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h18v14H3z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M9 5v14"/>
                </svg>
                <span class="text-sm font-medium">Data Kelas</span>
            </a>

            {{-- DATA SISWA --}}
            <a
                href="{{ route('admin.siswa.index') }}"
                class="{{ request()->routeIs('admin.siswa.*') ? 'sidebar-active' : 'sidebar-link' }} mb-2"
            >
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/>
                    <circle cx="10" cy="7" r="4"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 8v6m-3-3h6"/>
                </svg>
                <span class="text-sm font-medium">Data Siswa</span>
            </a>

            {{-- AKADEMIK --}}
            <p class="px-3 mt-7 mb-3 text-[10px] font-extrabold tracking-[.18em] uppercase text-slate-500">
                Akademik
            </p>

            {{-- DATA NILAI --}}
            <a
                href="{{ route('admin.nilai.index') }}"
                class="{{ request()->routeIs('admin.nilai.*') ? 'sidebar-active' : 'sidebar-link' }} mb-2"
            >
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 3h14v18H5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 8h8M8 12h8M8 16h5"/>
                </svg>
                <span class="text-sm font-medium">Data Nilai</span>
            </a>

            {{-- PERIODE RAPOR --}}
            <a
                href="{{ route('admin.rapor.index') }}"
                class="{{ request()->routeIs('admin.rapor.*') && !request()->routeIs('admin.rapor_siswa.*') ? 'sidebar-active' : 'sidebar-link' }} mb-2"
            >
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h9l3 3v15H6V3Z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 3v4h3M9 12h6M9 16h6"/>
                </svg>
                <span class="text-sm font-medium">Periode Rapor</span>
            </a>

            {{-- DATA RAPOR SISWA --}}
            <a
                href="{{ route('admin.rapor_siswa.index') }}"
                class="{{ request()->routeIs('admin.rapor_siswa.*') ? 'sidebar-active' : 'sidebar-link' }} mb-2"
            >
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h9l3 3v15H6V3Z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 3v4h4M9 12h6M9 16h6"/>
                </svg>
                <span class="text-sm font-medium">Data Rapor Siswa</span>
            </a>

            {{-- AKUN --}}
            <p class="px-3 mt-7 mb-3 text-[10px] font-extrabold tracking-[.18em] uppercase text-slate-500">
                Akun
            </p>

            {{-- PROFIL ADMIN --}}
            <a
                href="{{ route('admin.profil') }}"
                class="{{ request()->routeIs('admin.profil') ? 'sidebar-active' : 'sidebar-link' }} mb-2"
            >
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 21a8 8 0 0 1 16 0"/>
                </svg>
                <span class="text-sm font-medium">Profil Admin</span>
            </a>

            {{-- LOGOUT --}}
            <form action="{{ route('logout') }}" method="POST" class="mt-2">
                @csrf

                <button
                    type="submit"
                    class="sidebar-link w-full text-left hover:!bg-red-500/10 hover:!text-red-400"
                    onclick="return confirm('Yakin ingin keluar dari akun?')"
                >
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 17l5-5-5-5M15 12H3"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7"/>
                    </svg>
                    <span class="text-sm font-medium">Logout</span>
                </button>
            </form>

        </nav>

        {{-- SIDEBAR FOOTER --}}
        <div class="px-5 py-4 border-t border-white/10">
            <p class="text-[11px] text-slate-500 text-center">
                © {{ date('Y') }} Sistem Akademik Mini
            </p>
        </div>
    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="flex-1 min-w-0 page-surface">

        {{-- TOPBAR --}}
        <header class="sticky top-0 z-30 bg-white/90 dark:bg-[#111c2e]/95 backdrop-blur border-b border-slate-200 dark:border-slate-700">
            <div class="px-5 md:px-8 py-4 flex items-center justify-between gap-4">

                <div class="min-w-0">
                    <h2 class="text-lg md:text-xl font-extrabold text-slate-900 truncate">
                        @yield('page-title', 'Dashboard')
                    </h2>
                    <p class="text-xs md:text-sm text-slate-500 mt-1 truncate">
                        @yield('page-subtitle', 'Sistem Akademik Mini')
                    </p>
                </div>

                <div class="flex items-center gap-3 flex-shrink-0">
                    <button
                        type="button"
                        id="adminThemeToggle"
                        class="w-10 h-10 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 hover:bg-slate-100 dark:hover:bg-slate-700 flex items-center justify-center transition-smooth"
                        aria-label="Ganti tema"
                        title="Ganti tema"
                    >
                        <svg id="themeSun" class="w-5 h-5 hidden dark:block text-amber-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M2 12h2m16 0h2M4.93 19.07l1.42-1.42m11.3-11.3 1.42-1.42"/>
                        </svg>

                        <svg id="themeMoon" class="w-5 h-5 block dark:hidden text-slate-700" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.9 13A9 9 0 0 1 11 3.1 9 9 0 1 0 20.9 13Z"/>
                        </svg>
                    </button>

                    <div class="hidden sm:block text-right">
                        <p class="text-sm font-bold text-slate-800 dark:text-slate-100">
                            {{ ucfirst(auth()->user()->username ?? 'Admin') }}
                        </p>
                        <p class="text-xs text-slate-500">Administrator</p>
                    </div>
                </div>

            </div>
        </header>

        {{-- ISI HALAMAN --}}
        <div class="px-5 md:px-8 py-6 md:py-8">
            @if(session('success'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 dark:bg-emerald-900/20 dark:border-emerald-800 dark:text-emerald-300">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700 dark:bg-red-900/20 dark:border-red-800 dark:text-red-300">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 dark:bg-red-900/20 dark:border-red-800 dark:text-red-300">
                    <p class="font-bold mb-2">Ada data yang perlu diperbaiki:</p>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>

    </main>
</div>

<script>
    const themeToggle = document.getElementById('adminThemeToggle');

    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            const isDark = document.documentElement.classList.toggle('dark');

            localStorage.setItem('admin-theme', isDark ? 'dark' : 'light');
        });
    }
</script>

@stack('scripts')

</body>
</html>