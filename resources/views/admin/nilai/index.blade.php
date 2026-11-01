@extends('layouts.admin')

@section('title', 'Data Nilai - Sistem Akademik Mini')
@section('page-title', 'Data Nilai')
@section('page-subtitle', 'Pantau nilai akademik siswa berdasarkan kelas, semester, dan mata pelajaran.')

@push('styles')
<style>
/* =====================================================
   EDUVIA - DATA NILAI
   Pastel Blue + Dark Navy
===================================================== */

.nilai-page {
    --nv-primary: #3478BD;
    --nv-primary-dark: #285F96;
    --nv-text: #293F57;
    --nv-muted: #526982;
    --nv-border: #D5E1ED;

    color: var(--nv-text);
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.nilai-page *,
.nilai-page *::before,
.nilai-page *::after {
    box-sizing: border-box;
}

/* ANIMASI */

.nv-enter {
    animation: nvEnter .35s ease-out both;
}

@keyframes nvEnter {
    from {
        opacity: 0;
        transform: translateY(7px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* HEADER */

.nv-hero {
    overflow: hidden;
    border: 1px solid #BDD6EE;
    border-radius: 17px;
    background: linear-gradient(
        115deg,
        #C3E0F4 0%,
        #E3F0FA 58%,
        #F8FAFC 100%
    );
    box-shadow: 0 4px 12px rgba(47, 93, 145, .06);
}

.nv-hero-icon,
.nv-info-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border: 1px solid #C3D8EB;
    background: #E3F0FA;
    color: #3478BD;
}

.nv-hero-icon {
    width: 58px;
    height: 58px;
    border: 1px solid #FFFFFF;
    border-radius: 15px;
    background: #FFFFFF;
}

.nv-hero-icon svg {
    width: 27px;
    height: 27px;
}

.nv-hero-label {
    color: #285F96;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.nv-hero-title {
    color: #214A77;
}

.nv-hero-description {
    color: #4D6886;
}

/* PANEL */

.nv-panel {
    overflow: hidden;
    border: 1px solid #D5E1ED;
    border-radius: 15px;
    background: #FFFFFF;
    box-shadow: 0 4px 12px rgba(45, 82, 124, .045);
}

.nv-panel-header {
    padding: 17px 20px;
    border-bottom: 1px solid #D5E1ED;
    background: #F5F9FE;
}

.nv-panel-body {
    padding: 20px;
}

.nv-panel-title {
    color: #294B70;
    font-size: 14px;
    font-weight: 800;
    line-height: 1.5;
}

.nv-panel-description {
    margin-top: 4px;
    color: #667D95;
    font-size: 11px;
    font-weight: 500;
    line-height: 1.7;
}

.nv-info-icon {
    width: 47px;
    height: 47px;
    border-radius: 11px;
}

.nv-info-icon svg {
    width: 23px;
    height: 23px;
}

/* LABEL DAN FILTER */

.nv-label {
    display: block;
    margin-bottom: 7px;
    color: #435C76;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .04em;
    text-transform: uppercase;
}

.nv-select {
    display: block;
    width: 100%;
    min-width: 0;
    min-height: 44px;
    padding: 10px 38px 10px 12px;
    border: 1px solid #C9D9E9;
    border-radius: 9px;
    outline: none;
    background-color: #FFFFFF;
    color: #26374A;
    font-family: inherit;
    font-size: 12px;
    font-weight: 600;

    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;

    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23526982' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;

    transition: border-color .2s ease, box-shadow .2s ease;
}

.nv-select:hover {
    border-color: #A9C5E0;
}

.nv-select:focus {
    border-color: #438BD0;
    box-shadow: 0 0 0 3px rgba(67, 139, 208, .16);
}

.nilai-page select.nv-select option {
    background: #FFFFFF;
    color: #26374A;
}

/* BUTTON */

.nv-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 42px;
    padding: 10px 16px;
    border: 1px solid transparent;
    border-radius: 9px;
    font-family: inherit;
    font-size: 12px;
    font-weight: 800;
    line-height: 1.4;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition:
        background .18s ease,
        border-color .18s ease,
        transform .18s ease;
}

.nv-button svg {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
}

.nv-button:hover {
    transform: translateY(-1px);
}

.nv-button-primary {
    border-color: #3478BD;
    background: #3478BD;
    color: #FFFFFF;
}

.nv-button-primary:hover {
    border-color: #285F96;
    background: #285F96;
    color: #FFFFFF;
}

.nv-button-secondary {
    border-color: #C8DCEE;
    background: #FFFFFF;
    color: #365773;
}

.nv-button-secondary:hover {
    border-color: #A4BFDF;
    background: #E3F0FA;
    color: #285F96;
}

/* BADGE JUMLAH DATA */

.nv-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 31px;
    padding: 6px 11px;
    border: 1px solid #C8DCEE;
    border-radius: 8px;
    background: #EAF4FF;
    color: #3478BD;
    font-size: 11px;
    font-weight: 800;
    white-space: nowrap;
}

/* CHIP INFORMASI */

.nv-chip {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    min-height: 32px;
    padding: 7px 10px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 800;
    line-height: 1.4;
}

.nv-chip-blue {
    border-color: #C8DCEE;
    background: #EAF4FF;
    color: #3478BD;
}

.nv-chip-green {
    border-color: #C6E8D1;
    background: #EFFAF2;
    color: #247546;
}

.nv-chip-teal {
    border-color: #BDE3E3;
    background: #E8F7F6;
    color: #287A78;
}

/* KETERANGAN STATUS */

.nv-status-legend {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 11px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 700;
}

.nv-status-dot {
    width: 7px;
    height: 7px;
    flex-shrink: 0;
    border-radius: 50%;
}

.nv-legend-success {
    border-color: #C6E8D1;
    background: #EFFAF2;
    color: #247546;
}

.nv-legend-danger {
    border-color: #F1CACA;
    background: #FFF1F1;
    color: #B53F4B;
}

.nv-legend-muted {
    border-color: #DCE4EC;
    background: #F1F5F9;
    color: #64748B;
}

.nv-legend-blue {
    border-color: #C8DCEE;
    background: #EAF4FF;
    color: #3478BD;
}

/* TABEL */

.nv-table-shell {
    overflow: hidden;
    border: 1px solid #D5E1ED;
    border-radius: 15px;
    background: #FFFFFF;
    box-shadow: 0 4px 12px rgba(45, 82, 124, .045);
}

.nv-table-scroll {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.nv-table {
    width: 100%;
    min-width: 1450px;
    border-collapse: separate;
    border-spacing: 0;
    table-layout: auto;
}

.nv-table thead th {
    padding: 13px 15px;
    border-right: 1px solid #D7E5F3;
    border-bottom: 1px solid #CFDEED;
    background: #EAF4FF;
    color: #2E5278;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .035em;
    text-transform: uppercase;
    white-space: nowrap;
}

.nv-table thead th:last-child {
    border-right: none;
}

.nv-table tbody td {
    padding: 13px 15px;
    border-right: 1px solid #E0E9F3;
    border-bottom: 1px solid #E0E9F3;
    color: #3B5068;
    font-size: 12px;
    vertical-align: middle;
}

.nv-table tbody td:last-child {
    border-right: none;
}

.nv-table tbody tr:last-child td {
    border-bottom: none;
}

.nv-table tbody tr:nth-child(even) {
    background: #F9FBFE;
}

.nv-table tbody tr {
    transition: background .18s ease;
}

.nv-table tbody tr:hover {
    background: #EDF6FF;
}

/* NAMA SISWA TANPA AVATAR */

.nv-student-name {
    color: #304B69;
    font-size: 12px;
    font-weight: 800;
    white-space: nowrap;
}

/* DATA CHIP */

.nv-data-chip {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 9px;
    border: 1px solid #DCE8F5;
    border-radius: 7px;
    background: #F3F8FE;
    color: #45627F;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.nv-mapel-chip {
    border-color: #D5E2F4;
    background: #EEF4FC;
    color: #3F6691;
}

/* SEMESTER GANJIL DAN GENAP */

.nv-status {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 28px;
    padding: 6px 9px;
    border: 1px solid transparent;
    border-radius: 7px;
    font-size: 10px;
    font-weight: 800;
    white-space: nowrap;
}

/* GANJIL - BIRU PASTEL */

.nv-semester-ganjil {
    border-color: #C8DCEE;
    background: #EAF4FF;
    color: #3478BD;
}

/* GENAP - BIRU MEDIUM PASTEL */

.nv-semester-genap {
    border-color: #AFC7E2;
    background: #C9DDF1;
    color: #315D89;
}

/* NILAI AKHIR */

.nv-final-score {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 65px;
    padding: 7px 10px;
    border: 1px solid #C8DCEE;
    border-radius: 7px;
    background: #EAF4FF;
    color: #285F96;
    font-size: 12px;
    font-weight: 800;
    white-space: nowrap;
}

/* PREDIKAT */

.nv-grade {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 31px;
    height: 29px;
    padding: 5px 9px;
    border: 1px solid transparent;
    border-radius: 7px;
    font-size: 11px;
    font-weight: 900;
}

.nv-grade-a {
    border-color: #C6E8D1;
    background: #EFFAF2;
    color: #247546;
}

.nv-grade-b {
    border-color: #C8DCEE;
    background: #EAF4FF;
    color: #3478BD;
}

.nv-grade-c {
    border-color: #BDE3E3;
    background: #E8F7F6;
    color: #287A78;
}

.nv-grade-d {
    border-color: #F1CACA;
    background: #FFF1F1;
    color: #B53F4B;
}

/* STATUS NILAI */

.nv-status-success {
    border-color: #C6E8D1;
    background: #EFFAF2;
    color: #247546;
}

.nv-status-danger {
    border-color: #F1CACA;
    background: #FFF1F1;
    color: #B53F4B;
}

.nv-status-muted {
    border-color: #DCE4EC;
    background: #F1F5F9;
    color: #64748B;
}

.nv-status-info {
    border-color: #C8DCEE;
    background: #EAF4FF;
    color: #3478BD;
}

/* EMPTY STATE */

.nv-empty {
    padding: 55px 20px;
    text-align: center;
}

.nv-empty-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 58px;
    height: 58px;
    margin: 0 auto 14px;
    border: 1px solid #D5E1ED;
    border-radius: 14px;
    background: #F1F6FC;
    color: #7895B5;
}

.nv-empty-icon svg {
    width: 26px;
    height: 26px;
}

/* PAGINATION */

.nv-pagination {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
}

.nv-page-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 38px;
    padding: 8px 14px;
    border: 1px solid #C8DCEE;
    border-radius: 8px;
    background: #FFFFFF;
    color: #3478BD;
    font-size: 12px;
    font-weight: 800;
    text-decoration: none;
    transition: background .2s ease, border-color .2s ease;
}

.nv-page-link:hover {
    border-color: #A4BFDF;
    background: #EAF4FF;
}

.nv-page-link-disabled {
    border-color: #E0E7EF;
    background: #F4F7FA;
    color: #9AA9B9;
    cursor: not-allowed;
}

/* FOOTER */

.nv-footer-line {
    width: 42px;
    height: 3px;
    margin: 0 auto 12px;
    border-radius: 20px;
    background: #89AAD7;
}

.nv-footer {
    color: #73869B;
    font-size: 11px;
    font-weight: 600;
    text-align: center;
}

/* =====================================================
   DARK MODE
===================================================== */

.dark .nilai-page {
    color: #E4ECF6;
}

/* DARK HEADER */

.dark .nv-hero {
    border-color: #3B5878;
    background: linear-gradient(
        115deg,
        #17283D 0%,
        #1C3049 55%,
        #243E59 100%
    );
    box-shadow: 0 4px 12px rgba(0, 0, 0, .14);
}

.dark .nv-hero-label {
    color: #C6E1FF;
}

.dark .nv-hero-title {
    color: #F1F6FC;
}

.dark .nv-hero-description {
    color: #C2D0E0;
}

.dark .nv-hero-icon,
.dark .nv-info-icon {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

/* DARK PANEL */

.dark .nv-panel {
    border-color: #354962;
    background: #192438;
    box-shadow: none;
}

.dark .nv-panel-header {
    border-color: #354962;
    background: #1C2C42;
}

.dark .nv-panel-title {
    color: #EAF3FF;
}

.dark .nv-panel-description {
    color: #AABBD0;
}

/* DARK FILTER */

.dark .nv-label {
    color: #C5D5E9;
}

.dark .nv-select {
    border-color: #40536B;
    background-color: #111C2E;
    color: #E8F0FB;
    color-scheme: dark;
}

.dark .nilai-page select.nv-select option {
    background: #192438;
    color: #E8F0FB;
}

.dark .nv-select:hover {
    border-color: #5799DC;
}

.dark .nv-select:focus {
    border-color: #5799DC;
    background-color: #152337;
    box-shadow: 0 0 0 3px rgba(87, 153, 220, .17);
}

/* DARK BUTTON */

.dark .nv-button-primary {
    border-color: #557FAF;
    background: #3478BD;
    color: #FFFFFF;
}

.dark .nv-button-primary:hover {
    background: #285F96;
}

.dark .nv-button-secondary {
    border-color: #435873;
    background: #24364D;
    color: #D5E5F8;
}

.dark .nv-button-secondary:hover {
    background: #2F4865;
}

.dark .nv-count {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

/* DARK CHIP */

.dark .nv-chip-blue {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

.dark .nv-chip-green {
    border-color: #315E49;
    background: #1C382D;
    color: #A7E4BD;
}

.dark .nv-chip-teal {
    border-color: #376665;
    background: #203E40;
    color: #A9E1DC;
}

/* DARK LEGEND */

.dark .nv-legend-success {
    border-color: #315E49;
    background: #1C382D;
    color: #A7E4BD;
}

.dark .nv-legend-danger {
    border-color: #704044;
    background: #3B2429;
    color: #FFB4B4;
}

.dark .nv-legend-muted {
    border-color: #40516A;
    background: #27374C;
    color: #C4D0DF;
}

.dark .nv-legend-blue {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

/* DARK TABLE */

.dark .nv-table-shell {
    border-color: #354962;
    background: #192438;
    box-shadow: none;
}

.dark .nv-table thead th {
    border-color: #3A5068;
    background: #263E59;
    color: #E1EDFC;
}

.dark .nv-table tbody td {
    border-color: #354A62;
    color: #D4E0EF;
}

.dark .nv-table tbody tr:nth-child(even) {
    background: #1D2C40;
}

.dark .nv-table tbody tr:nth-child(odd) {
    background: #192438;
}

.dark .nv-table tbody tr:hover {
    background: #24384F;
}

.dark .nv-student-name {
    color: #E3EDF9;
}

.dark .nv-data-chip {
    border-color: #40546E;
    background: #24374F;
    color: #D2E2F5;
}

.dark .nv-mapel-chip {
    border-color: #465C7A;
    background: #293C58;
    color: #D4E5FC;
}

/* DARK SEMESTER GANJIL */

.dark .nv-semester-ganjil {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

/* DARK SEMESTER GENAP */

.dark .nv-semester-genap {
    border-color: #58799E;
    background: #385675;
    color: #E6F1FC;
}

/* DARK NILAI AKHIR */

.dark .nv-final-score {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

/* DARK PREDIKAT */

.dark .nv-grade-a {
    border-color: #315E49;
    background: #1C382D;
    color: #A7E4BD;
}

.dark .nv-grade-b {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

.dark .nv-grade-c {
    border-color: #376665;
    background: #203E40;
    color: #A9E1DC;
}

.dark .nv-grade-d {
    border-color: #704044;
    background: #3B2429;
    color: #FFB4B4;
}

/* DARK STATUS */

.dark .nv-status-success {
    border-color: #315E49;
    background: #1C382D;
    color: #A7E4BD;
}

.dark .nv-status-danger {
    border-color: #704044;
    background: #3B2429;
    color: #FFB4B4;
}

.dark .nv-status-muted {
    border-color: #40516A;
    background: #27374C;
    color: #C4D0DF;
}

.dark .nv-status-info {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

/* DARK EMPTY STATE */

.dark .nv-empty-icon {
    border-color: #40536B;
    background: #24374F;
    color: #A8C2E0;
}

/* DARK PAGINATION */

.dark .nv-page-link {
    border-color: #405773;
    background: #24364D;
    color: #D5E5F8;
}

.dark .nv-page-link:hover {
    border-color: #58799F;
    background: #2F4865;
}

.dark .nv-page-link-disabled {
    border-color: #35465D;
    background: #1D2B3E;
    color: #71849A;
}

/* DARK FOOTER */

.dark .nv-footer {
    color: #AABBD0;
}

.dark .nv-footer-line {
    background: #5C82AB;
}

/* RESPONSIVE */

@media (max-width: 640px) {
    .nv-hero {
        border-radius: 14px;
    }

    .nv-hero-icon {
        width: 47px;
        height: 47px;
        border-radius: 11px;
    }

    .nv-hero-icon svg {
        width: 23px;
        height: 23px;
    }

    .nv-panel-body {
        padding: 16px;
    }

    .nv-panel-header {
        padding: 15px 16px;
    }

    .nv-filter-actions {
        flex-direction: column;
    }

    .nv-filter-actions .nv-button {
        width: 100%;
    }

    .nv-pagination {
        justify-content: center;
        gap: 8px;
    }

    .nv-page-link {
        padding: 8px 11px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .nilai-page *,
    .nilai-page *::before,
    .nilai-page *::after {
        animation: none !important;
        transition: none !important;
    }
}
</style>
@endpush


@section('content')

<div class="nilai-page space-y-6">

    {{-- HEADER HALAMAN --}}
    <section class="nv-hero nv-enter">

        <div class="flex items-center gap-4 p-5 sm:p-7">

            <div class="nv-hero-icon">

                <svg fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24"
                     aria-hidden="true">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M4 19V5m0 14h16"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M8 16v-5m4 5V7m4 9v-8"/>

                </svg>

            </div>

            <div class="min-w-0">

                <p class="nv-hero-label mb-1">
                    Akademik
                </p>

                <h2 class="nv-hero-title text-xl font-extrabold sm:text-2xl">
                    Data Nilai
                </h2>

                <p class="nv-hero-description mt-2 text-sm leading-relaxed">
                    Lihat dan pantau nilai akademik siswa berdasarkan kelas,
                    semester, dan mata pelajaran.
                </p>

            </div>

        </div>

    </section>


    {{-- INFORMASI DATA NILAI --}}
    <section class="nv-panel nv-enter">

        <div class="nv-panel-body">

            <div class="flex flex-col sm:flex-row sm:items-start gap-4">

                <div class="nv-info-icon">

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M4 19V5m0 14h16"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M8 16v-5m4 5V7m4 9v-8"/>

                    </svg>

                </div>

                <div class="min-w-0 flex-1">

                    <h3 class="nv-panel-title">
                        Pemantauan Data Nilai
                    </h3>

                    <p class="nv-panel-description mt-2">
                        Admin dapat melihat dan memantau nilai akademik siswa
                        berdasarkan kelas, semester, dan mata pelajaran.
                        Penginputan serta pengelolaan nilai dilakukan melalui
                        akun Guru.
                    </p>

                    <div class="mt-4 flex flex-wrap gap-2">

                        <span class="nv-chip nv-chip-green">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6"/>
                            </svg>
                            Lihat Data Nilai
                        </span>

                        <span class="nv-chip nv-chip-blue">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6"/>
                            </svg>
                            Filter Nilai
                        </span>

                        <span class="nv-chip nv-chip-teal">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6"/>
                            </svg>
                            Pantau KKM
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- FILTER DATA NILAI --}}
    <section class="nv-panel nv-enter">

        <div class="nv-panel-header">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                <div>
                    <h3 class="nv-panel-title">
                        Filter Data Nilai
                    </h3>

                    <p class="nv-panel-description">
                        Pilih kelas, semester, dan mata pelajaran untuk melihat nilai tertentu.
                    </p>
                </div>

                <span class="nv-count">
                    {{ $nilaiList->total() }} Data
                </span>

            </div>

        </div>


        <div class="nv-panel-body">

            <form
                method="GET"
                action="{{ route('admin.nilai.index') }}"
                class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 items-end"
            >

                {{-- KELAS --}}
                <div>

                    <label for="filter-kelas" class="nv-label">
                        Kelas
                    </label>

                    <select
                        id="filter-kelas"
                        name="kelas"
                        class="nv-select"
                    >

                        <option value="">
                            Semua Kelas
                        </option>

                        @foreach($kelasList as $kelas)

                            <option
                                value="{{ $kelas->nama_kelas }}"
                                {{ $kelasTerpilih == $kelas->nama_kelas ? 'selected' : '' }}
                            >
                                {{ $kelas->nama_kelas }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- SEMESTER --}}
                <div>

                    <label for="filter-semester" class="nv-label">
                        Semester
                    </label>

                    <select
                        id="filter-semester"
                        name="semester"
                        class="nv-select"
                    >

                        <option value="">
                            Semua Semester
                        </option>

                        <option
                            value="1"
                            {{ (string) $semesterTerpilih === '1' ? 'selected' : '' }}
                        >
                            Semester 1 - Ganjil
                        </option>

                        <option
                            value="2"
                            {{ (string) $semesterTerpilih === '2' ? 'selected' : '' }}
                        >
                            Semester 2 - Genap
                        </option>

                    </select>

                </div>


                {{-- MATA PELAJARAN --}}
                <div>

                    <label for="filter-mapel" class="nv-label">
                        Mata Pelajaran
                    </label>

                    <select
                        id="filter-mapel"
                        name="mapel"
                        class="nv-select"
                    >

                        <option value="">
                            Semua Mata Pelajaran
                        </option>

                        @foreach($mapelList as $mapel)

                            <option
                                value="{{ $mapel->id_mapel }}"
                                {{ (string) $mapelTerpilih === (string) $mapel->id_mapel ? 'selected' : '' }}
                            >
                                {{ $mapel->nama_mapel }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- TOMBOL FILTER --}}
                <div class="nv-filter-actions flex gap-2">

                    <button
                        type="submit"
                        class="nv-button nv-button-primary flex-1"
                    >

                        <svg fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             viewBox="0 0 24 24"
                             aria-hidden="true">

                            <circle cx="11" cy="11" r="7"/>

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="m16 16 4 4"/>

                        </svg>

                        Tampilkan

                    </button>

                    @if($kelasTerpilih || $semesterTerpilih || $mapelTerpilih)

                        <a
                            href="{{ route('admin.nilai.index') }}"
                            class="nv-button nv-button-secondary"
                        >
                            Reset
                        </a>

                    @endif

                </div>

            </form>

        </div>

    </section>


    {{-- INFORMASI FILTER AKTIF --}}
    <section class="nv-panel">

        <div class="nv-panel-body">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div class="min-w-0">

                    <h3 class="nv-panel-title">
                        Daftar Nilai
                    </h3>

                    <p class="nv-panel-description mt-2">

                        @if($kelasTerpilih)
                            Kelas {{ $kelasTerpilih }}
                        @else
                            Semua Kelas
                        @endif

                        @if((string) $semesterTerpilih === '1')
                            • Semester 1 - Ganjil
                        @elseif((string) $semesterTerpilih === '2')
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

                <span class="nv-count">
                    {{ $nilaiList->total() }} Data Nilai
                </span>

            </div>

        </div>

    </section>


    {{-- KETERANGAN STATUS NILAI --}}
    <section class="nv-panel">

        <div class="nv-panel-body">

            <h3 class="nv-panel-title mb-4">
                Keterangan Status Nilai
            </h3>

            <div class="flex flex-wrap gap-2">

                <span class="nv-status-legend nv-legend-success">
                    <span class="nv-status-dot bg-emerald-500"></span>
                    Tuntas: nilai akhir ≥ KKM
                </span>

                <span class="nv-status-legend nv-legend-danger">
                    <span class="nv-status-dot bg-red-500"></span>
                    Remedial: nilai akhir di bawah KKM
                </span>

                <span class="nv-status-legend nv-legend-muted">
                    <span class="nv-status-dot bg-slate-400"></span>
                    Belum dinilai
                </span>

                <span class="nv-status-legend nv-legend-blue">
                    <span class="nv-status-dot bg-blue-500"></span>
                    KKM belum diatur
                </span>

            </div>

        </div>

    </section>


    {{-- TABEL DATA NILAI --}}
    <section class="nv-table-shell">

        <div class="nv-panel-header">

            <h3 class="nv-panel-title">
                Data Nilai Siswa
            </h3>

            <p class="nv-panel-description">
                Admin hanya memiliki akses untuk melihat dan memantau data nilai.
            </p>

        </div>


        <div class="nv-table-scroll">

            <table class="nv-table">

                <thead>
                    <tr>
                        <th class="text-left">No</th>
                        <th class="text-left">NIS</th>
                        <th class="text-left">Nama Siswa</th>
                        <th class="text-left">Kelas</th>
                        <th class="text-left">Mata Pelajaran</th>
                        <th class="text-center">Semester</th>
                        <th class="text-center">Harian</th>
                        <th class="text-center">UTS</th>
                        <th class="text-center">UAS</th>
                        <th class="text-center">Nilai Akhir</th>
                        <th class="text-center">KKM</th>
                        <th class="text-center">Predikat</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>


                <tbody>

                    @forelse($nilaiList as $index => $nilai)

                        @php
                            $nilaiAkhirTersedia = is_numeric($nilai->nilai_akhir);
                            $kkmTersedia = is_numeric($nilai->mapel->kkm ?? null);
                        @endphp

                        <tr>

                            {{-- NO --}}
                            <td>
                                <span class="font-semibold">
                                    {{ $nilaiList->firstItem() + $index }}
                                </span>
                            </td>


                            {{-- NIS --}}
                            <td>
                                <span class="whitespace-nowrap font-semibold">
                                    {{ $nilai->siswa->nis ?? '-' }}
                                </span>
                            </td>


                            {{-- NAMA SISWA TANPA HURUF INISIAL --}}
                            <td>
                                <span class="nv-student-name">
                                    {{ $nilai->siswa->nama_siswa ?? '-' }}
                                </span>
                            </td>


                            {{-- KELAS --}}
                            <td>
                                <span class="nv-data-chip">
                                    {{ $nilai->siswa->kelas ?? '-' }}
                                </span>
                            </td>


                            {{-- MATA PELAJARAN --}}
                            <td>
                                <span class="nv-data-chip nv-mapel-chip">
                                    {{ $nilai->mapel->nama_mapel ?? '-' }}
                                </span>
                            </td>


                            {{-- SEMESTER --}}
                            <td class="text-center">

                                @if($nilai->semester == 1)

                                    <span class="nv-status nv-semester-ganjil">
                                        Ganjil
                                    </span>

                                @elseif($nilai->semester == 2)

                                    <span class="nv-status nv-semester-genap">
                                        Genap
                                    </span>

                                @else

                                    <span class="nv-muted">-</span>

                                @endif

                            </td>


                            {{-- NILAI HARIAN --}}
                            <td class="text-center">
                                <span class="whitespace-nowrap font-semibold">
                                    {{ is_numeric($nilai->nilai_harian) ? number_format((float) $nilai->nilai_harian, 2) : '-' }}
                                </span>
                            </td>


                            {{-- NILAI UTS --}}
                            <td class="text-center">
                                <span class="whitespace-nowrap font-semibold">
                                    {{ is_numeric($nilai->nilai_uts) ? number_format((float) $nilai->nilai_uts, 2) : '-' }}
                                </span>
                            </td>


                            {{-- NILAI UAS --}}
                            <td class="text-center">
                                <span class="whitespace-nowrap font-semibold">
                                    {{ is_numeric($nilai->nilai_uas) ? number_format((float) $nilai->nilai_uas, 2) : '-' }}
                                </span>
                            </td>


                            {{-- NILAI AKHIR --}}
                            <td class="text-center">

                                @if($nilaiAkhirTersedia)

                                    <span class="nv-final-score">
                                        {{ number_format((float) $nilai->nilai_akhir, 2) }}
                                    </span>

                                @else

                                    <span class="nv-muted">-</span>

                                @endif

                            </td>


                            {{-- KKM --}}
                            <td class="text-center">

                                @if($kkmTersedia)

                                    <span class="whitespace-nowrap font-semibold">
                                        {{ number_format((float) $nilai->mapel->kkm, 0) }}
                                    </span>

                                @else

                                    <span class="nv-muted whitespace-nowrap">
                                        Belum diatur
                                    </span>

                                @endif

                            </td>


                            {{-- PREDIKAT --}}
                            <td class="text-center">

                                @if($nilai->predikat === 'A')

                                    <span class="nv-grade nv-grade-a">A</span>

                                @elseif($nilai->predikat === 'B')

                                    <span class="nv-grade nv-grade-b">B</span>

                                @elseif($nilai->predikat === 'C')

                                    <span class="nv-grade nv-grade-c">C</span>

                                @elseif($nilai->predikat === 'D')

                                    <span class="nv-grade nv-grade-d">D</span>

                                @else

                                    <span class="nv-muted">-</span>

                                @endif

                            </td>


                            {{-- STATUS --}}
                            <td class="text-center">

                                @if(!$nilaiAkhirTersedia)

                                    <span class="nv-status nv-status-muted">
                                        Belum dinilai
                                    </span>

                                @elseif(!$kkmTersedia)

                                    <span class="nv-status nv-status-info">
                                        KKM belum diatur
                                    </span>

                                @elseif((float) $nilai->nilai_akhir >= (float) $nilai->mapel->kkm)

                                    <span class="nv-status nv-status-success">
                                        Tuntas
                                    </span>

                                @else

                                    <span class="nv-status nv-status-danger">
                                        Remedial
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="13">

                                <div class="nv-empty">

                                    <div class="nv-empty-icon">

                                        <svg fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.6"
                                             viewBox="0 0 24 24"
                                             aria-hidden="true">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M4 19V5m0 14h16"/>

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M8 16v-5m4 5V7m4 9v-8"/>

                                        </svg>

                                    </div>

                                    <h4 class="nv-panel-title">
                                        Belum ada data nilai
                                    </h4>

                                    <p class="nv-muted mt-2">
                                        Belum ditemukan nilai untuk filter yang dipilih.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>


    {{-- PAGINATION: TOMBOL SAJA --}}
    @if($nilaiList->hasPages())

        <section class="nv-panel">

            <div class="nv-panel-body">

                <nav class="nv-pagination" aria-label="Navigasi halaman data nilai">

                    {{-- SEBELUMNYA --}}
                    @if($nilaiList->onFirstPage())

                        <span class="nv-page-link nv-page-link-disabled">
                            ← Sebelumnya
                        </span>

                    @else

                        <a
                            href="{{ request()->fullUrlWithQuery(['page' => $nilaiList->currentPage() - 1]) }}"
                            class="nv-page-link"
                        >
                            ← Sebelumnya
                        </a>

                    @endif


                    {{-- SELANJUTNYA --}}
                    @if($nilaiList->hasMorePages())

                        <a
                            href="{{ request()->fullUrlWithQuery(['page' => $nilaiList->currentPage() + 1]) }}"
                            class="nv-page-link"
                        >
                            Selanjutnya →
                        </a>

                    @else

                        <span class="nv-page-link nv-page-link-disabled">
                            Selanjutnya →
                        </span>

                    @endif

                </nav>

            </div>

        </section>

    @endif


    {{-- FOOTER --}}
    <footer class="pt-2 pb-3 text-center">

        <div class="nv-footer-line"></div>

        <p class="nv-footer">
            © {{ date('Y') }} Sistem Akademik Mini
        </p>

    </footer>

</div>

@endsection