@extends('layouts.admin')

@section('title', 'Data Kelas - Sistem Akademik Mini')
@section('page-title', 'Data Kelas')
@section('page-subtitle', 'Kelola daftar kelas dan wali kelas.')

@push('styles')
<style>
/* =====================================================
   EDUVIA - DATA KELAS
   Pastel Blue + Dark Navy
===================================================== */

.kelas-page {
    --kp-blue: #3478BD;
    --kp-blue-dark: #285F96;
    --kp-text: #293F57;
    --kp-muted: #526982;
    --kp-border: #D5E1ED;

    color: var(--kp-text);
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.kelas-page *,
.kelas-page *::before,
.kelas-page *::after {
    box-sizing: border-box;
}

/* ANIMASI */

.kp-enter {
    animation: kpEnter .35s ease-out both;
}

.kp-delay {
    animation-delay: .08s;
}

@keyframes kpEnter {
    from {
        opacity: 0;
        transform: translateY(7px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes kpRowEnter {
    from {
        opacity: 0;
        transform: translateY(4px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* HEADER */

.kp-hero {
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

.kp-hero-icon,
.kp-section-icon,
.kp-class-icon,
.kp-empty-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border: 1px solid #C3D8EB;
    background: #E3F0FA;
    color: #3478BD;
}

.kp-hero-icon {
    width: 58px;
    height: 58px;
    border: 1px solid #FFFFFF;
    border-radius: 15px;
    background: #FFFFFF;
}

.kp-hero-icon svg {
    width: 27px;
    height: 27px;
}

.kp-section-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
}

.kp-section-icon svg {
    width: 20px;
    height: 20px;
}

.kp-class-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
}

.kp-class-icon svg {
    width: 21px;
    height: 21px;
}

.kp-hero-label {
    color: #285F96;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.kp-hero-title {
    color: #214A77;
}

.kp-hero-description {
    color: #4D6886;
}

/* TOMBOL */

.kp-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 42px;
    padding: 10px 15px;
    border: 1px solid transparent;
    border-radius: 9px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 800;
    line-height: 1.4;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition:
        transform .18s ease,
        box-shadow .18s ease,
        background .18s ease,
        border-color .18s ease;
}

.kp-button svg {
    width: 17px;
    height: 17px;
    flex-shrink: 0;
}

.kp-button:hover {
    transform: translateY(-1px);
}

.kp-button-primary {
    border-color: #3478BD;
    background: #3478BD;
    color: #FFFFFF;
    box-shadow: 0 3px 8px rgba(52, 120, 189, .12);
}

.kp-button-primary:hover {
    border-color: #285F96;
    background: #285F96;
    color: #FFFFFF;
}

.kp-button:focus-visible,
.kp-search-button:focus-visible,
.kp-reset-button:focus-visible,
.kp-action:focus-visible {
    outline: 3px solid rgba(52, 120, 189, .3);
    outline-offset: 3px;
}

/* NOTIFIKASI */

.kp-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 15px 17px;
    border-radius: 11px;
    font-size: 13px;
    font-weight: 600;
    line-height: 1.7;
    animation: kpEnter .35s ease both;
}

.kp-alert-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    flex-shrink: 0;
    border: 1px solid currentColor;
    border-radius: 9px;
    background: rgba(255, 255, 255, .8);
    font-size: 17px;
    font-weight: 900;
}

/* PANEL PENCARIAN */

.kp-panel {
    position: relative;
    z-index: 5;
    overflow: visible;
    border: 1px solid #D5E1ED;
    border-radius: 15px;
    background: #F2F7FC;
    box-shadow: 0 4px 12px rgba(45, 82, 124, .045);
}

.kp-panel-body {
    padding: 20px;
}

.kp-panel-title {
    color: #294B70;
    font-size: 14px;
    font-weight: 800;
    line-height: 1.5;
}

.kp-panel-description {
    margin-top: 4px;
    color: #667D95;
    font-size: 11px;
    line-height: 1.7;
}

/* INPUT PENCARIAN */

.kp-search-wrapper {
    position: relative;
    min-width: 0;
    flex: 1;
}

.kp-search-input {
    display: block;
    width: 100%;
    min-height: 44px;
    padding: 10px 13px 10px 41px;
    border: 1px solid #C9D9E9;
    border-radius: 9px;
    background: #FFFFFF;
    color: #26374A;
    font-family: inherit;
    font-size: 13px;
    font-weight: 500;
    outline: none;
    transition:
        border-color .2s ease,
        background .2s ease,
        box-shadow .2s ease;
}

.kp-search-input::placeholder {
    color: #8495A8;
    font-weight: 500;
}

.kp-search-input:focus {
    border-color: #438BD0;
    background: #FFFFFF;
    box-shadow: 0 0 0 3px rgba(67, 139, 208, .16);
}

.kp-search-icon {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 13px;
    display: flex;
    align-items: center;
    color: #849AB0;
    pointer-events: none;
}

.kp-search-icon svg {
    width: 17px;
    height: 17px;
}

.kp-search-button,
.kp-reset-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    min-height: 44px;
    padding: 10px 16px;
    border-radius: 9px;
    font-family: inherit;
    font-size: 12px;
    font-weight: 800;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition:
        transform .18s ease,
        background .18s ease;
}

.kp-search-button svg,
.kp-reset-button svg {
    width: 16px;
    height: 16px;
}

.kp-search-button {
    border: 1px solid #3478BD;
    background: #3478BD;
    color: #FFFFFF;
}

.kp-search-button:hover {
    transform: translateY(-1px);
    background: #285F96;
}

.kp-reset-button {
    border: 1px solid #C8DCEE;
    background: #FFFFFF;
    color: #365773;
}

.kp-reset-button:hover {
    background: #E3F0FA;
}

/* RIWAYAT PENCARIAN */

.kp-suggestion-box {
    position: absolute;
    top: calc(100% + 7px);
    left: 0;
    right: 0;
    z-index: 90;
    overflow: hidden;
    max-height: 260px;
    overflow-y: auto;
    border: 1px solid #D5E1ED;
    border-radius: 10px;
    background: #FFFFFF;
    box-shadow: 0 8px 20px rgba(39, 77, 119, .12);
    animation: kpSuggestionEnter .16s ease-out;
}

.kp-suggestion-box[hidden] {
    display: none !important;
}

@keyframes kpSuggestionEnter {
    from {
        opacity: 0;
        transform: translateY(-4px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.kp-suggestion-heading {
    position: sticky;
    top: 0;
    z-index: 1;
    padding: 10px 13px;
    border-bottom: 1px solid #E5EDF5;
    background: #F8FAFC;
    color: #71849A;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .07em;
    text-transform: uppercase;
}

.kp-suggestion-item {
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
    padding: 11px 13px;
    border: 0;
    background: #FFFFFF;
    color: #30445B;
    font-family: inherit;
    font-size: 12px;
    font-weight: 600;
    text-align: left;
    cursor: pointer;
    transition: background .18s ease;
}

.kp-suggestion-item + .kp-suggestion-item {
    border-top: 1px solid #EDF1F6;
}

.kp-suggestion-item:hover,
.kp-suggestion-item:focus-visible {
    outline: none;
    background: #EAF3FC;
    color: #285F96;
}

.kp-suggestion-item svg {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
    color: #89AAD7;
}

/* TABEL */

.kp-table-shell {
    overflow: hidden;
    border: 1px solid #D5E1ED;
    border-radius: 15px;
    background: #FFFFFF;
    box-shadow: 0 4px 12px rgba(45, 82, 124, .045);
}

.kp-table-header {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 13px;
    padding: 18px 20px;
    border-bottom: 1px solid #D5E1ED;
    background: #F5F9FE;
}

.kp-total {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 11px;
    border: 1px solid #C8DFF7;
    border-radius: 8px;
    background: #EAF4FF;
    color: #2C6399;
    font-size: 11px;
    font-weight: 800;
    white-space: nowrap;
}

.kp-total svg {
    width: 15px;
    height: 15px;
}

.kp-table {
    width: 100%;
    min-width: 850px;
    border-collapse: separate;
    border-spacing: 0;
    text-align: left;
}

.kp-table thead th {
    padding: 13px 16px;
    border-right: 1px solid #D7E5F3;
    border-bottom: 1px solid #CFDEED;
    background: #EAF4FF;
    color: #2E5278;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .05em;
    text-transform: uppercase;
    white-space: nowrap;
}

.kp-table thead th:last-child,
.kp-table tbody td:last-child {
    border-right: 0;
}

.kp-table tbody td {
    padding: 14px 16px;
    border-right: 1px solid #E0E9F3;
    border-bottom: 1px solid #E0E9F3;
    color: #405268;
    vertical-align: middle;
    font-size: 12px;
    line-height: 1.7;
}

.kp-table tbody tr:last-child td {
    border-bottom: 0;
}

.kp-table tbody tr {
    animation: kpRowEnter .3s ease both;
    transition: background .18s ease;
}

.kp-table tbody tr:nth-child(even) {
    background: #F9FBFE;
}

.kp-table tbody tr:hover {
    background: #EDF6FF;
}

/* NOMOR */

.kp-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 29px;
    height: 29px;
    padding: 0 7px;
    border: 1px solid #D5E5F6;
    border-radius: 8px;
    background: #EEF6FF;
    color: #356DA5;
    font-size: 11px;
    font-weight: 800;
}

/* NAMA KELAS */

.kp-class-name {
    color: #283F58;
    font-size: 12px;
    font-weight: 800;
    line-height: 1.6;
}

/* TINGKAT */

.kp-level-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 9px;
    border: 1px solid #C8DFF7;
    border-radius: 8px;
    background: #EDF6FF;
    color: #2C6399;
    font-size: 10px;
    font-weight: 800;
    white-space: nowrap;
}

.kp-major-text {
    color: #344F6B;
    font-size: 11px;
    font-weight: 700;
}

/* WALI KELAS */

.kp-wali-wrap {
    display: flex;
    align-items: center;
    gap: 9px;
    min-width: 160px;
}

.kp-wali-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 33px;
    height: 33px;
    flex-shrink: 0;
    border: 1px solid #D8E5F2;
    border-radius: 9px;
    background: #F0F5FB;
    color: #5C7590;
}

.kp-wali-icon svg {
    width: 16px;
    height: 16px;
}

.kp-wali-name {
    color: #344F6B;
    font-size: 11px;
    font-weight: 700;
    line-height: 1.6;
    overflow-wrap: anywhere;
}

.kp-empty-wali {
    display: inline-flex;
    align-items: center;
    padding: 6px 9px;
    border: 1px dashed #D5DEEA;
    border-radius: 8px;
    background: #F7F9FC;
    color: #75869A;
    font-size: 10px;
    font-weight: 700;
}

/* AKSI */

.kp-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    min-width: 160px;
}

.kp-actions form {
    margin: 0;
}

.kp-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    min-height: 34px;
    padding: 7px 10px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-family: inherit;
    font-size: 10px;
    font-weight: 800;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition:
        transform .18s ease,
        background .18s ease,
        border-color .18s ease,
        color .18s ease;
}

.kp-action svg {
    width: 15px;
    height: 15px;
    flex-shrink: 0;
}

.kp-action:hover {
    transform: translateY(-1px);
}

.kp-action-edit {
    border-color: #C8DFF7;
    background: #EDF6FF;
    color: #2C6399;
}

.kp-action-edit:hover {
    background: #DBEEFF;
}

.kp-action-delete {
    border-color: #F1D1D5;
    background: #FFF0F1;
    color: #A93649;
}

.kp-action-delete:hover {
    color: #FFFFFF;
    background: #C9475D;
    border-color: #C9475D;
}

.kp-action-delete svg {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
}

/* DATA KOSONG */

.kp-empty {
    padding: 50px 20px !important;
    text-align: center;
}

.kp-empty-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 14px;
    border-radius: 13px;
}

.kp-empty-icon svg {
    width: 27px;
    height: 27px;
}

.kp-empty-title {
    color: #344F6B;
    font-size: 14px;
    font-weight: 800;
}

.kp-empty-description {
    margin-top: 5px;
    color: #8192A5;
    font-size: 11px;
    line-height: 1.7;
}

/* PAGINATION */

.kp-pagination {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 20px;
    border-top: 1px solid #D5E1ED;
    background: #FFFFFF;
}

.kp-page-link {
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

.kp-page-link:hover {
    border-color: #A4BFDF;
    background: #EAF4FF;
}

.kp-page-link-disabled {
    border-color: #E0E7EF;
    background: #F4F7FA;
    color: #9AA9B9;
    cursor: not-allowed;
}

/* FOOTER */

.kp-footer-line {
    width: 42px;
    height: 3px;
    margin: 0 auto 12px;
    border-radius: 20px;
    background: #89AAD7;
}

.kp-footer {
    color: #73869B;
    font-size: 11px;
    font-weight: 600;
    text-align: center;
}

/* =====================================================
   DARK MODE
===================================================== */

.dark .kelas-page {
    --kp-text: #E4ECF6;
    --kp-muted: #AABBD0;
    --kp-border: #354A62;
    color: var(--kp-text);
}

.dark .kp-hero {
    border-color: #3B5878;
    background: linear-gradient(
        115deg,
        #17283D 0%,
        #1C3049 55%,
        #243E59 100%
    );
    box-shadow: 0 4px 12px rgba(0, 0, 0, .14);
}

.dark .kp-hero-label {
    color: #C6E1FF;
}

.dark .kp-hero-title {
    color: #F1F6FC;
}

.dark .kp-hero-description {
    color: #C2D0E0;
}

.dark .kp-hero-icon,
.dark .kp-section-icon,
.dark .kp-class-icon,
.dark .kp-empty-icon {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

.dark .kp-button-primary {
    border-color: #557FAF;
    background: #3478BD;
}

.dark .kp-button-primary:hover {
    background: #285F96;
}

.dark .kp-panel {
    border-color: #354962;
    background: #1C2C42;
    box-shadow: none;
}

.dark .kp-panel-title {
    color: #EAF3FF;
}

.dark .kp-panel-description {
    color: #AABBD0;
}

.dark .kp-search-input {
    border-color: #40536B;
    background: #111C2E;
    color: #E8F0FB;
}

.dark .kp-search-input::placeholder {
    color: #93A6BD;
}

.dark .kp-search-input:focus {
    border-color: #5799DC;
    background: #152337;
    box-shadow: 0 0 0 3px rgba(87, 153, 220, .17);
}

.dark .kp-search-icon {
    color: #AABBD0;
}

.dark .kp-reset-button {
    border-color: #435873;
    background: #24364D;
    color: #D5E5F8;
}

.dark .kp-reset-button:hover {
    background: #2F4865;
}

/* DARK MODE RIWAYAT */

.dark .kp-suggestion-box {
    border-color: #354A62;
    background: #192438;
    box-shadow: 0 8px 20px rgba(0, 0, 0, .25);
}

.dark .kp-suggestion-heading {
    border-color: #354A62;
    background: #203149;
    color: #AFC0D4;
}

.dark .kp-suggestion-item {
    border-color: #34465F;
    background: #192438;
    color: #E1EAF5;
}

.dark .kp-suggestion-item:hover,
.dark .kp-suggestion-item:focus-visible {
    background: #263E59;
    color: #FFFFFF;
}

.dark .kp-suggestion-item svg {
    color: #AFCBEA;
}

/* DARK MODE TABEL */

.dark .kp-table-shell {
    border-color: #354962;
    background: #192438;
    box-shadow: none;
}

.dark .kp-table-header {
    border-color: #354962;
    background: #1C2C42;
}

.dark .kp-total {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

.dark .kp-table thead th {
    border-color: #3A5068;
    background: #263E59;
    color: #D5E5F8;
}

.dark .kp-table tbody td {
    border-color: #354962;
    color: #C7D4E4;
}

.dark .kp-table tbody tr:nth-child(even) {
    background: #1C2C42;
}

.dark .kp-table tbody tr:hover {
    background: #263E59;
}

.dark .kp-number,
.dark .kp-level-badge {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

.dark .kp-class-name,
.dark .kp-major-text,
.dark .kp-wali-name {
    color: #EAF3FF;
}

.dark .kp-wali-icon {
    border-color: #40536B;
    background: #26384D;
    color: #BDD4EB;
}

.dark .kp-empty-wali {
    border-color: #405168;
    background: #263549;
    color: #C3D0DF;
}

.dark .kp-action-edit {
    border-color: #3A5D80;
    background: #203B55;
    color: #B9DCFF;
}

.dark .kp-action-edit:hover {
    background: #294A69;
}

.dark .kp-action-delete {
    color: #FFC5CD;
    background: #432A35;
    border-color: #65404B;
}

.dark .kp-action-delete:hover {
    color: #FFFFFF;
    background: #B83B52;
    border-color: #B83B52;
}

.dark .kp-empty-title {
    color: #E4EFFC;
}

.dark .kp-empty-description,
.dark .kp-footer {
    color: #AABBD0;
}

/* DARK MODE PAGINATION */

.dark .kp-pagination {
    border-color: #354962;
    background: #192438;
}

.dark .kp-page-link {
    border-color: #405773;
    background: #24364D;
    color: #D5E5F8;
}

.dark .kp-page-link:hover {
    border-color: #58799F;
    background: #2F4865;
}

.dark .kp-page-link-disabled {
    border-color: #35465D;
    background: #1D2B3E;
    color: #71849A;
}

/* RESPONSIVE */

@media (max-width: 640px) {
    .kp-hero {
        border-radius: 14px;
    }

    .kp-hero-icon {
        width: 47px;
        height: 47px;
        border-radius: 11px;
    }

    .kp-hero-icon svg {
        width: 23px;
        height: 23px;
    }

    .kp-panel-body {
        padding: 16px;
    }

    .kp-table-header {
        padding: 16px;
    }

    .kp-button,
    .kp-search-button,
    .kp-reset-button {
        width: 100%;
    }

    .kp-search-wrapper {
        width: 100%;
    }

    .kp-pagination {
        justify-content: center;
        gap: 8px;
        padding: 16px;
    }

    .kp-page-link {
        padding: 8px 11px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .kelas-page *,
    .kelas-page *::before,
    .kelas-page *::after {
        animation: none !important;
        transition: none !important;
    }
}
</style>
@endpush


@section('content')

<div class="kelas-page space-y-6">

    {{-- HEADER UTAMA --}}
    <section class="kp-hero kp-enter">

        <div class="flex flex-col gap-5 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-7">

            <div class="flex min-w-0 items-center gap-4">

                <div class="kp-hero-icon">

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M3 21h18"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M9 7h1m4 0h1M9 11h1m4 0h1M9 15h1m4 0h1"/>

                    </svg>

                </div>

                <div class="min-w-0">

                    <p class="kp-hero-label mb-1">
                        Data Master
                    </p>

                    <h2 class="kp-hero-title text-xl font-extrabold sm:text-2xl">
                        Data Kelas
                    </h2>

                    <p class="kp-hero-description mt-2 text-sm leading-relaxed">
                        Kelola daftar kelas, tingkat, jurusan, dan wali kelas
                        dalam satu halaman.
                    </p>

                </div>

            </div>

            <a href="{{ route('admin.kelas.create') }}"
               class="kp-button kp-button-primary flex-shrink-0">

                <svg fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     viewBox="0 0 24 24"
                     aria-hidden="true">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 5v14M5 12h14"/>

                </svg>

                Tambah Kelas

            </a>

        </div>

    </section>


    {{-- NOTIFIKASI SUKSES --}}
    @if(session('success'))

        <div
            class="kp-alert border border-emerald-200 bg-emerald-50 text-emerald-800 dark:border-emerald-500/30 dark:bg-emerald-500/10 dark:text-emerald-300"
            role="status"
        >

            <div class="kp-alert-icon text-emerald-700 dark:text-emerald-300">
                ✓
            </div>

            <div class="min-w-0 flex-1">

                <p class="font-extrabold">
                    Berhasil
                </p>

                <p class="mt-1">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- NOTIFIKASI ERROR SESSION --}}
    @if(session('error'))

        <div
            class="kp-alert border border-red-200 bg-red-50 text-red-800 dark:border-red-500/30 dark:bg-red-500/10 dark:text-red-300"
            role="alert"
        >

            <div class="kp-alert-icon text-red-700 dark:text-red-300">
                !
            </div>

            <div class="min-w-0 flex-1">

                <p class="font-extrabold">
                    Tidak Dapat Diproses
                </p>

                <p class="mt-1">
                    {{ session('error') }}
                </p>

            </div>

        </div>

    @endif


    {{-- NOTIFIKASI VALIDASI --}}
    @if($errors->any())

        <div
            class="kp-alert border border-red-200 bg-red-50 text-red-800 dark:border-red-500/30 dark:bg-red-500/10 dark:text-red-300"
            role="alert"
        >

            <div class="kp-alert-icon text-red-700 dark:text-red-300">
                !
            </div>

            <div class="min-w-0 flex-1">

                <p class="mb-2 font-extrabold">
                    Terjadi Kesalahan
                </p>

                <ul class="space-y-1">

                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    {{-- PENCARIAN --}}
    <section class="kp-panel kp-enter kp-delay">

        <div class="kp-panel-body">

            <div class="mb-4 flex items-center gap-3">

                <div class="kp-section-icon">

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <circle cx="10.5" cy="10.5" r="6.5"/>
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="m16 16 5 5"/>

                    </svg>

                </div>

                <div>

                    <h3 class="kp-panel-title">
                        Cari Data Kelas
                    </h3>

                    <p class="kp-panel-description">
                        Cari berdasarkan nama kelas, tingkat, jurusan, atau wali kelas.
                    </p>

                </div>

            </div>


            <form
                id="kelasSearchForm"
                action="{{ route('admin.kelas.index') }}"
                method="GET"
                autocomplete="off"
                class="flex flex-col gap-3 sm:flex-row"
            >

                <div class="kp-search-wrapper">

                    <span class="kp-search-icon">

                        <svg fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             viewBox="0 0 24 24"
                             aria-hidden="true">

                            <circle cx="10.5" cy="10.5" r="6.5"/>
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="m16 16 5 5"/>

                        </svg>

                    </span>

                    <label for="searchKelas" class="sr-only">
                        Cari kelas
                    </label>

                    <input
                        id="searchKelas"
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari nama kelas, tingkat, jurusan, atau wali kelas..."
                        class="kp-search-input"
                        autocomplete="off"
                        spellcheck="false"
                    >

                    {{-- DROPDOWN RIWAYAT --}}
                    <div
                        id="kelasSearchSuggestions"
                        class="kp-suggestion-box"
                        role="listbox"
                        aria-label="Riwayat pencarian kelas"
                        hidden
                    ></div>

                </div>


                <button type="submit" class="kp-search-button">

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <circle cx="10.5" cy="10.5" r="6.5"/>
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="m16 16 5 5"/>

                    </svg>

                    Cari

                </button>


                @if($search !== '')

                    <a href="{{ route('admin.kelas.index') }}"
                       class="kp-reset-button">

                        <svg fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             viewBox="0 0 24 24"
                             aria-hidden="true">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M4 4v5h5"/>

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M5.5 9A7 7 0 0 1 18 6.5"/>

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M20 20v-5h-5"/>

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M18.5 15A7 7 0 0 1 6 17.5"/>

                        </svg>

                        Reset

                    </a>

                @endif

            </form>

        </div>

    </section>


    {{-- TABEL DATA KELAS --}}
    <section class="kp-table-shell kp-enter">

        {{-- HEADER TABEL --}}
        <div class="kp-table-header">

            <div class="flex items-center gap-3">

                <div class="kp-section-icon">

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M3 21h18"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M9 7h1m4 0h1M9 11h1m4 0h1"/>

                    </svg>

                </div>

                <div>

                    <h3 class="kp-panel-title">
                        Daftar Kelas
                    </h3>

                    <p class="kp-panel-description">
                        Data kelas yang tersedia di sistem.
                    </p>

                </div>

            </div>


            <div class="kp-total">

                <svg fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24"
                     aria-hidden="true">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M3 21h18M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"/>

                </svg>

                {{ $kelasList->total() }} Kelas

            </div>

        </div>


        {{-- ISI TABEL --}}
        <div class="overflow-x-auto">

            <table class="kp-table">

                <thead>

                    <tr>

                        <th>No.</th>
                        <th>Nama Kelas</th>
                        <th>Tingkat</th>
                        <th>Jurusan</th>
                        <th>Wali Kelas</th>
                        <th class="text-center">Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($kelasList as $index => $kelas)

                        <tr>

                            {{-- NOMOR --}}
                            <td>

                                <span class="kp-number">
                                    {{ $kelasList->firstItem() + $index }}
                                </span>

                            </td>


                            {{-- NAMA KELAS --}}
                            <td>

                                <div class="flex items-center gap-3">

                                    <div class="kp-class-icon">

                                        <svg fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             viewBox="0 0 24 24"
                                             aria-hidden="true">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M3 21h18M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"/>

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M9 7h1m4 0h1M9 11h1m4 0h1M9 15h1m4 0h1"/>

                                        </svg>

                                    </div>

                                    <div class="min-w-0">

                                        <p class="kp-class-name">
                                            {{ $kelas->nama_kelas }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- TINGKAT --}}
                            <td>

                                <span class="kp-level-badge">
                                    Tingkat {{ $kelas->tingkat }}
                                </span>

                            </td>


                            {{-- JURUSAN --}}
                            <td>

                                <span class="kp-major-text">
                                    {{ $kelas->jurusan ?? '-' }}
                                </span>

                            </td>


                            {{-- WALI KELAS --}}
                            <td>

                                @if($kelas->wali_kelas)

                                    <div class="kp-wali-wrap">

                                        <div class="kp-wali-icon">

                                            <svg fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="1.8"
                                                 viewBox="0 0 24 24"
                                                 aria-hidden="true">

                                                <circle cx="12" cy="8" r="4"/>

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M5 21v-2a7 7 0 0 1 14 0v2"/>

                                            </svg>

                                        </div>

                                        <span class="kp-wali-name">
                                            {{ $kelas->wali_kelas }}
                                        </span>

                                    </div>

                                @else

                                    <span class="kp-empty-wali">
                                        Belum ditentukan
                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td>

                                <div class="kp-actions">

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('admin.kelas.edit', $kelas->id) }}"
                                        class="kp-action kp-action-edit"
                                    >

                                        <svg fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8"
                                             viewBox="0 0 24 24"
                                             aria-hidden="true">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="m15.232 5.232 3.536 3.536"/>

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M4 20h4L18.768 9.232a2.5 2.5 0 0 0-3.536-3.536L4 16v4Z"/>

                                        </svg>

                                        Edit

                                    </a>


                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('admin.kelas.destroy', $kelas->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus kelas ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="kp-action kp-action-delete"
                                        >

                                            <svg
                                                width="16"
                                                height="16"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                viewBox="0 0 24 24"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M4 7h16M10 11v6m4-6v6M6 7l1 13h10l1-13M9 7V4h6v3"
                                                />
                                            </svg>

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="kp-empty">

                                <div class="kp-empty-icon">

                                    <svg fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         viewBox="0 0 24 24"
                                         aria-hidden="true">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M3 21h18M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"/>

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M9 7h1m4 0h1M9 11h1m4 0h1"/>

                                    </svg>

                                </div>


                                <h3 class="kp-empty-title">

                                    @if($search !== '')
                                        Kelas Tidak Ditemukan
                                    @else
                                        Belum Ada Data Kelas
                                    @endif

                                </h3>


                                <p class="kp-empty-description">

                                    @if($search !== '')
                                        Coba gunakan kata kunci pencarian yang lain.
                                    @else
                                        Tambahkan kelas untuk mulai mengelola data.
                                    @endif

                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>


    {{-- PAGINATION DATA KELAS --}}
    @if($kelasList->hasPages())

        <section class="kp-table-shell">

            <nav
                class="kp-pagination"
                aria-label="Navigasi halaman data kelas"
            >

                {{-- SEBELUMNYA --}}
                @if($kelasList->onFirstPage())

                    <span class="kp-page-link kp-page-link-disabled">
                        ← Sebelumnya
                    </span>

                @else

                    <a
                        href="{{ request()->fullUrlWithQuery([
                            'page' => $kelasList->currentPage() - 1
                        ]) }}"
                        class="kp-page-link"
                    >
                        ← Sebelumnya
                    </a>

                @endif


                {{-- SELANJUTNYA --}}
                @if($kelasList->hasMorePages())

                    <a
                        href="{{ request()->fullUrlWithQuery([
                            'page' => $kelasList->currentPage() + 1
                        ]) }}"
                        class="kp-page-link"
                    >
                        Selanjutnya →
                    </a>

                @else

                    <span class="kp-page-link kp-page-link-disabled">
                        Selanjutnya →
                    </span>

                @endif

            </nav>

        </section>

    @endif


    {{-- FOOTER --}}
    <footer class="text-center pt-2 pb-3">

        <div class="kp-footer-line"></div>

        <p class="kp-footer">
            © {{ date('Y') }} Sistem Akademik Mini
        </p>

    </footer>

</div>

@endsection


{{-- =====================================================
     JAVASCRIPT RIWAYAT PENCARIAN KELAS
===================================================== --}}

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('kelasSearchForm');
    const input = document.getElementById('searchKelas');
    const dropdown = document.getElementById('kelasSearchSuggestions');

    if (!form || !input || !dropdown) {
        return;
    }

    const STORAGE_KEY = 'eduvia_kelas_search_history';
    const MAX_HISTORY = 6;


    /*
     * Ambil riwayat pencarian.
     */
    function getHistory() {

        try {

            const history = JSON.parse(
                localStorage.getItem(STORAGE_KEY) || '[]'
            );

            if (!Array.isArray(history)) {
                return [];
            }

            return history
                .filter(item => typeof item === 'string')
                .filter(item => item.trim() !== '');

        } catch (error) {

            return [];

        }

    }


    /*
     * Simpan riwayat pencarian baru.
     * Maksimal 6 riwayat.
     */
    function saveHistory(value) {

        const keyword = value.trim();

        if (!keyword) {
            return;
        }

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

            // Pencarian tetap bisa digunakan jika localStorage tidak tersedia.

        }

    }


    /*
     * Ikon riwayat.
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
     * Tutup dropdown.
     */
    function hideSuggestions() {

        dropdown.hidden = true;
        dropdown.replaceChildren();

    }


    /*
     * Tampilkan dropdown riwayat.
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


        const heading = document.createElement('div');

        heading.className = 'kp-suggestion-heading';

        heading.textContent = keyword
            ? 'Riwayat yang cocok'
            : 'Riwayat pencarian sebelumnya';

        dropdown.appendChild(heading);


        filtered.forEach(function (item) {

            const button = document.createElement('button');

            button.type = 'button';
            button.className = 'kp-suggestion-item';
            button.setAttribute('role', 'option');

            const icon = createHistoryIcon();

            const text = document.createElement('span');

            text.textContent = item;

            button.appendChild(icon);
            button.appendChild(text);

            button.addEventListener('mousedown', function (event) {
                event.preventDefault();
            });

            button.addEventListener('click', function () {

                input.value = item;

                hideSuggestions();

                form.requestSubmit();

            });

            dropdown.appendChild(button);

        });

        dropdown.hidden = false;

    }


    /*
     * Tampilkan riwayat ketika input aktif.
     */
    input.addEventListener('focus', renderSuggestions);

    input.addEventListener('input', renderSuggestions);


    /*
     * Tutup dropdown menggunakan tombol Escape.
     */
    input.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {
            hideSuggestions();
        }

    });


    /*
     * Simpan pencarian ketika form dikirim.
     */
    form.addEventListener('submit', function () {

        saveHistory(input.value);

    });


    /*
     * Klik di luar area pencarian akan menutup dropdown.
     */
    document.addEventListener('click', function (event) {

        if (!form.contains(event.target)) {
            hideSuggestions();
        }

    });

});
</script>
@endpush