@extends('layouts.admin')

@section('title', 'Tambah Data Guru - Sistem Akademik Mini')

@section('page-title', 'Tambah Data Guru')

@section('page-subtitle', 'Data Guru')

@section('content')

<div class="mb-7">
    <div class="flex items-center gap-3 mb-2">
        <div class="w-11 h-11 rounded-xl bg-blue-100 dark:bg-blue-500/10 flex items-center justify-center">
            <span class="text-xl">👨‍🏫</span>
        </div>

        <div>
            <h1 class="text-2xl font-extrabold main-title">
                Tambah Informasi Guru
            </h1>
            <p class="text-sm main-subtitle mt-1">
                Isi formulir di bawah untuk menambahkan guru baru.
            </p>
        </div>
    </div>
</div>

{{-- ERROR --}}
@if ($errors->any())
    <div class="mb-6 px-5 py-4 rounded-2xl bg-red-50 dark:bg-red-500/10 border border-red-100 dark:border-red-500/20 text-red-700 dark:text-red-400">
        <div class="flex items-start gap-3">
            <div class="w-9 h-9 rounded-lg bg-red-100 dark:bg-red-500/20 flex items-center justify-center shrink-0">
                !
            </div>

            <div>
                <p class="font-semibold text-sm mb-2">
                    Terjadi kesalahan
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
<div class="dashboard-card rounded-[1.5rem] border shadow-xl shadow-slate-900/5 overflow-hidden max-w-3xl transition-smooth">

    {{-- CARD HEADER --}}
    <div class="px-7 py-6 border-b table-border">
        <h3 class="text-lg font-extrabold card-title">
            Informasi Guru
        </h3>

        <p class="text-sm card-muted mt-1">
            Lengkapi data guru dengan benar.
        </p>
    </div>

    {{-- FORM --}}
    <form action="{{ route('admin.guru.store') }}" method="POST" class="p-7">
        @csrf

        {{-- NIP --}}
        <div class="mb-5">
            <label for="nip" class="block text-sm font-bold table-text mb-2">
                NIP <span class="text-red-500">*</span>
            </label>

            <input
                type="text"
                id="nip"
                name="nip"
                value="{{ old('nip') }}"
                placeholder="Masukkan NIP guru"
                required
                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-700 dark:text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 dark:focus:border-blue-400 focus:bg-white dark:focus:bg-slate-800 transition-smooth"
            >

            @error('nip')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- NAMA GURU --}}
        <div class="mb-5">
            <label for="nama" class="block text-sm font-bold table-text mb-2">
                Nama Guru <span class="text-red-500">*</span>
            </label>

            <input
                type="text"
                id="nama"
                name="nama"
                value="{{ old('nama') }}"
                placeholder="Masukkan nama lengkap beserta gelar"
                required
                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-700 dark:text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 dark:focus:border-blue-400 focus:bg-white dark:focus:bg-slate-800 transition-smooth"
            >

            @error('nama')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- MAPEL --}}
        <div class="mb-5">
            <label for="mapel_diampu" class="block text-sm font-bold table-text mb-2">
                Mapel yang Diampu <span class="text-red-500">*</span>
            </label>

            <select
                id="mapel_diampu"
                name="mapel_diampu"
                required
                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-700 dark:text-slate-200 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 dark:focus:border-blue-400 focus:bg-white dark:focus:bg-slate-800 transition-smooth"
            >
                <option value="">-- Pilih Mata Pelajaran --</option>

                @forelse ($mapelList as $mapel)
                    <option
                        value="{{ $mapel->nama_mapel }}"
                        {{ old('mapel_diampu') == $mapel->nama_mapel ? 'selected' : '' }}
                    >
                        {{ $mapel->nama_mapel }}
                    </option>
                @empty
                    <option value="" disabled>
                        Belum ada data mata pelajaran
                    </option>
                @endforelse
            </select>

            <p class="text-xs card-muted mt-2">
                Pilihan diambil langsung dari data Mata Pelajaran.
            </p>

            @error('mapel_diampu')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- KELAS YANG DIAJAR --}}
        <div class="mb-7">
            <label class="block text-sm font-bold table-text mb-2">
                Kelas yang Diajar <span class="text-red-500">*</span>
            </label>

            <p class="text-xs card-muted mb-4">
                Pilih satu atau beberapa kelas yang diajar oleh guru ini.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @forelse ($kelasList as $kelas)
                    <label class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 hover:bg-blue-50 dark:hover:bg-blue-500/10 cursor-pointer transition-smooth">

                        <input
                            type="checkbox"
                            name="kelas_ids[]"
                            value="{{ $kelas->id }}"
                            {{ in_array($kelas->id, old('kelas_ids', [])) ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                        >

                        <div>
                            <p class="text-sm font-bold table-text">
                                {{ $kelas->nama_kelas }}
                            </p>

                            <p class="text-xs card-muted mt-1">
                                {{ $kelas->tingkat }} {{ $kelas->jurusan }}
                            </p>
                        </div>
                    </label>
                @empty
                    <div class="col-span-full p-4 rounded-xl bg-yellow-50 dark:bg-yellow-500/10 border border-yellow-200 dark:border-yellow-500/20">
                        <p class="text-sm text-yellow-700 dark:text-yellow-400">
                            Belum ada data kelas. Silakan tambahkan kelas terlebih dahulu.
                        </p>
                    </div>
                @endforelse
            </div>

            @error('kelas_ids')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror

            @error('kelas_ids.*')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- BUTTON --}}
        <div class="flex flex-col sm:flex-row gap-3 pt-2">
            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-bold shadow-lg shadow-blue-900/10 hover:shadow-xl hover:-translate-y-0.5 transition-smooth"
            >
                <span>✓</span>
                Simpan Data
            </button>

            <a
                href="{{ route('admin.guru.index') }}"
                class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-smooth text-sm font-bold"
            >
                Batal
            </a>
        </div>
    </form>
</div>

{{-- FOOTER --}}
<div class="mt-8 text-center">
    <p class="text-xs card-muted">
        © {{ date('Y') }} Sistem Akademik Mini
    </p>
</div>

@endsection