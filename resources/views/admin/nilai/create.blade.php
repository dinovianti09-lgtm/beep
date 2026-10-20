@extends('layouts.admin')

@section('title', 'Tambah Nilai - Sistem Akademik')

@section('page-title', 'Tambah Nilai')

@section('page-subtitle', 'Tambahkan data nilai akademik siswa')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center">
                    <span class="text-xl">📊</span>
                </div>

                <div>
                    <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">
                        Tambah Nilai
                    </h2>

                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                        Tambahkan data nilai akademik siswa.
                    </p>
                </div>
            </div>
        </div>

        <a
            href="{{ route('admin.nilai.index') }}"
            class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-sm font-semibold shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700 hover:-translate-y-0.5 transition"
        >
            ← Kembali
        </a>
    </div>


    {{-- ERROR --}}
    @if($errors->any())
        <div class="px-5 py-4 rounded-2xl bg-red-50 dark:bg-red-950/30 border border-red-100 dark:border-red-900">
            <div class="flex gap-3">
                <div class="w-9 h-9 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center text-red-600 dark:text-red-300 font-bold shrink-0">
                    !
                </div>

                <div>
                    <p class="font-semibold text-sm text-red-700 dark:text-red-300 mb-2">
                        Data belum bisa disimpan
                    </p>

                    <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif


    {{-- FORM CARD --}}
    <div class="bg-white dark:bg-slate-800 rounded-[1.5rem] border border-slate-200 dark:border-slate-700 shadow-xl shadow-slate-900/5 overflow-hidden">

        {{-- CARD HEADER --}}
        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-700 bg-gradient-to-r from-blue-50/70 to-indigo-50/70 dark:from-slate-800 dark:to-slate-800">
            <h3 class="font-bold text-slate-800 dark:text-white">
                Form Tambah Nilai
            </h3>

            <p class="text-xs text-slate-400 mt-1">
                Lengkapi data siswa dan nilai akademik.
            </p>
        </div>


        <form
            action="{{ route('admin.nilai.store') }}"
            method="POST"
        >
            @csrf

            {{-- DATA AKADEMIK --}}
            <div class="p-6 sm:p-8">

                <div class="flex items-start gap-3 mb-6">
                    <div class="w-9 h-9 rounded-lg bg-blue-100 flex items-center justify-center shrink-0">
                        📚
                    </div>

                    <div>
                        <h3 class="font-bold text-slate-800 dark:text-white">
                            Data Akademik
                        </h3>

                        <p class="text-xs text-slate-400 mt-1">
                            Pilih siswa, mata pelajaran, semester, dan periode rapor.
                        </p>
                    </div>
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- SISWA --}}
                    <div>
                        <label
                            for="id_siswa"
                            class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2"
                        >
                            Siswa <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="id_siswa"
                            name="id_siswa"
                            required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 text-sm text-slate-800 dark:text-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500"
                        >
                            <option value="">Pilih Siswa</option>

                            @foreach($siswaList as $siswa)
                                <option
                                    value="{{ $siswa->id_siswa }}"
                                    {{ old('id_siswa') == $siswa->id_siswa ? 'selected' : '' }}
                                >
                                    {{ $siswa->nama_siswa }}
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
                        <label
                            for="id_mapel"
                            class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2"
                        >
                            Mata Pelajaran <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="id_mapel"
                            name="id_mapel"
                            required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 text-sm text-slate-800 dark:text-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500"
                        >
                            <option value="">Pilih Mata Pelajaran</option>

                            @foreach($mapelList as $mapel)
                                <option
                                    value="{{ $mapel->id_mapel }}"
                                    {{ old('id_mapel') == $mapel->id_mapel ? 'selected' : '' }}
                                >
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
                        <label
                            for="semester"
                            class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2"
                        >
                            Semester <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="semester"
                            name="semester"
                            required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 text-sm text-slate-800 dark:text-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500"
                        >
                            <option value="">Pilih Semester</option>

                            <option
                                value="1"
                                {{ old('semester') == '1' ? 'selected' : '' }}
                            >
                                Ganjil
                            </option>

                            <option
                                value="2"
                                {{ old('semester') == '2' ? 'selected' : '' }}
                            >
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
                        <label
                            for="id_rapor"
                            class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2"
                        >
                            Periode Rapor <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="id_rapor"
                            name="id_rapor"
                            required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 text-sm text-slate-800 dark:text-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500"
                        >
                            <option value="">Pilih Periode Rapor</option>

                            @foreach($raporList as $rapor)
                                <option
                                    value="{{ $rapor->id_rapor }}"
                                    {{ old('id_rapor') == $rapor->id_rapor ? 'selected' : '' }}
                                >
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
            <div class="px-6 sm:px-8 pb-8">

                <div class="border-t border-slate-100 dark:border-slate-700 pt-8">

                    <div class="flex items-start gap-3 mb-6">
                        <div class="w-9 h-9 rounded-lg bg-indigo-100 flex items-center justify-center shrink-0">
                            📝
                        </div>

                        <div>
                            <h3 class="font-bold text-slate-800 dark:text-white">
                                Nilai Siswa
                            </h3>

                            <p class="text-xs text-slate-400 mt-1">
                                Masukkan nilai. Nilai akhir dan predikat dihitung otomatis.
                            </p>
                        </div>
                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- NILAI HARIAN --}}
                        <div>
                            <label
                                for="nilai_harian"
                                class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2"
                            >
                                Nilai Harian <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="number"
                                id="nilai_harian"
                                name="nilai_harian"
                                value="{{ old('nilai_harian') }}"
                                min="0"
                                max="100"
                                step="0.01"
                                required
                                placeholder="Masukkan nilai harian"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 text-sm text-slate-800 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500"
                            >

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
                            <label
                                for="nilai_uts"
                                class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2"
                            >
                                Nilai UTS <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="number"
                                id="nilai_uts"
                                name="nilai_uts"
                                value="{{ old('nilai_uts') }}"
                                min="0"
                                max="100"
                                step="0.01"
                                required
                                placeholder="Masukkan nilai UTS"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 text-sm text-slate-800 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500"
                            >

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
                            <label
                                for="nilai_uas"
                                class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2"
                            >
                                Nilai UAS <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="number"
                                id="nilai_uas"
                                name="nilai_uas"
                                value="{{ old('nilai_uas') }}"
                                min="0"
                                max="100"
                                step="0.01"
                                required
                                placeholder="Masukkan nilai UAS"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 text-sm text-slate-800 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500"
                            >

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
                            <label
                                for="nilai_akhir"
                                class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2"
                            >
                                Nilai Akhir
                            </label>

                            <input
                                type="text"
                                id="nilai_akhir"
                                name="nilai_akhir"
                                value="{{ old('nilai_akhir') }}"
                                readonly
                                placeholder="Otomatis"
                                class="w-full px-4 py-3 rounded-xl border border-blue-100 dark:border-blue-900 bg-blue-50 dark:bg-blue-950/40 text-sm font-bold text-blue-700 dark:text-blue-300 focus:outline-none"
                            >

                            <p class="text-xs text-slate-400 mt-2">
                                Harian 30% + UTS 30% + UAS 40%
                            </p>
                        </div>


                        {{-- PREDIKAT --}}
                        <div>
                            <label
                                for="predikat"
                                class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2"
                            >
                                Predikat
                            </label>

                            <input
                                type="text"
                                id="predikat"
                                name="predikat"
                                value="{{ old('predikat') }}"
                                readonly
                                placeholder="Otomatis"
                                class="w-full px-4 py-3 rounded-xl border border-indigo-100 dark:border-indigo-900 bg-indigo-50 dark:bg-indigo-950/40 text-sm font-bold text-indigo-700 dark:text-indigo-300 focus:outline-none"
                            >

                            <p class="text-xs text-slate-400 mt-2">
                                A ≥ 90 · B ≥ 80 · C ≥ 70 · D &lt; 70
                            </p>
                        </div>

                    </div>
                </div>
            </div>


            {{-- BUTTON --}}
            <div class="px-6 sm:px-8 py-5 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-700 flex flex-col sm:flex-row justify-end gap-3">

                <a
                    href="{{ route('admin.nilai.index') }}"
                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-sm font-semibold hover:bg-slate-100 dark:hover:bg-slate-700 transition"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold shadow-lg shadow-blue-900/10 hover:-translate-y-1 transition"
                >
                    <span>✓</span>
                    Simpan Nilai
                </button>

            </div>

        </form>
    </div>


    {{-- INFO --}}
    <div class="flex gap-3 px-5 py-4 rounded-2xl bg-blue-50 dark:bg-blue-950/30 border border-blue-100 dark:border-blue-900">

        <div class="text-blue-600 dark:text-blue-400 text-lg">
            💡
        </div>

        <div>
            <p class="text-sm font-semibold text-blue-800 dark:text-blue-300">
                Informasi Penilaian
            </p>

            <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">
                Nilai akhir dihitung otomatis dengan bobot Harian 30%, UTS 30%, dan UAS 40%.
            </p>
        </div>

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