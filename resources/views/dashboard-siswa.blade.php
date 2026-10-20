@extends('layouts.siswa')

@section('title', 'Dashboard Siswa - Sistem Akademik Mini')

@section('page-title', 'Dashboard Siswa')

@section('page-subtitle', 'Selamat datang di Sistem Akademik Mini')


@php

    $siswa = \App\Models\Siswa::where(
        'user_id',
        auth()->id()
    )->first();

    $namaSiswa = $siswa
        ? $siswa->nama_siswa
        : ucfirst(auth()->user()->username);

    $inisial = strtoupper(
        substr($namaSiswa, 0, 2)
    );

    $totalMapel = \App\Models\Mapel::count();

    $nilaiTerbaru = collect();

    $avgNilai = null;

    $totalMapelDinilai = 0;


    if ($siswa) {

        $nilaiTerbaru = \App\Models\Nilai::where(
                'id_siswa',
                $siswa->id_siswa
            )
            ->with('mapel')
            ->latest('id_nilai')
            ->limit(5)
            ->get();

        $avgNilai = \App\Models\Nilai::where(
                'id_siswa',
                $siswa->id_siswa
            )
            ->avg('nilai_akhir');

        $totalMapelDinilai = \App\Models\Nilai::where(
                'id_siswa',
                $siswa->id_siswa
            )
            ->count();

    }

@endphp


<div class="space-y-6">


    {{-- =====================================================
         WELCOME
    ====================================================== --}}

    <div class="bg-blue-600 rounded-2xl p-6 shadow-lg text-white">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div class="flex items-center gap-4">

                <div class="w-16 h-16 rounded-2xl bg-white/15 border border-white/20 flex items-center justify-center text-2xl font-bold flex-shrink-0">

                    {{ $inisial }}

                </div>


                <div>

                    <p class="text-blue-100 text-sm mb-1">
                        Selamat datang 👋
                    </p>

                    <h2 class="text-2xl font-extrabold">
                        {{ $namaSiswa }}
                    </h2>

                    <p class="text-blue-100 text-sm mt-1">
                        Semangat belajar dan raih prestasi terbaikmu!
                    </p>

                </div>

            </div>


            <a
                href="{{ route('siswa.rapor.index') }}"
                class="inline-flex items-center justify-center gap-2 bg-white text-blue-600 font-bold px-5 py-3 rounded-xl text-sm shadow-sm hover:bg-blue-50 transition"
            >

                📄

                Lihat Rapor

            </a>

        </div>


        {{-- INFO SISWA --}}

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6 pt-5 border-t border-white/20">


            <div class="bg-white/10 rounded-xl p-4">

                <p class="text-blue-100 text-xs font-medium mb-1">
                    NIS
                </p>

                <p class="font-bold text-lg">
                    {{ $siswa ? $siswa->nis : '-' }}
                </p>

            </div>


            <div class="bg-white/10 rounded-xl p-4">

                <p class="text-blue-100 text-xs font-medium mb-1">
                    Kelas
                </p>

                <p class="font-bold text-lg">
                    {{ $siswa ? $siswa->kelas : '-' }}
                </p>

            </div>


            <div class="bg-white/10 rounded-xl p-4">

                <p class="text-blue-100 text-xs font-medium mb-1">
                    Total Mapel
                </p>

                <p class="font-bold text-lg">
                    {{ $totalMapel }}
                </p>

            </div>

        </div>

    </div>



    {{-- =====================================================
         STATISTIK
    ====================================================== --}}

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">


        {{-- RATA-RATA NILAI --}}

        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                        Rata-rata Nilai
                    </p>

                    <h3 class="text-3xl font-extrabold text-emerald-600 mt-2">

                        {{ $avgNilai !== null
                            ? number_format($avgNilai, 1)
                            : '0.0'
                        }}

                    </h3>

                    <p class="text-xs text-slate-400 mt-1">
                        Dari semua nilai
                    </p>

                </div>


                <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center text-xl">

                    📈

                </div>

            </div>

        </div>



        {{-- MAPEL DINILAI --}}

        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                        Mapel Dinilai
                    </p>

                    <h3 class="text-3xl font-extrabold text-blue-600 mt-2">

                        {{ $totalMapelDinilai }}

                    </h3>

                    <p class="text-xs text-slate-400 mt-1">
                        Sudah ada nilainya
                    </p>

                </div>


                <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center text-xl">

                    📚

                </div>

            </div>

        </div>



        {{-- STATUS RAPOR --}}

        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                        Status Rapor
                    </p>

                    <h3 class="text-xl font-extrabold text-blue-600 mt-3">
                        Tersedia
                    </h3>

                    <p class="text-xs text-slate-400 mt-1">
                        Siap untuk dilihat
                    </p>

                </div>


                <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center text-xl">

                    📄

                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
         NILAI TERBARU + AKSES CEPAT
    ====================================================== --}}

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">


        {{-- NILAI TERBARU --}}

        <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">


            <div class="flex items-center justify-between mb-5">

                <div>

                    <h2 class="text-lg font-bold text-slate-800 dark:text-white">
                        Nilai Terbaru
                    </h2>

                    <p class="text-xs text-slate-400 mt-1">
                        Nilai terbaru yang sudah diinput guru
                    </p>

                </div>


                <a
                    href="{{ route('siswa.nilai.index') }}"
                    class="text-xs font-semibold text-blue-600 hover:text-blue-700"
                >

                    Lihat Semua →

                </a>

            </div>



            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead>

                        <tr class="border-b border-slate-100 dark:border-slate-800">

                            <th class="text-left py-3 text-xs font-semibold text-slate-500 dark:text-slate-400">
                                Mata Pelajaran
                            </th>

                            <th class="text-center py-3 text-xs font-semibold text-slate-500 dark:text-slate-400">
                                Nilai Akhir
                            </th>

                            <th class="text-center py-3 text-xs font-semibold text-slate-500 dark:text-slate-400">
                                Predikat
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">


                        @forelse($nilaiTerbaru as $nilai)

                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">

                                <td class="py-3 font-medium text-slate-700 dark:text-slate-200">

                                    {{ $nilai->mapel->nama_mapel ?? 'Mapel' }}

                                </td>


                                <td class="py-3 text-center font-bold text-slate-800 dark:text-white">

                                    {{ $nilai->nilai_akhir !== null
                                        ? number_format($nilai->nilai_akhir, 1)
                                        : '-'
                                    }}

                                </td>


                                <td class="py-3 text-center">

                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 dark:bg-blue-500/10 text-blue-700 dark:text-blue-300">

                                        {{ $nilai->predikat ?? '-' }}

                                    </span>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td
                                    colspan="3"
                                    class="py-10 text-center text-slate-500 dark:text-slate-400"
                                >

                                    <div class="text-3xl mb-2">
                                        📚
                                    </div>

                                    <p class="text-sm">
                                        Belum ada nilai yang diinput oleh guru.
                                    </p>

                                </td>

                            </tr>

                        @endforelse


                    </tbody>

                </table>

            </div>

        </div>



        {{-- AKSES CEPAT --}}

        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">


            <h2 class="text-lg font-bold text-slate-800 dark:text-white">
                Akses Cepat
            </h2>

            <p class="text-xs text-slate-400 mt-1 mb-5">
                Menu yang bisa kamu gunakan
            </p>


            <div class="space-y-3">


                {{-- NILAI --}}

                <a
                    href="{{ route('siswa.nilai.index') }}"
                    class="flex items-center gap-3 p-4 rounded-xl bg-blue-50 dark:bg-blue-500/10 hover:bg-blue-100 dark:hover:bg-blue-500/20 transition"
                >

                    <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-500/20 flex items-center justify-center">

                        📊

                    </div>


                    <div>

                        <p class="text-sm font-bold text-slate-700 dark:text-slate-200">
                            Nilai Saya
                        </p>

                        <p class="text-xs text-slate-500 dark:text-slate-400">
                            Lihat nilai akademik
                        </p>

                    </div>

                </a>



                {{-- RAPOR --}}

                <a
                    href="{{ route('siswa.rapor.index') }}"
                    class="flex items-center gap-3 p-4 rounded-xl bg-blue-50 dark:bg-blue-500/10 hover:bg-blue-100 dark:hover:bg-blue-500/20 transition"
                >

                    <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-500/20 flex items-center justify-center">

                        📄

                    </div>


                    <div>

                        <p class="text-sm font-bold text-slate-700 dark:text-slate-200">
                            Rapor Saya
                        </p>

                        <p class="text-xs text-slate-500 dark:text-slate-400">
                            Lihat hasil rapor
                        </p>

                    </div>

                </a>

            </div>

        </div>

    </div>

</div>