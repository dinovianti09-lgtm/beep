
@extends('layouts.admin')

@section('title', 'Tambah Kelas - Sistem Akademik Mini')

@section('page-title', 'Tambah Kelas')

@section('page-subtitle', 'Data Kelas')

@section('content')

<div class="space-y-6">

    {{-- PAGE HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="w-11 h-11 rounded-xl bg-blue-100 dark:bg-blue-500/10 flex items-center justify-center">
                    <span class="text-xl">🏫</span>
                </div>

                <div>
                    <h3 class="text-xl font-extrabold text-slate-900 dark:text-white">
                        Tambah Kelas Baru
                    </h3>
                    <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">
                        Buat data kelas berdasarkan tingkat dan jurusan.
                    </p>
                </div>
            </div>
        </div>

        <a href="{{ route('admin.kelas.index') }}"
            class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition text-sm font-bold">
            ← Kembali
        </a>
    </div>

    {{-- ERROR --}}
    @if($errors->any())
        <div class="max-w-4xl px-5 py-4 rounded-2xl bg-red-50 dark:bg-red-500/10 border border-red-100 dark:border-red-500/20 text-red-700 dark:text-red-400">
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-full bg-red-100 dark:bg-red-500/20 flex items-center justify-center flex-shrink-0 font-bold">
                    !
                </div>

                <div>
                    <p class="font-semibold text-sm mb-2">
                        Data belum bisa disimpan
                    </p>

                    <ul class="text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- FORM --}}
    <div class="max-w-4xl">
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">

            {{-- CARD HEADER --}}
            <div class="px-7 py-6 border-b border-slate-100 dark:border-slate-800">
                <h3 class="text-lg font-extrabold text-slate-900 dark:text-white">
                    Informasi Kelas
                </h3>

                <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">
                    Pilih tingkat, jurusan, dan nomor kelas.
                </p>
            </div>

            {{-- FORM --}}
            <form action="{{ route('admin.kelas.store') }}" method="POST">
                @csrf

                <div class="p-7 space-y-6">

                    {{-- TINGKAT + JURUSAN --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- TINGKAT --}}
                        <div>
                            <label for="tingkat" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                Tingkat <span class="text-red-500">*</span>
                            </label>

                            <select id="tingkat" name="tingkat" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 transition">

                                <option value="">-- Pilih Tingkat --</option>
                                <option value="X" {{ old('tingkat') == 'X' ? 'selected' : '' }}>X (Kelas 10)</option>
                                <option value="XI" {{ old('tingkat') == 'XI' ? 'selected' : '' }}>XI (Kelas 11)</option>
                                <option value="XII" {{ old('tingkat') == 'XII' ? 'selected' : '' }}>XII (Kelas 12)</option>
                            </select>

                            @error('tingkat')
                                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- JURUSAN --}}
                        <div>
                            <label for="jurusan" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                Jurusan <span class="text-red-500">*</span>
                            </label>

                            <select id="jurusan" name="jurusan" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 transition">

                                <option value="">-- Pilih Jurusan --</option>
                                <option value="RPL" {{ old('jurusan') == 'RPL' ? 'selected' : '' }}>RPL</option>
                                <option value="DKV" {{ old('jurusan') == 'DKV' ? 'selected' : '' }}>DKV</option>
                                <option value="BR" {{ old('jurusan') == 'BR' ? 'selected' : '' }}>BR</option>
                            </select>

                            @error('jurusan')
                                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- NOMOR KELAS --}}
                    <div>
                        <label for="nomor_kelas" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                            Nomor Kelas <span class="text-red-500">*</span>
                        </label>

                        <select id="nomor_kelas" name="nomor_kelas" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 transition">

                            <option value="">-- Pilih Nomor Kelas --</option>

                            @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ (string) old('nomor_kelas') === (string) $i ? 'selected' : '' }}>
                                    Kelas {{ $i }}
                                </option>
                            @endfor
                        </select>

                        @error('nomor_kelas')
                            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- PREVIEW NAMA KELAS --}}
                    <div class="rounded-2xl bg-blue-50 dark:bg-blue-500/10 border border-blue-100 dark:border-blue-500/20 p-5">
                        <p class="text-xs font-bold text-blue-600 dark:text-blue-400 mb-2">
                            Nama Kelas Otomatis
                        </p>

                        <p id="preview-kelas" class="text-2xl font-extrabold text-blue-800 dark:text-blue-300">
                            Pilih tingkat, jurusan, dan nomor kelas
                        </p>
                    </div>

                    {{-- WALI KELAS --}}
                    <div>
                        <label for="wali_kelas" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                            Wali Kelas
                        </label>

                        <select id="wali_kelas" name="wali_kelas"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 transition">

                            <option value="">-- Belum ada wali kelas --</option>

                            @foreach($guruList as $guru)
                                @php
                                    $kelasDipakai = $guru->kelas_wali_dipakai;
                                    $sudahDipakai = $kelasDipakai !== null;
                                @endphp

                                <option
                                    value="{{ $guru->nama_guru }}"
                                    {{ old('wali_kelas') == $guru->nama_guru ? 'selected' : '' }}
                                    {{ $sudahDipakai ? 'disabled' : '' }}>

                                    {{ $guru->nama_guru }}

                                    @if($sudahDipakai)
                                        — Sudah menjadi wali kelas {{ $kelasDipakai->nama_kelas }}
                                    @else
                                        — Belum menjadi wali kelas
                                    @endif
                                </option>
                            @endforeach
                        </select>

                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                            Guru yang sudah menjadi wali kelas di kelas lain tidak dapat dipilih kembali.
                        </p>

                        @error('wali_kelas')
                            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ACTIONS --}}
                    <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row gap-3">

                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-bold shadow-lg shadow-blue-900/10 hover:shadow-xl hover:-translate-y-0.5 transition">
                            <span>✓</span>
                            Simpan Kelas
                        </button>

                        <a href="{{ route('admin.kelas.index') }}"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition text-sm font-bold">
                            ← Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>

        {{-- INFO --}}
        <div class="mt-5 flex gap-3 px-5 py-4 rounded-2xl bg-blue-50 dark:bg-blue-500/10 border border-blue-100 dark:border-blue-500/20">
            <div class="text-blue-600 dark:text-blue-400 text-lg">💡</div>

            <div>
                <p class="text-sm font-bold text-blue-800 dark:text-blue-300">
                    Informasi
                </p>

                <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">
                    Nama kelas akan dibuat otomatis berdasarkan tingkat, jurusan, dan nomor kelas.
                </p>
            </div>
        </div>
    </div>

    {{-- FOOTER --}}
    <div class="pt-4 text-center">
        <p class="text-xs text-slate-400 dark:text-slate-500">
            © {{ date('Y') }} Sistem Akademik Mini
        </p>
    </div>

</div>

{{-- PREVIEW NAMA KELAS --}}
<script>
    const tingkat = document.getElementById('tingkat');
    const jurusan = document.getElementById('jurusan');
    const nomorKelas = document.getElementById('nomor_kelas');
    const preview = document.getElementById('preview-kelas');

    function updatePreview() {
        const t = tingkat.value;
        const j = jurusan.value;
        const n = nomorKelas.value;

        if (t && j && n) {
            preview.textContent = t + ' ' + j + ' ' + n;
        } else {
            preview.textContent = 'Pilih tingkat, jurusan, dan nomor kelas';
        }
    }

    tingkat.addEventListener('change', updatePreview);
    jurusan.addEventListener('change', updatePreview);
    nomorKelas.addEventListener('change', updatePreview);

    updatePreview();
</script>

@endsection
