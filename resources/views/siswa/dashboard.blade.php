 @extends('layouts.siswa')

@section('title', 'Dashboard Siswa - Sistem Akademik')

@section('page-title', 'Dashboard Siswa')

@section('page-subtitle', 'Pantau perkembangan akademik kamu')

@section('content')

<div class="space-y-6">

    {{-- WELCOME SISWA --}}
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
                        Pantau nilai, perkembangan akademik, dan rapormu melalui dashboard siswa.
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

    {{-- STATISTIK UTAMA: STRUKTUR DISAMAKAN DENGAN DASHBOARD GURU --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

        {{-- KELAS --}}
        <div class="dashboard-card rounded-2xl border shadow-sm p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium card-muted">Kelas</p>

                    <p class="text-2xl font-extrabold card-title mt-2">
                        {{ $siswa->kelas ?? '-' }}
                    </p>

                    <p class="text-xs card-muted mt-1">
                        Kelas kamu saat ini
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- RATA-RATA NILAI --}}
        <div class="dashboard-card rounded-2xl border shadow-sm p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium card-muted">Rata-rata Nilai</p>

                    <p class="text-3xl font-extrabold card-title mt-2">
                        {{ number_format((float) ($avgNilai ?? 0), 2) }}
                    </p>

                    <p class="text-xs card-muted mt-1">
                        Rata-rata nilai akademik
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M7 16l4-5 3 3 6-7"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- MATA PELAJARAN --}}
        <div class="dashboard-card rounded-2xl border shadow-sm p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium card-muted">Mata Pelajaran Dinilai</p>

                    <p class="text-3xl font-extrabold card-title mt-2">
                        {{ $totalMapelDinilai ?? 0 }}
                    </p>

                    <p class="text-xs card-muted mt-1">
                        Mapel yang sudah memiliki nilai
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

    {{-- NILAI TERBARU --}}
    <div class="dashboard-card rounded-2xl border shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b table-border flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h3 class="text-base font-bold card-title">
                    Nilai Terbaru
                </h3>

                <p class="text-xs card-muted mt-1">
                    Perkembangan nilai akademik kamu
                </p>
            </div>

            <a href="{{ route('siswa.nilai.index') }}"
               class="inline-flex items-center justify-center gap-2 w-fit px-4 py-2 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-700 dark:text-blue-300 text-sm font-semibold hover:bg-blue-100 dark:hover:bg-blue-500/20 transition">
                Lihat Semua

                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="table-header">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">No</th>
                        <th class="px-6 py-4 text-left font-semibold">Mata Pelajaran</th>
                        <th class="px-6 py-4 text-left font-semibold">Semester</th>
                        <th class="px-6 py-4 text-left font-semibold">Nilai Akhir</th>
                        <th class="px-6 py-4 text-left font-semibold">Predikat</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($nilaiTerbaru as $index => $nilai)
                        @php
                            $predikat = strtoupper($nilai->predikat ?? '-');

                            $predikatClass = match ($predikat) {
                                'A' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400',
                                'B' => 'bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400',
                                'C' => 'bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400',
                                'D' => 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400',
                                default => 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300',
                            };

                            $semester = strtolower((string) ($nilai->semester ?? ''));
                        @endphp

                        <tr class="table-row border-t table-border">
                            <td class="px-6 py-4 table-text">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="font-semibold table-text">
                                    {{ $nilai->mapel->nama_mapel ?? '-' }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                @if(in_array($semester, ['1', 'ganjil']))
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-700 dark:text-blue-300 text-xs font-semibold">
                                        Semester 1
                                    </span>
                                @elseif(in_array($semester, ['2', 'genap']))
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg bg-violet-50 dark:bg-violet-500/10 text-violet-700 dark:text-violet-300 text-xs font-semibold">
                                        Semester 2
                                    </span>
                                @else
                                    <span class="table-text">
                                        {{ $nilai->semester ?? '-' }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <span class="text-base font-extrabold table-text">
                                    {{ is_numeric($nilai->nilai_akhir) ? number_format((float) $nilai->nilai_akhir, 2) : ($nilai->nilai_akhir ?? '-') }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex items-center justify-center min-w-[38px] px-2.5 py-1 rounded-lg text-xs font-bold {{ $predikatClass }}">
                                    {{ $predikat }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6 card-muted" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 16h6M9 8h6"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h9l3 3v15H6V3z"/>
                                        </svg>
                                    </div>

                                    <p class="font-semibold table-text">
                                        Belum ada nilai
                                    </p>

                                    <p class="text-xs card-muted mt-1">
                                        Nilai akademik kamu belum tercatat.
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
            <h3 class="text-base font-bold card-title">
                Menu Cepat
            </h3>

            <p class="text-xs card-muted mt-1">
                Akses informasi akademik yang kamu butuhkan
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

            {{-- NILAI SAYA --}}
            <a href="{{ route('siswa.nilai.index') }}"
               class="dashboard-card group rounded-2xl border shadow-sm p-5 flex items-center gap-4 transition duration-300 hover:-translate-y-1 hover:shadow-md">

                <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 16h6M7 4h7l3 3v13H7a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 4v4h4"/>
                    </svg>
                </div>

                <div class="flex-1">
                    <h4 class="font-bold card-title group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">
                        Nilai Saya
                    </h4>

                    <p class="text-xs card-muted mt-1">
                        Lihat seluruh nilai akademik kamu
                    </p>
                </div>

                <svg class="w-5 h-5 card-muted group-hover:text-blue-600 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>

            {{-- RAPOR SAYA --}}
            <a href="{{ route('siswa.rapor.index') }}"
               class="dashboard-card group rounded-2xl border shadow-sm p-5 flex items-center gap-4 transition duration-300 hover:-translate-y-1 hover:shadow-md">

                <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h8l4 4v14H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 3v5h4M9 13h6M9 17h6"/>
                    </svg>
                </div>

                <div class="flex-1">
                    <h4 class="font-bold card-title group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition">
                        Rapor Saya
                    </h4>

                    <p class="text-xs card-muted mt-1">
                        Lihat rapor dan transkrip nilai kamu
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
            Pantau perkembangan akademikmu dengan mudah dan terstruktur.
        </p>
    </div>

</div>

@endsection