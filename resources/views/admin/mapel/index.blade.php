
@extends('layouts.admin')

@section('title', 'Data Mata Pelajaran - Sistem Akademik')

@section('page-title', 'Mata Pelajaran')

@section('page-subtitle', 'Kelola data mata pelajaran, jurusan, tingkat kelas, dan KKM')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="w-11 h-11 rounded-xl bg-blue-100 dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />
                    </svg>
                </div>

                <h1 class="text-2xl font-extrabold text-slate-800 dark:text-white">
                    Data Mata Pelajaran
                </h1>
            </div>

            <p class="text-sm text-slate-500 dark:text-slate-400">
                Kelola mata pelajaran berdasarkan jurusan dan tingkat kelas.
            </p>
        </div>

        {{-- TAMBAH MAPEL --}}
        <a href="{{ route('admin.mapel.create') }}"
            class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-bold shadow-lg shadow-blue-900/10 hover:shadow-xl hover:-translate-y-0.5 transition-smooth">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4v16m8-8H4" />
            </svg>
            Tambah Mapel
        </a>
    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="flex items-center gap-3 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20">
            <div class="w-9 h-9 rounded-full bg-emerald-100 dark:bg-emerald-500/20 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                ✓
            </div>
            <p class="text-sm font-semibold text-emerald-700 dark:text-emerald-400">
                {{ session('success') }}
            </p>
        </div>
    @endif

    {{-- ERROR --}}
    @if(session('error'))
        <div class="p-4 rounded-xl bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20">
            <p class="text-sm font-semibold text-red-700 dark:text-red-400">
                {{ session('error') }}
            </p>
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 rounded-xl bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20">
            <p class="text-sm font-bold text-red-700 dark:text-red-400 mb-2">
                Terjadi kesalahan:
            </p>
            <ul class="list-disc ml-5 space-y-1 text-sm text-red-600 dark:text-red-400">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FILTER DAN PENCARIAN --}}
    @php
        $search = trim(request('search', ''));
        $filterJurusan = request('jurusan', '');
        $filterTingkat = request('tingkat', '');

        $mapelHasil = $mapelList;

        if ($search !== '') {
            $keyword = strtolower($search);

            $mapelHasil = $mapelHasil->filter(function ($mapel) use ($keyword) {
                return str_contains(strtolower($mapel->nama_mapel ?? ''), $keyword)
                    || str_contains((string) ($mapel->kkm ?? ''), $keyword);
            });
        }

        if ($filterJurusan !== '') {
            $mapelHasil = $mapelHasil->filter(function ($mapel) use ($filterJurusan) {
                return $mapel->pengaturanKelas->contains(
                    'jurusan',
                    $filterJurusan
                );
            });
        }

        if ($filterTingkat !== '') {
            $mapelHasil = $mapelHasil->filter(function ($mapel) use ($filterTingkat) {
                return $mapel->pengaturanKelas->contains(
                    'tingkat',
                    $filterTingkat
                );
            });
        }

        $adaFilter = $search !== ''
            || $filterJurusan !== ''
            || $filterTingkat !== '';
    @endphp

    {{-- SEARCH CARD --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm p-5">

        <form action="{{ route('admin.mapel.index') }}" method="GET" class="space-y-4">

            {{-- PENCARIAN --}}
            <div class="relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 pointer-events-none"
                    fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7" />
                    <path stroke-linecap="round" d="m20 20-4-4" />
                </svg>

                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Cari nama mata pelajaran atau KKM..."
                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 text-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
            </div>

            {{-- FILTER JURUSAN DAN TINGKAT --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                <div>
                    <label for="filter_jurusan" class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-2">
                        Filter Jurusan
                    </label>

                    <select
                        id="filter_jurusan"
                        name="jurusan"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 text-slate-800 dark:text-white text-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                        <option value="">Semua Jurusan</option>

                        @foreach($jurusanList as $jurusan)
                            <option value="{{ $jurusan }}" {{ $filterJurusan === $jurusan ? 'selected' : '' }}>
                                {{ $jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="filter_tingkat" class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-2">
                        Filter Tingkat Kelas
                    </label>

                    <select
                        id="filter_tingkat"
                        name="tingkat"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 text-slate-800 dark:text-white text-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                        <option value="">Semua Tingkat</option>

                        @foreach($tingkatList as $tingkat)
                            <option value="{{ $tingkat }}" {{ $filterTingkat === $tingkat ? 'selected' : '' }}>
                                Kelas {{ $tingkat }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            {{-- BUTTON FILTER --}}
            <div class="flex flex-col sm:flex-row gap-3">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold transition-smooth">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7" />
                        <path stroke-linecap="round" d="m20 20-4-4" />
                    </svg>
                    Cari dan Filter
                </button>

                @if($adaFilter)
                    <a href="{{ route('admin.mapel.index') }}"
                        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 text-sm font-bold transition-smooth">
                        Reset Filter
                    </a>
                @endif
            </div>

        </form>

        {{-- RINGKASAN FILTER --}}
        @if($adaFilter)
            <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Menampilkan
                    <span class="font-bold text-slate-800 dark:text-white">{{ $mapelHasil->count() }}</span>
                    mata pelajaran

                    @if($search !== '')
                        untuk pencarian
                        <span class="font-bold text-slate-800 dark:text-white">"{{ $search }}"</span>
                    @endif

                    @if($filterJurusan !== '')
                        · Jurusan
                        <span class="font-bold text-slate-800 dark:text-white">{{ $filterJurusan }}</span>
                    @endif

                    @if($filterTingkat !== '')
                        · Kelas
                        <span class="font-bold text-slate-800 dark:text-white">{{ $filterTingkat }}</span>
                    @endif
                </p>
            </div>
        @endif

    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white dark:bg-slate-900 rounded-[1.5rem] border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-900/5 overflow-hidden">

        {{-- CARD HEADER --}}
        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <h3 class="font-bold text-slate-900 dark:text-slate-100">
                        Daftar Mata Pelajaran
                    </h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">
                        Mata pelajaran beserta pengaturan jurusan dan tingkat kelas.
                    </p>
                </div>

                <div class="px-3 py-1.5 rounded-full bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 text-xs font-bold whitespace-nowrap">
                    {{ $mapelHasil->count() }} Mapel
                </div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="w-full">

                <thead class="bg-slate-50 dark:bg-slate-800/70">
                    <tr class="border-b border-slate-100 dark:border-slate-700">
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Nama Mata Pelajaran</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Jurusan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Tingkat</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">KKM</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-slate-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">

                    @forelse($mapelHasil as $index => $mapel)

                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-smooth">

                            {{-- NOMOR --}}
                            <td class="px-6 py-5">
                                <span class="text-sm font-semibold text-slate-400">
                                    {{ $index + 1 }}
                                </span>
                            </td>

                            {{-- NAMA MAPEL --}}
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-500/10 dark:to-indigo-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400 flex-shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="text-sm font-bold text-slate-700 dark:text-slate-200">
                                            {{ $mapel->nama_mapel }}
                                        </p>
                                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">
                                            Mata Pelajaran
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- JURUSAN --}}
                            <td class="px-6 py-5">
                                <div class="flex flex-wrap gap-1.5">
                                    @forelse($mapel->pengaturanKelas->pluck('jurusan')->unique() as $jurusan)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-300 text-xs font-bold">
                                            {{ $jurusan }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-slate-400">
                                            Belum diatur
                                        </span>
                                    @endforelse
                                </div>
                            </td>

                            {{-- TINGKAT --}}
                            <td class="px-6 py-5">
                                <div class="flex flex-wrap gap-1.5">
                                    @forelse($mapel->pengaturanKelas->pluck('tingkat')->unique()->sort() as $tingkat)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-emerald-50 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-300 text-xs font-bold">
                                            {{ $tingkat }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-slate-400">
                                            Belum diatur
                                        </span>
                                    @endforelse
                                </div>
                            </td>

                            {{-- KKM --}}
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-blue-50 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400 text-xs font-bold">
                                    KKM {{ $mapel->kkm }}
                                </span>
                            </td>

                            {{-- AKSI --}}
                            <td class="px-6 py-5">
                                <div class="flex justify-center items-center gap-2">

                                    <a href="{{ route('admin.mapel.edit', $mapel->id_mapel) }}"
                                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400 text-xs font-semibold hover:bg-blue-100 dark:hover:bg-blue-500/20 hover:-translate-y-0.5 transition-smooth">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                        </svg>
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.mapel.destroy', $mapel->id_mapel) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus mata pelajaran ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 text-xs font-semibold hover:bg-red-100 dark:hover:bg-red-500/20 hover:-translate-y-0.5 transition-smooth">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14" />
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
                                    <div class="w-16 h-16 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-4 text-slate-400 dark:text-slate-500">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>

                                    <h3 class="font-bold text-slate-700 dark:text-slate-300">
                                        @if($adaFilter)
                                            Mata pelajaran tidak ditemukan
                                        @else
                                            Belum ada data mata pelajaran
                                        @endif
                                    </h3>

                                    <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">
                                        @if($adaFilter)
                                            Coba ubah kata kunci atau pilihan filter.
                                        @else
                                            Tambahkan mata pelajaran untuk mulai mengelola data.
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
    <p class="text-center text-xs text-slate-400 dark:text-slate-500 pt-2">
        © {{ date('Y') }} Sistem Akademik Mini
    </p>

</div>

@endsection
