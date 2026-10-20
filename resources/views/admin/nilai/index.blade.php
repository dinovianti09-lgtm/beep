@extends('layouts.admin')

@section('title', 'Data Nilai - Sistem Akademik')

@section('page-title', 'Data Nilai')

@section('page-subtitle', 'Pantau nilai akademik siswa berdasarkan kelas, semester, dan mata pelajaran')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-xl font-extrabold main-title">
                Data Nilai
            </h3>
            <p class="text-sm main-subtitle mt-1">
                Lihat dan pantau nilai akademik siswa yang tersimpan dalam sistem.
            </p>
        </div>
    </div>

    {{-- NOTIFIKASI SUKSES --}}
    @if(session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-700 dark:border-emerald-800 dark:bg-emerald-900/20 dark:text-emerald-400">
            <div class="font-bold mb-1">Berhasil</div>
            {{ session('success') }}
        </div>
    @endif

    {{-- NOTIFIKASI ERROR --}}
    @if($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700 dark:border-red-800 dark:bg-red-900/20 dark:text-red-400">
            <p class="font-bold mb-2">Proses belum berhasil</p>
            <ul class="list-disc ml-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- INFORMASI AKSES NILAI ADMIN --}}
    <div class="dashboard-card rounded-2xl border shadow-sm p-6 transition-smooth">
        <div class="flex flex-col sm:flex-row sm:items-start gap-4">
            <div class="w-12 h-12 shrink-0 rounded-xl bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center text-2xl">
                📊
            </div>

            <div class="flex-1">
                <h4 class="font-extrabold card-title">
                    Pemantauan Data Nilai
                </h4>

                <p class="text-sm card-muted mt-2 leading-relaxed">
                    Admin dapat melihat dan memantau nilai akademik siswa berdasarkan kelas,
                    semester, dan mata pelajaran. Penginputan serta pengelolaan nilai
                    dilakukan melalui akun Guru.
                </p>

                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-emerald-50 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 text-xs font-bold">
                        <span>✓</span> Lihat Data Nilai
                    </span>

                    <span class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400 text-xs font-bold">
                        <span>✓</span> Filter Nilai
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- FILTER CARD --}}
    <div class="dashboard-card rounded-2xl border shadow-sm p-6 transition-smooth">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
            <div>
                <h4 class="font-extrabold card-title">
                    Filter Data Nilai
                </h4>
                <p class="text-xs card-muted mt-1">
                    Pilih kelas, semester, dan mata pelajaran untuk melihat nilai tertentu.
                </p>
            </div>

            <div class="px-3 py-1.5 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 text-xs font-bold">
                {{ $nilaiList->count() }} Data
            </div>
        </div>

        <form method="GET"
              action="{{ route('admin.nilai.index') }}"
              class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

            {{-- KELAS --}}
            <div>
                <label class="block text-xs font-bold card-muted uppercase tracking-wider mb-2">
                    Kelas
                </label>

                <select name="kelas"
                        class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-3 text-sm table-text focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kelas</option>

                    @foreach($kelasList as $kelas)
                        <option value="{{ $kelas->nama_kelas }}"
                            {{ $kelasTerpilih == $kelas->nama_kelas ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- SEMESTER --}}
            <div>
                <label class="block text-xs font-bold card-muted uppercase tracking-wider mb-2">
                    Semester
                </label>

                <select name="semester"
                        class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-3 text-sm table-text focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Semester</option>

                    <option value="1" {{ (string) $semesterTerpilih === '1' ? 'selected' : '' }}>
                        Semester 1 - Ganjil
                    </option>

                    <option value="2" {{ (string) $semesterTerpilih === '2' ? 'selected' : '' }}>
                        Semester 2 - Genap
                    </option>
                </select>
            </div>

            {{-- MATA PELAJARAN --}}
            <div>
                <label class="block text-xs font-bold card-muted uppercase tracking-wider mb-2">
                    Mata Pelajaran
                </label>

                <select name="mapel"
                        class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-3 text-sm table-text focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Mata Pelajaran</option>

                    @foreach($mapelList as $mapel)
                        <option value="{{ $mapel->id_mapel }}"
                            {{ (string) $mapelTerpilih === (string) $mapel->id_mapel ? 'selected' : '' }}>
                            {{ $mapel->nama_mapel }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- TOMBOL FILTER --}}
            <div class="flex gap-2">
                <button type="submit"
                        class="flex-1 px-5 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-bold shadow-lg shadow-blue-900/10 hover:shadow-xl hover:-translate-y-0.5 transition">
                    Tampilkan
                </button>

                @if($kelasTerpilih || $semesterTerpilih || $mapelTerpilih)
                    <a href="{{ route('admin.nilai.index') }}"
                       class="px-5 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-sm font-bold hover:bg-slate-200 dark:hover:bg-slate-700 transition">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- INFO FILTER --}}
    <div class="dashboard-card rounded-2xl border shadow-sm transition-smooth">
        <div class="px-6 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h4 class="font-extrabold card-title">
                    Daftar Nilai
                </h4>

                <p class="text-xs card-muted mt-1">
                    @if($kelasTerpilih)
                        Kelas {{ $kelasTerpilih }}
                    @else
                        Semua Kelas
                    @endif

                    @if($semesterTerpilih == '1')
                        • Semester 1 - Ganjil
                    @elseif($semesterTerpilih == '2')
                        • Semester 2 - Genap
                    @else
                        • Semua Semester
                    @endif

                    @if($mapelTerpilih)
                        @php
                            $mapelDipilih = $mapelList->firstWhere(
                                'id_mapel',
                                (int) $mapelTerpilih
                            );
                        @endphp

                        • {{ $mapelDipilih->nama_mapel ?? 'Mata Pelajaran' }}
                    @endif
                </p>
            </div>

            <div class="px-3 py-1.5 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 text-xs font-bold whitespace-nowrap">
                {{ $nilaiList->count() }} Data Nilai
            </div>
        </div>
    </div>

    {{-- TABLE CARD --}}
    <div class="dashboard-card rounded-2xl border shadow-sm overflow-hidden transition-smooth">

        <div class="px-6 py-5 border-b table-border">
            <h4 class="font-extrabold card-title">
                Data Nilai Siswa
            </h4>

            <p class="text-xs card-muted mt-1">
                Daftar nilai akademik siswa. Admin hanya memiliki akses untuk melihat data.
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[1200px]">
                <thead>
                    <tr class="table-header border-b table-border">
                        <th class="px-6 py-4 text-left text-xs font-bold card-muted uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-bold card-muted uppercase tracking-wider">NIS</th>
                        <th class="px-6 py-4 text-left text-xs font-bold card-muted uppercase tracking-wider">Nama Siswa</th>
                        <th class="px-6 py-4 text-left text-xs font-bold card-muted uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-4 text-left text-xs font-bold card-muted uppercase tracking-wider">Mata Pelajaran</th>
                        <th class="px-6 py-4 text-center text-xs font-bold card-muted uppercase tracking-wider">Semester</th>
                        <th class="px-6 py-4 text-center text-xs font-bold card-muted uppercase tracking-wider">Harian</th>
                        <th class="px-6 py-4 text-center text-xs font-bold card-muted uppercase tracking-wider">UTS</th>
                        <th class="px-6 py-4 text-center text-xs font-bold card-muted uppercase tracking-wider">UAS</th>
                        <th class="px-6 py-4 text-center text-xs font-bold card-muted uppercase tracking-wider">Nilai Akhir</th>
                        <th class="px-6 py-4 text-center text-xs font-bold card-muted uppercase tracking-wider">Predikat</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($nilaiList as $index => $nilai)
                        <tr class="table-row transition-smooth">

                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold card-muted">
                                    {{ $index + 1 }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span class="text-sm table-text">
                                    {{ $nilai->siswa->nis ?? '-' }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-sm">
                                        {{ strtoupper(substr($nilai->siswa->nama_siswa ?? 'S', 0, 1)) }}
                                    </div>

                                    <span class="text-sm font-bold table-text">
                                        {{ $nilai->siswa->nama_siswa ?? '-' }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs font-semibold">
                                    {{ $nilai->siswa->kelas ?? '-' }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1.5 rounded-lg bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 text-xs font-semibold">
                                    {{ $nilai->mapel->nama_mapel ?? '-' }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($nilai->semester == 1)
                                    <span class="inline-flex px-3 py-1.5 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 text-xs font-bold">
                                        1 - Ganjil
                                    </span>
                                @elseif($nilai->semester == 2)
                                    <span class="inline-flex px-3 py-1.5 rounded-lg bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 text-xs font-bold">
                                        2 - Genap
                                    </span>
                                @else
                                    <span class="text-sm card-muted">-</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="text-sm table-text">
                                    {{ number_format((float) $nilai->nilai_harian, 2) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="text-sm table-text">
                                    {{ number_format((float) $nilai->nilai_uts, 2) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="text-sm table-text">
                                    {{ number_format((float) $nilai->nilai_uas, 2) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex px-3 py-1.5 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 text-xs font-bold">
                                    {{ number_format((float) $nilai->nilai_akhir, 2) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($nilai->predikat === 'A')
                                    <span class="inline-flex px-3 py-1.5 rounded-lg bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-xs font-bold">A</span>
                                @elseif($nilai->predikat === 'B')
                                    <span class="inline-flex px-3 py-1.5 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 text-xs font-bold">B</span>
                                @elseif($nilai->predikat === 'C')
                                    <span class="inline-flex px-3 py-1.5 rounded-lg bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 text-xs font-bold">C</span>
                                @elseif($nilai->predikat === 'D')
                                    <span class="inline-flex px-3 py-1.5 rounded-lg bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 text-xs font-bold">D</span>
                                @else
                                    <span class="text-sm card-muted">-</span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-2xl mb-4">
                                        📊
                                    </div>

                                    <h4 class="text-sm font-bold text-slate-700 dark:text-slate-300">
                                        Belum ada data nilai
                                    </h4>

                                    <p class="text-xs card-muted mt-1">
                                        Belum ditemukan nilai untuk filter yang dipilih.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- FOOTER --}}
    <p class="text-center text-xs card-muted mt-8">
        © {{ date('Y') }} Sistem Akademik Mini
    </p>

</div>

@endsection