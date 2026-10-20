 @extends('layouts.guru')

@section('title', 'Edit Nilai - Sistem Akademik')

@section('page-title', 'Edit Nilai')

@section('page-subtitle', 'Perbarui nilai akademik siswa')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 dark:bg-amber-900/40">
                <i data-lucide="pencil" class="h-5 w-5 text-amber-700 dark:text-amber-300"></i>
            </div>
            <div>
                <h2 class="text-2xl font-extrabold text-slate-900 dark:text-slate-100">
                    Edit Nilai Siswa
                </h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Perbarui data nilai siswa yang telah diinput.
                </p>
            </div>
        </div>

        <a href="{{ route('guru.rekap.index') }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700">
            <i data-lucide="arrow-left" class="h-4 w-4"></i>
            Kembali ke Rekap
        </a>
    </div>

    {{-- NOTIFIKASI VALIDASI --}}
    @if($errors->any())
        <div class="rounded-2xl border border-red-100 bg-red-50 px-5 py-4 dark:border-red-900 dark:bg-red-950/40">
            <div class="flex gap-3">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/60">
                    <i data-lucide="alert-circle" class="h-5 w-5 text-red-600 dark:text-red-300"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-red-800 dark:text-red-300">
                        Periksa kembali data
                    </p>
                    <ul class="mt-2 space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="text-xs text-red-600 dark:text-red-300">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- FORM EDIT --}}
    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-900/5 dark:border-slate-700 dark:bg-slate-900">

        <div class="border-b border-slate-100 bg-gradient-to-r from-amber-50/70 to-orange-50/70 px-6 py-5 dark:border-slate-700 dark:from-slate-800 dark:to-slate-800">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 dark:bg-amber-900/40">
                    <i data-lucide="clipboard-pen-line" class="h-5 w-5 text-amber-700 dark:text-amber-300"></i>
                </div>
                <div>
                    <h3 class="font-bold text-slate-800 dark:text-slate-100">Form Edit Nilai</h3>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                        Ubah data yang diperlukan, kemudian simpan perubahan.
                    </p>
                </div>
            </div>
        </div>

        <form action="{{ route('guru.rekap.update', $nilai->id_nilai) }}"
              method="POST"
              id="formEditNilai"
              class="space-y-6 p-6">

            @csrf
            @method('PUT')

            {{-- DATA SISWA DAN MAPEL --}}
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                <div>
                    <label for="id_siswa" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                        Siswa
                    </label>

                    <select name="id_siswa"
                            id="id_siswa"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100">

                        @foreach($siswaList as $siswa)
                            <option value="{{ $siswa->id_siswa }}"
                                {{ (string) old('id_siswa', $nilai->id_siswa) === (string) $siswa->id_siswa ? 'selected' : '' }}>
                                {{ $siswa->nama_siswa }}@if($siswa->nis) - {{ $siswa->nis }}@endif
                            </option>
                        @endforeach
                    </select>

                    <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                        Pilih siswa yang termasuk kelas yang kamu ajar.
                    </p>
                </div>

                <div>
                    <label for="nama_mapel" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                        Mata Pelajaran
                    </label>

                    <input type="text"
                           id="nama_mapel"
                           value="{{ $mapel->nama_mapel ?? $nilai->mapel->nama_mapel ?? '-' }}"
                           readonly
                           class="w-full cursor-not-allowed rounded-xl border border-slate-200 bg-slate-100 px-4 py-3 text-sm text-slate-600 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-300">

                    <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                        Mata pelajaran mengikuti akun guru yang sedang login.
                    </p>
                </div>

            </div>

            {{-- SEMESTER DAN RAPOR --}}
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                <div>
                    <label for="semester" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                        Semester
                    </label>

                    <select name="semester"
                            id="semester"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100">

                        <option value="1" {{ (string) old('semester', $nilai->semester) === '1' ? 'selected' : '' }}>
                            Semester 1
                        </option>
                        <option value="2" {{ (string) old('semester', $nilai->semester) === '2' ? 'selected' : '' }}>
                            Semester 2
                        </option>
                    </select>
                </div>

                <div>
                    <label for="id_rapor" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                        Periode Rapor
                    </label>

                    <select name="id_rapor"
                            id="id_rapor"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100">

                        <option value="">-- Pilih Periode Rapor --</option>

                        @foreach($raporList as $rapor)
                            @php
                                $semesterRapor = in_array((string) $rapor->semester, ['1', 'Ganjil'], true) ? '1' : (in_array((string) $rapor->semester, ['2', 'Genap'], true) ? '2' : '');
                            @endphp

                            <option value="{{ $rapor->id_rapor }}"
                                    data-semester="{{ $semesterRapor }}"
                                {{ (string) old('id_rapor', $nilai->id_rapor) === (string) $rapor->id_rapor ? 'selected' : '' }}>
                                Semester {{ $rapor->semester }} - {{ $rapor->tahun_ajaran }}
                            </option>
                        @endforeach
                    </select>

                    <p id="pesanRapor" class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                        Periode rapor akan menyesuaikan semester yang dipilih.
                    </p>
                </div>

            </div>

            {{-- NILAI AKADEMIK --}}
            <div>
                <div class="mb-4">
                    <h3 class="text-base font-bold text-slate-800 dark:text-slate-100">
                        Nilai Akademik
                    </h3>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                        Masukkan nilai antara 0 sampai 100.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">

                    <div>
                        <label for="nilai_harian" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            Nilai Harian
                        </label>
                        <input type="number"
                               name="nilai_harian"
                               id="nilai_harian"
                               min="0"
                               max="100"
                               step="0.01"
                               required
                               value="{{ old('nilai_harian', $nilai->nilai_harian) }}"
                               class="nilai-input w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100">
                    </div>

                    <div>
                        <label for="nilai_uts" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            Nilai UTS
                        </label>
                        <input type="number"
                               name="nilai_uts"
                               id="nilai_uts"
                               min="0"
                               max="100"
                               step="0.01"
                               required
                               value="{{ old('nilai_uts', $nilai->nilai_uts) }}"
                               class="nilai-input w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100">
                    </div>

                    <div>
                        <label for="nilai_uas" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            Nilai UAS
                        </label>
                        <input type="number"
                               name="nilai_uas"
                               id="nilai_uas"
                               min="0"
                               max="100"
                               step="0.01"
                               required
                               value="{{ old('nilai_uas', $nilai->nilai_uas) }}"
                               class="nilai-input w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100">
                    </div>

                </div>
            </div>

            {{-- HASIL PERHITUNGAN --}}
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 dark:border-slate-700 dark:bg-slate-800/70">

                <div class="mb-4 flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 dark:bg-blue-900/40">
                        <i data-lucide="chart-no-axes-combined" class="h-5 w-5 text-blue-700 dark:text-blue-300"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800 dark:text-slate-100">Hasil Perhitungan</h3>
                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                            Dihitung otomatis berdasarkan bobot nilai.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    <div class="rounded-xl border border-slate-200 bg-white p-4 dark:border-slate-700 dark:bg-slate-900">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Nilai Akhir
                        </p>
                        <p id="nilai_akhir_preview" class="mt-2 text-2xl font-extrabold text-blue-600 dark:text-blue-400">
                            {{ number_format((float) $nilai->nilai_akhir, 2) }}
                        </p>
                        <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">
                            Harian 30% · UTS 30% · UAS 40%
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200 bg-white p-4 dark:border-slate-700 dark:bg-slate-900">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Predikat
                        </p>
                        <p id="predikat_preview" class="mt-2 text-2xl font-extrabold text-indigo-600 dark:text-indigo-400">
                            {{ $nilai->predikat ?? '-' }}
                        </p>
                        <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">
                            A ≥ 90 · B ≥ 80 · C ≥ 70 · D &lt; 70
                        </p>
                    </div>

                </div>
            </div>

            {{-- BUTTON --}}
            <div class="flex flex-col gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end dark:border-slate-700">

                <a href="{{ route('guru.rekap.index') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700">
                    <i data-lucide="x" class="h-4 w-4"></i>
                    Batal
                </a>

                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-900/10 transition hover:-translate-y-0.5">
                    <i data-lucide="save" class="h-4 w-4"></i>
                    Simpan Perubahan
                </button>

            </div>

        </form>
    </div>

    {{-- INFO --}}
    <div class="flex gap-3 rounded-2xl border border-amber-100 bg-amber-50 px-5 py-4 dark:border-amber-900 dark:bg-amber-950/30">
        <i data-lucide="info" class="h-5 w-5 shrink-0 text-amber-600 dark:text-amber-400"></i>
        <div>
            <p class="text-sm font-semibold text-amber-800 dark:text-amber-300">Informasi</p>
            <p class="mt-1 text-xs text-amber-700 dark:text-amber-300/80">
                Mata pelajaran tidak dapat diubah karena mengikuti mata pelajaran yang diampu oleh guru yang sedang login.
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
        const harianInput = document.getElementById('nilai_harian');
        const utsInput = document.getElementById('nilai_uts');
        const uasInput = document.getElementById('nilai_uas');

        const harian = parseFloat(harianInput.value);
        const uts = parseFloat(utsInput.value);
        const uas = parseFloat(uasInput.value);

        const semuaValid = [harianInput, utsInput, uasInput].every(function (input) {
            return input.value.trim() !== ''
                && Number.isFinite(parseFloat(input.value))
                && parseFloat(input.value) >= 0
                && parseFloat(input.value) <= 100;
        });

        if (!semuaValid) {
            document.getElementById('nilai_akhir_preview').textContent = '-';
            document.getElementById('predikat_preview').textContent = '-';
            return;
        }

        const nilaiAkhir = (harian * 0.30) + (uts * 0.30) + (uas * 0.40);

        let predikat = 'D';
        if (nilaiAkhir >= 90) {
            predikat = 'A';
        } else if (nilaiAkhir >= 80) {
            predikat = 'B';
        } else if (nilaiAkhir >= 70) {
            predikat = 'C';
        }

        document.getElementById('nilai_akhir_preview').textContent = nilaiAkhir.toFixed(2);
        document.getElementById('predikat_preview').textContent = predikat;
    }

    semesterSelect.addEventListener('change', filterRapor);

    document.querySelectorAll('.nilai-input').forEach(function (input) {
        input.addEventListener('input', hitungNilai);
    });

    filterRapor();
    hitungNilai();

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>

@endsection