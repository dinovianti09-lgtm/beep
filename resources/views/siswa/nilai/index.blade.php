
@extends('layouts.siswa')

@section('title', 'Nilai Saya - Sistem Akademik')
@section('page-title', 'Nilai Saya')
@section('page-subtitle', 'Lihat perkembangan nilai akademik kamu')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div class="dashboard-card rounded-2xl border shadow-sm p-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6M9 16h6M7 4h7l3 3v13H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 4v4h4"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold card-title">Nilai Saya</h2>
                    <p class="text-sm card-muted mt-1">Lihat seluruh perkembangan nilai akademik kamu.</p>
                </div>
            </div>

            <a href="{{ route('siswa.dashboard') }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-slate-800 dark:bg-slate-700 text-white text-sm font-semibold hover:bg-slate-700 dark:hover:bg-slate-600 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Dashboard
            </a>
        </div>
    </div>

    {{-- PILIH PERIODE --}}
    <div class="dashboard-card rounded-2xl border shadow-sm p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="min-w-0">
                <h3 class="text-base font-bold card-title">Pilih Semester</h3>
                <p class="text-sm card-muted mt-1">Pilih semester dan tahun ajaran yang ingin kamu lihat.</p>
            </div>

            @if($semesterList->isNotEmpty())
                <form method="GET" action="{{ route('siswa.nilai.index') }}" class="w-full md:w-80 md:flex-shrink-0">
                    <label for="semester-nilai" class="sr-only">Pilih semester dan tahun ajaran</label>
                    <select
                        id="semester-nilai"
                        name="semester"
                        onchange="this.form.submit()"
                        class="block w-full min-w-0 box-border px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-sm font-semibold leading-5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        @foreach($semesterList as $periode)
                            <option
                                value="{{ $periode->id_rapor }}"
                                {{ (string) $semesterDipilih === (string) $periode->id_rapor ? 'selected' : '' }}
                            >{{ $periode->semester }} - Tahun Ajaran {{ $periode->tahun_ajaran }}</option>
                        @endforeach
                    </select>
                </form>
            @else
                <div class="w-full md:w-80 px-4 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 text-sm text-slate-500 dark:text-slate-400">
                    Belum ada periode nilai
                </div>
            @endif
        </div>
    </div>

    {{-- INFORMASI PERIODE --}}
    @php
        $periodeAktif = $semesterList->first(
            fn ($periode) => (string) $periode->id_rapor === (string) $semesterDipilih
        );
    @endphp

    @if($periodeAktif)
        <div class="dashboard-card rounded-2xl border shadow-sm p-5">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-xl bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.25v13.5M5.5 4.75h4a2.5 2.5 0 012.5 2.5v12a2.5 2.5 0 00-2.5-2.5h-4a2.5 2.5 0 01-2.5-2.5v-7a2.5 2.5 0 012.5-2.5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 4.75h-4a2.5 2.5 0 00-2.5 2.5v12a2.5 2.5 0 012.5-2.5h4a2.5 2.5 0 002.5-2.5v-7a2.5 2.5 0 00-2.5-2.5z"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h3 class="font-bold card-title">
                        Semester {{ $periodeAktif->semester }}
                    </h3>
                    <p class="text-sm card-muted mt-1">
                        Tahun Ajaran {{ $periodeAktif->tahun_ajaran }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        <div class="dashboard-card rounded-2xl border shadow-sm p-6 transition-smooth hover:shadow-md">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 19V5M4 19h16M8 16v-5M12 16V8M16 16v-3"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm card-muted">Total Mata Pelajaran</p>
                    <p class="text-2xl font-bold card-title mt-1">{{ $nilais->count() }}</p>
                </div>
            </div>
        </div>

        <div class="dashboard-card rounded-2xl border shadow-sm p-6 transition-smooth hover:shadow-md">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-xl bg-green-100 dark:bg-green-900/40 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17l6-6 4 4 8-8"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 7h7v7"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm card-muted">Nilai Terbaik</p>
                    <p class="text-2xl font-bold card-title mt-1">
                        @php
                            $nilaiTerisi = $nilais->filter(
                                fn ($item) => $item->nilai_akhir !== null
                                    && $item->nilai_akhir !== ''
                                    && is_numeric($item->nilai_akhir)
                            );
                        @endphp
                        {{ $nilaiTerisi->isNotEmpty() ? number_format((float) $nilaiTerisi->max('nilai_akhir'), 2) : '-' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="dashboard-card rounded-2xl border shadow-sm p-6 transition-smooth hover:shadow-md">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-xl bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                        <circle cx="12" cy="12" r="9" stroke-width="2"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm card-muted">Status Akademik</p>
                    <p class="text-xl font-bold text-emerald-600 dark:text-emerald-400 mt-1">Aktif</p>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL NILAI --}}
    <div class="dashboard-card rounded-2xl border shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-200 dark:border-slate-700">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6M9 16h6M9 8h6"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold card-title">Nilai Mata Pelajaran</h3>
                    <p class="text-sm card-muted mt-1">
                        @if($periodeAktif)
                            Semester {{ $periodeAktif->semester }} - Tahun Ajaran {{ $periodeAktif->tahun_ajaran }}
                        @else
                            Belum ada periode nilai
                        @endif
                    </p>
                </div>
            </div>
        </div>

        @if($semesterList->isEmpty())
            <div class="p-10 text-center">
                <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center">
                    <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.25v13.5M5.5 4.75h4a2.5 2.5 0 012.5 2.5v12a2.5 2.5 0 00-2.5-2.5h-4a2.5 2.5 0 01-2.5-2.5v-7a2.5 2.5 0 012.5-2.5z"/>
                    </svg>
                </div>
                <h3 class="font-bold card-title">Belum Ada Nilai</h3>
                <p class="text-sm card-muted mt-2">Nilai kamu belum tersedia saat ini.</p>
            </div>

        @elseif($nilais->isEmpty())
            <div class="p-10 text-center">
                <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center">
                    <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h14v14H5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9h8M8 13h5"/>
                    </svg>
                </div>
                <h3 class="font-bold card-title">Belum Ada Nilai</h3>
                <p class="text-sm card-muted mt-2">Belum ada nilai untuk periode yang dipilih.</p>
            </div>

        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th class="px-5 py-4 text-left font-semibold text-slate-600 dark:text-slate-300">No</th>
                            <th class="px-5 py-4 text-left font-semibold text-slate-600 dark:text-slate-300">Mata Pelajaran</th>
                            <th class="px-5 py-4 text-center font-semibold text-slate-600 dark:text-slate-300">Semester</th>
                            <th class="px-5 py-4 text-center font-semibold text-slate-600 dark:text-slate-300">Harian</th>
                            <th class="px-5 py-4 text-center font-semibold text-slate-600 dark:text-slate-300">UTS</th>
                            <th class="px-5 py-4 text-center font-semibold text-slate-600 dark:text-slate-300">UAS</th>
                            <th class="px-5 py-4 text-center font-semibold text-slate-600 dark:text-slate-300">Nilai Akhir</th>
                            <th class="px-5 py-4 text-center font-semibold text-slate-600 dark:text-slate-300">KKM</th>
                            <th class="px-5 py-4 text-center font-semibold text-slate-600 dark:text-slate-300">Status Ketuntasan</th>
                            <th class="px-5 py-4 text-center font-semibold text-slate-600 dark:text-slate-300">Predikat</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @foreach($nilais as $index => $nilai)
                            @php
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

                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition">
                                <td class="px-5 py-4 text-slate-500 dark:text-slate-400">{{ $index + 1 }}</td>

                                <td class="px-5 py-4">
                                    <div class="font-semibold card-title">{{ $nilai->mapel->nama_mapel ?? '-' }}</div>
                                </td>

                                <td class="px-5 py-4 text-center">
                                    <span class="inline-flex px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-semibold whitespace-nowrap">
                                        {{ $nilai->rapor->semester ?? '-' }}
                                    </span>
                                </td>

                                <td class="px-5 py-4 text-center text-slate-700 dark:text-slate-300">
                                    {{ $nilai->nilai_harian ?? '-' }}
                                </td>

                                <td class="px-5 py-4 text-center text-slate-700 dark:text-slate-300">
                                    {{ $nilai->nilai_uts ?? '-' }}
                                </td>

                                <td class="px-5 py-4 text-center text-slate-700 dark:text-slate-300">
                                    {{ $nilai->nilai_uas ?? '-' }}
                                </td>

                                <td class="px-5 py-4 text-center">
                                    <span class="inline-flex items-center justify-center min-w-12 px-3 py-1 rounded-lg bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold">
                                        {{ $nilaiAkhirValid ? number_format((float) $nilai->nilai_akhir, 2) : '-' }}
                                    </span>
                                </td>

                                {{-- KKM --}}
                                <td class="px-5 py-4 text-center text-slate-700 dark:text-slate-300">
                                    {{ $kkmValid ? $nilai->mapel->kkm : '-' }}
                                </td>

                                {{-- STATUS KETUNTASAN --}}
                                <td class="px-5 py-4 text-center">
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold whitespace-nowrap {{ $statusClass }}">
                                        {{ $statusKetuntasan }}
                                    </span>
                                </td>

                                {{-- PREDIKAT --}}
                                <td class="px-5 py-4 text-center">
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold {{ $badge }}">
                                        {{ $nilai->predikat ?? '-' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
