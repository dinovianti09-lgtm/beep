
@extends('layouts.admin')

@section('title', 'Tambah Mata Pelajaran - Sistem Akademik Mini')

@section('page-title', 'Tambah Mata Pelajaran')

@section('page-subtitle', 'Mata Pelajaran')

@section('content')

<div class="space-y-6">

    {{-- PAGE HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="w-11 h-11 rounded-xl bg-blue-100 dark:bg-blue-500/10 flex items-center justify-center">
                    <span class="text-xl">📚</span>
                </div>

                <div>
                    <h3 class="text-xl font-extrabold text-slate-900 dark:text-white">
                        Tambah Mata Pelajaran
                    </h3>

                    <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">
                        Isi informasi mata pelajaran, jurusan, dan tingkat kelas.
                    </p>
                </div>
            </div>
        </div>

        {{-- KEMBALI --}}
        <a
            href="{{ route('admin.mapel.index') }}"
            class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition text-sm font-bold"
        >
            ← Kembali
        </a>
    </div>

    {{-- ERROR --}}
    @if($errors->any())
        <div class="max-w-3xl px-5 py-4 rounded-2xl bg-red-50 dark:bg-red-500/10 border border-red-100 dark:border-red-500/20 text-red-700 dark:text-red-400">
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-full bg-red-100 dark:bg-red-500/20 flex items-center justify-center flex-shrink-0 font-bold">
                    !
                </div>

                <div>
                    <p class="font-semibold text-sm mb-2">
                        Terdapat kesalahan:
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
    <div class="max-w-3xl">
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm">

            {{-- CARD HEADER --}}
            <div class="px-7 py-6 border-b border-slate-100 dark:border-slate-800">
                <h3 class="text-lg font-extrabold text-slate-900 dark:text-white">
                    Informasi Mata Pelajaran
                </h3>

                <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">
                    Masukkan data mata pelajaran dengan benar.
                </p>
            </div>

            {{-- FORM --}}
            <form
                action="{{ route('admin.mapel.store') }}"
                method="POST"
                class="p-7 space-y-6"
            >
                @csrf

                {{-- NAMA MAPEL --}}
                <div>
                    <label
                        for="nama_mapel"
                        class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2"
                    >
                        Nama Mata Pelajaran
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="nama_mapel"
                        name="nama_mapel"
                        value="{{ old('nama_mapel') }}"
                        required
                        maxlength="100"
                        placeholder="Contoh: Matematika"
                        class="w-full px-4 py-3.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-800 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 transition"
                    >

                    @error('nama_mapel')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror

                    <p class="mt-2 text-xs text-slate-400 dark:text-slate-500">
                        Masukkan nama mata pelajaran secara lengkap.
                    </p>
                </div>

                {{-- KKM --}}
                <div>
                    <label
                        for="kkm"
                        class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2"
                    >
                        KKM
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="number"
                        id="kkm"
                        name="kkm"
                        value="{{ old('kkm', 75) }}"
                        required
                        min="0"
                        max="100"
                        placeholder="75"
                        class="w-full px-4 py-3.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-800 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 transition"
                    >

                    @error('kkm')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror

                    <p class="mt-2 text-xs text-slate-400 dark:text-slate-500">
                        Masukkan nilai KKM antara 0 sampai 100.
                    </p>
                </div>

                {{-- PILIH JURUSAN --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                        Jurusan
                        <span class="text-red-500">*</span>
                    </label>

                    <p class="text-xs text-slate-400 dark:text-slate-500 mb-3">
                        Pilih satu atau beberapa jurusan yang menggunakan mata pelajaran ini.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        @foreach($jurusanList as $jurusan)
                            <label class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 hover:border-blue-400 transition cursor-pointer">
                                <input
                                    type="checkbox"
                                    name="jurusan[]"
                                    value="{{ $jurusan }}"
                                    {{ in_array($jurusan, old('jurusan', [])) ? 'checked' : '' }}
                                    class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                                >

                                <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    {{ $jurusan }}
                                </span>
                            </label>
                        @endforeach
                    </div>

                    @error('jurusan')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror

                    @error('jurusan.*')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- PILIH TINGKAT --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                        Tingkat Kelas
                        <span class="text-red-500">*</span>
                    </label>

                    <p class="text-xs text-slate-400 dark:text-slate-500 mb-3">
                        Pilih tingkat kelas yang menggunakan mata pelajaran ini.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        @foreach($tingkatList as $tingkat)
                            <label class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 hover:border-blue-400 transition cursor-pointer">
                                <input
                                    type="checkbox"
                                    name="tingkat[]"
                                    value="{{ $tingkat }}"
                                    {{ in_array($tingkat, old('tingkat', [])) ? 'checked' : '' }}
                                    class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                                >

                                <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    Kelas {{ $tingkat }}
                                </span>
                            </label>
                        @endforeach
                    </div>

                    @error('tingkat')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror

                    @error('tingkat.*')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <div class="pt-2 flex flex-col sm:flex-row gap-3">
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-bold shadow-lg shadow-blue-900/10 hover:shadow-xl hover:-translate-y-0.5 transition"
                    >
                        <span>✓</span>
                        Simpan Mata Pelajaran
                    </button>

                    <a
                        href="{{ route('admin.mapel.index') }}"
                        class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition text-sm font-bold"
                    >
                        Batal
                    </a>
                </div>

            </form>
        </div>

        {{-- INFO CARD --}}
        <div class="mt-6 bg-blue-50 dark:bg-blue-500/10 border border-blue-100 dark:border-blue-500/20 rounded-2xl p-5">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-500/20 flex items-center justify-center flex-shrink-0">
                    <span>ℹ️</span>
                </div>

                <div>
                    <h3 class="text-sm font-bold text-blue-900 dark:text-blue-300 mb-1">
                        Informasi
                    </h3>

                    <p class="text-xs text-blue-700 dark:text-blue-400 leading-relaxed">
                        Mata pelajaran disimpan satu kali. Jurusan dan tingkat kelas yang dipilih akan menjadi pengaturan penggunaan mata pelajaran tersebut.
                    </p>
                </div>
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

@endsection
