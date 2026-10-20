@extends('layouts.admin')

@section('title', 'Data Kelas - Sistem Akademik Mini')

@section('page-title', 'Data Kelas')

@section('page-subtitle', 'Kelola daftar kelas dan wali kelas.')

@section('content')

<div class="space-y-6">

{{-- HEADER --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

    <div>
        <div class="flex items-center gap-3 mb-2">

            <div class="w-11 h-11 rounded-xl bg-blue-100 dark:bg-blue-500/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16M9 7h1m4 0h1M9 11h1m4 0h1M9 15h1m4 0h1"/>
                </svg>
            </div>

            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-slate-100">
                Data Kelas
            </h1>

        </div>

        <p class="text-sm text-slate-500 dark:text-slate-400">
            Kelola daftar kelas dan wali kelas.
        </p>
    </div>

    {{-- TAMBAH KELAS --}}
    <a
        href="{{ route('admin.kelas.create') }}"
        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold shadow-lg shadow-blue-900/10 hover:-translate-y-1 transition"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14M5 12h14"/>
        </svg>

        Tambah Kelas
    </a>

</div>


{{-- SUCCESS --}}
@if(session('success'))

    <div class="flex items-center gap-3 px-5 py-4 rounded-2xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400">

        <div class="w-9 h-9 rounded-full bg-emerald-100 dark:bg-emerald-500/20 flex items-center justify-center">

            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>

        </div>

        <p class="text-sm font-medium">
            {{ session('success') }}
        </p>

    </div>

@endif


{{-- ERROR --}}
@if($errors->any())

    <div class="px-5 py-4 rounded-2xl bg-red-50 dark:bg-red-500/10 border border-red-100 dark:border-red-500/20 text-red-700 dark:text-red-400">

        <p class="font-semibold text-sm mb-2">
            Terjadi kesalahan:
        </p>

        <ul class="text-sm space-y-1">

            @foreach($errors->all() as $error)

                <li class="flex items-start gap-2">
                    <span class="mt-1 w-1.5 h-1.5 rounded-full bg-red-500 flex-shrink-0"></span>
                    <span>{{ $error }}</span>
                </li>

            @endforeach

        </ul>

    </div>

@endif


{{-- PENCARIAN --}}
<div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm p-5">

    <form
        action="{{ route('admin.kelas.index') }}"
        method="GET"
        class="flex flex-col sm:flex-row gap-3"
    >

        <div class="relative flex-1">

            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>

            </div>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama kelas, tingkat, jurusan, atau wali kelas..."
                class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-700 dark:text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
            >

        </div>

        <button
            type="submit"
            class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold transition"
        >

            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>

            Cari

        </button>

        @if(request('search'))

            <a
                href="{{ route('admin.kelas.index') }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-sm font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition"
            >

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h5M20 20v-5h-5M5.5 9A7 7 0 0118 6.5M18.5 15A7 7 0 016 17.5"/>
                </svg>

                Reset

            </a>

        @endif

    </form>

</div>


{{-- TABLE CARD --}}
<div class="bg-white dark:bg-slate-900 rounded-[1.5rem] border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-900/5 overflow-hidden">

    {{-- CARD HEADER --}}
    <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">

        <div>

            <h3 class="font-bold text-slate-900 dark:text-slate-100">
                Daftar Kelas
            </h3>

            <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">
                Data kelas yang tersedia di sistem.
            </p>

        </div>

        <div class="px-3 py-1.5 rounded-full bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 text-xs font-bold">
            {{ $kelasList->count() }} Kelas
        </div>

    </div>


    {{-- TABLE --}}
    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-slate-50 dark:bg-slate-800">

                <tr class="border-b border-slate-100 dark:border-slate-700">

                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                        No
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Nama Kelas
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Tingkat
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Jurusan
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Wali Kelas
                    </th>

                    <th class="px-6 py-4 text-center text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">

                @forelse($kelasList as $index => $kelas)

                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/70 transition">

                        {{-- NO --}}
                        <td class="px-6 py-5">

                            <span class="text-sm font-semibold text-slate-400">
                                {{ $index + 1 }}
                            </span>

                        </td>


                        {{-- NAMA KELAS --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-500/10 dark:to-indigo-500/10 flex items-center justify-center">

                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16M9 7h1m4 0h1M9 11h1m4 0h1M9 15h1m4 0h1"/>
                                    </svg>

                                </div>

                                <div>

                                    <p class="text-sm font-bold text-slate-700 dark:text-slate-200">
                                        {{ $kelas->nama_kelas }}
                                    </p>

                                    <p class="text-xs text-slate-400 mt-0.5">
                                        Kelas
                                    </p>

                                </div>

                            </div>

                        </td>


                        {{-- TINGKAT --}}
                        <td class="px-6 py-5">

                            <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-blue-50 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400 text-xs font-bold">
                                Tingkat {{ $kelas->tingkat }}
                            </span>

                        </td>


                        {{-- JURUSAN --}}
                        <td class="px-6 py-5">

                            <span class="text-sm text-slate-600 dark:text-slate-300">
                                {{ $kelas->jurusan ?? '-' }}
                            </span>

                        </td>


                        {{-- WALI KELAS --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-2">

                                <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-800 flex items-center justify-center">

                                    <svg class="w-4 h-4 text-slate-500 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 12a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 0114 0"/>
                                    </svg>

                                </div>

                                <span class="text-sm text-slate-600 dark:text-slate-300">
                                    {{ $kelas->wali_kelas ?? '-' }}
                                </span>

                            </div>

                        </td>


                        {{-- AKSI --}}
                        <td class="px-6 py-5">

                            <div class="flex justify-center items-center gap-2">

                                {{-- EDIT --}}
                                <a
                                    href="{{ route('admin.kelas.edit', $kelas->id) }}"
                                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400 text-xs font-semibold hover:bg-blue-100 dark:hover:bg-blue-500/20 hover:-translate-y-0.5 transition"
                                >

                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M4 20h4l10.768-10.768a2.5 2.5 0 00-3.536-3.536L4 16v4z"/>
                                    </svg>

                                    Edit

                                </a>


                                {{-- HAPUS --}}
                                <form
                                    action="{{ route('admin.kelas.destroy', $kelas->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus kelas ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 text-xs font-semibold hover:bg-red-100 dark:hover:bg-red-500/20 hover:-translate-y-0.5 transition"
                                    >

                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12M9 7V5a1 1 0 011-1h4a1 1 0 011 1v2m2 0v12a2 2 0 01-2 2H9a2 2 0 01-2-2V7m3 4v6m4-6v6"/>
                                        </svg>

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="px-6 py-16 text-center">

                            <div class="flex flex-col items-center">

                                <div class="w-16 h-16 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-4">

                                    <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16M9 7h1m4 0h1M9 11h1m4 0h1M9 15h1m4 0h1"/>
                                    </svg>

                                </div>

                                <h3 class="font-bold text-slate-700 dark:text-slate-300">

                                    @if(request('search'))
                                        Kelas tidak ditemukan
                                    @else
                                        Belum ada data kelas
                                    @endif

                                </h3>

                                <p class="text-sm text-slate-400 mt-1">

                                    @if(request('search'))
                                        Coba gunakan kata kunci pencarian yang lain.
                                    @else
                                        Tambahkan kelas untuk mulai mengelola data.
                                    @endif

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
<div class="text-center pt-2">

    <p class="text-xs text-slate-400">
        © {{ date('Y') }} Sistem Akademik Mini
    </p>

</div>

</div>

@endsection
