@extends('layouts.admin')

@section('title', 'Data Rapor - Sistem Akademik Mini')

@section('page-title', 'Data Rapor')

@section('page-subtitle', 'Kelola periode rapor yang tersedia dalam sistem.')

@section('content')

<div class="p-6 lg:p-8">

    {{-- PAGE HEADER --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <div class="mb-2 flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 dark:bg-blue-500/10">
                    <span class="text-xl">📄</span>
                </div>

                <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">
                    Daftar Rapor
                </h1>
            </div>

            <p class="text-sm text-slate-400 dark:text-slate-500">
                Kelola periode rapor yang tersedia dalam sistem.
            </p>
        </div>

        {{-- TAMBAH PERIODE --}}
        <a
            href="{{ route('admin.rapor.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-blue-900/10 transition hover:-translate-y-0.5 hover:shadow-xl"
        >
            <span class="text-lg leading-none">+</span>
            Tambah Periode
        </a>

    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-100 bg-emerald-50 p-4 text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-400">
            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100 dark:bg-emerald-500/20">
                ✓
            </div>

            <p class="text-sm font-medium">
                {{ session('success') }}
            </p>
        </div>
    @endif

    {{-- ERROR MESSAGE --}}
    @if($errors->any())
        <div class="mb-6 rounded-xl border border-red-100 bg-red-50 p-4 text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-400">
            <div class="flex items-start gap-3">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red-100 dark:bg-red-500/20">
                    !
                </div>

                <div>
                    <p class="mb-2 text-sm font-bold">
                        Terjadi kesalahan
                    </p>

                    <ul class="space-y-1 text-sm">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- TABLE CARD --}}
    <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm transition dark:border-slate-800 dark:bg-slate-900">

        {{-- CARD HEADER --}}
        <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5 dark:border-slate-800">
            <div>
                <h4 class="font-extrabold text-slate-900 dark:text-white">
                    Data Rapor
                </h4>

                <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">
                    Daftar periode rapor yang tersimpan.
                </p>
            </div>

            <div class="rounded-full bg-blue-50 px-3 py-1.5 text-xs font-bold text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                {{ $rapors->count() }} Rapor
            </div>
        </div>

        {{-- TABLE --}}
        <div class="w-full overflow-x-auto">
            <table class="w-full min-w-[700px]">

                <colgroup>
                    <col style="width: 10%">
                    <col style="width: 25%">
                    <col style="width: 30%">
                    <col style="width: 35%">
                </colgroup>

                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50 dark:border-slate-700 dark:bg-slate-800">

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            No
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Semester
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Tahun Ajaran
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Aksi
                        </th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">

                    @forelse($rapors as $index => $rapor)

                        <tr class="transition hover:bg-slate-50 dark:hover:bg-slate-800/70">

                            {{-- NOMOR --}}
                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold text-slate-500 dark:text-slate-400">
                                    {{ $index + 1 }}
                                </span>
                            </td>

                            {{-- SEMESTER --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                                    @if(in_array(strtolower((string) $rapor->semester), ['1', 'ganjil']))
                                        Semester Ganjil
                                    @elseif(in_array(strtolower((string) $rapor->semester), ['2', 'genap']))
                                        Semester Genap
                                    @else
                                        Semester {{ $rapor->semester }}
                                    @endif
                                </span>
                            </td>

                            {{-- TAHUN AJARAN --}}
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-slate-800 dark:text-slate-200">
                                    {{ $rapor->tahun_ajaran }}
                                </span>
                            </td>

                            {{-- AKSI --}}
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap justify-center gap-2">

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('admin.rapor.edit', $rapor->id_rapor) }}"
                                        class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3.5 py-2 text-xs font-bold text-blue-600 transition hover:bg-blue-600 hover:text-white dark:bg-blue-500/10 dark:text-blue-400"
                                    >
                                        ✎ Edit
                                    </a>

                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('admin.rapor.destroy', $rapor->id_rapor) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus periode rapor ini?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center gap-1.5 rounded-lg bg-red-50 px-3.5 py-2 text-xs font-bold text-red-600 transition hover:bg-red-600 hover:text-white dark:bg-red-500/10 dark:text-red-400"
                                        >
                                            🗑 Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">

                                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-2xl dark:bg-slate-800">
                                        📄
                                    </div>

                                    <h4 class="text-sm font-bold text-slate-700 dark:text-slate-300">
                                        Belum ada data rapor
                                    </h4>

                                    <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">
                                        Silakan tambahkan periode rapor terlebih dahulu.
                                    </p>

                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>
            </table>
        </div>

    </div>

    {{-- FOOTER --}}
    <p class="mt-8 text-center text-xs text-slate-400 dark:text-slate-600">
        © {{ date('Y') }} Sistem Akademik Mini
    </p>

</div>

@endsection
