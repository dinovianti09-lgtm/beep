@extends('layouts.guru')

@section('title', 'Input Nilai - Sistem Akademik')
@section('page-title', 'Input Nilai')
@section('page-subtitle', 'Tambahkan nilai siswa sesuai kelas dan mata pelajaran yang diampu')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-slate-800 dark:text-white">Input Nilai Siswa</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Isi nilai harian, UTS, dan UAS siswa.</p>
        </div>

        <a href="{{ route('guru.rekap.index') }}"
           class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">
            Kembali ke Rekap
        </a>
    </div>

    {{-- PESAN ERROR --}}
    @if ($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 dark:border-red-900/60 dark:bg-red-950/40 dark:text-red-300">
            <p class="mb-2 font-semibold">Periksa kembali data berikut:</p>
            <ul class="list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700 dark:border-emerald-900/60 dark:bg-emerald-950/40 dark:text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- INFORMASI MAPEL --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6 dark:border-slate-700 dark:bg-slate-800">
        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Mata Pelajaran yang Diampu</p>
        <h3 class="mt-1 text-xl font-bold text-slate-800 dark:text-white">
            {{ $mapel->nama_mapel }}
        </h3>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
            Guru: {{ $guru->nama_guru ?? auth()->user()->username }}
        </p>
    </div>

    {{-- FORM INPUT --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6 dark:border-slate-700 dark:bg-slate-800">
        <form action="{{ route('guru.nilai.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                {{-- KELAS --}}
                <div>
                    <label for="id_kelas" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                        Kelas <span class="text-red-500">*</span>
                    </label>

                    <select id="id_kelas" name="id_kelas" required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-200 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                        <option value="">Pilih kelas terlebih dahulu</option>

                        @foreach ($kelasDiajar as $kelas)
                            <option value="{{ $kelas->id }}"
                                {{ (string) old('id_kelas', $kelasTerpilih) === (string) $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>

                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                        Pilih kelas terlebih dahulu sebelum memilih siswa.
                    </p>

                    @error('id_kelas')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- SISWA --}}
                <div>
                    <label for="id_siswa" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                        Nama Siswa <span class="text-red-500">*</span>
                    </label>

                    <select id="id_siswa" name="id_siswa" required disabled
                            class="w-full rounded-xl border border-slate-200 bg-slate-100 px-4 py-3 text-sm text-slate-500 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 disabled:cursor-not-allowed disabled:opacity-70 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-300 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                        <option value="">Pilih kelas terlebih dahulu</option>

                        @foreach ($siswaList as $siswa)
                            @php
                                $kelasSiswa = str_replace('-', ' ', trim((string) $siswa->kelas));

                                $idKelasSiswa = $kelasDiajar->first(function ($item) use ($kelasSiswa) {
                                    return str_replace('-', ' ', trim((string) $item->nama_kelas)) === $kelasSiswa;
                                });
                            @endphp

                            <option value="{{ $siswa->id_siswa }}"
                                    data-kelas="{{ $idKelasSiswa->id ?? '' }}"
                                {{ (string) old('id_siswa') === (string) $siswa->id_siswa ? 'selected' : '' }}>
                                {{ $siswa->nama_siswa }} — {{ $siswa->kelas }}
                            </option>
                        @endforeach
                    </select>

                    <p id="pesan-siswa" class="mt-1 text-xs text-slate-500 dark:text-slate-400" aria-live="polite">
                        Pilih kelas terlebih dahulu untuk membuka daftar siswa.
                    </p>

                    @error('id_siswa')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                    @if ($siswaList->isEmpty())
                        <p class="mt-1 text-sm text-amber-600 dark:text-amber-400">
                            Belum ada siswa di kelas yang diajar.
                        </p>
                    @endif
                </div>

                {{-- MAPEL --}}
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                        Mata Pelajaran
                    </label>
                    <input type="text" value="{{ $mapel->nama_mapel }}" readonly
                           class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-500 outline-none dark:border-slate-600 dark:bg-slate-900 dark:text-slate-400">
                </div>

                {{-- SEMESTER --}}
                <div>
                    <label for="semester" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                        Semester <span class="text-red-500">*</span>
                    </label>

                    <select id="semester" name="semester" required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-200 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                        <option value="">Pilih semester terlebih dahulu</option>
                        <option value="1" {{ old('semester') === '1' ? 'selected' : '' }}>
                            Semester 1 — Ganjil
                        </option>
                        <option value="2" {{ old('semester') === '2' ? 'selected' : '' }}>
                            Semester 2 — Genap
                        </option>
                    </select>

                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                        Pilih semester untuk membuka periode rapor yang sesuai.
                    </p>

                    @error('semester')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- RAPOR --}}
                <div>
                    <label for="id_rapor" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                        Periode Rapor <span class="text-red-500">*</span>
                    </label>

                    <select id="id_rapor" name="id_rapor" required disabled
                            class="w-full rounded-xl border border-slate-200 bg-slate-100 px-4 py-3 text-sm text-slate-500 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 disabled:cursor-not-allowed disabled:opacity-70 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-300 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                        <option value="">Pilih semester terlebih dahulu</option>

                        @foreach ($raporList as $rapor)
                            @php
                                $semesterRapor = strtolower(trim((string) $rapor->semester));

                                $nomorSemester = in_array($semesterRapor, ['ganjil', '1'], true)
                                    ? '1'
                                    : (in_array($semesterRapor, ['genap', '2'], true) ? '2' : '');
                            @endphp

                            <option value="{{ $rapor->id_rapor }}"
                                    data-semester="{{ $nomorSemester }}"
                                {{ (string) old('id_rapor') === (string) $rapor->id_rapor ? 'selected' : '' }}>
                                {{ $rapor->semester }} — {{ $rapor->tahun_ajaran }}
                            </option>
                        @endforeach
                    </select>

                    <p id="pesan-rapor" class="mt-1 text-xs text-slate-500 dark:text-slate-400" aria-live="polite">
                        Pilih semester terlebih dahulu untuk membuka periode rapor.
                    </p>

                    @error('id_rapor')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- KOMPONEN NILAI --}}
            <div class="border-t border-slate-100 pt-5 dark:border-slate-700">
                <h3 class="mb-4 text-lg font-bold text-slate-800 dark:text-white">Komponen Nilai</h3>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                    <div>
                        <label for="nilai_harian" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                            Nilai Harian <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="nilai_harian" name="nilai_harian"
                               min="0" max="100" step="0.01" required
                               value="{{ old('nilai_harian') }}" placeholder="0–100"
                               class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-200 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                        @error('nilai_harian')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nilai_uts" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                            Nilai UTS <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="nilai_uts" name="nilai_uts"
                               min="0" max="100" step="0.01" required
                               value="{{ old('nilai_uts') }}" placeholder="0–100"
                               class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-200 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                        @error('nilai_uts')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nilai_uas" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                            Nilai UAS <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="nilai_uas" name="nilai_uas"
                               min="0" max="100" step="0.01" required
                               value="{{ old('nilai_uas') }}" placeholder="0–100"
                               class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-200 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                        @error('nilai_uas')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <p class="mt-3 text-xs text-slate-500 dark:text-slate-400">
                    Nilai akhir dihitung otomatis: Harian 30%, UTS 30%, dan UAS 40%.
                </p>
            </div>

            {{-- TOMBOL --}}
            <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end dark:border-slate-700">
                <a href="{{ route('guru.rekap.index') }}"
                   class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">
                    Batal
                </a>

                <button type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-md shadow-indigo-500/20 transition hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800">
                    Simpan Nilai
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const kelasSelect = document.getElementById('id_kelas');
    const siswaSelect = document.getElementById('id_siswa');
    const pesanSiswa = document.getElementById('pesan-siswa');

    const semesterSelect = document.getElementById('semester');
    const raporSelect = document.getElementById('id_rapor');
    const pesanRapor = document.getElementById('pesan-rapor');

    if (!kelasSelect || !siswaSelect || !semesterSelect || !raporSelect) {
        return;
    }

    const siswaOptions = Array.from(siswaSelect.options).slice(1);
    const raporOptions = Array.from(raporSelect.options).slice(1);

    function filterSiswa() {
        const kelasId = kelasSelect.value;
        const siswaSebelumnya = siswaSelect.value;

        siswaOptions.forEach(function (option) {
            const cocok = kelasId !== '' && option.dataset.kelas === kelasId;
            option.hidden = !cocok;
            option.disabled = !cocok;
        });

        siswaSelect.disabled = kelasId === '';

        if (kelasId === '') {
            siswaSelect.value = '';
            siswaSelect.options[0].textContent = 'Pilih kelas terlebih dahulu';
            pesanSiswa.textContent = 'Pilih kelas terlebih dahulu untuk membuka daftar siswa.';
            return;
        }

        siswaSelect.options[0].textContent = 'Pilih siswa';

        const adaSiswa = siswaOptions.some(function (option) {
            return !option.disabled;
        });

        if (!adaSiswa) {
            siswaSelect.value = '';
            siswaSelect.options[0].textContent = 'Belum ada siswa di kelas ini';
            pesanSiswa.textContent = 'Belum ada siswa yang terdaftar di kelas ini.';
            return;
        }

        const pilihanMasihValid = siswaOptions.some(function (option) {
            return option.value === siswaSebelumnya && !option.disabled;
        });

        if (!pilihanMasihValid) {
            siswaSelect.value = '';
        }

        pesanSiswa.textContent = 'Pilih siswa dari kelas yang sudah dipilih.';
    }

    function filterRapor() {
        const semester = semesterSelect.value;
        const raporSebelumnya = raporSelect.value;

        raporOptions.forEach(function (option) {
            const cocok = semester !== '' && option.dataset.semester === semester;
            option.hidden = !cocok;
            option.disabled = !cocok;
        });

        raporSelect.disabled = semester === '';

        if (semester === '') {
            raporSelect.value = '';
            raporSelect.options[0].textContent = 'Pilih semester terlebih dahulu';
            pesanRapor.textContent = 'Pilih semester terlebih dahulu untuk membuka periode rapor.';
            return;
        }

        raporSelect.options[0].textContent = 'Pilih periode rapor';

        const adaRapor = raporOptions.some(function (option) {
            return !option.disabled;
        });

        if (!adaRapor) {
            raporSelect.value = '';
            raporSelect.options[0].textContent = 'Periode rapor belum tersedia';
            pesanRapor.textContent = 'Belum ada periode rapor untuk semester ini. Hubungi Admin.';
            return;
        }

        const pilihanMasihValid = raporOptions.some(function (option) {
            return option.value === raporSebelumnya && !option.disabled;
        });

        if (!pilihanMasihValid) {
            raporSelect.value = '';
        }

        pesanRapor.textContent = 'Pilih periode rapor yang sesuai dengan semester.';
    }

    // Pemberitahuan jika pengguna mencoba membuka dropdown yang masih terkunci.
    siswaSelect.addEventListener('mousedown', function (event) {
        if (kelasSelect.value === '') {
            event.preventDefault();
            alert('Pilih kelas terlebih dahulu sebelum memilih siswa.');
            kelasSelect.focus();
        }
    });

    siswaSelect.addEventListener('focus', function () {
        if (kelasSelect.value === '') {
            alert('Pilih kelas terlebih dahulu sebelum memilih siswa.');
            kelasSelect.focus();
        }
    });

    raporSelect.addEventListener('mousedown', function (event) {
        if (semesterSelect.value === '') {
            event.preventDefault();
            alert('Pilih semester terlebih dahulu sebelum memilih periode rapor.');
            semesterSelect.focus();
        }
    });

    raporSelect.addEventListener('focus', function () {
        if (semesterSelect.value === '') {
            alert('Pilih semester terlebih dahulu sebelum memilih periode rapor.');
            semesterSelect.focus();
        }
    });

    kelasSelect.addEventListener('change', filterSiswa);
    semesterSelect.addEventListener('change', filterRapor);

    filterSiswa();
    filterRapor();
});
</script>

@endsection