@extends('layouts.admin')

@section('title', 'Data Kepala Sekolah - Sistem Akademik Mini')
@section('page-title', 'Data Kepala Sekolah')
@section('page-subtitle', 'Kelola nama dan NIP Kepala Sekolah.')

@push('styles')
<style>
/* =====================================================
   EDUVIA - DATA KEPALA SEKOLAH
   Pastel Blue + Dark Navy
===================================================== */

.kepsek-page {
    --kp-blue: #3478BD;
    --kp-blue-dark: #285F96;
    --kp-text: #293F57;
    --kp-muted: #526982;
    --kp-border: #D5E1ED;

    color: var(--kp-text);
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.kepsek-page *,
.kepsek-page *::before,
.kepsek-page *::after {
    box-sizing: border-box;
}

.kp-enter {
    animation: kpEnter .35s ease-out both;
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
.kp-section-icon {
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
    border-color: #FFFFFF;
    border-radius: 15px;
    background: #FFFFFF;
}

.kp-hero-icon svg {
    width: 27px;
    height: 27px;
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

/* CARD */

.kp-card {
    max-width: 850px;
    overflow: hidden;
    border: 1px solid #D5E1ED;
    border-radius: 15px;
    background: #FFFFFF;
    box-shadow: 0 4px 12px rgba(45, 82, 124, .045);
}

.kp-card-header {
    padding: 18px 20px;
    border-bottom: 1px solid #D5E1ED;
    background: #F5F9FE;
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

.kp-card-title {
    color: #294B70;
    font-size: 14px;
    font-weight: 800;
    line-height: 1.5;
}

.kp-card-description {
    margin-top: 4px;
    color: #667D95;
    font-size: 11px;
    line-height: 1.7;
}

.kp-card-body {
    padding: 24px 20px;
}

/* FORM */

.kp-field {
    margin-bottom: 21px;
}

.kp-label {
    display: block;
    margin-bottom: 7px;
    color: #435C76;
    font-size: 12px;
    font-weight: 800;
}

.kp-required {
    color: #DC2626;
}

.kp-input {
    display: block;
    width: 100%;
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

.kp-input::placeholder {
    color: #8495A8;
}

.kp-input:hover {
    border-color: #A9C5E0;
}

.kp-input:focus {
    border-color: #438BD0;
    background: #FFFFFF;
    box-shadow: 0 0 0 3px rgba(67, 139, 208, .16);
}

.kp-help {
    margin-top: 7px;
    color: #71849A;
    font-size: 11px;
    font-weight: 500;
    line-height: 1.7;
}

.kp-error {
    margin-top: 7px;
    color: #DC2626;
    font-size: 12px;
    font-weight: 700;
}

/* ALERT */

.kp-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 15px 17px;
    border-radius: 11px;
    font-size: 12px;
    font-weight: 600;
    line-height: 1.7;
}

.kp-alert-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    flex-shrink: 0;
    border-radius: 9px;
}

.kp-alert-success {
    border: 1px solid #B9E5CC;
    background: #F0FBF4;
    color: #247546;
}

.kp-alert-success .kp-alert-icon {
    background: #D8F3E2;
    color: #21804A;
}

.kp-alert-error {
    border: 1px solid #F1C4C4;
    background: #FFF0F0;
    color: #A93649;
}

.kp-alert-error .kp-alert-icon {
    background: #FCE0E0;
    color: #B23535;
}

.kp-error-list {
    margin-top: 5px;
    padding-left: 18px;
    list-style: disc;
}

/* TOMBOL */

.kp-actions {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-end;
    gap: 9px;
    margin-top: 7px;
    padding-top: 19px;
    border-top: 1px solid #E0E9F3;
}

.kp-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 42px;
    padding: 10px 16px;
    border: 1px solid transparent;
    border-radius: 9px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 800;
    line-height: 1.4;
    text-decoration: none;
    cursor: pointer;
    transition:
        transform .18s ease,
        background .18s ease,
        border-color .18s ease;
}

.kp-button svg {
    width: 17px;
    height: 17px;
}

.kp-button:hover {
    transform: translateY(-1px);
}

.kp-button-primary {
    border-color: #3478BD;
    background: #3478BD;
    color: #FFFFFF;
}

.kp-button-primary:hover {
    border-color: #285F96;
    background: #285F96;
    color: #FFFFFF;
}

.kp-button-secondary {
    border-color: #C8DCEE;
    background: #FFFFFF;
    color: #365773;
}

.kp-button-secondary:hover {
    border-color: #A4BFDF;
    background: #E3F0FA;
    color: #285F96;
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

.dark .kepsek-page {
    color: #E4ECF6;
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
.dark .kp-section-icon {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

/* DARK CARD */

.dark .kp-card {
    border-color: #354962;
    background: #192438;
    box-shadow: none;
}

.dark .kp-card-header {
    border-color: #354962;
    background: #1C2C42;
}

.dark .kp-card-title {
    color: #EAF3FF;
}

.dark .kp-card-description {
    color: #AABBD0;
}

/* DARK FORM */

.dark .kp-label {
    color: #C5D5E9;
}

.dark .kp-input {
    border-color: #40536B;
    background: #111C2E;
    color: #E8F0FB;
    color-scheme: dark;
}

.dark .kp-input::placeholder {
    color: #8294A9;
}

.dark .kp-input:hover {
    border-color: #5799DC;
}

.dark .kp-input:focus {
    border-color: #5799DC;
    background: #152337;
    color: #E8F0FB;
    box-shadow: 0 0 0 3px rgba(87, 153, 220, .17);
}

.dark .kp-help {
    color: #AABBD0;
}

.dark .kp-error {
    color: #FFB4B4;
}

/* DARK ALERT */

.dark .kp-alert-success {
    border-color: #315E49;
    background: #1C382D;
    color: #A7E4BD;
}

.dark .kp-alert-success .kp-alert-icon {
    background: #28513C;
    color: #A7E4BD;
}

.dark .kp-alert-error {
    border-color: #704044;
    background: #3B2429;
    color: #FFB4B4;
}

.dark .kp-alert-error .kp-alert-icon {
    background: #482A30;
    color: #FFB4B4;
}

/* DARK BUTTON */

.dark .kp-button-primary {
    border-color: #557FAF;
    background: #3478BD;
    color: #FFFFFF;
}

.dark .kp-button-primary:hover {
    background: #285F96;
}

.dark .kp-button-secondary {
    border-color: #435873;
    background: #24364D;
    color: #D5E5F8;
}

.dark .kp-button-secondary:hover {
    background: #2F4865;
}

.dark .kp-actions {
    border-color: #354962;
}

.dark .kp-footer {
    color: #AABBD0;
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

    .kp-card-header {
        padding: 16px;
    }

    .kp-card-body {
        padding: 17px;
    }

    .kp-actions {
        flex-direction: column-reverse;
    }

    .kp-actions .kp-button {
        width: 100%;
    }
}

@media (prefers-reduced-motion: reduce) {
    .kepsek-page *,
    .kepsek-page *::before,
    .kepsek-page *::after {
        animation: none !important;
        transition: none !important;
    }
}
</style>
@endpush


@section('content')

<div class="kepsek-page space-y-6">

    {{-- HEADER --}}
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
                              d="M12 3 4 7v5c0 5 3.5 8 8 9 4.5-1 8-4 8-9V7l-8-4Z"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="m9 12 2 2 4-4"/>

                    </svg>

                </div>

                <div class="min-w-0">

                    <p class="kp-hero-label mb-1">
                        Data Master
                    </p>

                    <h2 class="kp-hero-title text-xl font-extrabold sm:text-2xl">
                        Data Kepala Sekolah
                    </h2>

                    <p class="kp-hero-description mt-2 text-sm leading-relaxed">
                        Atur nama dan NIP Kepala Sekolah untuk cetakan rapor.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- NOTIFIKASI BERHASIL --}}
    @if (session('success'))

        <div class="kp-alert kp-alert-success" role="status">

            <div class="kp-alert-icon">

                <svg fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     viewBox="0 0 24 24"
                     aria-hidden="true">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="m5 12 4 4L19 6"/>

                </svg>

            </div>

            <div class="min-w-0">
                {{ session('success') }}
            </div>

        </div>

    @endif


    {{-- NOTIFIKASI ERROR --}}
    @if ($errors->any())

        <div class="kp-alert kp-alert-error" role="alert">

            <div class="kp-alert-icon">
                !
            </div>

            <div class="min-w-0 flex-1">

                <p class="font-extrabold">
                    Data belum bisa disimpan.
                </p>

                <ul class="kp-error-list">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    {{-- FORM DATA KEPALA SEKOLAH --}}
    <section class="kp-card kp-enter">

        {{-- HEADER CARD --}}
        <div class="kp-card-header">

            <div class="flex items-center gap-3">

                <div class="kp-section-icon">

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

                <div>

                    <h3 class="kp-card-title">
                        Informasi Kepala Sekolah
                    </h3>

                    <p class="kp-card-description">
                        Masukkan nama dan NIP sesuai data resmi.
                    </p>

                </div>

            </div>

        </div>


        {{-- FORM --}}
        <form
            action="{{ route('admin.pengaturan-sekolah.update') }}"
            method="POST"
            class="kp-card-body"
        >

            @csrf
            @method('PUT')


            {{-- NAMA KEPALA SEKOLAH --}}
            <div class="kp-field">

                <label
                    for="nama_kepala_sekolah"
                    class="kp-label"
                >
                    Nama Kepala Sekolah
                    <span class="kp-required">*</span>
                </label>

                <input
                    type="text"
                    id="nama_kepala_sekolah"
                    name="nama_kepala_sekolah"
                    value="{{ old('nama_kepala_sekolah', $pengaturan->nama_kepala_sekolah ?? '') }}"
                    maxlength="150"
                    required
                    autocomplete="off"
                    class="kp-input"
                    placeholder="Masukkan nama Kepala Sekolah"
                >

                @error('nama_kepala_sekolah')
                    <p class="kp-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- NIP KEPALA SEKOLAH --}}
            <div class="kp-field">

                <label
                    for="nip_kepala_sekolah"
                    class="kp-label"
                >
                    NIP Kepala Sekolah
                </label>

                <input
                    type="text"
                    id="nip_kepala_sekolah"
                    name="nip_kepala_sekolah"
                    value="{{ old('nip_kepala_sekolah', $pengaturan->nip_kepala_sekolah ?? '') }}"
                    maxlength="50"
                    autocomplete="off"
                    class="kp-input"
                    placeholder="Masukkan NIP jika tersedia"
                >

                @error('nip_kepala_sekolah')
                    <p class="kp-error">
                        {{ $message }}
                    </p>
                @enderror

                <p class="kp-help">
                    Kosongkan jika NIP belum tersedia. Jangan isi dengan nomor perkiraan.
                </p>

            </div>


            {{-- TOMBOL --}}
            <div class="kp-actions">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="kp-button kp-button-secondary"
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

                    Kembali

                </a>


                <button
                    type="submit"
                    class="kp-button kp-button-primary"
                >

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="m5 12 4 4L19 6"/>

                    </svg>

                    Simpan Data

                </button>

            </div>

        </form>

    </section>


    {{-- FOOTER --}}
    <footer class="pt-2 pb-3 text-center">

        <div class="kp-footer-line"></div>

        <p class="kp-footer">
            © {{ date('Y') }} Sistem Akademik Mini
        </p>

    </footer>

</div>

@endsection