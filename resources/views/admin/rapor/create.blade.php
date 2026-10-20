@extends('layouts.admin')

@section('title', 'Tambah Periode Rapor - Sistem Akademik')

@section('page-title', 'Tambah Periode Rapor')

@section('page-subtitle', 'Tambahkan periode rapor baru')

@section('content')

<div class="max-w-3xl">

    {{-- HEADER --}}
    <div class="mb-6">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center">
                <span class="text-xl">📄</span>
            </div>

            <div>
                <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">
                    Periode Rapor Baru
                </h2>

                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Isi data periode rapor yang akan digunakan.
                </p>
            </div>
        </div>
    </div>


    {{-- FORM CARD --}}
    <div class="bg-white dark:bg-slate-800 rounded-[1.5rem] border border-slate-200 dark:border-slate-700 shadow-xl shadow-slate-900/5 overflow-hidden">

        {{-- CARD HEADER --}}
        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-700 bg-gradient-to-r from-blue-50/70 to-indigo-50/70 dark:from-slate-800 dark:to-slate-800">

            <h3 class="font-bold text-slate-800 dark:text-white">
                Form Tambah Periode Rapor
            </h3>

            <p class="text-xs text-slate-400 mt-1">
                Lengkapi semester dan tahun ajaran.
            </p>

        </div>


        {{-- FORM --}}
        <form action="{{ route('admin.rapor.store') }}" method="POST">

            @csrf

            <div class="p-6 sm:p-8 space-y-6">

                {{-- SEMESTER --}}
                <div>
                    <label
                        for="semester"
                        class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2"
                    >
                        Semester
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="semester"
                        name="semester"
                        required
                        class="w-full border border-slate-200 dark:border-slate-600 rounded-xl px-4 py-3 bg-slate-50 dark:bg-slate-700 text-slate-800 dark:text-white text-sm focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500"
                    >

                        <option value="">
                            Pilih Semester
                        </option>

                        <option
                            value="Ganjil"
                            {{ old('semester') == 'Ganjil' ? 'selected' : '' }}
                        >
                            Ganjil
                        </option>

                        <option
                            value="Genap"
                            {{ old('semester') == 'Genap' ? 'selected' : '' }}
                        >
                            Genap
                        </option>

                    </select>

                    @error('semester')
                        <p class="text-sm text-red-500 mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- TAHUN AJARAN --}}
                <div>
                    <label
                        for="tahun_ajaran"
                        class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2"
                    >
                        Tahun Ajaran
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="tahun_ajaran"
                        name="tahun_ajaran"
                        value="{{ old('tahun_ajaran', '2026/2027') }}"
                        placeholder="Contoh: 2026/2027"
                        required
                        maxlength="20"
                        class="w-full border border-slate-200 dark:border-slate-600 rounded-xl px-4 py-3 bg-slate-50 dark:bg-slate-700 text-slate-800 dark:text-white placeholder-slate-400 text-sm focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500"
                    >

                    <p class="text-xs text-slate-400 mt-2">
                        Contoh format: 2026/2027
                    </p>

                    @error('tahun_ajaran')
                        <p class="text-sm text-red-500 mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- ERROR --}}
                @if ($errors->any())

                    <div class="rounded-2xl bg-red-50 dark:bg-red-950/30 border border-red-100 dark:border-red-900 p-4">

                        <p class="font-semibold text-red-700 dark:text-red-300 mb-2">
                            Data belum bisa disimpan:
                        </p>

                        <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400 space-y-1">

                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach

                        </ul>

                    </div>

                @endif

            </div>


            {{-- BUTTON --}}
            <div class="px-6 sm:px-8 py-5 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-700 flex flex-col sm:flex-row justify-end gap-3">

                <a
                    href="{{ route('admin.rapor.index') }}"
                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-sm font-semibold hover:bg-slate-100 dark:hover:bg-slate-700 transition"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold shadow-lg shadow-blue-900/10 hover:-translate-y-0.5 transition"
                >
                    <span>✓</span>
                    Simpan Periode
                </button>

            </div>

        </form>

    </div>


    {{-- INFO --}}
    <div class="flex gap-3 px-5 py-4 mt-6 rounded-2xl bg-blue-50 dark:bg-blue-950/30 border border-blue-100 dark:border-blue-900">

        <div class="text-blue-600 dark:text-blue-400 text-lg">
            💡
        </div>

        <div>
            <p class="text-sm font-semibold text-blue-800 dark:text-blue-300">
                Informasi
            </p>

            <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">
                Periode rapor ini nantinya dapat digunakan saat menambahkan nilai siswa.
            </p>
        </div>

    </div>


    {{-- FOOTER --}}
    <div class="text-center pt-5">
        <p class="text-xs text-slate-400">
            © {{ date('Y') }} Sistem Akademik Mini
        </p>
    </div>

</div>

@endsection