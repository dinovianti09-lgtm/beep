
@extends('layouts.guru')

@section('title', 'Edit Nilai - Sistem Akademik')
@section('page-title', 'Edit Nilai')
@section('page-subtitle', 'Perbarui nilai akademik siswa')

@section('content')

@php
    $dataBobot = [];

    foreach ($raporList as $raporItem) {
        $bobotItem = $bobotNilai[$raporItem->id_rapor] ?? null;

        $dataBobot[$raporItem->id_rapor] = [
            'harian' => (float) ($bobotItem->bobot_harian ?? 30),
            'uts' => (float) ($bobotItem->bobot_uts ?? 30),
            'uas' => (float) ($bobotItem->bobot_uas ?? 40),
        ];
    }

    $predikatAwal = strtoupper($nilai->predikat ?? '-');

    $warnaPredikatAwal = match ($predikatAwal) {
        'A' => 'predikat-a',
        'B' => 'predikat-b',
        'C' => 'predikat-c',
        'D' => 'predikat-d',
        default => 'predikat-default',
    };
@endphp

<style>
    .edit-nilai-page {
        --en-blue: #78a9e5;
        --en-blue-soft: #edf5ff;
        --en-blue-border: #d7e8ff;
    }

    .edit-nilai-page .en-card {
        border-color: var(--en-blue-border);
        background: #ffffff;
    }

    .edit-nilai-page .en-section-icon {
        display: flex;
        width: 30px;
        height: 30px;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #eaf3ff;
        color: #548bd1;
    }

    .edit-nilai-page .en-section-icon svg {
        width: 16px;
        height: 16px;
    }

    .edit-nilai-page .en-input {
        border-color: #d8e6f7;
        background: #fbfdff;
        color: #334155;
    }

    .edit-nilai-page .en-input:focus {
        border-color: #83b4ed;
        box-shadow: 0 0 0 4px rgb(125 174 234 / 15%);
    }

    .edit-nilai-page .en-soft-panel {
        border-color: #d9eaff;
        background: #f1f7ff;
    }

    .edit-nilai-page .en-preview-card {
        border-color: #dceaff;
        background: #ffffff;
    }

    .edit-nilai-page .en-final-badge {
        display: inline-flex;
        align-items: center;
        border: 1px solid #c8defb;
        border-radius: 12px;
        background: #e8f2ff;
        padding: 7px 13px;
        color: #477fca;
        font-size: 1.5rem;
        font-weight: 800;
    }

    .edit-nilai-page .en-predikat-badge {
        display: inline-flex;
        min-width: 52px;
        align-items: center;
        justify-content: center;
        border: 1px solid transparent;
        border-radius: 12px;
        padding: 7px 15px;
        font-size: 1.5rem;
        font-weight: 800;
    }

    .edit-nilai-page .predikat-a {
        border-color: #a7e8c2;
        background: #e4f9ed;
        color: #218653;
    }

    .edit-nilai-page .predikat-b {
        border-color: #bfdcff;
        background: #e8f2ff;
        color: #477fca;
    }

    .edit-nilai-page .predikat-c {
        border-color: #f5df9b;
        background: #fff7dc;
        color: #a87913;
    }

    .edit-nilai-page .predikat-d {
        border-color: #ffcaca;
        background: #fff0f0;
        color: #d34f4f;
    }

    .edit-nilai-page .predikat-default {
        border-color: #dbe5f1;
        background: #f1f5f9;
        color: #64748b;
    }

    .edit-nilai-page .en-primary-button {
        background: #78a9e5;
        color: #ffffff;
    }

    .edit-nilai-page .en-primary-button:hover {
        background: #5d94d8;
    }

    .edit-nilai-page .en-back-button {
        border-color: #d5e5f8;
        background: #f7faff;
        color: #5485c2;
    }

    .edit-nilai-page .en-back-button:hover {
        border-color: #b8d5f7;
        background: #eaf3ff;
        color: #386fae;
    }

    .dark .edit-nilai-page .en-card {
        border-color: #334b68;
        background: #17283d;
    }

    .dark .edit-nilai-page .en-section-icon {
        background: #243e5e;
        color: #a8ceff;
    }

    .dark .edit-nilai-page .en-input {
        border-color: #405875;
        background: #1e324a;
        color: #e2eaf5;
    }

    .dark .edit-nilai-page .en-input:focus {
        border-color: #76a9e5;
        box-shadow: 0 0 0 4px rgb(118 169 229 / 15%);
    }

    .dark .edit-nilai-page .en-soft-panel {
        border-color: #345273;
        background: #1b3049;
    }

    .dark .edit-nilai-page .en-preview-card {
        border-color: #405875;
        background: #1b3049;
    }

    .dark .edit-nilai-page .en-final-badge {
        border-color: #365d89;
        background: #263f5d;
        color: #a8ceff;
    }

    .dark .edit-nilai-page .predikat-a {
        border-color: #286a4a;
        background: #183d30;
        color: #8de0ae;
    }

    .dark .edit-nilai-page .predikat-b {
        border-color: #365f8d;
        background: #213e5e;
        color: #a8ceff;
    }

    .dark .edit-nilai-page .predikat-c {
        border-color: #80682f;
        background: #493c20;
        color: #f5d47e;
    }

    .dark .edit-nilai-page .predikat-d {
        border-color: #854747;
        background: #492b30;
        color: #ffaaaa;
    }

    .dark .edit-nilai-page .predikat-default {
        border-color: #46566a;
        background: #2b3b50;
        color: #cbd5e1;
    }

    .dark .edit-nilai-page .en-back-button {
        border-color: #405875;
        background: #1e324a;
        color: #b7d5fa;
    }

    .dark .edit-nilai-page .en-back-button:hover {
        background: #294361;
        color: #d5e8ff;
    }

    @media (max-width: 640px) {
        .edit-nilai-page .en-final-badge,
        .edit-nilai-page .en-predikat-badge {
            font-size: 1.25rem;
        }
    }
</style>

<div class="edit-nilai-page space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-3">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-100 dark:bg-blue-900/40">
                <i data-lucide="clipboard-pen-line" class="h-6 w-6 text-blue-600 dark:text-blue-300"></i>
            </div>

            <div>
                <h2 class="text-xl font-extrabold text-slate-800 dark:text-slate-100 sm:text-2xl">
                    Edit Nilai Siswa
                </h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Perbarui data nilai akademik siswa.
                </p>
            </div>
        </div>

        <a href="{{ route('guru.rekap.index') }}"
           class="en-back-button inline-flex items-center justify-center gap-2 rounded-xl border px-5 py-3 text-sm font-semibold transition">
            <i data-lucide="arrow-left" class="h-4 w-4"></i>
            Kembali ke Rekap
        </a>
    </div>

    {{-- VALIDATION ERROR --}}
    @if($errors->any())
        <div class="rounded-2xl border border-red-200 bg-red-50 p-5 dark:border-red-900/50 dark:bg-red-950/30">
            <div class="flex gap-3">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-100 dark:bg-red-900/40">
                    <i data-lucide="alert-circle" class="h-5 w-5 text-red-600 dark:text-red-400"></i>
                </div>

                <div>
                    <p class="font-semibold text-red-800 dark:text-red-300">
                        Periksa kembali data
                    </p>

                    <ul class="mt-2 space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="text-sm text-red-700 dark:text-red-300">
                                • {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- FORM CARD --}}
    <div class="en-card overflow-hidden rounded-2xl border shadow-sm">

        {{-- CARD HEADER --}}
        <div class="border-b border-blue-100 bg-blue-50/80 px-6 py-5 dark:border-slate-700 dark:bg-slate-800/80">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 dark:bg-blue-900/50">
                    <i data-lucide="file-pen-line" class="h-5 w-5 text-blue-600 dark:text-blue-300"></i>
                </div>

                <div>
                    <h3 class="font-bold text-slate-800 dark:text-slate-100">
                        Form Edit Nilai
                    </h3>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                        Lengkapi data berikut untuk memperbarui nilai siswa.
                    </p>
                </div>
            </div>
        </div>

        <form action="{{ route('guru.rekap.update', $nilai->id_nilai) }}"
              method="POST"
              id="formEditNilai"
              class="space-y-7 p-5 sm:p-6">

            @csrf
            @method('PUT')

            {{-- DATA SISWA --}}
            <section>
                <div class="mb-4 flex items-center gap-2">
                    <span class="en-section-icon">
                        <i data-lucide="user-round"></i>
                    </span>
                    <h3 class="font-bold text-slate-800 dark:text-slate-100">
                        Data Siswa dan Mata Pelajaran
                    </h3>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <div>
                        <label for="id_siswa" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            Siswa <span class="text-red-500">*</span>
                        </label>

                        <select name="id_siswa"
                                id="id_siswa"
                                required
                                class="en-input w-full rounded-xl border px-4 py-3 text-sm outline-none transition">

                            @foreach($siswaList as $siswa)
                                <option value="{{ $siswa->id_siswa }}"
                                    {{ (string) old('id_siswa', $nilai->id_siswa) === (string) $siswa->id_siswa ? 'selected' : '' }}>
                                    {{ $siswa->nama_siswa }}
                                    @if($siswa->nis)
                                        - {{ $siswa->nis }}
                                    @endif
                                </option>
                            @endforeach
                        </select>

                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                            Pilih siswa dari kelas yang kamu ajar.
                        </p>
                    </div>

                    <div>
                        <label for="nama_mapel" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            Mata Pelajaran
                        </label>

                        <div class="relative">
                            <span class="absolute inset-y-0 left-4 flex items-center text-blue-400">
                                <i data-lucide="book-open" class="h-4 w-4"></i>
                            </span>

                            <input type="text"
                                   id="nama_mapel"
                                   value="{{ $mapel->nama_mapel ?? $nilai->mapel->nama_mapel ?? '-' }}"
                                   readonly
                                   class="en-input w-full cursor-not-allowed rounded-xl border py-3 pl-11 pr-4 text-sm opacity-80">
                        </div>

                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                            Mengikuti mata pelajaran yang diampu guru.
                        </p>
                    </div>

                </div>
            </section>

            <div class="border-t border-blue-100 dark:border-slate-700"></div>

            {{-- PERIODE RAPOR --}}
            <section>
                <div class="mb-4 flex items-center gap-2">
                    <span class="en-section-icon">
                        <i data-lucide="calendar-days"></i>
                    </span>
                    <h3 class="font-bold text-slate-800 dark:text-slate-100">
                        Periode Akademik
                    </h3>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <div>
                        <label for="semester" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            Semester <span class="text-red-500">*</span>
                        </label>

                        <select name="semester"
                                id="semester"
                                required
                                class="en-input w-full rounded-xl border px-4 py-3 text-sm outline-none transition">

                            <option value="1" {{ (string) old('semester', $nilai->semester) === '1' ? 'selected' : '' }}>
                                Semester 1 (Ganjil)
                            </option>

                            <option value="2" {{ (string) old('semester', $nilai->semester) === '2' ? 'selected' : '' }}>
                                Semester 2 (Genap)
                            </option>
                        </select>
                    </div>

                    <div>
                        <label for="id_rapor" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            Periode Rapor <span class="text-red-500">*</span>
                        </label>

                        <select name="id_rapor"
                                id="id_rapor"
                                required
                                class="en-input w-full rounded-xl border px-4 py-3 text-sm outline-none transition">

                            <option value="">-- Pilih Periode Rapor --</option>

                            @foreach($raporList as $rapor)
                                @php
                                    $semesterRapor = in_array((string) $rapor->semester, ['1', 'Ganjil'], true)
                                        ? '1'
                                        : (in_array((string) $rapor->semester, ['2', 'Genap'], true) ? '2' : '');
                                @endphp

                                <option value="{{ $rapor->id_rapor }}"
                                        data-semester="{{ $semesterRapor }}"
                                    {{ (string) old('id_rapor', $nilai->id_rapor) === (string) $rapor->id_rapor ? 'selected' : '' }}>
                                    Semester {{ $rapor->semester }} - {{ $rapor->tahun_ajaran }}
                                </option>
                            @endforeach
                        </select>

                        <p id="pesanRapor" class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                            Pilih periode rapor yang sesuai dengan semester.
                        </p>
                    </div>

                </div>
            </section>

            <div class="border-t border-blue-100 dark:border-slate-700"></div>

            {{-- INPUT NILAI --}}
            <section>
                <div class="mb-4 flex items-center gap-2">
                    <span class="en-section-icon">
                        <i data-lucide="graduation-cap"></i>
                    </span>
                    <h3 class="font-bold text-slate-800 dark:text-slate-100">
                        Nilai Akademik
                    </h3>
                </div>

                <p class="mb-4 text-sm text-slate-500 dark:text-slate-400">
                    Masukkan nilai pada rentang 0 sampai 100.
                </p>

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">

                    <div>
                        <label for="nilai_harian" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            Nilai Harian <span class="text-red-500">*</span>
                        </label>

                        <input type="number"
                               name="nilai_harian"
                               id="nilai_harian"
                               min="0"
                               max="100"
                               step="0.01"
                               required
                               value="{{ old('nilai_harian', $nilai->nilai_harian) }}"
                               class="nilai-input en-input w-full rounded-xl border px-4 py-3 text-sm outline-none transition">
                    </div>

                    <div>
                        <label for="nilai_uts" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            Nilai UTS <span class="text-red-500">*</span>
                        </label>

                        <input type="number"
                               name="nilai_uts"
                               id="nilai_uts"
                               min="0"
                               max="100"
                               step="0.01"
                               required
                               value="{{ old('nilai_uts', $nilai->nilai_uts) }}"
                               class="nilai-input en-input w-full rounded-xl border px-4 py-3 text-sm outline-none transition">
                    </div>

                    <div>
                        <label for="nilai_uas" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            Nilai UAS <span class="text-red-500">*</span>
                        </label>

                        <input type="number"
                               name="nilai_uas"
                               id="nilai_uas"
                               min="0"
                               max="100"
                               step="0.01"
                               required
                               value="{{ old('nilai_uas', $nilai->nilai_uas) }}"
                               class="nilai-input en-input w-full rounded-xl border px-4 py-3 text-sm outline-none transition">
                    </div>

                </div>
            </section>

            {{-- PREVIEW NILAI --}}
            <section class="en-soft-panel rounded-2xl border p-5">

                <div class="mb-5 flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 dark:bg-blue-900/50">
                        <i data-lucide="chart-no-axes-combined" class="h-5 w-5 text-blue-600 dark:text-blue-300"></i>
                    </div>

                    <div>
                        <h3 class="font-bold text-slate-800 dark:text-slate-100">
                            Hasil Perhitungan
                        </h3>
                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                            Preview otomatis berdasarkan bobot periode rapor.
                        </p>
                    </div>
                </div>

                {{-- INFORMASI BOBOT --}}
                <div class="mb-4 grid grid-cols-3 gap-2">
                    <div class="rounded-xl border border-blue-100 bg-white p-3 text-center dark:border-slate-700 dark:bg-slate-900">
                        <p class="text-xs text-slate-500 dark:text-slate-400">Harian</p>
                        <p id="bobot_harian_preview" class="mt-1 text-lg font-extrabold text-blue-600 dark:text-blue-300">30%</p>
                    </div>

                    <div class="rounded-xl border border-blue-100 bg-white p-3 text-center dark:border-slate-700 dark:bg-slate-900">
                        <p class="text-xs text-slate-500 dark:text-slate-400">UTS</p>
                        <p id="bobot_uts_preview" class="mt-1 text-lg font-extrabold text-blue-600 dark:text-blue-300">30%</p>
                    </div>

                    <div class="rounded-xl border border-blue-100 bg-white p-3 text-center dark:border-slate-700 dark:bg-slate-900">
                        <p class="text-xs text-slate-500 dark:text-slate-400">UAS</p>
                        <p id="bobot_uas_preview" class="mt-1 text-lg font-extrabold text-blue-600 dark:text-blue-300">40%</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    <div class="en-preview-card rounded-xl border p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Nilai Akhir
                        </p>

                        <div class="mt-3">
                            <span id="nilai_akhir_preview" class="en-final-badge">
                                {{ number_format((float) $nilai->nilai_akhir, 2) }}
                            </span>
                        </div>

                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                            Hasil perhitungan sesuai bobot.
                        </p>
                    </div>

                    <div class="en-preview-card rounded-xl border p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Predikat
                        </p>

                        <div class="mt-3">
                            <span id="predikat_preview" class="en-predikat-badge {{ $warnaPredikatAwal }}">
                                {{ $predikatAwal }}
                            </span>
                        </div>

                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                            A ≥ 90 · B ≥ 80 · C ≥ 70 · D &lt; 70
                        </p>
                    </div>

                </div>
            </section>

            {{-- BUTTON --}}
            <div class="flex flex-col-reverse gap-3 border-t border-blue-100 pt-5 dark:border-slate-700 sm:flex-row sm:justify-end">

                <a href="{{ route('guru.rekap.index') }}"
                   class="en-back-button inline-flex items-center justify-center gap-2 rounded-xl border px-5 py-3 text-sm font-semibold transition">
                    <i data-lucide="x" class="h-4 w-4"></i>
                    Batal
                </a>

                <button type="submit"
                        class="en-primary-button inline-flex items-center justify-center gap-2 rounded-xl px-6 py-3 text-sm font-bold shadow-sm transition hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-blue-300/40">
                    <i data-lucide="save" class="h-4 w-4"></i>
                    Simpan Perubahan
                </button>

            </div>

        </form>
    </div>

    {{-- INFORMATION --}}
    <div class="flex gap-3 rounded-2xl border border-blue-100 bg-blue-50/80 px-5 py-4 dark:border-blue-900/40 dark:bg-blue-950/30">
        <i data-lucide="info" class="mt-0.5 h-5 w-5 shrink-0 text-blue-600 dark:text-blue-300"></i>

        <div>
            <p class="text-sm font-bold text-blue-800 dark:text-blue-200">
                Informasi
            </p>
            <p class="mt-1 text-xs leading-relaxed text-blue-700 dark:text-blue-200/80">
                Mata pelajaran mengikuti akun guru yang sedang login. Nilai akhir dihitung berdasarkan bobot yang telah diatur untuk mata pelajaran dan periode rapor yang dipilih.
            </p>
        </div>
    </div>

    <div class="pb-2 text-center text-xs text-slate-400 dark:text-slate-500">
        © {{ date('Y') }} Sistem Akademik Mini
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const semesterSelect = document.getElementById('semester');
    const raporSelect = document.getElementById('id_rapor');
    const pesanRapor = document.getElementById('pesanRapor');

    const harianInput = document.getElementById('nilai_harian');
    const utsInput = document.getElementById('nilai_uts');
    const uasInput = document.getElementById('nilai_uas');

    const nilaiAkhirPreview = document.getElementById('nilai_akhir_preview');
    const predikatPreview = document.getElementById('predikat_preview');

    const bobotHarianPreview = document.getElementById('bobot_harian_preview');
    const bobotUtsPreview = document.getElementById('bobot_uts_preview');
    const bobotUasPreview = document.getElementById('bobot_uas_preview');

    const bobotPerRapor = @json($dataBobot);

    const bobotDefault = {
        harian: 30,
        uts: 30,
        uas: 40
    };

    function ambilBobot() {
        const idRapor = raporSelect.value;
        return bobotPerRapor[idRapor] || bobotDefault;
    }

    function aturWarnaPredikat(predikat) {
        const daftarKelas = [
            'predikat-a',
            'predikat-b',
            'predikat-c',
            'predikat-d',
            'predikat-default'
        ];

        predikatPreview.classList.remove(...daftarKelas);

        const warna = {
            A: 'predikat-a',
            B: 'predikat-b',
            C: 'predikat-c',
            D: 'predikat-d'
        };

        predikatPreview.classList.add(
            warna[predikat] || 'predikat-default'
        );
    }

    function filterRapor() {
        const semesterDipilih = semesterSelect.value;
        let raporTerpilihMasihCocok = false;

        Array.from(raporSelect.options).forEach(function (option) {
            if (option.value === '') {
                option.hidden = false;
                option.disabled = false;
                return;
            }

            const cocok = option.dataset.semester === semesterDipilih;

            option.hidden = !cocok;
            option.disabled = !cocok;

            if (cocok && option.selected) {
                raporTerpilihMasihCocok = true;
            }
        });

        if (!raporTerpilihMasihCocok) {
            raporSelect.value = '';
        }

        pesanRapor.textContent = raporSelect.value
            ? 'Periode rapor sesuai dengan semester yang dipilih.'
            : 'Silakan pilih periode rapor yang sesuai dengan semester.';
    }

    function hitungNilai() {
        const bobot = ambilBobot();

        bobotHarianPreview.textContent = bobot.harian + '%';
        bobotUtsPreview.textContent = bobot.uts + '%';
        bobotUasPreview.textContent = bobot.uas + '%';

        const semuaValid = [harianInput, utsInput, uasInput].every(function (input) {
            return input.value.trim() !== ''
                && Number.isFinite(parseFloat(input.value))
                && parseFloat(input.value) >= 0
                && parseFloat(input.value) <= 100;
        });

        if (!semuaValid) {
            nilaiAkhirPreview.textContent = '-';
            predikatPreview.textContent = '-';
            aturWarnaPredikat('-');
            return;
        }

        const harian = parseFloat(harianInput.value);
        const uts = parseFloat(utsInput.value);
        const uas = parseFloat(uasInput.value);

        const nilaiAkhir =
            (harian * bobot.harian / 100) +
            (uts * bobot.uts / 100) +
            (uas * bobot.uas / 100);

        let predikat = 'D';

        if (nilaiAkhir >= 90) {
            predikat = 'A';
        } else if (nilaiAkhir >= 80) {
            predikat = 'B';
        } else if (nilaiAkhir >= 70) {
            predikat = 'C';
        }

        nilaiAkhirPreview.textContent = nilaiAkhir.toFixed(2);
        predikatPreview.textContent = predikat;

        aturWarnaPredikat(predikat);
    }

    semesterSelect.addEventListener('change', function () {
        filterRapor();
        hitungNilai();
    });

    raporSelect.addEventListener('change', hitungNilai);

    [harianInput, utsInput, uasInput].forEach(function (input) {
        input.addEventListener('input', hitungNilai);
    });

    filterRapor();
    hitungNilai();

    // Render semua ikon Lucide menjadi SVG.
    function renderIkonLucide() {
        if (window.lucide && typeof window.lucide.createIcons === 'function') {
            window.lucide.createIcons();
        }
    }

       renderIkonLucide();

    // ANTI DOUBLE CLICK SIMPAN PERUBAHAN
    const formEdit = document.getElementById('formEditNilai');
    const tombolSimpan = formEdit?.querySelector('button[type="submit"]');

    let sedangMemproses = false;

    if (formEdit && tombolSimpan) {
        formEdit.addEventListener('submit', function (event) {
            if (sedangMemproses) {
                event.preventDefault();
                return;
            }

            if (!formEdit.checkValidity()) {
                return;
            }

            sedangMemproses = true;
            tombolSimpan.disabled = true;
            tombolSimpan.textContent = 'Memproses...';
        });
    }
});
</script>

@endsection
