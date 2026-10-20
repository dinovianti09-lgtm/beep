
@extends('layouts.siswa')

@section('title', 'Transkrip Nilai - Sistem Akademik Mini')
@section('page-title', 'Transkrip Nilai')
@section('page-subtitle', 'Lihat rapor hasil belajar kamu')

@section('content')

@php
    $namaSiswa = $siswa->nama_siswa
        ?? auth()->user()->name
        ?? auth()->user()->username
        ?? 'Siswa';

    $semuaNilai = collect($nilais ?? []);

    // Nilai lengkap jika Harian, UTS, UAS, dan Nilai Akhir tersedia.
    $nilaiLengkap = $semuaNilai->filter(function ($nilai) {
        return is_numeric($nilai->nilai_harian)
            && is_numeric($nilai->nilai_uts)
            && is_numeric($nilai->nilai_uas)
            && is_numeric($nilai->nilai_akhir);
    });

    $jumlahMapel = $nilaiLengkap->count();
    $jumlahSemuaMapel = $semuaNilai->count();
    $jumlahMapelKurang = max(0, $jumlahSemuaMapel - $jumlahMapel);

    $rataRata = $jumlahMapel > 0
        ? round(
            $nilaiLengkap->avg(
                fn ($nilai) => (float) $nilai->nilai_akhir
            ),
            2
        )
        : null;

    $waliKelas = $waliKelas ?: 'Wali Kelas Belum Ditentukan';
@endphp

<style>
    .transkrip-page {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .transkrip-card {
        background: #ffffff;
        color: #1e293b;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 14px rgba(15, 23, 42, .04);
        transition: background-color .2s, border-color .2s, color .2s;
    }

    html.dark .transkrip-card:not(.report-paper) {
        background: #1e293b;
        color: #f1f5f9;
        border-color: #334155;
        box-shadow: 0 4px 14px rgba(0, 0, 0, .12);
    }

    .transkrip-heading {
        color: #1e293b;
        font-weight: 700;
    }

    .transkrip-description {
        color: #64748b;
    }

    html.dark .transkrip-heading {
        color: #f8fafc;
    }

    html.dark .transkrip-description {
        color: #cbd5e1;
    }

    .transkrip-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px;
    }

    .transkrip-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 18px;
        border-radius: 9px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        transition: .2s;
    }

    .transkrip-button-secondary {
        background: #f1f5f9;
        color: #334155 !important;
        border: 1px solid #e2e8f0;
    }

    .transkrip-button-secondary:hover {
        background: #e2e8f0;
    }

    html.dark .transkrip-button-secondary {
        background: #334155;
        color: #f1f5f9 !important;
        border-color: #475569;
    }

    html.dark .transkrip-button-secondary:hover {
        background: #475569;
    }

    .transkrip-select {
        width: 100%;
        max-width: 320px;
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        padding: 11px 12px;
        background: #ffffff;
        color: #1e293b;
        outline: none;
    }

    .transkrip-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, .15);
    }

    html.dark .transkrip-select {
        background: #0f172a;
        color: #f1f5f9;
        border-color: #475569;
    }

    html.dark .transkrip-select option {
        background: #0f172a;
        color: #f1f5f9;
    }

    .transkrip-label {
        color: #334155;
        font-size: 14px;
        font-weight: 600;
    }

    html.dark .transkrip-label {
        color: #e2e8f0;
    }

    .transkrip-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    .transkrip-stat {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        background: #ffffff;
        min-width: 0;
    }

    html.dark .transkrip-stat {
        background: #1e293b;
        border-color: #334155;
    }

    .transkrip-stat-label {
        color: #64748b;
        font-size: 13px;
        margin-bottom: 8px;
    }

    html.dark .transkrip-stat-label {
        color: #cbd5e1;
    }

    .transkrip-stat-value {
        color: #0f172a;
        font-size: 25px;
        font-weight: 800;
        overflow-wrap: anywhere;
    }

    html.dark .transkrip-stat-value {
        color: #f8fafc;
    }

    /* LEMBAR RAPOR SELALU TERANG */
    .report-paper {
        background: #ffffff !important;
        color: #111111 !important;
        color-scheme: light !important;
        font-family: Arial, Helvetica, sans-serif !important;
        font-size: 14px !important;
        line-height: 1.65 !important;
        opacity: 1 !important;
        isolation: isolate;
        box-sizing: border-box;
    }

    .report-paper,
    .report-paper * {
        box-sizing: border-box;
        text-shadow: none !important;
        -webkit-text-fill-color: currentColor;
    }

    .report-paper,
    .report-paper p,
    .report-paper span,
    .report-paper div,
    .report-paper td,
    .report-paper th {
        color: #111111 !important;
    }

    .report-paper h1,
    .report-paper h2,
    .report-paper h3 {
        color: #000000 !important;
        font-weight: 800 !important;
    }

    .report-school-header {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 125px;
        padding: 10px 10px 20px;
        border-bottom: 4px double #111111;
        background: #ffffff !important;
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
        text-align: center;
        padding: 0 10px;
    }

    .school-heading {
        font-size: 14px;
        font-weight: 800;
        text-align: center;
        color: #111111 !important;
    }

    .school-name {
        font-size: 25px;
        line-height: 1.3;
        font-weight: 900;
        text-align: center;
        color: #000000 !important;
        margin-top: 5px;
    }

    .school-subheading {
        font-size: 13px;
        font-weight: 700;
        text-align: center;
        color: #222222 !important;
        margin-top: 5px;
    }

    .report-title {
        color: #000000 !important;
        font-size: 21px;
        font-weight: 900;
        letter-spacing: 1px;
        text-align: center;
    }

    .report-subtitle {
        color: #222222 !important;
        font-size: 14px;
        font-weight: 600;
        text-align: center;
    }

    .identity-section {
        background: #ffffff !important;
    }

    .section-heading {
        color: #000000 !important;
        font-size: 15px;
        font-weight: 900;
        border-bottom: 2px solid #333333;
        padding-bottom: 8px;
        margin-bottom: 16px;
    }

    .identity-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px 28px;
        background: #ffffff !important;
    }

    .identity-row {
        display: grid;
        grid-template-columns: 125px 12px minmax(0, 1fr);
        align-items: start;
        gap: 4px;
        background: #ffffff !important;
        font-size: 14px;
        line-height: 1.8;
    }

    .identity-label,
    .identity-colon {
        color: #111111 !important;
        font-size: 14px;
        font-weight: 600;
    }

    .identity-value {
        color: #000000 !important;
        font-size: 14px;
        font-weight: 800;
        overflow-wrap: anywhere;
    }

    .report-table {
        width: 100%;
        border-collapse: collapse;
        background: #ffffff !important;
        color: #000000 !important;
        font-size: 13px;
    }

    .report-table th,
    .report-table td {
        border: 1px solid #555555 !important;
        padding: 10px 8px;
        color: #000000 !important;
        vertical-align: middle;
        background: #ffffff !important;
        font-size: 13px;
    }

    .report-table th {
        background: #e5e7eb !important;
        font-weight: 900;
    }

    .report-table .grade-value,
    .report-table .final-value {
        font-weight: 900;
    }

    .summary-table th {
        width: 65%;
    }

    .summary-table td {
        font-weight: 900;
    }

    .signature-section {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
        margin-top: 48px;
        align-items: start;
    }

    .signature-content {
        width: 100%;
        text-align: center;
        min-width: 0;
    }

    .signature-content p {
        color: #111111 !important;
        font-size: 13px;
    }

    .signature-role {
        color: #000000 !important;
        font-size: 13px;
        font-weight: 700;
    }

    .signature-space {
        height: 80px;
    }

    .signature-name {
        color: #000000 !important;
        font-size: 14px;
        font-weight: 900;
        text-decoration: underline;
        overflow-wrap: anywhere;
    }

    .report-footer {
        border-top: 1px solid #cbd5e1;
        margin-top: 32px;
        padding-top: 12px;
        text-align: center;
        font-size: 11px;
        color: #475569 !important;
    }

    @media (max-width: 640px) {
        .transkrip-card {
            padding: 16px;
        }

        .transkrip-stats {
            grid-template-columns: 1fr;
        }

        .report-paper {
            padding: 20px !important;
        }

        .report-school-header {
            padding-top: 105px;
            min-height: 180px;
        }

        .school-logo {
            top: 5px;
            left: 50%;
            transform: translateX(-50%);
            width: 78px;
            height: 78px;
        }

        .school-heading-content {
            padding: 0;
        }

        .school-name {
            font-size: 21px;
        }

        .identity-grid {
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .identity-row {
            grid-template-columns: 125px 12px minmax(0, 1fr);
        }

        .report-table-wrap {
            overflow-x: auto;
        }

        .report-table:not(.summary-table) {
            min-width: 650px;
        }

        .summary-table {
            min-width: 0;
        }

        .signature-section {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 36px;
        }

        .signature-content p {
            font-size: 11px;
        }

        .signature-name {
            font-size: 12px;
        }

        .signature-space {
            height: 65px;
        }
    }
</style>

<div class="transkrip-page">

    {{-- PILIH PERIODE --}}
    <div class="transkrip-card">
        <div class="flex flex-col gap-4">
            <div>
                <h2 class="transkrip-heading text-lg">
                    Transkrip Nilai
                </h2>

                <p class="transkrip-description mt-1 text-sm">
                    Pilih semester untuk melihat rapor kamu.
                </p>
            </div>

            <form action="{{ route('siswa.rapor.index') }}"
                  method="GET"
                  class="flex flex-col sm:flex-row sm:items-end gap-3">

                <div class="flex flex-col gap-2">
                    <label for="semester" class="transkrip-label">
                        Semester / Periode Rapor
                    </label>

                    <select id="semester"
                            name="semester"
                            class="transkrip-select"
                            onchange="this.form.submit()">

                        @forelse ($semesterList as $periode)
                            <option value="{{ $periode->id_rapor }}"
                                {{ (string) $semesterDipilih === (string) $periode->id_rapor ? 'selected' : '' }}>
                                {{ $periode->semester ?? '-' }}
                                - {{ $periode->tahun_ajaran ?? '-' }}
                            </option>
                        @empty
                            <option value="">Belum ada periode rapor</option>
                        @endforelse
                    </select>
                </div>

                <noscript>
                    <button type="submit"
                            class="transkrip-button transkrip-button-secondary">
                        Tampilkan
                    </button>
                </noscript>
            </form>

            <div class="transkrip-actions">
                <a href="{{ route('siswa.dashboard') }}"
                   class="transkrip-button transkrip-button-secondary">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    {{-- RINGKASAN NILAI --}}
    <div class="transkrip-stats">
        <div class="transkrip-stat">
            <div class="transkrip-stat-label">
                Mata Pelajaran Lengkap
            </div>

            <div class="transkrip-stat-value">
                {{ $jumlahMapel }} / {{ $jumlahSemuaMapel }}
            </div>

            <p class="transkrip-description mt-2 text-sm">
                @if ($jumlahMapelKurang > 0)
                    {{ $jumlahMapelKurang }} mata pelajaran belum lengkap
                @else
                    Semua mata pelajaran sudah lengkap
                @endif
            </p>
        </div>

        <div class="transkrip-stat">
            <div class="transkrip-stat-label">
                Rata-rata Nilai
            </div>

            <div class="transkrip-stat-value">
                {{ $rataRata !== null ? number_format($rataRata, 2, ',', '.') : '-' }}
            </div>
        </div>

        <div class="transkrip-stat">
            <div class="transkrip-stat-label">
                Semester
            </div>

            <div class="transkrip-stat-value" style="font-size: 19px;">
                {{ $rapor->semester ?? '-' }}
            </div>
        </div>
    </div>

    {{-- LEMBAR RAPOR --}}
    <div class="transkrip-card report-paper"
         style="max-width: 1024px; width: 100%; margin: 0 auto; padding: 40px;">

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
        <div class="text-center mt-6 mb-7">
            <h2 class="report-title uppercase">
                RAPOR SISWA
            </h2>

            <p class="report-subtitle mt-1">
                Tahun Ajaran {{ $rapor->tahun_ajaran ?? '-' }}
            </p>
        </div>

        {{-- IDENTITAS SISWA --}}
        <div class="identity-section mb-7">
            <h3 class="section-heading uppercase">
                A. Identitas Peserta Didik
            </h3>

            <div class="identity-grid">
                <div class="identity-row">
                    <span class="identity-label">Nama Siswa</span>
                    <span class="identity-colon">:</span>
                    <span class="identity-value">
                        {{ $namaSiswa }}
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
                        {{ $waliKelas }}
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

        {{-- TABEL NILAI --}}
        <div class="mb-8">
            <h3 class="section-heading uppercase">
                B. Capaian Hasil Belajar
            </h3>

            <div class="report-table-wrap">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th style="width: 42px;" class="text-center">No.</th>
                            <th class="text-left">Mata Pelajaran</th>
                            <th class="text-center">Harian</th>
                            <th class="text-center">UTS</th>
                            <th class="text-center">UAS</th>
                            <th class="text-center">Nilai Akhir</th>
                            <th class="text-center">Predikat</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($nilais ?? [] as $index => $nilai)
                            <tr>
                                <td class="text-center">
                                    {{ $index + 1 }}
                                </td>

                                <td>
                                    {{ $nilai->mapel->nama_mapel ?? '-' }}
                                </td>

                                <td class="text-center">
                                    {{ is_numeric($nilai->nilai_harian)
                                        ? number_format((float) $nilai->nilai_harian, 2, ',', '.')
                                        : 'Belum diinput' }}
                                </td>

                                <td class="text-center">
                                    {{ is_numeric($nilai->nilai_uts)
                                        ? number_format((float) $nilai->nilai_uts, 2, ',', '.')
                                        : 'Belum diinput' }}
                                </td>

                                <td class="text-center">
                                    {{ is_numeric($nilai->nilai_uas)
                                        ? number_format((float) $nilai->nilai_uas, 2, ',', '.')
                                        : 'Belum diinput' }}
                                </td>

                                <td class="text-center final-value">
                                    {{ is_numeric($nilai->nilai_akhir)
                                        ? number_format((float) $nilai->nilai_akhir, 2, ',', '.')
                                        : 'Belum diinput' }}
                                </td>

                                <td class="text-center grade-value">
                                    {{ filled($nilai->predikat)
                                        ? $nilai->predikat
                                        : 'Belum diinput' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Belum ada mata pelajaran untuk kelas ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- RINGKASAN RAPOR --}}
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
                            {{ $jumlahSemuaMapel }} Mata Pelajaran
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
                            {{ $jumlahMapelKurang }} Mata Pelajaran
                        </td>
                    </tr>

                    <tr>
                        <th class="text-left">
                            Rata-rata Nilai Akhir
                        </th>

                        <td class="text-center final-value">
                            {{ $rataRata !== null ? number_format($rataRata, 2, ',', '.') : 'Belum tersedia' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- TANDA TANGAN --}}
        <div class="signature-section">
            <div class="signature-content">
                <p>Mengetahui,</p>

                <p class="signature-role mt-1">
                    Wali Kelas {{ $siswa->kelas ?? '-' }}
                </p>

                <div class="signature-space"></div>

                <p class="signature-name">
                    {{ $waliKelas }}
                </p>
            </div>

            <div class="signature-content">
                <p>Mengetahui,</p>

                <p class="signature-role mt-1">
                    Kepala Sekolah
                </p>

                <div class="signature-space"></div>

                <p class="signature-name">
                    Ahmad Fadilah
                </p>
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="report-footer">
            Dokumen ini dibuat melalui Sistem Akademik Mini.
        </div>
    </div>

</div>

@endsection
