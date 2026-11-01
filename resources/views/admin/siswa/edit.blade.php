@extends('layouts.admin')

@section('title', 'Edit Siswa - Sistem Akademik Mini')
@section('page-title', 'Edit Data Siswa')
@section('page-subtitle', 'Perbarui informasi siswa.')

@push('styles')
<style>
/* =====================================================
   EDUVIA - EDIT DATA SISWA
   Pastel Blue + Dark Navy
===================================================== */

.siswa-edit-page {
    --se-blue: #3478BD;
    --se-blue-dark: #285F96;
    --se-text: #293F57;
    --se-muted: #526982;
    --se-border: #D5E1ED;

    color: var(--se-text);
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.siswa-edit-page *,
.siswa-edit-page *::before,
.siswa-edit-page *::after {
    box-sizing: border-box;
}

/* ANIMASI */

.se-enter {
    animation: seEnter .35s ease-out both;
}

@keyframes seEnter {
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

.se-hero {
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

.se-hero-icon,
.se-section-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border: 1px solid #C3D8EB;
    background: #E3F0FA;
    color: #3478BD;
}

.se-hero-icon {
    width: 58px;
    height: 58px;
    border: 1px solid #FFFFFF;
    border-radius: 15px;
    background: #FFFFFF;
}

.se-hero-icon svg {
    width: 27px;
    height: 27px;
}

.se-hero-label {
    color: #285F96;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.se-hero-title {
    color: #214A77;
}

.se-hero-description {
    color: #4D6886;
}

/* TOMBOL */

.se-button {
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

.se-button svg {
    width: 17px;
    height: 17px;
    flex-shrink: 0;
}

.se-button:hover {
    transform: translateY(-1px);
}

.se-button:active {
    transform: translateY(0);
}

.se-button:focus-visible {
    outline: 3px solid rgba(52, 120, 189, .3);
    outline-offset: 3px;
}

.se-button-primary {
    border-color: #3478BD;
    background: #3478BD;
    color: #FFFFFF;
    box-shadow: 0 3px 8px rgba(52, 120, 189, .12);
}

.se-button-primary:hover {
    border-color: #285F96;
    background: #285F96;
    color: #FFFFFF;
}

.se-button-secondary {
    border-color: #C8DCEE;
    background: #FFFFFF;
    color: #365773;
}

.se-button-secondary:hover {
    border-color: #A4BFDF;
    background: #E3F0FA;
    color: #285F96;
}

/* FORM CARD */

.se-form-card {
    max-width: 850px;
    overflow: hidden;
    border: 1px solid #D5E1ED;
    border-radius: 15px;
    background: #FFFFFF;
    box-shadow: 0 4px 12px rgba(45, 82, 124, .045);
}

.se-card-header {
    padding: 18px 20px;
    border-bottom: 1px solid #D5E1ED;
    background: #F5F9FE;
}

.se-section-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
}

.se-section-icon svg {
    width: 20px;
    height: 20px;
}

.se-card-title {
    color: #294B70;
    font-size: 14px;
    font-weight: 800;
    line-height: 1.5;
}

.se-card-description {
    margin-top: 4px;
    color: #667D95;
    font-size: 11px;
    line-height: 1.7;
}

.se-form-body {
    padding: 24px 20px;
}

/* FIELD */

.se-field {
    margin-bottom: 21px;
}

.se-label {
    display: block;
    margin-bottom: 7px;
    color: #435C76;
    font-size: 12px;
    font-weight: 800;
}

.se-required {
    color: #DC2626;
    font-weight: 800;
}

/* INPUT DAN SELECT */

.se-input,
.se-select {
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

.se-input::placeholder {
    color: #8495A8;
    font-weight: 500;
}

.se-input:hover,
.se-select:hover {
    border-color: #A9C5E0;
}

.se-input:focus,
.se-select:focus {
    border-color: #438BD0;
    background: #FFFFFF;
    box-shadow: 0 0 0 3px rgba(67, 139, 208, .16);
    outline: none;
}

/* DROPDOWN */

.siswa-edit-page select.se-select {
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

.siswa-edit-page select.se-select option {
    background: #FFFFFF;
    color: #26374A;
}

/* PETUNJUK DAN ERROR */

.se-help {
    margin-top: 7px;
    color: #71849A;
    font-size: 11px;
    font-weight: 500;
    line-height: 1.7;
}

.se-error {
    margin-top: 7px;
    color: #DC2626;
    font-size: 12px;
    font-weight: 700;
}

/* NOTIFIKASI VALIDASI */

.se-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 15px 17px;
    border: 1px solid #F1C4C4;
    border-radius: 11px;
    background: #FFF0F0;
    color: #B23535;
}

.se-alert-icon {
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

.se-alert-title {
    color: #A93649;
    font-size: 13px;
    font-weight: 800;
}

.se-alert-list {
    margin-top: 6px;
    padding-left: 18px;
    color: #A93649;
    font-size: 12px;
    font-weight: 600;
    line-height: 1.8;
    list-style: disc;
}

/* TOMBOL FORM */

.se-form-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 9px;
    margin-top: 7px;
    padding-top: 19px;
    border-top: 1px solid #E0E9F3;
}

/* FOOTER */

.se-footer-line {
    width: 42px;
    height: 3px;
    margin: 0 auto 12px;
    border-radius: 20px;
    background: #89AAD7;
}

.se-footer {
    color: #73869B;
    font-size: 11px;
    font-weight: 600;
    text-align: center;
}

/* =====================================================
   DARK MODE
===================================================== */

.dark .siswa-edit-page {
    --se-text: #E4ECF6;
    --se-muted: #AABBD0;
    --se-border: #354A62;

    color: var(--se-text);
}

.dark .se-hero {
    border-color: #3B5878;
    background: linear-gradient(
        115deg,
        #17283D 0%,
        #1C3049 55%,
        #243E59 100%
    );
    box-shadow: 0 4px 12px rgba(0, 0, 0, .14);
}

.dark .se-hero-label {
    color: #C6E1FF;
}

.dark .se-hero-title {
    color: #F1F6FC;
}

.dark .se-hero-description {
    color: #C2D0E0;
}

.dark .se-hero-icon,
.dark .se-section-icon {
    border-color: #405773;
    background: #263E59;
    color: #D5E5F8;
}

/* DARK MODE BUTTON */

.dark .se-button-primary {
    border-color: #557FAF;
    background: #3478BD;
    color: #FFFFFF;
}

.dark .se-button-primary:hover {
    background: #285F96;
}

.dark .se-button-secondary {
    border-color: #435873;
    background: #24364D;
    color: #D5E5F8;
}

.dark .se-button-secondary:hover {
    background: #2F4865;
}

/* DARK MODE FORM */

.dark .se-form-card {
    border-color: #354962;
    background: #192438;
    box-shadow: none;
}

.dark .se-card-header {
    border-color: #354962;
    background: #1C2C42;
}

.dark .se-card-title {
    color: #EAF3FF;
}

.dark .se-card-description {
    color: #AABBD0;
}

.dark .se-label {
    color: #C5D5E9;
}

.dark .se-input,
.dark .se-select {
    border-color: #40536B;
    background-color: #111C2E;
    color: #E8F0FB;
}

.dark .se-input::placeholder {
    color: #8294A9;
}

.dark .se-input:hover,
.dark .se-select:hover {
    border-color: #5799DC;
}

.dark .se-input:focus,
.dark .se-select:focus {
    border-color: #5799DC;
    background-color: #152337;
    color: #E8F0FB;
    box-shadow: 0 0 0 3px rgba(87, 153, 220, .17);
}

/* DROPDOWN DARK MODE */

.dark .siswa-edit-page select.se-select {
    color-scheme: dark;
    border-color: #40536B;
    background-color: #111C2E;
    color: #E8F0FB;
}

.dark .siswa-edit-page select.se-select option {
    background-color: #192438;
    color: #E8F0FB;
}

.dark .siswa-edit-page select.se-select option:checked {
    background-color: #263E59;
    color: #FFFFFF;
}

.dark .se-help {
    color: #AABBD0;
}

.dark .se-error {
    color: #FFB4B4;
}

/* DARK MODE VALIDASI */

.dark .se-alert {
    border-color: #704044;
    background: #3B2429;
    color: #FFB4B4;
}

.dark .se-alert-icon {
    border-color: #704044;
    background: #482A30;
    color: #FFB4B4;
}

.dark .se-alert-title,
.dark .se-alert-list {
    color: #FFB4B4;
}

/* DARK MODE FOOTER */

.dark .se-form-actions {
    border-color: #354962;
}

.dark .se-footer {
    color: #AABBD0;
}

/* RESPONSIVE */

@media (max-width: 640px) {
    .se-hero {
        border-radius: 14px;
    }

    .se-hero-icon {
        width: 47px;
        height: 47px;
        border-radius: 11px;
    }

    .se-hero-icon svg {
        width: 23px;
        height: 23px;
    }

    .se-form-body {
        padding: 17px;
    }

    .se-card-header {
        padding: 16px;
    }

    .se-form-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .se-form-actions .se-button {
        width: 100%;
    }
}

@media (prefers-reduced-motion: reduce) {
    .siswa-edit-page *,
    .siswa-edit-page *::before,
    .siswa-edit-page *::after {
        animation: none !important;
        transition: none !important;
    }
}
</style>
@endpush


@section('content')

<div class="siswa-edit-page space-y-6">

    {{-- HEADER HALAMAN --}}
    <section class="se-hero se-enter">

        <div class="flex flex-col gap-5 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-7">

            <div class="flex min-w-0 items-center gap-4">

                <div class="se-hero-icon">

                    <svg fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 20h9"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M16.5 3.5a2.12 2.12 0 0 1 3 3L8 18l-4 1 1-4Z"/>

                    </svg>

                </div>

                <div class="min-w-0">

                    <p class="se-hero-label mb-1">
                        Data Master
                    </p>

                    <h2 class="se-hero-title text-xl font-extrabold sm:text-2xl">
                        Edit Data Siswa
                    </h2>

                    <p class="se-hero-description mt-2 text-sm leading-relaxed">
                        Perbarui informasi siswa kemudian simpan perubahan.
                    </p>

                </div>

            </div>


            <a
                href="{{ route('admin.siswa.index') }}"
                class="se-button se-button-secondary flex-shrink-0"
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

        <div class="se-alert" role="alert">

            <div class="se-alert-icon">
                !
            </div>

            <div class="min-w-0 flex-1">

                <h3 class="se-alert-title">
                    Data belum bisa disimpan
                </h3>

                <ul class="se-alert-list">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    {{-- FORM EDIT SISWA --}}
    <section class="se-form-card se-enter">

        {{-- HEADER FORM --}}
        <div class="se-card-header">

            <div class="flex items-center gap-3">

                <div class="se-section-icon">

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

                    <h3 class="se-card-title">
                        Informasi Siswa
                    </h3>

                    <p class="se-card-description">
                        Ubah informasi siswa yang diperlukan.
                    </p>

                </div>

            </div>

        </div>


        {{-- ISI FORM --}}
        <form
            action="{{ route('admin.siswa.update', $siswa->id_siswa) }}"
            method="POST"
            class="se-form-body"
        >

            @csrf
            @method('PUT')


            {{-- NIS --}}
            <div class="se-field">

                <label for="nis" class="se-label">
                    NIS <span class="se-required">*</span>
                </label>

                <input
                    type="text"
                    id="nis"
                    name="nis"
                    value="{{ old('nis', $siswa->nis) }}"
                    placeholder="Masukkan NIS siswa"
                    maxlength="50"
                    autocomplete="off"
                    required
                    class="se-input"
                >

                @error('nis')
                    <p class="se-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- NAMA SISWA --}}
            <div class="se-field">

                <label for="nama_siswa" class="se-label">
                    Nama Siswa <span class="se-required">*</span>
                </label>

                <input
                    type="text"
                    id="nama_siswa"
                    name="nama_siswa"
                    value="{{ old('nama_siswa', $siswa->nama_siswa) }}"
                    placeholder="Masukkan nama lengkap siswa"
                    maxlength="255"
                    autocomplete="off"
                    required
                    class="se-input"
                >

                @error('nama_siswa')
                    <p class="se-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- KELAS --}}
            <div class="se-field">

                <label for="kelas" class="se-label">
                    Kelas <span class="se-required">*</span>
                </label>

                <select
                    id="kelas"
                    name="kelas"
                    required
                    class="se-select"
                >

                    <option value="">
                        -- Pilih Kelas --
                    </option>

                    @forelse($kelasList as $kelas)

                        <option
                            value="{{ $kelas->nama_kelas }}"
                            {{ old('kelas', $siswa->kelas) == $kelas->nama_kelas ? 'selected' : '' }}
                        >
                            {{ $kelas->nama_kelas }}
                        </option>

                    @empty

                        <option value="" disabled>
                            Belum ada data kelas
                        </option>

                    @endforelse

                </select>

                @error('kelas')
                    <p class="se-error">
                        {{ $message }}
                    </p>
                @enderror

                <p class="se-help">
                    Kelas diambil dari Data Kelas yang sudah dibuat.
                </p>

            </div>


            {{-- JENIS KELAMIN --}}
            <div class="se-field">

                <label for="jenis_kelamin" class="se-label">
                    Jenis Kelamin <span class="se-required">*</span>
                </label>

                <select
                    id="jenis_kelamin"
                    name="jenis_kelamin"
                    required
                    class="se-select"
                >

                    <option value="">
                        -- Pilih Jenis Kelamin --
                    </option>

                    <option
                        value="L"
                        {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}
                    >
                        Laki-laki
                    </option>

                    <option
                        value="P"
                        {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}
                    >
                        Perempuan
                    </option>

                </select>

                @error('jenis_kelamin')
                    <p class="se-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- TOMBOL --}}
            <div class="se-form-actions">

                <button
                    type="submit"
                    class="se-button se-button-primary"
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

                    Simpan Perubahan

                </button>


                <a
                    href="{{ route('admin.siswa.index') }}"
                    class="se-button se-button-secondary"
                >

                    Batal

                </a>

            </div>

        </form>

    </section>


    {{-- FOOTER --}}
    <footer class="pt-2 pb-3 text-center">

        <div class="se-footer-line"></div>

        <p class="se-footer">
            © {{ date('Y') }} Sistem Akademik Mini
        </p>

    </footer>

</div>

@endsection