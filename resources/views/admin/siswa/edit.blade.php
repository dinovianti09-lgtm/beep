@extends('layouts.admin')

@section('title', 'Edit Siswa - Sistem Akademik')

@section('page-title', 'Edit Siswa')

@section('page-subtitle', 'Perbarui data siswa')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-extrabold text-slate-800 dark:text-white">
            Edit Data Siswa
        </h2>

        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
            Perbarui informasi siswa kemudian simpan perubahan.
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

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- FORM CARD --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm max-w-3xl overflow-hidden">

        {{-- CARD HEADER --}}
        <div class="px-6 py-5 border-b border-slate-200 dark:border-slate-700">

            <h3 class="font-extrabold text-slate-800 dark:text-white">
                Informasi Siswa
            </h3>

            <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">
                Ubah informasi siswa yang diperlukan.
            </p>

        </div>


        {{-- FORM --}}
        <form
            action="{{ route('admin.siswa.update', $siswa->id_siswa) }}"
            method="POST"
            class="p-6"
        >

            @csrf

            @method('PUT')


            {{-- NIS --}}
            <div class="mb-5">

                <label
                    for="nis"
                    class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2"
                >
                    NIS
                    <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    id="nis"
                    name="nis"
                    value="{{ old('nis', $siswa->nis) }}"
                    placeholder="Masukkan NIS siswa"
                    maxlength="50"
                    required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-700 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 transition"
                >

                @error('nis')

                    <p class="text-xs text-red-500 mt-2">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- NAMA SISWA --}}
            <div class="mb-5">

                <label
                    for="nama_siswa"
                    class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2"
                >
                    Nama Siswa
                    <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    id="nama_siswa"
                    name="nama_siswa"
                    value="{{ old('nama_siswa', $siswa->nama_siswa) }}"
                    placeholder="Masukkan nama lengkap siswa"
                    maxlength="255"
                    required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-700 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 transition"
                >

                @error('nama_siswa')

                    <p class="text-xs text-red-500 mt-2">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- KELAS --}}
            <div class="mb-5">

                <label
                    for="kelas"
                    class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2"
                >
                    Kelas
                    <span class="text-red-500">*</span>
                </label>

                <select
                    id="kelas"
                    name="kelas"
                    required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-700 dark:text-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 transition"
                >

                    <option value="">
                        -- Pilih Kelas --
                    </option>

                    @forelse($kelasList as $kelas)

                        <option
                            value="{{ $kelas->nama_kelas }}"
                            {{ old('kelas', $siswa->kelas) == $kelas->nama_kelas ? 'selected' : '' }}
                        >
                            {{ $kelas->nama_kelas }}
                        </option>

                    @empty

                        <option value="" disabled>
                            Belum ada data kelas
                        </option>

                    @endforelse

                </select>

                @error('kelas')

                    <p class="text-xs text-red-500 mt-2">
                        {{ $message }}
                    </p>

                @enderror

                <p class="text-xs text-slate-400 dark:text-slate-500 mt-2">
                    Kelas diambil dari Data Kelas yang sudah dibuat.
                </p>

            </div>


            {{-- JENIS KELAMIN --}}
            <div class="mb-7">

                <label
                    for="jenis_kelamin"
                    class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2"
                >
                    Jenis Kelamin
                    <span class="text-red-500">*</span>
                </label>

                <select
                    id="jenis_kelamin"
                    name="jenis_kelamin"
                    required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-700 dark:text-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 transition"
                >

                    <option value="">
                        -- Pilih Jenis Kelamin --
                    </option>

                    <option
                        value="L"
                        {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}
                    >
                        Laki-laki
                    </option>

                    <option
                        value="P"
                        {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}
                    >
                        Perempuan
                    </option>

                </select>

                @error('jenis_kelamin')

                    <p class="text-xs text-red-500 mt-2">
                        {{ $message }}
                    </p>

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
                    href="{{ route('admin.siswa.index') }}"
                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-200 hover:bg-slate-200 dark:hover:bg-slate-700 transition text-sm font-bold"
                >
                    Batal
                </a>

            </div>

        </form>

    </div>


    {{-- FOOTER --}}
    <p class="text-center text-xs text-slate-400 dark:text-slate-500 mt-8">
        © {{ date('Y') }} Sistem Akademik Mini
    </p>

</div>

@endsection