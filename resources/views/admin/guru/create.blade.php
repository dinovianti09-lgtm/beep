@extends('layouts.admin')

@section('title', 'Tambah Data Guru - Sistem Akademik Mini')
@section('page-title', 'Tambah Data Guru')
@section('page-subtitle', 'Tambahkan identitas dan penugasan guru')

@push('styles')
<style>
/* =====================================================
   EDUVIA - TAMBAH DATA GURU
   Pastel Blue + Dark Navy
===================================================== */

.guru-create {
    --gc-blue: #3478BD;
    --gc-blue-dark: #285F96;
    --gc-text: #293F57;
    --gc-muted: #526982;
    --gc-border: #D5E1ED;

    color: var(--gc-text);
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.dark .guru-create {
    --gc-text: #E4ECF6;
    --gc-muted: #AABBD0;
    --gc-border: #354A62;
}

.guru-create *,
.guru-create *::before,
.guru-create *::after {
    box-sizing: border-box;
}

/* =====================================================
   ANIMASI
===================================================== */

.gc-enter {
    animation: gcEnter .35s ease-out both;
}

.gc-delay {
    animation-delay: .08s;
}

@keyframes gcEnter {
    from {
        opacity: 0;
        transform: translateY(7px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* =====================================================
   HEADER
===================================================== */

.gc-hero {
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

.gc-hero::before,
.gc-hero::after {
    display: none !important;
    content: none !important;
}

.gc-hero-icon {
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

.gc-hero-label {
    color: #285F96;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.gc-hero-title {
    color: #214A77;
}

.gc-hero-description {
    color: #4D6886;
}

.dark .gc-hero {
    background: linear-gradient(
        115deg,
        #17283D 0%,
        #1C3049 55%,
        #243E59 100%
    );
    border-color: #3B5878;
    box-shadow: 0 4px 12px rgba(0, 0, 0, .14);
}

.dark .gc-hero-label {
    color: #C6E1FF;
}

.dark .gc-hero-title {
    color: #F1F6FC;
}

.dark .gc-hero-description {
    color: #C2D0E0;
}

.dark .gc-hero-icon {
    background: #263E59;
    color: #D8E9FC;
    border-color: #405B78;
}

/* =====================================================
   TOMBOL
===================================================== */

.gc-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 42px;
    padding: 10px 15px;
    border: 1px solid transparent;
    border-radius: 9px;
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

.gc-button:hover {
    transform: translateY(-1px);
}

.gc-button:active {
    transform: translateY(0);
}

.gc-button:focus-visible,
.gc-back-link:focus-visible {
    outline: 3px solid rgba(52, 120, 189, .3);
    outline-offset: 3px;
}

.gc-button-primary {
    color: #FFFFFF;
    background: #3478BD;
    border-color: #3478BD;
    box-shadow: 0 3px 8px rgba(52, 120, 189, .12);
}

.gc-button-primary:hover {
    color: #FFFFFF;
    background: #285F96;
    border-color: #285F96;
}

.gc-button-secondary {
    color: #365773;
    background: #FFFFFF;
    border-color: #C8DCEE;
}

.gc-button-secondary:hover {
    color: #285F96;
    background: #E3F0FA;
    border-color: #A4BFDF;
}

.dark .gc-button-primary {
    color: #FFFFFF;
    background: #3478BD;
    border-color: #557FAF;
}

.dark .gc-button-primary:hover {
    background: #285F96;
}

.dark .gc-button-secondary {
    color: #D5E5F8;
    background: #24364D;
    border-color: #435873;
}

.dark .gc-button-secondary:hover {
    color: #FFFFFF;
    background: #2F4865;
}

/* =====================================================
   TOMBOL KEMBALI
===================================================== */

.gc-back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #285F96;
    font-size: 13px;
    font-weight: 800;
    text-decoration: none;
    transition: color .2s ease;
}

.gc-back-link:hover {
    color: #3478BD;
}

.dark .gc-back-link {
    color: #C6E1FF;
}

.dark .gc-back-link:hover {
    color: #FFFFFF;
}

/* =====================================================
   KARTU FORM
===================================================== */

.gc-card {
    overflow: hidden;
    border: 1px solid #D5E1ED;
    border-radius: 15px;
    background: #FFFFFF;
    box-shadow: 0 4px 12px rgba(45, 82, 124, .045);
}

.dark .gc-card {
    border-color: #354962;
    background: #192438;
    box-shadow: none;
}

.gc-card-header {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 20px 24px;
    border-bottom: 1px solid #D4E3F2;
    background: #F5F9FE;
}

.dark .gc-card-header {
    border-color: #354962;
    background: #1C2C42;
}

.gc-card-icon {
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

.gc-card-icon svg {
    width: 20px;
    height: 20px;
}

.gc-card-title {
    color: #214A77;
}

.gc-card-description {
    color: #667D95;
}

.dark .gc-card-icon {
    color: #C6E1FF;
    background: #263E59;
    border-color: #405773;
}

.dark .gc-card-title {
    color: #F1F6FC;
}

.dark .gc-card-description {
    color: #AABBD0;
}

/* =====================================================
   LABEL DAN INPUT
===================================================== */

.gc-field {
    margin-bottom: 22px;
}

.gc-label {
    display: block;
    margin-bottom: 8px;
    color: #435C76;
    font-size: 12px;
    font-weight: 800;
    line-height: 1.5;
}

.dark .gc-label {
    color: #C5D5E9;
}

.gc-required {
    color: #D9485F;
}

.gc-input {
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

.gc-input::placeholder {
    color: #8495A8;
    font-weight: 500;
}

.gc-input:focus {
    border-color: #438BD0;
    background: #FFFFFF;
    box-shadow: 0 0 0 3px rgba(67, 139, 208, .16);
}

.dark .gc-input {
    border-color: #40536B;
    background: #111C2E;
    color: #E8F0FB;
}

.dark .gc-input::placeholder {
    color: #93A6BD;
}

.dark .gc-input:focus {
    border-color: #5799DC;
    background: #152337;
    box-shadow: 0 0 0 3px rgba(87, 153, 220, .17);
}

.gc-helper {
    margin-top: 8px;
    color: #73869B;
    font-size: 11px;
    line-height: 1.7;
}

.gc-helper-icon {
    margin-right: 4px;
    color: #3478BD;
}

.dark .gc-helper {
    color: #AABBD0;
}

.dark .gc-helper-icon {
    color: #89AAD7;
}

.gc-field-error {
    margin-top: 7px;
    color: #C13D52;
    font-size: 12px;
    font-weight: 600;
    line-height: 1.6;
}

.dark .gc-field-error {
    color: #FF9EAC;
}

/* =====================================================
   CUSTOM AUTOCOMPLETE EDUVIA
===================================================== */

.gc-autocomplete {
    position: relative;
    width: 100%;
}

.gc-suggestion-box {
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
    animation: gcSuggestionEnter .16s ease-out;
}

.gc-suggestion-box[hidden] {
    display: none !important;
}

@keyframes gcSuggestionEnter {
    from {
        opacity: 0;
        transform: translateY(-4px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.gc-suggestion-heading {
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

.gc-suggestion-item {
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

.gc-suggestion-item + .gc-suggestion-item {
    border-top: 1px solid #EDF1F6;
}

.gc-suggestion-item:hover,
.gc-suggestion-item:focus-visible {
    outline: none;
    background: #EAF3FC;
    color: #285F96;
}

.gc-suggestion-item svg {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
    color: #89AAD7;
}

.gc-suggestion-empty {
    padding: 15px;
    color: #71849A;
    font-size: 12px;
    line-height: 1.6;
}

/* Mode gelap autocomplete */

.dark .gc-suggestion-box {
    border-color: #354A62;
    background: #192438;
    box-shadow: 0 8px 20px rgba(0, 0, 0, .25);
}

.dark .gc-suggestion-heading {
    border-color: #354A62;
    background: #203149;
    color: #AFC0D4;
}

.dark .gc-suggestion-item {
    border-color: #34465F;
    background: #192438;
    color: #E1EAF5;
}

.dark .gc-suggestion-item:hover,
.dark .gc-suggestion-item:focus-visible {
    background: #263E59;
    color: #FFFFFF;
}

.dark .gc-suggestion-item svg {
    color: #AFCBEA;
}

.dark .gc-suggestion-empty {
    color: #AABBD0;
}

/* =====================================================
   BAGIAN KELAS
===================================================== */

.gc-class-section {
    margin-top: 6px;
    padding: 19px;
    border: 1px solid #D5E1ED;
    border-radius: 11px;
    background: #F8FAFC;
}

.dark .gc-class-section {
    border-color: #354962;
    background: #1C2C42;
}

.gc-class-header {
    display: flex;
    align-items: flex-start;
    gap: 11px;
    margin-bottom: 16px;
}

.gc-class-heading {
    color: #294B70;
    font-size: 13px;
    font-weight: 800;
}

.gc-class-description {
    margin-top: 5px;
    color: #526982;
    font-size: 12px;
    line-height: 1.7;
}

.dark .gc-class-heading {
    color: #EAF3FF;
}

.dark .gc-class-description {
    color: #AABBD0;
}

.gc-class-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px;
}

.gc-class-option {
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

.gc-class-option:hover {
    border-color: #A4BFDF;
    background: #F0F6FD;
}

.gc-class-option:has(input:checked) {
    border-color: #89AAD7;
    background: #E3F0FA;
    box-shadow: inset 0 0 0 1px rgba(137, 170, 215, .2);
}

.gc-checkbox {
    width: 17px;
    height: 17px;
    flex-shrink: 0;
    margin-top: 2px;
    accent-color: #3478BD;
    cursor: pointer;
}

.gc-class-name {
    color: #294B70;
    font-size: 13px;
    font-weight: 800;
    line-height: 1.5;
    overflow-wrap: anywhere;
}

.gc-class-meta {
    margin-top: 4px;
    color: #526982;
    font-size: 11px;
    font-weight: 600;
    line-height: 1.6;
}

.dark .gc-class-option {
    border-color: #40536B;
    background: #111C2E;
}

.dark .gc-class-option:hover {
    border-color: #58789D;
    background: #203149;
}

.dark .gc-class-option:has(input:checked) {
    border-color: #5799DC;
    background: #203C5B;
}

.dark .gc-class-name {
    color: #EAF3FF;
}

.dark .gc-class-meta {
    color: #AABBD0;
}

.gc-no-class {
    padding: 16px;
    border: 1px solid #F0D69D;
    border-radius: 9px;
    background: #FFF8E8;
    color: #8E6414;
    font-size: 12px;
    font-weight: 600;
    line-height: 1.7;
}

.dark .gc-no-class {
    border-color: #70592E;
    background: #3B311E;
    color: #FFDC91;
}

/* =====================================================
   ERROR VALIDASI
===================================================== */

.gc-error-box {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 15px 17px;
    border: 1px solid #F0C7CE;
    border-radius: 11px;
    background: #FFF2F3;
    color: #A93449;
}

.gc-error-icon {
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

.dark .gc-error-box {
    border-color: #704044;
    background: #3B2429;
    color: #FFB4B4;
}

.dark .gc-error-icon {
    border-color: #704044;
    background: #482A30;
    color: #FFB4B4;
}

/* =====================================================
   PEMBATAS FORM
===================================================== */

.gc-divider {
    height: 1px;
    margin: 24px 0;
    background: #E0E9F2;
}

.dark .gc-divider {
    background: #354962;
}

/* =====================================================
   AKSI FORM
===================================================== */

.gc-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
    padding-top: 2px;
}

/* =====================================================
   FOOTER
===================================================== */

.gc-footer-line {
    width: 42px;
    height: 3px;
    margin: 0 auto 12px;
    border-radius: 20px;
    background: #89AAD7;
}

.gc-footer {
    color: #73869B;
    font-size: 11px;
    font-weight: 600;
    text-align: center;
}

.dark .gc-footer {
    color: #AABBD0;
}

/* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 640px) {
    .gc-hero {
        border-radius: 14px;
    }

    .gc-hero-icon {
        width: 47px;
        height: 47px;
        border-radius: 11px;
    }

    .gc-hero-icon svg {
        width: 23px;
        height: 23px;
    }

    .gc-card-header {
        padding: 17px;
    }

    .gc-card-body {
        padding: 18px !important;
    }

    .gc-class-section {
        padding: 14px;
    }

    .gc-class-grid {
        grid-template-columns: minmax(0, 1fr);
    }

    .gc-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .gc-actions .gc-button {
        width: 100%;
    }
}

@media (prefers-reduced-motion: reduce) {
    .guru-create *,
    .guru-create *::before,
    .guru-create *::after {
        animation: none !important;
        transition: none !important;
    }
}
</style>
@endpush


@section('content')

<div class="guru-create space-y-6">

    {{-- HEADER --}}
    <section class="gc-hero gc-enter">

        <div class="flex flex-col gap-5 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-7">

            <div class="flex min-w-0 items-center gap-4">

                <div class="gc-hero-icon">

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

                    <p class="gc-hero-label mb-1">
                        Data Master
                    </p>

                    <h2 class="gc-hero-title text-xl font-extrabold sm:text-2xl">
                        Tambah Data Guru
                    </h2>

                    <p class="gc-hero-description mt-2 text-sm leading-relaxed">
                        Masukkan identitas, mata pelajaran, dan kelas yang diajar
                        untuk menambahkan guru baru ke sistem.
                    </p>

                </div>

            </div>

            <a href="{{ route('admin.guru.index') }}"
               class="gc-button gc-button-secondary flex-shrink-0">

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


    {{-- ERROR VALIDASI --}}
    @if($errors->any())

        <div class="gc-error-box gc-enter" role="alert">

            <div class="gc-error-icon">
                !
            </div>

            <div class="min-w-0 flex-1">

                <p class="mb-2 text-sm font-extrabold">
                    Periksa kembali data berikut:
                </p>

                <ul class="space-y-1 text-sm leading-6 list-disc ml-5">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    {{-- FORM TAMBAH GURU --}}
    <div class="max-w-4xl gc-enter gc-delay">

        <section class="gc-card">

            {{-- HEADER KARTU --}}
            <div class="gc-card-header">

                <div class="gc-card-icon">

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

                    <h3 class="gc-card-title text-base font-extrabold sm:text-lg">
                        Informasi Guru
                    </h3>

                    <p class="gc-card-description text-xs mt-1">
                        Lengkapi semua data yang bertanda bintang (*) dengan benar.
                    </p>

                </div>

            </div>


            {{-- FORM --}}
            <form
                id="guruCreateForm"
                action="{{ route('admin.guru.store') }}"
                method="POST"
                autocomplete="off"
                class="gc-card-body p-6 sm:p-7"
            >

                @csrf


                {{-- NIP --}}
                <div class="gc-field">

                    <label for="nip" class="gc-label">
                        NIP
                        <span class="gc-required">*</span>
                    </label>

                    <div class="gc-autocomplete">

                        <input
                            type="text"
                            id="nip"
                            name="nip"
                            value="{{ old('nip') }}"
                            placeholder="Masukkan NIP guru"
                            required
                            class="gc-input"
                            autocomplete="off"
                            autocapitalize="off"
                            spellcheck="false"
                            data-history-key="eduvia_guru_nip_history"
                            aria-autocomplete="list"
                        >

                        <div
                            class="gc-suggestion-box"
                            data-suggestions="nip"
                            role="listbox"
                            aria-label="Riwayat NIP"
                            hidden
                        ></div>

                    </div>

                    @error('nip')
                        <p class="gc-field-error">{{ $message }}</p>
                    @enderror

                </div>


                {{-- NAMA GURU --}}
                <div class="gc-field">

                    <label for="nama" class="gc-label">
                        Nama Guru
                        <span class="gc-required">*</span>
                    </label>

                    <div class="gc-autocomplete">

                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            value="{{ old('nama') }}"
                            placeholder="Masukkan nama lengkap beserta gelar"
                            required
                            class="gc-input"
                            autocomplete="off"
                            autocapitalize="words"
                            spellcheck="false"
                            data-history-key="eduvia_guru_nama_history"
                            aria-autocomplete="list"
                        >

                        <div
                            class="gc-suggestion-box"
                            data-suggestions="nama"
                            role="listbox"
                            aria-label="Riwayat nama guru"
                            hidden
                        ></div>

                    </div>

                    @error('nama')
                        <p class="gc-field-error">{{ $message }}</p>
                    @enderror

                </div>


                {{-- MATA PELAJARAN --}}
                <div class="gc-field">

                    <label for="mapel_diampu_input" class="gc-label">
                        Mata Pelajaran yang Diampu
                        <span class="gc-required">*</span>
                    </label>

                    <div class="gc-autocomplete">

                        {{-- INPUT PILIH MAPEL --}}
                        <input
                            type="text"
                            id="mapel_diampu_input"
                            value="{{ old('mapel_diampu') }}"
                            placeholder="Cari atau pilih mata pelajaran..."
                            required
                            class="gc-input"
                            autocomplete="off"
                            autocapitalize="off"
                            spellcheck="false"
                            aria-autocomplete="list"
                            aria-controls="mapelGuruSuggestions"
                        >

                        {{-- NILAI ASLI UNTUK FORM LARAVEL --}}
                        <input
                            type="hidden"
                            id="mapel_diampu"
                            name="mapel_diampu"
                            value="{{ old('mapel_diampu') }}"
                        >

                        {{-- DAFTAR SARAN MAPEL DAN RIWAYAT --}}
                        <div
                            id="mapelGuruSuggestions"
                            class="gc-suggestion-box"
                            role="listbox"
                            aria-label="Pilihan mata pelajaran"
                            hidden
                        ></div>

                    </div>

                    <p class="gc-helper">
                        <span class="gc-helper-icon">ⓘ</span>
                        Pilihan mata pelajaran diambil dari Data Mata Pelajaran. Ketik untuk mencari atau pilih dari riwayat.
                    </p>

                    @error('mapel_diampu')
                        <p class="gc-field-error">{{ $message }}</p>
                    @enderror

                </div>


                <div class="gc-divider"></div>


                {{-- KELAS YANG DIAJAR --}}
                <section class="mb-7">

                    <div class="gc-class-section">

                        <div class="gc-class-header">

                            <div class="gc-card-icon">

                                <svg fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8"
                                     viewBox="0 0 24 24"
                                     aria-hidden="true">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M3 9 12 4l9 5-9 5-9-5Z"/>

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M7 11.5V16c3.3 2.5 6.7 2.5 10 0v-4.5M21 9v6"/>
                                </svg>

                            </div>

                            <div>

                                <p class="gc-class-heading">
                                    Kelas yang Diajar
                                    <span class="gc-required">*</span>
                                </p>

                                <p class="gc-class-description">
                                    Pilih satu atau beberapa kelas yang diajar oleh guru ini.
                                    Klik kotak kelas untuk memilih atau membatalkan pilihan.
                                </p>

                            </div>

                        </div>


                        <div class="gc-class-grid">

                            @forelse($kelasList as $kelas)

                                <label class="gc-class-option">

                                    <input
                                        type="checkbox"
                                        name="kelas_ids[]"
                                        value="{{ $kelas->id }}"
                                        {{ in_array($kelas->id, old('kelas_ids', [])) ? 'checked' : '' }}
                                        class="gc-checkbox"
                                    >

                                    <div class="min-w-0">

                                        <p class="gc-class-name">
                                            {{ $kelas->nama_kelas }}
                                        </p>

                                        <p class="gc-class-meta">
                                            {{ $kelas->tingkat }} {{ $kelas->jurusan }}
                                        </p>

                                    </div>

                                </label>

                            @empty

                                <div class="gc-no-class" style="grid-column: 1 / -1;">

                                    <p class="mb-1 font-extrabold">
                                        Belum Ada Data Kelas
                                    </p>

                                    <p>
                                        Silakan tambahkan kelas terlebih dahulu melalui menu Data Kelas.
                                    </p>

                                </div>

                            @endforelse

                        </div>


                        @error('kelas_ids')
                            <p class="gc-field-error">{{ $message }}</p>
                        @enderror

                        @error('kelas_ids.*')
                            <p class="gc-field-error">{{ $message }}</p>
                        @enderror

                    </div>

                </section>


                <div class="gc-divider"></div>


                {{-- TOMBOL --}}
                <div class="gc-actions">

                    <button
                        type="submit"
                        class="gc-button gc-button-primary"
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

                        Simpan Data Guru

                    </button>

                    <a
                        href="{{ route('admin.guru.index') }}"
                        class="gc-button gc-button-secondary"
                    >

                        Batal

                    </a>

                </div>

            </form>

        </section>

    </div>


    {{-- FOOTER --}}
    <footer class="text-center pt-2 pb-3">

        <div class="gc-footer-line"></div>

        <p class="gc-footer">
            © {{ date('Y') }} Sistem Akademik Mini
        </p>

    </footer>

</div>

@endsection


{{-- =====================================================
     JAVASCRIPT RIWAYAT ISIAN GURU
===================================================== --}}

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('guruCreateForm');

    if (!form) {
        return;
    }

    // S3-07: Pulihkan tombol saat kembali melalui riwayat browser.
    const guruSubmitButton = form.querySelector('button[type="submit"]');
    const guruSubmitOriginalHTML = guruSubmitButton ? guruSubmitButton.innerHTML : '';

    window.addEventListener('pageshow', function () {
        form.dataset.s3Submitting = 'false';

        if (guruSubmitButton) {
            guruSubmitButton.removeAttribute('aria-disabled');
            guruSubmitButton.style.pointerEvents = '';
            guruSubmitButton.style.opacity = '';
            guruSubmitButton.innerHTML = guruSubmitOriginalHTML;
        }
    });
    const MAX_HISTORY = 6;

    /*
     * Ambil elemen input NIP dan Nama Guru.
     */
    const historyInputs = form.querySelectorAll(
        'input[data-history-key]'
    );

    /*
     * Ambil input pencarian mata pelajaran.
     */
    const mapelInput = document.getElementById('mapel_diampu_input');
    const mapelHidden = document.getElementById('mapel_diampu');
    const mapelDropdown = document.getElementById('mapelGuruSuggestions');
    const mapelWrapper = mapelInput?.closest('.gc-autocomplete');

    /*
     * Daftar mata pelajaran dari database Laravel.
     * Nilai tetap diambil dari $mapelList.
     */
    const mapelOptions = @json(
        $mapelList->pluck('nama_mapel')->filter()->values()
    );

    /*
     * Mengambil riwayat dari localStorage.
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
     * Menyimpan riwayat baru.
     * Riwayat terbaru berada paling atas.
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
            // Form tetap berfungsi jika penyimpanan browser tidak tersedia.
        }

    }

    /*
     * Membuat ikon riwayat.
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
     * Menampilkan dropdown.
     */
    function showDropdown(dropdown) {
        dropdown.hidden = false;
    }

    /*
     * Menutup dropdown.
     */
    function hideDropdown(dropdown) {

        dropdown.hidden = true;
        dropdown.replaceChildren();

    }

    /*
     * Membuat tombol saran.
     */
    function createSuggestionButton(value, onChoose) {

        const button = document.createElement('button');

        button.type = 'button';
        button.className = 'gc-suggestion-item';
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
     * Menampilkan riwayat NIP dan Nama Guru.
     */
    function renderHistorySuggestions(input) {

        const wrapper = input.closest('.gc-autocomplete');

        const dropdown = wrapper?.querySelector('.gc-suggestion-box');

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

        heading.className = 'gc-suggestion-heading';

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
     * Aktifkan riwayat NIP dan Nama Guru.
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
                    .closest('.gc-autocomplete')
                    ?.querySelector('.gc-suggestion-box');

                if (dropdown) {
                    hideDropdown(dropdown);
                }

            }

        });

    });


    /*
     * Menampilkan riwayat dan pilihan mata pelajaran.
     */
    function renderMapelSuggestions() {

        if (!mapelInput || !mapelDropdown) {
            return;
        }

        const keyword = mapelInput.value.trim().toLowerCase();

        const history = getHistory('eduvia_guru_mapel_history');

        /*
         * Riwayat yang masih tersedia di Data Mata Pelajaran.
         */
        const riwayatValid = history.filter(function (item) {

            return mapelOptions.some(function (mapel) {
                return mapel.toLowerCase() === item.toLowerCase();
            });

        });

        /*
         * Urutkan riwayat lebih dahulu, lalu daftar mapel lainnya.
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
         * Filter berdasarkan kata yang diketik.
         */
        const filtered = combined
            .filter(function (item) {
                return item.toLowerCase().includes(keyword);
            })
            .slice(0, 10);

        mapelDropdown.replaceChildren();

        if (filtered.length === 0) {

            const empty = document.createElement('div');

            empty.className = 'gc-suggestion-empty';

            empty.textContent = keyword
                ? 'Mata pelajaran tidak ditemukan. Coba kata kunci lain.'
                : 'Belum ada mata pelajaran yang tersedia.';

            mapelDropdown.appendChild(empty);

            showDropdown(mapelDropdown);

            return;

        }

        const heading = document.createElement('div');

        heading.className = 'gc-suggestion-heading';

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


    /*
     * Saat mata pelajaran diklik atau diketik.
     */
    if (mapelInput && mapelHidden && mapelDropdown) {

        /*
         * Cocokkan nilai awal dari old() dengan daftar database.
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

            /*
             * Input manual harus cocok dengan mata pelajaran di database.
             */
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
     * Klik di luar dropdown akan menutup saran.
     */
    document.addEventListener('click', function (event) {

        document.querySelectorAll('.gc-autocomplete').forEach(function (wrapper) {

            if (!wrapper.contains(event.target)) {

                const dropdown = wrapper.querySelector('.gc-suggestion-box');

                if (dropdown) {
                    hideDropdown(dropdown);
                }

            }

        });

    });


    /*
     * Simpan riwayat ketika form dikirim.
     */
    form.addEventListener('submit', function (event) {

        /*
         * Pastikan mata pelajaran benar-benar dipilih dari database.
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
        // S3-07: Cegah pengiriman formulir berulang.
        if (form.dataset.s3Submitting === 'true') {
            event.preventDefault();
            return;
        }

        if (event.defaultPrevented) {
            return;
        }

        form.dataset.s3Submitting = 'true';

        const submitButton = form.querySelector('button[type="submit"]');

        if (submitButton) {
            submitButton.setAttribute('aria-disabled', 'true');
            submitButton.style.pointerEvents = 'none';
            submitButton.style.opacity = '0.7';
            submitButton.innerHTML = 'Memproses...';
        }
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

});
</script>
@endpush