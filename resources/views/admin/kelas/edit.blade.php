
@extends('layouts.admin')

@section('title', 'Edit Data Kelas - Sistem Akademik Mini')

@section('page-title', 'Edit Data Kelas')

@section('page-subtitle', 'Perbarui informasi data kelas.')

@section('content')

<div class="max-w-4xl">

    {{-- HEADER --}}
    <div class="flex items-center gap-4 mb-8">
        <div class="w-12 h-12 rounded-2xl bg-blue-100 dark:bg-blue-500/10 flex items-center justify-center">
            <span class="text-2xl">✏️</span>
        </div>

        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-slate-100">
                Edit Data Kelas
            </h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Perbarui informasi kelas dan wali kelas.
            </p>
        </div>
    </div>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="mb-6 px-5 py-4 rounded-2xl bg-red-50 dark:bg-red-500/10 border border-red-100 dark:border-red-500/20 text-red-700 dark:text-red-400">
            <div class="flex gap-3">
                <div class="w-9 h-9 rounded-full bg-red-100 dark:bg-red-500/20 flex items-center justify-center shrink-0">
                    !
                </div>

                <div>
                    <p class="font-semibold text-sm mb-2">
                        Data belum bisa diperbarui
                    </p>

                    <ul class="text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- FORM CARD --}}
    <div class="bg-white dark:bg-slate-900 rounded-[1.5rem] border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-900/5 overflow-hidden">

        {{-- CARD HEADER --}}
        <div class="px-8 py-6 border-b border-slate-100 dark:border-slate-800 bg-gradient-to-r from-blue-50/70 to-indigo-50/70 dark:from-blue-500/5 dark:to-indigo-500/5">
            <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100">
                Informasi Kelas
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Periksa kembali data sebelum menyimpan perubahan.
            </p>
        </div>

        <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="p-8 space-y-6">

                {{-- TINGKAT + JURUSAN --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- TINGKAT --}}
                    <div>
                        <label for="tingkat" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                            Tingkat <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="tingkat"
                            name="tingkat"
                            required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-500/10 focus:border-blue-500"
                        >
                            <option value="">-- Pilih Tingkat --</option>
                            <option value="X" {{ old('tingkat', $kelas->tingkat) == 'X' ? 'selected' : '' }}>X (Kelas 10)</option>
                            <option value="XI" {{ old('tingkat', $kelas->tingkat) == 'XI' ? 'selected' : '' }}>XI (Kelas 11)</option>
                            <option value="XII" {{ old('tingkat', $kelas->tingkat) == 'XII' ? 'selected' : '' }}>XII (Kelas 12)</option>
                        </select>

                        @error('tingkat')
                            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- JURUSAN --}}
                    <div>
                        <label for="jurusan" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                            Jurusan <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="jurusan"
                            name="jurusan"
                            required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-500/10 focus:border-blue-500"
                        >
                            <option value="">-- Pilih Jurusan --</option>
                            <option value="RPL" {{ old('jurusan', $kelas->jurusan) == 'RPL' ? 'selected' : '' }}>RPL</option>
                            <option value="DKV" {{ old('jurusan', $kelas->jurusan) == 'DKV' ? 'selected' : '' }}>DKV</option>
                            <option value="BR" {{ old('jurusan', $kelas->jurusan) == 'BR' ? 'selected' : '' }}>BR</option>
                        </select>

                        @error('jurusan')
                            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- NOMOR KELAS --}}
                <div>
                    <label for="nomor_kelas" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        Nomor Kelas <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="nomor_kelas"
                        name="nomor_kelas"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-500/10 focus:border-blue-500"
                    >
                        <option value="">-- Pilih Nomor Kelas --</option>

                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{ (string) old('nomor_kelas', $nomorKelas ?? '') === (string) $i ? 'selected' : '' }}>
                                Kelas {{ $i }}
                            </option>
                        @endfor
                    </select>

                    @error('nomor_kelas')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- PREVIEW --}}
                <div class="rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 border border-indigo-100 dark:border-indigo-500/20 p-5">
                    <p class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 mb-2">
                        Nama Kelas
                    </p>

                    <p id="preview-kelas" class="text-2xl font-extrabold text-indigo-800 dark:text-indigo-300">
                        {{ $kelas->nama_kelas }}
                    </p>
                </div>

                {{-- WALI KELAS --}}
                <div>
                    <label for="wali_kelas" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        Wali Kelas
                    </label>

                    <select
                        id="wali_kelas"
                        name="wali_kelas"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-500/10 focus:border-blue-500"
                    >
                        <option value="">-- Belum ada wali kelas --</option>

                        @foreach ($guruList as $guru)
                            @php
                                $kelasDipakai = $guru->kelas_wali_dipakai;
                                $sudahDipakai = $kelasDipakai !== null;
                                $waliKelasSaatIni = old('wali_kelas', $kelas->wali_kelas);
                                $terpilih = $waliKelasSaatIni == $guru->nama_guru;
                            @endphp

                            <option
                                value="{{ $guru->nama_guru }}"
                                {{ $terpilih ? 'selected' : '' }}
                                {{ $sudahDipakai && !$terpilih ? 'disabled' : '' }}
                            >
                                {{ $guru->nama_guru }}

                                @if ($sudahDipakai)
                                    — Sudah menjadi wali kelas {{ $kelasDipakai->nama_kelas }}
                                @elseif ($terpilih)
                                    — Wali kelas saat ini
                                @else
                                    — Belum menjadi wali kelas
                                @endif
                            </option>
                        @endforeach
                    </select>

                    <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                        Guru yang sudah menjadi wali kelas di kelas lain tidak dapat dipilih. Wali kelas saat ini tetap bisa dipertahankan.
                    </p>

                    @error('wali_kelas')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row gap-3">

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold shadow-lg shadow-blue-900/10 hover:-translate-y-1 transition"
                    >
                        <span>✓</span>
                        Simpan Perubahan
                    </button>

                    <a
                        href="{{ route('admin.kelas.index') }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-sm font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 hover:-translate-y-0.5 transition"
                    >
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
            <p class="text-sm font-semibold text-blue-800 dark:text-blue-300">
                Informasi
            </p>
            <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">
                Nama kelas akan mengikuti tingkat, jurusan, dan nomor kelas yang dipilih.
            </p>
        </div>
    </div>

    {{-- FOOTER --}}
    <div class="mt-8 text-center">
        <p class="text-xs text-slate-400">
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
