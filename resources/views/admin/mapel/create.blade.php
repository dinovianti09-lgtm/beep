@extends('layouts.admin')

@section('title', 'Tambah Mata Pelajaran - Sistem Akademik Mini')
@section('page-title', 'Tambah Mata Pelajaran')
@section('page-subtitle', 'Tambahkan mata pelajaran dan atur kelas yang menggunakannya')

@push('styles')
<style>
/* =====================================================
   EDUVIA - TAMBAH MATA PELAJARAN
   Pastel Blue + Dark Navy
===================================================== */

.mapel-create {
    --mc-blue: #3478BD;
    --mc-blue-dark: #285F96;
    --mc-text: #293F57;
    --mc-muted: #526982;
    --mc-border: #D5E1ED;
    --mc-card: #FFFFFF;

    color: var(--mc-text);
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.dark .mapel-create {
    --mc-text: #E4ECF6;
    --mc-muted: #AABBD0;
    --mc-border: #354A62;
    --mc-card: #192438;
}

.mapel-create *,
.mapel-create *::before,
.mapel-create *::after {
    box-sizing: border-box;
}

/* =====================================================
   ANIMASI
===================================================== */

.mc-enter {
    animation: mcEnter .35s ease-out both;
}

.mc-delay {
    animation-delay: .08s;
}

@keyframes mcEnter {
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

.mc-hero {
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

.mc-hero::before,
.mc-hero::after {
    display: none !important;
    content: none !important;
}

.mc-hero-icon {
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

.mc-hero-title {
    color: #214A77;
}

.mc-hero-description {
    color: #4D6886;
}

.dark .mc-hero {
    background: linear-gradient(
        115deg,
        #17283D 0%,
        #1C3049 55%,
        #243E59 100%
    );
    border-color: #3B5878;
    box-shadow: 0 4px 12px rgba(0, 0, 0, .14);
}

.dark .mc-hero-title {
    color: #F1F6FC;
}

.dark .mc-hero-description {
    color: #C2D0E0;
}

.dark .mc-hero-icon {
    background: #263E59;
    color: #D8E9FC;
    border-color: #405B78;
}

/* =====================================================
   TOMBOL
===================================================== */

.mc-btn {
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
    cursor: pointer;
    white-space: nowrap;
    transition:
        transform .18s ease,
        box-shadow .18s ease,
        background .18s ease,
        border-color .18s ease,
        color .18s ease;
}

.mc-btn:hover {
    transform: translateY(-1px);
}

.mc-btn:active {
    transform: translateY(0);
}

.mc-btn:focus-visible {
    outline: 3px solid rgba(52, 120, 189, .3);
    outline-offset: 3px;
}

.mc-btn-primary {
    color: #FFFFFF;
    background: #3478BD;
    border-color: #3478BD;
    box-shadow: 0 3px 8px rgba(52, 120, 189, .12);
}

.mc-btn-primary:hover {
    color: #FFFFFF;
    background: #285F96;
    border-color: #285F96;
}

.mc-btn-secondary {
    color: #365773;
    background: #FFFFFF;
    border-color: #C8DCEE;
}

.mc-btn-secondary:hover {
    color: #285F96;
    background: #E3F0FA;
    border-color: #A4BFDF;
}

.dark .mc-btn-primary {
    color: #FFFFFF;
    background: #3478BD;
    border-color: #557FAF;
}

.dark .mc-btn-primary:hover {
    background: #285F96;
}

.dark .mc-btn-secondary {
    color: #D5E5F8;
    background: #24364D;
    border-color: #435873;
}

.dark .mc-btn-secondary:hover {
    color: #FFFFFF;
    background: #2F4865;
}

/* =====================================================
   KARTU FORM
===================================================== */

.mc-form-card {
    overflow: hidden;
    background: #FFFFFF;
    border: 1px solid #D5E1ED;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(45, 82, 124, .045);
}

.dark .mc-form-card {
    background: #192438;
    border-color: #354962;
    box-shadow: none;
}

.mc-form-header {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 20px 24px;
    background: #F5F9FE;
    border-bottom: 1px solid #D4E3F2;
}

.dark .mc-form-header {
    background: #1C2C42;
    border-color: #354962;
}

.mc-section-icon {
    display: flex;
    flex-shrink: 0;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border: 1px solid #C3D8EB;
    border-radius: 10px;
    color: #3478BD;
    background: #E3F0FA;
}

.dark .mc-section-icon {
    color: #D8E9FC;
    background: #263E59;
    border-color: #405B78;
}

.mc-form-title {
    color: #214A77;
}

.mc-form-description {
    color: #667D95;
}

.dark .mc-form-title {
    color: #F1F6FC;
}

.dark .mc-form-description {
    color: #AABBD0;
}

/* =====================================================
   LABEL DAN INPUT
===================================================== */

.mc-label {
    display: block;
    margin-bottom: 8px;
    color: #435C76;
    font-size: 12px;
    font-weight: 800;
    line-height: 1.5;
}

.dark .mc-label {
    color: #C5D5E9;
}

.mc-required {
    color: #D9485F;
}

.mc-input {
    display: block;
    width: 100%;
    min-width: 0;
    min-height: 44px;
    padding: 10px 12px;
    border: 1px solid #C9D9E9;
    border-radius: 9px;
    background: #FFFFFF;
    color: #26374A;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    line-height: 1.5;
    transition:
        border-color .2s ease,
        box-shadow .2s ease,
        background .2s ease;
}

.mc-input::placeholder {
    color: #8495A8;
}

.mc-input:focus {
    outline: none;
    border-color: #438BD0;
    box-shadow: 0 0 0 3px rgba(67, 139, 208, .16);
}

.dark .mc-input {
    background: #111C2E;
    color: #E8F0FB;
    border-color: #40536B;
}

.dark .mc-input:focus {
    border-color: #5799DC;
    box-shadow: 0 0 0 3px rgba(87, 153, 220, .17);
}

/* =====================================================
   IKON NAMA MAPEL
   Sama seperti mapel-subject-icon di halaman Index
===================================================== */

.mc-name-input-wrapper {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
}

.mc-name-input-icon {
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

.mc-name-input-icon svg {
    width: 20px;
    height: 20px;
}

.mc-name-input-wrapper .mc-input {
    flex: 1;
    min-width: 0;
    border-radius: 9px;
}

.dark .mc-name-input-icon {
    background: #263E59;
    border-color: #405773;
    color: #C6E2FF;
}

/* =====================================================
   PETUNJUK DAN ERROR INPUT
===================================================== */

.mc-help {
    color: #73869B;
    font-size: 11px;
    line-height: 1.65;
}

.dark .mc-help {
    color: #A4B5CA;
}

.mc-field-error {
    margin-top: 7px;
    color: #C13D52;
    font-size: 12px;
    font-weight: 600;
}

.dark .mc-field-error {
    color: #FF9EAC;
}

/* =====================================================
   PILIHAN JURUSAN DAN TINGKAT KELAS
===================================================== */

.mc-choice-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 10px;
}

.mc-choice {
    display: flex;
    align-items: center;
    gap: 11px;
    min-height: 48px;
    padding: 10px 13px;
    border: 1px solid #D5E1ED;
    border-radius: 9px;
    background: #F8FAFC;
    cursor: pointer;
    transition:
        border-color .18s ease,
        background .18s ease,
        box-shadow .18s ease;
}

.mc-choice:hover {
    background: #EAF3FC;
    border-color: #A4BFDF;
}

.mc-choice:has(input:checked) {
    background: #E3F0FA;
    border-color: #89AAD7;
    box-shadow: inset 0 0 0 1px rgba(137, 170, 215, .2);
}

.mc-choice input {
    width: 17px;
    height: 17px;
    flex-shrink: 0;
    accent-color: #3478BD;
    cursor: pointer;
}

.mc-choice-text {
    color: #3D526A;
    font-size: 12px;
    font-weight: 700;
    line-height: 1.5;
}

.mc-choice:has(input:checked) .mc-choice-text {
    color: #285F96;
}

/* Mode gelap pilihan */

.dark .mc-choice {
    background: #202F45;
    border-color: #40536B;
}

.dark .mc-choice:hover {
    background: #263B54;
    border-color: #597DA4;
}

.dark .mc-choice:has(input:checked) {
    background: #263E59;
    border-color: #639BD0;
}

.dark .mc-choice-text {
    color: #DCEBFC;
}

.dark .mc-choice:has(input:checked) .mc-choice-text {
    color: #FFFFFF;
}

/* =====================================================
   INFORMASI PENGATURAN
===================================================== */

.mc-info {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 15px;
    border: 1px solid #C3D8EB;
    border-radius: 10px;
    background: #F0F7FD;
}

.mc-info-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    width: 36px;
    height: 36px;
    border: 1px solid #C3D8EB;
    border-radius: 9px;
    color: #285F96;
    background: #FFFFFF;
}

.mc-info-title {
    color: #285783;
}

.mc-info-text {
    color: #506D8B;
}

.dark .mc-info {
    border-color: #385572;
    background: #20364F;
}

.dark .mc-info-icon {
    color: #D8E9FC;
    background: #263E59;
    border-color: #405B78;
}

.dark .mc-info-title {
    color: #D2E8FF;
}

.dark .mc-info-text {
    color: #B3C9E0;
}

/* =====================================================
   NOTIFIKASI VALIDASI
===================================================== */

.mc-error-box {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 15px 17px;
    border: 1px solid #F0C7CE;
    border-radius: 11px;
    background: #FFF2F3;
    color: #A93449;
}

.mc-error-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    width: 36px;
    height: 36px;
    border: 1px solid #F0C7CE;
    border-radius: 9px;
    background: #FFFFFF;
}

.dark .mc-error-box {
    color: #FFC5CE;
    background: #3D2630;
    border-color: #70404D;
}

.dark .mc-error-icon {
    background: #482A32;
    border-color: #70404D;
}

/* =====================================================
   AKSI FORM
===================================================== */

.mc-form-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
    padding-top: 22px;
    border-top: 1px solid #E0E9F2;
}

.dark .mc-form-actions {
    border-color: #354962;
}

/* =====================================================
   FOOTER
===================================================== */

.mc-footer-line {
    width: 42px;
    height: 3px;
    margin: 0 auto 12px;
    border-radius: 20px;
    background: #89AAD7;
}

/* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 900px) {
    .mc-choice-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 640px) {
    .mc-hero {
        border-radius: 14px;
    }

    .mc-hero-icon {
        width: 47px;
        height: 47px;
        border-radius: 11px;
    }

    .mc-hero-icon svg {
        width: 23px;
        height: 23px;
    }

    .mc-form-header {
        padding: 17px;
    }

    .mc-form-body {
        padding: 18px !important;
    }

    .mc-choice-grid {
        grid-template-columns: minmax(0, 1fr);
    }

    .mc-form-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .mc-form-actions .mc-btn {
        width: 100%;
    }
}

@media (prefers-reduced-motion: reduce) {
    .mapel-create *,
    .mapel-create *::before,
    .mapel-create *::after {
        animation: none !important;
        transition: none !important;
    }
}
</style>
@endpush


@section('content')

<div class="mapel-create space-y-6">

    {{-- HEADER --}}
    <section class="mc-hero mc-enter">

        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5 p-5 sm:p-7">

            <div class="flex items-center gap-4 min-w-0">

                <div class="mc-hero-icon">

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

                    <p class="text-xs font-extrabold tracking-widest text-blue-700 dark:text-blue-300 uppercase mb-1">
                        Data Master
                    </p>

                    <h1 class="mc-hero-title text-xl sm:text-2xl font-extrabold">
                        Tambah Mata Pelajaran
                    </h1>

                    <p class="mc-hero-description text-sm mt-2 leading-relaxed">
                        Atur mata pelajaran sesuai jurusan dan tingkat kelas.
                    </p>

                </div>

            </div>

            <a href="{{ route('admin.mapel.index') }}"
               class="mc-btn mc-btn-secondary flex-shrink-0">

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

        <div class="mc-error-box mc-enter">

            <div class="mc-error-icon">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24"
                     aria-hidden="true">
                    <circle cx="12" cy="12" r="9"/>
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 8v4m0 4h.01"/>
                </svg>

            </div>

            <div>

                <p class="font-extrabold text-sm mb-2">
                    Periksa kembali data berikut:
                </p>

                <ul class="text-sm space-y-1 list-disc ml-5">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    {{-- FORM TAMBAH MAPEL --}}
    <div class="max-w-4xl mc-enter mc-delay">

        <section class="mc-form-card">

            {{-- HEADER KARTU --}}
            <div class="mc-form-header">

                <div class="mc-section-icon">

                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 6.253C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"/>
                    </svg>

                </div>

                <div>

                    <h2 class="mc-form-title text-base sm:text-lg font-extrabold">
                        Informasi Mata Pelajaran
                    </h2>

                    <p class="mc-form-description text-sm mt-1 leading-relaxed">
                        Lengkapi informasi dan tentukan jurusan serta tingkat kelas.
                    </p>

                </div>

            </div>


            {{-- FORM --}}
            <form
                action="{{ route('admin.mapel.store') }}"
                method="POST"
                autocomplete="off"
                class="mc-form-body p-6 sm:p-7 space-y-7"
            >

                @csrf


                {{-- NAMA MATA PELAJARAN --}}
                <div>

                    <label for="nama_mapel" class="mc-label">
                        Nama Mata Pelajaran
                        <span class="mc-required">*</span>
                    </label>

                    <div class="mc-name-input-wrapper">

                        <div class="mc-name-input-icon">

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

                        <input
                            type="text"
                            id="nama_mapel"
                            name="nama_mapel"
                            value="{{ old('nama_mapel') }}"
                            required
                            maxlength="100"
                            placeholder="Contoh: Pemrograman Web"
                            class="mc-input"
                            autocomplete="off"
                            autocapitalize="off"
                            spellcheck="false"
                        >

                    </div>

                    @error('nama_mapel')
                        <p class="mc-field-error">{{ $message }}</p>
                    @enderror

                    <p class="mc-help mt-2">
                        Masukkan nama mata pelajaran sesuai kurikulum sekolah.
                    </p>

                </div>


                {{-- KKM --}}
                <div>

                    <label for="kkm" class="mc-label">
                        Kriteria Ketuntasan Minimal (KKM)
                        <span class="mc-required">*</span>
                    </label>

                    <div class="max-w-xs">

                        <input
                            type="number"
                            id="kkm"
                            name="kkm"
                            value="{{ old('kkm', 75) }}"
                            required
                            min="0"
                            max="100"
                            placeholder="75"
                            class="mc-input"
                        >

                    </div>

                    @error('kkm')
                        <p class="mc-field-error">{{ $message }}</p>
                    @enderror

                    <p class="mc-help mt-2">
                        Masukkan KKM antara 0 sampai 100.
                    </p>

                </div>


                {{-- PEMBATAS --}}
                <div class="border-t border-slate-200 dark:border-slate-700"></div>


                {{-- PILIH JURUSAN --}}
                <section>

                    <div class="mb-4">

                        <h3 class="mc-label mb-1">
                            Pilih Jurusan
                            <span class="mc-required">*</span>
                        </h3>

                        <p class="mc-help">
                            Pilih satu atau beberapa jurusan yang menggunakan mata pelajaran ini.
                        </p>

                    </div>

                    <div class="mc-choice-grid">

                        @foreach($jurusanList as $jurusan)

                            <label class="mc-choice">

                                <input
                                    type="checkbox"
                                    name="jurusan[]"
                                    value="{{ $jurusan }}"
                                    {{ in_array($jurusan, (array) old('jurusan', []), true) ? 'checked' : '' }}
                                >

                                <span class="mc-choice-text">
                                    {{ $jurusan }}
                                </span>

                            </label>

                        @endforeach

                    </div>

                    @error('jurusan')
                        <p class="mc-field-error">{{ $message }}</p>
                    @enderror

                    @error('jurusan.*')
                        <p class="mc-field-error">{{ $message }}</p>
                    @enderror

                </section>


                {{-- PILIH TINGKAT KELAS --}}
                <section>

                    <div class="mb-4">

                        <h3 class="mc-label mb-1">
                            Pilih Tingkat Kelas
                            <span class="mc-required">*</span>
                        </h3>

                        <p class="mc-help">
                            Pilih tingkat kelas yang menggunakan mata pelajaran ini.
                        </p>

                    </div>

                    <div class="mc-choice-grid">

                        @foreach($tingkatList as $tingkat)

                            <label class="mc-choice">

                                <input
                                    type="checkbox"
                                    name="tingkat[]"
                                    value="{{ $tingkat }}"
                                    {{ in_array($tingkat, (array) old('tingkat', []), true) ? 'checked' : '' }}
                                >

                                <span class="mc-choice-text">
                                    Kelas {{ $tingkat }}
                                </span>

                            </label>

                        @endforeach

                    </div>

                    @error('tingkat')
                        <p class="mc-field-error">{{ $message }}</p>
                    @enderror

                    @error('tingkat.*')
                        <p class="mc-field-error">{{ $message }}</p>
                    @enderror

                </section>


                {{-- INFORMASI PENGATURAN --}}
                <div class="mc-info">

                    <div class="mc-info-icon">

                        <svg class="w-5 h-5"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             viewBox="0 0 24 24"
                             aria-hidden="true">
                            <circle cx="12" cy="12" r="9"/>
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 11v5m0-8h.01"/>
                        </svg>

                    </div>

                    <div>

                        <p class="mc-info-title text-sm font-extrabold">
                            Informasi Pengaturan
                        </p>

                        <p class="mc-info-text text-xs mt-2 leading-relaxed">
                            Sistem akan menghubungkan mata pelajaran ke kombinasi jurusan dan tingkat yang dipilih. Pastikan pilihan sesuai dengan kurikulum sekolah.
                        </p>

                    </div>

                </div>


                {{-- TOMBOL SIMPAN DAN BATAL --}}
                <div class="mc-form-actions">

                    <button type="submit" class="mc-btn mc-btn-primary">

                        <svg class="w-5 h-5"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             viewBox="0 0 24 24"
                             aria-hidden="true">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M5 13l4 4L19 7"/>
                        </svg>

                        Simpan Mata Pelajaran

                    </button>

                    <a
                        href="{{ route('admin.mapel.index') }}"
                        class="mc-btn mc-btn-secondary"
                    >
                        Batal
                    </a>

                </div>

            </form>

        </section>

    </div>


    {{-- FOOTER --}}
    <footer class="text-center pt-2 pb-3">

        <div class="mc-footer-line"></div>

        <p class="mc-help font-semibold">
            © {{ date('Y') }} Sistem Akademik Mini
        </p>

    </footer>

</div>


{{-- S3-07 ANTI DOUBLE CLICK TAMBAH MAPEL --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector(
        'form[action="{{ route('admin.mapel.store') }}"]'
    );

    if (!form) return;

    const button = form.querySelector('button[type="submit"]');
    if (!button) return;

    const originalHTML = button.innerHTML;

    form.addEventListener('submit', function (event) {
        if (event.defaultPrevented) return;

        if (form.dataset.s3Submitting === 'true') {
            event.preventDefault();
            return;
        }

        form.dataset.s3Submitting = 'true';
        button.setAttribute('aria-disabled', 'true');
        button.style.pointerEvents = 'none';
        button.style.opacity = '0.7';
        button.innerHTML = 'Memproses...';
    });

    window.addEventListener('pageshow', function () {
        form.dataset.s3Submitting = 'false';
        button.removeAttribute('aria-disabled');
        button.style.pointerEvents = '';
        button.style.opacity = '';
        button.innerHTML = originalHTML;
    });
});
</script>
@endpush
@endsection