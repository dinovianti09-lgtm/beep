@extends('layouts.siswa')

@section('title', 'Rapor Saya - Sistem Akademik Mini')
@section('page-title', 'Rapor Saya')
@section('page-subtitle', 'Lihat hasil belajar dan status nilai kamu')

@php
    use Illuminate\Support\Facades\DB;

    /*
    |--------------------------------------------------------------------------
    | Data nilai dari SiswaNilaiController
    |--------------------------------------------------------------------------
    */

    $daftarNilai = collect($nilais ?? [])->map(function ($item) {
        return (object) [
            'id_mapel' => $item->id_mapel
                ?? $item->mapel->id_mapel
                ?? null,
            'mapel' => $item->mapel ?? null,
            'nama_mapel' => $item->mapel->nama_mapel ?? '-',
            'nilai_harian' => $item->nilai_harian ?? null,
            'nilai_uts' => $item->nilai_uts ?? null,
            'nilai_uas' => $item->nilai_uas ?? null,
            'nilai_akhir' => $item->nilai_akhir ?? null,
            'predikat' => $item->predikat ?? null,
        ];
    });

    /*
    |--------------------------------------------------------------------------
    | Data kelas, wali kelas, dan NIP wali kelas
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

    /*
    |--------------------------------------------------------------------------
    | Identitas kepala sekolah dari pengaturan sekolah
    |--------------------------------------------------------------------------
    */

    $pengaturanSekolah = DB::table('pengaturan_sekolah')->first();

    $kepalaSekolah = $pengaturanSekolah->nama_kepala_sekolah
        ?? 'Ahmad Fadilah';

    $nipKepalaSekolah = $pengaturanSekolah->nip_kepala_sekolah
        ?? '';

    /*
    |--------------------------------------------------------------------------
    | Mata pelajaran wajib berdasarkan kelas siswa
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

    /*
    |--------------------------------------------------------------------------
    | Gabungkan mata pelajaran dengan nilai
    |--------------------------------------------------------------------------
    */

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
            ->filter(fn ($item) => $item->id_mapel !== null)
            ->unique('id_mapel')
            ->map(function ($nilai) {
                return (object) [
                    'id_mapel' => $nilai->id_mapel,
                    'nama_mapel' => $nilai->nama_mapel,
                    'kkm' => $nilai->mapel->kkm ?? null,
                    'nilai' => $nilai,
                ];
            })
            ->values();
    }

    /*
    |--------------------------------------------------------------------------
    | Status dan format nilai
    |--------------------------------------------------------------------------
    */

    $nilaiLengkap = function ($nilai) {
        return $nilai
            && is_numeric($nilai->nilai_harian)
            && is_numeric($nilai->nilai_uts)
            && is_numeric($nilai->nilai_uas)
            && is_numeric($nilai->nilai_akhir);
    };

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

    /*
    |--------------------------------------------------------------------------
    | Ringkasan nilai rapor
    |--------------------------------------------------------------------------
    */

    $jumlahSeluruhMapel = $barisRapor->count();

    $nilaiTerisi = $barisRapor->filter(
        fn ($baris) => $nilaiLengkap($baris->nilai)
    );

    $jumlahMapel = $nilaiTerisi->count();

    $jumlahMapelBelumLengkap = $barisRapor->filter(
        fn ($baris) => !$nilaiLengkap($baris->nilai)
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

    $jumlahTuntas = $barisRapor->filter(
        fn ($baris) => $statusNilai($baris) === 'Tuntas'
    )->count();

    $jumlahRemedial = $barisRapor->filter(
        fn ($baris) => $statusNilai($baris) === 'Remedial'
    )->count();

    $dataKehadiran = $kehadiran ?? null;
    $daftarEkstrakurikuler = collect($ekstrakurikulerList ?? []);
@endphp

@push('styles')
<style>
    .rapor-siswa {
        color: #0f172a;
    }

    .rapor-siswa .rapor-paper {
        background: #ffffff;
        color: #111827;
        font-family: Arial, Helvetica, sans-serif;
        line-height: 1.6;
    }

    .rapor-siswa .report-school-header {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        min-height: 115px;
        padding: 12px 10px 18px;
        border-bottom: 4px double #111827;
        background: #ffffff;
    }

    .rapor-siswa .school-logo {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        width: 78px;
        height: 78px;
        object-fit: contain;
    }

    .rapor-siswa .school-heading-content {
        width: 100%;
        text-align: center;
        padding: 0 10px;
    }

    .rapor-siswa .school-heading {
        font-size: 12px;
        font-weight: 800;
    }

    .rapor-siswa .school-name {
        margin-top: 5px;
        font-size: 23px;
        line-height: 1.3;
        font-weight: 900;
    }

    .rapor-siswa .school-subheading {
        margin-top: 5px;
        font-size: 12px;
        font-weight: 700;
    }

    .rapor-siswa .section-heading {
        margin-bottom: 14px;
        padding-bottom: 8px;
        border-bottom: 2px solid #333333;
        font-size: 14px;
        font-weight: 900;
        color: #111827;
    }

    .rapor-siswa .identity-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px 24px;
    }

    .rapor-siswa .identity-row {
        display: grid;
        grid-template-columns: 110px 12px minmax(0, 1fr);
        gap: 4px;
        align-items: start;
        font-size: 13px;
    }

    .rapor-siswa .identity-label,
    .rapor-siswa .identity-colon {
        font-weight: 600;
    }

    .rapor-siswa .identity-value {
        font-weight: 800;
        overflow-wrap: anywhere;
    }

    .rapor-siswa .report-table {
        width: 100%;
        border-collapse: collapse;
        background: #ffffff;
        color: #111827;
        font-size: 12px;
    }

    .rapor-siswa .report-table th,
    .rapor-siswa .report-table td {
        padding: 8px 6px;
        border: 1px solid #555555;
        color: #111827;
        vertical-align: middle;
        background: #ffffff;
        overflow-wrap: anywhere;
    }

    .rapor-siswa .report-table th {
        background: #e5e7eb;
        font-weight: 900;
    }

    .rapor-siswa .status-tuntas {
        display: inline-block;
        padding: 3px 7px;
        border-radius: 5px;
        background-color: #dcfce7;
        color: #15803d;
        font-weight: 800;
    }

    .rapor-siswa .report-table tbody tr.baris-remedial > td {
        background-color: #fee2e2 !important;
        color: #dc2626 !important;
        font-weight: 700 !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    .rapor-siswa .report-table tbody tr.baris-remedial > td span {
        color: #dc2626 !important;
        -webkit-text-fill-color: #dc2626 !important;
    }

    .rapor-siswa .status-remedial {
        display: inline-block;
        padding: 3px 7px;
        border-radius: 5px;
        background-color: #fecaca;
        color: #dc2626;
        font-weight: 800;
    }

    .rapor-siswa .status-belum {
        display: inline-block;
        padding: 3px 7px;
        border-radius: 5px;
        background-color: #f1f5f9;
        color: #64748b;
        font-weight: 700;
    }

    .rapor-siswa .summary-table th {
        width: 65%;
    }

    .rapor-siswa .summary-table td {
        font-weight: 800;
    }

    .rapor-siswa .signature-name {
        font-size: 13px;
        font-weight: 900;
        text-decoration: underline;
    }

    .rapor-siswa .signature-role {
        font-size: 12px;
        font-weight: 700;
    }

    @media (max-width: 640px) {
        .rapor-siswa .identity-grid {
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .rapor-siswa .school-name {
            font-size: 19px;
        }

        .rapor-siswa .report-school-header {
            padding-top: 95px;
        }

        .rapor-siswa .school-logo {
            top: 5px;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 70px;
        }

        .rapor-siswa .report-table {
            min-width: 760px;
        }

        .rapor-siswa .summary-table {
            min-width: 0;
        }
    }
</style>
@endpush

@section('content')
<div class="rapor-siswa space-y-6">

    {{-- Header dan pilihan semester --}}
    <div class="dashboard-card rounded-2xl border border-slate-200 p-5 shadow-sm dark:border-slate-800 sm:p-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-bold text-slate-800 dark:text-white">
                    Rapor Saya
                </h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Lihat nilai, KKM, dan status hasil belajar kamu.
                </p>
            </div>

            <form action="{{ route('siswa.rapor.index') }}" method="GET">
                <label for="semester-nilai"
                       class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                    Pilih Semester
                </label>

                <select id="semester-nilai"
                        name="semester"
                        onchange="this.form.submit()"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 sm:min-w-64">
                    @forelse (($semesterList ?? collect()) as $periode)
                        <option value="{{ $periode->id_rapor }}"
                            {{ (string) ($semesterDipilih ?? '') === (string) $periode->id_rapor ? 'selected' : '' }}>
                            {{ $periode->semester }} - {{ $periode->tahun_ajaran }}
                        </option>
                    @empty
                        <option value="">Belum ada periode rapor</option>
                    @endforelse
                </select>
            </form>
        </div>
    </div>

    {{-- Ringkasan --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="dashboard-card rounded-2xl border border-slate-200 p-5 shadow-sm dark:border-slate-800">
            <p class="text-sm text-slate-500 dark:text-slate-400">Mata Pelajaran</p>
            <p class="mt-2 text-2xl font-extrabold text-slate-800 dark:text-white">
                {{ $jumlahSeluruhMapel }}
            </p>
            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Jumlah seluruh mapel</p>
        </div>

        <div class="dashboard-card rounded-2xl border border-slate-200 p-5 shadow-sm dark:border-slate-800">
            <p class="text-sm text-slate-500 dark:text-slate-400">Rata-rata Nilai Akhir</p>
            <p class="mt-2 text-2xl font-extrabold text-blue-600 dark:text-blue-400">
                {{ $rataRataRapor !== null
                    ? number_format($rataRataRapor, 2, ',', '.')
                    : '-' }}
            </p>
            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Dari nilai yang lengkap</p>
        </div>

        <div class="dashboard-card rounded-2xl border border-emerald-200 p-5 shadow-sm dark:border-emerald-900">
            <p class="text-sm text-slate-500 dark:text-slate-400">Tuntas</p>
            <p class="mt-2 text-2xl font-extrabold text-emerald-600 dark:text-emerald-400">
                {{ $jumlahTuntas }}
            </p>
            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Nilai memenuhi KKM</p>
        </div>

        <div class="dashboard-card rounded-2xl border border-red-200 p-5 shadow-sm dark:border-red-900">
            <p class="text-sm text-slate-500 dark:text-slate-400">Remedial</p>
            <p class="mt-2 text-2xl font-extrabold text-red-600 dark:text-red-400">
                {{ $jumlahRemedial }}
            </p>
            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Nilai di bawah KKM</p>
        </div>
    </div>

    @if (!isset($rapor) || !$rapor)
        <div class="dashboard-card rounded-2xl border border-amber-200 bg-amber-50 p-6 text-sm text-amber-800 dark:border-amber-900 dark:bg-amber-950/30 dark:text-amber-300">
            Periode rapor belum tersedia atau belum dipilih.
        </div>
    @else
        <div class="rapor-paper mx-auto max-w-5xl rounded-2xl border border-slate-200 p-5 shadow-sm dark:border-slate-700 sm:p-10">

            {{-- Kop sekolah --}}
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

            {{-- Judul --}}
            <div class="mb-7 mt-6 text-center">
                <h2 class="text-xl font-black tracking-wider text-black">
                    RAPOR SISWA
                </h2>

                <p class="mt-1 text-sm font-semibold text-black">
                    Tahun Ajaran {{ $rapor->tahun_ajaran ?? '-' }}
                </p>
            </div>

            {{-- A. Identitas siswa --}}
            <div class="mb-7">
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

            {{-- B. Capaian hasil belajar --}}
            <div class="mb-8">
                <h3 class="section-heading uppercase">
                    B. Capaian Hasil Belajar
                </h3>

                @if (!$daftarMapelTersedia)
                    <p class="mb-3 rounded-lg border border-amber-300 bg-amber-50 p-3 text-sm text-amber-800">
                        Daftar mata pelajaran wajib untuk kelas ini belum diatur.
                        Tabel menampilkan nilai yang sudah tercatat.
                    </p>
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
                                    <td class="text-center">{{ $index + 1 }}</td>

                                    <td>{{ $baris->nama_mapel }}</td>

                                    <td class="text-center">
                                        {{ $formatNilai($nilai, 'nilai_harian') }}
                                    </td>

                                    <td class="text-center">
                                        {{ $formatNilai($nilai, 'nilai_uts') }}
                                    </td>

                                    <td class="text-center">
                                        {{ $formatNilai($nilai, 'nilai_uas') }}
                                    </td>

                                    <td class="text-center font-extrabold">
                                        {{ $formatNilai($nilai, 'nilai_akhir') }}
                                    </td>

                                    <td class="text-center">
                                        {{ $formatKKM($baris->kkm) }}
                                    </td>

                                    <td class="text-center font-extrabold">
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
                                        Belum ada data nilai untuk periode rapor ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- C. Ringkasan hasil belajar --}}
            <div class="mb-8">
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
                            <th class="text-left">
                                {{ $raporLengkap ? 'Rata-rata Nilai Akhir' : 'Rata-rata Sementara' }}
                            </th>
                            <td class="text-center">
                                {{ $rataRataRapor !== null
                                    ? number_format($rataRataRapor, 2, ',', '.')
                                    : 'Belum tersedia' }}
                            </td>
                        </tr>

                        <tr>
                            <th class="text-left">Status Kelengkapan Rapor</th>
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
                    Rata-rata dihitung dari nilai akhir mata pelajaran yang memiliki
                    nilai harian, UTS, UAS, dan nilai akhir lengkap.
                </p>
            </div>

            {{-- D. Kehadiran siswa --}}
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
                            <td class="text-center">{{ $dataKehadiran->sakit ?? 0 }}</td>
                        </tr>
                        <tr>
                            <td>Izin</td>
                            <td class="text-center">{{ $dataKehadiran->izin ?? 0 }}</td>
                        </tr>
                        <tr>
                            <td>Tanpa Keterangan</td>
                            <td class="text-center">{{ $dataKehadiran->tanpa_keterangan ?? 0 }}</td>
                        </tr>
                    </tbody>
                </table>

                @if (!$dataKehadiran)
                    <p class="mt-2 text-xs text-slate-500">
                        Data kehadiran belum diinput oleh guru.
                    </p>
                @endif
            </div>

            {{-- E. Ekstrakurikuler --}}
            <div class="mb-8">
                <h3 class="section-heading uppercase">
                    E. Ekstrakurikuler
                </h3>

                <table class="report-table">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-left">Kegiatan Ekstrakurikuler</th>
                            <th class="text-center">Predikat</th>
                            <th class="text-left">Keterangan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($daftarEkstrakurikuler as $index => $ekskul)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $ekskul->nama_ekstrakurikuler ?? '-' }}</td>
                                <td class="text-center">{{ $ekskul->predikat ?? '-' }}</td>
                                <td>{{ $ekskul->keterangan ?? '-' }}</td>
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

            {{-- Tanda tangan: mengikuti Admin Rapor --}}
            <div class="signature-section mt-12 grid grid-cols-2 gap-6">

                {{-- Kiri: Kepala Sekolah --}}
                <div class="w-full text-center">
                    <p>Mengetahui,</p>
                    <p class="signature-role mt-1">Kepala Sekolah</p>

                    <div style="height: 80px;"></div>

                    <p class="signature-name">
                        {{ $kepalaSekolah ?: 'Nama Kepala Sekolah' }}
                    </p>
                    <p>NIP. {{ $nipKepalaSekolah ?: '…………………' }}</p>
                </div>

                {{-- Kanan: Wali Kelas --}}
                <div class="w-full text-center">
                    <p>Bandung, {{ now()->translatedFormat('d F Y') }}</p>

                    <p class="signature-role mt-1">
                        Wali Kelas {{ $siswa->kelas ?? '-' }}
                    </p>

                    <div style="height: 80px;"></div>

                    <p class="signature-name">
                        {{ $waliKelas ?: 'Wali Kelas Belum Ditentukan' }}
                    </p>
                    <p>NIP. {{ $nipWaliKelas ?: '…………………' }}</p>
                </div>

            </div>

            {{-- Footer --}}
            <div class="mt-8 border-t border-slate-300 pt-4 text-center text-xs">
                Dokumen ini dibuat melalui Sistem Akademik Mini.
            </div>
        </div>
    @endif
</div>
@endsection