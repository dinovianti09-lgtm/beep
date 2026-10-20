@extends('layouts.guru')

@section('title', 'Rapor Kelas - Sistem Akademik Mini')

@section('page-title', 'Rapor Kelas')

@section('page-subtitle', 'Lihat periode rapor dan hasil belajar siswa di kelas wali Anda.')

@section('content')

<div class="p-6 lg:p-8">

    {{-- PAGE HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="w-11 h-11 rounded-xl bg-blue-100 dark:bg-blue-500/10 flex items-center justify-center">
                    <span class="text-xl">📄</span>
                </div>

                <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">
                    Rapor Kelas
                </h1>
            </div>

            <p class="text-sm text-slate-400 dark:text-slate-500">
                Periode rapor untuk kelas yang Anda ampu sebagai wali kelas.
            </p>
        </div>
    </div>

    {{-- INFORMASI KELAS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">

        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 p-5 shadow-sm">
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-2">
                Kelas Wali
            </p>

            <h3 class="text-xl font-extrabold text-slate-900 dark:text-white">
                {{ $kelasWali->nama_kelas }}
            </h3>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 p-5 shadow-sm">
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-2">
                Jumlah Siswa
            </p>

            <h3 class="text-xl font-extrabold text-slate-900 dark:text-white">
                {{ $jumlahSiswa }} Siswa
            </h3>
        </div>

    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden transition">

        {{-- CARD HEADER --}}
        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between gap-4">

            <div>
                <h4 class="font-extrabold text-slate-900 dark:text-white">
                    Daftar Periode Rapor
                </h4>

                <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">
                    Pilih periode untuk melihat rapor siswa di kelas Anda.
                </p>
            </div>

            <div class="px-3 py-1.5 rounded-full bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 text-xs font-bold whitespace-nowrap">
                {{ $raporList->count() }} Periode
            </div>

        </div>

        {{-- TABLE --}}
        <div class="w-full overflow-x-auto">

            <table class="w-full min-w-[650px]">

                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800 border-b border-slate-100 dark:border-slate-700">

                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                            No
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                            Semester
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                            Tahun Ajaran
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                            Aksi
                        </th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">

                    @forelse($raporList as $index => $rapor)

                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/70 transition">

                            {{-- NOMOR --}}
                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold text-slate-500 dark:text-slate-400">
                                    {{ $index + 1 }}
                                </span>
                            </td>

                            {{-- SEMESTER --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1.5 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 text-xs font-semibold">
                                    Semester {{ $rapor->semester }}
                                </span>
                            </td>

                            {{-- TAHUN AJARAN --}}
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-slate-800 dark:text-slate-200">
                                    {{ $rapor->tahun_ajaran }}
                                </span>
                            </td>

                            {{-- AKSI --}}
                            <td class="px-6 py-4">
                                <div class="flex justify-center">

                                    <a
                                        href="{{ route('guru.rapor.show', $rapor->id_rapor) }}"
                                        class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-600 hover:text-white transition text-xs font-bold"
                                    >
                                        👁 Lihat Rapor
                                    </a>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="w-16 h-16 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-2xl mb-4">
                                        📄
                                    </div>

                                    <h4 class="text-sm font-bold text-slate-700 dark:text-slate-300">
                                        Belum ada periode rapor
                                    </h4>

                                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">
                                        Periode akan tampil jika sudah tersedia nilai siswa di kelas Anda.
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
    <p class="text-center text-xs text-slate-400 dark:text-slate-600 mt-8">
        © {{ date('Y') }} Sistem Akademik Mini
    </p>

</div>

@endsection