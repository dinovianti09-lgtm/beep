
@extends('layouts.admin')

@section('title', 'Detail Rapor Siswa - Sistem Akademik Mini')
@section('page-title', 'Rapor Siswa')
@section('page-subtitle', 'Detail nilai akademik dan cetak rapor')

@php
    use Illuminate\Support\Facades\DB;

    /*
    |--------------------------------------------------------------------------
    | IDENTITAS KELAS DAN WALI KELAS
    |--------------------------------------------------------------------------
    */
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

    /*
    |--------------------------------------------------------------------------
    | DAFTAR MATA PELAJARAN WAJIB SESUAI KELAS
    |--------------------------------------------------------------------------
    */
    $mapelWajib = collect();

    if ($kelasData) {
        $mapelWajib = DB::table('mapel_kelas')
            ->join(
                'mapel',
                'mapel.id_mapel',
                '=',
                'mapel_kelas.id_mapel'
            )
            ->where('mapel_kelas.jurusan', $kelasData->jurusan)
            ->where('mapel_kelas.tingkat', $kelasData->tingkat)
            ->select('mapel.id_mapel', 'mapel.nama_mapel')
            ->distinct()
            ->orderBy('mapel.nama_mapel')
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | COCOKKAN MAPEL DENGAN NILAI SISWA
    |--------------------------------------------------------------------------
    */
    $daftarNilai = collect($nilais ?? []);

    if ($mapelWajib->isNotEmpty()) {
        $barisRapor = $mapelWajib->map(
            function ($mapel) use ($daftarNilai) {
                $nilai = $daftarNilai->firstWhere(
                    'id_mapel',
                    $mapel->id_mapel
                );

                return (object) [
                    'id_mapel' => $mapel->id_mapel,
                    'nama_mapel' => $mapel->nama_mapel,
                    'nilai' => $nilai,
                    'sudah_ada_nilai' => $nilai !== null,
                ];
            }
        );
    } else {
        $barisRapor = $daftarNilai->map(
            function ($nilai) {
                return (object) [
                    'id_mapel' => $nilai->id_mapel,
                    'nama_mapel' => $nilai->mapel->nama_mapel ?? '-',
                    'nilai' => $nilai,
                    'sudah_ada_nilai' => true,
                ];
            }
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RINGKASAN NILAI
    |--------------------------------------------------------------------------
    */
    $jumlahSeluruhMapel = $barisRapor->count();

    $nilaiTerisi = $barisRapor->filter(
        function ($baris) {
            $nilai = $baris->nilai;

            if (!$nilai) {
                return false;
            }

            return is_numeric($nilai->nilai_harian)
                && is_numeric($nilai->nilai_uts)
                && is_numeric($nilai->nilai_uas)
                && is_numeric($nilai->nilai_akhir);
        }
    );

    $jumlahMapel = $nilaiTerisi->count();

    $rataRataRapor = $jumlahMapel > 0
        ? round(
            $nilaiTerisi->avg(
                function ($baris) {
                    return (float) $baris->nilai->nilai_akhir;
                }
            ),
            2
        )
        : null;

    $jumlahMapelBelumLengkap = $barisRapor->filter(
        function ($baris) {
            $nilai = $baris->nilai;

            if (!$nilai) {
                return true;
            }

            return !is_numeric($nilai->nilai_harian)
                || !is_numeric($nilai->nilai_uts)
                || !is_numeric($nilai->nilai_uas)
                || !is_numeric($nilai->nilai_akhir);
        }
    )->count();

    $daftarMapelTersedia = $mapelWajib->isNotEmpty();

    /*
    |--------------------------------------------------------------------------
    | DATA KEHADIRAN DAN EKSTRAKURIKULER
    |--------------------------------------------------------------------------
    | Data dikirim oleh RaporSiswaController berdasarkan siswa dan periode.
    */
    $dataKehadiran = $kehadiran ?? null;
    $daftarEkstrakurikuler = collect($ekstrakurikulerList ?? []);

    /*
    |--------------------------------------------------------------------------
    | FORMAT NILAI
    |--------------------------------------------------------------------------
    */
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

    $formatJumlah = function ($nilai, $kolom) {
        if (!$nilai || !is_numeric($nilai->{$kolom} ?? null)) {
            return 0;
        }

        return (int) $nilai->{$kolom};
    };
@endphp

@push('styles')
<style>
    .print-card {
        background: #ffffff !important;
        color: #111111 !important;
        color-scheme: light !important;
        font-family: Arial, Helvetica, sans-serif !important;
        font-size: 14px !important;
        line-height: 1.65 !important;
        opacity: 1 !important;
        isolation: isolate;
    }

    .print-card,
    .print-card * {
        opacity: 1 !important;
        text-shadow: none !important;
        -webkit-text-fill-color: currentColor;
        box-sizing: border-box;
    }

    .print-card,
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

    .print-card .report-school-header {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 125px;
        padding: 10px 10px 20px;
        border-bottom: 4px double #111111 !important;
        background: #ffffff !important;
    }

    .print-card .school-logo {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        width: 90px;
        height: 90px;
        object-fit: contain;
    }

    .print-card .school-heading-content {
        width: 100%;
        text-align: center !important;
        padding: 0 10px;
    }

    .print-card .school-heading {
        font-size: 14px !important;
        font-weight: 800 !important;
        text-align: center !important;
        color: #111111 !important;
    }

    .print-card .school-name {
        font-size: 25px !important;
        line-height: 1.3 !important;
        font-weight: 900 !important;
        text-align: center !important;
        color: #000000 !important;
        margin-top: 5px;
    }

    .print-card .school-subheading {
        font-size: 13px !important;
        font-weight: 700 !important;
        text-align: center !important;
        color: #222222 !important;
        margin-top: 5px;
    }

    .print-card .report-title {
        color: #000000 !important;
        font-size: 21px !important;
        font-weight: 900 !important;
        letter-spacing: 1px;
        text-align: center !important;
    }

    .print-card .report-subtitle {
        color: #222222 !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        text-align: center !important;
    }

    .print-card .identity-section {
        background: #ffffff !important;
    }

    .print-card .section-heading {
        color: #000000 !important;
        font-size: 15px !important;
        font-weight: 900 !important;
        border-bottom: 2px solid #333333 !important;
        padding-bottom: 8px;
        margin-bottom: 16px;
    }

    .print-card .identity-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px 28px;
        background: #ffffff !important;
    }

    .print-card .identity-row {
        display: grid;
        grid-template-columns: 125px 12px minmax(0, 1fr);
        align-items: start;
        gap: 4px;
        background: #ffffff !important;
        font-size: 14px !important;
        line-height: 1.8 !important;
    }

    .print-card .identity-label,
    .print-card .identity-colon {
        color: #111111 !important;
        font-size: 14px !important;
        font-weight: 600 !important;
    }

    .print-card .identity-value {
        color: #000000 !important;
        font-size: 14px !important;
        font-weight: 800 !important;
        overflow-wrap: anywhere;
    }

    .print-card .report-table {
        width: 100%;
        border-collapse: collapse !important;
        background: #ffffff !important;
        color: #000000 !important;
        font-size: 13px !important;
    }

    .print-card .report-table th,
    .print-card .report-table td {
        border: 1px solid #555555 !important;
        padding: 10px 8px !important;
        color: #000000 !important;
        vertical-align: middle !important;
        background: #ffffff !important;
        font-size: 13px !important;
        overflow-wrap: anywhere;
    }

    .print-card .report-table th {
        background: #e5e7eb !important;
        font-weight: 900 !important;
    }

    .print-card .report-table .grade-value,
    .print-card .report-table .final-value {
        font-weight: 900 !important;
    }

    .print-card .summary-table th {
        width: 65%;
    }

    .print-card .summary-table td {
        font-weight: 900 !important;
    }

    .print-card .signature-section,
    .print-card .signature-section p {
        color: #111111 !important;
        background: #ffffff !important;
        font-size: 13px !important;
    }

    .print-card .signature-name {
        color: #000000 !important;
        font-size: 14px !important;
        font-weight: 900 !important;
        text-decoration: underline;
    }

    .print-card .signature-role {
        color: #000000 !important;
        font-size: 13px !important;
        font-weight: 700 !important;
    }

    .gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    @media (max-width: 640px) {
        .print-card {
            padding: 20px !important;
        }

        .print-card .report-school-header {
            padding-top: 105px;
            min-height: 180px;
        }

        .print-card .school-logo {
            top: 5px;
            left: 50%;
            transform: translateX(-50%);
            width: 78px;
            height: 78px;
        }

        .print-card .school-heading-content {
            padding: 0;
        }

        .print-card .school-name {
            font-size: 21px !important;
        }

        .print-card .identity-grid {
            grid-template-columns: 1fr !important;
            gap: 8px !important;
        }

        .print-card .identity-row {
            grid-template-columns: 125px 12px minmax(0, 1fr);
        }

        .print-card .report-table {
            min-width: 650px;
        }

        .print-card .summary-table {
            min-width: 0 !important;
        }
    }

    @media print {
        @page {
            size: A4 portrait;
            margin: 12mm;
        }

        html,
        body {
            background: #ffffff !important;
            color: #000000 !important;
            margin: 0 !important;
            padding: 0 !important;
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
            left: 0 !important;
            top: 0 !important;
            width: 100% !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 0 !important;
            border: none !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            background: #ffffff !important;
            color: #000000 !important;
            font-size: 10pt !important;
        }

        .print-card,
        .print-card * {
            color: #000000 !important;
            opacity: 1 !important;
            -webkit-text-fill-color: #000000 !important;
        }

        .print-card .report-school-header {
            min-height: 100px !important;
            padding: 5px 5px 15px !important;
            border-bottom: 3px double #000000 !important;
        }

        .print-card .school-logo {
            left: 5px !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            width: 75px !important;
            height: 75px !important;
        }

        .print-card .school-heading-content {
            padding: 0 5px 0 65px !important;
        }

        .print-card .school-heading {
            font-size: 10pt !important;
        }

        .print-card .school-name {
            font-size: 17pt !important;
        }

        .print-card .school-subheading {
            font-size: 9pt !important;
        }

        .print-card .report-title {
            font-size: 15pt !important;
        }

        .print-card .identity-grid {
            grid-template-columns: 1fr 1fr !important;
            gap: 6px 12px !important;
        }

        .print-card .identity-row,
        .print-card .identity-label,
        .print-card .identity-colon,
        .print-card .identity-value {
            font-size: 9pt !important;
        }

        .print-card .report-table {
            min-width: 0 !important;
            width: 100% !important;
            font-size: 8pt !important;
        }

        .print-card .report-table th,
        .print-card .report-table td {
            font-size: 8pt !important;
            padding: 5px 3px !important;
            border: 1px solid #555555 !important;
        }

        .print-card .report-table th {
            background: #e5e7eb !important;
        }

        .print-card .signature-section {
            break-inside: avoid;
        }

        .no-print {
            display: none !important;
        }

        tr {
            break-inside: avoid;
        }
    }
</style>
@endpush

@section('content')
<div class="space-y-6">

    {{-- TOMBOL AKSI --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between no-print">
        <div>
            <h2 class="text-xl font-bold text-slate-800 dark:text-white">
                Detail Rapor Siswa
            </h2>

            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                Periksa nilai siswa atau cetak rapor.
            </p>
        </div>

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.rapor_siswa.index') }}"
               class="inline-flex items-center justify-center rounded-xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-700">
                ← Kembali
            </a>

            <button type="button"
                    onclick="window.print()"
                    class="gradient-primary inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold text-white transition hover:opacity-90">
                🖨 Cetak Rapor
            </button>
        </div>
    </div>

    {{-- LEMBAR RAPOR --}}
    <div class="print-card mx-auto max-w-5xl rounded-2xl border border-slate-200 p-6 shadow-sm sm:p-10">

        {{-- KOP SEKOLAH --}}
        <div class="report-school-header">
            @if (file_exists(public_path('images/logo-sekolah.png')))
                <img src="{{ asset('images/logo-sekolah.png') }}"
                     alt="Logo sekolah"
                     class="school-logo">
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
            <h2 class="report-title uppercase">RAPOR SISWA</h2>

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
                    <span class="identity-value">{{ $siswa->nama_siswa ?? '-' }}</span>
                </div>

                <div class="identity-row">
                    <span class="identity-label">NIS</span>
                    <span class="identity-colon">:</span>
                    <span class="identity-value">{{ $siswa->nis ?? '-' }}</span>
                </div>

                <div class="identity-row">
                    <span class="identity-label">Kelas</span>
                    <span class="identity-colon">:</span>
                    <span class="identity-value">{{ $siswa->kelas ?? '-' }}</span>
                </div>

                <div class="identity-row">
                    <span class="identity-label">Wali Kelas</span>
                    <span class="identity-colon">:</span>
                    <span class="identity-value">{{ $waliKelas ?: 'Belum Ditentukan' }}</span>
                </div>

                <div class="identity-row">
                    <span class="identity-label">Semester</span>
                    <span class="identity-colon">:</span>
                    <span class="identity-value">{{ $rapor->semester ?? '-' }}</span>
                </div>

                <div class="identity-row">
                    <span class="identity-label">Tahun Ajaran</span>
                    <span class="identity-colon">:</span>
                    <span class="identity-value">{{ $rapor->tahun_ajaran ?? '-' }}</span>
                </div>
            </div>
        </div>

        {{-- B. CAPAIAN HASIL BELAJAR --}}
        <div class="mb-8">
            <h3 class="section-heading uppercase">
                B. Capaian Hasil Belajar
            </h3>

            @if (!$daftarMapelTersedia)
                <div class="mb-4 rounded-xl border border-amber-300 bg-amber-50 px-4 py-3 text-sm text-amber-800 no-print">
                    Daftar mata pelajaran wajib untuk kelas ini belum diatur.
                    Tabel di bawah menampilkan nilai yang sudah tercatat saja.
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 42px;">No.</th>
                            <th class="text-left">Mata Pelajaran</th>
                            <th class="text-center">Harian</th>
                            <th class="text-center">UTS</th>
                            <th class="text-center">UAS</th>
                            <th class="text-center">Nilai Akhir</th>
                            <th class="text-center">Predikat</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($barisRapor as $index => $baris)
                            @php
                                $nilai = $baris->nilai;
                            @endphp

                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $baris->nama_mapel }}</td>
                                <td class="text-center">{{ $formatNilai($nilai, 'nilai_harian') }}</td>
                                <td class="text-center">{{ $formatNilai($nilai, 'nilai_uts') }}</td>
                                <td class="text-center">{{ $formatNilai($nilai, 'nilai_uas') }}</td>
                                <td class="text-center final-value">{{ $formatNilai($nilai, 'nilai_akhir') }}</td>
                                <td class="text-center grade-value">
                                    {{ $nilai && filled($nilai->predikat) ? $nilai->predikat : 'Belum diinput' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
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
                        <th class="text-left">Jumlah Semua Mata Pelajaran</th>
                        <td class="text-center">{{ $jumlahSeluruhMapel }} Mata Pelajaran</td>
                    </tr>

                    <tr>
                        <th class="text-left">Mata Pelajaran dengan Nilai Lengkap</th>
                        <td class="text-center">{{ $jumlahMapel }} Mata Pelajaran</td>
                    </tr>

                    <tr>
                        <th class="text-left">Mata Pelajaran Belum Lengkap</th>
                        <td class="text-center">
                            {{ $daftarMapelTersedia
                                ? $jumlahMapelBelumLengkap . ' Mata Pelajaran'
                                : 'Daftar wajib belum diatur' }}
                        </td>
                    </tr>

                    <tr>
                        <th class="text-left">Rata-rata Nilai Akhir</th>
                        <td class="text-center final-value">
                            {{ $rataRataRapor !== null
                                ? number_format($rataRataRapor, 2, ',', '.')
                                : 'Belum tersedia' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- D. KEHADIRAN SISWA --}}
        <div class="mb-8">
            <h3 class="section-heading uppercase">
                D. Kehadiran Siswa
            </h3>

            <table class="report-table summary-table">
                <thead>
                    <tr>
                        <th class="text-left">Keterangan</th>
                        <th class="text-center">Jumlah Hari</th>
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
                        <th class="text-center" style="width: 42px;">No.</th>
                        <th class="text-left">Kegiatan Ekstrakurikuler</th>
                        <th class="text-center">Predikat</th>
                        <th class="text-left">Keterangan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($daftarEkstrakurikuler as $index => $ekskul)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $ekskul->nama_ekstrakurikuler ?: '-' }}</td>
                            <td class="text-center">{{ $ekskul->predikat ?: '-' }}</td>
                            <td>{{ $ekskul->keterangan ?: '-' }}</td>
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
        <div class="signature-section mt-12 grid grid-cols-1 gap-10 sm:grid-cols-2">
            <div class="w-full text-center">
                <p>Mengetahui,</p>

                <p class="signature-role mt-1">
                    Wali Kelas {{ $siswa->kelas ?? '-' }}
                </p>

                <div style="height: 80px;"></div>

                <p class="signature-name">
                    {{ $waliKelas ?: 'Wali Kelas Belum Ditentukan' }}
                </p>
            </div>

            <div class="w-full text-center">
                <p>Mengetahui,</p>

                <p class="signature-role mt-1">Kepala Sekolah</p>

                <div style="height: 80px;"></div>

                <p class="signature-name">Ahmad Fadilah</p>
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="report-footer mt-8 border-t border-slate-300 pt-4 text-center text-xs">
            Dokumen ini dibuat melalui Sistem Akademik Mini.
        </div>
    </div>
</div>
@endsection
