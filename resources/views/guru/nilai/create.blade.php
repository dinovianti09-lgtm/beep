@extends('layouts.guru')

@section('title', 'Input Nilai - Sistem Akademik')
@section('page-title', 'Input Nilai')
@section('page-subtitle', 'Tambahkan nilai siswa sesuai kelas dan mata pelajaran yang diampu')

@push('styles')
<style>
/* =====================================================
   EDUVIA - INPUT NILAI GURU
===================================================== */

.input-nilai-page {
    --input-border: #D5E1ED;
    --input-text: #26374A;
    --input-muted: #60748B;
    --input-card: #FFFFFF;
    --input-blue: #3478BD;
}

/* ANIMASI */
.input-nilai-page .input-enter {
    animation: inputEnter .4s ease-out both;
}

.input-nilai-page .input-delay-1 { animation-delay: .06s; }
.input-nilai-page .input-delay-2 { animation-delay: .12s; }
.input-nilai-page .input-delay-3 { animation-delay: .18s; }

@keyframes inputEnter {
    from {
        opacity: 0;
        transform: translateY(8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* HEADER */
.input-nilai-page .input-heading {
    color: #26374A;
}

.input-nilai-page .input-description {
    color: #60748B;
}

/* CARD */
.input-nilai-page .input-card {
    overflow: hidden;
    background: var(--input-card);
    border: 1px solid var(--input-border);
    border-radius: 17px;
    box-shadow: 0 3px 10px rgba(39,77,119,.045);
}

.input-nilai-page .card-heading {
    color: #26374A;
}

.input-nilai-page .card-description {
    color: #60748B;
}

/* IKON */
.input-nilai-page .input-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 46px;
    height: 46px;
    flex-shrink: 0;
    border: 1px solid #C3D8EB;
    border-radius: 13px;
    background: #E3F0FA;
    color: #355779;
}

/* INFORMASI MAPEL */
.input-nilai-page .mapel-card {
    position: relative;
    overflow: hidden;
    border: 1px solid #B8D2EB;
    border-radius: 17px;
    background: linear-gradient(115deg,#EAF4FD 0%,#D9EAFB 55%,#F0F7FD 100%);
    box-shadow: 0 4px 12px rgba(48,105,166,.06);
}

.input-nilai-page .mapel-label {
    color: #52708F;
}

.input-nilai-page .mapel-name {
    color: #1C4169;
}

.input-nilai-page .mapel-teacher {
    color: #526D89;
}

/* LABEL */
.input-nilai-page .field-label {
    display: block;
    margin-bottom: 9px;
    color: #30445B;
    font-size: 13px;
    font-weight: 800;
}

.input-nilai-page .required-mark {
    color: #DC5555;
}

/* INPUT */
.input-nilai-page .form-control {
    display: block;
    width: 100%;
    min-height: 47px;
    padding: 11px 14px;
    border: 1px solid #D5E1ED;
    border-radius: 11px;
    background: #FFFFFF;
    color: #30445B;
    font-size: 13px;
    outline: none;
    transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
}

.input-nilai-page .form-control:focus {
    border-color: #6B9FD1;
    box-shadow: 0 0 0 3px rgba(73,137,198,.13);
}

.input-nilai-page .form-control:disabled {
    cursor: not-allowed;
    background: #F1F5F9;
    color: #8795A5;
    opacity: 1;
}

.input-nilai-page .form-control[readonly] {
    background: #F5F8FC;
    color: #52677E;
}

.input-nilai-page .form-control::placeholder {
    color: #9AA9B9;
}

.input-nilai-page .field-hint {
    margin-top: 7px;
    color: #718399;
    font-size: 11px;
    line-height: 1.6;
}

/* BAGIAN FORM */
.input-nilai-page .form-section {
    padding-top: 22px;
    border-top: 1px solid #E2EAF2;
}

.input-nilai-page .section-indicator {
    width: 4px;
    height: 30px;
    flex-shrink: 0;
    border-radius: 10px;
    background: #527DAE;
}

.input-nilai-page .section-title {
    color: #26374A;
}

/* KOMPONEN NILAI */
.input-nilai-page .score-card {
    padding: 16px;
    border: 1px solid #D5E1ED;
    border-radius: 13px;
    background: #F9FBFE;
    transition: border-color .2s ease, box-shadow .2s ease;
}

.input-nilai-page .score-card:focus-within {
    border-color: #8DB4DC;
    box-shadow: 0 3px 10px rgba(52,120,189,.07);
}

.input-nilai-page .score-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border: 1px solid #C3D8EB;
    border-radius: 10px;
    background: #E3F0FA;
    color: #355779;
}

.input-nilai-page .score-title {
    color: #30445B;
}

/* INFO BOBOT */
.input-nilai-page .weight-info {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 13px 15px;
    border: 1px solid #C9DFF5;
    border-radius: 11px;
    background: #F0F7FE;
    color: #41658A;
    font-size: 12px;
    line-height: 1.7;
}

/* ALERT */
.input-nilai-page .alert-box {
    padding: 15px 17px;
    border-radius: 12px;
    font-size: 13px;
}

.input-nilai-page .alert-error {
    border: 1px solid #F2C4C4;
    background: #FFF4F4;
    color: #A53E3E;
}

.input-nilai-page .alert-success {
    border: 1px solid #B9E2CB;
    background: #F0FAF4;
    color: #267448;
}

/* BUTTON */
.input-nilai-page .btn-secondary,
.input-nilai-page .btn-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 44px;
    padding: 11px 19px;
    border-radius: 11px;
    font-size: 13px;
    font-weight: 800;
    text-decoration: none;
    transition: background .2s ease, transform .2s ease, box-shadow .2s ease;
}

.input-nilai-page .btn-secondary {
    border: 1px solid #D5E1ED;
    background: #FFFFFF;
    color: #40556D;
}

.input-nilai-page .btn-secondary:hover {
    background: #F1F6FB;
}

.input-nilai-page .btn-primary {
    border: 1px solid #3478BD;
    background: linear-gradient(110deg,#3478BD,#477FC0);
    color: #FFFFFF;
    box-shadow: 0 3px 8px rgba(52,120,189,.17);
}

.input-nilai-page .btn-primary:hover {
    background: linear-gradient(110deg,#2867A7,#386FAF);
    transform: translateY(-1px);
    box-shadow: 0 5px 12px rgba(52,120,189,.2);
}

.input-nilai-page .btn-primary:focus,
.input-nilai-page .btn-secondary:focus {
    outline: 2px solid #8DB4DC;
    outline-offset: 2px;
}

/* DARK MODE */
:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .input-heading,
:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .card-heading,
:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .section-title {
    color: #F1F6FC !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .input-description,
:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .card-description {
    color: #AFC0D4 !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .input-card {
    background: #192438 !important;
    border-color: #34465F !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .mapel-card {
    background: linear-gradient(115deg,#17283D,#243E59) !important;
    border-color: #3B5878 !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .mapel-label,
:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .mapel-teacher {
    color: #B7CBE2 !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .mapel-name {
    color: #F1F6FC !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .input-icon,
:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .score-icon {
    background: #263E59 !important;
    border-color: #405B78 !important;
    color: #D8E9FC !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .field-label,
:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .score-title {
    color: #E1EAF5 !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .form-control {
    background: #111D30 !important;
    border-color: #40516A !important;
    color: #E1EAF5 !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .form-control:disabled {
    background: #202D41 !important;
    color: #AFC0D4 !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .form-control[readonly] {
    background: #202D41 !important;
    color: #C2D0E0 !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .form-control:focus {
    border-color: #78A9D9 !important;
    box-shadow: 0 0 0 3px rgba(120,169,217,.13) !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .field-hint {
    color: #AFC0D4 !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .score-card {
    background: #1C2B3E !important;
    border-color: #354A62 !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .weight-info {
    background: #1D344D !important;
    border-color: #3B5878 !important;
    color: #C7DCF2 !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .form-section {
    border-color: #34465F !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .btn-secondary {
    background: #202D41 !important;
    border-color: #40516A !important;
    color: #E1EAF5 !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .btn-secondary:hover {
    background: #293A52 !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .alert-error {
    background: #3B2029 !important;
    border-color: #75404C !important;
    color: #FFC4CB !important;
}

:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .alert-success {
    background: #17392D !important;
    border-color: #326B50 !important;
    color: #B8EBCB !important;
}

/* HEADER DARK MODE */
:is(
    html.dark, body.dark,
    html.dark-mode, body.dark-mode,
    html[data-theme="dark"], body[data-theme="dark"],
    html[data-admin-theme="dark"], body[data-admin-theme="dark"],
    .dark, .dark-mode, [data-theme="dark"]
) .input-nilai-page .input-page-header {
    background: linear-gradient(110deg,#1D344D,#263E59) !important;
    border-color: #405B78 !important;
}

/* RESPONSIVE */
@media (max-width: 640px) {
    .input-nilai-page .input-card {
        border-radius: 14px;
    }

    .input-nilai-page .btn-primary,
    .input-nilai-page .btn-secondary {
        width: 100%;
    }

    .input-nilai-page .score-card {
        padding: 14px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .input-nilai-page *,
    .input-nilai-page *::before,
    .input-nilai-page *::after {
        animation: none !important;
        transition: none !important;
    }
}
</style>
@endpush

@section('content')

<div class="input-nilai-page space-y-6">

    {{-- HEADER --}}
    <div class="input-page-header input-enter flex flex-col gap-4 rounded-2xl border border-[#C3DDF3] bg-gradient-to-r from-[#E3F0FA] via-[#DCEBFA] to-[#EEF6FD] p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
        <div>
            <h2 class="input-heading text-2xl font-extrabold tracking-tight">
                Input Nilai Siswa
            </h2>
            <p class="input-description mt-2 text-sm">
                Isi nilai harian, UTS, dan UAS siswa.
            </p>
        </div>

        <a href="{{ route('guru.rekap.index') }}"
           class="btn-secondary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m7 7-7-7 7-7"/>
            </svg>
            Kembali ke Rekap
        </a>
    </div>

    {{-- PESAN ERROR --}}
    @if ($errors->any())
        <div class="alert-box alert-error input-enter" role="alert">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="9"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/>
                </svg>

                <div>
                    <p class="mb-2 font-extrabold">Periksa kembali data berikut:</p>
                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- PESAN BERHASIL --}}
    @if (session('success'))
        <div class="alert-box alert-success input-enter" role="status">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6"/>
                    <circle cx="12" cy="12" r="9"/>
                </svg>
                <p class="font-semibold">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    {{-- INFORMASI MAPEL --}}
    <div class="mapel-card input-enter input-delay-1 p-5 sm:p-6">
        <div class="relative z-10 flex items-center gap-4">
            <div class="input-icon !w-14 !h-14 !bg-white/70 !border-white/80">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                </svg>
            </div>

            <div class="min-w-0">
                <p class="mapel-label text-xs font-bold uppercase tracking-wider">
                    Mata Pelajaran yang Diampu
                </p>

                <h3 class="mapel-name mt-1 text-xl font-extrabold">
                    {{ $mapel->nama_mapel }}
                </h3>

                <p class="mapel-teacher mt-1 text-sm">
                    Guru: {{ $guru->nama_guru ?? auth()->user()->username }}
                </p>
            </div>
        </div>
    </div>

    {{-- FORM INPUT --}}
    <div class="input-card input-enter input-delay-2">

        <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-5 sm:px-6 dark:border-slate-700">
            <div class="input-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                </svg>
            </div>

            <div>
                <h3 class="card-heading text-base font-extrabold">Form Input Nilai</h3>
                <p class="card-description mt-1 text-xs">
                    Lengkapi informasi siswa dan komponen penilaian.
                </p>
            </div>
        </div>

        <form action="{{ route('guru.nilai.store') }}" method="POST" class="space-y-6 p-5 sm:p-6">
            @csrf

            {{-- INFORMASI SISWA --}}
            <div>
                <div class="mb-5 flex items-center gap-3">
                    <span class="section-indicator"></span>
                    <div>
                        <h4 class="section-title text-sm font-extrabold">Informasi Siswa</h4>
                        <p class="card-description mt-1 text-xs">
                            Pilih kelas, siswa, dan periode penilaian.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    {{-- KELAS --}}
                    <div>
                        <label for="id_kelas" class="field-label">
                            Kelas <span class="required-mark">*</span>
                        </label>

                        <select id="id_kelas" name="id_kelas" required class="form-control">
                            <option value="">Pilih kelas terlebih dahulu</option>

                            @foreach ($kelasDiajar as $kelas)
                                <option value="{{ $kelas->id }}"
                                    {{ (string) old('id_kelas', $kelasTerpilih) === (string) $kelas->id ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>

                        <p class="field-hint">
                            Pilih kelas terlebih dahulu sebelum memilih siswa.
                        </p>

                        @error('id_kelas')
                            <p class="mt-1 text-xs font-semibold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- SISWA --}}
                    <div>
                        <label for="id_siswa" class="field-label">
                            Nama Siswa <span class="required-mark">*</span>
                        </label>

                        <select id="id_siswa" name="id_siswa" required disabled class="form-control">
                            <option value="">Pilih kelas terlebih dahulu</option>

                            @foreach ($siswaList as $siswa)
                                @php
                                    $kelasSiswa = str_replace('-', ' ', trim((string) $siswa->kelas));

                                    $idKelasSiswa = $kelasDiajar->first(function ($item) use ($kelasSiswa) {
                                        return str_replace('-', ' ', trim((string) $item->nama_kelas)) === $kelasSiswa;
                                    });
                                @endphp

                                <option value="{{ $siswa->id_siswa }}"
                                        data-kelas="{{ $idKelasSiswa->id ?? '' }}"
                                    {{ (string) old('id_siswa') === (string) $siswa->id_siswa ? 'selected' : '' }}>
                                    {{ $siswa->nama_siswa }} — {{ $siswa->kelas }}
                                </option>
                            @endforeach
                        </select>

                        <p id="pesan-siswa" class="field-hint" aria-live="polite">
                            Pilih kelas terlebih dahulu untuk membuka daftar siswa.
                        </p>

                        @error('id_siswa')
                            <p class="mt-1 text-xs font-semibold text-red-500">{{ $message }}</p>
                        @enderror

                        @if ($siswaList->isEmpty())
                            <p class="mt-1 text-xs font-semibold text-amber-600 dark:text-amber-400">
                                Belum ada siswa di kelas yang diajar.
                            </p>
                        @endif
                    </div>

                    {{-- MAPEL --}}
                    <div>
                        <label class="field-label">Mata Pelajaran</label>

                        <input type="text"
                               value="{{ $mapel->nama_mapel }}"
                               readonly
                               class="form-control">
                        <p class="field-hint">
                            Mata pelajaran mengikuti penugasan guru.
                        </p>
                    </div>

                    {{-- SEMESTER --}}
                    <div>
                        <label for="semester" class="field-label">
                            Semester <span class="required-mark">*</span>
                        </label>

                        <select id="semester" name="semester" required class="form-control">
                            <option value="">Pilih semester terlebih dahulu</option>

                            <option value="1" {{ old('semester') === '1' ? 'selected' : '' }}>
                                Semester 1 — Ganjil
                            </option>

                            <option value="2" {{ old('semester') === '2' ? 'selected' : '' }}>
                                Semester 2 — Genap
                            </option>
                        </select>

                        <p class="field-hint">
                            Pilih semester untuk membuka periode rapor yang sesuai.
                        </p>

                        @error('semester')
                            <p class="mt-1 text-xs font-semibold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- RAPOR --}}
                    <div class="md:col-span-2">
                        <label for="id_rapor" class="field-label">
                            Periode Rapor <span class="required-mark">*</span>
                        </label>

                        <select id="id_rapor" name="id_rapor" required disabled class="form-control">
                            <option value="">Pilih semester terlebih dahulu</option>

                            @foreach ($raporList as $rapor)
                                @php
                                    $semesterRapor = strtolower(trim((string) $rapor->semester));

                                    $nomorSemester = in_array($semesterRapor, ['ganjil', '1'], true)
                                        ? '1'
                                        : (in_array($semesterRapor, ['genap', '2'], true) ? '2' : '');

                                    // Bobot berdasarkan mapel guru dan periode rapor.
                                    $bobot = $bobotList->get($rapor->id_rapor);

                                    $bobotHarian = $bobot->bobot_harian ?? 30;
                                    $bobotUts = $bobot->bobot_uts ?? 30;
                                    $bobotUas = $bobot->bobot_uas ?? 40;
                                @endphp

                                <option value="{{ $rapor->id_rapor }}"
                                        data-semester="{{ $nomorSemester }}"
                                        data-bobot-harian="{{ $bobotHarian }}"
                                        data-bobot-uts="{{ $bobotUts }}"
                                        data-bobot-uas="{{ $bobotUas }}"
                                    {{ (string) old('id_rapor') === (string) $rapor->id_rapor ? 'selected' : '' }}>
                                    {{ $rapor->semester }} — {{ $rapor->tahun_ajaran }}
                                </option>
                            @endforeach
                        </select>

                        <p id="pesan-rapor" class="field-hint" aria-live="polite">
                            Pilih semester terlebih dahulu untuk membuka periode rapor.
                        </p>

                        @error('id_rapor')
                            <p class="mt-1 text-xs font-semibold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- KOMPONEN NILAI --}}
            <div class="form-section">

                <div class="mb-5 flex items-center gap-3">
                    <span class="section-indicator"></span>
                    <div>
                        <h4 class="section-title text-sm font-extrabold">Komponen Nilai</h4>
                        <p class="card-description mt-1 text-xs">
                            Masukkan nilai setiap komponen dengan rentang 0 sampai 100.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                    {{-- NILAI HARIAN --}}
                    <div class="score-card">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="score-icon">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                                </svg>
                            </div>

                            <label for="nilai_harian" class="score-title text-sm font-extrabold">
                                Nilai Harian
                            </label>
                        </div>

                        <input type="number"
                               id="nilai_harian"
                               name="nilai_harian"
                               min="0"
                               max="100"
                               step="0.01"
                               required
                               value="{{ old('nilai_harian') }}"
                               placeholder="0–100"
                               class="form-control">

                        @error('nilai_harian')
                            <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- NILAI UTS --}}
                    <div class="score-card">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="score-icon">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5h6M9 9h6M9 13h6M9 17h6M5 3h14v18H5z"/>
                                </svg>
                            </div>

                            <label for="nilai_uts" class="score-title text-sm font-extrabold">
                                Nilai UTS
                            </label>
                        </div>

                        <input type="number"
                               id="nilai_uts"
                               name="nilai_uts"
                               min="0"
                               max="100"
                               step="0.01"
                               required
                               value="{{ old('nilai_uts') }}"
                               placeholder="0–100"
                               class="form-control">

                        @error('nilai_uts')
                            <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- NILAI UAS --}}
                    <div class="score-card">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="score-icon">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                                </svg>
                            </div>

                            <label for="nilai_uas" class="score-title text-sm font-extrabold">
                                Nilai UAS
                            </label>
                        </div>

                        <input type="number"
                               id="nilai_uas"
                               name="nilai_uas"
                               min="0"
                               max="100"
                               step="0.01"
                               required
                               value="{{ old('nilai_uas') }}"
                               placeholder="0–100"
                               class="form-control">

                        @error('nilai_uas')
                            <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- INFORMASI BOBOT --}}
                <div class="weight-info mt-5">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 11v5m0-8h.01"/>
                    </svg>

                    <p id="info-bobot" aria-live="polite">
                        Pilih periode rapor untuk melihat bobot perhitungan nilai akhir.
                    </p>
                </div>
            </div>

            {{-- TOMBOL --}}
            <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end dark:border-slate-700">

                <a href="{{ route('guru.rekap.index') }}" class="btn-secondary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>

                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6"/>
                    </svg>
                    Simpan Nilai
                </button>

            </div>
        </form>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const kelasSelect = document.getElementById('id_kelas');
    const siswaSelect = document.getElementById('id_siswa');
    const pesanSiswa = document.getElementById('pesan-siswa');

    const semesterSelect = document.getElementById('semester');
    const raporSelect = document.getElementById('id_rapor');
    const pesanRapor = document.getElementById('pesan-rapor');
    const infoBobot = document.getElementById('info-bobot');

    if (!kelasSelect || !siswaSelect || !semesterSelect || !raporSelect) {
        return;
    }

    const siswaOptions = Array.from(siswaSelect.options).slice(1);
    const raporOptions = Array.from(raporSelect.options).slice(1);

    function formatBobot(nilai) {
        const angka = Number(nilai);

        if (!Number.isFinite(angka)) {
            return '0';
        }

        return angka.toLocaleString('id-ID', {
            maximumFractionDigits: 2
        });
    }

    function updateInfoBobot() {
        const optionTerpilih = raporSelect.options[raporSelect.selectedIndex];

        if (
            !optionTerpilih ||
            !optionTerpilih.value ||
            raporSelect.disabled
        ) {
            infoBobot.textContent =
                'Pilih periode rapor untuk melihat bobot perhitungan nilai akhir.';
            return;
        }

        const harian = optionTerpilih.dataset.bobotHarian ?? '30';
        const uts = optionTerpilih.dataset.bobotUts ?? '30';
        const uas = optionTerpilih.dataset.bobotUas ?? '40';

        infoBobot.textContent =
            'Nilai akhir dihitung otomatis: Harian ' +
            formatBobot(harian) +
            '%, UTS ' +
            formatBobot(uts) +
            '%, dan UAS ' +
            formatBobot(uas) +
            '%.';
    }

    function filterSiswa() {
        const kelasId = kelasSelect.value;
        const siswaSebelumnya = siswaSelect.value;

        siswaOptions.forEach(function (option) {
            const cocok = kelasId !== '' && option.dataset.kelas === kelasId;
            option.hidden = !cocok;
            option.disabled = !cocok;
        });

        siswaSelect.disabled = kelasId === '';

        if (kelasId === '') {
            siswaSelect.value = '';
            siswaSelect.options[0].textContent = 'Pilih kelas terlebih dahulu';
            pesanSiswa.textContent = 'Pilih kelas terlebih dahulu untuk membuka daftar siswa.';
            return;
        }

        siswaSelect.options[0].textContent = 'Pilih siswa';

        const adaSiswa = siswaOptions.some(function (option) {
            return !option.disabled;
        });

        if (!adaSiswa) {
            siswaSelect.value = '';
            siswaSelect.options[0].textContent = 'Belum ada siswa di kelas ini';
            pesanSiswa.textContent = 'Belum ada siswa yang terdaftar di kelas ini.';
            return;
        }

        const pilihanMasihValid = siswaOptions.some(function (option) {
            return option.value === siswaSebelumnya && !option.disabled;
        });

        if (!pilihanMasihValid) {
            siswaSelect.value = '';
        }

        pesanSiswa.textContent = 'Pilih siswa dari kelas yang sudah dipilih.';
    }

    function filterRapor() {
        const semester = semesterSelect.value;
        const raporSebelumnya = raporSelect.value;

        raporOptions.forEach(function (option) {
            const cocok = semester !== '' && option.dataset.semester === semester;
            option.hidden = !cocok;
            option.disabled = !cocok;
        });

        raporSelect.disabled = semester === '';

        if (semester === '') {
            raporSelect.value = '';
            raporSelect.options[0].textContent = 'Pilih semester terlebih dahulu';
            pesanRapor.textContent = 'Pilih semester terlebih dahulu untuk membuka periode rapor.';
            updateInfoBobot();
            return;
        }

        raporSelect.options[0].textContent = 'Pilih periode rapor';

        const adaRapor = raporOptions.some(function (option) {
            return !option.disabled;
        });

        if (!adaRapor) {
            raporSelect.value = '';
            raporSelect.options[0].textContent = 'Periode rapor belum tersedia';
            pesanRapor.textContent = 'Belum ada periode rapor untuk semester ini. Hubungi Admin.';
            updateInfoBobot();
            return;
        }

        const pilihanMasihValid = raporOptions.some(function (option) {
            return option.value === raporSebelumnya && !option.disabled;
        });

        if (!pilihanMasihValid) {
            raporSelect.value = '';
        }

        pesanRapor.textContent = 'Pilih periode rapor yang sesuai dengan semester.';
        updateInfoBobot();
    }

    siswaSelect.addEventListener('mousedown', function (event) {
        if (kelasSelect.value === '') {
            event.preventDefault();
            alert('Pilih kelas terlebih dahulu sebelum memilih siswa.');
            kelasSelect.focus();
        }
    });

    siswaSelect.addEventListener('focus', function () {
        if (kelasSelect.value === '') {
            alert('Pilih kelas terlebih dahulu sebelum memilih siswa.');
            kelasSelect.focus();
        }
    });

    raporSelect.addEventListener('mousedown', function (event) {
        if (semesterSelect.value === '') {
            event.preventDefault();
            alert('Pilih semester terlebih dahulu sebelum memilih periode rapor.');
            semesterSelect.focus();
        }
    });

    raporSelect.addEventListener('focus', function () {
        if (semesterSelect.value === '') {
            alert('Pilih semester terlebih dahulu sebelum memilih periode rapor.');
            semesterSelect.focus();
        }
    });

    kelasSelect.addEventListener('change', filterSiswa);
    semesterSelect.addEventListener('change', filterRapor);
    raporSelect.addEventListener('change', updateInfoBobot);

    filterSiswa();
    filterRapor();

    // Pulihkan pilihan periode setelah validasi gagal jika masih cocok.
    const raporLama = @json((string) old('id_rapor', ''));
    const semesterLama = @json((string) old('semester', ''));

    if (semesterLama !== '') {
        semesterSelect.value = semesterLama;
        filterRapor();

        if (raporLama !== '') {
            const raporCocok = raporOptions.find(function (option) {
                return option.value === raporLama &&
                    option.dataset.semester === semesterLama;
            });

            if (raporCocok) {
                raporSelect.value = raporLama;
            }
        }

        updateInfoBobot();
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector(
        'form[action="{{ route('guru.nilai.store') }}"]'
    );

    if (!form) return;

    const tombol = form.querySelector('button[type="submit"]');

    if (!tombol) return;

    let sedangMemproses = false;

    form.addEventListener('submit', function (event) {
        if (sedangMemproses) {
            event.preventDefault();
            return;
        }

        if (!form.checkValidity()) {
            return;
        }

        sedangMemproses = true;

        tombol.disabled = true;
        tombol.innerHTML = 'Memproses...';
    });
});
</script>

@endsection