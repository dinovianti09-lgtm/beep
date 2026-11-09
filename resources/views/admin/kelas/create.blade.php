@extends('layouts.admin')

@section('title', 'Tambah Kelas - Sistem Akademik Mini')
@section('page-title', 'Tambah Kelas')
@section('page-subtitle', 'Data Kelas')

@push('styles')
<style>
.kelas-create {
    --kc-text: #293F57;
    --kc-border: #C9D9E9;
    --kc-input: #FFFFFF;
    --kc-input-text: #26374A;
    --kc-menu: #FFFFFF;
    --kc-option: #EDF5FD;
    --kc-option-text: #294B70;
    color: var(--kc-text);
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.kelas-create *,
.kelas-create *::before,
.kelas-create *::after {
    box-sizing: border-box;
}

.kc-enter { animation: kcEnter .35s ease-out both; }
.kc-delay { animation-delay: .08s; }

@keyframes kcEnter {
    from { opacity: 0; transform: translateY(7px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes kcMenuEnter {
    from { opacity: 0; transform: translateY(-5px); }
    to { opacity: 1; transform: translateY(0); }
}

/* HEADER */

.kc-hero {
    overflow: hidden;
    border: 1px solid #BDD6EE;
    border-radius: 17px;
    background: linear-gradient(115deg, #C3E0F4 0%, #E3F0FA 58%, #F8FAFC 100%);
    box-shadow: 0 4px 12px rgba(47, 93, 145, .06);
}

.kc-hero-icon,
.kc-card-icon,
.kc-info-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border: 1px solid #C3D8EB;
    background: #E3F0FA;
    color: #3478BD;
}

.kc-hero-icon {
    width: 58px;
    height: 58px;
    border: 1px solid #FFFFFF;
    border-radius: 15px;
    background: #FFFFFF;
}

.kc-hero-icon svg { width: 27px; height: 27px; }

.kc-hero-label {
    color: #285F96;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.kc-hero-title { color: #214A77; }
.kc-hero-description { color: #4D6886; }

.kc-back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #285F96;
    font-size: 13px;
    font-weight: 800;
    text-decoration: none;
}

.kc-back-link:hover { color: #3478BD; }

/* TOMBOL */

.kc-button {
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
    transition: transform .18s ease, background .18s ease, border-color .18s ease;
}

.kc-button svg { width: 17px; height: 17px; flex-shrink: 0; }
.kc-button:hover { transform: translateY(-1px); }

.kc-button-primary {
    border-color: #3478BD;
    background: #3478BD;
    color: #FFFFFF;
    box-shadow: 0 3px 8px rgba(52, 120, 189, .12);
}

.kc-button-primary:hover {
    border-color: #285F96;
    background: #285F96;
    color: #FFFFFF;
}

.kc-button-secondary {
    border-color: #C8DCEE;
    background: #FFFFFF;
    color: #365773;
}

.kc-button-secondary:hover {
    border-color: #A4BFDF;
    background: #E3F0FA;
    color: #285F96;
}

.kc-button:focus-visible,
.kc-back-link:focus-visible {
    outline: 3px solid rgba(52, 120, 189, .3);
    outline-offset: 3px;
}

/* ERROR */

.kc-error-box {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 15px 17px;
    border: 1px solid #F0C7CE;
    border-radius: 11px;
    background: #FFF2F3;
    color: #A93449;
    animation: kcEnter .35s ease both;
}

.kc-error-icon {
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

.kc-field-error {
    margin-top: 7px;
    color: #C13D52;
    font-size: 12px;
    font-weight: 600;
    line-height: 1.6;
}

/* CARD */

.kc-card {
    position: relative;
    z-index: 2;
    max-width: 900px;
    overflow: visible;
    border: 1px solid #D5E1ED;
    border-radius: 15px;
    background: #FFFFFF;
    box-shadow: 0 4px 12px rgba(45, 82, 124, .045);
}

.kc-card-header {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 20px 24px;
    border-bottom: 1px solid #D4E3F2;
    border-radius: 15px 15px 0 0;
    background: #F5F9FE;
}

.kc-card-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
}

.kc-card-icon svg { width: 20px; height: 20px; }
.kc-card-title { color: #214A77; }
.kc-card-description { color: #667D95; }

.kc-card-body {
    position: relative;
    overflow: visible;
    padding: 26px;
}

/* LABEL DAN INPUT */

.kc-field {
    position: relative;
    margin-bottom: 22px;
}

.kc-label {
    display: block;
    margin-bottom: 8px;
    color: #435C76;
    font-size: 12px;
    font-weight: 800;
    line-height: 1.5;
}

.kc-required { color: #D9485F; }

.kc-input {
    display: block;
    width: 100%;
    min-width: 0;
    min-height: 44px;
    padding: 10px 12px;
    border: 1px solid var(--kc-border);
    border-radius: 9px;
    background: var(--kc-input);
    color: var(--kc-input-text);
    font-family: inherit;
    font-size: 13px;
    font-weight: 500;
    line-height: 1.5;
    outline: none;
    transition: border-color .2s ease, background .2s ease, box-shadow .2s ease;
}

.kc-input::placeholder { color: #8495A8; }

.kc-input:focus {
    border-color: #438BD0;
    box-shadow: 0 0 0 3px rgba(67, 139, 208, .16);
}

/* CUSTOM DROPDOWN */

.kc-dropdown {
    position: relative;
    z-index: auto;
    width: 100%;
}

.kc-dropdown-trigger {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    width: 100%;
    text-align: left;
    cursor: pointer;
    background: #EDF5FD;
    border-color: #BDD3E8;
    color: #294B70;
}

.kc-dropdown-trigger:hover {
    border-color: #8FB5DA;
    background: #E3F0FA;
}

.kc-dropdown-trigger:focus-visible {
    border-color: #438BD0;
    outline: 3px solid rgba(67, 139, 208, .16);
    outline-offset: 1px;
}

.kc-dropdown-trigger[aria-invalid="true"] {
    border-color: #D9485F;
}

.kc-dropdown-arrow {
    width: 17px;
    height: 17px;
    flex-shrink: 0;
    color: #3478BD;
    transition: transform .18s ease;
}

.kc-dropdown-trigger[aria-expanded="true"] .kc-dropdown-arrow {
    transform: rotate(180deg);
}

/* SEMUA DROPDOWN TERBUKA KE BAWAH */

.kc-dropdown-menu {
    position: relative;
    top: auto;
    bottom: auto;
    left: auto;
    right: auto;
    z-index: 5;
    width: 100%;
    max-height: 220px;
    overflow-y: auto;
    margin-top: 7px;
    padding: 5px;
    border: 1px solid #C9DDEE;
    border-radius: 10px;
    background: var(--kc-menu);
    box-shadow: 0 8px 20px rgba(39, 77, 119, .14);
    animation: kcMenuEnter .16s ease-out;
}

.kc-dropdown-menu[hidden] { display: none !important; }

.kc-dropdown-option {
    display: flex;
    align-items: center;
    width: 100%;
    min-height: 40px;
    padding: 9px 12px;
    border: 0;
    border-radius: 7px;
    background: var(--kc-option);
    color: var(--kc-option-text);
    font-family: inherit;
    font-size: 12px;
    font-weight: 700;
    text-align: left;
    cursor: pointer;
    transition: background .15s ease, color .15s ease;
}

.kc-dropdown-option + .kc-dropdown-option { margin-top: 3px; }

.kc-dropdown-option:hover,
.kc-dropdown-option[aria-selected="true"],
.kc-dropdown-option:focus-visible {
    outline: none;
    background: #CFE5FA;
    color: #285F96;
}

/* GURU YANG SUDAH MENJADI WALI KELAS */

.kc-dropdown-option:disabled {
    opacity: 1 !important;
    background: #E8EEF5 !important;
    color: #718198 !important;
    cursor: not-allowed;
}

.kc-dropdown-error {
    margin-top: 7px;
    color: #C13D52;
    font-size: 12px;
    font-weight: 600;
}

.kc-dropdown-error[hidden] { display: none !important; }

/* PREVIEW */

.kc-preview {
    position: relative;
    margin-bottom: 25px;
    padding: 18px;
    border: 1px solid #BDD6EE;
    border-radius: 11px;
    background: #EAF4FF;
}

.kc-preview-label {
    color: #356C9F;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .07em;
    text-transform: uppercase;
}

.kc-preview-value {
    margin-top: 8px;
    color: #285F96;
    font-size: 23px;
    font-weight: 900;
    letter-spacing: -.025em;
    line-height: 1.5;
    overflow-wrap: anywhere;
}

.kc-preview-hint {
    margin-top: 5px;
    color: #627B94;
    font-size: 11px;
    line-height: 1.7;
}

/* PEMBATAS */

.kc-divider {
    height: 1px;
    margin: 25px 0;
    background: #E0E9F2;
}

/* WALI KELAS */

.kc-wali-box {
    padding: 19px;
    border: 1px solid #D5E1ED;
    border-radius: 11px;
    background: #F8FAFC;
}

.kc-wali-heading {
    color: #294B70;
    font-size: 13px;
    font-weight: 800;
}

.kc-wali-description {
    margin-top: 5px;
    color: #526982;
    font-size: 12px;
    line-height: 1.7;
}

.kc-wali-legend {
    display: flex;
    align-items: flex-start;
    gap: 9px;
    margin-top: 12px;
    color: #73869B;
    font-size: 11px;
    line-height: 1.7;
}

.kc-wali-legend-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 25px;
    height: 25px;
    flex-shrink: 0;
    border: 1px solid #C9E0FA;
    border-radius: 8px;
    background: #EAF4FF;
    color: #3478BD;
    font-weight: 800;
}

/* AKSI */

.kc-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
    padding-top: 22px;
    border-top: 1px solid #E0E9F2;
}

/* INFORMASI */

.kc-info-box {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    max-width: 900px;
    padding: 16px 18px;
    border: 1px solid #BDD6EE;
    border-radius: 11px;
    background: #EAF4FF;
}

.kc-info-icon {
    width: 36px;
    height: 36px;
    border-radius: 9px;
    background: #FFFFFF;
}

.kc-info-icon svg { width: 20px; height: 20px; }

.kc-info-title {
    color: #2D5C8B;
    font-size: 12px;
    font-weight: 800;
}

.kc-info-description {
    margin-top: 5px;
    color: #4C7197;
    font-size: 11px;
    line-height: 1.7;
}

/* FOOTER */

.kc-footer-line {
    width: 42px;
    height: 3px;
    margin: 0 auto 12px;
    border-radius: 20px;
    background: #89AAD7;
}

.kc-footer {
    color: #73869B;
    font-size: 11px;
    font-weight: 600;
    text-align: center;
}

/* DARK MODE */

.dark .kelas-create {
    --kc-text: #E4ECF6;
    --kc-border: #40536B;
    --kc-input: #111C2E;
    --kc-input-text: #E8F0FB;
    --kc-menu: #192438;
    --kc-option: #203149;
    --kc-option-text: #E8F0FB;
    color: var(--kc-text);
}

.dark .kc-hero {
    border-color: #3B5878;
    background: linear-gradient(115deg, #17283D 0%, #1C3049 55%, #243E59 100%);
    box-shadow: 0 4px 12px rgba(0, 0, 0, .14);
}

.dark .kc-hero-label { color: #C6E1FF; }
.dark .kc-hero-title { color: #F1F6FC; }
.dark .kc-hero-description { color: #C2D0E0; }

.dark .kc-hero-icon,
.dark .kc-card-icon {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

.dark .kc-back-link { color: #C6E1FF; }
.dark .kc-back-link:hover { color: #FFFFFF; }

.dark .kc-card {
    border-color: #354962;
    background: #192438;
    box-shadow: none;
}

.dark .kc-card-header {
    border-color: #354962;
    background: #1C2C42;
}

.dark .kc-card-title { color: #F1F6FC; }
.dark .kc-card-description { color: #AABBD0; }
.dark .kc-label { color: #C5D5E9; }

.dark .kc-input {
    border-color: #40536B;
    background: #111C2E;
    color: #E8F0FB;
}

.dark .kc-input::placeholder { color: #93A6BD; }

.dark .kc-input:focus {
    border-color: #5799DC;
    background: #152337;
    box-shadow: 0 0 0 3px rgba(87, 153, 220, .17);
}

.dark .kc-dropdown-trigger {
    border-color: #405773;
    background: #20364D;
    color: #E8F0FB;
}

.dark .kc-dropdown-trigger:hover {
    border-color: #648BB3;
    background: #263E59;
}

.dark .kc-dropdown-arrow { color: #C6E1FF; }

.dark .kc-dropdown-menu {
    border-color: #405773;
    background: #192438;
    box-shadow: 0 8px 20px rgba(0, 0, 0, .3);
}

.dark .kc-dropdown-option {
    background: #203149;
    color: #E8F0FB;
}

.dark .kc-dropdown-option:hover,
.dark .kc-dropdown-option[aria-selected="true"],
.dark .kc-dropdown-option:focus-visible {
    background: #345474;
    color: #FFFFFF;
}

.dark .kelas-create #wali_kelas_menu .kc-dropdown-option:disabled {
    opacity: 1 !important;
    background: #293B52 !important;
    color: #AABBD0 !important;
    cursor: not-allowed;
}

.dark .kc-dropdown-error,
.dark .kc-field-error { color: #FF9EAC; }

.dark .kc-preview {
    border-color: #365A7B;
    background: #203C57;
}

.dark .kc-preview-label { color: #B9DCFF; }
.dark .kc-preview-value { color: #E3EFFF; }
.dark .kc-preview-hint { color: #B2C9E0; }

.dark .kc-divider,
.dark .kc-actions { border-color: #354962; }

.dark .kc-wali-box {
    border-color: #354962;
    background: #1C2C42;
}

.dark .kc-wali-heading { color: #EAF3FF; }
.dark .kc-wali-description,
.dark .kc-wali-legend { color: #AABBD0; }

.dark .kc-wali-legend-icon {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

.dark .kc-button-primary {
    border-color: #557FAF;
    background: #3478BD;
    color: #FFFFFF;
}

.dark .kc-button-primary:hover { background: #285F96; }

.dark .kc-button-secondary {
    border-color: #435873;
    background: #24364D;
    color: #D5E5F8;
}

.dark .kc-button-secondary:hover { background: #2F4865; }

.dark .kc-info-box {
    border-color: #365A7B;
    background: #203C57;
}

.dark .kc-info-icon {
    border-color: #405D7B;
    background: #263E59;
    color: #D5E5F8;
}

.dark .kc-info-title { color: #C8E3FF; }
.dark .kc-info-description { color: #B4CEE8; }

.dark .kc-error-box {
    border-color: #704044;
    background: #3B2429;
    color: #FFB4B4;
}

.dark .kc-error-icon {
    border-color: #704044;
    background: #482A30;
    color: #FFB4B4;
}

.dark .kc-footer { color: #AABBD0; }

/* RESPONSIVE */

@media (max-width: 640px) {
    .kc-hero { border-radius: 14px; }
    .kc-hero-icon { width: 47px; height: 47px; border-radius: 11px; }
    .kc-hero-icon svg { width: 23px; height: 23px; }
    .kc-card-header { padding: 17px; }
    .kc-card-body { padding: 18px; }
    .kc-preview { padding: 15px; }
    .kc-preview-value { font-size: 21px; }
    .kc-wali-box { padding: 15px; }
    .kc-actions { flex-direction: column; align-items: stretch; }
    .kc-actions .kc-button { width: 100%; }
}

@media (prefers-reduced-motion: reduce) {
    .kelas-create *,
    .kelas-create *::before,
    .kelas-create *::after {
        animation: none !important;
        transition: none !important;
    }
}
</style>
@endpush

@section('content')

<div class="kelas-create space-y-6">

    {{-- HEADER --}}
    <section class="kc-hero kc-enter">
        <div class="flex items-center gap-4 p-5 sm:p-7">
            <div class="kc-hero-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                     aria-hidden="true">
                    <path d="M3 21h18"/>
                    <path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"/>
                    <path d="M9 7h1m4 0h1M9 11h1m4 0h1"/>
                </svg>
            </div>

            <div class="min-w-0">
                <p class="kc-hero-label mb-1">Data Master</p>
                <h2 class="kc-hero-title text-xl font-extrabold sm:text-2xl">
                    Tambah Kelas Baru
                </h2>
                <p class="kc-hero-description mt-2 text-sm leading-relaxed">
                    Buat data kelas berdasarkan tingkat, jurusan, nomor kelas,
                    dan penugasan wali kelas.
                </p>
            </div>
        </div>
    </section>

    {{-- KEMBALI --}}
    <div>
        <a href="{{ route('admin.kelas.index') }}" class="kc-back-link">
            <svg viewBox="0 0 24 24" width="17" height="17" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round"
                 stroke-linejoin="round" aria-hidden="true">
                <path d="m15 18-6-6 6-6"/>
                <path d="M9 12h12"/>
            </svg>
            Kembali ke Data Kelas
        </a>
    </div>

    {{-- ERROR --}}
    @if($errors->any())
        <div class="kc-error-box kc-enter" role="alert">
            <div class="kc-error-icon">!</div>
            <div class="min-w-0 flex-1">
                <p class="mb-2 text-sm font-extrabold">Data Belum Bisa Disimpan</p>
                <ul class="ml-5 list-disc space-y-1 text-sm leading-6">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- FORM CARD --}}
    <div class="max-w-4xl kc-enter kc-delay">
        <section class="kc-card">

            <div class="kc-card-header">
                <div class="kc-card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                         aria-hidden="true">
                        <path d="M3 21h18"/>
                        <path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"/>
                        <path d="M9 7h1m4 0h1M9 11h1m4 0h1"/>
                    </svg>
                </div>
                <div>
                    <h3 class="kc-card-title text-base font-extrabold sm:text-lg">
                        Informasi Kelas
                    </h3>
                    <p class="kc-card-description mt-1 text-xs">
                        Lengkapi tingkat, jurusan, nomor kelas, dan wali kelas.
                    </p>
                </div>
            </div>

            <form id="formTambahKelas"
                  action="{{ route('admin.kelas.store') }}"
                  method="POST"
                  autocomplete="off">
                @csrf

                <div class="kc-card-body">

                    {{-- PREVIEW --}}
                    <div class="kc-preview">
                        <p class="kc-preview-label">Pratinjau Nama Kelas</p>
                        <p id="preview-kelas" class="kc-preview-value">
                            Pilih tingkat, jurusan, dan nomor kelas
                        </p>
                        <p class="kc-preview-hint">
                            Nama kelas akan mengikuti pilihan yang kamu tentukan di bawah.
                        </p>
                    </div>

                    {{-- TINGKAT DAN JURUSAN --}}
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        <div class="kc-field">
                            <label class="kc-label" for="tingkat_display">
                                Tingkat <span class="kc-required">*</span>
                            </label>

                            <div class="kc-dropdown" data-kc-dropdown>
                                <input type="hidden" id="tingkat" name="tingkat"
                                       value="{{ old('tingkat') }}">

                                <button type="button" id="tingkat_display"
                                        class="kc-input kc-dropdown-trigger"
                                        aria-haspopup="listbox" aria-expanded="false"
                                        aria-controls="tingkat_menu">
                                    <span data-kc-label>-- Pilih Tingkat --</span>
                                    <svg class="kc-dropdown-arrow" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6"/>
                                    </svg>
                                </button>

                                <div id="tingkat_menu" class="kc-dropdown-menu"
                                     role="listbox" aria-label="Pilih tingkat" hidden>
                                    <button type="button" class="kc-dropdown-option" data-value="X">
                                        X (Kelas 10)
                                    </button>
                                    <button type="button" class="kc-dropdown-option" data-value="XI">
                                        XI (Kelas 11)
                                    </button>
                                    <button type="button" class="kc-dropdown-option" data-value="XII">
                                        XII (Kelas 12)
                                    </button>
                                </div>
                            </div>

                            <p class="kc-dropdown-error" data-kc-error hidden>
                                Silakan pilih tingkat terlebih dahulu.
                            </p>

                            @error('tingkat')
                                <p class="kc-field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="kc-field">
                            <label class="kc-label" for="jurusan_display">
                                Jurusan <span class="kc-required">*</span>
                            </label>

                            <div class="kc-dropdown" data-kc-dropdown>
                                <input type="hidden" id="jurusan" name="jurusan"
                                       value="{{ old('jurusan') }}">

                                <button type="button" id="jurusan_display"
                                        class="kc-input kc-dropdown-trigger"
                                        aria-haspopup="listbox" aria-expanded="false"
                                        aria-controls="jurusan_menu">
                                    <span data-kc-label>-- Pilih Jurusan --</span>
                                    <svg class="kc-dropdown-arrow" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6"/>
                                    </svg>
                                </button>

                                <div id="jurusan_menu" class="kc-dropdown-menu"
                                     role="listbox" aria-label="Pilih jurusan" hidden>
                                    <button type="button" class="kc-dropdown-option" data-value="RPL">RPL</button>
                                    <button type="button" class="kc-dropdown-option" data-value="DKV">DKV</button>
                                    <button type="button" class="kc-dropdown-option" data-value="BR">BR</button>
                                </div>
                            </div>

                            <p class="kc-dropdown-error" data-kc-error hidden>
                                Silakan pilih jurusan terlebih dahulu.
                            </p>

                            @error('jurusan')
                                <p class="kc-field-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- NOMOR KELAS --}}
                    <div class="kc-field">
                        <label class="kc-label" for="nomor_kelas_display">
                            Nomor Kelas <span class="kc-required">*</span>
                        </label>

                        <div class="kc-dropdown" data-kc-dropdown>
                            <input type="hidden" id="nomor_kelas" name="nomor_kelas"
                                   value="{{ old('nomor_kelas') }}">

                            <button type="button" id="nomor_kelas_display"
                                    class="kc-input kc-dropdown-trigger"
                                    aria-haspopup="listbox" aria-expanded="false"
                                    aria-controls="nomor_kelas_menu">
                                <span data-kc-label>-- Pilih Nomor Kelas --</span>
                                <svg class="kc-dropdown-arrow" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6"/>
                                </svg>
                            </button>

                            <div id="nomor_kelas_menu" class="kc-dropdown-menu"
                                 role="listbox" aria-label="Pilih nomor kelas" hidden>
                                @for($i = 1; $i <= 10; $i++)
                                    <button type="button" class="kc-dropdown-option"
                                            data-value="{{ $i }}">
                                        Kelas {{ $i }}
                                    </button>
                                @endfor
                            </div>
                        </div>

                        <p class="kc-dropdown-error" data-kc-error hidden>
                            Silakan pilih nomor kelas terlebih dahulu.
                        </p>

                        @error('nomor_kelas')
                            <p class="kc-field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="kc-divider"></div>

                    {{-- PENUGASAN WALI KELAS --}}
                    <section class="kc-wali-box">
                        <div class="flex items-start gap-3">
                            <div class="kc-card-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="1.8" stroke-linecap="round"
                                     stroke-linejoin="round" aria-hidden="true">
                                    <path d="m3 10 9-7 9 7"/>
                                    <path d="M5 9v11h14V9"/>
                                    <path d="M9 20v-6h6v6"/>
                                </svg>
                            </div>

                            <div class="min-w-0 flex-1">
                                <h3 class="kc-wali-heading">Penugasan Wali Kelas</h3>
                                <p class="kc-wali-description">
                                    Pilih guru yang akan menjadi wali kelas.
                                </p>
                            </div>
                        </div>

                        <div class="mt-5">
                            <label for="wali_kelas_display" class="kc-label">
                                Wali Kelas
                            </label>

                            <div class="kc-dropdown" data-kc-dropdown>
                                <input type="hidden" id="wali_kelas" name="wali_kelas"
                                       value="{{ old('wali_kelas') }}">

                                <button type="button" id="wali_kelas_display"
                                        class="kc-input kc-dropdown-trigger"
                                        aria-haspopup="listbox" aria-expanded="false"
                                        aria-controls="wali_kelas_menu">
                                    <span data-kc-label>-- Belum ada wali kelas --</span>
                                    <svg class="kc-dropdown-arrow" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6"/>
                                    </svg>
                                </button>

                                {{-- HANYA DAFTAR GURU, TANPA PILIHAN KOSONG --}}
                                <div id="wali_kelas_menu" class="kc-dropdown-menu"
                                     role="listbox" aria-label="Pilih wali kelas" hidden>

                                    @foreach($guruList as $guru)
                                        @php
                                            $kelasDipakai = $guru->kelas_wali_dipakai;
                                            $sudahDipakai = $kelasDipakai !== null;
                                        @endphp

                                        <button type="button"
                                                class="kc-dropdown-option"
                                                data-value="{{ $guru->nama_guru }}"
                                                @disabled($sudahDipakai)>
                                            {{ $guru->nama_guru }}

                                            @if($sudahDipakai)
                                                — Sudah menjadi wali kelas {{ $kelasDipakai->nama_kelas }}
                                            @else
                                                — Belum menjadi wali kelas
                                            @endif
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <div class="kc-wali-legend">
                                <div class="kc-wali-legend-icon">i</div>
                                <p>
                                    Guru yang sudah menjadi wali kelas di kelas lain
                                    tidak dapat dipilih kembali berdasarkan daftar yang tersedia.
                                </p>
                            </div>

                            @error('wali_kelas')
                                <p class="kc-field-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </section>

                    {{-- TOMBOL --}}
                    <div class="kc-actions">
                        <button type="submit" class="kc-button kc-button-primary">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path d="m5 12 4 4L19 6"/>
                            </svg>
                            Simpan Kelas
                        </button>

                        <a href="{{ route('admin.kelas.index') }}"
                           class="kc-button kc-button-secondary">
                            Batal
                        </a>
                    </div>

                </div>
            </form>
        </section>
    </div>

    {{-- INFORMASI --}}
    <section class="kc-info-box">
        <div class="kc-info-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="9"/>
                <path d="M12 11v5"/>
                <path d="M12 8h.01"/>
            </svg>
        </div>

        <div>
            <p class="kc-info-title">Informasi</p>
            <p class="kc-info-description">
                Nama kelas ditampilkan otomatis berdasarkan tingkat, jurusan,
                dan nomor kelas. Periksa hasil pratinjau sebelum menyimpan.
            </p>
        </div>
    </section>

    <footer class="pb-3 pt-2 text-center">
        <div class="kc-footer-line"></div>
        <p class="kc-footer">© {{ date('Y') }} Sistem Akademik Mini</p>
    </footer>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formTambahKelas');
    const preview = document.getElementById('preview-kelas');

    const requiredFields = ['tingkat', 'jurusan', 'nomor_kelas'];

    const dropdowns = Array.from(document.querySelectorAll(
        '.kelas-create [data-kc-dropdown]'
    ));

    if (!form || !preview || dropdowns.length !== 4) return;

    function closeAllDropdowns(except = null) {
        dropdowns.forEach(function (dropdown) {
            if (dropdown === except) return;

            const trigger = dropdown.querySelector('.kc-dropdown-trigger');
            const menu = dropdown.querySelector('.kc-dropdown-menu');

            menu.hidden = true;
            trigger.setAttribute('aria-expanded', 'false');
        });
    }

    function updatePreview() {
        const tingkat = document.getElementById('tingkat').value;
        const jurusan = document.getElementById('jurusan').value;
        const nomor = document.getElementById('nomor_kelas').value;

        preview.textContent = tingkat && jurusan && nomor
            ? tingkat + ' ' + jurusan + ' ' + nomor
            : 'Pilih tingkat, jurusan, dan nomor kelas';
    }

    dropdowns.forEach(function (dropdown) {
        const hiddenInput = dropdown.querySelector('input[type="hidden"]');
        const trigger = dropdown.querySelector('.kc-dropdown-trigger');
        const label = dropdown.querySelector('[data-kc-label]');
        const menu = dropdown.querySelector('.kc-dropdown-menu');
        const options = Array.from(menu.querySelectorAll('.kc-dropdown-option'));
        const error = dropdown.parentElement.querySelector('[data-kc-error]');

        function closeMenu() {
            menu.hidden = true;
            trigger.setAttribute('aria-expanded', 'false');
        }

        function openMenu() {
            closeAllDropdowns(dropdown);
            menu.hidden = false;
            trigger.setAttribute('aria-expanded', 'true');
        }

        function chooseOption(option) {
            if (option.disabled) return;

            hiddenInput.value = option.dataset.value;
            label.textContent = option.textContent.trim();

            options.forEach(function (item) {
                item.setAttribute('aria-selected', 'false');
            });

            option.setAttribute('aria-selected', 'true');
            trigger.setAttribute('aria-invalid', 'false');

            if (error) error.hidden = true;

            closeMenu();
            updatePreview();
        }

        if (hiddenInput.value !== '') {
            const selectedOption = options.find(function (option) {
                return String(option.dataset.value) === String(hiddenInput.value);
            });

            if (selectedOption) {
                label.textContent = selectedOption.textContent.trim();
                selectedOption.setAttribute('aria-selected', 'true');
            }
        }

        trigger.addEventListener('click', function () {
            if (menu.hidden) {
                openMenu();
            } else {
                closeMenu();
            }
        });

        trigger.addEventListener('keydown', function (event) {
            if (event.key === 'ArrowDown' || event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                openMenu();

                const firstEnabled = options.find(option => !option.disabled);
                firstEnabled?.focus();
            }

            if (event.key === 'Escape') closeMenu();
        });

        options.forEach(function (option, index) {
            option.addEventListener('click', function () {
                chooseOption(option);
            });

            option.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closeMenu();
                    trigger.focus();
                }

                if (event.key === 'ArrowDown') {
                    event.preventDefault();

                    for (let i = index + 1; i < options.length; i++) {
                        if (!options[i].disabled) {
                            options[i].focus();
                            break;
                        }
                    }
                }

                if (event.key === 'ArrowUp') {
                    event.preventDefault();

                    for (let i = index - 1; i >= 0; i--) {
                        if (!options[i].disabled) {
                            options[i].focus();
                            break;
                        }
                    }
                }
            });
        });
    });

    document.addEventListener('click', function (event) {
        if (!event.target.closest('.kelas-create [data-kc-dropdown]')) {
            closeAllDropdowns();
        }
    });

    form.addEventListener('submit', function (event) {
        for (const id of requiredFields) {
            const input = document.getElementById(id);

            if (!input.value) {
                event.preventDefault();

                const dropdown = input.closest('[data-kc-dropdown]');
                const trigger = dropdown.querySelector('.kc-dropdown-trigger');
                const menu = dropdown.querySelector('.kc-dropdown-menu');
                const error = dropdown.parentElement.querySelector('[data-kc-error]');

                closeAllDropdowns(dropdown);

                menu.hidden = false;
                trigger.setAttribute('aria-expanded', 'true');
                trigger.setAttribute('aria-invalid', 'true');

                if (error) error.hidden = false;

                trigger.focus();
                return;
            }
        }
    });

    // S3-07 ANTI DOUBLE CLICK TAMBAH KELAS
    const submitButton = form.querySelector('button[type="submit"]');
    const originalButtonHTML = submitButton ? submitButton.innerHTML : '';

    form.addEventListener('submit', function (event) {
        if (event.defaultPrevented) return;

        if (form.dataset.s3Submitting === 'true') {
            event.preventDefault();
            return;
        }

        form.dataset.s3Submitting = 'true';

        if (submitButton) {
            submitButton.setAttribute('aria-disabled', 'true');
            submitButton.style.pointerEvents = 'none';
            submitButton.style.opacity = '0.7';
            submitButton.innerHTML = 'Memproses...';
        }
    });

    window.addEventListener('pageshow', function () {
        form.dataset.s3Submitting = 'false';

        if (submitButton) {
            submitButton.removeAttribute('aria-disabled');
            submitButton.style.pointerEvents = '';
            submitButton.style.opacity = '';
            submitButton.innerHTML = originalButtonHTML;
        }
    });

    updatePreview();
});
</script>
@endpush
