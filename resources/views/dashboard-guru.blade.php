@extends('layouts.siswa')

@section('title', 'Nilai Saya - Sistem Akademik Mini')

@section('content')

<div class="nilai-page space-y-6">

    {{-- HEADER --}}
    <div class="rounded-2xl border border-[#B8D2EB] bg-gradient-to-r from-[#C3E0F4] via-[#BAD1EC] to-[#A4BFDF] p-6 sm:p-7 dark:border-[#344D68] dark:from-[#263E59] dark:via-[#304B6A] dark:to-[#263E59]">

        <div>
            <p class="mb-2 text-xs font-extrabold uppercase tracking-wider text-[#355779] dark:text-[#BBD7F2]">
                Akademik Siswa
            </p>

            <h1 class="text-2xl font-extrabold text-[#263F59] dark:text-white sm:text-3xl">
                Nilai Saya
            </h1>

            <p class="mt-2 text-sm font-medium text-[#456783] dark:text-[#D0E2F4]">
                Lihat hasil belajar dan perkembangan nilai setiap mata pelajaran.
            </p>
        </div>

    </div>


    {{-- FILTER SEMESTER --}}
    <div class="rounded-2xl border border-[#C3D8EB] bg-[#E3F0FA] p-5 dark:border-slate-700 dark:bg-slate-800">

        <form action="{{ route('siswa.nilai.index') }}" method="GET"
              class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">

            <div class="flex-1">
                <label for="id_rapor"
                       class="mb-2 block text-sm font-extrabold text-[#355779] dark:text-slate-200">
                    Pilih Periode Semester
                </label>

                <select
                    name="id_rapor"
                    id="id_rapor"
                    onchange="this.form.submit()"
                    class="w-full rounded-xl border border-[#B8D2EB] bg-[#F5F9FD] px-4 py-3 text-sm font-semibold text-[#355779] outline-none transition focus:border-[#719BC5] focus:ring-2 focus:ring-[#A4BFDF]/40 dark:border-slate-600 dark:bg-slate-700 dark:text-white"
                >
                    @foreach ($semesterList as $periode)
                        <option
                            value="{{ $periode->id_rapor }}"
                            {{ (string) request('id_rapor', $periodeAktif->id_rapor ?? '') === (string) $periode->id_rapor ? 'selected' : '' }}
                        >
                            {{ $periode->semester }} - {{ $periode->tahun_ajaran }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button
                type="submit"
                class="rounded-xl bg-[#89AAD7] px-5 py-3 text-sm font-extrabold text-[#263F59] transition hover:bg-[#719BC5] dark:bg-[#46698F] dark:text-white dark:hover:bg-[#557BA5]"
            >
                Tampilkan Nilai
            </button>

        </form>

    </div>


    {{-- INFORMASI PERIODE --}}
    @if ($periodeAktif)
        <div class="rounded-2xl border border-[#B8D2EB] bg-gradient-to-r from-[#C3E0F4] to-[#DCEBFA] p-5 dark:border-slate-700 dark:from-slate-800 dark:to-slate-800">

            <div class="flex items-center gap-4">

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#EAF4FC] text-[#355779] dark:bg-slate-700 dark:text-[#BBD7F2]">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>

                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-[#527391] dark:text-slate-400">
                        Periode yang ditampilkan
                    </p>

                    <h2 class="mt-1 text-lg font-extrabold text-[#263F59] dark:text-white">
                        {{ $periodeAktif->semester ?? '-' }}
                        {{ $periodeAktif->tahun_ajaran ?? '' }}
                    </h2>
                </div>

            </div>

        </div>
    @endif


    {{-- RINGKASAN NILAI --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

        {{-- TOTAL MAPEL --}}
        <div class="rounded-2xl border border-[#C3D8EB] bg-gradient-to-br from-[#E3F0FA] to-[#C3E0F4] p-5 dark:border-slate-700 dark:from-slate-800 dark:to-slate-800">

            <div class="flex items-center justify-between gap-3">

                <div>
                    <p class="text-sm font-bold text-[#527391] dark:text-slate-400">
                        Total Mata Pelajaran
                    </p>

                    <h3 class="mt-2 text-3xl font-extrabold text-[#355779] dark:text-white">
                        {{ $totalMapel ?? $nilais->count() }}
                    </h3>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl border border-[#C3D8EB] bg-[#EAF4FC] text-[#355779] dark:border-slate-600 dark:bg-slate-700 dark:text-[#BBD7F2]">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>

            </div>
        </div>


        {{-- NILAI TERISI --}}
        <div class="rounded-2xl border border-[#C3D8EB] bg-gradient-to-br from-[#DCEBFA] to-[#BAD1EC] p-5 dark:border-slate-700 dark:from-slate-800 dark:to-slate-800">

            <div class="flex items-center justify-between gap-3">

                <div>
                    <p class="text-sm font-bold text-[#527391] dark:text-slate-400">
                        Nilai Terisi
                    </p>

                    <h3 class="mt-2 text-3xl font-extrabold text-[#355779] dark:text-white">
                        {{ $totalNilaiTerisi ?? 0 }}
                    </h3>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl border border-[#B8D2EB] bg-[#EAF4FC] text-[#355779] dark:border-slate-600 dark:bg-slate-700 dark:text-[#BBD7F2]">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

            </div>
        </div>


        {{-- NILAI TERBAIK --}}
        <div class="rounded-2xl border border-[#C3D8EB] bg-gradient-to-br from-[#EAF4FC] to-[#C3E0F4] p-5 dark:border-slate-700 dark:from-slate-800 dark:to-slate-800">

            <div class="flex items-center justify-between gap-3">

                <div>
                    <p class="text-sm font-bold text-[#527391] dark:text-slate-400">
                        Nilai Tertinggi
                    </p>

                    <h3 class="mt-2 text-3xl font-extrabold text-[#355779] dark:text-white">
                        {{ is_numeric($nilaiTerbaik ?? null) ? number_format($nilaiTerbaik, 2) : '-' }}
                    </h3>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl border border-[#C3D8EB] bg-[#EAF4FC] text-[#355779] dark:border-slate-600 dark:bg-slate-700 dark:text-[#BBD7F2]">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 15l-2 5-1-3-3-1 5-2m1-10l2 2 3 .5-2 2 .5 3-3-1.5L10 12l.5-3-2-2 3-.5L12 4z"/>
                    </svg>
                </div>

            </div>
        </div>

    </div>


    {{-- TABEL NILAI --}}
    <div class="overflow-hidden rounded-2xl border border-[#C3D8EB] bg-[#E3F0FA] shadow-sm dark:border-slate-700 dark:bg-slate-800">

        <div class="border-b border-[#C3D8EB] bg-[#D5E7F7] px-5 py-5 dark:border-slate-700 dark:bg-slate-800">

            <h2 class="text-lg font-extrabold text-[#355779] dark:text-white">
                Daftar Nilai Mata Pelajaran
            </h2>

            <p class="mt-1 text-sm font-medium text-[#607D98] dark:text-slate-400">
                Rincian nilai harian, UTS, UAS, dan nilai akhir.
            </p>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full min-w-[1050px] border-collapse text-left">

                <thead>
                    <tr class="bg-[#A4BFDF] text-[#263F59] dark:bg-slate-700 dark:text-slate-100">

                        <th class="whitespace-nowrap px-4 py-4 text-xs font-extrabold uppercase tracking-wide">
                            No
                        </th>

                        <th class="whitespace-nowrap px-4 py-4 text-xs font-extrabold uppercase tracking-wide">
                            Mata Pelajaran
                        </th>

                        <th class="whitespace-nowrap px-4 py-4 text-xs font-extrabold uppercase tracking-wide">
                            Semester
                        </th>

                        <th class="whitespace-nowrap px-4 py-4 text-center text-xs font-extrabold uppercase tracking-wide">
                            Harian
                        </th>

                        <th class="whitespace-nowrap px-4 py-4 text-center text-xs font-extrabold uppercase tracking-wide">
                            UTS
                        </th>

                        <th class="whitespace-nowrap px-4 py-4 text-center text-xs font-extrabold uppercase tracking-wide">
                            UAS
                        </th>

                        <th class="whitespace-nowrap px-4 py-4 text-center text-xs font-extrabold uppercase tracking-wide">
                            Nilai Akhir
                        </th>

                        <th class="whitespace-nowrap px-4 py-4 text-center text-xs font-extrabold uppercase tracking-wide">
                            KKM
                        </th>

                        <th class="whitespace-nowrap px-4 py-4 text-center text-xs font-extrabold uppercase tracking-wide">
                            Status Ketuntasan
                        </th>

                        <th class="whitespace-nowrap px-4 py-4 text-center text-xs font-extrabold uppercase tracking-wide">
                            Predikat
                        </th>

                    </tr>
                </thead>


                <tbody class="divide-y divide-[#C9DCEC] dark:divide-slate-700">

                    @forelse ($nilais as $index => $nilai)

                        @php
                            $harian = data_get($nilai, 'nilai_harian');
                            $uts = data_get($nilai, 'nilai_uts');
                            $uas = data_get($nilai, 'nilai_uas');
                            $akhir = data_get($nilai, 'nilai_akhir');
                            $kkm = data_get($nilai, 'mapel.kkm');
                            $predikat = data_get($nilai, 'predikat');

                            $namaMapel = data_get($nilai, 'mapel.nama_mapel', 'Mata Pelajaran');
                            $semester = data_get($nilai, 'rapor.semester', $periodeAktif->semester ?? '-');

                            $nilaiLengkap = is_numeric($harian)
                                && is_numeric($uts)
                                && is_numeric($uas)
                                && is_numeric($akhir);

                            $tuntas = is_numeric($akhir)
                                && is_numeric($kkm)
                                && $akhir >= $kkm;
                        @endphp

                        <tr class="{{ $loop->even ? 'bg-[#DCEBFA]' : 'bg-[#EDF5FC]' }} transition hover:bg-[#CFE3F5] dark:bg-slate-800 dark:hover:bg-slate-700">

                            <td class="whitespace-nowrap px-4 py-4 text-sm font-bold text-[#527391] dark:text-slate-300">
                                {{ ($pagination->firstItem() ?? 1) + $loop->index }}
                            </td>

                            <td class="px-4 py-4 text-sm font-extrabold text-[#355779] dark:text-slate-100">
                                {{ $namaMapel }}
                            </td>

                            <td class="whitespace-nowrap px-4 py-4">
                                <span class="inline-flex rounded-lg border border-[#B8D2EB] bg-[#EAF4FC] px-3 py-1.5 text-xs font-extrabold text-[#355779] dark:border-slate-600 dark:bg-slate-700 dark:text-[#D0E2F4]">
                                    {{ $semester }}
                                </span>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-center text-sm font-extrabold text-[#355779] dark:text-slate-200">
                                {{ is_numeric($harian) ? number_format($harian, 2) : 'Belum Ada Nilai' }}
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-center text-sm font-extrabold text-[#355779] dark:text-slate-200">
                                {{ is_numeric($uts) ? number_format($uts, 2) : 'Belum Ada Nilai' }}
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-center text-sm font-extrabold text-[#355779] dark:text-slate-200">
                                {{ is_numeric($uas) ? number_format($uas, 2) : 'Belum Ada Nilai' }}
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-center text-sm font-extrabold text-[#355779] dark:text-white">
                                {{ is_numeric($akhir) ? number_format($akhir, 2) : 'Belum Ada Nilai' }}
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-center text-sm font-extrabold text-[#355779] dark:text-slate-200">
                                {{ is_numeric($kkm) ? number_format($kkm, 0) : 'KKM Belum Diatur' }}
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-center">

                                @if (!is_numeric($akhir))
                                    <span class="inline-flex rounded-lg bg-[#E5EAF0] px-3 py-1.5 text-xs font-bold text-[#64748B] dark:bg-slate-700 dark:text-slate-300">
                                        Belum Ada Nilai
                                    </span>
                                @elseif (!is_numeric($kkm))
                                    <span class="inline-flex rounded-lg bg-[#E5EAF0] px-3 py-1.5 text-xs font-bold text-[#64748B] dark:bg-slate-700 dark:text-slate-300">
                                        KKM Belum Diatur
                                    </span>
                                @elseif ($tuntas)
                                    <span class="inline-flex rounded-lg bg-[#D9F1E3] px-3 py-1.5 text-xs font-extrabold text-[#287A4B] dark:bg-green-900/30 dark:text-green-300">
                                        Tuntas
                                    </span>
                                @else
                                    <span class="inline-flex rounded-lg bg-[#FCE8D9] px-3 py-1.5 text-xs font-extrabold text-[#B76532] dark:bg-orange-900/30 dark:text-orange-300">
                                        Belum Tuntas
                                    </span>
                                @endif

                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-center">

                                @if (!empty($predikat))
                                    <span class="inline-flex min-w-9 justify-center rounded-lg bg-[#C3E0F4] px-3 py-1.5 text-sm font-extrabold text-[#355779] dark:bg-slate-700 dark:text-[#D0E2F4]">
                                        {{ $predikat }}
                                    </span>
                                @else
                                    <span class="text-xs font-bold text-[#71869B] dark:text-slate-400">
                                        Belum Ada Predikat
                                    </span>
                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="10" class="px-5 py-12 text-center">

                                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[#D5E7F7] text-[#527391] dark:bg-slate-700 dark:text-slate-300">
                                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
                                    </svg>
                                </div>

                                <h3 class="mt-4 text-base font-extrabold text-[#355779] dark:text-white">
                                    Belum Ada Data Nilai
                                </h3>

                                <p class="mt-1 text-sm font-medium text-[#71869B] dark:text-slate-400">
                                    Belum ada nilai yang tersedia pada periode ini.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION: SEBELUMNYA DAN SELANJUTNYA SAJA --}}
        @if ($pagination->lastPage() > 1)

            <div class="flex items-center justify-between gap-3 border-t border-[#C3D8EB] bg-[#DCEBFA] px-5 py-4 dark:border-slate-700 dark:bg-slate-800">

                @if ($pagination->onFirstPage())
                    <span class="inline-flex cursor-not-allowed items-center gap-2 rounded-xl border border-[#C3D8EB] bg-[#EDF5FC] px-4 py-2.5 text-sm font-bold text-[#9AAFC3] dark:border-slate-700 dark:bg-slate-700 dark:text-slate-500">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Sebelumnya
                    </span>
                @else
                    <a href="{{ $pagination->previousPageUrl() }}"
                       class="inline-flex items-center gap-2 rounded-xl border border-[#A4BFDF] bg-[#EAF4FC] px-4 py-2.5 text-sm font-extrabold text-[#355779] transition hover:bg-[#C3E0F4] dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:hover:bg-slate-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Sebelumnya
                    </a>
                @endif


                @if ($pagination->hasMorePages())
                    <a href="{{ $pagination->nextPageUrl() }}"
                       class="inline-flex items-center gap-2 rounded-xl border border-[#A4BFDF] bg-[#EAF4FC] px-4 py-2.5 text-sm font-extrabold text-[#355779] transition hover:bg-[#C3E0F4] dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:hover:bg-slate-600">
                        Selanjutnya
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @else
                    <span class="inline-flex cursor-not-allowed items-center gap-2 rounded-xl border border-[#C3D8EB] bg-[#EDF5FC] px-4 py-2.5 text-sm font-bold text-[#9AAFC3] dark:border-slate-700 dark:bg-slate-700 dark:text-slate-500">
                        Selanjutnya
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                @endif

            </div>

        @endif

    </div>

</div>

@endsection