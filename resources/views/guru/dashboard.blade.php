@extends('layouts.guru')

@section('title', 'Dashboard Guru - Sistem Akademik')
@section('page-title', 'Dashboard Guru')
@section('page-subtitle', 'Kelola aktivitas akademik Anda')

@push('styles')
<style>
/* =====================================================
   EDUVIA GURU DASHBOARD
===================================================== */

.dashboard-page {
    --dash-border: #D5E1ED;
    --dash-card: #FFFFFF;
    min-width: 0;
    width: 100%;
}

.dashboard-page *,
.dashboard-page *::before,
.dashboard-page *::after {
    box-sizing: border-box;
}

/* ANIMASI */
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
    min-width: 0;
    border: 1px solid #B8D2EB;
    border-radius: 18px;
    background: linear-gradient(115deg, #B8D8F8 0%, #D4E8FC 52%, #EAF3FC 100%);
    box-shadow: 0 5px 14px rgba(48,105,166,.07);
}

.dashboard-page .dashboard-hero-content {
    min-width: 0;
}

.dashboard-page .hero-eyebrow { color: #315E8D; }

.dashboard-page .hero-title {
    color: #1C4169;
    letter-spacing: -.7px;
    overflow-wrap: anywhere;
}

.dashboard-page .hero-description { color: #405D7B; }

.dashboard-page .hero-accent-line {
    width: 42px;
    height: 4px;
    flex-shrink: 0;
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
    overflow-wrap: anywhere;
}

.dashboard-page .stat-icon {
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
    transition: transform .2s ease;
}

.dashboard-page .dashboard-card:hover .stat-icon {
    transform: translateY(-1px);
}

.dashboard-page .section-indicator {
    display: inline-block;
    width: 4px;
    height: 35px;
    flex-shrink: 0;
    border-radius: 10px;
    background: #527DAE;
}

/* HEADER SECTION */
.dashboard-page .dashboard-section-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    min-width: 0;
    padding: 20px 23px;

    /* KOTAK BIRU HEADER */
    background: #E3F0FA !important;
    background-color: #E3F0FA !important;
    border: 1px solid #C3D8EB !important;
    border-bottom: 1px solid #C3D8EB !important;
    border-radius: 15px 15px 0 0;
}

.dashboard-page .dashboard-section-head > div {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
    flex: 1;
}

.dashboard-page .dashboard-section-head > div > div {
    min-width: 0;
}

.dashboard-page .dashboard-section-head > span.table-badge {
    flex-shrink: 0;
    margin-left: auto;
}

.dashboard-page .section-title { color: #26374A; }
.dashboard-page .section-description { color: #60748B; }

/* TABEL */
.dashboard-page .dashboard-table {
    width: 100%;
    min-width: 680px;
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

.dashboard-page .dashboard-table tbody tr {
    background: #FFFFFF;
    transition: background .18s ease;
}

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

.dashboard-page .table-user-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    border: 1px solid #C3D8EB;
    border-radius: 11px;
    background: #E3F0FA;
    color: #355779;
}

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

/* MENU CEPAT */
.dashboard-page .quick-card {
    display: flex;
    align-items: center;
    gap: 15px;
    min-width: 0;
    min-height: 80px;
    padding: 19px;
    text-decoration: none;
}

.dashboard-page .quick-card .quick-icon {
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

/* FOOTER */
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
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .dashboard-hero {
    background: linear-gradient(115deg,#17283D 0%,#1C3049 55%,#243E59 100%) !important;
    border-color: #3B5878 !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .hero-eyebrow { color: #AFCBEA !important; }

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .hero-title { color: #F1F6FC !important; }

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .hero-description { color: #C0D0E2 !important; }

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .hero-icon-box {
    background: #263E59 !important;
    border-color: #405B78 !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .hero-icon-box svg { color: #D8E9FC !important; }

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .dashboard-card {
    background: #192438 !important;
    border-color: #34465F !important;
    box-shadow: 0 3px 10px rgba(0,0,0,.14) !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .stat-card {
    background: #1C2B3E !important;
    border-color: #354A62 !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .stat-card::before { background: #89AAD7 !important; }

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .card-title,
:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .stat-number,
:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .section-title {
    color: #F1F6FC !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .card-muted,
:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .section-description {
    color: #AFC0D4 !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .stat-icon,
:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .quick-icon {
    background: #263E59 !important;
    border-color: #405B78 !important;
    color: #D8E9FC !important;
}

/* HEADER SECTION DARK MODE */
:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .dashboard-section-head {
    background: #263E59 !important;
    background-color: #263E59 !important;
    border-color: #405B78 !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .dashboard-table thead th {
    color: #DDEBFC !important;
    background: #263A53 !important;
    border-color: #3A4D66 !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .dashboard-table tbody tr,
:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .dashboard-table tbody tr:nth-child(even) {
    background: #192438 !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .dashboard-table tbody tr:hover { background: #24354C !important; }

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .dashboard-table tbody td { border-color: #34465F !important; }

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .table-text { color: #E1EAF5 !important; }

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .table-user-icon,
:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .table-badge {
    background: #263E59 !important;
    border-color: #405B78 !important;
    color: #D8E9FC !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .dashboard-empty { background: #192438 !important; }

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .dashboard-page .empty-icon-box {
    background: #263E59 !important;
    border-color: #405B78 !important;
    color: #D8E9FC !important;
}

/* RESPONSIVE TABLET DAN HP */
@media (max-width: 767px) {
    .dashboard-page .dashboard-hero { border-radius: 15px; }

    .dashboard-page .dashboard-hero-content {
        padding: 23px 20px;
    }

    .dashboard-page .hero-icon-box {
        width: 65px;
        height: 65px;
    }

    .dashboard-page .dashboard-section-head {
        flex-wrap: wrap;
        align-items: center;
        padding: 17px 16px;
    }

    .dashboard-page .dashboard-section-head > div {
        flex-basis: 100%;
    }

    .dashboard-page .dashboard-section-head > span.table-badge {
        margin-left: auto;
    }

    .dashboard-page .dashboard-table thead th,
    .dashboard-page .dashboard-table tbody td {
        padding: 12px 14px;
    }

    .dashboard-page .quick-card {
        min-height: 80px;
        padding: 15px;
    }
}

/* HP LAYAR KECIL */
@media (max-width: 380px) {
    .dashboard-page .dashboard-hero-content {
        padding: 20px 16px;
    }

    .dashboard-page .dashboard-section-head {
        gap: 10px;
        padding: 15px 13px;
    }

    .dashboard-page .dashboard-section-head > div {
        flex-basis: 100%;
    }

    .dashboard-page .quick-card {
        gap: 11px;
        padding: 13px;
    }

    .dashboard-page .quick-card .quick-icon {
        width: 46px;
        height: 46px;
    }

    .dashboard-page .quick-arrow {
        width: 18px;
        height: 18px;
    }

    .dashboard-page .stat-icon {
        width: 46px;
        height: 46px;
    }
}

/* AKSESIBILITAS */
.dashboard-page a:focus-visible {
    outline: 3px solid rgba(52,120,189,.4);
    outline-offset: 3px;
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

    {{-- HERO GURU --}}
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
                    Halo, {{ $guru->nama_guru }}!
                </h2>

                <p class="hero-description text-sm mt-3 max-w-xl leading-relaxed">
                    Pantau aktivitas mengajar, data siswa, dan nilai akademik melalui dashboard guru.
                </p>
            </div>

            <div class="hero-icon-box hidden sm:flex">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zM5 12v5c3.5 3 10.5 3 14 0v-5M21 9v6"/>
                </svg>
            </div>
        </div>
    </section>

    {{-- RINGKASAN AKADEMIK --}}
    <section class="dash-enter dash-delay-1">
        <div class="flex items-center gap-3 mb-4">
            <span class="w-1 h-6 rounded-full bg-blue-600"></span>
            <div>
                <h3 class="text-base font-extrabold card-title">Ringkasan Akademik</h3>
                <p class="text-xs card-muted mt-1">
                    Informasi kelas dan mata pelajaran yang Anda ampu
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

            {{-- KELAS WALI --}}
            <article class="dashboard-card stat-card p-5">
                <div class="relative z-10 flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-sm font-bold card-muted">Kelas Wali</p>
                        <p class="stat-number text-2xl font-extrabold mt-3">
                            {{ $kelasWali->nama_kelas ?? '-' }}
                        </p>
                        <p class="text-xs card-muted mt-2">Kelas yang Anda bimbing</p>
                    </div>

                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5"/>
                        </svg>
                    </div>
                </div>
            </article>

            {{-- JUMLAH SISWA --}}
            <article class="dashboard-card stat-card p-5">
                <div class="relative z-10 flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-sm font-bold card-muted">Jumlah Siswa</p>
                        <p class="stat-number text-3xl font-extrabold mt-3">
                            {{ $jumlahSiswaWali }}
                        </p>
                        <p class="text-xs card-muted mt-2">Siswa terdaftar di kelas wali</p>
                    </div>

                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                </div>
            </article>

            {{-- MATA PELAJARAN --}}
            <article class="dashboard-card stat-card p-5 sm:col-span-2 xl:col-span-1">
                <div class="relative z-10 flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-sm font-bold card-muted">Mata Pelajaran</p>
                        <p class="stat-number text-2xl font-extrabold mt-3 break-words">
                            {{ $guru->mapel_diampu ?? '-' }}
                        </p>
                        <p class="text-xs card-muted mt-2">Mata pelajaran yang diampu</p>
                    </div>

                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                        </svg>
                    </div>
                </div>
            </article>

        </div>
    </section>

{{-- KELAS YANG DIAJAR --}}
<section class="dashboard-card dash-enter dash-delay-2">

    <div class="dashboard-section-head">
        <div>
            <span class="section-indicator"></span>

            <div>
                <h3 class="section-title text-base font-extrabold">
                    Kelas yang Diajar
                </h3>

                <p class="section-description text-xs mt-1">
                    Daftar kelas aktif sesuai pengaturan mata pelajaran Admin
                </p>
            </div>
        </div>

        <span class="table-badge whitespace-nowrap">
            {{ $jumlahKelasDiajar }} Kelas
        </span>
    </div>

    <div class="p-5 sm:p-6">

        @if($kelasDiajar->isNotEmpty())

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                @foreach($kelasDiajar as $kelas)

                    <div class="dashboard-card p-4 flex items-center gap-3">

                        <div class="table-user-icon">
                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5"/>
                            </svg>
                        </div>

                        <div class="min-w-0">
                            <p class="font-extrabold card-title">
                                {{ $kelas->nama_kelas }}
                            </p>

                            <p class="text-xs card-muted mt-1">
                                {{ $mapel->nama_mapel ?? 'Mata Pelajaran' }}
                            </p>
                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="text-center py-8">
                <div class="empty-icon-box">
                    <svg class="w-6 h-6"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5"/>
                    </svg>
                </div>

                <p class="font-bold card-title">
                    Belum Ada Kelas Aktif
                </p>

                <p class="text-xs card-muted mt-2">
                    Belum ada kelas yang sesuai dengan pengaturan
                    mata pelajaran dan penugasan Admin.
                </p>
            </div>

        @endif

    </div>
</section>


    {{-- DAFTAR SISWA --}}
    <section class="dashboard-card dash-enter dash-delay-2">
        <div class="dashboard-section-head">
            <div>
                <span class="section-indicator"></span>
                <div>
                    <h3 class="section-title text-base font-extrabold">Daftar Siswa</h3>
                    <p class="section-description text-xs mt-1">
                        Data siswa yang terdaftar di kelas wali Anda
                    </p>
                </div>
            </div>

            <span class="table-badge whitespace-nowrap">
                {{ $jumlahSiswaWali }} Siswa
            </span>
        </div>

        <div class="w-full overflow-x-auto">
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Jenis Kelamin</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($siswaWali as $index => $siswa)
                        <tr>
                            <td class="table-text font-semibold">{{ $index + 1 }}</td>
                            <td class="table-text font-bold">{{ $siswa->nis ?? '-' }}</td>

                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="table-user-icon">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                            <circle cx="12" cy="8" r="4"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 21a8 8 0 0 1 16 0"/>
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="font-bold table-text">{{ $siswa->nama_siswa }}</p>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="table-badge">{{ $siswa->kelas ?? '-' }}</span>
                            </td>

                            <td class="table-text font-bold">
                                @php
                                    $jenisKelamin = strtolower(trim($siswa->jenis_kelamin ?? ''));
                                @endphp

                                {{ $jenisKelamin === 'p' || $jenisKelamin === 'perempuan'
                                    ? 'Perempuan'
                                    : ($jenisKelamin === 'l' || $jenisKelamin === 'laki-laki'
                                        ? 'Laki-laki'
                                        : '-') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="dashboard-empty">
                                <div class="empty-icon-box">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 0 0-5-3.87M9 20H2v-2a4 4 0 0 1 7.75-1.4M15 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    </svg>
                                </div>
                                <p class="font-bold table-text">Belum ada data siswa</p>
                                <p class="text-xs card-muted mt-2">
                                    Belum ada siswa yang terdaftar di kelas wali Anda.
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
            <span class="w-1 h-6 rounded-full bg-blue-600"></span>
            <div>
                <h3 class="text-base font-extrabold card-title">Menu Cepat</h3>
                <p class="text-xs card-muted mt-1">
                    Akses fitur akademik yang sering digunakan
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

            {{-- INPUT NILAI --}}
            <a href="{{ route('guru.nilai.create') }}" class="dashboard-card quick-card group">
                <div class="quick-icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-extrabold card-title">Input Nilai</h4>
                    <p class="text-xs card-muted mt-1">Masukkan nilai siswa</p>
                </div>
                <svg class="quick-arrow w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>

            {{-- REKAP NILAI --}}
            <a href="{{ route('guru.rekap.index') }}" class="dashboard-card quick-card group">
                <div class="quick-icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 19V5M4 19h16M8 16v-5M12 16V8M16 16v-3"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-extrabold card-title">Rekap Nilai</h4>
                    <p class="text-xs card-muted mt-1">Lihat rekap nilai akademik siswa</p>
                </div>
                <svg class="quick-arrow w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>

            {{-- BOBOT NILAI --}}
            <a href="{{ route('guru.bobot-nilai.index') }}" class="dashboard-card quick-card group">
                <div class="quick-icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M3 12h18"/>
                        <circle cx="12" cy="12" r="9"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 8h8M8 16h8"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-extrabold card-title">Bobot Nilai</h4>
                    <p class="text-xs card-muted mt-1">Atur persentase komponen penilaian</p>
                </div>
                <svg class="quick-arrow w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>

            {{-- RAPOR --}}
            <a href="{{ route('guru.rapor.index') }}" class="dashboard-card quick-card group">
                <div class="quick-icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h9l3 3v15H6V3z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 11h6M9 15h6M9 7h3"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-extrabold card-title">Rapor</h4>
                    <p class="text-xs card-muted mt-1">Kelola dan lihat rapor siswa</p>
                </div>
                <svg class="quick-arrow w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7l7 7-7 7"/>
                </svg>
            </a>

        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="dashboard-footer">
        <p class="text-xs font-bold card-muted">Sistem Akademik Mini</p>
        <p class="text-xs card-muted mt-2">
            Kelola aktivitas akademik sekolah dengan mudah dan terstruktur.
        </p>
    </footer>

</div>

@endsection
