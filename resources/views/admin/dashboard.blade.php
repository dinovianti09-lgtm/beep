@extends('layouts.admin')

@section('title', 'Dashboard Admin - Sistem Akademik')
@section('page-title', 'Dashboard Admin')
@section('page-subtitle', 'Kelola dan pantau sistem akademik sekolah')

@push('styles')
<style>
/* =====================================================
   EDUVIA ADMIN DASHBOARD
   Pastel Blue + Dark Navy
===================================================== */

.dashboard-page {
    --dash-text: #26374A;
    --dash-muted: #60748B;
    --dash-border: #D5E1ED;
    --dash-card: #FFFFFF;
    --dash-icon-bg: #E3F0FA;
    --dash-icon-color: #355779;
}

/* =====================================================
   ANIMASI
===================================================== */

.dashboard-page .dash-enter {
    animation: dashEnter .4s ease-out both;
}

.dashboard-page .dash-delay-1 { animation-delay: .06s; }
.dashboard-page .dash-delay-2 { animation-delay: .12s; }
.dashboard-page .dash-delay-3 { animation-delay: .18s; }

@keyframes dashEnter {
    from {
        opacity: 0;
        transform: translateY(8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* =====================================================
   HERO / SAMBUTAN ADMIN
===================================================== */

.dashboard-page .dashboard-hero {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    border: 1px solid #B8D2EB;
    border-radius: 18px;
    background: linear-gradient(115deg, #B8D8F8 0%, #D4E8FC 52%, #EAF3FC 100%);
    box-shadow: 0 5px 14px rgba(48, 105, 166, .07);
}

.dashboard-page .dashboard-hero::before,
.dashboard-page .dashboard-hero::after {
    display: none !important;
}

.dashboard-page .hero-eyebrow { color: #315E8D; }
.dashboard-page .hero-title { color: #1C4169; letter-spacing: -.7px; }
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

/* =====================================================
   KARTU DASHBOARD
===================================================== */

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

.dashboard-page .dashboard-card.stat-card {
    background: #F8FAFC;
    border-color: #D5E1ED;
}

.dashboard-page .dashboard-card.stat-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: #89AAD7;
}

.dashboard-page .dashboard-card.stat-card::after { display: none !important; }

.dashboard-page .stat-blue,
.dashboard-page .stat-violet,
.dashboard-page .stat-cyan,
.dashboard-page .stat-indigo,
.dashboard-page .stat-emerald,
.dashboard-page .stat-amber { --card-icon-bg: #E3F0FA; }

.dashboard-page .card-title { color: #26374A; }
.dashboard-page .card-muted { color: #60748B; }

.dashboard-page .stat-number {
    position: relative;
    z-index: 1;
    color: #26374A;
    line-height: 1.15;
    font-variant-numeric: tabular-nums;
    letter-spacing: -.7px;
}

.dashboard-page .stat-caption { color: #60748B; }

.dashboard-page .stat-icon {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 54px;
    height: 54px;
    flex-shrink: 0;
    border: 1px solid #C3D8EB;
    border-radius: 14px;
    background: #E3F0FA;
    box-shadow: 0 2px 5px rgba(44,83,125,.04);
    transition: transform .2s ease;
}

.dashboard-page .stat-icon svg { color: #355779; }
.dashboard-page .dashboard-card:hover .stat-icon { transform: translateY(-1px); }

/* =====================================================
   RINGKASAN AKADEMIK
===================================================== */

.dashboard-page .summary-card {
    display: flex;
    align-items: center;
    gap: 17px;
    padding: 22px;
}

.dashboard-page .summary-card .stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
}

.dashboard-page .summary-number {
    font-size: 27px;
    font-weight: 800;
    line-height: 1.2;
    color: #26374A;
    font-variant-numeric: tabular-nums;
}

/* =====================================================
   HEADER TABEL
===================================================== */

.dashboard-page .dashboard-table-card { border-radius: 16px; }

.dashboard-page .dashboard-section-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    padding: 20px 23px;
    border-bottom: 1px solid #D6E4F2;
    background: #F8FBFF;
}

.dashboard-page .section-indicator {
    display: inline-block;
    width: 4px;
    height: 35px;
    flex-shrink: 0;
    border-radius: 10px;
    background: #527DAE;
}

.dashboard-page .section-title { color: #26374A; letter-spacing: -.3px; }
.dashboard-page .section-description { color: #60748B; }

.dashboard-page .dashboard-see-all {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    flex-shrink: 0;
    padding: 9px 13px;
    border: 1px solid #BDD7F1;
    border-radius: 9px;
    background: #EAF3FC;
    color: #285F97;
    font-size: 12px;
    font-weight: 800;
    text-decoration: none;
    transition: .2s ease;
}

.dashboard-page .dashboard-see-all:hover {
    color: #FFFFFF;
    background: #3478BD;
    border-color: #3478BD;
}

/* =====================================================
   TABEL
===================================================== */

.dashboard-page .dashboard-table {
    width: 100%;
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

.dashboard-page .dashboard-table tbody tr:last-child td { border-bottom: 0; }
.dashboard-page .dashboard-table tbody tr { background: #FFFFFF; transition: background .18s ease; }
.dashboard-page .dashboard-table tbody tr:nth-child(even) { background: #F8FBFF; }
.dashboard-page .dashboard-table tbody tr:hover { background: #EEF6FF; }

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

/* =====================================================
   BADGE UMUM
===================================================== */

.dashboard-page .table-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    max-width: 240px;
    padding: 6px 10px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 800;
    line-height: 1.45;
}

.dashboard-page .badge-blue,
.dashboard-page .badge-violet,
.dashboard-page .badge-teal {
    color: #294F79;
    background: #E3F0FA;
    border-color: #C3D8EB;
}

.dashboard-page .badge-emerald { color: #207653; background: #E1F6EB; border-color: #C7EAD7; }
.dashboard-page .badge-amber { color: #8B5B15; background: #FFF1D9; border-color: #F3DEB4; }
.dashboard-page .badge-rose { color: #A33E56; background: #FDEAF0; border-color: #F6D1DD; }

/* =====================================================
   PREDIKAT NILAI
   A = Hijau, B = Biru, C = Kuning, D = Merah
===================================================== */

.dashboard-page .grade-badge.badge-emerald { color: #218454; background: #E8F7EF; border-color: #B9E5CB; }
.dashboard-page .grade-badge.badge-blue { color: #3478BD; background: #EAF4FF; border-color: #C8DCEE; }
.dashboard-page .grade-badge.badge-amber { color: #A66B12; background: #FFF7DF; border-color: #F5DFA5; }
.dashboard-page .grade-badge.badge-rose { color: #C24A4A; background: #FDECEC; border-color: #F3C5C5; }

/* =====================================================
   NILAI AKHIR - BIRU PASTEL
===================================================== */

.dashboard-page .final-value-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 55px;
    padding: 6px 10px;
    border: 1px solid #C8DCEE;
    border-radius: 8px;
    background: #EAF4FF;
    color: #3478BD;
    font-size: 13px;
    font-weight: 800;
    white-space: nowrap;
    font-variant-numeric: tabular-nums;
}

/* =====================================================
   DATA KOSONG
===================================================== */

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

/* =====================================================
   FOOTER
===================================================== */

.dashboard-page .dashboard-footer {
    position: relative;
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

/* =====================================================
   MODE GELAP
===================================================== */

:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page {
    --dash-text: #EDF4FC;
    --dash-muted: #AFC0D4;
    --dash-border: #354A62;
    --dash-card: #192438;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .dashboard-hero {
    background: linear-gradient(115deg, #17283D 0%, #1C3049 55%, #243E59 100%) !important;
    border-color: #3B5878 !important;
    box-shadow: 0 5px 14px rgba(0,0,0,.16) !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .hero-eyebrow { color: #AFCBEA !important; }
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .hero-title { color: #F1F6FC !important; }
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .hero-description { color: #C0D0E2 !important; }
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .hero-accent-line { background: #89AAD7 !important; }

:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .hero-icon-box {
    background: #263E59 !important;
    border-color: #405B78 !important;
    box-shadow: 0 4px 12px rgba(0,0,0,.15) !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .hero-icon-box svg { color: #D8E9FC !important; }
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .dashboard-hero .inline-flex { background: #263E59 !important; border-color: #405B78 !important; color: #D8E9FC !important; }

:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .dashboard-card {
    background: #192438 !important;
    border-color: #34465F !important;
    box-shadow: 0 3px 10px rgba(0,0,0,.14) !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .dashboard-card.stat-card { background: #1C2B3E !important; border-color: #354A62 !important; }
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .dashboard-card.stat-card::before { background: #89AAD7 !important; }

:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .card-title,
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .stat-number,
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .summary-number { color: #F1F6FC !important; }

:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .card-muted,
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .stat-caption { color: #AFC0D4 !important; }

:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .stat-icon { background: #263E59 !important; border-color: #405B78 !important; box-shadow: none !important; }
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .stat-icon svg { color: #D8E9FC !important; }

:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .dashboard-section-head { background: #1C2C42 !important; border-color: #34465F !important; }
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .section-title { color: #EEF5FC !important; }
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .section-description { color: #AFC0D4 !important; }

:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .dashboard-table thead th { color: #DDEBFC !important; background: #263A53 !important; border-color: #3A4D66 !important; }
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .dashboard-table tbody tr,
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .dashboard-table tbody tr:nth-child(even) { background: #192438 !important; }
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .dashboard-table tbody tr:hover { background: #24354C !important; }
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .dashboard-table tbody td { border-color: #34465F !important; }
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .table-text { color: #E1EAF5 !important; }

:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .table-user-icon { background: #263E59 !important; border-color: #405B78 !important; color: #D8E9FC !important; }

:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .badge-blue,
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .badge-violet,
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .badge-teal { background: #263E59 !important; border-color: #435E7C !important; color: #DFECFB !important; }

:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .grade-badge.badge-emerald { background: #12372F !important; border-color: #23604D !important; color: #86EFAC !important; }
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .grade-badge.badge-blue { background: #243E59 !important; border-color: #3A5876 !important; color: #A9D2F5 !important; }
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .grade-badge.badge-amber { background: #493A20 !important; border-color: #80652F !important; color: #FDE7A3 !important; }
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .grade-badge.badge-rose { background: #3B2028 !important; border-color: #693541 !important; color: #FCA5A5 !important; }

:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .final-value-badge { background: #243E59 !important; border-color: #3A5876 !important; color: #A9D2F5 !important; }

:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .dashboard-empty { background: #192438 !important; }
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .empty-icon-box { background: #263E59 !important; border-color: #405B78 !important; color: #D8E9FC !important; }

:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .dashboard-see-all { background: #263A53 !important; border-color: #3A5270 !important; color: #D7E9FC !important; }
:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], html[data-admin-theme="dark"], body[data-admin-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .dashboard-see-all:hover { background: #3478BD !important; color: #FFFFFF !important; }

/* =====================================================
   STATISTIK NILAI BULANAN
===================================================== */

.dashboard-page .monthly-grade-grid {
    display: grid;
    grid-template-columns: repeat(12, minmax(0,1fr));
    gap: 10px;
    align-items: end;
    min-height: 230px;
    padding: 18px 8px 8px;
}

.dashboard-page .monthly-grade-item {
    min-width: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 9px;
}

.dashboard-page .monthly-grade-value {
    font-size: 11px;
    font-weight: 800;
    color: var(--dash-text);
    white-space: nowrap;
}

.dashboard-page .monthly-grade-track {
    height: 145px;
    width: 100%;
    max-width: 43px;
    border-radius: 9px;
    background: #EAF3FC;
    display: flex;
    align-items: flex-end;
    overflow: hidden;
}

.dashboard-page .monthly-grade-bar {
    width: 100%;
    min-height: 0;
    background: linear-gradient(180deg, #3478BD, #89AAD7);
    border-radius: 9px 9px 0 0;
}

.dashboard-page .monthly-grade-month {
    font-size: 11px;
    font-weight: 700;
    color: var(--dash-muted);
}

.dashboard-page .monthly-grade-filter {
    border: 1px solid var(--dash-border);
    background: var(--dash-card);
    color: var(--dash-text);
    border-radius: 9px;
    padding: 8px 12px;
    font-size: 12px;
    font-weight: 700;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode, html[data-theme="dark"], body[data-theme="dark"], .dark, .dark-mode, [data-theme="dark"]) .dashboard-page .monthly-grade-track { background: #263E59; }

@media (max-width: 640px) {
    .dashboard-page .monthly-grade-grid { gap: 5px; padding-left: 2px; padding-right: 2px; }
    .dashboard-page .monthly-grade-value,
    .dashboard-page .monthly-grade-month { font-size: 9px; }
}

/* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 767px) {
    .dashboard-page .dashboard-hero { border-radius: 15px; }
    .dashboard-page .dashboard-hero-content { padding: 23px 20px; }
    .dashboard-page .hero-icon-box { width: 65px; height: 65px; border-radius: 15px; }
    .dashboard-page .hero-icon-box svg { width: 34px; height: 34px; }
    .dashboard-page .dashboard-section-head { padding: 17px 16px; }
    .dashboard-page .dashboard-table thead th,
    .dashboard-page .dashboard-table tbody td { padding: 12px 14px; }
    .dashboard-page .summary-card { padding: 19px; }
}

@media (max-width: 420px) {
    .dashboard-page .dashboard-hero-content { padding: 20px 16px; }
    .dashboard-page .hero-title { font-size: 23px; }
    .dashboard-page .dashboard-section-head { align-items: flex-start; }
    .dashboard-page .dashboard-see-all { padding: 8px 10px; font-size: 11px; }
    .dashboard-page .summary-card { gap: 12px; padding: 16px; }
    .dashboard-page .summary-card .stat-icon { width: 49px; height: 49px; }
    .dashboard-page .summary-number { font-size: 24px; }
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

    {{-- SAMBUTAN ADMIN --}}
    <section class="dashboard-hero dash-enter">
        <div class="dashboard-hero-content relative z-10 flex items-center justify-between gap-5 px-7 py-7 sm:px-8 sm:py-8">
            <div class="min-w-0">
                <div class="flex items-center gap-2 mb-3">
                    <span class="hero-accent-line"></span>
                    <p class="hero-eyebrow text-xs sm:text-sm font-extrabold tracking-wide">SELAMAT DATANG KEMBALI</p>
                </div>
                <h2 class="hero-title text-2xl sm:text-3xl font-extrabold">Halo, {{ $namaSiswa }}!</h2>
                <p class="hero-description text-sm mt-3 max-w-xl leading-relaxed">Kelola dan pantau seluruh data akademik sekolah melalui satu dashboard.</p>
                <div class="flex items-center gap-2 mt-5">
                    <span class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-white/65 border border-white/80 text-xs font-bold text-slate-700">
                        <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                        </svg>
                        Sistem Akademik Mini
                    </span>
                </div>
            </div>
            <div class="hero-icon-box hidden sm:flex" aria-hidden="true">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M4 21V9l8-5 8 5v12M9 21v-6h6v6M7 10h.01M12 10h.01M17 10h.01"/>
                </svg>
            </div>
        </div>
    </section>

    {{-- RINGKASAN DATA --}}
    <section class="dash-enter dash-delay-1">
        <div class="flex items-center gap-3 mb-4">
            <span class="w-1 h-6 rounded-full bg-blue-600"></span>
            <div>
                <h3 class="text-base font-extrabold card-title">Ringkasan Data</h3>
                <p class="text-xs card-muted mt-1">Gambaran umum data akademik sekolah</p>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
            <article class="dashboard-card stat-card stat-blue p-5">
                <div class="relative z-10 flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-sm font-bold card-muted">Total Guru</p>
                        <p class="stat-number text-3xl font-extrabold mt-3">{{ $jumlahGuru }}</p>
                        <p class="stat-caption text-xs font-medium mt-2">Guru terdaftar</p>
                    </div>
                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                </div>
            </article>

            <article class="dashboard-card stat-card stat-violet p-5">
                <div class="relative z-10 flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-sm font-bold card-muted">Total Siswa</p>
                        <p class="stat-number text-3xl font-extrabold mt-3">{{ $jumlahSiswa }}</p>
                        <p class="stat-caption text-xs font-medium mt-2">Siswa terdaftar</p>
                    </div>
                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                </div>
            </article>

            <article class="dashboard-card stat-card stat-cyan p-5">
                <div class="relative z-10 flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-sm font-bold card-muted">Total Kelas</p>
                        <p class="stat-number text-3xl font-extrabold mt-3">{{ $jumlahKelas }}</p>
                        <p class="stat-caption text-xs font-medium mt-2">Kelas tersedia</p>
                    </div>
                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5M9 10h.01M12 10h.01M15 10h.01"/>
                        </svg>
                    </div>
                </div>
            </article>

            <article class="dashboard-card stat-card stat-indigo p-5">
                <div class="relative z-10 flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-sm font-bold card-muted">Mata Pelajaran</p>
                        <p class="stat-number text-3xl font-extrabold mt-3">{{ $jumlahMapel }}</p>
                        <p class="stat-caption text-xs font-medium mt-2">Mapel tersedia</p>
                    </div>
                    <div class="stat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                        </svg>
                    </div>
                </div>
            </article>
        </div>
    </section>

    
<form method="GET" class="flex items-center gap-2 mt-3">
    <input type="hidden" name="tahun_nilai"
           value="{{ $tahunNilaiTerpilih }}">

    <input type="hidden" name="semester_bulanan"
           value="{{ $semesterBulanan }}">

    <select name="semester_akademik"
            onchange="
                this.form.elements['semester_bulanan'].value = this.value;
                this.form.submit();
            "
            class="rounded-lg border border-gray-300 px-3 py-2 text-sm">

        <option value="" {{ $semesterAkademik === '' ? 'selected' : '' }}>
            Semua Semester
        </option>

        <option value="1" {{ $semesterAkademik === '1' ? 'selected' : '' }}>
            Semester 1
        </option>

        <option value="2" {{ $semesterAkademik === '2' ? 'selected' : '' }}>
            Semester 2
        </option>
    </select>
</form>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <article class="dashboard-card stat-card stat-emerald summary-card">
                <div class="stat-icon">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l4-5 3 3 6-7"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-bold card-muted">Rata-rata Nilai</p>
                    <p class="summary-number mt-2">{{ number_format($avgNilai, 2) }}</p>
                    <p class="text-xs card-muted mt-2">Dari seluruh data nilai</p>
                </div>
            </article>

            <article class="dashboard-card stat-card stat-amber summary-card">
                <div class="stat-icon">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-bold card-muted">Mata Pelajaran Dinilai</p>
                    <p class="summary-number mt-2">{{ $totalMapelDinilai }}</p>
                    <p class="text-xs card-muted mt-2">Mapel yang sudah memiliki nilai</p>
                </div>
            </article>
        </div>
    </section>

    

{{-- STATISTIK NILAI BULANAN --}}
<section class="dashboard-card dashboard-table-card dash-enter dash-delay-2">

    <style>
        .edu-chart {
            width: 100%;
            min-width: 650px;
            display: block;
        }

        .edu-chart-grid {
            stroke: #E5EAF1;
            stroke-width: 1;
            stroke-dasharray: 3 5;
        }

        .edu-chart-label {
            fill: #718096;
            font-size: 11px;
            font-weight: 600;
        }

        .edu-chart-line {
            fill: none;
            stroke: #397DBB;
            stroke-width: 3.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .edu-chart-point {
            fill: white;
            stroke: #397DBB;
            stroke-width: 3;
        }

        .edu-chart-value {
            fill: #285783;
            font-size: 11px;
            font-weight: 800;
        }

        .edu-chart-month-guide {
            stroke: #E8EEF5;
            stroke-width: 1;
            stroke-dasharray: 2 5;
        }

        .edu-chart-filter {
            border: 1px solid var(--dash-border);
            border-radius: 9px;
            padding: 8px 12px;
            background: var(--dash-card);
            color: var(--dash-text);
            font-size: 12px;
            font-weight: 700;
        }

        @media (max-width: 640px) {
            .edu-chart {
                min-width: 650px;
            }
        }
    </style>

    {{-- HEADER --}}
    <div class="dashboard-section-head flex-wrap">

        <div class="flex items-center gap-3 min-w-0">
            <span class="section-indicator"></span>

            <div>
                <h3 class="section-title text-base font-extrabold">
                    Statistik Nilai Bulanan
                </h3>

                <p class="section-description text-xs mt-1">
                    Perkembangan rata-rata nilai akhir siswa setiap bulan
                </p>
            </div>
        </div>

        {{-- FILTER TAHUN --}}
        <form method="GET"
              action="{{ url()->current() }}"
              class="flex items-center gap-2">

            <input type="hidden"
                   name="semester_akademik"
                   value="{{ $semesterAkademik }}">

            <input type="hidden"
                   name="semester_bulanan"
                   value="{{ $semesterBulanan }}">

            <label class="text-xs font-bold card-muted">
                Tahun
            </label>

            <select name="tahun_nilai"
                    class="edu-chart-filter"
                    onchange="this.form.submit()">

                @foreach($tahunNilaiTersedia as $tahun)
                    <option value="{{ $tahun }}"
                        @selected((int) $tahunNilaiTerpilih === (int) $tahun)>
                        {{ $tahun }}
                    </option>
                @endforeach

            </select>
        </form>

    </div>

    {{-- DATA GRAFIK --}}
    @php
        $validPoints = collect($statistikNilaiBulanan)
            ->values()
            ->map(function ($data, $index) {
                if ($data['rata_rata'] === null) {
                    return null;
                }

                return [
                    'x' => 70 + ($index * 65),
                    'nilai' => (float) $data['rata_rata'],
                    'bulan' => $data['bulan_panjang'],
                    'jumlah' => $data['jumlah'],
                ];
            })
            ->filter()
            ->values();

        $minNilai = $validPoints->min('nilai') ?? 0;
        $maxNilai = $validPoints->max('nilai') ?? 100;

        $batasBawah = max(0, floor(($minNilai - 5) / 5) * 5);
        $batasAtas = min(100, ceil(($maxNilai + 5) / 5) * 5);

        if (($batasAtas - $batasBawah) < 10) {
            $batasAtas = min(100, $batasBawah + 10);
        }

        $tinggiGrafik = 160;
        $posisiAtas = 45;
        $posisiBawah = 205;

        $chartPoints = $validPoints->map(function ($point) use (
            $batasBawah,
            $batasAtas,
            $tinggiGrafik,
            $posisiBawah
        ) {
            $point['y'] = $posisiBawah -
                (($point['nilai'] - $batasBawah) /
                max(1, $batasAtas - $batasBawah)) *
                $tinggiGrafik;

            return $point;
        });

        $linePath = '';

        if ($chartPoints->count() > 0) {
            $first = $chartPoints->first();

            $linePath = "M {$first['x']} {$first['y']}";

            for ($i = 1; $i < $chartPoints->count(); $i++) {
                $previous = $chartPoints[$i - 1];
                $current = $chartPoints[$i];

                $distance = $current['x'] - $previous['x'];

                $linePath .= " C "
                    . ($previous['x'] + $distance / 3) . " "
                    . $previous['y'] . ", "
                    . ($current['x'] - $distance / 3) . " "
                    . $current['y'] . ", "
                    . $current['x'] . " "
                    . $current['y'];
            }
        }

        $areaPath = $chartPoints->count() > 0
            ? $linePath . " L "
                . $chartPoints->last()['x'] . " 205 L "
                . $chartPoints->first()['x'] . " 205 Z"
            : '';
    @endphp

    <div class="p-5 sm:p-6">

        @if($chartPoints->count() > 0)

            <div class="overflow-x-auto">

                <svg class="edu-chart"
                     viewBox="0 0 860 255"
                     role="img"
                     aria-label="Grafik perkembangan rata-rata nilai bulanan">

                    <defs>
                        <linearGradient id="eduChartGradient"
                                        x1="0" y1="0"
                                        x2="0" y2="1">

                            <stop offset="0%"
                                  stop-color="#397DBB"
                                  stop-opacity="0.25"/>

                            <stop offset="100%"
                                  stop-color="#397DBB"
                                  stop-opacity="0.015"/>

                        </linearGradient>
                    </defs>

                    {{-- GARIS GRID DAN SKALA --}}
                    @for($i = 0; $i <= 4; $i++)

                        @php
                            $y = $posisiAtas + ($i * 40);

                            $nilaiSkala = $batasAtas -
                                (($batasAtas - $batasBawah) * $i / 4);
                        @endphp

                        <line x1="48"
                              y1="{{ $y }}"
                              x2="825"
                              y2="{{ $y }}"
                              class="edu-chart-grid"/>

                        <text x="35"
                              y="{{ $y + 4 }}"
                              text-anchor="end"
                              class="edu-chart-label">

                            {{ number_format($nilaiSkala, 0) }}

                        </text>

                    @endfor

                    {{-- PANDUAN BULAN --}}
                    @foreach($statistikNilaiBulanan as $index => $data)

                        <line
                            x1="{{ 70 + ($index * 65) }}"
                            y1="45"
                            x2="{{ 70 + ($index * 65) }}"
                            y2="205"
                            class="edu-chart-month-guide"/>

                    @endforeach

                    {{-- AREA GRADASI --}}
                    <path d="{{ $areaPath }}"
                          fill="url(#eduChartGradient)"/>

                    {{-- GARIS LENGKUNG --}}
                    @if($chartPoints->count() > 1)

                        <path d="{{ $linePath }}"
                              class="edu-chart-line"/>

                    @endif

                    {{-- TITIK DAN LABEL NILAI --}}
                    @foreach($chartPoints as $point)

                        <circle
                            cx="{{ $point['x'] }}"
                            cy="{{ $point['y'] }}"
                            r="5.5"
                            class="edu-chart-point">

                            <title>
                                {{ $point['bulan'] }}:
                                {{ number_format($point['nilai'], 2, ',', '.') }}
                                | {{ $point['jumlah'] }} data nilai
                            </title>

                        </circle>

                        <text
                            x="{{ $point['x'] }}"
                            y="{{ $point['y'] - 15 }}"
                            text-anchor="middle"
                            class="edu-chart-value">

                            {{ number_format($point['nilai'], 1, ',', '.') }}

                        </text>

                    @endforeach

                    {{-- LABEL BULAN --}}
                    @foreach($statistikNilaiBulanan as $index => $data)

                        <text
                            x="{{ 70 + ($index * 65) }}"
                            y="230"
                            text-anchor="middle"
                            class="edu-chart-label">

                            {{ $data['bulan'] }}

                        </text>

                    @endforeach

                </svg>

            </div>

            {{-- KETERANGAN --}}
            <div class="flex flex-wrap items-center justify-between gap-3 mt-4">

                <div class="flex items-center gap-2">

                    <span class="w-3 h-3 rounded-full bg-blue-600"></span>

                    <span class="text-xs card-muted">
                        Rata-rata nilai akhir
                    </span>

                </div>

                <span class="text-xs card-muted">
                    {{ $chartPoints->count() }} bulan memiliki data
                </span>

            </div>

            <p class="text-xs card-muted mt-3">
                Grafik berdasarkan tanggal pertama kali data nilai diinput.
                Arahkan kursor ke titik untuk melihat detail nilai.
            </p>

        @else

            <div class="dashboard-empty">

                <div class="empty-icon-box">—</div>

                <p class="font-bold table-text">
                    Belum ada data nilai
                </p>

                <p class="text-xs card-muted mt-2">
                    Belum terdapat nilai pada tahun {{ $tahunNilaiTerpilih }}.
                </p>

            </div>

        @endif

    </div>

</section>


    
{{-- RATA-RATA NILAI PER MATA PELAJARAN --}}
<section class="dashboard-card dashboard-table-card dash-enter dash-delay-2">

    <div class="dashboard-section-head">
        <div class="flex items-center gap-3 min-w-0">
            <span class="section-indicator"></span>
            <div class="min-w-0">
                <h3 class="section-title text-base font-extrabold">
                    Rata-rata Nilai per Mata Pelajaran
                </h3>
                <p class="section-description text-xs mt-1">
                    Rata-rata nilai akhir siswa berdasarkan mata pelajaran
                </p>
            </div>
        </div>

        <span class="table-badge badge-blue">
            {{ $rataRataPerMapel->count() }} Mapel
        </span>
    </div>

    <div class="p-5 sm:p-6">

        @if($rataRataPerMapel->contains(fn ($mapel) => $mapel->rata_rata_nilai !== null))

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                @foreach($rataRataPerMapel as $mapel)

                    <div class="rounded-xl border border-slate-200 bg-white p-4">

                        <div class="flex items-center justify-between gap-3 mb-3">

                            <div class="min-w-0">
                                <p class="text-sm font-bold table-text truncate">
                                    {{ $mapel->nama_mapel }}
                                </p>
                                <p class="text-xs card-muted mt-1">
                                    Nilai rata-rata
                                </p>
                            </div>

                            @if($mapel->rata_rata_nilai !== null)

                                <span class="final-value-badge">
                                    {{ number_format($mapel->rata_rata_nilai, 2, ',', '.') }}
                                </span>

                            @else

                                <span class="table-badge badge-amber">
                                    Belum ada nilai
                                </span>

                            @endif

                        </div>

                        @if($mapel->rata_rata_nilai !== null)

                            <div class="w-full h-2.5 rounded-full bg-blue-100 overflow-hidden">

                                <div
                                    class="h-full rounded-full"
                                    style="
                                        width: {{ max(0, min(100, (float) $mapel->rata_rata_nilai)) }}%;
                                        background: linear-gradient(90deg, #3478BD, #89AAD7);
                                    ">
                                </div>

                            </div>

                        @endif

                    </div>

                @endforeach

            </div>

        @else

            <div class="dashboard-empty">
                <div class="empty-icon-box">—</div>
                <p class="font-bold table-text">
                    Belum ada data nilai mata pelajaran
                </p>
                <p class="text-xs card-muted mt-2">
                    Data rata-rata nilai akan muncul setelah nilai siswa diinput.
                </p>
            </div>

        @endif

    </div>

</section>


    {{-- REKAP JUMLAH SISWA PER KELAS --}}
    <section class="dashboard-card dashboard-table-card dash-enter dash-delay-2">
        <div class="dashboard-section-head">
            <div class="flex items-center gap-3 min-w-0">
                <span class="section-indicator"></span>
                <div class="min-w-0">
                    <h3 class="section-title text-base font-extrabold">Rekap Jumlah Siswa per Kelas</h3>
                    <p class="section-description text-xs mt-1">Statistik jumlah siswa berdasarkan kelas</p>
                </div>
            </div>
            <span class="table-badge badge-blue">{{ $rekapSiswaPerKelas->sum('jumlah_siswa') }} Siswa</span>
        </div>
        <div class="overflow-x-auto">
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Jumlah Siswa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekapSiswaPerKelas as $rekap)
                        <tr>
                            <td class="table-text font-semibold">{{ $loop->iteration }}</td>
                            <td>
                                <span class="table-badge badge-blue">{{ $rekap->kelas ?: 'Belum Ada Kelas' }}</span>
                            </td>
                            <td class="table-text font-bold">{{ $rekap->jumlah_siswa }} Siswa</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="dashboard-empty">Belum ada data siswa untuk direkap.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- GURU TERBARU --}}
    <section class="dashboard-card dashboard-table-card dash-enter dash-delay-2">
        <div class="dashboard-section-head">
            <div class="flex items-center gap-3 min-w-0">
                <span class="section-indicator"></span>
                <div class="min-w-0">
                    <h3 class="section-title text-base font-extrabold">Guru Terbaru</h3>
                    <p class="section-description text-xs mt-1">Data guru yang terakhir ditambahkan</p>
                </div>
            </div>
            <a href="{{ route('admin.guru.index') }}" class="dashboard-see-all">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/>
                </svg>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Guru</th>
                        <th>NIP</th>
                        <th>Mata Pelajaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guruList as $index => $guru)
                        <tr>
                            <td class="table-text font-semibold">{{ $index + 1 }}</td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="table-user-icon">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                            <circle cx="12" cy="8" r="4"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 21a8 8 0 0 1 16 0"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold table-text">{{ $guru->nama_guru }}</p>
                                        <p class="text-xs card-muted mt-1">Guru</p>
                                    </div>
                                </div>
                            </td>
                            <td class="table-text font-medium">{{ $guru->nip }}</td>
                            <td>
                                <span class="table-badge badge-violet">{{ $guru->mapel_diampu ?? '-' }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="dashboard-empty">
                                <div class="empty-icon-box">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                        <circle cx="9" cy="7" r="4"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                    </svg>
                                </div>
                                <p class="font-bold table-text">Belum ada data guru</p>
                                <p class="text-xs card-muted mt-2">Data guru akan muncul di sini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- SISWA TERBARU --}}
    <section class="dashboard-card dashboard-table-card dash-enter dash-delay-3">
        <div class="dashboard-section-head">
            <div class="flex items-center gap-3 min-w-0">
                <span class="section-indicator"></span>
                <div class="min-w-0">
                    <h3 class="section-title text-base font-extrabold">Siswa Terbaru</h3>
                    <p class="section-description text-xs mt-1">Data siswa yang terakhir ditambahkan</p>
                </div>
            </div>
            <a href="{{ route('admin.siswa.index') }}" class="dashboard-see-all">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/>
                </svg>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Siswa</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswaList as $index => $siswa)
                        <tr>
                            <td class="table-text font-semibold">{{ $index + 1 }}</td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="table-user-icon">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                            <circle cx="12" cy="8" r="4"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 21a8 8 0 0 1 16 0"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold table-text">{{ $siswa->nama_siswa }}</p>
                                        <p class="text-xs card-muted mt-1">Siswa</p>
                                    </div>
                                </div>
                            </td>
                            <td class="table-text font-medium">{{ $siswa->nis }}</td>
                            <td>
                                <span class="table-badge badge-blue">{{ $siswa->kelas }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="dashboard-empty">
                                <div class="empty-icon-box">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                        <circle cx="12" cy="8" r="4"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 21a8 8 0 0 1 16 0"/>
                                    </svg>
                                </div>
                                <p class="font-bold table-text">Belum ada data siswa</p>
                                <p class="text-xs card-muted mt-2">Data siswa akan muncul di sini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- NILAI TERBARU --}}
    <section class="dashboard-card dashboard-table-card dash-enter dash-delay-3">
        <div class="dashboard-section-head">
            <div class="flex items-center gap-3 min-w-0">
                <span class="section-indicator"></span>
                <div class="min-w-0">
                    <h3 class="section-title text-base font-extrabold">Nilai Terbaru</h3>
                    <p class="section-description text-xs mt-1">Data nilai akademik yang terakhir ditambahkan</p>
                </div>
            </div>
            <a href="{{ route('admin.nilai.index') }}" class="dashboard-see-all">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/>
                </svg>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Siswa</th>
                        <th>Mata Pelajaran</th>
                        <th>Semester</th>
                        <th>Nilai Akhir</th>
                        <th>Predikat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($nilaiTerbaru as $index => $nilai)
                        <tr>
                            <td class="table-text font-semibold">{{ $index + 1 }}</td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="table-user-icon">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                            <circle cx="12" cy="8" r="4"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 21a8 8 0 0 1 16 0"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold table-text">{{ $nilai->siswa->nama_siswa ?? '-' }}</p>
                                        <p class="text-xs card-muted mt-1">{{ $nilai->siswa->nis ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="table-badge badge-violet">{{ $nilai->mapel->nama_mapel ?? '-' }}</span>
                            </td>
                            <td>
                                @if ((string) $nilai->semester === '1')
                                    <span class="table-badge badge-blue">Semester 1</span>
                                @else
                                    <span class="table-badge badge-teal">Semester 2</span>
                                @endif
                            </td>
                            <td>
                                @if (is_numeric($nilai->nilai_akhir))
                                    <span class="final-value-badge">{{ number_format((float) $nilai->nilai_akhir, 2) }}</span>
                                @else
                                    <span class="table-badge badge-blue">Belum diinput</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $predikat = strtoupper(trim((string) ($nilai->predikat ?? '')));
                                    $predikatClass = match ($predikat) {
                                        'A' => 'badge-emerald',
                                        'B' => 'badge-blue',
                                        'C' => 'badge-amber',
                                        'D' => 'badge-rose',
                                        default => '',
                                    };
                                @endphp
                                @if (in_array($predikat, ['A', 'B', 'C', 'D'], true))
                                    <span class="table-badge grade-badge {{ $predikatClass }}">{{ $predikat }}</span>
                                @else
                                    <span class="table-badge badge-blue">Belum ada</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="dashboard-empty">
                                <div class="empty-icon-box">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 16h6M9 8h6"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h9l3 3v15H6V3Z"/>
                                    </svg>
                                </div>
                                <p class="font-bold table-text">Belum ada data nilai</p>
                                <p class="text-xs card-muted mt-2">Data nilai akan muncul di sini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- FOOTER DASHBOARD --}}
    <footer class="dashboard-footer">
        <p class="text-xs font-bold card-muted">Sistem Akademik Mini</p>
        <p class="text-xs card-muted mt-2">Kelola data akademik sekolah dengan mudah dan terstruktur.</p>
    </footer>

</div>
@endsection