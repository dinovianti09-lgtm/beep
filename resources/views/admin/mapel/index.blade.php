@extends('layouts.admin')

@section('title', 'Data Mata Pelajaran - Sistem Akademik')
@section('page-title', 'Mata Pelajaran')
@section('page-subtitle', 'Kelola data mata pelajaran, jurusan, tingkat kelas, dan KKM')

@push('styles')
<style>
/* =====================================================
   EDUVIA - DATA MATA PELAJARAN
   Pastel Blue + Dark Navy
===================================================== */

.mapel-page {
    --mapel-blue: #3478BD;
    --mapel-blue-dark: #285F96;
    --mapel-blue-light: #89AAD7;
    --mapel-pale: #E3F0FA;
    --mapel-text: #293F57;
    --mapel-muted: #526982;
    --mapel-border: #D5E1ED;
    --mapel-card: #FFFFFF;

    color: var(--mapel-text);
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.dark .mapel-page {
    --mapel-text: #E4ECF6;
    --mapel-muted: #AABBD0;
    --mapel-border: #354A62;
    --mapel-card: #192438;
}

/* ANIMASI */

.mapel-enter {
    animation: mapelEnter .35s ease-out both;
}

.mapel-delay-1 {
    animation-delay: .06s;
}

.mapel-delay-2 {
    animation-delay: .12s;
}

@keyframes mapelEnter {
    from {
        opacity: 0;
        transform: translateY(7px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* HEADER HALAMAN */

.mapel-hero {
    position: relative;
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

.mapel-hero::before,
.mapel-hero::after {
    display: none !important;
    content: none !important;
}

.mapel-hero-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 58px;
    height: 58px;
    flex-shrink: 0;
    border: 1px solid #FFFFFF;
    border-radius: 15px;
    color: #285F96;
    background: #FFFFFF;
}

.mapel-hero-title {
    color: #214A77;
}

.mapel-hero-description {
    color: #4D6886;
}

.dark .mapel-hero {
    background: linear-gradient(
        115deg,
        #17283D 0%,
        #1C3049 55%,
        #243E59 100%
    );
    border-color: #3B5878;
    box-shadow: 0 4px 12px rgba(0, 0, 0, .14);
}

.dark .mapel-hero-title {
    color: #F1F6FC;
}

.dark .mapel-hero-description {
    color: #C2D0E0;
}

.dark .mapel-hero-icon {
    background: #263E59;
    color: #D8E9FC;
    border-color: #405B78;
}

/* TOMBOL */

.mapel-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 40px;
    padding: 10px 15px;
    border: 1px solid transparent;
    border-radius: 9px;
    font-size: 13px;
    font-weight: 800;
    line-height: 1.4;
    text-decoration: none;
    cursor: pointer;
    white-space: nowrap;
    transition:
        transform .18s ease,
        box-shadow .18s ease,
        background .18s ease,
        border-color .18s ease;
}

.mapel-btn:hover {
    transform: translateY(-1px);
}

.mapel-btn:active {
    transform: translateY(0);
}

.mapel-btn:focus-visible {
    outline: 3px solid rgba(52, 120, 189, .3);
    outline-offset: 3px;
}

.mapel-btn-primary {
    color: #FFFFFF;
    background: #3478BD;
    border-color: #3478BD;
    box-shadow: 0 3px 8px rgba(52, 120, 189, .12);
}

.mapel-btn-primary:hover {
    color: #FFFFFF;
    background: #285F96;
    border-color: #285F96;
}

.mapel-btn-secondary {
    color: #365773;
    background: #FFFFFF;
    border-color: #C8DCEE;
}

.mapel-btn-secondary:hover {
    color: #285F96;
    background: #E3F0FA;
    border-color: #A4BFDF;
}

.mapel-btn-search {
    color: #FFFFFF;
    background: #3478BD;
    border-color: #3478BD;
}

.mapel-btn-search:hover {
    color: #FFFFFF;
    background: #285F96;
    border-color: #285F96;
}

.mapel-btn-edit {
    color: #285F98;
    background: #E3F0FA;
    border-color: #C3D8EB;
}

.mapel-btn-edit:hover {
    color: #FFFFFF;
    background: #3478BD;
    border-color: #3478BD;
}

.mapel-btn-delete {
    color: #A93649;
    background: #FFF0F1;
    border-color: #F1D1D5;
}

.mapel-btn-delete:hover {
    color: #FFFFFF;
    background: #C9475D;
    border-color: #C9475D;
}

.dark .mapel-btn-primary {
    color: #FFFFFF;
    background: #3478BD;
    border-color: #557FAF;
}

.dark .mapel-btn-primary:hover {
    background: #285F96;
}

.dark .mapel-btn-secondary {
    color: #D5E5F8;
    background: #24364D;
    border-color: #435873;
}

.dark .mapel-btn-secondary:hover {
    background: #2F4865;
}

.dark .mapel-btn-edit {
    color: #C7E2FF;
    background: #243D59;
    border-color: #3A5674;
}

.dark .mapel-btn-edit:hover {
    color: #FFFFFF;
    background: #3478BD;
}

.dark .mapel-btn-delete {
    color: #FFC5CD;
    background: #432A35;
    border-color: #65404B;
}

.dark .mapel-btn-delete:hover {
    color: #FFFFFF;
    background: #B83B52;
}

/* NOTIFIKASI */

.mapel-notice {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 15px 17px;
    border: 1px solid;
    border-radius: 11px;
    animation: mapelEnter .25s ease-out;
}

/* PANEL PENCARIAN DAN FILTER */

.mapel-panel {
    position: relative;
    overflow: visible;
    background: linear-gradient(
        115deg,
        #C3E0F4 0%,
        #E3F0FA 55%,
        #F8FAFC 100%
    );
    border: 1px solid #BDD6EE;
    border-radius: 17px;
    box-shadow: 0 4px 12px rgba(47, 93, 145, .06);
}

.mapel-panel-heading {
    color: #214A77;
}

.dark .mapel-panel {
    background: linear-gradient(
        115deg,
        #17283D 0%,
        #1C3049 55%,
        #243E59 100%
    );
    border-color: #3B5878;
    box-shadow: 0 4px 12px rgba(0, 0, 0, .14);
}

.dark .mapel-panel-heading {
    color: #F1F6FC;
}

.mapel-field-label {
    display: block;
    margin-bottom: 7px;
    color: #435C76;
    font-size: 12px;
    font-weight: 800;
}

.dark .mapel-field-label {
    color: #C5D5E9;
}

/* INPUT DAN DROPDOWN FILTER */

.mapel-input {
    display: block;
    width: 100%;
    min-width: 0;
    min-height: 44px;
    padding: 10px 12px;
    border: 1px solid #C9D9E9;
    border-radius: 9px;
    background: #FFFFFF;
    color: #26374A;
    font-size: 13px;
    line-height: 1.5;
    transition:
        border-color .2s ease,
        box-shadow .2s ease,
        background .2s ease;
}

.mapel-input::placeholder {
    color: #8495A8;
}

.mapel-input:focus {
    outline: none;
    border-color: #438BD0;
    box-shadow: 0 0 0 3px rgba(67, 139, 208, .16);
}

.dark .mapel-input {
    background: #111C2E;
    color: #E8F0FB;
    border-color: #40536B;
}

.dark .mapel-input:focus {
    border-color: #5799DC;
    box-shadow: 0 0 0 3px rgba(87, 153, 220, .17);
}

/* DROPDOWN JURUSAN DAN TINGKAT */

.mapel-page select.mapel-input {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;

    width: 100%;
    min-height: 44px;
    padding: 10px 40px 10px 12px;

    border: 1px solid #C9D9E9;
    border-radius: 9px;

    background-color: #FFFFFF;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23526982' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 13px center;
    background-size: 16px;

    color: #26374A;
    font-family: inherit;
    font-size: 13px;
    line-height: 1.5;
    font-weight: 500;

    cursor: pointer;

    transition:
        border-color .2s ease,
        box-shadow .2s ease,
        background-color .2s ease;
}

.mapel-page select.mapel-input:hover {
    border-color: #A9C5E0;
}

.mapel-page select.mapel-input:focus {
    outline: none;
    border-color: #438BD0;
    box-shadow: 0 0 0 3px rgba(67, 139, 208, .16);
}

/* DROPDOWN MODE GELAP */

.dark .mapel-page select.mapel-input {
    background-color: #111C2E;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23AABBD0' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");

    color: #E8F0FB;
    border-color: #40536B;
}

.dark .mapel-page select.mapel-input:hover {
    border-color: #5799DC;
}

.dark .mapel-page select.mapel-input:focus {
    border-color: #5799DC;
    box-shadow: 0 0 0 3px rgba(87, 153, 220, .17);
}

.mapel-page select.mapel-input option {
    padding: 10px;
    background: #FFFFFF;
    color: #26374A;
}

.dark .mapel-page select.mapel-input option {
    background: #192438;
    color: #E8F0FB;
}

/* RINGKASAN FILTER */

.mapel-filter-summary {
    color: #506983;
    background: rgba(255, 255, 255, .62);
    border: 1px solid #D8E7F6;
    border-radius: 9px;
}

.dark .mapel-filter-summary {
    color: #C6D5E7;
    background: rgba(17, 28, 46, .65);
    border-color: #364B65;
}

/* SUSUNAN FILTER */

.mapel-filter-grid {
    display: grid;
    grid-template-columns:
        minmax(220px, 1.5fr)
        minmax(140px, .9fr)
        minmax(140px, .9fr)
        auto;
    align-items: end;
    gap: 14px;
}

.mapel-filter-grid > div {
    min-width: 0;
}

.mapel-filter-search {
    min-width: 0;
}

.mapel-filter-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.mapel-filter-actions .mapel-btn {
    min-height: 44px;
    padding: 10px 13px;
}

/* RIWAYAT PENCARIAN */

.mapel-search-wrapper {
    position: relative;
    width: 100%;
}

.mapel-suggestion-box {
    position: absolute;
    top: calc(100% + 7px);
    left: 0;
    right: 0;
    z-index: 60;
    overflow: hidden;
    background: #FFFFFF;
    border: 1px solid #D5E1ED;
    border-radius: 11px;
    box-shadow: 0 8px 20px rgba(39, 77, 119, .12);
    animation: suggestionEnter .16s ease-out;
}

.mapel-suggestion-box.hidden {
    display: none !important;
}

@keyframes suggestionEnter {
    from {
        opacity: 0;
        transform: translateY(-4px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.mapel-suggestion-heading {
    padding: 11px 14px;
    color: #71849A;
    background: #F8FAFC;
    border-bottom: 1px solid #E5EDF5;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.mapel-suggestion-item {
    display: flex;
    align-items: center;
    gap: 11px;
    width: 100%;
    padding: 11px 14px;
    color: #30445B;
    background: #FFFFFF;
    text-align: left;
    font-size: 13px;
    font-weight: 600;
    transition: background .18s ease;
}

.mapel-suggestion-item + .mapel-suggestion-item {
    border-top: 1px solid #EDF1F6;
}

.mapel-suggestion-item:hover,
.mapel-suggestion-item:focus-visible {
    background: #EAF3FC;
    color: #285F96;
    outline: none;
}

.mapel-suggestion-item svg {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
    color: #89AAD7;
}

.dark .mapel-suggestion-box {
    background: #192438;
    border-color: #354A62;
    box-shadow: 0 8px 20px rgba(0, 0, 0, .25);
}

.dark .mapel-suggestion-heading {
    color: #AFC0D4;
    background: #203149;
    border-color: #354A62;
}

.dark .mapel-suggestion-item {
    color: #E1EAF5;
    background: #192438;
}

.dark .mapel-suggestion-item + .mapel-suggestion-item {
    border-color: #34465F;
}

.dark .mapel-suggestion-item:hover,
.dark .mapel-suggestion-item:focus-visible {
    background: #263E59;
    color: #FFFFFF;
}

.dark .mapel-suggestion-item svg {
    color: #AFCBEA;
}

/* TABEL MATA PELAJARAN */

.mapel-table-card {
    overflow: hidden;
    background: #FFFFFF;
    border: 1px solid #D5E1ED;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(45, 82, 124, .045);
}

.dark .mapel-table-card {
    background: #192438;
    border-color: #354962;
    box-shadow: none;
}

.mapel-table-header {
    background: #F5F9FE;
    border-bottom: 1px solid #D4E3F2;
}

.dark .mapel-table-header {
    background: #1C2C42;
    border-color: #354962;
}

.mapel-table-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 7px 11px;
    border: 1px solid #BDD8F2;
    border-radius: 8px;
    color: #285F98;
    background: #E3F0FA;
    font-size: 12px;
    font-weight: 800;
    white-space: nowrap;
}

.dark .mapel-table-count {
    color: #C6E1FF;
    background: #263E59;
    border-color: #3A5776;
}

/* TABEL */

.mapel-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.mapel-table thead th {
    padding: 14px 17px;
    text-align: left;
    white-space: nowrap;
    color: #315579;
    background: #E3F0FA;
    border-bottom: 1px solid #C3D8EB;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .045em;
    text-transform: uppercase;
}

.mapel-table thead th:last-child {
    text-align: center;
}

.mapel-table tbody tr {
    background: #FFFFFF;
    transition: background .18s ease;
}

.mapel-table tbody tr:nth-child(even) {
    background: #F8FAFC;
}

.mapel-table tbody tr:hover {
    background: #EDF5FE;
}

.mapel-table tbody td {
    padding: 16px 17px;
    border-bottom: 1px solid #E0EAF4;
    vertical-align: middle;
}

.mapel-table tbody tr:last-child td {
    border-bottom: 0;
}

.mapel-text {
    color: #2E435B;
}

.mapel-muted {
    color: #526982;
}

.mapel-subject-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 43px;
    height: 43px;
    flex-shrink: 0;
    border: 1px solid #C6DDF5;
    border-radius: 11px;
    background: #E3F0FA;
    color: #3478BD;
}

.dark .mapel-table thead th {
    color: #DDEBFC;
    background: #263A53;
    border-color: #3B506B;
}

.dark .mapel-table tbody tr,
.dark .mapel-table tbody tr:nth-child(even) {
    background: #192438;
}

.dark .mapel-table tbody tr:hover {
    background: #24354C;
}

.dark .mapel-table tbody td {
    border-color: #34465F;
}

.dark .mapel-text {
    color: #E4EDF8;
}

.dark .mapel-muted {
    color: #A9BCD2;
}

.dark .mapel-subject-icon {
    background: #263E59;
    border-color: #405773;
    color: #C6E2FF;
}

/* BADGE JURUSAN DAN TINGKAT */

.mapel-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    max-width: 230px;
    min-height: 30px;
    padding: 6px 10px;
    border: 1px solid #C3D8EB;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
    line-height: 1.4;
}

.mapel-badge-blue,
.mapel-badge-violet,
.mapel-badge-teal {
    color: #285F98;
    background: #E3F0FA;
    border-color: #C3D8EB;
}

.mapel-badge-list {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 7px;
    min-width: 100px;
}

.dark .mapel-badge-blue,
.dark .mapel-badge-violet,
.dark .mapel-badge-teal {
    color: #C6E1FF;
    background: #203C5B;
    border-color: #355574;
}

/* KKM */

.mapel-kkm {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 42px;
    min-height: 34px;
    padding: 6px 12px;
    border: 1px solid #BDD6EE;
    border-radius: 8px;
    background: #E3F0FA;
    color: #285F96;
    font-size: 14px;
    font-weight: 800;
    font-variant-numeric: tabular-nums;
    line-height: 1.4;
    white-space: nowrap;
}

.dark .mapel-kkm {
    color: #C6E2FF;
    background: #203B57;
    border-color: #355675;
}

/* BELUM DIATUR */

.mapel-unconfigured {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 32px;
    padding: 7px 11px;
    border: 1px solid #D5E1ED;
    border-radius: 8px;
    background: #F3F6FA;
    color: #526982;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
}

.dark .mapel-unconfigured {
    color: #C2D0E0;
    background: #263A53;
    border-color: #435873;
}

/* DATA KOSONG */

.mapel-empty {
    padding: 50px 20px !important;
    text-align: center;
}

.mapel-empty-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 56px;
    height: 56px;
    margin: 0 auto 14px;
    border: 1px solid #C8DFF6;
    border-radius: 14px;
    background: #E3F0FA;
    color: #3478BD;
}

.dark .mapel-empty-icon {
    background: #263C56;
    border-color: #3D5876;
    color: #C7E3FF;
}

/* PAGINATION */

.mapel-pagination {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px;
    border-top: 1px solid #D5E1ED;
    background: #FFFFFF;
}

.mapel-page-link {
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

.mapel-page-link:hover {
    border-color: #A4BFDF;
    background: #EAF4FF;
}

.mapel-page-link-disabled {
    border-color: #E0E7EF;
    background: #F4F7FA;
    color: #9AA9B9;
    cursor: not-allowed;
}

.dark .mapel-pagination {
    border-color: #354962;
    background: #192438;
}

.dark .mapel-page-link {
    border-color: #405773;
    background: #24364D;
    color: #D5E5F8;
}

.dark .mapel-page-link:hover {
    border-color: #58799F;
    background: #2F4865;
}

.dark .mapel-page-link-disabled {
    border-color: #35465D;
    background: #1D2B3E;
    color: #71849A;
}

/* FOOTER */

.mapel-footer-line {
    width: 42px;
    height: 3px;
    margin: 0 auto 12px;
    border-radius: 20px;
    background: #89AAD7;
}

/* RESPONSIVE */

@media (max-width: 1100px) {
    .mapel-filter-grid {
        grid-template-columns:
            minmax(0, 1.4fr)
            minmax(0, 1fr);
    }

    .mapel-filter-search,
    .mapel-filter-actions {
        grid-column: 1 / -1;
    }

    .mapel-filter-actions {
        justify-content: flex-end;
    }
}

@media (max-width: 640px) {
    .mapel-hero {
        border-radius: 14px;
    }

    .mapel-hero-icon {
        width: 47px;
        height: 47px;
        border-radius: 11px;
    }

    .mapel-hero-icon svg {
        width: 23px;
        height: 23px;
    }

    .mapel-table thead th,
    .mapel-table tbody td {
        padding: 12px;
    }

    .mapel-btn {
        padding: 10px 13px;
    }

    .mapel-badge {
        font-size: 11px;
        padding: 6px 8px;
    }

    .mapel-kkm {
        min-width: 38px;
        min-height: 31px;
        padding: 5px 9px;
    }

    .mapel-filter-grid {
        grid-template-columns: minmax(0, 1fr);
        gap: 15px;
    }

    .mapel-filter-search,
    .mapel-filter-actions {
        grid-column: auto;
    }

    .mapel-filter-actions {
        justify-content: flex-start;
    }

    .mapel-pagination {
        justify-content: center;
        gap: 8px;
        padding: 16px;
    }

    .mapel-page-link {
        padding: 8px 11px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .mapel-page *,
    .mapel-page *::before,
    .mapel-page *::after {
        animation: none !important;
        transition: none !important;
    }
}
</style>
@endpush


@section('content')

<div class="mapel-page space-y-6">

    {{-- HEADER HALAMAN --}}
    <section class="mapel-hero mapel-enter">

        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5 p-5 sm:p-7">

            <div class="flex items-center gap-4 min-w-0">

                <div class="mapel-hero-icon">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21V5.5Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 17a2.5 2.5 0 0 1 2.5-2.5H20"/>
                    </svg>
                </div>

                <div class="min-w-0">

                    <p class="text-xs font-extrabold tracking-widest text-blue-700 dark:text-blue-300 uppercase mb-1">
                        Data Master
                    </p>

                    <h1 class="mapel-hero-title text-xl sm:text-2xl font-extrabold">
                        Data Mata Pelajaran
                    </h1>

                    <p class="mapel-hero-description text-sm mt-2 leading-relaxed">
                        Kelola mata pelajaran, jurusan, tingkat kelas, dan KKM.
                    </p>

                </div>

            </div>

            <a href="{{ route('admin.mapel.create') }}"
               class="mapel-btn mapel-btn-primary flex-shrink-0">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>

                Tambah Mapel

            </a>

        </div>

    </section>


    {{-- NOTIFIKASI BERHASIL --}}
    @if(session('success'))

        <div class="mapel-notice mapel-enter bg-emerald-50 border-emerald-200 dark:bg-emerald-950/30 dark:border-emerald-800">

            <div class="w-9 h-9 shrink-0 flex items-center justify-center rounded-lg bg-emerald-100 text-emerald-700 dark:bg-emerald-900/60 dark:text-emerald-300">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m5 13 4 4L19 7"/>
                </svg>

            </div>

            <p class="text-sm font-bold text-emerald-800 dark:text-emerald-300 pt-2">
                {{ session('success') }}
            </p>

        </div>

    @endif


    {{-- NOTIFIKASI ERROR --}}
    @if(session('error'))

        <div class="mapel-notice bg-rose-50 border-rose-200 dark:bg-rose-950/30 dark:border-rose-800">

            <div class="w-9 h-9 shrink-0 flex items-center justify-center rounded-lg bg-rose-100 text-rose-700 dark:bg-rose-900/60 dark:text-rose-300">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="9"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/>
                </svg>

            </div>

            <p class="text-sm font-bold text-rose-800 dark:text-rose-300 pt-2">
                {{ session('error') }}
            </p>

        </div>

    @endif


    {{-- VALIDASI --}}
    @if($errors->any())

        <div class="mapel-notice bg-rose-50 border-rose-200 dark:bg-rose-950/30 dark:border-rose-800">

            <div class="w-9 h-9 shrink-0 flex items-center justify-center rounded-lg bg-rose-100 text-rose-700 dark:bg-rose-900/60 dark:text-rose-300">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="9"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/>
                </svg>

            </div>

            <div>

                <p class="text-sm font-extrabold text-rose-800 dark:text-rose-300 mb-2">
                    Terjadi kesalahan:
                </p>

                <ul class="list-disc ml-5 space-y-1 text-sm text-rose-700 dark:text-rose-300">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    {{-- LOGIKA PENCARIAN DAN FILTER --}}
    @php
        $search = trim(request('search', ''));
        $filterJurusan = request('jurusan', '');
        $filterTingkat = request('tingkat', '');

        $adaFilter = $search !== ''
            || $filterJurusan !== ''
            || $filterTingkat !== '';
    @endphp


    {{-- PANEL PENCARIAN DAN FILTER --}}
    <section class="mapel-panel mapel-enter mapel-delay-1 p-5 sm:p-6">

        <div class="flex items-center gap-3 mb-5">

            <div class="w-10 h-10 shrink-0 rounded-lg flex items-center justify-center bg-blue-100 text-blue-700 dark:bg-blue-500/15 dark:text-blue-300">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="11" cy="11" r="7"/>
                    <path stroke-linecap="round" d="m20 20-4-4"/>
                </svg>

            </div>

            <div>

                <h2 class="mapel-panel-heading text-sm font-extrabold">
                    Cari dan Filter Mata Pelajaran
                </h2>

                <p class="mapel-muted text-xs mt-1">
                    Cari berdasarkan nama, KKM, jurusan, atau tingkat kelas.
                </p>

            </div>

        </div>


        {{-- FORM PENCARIAN --}}
        <form
            id="mapelSearchForm"
            action="{{ route('admin.mapel.index') }}"
            method="GET"
            autocomplete="off"
            class="mapel-filter-grid"
        >

            {{-- KATA KUNCI --}}
            <div class="mapel-filter-search">

                <label for="search_mapel" class="mapel-field-label">
                    Kata Kunci
                </label>

                <div class="mapel-search-wrapper">

                    <div class="relative">

                        <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 pointer-events-none"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             viewBox="0 0 24 24"
                             aria-hidden="true">

                            <circle cx="11" cy="11" r="7"/>
                            <path stroke-linecap="round" d="m20 20-4-4"/>

                        </svg>

                        <input
                            id="search_mapel"
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Cari nama mapel atau KKM..."
                            class="mapel-input pl-11"
                            autocomplete="off"
                            autocapitalize="off"
                            spellcheck="false"
                            aria-autocomplete="list"
                            aria-controls="mapelSearchSuggestions"
                        >

                    </div>


                    {{-- DROPDOWN RIWAYAT PENCARIAN --}}
                    <div
                        id="mapelSearchSuggestions"
                        class="mapel-suggestion-box hidden"
                        role="listbox"
                        aria-label="Riwayat pencarian"
                    ></div>

                </div>

            </div>


            {{-- FILTER JURUSAN --}}
            <div>

                <label for="filter_jurusan" class="mapel-field-label">
                    Jurusan
                </label>

                <select
                    id="filter_jurusan"
                    name="jurusan"
                    class="mapel-input"
                >

                    <option value="">Semua Jurusan</option>

                    @foreach($jurusanList as $jurusan)

                        <option
                            value="{{ $jurusan }}"
                            {{ $filterJurusan === $jurusan ? 'selected' : '' }}
                        >
                            {{ $jurusan }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- FILTER TINGKAT --}}
            <div>

                <label for="filter_tingkat" class="mapel-field-label">
                    Tingkat Kelas
                </label>

                <select
                    id="filter_tingkat"
                    name="tingkat"
                    class="mapel-input"
                >

                    <option value="">Semua Tingkat</option>

                    @foreach($tingkatList as $tingkat)

                        <option
                            value="{{ $tingkat }}"
                            {{ $filterTingkat === $tingkat ? 'selected' : '' }}
                        >
                            Kelas {{ $tingkat }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- TOMBOL --}}
            <div class="mapel-filter-actions">

                <button type="submit" class="mapel-btn mapel-btn-search">

                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="11" cy="11" r="7"/>
                        <path stroke-linecap="round" d="m20 20-4-4"/>
                    </svg>

                    Cari

                </button>

                @if($adaFilter)

                    <a
                        href="{{ route('admin.mapel.index') }}"
                        class="mapel-btn mapel-btn-secondary"
                        title="Reset semua filter"
                    >

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12a9 9 0 1 0 3-6.7L3 8"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v5h5"/>
                        </svg>

                        Reset

                    </a>

                @endif

            </div>

        </form>


        {{-- HASIL FILTER --}}
        @if($adaFilter)

            <div class="mapel-filter-summary mt-5 p-3 text-xs leading-relaxed">

                Menampilkan
                <strong>{{ $mapelList->total() }}</strong>
                mata pelajaran

                @if($search !== '')
                    · Kata kunci <strong>{{ $search }}</strong>
                @endif

                @if($filterJurusan !== '')
                    · Jurusan <strong>{{ $filterJurusan }}</strong>
                @endif

                @if($filterTingkat !== '')
                    · Tingkat <strong>{{ $filterTingkat }}</strong>
                @endif

            </div>

        @endif

    </section>


    {{-- TABEL MATA PELAJARAN --}}
    <section class="mapel-table-card mapel-enter mapel-delay-2">

        {{-- HEADER TABEL --}}
        <div class="mapel-table-header flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 px-5 sm:px-6 py-5">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-blue-100 text-blue-700 dark:bg-blue-500/15 dark:text-blue-300">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21V5.5Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 17a2.5 2.5 0 0 1 2.5-2.5H20"/>
                    </svg>

                </div>

                <div>

                    <h2 class="mapel-panel-heading font-extrabold text-sm sm:text-base">
                        Daftar Mata Pelajaran
                    </h2>

                    <p class="mapel-muted text-xs mt-1">
                        Data mapel, jurusan, tingkat, dan KKM.
                    </p>

                </div>

            </div>

            <div class="mapel-table-count">

                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 5h16M4 12h16M4 19h16"/>
                </svg>

                {{ $mapelList->total() }} Mapel

            </div>

        </div>


        {{-- ISI TABEL --}}
        <div class="overflow-x-auto">

            <table class="mapel-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mata Pelajaran</th>
                        <th>Jurusan</th>
                        <th>Tingkat</th>
                        <th>KKM</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($mapelList as $index => $mapel)

                        <tr>

                            {{-- NOMOR --}}
                            <td>
                                <span class="mapel-muted text-xs font-bold">
                                    {{ $mapelList->firstItem() + $index }}
                                </span>
                            </td>


                            {{-- NAMA MAPEL --}}
                            <td>

                                <div class="flex items-center gap-3 min-w-[205px]">

                                    <div class="mapel-subject-icon">

                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21V5.5Z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 17a2.5 2.5 0 0 1 2.5-2.5H20"/>
                                        </svg>

                                    </div>

                                    <div>

                                        <p class="mapel-text text-sm font-extrabold">
                                            {{ $mapel->nama_mapel }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- JURUSAN --}}
                            <td>

                                <div class="mapel-badge-list">

                                    @forelse($mapel->pengaturanKelas->pluck('jurusan')->unique() as $jurusan)

                                        <span class="mapel-badge mapel-badge-blue">
                                            {{ $jurusan }}
                                        </span>

                                    @empty

                                        <span class="mapel-unconfigured">
                                            Belum diatur
                                        </span>

                                    @endforelse

                                </div>

                            </td>


                            {{-- TINGKAT --}}
                            <td>

                                <div class="mapel-badge-list">

                                    @forelse($mapel->pengaturanKelas->pluck('tingkat')->unique()->sort() as $tingkat)

                                        <span class="mapel-badge mapel-badge-blue">
                                            {{ $tingkat }}
                                        </span>

                                    @empty

                                        <span class="mapel-unconfigured">
                                            Belum diatur
                                        </span>

                                    @endforelse

                                </div>

                            </td>


                            {{-- KKM --}}
                            <td>

                                <span class="mapel-kkm">
                                    {{ $mapel->kkm }}
                                </span>

                            </td>


                            {{-- AKSI --}}
                            <td>

                                <div class="flex items-center justify-center gap-2 min-w-[170px]">

                                    <a
                                        href="{{ route('admin.mapel.edit', $mapel->id_mapel) }}"
                                        class="mapel-btn mapel-btn-edit"
                                    >

                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16 4 4 4M4 20l4-.8L19 8a2.1 2.1 0 0 0-3-3L5 16l-1 4Z"/>
                                        </svg>

                                        Edit

                                    </a>


                                    <form
                                        action="{{ route('admin.mapel.destroy', $mapel->id_mapel) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus mata pelajaran ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="mapel-btn mapel-btn-delete">

                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M10 11v6m4-6v6M6 7l1 13h10l1-13M9 7V4h6v3"/>
                                            </svg>

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="mapel-empty">

                                <div class="mapel-empty-icon">

                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21V5.5Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 17a2.5 2.5 0 0 1 2.5-2.5H20"/>
                                    </svg>

                                </div>

                                <h3 class="mapel-text font-extrabold">

                                    @if($adaFilter)
                                        Mata pelajaran tidak ditemukan
                                    @else
                                        Belum ada data mata pelajaran
                                    @endif

                                </h3>

                                <p class="mapel-muted text-sm mt-2 max-w-md mx-auto">

                                    @if($adaFilter)
                                        Coba ubah kata kunci atau pilihan filter untuk menemukan data.
                                    @else
                                        Tambahkan mata pelajaran untuk mulai mengelola data akademik.
                                    @endif

                                </p>

                                @if(!$adaFilter)

                                    <a
                                        href="{{ route('admin.mapel.create') }}"
                                        class="mapel-btn mapel-btn-primary mt-5"
                                    >

                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                        </svg>

                                        Tambah Mapel

                                    </a>

                                @endif

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>


    {{-- PAGINATION: SEBELUMNYA DAN SELANJUTNYA --}}
    @if($mapelList->hasPages())

        <section class="mapel-table-card">

            <nav
                class="mapel-pagination"
                aria-label="Navigasi halaman mata pelajaran"
            >

                {{-- SEBELUMNYA --}}
                @if($mapelList->onFirstPage())

                    <span class="mapel-page-link mapel-page-link-disabled">
                        ← Sebelumnya
                    </span>

                @else

                    <a
                        href="{{ request()->fullUrlWithQuery([
                            'page' => $mapelList->currentPage() - 1
                        ]) }}"
                        class="mapel-page-link"
                    >
                        ← Sebelumnya
                    </a>

                @endif


                {{-- SELANJUTNYA --}}
                @if($mapelList->hasMorePages())

                    <a
                        href="{{ request()->fullUrlWithQuery([
                            'page' => $mapelList->currentPage() + 1
                        ]) }}"
                        class="mapel-page-link"
                    >
                        Selanjutnya →
                    </a>

                @else

                    <span class="mapel-page-link mapel-page-link-disabled">
                        Selanjutnya →
                    </span>

                @endif

            </nav>

        </section>

    @endif


    {{-- FOOTER --}}
    <footer class="text-center pt-2 pb-3">

        <div class="mapel-footer-line"></div>

        <p class="mapel-muted text-xs font-semibold">
            Sistem Akademik Mini
        </p>

        <p class="mapel-muted text-xs mt-1">
            Data mata pelajaran dan pengaturan kelas.
        </p>

    </footer>

</div>

@endsection


{{-- JAVASCRIPT RIWAYAT PENCARIAN --}}

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('search_mapel');
    const dropdown = document.getElementById('mapelSearchSuggestions');
    const wrapper = input?.closest('.mapel-search-wrapper');
    const form = document.getElementById('mapelSearchForm');

    if (!input || !dropdown || !wrapper || !form) {
        return;
    }

    const STORAGE_KEY = 'eduvia_mapel_search_history';
    const MAX_HISTORY = 6;

    /*
     * Mengambil riwayat pencarian dari browser.
     */
    function getHistory() {
        try {
            const history = JSON.parse(
                localStorage.getItem(STORAGE_KEY) || '[]'
            );

            return Array.isArray(history)
                ? history.filter(item => typeof item === 'string')
                : [];

        } catch (error) {
            return [];
        }
    }

    /*
     * Menyimpan riwayat pencarian.
     */
    function saveHistory(keyword) {
        const history = getHistory().filter(function (item) {
            return item.toLowerCase() !== keyword.toLowerCase();
        });

        history.unshift(keyword);

        try {
            localStorage.setItem(
                STORAGE_KEY,
                JSON.stringify(history.slice(0, MAX_HISTORY))
            );
        } catch (error) {
            // Pencarian tetap berjalan apabila penyimpanan browser gagal.
        }
    }

    /*
     * Menutup dropdown.
     */
    function hideSuggestions() {
        dropdown.classList.add('hidden');
        dropdown.replaceChildren();
    }

    /*
     * Membuat ikon jam.
     */
    function createHistoryIcon() {

        const svg = document.createElementNS(
            'http://www.w3.org/2000/svg',
            'svg'
        );

        svg.setAttribute('fill', 'none');
        svg.setAttribute('stroke', 'currentColor');
        svg.setAttribute('stroke-width', '1.8');
        svg.setAttribute('viewBox', '0 0 24 24');
        svg.setAttribute('aria-hidden', 'true');

        const circle = document.createElementNS(
            'http://www.w3.org/2000/svg',
            'circle'
        );

        circle.setAttribute('cx', '12');
        circle.setAttribute('cy', '12');
        circle.setAttribute('r', '9');

        const path = document.createElementNS(
            'http://www.w3.org/2000/svg',
            'path'
        );

        path.setAttribute('stroke-linecap', 'round');
        path.setAttribute('stroke-linejoin', 'round');
        path.setAttribute('d', 'M12 7v5l3 2');

        svg.appendChild(circle);
        svg.appendChild(path);

        return svg;
    }

    /*
     * Menampilkan riwayat pencarian.
     * Tidak ada tombol hapus riwayat.
     */
    function renderSuggestions() {

        const keyword = input.value.trim().toLowerCase();
        const history = getHistory();

        const filtered = history
            .filter(function (item) {
                return item.toLowerCase().includes(keyword);
            })
            .slice(0, MAX_HISTORY);

        dropdown.replaceChildren();

        if (filtered.length === 0) {
            hideSuggestions();
            return;
        }

        /*
         * Judul dropdown.
         */
        const heading = document.createElement('div');

        heading.className = 'mapel-suggestion-heading';

        heading.textContent = keyword
            ? 'Riwayat pencarian'
            : 'Pencarian sebelumnya';

        dropdown.appendChild(heading);

        /*
         * Daftar riwayat.
         */
        filtered.forEach(function (item) {

            const button = document.createElement('button');

            button.type = 'button';
            button.className = 'mapel-suggestion-item';
            button.setAttribute('role', 'option');

            const icon = createHistoryIcon();

            const text = document.createElement('span');
            text.textContent = item;

            button.appendChild(icon);
            button.appendChild(text);

            /*
             * Mencegah input kehilangan fokus sebelum item dipilih.
             */
            button.addEventListener('mousedown', function (event) {
                event.preventDefault();
            });

            /*
             * Memasukkan riwayat ke kolom pencarian.
             */
            button.addEventListener('click', function () {

                input.value = item;

                hideSuggestions();

                input.focus();
            });

            dropdown.appendChild(button);

        });

        dropdown.classList.remove('hidden');
    }

    /*
     * Saat input difokuskan.
     */
    input.addEventListener('focus', renderSuggestions);

    /*
     * Saat pengguna mengetik.
     */
    input.addEventListener('input', renderSuggestions);

    /*
     * Tombol Escape menutup dropdown.
     */
    input.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {
            hideSuggestions();
        }

    });

    /*
     * Klik di luar kotak pencarian menutup dropdown.
     */
    document.addEventListener('click', function (event) {

        if (!wrapper.contains(event.target)) {
            hideSuggestions();
        }

    });

    /*
     * Simpan kata kunci saat form dikirim.
     */
    form.addEventListener('submit', function () {

        const keyword = input.value.trim();

        if (keyword.length > 0) {
            saveHistory(keyword);
        }

    });

});
</script>
@endpush