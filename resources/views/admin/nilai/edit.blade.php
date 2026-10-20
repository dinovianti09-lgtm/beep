@extends('layouts.admin')

@section('title', 'Edit Nilai - Sistem Akademik')

@section('page-title', 'Edit Nilai')

@section('page-subtitle', 'Perbarui data nilai siswa')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">
                Edit Nilai
            </h2>

            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Perbarui data nilai siswa
            </p>
        </div>

        <a href="{{ route('admin.nilai.index') }}"
           class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-600 dark:text-slate-200 text-sm font-semibold hover:bg-slate-50 dark:hover:bg-slate-800 transition">
            ← Kembali
        </a>

    </div>


    {{-- ERROR --}}
    @if($errors->any())

        <div class="rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 px-5 py-4 text-sm text-red-700 dark:text-red-400">

            <p class="font-semibold mb-2">
                Data belum bisa disimpan
            </p>

            <ul class="list-disc ml-5 space-y-1">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- FORM --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">

        <form action="{{ route('admin.nilai.update', $nilai->id_nilai) }}"
              method="POST">

            @csrf
            @method('PUT')


            {{-- DATA AKADEMIK --}}
            <div class="p-6">

                <div class="mb-6">

                    <h3 class="text-lg font-bold text-slate-800 dark:text-white">
                        Data Akademik
                    </h3>

                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                        Perbarui siswa, mata pelajaran, semester, dan periode rapor.
                    </p>

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- SISWA --}}
                    <div>

                        <label for="id_siswa"
                               class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2">

                            Siswa
                            <span class="text-red-500">*</span>

                        </label>

                        <select id="id_siswa"
                                name="id_siswa"
                                required
                                class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 px-4 py-3 text-sm text-slate-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-400">

                            @foreach($siswaList as $siswa)

                                <option value="{{ $siswa->id_siswa }}"
                                    {{ old('id_siswa', $nilai->id_siswa) == $siswa->id_siswa ? 'selected' : '' }}>

                                    {{ $siswa->nama_siswa }} - {{ $siswa->kelas }}

                                </option>

                            @endforeach

                        </select>

                        @error('id_siswa')

                            <p class="mt-2 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- MAPEL --}}
                    <div>

                        <label for="id_mapel"
                               class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2">

                            Mata Pelajaran
                            <span class="text-red-500">*</span>

                        </label>

                        <select id="id_mapel"
                                name="id_mapel"
                                required
                                class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 px-4 py-3 text-sm text-slate-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-400">

                            @foreach($mapelList as $mapel)

                                <option value="{{ $mapel->id_mapel }}"
                                    {{ old('id_mapel', $nilai->id_mapel) == $mapel->id_mapel ? 'selected' : '' }}>

                                    {{ $mapel->nama_mapel }}

                                </option>

                            @endforeach

                        </select>

                        @error('id_mapel')

                            <p class="mt-2 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- SEMESTER --}}
                    <div>

                        <label for="semester"
                               class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2">

                            Semester
                            <span class="text-red-500">*</span>

                        </label>

                        <select id="semester"
                                name="semester"
                                required
                                class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 px-4 py-3 text-sm text-slate-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-400">

                            <option value="1"
                                {{ old('semester', $nilai->semester) == 1 ? 'selected' : '' }}>
                                Ganjil
                            </option>

                            <option value="2"
                                {{ old('semester', $nilai->semester) == 2 ? 'selected' : '' }}>
                                Genap
                            </option>

                        </select>

                        @error('semester')

                            <p class="mt-2 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- PERIODE RAPOR --}}
                    <div>

                        <label for="id_rapor"
                               class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2">

                            Periode Rapor
                            <span class="text-red-500">*</span>

                        </label>

                        <select id="id_rapor"
                                name="id_rapor"
                                required
                                class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 px-4 py-3 text-sm text-slate-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-400">

                            @foreach($raporList as $rapor)

                                <option value="{{ $rapor->id_rapor }}"
                                    {{ old('id_rapor', $nilai->id_rapor) == $rapor->id_rapor ? 'selected' : '' }}>

                                    {{ $rapor->semester }} — {{ $rapor->tahun_ajaran }}

                                </option>

                            @endforeach

                        </select>

                        @error('id_rapor')

                            <p class="mt-2 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>

            </div>


            {{-- NILAI --}}
            <div class="p-6 border-t border-slate-200 dark:border-slate-700">

                <div class="mb-6">

                    <h3 class="text-lg font-bold text-slate-800 dark:text-white">
                        Nilai Siswa
                    </h3>

                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                        Perbarui nilai. Nilai akhir dan predikat dihitung otomatis.
                    </p>

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- NILAI HARIAN --}}
                    <div>

                        <label for="nilai_harian"
                               class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2">

                            Nilai Harian
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="number"
                               id="nilai_harian"
                               name="nilai_harian"
                               value="{{ old('nilai_harian', $nilai->nilai_harian) }}"
                               required
                               min="0"
                               max="100"
                               step="0.01"
                               class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 px-4 py-3 text-sm text-slate-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-400">

                        <p class="text-xs text-slate-400 mt-2">
                            Bobot nilai: 30%
                        </p>

                        @error('nilai_harian')

                            <p class="mt-2 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- NILAI UTS --}}
                    <div>

                        <label for="nilai_uts"
                               class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2">

                            Nilai UTS
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="number"
                               id="nilai_uts"
                               name="nilai_uts"
                               value="{{ old('nilai_uts', $nilai->nilai_uts) }}"
                               required
                               min="0"
                               max="100"
                               step="0.01"
                               class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 px-4 py-3 text-sm text-slate-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-400">

                        <p class="text-xs text-slate-400 mt-2">
                            Bobot nilai: 30%
                        </p>

                        @error('nilai_uts')

                            <p class="mt-2 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- NILAI UAS --}}
                    <div>

                        <label for="nilai_uas"
                               class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2">

                            Nilai UAS
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="number"
                               id="nilai_uas"
                               name="nilai_uas"
                               value="{{ old('nilai_uas', $nilai->nilai_uas) }}"
                               required
                               min="0"
                               max="100"
                               step="0.01"
                               class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 px-4 py-3 text-sm text-slate-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-400">

                        <p class="text-xs text-slate-400 mt-2">
                            Bobot nilai: 40%
                        </p>

                        @error('nilai_uas')

                            <p class="mt-2 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- NILAI AKHIR --}}
                    <div>

                        <label for="nilai_akhir"
                               class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2">

                            Nilai Akhir

                        </label>

                        <input type="text"
                               id="nilai_akhir"
                               value="{{ old('nilai_akhir', $nilai->nilai_akhir) }}"
                               readonly
                               class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-100 dark:bg-slate-800 px-4 py-3 text-sm font-bold text-slate-800 dark:text-white focus:outline-none">

                        <p class="text-xs text-slate-400 mt-2">
                            Harian 30% + UTS 30% + UAS 40%
                        </p>

                    </div>


                    {{-- PREDIKAT --}}
                    <div>

                        <label for="predikat"
                               class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2">

                            Predikat

                        </label>

                        <input type="text"
                               id="predikat"
                               value="{{ old('predikat', $nilai->predikat) }}"
                               readonly
                               class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-100 dark:bg-slate-800 px-4 py-3 text-sm font-bold text-slate-800 dark:text-white focus:outline-none">

                        <p class="text-xs text-slate-400 mt-2">
                            A ≥ 90 · B ≥ 80 · C ≥ 70 · D &lt; 70
                        </p>

                    </div>

                </div>

            </div>


            {{-- BUTTON --}}
            <div class="px-6 py-5 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-700 flex flex-col sm:flex-row justify-end gap-3">

                <a href="{{ route('admin.nilai.index') }}"
                   class="inline-flex items-center justify-center px-6 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-200 text-sm font-semibold hover:bg-slate-50 dark:hover:bg-slate-800 transition">

                    Batal

                </a>

                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-slate-900 text-white text-sm font-semibold hover:bg-slate-700 transition">

                    ✓
                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>


    {{-- INFO --}}
    <div class="rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 px-5 py-4">

        <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">
            Informasi Penilaian
        </p>

        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
            Nilai akhir dihitung otomatis dengan bobot Harian 30%, UTS 30%, dan UAS 40%.
        </p>

    </div>


    {{-- FOOTER --}}
    <div class="text-center pt-2">

        <p class="text-xs text-slate-400">
            © {{ date('Y') }} Sistem Akademik Mini
        </p>

    </div>

</div>


{{-- JAVASCRIPT --}}
<script>

    function hitungNilai() {

        const harian =
            parseFloat(document.getElementById('nilai_harian').value) || 0;

        const uts =
            parseFloat(document.getElementById('nilai_uts').value) || 0;

        const uas =
            parseFloat(document.getElementById('nilai_uas').value) || 0;


        const nilaiAkhir =
            (harian * 0.30) +
            (uts * 0.30) +
            (uas * 0.40);


        document.getElementById('nilai_akhir').value =
            nilaiAkhir.toFixed(2);


        let predikat = '';


        if (nilaiAkhir >= 90) {

            predikat = 'A';

        } else if (nilaiAkhir >= 80) {

            predikat = 'B';

        } else if (nilaiAkhir >= 70) {

            predikat = 'C';

        } else {

            predikat = 'D';

        }


        document.getElementById('predikat').value = predikat;

    }


    document
        .getElementById('nilai_harian')
        .addEventListener('input', hitungNilai);


    document
        .getElementById('nilai_uts')
        .addEventListener('input', hitungNilai);


    document
        .getElementById('nilai_uas')
        .addEventListener('input', hitungNilai);


    hitungNilai();

</script>

@endsection