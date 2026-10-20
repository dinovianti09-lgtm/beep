@extends('layouts.guru')

@section('title', 'Dashboard Guru - Sistem Akademik')

@section('page-title', 'Dashboard Guru')

@section('page-subtitle', 'Kelola aktivitas akademik Anda')

@section('content')

<div class="space-y-6">

    {{-- WELCOME --}}
    <div class="rounded-2xl overflow-hidden shadow-sm border border-blue-500/10">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-7 sm:px-8">
            <div class="flex items-center justify-between gap-6">
                <div>
                    <p class="text-sm font-medium text-blue-100">
                        Selamat datang kembali
                    </p>

                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white mt-1">
                        Halo, {{ $guru->nama_guru }}!
                    </h2>

                    <p class="text-sm text-blue-100 mt-2 max-w-xl">
                        Pantau aktivitas mengajar, data siswa, dan nilai akademik melalui dashboard guru.
                    </p>
                </div>

                <div class="hidden sm:flex w-16 h-16 rounded-2xl bg-white/10 items-center justify-center shrink-0">
                    <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zM5 12v5c3.5 3 10.5 3 14 0v-5M21 9v6"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- STATISTIK UTAMA --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

        {{-- KELAS WALI --}}
        <div class="dashboard-card rounded-2xl border shadow-sm p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium card-muted">Kelas Wali</p>

                    <p class="text-2xl font-extrabold card-title mt-2">
                        {{ $kelasWali->nama_kelas ?? '-' }}
                    </p>

                    <p class="text-xs card-muted mt-1">
                        Kelas yang Anda bimbing
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- JUMLAH SISWA --}}
        <div class="dashboard-card rounded-2xl border shadow-sm p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium card-muted">Jumlah Siswa</p>

                    <p class="text-3xl font-extrabold card-title mt-2">
                        {{ $jumlahSiswaWali }}
                    </p>

                    <p class="text-xs card-muted mt-1">
                        Siswa terdaftar di kelas wali
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- MATA PELAJARAN --}}
        <div class="dashboard-card rounded-2xl border shadow-sm p-5 sm:col-span-2 xl:col-span-1">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium card-muted">Mata Pelajaran</p>

                    <p class="text-2xl font-extrabold card-title mt-2">
                        {{ $guru->mapel_diampu ?? '-' }}
                    </p>

                    <p class="text-xs card-muted mt-1">
                        Mata pelajaran yang diampu
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-violet-50 dark:bg-violet-500/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-violet-600 dark:text-violet-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                    </svg>
                </div>
            </div>
        </div>

    </div>

    {{-- DAFTAR SISWA --}}
    <div class="dashboard-card rounded-2xl border shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b table-border flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h3 class="text-base font-bold card-title">Daftar Siswa</h3>
                <p class="text-xs card-muted mt-1">
                    Data siswa yang terdaftar di kelas wali Anda
                </p>
            </div>

            <span class="inline-flex items-center w-fit px-3 py-1.5 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-700 dark:text-blue-300 text-xs font-semibold">
                {{ $jumlahSiswaWali }} Siswa
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="table-header">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">No</th>
                        <th class="px-6 py-4 text-left font-semibold">NIS</th>
                        <th class="px-6 py-4 text-left font-semibold">Nama Siswa</th>
                        <th class="px-6 py-4 text-left font-semibold">Kelas</th>
                        <th class="px-6 py-4 text-left font-semibold">Jenis Kelamin</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($siswaWali as $index => $siswa)
                        <tr class="table-row border-t table-border">
                            <td class="px-6 py-4 table-text">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-6 py-4 table-text">
                                {{ $siswa->nis ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-500/10 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                            <circle cx="12" cy="8" r="4"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 21a8 8 0 0 1 16 0"/>
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="font-semibold table-text">
                                            {{ $siswa->nama_siswa }}
                                        </p>
                                        <p class="text-xs card-muted">Siswa</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-700 dark:text-blue-300 text-xs font-semibold">
                                    {{ $siswa->kelas ?? '-' }}
                                </span>
                            </td>

                            <td class="px-6 py-4 table-text">
                                {{ $siswa->jenis_kelamin ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6 card-muted" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 0 0-5-3.87M9 20H2v-2a4 4 0 0 1 7.75-1.4M15 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                        </svg>
                                    </div>

                                    <p class="font-semibold table-text">
                                        Belum ada data siswa
                                    </p>

                                    <p class="text-xs card-muted mt-1">
                                        Belum ada siswa yang terdaftar di kelas wali Anda.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>

    {{-- MENU CEPAT --}}
    <div>
        <div class="mb-4">
            <h3 class="text-base font-bold card-title">Menu Cepat</h3>
            <p class="text-xs card-muted mt-1">
                Akses fitur akademik yang sering digunakan
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

            {{-- INPUT NILAI --}}
            <a href="{{ route('guru.nilai.create') }}"
                class="dashboard-card group rounded-2xl border shadow-sm p-5 flex items-center gap-4 transition duration-300 hover:-translate-y-1 hover:shadow-md">
                <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                    </svg>
                </div>

                <div class="flex-1">
                    <h4 class="font-bold card-title">Input Nilai</h4>
                    <p class="text-xs card-muted mt-1">
                        Masukkan nilai siswa
                    </p>
                </div>

                <svg class="w-5 h-5 card-muted group-hover:text-blue-600 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>

            {{-- REKAP NILAI --}}
            <a href="{{ route('guru.rekap.index') }}"
                class="dashboard-card group rounded-2xl border shadow-sm p-5 flex items-center gap-4 transition duration-300 hover:-translate-y-1 hover:shadow-md">
                <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 19V5M4 19h16M8 16v-5M12 16V8M16 16v-3"/>
                    </svg>
                </div>

                <div class="flex-1">
                    <h4 class="font-bold card-title">Rekap Nilai</h4>
                    <p class="text-xs card-muted mt-1">
                        Lihat rekap nilai akademik siswa
                    </p>
                </div>

                <svg class="w-5 h-5 card-muted group-hover:text-indigo-600 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>

        </div>
    </div>

    {{-- FOOTER --}}
    <div class="text-center pt-2 pb-4">
        <p class="text-xs card-muted">
            Sistem Akademik Mini
        </p>
        <p class="text-xs card-muted mt-1">
            Kelola aktivitas akademik sekolah dengan mudah dan terstruktur.
        </p>
    </div>

</div>

@endsection