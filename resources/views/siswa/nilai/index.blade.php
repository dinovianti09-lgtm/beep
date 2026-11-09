@extends('layouts.siswa')

@section('title', 'Nilai Saya - Sistem Akademik')
@section('page-title', 'Nilai Saya')
@section('page-subtitle', 'Lihat perkembangan nilai akademik kamu')

@section('content')
<div class="dashboard-page space-y-6">

    {{-- HEADER NILAI SAYA --}}
    <div class="relative overflow-hidden rounded-2xl border border-[#C9DCEC] dark:border-[#263E59] bg-gradient-to-r from-[#DCEBFA] via-[#EAF3FB] to-[#F4F8FC] dark:from-[#172B46] dark:via-[#203A57] dark:to-[#263E59] p-6 sm:p-7 shadow-sm">
        <div class="absolute -right-10 -top-12 w-48 h-48 rounded-full bg-white/30 dark:bg-white/5"></div>
        <div class="absolute right-20 -bottom-20 w-40 h-40 rounded-full bg-[#8DB9E8]/20 dark:bg-[#8DB9E8]/10"></div>

        <div class="relative flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-white/80 dark:bg-[#263E59] flex items-center justify-center flex-shrink-0 shadow-sm">
                <svg class="w-7 h-7 text-[#3478BD] dark:text-[#D8E9FC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6M9 16h6M7 4h7l3 3v13H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 4v4h4"/>
                </svg>
            </div>

            <div class="min-w-0">
                <h2 class="text-xl sm:text-2xl font-bold text-[#355779] dark:text-[#D8E9FC]">
                    Nilai Saya
                </h2>
                <p class="text-sm text-[#587A9B] dark:text-[#A9C4DF] mt-1">
                    Lihat seluruh perkembangan nilai akademik kamu.
                </p>
            </div>
        </div>
    </div>

    {{-- PILIH PERIODE --}}
    <div class="dashboard-card rounded-2xl border shadow-sm p-5 sm:p-6">
        <div class="flex flex-col gap-4">

            <div>
                <h3 class="text-base font-extrabold card-title">
                    Pilih Semester
                </h3>
                <p class="text-sm card-muted mt-1">
                    Silakan pilih semester dan tahun ajaran untuk melihat nilai akademik kamu.
                </p>
            </div>

            @if($semesterList->isNotEmpty())
                <form method="GET"
                      action="{{ route('siswa.nilai.index') }}"
                      class="w-full">

                    <label for="semester-nilai"
                           class="block text-sm font-bold card-title mb-2">
                        Pilih Semester
                    </label>

                    <select
                        id="semester-nilai"
                        name="semester"
                        onchange="this.form.submit()"
                        class="block w-full md:max-w-md px-4 py-3 rounded-xl border border-[#A4BFDF] dark:border-slate-600 bg-[#F4F8FC] dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-[#89AAD7] focus:border-[#89AAD7] transition"
                    >
                        @foreach($semesterList as $periode)
                            <option
                                value="{{ $periode->id_rapor }}"
                                {{ (string) $semesterDipilih === (string) $periode->id_rapor ? 'selected' : '' }}
                            >
                                {{ $periode->semester }} - Tahun Ajaran {{ $periode->tahun_ajaran }}
                            </option>
                        @endforeach
                    </select>

                    <p class="text-xs card-muted mt-2">
                        Perubahan pilihan semester akan menampilkan nilai sesuai periode yang dipilih.
                    </p>
                </form>
            @else
                <div class="w-full md:max-w-md px-4 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 text-sm text-slate-500 dark:text-slate-400">
                    Belum ada periode nilai
                </div>
            @endif

        </div>
    </div>

    {{-- INFORMASI PERIODE --}}
    @if($periodeAktif)
        <div class="rounded-2xl border border-[#C9DCEC] dark:border-[#263E59] bg-gradient-to-r from-[#EAF3FB] to-[#F4F8FC] dark:from-[#172B46] dark:to-[#203A57] p-5">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-xl bg-white/80 dark:bg-[#263E59] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-[#3478BD] dark:text-[#D8E9FC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.25v13.5M5.5 4.75h4a2.5 2.5 0 012.5 2.5v12a2.5 2.5 0 00-2.5-2.5h-4a2.5 2.5 0 01-2.5-2.5v-7a2.5 2.5 0 012.5-2.5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 4.75h-4a2.5 2.5 0 00-2.5 2.5v12a2.5 2.5 0 012.5-2.5h4a2.5 2.5 0 002.5-2.5v-7a2.5 2.5 0 00-2.5-2.5z"/>
                    </svg>
                </div>

                <div class="min-w-0">
                    <h3 class="font-bold text-[#355779] dark:text-[#D8E9FC]">
                        Semester {{ $periodeAktif->semester }}
                    </h3>
                    <p class="text-sm text-[#587A9B] dark:text-[#A9C4DF] mt-1">
                        Tahun Ajaran {{ $periodeAktif->tahun_ajaran }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

        {{-- TOTAL MAPEL --}}
        <div class="rounded-2xl border border-[#D5E5F2] dark:border-[#263E59] bg-gradient-to-br from-[#F0F6FC] to-[#E5F0FA] dark:from-[#172B46] dark:to-[#203A57] p-5 transition-shadow hover:shadow-md">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-xl bg-white/80 dark:bg-[#263E59] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-[#3478BD] dark:text-[#D8E9FC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 19V5M4 19h16M8 16v-5M12 16V8M16 16v-3"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-[#587A9B] dark:text-[#A9C4DF]">
                        Total Mata Pelajaran
                    </p>
                    <p class="text-2xl font-bold text-[#355779] dark:text-[#D8E9FC] mt-1">
                        {{ $totalMapel }}
                    </p>
                </div>
            </div>
        </div>

        {{-- NILAI TERBAIK --}}
        <div class="rounded-2xl border border-[#D5E5F2] dark:border-[#263E59] bg-gradient-to-br from-[#F0F6FC] to-[#E5F0FA] dark:from-[#172B46] dark:to-[#203A57] p-5 transition-shadow hover:shadow-md">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-xl bg-white/80 dark:bg-[#263E59] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-[#3478BD] dark:text-[#D8E9FC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17l6-6 4 4 8-8"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 7h7v7"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-[#587A9B] dark:text-[#A9C4DF]">
                        Nilai Terbaik
                    </p>
                    <p class="text-2xl font-bold text-[#355779] dark:text-[#D8E9FC] mt-1">
                        {{ $nilaiTerbaik !== null ? number_format((float) $nilaiTerbaik, 2) : 'Belum Ada Nilai' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- STATUS AKADEMIK --}}
        <div class="rounded-2xl border border-[#D5E5F2] dark:border-[#263E59] bg-gradient-to-br from-[#F0F6FC] to-[#E5F0FA] dark:from-[#172B46] dark:to-[#203A57] p-5 transition-shadow hover:shadow-md sm:col-span-2 xl:col-span-1">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-xl bg-white/80 dark:bg-[#263E59] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-[#3478BD] dark:text-[#D8E9FC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                        <circle cx="12" cy="12" r="9" stroke-width="2"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-[#587A9B] dark:text-[#A9C4DF]">
                        Status Akademik
                    </p>
                    <p class="text-xl font-bold text-emerald-600 dark:text-emerald-400 mt-1">
                        Aktif
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL NILAI --}}
    <div class="dashboard-card rounded-2xl border shadow-sm overflow-hidden">

        {{-- JUDUL TABEL --}}
        <div class="p-5 sm:p-6 border-b border-[#D5E5F2] dark:border-slate-700 bg-gradient-to-r from-[#DCEBFA] to-[#EDF5FC] dark:from-[#172B46] dark:to-[#203A57]">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/80 dark:bg-[#263E59] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-[#3478BD] dark:text-[#D8E9FC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6M9 16h6M9 8h6"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h3 class="text-lg font-bold text-[#355779] dark:text-[#D8E9FC]">
                        Nilai Mata Pelajaran
                    </h3>
                    <p class="text-sm text-[#587A9B] dark:text-[#A9C4DF] mt-1">
                        @if($periodeAktif)
                            Semester {{ $periodeAktif->semester }}
                            - Tahun Ajaran {{ $periodeAktif->tahun_ajaran }}
                        @else
                            Belum ada periode nilai
                        @endif
                    </p>
                </div>
            </div>
        </div>

        {{-- BELUM ADA PERIODE --}}
        @if($semesterList->isEmpty())
            <div class="p-10 text-center">
                <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-[#EAF3FB] dark:bg-[#172B46] flex items-center justify-center">
                    <svg class="w-7 h-7 text-[#789BBB] dark:text-[#A9C4DF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.25v13.5M5.5 4.75h4a2.5 2.5 0 012.5 2.5v12a2.5 2.5 0 00-2.5-2.5h-4a2.5 2.5 0 01-2.5-2.5v-7a2.5 2.5 0 012.5-2.5z"/>
                    </svg>
                </div>
                <h3 class="font-bold card-title">Belum Ada Nilai</h3>
                <p class="text-sm card-muted mt-2">
                    Nilai kamu belum tersedia saat ini.
                </p>
            </div>

        {{-- BELUM ADA MAPEL --}}
        @elseif($nilais->isEmpty())
            <div class="p-10 text-center">
                <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-[#EAF3FB] dark:bg-[#172B46] flex items-center justify-center">
                    <svg class="w-7 h-7 text-[#789BBB] dark:text-[#A9C4DF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h14v14H5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9h8M8 13h5"/>
                    </svg>
                </div>
                <h3 class="font-bold card-title">Belum Ada Mata Pelajaran</h3>
                <p class="text-sm card-muted mt-2">
                    Belum ada mata pelajaran untuk periode yang dipilih.
                </p>
            </div>

        {{-- DATA NILAI --}}
        @else
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1100px] text-sm">
                    <thead class="bg-[#DCEBFA] dark:bg-[#203A57] border-b border-[#C9DCEC] dark:border-slate-700">
                        <tr>
                            <th class="px-5 py-4 text-left font-bold text-[#355779] dark:text-[#D8E9FC]">No</th>
                            <th class="px-5 py-4 text-left font-bold text-[#355779] dark:text-[#D8E9FC]">Mata Pelajaran</th>
                            <th class="px-5 py-4 text-center font-bold text-[#355779] dark:text-[#D8E9FC]">Semester</th>
                            <th class="px-5 py-4 text-center font-bold text-[#355779] dark:text-[#D8E9FC]">Harian</th>
                            <th class="px-5 py-4 text-center font-bold text-[#355779] dark:text-[#D8E9FC]">UTS</th>
                            <th class="px-5 py-4 text-center font-bold text-[#355779] dark:text-[#D8E9FC]">UAS</th>
                            <th class="px-5 py-4 text-center font-bold text-[#355779] dark:text-[#D8E9FC]">Nilai Akhir</th>
                            <th class="px-5 py-4 text-center font-bold text-[#355779] dark:text-[#D8E9FC]">KKM</th>
                            <th class="px-5 py-4 text-center font-bold text-[#355779] dark:text-[#D8E9FC]">Status Ketuntasan</th>
                            <th class="px-5 py-4 text-center font-bold text-[#355779] dark:text-[#D8E9FC]">Predikat</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @foreach($nilais as $index => $nilai)
                            @php
                                $nilaiHarianValid = $nilai->nilai_harian !== null
                                    && $nilai->nilai_harian !== ''
                                    && is_numeric($nilai->nilai_harian);

                                $nilaiUtsValid = $nilai->nilai_uts !== null
                                    && $nilai->nilai_uts !== ''
                                    && is_numeric($nilai->nilai_uts);

                                $nilaiUasValid = $nilai->nilai_uas !== null
                                    && $nilai->nilai_uas !== ''
                                    && is_numeric($nilai->nilai_uas);

                                $nilaiAkhirValid = $nilai->nilai_akhir !== null
                                    && $nilai->nilai_akhir !== ''
                                    && is_numeric($nilai->nilai_akhir);

                                $kkmValid = $nilai->mapel
                                    && $nilai->mapel->kkm !== null
                                    && $nilai->mapel->kkm !== ''
                                    && is_numeric($nilai->mapel->kkm);

                                if (!$nilaiAkhirValid) {
                                    $statusKetuntasan = 'Belum Ada Nilai';
                                } elseif (!$kkmValid) {
                                    $statusKetuntasan = 'KKM Belum Diatur';
                                } elseif ((float) $nilai->nilai_akhir >= (float) $nilai->mapel->kkm) {
                                    $statusKetuntasan = 'Tuntas';
                                } else {
                                    $statusKetuntasan = 'Belum Tuntas';
                                }

                                $statusClass = match($statusKetuntasan) {
                                    'Tuntas' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300',
                                    'Belum Tuntas' => 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300',
                                    default => 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300',
                                };

                                $badge = match($nilai->predikat) {
                                    'A' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300',
                                    'B' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300',
                                    'C' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300',
                                    'D' => 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300',
                                    default => 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300',
                                };
                            @endphp

                            <tr class="hover:bg-[#F0F6FC] dark:hover:bg-slate-700/40 transition-colors">
                                <td class="px-5 py-4 text-slate-500 dark:text-slate-400 font-medium">
                                    {{ ($pagination->firstItem() ?? 1) + $index }}
                                </td>

                                <td class="px-5 py-4">
                                    <div class="font-semibold card-title">
                                        {{ $nilai->mapel->nama_mapel ?? 'Mata Pelajaran Belum Tersedia' }}
                                    </div>
                                </td>

                                <td class="px-5 py-4 text-center">
                                    <span class="inline-flex px-3 py-1 rounded-full bg-[#E3F0FA] dark:bg-[#172B46] text-[#3478BD] dark:text-[#8DB9E8] text-xs font-bold whitespace-nowrap">
                                        {{ $nilai->rapor->semester ?? 'Belum Ditentukan' }}
                                    </span>
                                </td>

                                <td class="px-5 py-4 text-center text-slate-700 dark:text-slate-200 font-semibold whitespace-nowrap">
                                    {{ $nilaiHarianValid ? number_format((float) $nilai->nilai_harian, 2) : 'Belum Ada Nilai' }}
                                </td>

                                <td class="px-5 py-4 text-center text-slate-700 dark:text-slate-200 font-semibold whitespace-nowrap">
                                    {{ $nilaiUtsValid ? number_format((float) $nilai->nilai_uts, 2) : 'Belum Ada Nilai' }}
                                </td>

                                <td class="px-5 py-4 text-center text-slate-700 dark:text-slate-200 font-semibold whitespace-nowrap">
                                    {{ $nilaiUasValid ? number_format((float) $nilai->nilai_uas, 2) : 'Belum Ada Nilai' }}
                                </td>

                                <td class="px-5 py-4 text-center whitespace-nowrap">
                                    @if($nilaiAkhirValid)
                                        <span class="inline-flex items-center justify-center min-w-14 px-3 py-1.5 rounded-lg bg-[#DCEBFA] dark:bg-[#203A57] text-[#28649F] dark:text-[#D8E9FC] font-bold">
                                            {{ number_format((float) $nilai->nilai_akhir, 2) }}
                                        </span>
                                    @else
                                        <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">
                                            Belum Ada Nilai
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4 text-center text-slate-700 dark:text-slate-200 font-semibold whitespace-nowrap">
                                    {{ $kkmValid ? number_format((float) $nilai->mapel->kkm, 0) : 'KKM Belum Diatur' }}
                                </td>

                                <td class="px-5 py-4 text-center">
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold whitespace-nowrap {{ $statusClass }}">
                                        {{ $statusKetuntasan }}
                                    </span>
                                </td>

                                <td class="px-5 py-4 text-center whitespace-nowrap">
                                    @if(in_array($nilai->predikat, ['A', 'B', 'C', 'D']))
                                        <span class="inline-flex min-w-8 justify-center px-3 py-1 rounded-full text-xs font-bold {{ $badge }}">
                                            {{ $nilai->predikat }}
                                        </span>
                                    @else
                                        <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">
                                            Belum Ada Predikat
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- NAVIGASI HALAMAN --}}
            @if($pagination->lastPage() > 1)
                <div class="px-5 py-4 border-t border-[#D5E5F2] dark:border-slate-700 bg-[#F7FAFD] dark:bg-slate-800/50 flex items-center justify-between gap-3">

                    {{-- SEBELUMNYA --}}
                    @if($pagination->onFirstPage())
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-400 dark:text-slate-500 text-sm font-semibold cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Sebelumnya
                        </span>
                    @else
                        <a href="{{ $pagination->previousPageUrl() }}"
                           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#E3F0FA] dark:bg-[#172B46] text-[#3478BD] dark:text-[#D8E9FC] text-sm font-semibold hover:bg-[#D4E7F7] dark:hover:bg-[#263E59] transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Sebelumnya
                        </a>
                    @endif

                    {{-- SELANJUTNYA --}}
                    @if($pagination->hasMorePages())
                        <a href="{{ $pagination->nextPageUrl() }}"
                           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#3478BD] hover:bg-[#28649F] text-white text-sm font-semibold transition">
                            Selanjutnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    @else
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-400 dark:text-slate-500 text-sm font-semibold cursor-not-allowed">
                            Selanjutnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    @endif

                </div>
            @endif
        @endif
    </div>
</div>
@endsection