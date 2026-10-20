@extends('layouts.admin')

@section('title', 'Lihat Rapor - Sistem Akademik')

@section('page-title', 'Lihat Rapor')

@section('page-subtitle', 'Lihat rapor berdasarkan kelas dan siswa')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 no-print">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">
                Rapor Siswa
            </h2>

            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Semester {{ $rapor->semester }}
                •
                Tahun Ajaran {{ $rapor->tahun_ajaran }}
            </p>
        </div>

        <div class="flex gap-3">
            <a
                href="{{ route('admin.rapor.index') }}"
                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition text-sm font-semibold"
            >
                ← Kembali
            </a>

            @if($siswa)
                <button
                    type="button"
                    onclick="window.print()"
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-slate-900 dark:bg-slate-700 text-white hover:bg-slate-800 dark:hover:bg-slate-600 transition text-sm font-semibold"
                >
                    🖨️ Cetak Rapor
                </button>
            @endif
        </div>
    </div>


    {{-- INFO PERIODE --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm p-6 mb-6 no-print">

        <div class="flex items-center gap-3 mb-5">
            <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400">
                📄
            </div>

            <div>
                <h3 class="font-extrabold text-slate-900 dark:text-white">
                    Periode Rapor
                </h3>

                <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">
                    Periode yang sedang dilihat
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <div class="rounded-xl bg-slate-50 dark:bg-slate-800 p-4">
                <p class="text-xs text-slate-400 dark:text-slate-500 mb-1">
                    Semester
                </p>

                <p class="text-sm font-bold text-slate-800 dark:text-slate-200">
                    {{ $rapor->semester }}
                </p>
            </div>

            <div class="rounded-xl bg-slate-50 dark:bg-slate-800 p-4">
                <p class="text-xs text-slate-400 dark:text-slate-500 mb-1">
                    Tahun Ajaran
                </p>

                <p class="text-sm font-bold text-slate-800 dark:text-slate-200">
                    {{ $rapor->tahun_ajaran }}
                </p>
            </div>

        </div>
    </div>


    {{-- FILTER KELAS & SISWA --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm p-6 mb-6 no-print">

        <div class="mb-5">
            <h3 class="font-extrabold text-slate-900 dark:text-white">
                Pilih Data Rapor
            </h3>

            <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">
                Pilih kelas terlebih dahulu, kemudian pilih siswa dari kelas tersebut.
            </p>
        </div>

        <form
            action="{{ route('admin.rapor.lihat', $rapor->id_rapor) }}"
            method="GET"
        >

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- PILIH KELAS --}}
                <div>
                    <label
                        for="kelas"
                        class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2"
                    >
                        Pilih Kelas
                    </label>

                    <select
                        id="kelas"
                        name="kelas"
                        onchange="this.form.submit()"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                    >
                        <option value="">
                            -- Pilih Kelas --
                        </option>

                        @foreach($kelasList as $kelas)
                            <option
                                value="{{ $kelas }}"
                                {{ $kelasTerpilih == $kelas ? 'selected' : '' }}
                            >
                                {{ $kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>


                {{-- PILIH SISWA --}}
                <div>
                    <label
                        for="id_siswa"
                        class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2"
                    >
                        Pilih Siswa
                    </label>

                    <select
                        id="id_siswa"
                        name="id_siswa"
                        required
                        {{ empty($kelasTerpilih) ? 'disabled' : '' }}
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none disabled:bg-slate-100 disabled:dark:bg-slate-800/60 disabled:text-slate-400"
                    >

                        @if(empty($kelasTerpilih))

                            <option value="">
                                -- Pilih Kelas Terlebih Dahulu --
                            </option>

                        @else

                            <option value="">
                                -- Pilih Siswa --
                            </option>

                            @forelse($siswaList as $siswaItem)

                                <option
                                    value="{{ $siswaItem->id_siswa }}"
                                    {{ request('id_siswa') == $siswaItem->id_siswa ? 'selected' : '' }}
                                >
                                    {{ $siswaItem->nama_siswa }}

                                    @if($siswaItem->nis)
                                        - {{ $siswaItem->nis }}
                                    @elseif($siswaItem->nisn ?? false)
                                        - {{ $siswaItem->nisn }}
                                    @endif

                                </option>

                            @empty

                                <option value="" disabled>
                                    Tidak ada siswa di kelas ini
                                </option>

                            @endforelse

                        @endif

                    </select>

                    @if(!empty($kelasTerpilih))

                        @if($siswaList->count() > 0)

                            <p class="text-xs text-emerald-600 dark:text-emerald-400 mt-2">
                                ✓ Menampilkan {{ $siswaList->count() }} siswa dari kelas {{ $kelasTerpilih }}
                            </p>

                        @else

                            <p class="text-xs text-red-500 dark:text-red-400 mt-2">
                                ✕ Tidak ada siswa yang terdaftar di kelas {{ $kelasTerpilih }}
                            </p>

                        @endif

                    @else

                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-2">
                            Pilih kelas untuk menampilkan daftar siswa.
                        </p>

                    @endif

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="mt-5">
                <button
                    type="submit"
                    id="btnLihatRapor"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-bold shadow-lg shadow-blue-900/10 hover:shadow-xl hover:-translate-y-0.5 transition disabled:opacity-50 disabled:cursor-not-allowed"
                    {{ empty($kelasTerpilih) || $siswaList->count() == 0 ? 'disabled' : '' }}
                >
                    👁️ Lihat Rapor
                </button>
            </div>

        </form>
    </div>


    {{-- HASIL RAPOR --}}
    @if($siswa)

        <div
            id="rapor-print"
            class="bg-white dark:bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden"
        >

            {{-- HEADER RAPOR --}}
            <div class="rapor-header">
                <h1>
                    RAPOR SISWA
                </h1>

                <p>
                    SISTEM AKADEMIK MINI
                </p>

                <p class="periode-print">
                    Semester {{ $rapor->semester }}
                    •
                    Tahun Ajaran {{ $rapor->tahun_ajaran }}
                </p>
            </div>


            {{-- IDENTITAS SISWA --}}
            <div class="identitas">

                <div class="identitas-item">
                    <span>Nama Siswa</span>
                    <strong>{{ $siswa->nama_siswa }}</strong>
                </div>

                <div class="identitas-item">
                    <span>NIS</span>
                    <strong>{{ $siswa->nis ?? $siswa->nisn ?? '-' }}</strong>
                </div>

                <div class="identitas-item">
                    <span>Kelas</span>
                    <strong>{{ $siswa->kelas ?? '-' }}</strong>
                </div>

                <div class="identitas-item">
                    <span>Wali Kelas</span>
                    <strong>{{ $waliKelas ?? '-' }}</strong>
                </div>

                <div class="identitas-item">
                    <span>Semester</span>
                    <strong>{{ $rapor->semester }}</strong>
                </div>

                <div class="identitas-item">
                    <span>Tahun Ajaran</span>
                    <strong>{{ $rapor->tahun_ajaran }}</strong>
                </div>

            </div>


            {{-- TABEL NILAI --}}
            <div class="table-wrapper">

                <table class="tabel-rapor">

                    <thead>
                        <tr>
                            <th class="kolom-no">No</th>
                            <th class="kolom-mapel">Mata Pelajaran</th>
                            <th>Harian</th>
                            <th>UTS</th>
                            <th>UAS</th>
                            <th>Nilai Akhir</th>
                            <th>Predikat</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($nilaiList as $index => $nilai)

                            <tr>
                                <td class="text-center">
                                    {{ $index + 1 }}
                                </td>

                                <td>
                                    {{ $nilai->mapel->nama_mapel ?? '-' }}
                                </td>

                                <td class="text-center">
                                    {{ $nilai->nilai_harian ?? '-' }}
                                </td>

                                <td class="text-center">
                                    {{ $nilai->nilai_uts ?? '-' }}
                                </td>

                                <td class="text-center">
                                    {{ $nilai->nilai_uas ?? '-' }}
                                </td>

                                <td class="text-center nilai-akhir">
                                    {{ $nilai->nilai_akhir ?? '-' }}
                                </td>

                                <td class="text-center predikat">
                                    {{ $nilai->predikat ?? '-' }}
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="kosong">
                                    Belum ada nilai untuk siswa ini pada periode tersebut.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- RINGKASAN RAPOR --}}
            <div class="ringkasan-rapor">

                <div class="ringkasan-item">
                    <span>Jumlah Mata Pelajaran Dinilai</span>

                    <strong>
                        {{ $jumlahMapel }}
                    </strong>
                </div>

                <div class="ringkasan-item rata-rata-item">
                    <span>Rata-rata Rapor</span>

                    <strong>
                        {{ $rataRataRapor !== null
                            ? number_format($rataRataRapor, 2, ',', '.')
                            : '-' }}
                    </strong>
                </div>

            </div>


            {{-- TANDA TANGAN --}}
            <div class="ttd">

                <div></div>

                <div class="ttd-kanan">

                    <p>
                        Mengetahui,
                    </p>

                    <p>
                        Wali Kelas {{ $siswa->kelas ?? '' }}
                    </p>

                    <div class="jarak-ttd"></div>

                    <p class="nama-ttd">
                        {{ $waliKelas ?? '____________________________' }}
                    </p>

                </div>

            </div>

        </div>

    @endif

</div>


<style>

    .rapor-header {
        text-align: center;
        padding: 30px 20px 20px;
        border-bottom: 1px solid #e5e7eb;
    }

    .rapor-header h1 {
        font-size: 24px;
        font-weight: 800;
        color: #1f2937;
        margin: 0;
    }

    .rapor-header p {
        font-size: 14px;
        color: #6b7280;
        margin-top: 5px;
    }

    .periode-print {
        font-weight: 600;
    }


    .identitas {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        padding: 25px;
        border-bottom: 1px solid #e5e7eb;
    }

    .identitas-item span {
        display: block;
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 5px;
    }

    .identitas-item strong {
        font-size: 14px;
        color: #1f2937;
    }


    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .tabel-rapor {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .tabel-rapor th,
    .tabel-rapor td {
        border: 1px solid #d1d5db;
        padding: 12px 10px;
        font-size: 13px;
    }

    .tabel-rapor th {
        background: #f8fafc;
        font-weight: 700;
        color: #374151;
        text-align: center;
    }

    .tabel-rapor td {
        color: #374151;
    }

    .kolom-no {
        width: 7%;
    }

    .kolom-mapel {
        width: 31%;
    }

    .tabel-rapor th:nth-child(3),
    .tabel-rapor th:nth-child(4),
    .tabel-rapor th:nth-child(5) {
        width: 12%;
    }

    .tabel-rapor th:nth-child(6) {
        width: 15%;
    }

    .tabel-rapor th:nth-child(7) {
        width: 11%;
    }

    .text-center {
        text-align: center;
    }

    .nilai-akhir {
        font-weight: 700;
    }

    .predikat {
        font-weight: 800;
    }

    .kosong {
        text-align: center;
        padding: 30px !important;
        color: #6b7280;
    }


    /* RINGKASAN RAPOR */
    .ringkasan-rapor {
        display: flex;
        justify-content: flex-end;
        gap: 16px;
        padding: 20px 25px;
        background: #f8fafc;
        border-top: 1px solid #e5e7eb;
        border-bottom: 1px solid #e5e7eb;
    }

    .ringkasan-item {
        display: flex;
        flex-direction: column;
        gap: 6px;
        min-width: 180px;
        padding: 14px 18px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        background: #fff;
    }

    .ringkasan-item span {
        font-size: 12px;
        color: #64748b;
    }

    .ringkasan-item strong {
        font-size: 22px;
        font-weight: 800;
        color: #1e293b;
    }

    .rata-rata-item strong {
        color: #2563eb;
    }


    /* TANDA TANGAN */
    .ttd {
        display: grid;
        grid-template-columns: 1fr 1fr;
        padding: 35px 25px 25px;
    }

    .ttd-kanan {
        text-align: center;
    }

    .ttd-kanan p {
        margin: 4px 0;
        font-size: 13px;
        color: #374151;
    }

    .jarak-ttd {
        height: 70px;
    }

    .nama-ttd {
        font-weight: 700;
    }


    /* PRINT */
    @media print {

        @page {
            size: A4 portrait;
            margin: 12mm;
        }

        html,
        body {
            width: 100%;
            margin: 0;
            padding: 0;
            background: white !important;
        }

        body * {
            visibility: hidden;
        }

        #rapor-print,
        #rapor-print * {
            visibility: visible;
        }

        #rapor-print {
            position: absolute;
            left: 0;
            top: 0;
            width: 100% !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 0 !important;
            border: none !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            overflow: visible !important;
        }

        .no-print {
            display: none !important;
        }

        .rapor-header {
            padding: 0 0 15px;
            border-bottom: 2px solid #000;
        }

        .rapor-header h1 {
            font-size: 20px;
            color: #000;
        }

        .rapor-header p {
            font-size: 12px;
            color: #000;
        }

        .identitas {
            grid-template-columns: 1fr 1fr;
            gap: 10px 30px;
            padding: 15px 0;
            border-bottom: 1px solid #000;
        }

        .identitas-item span {
            font-size: 10px;
            color: #000;
        }

        .identitas-item strong {
            font-size: 11px;
            color: #000;
        }

        .table-wrapper {
            overflow: visible !important;
            width: 100% !important;
        }

        .tabel-rapor {
            width: 100% !important;
            table-layout: fixed !important;
            border-collapse: collapse !important;
        }

        .tabel-rapor th,
        .tabel-rapor td {
            padding: 7px 5px !important;
            font-size: 10px !important;
            color: #000 !important;
            border: 1px solid #000 !important;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .kolom-no {
            width: 7% !important;
        }

        .kolom-mapel {
            width: 31% !important;
        }

        .tabel-rapor th:nth-child(3),
        .tabel-rapor th:nth-child(4),
        .tabel-rapor th:nth-child(5) {
            width: 12% !important;
        }

        .tabel-rapor th:nth-child(6) {
            width: 15% !important;
        }

        .tabel-rapor th:nth-child(7) {
            width: 11% !important;
        }

        .ringkasan-rapor {
            display: flex !important;
            justify-content: flex-end !important;
            gap: 10px !important;
            padding: 12px 0 !important;
            background: #fff !important;
            border-top: 1px solid #000 !important;
            border-bottom: 1px solid #000 !important;
        }

        .ringkasan-item {
            min-width: 140px;
            padding: 8px 10px !important;
            border: 1px solid #000 !important;
            border-radius: 0 !important;
            background: #fff !important;
        }

        .ringkasan-item span {
            font-size: 9px !important;
            color: #000 !important;
        }

        .ringkasan-item strong {
            font-size: 15px !important;
            color: #000 !important;
        }

        .ttd {
            padding: 25px 0 0;
        }

        .ttd-kanan p {
            font-size: 11px;
            color: #000;
        }

        .jarak-ttd {
            height: 60px;
        }

    }

    @media screen and (max-width: 640px) {

        .ringkasan-rapor {
            flex-direction: column;
        }

        .ringkasan-item {
            width: 100%;
            box-sizing: border-box;
        }

    }

</style>

@endsection