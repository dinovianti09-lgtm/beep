@extends('layouts.guru')

@section('title', 'Pengaturan Bobot Nilai - Sistem Akademik')
@section('page-title', 'Pengaturan Bobot Nilai')
@section('page-subtitle', 'Atur persentase nilai Harian, UTS, dan UAS')

@push('styles')
<style>
.bobot-page {
    --bobot-text: #26374A;
    --bobot-muted: #647991;
    --bobot-border: #D8E3EE;
}

.bobot-page .bobot-page-header {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 22px 24px;
    border: 1px solid #C8DCEE;
    border-radius: 16px;
    background: linear-gradient(120deg, #E3F0FA 0%, #F3F8FD 100%);
    box-shadow: 0 3px 10px rgba(39,77,119,.045);
}

.bobot-page .bobot-page-header .bobot-icon {
    width: 50px;
    height: 50px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #C8DCEE;
    border-radius: 13px;
    background: #FFFFFF;
    color: #416D99;
}

.bobot-page .bobot-page-header h1 {
    color: #294D70;
    font-size: 21px;
    font-weight: 800;
}

.bobot-page .bobot-page-header p {
    color: #607A94;
}

.bobot-page .bobot-card {
    overflow: hidden;
    border: 1px solid #D8E3EE;
    border-radius: 16px;
    background: #FFFFFF;
    box-shadow: 0 3px 10px rgba(39,77,119,.045);
}

.bobot-page .bobot-card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 18px 20px;
    border-bottom: 1px solid #E5ECF3;
}

.bobot-page .bobot-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    border: 1px solid #D5E5F3;
    border-radius: 11px;
    background: #EAF3FB;
    color: #416D99;
}

.bobot-page .bobot-heading {
    color: #26374A;
    font-weight: 800;
}

.bobot-page .bobot-muted {
    color: #647991;
}

.bobot-page .bobot-label {
    display: block;
    margin-bottom: 8px;
    color: #344B63;
    font-size: 13px;
    font-weight: 700;
}

.bobot-page .bobot-control {
    width: 100%;
    min-height: 46px;
    padding: 11px 14px;
    border: 1px solid #D5E1ED;
    border-radius: 11px;
    background: #F9FBFD;
    color: #30445B;
    font-size: 14px;
    outline: none;
    transition: .2s ease;
}

.bobot-page .bobot-control:focus {
    border-color: #6B9FD1;
    background: #FFFFFF;
    box-shadow: 0 0 0 3px rgba(73,137,198,.12);
}

.bobot-page .bobot-weight-card {
    padding: 17px;
    border: 1px solid #D8E3EE;
    border-radius: 13px;
    background: #F8FAFD;
    transition: .2s ease;
}

.bobot-page .bobot-weight-card:hover {
    border-color: #A9C8E5;
}

.bobot-page .bobot-number-wrap {
    position: relative;
}

.bobot-page .bobot-number {
    width: 100%;
    min-height: 48px;
    padding: 11px 42px 11px 14px;
    border: 1px solid #D5E1ED;
    border-radius: 11px;
    background: #FFFFFF;
    color: #26374A;
    font-size: 19px;
    font-weight: 800;
    outline: none;
    transition: .2s ease;
}

.bobot-page .bobot-number:focus {
    border-color: #6B9FD1;
    box-shadow: 0 0 0 3px rgba(73,137,198,.12);
}

.bobot-page .bobot-percent {
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    color: #647991;
    font-weight: 700;
}

.bobot-page .bobot-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 45px;
    padding: 11px 18px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 800;
    transition: .2s ease;
}

.bobot-page .bobot-btn:hover {
    transform: translateY(-1px);
}

.bobot-page .bobot-btn-primary {
    background: #397DBB;
    color: #FFFFFF;
}

.bobot-page .bobot-btn-primary:hover {
    background: #286AA8;
}

.bobot-page .bobot-btn-primary:disabled {
    opacity: .5;
    cursor: not-allowed;
    transform: none;
}

.bobot-page .bobot-btn-outline {
    border: 1px solid #D5E1ED;
    background: #FFFFFF;
    color: #50647B;
}

.bobot-page .bobot-btn-outline:hover {
    background: #F1F6FB;
}

.bobot-page .bobot-info {
    border: 1px solid #C9DFF1;
    border-radius: 12px;
    background: #EDF6FD;
    padding: 16px;
    color: #315C82;
}

.bobot-page .bobot-total {
    font-weight: 800;
}

.bobot-page .bobot-status {
    font-size: 12px;
    font-weight: 600;
}

/* DARK MODE */
:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .bobot-page .bobot-page-header {
    background: linear-gradient(120deg, #1D3149 0%, #223A55 100%) !important;
    border-color: #405B78 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .bobot-page .bobot-page-header h1 {
    color: #F1F6FC !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .bobot-page .bobot-page-header p {
    color: #C0D2E5 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .bobot-page .bobot-card {
    background: #192438 !important;
    border-color: #34465F !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .bobot-page .bobot-card-header {
    border-color: #34465F !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .bobot-page .bobot-heading {
    color: #F1F6FC !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .bobot-page .bobot-muted {
    color: #AFC0D4 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .bobot-page .bobot-icon {
    background: #263E59 !important;
    border-color: #405B78 !important;
    color: #D8E9FC !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .bobot-page .bobot-label {
    color: #DCE7F4 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .bobot-page .bobot-control {
    background: #111D30 !important;
    border-color: #40516A !important;
    color: #E1EAF5 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .bobot-page .bobot-weight-card {
    background: #202D41 !important;
    border-color: #40516A !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .bobot-page .bobot-number {
    background: #111D30 !important;
    border-color: #40516A !important;
    color: #F1F6FC !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .bobot-page .bobot-percent {
    color: #AFC0D4 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .bobot-page .bobot-btn-outline {
    background: #202D41 !important;
    border-color: #40516A !important;
    color: #E1EAF5 !important;
}

:is(html.dark, body.dark, html.dark-mode, body.dark-mode,
html[data-theme="dark"], body[data-theme="dark"],
html[data-admin-theme="dark"], body[data-admin-theme="dark"],
.dark, .dark-mode, [data-theme="dark"]) .bobot-page .bobot-info {
    background: #1C3550 !important;
    border-color: #365B7D !important;
    color: #D5E9FC !important;
}

/* RESPONSIVE */
@media(max-width:640px) {
    .bobot-page .bobot-page-header {
        padding: 17px;
        gap: 12px;
    }

    .bobot-page .bobot-page-header .bobot-icon {
        width: 44px;
        height: 44px;
    }

    .bobot-page .bobot-page-header h1 {
        font-size: 18px;
    }

    .bobot-page .bobot-card-header {
        padding: 16px;
    }

    .bobot-page .bobot-btn {
        width: 100%;
    }

    .bobot-page .bobot-weight-card {
        padding: 15px;
    }
}
</style>
@endpush

@section('content')
<div class="bobot-page space-y-6">

    {{-- HEADER --}}
    <div class="bobot-page-header">
        <div class="bobot-icon">
            <i data-lucide="sliders-horizontal" class="h-6 w-6"></i>
        </div>

        <div class="min-w-0">
            <h1>Pengaturan Bobot Nilai</h1>
            <p class="mt-1 text-sm">
                Atur persentase nilai Harian, UTS, dan UAS untuk setiap periode rapor.
            </p>
        </div>
    </div>

    {{-- NOTIFIKASI --}}
    @if (session('success'))
        <div class="flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800 dark:border-green-800/60 dark:bg-green-950/40 dark:text-green-300">
            <i data-lucide="circle-check" class="mt-0.5 h-5 w-5 shrink-0"></i>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800 dark:border-red-800/60 dark:bg-red-950/40 dark:text-red-300">
            <div class="flex items-center gap-2 font-semibold">
                <i data-lucide="alert-circle" class="h-5 w-5"></i>
                Periksa kembali pengaturan:
            </div>

            <ul class="mt-2 list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- INFORMASI MAPEL --}}
    <div class="bobot-card p-5">
        <div class="flex items-start gap-4">
            <div class="bobot-icon">
                <i data-lucide="book-open" class="h-6 w-6"></i>
            </div>

            <div class="min-w-0 flex-1">
                <p class="bobot-muted text-sm font-medium">
                    Mata Pelajaran yang Diampu
                </p>

                <h2 class="bobot-heading mt-1 break-words text-xl font-extrabold">
                    {{ $mapel->nama_mapel }}
                </h2>

                <p class="bobot-muted mt-2 text-sm">
                    Guru:
                    <span class="bobot-heading font-semibold">
                        {{ $guru->nama_guru }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    {{-- PILIH PERIODE RAPOR --}}
    <div class="bobot-card">
        <div class="bobot-card-header">
            <div class="bobot-icon">
                <i data-lucide="calendar-days" class="h-5 w-5"></i>
            </div>

            <div>
                <h2 class="bobot-heading font-extrabold">
                    Pilih Periode Bobot Nilai
                </h2>
                <p class="bobot-muted mt-1 text-sm">
                    Pilih semester dan tahun ajaran yang ingin diatur.
                </p>
            </div>
        </div>

        <div class="p-5">
            @if ($raporList->isEmpty())
                <div class="flex items-start gap-3 rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800 dark:border-amber-800/60 dark:bg-amber-950/30 dark:text-amber-300">
                    <i data-lucide="info" class="mt-0.5 h-5 w-5 shrink-0"></i>
                    <p>Belum ada periode rapor. Tambahkan periode rapor terlebih dahulu.</p>
                </div>
            @else

                @php
                    $periodeAwal = $raporTerpilih ?? $raporList->first();
                    $semesterAwal = ucfirst(strtolower($periodeAwal->semester ?? 'Ganjil'));
                @endphp

                <form method="GET"
                      action="{{ route('guru.bobot-nilai.index') }}"
                      id="form-pilih-periode"
                      class="space-y-5">

                    {{-- DROPDOWN SEMESTER --}}
                    <div>
                        <label for="pilih_semester" class="bobot-label">
                            Pilih Semester
                        </label>

                        <select id="pilih_semester"
                                class="bobot-control">

                            <option value="Ganjil"
                                {{ $semesterAwal === 'Ganjil' ? 'selected' : '' }}>
                                Semester Ganjil
                            </option>

                            <option value="Genap"
                                {{ $semesterAwal === 'Genap' ? 'selected' : '' }}>
                                Semester Genap
                            </option>
                        </select>
                    </div>

                    {{-- DROPDOWN TAHUN AJARAN --}}
                    <div>
                        <label for="id_rapor" class="bobot-label">
                            Pilih Tahun Ajaran
                        </label>

                        <select name="id_rapor"
                                id="id_rapor"
                                required
                                class="bobot-control">

                            @foreach ($raporList as $raporItem)
                                <option value="{{ $raporItem->id_rapor }}"
                                        data-semester="{{ ucfirst(strtolower($raporItem->semester)) }}"
                                        @selected(
                                            $raporTerpilih &&
                                            (int) $raporTerpilih->id_rapor === (int) $raporItem->id_rapor
                                        )>
                                    {{ $raporItem->tahun_ajaran }}
                                </option>
                            @endforeach
                        </select>

                        <p class="bobot-muted mt-2 text-xs">
                            Tahun ajaran akan menyesuaikan semester yang dipilih.
                        </p>
                    </div>

                    <button type="submit" class="bobot-btn bobot-btn-primary">
                        <i data-lucide="arrow-right" class="h-4 w-4"></i>
                        Tampilkan Bobot
                    </button>
                </form>
            @endif
        </div>
    </div>

    {{-- FORM BOBOT NILAI --}}
    @if ($raporTerpilih)
        @php
            $harian = old('bobot_harian', $bobot->bobot_harian ?? 30);
            $uts = old('bobot_uts', $bobot->bobot_uts ?? 30);
            $uas = old('bobot_uas', $bobot->bobot_uas ?? 40);
        @endphp

        <div class="bobot-card">

            <div class="bobot-card-header">
                <div class="bobot-icon">
                    <i data-lucide="chart-no-axes-combined" class="h-5 w-5"></i>
                </div>

                <div>
                    <h2 class="bobot-heading text-lg font-extrabold">
                        Bobot Penilaian
                    </h2>
                    <p class="bobot-muted mt-1 text-sm">
                        Semester {{ $raporTerpilih->semester }}
                        — {{ $raporTerpilih->tahun_ajaran }}
                    </p>
                </div>
            </div>

            <div class="p-5">
                <form method="POST" action="{{ route('guru.bobot-nilai.update') }}">
                    @csrf

                    <input type="hidden"
                           name="id_rapor"
                           value="{{ $raporTerpilih->id_rapor }}">

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                        {{-- HARIAN --}}
                        <div class="bobot-weight-card">
                            <div class="mb-4 flex items-center gap-3">
                                <div class="bobot-icon">
                                    <i data-lucide="clipboard-list" class="h-5 w-5"></i>
                                </div>

                                <div>
                                    <label for="bobot_harian" class="bobot-heading block font-bold">
                                        Nilai Harian
                                    </label>
                                    <p class="bobot-muted text-xs">
                                        Tugas dan penilaian harian
                                    </p>
                                </div>
                            </div>

                            <div class="bobot-number-wrap">
                                <input type="number"
                                       id="bobot_harian"
                                       name="bobot_harian"
                                       min="0"
                                       max="100"
                                       step="1"
                                       required
                                       value="{{ $harian }}"
                                       class="bobot-number">

                                <span class="bobot-percent">%</span>
                            </div>
                        </div>

                        {{-- UTS --}}
                        <div class="bobot-weight-card">
                            <div class="mb-4 flex items-center gap-3">
                                <div class="bobot-icon">
                                    <i data-lucide="file-pen-line" class="h-5 w-5"></i>
                                </div>

                                <div>
                                    <label for="bobot_uts" class="bobot-heading block font-bold">
                                        Nilai UTS
                                    </label>
                                    <p class="bobot-muted text-xs">
                                        Ujian tengah semester
                                    </p>
                                </div>
                            </div>

                            <div class="bobot-number-wrap">
                                <input type="number"
                                       id="bobot_uts"
                                       name="bobot_uts"
                                       min="0"
                                       max="100"
                                       step="1"
                                       required
                                       value="{{ $uts }}"
                                       class="bobot-number">

                                <span class="bobot-percent">%</span>
                            </div>
                        </div>

                        {{-- UAS --}}
                        <div class="bobot-weight-card">
                            <div class="mb-4 flex items-center gap-3">
                                <div class="bobot-icon">
                                    <i data-lucide="graduation-cap" class="h-5 w-5"></i>
                                </div>

                                <div>
                                    <label for="bobot_uas" class="bobot-heading block font-bold">
                                        Nilai UAS
                                    </label>
                                    <p class="bobot-muted text-xs">
                                        Ujian akhir semester
                                    </p>
                                </div>
                            </div>

                            <div class="bobot-number-wrap">
                                <input type="number"
                                       id="bobot_uas"
                                       name="bobot_uas"
                                       min="0"
                                       max="100"
                                       step="1"
                                       required
                                       value="{{ $uas }}"
                                       class="bobot-number">

                                <span class="bobot-percent">%</span>
                            </div>
                        </div>

                    </div>

                    {{-- TOTAL BOBOT --}}
                    <div class="bobot-info mt-5">
                        <div class="flex items-start gap-3">
                            <i data-lucide="info" class="mt-0.5 h-5 w-5 shrink-0"></i>

                            <div class="min-w-0 flex-1">
                                <p class="text-sm leading-6">
                                    <strong>Perhatian:</strong>
                                    Jumlah bobot Harian, UTS, dan UAS harus tepat 100%.
                                    Contoh: Harian 20%, UTS 30%, dan UAS 50%.
                                </p>

                                <p id="total-bobot"
                                   aria-live="polite"
                                   class="bobot-total mt-3">
                                    Total bobot: 100%
                                </p>

                                <p id="status-bobot" class="bobot-status mt-1">
                                    Total bobot sudah sesuai.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- TOMBOL --}}
                    <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                        <button type="submit"
                                id="simpan-bobot"
                                class="bobot-btn bobot-btn-primary">
                            <i data-lucide="save" class="h-5 w-5"></i>
                            Simpan Bobot
                        </button>

                        <a href="{{ route('guru.rekap.index') }}"
                           class="bobot-btn bobot-btn-outline">
                            <i data-lucide="arrow-left" class="h-5 w-5"></i>
                            Kembali ke Rekap
                        </a>
                    </div>
                </form>
            </div>
        </div>
    @endif

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* DROPDOWN SEMESTER DAN TAHUN AJARAN */
    const semesterSelect = document.getElementById('pilih_semester');
    const selectRapor = document.getElementById('id_rapor');

    if (semesterSelect && selectRapor) {

        function sesuaikanTahunAjaran() {

            const semester = semesterSelect.value;

            let opsiPertama = null;
            let opsiTerpilih = null;

            Array.from(selectRapor.options).forEach(function (opsi) {

                const sesuai = opsi.dataset.semester === semester;

                opsi.hidden = !sesuai;
                opsi.disabled = !sesuai;

                if (sesuai && !opsiPertama) {
                    opsiPertama = opsi;
                }

                if (sesuai && opsi.selected) {
                    opsiTerpilih = opsi;
                }
            });

            if (opsiTerpilih) {
                selectRapor.value = opsiTerpilih.value;
            } else if (opsiPertama) {
                selectRapor.value = opsiPertama.value;
            } else {
                selectRapor.value = '';
            }

            selectRapor.disabled = !opsiPertama;
        }

        semesterSelect.addEventListener('change', sesuaikanTahunAjaran);

        sesuaikanTahunAjaran();
    }

    /* HITUNG TOTAL BOBOT */
    const harian = document.getElementById('bobot_harian');
    const uts = document.getElementById('bobot_uts');
    const uas = document.getElementById('bobot_uas');
    const total = document.getElementById('total-bobot');
    const status = document.getElementById('status-bobot');
    const tombolSimpan = document.getElementById('simpan-bobot');

    if (!harian || !uts || !uas || !total || !status) {
        return;
    }

    function hitungTotal() {

        const nilaiHarian = Number(harian.value) || 0;
        const nilaiUts = Number(uts.value) || 0;
        const nilaiUas = Number(uas.value) || 0;

        const jumlah = nilaiHarian + nilaiUts + nilaiUas;

        const valid =
            jumlah === 100 &&
            [harian, uts, uas].every(function (input) {
                return input.value !== '' &&
                    input.checkValidity();
            });

        total.textContent = 'Total bobot: ' + jumlah + '%';

        total.classList.remove(
            'text-green-700',
            'dark:text-green-300',
            'text-red-600',
            'dark:text-red-300'
        );

        status.classList.remove(
            'text-green-700',
            'dark:text-green-300',
            'text-red-600',
            'dark:text-red-300'
        );

        if (valid) {

            total.classList.add(
                'text-green-700',
                'dark:text-green-300'
            );

            status.classList.add(
                'text-green-700',
                'dark:text-green-300'
            );

            status.textContent =
                'Total bobot sudah sesuai dan siap disimpan.';

            if (tombolSimpan) {
                tombolSimpan.disabled = false;
            }

        } else {

            total.classList.add(
                'text-red-600',
                'dark:text-red-300'
            );

            status.classList.add(
                'text-red-600',
                'dark:text-red-300'
            );

            status.textContent = jumlah === 100
                ? 'Pastikan semua bobot berada di antara 0 sampai 100.'
                : jumlah < 100
                    ? 'Total bobot masih kurang ' + (100 - jumlah) + '%.'
                    : 'Total bobot melebihi ' + (jumlah - 100) + '%.';

            if (tombolSimpan) {
                tombolSimpan.disabled = true;
            }
        }
    }

    harian.addEventListener('input', hitungTotal);
    uts.addEventListener('input', hitungTotal);
    uas.addEventListener('input', hitungTotal);

    hitungTotal();

    // ANTI DOUBLE CLICK SIMPAN BOBOT
    const formBobot = tombolSimpan?.closest('form');
    let sedangMemproses = false;

    if (formBobot && tombolSimpan) {
        formBobot.addEventListener('submit', function (event) {
            if (sedangMemproses) {
                event.preventDefault();
                return;
            }

            if (!formBobot.checkValidity() || tombolSimpan.disabled) {
                return;
            }

            sedangMemproses = true;
            tombolSimpan.disabled = true;
            tombolSimpan.innerHTML = 'Memproses...';
        });
    }
});
</script>
@endsection