
@extends('layouts.admin')

@section('title', 'Edit Mata Pelajaran - Sistem Akademik')

@section('page-title', 'Edit Mata Pelajaran')

@section('page-subtitle', 'Perbarui informasi mata pelajaran')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-extrabold text-slate-800 dark:text-white">
            Edit Mata Pelajaran
        </h2>

        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
            Perbarui nama, KKM, jurusan, dan tingkat kelas mata pelajaran.
        </p>
    </div>

    {{-- ERROR --}}
    @if($errors->any())
        <div class="p-4 rounded-xl bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-red-700 dark:text-red-400">
            <p class="text-sm font-bold mb-2">
                Terjadi kesalahan:
            </p>

            <ul class="list-disc ml-5 space-y-1 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM CARD --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm max-w-3xl overflow-hidden">

        {{-- CARD HEADER --}}
        <div class="px-6 py-5 border-b border-slate-200 dark:border-slate-700">
            <h3 class="font-extrabold text-slate-800 dark:text-white">
                Informasi Mata Pelajaran
            </h3>

            <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">
                Ubah informasi mata pelajaran yang diperlukan.
            </p>
        </div>

        {{-- FORM --}}
        <form
            action="{{ route('admin.mapel.update', $mapel->id_mapel) }}"
            method="POST"
            class="p-6"
        >
            @csrf
            @method('PUT')

            {{-- NAMA MAPEL --}}
            <div class="mb-5">
                <label
                    for="nama_mapel"
                    class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2"
                >
                    Nama Mata Pelajaran
                    <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    id="nama_mapel"
                    name="nama_mapel"
                    value="{{ old('nama_mapel', $mapel->nama_mapel) }}"
                    placeholder="Contoh: Pemrograman Web"
                    maxlength="100"
                    required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-700 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 transition"
                >

                @error('nama_mapel')
                    <p class="text-xs text-red-500 mt-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- KKM --}}
            <div class="mb-7">
                <label
                    for="kkm"
                    class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2"
                >
                    KKM
                    <span class="text-red-500">*</span>
                </label>

                <input
                    type="number"
                    id="kkm"
                    name="kkm"
                    value="{{ old('kkm', $mapel->kkm) }}"
                    min="0"
                    max="100"
                    required
                    placeholder="Contoh: 75"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-700 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 transition"
                >

                @error('kkm')
                    <p class="text-xs text-red-500 mt-2">
                        {{ $message }}
                    </p>
                @enderror

                <p class="text-xs text-slate-400 dark:text-slate-500 mt-2">
                    Masukkan nilai KKM antara 0 sampai 100.
                </p>
            </div>

            {{-- JURUSAN --}}
            <div class="mb-7">
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2">
                    Jurusan
                    <span class="text-red-500">*</span>
                </label>

                <p class="text-xs text-slate-400 dark:text-slate-500 mb-3">
                    Pilih semua jurusan yang menggunakan mata pelajaran ini.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    @foreach($jurusanList as $jurusan)
                        <label class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 hover:border-blue-400 transition cursor-pointer">
                            <input
                                type="checkbox"
                                name="jurusan[]"
                                value="{{ $jurusan }}"
                                {{ in_array($jurusan, old('jurusan', $jurusanTerpilih)) ? 'checked' : '' }}
                                class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                            >

                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">
                                {{ $jurusan }}
                            </span>
                        </label>
                    @endforeach
                </div>

                @error('jurusan')
                    <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                @enderror

                @error('jurusan.*')
                    <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- TINGKAT KELAS --}}
            <div class="mb-7">
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2">
                    Tingkat Kelas
                    <span class="text-red-500">*</span>
                </label>

                <p class="text-xs text-slate-400 dark:text-slate-500 mb-3">
                    Pilih semua tingkat kelas yang menggunakan mata pelajaran ini.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    @foreach($tingkatList as $tingkat)
                        <label class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 hover:border-blue-400 transition cursor-pointer">
                            <input
                                type="checkbox"
                                name="tingkat[]"
                                value="{{ $tingkat }}"
                                {{ in_array($tingkat, old('tingkat', $tingkatTerpilih)) ? 'checked' : '' }}
                                class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                            >

                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Kelas {{ $tingkat }}
                            </span>
                        </label>
                    @endforeach
                </div>

                @error('tingkat')
                    <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                @enderror

                @error('tingkat.*')
                    <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- BUTTON --}}
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-bold shadow-lg shadow-blue-900/10 hover:shadow-xl hover:-translate-y-0.5 transition"
                >
                    <span>✓</span>
                    Simpan Perubahan
                </button>

                <a
                    href="{{ route('admin.mapel.index') }}"
                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-200 hover:bg-slate-200 dark:hover:bg-slate-700 transition text-sm font-bold"
                >
                    Batal
                </a>
            </div>

        </form>
    </div>

    {{-- INFO --}}
    <div class="max-w-3xl bg-blue-50 dark:bg-blue-500/10 border border-blue-100 dark:border-blue-500/20 rounded-2xl p-5">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-500/20 flex items-center justify-center flex-shrink-0">
                <span>ℹ️</span>
            </div>

            <div>
                <h3 class="text-sm font-bold text-blue-900 dark:text-blue-300 mb-1">
                    Informasi
                </h3>

                <p class="text-xs text-blue-700 dark:text-blue-400 leading-relaxed">
                    Perubahan jurusan dan tingkat kelas akan memperbarui pengaturan mata pelajaran yang sama, bukan membuat mata pelajaran baru. Data nilai yang sudah ada tidak dihapus oleh perubahan pengaturan ini.
                </p>
            </div>
        </div>
    </div>

    {{-- FOOTER --}}
    <p class="text-center text-xs text-slate-400 dark:text-slate-500 mt-8">
        © {{ date('Y') }} Sistem Akademik Mini
    </p>

</div>

@endsection
