 @extends('layouts.admin')

@section('title', 'Edit Data Guru - Sistem Akademik Mini')

@section('page-title', 'Edit Data Guru')

@section('page-subtitle', 'Data Guru')

@section('content')

@php
    $kelasTerpilih = old('kelas_ids', $kelasTerpilih ?? []);
    $kelasTerpilih = array_map('intval', $kelasTerpilih);

    $tingkatList = $kelasList
        ->pluck('tingkat')
        ->filter()
        ->unique()
        ->sort()
        ->values();

    $jurusanList = $kelasList
        ->pluck('jurusan')
        ->filter()
        ->unique()
        ->sort()
        ->values();

    $waliKelasGuru = $kelasList
        ->filter(function ($kelas) use ($guru) {
            return trim((string) $kelas->wali_kelas)
                === trim((string) $guru->nama_guru);
        })
        ->pluck('id')
        ->map(fn ($id) => (int) $id)
        ->values()
        ->all();
@endphp

<div class="mb-7">
    <div class="flex items-center gap-3 mb-2">
        <div class="w-11 h-11 rounded-xl bg-blue-100 dark:bg-blue-500/10 flex items-center justify-center">
            <span class="text-xl">👨‍🏫</span>
        </div>

        <div>
            <h1 class="text-2xl font-extrabold main-title">
                Edit Informasi Guru
            </h1>

            <p class="text-sm main-subtitle mt-1">
                Perbarui data guru dan kelas yang diajar.
            </p>
        </div>
    </div>
</div>

@if($errors->any())
    <div class="mb-6 px-5 py-4 rounded-2xl bg-red-50 dark:bg-red-500/10 border border-red-100 dark:border-red-500/20 text-red-700 dark:text-red-400">
        <div class="flex items-start gap-3">
            <div class="w-9 h-9 rounded-lg bg-red-100 dark:bg-red-500/20 flex items-center justify-center shrink-0">
                !
            </div>

            <div>
                <p class="font-semibold text-sm mb-2">Terjadi kesalahan</p>

                <ul class="text-sm space-y-1">
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

<div class="dashboard-card rounded-[1.5rem] border shadow-xl shadow-slate-900/5 overflow-hidden max-w-4xl transition-smooth">

    <div class="px-7 py-6 border-b table-border">
        <h3 class="text-lg font-extrabold card-title">
            Informasi Guru
        </h3>

        <p class="text-sm card-muted mt-1">
            Perbarui data guru dengan benar.
        </p>
    </div>

    <form
        action="{{ route('admin.guru.update', $guru->id_guru) }}"
        method="POST"
        class="p-7"
    >
        @csrf
        @method('PUT')

        {{-- NIP --}}
        <div class="mb-5">
            <label for="nip" class="block text-sm font-bold table-text mb-2">
                NIP <span class="text-red-500">*</span>
            </label>

            <input
                type="text"
                id="nip"
                name="nip"
                value="{{ old('nip', $guru->nip) }}"
                placeholder="Masukkan NIP guru"
                required
                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-700 dark:text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-smooth"
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
                value="{{ old('nama', $guru->nama_guru) }}"
                placeholder="Masukkan nama lengkap guru"
                required
                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-700 dark:text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-smooth"
            >

            @error('nama')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- MAPEL --}}
        <div class="mb-7">
            <label for="mapel_diampu" class="block text-sm font-bold table-text mb-2">
                Mapel yang Diampu <span class="text-red-500">*</span>
            </label>

            <select
                id="mapel_diampu"
                name="mapel_diampu"
                required
                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-700 dark:text-slate-200 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-smooth"
            >
                <option value="">-- Pilih Mata Pelajaran --</option>

                @foreach($mapelList as $mapel)
                    <option
                        value="{{ $mapel->nama_mapel }}"
                        @selected(old('mapel_diampu', $guru->mapel_diampu) == $mapel->nama_mapel)
                    >
                        {{ $mapel->kode_mapel }} - {{ $mapel->nama_mapel }}
                    </option>
                @endforeach
            </select>

            @error('mapel_diampu')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- STATUS WALI KELAS --}}
        <div class="mb-7 p-5 rounded-2xl border border-blue-200 dark:border-blue-500/20 bg-blue-50/70 dark:bg-blue-500/5">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-500/10 flex items-center justify-center shrink-0">
                    <span class="text-lg">🏫</span>
                </div>

                <div class="min-w-0">
                    <h3 class="text-sm font-extrabold card-title">
                        Informasi Wali Kelas
                    </h3>

                    @if(count($waliKelasGuru) > 0)
                        <p class="text-sm card-muted mt-1">
                            Guru ini terdaftar sebagai wali kelas:
                        </p>

                        <div class="flex flex-wrap gap-2 mt-3">
                            @foreach($kelasList->whereIn('id', $waliKelasGuru) as $kelas)
                                <span class="inline-flex px-3 py-1.5 rounded-lg bg-white dark:bg-slate-800 border border-blue-200 dark:border-slate-700 text-sm font-bold table-text">
                                    {{ $kelas->nama_kelas }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm card-muted mt-1">
                            Guru ini belum tercatat sebagai wali kelas.
                        </p>
                    @endif

                    <p class="text-xs card-muted mt-3">
                        Informasi wali kelas berasal dari data kelas. Pengaturan ini berbeda dari penugasan mata pelajaran.
                    </p>
                </div>
            </div>
        </div>

        {{-- KELAS YANG DIAJAR --}}
        <div class="mb-7">
            <div class="mb-4">
                <h3 class="text-base font-extrabold card-title">
                    Kelas yang Diajar <span class="text-red-500">*</span>
                </h3>

                <p class="text-sm card-muted mt-1">
                    Pilih semua kelas yang benar-benar diajar guru ini sesuai pembagian jadwal sekolah.
                </p>
            </div>

            {{-- RINGKASAN --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-4 rounded-xl border border-slate-200 dark:border-slate-700 mb-4">
                <div>
                    <p class="text-sm font-bold table-text">
                        Kelas dipilih:
                        <span id="jumlahKelasTerpilih">{{ count($kelasTerpilih) }}</span>
                    </p>

                    <p class="text-xs card-muted mt-1">
                        Pilihan tidak akan hilang saat filter diganti.
                    </p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <button
                        type="button"
                        id="pilihSemuaDitampilkan"
                        class="px-3 py-2 rounded-lg bg-blue-600 text-white text-xs font-bold hover:bg-blue-700 transition"
                    >
                        Pilih yang Ditampilkan
                    </button>

                    <button
                        type="button"
                        id="hapusPilihanDitampilkan"
                        class="px-3 py-2 rounded-lg bg-slate-100 dark:bg-slate-800 table-text text-xs font-bold hover:bg-slate-200 dark:hover:bg-slate-700 transition"
                    >
                        Hapus Pilihan Ditampilkan
                    </button>
                </div>
            </div>

            {{-- FILTER --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">
                <div>
                    <label for="filterTingkat" class="block text-sm font-bold table-text mb-2">
                        Filter Tingkat
                    </label>

                    <select
                        id="filterTingkat"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm table-text focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500"
                    >
                        <option value="semua">Semua Tingkat</option>

                        @foreach($tingkatList as $tingkat)
                            <option value="{{ $tingkat }}">{{ $tingkat }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="filterJurusan" class="block text-sm font-bold table-text mb-2">
                        Filter Jurusan
                    </label>

                    <select
                        id="filterJurusan"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm table-text focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500"
                    >
                        <option value="semua">Semua Jurusan</option>

                        @foreach($jurusanList as $jurusan)
                            <option value="{{ $jurusan }}">{{ $jurusan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- DAFTAR KELAS --}}
            <div id="daftarKelas" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @forelse($kelasList as $kelas)
                    <label
                        data-kelas-card
                        data-tingkat="{{ $kelas->tingkat }}"
                        data-jurusan="{{ $kelas->jurusan }}"
                        class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 hover:bg-blue-50 dark:hover:bg-blue-500/10 cursor-pointer transition"
                    >
                        <input
                            type="checkbox"
                            name="kelas_ids[]"
                            value="{{ $kelas->id }}"
                            @checked(in_array((int) $kelas->id, $kelasTerpilih, true))
                            class="kelas-checkbox w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 shrink-0"
                        >

                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-bold table-text">
                                {{ $kelas->nama_kelas }}
                            </p>

                            <p class="text-xs card-muted mt-1">
                                Tingkat {{ $kelas->tingkat }} · Jurusan {{ $kelas->jurusan }}
                            </p>

                            @if(in_array((int) $kelas->id, $waliKelasGuru, true))
                                <span class="inline-flex mt-2 px-2 py-1 rounded-md bg-amber-100 text-amber-800 text-xs font-semibold">
                                    Wali Kelas
                                </span>
                            @endif
                        </div>
                    </label>
                @empty
                    <div class="col-span-full p-4 rounded-xl bg-yellow-50 dark:bg-yellow-500/10 border border-yellow-200 dark:border-yellow-500/20">
                        <p class="text-sm text-yellow-700 dark:text-yellow-400">
                            Belum ada data kelas. Tambahkan data kelas terlebih dahulu.
                        </p>
                    </div>
                @endforelse
            </div>

            <p id="tidakAdaKelas" class="hidden mt-3 p-4 rounded-xl bg-amber-50 dark:bg-amber-500/10 text-sm text-amber-700 dark:text-amber-400">
                Tidak ada kelas yang sesuai dengan filter ini.
            </p>

            @error('kelas_ids')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror

            @error('kelas_ids.*')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- TOMBOL --}}
        <div class="flex flex-col sm:flex-row gap-3 pt-2">
            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-bold shadow-lg shadow-blue-900/10 hover:shadow-xl hover:-translate-y-0.5 transition"
            >
                <span>✓</span>
                Simpan Perubahan
            </button>

            <a
                href="{{ route('admin.guru.index') }}"
                class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition text-sm font-bold"
            >
                Batal
            </a>
        </div>
    </form>
</div>

<div class="mt-8 text-center">
    <p class="text-xs card-muted">
        © {{ date('Y') }} Sistem Akademik Mini
    </p>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const filterTingkat = document.getElementById('filterTingkat');
    const filterJurusan = document.getElementById('filterJurusan');
    const cards = Array.from(document.querySelectorAll('[data-kelas-card]'));
    const checkboxes = Array.from(document.querySelectorAll('.kelas-checkbox'));
    const jumlahKelasTerpilih = document.getElementById('jumlahKelasTerpilih');
    const tidakAdaKelas = document.getElementById('tidakAdaKelas');
    const pilihSemuaDitampilkan = document.getElementById('pilihSemuaDitampilkan');
    const hapusPilihanDitampilkan = document.getElementById('hapusPilihanDitampilkan');

    function cocokDenganFilter(card) {
        const tingkatCocok =
            filterTingkat.value === 'semua' ||
            card.dataset.tingkat === filterTingkat.value;

        const jurusanCocok =
            filterJurusan.value === 'semua' ||
            card.dataset.jurusan === filterJurusan.value;

        return tingkatCocok && jurusanCocok;
    }

    function perbaruiTampilan() {
        let jumlahDitampilkan = 0;
        let jumlahDipilih = 0;

        cards.forEach(function (card) {
            const cocok = cocokDenganFilter(card);

            card.classList.toggle('hidden', !cocok);

            if (cocok) {
                jumlahDitampilkan++;
            }
        });

        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                jumlahDipilih++;
            }
        });

        jumlahKelasTerpilih.textContent = jumlahDipilih;
        tidakAdaKelas.classList.toggle('hidden', jumlahDitampilkan > 0);
    }

    filterTingkat.addEventListener('change', perbaruiTampilan);
    filterJurusan.addEventListener('change', perbaruiTampilan);

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', perbaruiTampilan);
    });

    pilihSemuaDitampilkan.addEventListener('click', function () {
        cards.forEach(function (card) {
            if (cocokDenganFilter(card)) {
                const checkbox = card.querySelector('.kelas-checkbox');

                if (checkbox) {
                    checkbox.checked = true;
                }
            }
        });

        perbaruiTampilan();
    });

    hapusPilihanDitampilkan.addEventListener('click', function () {
        cards.forEach(function (card) {
            if (cocokDenganFilter(card)) {
                const checkbox = card.querySelector('.kelas-checkbox');

                if (checkbox) {
                    checkbox.checked = false;
                }
            }
        });

        perbaruiTampilan();
    });

    perbaruiTampilan();
});
</script>

@endsection