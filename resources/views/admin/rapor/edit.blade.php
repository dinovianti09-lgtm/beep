@extends('layouts.admin')

@section('title', 'Edit Periode Rapor - Sistem Akademik')

@section('page-title', 'Edit Periode Rapor')

@section('page-subtitle', 'Perbarui data periode rapor')

@section('content')

<div class="max-w-3xl">

    <div class="bg-white rounded-2xl border border-gray-200 p-8">

        {{-- Header Form --}}
        <div class="mb-8">

            <h2 class="text-xl font-semibold text-gray-800">
                Edit Periode Rapor
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Perbarui informasi semester dan tahun ajaran.
            </p>

        </div>


        {{-- Form --}}
        <form
            action="{{ route('admin.rapor.update', $rapor->id_rapor) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            <div class="space-y-6">

                {{-- Semester --}}
                <div>

                    <label
                        for="semester"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Semester
                    </label>

                    <select
                        id="semester"
                        name="semester"
                        required
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300"
                    >

                        <option value="">
                            Pilih Semester
                        </option>

                        <option
                            value="Ganjil"
                            {{ old('semester', $rapor->semester) == 'Ganjil' ? 'selected' : '' }}
                        >
                            Ganjil
                        </option>

                        <option
                            value="Genap"
                            {{ old('semester', $rapor->semester) == 'Genap' ? 'selected' : '' }}
                        >
                            Genap
                        </option>

                    </select>

                    @error('semester')
                        <p class="text-sm text-red-600 mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Tahun Ajaran --}}
                <div>

                    <label
                        for="tahun_ajaran"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Tahun Ajaran
                    </label>

                    <input
                        type="text"
                        id="tahun_ajaran"
                        name="tahun_ajaran"
                        value="{{ old('tahun_ajaran', $rapor->tahun_ajaran) }}"
                        placeholder="Contoh: 2026/2027"
                        required
                        maxlength="20"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300"
                    >

                    <p class="text-xs text-gray-500 mt-2">
                        Contoh format: 2026/2027
                    </p>

                    @error('tahun_ajaran')
                        <p class="text-sm text-red-600 mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- Error Validasi --}}
            @if ($errors->any())

                <div class="mt-6 rounded-xl bg-red-50 border border-red-200 p-4">

                    <p class="font-semibold text-red-700 mb-2">
                        Data belum bisa disimpan:
                    </p>

                    <ul class="list-disc list-inside text-sm text-red-600">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- Tombol --}}
            <div class="flex justify-end gap-3 mt-8">

                <a
                    href="{{ route('admin.rapor.index') }}"
                    class="px-5 py-3 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-5 py-3 rounded-xl bg-gray-900 text-white hover:bg-gray-800"
                >
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection