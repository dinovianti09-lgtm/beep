@extends('layouts.admin')

@section('title', 'Tambah Data Siswa - Sistem Akademik Mini')

@section('page-title', 'Tambah Data Siswa')

@section('page-subtitle', 'Data Siswa')

@section('content')

<div class="space-y-6">

{{-- PAGE HEADER --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <div class="flex items-center gap-3 mb-2">
            <div class="w-11 h-11 rounded-xl bg-blue-100 dark:bg-blue-500/10 flex items-center justify-center text-xl">
                👨‍🎓
            </div>
            <div>
                <h3 class="text-xl font-extrabold text-slate-900 dark:text-white">
                    Formulir Siswa
                </h3>
                <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">
                    Isi data berikut untuk menambahkan siswa baru.
                </p>
            </div>
        </div>
    </div>

    <a
        href="{{ route('admin.siswa.index') }}"
        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition text-sm font-bold"
    >
        ← Kembali
    </a>
</div>

{{-- VALIDATION ERROR --}}
@if ($errors->any())
    <div class="bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 rounded-2xl p-5">
        <div class="flex items-start gap-3">
            <div class="w-9 h-9 rounded-lg bg-red-100 dark:bg-red-500/20 flex items-center justify-center text-red-600 dark:text-red-400 font-bold">
                !
            </div>
            <div>
                <h4 class="text-sm font-bold text-red-700 dark:text-red-400">
                    Data belum bisa disimpan
                </h4>
                <ul class="mt-2 text-sm text-red-600 dark:text-red-400 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

{{-- FORM CARD --}}
<div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm max-w-3xl">

    <div class="px-7 py-6 border-b border-slate-100 dark:border-slate-800">
        <h3 class="text-lg font-extrabold text-slate-900 dark:text-white">
            Informasi Siswa
        </h3>
        <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">
            Masukkan informasi siswa dengan benar.
        </p>
    </div>

    <form
        action="{{ route('admin.siswa.store') }}"
        method="POST"
        class="p-7"
    >
        @csrf

        {{-- NIS --}}
        <div class="mb-5">
            <label for="nis" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                NIS <span class="text-red-500">*</span>
            </label>
            <input
                type="text"
                id="nis"
                name="nis"
                value="{{ old('nis') }}"
                placeholder="Masukkan NIS siswa"
                maxlength="20"
                required
                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-700 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 transition"
            >
            @error('nis')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- NAMA SISWA --}}
        <div class="mb-5">
            <label for="nama_siswa" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                Nama Siswa <span class="text-red-500">*</span>
            </label>
            <input
                type="text"
                id="nama_siswa"
                name="nama_siswa"
                value="{{ old('nama_siswa') }}"
                placeholder="Masukkan nama lengkap siswa"
                maxlength="255"
                required
                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-700 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 transition"
            >
            @error('nama_siswa')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- KELAS: DIAMBIL DARI DATA KELAS --}}
        <div class="mb-5">
            <label for="kelas" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                Kelas <span class="text-red-500">*</span>
            </label>

            <select
                id="kelas"
                name="kelas"
                required
                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-700 dark:text-slate-200 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 transition"
            >
                <option value="">-- Pilih Kelas --</option>

                @forelse ($kelasList as $kelas)
                    <option
                        value="{{ $kelas->nama_kelas }}"
                        {{ old('kelas') == $kelas->nama_kelas ? 'selected' : '' }}
                    >
                        {{ $kelas->nama_kelas }}
                    </option>
                @empty
                    <option value="" disabled>
                        Belum ada kelas terdaftar di Data Kelas
                    </option>
                @endforelse
            </select>

            @error('kelas')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror

            <p class="text-xs text-slate-400 dark:text-slate-500 mt-2">
                Pilih kelas yang sudah terdaftar pada menu Data Kelas.
            </p>
        </div>

        {{-- JENIS KELAMIN --}}
        <div class="mb-7">
            <label for="jenis_kelamin" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                Jenis Kelamin <span class="text-red-500">*</span>
            </label>

            <select
                id="jenis_kelamin"
                name="jenis_kelamin"
                required
                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-700 dark:text-slate-200 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 transition"
            >
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                    Laki-laki
                </option>
                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                    Perempuan
                </option>
            </select>

            @error('jenis_kelamin')
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
                Simpan Data
            </button>

            <a
                href="{{ route('admin.siswa.index') }}"
                class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition text-sm font-bold"
            >
                Batal
            </a>
        </div>
    </form>
</div>

<p class="text-center text-xs text-slate-400 dark:text-slate-500 pt-2">
    © {{ date('Y') }} Sistem Akademik Mini
</p>


</div>

@endsection
