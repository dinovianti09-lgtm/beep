@extends('layouts.guru')

@section('title', 'Rekap Nilai - Sistem Akademik')
@section('page-title', 'Rekap Nilai')
@section('page-subtitle', 'Lihat dan kelola rekap nilai siswa')

@push('styles')
<style>
.rekap-page {
    --rp-text: #26374A;
    --rp-muted: #647991;
    --rp-border: #D8E3EE;
    --rp-card: #FFFFFF;
    --rp-soft: #F7FAFD;
}

.rekap-page .rp-card {
    overflow: hidden;
    background: var(--rp-card);
    border: 1px solid var(--rp-border);
    border-radius: 16px;
    box-shadow: 0 3px 10px rgba(39,77,119,.045);
}

.rekap-page .rp-heading {
    color: var(--rp-text);
}

.rekap-page .rp-muted {
    color: var(--rp-muted);
}

/* HEADER BIRU PASTEL */
.rekap-page .rp-page-header {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 22px 24px;
    border: 1px solid #C8DCEE;
    border-radius: 16px;
    background: linear-gradient(120deg, #E3F0FA 0%, #F3F8FD 100%);
    box-shadow: 0 3px 10px rgba(39,77,119,.045);
}

.rekap-page .rp-page-header .rp-icon {
    width: 50px;
    height: 50px;
    background: #FFFFFF;
    border-color: #C8DCEE;
}

.rekap-page .rp-page-header h2 {
    color: #294D70;
    font-size: 21px;
    font-weight: 800;
}

.rekap-page .rp-page-header p {
    color: #607A94;
}

.rekap-page .rp-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 46px;
    height: 46px;
    flex-shrink: 0;
    border: 1px solid #C8DCEE;
    border-radius: 13px;
    background: #E8F2FB;
    color: #416D99;
}

.rekap-page .rp-label {
    display: block;
    margin-bottom: 8px;
    color: #344B63;
    font-size: 12px;
    font-weight: 800;
}

.rekap-page .rp-control {
    display: block;
    width: 100%;
    min-height: 44px;
    padding: 10px 13px;
    border: 1px solid #D5E1ED;
    border-radius: 10px;
    background: #F9FBFD;
    color: #30445B;
    font-size: 13px;
    outline: none;
    transition: .2s ease;
}

.rekap-page .rp-control:focus {
    border-color: #6B9FD1;
    box-shadow: 0 0 0 3px rgba(73,137,198,.12);
}

.rekap-page .rp-control::placeholder {
    color: #9AA9B9;
}

.rekap-page .rp-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 44px;
    padding: 10px 17px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 800;
    transition: .2s ease;
    cursor: pointer;
}

.rekap-page .rp-btn:hover {
    transform: translateY(-1px);
}

.rekap-page .rp-btn-blue {
    background: #397DBB;
    color: white;
}

.rekap-page .rp-btn-blue:hover {
    background: #286AA8;
}

.rekap-page .rp-btn-outline {
    border: 1px solid #D5E1ED;
    background: white;
    color: #50647B;
}

.rekap-page .rp-btn-outline:hover {
    background: #F1F6FB;
}

.rekap-page .rp-feature {
    display: flex;
    flex-direction: column;
    padding: 17px;
    border: 1px solid #D8E3EE;
    border-radius: 13px;
    background: #FFFFFF;
}

.rekap-page .rp-feature-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 37px;
    height: 37px;
    margin-bottom: 13px;
    border-radius: 10px;
    background: #E8F2FB;
    color: #416D99;
}

.rekap-page .rp-table th {
    padding: 15px 14px;
    background: #F3F7FB;
    color: #52677E;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .025em;
    white-space: nowrap;
}

.rekap-page .rp-table td {
    padding: 14px;
    font-size: 12px;
    border-bottom: 1px solid #EDF1F5;
}

.rekap-page .rp-table tbody tr:last-child td {
    border-bottom: 0;
}

.rekap-page .rp-table tbody tr:hover {
    background: #F7FAFD;
}

.rekap-page .rp-status {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 800;
    white-space: nowrap;
}

/* WARNA PREDIKAT */
.rekap-page .rp-predikat-a {
    background: #DCFCE7;
    color: #15803D;
}

.rekap-page .rp-predikat-b {
    background: #DBEAFE;
    color: #1D4ED8;
}

.rekap-page .rp-predikat-c {
    background: #FEF3C7;
    color: #B45309;
}

.rekap-page .rp-predikat-d {
    background: #FEE2E2;
    color: #B91C1C;
}

.rekap-page .rp-predikat-default {
    background: #E2E8F0;
    color: #475569;
}

.rekap-page .rp-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border-radius: 9px;
    transition: .2s ease;
}

.rekap-page .rp-action:hover {
    transform: translateY(-1px);
}

.rekap-page .rp-divider {
    border-color: #E5ECF3;
}

/* PAGINATION */
.rekap-page .rp-page-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 44px;
    min-height: 44px;
    padding: 0 11px;
    border: 1px solid #D8E3EE;
    border-radius: 9px;
    background: #FFFFFF;
    color: #52677E;
    font-size: 12px;
    font-weight: 700;
    transition: .2s ease;
}

.rekap-page .rp-page-link:hover {
    background: #EAF3FB;
    border-color: #A9C8E5;
    color: #286AA8;
}

.rekap-page .rp-page-link.disabled {
    opacity: .45;
    cursor: not-allowed;
    pointer-events: none;
}

/* DARK MODE */
:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-page-header {
    background: linear-gradient(120deg, #1D3149 0%, #223A55 100%) !important;
    border-color: #405B78 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-page-header h2 {
    color: #F1F6FC !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-page-header p {
    color: #C0D2E5 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-card {
    background: #192438 !important;
    border-color: #34465F !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-heading {
    color: #F1F6FC !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-muted {
    color: #AFC0D4 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-icon,
:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-feature-icon {
    background: #263E59 !important;
    border-color: #405B78 !important;
    color: #D8E9FC !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-label {
    color: #DCE7F4 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-control {
    background: #111D30 !important;
    border-color: #40516A !important;
    color: #E1EAF5 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-feature {
    background: #1C2B3E !important;
    border-color: #354A62 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-btn-outline {
    background: #202D41 !important;
    border-color: #40516A !important;
    color: #E1EAF5 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-table th {
    background: #202F44 !important;
    color: #D5E2F0 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-table td {
    border-color: #34465F !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-table tbody tr:hover {
    background: #202F44 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-divider {
    border-color: #34465F !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-page-link {
    background: #202D41;
    border-color: #40516A;
    color: #DCE7F4;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-predikat-a {
    background: #14532D !important;
    color: #BBF7D0 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-predikat-b {
    background: #1E3A8A !important;
    color: #BFDBFE !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-predikat-c {
    background: #78350F !important;
    color: #FDE68A !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body.dark-mode,
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rekap-page .rp-predikat-d {
    background: #7F1D1D !important;
    color: #FECACA !important;
}

/* RESPONSIVE */
@media(max-width:640px) {
    .rekap-page .rp-page-header {
        padding: 17px;
        gap: 12px;
    }

    .rekap-page .rp-page-header .rp-icon {
        width: 44px;
        height: 44px;
    }

    .rekap-page .rp-page-header h2 {
        font-size: 18px;
    }

    .rekap-page .rp-btn {
        width: 100%;
    }

    .rekap-page .rp-feature {
        padding: 14px;
    }

    .rekap-page .rp-pagination {
        justify-content: center;
    }
}
</style>
@endpush

@section('content')
<div class="rekap-page space-y-6">

    {{-- HEADER BIRU PASTEL --}}
    <div class="rp-page-header">
        <div class="rp-icon">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v1a2 2 0 0 1-2 2Z"/>
            </svg>
        </div>

        <div>
            <h2>Rekap Nilai Siswa</h2>
            <p class="mt-1 text-sm">
                Pantau nilai siswa berdasarkan kelas dan semester.
            </p>
        </div>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800 dark:border-emerald-800 dark:bg-emerald-900/20 dark:text-emerald-300" role="status">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800 dark:border-red-800 dark:bg-red-900/20 dark:text-red-300" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 dark:border-red-800 dark:bg-red-900/20 dark:text-red-300" role="alert">
            <p class="mb-2 font-bold">Periksa kembali data berikut:</p>
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if(session('import_errors'))
        <div class="rounded-xl border border-blue-200 bg-blue-50 p-4 text-blue-900 dark:border-blue-800 dark:bg-blue-900/20 dark:text-blue-200">
            <h3 class="mb-2 font-bold">Detail Import Excel</h3>
            <ul class="list-inside list-disc space-y-1 text-sm">
                @foreach(session('import_errors') as $importError)
                    <li>{{ $importError }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FILTER DAN PENCARIAN --}}
    <div class="rp-card">
        <div class="flex items-center gap-3 border-b rp-divider px-5 py-4">
            <div class="rp-icon !h-10 !w-10">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7"/>
                    <path stroke-linecap="round" d="m20 20-4-4"/>
                </svg>
            </div>

            <div>
                <h3 class="rp-heading font-extrabold">Cari dan Filter Nilai</h3>
                <p class="rp-muted mt-1 text-xs">Cari berdasarkan nama atau NIS, lalu pilih kelas dan semester.</p>
            </div>
        </div>

        <form method="GET"
              action="{{ route('guru.rekap.index') }}"
              class="p-5"
              autocomplete="off">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                <div>
                    <label for="search" class="rp-label">Nama Siswa / NIS</label>

                    <input
                        id="search"
                        type="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Masukkan nama atau NIS..."
                        class="rp-control"
                        autocomplete="off"
                        autocapitalize="off"
                        spellcheck="false"
                        aria-label="Cari nama siswa atau NIS"
                    >
                </div>

                <div>
                    <label for="kelas" class="rp-label">Kelas</label>

                    <select id="kelas" name="kelas" class="rp-control">
                        <option value="">Semua Kelas</option>

                        @foreach($kelasDiajar as $kelas)
                            <option value="{{ $kelas->nama_kelas }}"
                                {{ $kelasTerpilih == $kelas->nama_kelas ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="semester" class="rp-label">Semester</label>

                    <select id="semester" name="semester" class="rp-control">
                        <option value="">Semua Semester</option>
                        <option value="1" {{ $semesterTerpilih == '1' ? 'selected' : '' }}>
                            Semester 1 — Ganjil
                        </option>
                        <option value="2" {{ $semesterTerpilih == '2' ? 'selected' : '' }}>
                            Semester 2 — Genap
                        </option>
                    </select>
                </div>

            </div>

            <div class="mt-5 flex flex-col gap-3 sm:flex-row">
                <button type="submit" class="rp-btn rp-btn-blue">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7"/>
                        <path stroke-linecap="round" d="m20 20-4-4"/>
                    </svg>
                    Cari Nilai
                </button>

                @if(request()->filled('search') || $kelasTerpilih || $semesterTerpilih)
                    <a href="{{ route('guru.rekap.index') }}" class="rp-btn rp-btn-outline">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h5M5.5 14a7 7 0 1 0 1.3-7L4 9"/>
                        </svg>
                        Reset Filter
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- IMPORT DAN EXPORT EXCEL --}}
    <div class="rp-card">
        <div class="flex items-center gap-3 border-b rp-divider px-5 py-4">
            <div class="rp-icon !h-10 !w-10">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v16H4zM8 8h8M8 12h8M8 16h4"/>
                </svg>
            </div>

            <div>
                <h3 class="rp-heading font-extrabold">Import dan Export Excel</h3>
                <p class="rp-muted mt-1 text-xs">Kelola nilai secara massal menggunakan file Excel.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 p-5 lg:grid-cols-3">

            {{-- TEMPLATE --}}
            <div class="rp-feature">
                <div class="rp-feature-icon">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v12m0 0 4-4m-4 4-4-4M5 17v3h14v-3"/>
                    </svg>
                </div>

                <h4 class="rp-heading text-sm font-extrabold">Download Template Excel</h4>

                <p class="rp-muted mt-2 flex-1 text-xs leading-6">
                    Unduh format Excel sebelum mengisi nilai siswa.
                </p>

                <a href="{{ route('guru.nilai.template') }}" class="rp-btn rp-btn-blue mt-4">
                    Download Template
                </a>
            </div>

            {{-- IMPORT --}}
            <div class="rp-feature">
                <div class="rp-feature-icon">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16V4m0 0L8 8m4-4 4 4M5 17v3h14v-3"/>
                    </svg>
                </div>

                <h4 class="rp-heading text-sm font-extrabold">Import Excel</h4>

                <p class="rp-muted mt-2 text-xs leading-6">
                    Unggah file Excel berisi nilai siswa menggunakan format template.
                </p>

                <form action="{{ route('guru.nilai.import') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="mt-4 space-y-3">

                    @csrf

                    <label for="file_excel" class="rp-label">Pilih file Excel</label>

                    <input
                        id="file_excel"
                        type="file"
                        name="file"
                        accept=".xlsx,.xls,.csv"
                        required
                        class="block w-full rounded-lg border border-slate-200 bg-slate-50 text-xs text-slate-600 file:mr-3 file:border-0 file:bg-blue-50 file:px-3 file:py-3 file:font-bold file:text-blue-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:file:bg-slate-700 dark:file:text-blue-300"
                    >

                    <button type="submit" class="rp-btn rp-btn-blue w-full">
                        Import Nilai
                    </button>
                </form>
            </div>

            {{-- EXPORT --}}
            <div class="rp-feature">
                <div class="rp-feature-icon">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v12m0 0 4-4m-4 4-4-4M5 17v3h14v-3"/>
                    </svg>
                </div>

                <h4 class="rp-heading text-sm font-extrabold">Export Excel</h4>

                <p class="rp-muted mt-2 flex-1 text-xs leading-6">
                    Unduh rekap nilai untuk dokumentasi.
                </p>

                <a href="{{ route('guru.nilai.export', request()->query()) }}"
                   class="rp-btn rp-btn-blue mt-4">
                    Export Rekap Nilai
                </a>
            </div>

        </div>

        <div class="border-t rp-divider bg-slate-50 px-5 py-3 dark:bg-slate-800/50">
            <p class="rp-muted text-xs leading-5">
                Gunakan template yang disediakan. Pastikan NIS, nama siswa, kelas, mata pelajaran, semester, tahun ajaran, dan nilai sesuai dengan sistem.
            </p>
        </div>
    </div>

    {{-- JUMLAH DATA BAGIAN ATAS --}}
    <div class="flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h3 class="rp-heading font-extrabold">Daftar Rekap Nilai</h3>

            <p class="rp-muted mt-1 text-sm">
                Menampilkan
                <span class="rp-heading font-extrabold">{{ $rekaps->count() }}</span>
                dari
                <span class="rp-heading font-extrabold">{{ $rekaps->total() }}</span>
                data nilai
            </p>
        </div>
    </div>

    {{-- TABEL REKAP NILAI --}}
    <div class="rp-card">

        <div class="border-b rp-divider px-5 py-4">
            <h3 class="rp-heading text-sm font-extrabold">Data Nilai Siswa</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="rp-table w-full min-w-[1250px] text-left">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th class="text-center">Semester</th>
                        <th class="text-center">Harian</th>
                        <th class="text-center">UTS</th>
                        <th class="text-center">UAS</th>
                        <th class="text-center">Nilai Akhir</th>
                        <th class="text-center">KKM</th>
                        <th class="text-center">Predikat</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($rekaps as $index => $rekap)
                        @php
                            $nilaiAkhirTersedia = is_numeric($rekap->nilai_akhir);
                            $kkmTersedia = is_numeric($rekap->mapel->kkm ?? null);

                            $nilaiAkhir = $nilaiAkhirTersedia
                                ? (float) $rekap->nilai_akhir
                                : null;

                            $kkm = $kkmTersedia
                                ? (float) $rekap->mapel->kkm
                                : null;

                            $semesterTampil = $rekap->rapor->semester
                                ?? $rekap->semester
                                ?? '-';

                            $semesterNormal = strtolower(trim((string) $semesterTampil));

                            $predikat = strtoupper(trim((string) ($rekap->predikat ?? '')));

                            $warnaPredikat = match ($predikat) {
                                'A' => 'rp-predikat-a',
                                'B' => 'rp-predikat-b',
                                'C' => 'rp-predikat-c',
                                'D' => 'rp-predikat-d',
                                default => 'rp-predikat-default',
                            };
                        @endphp

                        <tr>
                            <td class="whitespace-nowrap text-slate-500 dark:text-slate-400">
                                {{ $rekaps->firstItem() + $index }}
                            </td>

                            <td>
                                <div class="flex min-w-[180px] items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-100 font-extrabold text-blue-700 dark:bg-blue-900/40 dark:text-blue-300">
                                        {{ strtoupper(substr($rekap->siswa->nama_siswa ?? 'S', 0, 1)) }}
                                    </div>

                                    <div>
                                        <p class="font-extrabold text-slate-800 dark:text-white">
                                            {{ $rekap->siswa->nama_siswa ?? '-' }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                            NIS: {{ $rekap->siswa->nis ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="whitespace-nowrap font-bold text-slate-700 dark:text-slate-200">
                                {{ $rekap->siswa->kelas ?? '-' }}
                            </td>

                            <td class="whitespace-nowrap font-bold text-slate-700 dark:text-slate-300">
                                {{ $rekap->mapel->nama_mapel ?? '-' }}
                            </td>

                            <td class="whitespace-nowrap text-center">
                                <span class="rp-status bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                                    @if(in_array($semesterNormal, ['1', 'ganjil']))
                                        Ganjil
                                    @elseif(in_array($semesterNormal, ['2', 'genap']))
                                        Genap
                                    @else
                                        {{ $semesterTampil }}
                                    @endif
                                </span>
                            </td>

                            <td class="whitespace-nowrap text-center font-extrabold text-slate-700 dark:text-slate-200">
                                {{ $rekap->nilai_harian ?? '-' }}
                            </td>

                            <td class="whitespace-nowrap text-center font-extrabold text-slate-700 dark:text-slate-200">
                                {{ $rekap->nilai_uts ?? '-' }}
                            </td>

                            <td class="whitespace-nowrap text-center font-extrabold text-slate-700 dark:text-slate-200">
                                {{ $rekap->nilai_uas ?? '-' }}
                            </td>

                            <td class="whitespace-nowrap text-center">
                                <span class="rp-status bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                                    {{ $nilaiAkhirTersedia ? $rekap->nilai_akhir : '-' }}
                                </span>
                            </td>

                            <td class="whitespace-nowrap text-center font-bold text-slate-700 dark:text-slate-300">
                                {{ $kkmTersedia ? $rekap->mapel->kkm : '-' }}
                            </td>

                            <td class="whitespace-nowrap text-center">
                                <span class="rp-status {{ $warnaPredikat }}">
                                    {{ $predikat !== '' ? $predikat : '-' }}
                                </span>
                            </td>

                            <td class="whitespace-nowrap text-center">
                                @if(!$nilaiAkhirTersedia)
                                    <span class="rp-status bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300">
                                        Belum dinilai
                                    </span>
                                @elseif(!$kkmTersedia)
                                    <span class="rp-status bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                        KKM belum diatur
                                    </span>
                                @elseif($nilaiAkhir >= $kkm)
                                    <span class="rp-status bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300">
                                        Tuntas
                                    </span>
                                @else
                                    <span class="rp-status bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                        Remedial
                                    </span>
                                @endif
                            </td>

                            <td class="whitespace-nowrap">
                                <div class="flex items-center justify-center gap-2">

                                    <a href="{{ route('guru.rekap.edit', $rekap->id_nilai) }}"
                                       title="Edit nilai"
                                       aria-label="Edit nilai {{ $rekap->siswa->nama_siswa ?? '' }}"
                                       class="rp-action bg-blue-50 text-blue-700 hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-300">

                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m15 5 4 4M4 20l4-.8L19 8a2.8 2.8 0 0 0-4-4L4 15l-.8 5Z"/>
                                        </svg>
                                    </a>

                                    <form action="{{ route('guru.rekap.destroy', $rekap->id_nilai) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus nilai siswa ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                title="Hapus nilai"
                                                aria-label="Hapus nilai {{ $rekap->siswa->nama_siswa ?? '' }}"
                                                class="rp-action bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-900/20 dark:text-red-300">

                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M10 11v6m4-6v6M5 7l1 14h12l1-14M9 7V4h6v3"/>
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="13" class="px-6 py-14 text-center">
                                <div class="mx-auto flex max-w-sm flex-col items-center">

                                    <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400 dark:bg-slate-800">
                                        <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 5h16M4 10h16M4 15h16M4 20h16"/>
                                        </svg>
                                    </div>

                                    <h3 class="rp-heading font-extrabold">
                                        Tidak Ada Data Nilai
                                    </h3>

                                    <p class="rp-muted mt-2 text-sm">
                                        Tidak ada nilai yang cocok dengan pencarian atau filter yang dipilih.
                                    </p>

                                    @if(request()->filled('search') || $kelasTerpilih || $semesterTerpilih)
                                        <a href="{{ route('guru.rekap.index') }}" class="rp-btn rp-btn-blue mt-4">
                                            Reset Filter
                                        </a>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($rekaps->hasPages())
            <div class="flex justify-end border-t rp-divider px-5 py-4">

                <div class="rp-pagination flex flex-wrap items-center gap-2">

                    {{-- SEBELUMNYA --}}
                    @if($rekaps->onFirstPage())
                        <span class="rp-page-link disabled">
                            <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m15 18-6-6 6-6"/>
                            </svg>
                            Sebelumnya
                        </span>
                    @else
                        <a href="{{ $rekaps->previousPageUrl() }}" class="rp-page-link">
                            <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m15 18-6-6 6-6"/>
                            </svg>
                            Sebelumnya
                        </a>
                    @endif

                    {{-- SELANJUTNYA --}}
                    @if($rekaps->hasMorePages())
                        <a href="{{ $rekaps->nextPageUrl() }}" class="rp-page-link">
                            Selanjutnya
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/>
                            </svg>
                        </a>
                    @else
                        <span class="rp-page-link disabled">
                            Selanjutnya
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/>
                            </svg>
                        </span>
                    @endif

                </div>
            </div>
        @endif
    </div>

    <div class="pb-2 text-center text-xs text-slate-400 dark:text-slate-500">
        Sistem Akademik Mini
    </div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const formImport = document.querySelector(
        'form[action="{{ route('guru.nilai.import') }}"]'
    );

    if (!formImport) return;

    const tombolImport = formImport.querySelector('button[type="submit"]');

    if (!tombolImport) return;

    let sedangMemproses = false;

    formImport.addEventListener('submit', function (event) {
        if (sedangMemproses) {
            event.preventDefault();
            return;
        }

        if (!formImport.checkValidity()) {
            return;
        }

        sedangMemproses = true;
        tombolImport.disabled = true;
        tombolImport.textContent = 'Memproses...';
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const formHapus = document.querySelectorAll(
        'form[action*="/destroy"], form[method="POST"][onsubmit]'
    );

    formHapus.forEach(function (form) {
        const tombol = form.querySelector('button[type="submit"]');

        if (!tombol) return;

        let sedangMemproses = false;

        form.addEventListener('submit', function (event) {
            if (sedangMemproses) {
                event.preventDefault();
                return;
            }

            sedangMemproses = true;
            tombol.disabled = true;
            tombol.innerHTML = '<span class="text-xs">...</span>';
        });
    });
});
</script>
@endsection