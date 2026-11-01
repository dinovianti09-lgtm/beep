@extends('layouts.admin')

@section('title', 'Tambah Data Siswa - Sistem Akademik Mini')
@section('page-title', 'Tambah Data Siswa')
@section('page-subtitle', 'Tambahkan data siswa baru.')

@push('styles')
<style>
/* =====================================================
   EDUVIA - TAMBAH DATA SISWA
   Pastel Blue + Dark Navy
===================================================== */

.siswa-create-page {
    --sc-blue: #3478BD;
    --sc-blue-dark: #285F96;
    --sc-text: #293F57;
    --sc-muted: #526982;
    --sc-border: #D5E1ED;

    color: var(--sc-text);
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.siswa-create-page *,
.siswa-create-page *::before,
.siswa-create-page *::after {
    box-sizing: border-box;
}

/* ANIMASI */

.sc-enter {
    animation: scEnter .35s ease-out both;
}

@keyframes scEnter {
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

.sc-hero {
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

.sc-hero-icon,
.sc-section-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border: 1px solid #C3D8EB;
    background: #E3F0FA;
    color: #3478BD;
}

.sc-hero-icon {
    width: 58px;
    height: 58px;
    border: 1px solid #FFFFFF;
    border-radius: 15px;
    background: #FFFFFF;
}

.sc-hero-icon svg {
    width: 27px;
    height: 27px;
}

.sc-hero-label {
    color: #285F96;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.sc-hero-title {
    color: #214A77;
}

.sc-hero-description {
    color: #4D6886;
}

/* TOMBOL */

.sc-button {
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

.sc-button svg {
    width: 17px;
    height: 17px;
    flex-shrink: 0;
}

.sc-button:hover {
    transform: translateY(-1px);
}

.sc-button:active {
    transform: translateY(0);
}

.sc-button:focus-visible {
    outline: 3px solid rgba(52, 120, 189, .3);
    outline-offset: 3px;
}

.sc-button-primary {
    border-color: #3478BD;
    background: #3478BD;
    color: #FFFFFF;
    box-shadow: 0 3px 8px rgba(52, 120, 189, .12);
}

.sc-button-primary:hover {
    border-color: #285F96;
    background: #285F96;
    color: #FFFFFF;
}

.sc-button-secondary {
    border-color: #C8DCEE;
    background: #FFFFFF;
    color: #365773;
}

.sc-button-secondary:hover {
    border-color: #A4BFDF;
    background: #E3F0FA;
    color: #285F96;
}

/* PANEL FORM */

.sc-form-card {
    max-width: 850px;
    overflow: hidden;
    border: 1px solid #D5E1ED;
    border-radius: 15px;
    background: #FFFFFF;
    box-shadow: 0 4px 12px rgba(45, 82, 124, .045);
}

.sc-card-header {
    padding: 18px 20px;
    border-bottom: 1px solid #D5E1ED;
    background: #F5F9FE;
}

.sc-section-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
}

.sc-section-icon svg {
    width: 20px;
    height: 20px;
}

.sc-card-title {
    color: #294B70;
    font-size: 14px;
    font-weight: 800;
    line-height: 1.5;
}

.sc-card-description {
    margin-top: 4px;
    color: #667D95;
    font-size: 11px;
    line-height: 1.7;
}

.sc-form-body {
    padding: 24px 20px;
}

/* FIELD */

.sc-field {
    margin-bottom: 21px;
}

.sc-label {
    display: block;
    margin-bottom: 7px;
    color: #435C76;
    font-size: 12px;
    font-weight: 800;
}

.sc-required {
    color: #DC2626;
    font-weight: 800;
}

/* INPUT DAN SELECT */

.sc-input,
.sc-select {
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
        box-shadow .2s ease,
        background .2s ease;
}

.sc-input::placeholder {
    color: #8495A8;
    font-weight: 500;
}

.sc-input:hover,
.sc-select:hover {
    border-color: #A9C5E0;
}

.sc-input:focus,
.sc-select:focus {
    border-color: #438BD0;
    background: #FFFFFF;
    box-shadow: 0 0 0 3px rgba(67, 139, 208, .16);
    outline: none;
}

/* DROPDOWN */

.siswa-create-page select.sc-select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    color-scheme: light;

    padding: 10px 40px 10px 12px;

    background-color: #FFFFFF;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23526982' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 13px center;
    background-size: 16px;

    cursor: pointer;
}

.siswa-create-page select.sc-select option {
    background: #FFFFFF;
    color: #26374A;
}

/* PETUNJUK FIELD */

.sc-help {
    margin-top: 7px;
    color: #71849A;
    font-size: 11px;
    font-weight: 500;
    line-height: 1.7;
}

.sc-error {
    margin-top: 7px;
    color: #DC2626;
    font-size: 12px;
    font-weight: 700;
}

/* NOTIFIKASI VALIDASI */

.sc-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 15px 17px;
    border: 1px solid #F1C4C4;
    border-radius: 11px;
    background: #FFF0F0;
    color: #B23535;
    animation: scEnter .3s ease-out;
}

.sc-alert-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    flex-shrink: 0;
    border: 1px solid #F1C4C4;
    border-radius: 9px;
    background: #FFFFFF;
    color: #B23535;
    font-size: 16px;
    font-weight: 900;
}

.sc-alert-title {
    color: #A93649;
    font-size: 13px;
    font-weight: 800;
}

.sc-alert-list {
    margin-top: 6px;
    padding-left: 18px;
    color: #A93649;
    font-size: 12px;
    font-weight: 600;
    line-height: 1.8;
    list-style: disc;
}

/* BAGIAN TOMBOL */

.sc-form-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 9px;
    margin-top: 7px;
    padding-top: 19px;
    border-top: 1px solid #E0E9F3;
}

/* FOOTER */

.sc-footer-line {
    width: 42px;
    height: 3px;
    margin: 0 auto 12px;
    border-radius: 20px;
    background: #89AAD7;
}

.sc-footer {
    color: #73869B;
    font-size: 11px;
    font-weight: 600;
    text-align: center;
}

/* =====================================================
   DARK MODE
===================================================== */

.dark .siswa-create-page {
    --sc-text: #E4ECF6;
    --sc-muted: #AABBD0;
    --sc-border: #354A62;

    color: var(--sc-text);
}

.dark .sc-hero {
    border-color: #3B5878;
    background: linear-gradient(
        115deg,
        #17283D 0%,
        #1C3049 55%,
        #243E59 100%
    );
    box-shadow: 0 4px 12px rgba(0, 0, 0, .14);
}

.dark .sc-hero-label {
    color: #C6E1FF;
}

.dark .sc-hero-title {
    color: #F1F6FC;
}

.dark .sc-hero-description {
    color: #C2D0E0;
}

.dark .sc-hero-icon,
.dark .sc-section-icon {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

/* DARK MODE TOMBOL */

.dark .sc-button-primary {
    border-color: #557FAF;
    background: #3478BD;
    color: #FFFFFF;
}

.dark .sc-button-primary:hover {
    background: #285F96;
}

.dark .sc-button-secondary {
    border-color: #435873;
    background: #24364D;
    color: #D5E5F8;
}

.dark .sc-button-secondary:hover {
    background: #2F4865;
}

/* DARK MODE FORM */

.dark .sc-form-card {
    border-color: #354962;
    background: #192438;
    box-shadow: none;
}

.dark .sc-card-header {
    border-color: #354962;
    background: #1C2C42;
}

.dark .sc-card-title {
    color: #EAF3FF;
}

.dark .sc-card-description {
    color: #AABBD0;
}

.dark .sc-label {
    color: #C5D5E9;
}

.dark .sc-input,
.dark .sc-select {
    border-color: #40536B;
    background-color: #111C2E;
    color: #E8F0FB;
}

.dark .sc-input::placeholder {
    color: #8294A9;
}

.dark .sc-input:hover,
.dark .sc-select:hover {
    border-color: #5799DC;
}

.dark .sc-input:focus,
.dark .sc-select:focus {
    border-color: #5799DC;
    background-color: #152337;
    color: #E8F0FB;
    box-shadow: 0 0 0 3px rgba(87, 153, 220, .17);
}

/* DROPDOWN DARK MODE */

.dark .siswa-create-page select.sc-select {
    color-scheme: dark;
    border-color: #40536B;
    background-color: #111C2E;
    color: #E8F0FB;
}

.dark .siswa-create-page select.sc-select option {
    background-color: #192438;
    color: #E8F0FB;
}

.dark .siswa-create-page select.sc-select option:checked {
    background-color: #263E59;
    color: #FFFFFF;
}

.dark .sc-help {
    color: #AABBD0;
}

.dark .sc-error {
    color: #FFB4B4;
}

/* DARK MODE VALIDASI */

.dark .sc-alert {
    border-color: #704044;
    background: #3B2429;
    color: #FFB4B4;
}

.dark .sc-alert-icon {
    border-color: #704044;
    background: #482A30;
    color: #FFB4B4;
}

.dark .sc-alert-title,
.dark .sc-alert-list {
    color: #FFB4B4;
}

/* DARK MODE FOOTER */

.dark .sc-form-actions {
    border-color: #354962;
}

.dark .sc-footer {
    color: #AABBD0;
}

/* RESPONSIVE */

@media (max-width: 640px) {
    .sc-hero {
        border-radius: 14px;
    }

    .sc-hero-icon {
        width: 47px;
        height: 47px;
        border-radius: 11px;
    }

    .sc-hero-icon svg {
        width: 23px;
        height: 23px;
    }

    .sc-form-body {
        padding: 17px;
    }

    .sc-card-header {
        padding: 16px;
    }

    .sc-form-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .sc-form-actions .sc-button {
        width: 100%;
    }
}

@media (prefers-reduced-motion: reduce) {
    .siswa-create-page *,
    .siswa-create-page *::before,
    .siswa-create-page *::after {
        animation: none !important;
        transition: none !important;
    }
}
</style>
@endpush


@section('content')

<div class="siswa-create-page space-y-6">

    {{-- HEADER HALAMAN --}}
    <section class="sc-hero sc-enter">

        <div class="flex flex-col gap-5 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-7">

            <div class="flex min-w-0 items-center gap-4">

                <div class="sc-hero-icon">

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>

                        <circle cx="10" cy="7" r="4"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M20 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>

                    </svg>

                </div>

                <div class="min-w-0">

                    <p class="sc-hero-label mb-1">
                        Data Master
                    </p>

                    <h2 class="sc-hero-title text-xl font-extrabold sm:text-2xl">
                        Tambah Data Siswa
                    </h2>

                    <p class="sc-hero-description mt-2 text-sm leading-relaxed">
                        Tambahkan identitas siswa ke dalam sistem akademik.
                    </p>

                </div>

            </div>


            <a
                href="{{ route('admin.siswa.index') }}"
                class="sc-button sc-button-secondary flex-shrink-0"
            >

                <svg fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24"
                     aria-hidden="true">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M15 18l-6-6 6-6"/>

                </svg>

                Kembali ke Data Siswa

            </a>

        </div>

    </section>


    {{-- VALIDASI --}}
    @if($errors->any())

        <div class="sc-alert" role="alert">

            <div class="sc-alert-icon">
                !
            </div>

            <div class="min-w-0 flex-1">

                <h3 class="sc-alert-title">
                    Data belum bisa disimpan
                </h3>

                <ul class="sc-alert-list">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    {{-- FORM TAMBAH SISWA --}}
    <section class="sc-form-card sc-enter">

        {{-- HEADER FORM --}}
        <div class="sc-card-header">

            <div class="flex items-center gap-3">

                <div class="sc-section-icon">

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>

                        <circle cx="10" cy="7" r="4"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M20 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>

                    </svg>

                </div>

                <div>

                    <h3 class="sc-card-title">
                        Informasi Siswa
                    </h3>

                    <p class="sc-card-description">
                        Masukkan informasi siswa dengan benar.
                    </p>

                </div>

            </div>

        </div>


        {{-- ISI FORM --}}
        <form
            action="{{ route('admin.siswa.store') }}"
            method="POST"
            class="sc-form-body"
        >

            @csrf


            {{-- NIS --}}
            <div class="sc-field">

                <label for="nis" class="sc-label">
                    NIS <span class="sc-required">*</span>
                </label>

                <input
                    type="text"
                    id="nis"
                    name="nis"
                    value="{{ old('nis') }}"
                    placeholder="Masukkan NIS siswa"
                    maxlength="20"
                    autocomplete="off"
                    required
                    class="sc-input"
                >

                @error('nis')
                    <p class="sc-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- NAMA SISWA --}}
            <div class="sc-field">

                <label for="nama_siswa" class="sc-label">
                    Nama Siswa <span class="sc-required">*</span>
                </label>

                <input
                    type="text"
                    id="nama_siswa"
                    name="nama_siswa"
                    value="{{ old('nama_siswa') }}"
                    placeholder="Masukkan nama lengkap siswa"
                    maxlength="255"
                    autocomplete="off"
                    required
                    class="sc-input"
                >

                @error('nama_siswa')
                    <p class="sc-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- KELAS --}}
            <div class="sc-field">

                <label for="kelas" class="sc-label">
                    Kelas <span class="sc-required">*</span>
                </label>

                <select
                    id="kelas"
                    name="kelas"
                    required
                    class="sc-select"
                >

                    <option value="">
                        -- Pilih Kelas --
                    </option>

                    @forelse($kelasList as $kelas)

                        <option
                            value="{{ $kelas->nama_kelas }}"
                            {{ old('kelas') == $kelas->nama_kelas ? 'selected' : '' }}
                        >
                            {{ $kelas->nama_kelas }}
                        </option>

                    @empty

                        <option value="" disabled>
                            Belum ada kelas terdaftar di Data Kelas
                        </option>

                    @endforelse

                </select>

                @error('kelas')
                    <p class="sc-error">
                        {{ $message }}
                    </p>
                @enderror

                <p class="sc-help">
                    Pilih kelas yang sudah terdaftar pada menu Data Kelas.
                </p>

            </div>


            {{-- JENIS KELAMIN --}}
            <div class="sc-field">

                <label for="jenis_kelamin" class="sc-label">
                    Jenis Kelamin <span class="sc-required">*</span>
                </label>

                <select
                    id="jenis_kelamin"
                    name="jenis_kelamin"
                    required
                    class="sc-select"
                >

                    <option value="">
                        -- Pilih Jenis Kelamin --
                    </option>

                    <option
                        value="L"
                        {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}
                    >
                        Laki-laki
                    </option>

                    <option
                        value="P"
                        {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}
                    >
                        Perempuan
                    </option>

                </select>

                @error('jenis_kelamin')
                    <p class="sc-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- TOMBOL FORM --}}
            <div class="sc-form-actions">

                <button
                    type="submit"
                    class="sc-button sc-button-primary"
                >

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="m5 13 4 4L19 7"/>

                    </svg>

                    Simpan Data

                </button>


                <a
                    href="{{ route('admin.siswa.index') }}"
                    class="sc-button sc-button-secondary"
                >

                    Batal

                </a>

            </div>

        </form>

    </section>


    {{-- FOOTER --}}
    <footer class="text-center pt-2 pb-3">

        <div class="sc-footer-line"></div>

        <p class="sc-footer">
            © {{ date('Y') }} Sistem Akademik Mini
        </p>

    </footer>

</div>

@endsection