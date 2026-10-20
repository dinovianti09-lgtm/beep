<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Guru - Sistem Akademik Mini</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 600ms linear;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        .transition-smooth {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .gradient-secondary {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .gradient-success {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .gradient-warning {
            background: linear-gradient(135deg, #fbbf24 0%, #f97316 100%);
        }

        .nav-item-active {
            background: linear-gradient(
                90deg,
                rgba(99, 102, 241, 0.15) 0%,
                transparent 100%
            );

            border-left: 3px solid #6366f1;
            color: #6366f1;
        }
    </style>
</head>

<body class="bg-slate-50 font-sans antialiased">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-72 bg-slate-900 text-slate-300 flex flex-col min-h-screen shadow-2xl">

        <!-- LOGO -->
        <div class="p-6 border-b border-slate-800">

            <div class="flex items-center space-x-3">

                <div class="relative">

                    <div class="absolute inset-0 bg-indigo-500 rounded-xl blur opacity-30"></div>

                    <div class="relative w-10 h-10 rounded-xl bg-white p-1 shadow-lg flex items-center justify-center text-xl">
                        🎓
                    </div>

                </div>

                <span class="font-bold text-sm tracking-wide text-white leading-tight">
                    Sistem Akademik<br>
                    Mini
                </span>

            </div>

        </div>


        <!-- MENU -->
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">

            <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-2">
                Menu Guru
            </p>


            <!-- DASHBOARD -->
            <a
                href="{{ route('guru.dashboard') }}"
                class="ripple-btn relative flex items-center space-x-3 px-4 py-3 rounded-xl nav-item-active font-medium text-sm overflow-hidden"
            >

                <svg
                    class="w-5 h-5 text-indigo-500"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                    />
                </svg>

                <span>Beranda Guru</span>

            </a>


            <!-- INPUT NILAI -->
            <a
                href="{{ route('guru.nilai.create') }}"
                class="ripple-btn relative flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white font-medium text-sm transition-smooth group overflow-hidden"
            >

                <svg
                    class="w-5 h-5 group-hover:text-white transition-smooth"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                    />
                </svg>

                <span>Input Nilai Siswa</span>

            </a>


            <!-- REKAP NILAI -->
            <a
                href="{{ route('guru.rekap.index') }}"
                class="ripple-btn relative flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white font-medium text-sm transition-smooth group overflow-hidden"
            >

                <svg
                    class="w-5 h-5 group-hover:text-white transition-smooth"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                    />
                </svg>

                <span>Rekap Nilai</span>

            </a>

        </nav>


        <!-- LOGOUT -->
        <div class="p-4 border-t border-slate-800">

            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="ripple-btn relative w-full flex items-center space-x-3 px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/10 hover:text-red-400 font-medium text-sm transition-smooth group text-left overflow-hidden"
                >

                    <svg
                        class="w-5 h-5 group-hover:text-red-400 transition-smooth"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                        />
                    </svg>

                    <span>Logout</span>

                </button>

            </form>

        </div>

    </aside>


    <!-- CONTENT -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        <!-- HEADER -->
        <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 px-8 py-6 flex items-center justify-between sticky top-0 z-20">

            <div>

                <h1 class="text-2xl font-bold text-slate-800">
                    Dashboard Guru
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Selamat datang di Sistem Akademik Mini
                </p>

            </div>


            <div class="flex items-center space-x-4">

                <div class="text-right hidden sm:block">

                    <p class="text-sm font-semibold text-slate-700">
                        {{ ucfirst(auth()->user()->username) }}
                    </p>

                    <p class="text-xs text-slate-500">
                        Guru
                    </p>

                </div>


                <div class="w-10 h-10 rounded-full gradient-primary flex items-center justify-center text-white font-bold text-sm shadow-lg">

                    {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}

                </div>

            </div>

        </header>


        <!-- MAIN -->
        <main class="p-8 overflow-y-auto flex-1">


            <!-- WELCOME -->
            <div class="mb-6">

                <h2 class="text-xl font-bold text-slate-800">
                    Selamat Datang, {{ ucfirst(auth()->user()->username) }} 👋
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Kelola nilai dan pantau data akademik siswa dari halaman Guru.
                </p>

            </div>


            <!-- STATISTIK -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">


                <!-- TOTAL SISWA -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500 mb-1">
                                Total Siswa
                            </p>

                            <h3 class="text-3xl font-bold text-slate-800">
                                {{ \App\Models\Siswa::count() }}
                            </h3>

                            <p class="text-xs text-slate-400 mt-1">
                                Siswa terdaftar
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl gradient-success flex items-center justify-center shadow-lg">

                            <svg
                                class="w-6 h-6 text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                <!-- TOTAL MAPEL -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500 mb-1">
                                Total Mapel
                            </p>

                            <h3 class="text-3xl font-bold text-slate-800">
                                {{ \App\Models\Mapel::count() }}
                            </h3>

                            <p class="text-xs text-slate-400 mt-1">
                                Mata pelajaran tersedia
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl gradient-secondary flex items-center justify-center shadow-lg">

                            <svg
                                class="w-6 h-6 text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                <!-- NILAI -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500 mb-1">
                                Nilai Masuk
                            </p>

                            <h3 class="text-3xl font-bold text-amber-600">
                                {{ \App\Models\Nilai::count() }}
                            </h3>

                            <p class="text-xs text-slate-400 mt-1">
                                Data nilai tersimpan
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl gradient-warning flex items-center justify-center shadow-lg">

                            <svg
                                class="w-6 h-6 text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                <!-- PERIODE RAPOR -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500 mb-1">
                                Periode Rapor
                            </p>

                            <h3 class="text-3xl font-bold text-indigo-600">
                                {{ \App\Models\Rapor::count() }}
                            </h3>

                            <p class="text-xs text-slate-400 mt-1">
                                Periode tersedia
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl gradient-primary flex items-center justify-center shadow-lg">

                            <svg
                                class="w-6 h-6 text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>

                        </div>

                    </div>

                </div>

            </div>


            <!-- MENU UTAMA GURU -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


                <!-- INPUT NILAI -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                    <div class="flex items-start gap-4">

                        <div class="w-12 h-12 rounded-xl gradient-primary flex items-center justify-center shrink-0">

                            <svg
                                class="w-6 h-6 text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                />
                            </svg>

                        </div>

                        <div class="flex-1">

                            <h2 class="text-lg font-bold text-slate-800">
                                Input Nilai Siswa
                            </h2>

                            <p class="text-sm text-slate-500 mt-1 mb-4">
                                Masukkan nilai harian, UTS, dan UAS siswa.
                            </p>

                            <a
                                href="{{ route('guru.nilai.create') }}"
                                class="inline-flex items-center px-4 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition-smooth"
                            >
                                Input Nilai
                                <span class="ml-2">→</span>
                            </a>

                        </div>

                    </div>

                </div>


                <!-- REKAP NILAI -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                    <div class="flex items-start gap-4">

                        <div class="w-12 h-12 rounded-xl gradient-success flex items-center justify-center shrink-0">

                            <svg
                                class="w-6 h-6 text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                />
                            </svg>

                        </div>

                        <div class="flex-1">

                            <h2 class="text-lg font-bold text-slate-800">
                                Rekap Nilai
                            </h2>

                            <p class="text-sm text-slate-500 mt-1 mb-4">
                                Lihat dan pantau data nilai siswa yang sudah dimasukkan.
                            </p>

                            <a
                                href="{{ route('guru.rekap.index') }}"
                                class="inline-flex items-center px-4 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition-smooth"
                            >
                                Lihat Rekap
                                <span class="ml-2">→</span>
                            </a>

                        </div>

                    </div>

                </div>

            </div>


            <!-- INFORMASI -->
            <div class="mt-6 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <div class="flex items-start gap-4">

                    <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center shrink-0">

                        <svg
                            class="w-5 h-5 text-indigo-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>

                    </div>

                    <div>

                        <h3 class="font-semibold text-slate-800">
                            Informasi Guru
                        </h3>

                        <p class="text-sm text-slate-500 mt-1 leading-relaxed">
                            Gunakan menu Input Nilai untuk memasukkan nilai siswa.
                            Setelah nilai tersimpan, data dapat dilihat melalui menu Rekap Nilai.
                        </p>

                    </div>

                </div>

            </div>

        </main>

    </div>

</div>


<!-- RIPPLE EFFECT -->
<script>
    document.addEventListener('DOMContentLoaded', function () {

        function createRipple(event) {

            const button = event.currentTarget;

            const circle = document.createElement('span');

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

            circle.style.backgroundColor =
                "rgba(99, 102, 241, 0.2)";

            circle.classList.add('ripple-effect');

            const ripple =
                button.getElementsByClassName('ripple-effect')[0];

            if (ripple) {
                ripple.remove();
            }

            button.appendChild(circle);
        }

        const buttons =
            document.querySelectorAll('.ripple-btn');

        for (const button of buttons) {
            button.addEventListener('click', createRipple);
        }

    });
</script>

</body>
</html>