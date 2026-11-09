@extends('layouts.guru')

@section('title', 'Rapor Kelas - Sistem Akademik Mini')
@section('page-title', 'Rapor Kelas')
@section('page-subtitle', 'Lihat periode rapor dan hasil belajar siswa di kelas wali Anda.')

@push('styles')
<style>
.rapor-kelas-page {
    --rk-text: #26374A;
    --rk-muted: #647991;
    --rk-border: #D8E3EE;
}

/* HEADER BIRU PASTEL */
.rapor-kelas-page .rk-page-header {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 22px 24px;
    border: 1px solid #C8DCEE;
    border-radius: 16px;
    background: linear-gradient(120deg, #E3F0FA 0%, #F3F8FD 100%);
    box-shadow: 0 3px 10px rgba(39,77,119,.045);
}

.rapor-kelas-page .rk-page-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    flex-shrink: 0;
    border: 1px solid #C8DCEE;
    border-radius: 13px;
    background: #FFFFFF;
    color: #416D99;
}

.rapor-kelas-page .rk-page-header h1 {
    color: #294D70;
    font-size: 21px;
    font-weight: 800;
}

.rapor-kelas-page .rk-page-header p {
    color: #607A94;
}

/* CARD */
.rapor-kelas-page .rk-card {
    overflow: hidden;
    border: 1px solid #D8E3EE;
    border-radius: 16px;
    background: #FFFFFF;
    box-shadow: 0 3px 10px rgba(39,77,119,.045);
}

.rapor-kelas-page .rk-info-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 46px;
    height: 46px;
    flex-shrink: 0;
    border: 1px solid #D5E5F3;
    border-radius: 12px;
    background: #EAF3FB;
    color: #416D99;
}

.rapor-kelas-page .rk-heading {
    color: #26374A;
}

.rapor-kelas-page .rk-muted {
    color: #647991;
}

.rapor-kelas-page .rk-table th {
    padding: 15px 20px;
    background: #F3F7FB;
    color: #52677E;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .04em;
    text-transform: uppercase;
    white-space: nowrap;
}

.rapor-kelas-page .rk-table td {
    padding: 16px 20px;
    border-bottom: 1px solid #EDF1F5;
}

.rapor-kelas-page .rk-table tbody tr:last-child td {
    border-bottom: 0;
}

.rapor-kelas-page .rk-table tbody tr {
    transition: background .2s ease;
}

.rapor-kelas-page .rk-table tbody tr:hover {
    background: #F7FAFD;
}

.rapor-kelas-page .rk-semester {
    display: inline-flex;
    align-items: center;
    padding: 7px 12px;
    border: 1px solid #D5E5F3;
    border-radius: 9px;
    background: #EAF3FB;
    color: #356D9F;
    font-size: 11px;
    font-weight: 800;
    white-space: nowrap;
}

.rapor-kelas-page .rk-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 42px;
    padding: 10px 15px;
    border-radius: 10px;
    background: #397DBB;
    color: #FFFFFF;
    font-size: 12px;
    font-weight: 800;
    transition: .2s ease;
}

.rapor-kelas-page .rk-action:hover {
    background: #286AA8;
    transform: translateY(-1px);
}

/* DARK MODE */
:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rapor-kelas-page .rk-page-header {
    background: linear-gradient(120deg, #1D3149 0%, #223A55 100%) !important;
    border-color: #405B78 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rapor-kelas-page .rk-page-header h1 {
    color: #F1F6FC !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rapor-kelas-page .rk-page-header p {
    color: #C0D2E5 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rapor-kelas-page .rk-card {
    background: #192438 !important;
    border-color: #34465F !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rapor-kelas-page .rk-heading {
    color: #F1F6FC !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rapor-kelas-page .rk-muted {
    color: #AFC0D4 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rapor-kelas-page .rk-page-icon,
:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rapor-kelas-page .rk-info-icon {
    background: #263E59 !important;
    border-color: #405B78 !important;
    color: #D8E9FC !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rapor-kelas-page .rk-table th {
    background: #202F44 !important;
    color: #D5E2F0 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rapor-kelas-page .rk-table td {
    border-color: #34465F !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rapor-kelas-page .rk-table tbody tr:hover {
    background: #202F44 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .rapor-kelas-page .rk-semester {
    background: #263E59 !important;
    border-color: #405B78 !important;
    color: #C8E0F8 !important;
}

/* RESPONSIVE */
@media(max-width:640px) {
    .rapor-kelas-page .rk-page-header {
        padding: 17px;
        gap: 12px;
    }

    .rapor-kelas-page .rk-page-icon {
        width: 44px;
        height: 44px;
    }

    .rapor-kelas-page .rk-page-header h1 {
        font-size: 18px;
    }

    .rapor-kelas-page .rk-table th,
    .rapor-kelas-page .rk-table td {
        padding: 13px 15px;
    }

    .rapor-kelas-page .rk-action {
        min-height: 40px;
        padding: 9px 12px;
    }
}
</style>
@endpush

@section('content')
<div class="rapor-kelas-page space-y-6 p-4 sm:p-6 lg:p-8">

    {{-- HEADER BIRU PASTEL --}}
    <div class="rk-page-header">
        <div class="rk-page-icon">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-6 w-6"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M7 3.75h7l5 5v11.5a1.75 1.75 0 0 1-1.75 1.75h-10.5A1.75 1.75 0 0 1 5 20.25V5.5A1.75 1.75 0 0 1 6.75 3.75Z"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M14 3.75v5h5M8.5 13h7M8.5 16.5h7"/>
            </svg>
        </div>

        <div class="min-w-0">
            <h1>Rapor Kelas</h1>
            <p class="mt-1 text-sm">
                Periode rapor untuk kelas yang Anda ampu sebagai wali kelas.
            </p>
        </div>
    </div>

    {{-- INFORMASI KELAS --}}
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

        {{-- KELAS WALI --}}
        <div class="rk-card p-5">
            <div class="flex items-center gap-4">
                <div class="rk-info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.75 19.25h16.5M5.5 19.25V7.5l6.5-3 6.5 3v11.75M9 9.5h.01M15 9.5h.01M9 13h.01M15 13h.01M10 19.25v-3.5h4v3.5"/>
                    </svg>
                </div>

                <div class="min-w-0">
                    <p class="rk-muted text-sm">Kelas Wali</p>
                    <h3 class="rk-heading mt-1 break-words text-xl font-extrabold">
                        {{ $kelasWali->nama_kelas }}
                    </h3>
                </div>
            </div>
        </div>

        {{-- JUMLAH SISWA --}}
        <div class="rk-card p-5">
            <div class="flex items-center gap-4">
                <div class="rk-info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16 19.25h4.25v-1.5a3.25 3.25 0 0 0-5.1-2.67M16 19.25H8m8 0v-1.5a4 4 0 0 0-8 0v1.5m8-10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 15.08a3.25 3.25 0 0 0-5.1 2.67v1.5H8"/>
                    </svg>
                </div>

                <div>
                    <p class="rk-muted text-sm">Jumlah Siswa</p>
                    <h3 class="rk-heading mt-1 text-xl font-extrabold">
                        {{ $jumlahSiswa }}
                        <span class="rk-muted text-sm font-semibold">Siswa</span>
                    </h3>
                </div>
            </div>
        </div>

    </div>

    {{-- DAFTAR PERIODE RAPOR --}}
    <div class="rk-card">

        {{-- HEADER TABEL --}}
        <div class="flex flex-col gap-3 border-b border-slate-100 px-5 py-5 dark:border-slate-800 sm:flex-row sm:items-center sm:justify-between lg:px-6">

            <div>
                <h3 class="rk-heading font-extrabold">
                    Daftar Periode Rapor
                </h3>

                <p class="rk-muted mt-1 text-xs">
                    Pilih periode untuk melihat rapor siswa di kelas Anda.
                </p>
            </div>

            {{-- JUMLAH PERIODE --}}
            <span class="inline-flex w-fit items-center gap-2 rounded-full border border-[#D5E5F3] bg-[#EAF3FB] px-3 py-2 text-xs font-extrabold text-[#356D9F] dark:border-[#405B78] dark:bg-[#263E59] dark:text-[#C8E0F8]">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-4 w-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8 6.75h8M8 10.75h8M8 14.75h5M5.75 3.75h12.5A1.75 1.75 0 0 1 20 5.5v13a1.75 1.75 0 0 1-1.75 1.75H5.75A1.75 1.75 0 0 1 4 18.5v-13a1.75 1.75 0 0 1 1.75-1.75Z"/>
                </svg>

                {{ $raporList->count() }} Periode
            </span>

        </div>

        {{-- TABEL --}}
        <div class="w-full overflow-x-auto">
            <table class="rk-table w-full min-w-[650px] text-left">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Semester</th>
                        <th>Tahun Ajaran</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($raporList as $index => $rapor)

                        @php
                            $semesterLabel = match (strtolower(trim((string) $rapor->semester))) {
                                '1', 'ganjil' => 'Ganjil',
                                '2', 'genap' => 'Genap',
                                default => $rapor->semester,
                            };
                        @endphp

                        <tr>

                            {{-- NOMOR --}}
                            <td class="text-sm font-semibold text-slate-500 dark:text-slate-400">
                                {{ $index + 1 }}
                            </td>

                            {{-- SEMESTER --}}
                            <td>
                                <span class="rk-semester">
                                    Semester {{ $semesterLabel }}
                                </span>
                            </td>

                            {{-- TAHUN AJARAN --}}
                            <td class="text-sm font-semibold text-slate-700 dark:text-slate-200">
                                {{ $rapor->tahun_ajaran }}
                            </td>

                            {{-- AKSI --}}
                            <td>
                                <div class="flex justify-center">
                                    <a href="{{ route('guru.rapor.show', $rapor->id_rapor) }}"
                                       class="rk-action">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-4 w-4"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M2.75 12s3.25-6 9.25-6 9.25 6 9.25 6-3.25 6-9.25 6-9.25-6-9.25-6Z"/>
                                            <circle cx="12" cy="12" r="2.5"/>
                                        </svg>

                                        Lihat Rapor
                                    </a>
                                </div>
                            </td>

                        </tr>

                    @empty

                        {{-- DATA KOSONG --}}
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-[#EAF3FB] text-[#416D99] dark:bg-[#263E59] dark:text-[#D8E9FC]">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-7 w-7"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="1.7">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M7 3.75h7l5 5v11.5A1.75 1.75 0 0 1 17.25 22h-10.5A1.75 1.75 0 0 1 5 20.25V5.5A1.75 1.75 0 0 1 6.75 3.75Z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M14 3.75v5h5M8.5 13h7M8.5 16.5h7"/>
                                        </svg>
                                    </div>

                                    <h4 class="rk-heading text-sm font-extrabold">
                                        Belum Ada Periode Rapor
                                    </h4>

                                    <p class="rk-muted mt-1 max-w-sm text-xs leading-5">
                                        Periode akan tampil jika sudah tersedia nilai siswa di kelas Anda.
                                    </p>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>
            </table>
        </div>

    </div>

    {{-- FOOTER --}}
    <p class="rk-muted pt-2 text-center text-xs">
        © {{ date('Y') }} Sistem Akademik Mini
    </p>

</div>
@endsection