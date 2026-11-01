@extends('layouts.admin')

@section('title', 'Detail Rapor Siswa - Sistem Akademik Mini')
@section('page-title', 'Rapor Siswa')
@section('page-subtitle', 'Detail nilai akademik dan cetak rapor.')

@php
    use Illuminate\Support\Facades\DB;

    // Identitas kelas dan wali kelas.
    $namaKelasSiswa = strtolower(
        str_replace('-', ' ', trim($siswa->kelas ?? ''))
    );

    $kelasData = DB::table('kelas')
        ->whereRaw(
            "LOWER(REPLACE(TRIM(nama_kelas), '-', ' ')) = ?",
            [$namaKelasSiswa]
        )
        ->first();

    $waliKelas = $kelasData->wali_kelas ?? null;
    $nipWaliKelas = null;

    // Ambil NIP berdasarkan nama wali kelas.
    if (!empty($waliKelas)) {
        $guruWaliKelas = DB::table('guru')
            ->whereRaw('TRIM(nama_guru) = ?', [trim($waliKelas)])
            ->first();

        if ($guruWaliKelas) {
            $waliKelas = $guruWaliKelas->nama_guru;
            $nipWaliKelas = $guruWaliKelas->nip;
        }
    }

    // Identitas kepala sekolah.
    $pengaturanSekolah = DB::table('pengaturan_sekolah')->first();

    $kepalaSekolah = $pengaturanSekolah->nama_kepala_sekolah
        ?? 'Ahmad Fadilah';

    $nipKepalaSekolah = $pengaturanSekolah->nip_kepala_sekolah
        ?? '';

    // Mata pelajaran wajib berdasarkan jurusan dan tingkat kelas.
    $mapelWajib = collect();

    if ($kelasData) {
        $mapelWajib = DB::table('mapel_kelas')
            ->join(
                'mapel',
                'mapel.id_mapel',
                '=',
                'mapel_kelas.id_mapel'
            )
            ->whereRaw(
                'LOWER(TRIM(mapel_kelas.jurusan)) = ?',
                [strtolower(trim($kelasData->jurusan ?? ''))]
            )
            ->whereRaw(
                'LOWER(TRIM(mapel_kelas.tingkat)) = ?',
                [strtolower(trim($kelasData->tingkat ?? ''))]
            )
            ->select(
                'mapel.id_mapel',
                'mapel.nama_mapel',
                'mapel.kkm'
            )
            ->distinct()
            ->orderBy('mapel.nama_mapel')
            ->get();
    }

    // Cocokkan mata pelajaran wajib dengan nilai siswa.
    $daftarNilai = collect($nilais ?? []);

    if ($mapelWajib->isNotEmpty()) {
        $barisRapor = $mapelWajib->map(function ($mapel) use ($daftarNilai) {
            $nilai = $daftarNilai->first(function ($item) use ($mapel) {
                return (string) $item->id_mapel
                    === (string) $mapel->id_mapel;
            });

            return (object) [
                'id_mapel' => $mapel->id_mapel,
                'nama_mapel' => $mapel->nama_mapel,
                'kkm' => $mapel->kkm,
                'nilai' => $nilai,
            ];
        });
    } else {
        // Fallback jika pemetaan mata pelajaran wajib belum tersedia.
        $barisRapor = $daftarNilai
            ->unique('id_mapel')
            ->map(function ($nilai) {
                return (object) [
                    'id_mapel' => $nilai->id_mapel,
                    'nama_mapel' => $nilai->mapel->nama_mapel ?? '-',
                    'kkm' => $nilai->mapel->kkm ?? null,
                    'nilai' => $nilai,
                ];
            })
            ->values();
    }

    // Periksa kelengkapan komponen nilai.
    $nilaiLengkap = function ($nilai) {
        return $nilai
            && is_numeric($nilai->nilai_harian)
            && is_numeric($nilai->nilai_uts)
            && is_numeric($nilai->nilai_uas)
            && is_numeric($nilai->nilai_akhir);
    };

    $jumlahSeluruhMapel = $barisRapor->count();

    $nilaiTerisi = $barisRapor->filter(function ($baris) use ($nilaiLengkap) {
        return $nilaiLengkap($baris->nilai);
    });

    $jumlahMapel = $nilaiTerisi->count();

    $jumlahMapelBelumLengkap = $barisRapor->filter(
        function ($baris) use ($nilaiLengkap) {
            return !$nilaiLengkap($baris->nilai);
        }
    )->count();

    // Rata-rata menggunakan nilai akhir yang lengkap.
    $rataRataRapor = $jumlahMapel > 0
        ? round(
            $nilaiTerisi->avg(
                fn ($baris) => (float) $baris->nilai->nilai_akhir
            ),
            2
        )
        : null;

    $daftarMapelTersedia = $mapelWajib->isNotEmpty();

    $raporLengkap = $daftarMapelTersedia
        && $jumlahSeluruhMapel > 0
        && $jumlahMapelBelumLengkap === 0;

    // Status berdasarkan nilai akhir dan KKM.
    $statusNilai = function ($baris) {
        $nilai = $baris->nilai;
        $kkm = $baris->kkm;

        if (!$nilai || !is_numeric($nilai->nilai_akhir)) {
            return 'Belum dinilai';
        }

        if (!is_numeric($kkm)) {
            return 'KKM belum diatur';
        }

        return (float) $nilai->nilai_akhir >= (float) $kkm
            ? 'Tuntas'
            : 'Remedial';
    };

    // Format angka nilai.
    $formatNilai = function ($nilai, $kolom) {
        if (!$nilai || !is_numeric($nilai->{$kolom} ?? null)) {
            return 'Belum diinput';
        }

        return number_format(
            (float) $nilai->{$kolom},
            2,
            ',',
            '.'
        );
    };

    $formatKKM = function ($kkm) {
        return is_numeric($kkm)
            ? number_format((float) $kkm, 2, ',', '.')
            : 'Belum diatur';
    };

    $formatJumlah = function ($data, $kolom) {
        if (!$data || !is_numeric($data->{$kolom} ?? null)) {
            return 0;
        }

        return (int) $data->{$kolom};
    };

    $dataKehadiran = $kehadiran ?? null;
    $daftarEkstrakurikuler = collect($ekstrakurikulerList ?? []);
@endphp


@push('styles')
<style>
    /* =========================================
       HALAMAN DETAIL RAPOR
    ========================================= */

    .rs-show-page {
        color: #293F57;
    }

    .rs-show-hero {
        background: linear-gradient(
            115deg,
            #C3E0F4 0%,
            #E3F0FA 58%,
            #F8FAFC 100%
        );
        border: 1px solid #BDD6EE;
        border-radius: 17px;
    }

    .rs-show-muted {
        color: #526982;
    }

    .rs-show-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border-radius: 10px;
        padding: 11px 17px;
        font-size: 12px;
        font-weight: 800;
        transition: .2s ease;
    }

    .rs-show-back {
        background: #FFFFFF;
        border: 1px solid #D5E1ED;
        color: #526982;
    }

    .rs-show-back:hover {
        background: #F1F6FB;
        border-color: #BDD6EE;
    }

    .rs-show-print {
        background: #3478BD;
        border: 1px solid #3478BD;
        color: #FFFFFF;
        box-shadow: 0 4px 12px rgba(52, 120, 189, .15);
    }

    .rs-show-print:hover {
        background: #285F96;
        border-color: #285F96;
        transform: translateY(-1px);
    }

    .rs-document-shell {
        overflow: hidden;
        border: 1px solid #D5E1ED;
        border-radius: 16px;
        background: #FFFFFF;
        padding: 22px;
        box-shadow: 0 4px 18px rgba(41, 63, 87, .05);
    }

    /* =========================================
       LEMBAR RAPOR
       Tetap putih agar cocok untuk hasil cetak.
    ========================================= */

    .print-card {
        background: #FFFFFF !important;
        color: #111111 !important;
        color-scheme: light !important;
        font-family: Arial, Helvetica, sans-serif !important;
        font-size: 14px !important;
        line-height: 1.65 !important;
        isolation: isolate;
    }

    .print-card,
    .print-card * {
        box-sizing: border-box;
        opacity: 1 !important;
        text-shadow: none !important;
        -webkit-text-fill-color: currentColor;
    }

    .print-card p,
    .print-card span,
    .print-card div,
    .print-card td,
    .print-card th {
        color: #111111 !important;
    }

    .print-card h1,
    .print-card h2,
    .print-card h3 {
        color: #000000 !important;
        font-weight: 800 !important;
    }

    /* =========================================
       KOP SEKOLAH
    ========================================= */

    .report-school-header {
        display: flex;
        position: relative;
        align-items: center;
        justify-content: center;
        min-height: 125px;
        padding: 10px 10px 20px;
        border-bottom: 4px double #111111 !important;
        background: #FFFFFF !important;
    }

    .school-logo {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        width: 90px;
        height: 90px;
        object-fit: contain;
    }

    .school-heading-content {
        width: 100%;
        text-align: center !important;
        padding: 0 10px;
    }

    .school-heading {
        font-size: 14px !important;
        font-weight: 800 !important;
        text-align: center !important;
    }

    .school-name {
        margin-top: 5px;
        font-size: 25px !important;
        line-height: 1.3 !important;
        font-weight: 900 !important;
        text-align: center !important;
    }

    .school-subheading {
        margin-top: 5px;
        font-size: 13px !important;
        font-weight: 700 !important;
        text-align: center !important;
    }

    .report-title {
        font-size: 21px !important;
        font-weight: 900 !important;
        letter-spacing: 1px;
        text-align: center !important;
    }

    .report-subtitle {
        font-size: 14px !important;
        font-weight: 600 !important;
        text-align: center !important;
    }

    /* =========================================
       IDENTITAS SISWA
    ========================================= */

    .section-heading {
        margin-bottom: 16px;
        padding-bottom: 8px;
        border-bottom: 2px solid #333333 !important;
        font-size: 15px !important;
        font-weight: 900 !important;
    }

    .identity-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px 28px;
        background: #FFFFFF !important;
    }

    .identity-row {
        display: grid;
        grid-template-columns: 125px 12px minmax(0, 1fr);
        gap: 4px;
        align-items: start;
        font-size: 14px !important;
        line-height: 1.8 !important;
    }

    .identity-label,
    .identity-colon {
        font-weight: 600 !important;
    }

    .identity-value {
        font-weight: 800 !important;
        overflow-wrap: anywhere;
    }

    /* =========================================
       TABEL RAPOR
    ========================================= */

    .report-table {
        width: 100%;
        border-collapse: collapse !important;
        background: #FFFFFF !important;
        color: #000000 !important;
        font-size: 12px !important;
    }

    .report-table th,
    .report-table td {
        padding: 8px 6px !important;
        border: 1px solid #555555 !important;
        color: #000000 !important;
        vertical-align: middle !important;
        background: #FFFFFF !important;
        font-size: 12px !important;
        overflow-wrap: anywhere;
    }

    .report-table th {
        background: #E5E7EB !important;
        font-weight: 900 !important;
    }

    /* BARIS REMEDIAL */

    .report-table tbody tr.baris-remedial > td {
        background-color: #FEE2E2 !important;
        color: #DC2626 !important;
        font-weight: 700 !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    .report-table tbody tr.baris-remedial > td span {
        color: #DC2626 !important;
        -webkit-text-fill-color: #DC2626 !important;
    }

    .summary-table th {
        width: 65%;
    }

    .summary-table td,
    .grade-value,
    .final-value {
        font-weight: 900 !important;
    }

    /* STATUS NILAI */

    .print-card .status-tuntas {
        color: #15803D !important;
        -webkit-text-fill-color: #15803D !important;
        font-weight: 800 !important;
    }

    .print-card .status-remedial {
        color: #DC2626 !important;
        -webkit-text-fill-color: #DC2626 !important;
        font-weight: 800 !important;
    }

    .print-card .status-belum {
        color: #64748B !important;
        -webkit-text-fill-color: #64748B !important;
        font-weight: 700 !important;
    }

    /* =========================================
       TANDA TANGAN
    ========================================= */

    .signature-name {
        font-size: 14px !important;
        font-weight: 900 !important;
        text-decoration: underline;
    }

    .signature-role {
        font-size: 13px !important;
        font-weight: 700 !important;
    }

    /* =========================================
       TAMPILAN RESPONSIVE
    ========================================= */

    @media (max-width: 640px) {
        .rs-document-shell {
            padding: 12px;
        }

        .print-card {
            padding: 20px !important;
        }

        .report-school-header {
            min-height: 180px;
            padding-top: 105px;
        }

        .school-logo {
            top: 5px;
            left: 50%;
            transform: translateX(-50%);
            width: 78px;
            height: 78px;
        }

        .school-name {
            font-size: 21px !important;
        }

        .identity-grid {
            grid-template-columns: 1fr !important;
            gap: 8px !important;
        }

        .report-table {
            min-width: 760px;
        }

        .summary-table {
            min-width: 0 !important;
        }
    }

    /* =========================================
       DARK MODE HALAMAN
    ========================================= */

    .dark .rs-show-page {
        color: #E4ECF6;
    }

    .dark .rs-show-hero {
        background: linear-gradient(
            115deg,
            #243E59 0%,
            #1C3049 58%,
            #17283D 100%
        );
        border-color: #354962;
    }

    .dark .rs-show-muted {
        color: #A7B8CC;
    }

    .dark .rs-show-back {
        background: #24364D;
        border-color: #3A5068;
        color: #D3DFEC;
    }

    .dark .rs-show-back:hover {
        background: #304966;
        border-color: #527393;
    }

    .dark .rs-document-shell {
        background: #192438;
        border-color: #354962;
    }

    /* =========================================
       CETAK RAPOR
    ========================================= */

    @media print {
        @page {
            size: A4 portrait;
            margin: 10mm;
        }

        html,
        body {
            margin: 0 !important;
            padding: 0 !important;
            background: #FFFFFF !important;
            color: #000000 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body * {
            visibility: hidden !important;
        }

        .print-card,
        .print-card * {
            visibility: visible !important;
        }

        .print-card {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 0 !important;
            border: none !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            background: #FFFFFF !important;
            color: #000000 !important;
            font-size: 9pt !important;
        }

        .print-card,
        .print-card * {
            opacity: 1 !important;
        }

        .print-card .report-table tbody tr.baris-remedial > td {
            background-color: #FEE2E2 !important;
            color: #DC2626 !important;
            -webkit-text-fill-color: #DC2626 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .print-card .report-table tbody tr.baris-remedial > td span {
            color: #DC2626 !important;
            -webkit-text-fill-color: #DC2626 !important;
        }

        .print-card .status-tuntas {
            color: #15803D !important;
            -webkit-text-fill-color: #15803D !important;
        }

        .print-card .status-remedial {
            color: #DC2626 !important;
            -webkit-text-fill-color: #DC2626 !important;
        }

        .print-card .status-belum {
            color: #64748B !important;
            -webkit-text-fill-color: #64748B !important;
        }

        .rs-document-shell {
            display: block !important;
            overflow: visible !important;
            border: none !important;
            border-radius: 0 !important;
            padding: 0 !important;
            background: #FFFFFF !important;
            box-shadow: none !important;
        }

        .report-school-header {
            min-height: 95px !important;
            padding: 5px 5px 12px !important;
        }

        .school-logo {
            left: 5px !important;
            width: 65px !important;
            height: 65px !important;
        }

        .school-heading-content {
            padding-left: 55px !important;
        }

        .school-name {
            font-size: 16pt !important;
        }

        .school-heading,
        .school-subheading {
            font-size: 9pt !important;
        }

        .report-title {
            font-size: 14pt !important;
        }

        .identity-grid {
            grid-template-columns: 1fr 1fr !important;
            gap: 5px 10px !important;
        }

        .identity-row,
        .identity-label,
        .identity-colon,
        .identity-value {
            font-size: 8pt !important;
        }

        .report-table {
            min-width: 0 !important;
            width: 100% !important;
            font-size: 7pt !important;
        }

        .report-table th,
        .report-table td {
            padding: 4px 3px !important;
            font-size: 7pt !important;
        }

        .signature-section,
        .report-table tr {
            break-inside: avoid;
        }

        .no-print {
            display: none !important;
        }
    }
</style>
@endpush


@section('content')

<div class="rs-show-page space-y-6 p-6 lg:p-8">

    {{-- HEADER DETAIL RAPOR --}}
    <div class="no-print rs-show-hero flex flex-col gap-5 p-6 sm:flex-row sm:items-center sm:justify-between lg:p-7">

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
                    Detail Rapor Siswa
                </h2>

                <p class="mt-1 text-xs text-[#526982] dark:text-slate-300 sm:text-sm">
                    Periksa hasil belajar dan cetak rapor siswa.
                </p>
            </div>

        </div>

        {{-- TOMBOL AKSI --}}
        <div class="flex flex-wrap gap-2">

            <a
                href="{{ route('admin.rapor_siswa.index') }}"
                class="rs-show-btn rs-show-back"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6"/>
                </svg>

                Kembali
            </a>

            <button
                type="button"
                onclick="window.print()"
                class="rs-show-btn rs-show-print"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="17"
                    height="17"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M6 9V2h12v7"/>
                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
                    <path d="M6 14h12v8H6z"/>
                </svg>

                Cetak Rapor
            </button>

        </div>

    </div>


    {{-- LEMBAR RAPOR --}}
    <div class="rs-document-shell">

        <div class="print-card mx-auto max-w-5xl rounded-xl p-6 sm:p-10">

            {{-- KOP SEKOLAH --}}
            <div class="report-school-header">

                @if (file_exists(public_path('images/logo-sekolah.png')))
                    <img
                        src="{{ asset('images/logo-sekolah.png') }}"
                        alt="Logo sekolah"
                        class="school-logo"
                    >
                @endif

                <div class="school-heading-content">

                    <p class="school-heading uppercase tracking-wider">
                        LEMBAR HASIL BELAJAR SISWA
                    </p>

                    <h1 class="school-name uppercase">
                        SMK BUDI BAKTI CIWIDEY
                    </h1>

                    <p class="school-subheading uppercase">
                        RAPOR HASIL BELAJAR PESERTA DIDIK
                    </p>

                </div>

            </div>


            {{-- JUDUL RAPOR --}}
            <div class="mb-7 mt-6 text-center">

                <h2 class="report-title uppercase">
                    RAPOR SISWA
                </h2>

                <p class="report-subtitle mt-1">
                    Tahun Ajaran {{ $rapor->tahun_ajaran ?? '-' }}
                </p>

            </div>


            {{-- A. IDENTITAS SISWA --}}
            <div class="identity-section mb-7">

                <h3 class="section-heading uppercase">
                    A. Identitas Peserta Didik
                </h3>

                <div class="identity-grid">

                    <div class="identity-row">
                        <span class="identity-label">Nama Siswa</span>
                        <span class="identity-colon">:</span>
                        <span class="identity-value">
                            {{ $siswa->nama_siswa ?? '-' }}
                        </span>
                    </div>

                    <div class="identity-row">
                        <span class="identity-label">NIS</span>
                        <span class="identity-colon">:</span>
                        <span class="identity-value">
                            {{ $siswa->nis ?? '-' }}
                        </span>
                    </div>

                    <div class="identity-row">
                        <span class="identity-label">Kelas</span>
                        <span class="identity-colon">:</span>
                        <span class="identity-value">
                            {{ $siswa->kelas ?? '-' }}
                        </span>
                    </div>

                    <div class="identity-row">
                        <span class="identity-label">Wali Kelas</span>
                        <span class="identity-colon">:</span>
                        <span class="identity-value">
                            {{ $waliKelas ?: 'Belum Ditentukan' }}
                        </span>
                    </div>

                    <div class="identity-row">
                        <span class="identity-label">Semester</span>
                        <span class="identity-colon">:</span>
                        <span class="identity-value">
                            {{ $rapor->semester ?? '-' }}
                        </span>
                    </div>

                    <div class="identity-row">
                        <span class="identity-label">Tahun Ajaran</span>
                        <span class="identity-colon">:</span>
                        <span class="identity-value">
                            {{ $rapor->tahun_ajaran ?? '-' }}
                        </span>
                    </div>

                </div>

            </div>


            {{-- B. CAPAIAN HASIL BELAJAR --}}
            <div class="mb-8">

                <h3 class="section-heading uppercase">
                    B. Capaian Hasil Belajar
                </h3>

                @if (!$daftarMapelTersedia)
                    <div class="no-print mb-4 rounded-xl border border-amber-300 bg-amber-50 px-4 py-3 text-sm text-amber-800">
                        Daftar mata pelajaran wajib untuk kelas ini belum diatur.
                        Tabel menampilkan nilai yang sudah tercatat saja.
                    </div>
                @endif

                <div class="overflow-x-auto">

                    <table class="report-table">

                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-left">Mata Pelajaran</th>
                                <th class="text-center">Harian</th>
                                <th class="text-center">UTS</th>
                                <th class="text-center">UAS</th>
                                <th class="text-center">Nilai Akhir</th>
                                <th class="text-center">KKM</th>
                                <th class="text-center">Predikat</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($barisRapor as $index => $baris)

                                @php
                                    $nilai = $baris->nilai;
                                    $status = $statusNilai($baris);
                                @endphp

                                <tr class="{{ $status === 'Remedial' ? 'baris-remedial' : '' }}">

                                    <td class="text-center">
                                        {{ $index + 1 }}
                                    </td>

                                    <td>
                                        {{ $baris->nama_mapel }}
                                    </td>

                                    <td class="text-center">
                                        {{ $formatNilai($nilai, 'nilai_harian') }}
                                    </td>

                                    <td class="text-center">
                                        {{ $formatNilai($nilai, 'nilai_uts') }}
                                    </td>

                                    <td class="text-center">
                                        {{ $formatNilai($nilai, 'nilai_uas') }}
                                    </td>

                                    <td class="text-center final-value">

                                        @if ($status === 'Remedial')

                                            <span class="status-remedial">
                                                {{ $formatNilai($nilai, 'nilai_akhir') }}
                                            </span>

                                        @elseif ($status === 'Tuntas')

                                            <span class="status-tuntas">
                                                {{ $formatNilai($nilai, 'nilai_akhir') }}
                                            </span>

                                        @else

                                            <span class="status-belum">
                                                {{ $formatNilai($nilai, 'nilai_akhir') }}
                                            </span>

                                        @endif

                                    </td>

                                    <td class="text-center">
                                        {{ $formatKKM($baris->kkm) }}
                                    </td>

                                    <td class="text-center grade-value">
                                        {{ $nilai && filled($nilai->predikat)
                                            ? $nilai->predikat
                                            : 'Belum diinput' }}
                                    </td>

                                    <td class="text-center">

                                        @if ($status === 'Tuntas')

                                            <span class="status-tuntas">
                                                {{ $status }}
                                            </span>

                                        @elseif ($status === 'Remedial')

                                            <span class="status-remedial">
                                                {{ $status }}
                                            </span>

                                        @else

                                            <span class="status-belum">
                                                {{ $status }}
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="9" class="text-center">
                                        Belum ada data mata pelajaran atau nilai untuk rapor ini.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- C. RINGKASAN HASIL BELAJAR --}}
            <div class="mb-8 mt-6">

                <h3 class="section-heading uppercase">
                    C. Ringkasan Hasil Belajar
                </h3>

                <table class="report-table summary-table">

                    <tbody>

                        <tr>
                            <th class="text-left">
                                Jumlah Semua Mata Pelajaran
                            </th>

                            <td class="text-center">
                                {{ $jumlahSeluruhMapel }} Mata Pelajaran
                            </td>
                        </tr>

                        <tr>
                            <th class="text-left">
                                Mata Pelajaran dengan Nilai Lengkap
                            </th>

                            <td class="text-center">
                                {{ $jumlahMapel }} Mata Pelajaran
                            </td>
                        </tr>

                        <tr>
                            <th class="text-left">
                                Mata Pelajaran Belum Lengkap
                            </th>

                            <td class="text-center">
                                {{ $daftarMapelTersedia
                                    ? $jumlahMapelBelumLengkap . ' Mata Pelajaran'
                                    : 'Daftar wajib belum diatur' }}
                            </td>
                        </tr>

                        <tr>
                            <th class="text-left">
                                {{ $raporLengkap
                                    ? 'Rata-rata Nilai Akhir'
                                    : 'Rata-rata Sementara' }}
                            </th>

                            <td class="text-center final-value">
                                {{ $rataRataRapor !== null
                                    ? number_format($rataRataRapor, 2, ',', '.')
                                    : 'Belum tersedia' }}
                            </td>
                        </tr>

                        <tr>
                            <th class="text-left">
                                Status Kelengkapan Rapor
                            </th>

                            <td class="text-center">

                                @if (!$daftarMapelTersedia)

                                    Pemetaan mapel belum tersedia

                                @elseif ($raporLengkap)

                                    Lengkap

                                @else

                                    Belum Lengkap

                                @endif

                            </td>
                        </tr>

                    </tbody>

                </table>

                <p class="mt-2 text-xs text-slate-500">
                    Rata-rata dihitung dari mata pelajaran yang memiliki nilai harian,
                    UTS, UAS, dan nilai akhir lengkap.
                </p>

            </div>


            {{-- D. KEHADIRAN SISWA --}}
            <div class="mb-8">

                <h3 class="section-heading uppercase">
                    D. Kehadiran Siswa
                </h3>

                <table class="report-table summary-table">

                    <thead>
                        <tr>
                            <th class="text-left">
                                Keterangan
                            </th>

                            <th class="text-center">
                                Jumlah Hari
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>Sakit</td>

                            <td class="text-center">
                                {{ $formatJumlah($dataKehadiran, 'sakit') }}
                            </td>
                        </tr>

                        <tr>
                            <td>Izin</td>

                            <td class="text-center">
                                {{ $formatJumlah($dataKehadiran, 'izin') }}
                            </td>
                        </tr>

                        <tr>
                            <td>Tanpa Keterangan</td>

                            <td class="text-center">
                                {{ $formatJumlah($dataKehadiran, 'tanpa_keterangan') }}
                            </td>
                        </tr>

                    </tbody>

                </table>

                @if (!$dataKehadiran)
                    <p class="mt-2 text-sm">
                        Data kehadiran belum diinput oleh Guru.
                    </p>
                @endif

            </div>


            {{-- E. EKSTRAKURIKULER --}}
            <div class="mb-8">

                <h3 class="section-heading uppercase">
                    E. Ekstrakurikuler
                </h3>

                <table class="report-table">

                    <thead>
                        <tr>

                            <th class="text-center">
                                No.
                            </th>

                            <th class="text-left">
                                Kegiatan Ekstrakurikuler
                            </th>

                            <th class="text-center">
                                Predikat
                            </th>

                            <th class="text-left">
                                Keterangan
                            </th>

                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($daftarEkstrakurikuler as $index => $ekskul)

                            <tr>

                                <td class="text-center">
                                    {{ $index + 1 }}
                                </td>

                                <td>
                                    {{ $ekskul->nama_ekstrakurikuler ?: '-' }}
                                </td>

                                <td class="text-center">
                                    {{ $ekskul->predikat ?: '-' }}
                                </td>

                                <td>
                                    {{ $ekskul->keterangan ?: '-' }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center">
                                    Belum ada data ekstrakurikuler untuk periode ini.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- TANDA TANGAN --}}
            <div class="signature-section mt-12 grid grid-cols-2 gap-6">

                {{-- KEPALA SEKOLAH --}}
                <div class="w-full text-center">

                    <p>Mengetahui,</p>

                    <p class="signature-role mt-1">
                        Kepala Sekolah
                    </p>

                    <div style="height: 80px;"></div>

                    <p class="signature-name">
                        {{ $kepalaSekolah ?: 'Nama Kepala Sekolah' }}
                    </p>

                    <p>
                        NIP. {{ $nipKepalaSekolah ?: '…………………' }}
                    </p>

                </div>


                {{-- WALI KELAS --}}
                <div class="w-full text-center">

                    <p>
                        Bandung, {{ now()->translatedFormat('d F Y') }}
                    </p>

                    <p class="signature-role mt-1">
                        Wali Kelas {{ $siswa->kelas ?? '-' }}
                    </p>

                    <div style="height: 80px;"></div>

                    <p class="signature-name">
                        {{ $waliKelas ?: 'Wali Kelas Belum Ditentukan' }}
                    </p>

                    <p>
                        NIP. {{ $nipWaliKelas ?: '…………………' }}
                    </p>

                </div>

            </div>


            {{-- FOOTER DOKUMEN --}}
            <div class="mt-8 border-t border-slate-300 pt-4 text-center text-xs">
                Dokumen ini dibuat melalui Sistem Akademik Mini.
            </div>

        </div>

    </div>

</div>

@endsection