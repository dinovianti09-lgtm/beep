@extends('layouts.admin')

@section('title', 'Rapor Siswa - Sistem Akademik Mini')
@section('page-title', 'Rapor Siswa')
@section('page-subtitle', 'Kelola rapor siswa berdasarkan periode rapor.')

@section('content')

<style>
    .rs-page {
        color: #293F57;
    }

    .rs-hero {
        background: linear-gradient(115deg, #C3E0F4 0%, #E3F0FA 58%, #F8FAFC 100%);
        border: 1px solid #BDD6EE;
        border-radius: 17px;
    }

    .rs-card {
        background: #FFFFFF;
        border: 1px solid #D5E1ED;
        border-radius: 15px;
        overflow: hidden;
    }

    .rs-muted {
        color: #526982;
    }

    /* INPUT FILTER */

    .rs-input {
        width: 100%;
        border: 1px solid #D5E1ED;
        border-radius: 10px;
        background: #F8FAFC;
        color: #293F57;
        padding: 11px 13px;
        font-size: 12px;
        outline: none;
        transition: .2s ease;
    }

    .rs-input:focus {
        border-color: #3478BD;
        background: #FFFFFF;
        box-shadow: 0 0 0 3px rgba(52, 120, 189, .12);
    }

    .rs-label {
        display: block;
        margin-bottom: 8px;
        color: #526982;
        font-size: 12px;
        font-weight: 700;
    }

    /* BUTTON FILTER */

    .rs-primary-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 11px 17px;
        min-height: 44px;
        border-radius: 9px;
        background: #3478BD;
        color: white;
        font-size: 12px;
        font-weight: 800;
        transition: .2s ease;
    }

    .rs-primary-btn:hover {
        background: #285F96;
        transform: translateY(-1px);
    }

    .rs-secondary-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 11px 17px;
        min-height: 44px;
        border: 1px solid #D5E1ED;
        border-radius: 9px;
        background: #FFFFFF;
        color: #526982;
        font-size: 12px;
        font-weight: 800;
        transition: .2s ease;
    }

    .rs-secondary-btn:hover {
        background: #F1F6FB;
        border-color: #BDD6EE;
    }

    /* TABLE */

    .rs-table {
        width: 100%;
        min-width: 1100px;
        border-collapse: separate;
        border-spacing: 0;
    }

    .rs-table th {
        padding: 15px 17px;
        background: #EAF4FF;
        color: #526982;
        border-right: 1px solid #D7E5F3;
        border-bottom: 1px solid #CFDEED;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .05em;
        white-space: nowrap;
    }

    .rs-table th:last-child,
    .rs-table td:last-child {
        border-right: none;
    }

    .rs-table td {
        padding: 15px 17px;
        color: #293F57;
        border-right: 1px solid #E0E9F3;
        border-bottom: 1px solid #E0E9F3;
        font-size: 12px;
        vertical-align: middle;
    }

    .rs-table tbody tr:nth-child(even) {
        background: #F9FBFE;
    }

    .rs-table tbody tr:hover {
        background: #EDF6FF;
    }

    .rs-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* BADGE PERIODE */

    .rs-period-badge {
        display: inline-flex;
        padding: 6px 10px;
        border: 1px solid #C8DCEE;
        border-radius: 8px;
        background: #EAF4FF;
        color: #3478BD;
        font-size: 10px;
        font-weight: 800;
        white-space: nowrap;
    }

    .rs-period-genap {
        border-color: #AFC7E2;
        background: #C9DDF1;
        color: #315D89;
    }

    /* STATUS RAPOR */

    .rs-status {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 800;
        white-space: nowrap;
    }

    .rs-status-complete {
        background: #E8F7EF;
        color: #218454;
    }

    .rs-status-warning {
        background: #FFF4DB;
        color: #A66A08;
    }

    .rs-status-incomplete {
        background: #FDECEC;
        color: #C24A4A;
    }

    .rs-status-empty {
        background: #EEF2F7;
        color: #64748B;
    }

    .rs-status-neutral {
        background: #EEF2F7;
        color: #526982;
    }

    /* TOMBOL AKSI */

    .rs-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 8px 11px;
        min-height: 44px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 800;
        transition: .2s ease;
    }

    .rs-action svg {
        flex-shrink: 0;
    }

    .rs-view-btn {
        border: 1px solid #D5E5F5;
        background: #EAF4FF;
        color: #3478BD;
    }

    .rs-view-btn:hover {
        border-color: #3478BD;
        background: #3478BD;
        color: #FFFFFF;
    }

    /* HAPUS */

    .rs-delete-btn {
        border: 1px solid #F1D1D5;
        background: #FFF0F1;
        color: #A93649;
    }

    .rs-delete-btn:hover {
        border-color: #C9475D;
        background: #C9475D;
        color: #FFFFFF;
    }

    .rs-delete-btn svg {
        width: 16px;
        height: 16px;
    }

    /* NOTIFIKASI */

    .rs-alert-success {
        border: 1px solid #BBF7D0;
        background: #ECFDF5;
        color: #047857;
    }

    .rs-alert-error {
        border: 1px solid #FECACA;
        background: #FEF2F2;
        color: #B91C1C;
    }

    /* =====================================================
       PAGINATION
       HANYA SEBELUMNYA DAN SELANJUTNYA
    ===================================================== */

    .rs-pagination {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        padding: 16px 20px;
        border-top: 1px solid #D5E1ED;
        background: #FFFFFF;
    }

    .rs-pagination-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
    }

    .rs-page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 44px;
        padding: 8px 14px;
        border: 1px solid #C8DCEE;
        border-radius: 8px;
        background: #FFFFFF;
        color: #3478BD;
        font-size: 12px;
        font-weight: 800;
        text-decoration: none;
        transition: background .18s ease, border-color .18s ease;
    }

    .rs-page-link:hover {
        border-color: #A4BFDF;
        background: #E3F0FA;
    }

    .rs-page-link-disabled {
        border-color: #E0E7EF;
        background: #F4F7FA;
        color: #9AA9B9;
        cursor: not-allowed;
    }

    /* DARK MODE */

    .dark .rs-page {
        color: #E4ECF6;
    }

    .dark .rs-hero {
        background: linear-gradient(115deg, #243E59 0%, #1C3049 58%, #17283D 100%);
        border-color: #354962;
    }

    .dark .rs-card {
        background: #192438;
        border-color: #354962;
    }

    .dark .rs-muted {
        color: #A7B8CC;
    }

    .dark .rs-input {
        background: #1C3049;
        border-color: #3A5068;
        color: #E4ECF6;
    }

    .dark .rs-input:focus {
        background: #243E59;
        border-color: #6CA7DE;
    }

    .dark .rs-input option {
        background: #192438;
        color: #E4ECF6;
    }

    .dark .rs-label {
        color: #C1D0E1;
    }

    .dark .rs-secondary-btn {
        background: #24364D;
        border-color: #3A5068;
        color: #D3DFEC;
    }

    .dark .rs-secondary-btn:hover {
        background: #304966;
    }

    .dark .rs-table th {
        background: #263E59;
        color: #C1D0E1;
        border-color: #3A5068;
    }

    .dark .rs-table td {
        color: #E4ECF6;
        border-color: #354962;
    }

    .dark .rs-table tbody tr:nth-child(even) {
        background: #1C2B40;
    }

    .dark .rs-table tbody tr:hover {
        background: #243E59;
    }

    .dark .rs-period-badge {
        background: #243E59;
        border-color: #3A5876;
        color: #A9D2F5;
    }

    .dark .rs-period-genap {
        background: #315071;
        border-color: #496D91;
        color: #D2E7FA;
    }

    /* STATUS DARK MODE */

    .dark .rs-status-complete {
        background: #12372F;
        color: #86EFAC;
    }

    .dark .rs-status-warning {
        background: #3F3116;
        color: #FCD34D;
    }

    .dark .rs-status-incomplete {
        background: #3B2028;
        color: #FCA5A5;
    }

    .dark .rs-status-empty {
        background: #304158;
        color: #C1D0E1;
    }

    .dark .rs-status-neutral {
        background: #304158;
        color: #C1D0E1;
    }

    /* BUTTON DARK MODE */

    .dark .rs-view-btn {
        background: #263E59;
        border-color: #3A5876;
        color: #A9D2F5;
    }

    .dark .rs-view-btn:hover {
        background: #3478BD;
        color: white;
    }

    /* HAPUS DARK MODE */

    .dark .rs-delete-btn {
        color: #FFC5CD;
        background: #432A35;
        border-color: #65404B;
    }

    .dark .rs-delete-btn:hover {
        color: #FFFFFF;
        background: #B83B52;
        border-color: #B83B52;
    }

    /* NOTIFIKASI DARK MODE */

    .dark .rs-alert-success {
        background: #12372F;
        border-color: #23604D;
        color: #86EFAC;
    }

    .dark .rs-alert-error {
        background: #3B2028;
        border-color: #693541;
        color: #FCA5A5;
    }

    /* PAGINATION DARK MODE */

    .dark .rs-pagination {
        border-color: #354962;
        background: #192438;
    }

    .dark .rs-page-link {
        border-color: #405773;
        background: #24364D;
        color: #D5E5F8;
    }

    .dark .rs-page-link:hover {
        background: #2F4865;
    }

    .dark .rs-page-link-disabled {
        border-color: #35465D;
        background: #1D2B3E;
        color: #71849A;
    }

    /* RESPONSIVE */

    @media (max-width: 640px) {
        .rs-action-wrapper {
            flex-direction: column;
        }

        .rs-action-wrapper form,
        .rs-action-wrapper a,
        .rs-action-wrapper button {
            width: 100%;
        }

        .rs-pagination {
            padding: 16px;
        }

        .rs-pagination-actions {
            width: 100%;
            justify-content: flex-end;
        }
    }
</style>


<div class="rs-page space-y-6 p-6 lg:p-8">

    {{-- HERO HEADER --}}
    <div class="rs-hero flex flex-col gap-5 p-6 sm:flex-row sm:items-center sm:justify-between lg:p-7">

        <div class="flex items-center gap-4">

            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-white/60 bg-white/70 text-[#3478BD] shadow-sm dark:border-slate-500/20 dark:bg-slate-800/40 dark:text-blue-300">

                <svg xmlns="http://www.w3.org/2000/svg"
                    width="27"
                    height="27"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <path d="M14 2v6h6"/>
                    <path d="M8 13h8"/>
                    <path d="M8 17h8"/>
                </svg>

            </div>

            <div>
                <p class="mb-1 text-xs font-bold uppercase tracking-wider text-[#3478BD] dark:text-blue-300">
                    Manajemen Akademik
                </p>

                <h2 class="text-xl font-extrabold text-[#293F57] dark:text-white lg:text-2xl">
                    Data Rapor Siswa
                </h2>

                <p class="mt-1 text-xs text-[#526982] dark:text-slate-300 sm:text-sm">
                    Pantau kelengkapan rapor siswa berdasarkan periode.
                </p>
            </div>

        </div>

        <div class="inline-flex w-fit items-center gap-2 rounded-full border border-[#D5E5F5] bg-[#EAF4FF] px-4 py-2.5 text-xs font-bold text-[#3478BD] dark:border-[#3A5876] dark:bg-[#263E59] dark:text-blue-300">
            <span class="h-2 w-2 rounded-full bg-[#3478BD]"></span>
            {{ $raporSiswaList->total() }} Data Ditampilkan
        </div>

    </div>


    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="rs-alert-success flex items-center gap-3 rounded-xl p-4 text-sm font-semibold">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white/70 font-bold dark:bg-black/10">
                ✓
            </span>

            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="rs-alert-error flex items-center gap-3 rounded-xl p-4 text-sm font-semibold">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white/70 font-bold dark:bg-black/10">
                !
            </span>

            {{ session('error') }}
        </div>
    @endif


    {{-- FILTER --}}
    <div class="rs-card">

        <div class="border-b border-[#D5E1ED] px-6 py-5 dark:border-[#354962]">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#EAF4FF] text-[#3478BD] dark:bg-[#263E59] dark:text-blue-300">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="19"
                        height="19"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M4 5h16"/>
                        <path d="M7 12h10"/>
                        <path d="M10 19h4"/>
                    </svg>

                </div>

                <div>
                    <h3 class="text-sm font-extrabold text-[#293F57] dark:text-white">
                        Pencarian dan Filter
                    </h3>

                    <p class="mt-1 text-xs rs-muted">
                        Sesuaikan data rapor berdasarkan periode dan identitas siswa.
                    </p>
                </div>

            </div>

        </div>


        <form
            id="filter-rapor-form"
            method="GET"
            action="{{ route('admin.rapor_siswa.index') }}"
            autocomplete="off"
            class="grid grid-cols-1 gap-5 p-6 sm:grid-cols-2 lg:grid-cols-3"
        >

            {{-- PERIODE --}}
            <div>

                <label for="filter-periode" class="rs-label">
                    Semester dan Tahun Ajaran
                </label>

                <select
                    id="filter-periode"
                    name="id_rapor"
                    class="rs-input"
                >

                    <option value="all" @selected($idRaporTerpilih === 'all')>
                        Semua Semester
                    </option>

                    @foreach($periodeList as $item)

                        @php
                            $semesterItem = strtolower(trim((string) $item->semester));

                            if (in_array($semesterItem, ['1', 'ganjil'], true)) {
                                $labelSemester = 'Ganjil';
                            } elseif (in_array($semesterItem, ['2', 'genap'], true)) {
                                $labelSemester = 'Genap';
                            } else {
                                $labelSemester = $item->semester;
                            }
                        @endphp

                        <option
                            value="{{ $item->id_rapor }}"
                            @selected((string) $idRaporTerpilih === (string) $item->id_rapor)
                        >
                            {{ $labelSemester }} - {{ $item->tahun_ajaran }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- JURUSAN --}}
            <div>

                <label for="filter-jurusan" class="rs-label">
                    Jurusan
                </label>

                <select
                    id="filter-jurusan"
                    name="jurusan"
                    class="rs-input"
                >

                    <option value="">
                        Semua Jurusan
                    </option>

                    @foreach($jurusanList as $jurusan)

                        <option
                            value="{{ $jurusan }}"
                            @selected(request('jurusan') == $jurusan)
                        >
                            {{ $jurusan }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- TINGKAT --}}
            <div>

                <label for="filter-tingkat" class="rs-label">
                    Tingkat
                </label>

                <select
                    id="filter-tingkat"
                    name="tingkat"
                    class="rs-input"
                >

                    <option value="">
                        Semua Tingkat
                    </option>

                </select>

            </div>


            {{-- KELAS --}}
            <div>

                <label for="filter-kelas" class="rs-label">
                    Kelas
                </label>

                <select
                    id="filter-kelas"
                    name="kelas"
                    class="rs-input"
                >

                    <option value="">
                        Semua Kelas
                    </option>

                    @foreach($kelasList as $kelas)

                        <option
                            value="{{ $kelas->nama_kelas }}"
                            data-jurusan="{{ $kelas->jurusan }}"
                            data-tingkat="{{ $kelas->tingkat }}"
                            @selected(request('kelas') == $kelas->nama_kelas)
                        >
                            {{ $kelas->nama_kelas }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- PENCARIAN NAMA SISWA / NIS --}}
            <div>

                <label for="filter-search" class="rs-label">
                    Nama Siswa / NIS
                </label>

                <input
                    type="hidden"
                    name="search"
                    id="filter-search-value"
                    value="{{ request('search') }}"
                >

                <input
                    type="text"
                    id="filter-search"
                    placeholder="Cari nama atau NIS..."
                    autocomplete="off"
                    autocorrect="off"
                    autocapitalize="off"
                    spellcheck="false"
                    class="rs-input"
                >

            </div>


            {{-- TOMBOL --}}
            <div class="flex flex-wrap items-end gap-2">

                <button type="submit" class="rs-primary-btn">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="15"
                        height="15"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round">
                        <path d="M4 5h16"/>
                        <path d="M7 12h10"/>
                        <path d="M10 19h4"/>
                    </svg>

                    Terapkan Filter
                </button>

                <a
                    href="{{ route('admin.rapor_siswa.index') }}"
                    class="rs-secondary-btn"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- TABEL RAPOR SISWA --}}
    <div class="rs-card">

        {{-- TABLE HEADER --}}
        <div class="flex flex-col gap-2 border-b border-[#D5E1ED] px-6 py-5 dark:border-[#354962] sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h3 class="text-base font-extrabold text-[#293F57] dark:text-white">
                    Daftar Rapor Siswa
                </h3>

                <p class="mt-1 text-xs rs-muted">
                    @if($periode)
                        Periode:
                        {{ $periode->semester }} - {{ $periode->tahun_ajaran }}
                    @else
                        Menampilkan seluruh semester dan tahun ajaran.
                    @endif
                </p>
            </div>

            <span class="text-xs font-semibold rs-muted">
                Total: {{ $raporSiswaList->total() }} data
            </span>

        </div>


        {{-- TABLE --}}
        <div class="w-full overflow-x-auto">

            <table class="rs-table">

                <colgroup>
                    <col style="width: 5%">
                    <col style="width: 18%">
                    <col style="width: 9%">
                    <col style="width: 15%">
                    <col style="width: 10%">
                    <col style="width: 16%">
                    <col style="width: 12%">
                    <col style="width: 15%">
                </colgroup>

                <thead>
                    <tr>

                        <th class="text-left">
                            No
                        </th>

                        <th class="text-left">
                            Siswa
                        </th>

                        <th class="text-left">
                            Kelas
                        </th>

                        <th class="text-left">
                            Periode
                        </th>

                        <th class="text-center">
                            Jumlah Nilai
                        </th>

                        <th class="text-left">
                            Status Rapor
                        </th>

                        <th class="text-left">
                            Tanggal Cetak
                        </th>

                        <th class="text-center">
                            Aksi
                        </th>

                    </tr>
                </thead>


                <tbody>

                    @forelse($raporSiswaList as $index => $item)

                        <tr>

                            {{-- NOMOR --}}
                            <td class="font-bold rs-muted">
                                {{ $raporSiswaList->firstItem() + $index }}
                            </td>


                            {{-- SISWA --}}
                            <td>

                                <p class="font-extrabold text-[#293F57] dark:text-white">
                                    {{ $item->siswa->nama_siswa }}
                                </p>

                                <p class="mt-1 text-[11px] rs-muted">
                                    NIS: {{ $item->siswa->nis }}
                                </p>

                            </td>


                            {{-- KELAS --}}
                            <td>
                                <span class="font-semibold">
                                    {{ $item->siswa->kelas }}
                                </span>
                            </td>


                            {{-- PERIODE --}}
                            <td>

                                @php
                                    $semesterBaris = strtolower(trim((string) $item->rapor->semester));

                                    if (in_array($semesterBaris, ['1', 'ganjil'], true)) {
                                        $labelBaris = 'Ganjil';
                                        $kelasBadge = '';
                                    } elseif (in_array($semesterBaris, ['2', 'genap'], true)) {
                                        $labelBaris = 'Genap';
                                        $kelasBadge = 'rs-period-genap';
                                    } else {
                                        $labelBaris = $item->rapor->semester;
                                        $kelasBadge = '';
                                    }
                                @endphp

                                <div class="flex flex-col items-start gap-1.5">

                                    <span class="rs-period-badge {{ $kelasBadge }}">
                                        {{ $labelBaris }}
                                    </span>

                                    <span class="text-[11px] font-semibold rs-muted">
                                        {{ $item->rapor->tahun_ajaran }}
                                    </span>

                                </div>

                            </td>


                            {{-- JUMLAH NILAI --}}
                            <td class="text-center">

                                <span class="font-bold">
                                    {{ $item->jumlah_nilai }}
                                </span>

                            </td>


                            {{-- STATUS RAPOR --}}
                            <td>

                                @if($item->status_rapor === 'Rapor Lengkap - Tuntas')

                                    <span class="rs-status rs-status-complete">
                                        Rapor Lengkap - Tuntas
                                    </span>

                                @elseif($item->status_rapor === 'Rapor Lengkap - Belum Tuntas')

                                    <span class="rs-status rs-status-warning">
                                        Rapor Lengkap - Belum Tuntas
                                    </span>

                                @elseif($item->status_rapor === 'Rapor Belum Lengkap')

                                    <span class="rs-status rs-status-incomplete">
                                        Rapor Belum Lengkap
                                    </span>

                                @elseif($item->status_rapor === 'Belum Ada Nilai Lengkap')

                                    <span class="rs-status rs-status-empty">
                                        Belum Ada Nilai Lengkap
                                    </span>

                                @else

                                    <span class="rs-status rs-status-neutral">
                                        {{ $item->status_rapor }}
                                    </span>

                                @endif

                            </td>


                            {{-- TANGGAL CETAK --}}
                            <td class="whitespace-nowrap">

                                @if($item->tgl_cetak)
                                    {{ \Carbon\Carbon::parse($item->tgl_cetak)->translatedFormat('d F Y') }}
                                @else
                                    <span class="rs-muted">-</span>
                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td>

                                <div class="flex flex-wrap items-center justify-center gap-2">

                                    @if($item->id_rapor_siswa)

                                        {{-- LIHAT --}}
                                        <a
                                            href="{{ route('admin.rapor_siswa.show', $item->id_rapor_siswa) }}"
                                            class="rs-action rs-view-btn"
                                        >

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                width="14"
                                                height="14"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/>
                                                <circle cx="12" cy="12" r="3"/>
                                            </svg>

                                            Lihat

                                        </a>


                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('admin.rapor_siswa.destroy', $item->id_rapor_siswa) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus rapor siswa ini?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="rs-action rs-delete-btn"
                                            >

                                                <svg
                                                    width="16"
                                                    height="16"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    aria-hidden="true"
                                                >
                                                    <path d="M4 7h16M10 11v6m4-6v6M6 7l1 13h10l1-13M9 7V4h6v3"/>
                                                </svg>

                                                Hapus

                                            </button>

                                        </form>

                                    @else

                                        <span class="text-[11px] font-medium rs-muted">
                                            Rapor belum dibuat
                                        </span>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-[#EAF4FF] text-[#3478BD] dark:bg-[#263E59] dark:text-blue-300">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            width="30"
                                            height="30"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.6"
                                            stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                            <path d="M14 2v6h6"/>
                                            <path d="M8 13h8"/>
                                            <path d="M8 17h5"/>
                                        </svg>

                                    </div>

                                    <h4 class="text-sm font-extrabold text-[#293F57] dark:text-white">
                                        Tidak Ada Data Rapor
                                    </h4>

                                    <p class="mt-2 max-w-sm text-xs rs-muted">
                                        Tidak ada siswa yang sesuai dengan periode atau filter pencarian.
                                    </p>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION RAPOR SISWA --}}
        @if($raporSiswaList->hasPages())

            <div class="rs-pagination">

                <div class="rs-pagination-actions">

                    {{-- SEBELUMNYA --}}
                    @if($raporSiswaList->onFirstPage())

                        <span class="rs-page-link rs-page-link-disabled">
                            ← Sebelumnya
                        </span>

                    @else

                        <a
                            href="{{ $raporSiswaList->previousPageUrl() }}"
                            class="rs-page-link"
                        >
                            ← Sebelumnya
                        </a>

                    @endif


                    {{-- SELANJUTNYA --}}
                    @if($raporSiswaList->hasMorePages())

                        <a
                            href="{{ $raporSiswaList->nextPageUrl() }}"
                            class="rs-page-link"
                        >
                            Selanjutnya →
                        </a>

                    @else

                        <span class="rs-page-link rs-page-link-disabled">
                            Selanjutnya →
                        </span>

                    @endif

                </div>

            </div>

        @endif

    </div>


    {{-- FOOTER --}}
    <p class="pt-2 text-center text-xs text-[#8A9DB1] dark:text-slate-500">
        © {{ date('Y') }} Sistem Akademik Mini
    </p>

</div>


{{-- SCRIPT FILTER DAN PENCARIAN --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('filter-rapor-form');

    const searchInput = document.getElementById('filter-search');

    const hiddenSearch = document.getElementById('filter-search-value');

    const jurusanSelect = document.getElementById('filter-jurusan');

    const tingkatSelect = document.getElementById('filter-tingkat');

    const kelasSelect = document.getElementById('filter-kelas');


    /*
    |--------------------------------------------------------------------------
    | PENCARIAN NAMA SISWA / NIS
    |--------------------------------------------------------------------------
    */

    if (searchInput && hiddenSearch && form) {

        // Kosongkan kolom yang terlihat setiap halaman dibuka.
        searchInput.value = '';

        // Salin teks pencarian hanya ketika form dikirim.
        form.addEventListener('submit', function () {
            hiddenSearch.value = searchInput.value.trim();
        });

        // Pastikan kolom tetap kosong ketika halaman dipulihkan browser.
        window.addEventListener('pageshow', function () {
            searchInput.value = '';
        });

    }


    /*
    |--------------------------------------------------------------------------
    | FILTER JURUSAN → TINGKAT → KELAS
    |--------------------------------------------------------------------------
    */

    if (!jurusanSelect || !tingkatSelect || !kelasSelect) {
        return;
    }

    const semuaKelas = Array.from(kelasSelect.options)
        .filter(option => option.value !== '')
        .map(option => ({
            nama: option.value,
            jurusan: option.dataset.jurusan || '',
            tingkat: option.dataset.tingkat || ''
        }));

    const tingkatAwal = @json((string) request('tingkat'));

    const kelasAwal = @json((string) request('kelas'));


    function perbaruiTingkat(pilihanTingkat = '') {

        const jurusan = jurusanSelect.value;

        const tingkatTersedia = [...new Set(
            semuaKelas
                .filter(k => !jurusan || k.jurusan === jurusan)
                .map(k => k.tingkat)
                .filter(Boolean)
        )];

        tingkatSelect.innerHTML = '';

        const opsiSemua = document.createElement('option');

        opsiSemua.value = '';

        opsiSemua.textContent = 'Semua Tingkat';

        tingkatSelect.appendChild(opsiSemua);


        tingkatTersedia.forEach(tingkat => {

            const option = document.createElement('option');

            option.value = tingkat;

            option.textContent = tingkat;

            tingkatSelect.appendChild(option);

        });


        tingkatSelect.value = tingkatTersedia.includes(pilihanTingkat)
            ? pilihanTingkat
            : '';

        perbaruiKelas(kelasAwal);

    }


    function perbaruiKelas(pilihanKelas = '') {

        const jurusan = jurusanSelect.value;

        const tingkat = tingkatSelect.value;

        const kelasTersedia = semuaKelas.filter(k =>
            (!jurusan || k.jurusan === jurusan) &&
            (!tingkat || k.tingkat === tingkat)
        );

        kelasSelect.innerHTML = '';

        const opsiSemua = document.createElement('option');

        opsiSemua.value = '';

        opsiSemua.textContent = 'Semua Kelas';

        kelasSelect.appendChild(opsiSemua);


        kelasTersedia.forEach(k => {

            const option = document.createElement('option');

            option.value = k.nama;

            option.textContent = k.nama;

            kelasSelect.appendChild(option);

        });


        kelasSelect.value = kelasTersedia.some(k => k.nama === pilihanKelas)
            ? pilihanKelas
            : '';

    }


    // Tampilkan pilihan awal berdasarkan filter sebelumnya.
    perbaruiTingkat(tingkatAwal);


    jurusanSelect.addEventListener('change', function () {
        perbaruiTingkat('');
    });


    tingkatSelect.addEventListener('change', function () {
        perbaruiKelas('');
    });

});
</script>

@endsection