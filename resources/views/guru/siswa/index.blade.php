@extends('layouts.guru')

@section('title', 'Data Siswa - Sistem Akademik')

@section('page-title', 'Data Siswa')

@section('page-subtitle', 'Daftar siswa kelas wali')

@section('content')

<div class="space-y-6">

    {{-- =========================
         HEADER
    ========================== --}}

    <div class="dashboard-card rounded-2xl p-6 shadow-sm border">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h3 class="text-xl font-extrabold card-title">
                    Data Siswa
                </h3>

                <p class="text-sm card-muted mt-1">
                    Daftar siswa yang berada di kelas wali Anda.
                </p>

            </div>

            @if($kelasWali)

                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300">

                    <span>
                        🏫
                    </span>

                    <span class="font-semibold">
                        {{ $kelasWali->nama_kelas }}
                    </span>

                </div>

            @endif

        </div>

    </div>


    {{-- =========================
         INFORMASI GURU
    ========================== --}}

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        {{-- NAMA GURU --}}

        <div class="dashboard-card rounded-2xl p-5 shadow-sm border">

            <p class="text-sm card-muted">
                Wali Kelas
            </p>

            <h3 class="text-lg font-bold card-title mt-1">
                {{ $guru->nama_guru }}
            </h3>

        </div>


        {{-- KELAS --}}

        <div class="dashboard-card rounded-2xl p-5 shadow-sm border">

            <p class="text-sm card-muted">
                Kelas
            </p>

            <h3 class="text-lg font-bold card-title mt-1">
                {{ $kelasWali->nama_kelas ?? '-' }}
            </h3>

        </div>


        {{-- JUMLAH SISWA --}}

        <div class="dashboard-card rounded-2xl p-5 shadow-sm border">

            <p class="text-sm card-muted">
                Jumlah Siswa
            </p>

            <h3 class="text-2xl font-extrabold text-blue-600 mt-1">
                {{ $siswaList->count() }}
            </h3>

        </div>

    </div>


    {{-- =========================
         TABEL SISWA
    ========================== --}}

    <div class="dashboard-card rounded-2xl shadow-sm border overflow-hidden">

        <div class="p-6 border-b border-slate-200 dark:border-slate-700">

            <h3 class="text-lg font-bold card-title">
                Daftar Siswa
            </h3>

            <p class="text-sm card-muted mt-1">
                Siswa yang terdaftar di kelas {{ $kelasWali->nama_kelas ?? '-' }}
            </p>

        </div>


        @if($siswaList->count() > 0)

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-slate-50 dark:bg-slate-900/50">

                        <tr>

                            <th class="px-6 py-4 text-left font-semibold text-slate-600 dark:text-slate-300">
                                No
                            </th>

                            <th class="px-6 py-4 text-left font-semibold text-slate-600 dark:text-slate-300">
                                NIS
                            </th>

                            <th class="px-6 py-4 text-left font-semibold text-slate-600 dark:text-slate-300">
                                Nama Siswa
                            </th>

                            <th class="px-6 py-4 text-left font-semibold text-slate-600 dark:text-slate-300">
                                Kelas
                            </th>

                            <th class="px-6 py-4 text-left font-semibold text-slate-600 dark:text-slate-300">
                                Jenis Kelamin
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">

                        @foreach($siswaList as $index => $siswa)

                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition">

                                <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                    {{ $index + 1 }}
                                </td>

                                <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                    {{ $siswa->nis ?? '-' }}
                                </td>

                                <td class="px-6 py-4 font-semibold card-title">
                                    {{ $siswa->nama_siswa }}
                                </td>

                                <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                    {{ $siswa->kelas ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                    {{ $siswa->jenis_kelamin ?? '-' }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="p-12 text-center">

                <div class="text-5xl mb-4">
                    👨‍🎓
                </div>

                <h3 class="text-lg font-bold card-title">
                    Belum Ada Siswa
                </h3>

                <p class="text-sm card-muted mt-2">
                    Belum ada siswa yang terdaftar di kelas wali Anda.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection