@extends('layouts.siswa')

@section('title', 'Dashboard Siswa - Sistem Akademik')
@section('page-title', 'Dashboard Siswa')
@section('page-subtitle', 'Pantau perkembangan akademik kamu')

@push('styles')
<style>
.dashboard-page {
    --dash-border: #D5E1ED;
    --dash-card: #FFFFFF;
}

.dashboard-page .dash-enter {
    animation: dashEnter .4s ease-out both;
}
.dashboard-page .dash-delay-1 { animation-delay: .06s; }
.dashboard-page .dash-delay-2 { animation-delay: .12s; }
.dashboard-page .dash-delay-3 { animation-delay: .18s; }

@keyframes dashEnter {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}

/* HERO */
.dashboard-page .dashboard-hero {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    border: 1px solid #B8D2EB;
    border-radius: 18px;
    background: linear-gradient(115deg,#B8D8F8 0%,#D4E8FC 52%,#EAF3FC 100%);
    box-shadow: 0 5px 14px rgba(48,105,166,.07);
}
.dashboard-page .hero-eyebrow { color: #315E8D; }
.dashboard-page .hero-title {
    color: #1C4169;
    letter-spacing: -.7px;
}
.dashboard-page .hero-description { color: #405D7B; }
.dashboard-page .hero-accent-line {
    width: 42px;
    height: 4px;
    border-radius: 20px;
    background: #3478BD;
}
.dashboard-page .hero-icon-box {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 88px;
    height: 88px;
    flex-shrink: 0;
    border: 1px solid rgba(255,255,255,.85);
    border-radius: 20px;
    background: rgba(255,255,255,.65);
    box-shadow: 0 5px 12px rgba(51,105,161,.08);
}
.dashboard-page .hero-icon-box svg { color: #3478BD; }

/* KARTU */
.dashboard-page .dashboard-card {
    position: relative;
    min-width: 0;
    overflow: hidden;
    background: var(--dash-card);
    border: 1px solid var(--dash-border);
    border-radius: 16px;
    box-shadow: 0 3px 9px rgba(39,77,119,.045);
    transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
}
.dashboard-page .dashboard-card:hover {
    transform: translateY(-2px);
    border-color: #B5CDE5;
    box-shadow: 0 7px 16px rgba(42,91,143,.08);
}
.dashboard-page .stat-card {
    background: #F8FAFC;
    border-color: #D5E1ED;
}
.dashboard-page .stat-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: #89AAD7;
}
.dashboard-page .card-title { color: #26374A; }
.dashboard-page .card-muted { color: #60748B; }
.dashboard-page .stat-number {
    color: #26374A;
    line-height: 1.15;
    font-variant-numeric: tabular-nums;
}
.dashboard-page .stat-icon,
.dashboard-page .quick-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 54px;
    height: 54px;
    flex-shrink: 0;
    border: 1px solid #C3D8EB;
    border-radius: 14px;
    background: #E3F0FA;
    color: #355779;
}
.dashboard-page .section-indicator {
    display: inline-block;
    width: 4px;
    height: 35px;
    flex-shrink: 0;
    border-radius: 10px;
    background: #527DAE;
}

/* TABEL */
.dashboard-page .dashboard-section-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    padding: 20px 23px;
    border-bottom: 1px solid #D6E4F2;
    background: #F8FBFF;
}
.dashboard-page .section-title { color: #26374A; }
.dashboard-page .section-description { color: #60748B; }
.dashboard-page .dashboard-table {
    width: 100%;
    min-width: 650px;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 13px;
}
.dashboard-page .dashboard-table thead th {
    padding: 14px 20px;
    text-align: left;
    white-space: nowrap;
    font-weight: 800;
    color: #294F79;
    background: #E5F0FB;
    border-bottom: 1px solid #C9DDF1;
}
.dashboard-page .dashboard-table tbody td {
    padding: 14px 20px;
    border-bottom: 1px solid #E5EDF5;
    vertical-align: middle;
}
.dashboard-page .dashboard-table tbody tr { background: #FFFFFF; }
.dashboard-page .dashboard-table tbody tr:nth-child(even) {
    background: #F8FBFF;
}
.dashboard-page .dashboard-table tbody tr:hover {
    background: #EEF6FF;
}
.dashboard-page .dashboard-table tbody tr:last-child td {
    border-bottom: 0;
}
.dashboard-page .table-text { color: #30445B; }
.dashboard-page .table-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 10px;
    border: 1px solid #C3D8EB;
    border-radius: 8px;
    background: #E3F0FA;
    color: #294F79;
    font-size: 11px;
    font-weight: 800;
}
.dashboard-page .grade-a {
    background: #E5F6EC;
    border-color: #B8E4C8;
    color: #237548;
}
.dashboard-page .grade-b {
    background: #E3F0FA;
    border-color: #C3D8EB;
    color: #294F79;
}
.dashboard-page .grade-c {
    background: #FFF4D9;
    border-color: #F2D99A;
    color: #956515;
}
.dashboard-page .grade-d {
    background: #FCE8E8;
    border-color: #F2C2C2;
    color: #B43B3B;
}
.dashboard-page .dashboard-empty {
    padding: 42px 22px !important;
    text-align: center;
    background: #FFFFFF !important;
}
.dashboard-page .empty-icon-box {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 52px;
    height: 52px;
    margin: 0 auto 12px;
    border: 1px solid #C9DFF5;
    border-radius: 14px;
    background: #EAF3FC;
    color: #477EB9;
}

/* MENU */
.dashboard-page .quick-card {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 19px;
    text-decoration: none;
}
.dashboard-page .quick-card .quick-icon {
    transition: transform .2s ease, background .2s ease;
}
.dashboard-page .quick-card:hover .quick-icon {
    transform: translateY(-2px);
    background: #D5E9FA;
}
.dashboard-page .quick-arrow {
    color: #60748B;
    transition: transform .2s ease, color .2s ease;
}
.dashboard-page .quick-card:hover .quick-arrow {
    color: #3478BD;
    transform: translateX(3px);
}

/* INFORMASI */
.dashboard-page .info-panel {
    padding: 20px 23px;
    border: 1px solid #D5E1ED;
    border-radius: 16px;
    background: #F8FBFF;
}
.dashboard-page .dashboard-footer {
    padding: 18px 12px 10px;
    text-align: center;
}
.dashboard-page .dashboard-footer::before {
    content: "";
    display: block;
    width: 48px;
    height: 3px;
    margin: 0 auto 13px;
    border-radius: 20px;
    background: #89AAD7;
}

/* DARK MODE */
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .dashboard-hero {
    background: linear-gradient(115deg,#17283D 0%,#1C3049 55%,#243E59 100%) !important;
    border-color: #3B5878 !important;
}
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .hero-eyebrow { color: #AFCBEA !important; }

:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .hero-title { color: #F1F6FC !important; }

:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .hero-description,
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .card-muted,
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .section-description {
    color: #AFC0D4 !important;
}
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .hero-icon-box,
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .stat-icon,
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .quick-icon,
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .table-badge,
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .empty-icon-box {
    background: #263E59 !important;
    border-color: #405B78 !important;
    color: #D8E9FC !important;
}
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .dashboard-card {
    background: #192438 !important;
    border-color: #34465F !important;
    box-shadow: 0 3px 10px rgba(0,0,0,.14) !important;
}
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .stat-card {
    background: #1C2B3E !important;
    border-color: #354A62 !important;
}
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .card-title,
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .stat-number,
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .section-title {
    color: #F1F6FC !important;
}
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .dashboard-section-head,
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .info-panel {
    background: #1C2C42 !important;
    border-color: #34465F !important;
}
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .dashboard-table thead th {
    color: #DDEBFC !important;
    background: #263A53 !important;
    border-color: #3A4D66 !important;
}
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .dashboard-table tbody tr,
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .dashboard-empty {
    background: #192438 !important;
}
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .dashboard-table tbody tr:hover {
    background: #24354C !important;
}
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .dashboard-table tbody td {
    border-color: #34465F !important;
}
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .table-text {
    color: #E1EAF5 !important;
}
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .grade-a {
    background: #173D2B !important;
    border-color: #286044 !important;
    color: #A8E2BE !important;
}
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .grade-b {
    background: #263E59 !important;
    border-color: #405B78 !important;
    color: #D8E9FC !important;
}
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .grade-c {
    background: #49391C !important;
    border-color: #76602D !important;
    color: #F4D58C !important;
}
:is(
    html.dark, body.dark, html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .grade-d {
    background: #492626 !important;
    border-color: #754040 !important;
    color: #F2B5B5 !important;
}

/* RESPONSIVE */
@media (max-width: 767px) {
    .dashboard-page .dashboard-hero { border-radius: 15px; }
    .dashboard-page .dashboard-hero-content { padding: 23px 20px; }
    .dashboard-page .hero-icon-box { width: 65px; height: 65px; }
    .dashboard-page .dashboard-section-head { padding: 17px 16px; }
    .dashboard-page .dashboard-table thead th,
    .dashboard-page .dashboard-table tbody td {
        padding: 12px 14px;
    }
}
@media (prefers-reduced-motion: reduce) {
    .dashboard-page *,
    .dashboard-page *::before,
    .dashboard-page *::after {
        animation: none !important;
        transition: none !important;
    }
}
</style>
@endpush

@section('content')
<div class="dashboard-page space-y-6">

    {{-- HERO SISWA --}}
    <section class="dashboard-hero dash-enter">
        <div class="dashboard-hero-content relative z-10 flex items-center justify-between gap-5 px-7 py-7 sm:px-8 sm:py-8">
            <div class="min-w-0">
                <div class="flex items-center gap-2 mb-3">
                    <span class="hero-accent-line"></span>
                    <p class="hero-eyebrow text-xs sm:text-sm font-extrabold tracking-wide">
                        SELAMAT DATANG KEMBALI
                    </p>
                </div>

                <h2 class="hero-title text-2xl sm:text-3xl font-extrabold">
                    Halo, {{ $namaSiswa }}!
                </h2>

                <p class="hero-description text-sm mt-3 max-w-xl leading-relaxed">
                    Pantau nilai dan perkembangan akademik kamu melalui dashboard siswa.
                </p>
            </div>

            <div class="hero-icon-box hidden sm:flex">
                <svg class="w-12 h-12" fill="none" stroke="currentColor"
                     stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 14l9-5-9-5-9 5 9 5zM5 12v5c3.5 3 10.5 3 14 0v-5M21 9v6"/>
                </svg>
            </div>
        </div>
    </section>

    {{-- RINGKASAN AKADEMIK --}}
    <section class="dash-enter dash-delay-1">
        <div class="flex items-center gap-3 mb-4">
            <span class="section-indicator"></span>
            <div>
                <h3 class="text-base font-extrabold card-title">Ringkasan Akademik</h3>
                <p class="text-xs card-muted mt-1">
                    Informasi kelas dan perkembangan nilai kamu
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

            {{-- KELAS --}}
            <article class="dashboard-card stat-card p-5">
                <div class="relative z-10 flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-bold card-muted">Kelas</p>
                        <p class="stat-number text-2xl font-extrabold mt-3">
                            {{ $siswa->kelas ?? '-' }}
                        </p>
                        <p class="text-xs card-muted mt-2">Kelas kamu saat ini</p>
                    </div>
                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                             stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5"/>
                        </svg>
                    </div>
                </div>
            </article>

            {{-- RATA-RATA --}}
            <article class="dashboard-card stat-card p-5">
                <div class="relative z-10 flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-bold card-muted">Rata-rata Nilai</p>
                        <p class="stat-number text-3xl font-extrabold mt-3">
                            {{ number_format((float) ($avgNilai ?? 0), 2) }}
                        </p>
                        <p class="text-xs card-muted mt-2">Rata-rata nilai akademik</p>
                    </div>
                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                             stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4 19V5M4 19h16M8 16v-5M12 16V8M16 16v-3"/>
                        </svg>
                    </div>
                </div>
            </article>

            {{-- MAPEL DINILAI --}}
            <article class="dashboard-card stat-card p-5 sm:col-span-2 xl:col-span-1">
                <div class="relative z-10 flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-bold card-muted">Mata Pelajaran Dinilai</p>
                        <p class="stat-number text-3xl font-extrabold mt-3">
                            {{ $totalMapelDinilai ?? 0 }}
                        </p>
                        <p class="text-xs card-muted mt-2">Mata pelajaran yang sudah dinilai</p>
                    </div>
                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                             stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                        </svg>
                    </div>
                </div>
            </article>
        </div>
    </section>

    {{-- NILAI TERBARU --}}
    <section class="dashboard-card dash-enter dash-delay-2">
        <div class="dashboard-section-head">
            <div class="flex items-center gap-3 min-w-0">
                <span class="section-indicator"></span>
                <div class="min-w-0">
                    <h3 class="section-title text-base font-extrabold">Nilai Terbaru</h3>
                    <p class="section-description text-xs mt-1">
                        Daftar nilai akademik yang sudah kamu peroleh
                    </p>
                </div>
            </div>

            <a href="{{ route('siswa.nilai.index') }}"
               class="table-badge whitespace-nowrap">
                Lihat Semua
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Semester</th>
                        <th>Nilai Akhir</th>
                        <th>Predikat</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($nilaiTerbaru as $index => $nilai)
                        @php
                            $predikat = strtoupper($nilai->predikat ?? '-');

                            $predikatClass = match ($predikat) {
                                'A' => 'grade-a',
                                'B' => 'grade-b',
                                'C' => 'grade-c',
                                'D' => 'grade-d',
                                default => '',
                            };

                            $semester = strtolower((string) ($nilai->semester ?? ''));

                            $semesterLabel = in_array($semester, ['1', 'ganjil'])
                                ? 'Semester 1'
                                : (in_array($semester, ['2', 'genap'])
                                    ? 'Semester 2'
                                    : ($nilai->semester ?? '-'));
                        @endphp

                        <tr>
                            <td class="table-text font-semibold">
                                {{ $index + 1 }}
                            </td>

                            <td class="table-text font-bold">
                                {{ $nilai->mapel->nama_mapel ?? '-' }}
                            </td>

                            <td>
                                <span class="table-badge">
                                    {{ $semesterLabel }}
                                </span>
                            </td>

                            <td class="table-text font-extrabold">
                                {{ is_numeric($nilai->nilai_akhir)
                                    ? number_format((float) $nilai->nilai_akhir, 2)
                                    : ($nilai->nilai_akhir ?? '-') }}
                            </td>

                            <td>
                                <span class="table-badge {{ $predikatClass }}">
                                    {{ $predikat }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="dashboard-empty">
                                <div class="empty-icon-box">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                         stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                                    </svg>
                                </div>
                                <p class="font-bold table-text">Belum ada nilai</p>
                                <p class="text-xs card-muted mt-2">
                                    Nilai kamu akan muncul setelah guru menginput nilai.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- MENU CEPAT --}}
    <section class="dash-enter dash-delay-3">
        <div class="flex items-center gap-3 mb-4">
            <span class="section-indicator"></span>
            <div>
                <h3 class="text-base font-extrabold card-title">Menu Cepat</h3>
                <p class="text-xs card-muted mt-1">
                    Akses informasi akademik kamu
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

            {{-- NILAI SAYA --}}
            <a href="{{ route('siswa.nilai.index') }}"
               class="dashboard-card quick-card group">
                <div class="quick-icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                         stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-extrabold card-title">Nilai Saya</h4>
                    <p class="text-xs card-muted mt-1">Lihat nilai setiap mata pelajaran</p>
                </div>
                <svg class="quick-arrow w-5 h-5 shrink-0" fill="none"
                     stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>

            {{-- RAPOR SAYA --}}
            <a href="{{ route('siswa.rapor.index') }}"
               class="dashboard-card quick-card group">
                <div class="quick-icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                         stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 3h9l3 3v15H6V3z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 11h6M9 15h6M9 7h3"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-extrabold card-title">Rapor Saya</h4>
                    <p class="text-xs card-muted mt-1">Lihat rapor dan hasil belajar</p>
                </div>
                <svg class="quick-arrow w-5 h-5 shrink-0" fill="none"
                     stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </section>

    {{-- INFORMASI --}}
    <section class="info-panel dash-enter">
        <div class="flex items-start gap-3">
            <div class="quick-icon shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                     stroke-width="1.8" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="9"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 11v5M12 8h.01"/>
                </svg>
            </div>
            <div>
                <h3 class="font-extrabold card-title">Informasi Siswa</h3>
                <p class="text-sm card-muted mt-2 leading-relaxed">
                    Gunakan menu Nilai Saya untuk melihat hasil penilaian setiap mata pelajaran
                    dan menu Rapor Saya untuk melihat rekap hasil belajar setiap semester.
                </p>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="dashboard-footer">
        <p class="text-xs font-bold card-muted">Sistem Akademik Mini</p>
        <p class="text-xs card-muted mt-2">
            Pantau perkembangan akademikmu dengan mudah dan terstruktur.
        </p>
    </footer>

</div>
@endsection