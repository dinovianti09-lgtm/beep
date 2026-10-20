@extends('layouts.admin')

@section('title', 'Dashboard Admin - Sistem Akademik')

@section('page-title', 'Dashboard Admin')

@section('page-subtitle', 'Kelola dan pantau sistem akademik sekolah')

@section('content')

<div class="space-y-6">

    {{-- =========================
        WELCOME
    ========================== --}}
    <div class="rounded-2xl overflow-hidden shadow-sm border border-blue-500/10">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-7 sm:px-8">
            <div class="flex items-center justify-between gap-6">

                <div>
                    <p class="text-sm font-medium text-blue-100">
                        Selamat datang kembali
                    </p>

                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white mt-1">
                        Halo, {{ $namaSiswa }}!
                    </h2>

                    <p class="text-sm text-blue-100 mt-2 max-w-xl">
                        Kelola dan pantau seluruh data akademik sekolah melalui dashboard admin.
                    </p>
                </div>

                {{-- ICON --}}
                <div class="hidden sm:flex w-16 h-16 rounded-2xl bg-white/10 items-center justify-center">
                    <svg
                        class="w-9 h-9 text-white"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 21h18M4 21V9l8-5 8 5v12M9 21v-6h6v6M7 10h.01M12 10h.01M17 10h.01"
                        />
                    </svg>
                </div>

            </div>
        </div>
    </div>


    {{-- =========================
        STATISTIK UTAMA
    ========================== --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        {{-- TOTAL GURU --}}
        <div class="dashboard-card rounded-2xl border shadow-sm p-5">
            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium card-muted">
                        Total Guru
                    </p>

                    <p class="text-3xl font-extrabold card-title mt-2">
                        {{ $jumlahGuru }}
                    </p>

                    <p class="text-xs card-muted mt-1">
                        Guru terdaftar
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center">
                    <svg
                        class="w-6 h-6 text-blue-600 dark:text-blue-400"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                        />
                        <circle cx="9" cy="7" r="4"/>
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"
                        />
                    </svg>
                </div>

            </div>
        </div>


        {{-- TOTAL SISWA --}}
        <div class="dashboard-card rounded-2xl border shadow-sm p-5">
            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium card-muted">
                        Total Siswa
                    </p>

                    <p class="text-3xl font-extrabold card-title mt-2">
                        {{ $jumlahSiswa }}
                    </p>

                    <p class="text-xs card-muted mt-1">
                        Siswa terdaftar
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center">
                    <svg
                        class="w-6 h-6 text-indigo-600 dark:text-indigo-400"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"
                        />
                        <circle cx="9" cy="7" r="4"/>
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"
                        />
                    </svg>
                </div>

            </div>
        </div>


        {{-- TOTAL KELAS --}}
        <div class="dashboard-card rounded-2xl border shadow-sm p-5">
            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium card-muted">
                        Total Kelas
                    </p>

                    <p class="text-3xl font-extrabold card-title mt-2">
                        {{ $jumlahKelas }}
                    </p>

                    <p class="text-xs card-muted mt-1">
                        Kelas tersedia
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-sky-50 dark:bg-sky-500/10 flex items-center justify-center">
                    <svg
                        class="w-6 h-6 text-sky-600 dark:text-sky-400"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5M9 10h.01M12 10h.01M15 10h.01"
                        />
                    </svg>
                </div>

            </div>
        </div>


        {{-- TOTAL MAPEL --}}
        <div class="dashboard-card rounded-2xl border shadow-sm p-5">
            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium card-muted">
                        Mata Pelajaran
                    </p>

                    <p class="text-3xl font-extrabold card-title mt-2">
                        {{ $jumlahMapel }}
                    </p>

                    <p class="text-xs card-muted mt-1">
                        Mapel tersedia
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-violet-50 dark:bg-violet-500/10 flex items-center justify-center">
                    <svg
                        class="w-6 h-6 text-violet-600 dark:text-violet-400"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"
                        />
                    </svg>
                </div>

            </div>
        </div>

    </div>


    {{-- =========================
        RINGKASAN NILAI
    ========================== --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        {{-- RATA-RATA NILAI --}}
        <div class="dashboard-card rounded-2xl border shadow-sm p-5">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center shrink-0">
                    <svg
                        class="w-6 h-6 text-emerald-600 dark:text-emerald-400"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 3v18h18"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M7 16l4-5 3 3 6-7"
                        />
                    </svg>
                </div>

                <div>
                    <p class="text-sm font-medium card-muted">
                        Rata-rata Nilai
                    </p>

                    <p class="text-2xl font-extrabold card-title mt-1">
                        {{ number_format($avgNilai, 2) }}
                    </p>

                    <p class="text-xs card-muted mt-1">
                        Dari seluruh data nilai
                    </p>
                </div>

            </div>

        </div>


        {{-- MAPEL DINILAI --}}
        <div class="dashboard-card rounded-2xl border shadow-sm p-5">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center shrink-0">
                    <svg
                        class="w-6 h-6 text-amber-600 dark:text-amber-400"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"
                        />
                    </svg>
                </div>

                <div>
                    <p class="text-sm font-medium card-muted">
                        Mata Pelajaran Dinilai
                    </p>

                    <p class="text-2xl font-extrabold card-title mt-1">
                        {{ $totalMapelDinilai }}
                    </p>

                    <p class="text-xs card-muted mt-1">
                        Mapel yang sudah memiliki nilai
                    </p>
                </div>

            </div>

        </div>

    </div>


    {{-- =========================
        GURU TERBARU
    ========================== --}}
    <div class="dashboard-card rounded-2xl border shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b table-border flex items-center justify-between gap-4">

            <div>
                <h3 class="text-base font-bold card-title">
                    Guru Terbaru
                </h3>

                <p class="text-xs card-muted mt-1">
                    Data guru yang terakhir ditambahkan
                </p>
            </div>

            <a
                href="{{ route('admin.guru.index') }}"
                class="text-sm font-semibold text-blue-600 dark:text-blue-400 hover:underline"
            >
                Lihat Semua
            </a>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="table-header">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">
                            No
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Guru
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            NIP
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Mata Pelajaran
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($guruList as $index => $guru)

                        <tr class="table-row border-t table-border">

                            <td class="px-6 py-4 table-text">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-500/10 flex items-center justify-center shrink-0">
                                        <svg
                                            class="w-5 h-5 text-blue-600 dark:text-blue-400"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            viewBox="0 0 24 24"
                                        >
                                            <circle cx="12" cy="8" r="4"/>
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M4 21a8 8 0 0 1 16 0"
                                            />
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="font-semibold table-text">
                                            {{ $guru->nama_guru }}
                                        </p>

                                        <p class="text-xs card-muted">
                                            Guru
                                        </p>
                                    </div>

                                </div>

                            </td>

                            <td class="px-6 py-4 table-text">
                                {{ $guru->nip }}
                            </td>

                            <td class="px-6 py-4">

                                <span class="inline-flex items-center px-3 py-1 rounded-lg bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-300 text-xs font-semibold">
                                    {{ $guru->mapel_diampu ?? '-' }}
                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="4"
                                class="px-6 py-12 text-center"
                            >
                                <div class="flex flex-col items-center">

                                    <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-3">
                                        <svg
                                            class="w-6 h-6 card-muted"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M20 13V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v7"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3 13h18v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-5Z"
                                            />
                                        </svg>
                                    </div>

                                    <p class="font-semibold table-text">
                                        Belum ada data guru
                                    </p>

                                    <p class="text-xs card-muted mt-1">
                                        Data guru akan muncul di sini.
                                    </p>

                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- =========================
        SISWA TERBARU
    ========================== --}}
    <div class="dashboard-card rounded-2xl border shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b table-border flex items-center justify-between gap-4">

            <div>
                <h3 class="text-base font-bold card-title">
                    Siswa Terbaru
                </h3>

                <p class="text-xs card-muted mt-1">
                    Data siswa yang terakhir ditambahkan
                </p>
            </div>

            <a
                href="{{ route('admin.siswa.index') }}"
                class="text-sm font-semibold text-blue-600 dark:text-blue-400 hover:underline"
            >
                Lihat Semua
            </a>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="table-header">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">
                            No
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Siswa
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            NIS
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Kelas
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($siswaList as $index => $siswa)

                        <tr class="table-row border-t table-border">

                            <td class="px-6 py-4 table-text">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-xl bg-indigo-100 dark:bg-indigo-500/10 flex items-center justify-center shrink-0">
                                        <svg
                                            class="w-5 h-5 text-indigo-600 dark:text-indigo-400"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            viewBox="0 0 24 24"
                                        >
                                            <circle cx="12" cy="8" r="4"/>
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M4 21a8 8 0 0 1 16 0"
                                            />
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="font-semibold table-text">
                                            {{ $siswa->nama_siswa }}
                                        </p>

                                        <p class="text-xs card-muted">
                                            Siswa
                                        </p>
                                    </div>

                                </div>

                            </td>

                            <td class="px-6 py-4 table-text">
                                {{ $siswa->nis }}
                            </td>

                            <td class="px-6 py-4">

                                <span class="inline-flex items-center px-3 py-1 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-700 dark:text-blue-300 text-xs font-semibold">
                                    {{ $siswa->kelas }}
                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="4"
                                class="px-6 py-12 text-center"
                            >
                                <div class="flex flex-col items-center">

                                    <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-3">
                                        <svg
                                            class="w-6 h-6 card-muted"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M20 13V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v7"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3 13h18v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-5Z"
                                            />
                                        </svg>
                                    </div>

                                    <p class="font-semibold table-text">
                                        Belum ada data siswa
                                    </p>

                                    <p class="text-xs card-muted mt-1">
                                        Data siswa akan muncul di sini.
                                    </p>

                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- =========================
        NILAI TERBARU
    ========================== --}}
    <div class="dashboard-card rounded-2xl border shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b table-border flex items-center justify-between gap-4">

            <div>
                <h3 class="text-base font-bold card-title">
                    Nilai Terbaru
                </h3>

                <p class="text-xs card-muted mt-1">
                    Data nilai akademik yang terakhir ditambahkan
                </p>
            </div>

            <a
                href="{{ route('admin.nilai.index') }}"
                class="text-sm font-semibold text-blue-600 dark:text-blue-400 hover:underline"
            >
                Lihat Semua
            </a>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="table-header">
                    <tr>

                        <th class="px-6 py-4 text-left font-semibold">
                            No
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Siswa
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Mata Pelajaran
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Semester
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Nilai Akhir
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Predikat
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @forelse($nilaiTerbaru as $index => $nilai)

                        <tr class="table-row border-t table-border">

                            <td class="px-6 py-4 table-text">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center shrink-0">

                                        <svg
                                            class="w-5 h-5 text-slate-600 dark:text-slate-300"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            viewBox="0 0 24 24"
                                        >
                                            <circle cx="12" cy="8" r="4"/>
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M4 21a8 8 0 0 1 16 0"
                                            />
                                        </svg>

                                    </div>

                                    <div>
                                        <p class="font-semibold table-text">
                                            {{ $nilai->siswa->nama_siswa ?? '-' }}
                                        </p>

                                        <p class="text-xs card-muted">
                                            {{ $nilai->siswa->nis ?? '-' }}
                                        </p>
                                    </div>

                                </div>

                            </td>

                            <td class="px-6 py-4">

                                <span class="inline-flex items-center px-3 py-1 rounded-lg bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-300 text-xs font-semibold">
                                    {{ $nilai->mapel->nama_mapel ?? '-' }}
                                </span>

                            </td>

                            <td class="px-6 py-4">

                                @if((string) $nilai->semester === '1')
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-700 dark:text-blue-300 text-xs font-semibold">
                                        Semester 1
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg bg-violet-50 dark:bg-violet-500/10 text-violet-700 dark:text-violet-300 text-xs font-semibold">
                                        Semester 2
                                    </span>
                                @endif

                            </td>

                            <td class="px-6 py-4">

                                <span class="text-lg font-extrabold table-text">
                                    {{ number_format($nilai->nilai_akhir, 2) }}
                                </span>

                            </td>

                            <td class="px-6 py-4">

                                @php
                                    $predikat = strtoupper($nilai->predikat ?? '-');

                                    $predikatClass = match ($predikat) {
                                        'A' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400',
                                        'B' => 'bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400',
                                        'C' => 'bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400',
                                        'D' => 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400',
                                        default => 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300',
                                    };
                                @endphp

                                <span class="inline-flex items-center justify-center min-w-[38px] px-2.5 py-1 rounded-lg text-xs font-bold {{ $predikatClass }}">
                                    {{ $predikat }}
                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-12 text-center"
                            >

                                <div class="flex flex-col items-center">

                                    <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-3">

                                        <svg
                                            class="w-6 h-6 card-muted"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M9 12h6M9 16h6M9 8h6"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M6 3h9l3 3v15H6V3Z"
                                            />

                                        </svg>

                                    </div>

                                    <p class="font-semibold table-text">
                                        Belum ada data nilai
                                    </p>

                                    <p class="text-xs card-muted mt-1">
                                        Data nilai akan muncul di sini.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- =========================
        FOOTER
    ========================== --}}
    <div class="text-center pt-2 pb-4">

        <p class="text-xs card-muted">
            Sistem Akademik Mini
        </p>

        <p class="text-xs card-muted mt-1">
            Kelola data akademik sekolah dengan mudah dan terstruktur.
        </p>

    </div>

</div>

@endsection