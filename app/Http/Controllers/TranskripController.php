<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Rapor Saya - Sistem Akademik Mini</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .transition-smooth {
            transition: all 0.3s ease;
        }

        .gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .nav-item-active {
            background: rgba(99, 102, 241, 0.15);
            color: white;
            border-left: 3px solid #6366f1;
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        @media print {
            aside,
            header,
            .no-print {
                display: none !important;
            }

            main {
                padding: 0 !important;
            }

            body {
                background: white !important;
            }
        }
    </style>
</head>

<body class="bg-slate-50 antialiased">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-72 bg-slate-900 text-slate-300 flex flex-col min-h-screen shadow-2xl">

        <!-- LOGO -->
        <div class="p-6 border-b border-slate-800">
            <div class="flex items-center space-x-3">

                <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-xl shadow-lg">
                    🎓
                </div>

                <span class="font-bold text-sm tracking-wide text-white leading-tight">
                    Sistem Akademik<br>
                    Mini
                </span>

            </div>
        </div>


        <!-- MENU -->
        <nav class="flex-1 p-4 space-y-1">

            <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-2">
                Menu Siswa
            </p>


            <!-- DASHBOARD -->
            <a
                href="{{ route('siswa.dashboard') }}"
                class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white font-medium text-sm transition-smooth"
            >

                <svg
                    class="w-5 h-5"
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

                <span>Beranda Siswa</span>

            </a>


            <!-- RAPOR AKTIF -->
            <a
                href="#"
                class="nav-item-active flex items-center space-x-3 px-4 py-3 rounded-xl font-medium text-sm"
            >

                <svg
                    class="w-5 h-5 text-indigo-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293 1.707l-5.414 5.414A1 1 0 0115 19H7z"
                    />
                </svg>

                <span>Lihat Rapor Saya</span>

            </a>

        </nav>


        <!-- USER -->
        <div class="px-4 pb-4">

            <div class="bg-slate-800 rounded-xl p-4">

                <p class="text-xs text-slate-500 mb-1">
                    Login sebagai
                </p>

                <p class="text-sm font-semibold text-white truncate">
                    {{ $siswa ? $siswa->nama_siswa : ucfirst(auth()->user()->username) }}
                </p>

                <p class="text-xs text-slate-400 mt-1">
                    Siswa
                </p>

            </div>

        </div>


        <!-- LOGOUT -->
        <div class="p-4 border-t border-slate-800">

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button
                    type="submit"
                    class="w-full flex items-center space-x-3 px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/10 font-medium text-sm transition-smooth"
                >

                    <svg
                        class="w-5 h-5"
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
        <header class="bg-white border-b border-slate-200 px-8 py-6 flex items-center justify-between">

            <div>

                <h1 class="text-2xl font-bold text-slate-800">
                    Rapor Saya
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Daftar nilai akademik kamu
                </p>

            </div>


            <div class="flex items-center space-x-4">

                <div class="text-right hidden sm:block">

                    <p class="text-sm font-semibold text-slate-700">
                        {{ $siswa ? $siswa->nama_siswa : ucfirst(auth()->user()->username) }}
                    </p>

                    <p class="text-xs text-slate-500">
                        Siswa
                    </p>

                </div>


                <div class="w-10 h-10 rounded-full gradient-primary flex items-center justify-center text-white font-bold text-sm shadow-lg">

                    {{ $siswa ? strtoupper(substr($siswa->nama_siswa, 0, 2)) : strtoupper(substr(auth()->user()->username, 0, 2)) }}

                </div>

            </div>

        </header>


        <!-- MAIN -->
        <main class="p-8 overflow-y-auto flex-1">

            <!-- PROFILE -->
            <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-600 rounded-2xl p-6 mb-6 shadow-lg text-white">

                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">

                    <div>

                        <p class="text-indigo-100 text-sm mb-1">
                            Data Siswa
                        </p>

                        <h2 class="text-2xl font-bold">
                            {{ $siswa ? $siswa->nama_siswa : 'Data siswa belum tersedia' }}
                        </h2>

                        <p class="text-indigo-100 text-sm mt-2">
                            NIS:
                            {{ $siswa ? $siswa->nis : '-' }}
                        </p>

                    </div>


                    <div class="flex gap-3 no-print">

                        <a
                            href="{{ route('siswa.dashboard') }}"
                            class="bg-white text-indigo-600 font-bold px-5 py-3 rounded-xl text-sm shadow-lg hover:bg-indigo-50 transition-smooth"
                        >
                            Kembali
                        </a>

                        <button
                            onclick="window.print()"
                            class="bg-indigo-900/40 text-white font-bold px-5 py-3 rounded-xl text-sm hover:bg-indigo-900/60 transition-smooth"
                        >
                            Cetak Rapor
                        </button>

                    </div>

                </div>

            </div>


            <!-- PERIODE -->
            @if(isset($rapor))

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">

                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    Periode Rapor
                </p>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mt-2">

                    <div>
                        <h2 class="text-lg font-bold text-slate-800">
                            Semester {{ $rapor->semester }}
                        </h2>

                        <p class="text-sm text-slate-500">
                            Tahun Ajaran {{ $rapor->tahun_ajaran }}
                        </p>
                    </div>

                    @if(isset($raporSiswa))
                        <p class="text-sm text-slate-500">
                            Tanggal cetak:
                            <span class="font-semibold text-slate-700">
                                {{ $raporSiswa->tgl_cetak ?? '-' }}
                            </span>
                        </p>
                    @endif

                </div>

            </div>

            @endif


            <!-- TABEL NILAI -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="p-6 border-b border-slate-200">

                    <h2 class="text-lg font-bold text-slate-800">
                        Daftar Nilai
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Nilai yang sudah diinput oleh guru
                    </p>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-slate-50 border-b border-slate-200">

                            <tr>

                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                                    No
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                                    Mata Pelajaran
                                </th>

                                <th class="px-6 py-4 text-center text-xs font-semibold text-slate-500 uppercase">
                                    Harian
                                </th>

                                <th class="px-6 py-4 text-center text-xs font-semibold text-slate-500 uppercase">
                                    UTS
                                </th>

                                <th class="px-6 py-4 text-center text-xs font-semibold text-slate-500 uppercase">
                                    UAS
                                </th>

                                <th class="px-6 py-4 text-center text-xs font-semibold text-slate-500 uppercase">
                                    Nilai Akhir
                                </th>

                                <th class="px-6 py-4 text-center text-xs font-semibold text-slate-500 uppercase">
                                    Predikat
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @forelse($nilais as $index => $nilai)

                            <tr class="hover:bg-slate-50 transition-smooth">

                                <td class="px-6 py-4 text-slate-500">
                                    {{ $index + 1 }}
                                </td>


                                <td class="px-6 py-4">

                                    <p class="font-semibold text-slate-800">
                                        {{ $nilai->mapel->nama_mapel ?? '-' }}
                                    </p>

                                </td>


                                <td class="px-6 py-4 text-center text-slate-700">
                                    {{ $nilai->nilai_harian ?? '-' }}
                                </td>


                                <td class="px-6 py-4 text-center text-slate-700">
                                    {{ $nilai->nilai_uts ?? '-' }}
                                </td>


                                <td class="px-6 py-4 text-center text-slate-700">
                                    {{ $nilai->nilai_uas ?? '-' }}
                                </td>


                                <td class="px-6 py-4 text-center">

                                    <span class="font-bold text-indigo-600">
                                        {{ $nilai->nilai_akhir !== null ? number_format($nilai->nilai_akhir, 1) : '-' }}
                                    </span>

                                </td>


                                <td class="px-6 py-4 text-center">

                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700">
                                        {{ $nilai->predikat ?? '-' }}
                                    </span>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="7" class="px-6 py-12 text-center">

                                    <div class="text-4xl mb-3">
                                        📚
                                    </div>

                                    <p class="font-semibold text-slate-700">
                                        Belum ada nilai
                                    </p>

                                    <p class="text-sm text-slate-500 mt-1">
                                        Nilai kamu belum diinput oleh guru.
                                    </p>

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </main>

    </div>

</div>

</body>
</html>