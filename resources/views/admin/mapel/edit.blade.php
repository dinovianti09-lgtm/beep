@extends('layouts.admin')

@section('title', 'Edit Mata Pelajaran - Sistem Akademik Mini')
@section('page-title', 'Edit Mata Pelajaran')
@section('page-subtitle', 'Perbarui mata pelajaran dan pengaturan kelas')

@push('styles')
<style>
/* =====================================================
   EDUVIA - EDIT MATA PELAJARAN
   Konsisten dengan Data Mapel dan Tambah Mapel
===================================================== */

.mapel-edit {
    --me-blue: #3478BD;
    --me-blue-dark: #285F96;
    --me-text: #293F57;
    --me-muted: #526982;
    --me-border: #D5E1ED;

    color: var(--me-text);
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.dark .mapel-edit {
    --me-text: #E4ECF6;
    --me-muted: #AABBD0;
    --me-border: #354A62;
}

.mapel-edit *,
.mapel-edit *::before,
.mapel-edit *::after {
    box-sizing: border-box;
}

/* =====================================================
   ANIMASI
===================================================== */

.me-enter {
    animation: meEnter .35s ease-out both;
}

.me-delay {
    animation-delay: .08s;
}

@keyframes meEnter {
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

.me-hero {
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

.me-hero::before,
.me-hero::after {
    display: none !important;
    content: none !important;
}

.me-hero-icon {
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

.me-hero-title {
    color: #214A77;
}

.me-hero-description {
    color: #4D6886;
}

.dark .me-hero {
    background: linear-gradient(
        115deg,
        #17283D 0%,
        #1C3049 55%,
        #243E59 100%
    );
    border-color: #3B5878;
    box-shadow: 0 4px 12px rgba(0, 0, 0, .14);
}

.dark .me-hero-title {
    color: #F1F6FC;
}

.dark .me-hero-description {
    color: #C2D0E0;
}

.dark .me-hero-icon {
    background: #263E59;
    color: #D8E9FC;
    border-color: #405B78;
}

/* =====================================================
   TOMBOL
===================================================== */

.me-btn {
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

.me-btn:hover {
    transform: translateY(-1px);
}

.me-btn:active {
    transform: translateY(0);
}

.me-btn:focus-visible {
    outline: 3px solid rgba(52, 120, 189, .3);
    outline-offset: 3px;
}

.me-btn-primary {
    color: #FFFFFF;
    background: #3478BD;
    border-color: #3478BD;
    box-shadow: 0 3px 8px rgba(52, 120, 189, .12);
}

.me-btn-primary:hover {
    color: #FFFFFF;
    background: #285F96;
    border-color: #285F96;
}

.me-btn-secondary {
    color: #365773;
    background: #FFFFFF;
    border-color: #C8DCEE;
}

.me-btn-secondary:hover {
    color: #285F96;
    background: #E3F0FA;
    border-color: #A4BFDF;
}

.dark .me-btn-primary {
    color: #FFFFFF;
    background: #3478BD;
    border-color: #557FAF;
}

.dark .me-btn-primary:hover {
    background: #285F96;
}

.dark .me-btn-secondary {
    color: #D5E5F8;
    background: #24364D;
    border-color: #435873;
}

.dark .me-btn-secondary:hover {
    color: #FFFFFF;
    background: #2F4865;
}

/* =====================================================
   KARTU FORM
===================================================== */

.me-form-card {
    overflow: hidden;
    background: #FFFFFF;
    border: 1px solid #D5E1ED;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(45, 82, 124, .045);
}

.dark .me-form-card {
    background: #192438;
    border-color: #354962;
    box-shadow: none;
}

.me-form-header {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 20px 24px;
    background: #F5F9FE;
    border-bottom: 1px solid #D4E3F2;
}

.dark .me-form-header {
    background: #1C2C42;
    border-color: #354962;
}

.me-section-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    width: 42px;
    height: 42px;
    border: 1px solid #C3D8EB;
    border-radius: 10px;
    color: #3478BD;
    background: #E3F0FA;
}

.dark .me-section-icon {
    color: #D8E9FC;
    background: #263E59;
    border-color: #405B78;
}

.me-form-title {
    color: #214A77;
}

.me-form-description {
    color: #667D95;
}

.dark .me-form-title {
    color: #F1F6FC;
}

.dark .me-form-description {
    color: #AABBD0;
}

/* =====================================================
   LABEL DAN INPUT
===================================================== */

.me-label {
    display: block;
    margin-bottom: 8px;
    color: #435C76;
    font-size: 12px;
    font-weight: 800;
    line-height: 1.5;
}

.dark .me-label {
    color: #C5D5E9;
}

.me-required {
    color: #D9485F;
}

.me-input {
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

.me-input::placeholder {
    color: #8495A8;
}

.me-input:focus {
    outline: none;
    border-color: #438BD0;
    box-shadow: 0 0 0 3px rgba(67, 139, 208, .16);
}

.dark .me-input {
    background: #111C2E;
    color: #E8F0FB;
    border-color: #40536B;
}

.dark .me-input:focus {
    border-color: #5799DC;
    box-shadow: 0 0 0 3px rgba(87, 153, 220, .17);
}

.me-help {
    color: #73869B;
    font-size: 11px;
    line-height: 1.65;
}

.dark .me-help {
    color: #A4B5CA;
}

.me-field-error {
    margin-top: 7px;
    color: #C13D52;
    font-size: 12px;
    font-weight: 600;
}

.dark .me-field-error {
    color: #FF9EAC;
}

/* =====================================================
   PILIHAN JURUSAN DAN TINGKAT KELAS
===================================================== */

.me-choice-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 10px;
}

.me-choice {
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

.me-choice:hover {
    background: #EAF3FC;
    border-color: #A4BFDF;
}

.me-choice:has(input:checked) {
    background: #E3F0FA;
    border-color: #89AAD7;
    box-shadow: inset 0 0 0 1px rgba(137, 170, 215, .2);
}

.me-choice input {
    width: 17px;
    height: 17px;
    flex-shrink: 0;
    accent-color: #3478BD;
    cursor: pointer;
}

.me-choice-text {
    color: #3D526A;
    font-size: 12px;
    font-weight: 700;
    line-height: 1.5;
}

.me-choice:has(input:checked) .me-choice-text {
    color: #285F96;
}

.dark .me-choice {
    background: #202F45;
    border-color: #40536B;
}

.dark .me-choice:hover {
    background: #263B54;
    border-color: #597DA4;
}

.dark .me-choice:has(input:checked) {
    background: #263E59;
    border-color: #639BD0;
}

.dark .me-choice-text {
    color: #DCEBFC;
}

.dark .me-choice:has(input:checked) .me-choice-text {
    color: #FFFFFF;
}

/* =====================================================
   INFORMASI PENGATURAN
===================================================== */

.me-info {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 15px;
    border: 1px solid #C3D8EB;
    border-radius: 10px;
    background: #F0F7FD;
}

.me-info-icon {
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

.me-info-title {
    color: #285783;
}

.me-info-text {
    color: #506D8B;
}

.dark .me-info {
    border-color: #385572;
    background: #20364F;
}

.dark .me-info-icon {
    color: #D8E9FC;
    background: #263E59;
    border-color: #405B78;
}

.dark .me-info-title {
    color: #D2E8FF;
}

.dark .me-info-text {
    color: #B3C9E0;
}

/* =====================================================
   ERROR VALIDASI
===================================================== */

.me-error-box {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 15px 17px;
    border: 1px solid #F0C7CE;
    border-radius: 11px;
    background: #FFF2F3;
    color: #A93449;
}

.me-error-icon {
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

.dark .me-error-box {
    color: #FFC5CE;
    background: #3D2630;
    border-color: #70404D;
}

.dark .me-error-icon {
    background: #482A32;
    border-color: #70404D;
}

/* =====================================================
   AKSI FORM
===================================================== */

.me-form-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
    padding-top: 22px;
    border-top: 1px solid #E0E9F2;
}

.dark .me-form-actions {
    border-color: #354962;
}

/* =====================================================
   FOOTER
===================================================== */

.me-footer-line {
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
    .me-choice-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 640px) {
    .me-hero {
        border-radius: 14px;
    }

    .me-hero-icon {
        width: 47px;
        height: 47px;
        border-radius: 11px;
    }

    .me-hero-icon svg {
        width: 23px;
        height: 23px;
    }

    .me-form-header {
        padding: 17px;
    }

    .me-form-body {
        padding: 18px !important;
    }

    .me-choice-grid {
        grid-template-columns: minmax(0, 1fr);
    }

    .me-form-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .me-form-actions .me-btn {
        width: 100%;
    }
}

@media (prefers-reduced-motion: reduce) {
    .mapel-edit *,
    .mapel-edit *::before,
    .mapel-edit *::after {
        animation: none !important;
        transition: none !important;
    }
}
</style>
@endpush


@section('content')

<div class="mapel-edit space-y-6">

    {{-- HEADER --}}
    <section class="me-hero me-enter">

        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5 p-5 sm:p-7">

            <div class="flex items-center gap-4 min-w-0">

                <div class="me-hero-icon">

                    <svg class="w-7 h-7"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="m16 4 4 4M4 20l4-.8L19 8a2.1 2.1 0 0 0-3-3L5 16l-1 4Z"/>
                    </svg>

                </div>

                <div class="min-w-0">

                    <p class="text-xs font-extrabold tracking-widest text-blue-700 dark:text-blue-300 uppercase mb-1">
                        Data Master
                    </p>

                    <h1 class="me-hero-title text-xl sm:text-2xl font-extrabold">
                        Edit Mata Pelajaran
                    </h1>

                    <p class="me-hero-description text-sm mt-2 leading-relaxed">
                        Perbarui informasi mata pelajaran dan kelas yang menggunakannya.
                    </p>

                </div>

            </div>

            <a href="{{ route('admin.mapel.index') }}"
               class="me-btn me-btn-secondary flex-shrink-0">

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

        <div class="me-error-box me-enter">

            <div class="me-error-icon">

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

                <p class="text-sm font-extrabold mb-2">
                    Periksa kembali data berikut:
                </p>

                <ul class="space-y-1 text-sm list-disc ml-5">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    {{-- FORM EDIT --}}
    <div class="max-w-4xl me-enter me-delay">

        <section class="me-form-card">

            {{-- HEADER KARTU --}}
            <div class="me-form-header">

                <div class="me-section-icon">

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

                    <h2 class="me-form-title text-base sm:text-lg font-extrabold">
                        Informasi Mata Pelajaran
                    </h2>

                    <p class="me-form-description text-sm mt-1 leading-relaxed">
                        Ubah informasi sesuai kebutuhan kurikulum sekolah.
                    </p>

                </div>

            </div>


            {{-- FORM EDIT --}}
            <form
                action="{{ route('admin.mapel.update', $mapel->id_mapel) }}"
                method="POST"
                class="me-form-body p-6 sm:p-7 space-y-7"
            >

                @csrf
                @method('PUT')


                {{-- NAMA MAPEL --}}
                <div>

                    <label for="nama_mapel" class="me-label">
                        Nama Mata Pelajaran
                        <span class="me-required">*</span>
                    </label>

                    <input
                        type="text"
                        id="nama_mapel"
                        name="nama_mapel"
                        value="{{ old('nama_mapel', $mapel->nama_mapel) }}"
                        maxlength="100"
                        required
                        placeholder="Contoh: Pemrograman Web"
                        class="me-input"
                    >

                    @error('nama_mapel')
                        <p class="me-field-error">{{ $message }}</p>
                    @enderror

                </div>


                {{-- KKM --}}
                <div>

                    <label for="kkm" class="me-label">
                        Kriteria Ketuntasan Minimal (KKM)
                        <span class="me-required">*</span>
                    </label>

                    <div class="max-w-xs">

                        <input
                            type="number"
                            id="kkm"
                            name="kkm"
                            value="{{ old('kkm', $mapel->kkm) }}"
                            min="0"
                            max="100"
                            required
                            placeholder="75"
                            class="me-input"
                        >

                    </div>

                    @error('kkm')
                        <p class="me-field-error">{{ $message }}</p>
                    @enderror

                    <p class="me-help mt-2">
                        Masukkan KKM antara 0 sampai 100.
                    </p>

                </div>


                {{-- PEMBATAS --}}
                <div class="border-t border-slate-200 dark:border-slate-700"></div>


                {{-- PILIH JURUSAN --}}
                <section>

                    <div class="mb-4">

                        <h3 class="me-label mb-1">
                            Pilih Jurusan
                            <span class="me-required">*</span>
                        </h3>

                        <p class="me-help">
                            Centang semua jurusan yang menggunakan mata pelajaran ini.
                        </p>

                    </div>

                    <div class="me-choice-grid">

                        @foreach($jurusanList as $jurusan)

                            <label class="me-choice">

                                <input
                                    type="checkbox"
                                    name="jurusan[]"
                                    value="{{ $jurusan }}"
                                    {{ in_array($jurusan, old('jurusan', $jurusanTerpilih)) ? 'checked' : '' }}
                                >

                                <span class="me-choice-text">
                                    {{ $jurusan }}
                                </span>

                            </label>

                        @endforeach

                    </div>

                    @error('jurusan')
                        <p class="me-field-error">{{ $message }}</p>
                    @enderror

                    @error('jurusan.*')
                        <p class="me-field-error">{{ $message }}</p>
                    @enderror

                </section>


                {{-- PILIH TINGKAT KELAS --}}
                <section>

                    <div class="mb-4">

                        <h3 class="me-label mb-1">
                            Pilih Tingkat Kelas
                            <span class="me-required">*</span>
                        </h3>

                        <p class="me-help">
                            Centang semua tingkat yang menggunakan mata pelajaran ini.
                        </p>

                    </div>

                    <div class="me-choice-grid">

                        @foreach($tingkatList as $tingkat)

                            <label class="me-choice">

                                <input
                                    type="checkbox"
                                    name="tingkat[]"
                                    value="{{ $tingkat }}"
                                    {{ in_array($tingkat, old('tingkat', $tingkatTerpilih)) ? 'checked' : '' }}
                                >

                                <span class="me-choice-text">
                                    Kelas {{ $tingkat }}
                                </span>

                            </label>

                        @endforeach

                    </div>

                    @error('tingkat')
                        <p class="me-field-error">{{ $message }}</p>
                    @enderror

                    @error('tingkat.*')
                        <p class="me-field-error">{{ $message }}</p>
                    @enderror

                </section>


                {{-- INFORMASI PENGATURAN --}}
                <div class="me-info">

                    <div class="me-info-icon">

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

                        <p class="me-info-title text-sm font-extrabold">
                            Informasi Pengaturan
                        </p>

                        <p class="me-info-text text-xs mt-2 leading-relaxed">
                            Periksa kembali pilihan jurusan dan tingkat kelas sebelum menyimpan perubahan. Pengaturan harus sesuai dengan kurikulum sekolah.
                        </p>

                    </div>

                </div>


                {{-- TOMBOL SIMPAN DAN BATAL --}}
                <div class="me-form-actions">

                    <button type="submit" class="me-btn me-btn-primary">

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

                        Simpan Perubahan

                    </button>

                    <a
                        href="{{ route('admin.mapel.index') }}"
                        class="me-btn me-btn-secondary"
                    >
                        Batal
                    </a>

                </div>

            </form>

        </section>

    </div>


    {{-- FOOTER --}}
    <footer class="text-center pt-2 pb-3">

        <div class="me-footer-line"></div>

        <p class="me-help font-semibold">
            © {{ date('Y') }} Sistem Akademik Mini
        </p>

    </footer>

</div>

@endsection