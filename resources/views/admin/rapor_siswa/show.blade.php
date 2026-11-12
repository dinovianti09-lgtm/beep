@extends('layouts.admin')

@section('title', 'Detail Rapor Siswa - Sistem Akademik Mini')
@section('page-title', 'Rapor Siswa')
@section('page-subtitle', 'Detail nilai akademik dan cetak rapor.')

@php
    use Illuminate\Support\Facades\DB;

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

    if (!empty($waliKelas)) {
        $guruWaliKelas = DB::table('guru')
            ->whereRaw('TRIM(nama_guru) = ?', [trim($waliKelas)])
            ->first();

        if ($guruWaliKelas) {
            $waliKelas = $guruWaliKelas->nama_guru;
            $nipWaliKelas = $guruWaliKelas->nip;
        }
    }

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

    // Status nilai: komponen harus lengkap sebelum dibandingkan dengan KKM.
    $statusNilai = function ($baris) use ($nilaiLengkap) {
        $nilai = $baris->nilai;
        $kkm = $baris->kkm;

        if (!$nilaiLengkap($nilai)) {
            return 'Belum lengkap';
        }

        if (!is_numeric($kkm)) {
            return 'KKM belum diatur';
        }

        return (float) $nilai->nilai_akhir >= (float) $kkm
            ? 'Tuntas'
            : 'Remedial';
    };

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
       TAMPILAN HALAMAN
    ========================================= */

    .rs-show-page {
        color: #293F57;
        min-width: 0;
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

    /* =========================================
       WADAH RAPOR
    ========================================= */

    .rs-document-shell {
        width: 100%;
        max-width: 100%;
        min-width: 0;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        border: 1px solid #D5E1ED;
        border-radius: 16px;
        background: #FFFFFF;
        padding: 22px;
        box-shadow: 0 4px 18px rgba(41, 63, 87, .05);
    }

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
    }

    .print-card p:not(.text-remedial),
    .print-card span:not(.text-remedial),
    .print-card div:not(.text-remedial),
    .print-card td:not(.text-remedial),
    .print-card th:not(.text-remedial) {
        color: #111111;
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
       TABEL LAPTOP DAN HP
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
        vertical-align: middle !important;
        background: #FFFFFF !important;
        font-size: 12px !important;
        overflow-wrap: anywhere;
    }

    .report-table th {
        font-weight: 900 !important;
    }

    .summary-table th {
        width: 65%;
    }

    .summary-table td,
    .grade-value,
    .final-value {
        font-weight: 800 !important;
    }

    .text-remedial,
    td.text-remedial,
    span.text-remedial {
        color: #DC2626 !important;
        font-weight: 900 !important;
    }

    .text-tuntas {
        color: #111111 !important;
        font-weight: 700 !important;
    }

    .text-belum {
        color: #64748B !important;
        font-weight: 600 !important;
    }

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
       RESPONSIVE HP - TULISAN LEBIH JELAS
    ========================================= */

    @media screen and (max-width: 640px) {

        /* Area halaman admin mengikuti lebar layar HP */
        .rs-show-page {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            padding: 12px !important;
            overflow-x: hidden;
        }

        .rs-show-hero {
            padding: 15px !important;
            gap: 14px !important;
            border-radius: 14px;
        }

        .rs-show-hero > div:first-child {
            min-width: 0;
            align-items: flex-start;
        }

        .rs-show-hero h2 {
            font-size: 18px !important;
            line-height: 1.3 !important;
        }

        .rs-show-hero p {
            line-height: 1.5;
        }

        .rs-show-hero > div:last-child {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
        }

        .rs-show-hero > div:last-child form,
        .rs-show-hero > div:last-child form button,
        .rs-show-hero > div:last-child > a,
        .rs-show-hero > div:last-child > button {
            width: 100%;
        }

        .rs-show-btn {
            min-height: 42px;
            padding: 10px 9px;
            font-size: 11px;
            white-space: normal;
            text-align: center;
        }

        /* Kartu rapor tidak lagi memaksa seluruh halaman melebar */
        .rs-document-shell {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            padding: 10px !important;
            overflow: hidden !important;
            border-radius: 12px;
        }

        .print-card {
            width: 100% !important;
            min-width: 0 !important;
            max-width: 100% !important;
            margin: 0 !important;
            padding: 14px !important;
            border-radius: 10px !important;
            font-size: 11px !important;
            line-height: 1.45 !important;
        }

        /* Kop sekolah tetap seimbang dan logo tidak menimpa judul */
        .report-school-header {
            min-height: 88px !important;
            padding: 8px 5px 12px 58px !important;
        }

        .school-logo {
            position: absolute !important;
            left: 2px !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            width: 48px !important;
            height: 48px !important;
        }

        .school-heading-content {
            width: 100% !important;
            padding: 0 !important;
            text-align: center !important;
        }

        .school-heading {
            font-size: 8px !important;
            line-height: 1.25 !important;
        }

        .school-name {
            margin-top: 3px !important;
            font-size: 13px !important;
            line-height: 1.2 !important;
            overflow-wrap: anywhere;
        }

        .school-subheading {
            margin-top: 3px !important;
            font-size: 8px !important;
            line-height: 1.25 !important;
        }

        .report-title {
            font-size: 16px !important;
            line-height: 1.25 !important;
        }

        .report-subtitle {
            font-size: 10px !important;
            line-height: 1.3 !important;
        }

        .print-card > .mb-7,
        .print-card > .mb-8 {
            margin-bottom: 16px !important;
        }

        .print-card > .mt-6,
        .print-card > .mt-12 {
            margin-top: 16px !important;
        }

        .section-heading {
            margin-bottom: 9px !important;
            padding-bottom: 5px !important;
            font-size: 11px !important;
            line-height: 1.35 !important;
        }

        /* Identitas dibuat satu kolom agar tidak bertumpuk di layar sempit */
        .identity-grid {
            grid-template-columns: minmax(0, 1fr) !important;
            gap: 5px !important;
        }

        .identity-row {
            grid-template-columns: 92px 8px minmax(0, 1fr) !important;
            gap: 3px !important;
            font-size: 10px !important;
            line-height: 1.5 !important;
        }

        .identity-label,
        .identity-colon,
        .identity-value {
            font-size: 10px !important;
        }

        .identity-value {
            overflow-wrap: anywhere;
        }

        /* Tabel nilai dapat digeser sendiri, bukan membuat seluruh halaman melebar */
        .print-card .overflow-x-auto {
            width: 100% !important;
            max-width: 100% !important;
            overflow-x: auto !important;
            overflow-y: hidden !important;
            -webkit-overflow-scrolling: touch;
        }

        .report-table {
            width: 100% !important;
            min-width: 0 !important;
            table-layout: fixed !important;
            font-size: 9px !important;
        }

        .report-table th,
        .report-table td {
            padding: 5px 3px !important;
            font-size: 9px !important;
            line-height: 1.3 !important;
            overflow-wrap: anywhere !important;
        }

        /* Tabel capaian memiliki sembilan kolom; geser bagian tabelnya saja */
        .print-card .overflow-x-auto > .report-table {
            min-width: 610px !important;
            table-layout: auto !important;
        }

        .summary-table {
            width: 100% !important;
            min-width: 0 !important;
            table-layout: fixed !important;
        }

        .summary-table th {
            width: 65% !important;
        }

        .signature-section {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            gap: 10px !important;
            margin-top: 22px !important;
        }

        .signature-section > div {
            min-width: 0;
            font-size: 9px !important;
            overflow-wrap: anywhere;
        }

        .signature-name {
            font-size: 10px !important;
        }

        .signature-role {
            font-size: 9px !important;
        }

        .print-card > .mt-8.border-t {
            margin-top: 18px !important;
            padding-top: 8px !important;
            font-size: 8px !important;
        }
    }

    /* =========================================
       DARK MODE
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

    .dark .text-remedial {
        color: #EF4444 !important;
    }

    /* =========================================
       CETAK RAPOR A4
       TETAP SEPERTI VERSI YANG SUDAH BENAR
    ========================================= */

    @media print {

        @page {
            size: A4 portrait;
            margin: 8mm 10mm;
        }

        html,
        body {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            height: auto !important;
            min-height: 0 !important;
            overflow: visible !important;
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

        .rs-show-page {
            width: 100% !important;
            min-width: 0 !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: visible !important;
        }

        .rs-document-shell {
            display: block !important;
            width: 100% !important;
            min-width: 0 !important;
            max-width: none !important;
            height: auto !important;
            min-height: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: visible !important;
            border: none !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            background: #FFFFFF !important;
        }

        .print-card {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            display: block !important;
            width: 100% !important;
            min-width: 0 !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 0 !important;
            border: none !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            background: #FFFFFF !important;
            color: #000000 !important;
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 9pt !important;
            line-height: 1.3 !important;
        }

        .print-card,
        .print-card * {
            opacity: 1 !important;
            text-shadow: none !important;
        }

        /* KOP SEKOLAH */

        .report-school-header {
            position: relative !important;
            min-height: 100px !important;
            padding: 6px 8px 10px !important;
            margin: 0 !important;
            border-bottom: 3px double #111111 !important;
            background: #FFFFFF !important;
            break-inside: avoid;
        }

        .school-logo {
            position: absolute !important;
            left: 8px !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            width: 85px !important;
            height: 85px !important;
            object-fit: contain !important;
        }

        .school-heading-content {
            width: 100% !important;
            padding-left: 85px !important;
            padding-right: 5px !important;
        }

        .school-heading {
            font-size: 9pt !important;
            line-height: 1.25 !important;
        }

        .school-name {
            margin-top: 3px !important;
            font-size: 16pt !important;
            line-height: 1.2 !important;
        }

        .school-subheading {
            margin-top: 3px !important;
            font-size: 9pt !important;
            line-height: 1.25 !important;
        }

        /* JUDUL */

        .report-title {
            font-size: 14pt !important;
            line-height: 1.2 !important;
        }

        .report-subtitle {
            font-size: 9pt !important;
            line-height: 1.2 !important;
        }

        /* JARAK ANTARBAGIAN */

        .print-card > .mb-7,
        .print-card > .mb-8 {
            margin-bottom: 8px !important;
        }

        .print-card > .mt-6,
        .print-card > .mt-12 {
            margin-top: 8px !important;
        }

        .print-card > .mb-7.mt-6 {
            margin-top: 8px !important;
            margin-bottom: 9px !important;
        }

        .section-heading {
            width: 100% !important;
            box-sizing: border-box !important;
            margin-bottom: 6px !important;
            padding-bottom: 3px !important;
            border-bottom: 1px solid #333333 !important;
            font-size: 10pt !important;
            line-height: 1.3 !important;
            break-after: avoid;
        }

        /* IDENTITAS */

        .identity-grid {
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 3px 10px !important;
        }

        .identity-row {
            display: grid !important;
            grid-template-columns: 75px 8px minmax(0, 1fr) !important;
            gap: 3px !important;
            line-height: 1.35 !important;
        }

        .identity-row,
        .identity-label,
        .identity-colon,
        .identity-value {
            font-size: 8pt !important;
        }

        /* =========================================
           TABEL CETAK
           GARIS TIDAK TERPOTONG
        ========================================= */

        .print-card .report-table {
            display: table !important;

            width: 99.5% !important;
            max-width: 99.5% !important;
            min-width: 0 !important;

            margin-left: 0 !important;
            margin-right: auto !important;

            table-layout: fixed !important;
            border-collapse: collapse !important;
            border-spacing: 0 !important;

            border: 1px solid #222222 !important;
            box-sizing: border-box !important;

            background: #FFFFFF !important;
            color: #000000 !important;
            font-size: 8pt !important;
        }

        .print-card .report-table th,
        .print-card .report-table td {
            border: 1px solid #222222 !important;

            padding: 3px 4px !important;
            box-sizing: border-box !important;

            background: #FFFFFF !important;
            color: #000000 !important;

            font-size: 8pt !important;
            line-height: 1.25 !important;
            vertical-align: middle !important;

            overflow-wrap: anywhere !important;
            word-break: normal !important;
        }

        .print-card .report-table thead,
        .print-card .report-table tbody,
        .print-card .report-table tr {
            background: #FFFFFF !important;
        }

        .print-card .overflow-x-auto {
            width: 100% !important;
            max-width: 100% !important;
            overflow: visible !important;
        }

        .print-card .report-table thead {
            display: table-header-group !important;
        }

        .print-card .report-table tr {
            break-inside: avoid !important;
            page-break-inside: avoid !important;
        }

        .print-card .summary-table th {
            width: 65% !important;
        }

        /* STATUS NILAI */

        .print-card .text-remedial,
        .print-card td.text-remedial,
        .print-card span.text-remedial {
            color: #DC2626 !important;
            -webkit-text-fill-color: #DC2626 !important;
        }

        .print-card .text-tuntas {
            color: #111111 !important;
            -webkit-text-fill-color: #111111 !important;
        }

        /* KETERANGAN */

        .print-card p.mt-2 {
            margin-top: 3px !important;
            font-size: 7.5pt !important;
            line-height: 1.25 !important;
        }

        /* TANDA TANGAN */

        .signature-section {
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 16px !important;
            margin-top: 10px !important;
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .signature-section > div {
            font-size: 8pt !important;
            line-height: 1.3 !important;
        }

        .signature-section div[style*="height: 80px"] {
            height: 38px !important;
        }

        .signature-name {
            font-size: 9pt !important;
        }

        .signature-role {
            font-size: 8pt !important;
        }

        /* FOOTER */

        .print-card > .mt-8.border-t {
            margin-top: 8px !important;
            padding-top: 5px !important;
            font-size: 7pt !important;
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

            @if ($raporLengkap)
                <form
                    action="{{ route('admin.rapor_siswa.cetak', $raporSiswa->id_rapor_siswa) }}"
                    method="POST"
                    id="formCetakRapor"
                >
                    @csrf

                    <button
                        type="submit"
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
                            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h2"/>
                            <path d="M6 14h12v8H6z"/>
                        </svg>

                        Cetak Rapor
                    </button>
                </form>
            @else
                <button
                    type="button"
                    class="rs-show-btn"
                    disabled
                    title="Lengkapi seluruh nilai mata pelajaran terlebih dahulu."
                    style="background:#94A3B8; border:1px solid #94A3B8; color:#FFFFFF; cursor:not-allowed;"
                >
                    Rapor Belum Lengkap
                </button>
            @endif

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
                                    $isRemedial = ($status === 'Remedial');

                                    $predikat = strtoupper(
                                        trim((string) ($nilai->predikat ?? ''))
                                    );
                                @endphp

                                <tr>

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

                                    <td class="text-center final-value {{ $isRemedial ? 'text-remedial' : 'text-tuntas' }}">

                                        @if ($nilai && is_numeric($nilai->nilai_akhir))
                                            {{ $formatNilai($nilai, 'nilai_akhir') }}
                                        @else
                                            <span class="text-belum">
                                                Belum diinput
                                            </span>
                                        @endif

                                    </td>

                                    <td class="text-center">
                                        {{ $formatKKM($baris->kkm) }}
                                    </td>

                                    <td class="text-center grade-value {{ $isRemedial ? 'text-remedial' : 'text-tuntas' }}">

                                        @if (in_array($predikat, ['A', 'B', 'C', 'D'], true))
                                            {{ $predikat }}
                                        @else
                                            <span class="text-belum">
                                                Belum diinput
                                            </span>
                                        @endif

                                    </td>

                                    <td class="text-center {{ $isRemedial ? 'text-remedial' : ($status === 'Tuntas' ? 'text-tuntas' : 'text-belum') }}">
                                        {{ $status }}
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

                                @if ($rataRataRapor !== null)
                                    {{ number_format($rataRataRapor, 2, ',', '.') }}
                                @else
                                    <span class="text-belum">
                                        Belum tersedia
                                    </span>
                                @endif

                            </td>
                        </tr>

                        <tr>
                            <th class="text-left">
                                Status Kelengkapan Rapor
                            </th>

                            <td class="text-center">

                                @if (!$daftarMapelTersedia)
                                    <span class="text-belum">
                                        Pemetaan mapel belum tersedia
                                    </span>
                                @elseif ($raporLengkap)
                                    <span class="text-tuntas">
                                        Lengkap
                                    </span>
                                @else
                                    <span class="text-remedial">
                                        Belum Lengkap
                                    </span>
                                @endif

                            </td>
                        </tr>

                    </tbody>

                </table>

                <p class="mt-2 text-xs text-slate-500">
                    Rata-rata dihitung dari mata pelajaran yang memiliki
                    nilai harian, UTS, UAS, dan nilai akhir lengkap.
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
                    <p class="mt-2 text-sm text-slate-500">
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
                            <th class="text-center">No.</th>
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

@if (session('cetak_rapor'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                window.print();
            }, 500);
        });
    </script>
@endif

@endsection
