 @extends('layouts.guru')

@section('title', 'Rekap Nilai - Sistem Akademik')

@section('page-title', 'Rekap Nilai')

@section('page-subtitle', 'Lihat dan kelola rekap nilai siswa')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center gap-3">
        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2v1a2 2 0 01-2 2z"/>
            </svg>
        </div>

        <div>
            <h2 class="text-xl font-bold text-slate-800 dark:text-white">
                Rekap Nilai Siswa
            </h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                Pantau nilai siswa berdasarkan kelas dan semester.
            </p>
        </div>
    </div>

    {{-- NOTIFIKASI SUKSES --}}
    @if(session('success'))
        <div class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800 dark:border-emerald-800 dark:bg-emerald-900/20 dark:text-emerald-300">
            <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif

    {{-- NOTIFIKASI ERROR --}}
    @if(session('error'))
        <div class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-red-800 dark:border-red-800 dark:bg-red-900/20 dark:text-red-300">
            <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            <p class="text-sm font-medium">{{ session('error') }}</p>
        </div>
    @endif

    {{-- ERROR VALIDASI --}}
    @if($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 dark:border-red-800 dark:bg-red-900/20 dark:text-red-300">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    {{-- DETAIL ERROR IMPORT EXCEL --}}
    @if(session('import_errors'))
        <div class="rounded-xl border border-amber-200 bg-amber-50 p-4 text-amber-900 dark:border-amber-800 dark:bg-amber-900/20 dark:text-amber-200">
            <h3 class="mb-2 font-bold">Detail Import Excel</h3>

            <ul class="list-inside list-disc space-y-1 text-sm">
                @foreach(session('import_errors') as $importError)
                    <li>{{ $importError }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FILTER DAN PENCARIAN --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

        <div class="border-b border-slate-100 px-5 py-4 dark:border-slate-800">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-300">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414A1 1 0 0014 14.414V19l-4 2v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                </div>

                <div>
                    <h3 class="font-bold text-slate-800 dark:text-white">Cari dan Filter Nilai</h3>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                        Cari berdasarkan nama atau NIS, lalu pilih kelas dan semester.
                    </p>
                </div>
            </div>
        </div>

        <form method="GET" action="{{ route('guru.rekap.index') }}" class="p-5">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                {{-- PENCARIAN --}}
                <div>
                    <label for="search" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                        Nama Siswa / NIS
                    </label>

                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>

                        <input
                            id="search"
                            type="search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Masukkan nama atau NIS..."
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-blue-900/40"
                        >
                    </div>
                </div>

                {{-- KELAS --}}
                <div>
                    <label for="kelas" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                        Kelas
                    </label>

                    <select
                        id="kelas"
                        name="kelas"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-blue-900/40"
                    >
                        <option value="">Semua Kelas</option>

                        @foreach($kelasDiajar as $kelas)
                            <option
                                value="{{ $kelas->nama_kelas }}"
                                {{ $kelasTerpilih == $kelas->nama_kelas ? 'selected' : '' }}
                            >
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- SEMESTER --}}
                <div>
                    <label for="semester" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                        Semester
                    </label>

                    <select
                        id="semester"
                        name="semester"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-blue-900/40"
                    >
                        <option value="">Semua Semester</option>
                        <option value="1" {{ $semesterTerpilih == '1' ? 'selected' : '' }}>Semester 1</option>
                        <option value="2" {{ $semesterTerpilih == '2' ? 'selected' : '' }}>Semester 2</option>
                    </select>
                </div>

            </div>

            <div class="mt-5 flex flex-wrap gap-3">
                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-900"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari Nilai
                </button>

                @if(request()->filled('search') || $kelasTerpilih || $semesterTerpilih)
                    <a
                        href="{{ route('guru.rekap.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- FITUR EXCEL --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

        <div class="border-b border-slate-100 px-5 py-4 dark:border-slate-800">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3M5 11h14M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"/>
                    </svg>
                </div>

                <div>
                    <h3 class="font-bold text-slate-800 dark:text-white">Import dan Export Excel</h3>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                        Kelola nilai secara massal menggunakan file Excel.
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 p-5 lg:grid-cols-3">

            {{-- DOWNLOAD TEMPLATE --}}
            <div class="flex flex-col rounded-xl border border-slate-200 p-4 dark:border-slate-700">
                <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v12m0 0l-4-4m4 4l4-4M4 17v3h16v-3"/>
                    </svg>
                </div>

                <h4 class="font-bold text-slate-800 dark:text-white">Download Template Excel</h4>
                <p class="mt-2 flex-1 text-sm leading-6 text-slate-500 dark:text-slate-400">
                    Unduh format Excel yang sudah disediakan sebelum mengisi nilai siswa.
                </p>

                <a
                    href="{{ route('guru.nilai.template') }}"
                    class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v12m0 0l-4-4m4 4l4-4M4 17v3h16v-3"/>
                    </svg>
                    Download Template
                </a>
            </div>

            {{-- IMPORT EXCEL --}}
            <div class="flex flex-col rounded-xl border border-slate-200 p-4 dark:border-slate-700">
                <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 16V4m0 0L8 8m4-4l4 4M4 16v4h16v-4"/>
                    </svg>
                </div>

                <h4 class="font-bold text-slate-800 dark:text-white">Import Excel</h4>
                <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
                    Unggah file Excel berisi nilai siswa. Gunakan template yang disediakan agar format kolom sesuai.
                </p>

                <form
                    action="{{ route('guru.nilai.import') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="mt-4 space-y-3"
                >
                    @csrf

                    <label for="file_excel" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                        Pilih file Excel
                    </label>

                    <input
                        id="file_excel"
                        type="file"
                        name="file"
                        accept=".xlsx,.xls,.csv"
                        required
                        class="block w-full cursor-pointer rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-600 file:mr-3 file:border-0 file:bg-slate-100 file:px-3 file:py-3 file:font-semibold file:text-slate-700 hover:file:bg-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:file:bg-slate-700 dark:file:text-slate-200"
                    >

                    <button
                        type="submit"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-amber-500 px-4 py-3 text-sm font-semibold text-white transition hover:bg-amber-600"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 16V4m0 0L8 8m4-4l4 4M4 16v4h16v-4"/>
                        </svg>
                        Import Nilai
                    </button>
                </form>
            </div>

            {{-- EXPORT EXCEL --}}
            <div class="flex flex-col rounded-xl border border-slate-200 p-4 dark:border-slate-700">
                <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4h16v16H4zM8 8h8M8 12h8M8 16h4"/>
                    </svg>
                </div>

                <h4 class="font-bold text-slate-800 dark:text-white">Export Excel</h4>
                <p class="mt-2 flex-1 text-sm leading-6 text-slate-500 dark:text-slate-400">
                    Unduh rekap nilai yang sudah tersimpan untuk dokumentasi atau pengolahan lebih lanjut.
                </p>

                <a
                    href="{{ route('guru.nilai.export', request()->query()) }}"
                    class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4h16v16H4zM8 8h8M8 12h8M8 16h4"/>
                    </svg>
                    Export Rekap Nilai
                </a>
            </div>

        </div>

        <div class="border-t border-slate-100 bg-slate-50 px-5 py-3 dark:border-slate-800 dark:bg-slate-800/50">
            <p class="text-xs leading-5 text-slate-500 dark:text-slate-400">
                Catatan: gunakan template yang disediakan. Pastikan nama siswa, NIS, kelas, mata pelajaran, semester, tahun ajaran, dan nilai sesuai dengan data di sistem.
            </p>
        </div>
    </div>

    {{-- JUMLAH DATA --}}
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <h3 class="font-bold text-slate-800 dark:text-white">Daftar Rekap Nilai</h3>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                Total <span class="font-bold text-slate-700 dark:text-slate-200">{{ $rekaps->count() }}</span> data nilai
            </p>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

        <div class="overflow-x-auto">
            <table class="w-full min-w-[1050px] text-left text-sm">

                <thead class="border-b border-slate-200 bg-slate-50 dark:border-slate-700 dark:bg-slate-800">
                    <tr>
                        <th class="whitespace-nowrap px-5 py-4 font-semibold text-slate-600 dark:text-slate-300">No.</th>
                        <th class="whitespace-nowrap px-5 py-4 font-semibold text-slate-600 dark:text-slate-300">Siswa</th>
                        <th class="whitespace-nowrap px-5 py-4 font-semibold text-slate-600 dark:text-slate-300">Kelas</th>
                        <th class="whitespace-nowrap px-5 py-4 font-semibold text-slate-600 dark:text-slate-300">Mata Pelajaran</th>
                        <th class="whitespace-nowrap px-5 py-4 text-center font-semibold text-slate-600 dark:text-slate-300">Semester</th>
                        <th class="whitespace-nowrap px-5 py-4 text-center font-semibold text-slate-600 dark:text-slate-300">Harian</th>
                        <th class="whitespace-nowrap px-5 py-4 text-center font-semibold text-slate-600 dark:text-slate-300">UTS</th>
                        <th class="whitespace-nowrap px-5 py-4 text-center font-semibold text-slate-600 dark:text-slate-300">UAS</th>
                        <th class="whitespace-nowrap px-5 py-4 text-center font-semibold text-slate-600 dark:text-slate-300">Nilai Akhir</th>
                        <th class="whitespace-nowrap px-5 py-4 text-center font-semibold text-slate-600 dark:text-slate-300">Predikat</th>
                        <th class="whitespace-nowrap px-5 py-4 text-center font-semibold text-slate-600 dark:text-slate-300">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">

                    @forelse($rekaps as $index => $rekap)
                        <tr class="transition hover:bg-slate-50 dark:hover:bg-slate-800/50">

                            <td class="whitespace-nowrap px-5 py-4 text-slate-500 dark:text-slate-400">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex min-w-[190px] items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-100 font-bold text-blue-700 dark:bg-blue-900/40 dark:text-blue-300">
                                        {{ strtoupper(substr($rekap->siswa->nama_siswa ?? 'S', 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-800 dark:text-white">
                                            {{ $rekap->siswa->nama_siswa ?? '-' }}
                                        </p>
                                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                            NIS: {{ $rekap->siswa->nis ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-slate-600 dark:text-slate-300">
                                {{ $rekap->siswa->kelas ?? '-' }}
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 font-medium text-slate-700 dark:text-slate-300">
                                {{ $rekap->mapel->nama_mapel ?? '-' }}
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-center">
                                <span class="inline-flex rounded-lg bg-blue-50 px-3 py-1 font-semibold text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                                    {{ $rekap->semester ?? ($rekap->rapor->semester ?? '-') }}
                                </span>
                            </td>

                            <td class="px-5 py-4 text-center text-slate-600 dark:text-slate-300">
                                {{ $rekap->nilai_harian ?? 0 }}
                            </td>

                            <td class="px-5 py-4 text-center text-slate-600 dark:text-slate-300">
                                {{ $rekap->nilai_uts ?? 0 }}
                            </td>

                            <td class="px-5 py-4 text-center text-slate-600 dark:text-slate-300">
                                {{ $rekap->nilai_uas ?? 0 }}
                            </td>

                            <td class="px-5 py-4 text-center">
                                <span class="inline-flex min-w-12 justify-center rounded-lg bg-emerald-50 px-3 py-1 font-bold text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">
                                    {{ $rekap->nilai_akhir ?? 0 }}
                                </span>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <span class="inline-flex min-w-10 justify-center rounded-lg bg-blue-50 px-3 py-1 font-bold text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                                    {{ $rekap->predikat ?? '-' }}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-2">

                                    <a
                                        href="{{ route('guru.rekap.edit', $rekap->id_nilai) }}"
                                        title="Edit nilai"
                                        aria-label="Edit nilai {{ $rekap->siswa->nama_siswa ?? '' }}"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-700 transition hover:bg-amber-100 dark:bg-amber-900/20 dark:text-amber-300 dark:hover:bg-amber-900/40"
                                    >
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536M9 11l6.732-6.732a2.5 2.5 0 013.536 3.536L12.536 15.536a2.5 2.5 0 01-1.768.732H7v-3.768A2.5 2.5 0 017.732 10.732L9 9.464"/>
                                        </svg>
                                    </a>

                                    <form
                                        action="{{ route('guru.rekap.destroy', $rekap->id_nilai) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus nilai siswa ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Hapus nilai"
                                            aria-label="Hapus nilai {{ $rekap->siswa->nama_siswa ?? '' }}"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-red-600 transition hover:bg-red-100 dark:bg-red-900/20 dark:text-red-300 dark:hover:bg-red-900/40"
                                        >
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m-7 0h14"/>
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="11" class="px-6 py-14 text-center">
                                <div class="mx-auto flex max-w-sm flex-col items-center">
                                    <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400 dark:bg-slate-800">
                                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 012 2v1a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>

                                    <h3 class="font-bold text-slate-700 dark:text-slate-200">
                                        Tidak Ada Data Nilai
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                        Tidak ada nilai yang cocok dengan pencarian atau filter yang dipilih.
                                    </p>

                                    @if(request()->filled('search') || $kelasTerpilih || $semesterTerpilih)
                                        <a href="{{ route('guru.rekap.index') }}"
                                           class="mt-4 inline-flex items-center rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                                            Reset Filter
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    <div class="pb-2 text-center text-xs text-slate-400 dark:text-slate-500">
        Sistem Akademik Mini
    </div>

</div>

@endsection