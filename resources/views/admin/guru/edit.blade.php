@extends('layouts.admin')

@section('title', 'Edit Data Guru - Sistem Akademik Mini')
@section('page-title', 'Edit Data Guru')
@section('page-subtitle', 'Perbarui identitas dan penugasan guru')

@push('styles')
<style>
/* =====================================================
   EDUVIA - EDIT DATA GURU
   Pastel Blue + Dark Navy
===================================================== */

.guru-edit {
    --ge-blue: #3478BD;
    --ge-blue-dark: #285F96;
    --ge-text: #293F57;
    --ge-muted: #526982;
    --ge-border: #D5E1ED;

    color: var(--ge-text);
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.guru-edit *,
.guru-edit *::before,
.guru-edit *::after {
    box-sizing: border-box;
}

/* ANIMASI */

.ge-enter {
    animation: geEnter .35s ease-out both;
}

.ge-delay {
    animation-delay: .08s;
}

@keyframes geEnter {
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

.ge-hero {
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

.ge-hero-icon {
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

.ge-hero-label {
    color: #285F96;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.ge-hero-title {
    color: #214A77;
}

.ge-hero-description {
    color: #4D6886;
}

/* KEMBALI */

.ge-back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #285F96;
    font-size: 13px;
    font-weight: 800;
    text-decoration: none;
    transition: color .2s ease;
}

.ge-back-link:hover {
    color: #3478BD;
}

.ge-back-link:focus-visible {
    outline: 3px solid rgba(52, 120, 189, .3);
    outline-offset: 3px;
}

/* TOMBOL */

.ge-button {
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
        border-color .18s ease,
        color .18s ease;
}

.ge-button:hover {
    transform: translateY(-1px);
}

.ge-button:active {
    transform: translateY(0);
}

.ge-button:focus-visible,
.ge-small-button:focus-visible {
    outline: 3px solid rgba(52, 120, 189, .3);
    outline-offset: 3px;
}

.ge-button-primary {
    color: #FFFFFF;
    background: #3478BD;
    border-color: #3478BD;
    box-shadow: 0 3px 8px rgba(52, 120, 189, .12);
}

.ge-button-primary:hover {
    color: #FFFFFF;
    background: #285F96;
    border-color: #285F96;
}

.ge-button-secondary {
    color: #365773;
    background: #FFFFFF;
    border-color: #C8DCEE;
}

.ge-button-secondary:hover {
    color: #285F96;
    background: #E3F0FA;
    border-color: #A4BFDF;
}

/* CARD FORM */

.ge-card {
    overflow: hidden;
    border: 1px solid #D5E1ED;
    border-radius: 15px;
    background: #FFFFFF;
    box-shadow: 0 4px 12px rgba(45, 82, 124, .045);
}

.ge-card-header {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 20px 24px;
    border-bottom: 1px solid #D4E3F2;
    background: #F5F9FE;
}

.ge-card-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    border: 1px solid #C3D8EB;
    border-radius: 10px;
    color: #3478BD;
    background: #E3F0FA;
}

.ge-card-icon svg {
    width: 20px;
    height: 20px;
}

.ge-card-title {
    color: #214A77;
}

.ge-card-description {
    color: #667D95;
}

.ge-card-body {
    padding: 26px;
}

/* LABEL DAN INPUT */

.ge-field {
    margin-bottom: 22px;
}

.ge-label {
    display: block;
    margin-bottom: 8px;
    color: #435C76;
    font-size: 12px;
    font-weight: 800;
    line-height: 1.5;
}

.ge-required {
    color: #D9485F;
}

.ge-input {
    display: block;
    width: 100%;
    min-width: 0;
    min-height: 44px;
    padding: 10px 12px;
    border: 1px solid #C9D9E9;
    border-radius: 9px;
    background: #FFFFFF;
    color: #26374A;
    font-family: inherit;
    font-size: 13px;
    font-weight: 500;
    line-height: 1.5;
    outline: none;
    transition:
        border-color .2s ease,
        background .2s ease,
        box-shadow .2s ease;
}

.ge-input::placeholder {
    color: #8495A8;
    font-weight: 500;
}

.ge-input:focus {
    border-color: #438BD0;
    background: #FFFFFF;
    box-shadow: 0 0 0 3px rgba(67, 139, 208, .16);
}

.ge-input select,
select.ge-input {
    cursor: pointer;
}

.ge-helper {
    margin-top: 8px;
    color: #73869B;
    font-size: 11px;
    line-height: 1.7;
}

.ge-helper-icon {
    margin-right: 4px;
    color: #3478BD;
}

.ge-field-error {
    margin-top: 7px;
    color: #C13D52;
    font-size: 12px;
    font-weight: 600;
    line-height: 1.6;
}

/* CUSTOM AUTOCOMPLETE */

.ge-autocomplete {
    position: relative;
    width: 100%;
}

.ge-suggestion-box {
    position: absolute;
    top: calc(100% + 7px);
    left: 0;
    right: 0;
    z-index: 80;
    overflow: hidden;
    max-height: 265px;
    overflow-y: auto;
    border: 1px solid #D5E1ED;
    border-radius: 11px;
    background: #FFFFFF;
    box-shadow: 0 8px 20px rgba(39, 77, 119, .12);
    animation: geSuggestionEnter .16s ease-out;
}

.ge-suggestion-box[hidden] {
    display: none !important;
}

@keyframes geSuggestionEnter {
    from {
        opacity: 0;
        transform: translateY(-4px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.ge-suggestion-heading {
    position: sticky;
    top: 0;
    z-index: 1;
    padding: 11px 14px;
    border-bottom: 1px solid #E5EDF5;
    background: #F8FAFC;
    color: #71849A;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.ge-suggestion-item {
    display: flex;
    align-items: center;
    gap: 11px;
    width: 100%;
    padding: 11px 14px;
    border: 0;
    background: #FFFFFF;
    color: #30445B;
    font-family: inherit;
    font-size: 13px;
    font-weight: 600;
    text-align: left;
    cursor: pointer;
    transition: background .18s ease;
}

.ge-suggestion-item + .ge-suggestion-item {
    border-top: 1px solid #EDF1F6;
}

.ge-suggestion-item:hover,
.ge-suggestion-item:focus-visible {
    outline: none;
    background: #EAF3FC;
    color: #285F96;
}

.ge-suggestion-item svg {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
    color: #89AAD7;
}

.ge-suggestion-empty {
    padding: 15px;
    color: #71849A;
    font-size: 12px;
    line-height: 1.6;
}

/* INFORMASI WALI KELAS */

.ge-wali-panel {
    margin-bottom: 26px;
    padding: 19px;
    border: 1px solid #D5E1ED;
    border-radius: 11px;
    background: #F8FAFC;
}

.ge-wali-title {
    color: #294B70;
    font-size: 13px;
    font-weight: 800;
}

.ge-wali-description {
    margin-top: 5px;
    color: #526982;
    font-size: 12px;
    line-height: 1.7;
}

.ge-wali-tag {
    display: inline-flex;
    align-items: center;
    padding: 7px 11px;
    border: 1px solid #C3D8EB;
    border-radius: 8px;
    background: #FFFFFF;
    color: #305A83;
    font-size: 12px;
    font-weight: 800;
}

.ge-wali-note {
    margin-top: 14px;
    padding-top: 12px;
    border-top: 1px solid #D5E1ED;
    color: #73869B;
    font-size: 11px;
    line-height: 1.7;
}

/* PEMISAH */

.ge-divider {
    height: 1px;
    margin: 24px 0;
    background: #E0E9F2;
}

/* BAGIAN KELAS */

.ge-class-section {
    padding: 19px;
    border: 1px solid #D5E1ED;
    border-radius: 11px;
    background: #F8FAFC;
}

.ge-class-heading {
    color: #294B70;
    font-size: 13px;
    font-weight: 800;
}

.ge-class-description {
    margin-top: 5px;
    color: #526982;
    font-size: 12px;
    line-height: 1.7;
}

/* RINGKASAN */

.ge-selection-summary {
    display: flex;
    flex-direction: column;
    gap: 12px;
    align-items: flex-start;
    justify-content: space-between;
    margin: 17px 0;
    padding: 15px;
    border: 1px solid #D5E1ED;
    border-radius: 10px;
    background: #FFFFFF;
}

.ge-count-label {
    color: #344F6B;
    font-size: 13px;
    font-weight: 800;
}

.ge-count-number {
    display: inline-flex;
    min-width: 27px;
    height: 27px;
    align-items: center;
    justify-content: center;
    margin-left: 5px;
    padding: 0 7px;
    border: 1px solid #C9E0F8;
    border-radius: 8px;
    background: #EAF4FF;
    color: #2C6399;
    font-size: 12px;
    font-weight: 800;
}

.ge-helper-text {
    margin-top: 5px;
    color: #718397;
    font-size: 11px;
    line-height: 1.7;
}

/* TOMBOL KECIL */

.ge-small-button {
    display: inline-flex;
    min-height: 36px;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 9px 12px;
    border: 1px solid transparent;
    border-radius: 9px;
    font-family: inherit;
    font-size: 11px;
    font-weight: 800;
    cursor: pointer;
    transition: transform .2s ease, background .2s ease;
}

.ge-small-button:hover {
    transform: translateY(-1px);
}

.ge-select-visible {
    border-color: #3478BD;
    background: #3478BD;
    color: #FFFFFF;
}

.ge-select-visible:hover {
    background: #285F96;
}

.ge-clear-visible {
    border-color: #D4E0EC;
    background: #F4F8FC;
    color: #53677D;
}

.ge-clear-visible:hover {
    background: #E6F0FA;
}

/* FILTER */

.ge-filter-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 15px;
    margin-bottom: 18px;
}

/* KARTU KELAS */

.ge-class-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px;
}

.ge-class-option {
    display: flex;
    align-items: flex-start;
    gap: 11px;
    min-width: 0;
    padding: 13px;
    border: 1px solid #D5E1ED;
    border-radius: 9px;
    background: #FFFFFF;
    cursor: pointer;
    transition:
        border-color .18s ease,
        background .18s ease,
        box-shadow .18s ease;
}

.ge-class-option:hover {
    border-color: #A4BFDF;
    background: #F0F6FD;
}

.ge-class-option:has(input:checked) {
    border-color: #89AAD7;
    background: #E3F0FA;
    box-shadow: inset 0 0 0 1px rgba(137, 170, 215, .2);
}

.ge-class-option.hidden {
    display: none !important;
}

.ge-checkbox {
    width: 17px;
    height: 17px;
    flex-shrink: 0;
    margin-top: 2px;
    accent-color: #3478BD;
    cursor: pointer;
}

.ge-class-name {
    color: #294B70;
    font-size: 13px;
    font-weight: 800;
    line-height: 1.5;
    overflow-wrap: anywhere;
}

.ge-class-meta {
    margin-top: 4px;
    color: #526982;
    font-size: 11px;
    font-weight: 600;
    line-height: 1.6;
}

.ge-wali-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    margin-top: 8px;
    padding: 5px 8px;
    border: 1px solid #F0D39A;
    border-radius: 7px;
    background: #FFF6DF;
    color: #865B10;
    font-size: 10px;
    font-weight: 800;
}

.ge-wali-badge svg {
    width: 13px;
    height: 13px;
    flex-shrink: 0;
}

.ge-no-class,
.ge-filter-empty {
    padding: 15px;
    border: 1px solid #F0D69D;
    border-radius: 9px;
    background: #FFF8E8;
    color: #8E6414;
    font-size: 12px;
    font-weight: 600;
    line-height: 1.7;
}

.ge-filter-empty.hidden {
    display: none !important;
}

/* ERROR */

.ge-error-box {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 15px 17px;
    border: 1px solid #F0C7CE;
    border-radius: 11px;
    background: #FFF2F3;
    color: #A93449;
}

.ge-error-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    flex-shrink: 0;
    border: 1px solid #F0C7CE;
    border-radius: 9px;
    background: #FFFFFF;
    color: #C33E46;
    font-size: 18px;
    font-weight: 900;
}

/* AKSI FORM */

.ge-form-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
}

/* FOOTER */

.ge-footer-line {
    width: 42px;
    height: 3px;
    margin: 0 auto 12px;
    border-radius: 20px;
    background: #89AAD7;
}

.ge-footer {
    color: #73869B;
    font-size: 11px;
    font-weight: 600;
    text-align: center;
}

/* =====================================================
   DARK MODE
===================================================== */

.dark .guru-edit {
    --ge-text: #E4ECF6;
    --ge-muted: #AABBD0;
    --ge-border: #354A62;
    color: var(--ge-text);
}

.dark .ge-hero {
    background: linear-gradient(
        115deg,
        #17283D 0%,
        #1C3049 55%,
        #243E59 100%
    );
    border-color: #3B5878;
    box-shadow: 0 4px 12px rgba(0, 0, 0, .14);
}

.dark .ge-hero-label {
    color: #C6E1FF;
}

.dark .ge-hero-title {
    color: #F1F6FC;
}

.dark .ge-hero-description {
    color: #C2D0E0;
}

.dark .ge-hero-icon {
    background: #263E59;
    color: #D8E9FC;
    border-color: #405B78;
}

.dark .ge-back-link {
    color: #C6E1FF;
}

.dark .ge-back-link:hover {
    color: #FFFFFF;
}

.dark .ge-card {
    border-color: #354962;
    background: #192438;
    box-shadow: none;
}

.dark .ge-card-header {
    border-color: #354962;
    background: #1C2C42;
}

.dark .ge-card-icon {
    color: #C6E1FF;
    background: #263E59;
    border-color: #405773;
}

.dark .ge-card-title {
    color: #F1F6FC;
}

.dark .ge-card-description {
    color: #AABBD0;
}

.dark .ge-label {
    color: #C5D5E9;
}

.dark .ge-input {
    border-color: #40536B;
    background: #111C2E;
    color: #E8F0FB;
}

.dark .ge-input::placeholder {
    color: #93A6BD;
}

.dark .ge-input:focus {
    border-color: #5799DC;
    background: #152337;
    box-shadow: 0 0 0 3px rgba(87, 153, 220, .17);
}

.dark .ge-helper {
    color: #AABBD0;
}

.dark .ge-helper-icon {
    color: #89AAD7;
}

.dark .ge-field-error {
    color: #FF9EAC;
}

.dark .ge-suggestion-box {
    border-color: #354A62;
    background: #192438;
    box-shadow: 0 8px 20px rgba(0, 0, 0, .25);
}

.dark .ge-suggestion-heading {
    border-color: #354A62;
    background: #203149;
    color: #AFC0D4;
}

.dark .ge-suggestion-item {
    border-color: #34465F;
    background: #192438;
    color: #E1EAF5;
}

.dark .ge-suggestion-item:hover,
.dark .ge-suggestion-item:focus-visible {
    background: #263E59;
    color: #FFFFFF;
}

.dark .ge-suggestion-item svg {
    color: #AFCBEA;
}

.dark .ge-suggestion-empty {
    color: #AABBD0;
}

.dark .ge-wali-panel,
.dark .ge-class-section {
    border-color: #354962;
    background: #1C2C42;
}

.dark .ge-wali-title,
.dark .ge-class-heading {
    color: #EAF3FF;
}

.dark .ge-wali-description,
.dark .ge-class-description,
.dark .ge-wali-note {
    color: #AABBD0;
}

.dark .ge-wali-note {
    border-color: #354962;
}

.dark .ge-wali-tag {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

.dark .ge-divider {
    background: #354962;
}

.dark .ge-selection-summary {
    border-color: #354962;
    background: #192438;
}

.dark .ge-count-label {
    color: #D5E5F8;
}

.dark .ge-count-number {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

.dark .ge-helper-text {
    color: #AABBD0;
}

.dark .ge-select-visible {
    background: #3478BD;
    border-color: #557FAF;
}

.dark .ge-select-visible:hover {
    background: #285F96;
}

.dark .ge-clear-visible {
    border-color: #435873;
    background: #24364D;
    color: #D5E5F8;
}

.dark .ge-clear-visible:hover {
    background: #2F4865;
}

.dark .ge-class-option {
    border-color: #40536B;
    background: #111C2E;
}

.dark .ge-class-option:hover {
    border-color: #58789D;
    background: #203149;
}

.dark .ge-class-option:has(input:checked) {
    border-color: #5799DC;
    background: #203C5B;
}

.dark .ge-class-name {
    color: #EAF3FF;
}

.dark .ge-class-meta {
    color: #AABBD0;
}

.dark .ge-wali-badge {
    border-color: #70592E;
    background: #3B311E;
    color: #FFDC91;
}

.dark .ge-no-class,
.dark .ge-filter-empty {
    border-color: #70592E;
    background: #3B311E;
    color: #FFDC91;
}

.dark .ge-button-primary {
    color: #FFFFFF;
    background: #3478BD;
    border-color: #557FAF;
}

.dark .ge-button-primary:hover {
    background: #285F96;
}

.dark .ge-button-secondary {
    color: #D5E5F8;
    background: #24364D;
    border-color: #435873;
}

.dark .ge-button-secondary:hover {
    color: #FFFFFF;
    background: #2F4865;
}

.dark .ge-error-box {
    border-color: #704044;
    background: #3B2429;
    color: #FFB4B4;
}

.dark .ge-error-icon {
    border-color: #704044;
    background: #482A30;
    color: #FFB4B4;
}

.dark .ge-footer {
    color: #AABBD0;
}

/* RESPONSIVE */

@media (min-width: 640px) {
    .ge-selection-summary {
        flex-direction: row;
        align-items: center;
    }
}

@media (max-width: 640px) {
    .ge-hero {
        border-radius: 14px;
    }

    .ge-hero-icon {
        width: 47px;
        height: 47px;
        border-radius: 11px;
    }

    .ge-hero-icon svg {
        width: 23px;
        height: 23px;
    }

    .ge-card-header {
        padding: 17px;
    }

    .ge-card-body {
        padding: 18px;
    }

    .ge-wali-panel,
    .ge-class-section {
        padding: 14px;
    }

    .ge-filter-grid,
    .ge-class-grid {
        grid-template-columns: minmax(0, 1fr);
    }

    .ge-form-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .ge-form-actions .ge-button {
        width: 100%;
    }

    .ge-selection-summary {
        align-items: stretch;
    }

    .ge-selection-summary > div:last-child {
        display: flex;
        flex-direction: column;
    }

    .ge-small-button {
        width: 100%;
    }
}

@media (prefers-reduced-motion: reduce) {
    .guru-edit *,
    .guru-edit *::before,
    .guru-edit *::after {
        animation: none !important;
        transition: none !important;
    }
}
</style>
@endpush


@section('content')

@php
    $kelasTerpilih = old('kelas_ids', $kelasTerpilih ?? []);
    $kelasTerpilih = array_map('intval', $kelasTerpilih);

    $tingkatList = $kelasList
        ->pluck('tingkat')
        ->filter()
        ->unique()
        ->sort()
        ->values();

    $jurusanList = $kelasList
        ->pluck('jurusan')
        ->filter()
        ->unique()
        ->sort()
        ->values();

    $waliKelasGuru = $kelasList
        ->filter(function ($kelas) use ($guru) {
            return trim((string) $kelas->wali_kelas)
                === trim((string) $guru->nama_guru);
        })
        ->pluck('id')
        ->map(fn ($id) => (int) $id)
        ->values()
        ->all();
@endphp


<div class="guru-edit space-y-6">

    {{-- HEADER --}}
    <section class="ge-hero ge-enter">

        <div class="flex flex-col gap-5 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-7">

            <div class="flex min-w-0 items-center gap-4">

                <div class="ge-hero-icon">

                    <svg class="w-7 h-7"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21V5.5Z"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M4 17a2.5 2.5 0 0 1 2.5-2.5H20"/>

                    </svg>

                </div>

                <div class="min-w-0">

                    <p class="ge-hero-label mb-1">
                        Data Master
                    </p>

                    <h2 class="ge-hero-title text-xl font-extrabold sm:text-2xl">
                        Edit Data Guru
                    </h2>

                    <p class="ge-hero-description mt-2 text-sm leading-relaxed">
                        Perbarui identitas, mata pelajaran, dan penugasan kelas guru.
                    </p>

                </div>

            </div>

            <a href="{{ route('admin.guru.index') }}"
               class="ge-button ge-button-secondary flex-shrink-0">

                <svg class="w-4 h-4"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24"
                     aria-hidden="true">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M15 19l-7-7 7-7M8 12h13"/>

                </svg>

                Kembali

            </a>

        </div>

    </section>


    {{-- LINK KEMBALI --}}
    <div>
        <a href="{{ route('admin.guru.index') }}" class="ge-back-link">

            <svg viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 class="w-4 h-4"
                 aria-hidden="true">

                <path d="m15 18-6-6 6-6"/>
                <path d="M9 12h12"/>

            </svg>

            Kembali ke Daftar Guru

        </a>
    </div>


    {{-- ERROR VALIDASI --}}
    @if($errors->any())

        <div class="ge-error-box ge-enter" role="alert">

            <div class="ge-error-icon">
                !
            </div>

            <div class="min-w-0 flex-1">

                <p class="mb-2 text-sm font-extrabold">
                    Periksa Kembali Data Berikut
                </p>

                <ul class="space-y-1 text-sm leading-6 list-disc ml-5">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    {{-- FORM CARD --}}
    <div class="max-w-5xl ge-enter ge-delay">

        <section class="ge-card">

            {{-- JUDUL CARD --}}
            <div class="ge-card-header">

                <div class="ge-card-icon">

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21V5.5Z"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M4 17a2.5 2.5 0 0 1 2.5-2.5H20"/>

                    </svg>

                </div>

                <div>

                    <h3 class="ge-card-title text-base font-extrabold sm:text-lg">
                        Informasi Guru
                    </h3>

                    <p class="ge-card-description text-xs mt-1">
                        Periksa dan perbarui informasi guru dengan benar.
                    </p>

                </div>

            </div>


            {{-- FORM UPDATE --}}
            <form
                id="guruEditForm"
                action="{{ route('admin.guru.update', $guru->id_guru) }}"
                method="POST"
                autocomplete="off"
                class="ge-card-body"
            >

                @csrf
                @method('PUT')


                {{-- NIP --}}
                <div class="ge-field">

                    <label for="nip" class="ge-label">
                        NIP
                        <span class="ge-required">*</span>
                    </label>

                    <div class="ge-autocomplete">

                        <input
                            type="text"
                            id="nip"
                            name="nip"
                            value="{{ old('nip', $guru->nip) }}"
                            placeholder="Masukkan NIP guru"
                            required
                            class="ge-input"
                            autocomplete="off"
                            autocapitalize="off"
                            spellcheck="false"
                            data-history-key="eduvia_guru_nip_history"
                            aria-autocomplete="list"
                        >

                        <div
                            class="ge-suggestion-box"
                            data-suggestions="nip"
                            role="listbox"
                            aria-label="Riwayat NIP"
                            hidden
                        ></div>

                    </div>

                    @error('nip')
                        <p class="ge-field-error">{{ $message }}</p>
                    @enderror

                </div>


                {{-- NAMA GURU --}}
                <div class="ge-field">

                    <label for="nama" class="ge-label">
                        Nama Guru
                        <span class="ge-required">*</span>
                    </label>

                    <div class="ge-autocomplete">

                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            value="{{ old('nama', $guru->nama_guru) }}"
                            placeholder="Masukkan nama lengkap beserta gelar"
                            required
                            class="ge-input"
                            autocomplete="off"
                            autocapitalize="words"
                            spellcheck="false"
                            data-history-key="eduvia_guru_nama_history"
                            aria-autocomplete="list"
                        >

                        <div
                            class="ge-suggestion-box"
                            data-suggestions="nama"
                            role="listbox"
                            aria-label="Riwayat nama guru"
                            hidden
                        ></div>

                    </div>

                    @error('nama')
                        <p class="ge-field-error">{{ $message }}</p>
                    @enderror

                </div>


                {{-- MATA PELAJARAN --}}
                <div class="ge-field">

                    <label for="mapel_diampu_input" class="ge-label">
                        Mata Pelajaran yang Diampu
                        <span class="ge-required">*</span>
                    </label>

                    <div class="ge-autocomplete">

                        <input
                            type="text"
                            id="mapel_diampu_input"
                            value="{{ old('mapel_diampu', $guru->mapel_diampu) }}"
                            placeholder="Cari atau pilih mata pelajaran..."
                            required
                            class="ge-input"
                            autocomplete="off"
                            autocapitalize="off"
                            spellcheck="false"
                            aria-autocomplete="list"
                            aria-controls="mapelGuruSuggestions"
                        >

                        {{-- NILAI YANG DIKIRIM KE CONTROLLER --}}
                        <input
                            type="hidden"
                            id="mapel_diampu"
                            name="mapel_diampu"
                            value="{{ old('mapel_diampu', $guru->mapel_diampu) }}"
                        >

                        <div
                            id="mapelGuruSuggestions"
                            class="ge-suggestion-box"
                            role="listbox"
                            aria-label="Pilihan mata pelajaran"
                            hidden
                        ></div>

                    </div>

                    <p class="ge-helper">
                        <span class="ge-helper-icon">ⓘ</span>
                        Pilihan mata pelajaran diambil dari Data Mata Pelajaran. Ketik untuk mencari atau pilih dari riwayat.
                    </p>

                    @error('mapel_diampu')
                        <p class="ge-field-error">{{ $message }}</p>
                    @enderror

                </div>


                <div class="ge-divider"></div>


                {{-- INFORMASI WALI KELAS --}}
                <section class="ge-wali-panel">

                    <div class="flex items-start gap-3">

                        <div class="ge-card-icon">

                            <svg fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 viewBox="0 0 24 24"
                                 aria-hidden="true">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M3 10l9-7 9 7"/>

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M5 9v11h14V9"/>

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M9 20v-6h6v6"/>

                            </svg>

                        </div>

                        <div class="min-w-0 flex-1">

                            <h3 class="ge-wali-title">
                                Informasi Wali Kelas
                            </h3>

                            @if(count($waliKelasGuru) > 0)

                                <p class="ge-wali-description">
                                    Guru ini terdaftar sebagai wali kelas untuk:
                                </p>

                                <div class="mt-3 flex flex-wrap gap-2">

                                    @foreach($kelasList->whereIn('id', $waliKelasGuru) as $kelas)

                                        <span class="ge-wali-tag">
                                            {{ $kelas->nama_kelas }}
                                        </span>

                                    @endforeach

                                </div>

                            @else

                                <p class="ge-wali-description">
                                    Guru ini belum tercatat sebagai wali kelas.
                                </p>

                            @endif

                            <p class="ge-wali-note">
                                Informasi wali kelas berasal dari data kelas.
                                Pengaturan ini berbeda dari penugasan mata pelajaran.
                            </p>

                        </div>

                    </div>

                </section>


                {{-- KELAS YANG DIAJAR --}}
                <section class="ge-class-section">

                    <div class="flex items-start gap-3">

                        <div class="ge-card-icon">

                            <svg fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 viewBox="0 0 24 24"
                                 aria-hidden="true">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M3 9l9-5 9 5-9 5-9-5Z"/>

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M7 11.5V16c3.3 2.5 6.7 2.5 10 0v-4.5"/>

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M21 9v6"/>

                            </svg>

                        </div>

                        <div class="min-w-0 flex-1">

                            <h3 class="ge-class-heading">
                                Kelas yang Diajar
                                <span class="ge-required">*</span>
                            </h3>

                            <p class="ge-class-description">
                                Pilih semua kelas yang benar-benar diajar guru ini
                                sesuai pembagian jadwal sekolah.
                            </p>

                        </div>

                    </div>


                    {{-- RINGKASAN PILIHAN --}}
                    <div class="ge-selection-summary">

                        <div>

                            <p class="ge-count-label">
                                Kelas dipilih:

                                <span id="jumlahKelasTerpilih" class="ge-count-number">
                                    {{ count($kelasTerpilih) }}
                                </span>
                            </p>

                            <p class="ge-helper-text">
                                Pilihan kelas tetap tersimpan saat filter diganti.
                            </p>

                        </div>

                        <div class="flex flex-wrap gap-2">

                            <button
                                type="button"
                                id="pilihSemuaDitampilkan"
                                class="ge-small-button ge-select-visible"
                            >
                                ✓ Pilih yang Ditampilkan
                            </button>

                            <button
                                type="button"
                                id="hapusPilihanDitampilkan"
                                class="ge-small-button ge-clear-visible"
                            >
                                ↺ Hapus Pilihan Ditampilkan
                            </button>

                        </div>

                    </div>


                    {{-- FILTER KELAS --}}
                    <div class="ge-filter-grid">

                        <div>

                            <label for="filterTingkat" class="ge-label">
                                Filter Tingkat
                            </label>

                            <select id="filterTingkat" class="ge-input">

                                <option value="semua">
                                    Semua Tingkat
                                </option>

                                @foreach($tingkatList as $tingkat)

                                    <option value="{{ $tingkat }}">
                                        {{ $tingkat }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <div>

                            <label for="filterJurusan" class="ge-label">
                                Filter Jurusan
                            </label>

                            <select id="filterJurusan" class="ge-input">

                                <option value="semua">
                                    Semua Jurusan
                                </option>

                                @foreach($jurusanList as $jurusan)

                                    <option value="{{ $jurusan }}">
                                        {{ $jurusan }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>


                    {{-- DAFTAR KELAS --}}
                    <div id="daftarKelas" class="ge-class-grid">

                        @forelse($kelasList as $kelas)

                            <label
                                data-kelas-card
                                data-tingkat="{{ $kelas->tingkat }}"
                                data-jurusan="{{ $kelas->jurusan }}"
                                class="ge-class-option"
                            >

                                <input
                                    type="checkbox"
                                    name="kelas_ids[]"
                                    value="{{ $kelas->id }}"
                                    @checked(in_array((int) $kelas->id, $kelasTerpilih, true))
                                    class="kelas-checkbox ge-checkbox"
                                >

                                <div class="min-w-0 flex-1">

                                    <p class="ge-class-name">
                                        {{ $kelas->nama_kelas }}
                                    </p>

                                    <p class="ge-class-meta">
                                        Tingkat {{ $kelas->tingkat }}
                                        · Jurusan {{ $kelas->jurusan }}
                                    </p>

                                    @if(in_array((int) $kelas->id, $waliKelasGuru, true))

                                        <span class="ge-wali-badge">

                                            <svg viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="2"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round"
                                                 aria-hidden="true">

                                                <path d="m3 10 9-7 9 7"/>
                                                <path d="M5 9v11h14V9"/>

                                            </svg>

                                            Wali Kelas

                                        </span>

                                    @endif

                                </div>

                            </label>

                        @empty

                            <div class="ge-no-class" style="grid-column: 1 / -1;">

                                <p class="mb-1 font-extrabold">
                                    Belum Ada Data Kelas
                                </p>

                                <p>
                                    Tambahkan data kelas terlebih dahulu melalui menu Data Kelas.
                                </p>

                            </div>

                        @endforelse

                    </div>


                    <p id="tidakAdaKelas" class="ge-filter-empty hidden">
                        Tidak ada kelas yang sesuai dengan filter ini.
                    </p>


                    @error('kelas_ids')
                        <p class="ge-field-error">{{ $message }}</p>
                    @enderror

                    @error('kelas_ids.*')
                        <p class="ge-field-error">{{ $message }}</p>
                    @enderror

                </section>


                <div class="ge-divider"></div>


                {{-- TOMBOL --}}
                <div class="ge-form-actions">

                    <button
                        type="submit"
                        class="ge-button ge-button-primary"
                    >

                        <svg class="w-4 h-4"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             viewBox="0 0 24 24"
                             aria-hidden="true">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="m5 12 4 4L19 6"/>

                        </svg>

                        Simpan Perubahan

                    </button>


                    <a
                        href="{{ route('admin.guru.index') }}"
                        class="ge-button ge-button-secondary"
                    >
                        Batal
                    </a>

                </div>

            </form>

        </section>

    </div>


    {{-- FOOTER --}}
    <footer class="text-center pt-2 pb-3">

        <div class="ge-footer-line"></div>

        <p class="ge-footer">
            © {{ date('Y') }} Sistem Akademik Mini
        </p>

    </footer>

</div>

@endsection


{{-- =====================================================
     JAVASCRIPT
     RIWAYAT GURU + FILTER KELAS
===================================================== --}}

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    /*
     * ================================================
     * BAGIAN 1: RIWAYAT ISIAN GURU
     * ================================================
     */

    const form = document.getElementById('guruEditForm');

    if (!form) {
        return;
    }

    const MAX_HISTORY = 6;

    const historyInputs = form.querySelectorAll(
        'input[data-history-key]'
    );

    const mapelInput = document.getElementById('mapel_diampu_input');
    const mapelHidden = document.getElementById('mapel_diampu');
    const mapelDropdown = document.getElementById('mapelGuruSuggestions');

    const mapelOptions = @json(
        $mapelList->pluck('nama_mapel')->filter()->values()
    );


    /*
     * Ambil riwayat dari localStorage.
     */
    function getHistory(storageKey) {

        try {

            const history = JSON.parse(
                localStorage.getItem(storageKey) || '[]'
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
     * Simpan riwayat baru.
     * Riwayat terbaru berada di atas.
     */
    function saveHistory(storageKey, value) {

        const keyword = value.trim();

        if (!keyword) {
            return;
        }

        const history = getHistory(storageKey).filter(function (item) {

            return item.toLowerCase() !== keyword.toLowerCase();

        });

        history.unshift(keyword);

        try {

            localStorage.setItem(
                storageKey,
                JSON.stringify(history.slice(0, MAX_HISTORY))
            );

        } catch (error) {

            // Form tetap bisa digunakan jika penyimpanan tidak tersedia.

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
     * Membuat tombol saran.
     */
    function createSuggestionButton(value, onChoose) {

        const button = document.createElement('button');

        button.type = 'button';
        button.className = 'ge-suggestion-item';
        button.setAttribute('role', 'option');

        const icon = createHistoryIcon();

        const text = document.createElement('span');

        text.textContent = value;

        button.appendChild(icon);
        button.appendChild(text);

        button.addEventListener('mousedown', function (event) {
            event.preventDefault();
        });

        button.addEventListener('click', function () {
            onChoose(value);
        });

        return button;

    }


    /*
     * Menutup dropdown.
     */
    function hideDropdown(dropdown) {

        if (!dropdown) {
            return;
        }

        dropdown.hidden = true;
        dropdown.replaceChildren();

    }


    /*
     * Menampilkan dropdown.
     */
    function showDropdown(dropdown) {
        dropdown.hidden = false;
    }


    /*
     * Menampilkan riwayat NIP dan Nama Guru.
     */
    function renderHistorySuggestions(input) {

        const wrapper = input.closest('.ge-autocomplete');

        const dropdown = wrapper?.querySelector('.ge-suggestion-box');

        if (!dropdown) {
            return;
        }

        const storageKey = input.dataset.historyKey;

        const keyword = input.value.trim().toLowerCase();

        const history = getHistory(storageKey);

        const filtered = history
            .filter(function (item) {
                return item.toLowerCase().includes(keyword);
            })
            .slice(0, MAX_HISTORY);

        dropdown.replaceChildren();

        if (filtered.length === 0) {
            hideDropdown(dropdown);
            return;
        }

        const heading = document.createElement('div');

        heading.className = 'ge-suggestion-heading';

        heading.textContent = keyword
            ? 'Riwayat yang cocok'
            : 'Riwayat isian sebelumnya';

        dropdown.appendChild(heading);

        filtered.forEach(function (item) {

            const button = createSuggestionButton(item, function (value) {

                input.value = value;

                hideDropdown(dropdown);

                input.focus();

            });

            dropdown.appendChild(button);

        });

        showDropdown(dropdown);

    }


    /*
     * Aktifkan autocomplete khusus NIP dan Nama Guru.
     */
    historyInputs.forEach(function (input) {

        input.addEventListener('focus', function () {
            renderHistorySuggestions(input);
        });

        input.addEventListener('input', function () {
            renderHistorySuggestions(input);
        });

        input.addEventListener('keydown', function (event) {

            if (event.key === 'Escape') {

                const dropdown = input
                    .closest('.ge-autocomplete')
                    ?.querySelector('.ge-suggestion-box');

                hideDropdown(dropdown);

            }

        });

    });


    /*
     * ================================================
     * BAGIAN 2: MATA PELAJARAN
     * ================================================
     */

    function renderMapelSuggestions() {

        if (!mapelInput || !mapelHidden || !mapelDropdown) {
            return;
        }

        const keyword = mapelInput.value.trim().toLowerCase();

        const history = getHistory('eduvia_guru_mapel_history');

        /*
         * Riwayat yang masih tersedia di database.
         */
        const riwayatValid = history.filter(function (item) {

            return mapelOptions.some(function (mapel) {

                return mapel.toLowerCase() === item.toLowerCase();

            });

        });


        /*
         * Riwayat ditampilkan lebih dahulu,
         * lalu seluruh mata pelajaran lainnya.
         */
        const combined = [
            ...riwayatValid,

            ...mapelOptions.filter(function (mapel) {

                return !riwayatValid.some(function (item) {

                    return item.toLowerCase() === mapel.toLowerCase();

                });

            })
        ];


        /*
         * Filter sesuai kata yang diketik.
         */
        const filtered = combined
            .filter(function (item) {

                return item.toLowerCase().includes(keyword);

            })
            .slice(0, 10);


        mapelDropdown.replaceChildren();

        if (filtered.length === 0) {

            const empty = document.createElement('div');

            empty.className = 'ge-suggestion-empty';

            empty.textContent = keyword
                ? 'Mata pelajaran tidak ditemukan. Coba kata kunci lain.'
                : 'Belum ada mata pelajaran yang tersedia.';

            mapelDropdown.appendChild(empty);

            showDropdown(mapelDropdown);

            return;

        }


        const heading = document.createElement('div');

        heading.className = 'ge-suggestion-heading';

        heading.textContent = keyword
            ? 'Hasil pencarian mata pelajaran'
            : 'Riwayat dan daftar mata pelajaran';

        mapelDropdown.appendChild(heading);


        filtered.forEach(function (item) {

            const button = createSuggestionButton(item, function (value) {

                mapelInput.value = value;
                mapelHidden.value = value;

                mapelInput.setCustomValidity('');

                hideDropdown(mapelDropdown);

                mapelInput.focus();

            });

            mapelDropdown.appendChild(button);

        });

        showDropdown(mapelDropdown);

    }


    if (mapelInput && mapelHidden && mapelDropdown) {

        /*
         * Cocokkan mapel lama dengan daftar mapel database.
         */
        const initialMapel = mapelOptions.find(function (item) {

            return item.toLowerCase() === mapelInput.value.trim().toLowerCase();

        });

        if (initialMapel) {

            mapelInput.value = initialMapel;
            mapelHidden.value = initialMapel;

        } else {

            mapelHidden.value = '';

        }


        mapelInput.addEventListener('focus', renderMapelSuggestions);


        mapelInput.addEventListener('input', function () {

            const cocok = mapelOptions.find(function (item) {

                return item.toLowerCase() === mapelInput.value.trim().toLowerCase();

            });

            mapelHidden.value = cocok || '';

            mapelInput.setCustomValidity('');

            renderMapelSuggestions();

        });


        mapelInput.addEventListener('keydown', function (event) {

            if (event.key === 'Escape') {
                hideDropdown(mapelDropdown);
            }

        });

    }


    /*
     * ================================================
     * BAGIAN 3: TUTUP DROPDOWN SAAT KLIK DI LUAR
     * ================================================
     */

    document.addEventListener('click', function (event) {

        document.querySelectorAll('.ge-autocomplete').forEach(function (wrapper) {

            if (!wrapper.contains(event.target)) {

                const dropdown = wrapper.querySelector('.ge-suggestion-box');

                hideDropdown(dropdown);

            }

        });

    });


    /*
     * ================================================
     * BAGIAN 4: SIMPAN RIWAYAT SAAT FORM DIKIRIM
     * ================================================
     */

    form.addEventListener('submit', function (event) {

        /*
         * Pastikan mata pelajaran berasal dari daftar database.
         */
        if (mapelInput && mapelHidden) {

            const selectedMapel = mapelOptions.find(function (item) {

                return item.toLowerCase() === mapelInput.value.trim().toLowerCase();

            });

            if (!selectedMapel) {

                event.preventDefault();

                mapelInput.setCustomValidity(
                    'Pilih mata pelajaran dari daftar yang tersedia.'
                );

                mapelInput.reportValidity();

                mapelInput.focus();

                return;

            }

            mapelHidden.value = selectedMapel;

        }


        /*
         * Simpan riwayat NIP.
         */
        const nipInput = document.getElementById('nip');

        if (nipInput && nipInput.value.trim()) {

            saveHistory(
                'eduvia_guru_nip_history',
                nipInput.value
            );

        }


        /*
         * Simpan riwayat Nama Guru.
         */
        const namaInput = document.getElementById('nama');

        if (namaInput && namaInput.value.trim()) {

            saveHistory(
                'eduvia_guru_nama_history',
                namaInput.value
            );

        }


        /*
         * Simpan riwayat Mata Pelajaran.
         */
        if (mapelHidden && mapelHidden.value.trim()) {

            saveHistory(
                'eduvia_guru_mapel_history',
                mapelHidden.value
            );

        }

    });


    /*
     * ================================================
     * BAGIAN 5: FILTER KELAS
     * ================================================
     */

    const filterTingkat = document.getElementById('filterTingkat');
    const filterJurusan = document.getElementById('filterJurusan');

    const cards = Array.from(
        document.querySelectorAll('[data-kelas-card]')
    );

    const checkboxes = Array.from(
        document.querySelectorAll('.kelas-checkbox')
    );

    const jumlahKelasTerpilih = document.getElementById(
        'jumlahKelasTerpilih'
    );

    const tidakAdaKelas = document.getElementById(
        'tidakAdaKelas'
    );

    const pilihSemuaDitampilkan = document.getElementById(
        'pilihSemuaDitampilkan'
    );

    const hapusPilihanDitampilkan = document.getElementById(
        'hapusPilihanDitampilkan'
    );


    if (
        !filterTingkat ||
        !filterJurusan ||
        !jumlahKelasTerpilih ||
        !tidakAdaKelas ||
        !pilihSemuaDitampilkan ||
        !hapusPilihanDitampilkan
    ) {
        return;
    }


    /*
     * Memeriksa apakah kelas sesuai filter.
     */
    function cocokDenganFilter(card) {

        const tingkatCocok =
            filterTingkat.value === 'semua' ||
            card.dataset.tingkat === filterTingkat.value;

        const jurusanCocok =
            filterJurusan.value === 'semua' ||
            card.dataset.jurusan === filterJurusan.value;

        return tingkatCocok && jurusanCocok;

    }


    /*
     * Memperbarui tampilan dan jumlah kelas.
     */
    function perbaruiTampilan() {

        let jumlahDitampilkan = 0;
        let jumlahDipilih = 0;

        cards.forEach(function (card) {

            const cocok = cocokDenganFilter(card);

            card.classList.toggle('hidden', !cocok);

            if (cocok) {
                jumlahDitampilkan++;
            }

        });


        checkboxes.forEach(function (checkbox) {

            if (checkbox.checked) {
                jumlahDipilih++;
            }

        });


        jumlahKelasTerpilih.textContent = jumlahDipilih;

        tidakAdaKelas.classList.toggle(
            'hidden',
            jumlahDitampilkan > 0
        );

    }


    /*
     * Filter tingkat dan jurusan.
     */
    filterTingkat.addEventListener('change', perbaruiTampilan);

    filterJurusan.addEventListener('change', perbaruiTampilan);


    /*
     * Perbarui jumlah saat checkbox berubah.
     */
    checkboxes.forEach(function (checkbox) {

        checkbox.addEventListener('change', perbaruiTampilan);

    });


    /*
     * Pilih semua kelas yang sedang ditampilkan.
     */
    pilihSemuaDitampilkan.addEventListener('click', function () {

        cards.forEach(function (card) {

            if (cocokDenganFilter(card)) {

                const checkbox = card.querySelector('.kelas-checkbox');

                if (checkbox) {
                    checkbox.checked = true;
                }

            }

        });

        perbaruiTampilan();

    });


    /*
     * Hapus pilihan kelas yang sedang ditampilkan.
     * Kelas yang tersembunyi karena filter tetap dipertahankan.
     */
    hapusPilihanDitampilkan.addEventListener('click', function () {

        cards.forEach(function (card) {

            if (cocokDenganFilter(card)) {

                const checkbox = card.querySelector('.kelas-checkbox');

                if (checkbox) {
                    checkbox.checked = false;
                }

            }

        });

        perbaruiTampilan();

    });


    /*
     * Tampilan awal.
     */
    perbaruiTampilan();

});
</script>
@endpush