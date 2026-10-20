@extends('layouts.admin')

@section('title', 'Rapor Siswa - Sistem Akademik Mini')
@section('page-title', 'Rapor Siswa')
@section('page-subtitle', 'Kelola rapor siswa berdasarkan periode rapor')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-800 dark:text-white">
                    Daftar Rapor Siswa
                </h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    {{ $raporSiswaList->count() }} siswa ditampilkan
                </p>
            </div>
        </div>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-700 dark:border-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700 dark:border-red-800 dark:bg-red-900/30 dark:text-red-300">
            {{ session('error') }}
        </div>
    @endif

    {{-- FILTER --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800">
        <h3 class="mb-4 font-bold text-slate-800 dark:text-white">
            Pencarian dan Filter
        </h3>

        <form method="GET"
              action="{{ route('admin.rapor_siswa.index') }}"
              class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

            {{-- 1. PERIODE --}}
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">
                    Semester dan Tahun Ajaran
                </label>

                <select name="id_rapor"
                        class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800 dark:border-slate-600 dark:bg-slate-900 dark:text-white">
                    @foreach($periodeList as $item)
                        <option value="{{ $item->id_rapor }}"
                            @selected($periode?->id_rapor == $item->id_rapor)>
                            {{ $item->semester }} - {{ $item->tahun_ajaran }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- 2. JURUSAN --}}
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">
                    Jurusan
                </label>

                <select id="filter-jurusan"
                        name="jurusan"
                        class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800 dark:border-slate-600 dark:bg-slate-900 dark:text-white">
                    <option value="">Semua Jurusan</option>

                    @foreach($jurusanList as $jurusan)
                        <option value="{{ $jurusan }}"
                            @selected(request('jurusan') == $jurusan)>
                            {{ $jurusan }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- 3. TINGKAT --}}
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">
                    Tingkat
                </label>

                <select id="filter-tingkat"
                        name="tingkat"
                        class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800 dark:border-slate-600 dark:bg-slate-900 dark:text-white">
                    <option value="">Semua Tingkat</option>
                </select>
            </div>

            {{-- 4. KELAS --}}
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">
                    Kelas
                </label>

                <select id="filter-kelas"
                        name="kelas"
                        class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800 dark:border-slate-600 dark:bg-slate-900 dark:text-white">
                    <option value="">Semua Kelas</option>

                    @foreach($kelasList as $kelas)
                        <option value="{{ $kelas->nama_kelas }}"
                                data-jurusan="{{ $kelas->jurusan }}"
                                data-tingkat="{{ $kelas->tingkat }}"
                                @selected(request('kelas') == $kelas->nama_kelas)>
                            {{ $kelas->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- 5. PENCARIAN NAMA SISWA / NIS --}}
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">
                    Nama Siswa / NIS
                </label>

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari nama atau NIS..."
                       class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800 dark:border-slate-600 dark:bg-slate-900 dark:text-white">
            </div>

            {{-- TOMBOL FILTER --}}
            <div class="flex flex-wrap items-end gap-2">
                <button type="submit"
                        class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
                    Terapkan Filter
                </button>

                <a href="{{ route('admin.rapor_siswa.index') }}"
                   class="rounded-xl border border-slate-300 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 dark:border-slate-600 dark:text-slate-300 dark:hover:bg-slate-700">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- TABEL RAPOR --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-800">

        <div class="border-b border-slate-200 px-6 py-5 dark:border-slate-700">
            <h3 class="font-bold text-slate-800 dark:text-white">
                Data Rapor Siswa
            </h3>

            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                Periode:
                {{ $periode ? $periode->semester.' - '.$periode->tahun_ajaran : 'Belum tersedia' }}
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">

                <thead class="border-b border-slate-200 bg-slate-50 dark:border-slate-700 dark:bg-slate-900/50">
                    <tr>
                        @foreach(['No', 'Siswa', 'Kelas', 'Jumlah Nilai', 'Status Rapor', 'Tanggal Cetak', 'Aksi'] as $heading)
                            <th class="whitespace-nowrap px-5 py-4 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                {{ $heading }}
                            </th>
                        @endforeach
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">

                    @forelse($raporSiswaList as $index => $item)
                        <tr class="transition hover:bg-slate-50 dark:hover:bg-slate-700/40">

                            {{-- NOMOR --}}
                            <td class="whitespace-nowrap px-5 py-4 text-slate-500 dark:text-slate-400">
                                {{ $index + 1 }}
                            </td>

                            {{-- IDENTITAS SISWA --}}
                            <td class="px-5 py-4">
                                <p class="font-semibold text-slate-800 dark:text-white">
                                    {{ $item->siswa->nama_siswa }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                    NIS: {{ $item->siswa->nis }}
                                </p>
                            </td>

                            {{-- KELAS --}}
                            <td class="whitespace-nowrap px-5 py-4 text-slate-700 dark:text-slate-300">
                                {{ $item->siswa->kelas }}
                            </td>

                            {{-- JUMLAH NILAI --}}
                            <td class="whitespace-nowrap px-5 py-4 text-slate-700 dark:text-slate-300">
                                {{ $item->jumlah_nilai }}
                            </td>

                            {{-- STATUS RAPOR --}}
                            <td class="whitespace-nowrap px-5 py-4">
                                @if($item->status_rapor === 'Belum Ada Nilai')
                                    <span class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 dark:bg-red-900/30 dark:text-red-300">
                                        Belum Ada Nilai
                                    </span>

                                @elseif($item->status_rapor === 'Rapor Belum Lengkap')
                                    <span class="rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700 dark:bg-amber-900/30 dark:text-amber-300">
                                        Rapor Belum Lengkap
                                    </span>

                                @elseif($item->status_rapor === 'Rapor Lengkap')
                                    <span class="rounded-lg bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">
                                        Rapor Lengkap
                                    </span>

                                @else
                                    <span class="rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-700 dark:bg-slate-700 dark:text-slate-300">
                                        {{ $item->status_rapor }}
                                    </span>
                                @endif
                            </td>

                            {{-- TANGGAL CETAK --}}
                            <td class="whitespace-nowrap px-5 py-4 text-slate-700 dark:text-slate-300">
                                {{ $item->tgl_cetak ?? '-' }}
                            </td>

                            {{-- AKSI --}}
                            <td class="whitespace-nowrap px-5 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    @if($item->id_rapor_siswa)
                                        <a href="{{ route('admin.rapor_siswa.show', $item->id_rapor_siswa) }}"
                                           class="rounded-lg bg-indigo-50 px-4 py-2 font-semibold text-indigo-600 transition hover:bg-indigo-100 dark:bg-indigo-900/30 dark:text-indigo-300 dark:hover:bg-indigo-900/50">
                                            Lihat
                                        </a>

                                        <form action="{{ route('admin.rapor_siswa.destroy', $item->id_rapor_siswa) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus rapor siswa ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="rounded-lg bg-red-50 px-4 py-2 font-semibold text-red-600 transition hover:bg-red-100 dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-900/50">
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-slate-400">
                                            Rapor belum dibuat
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-14 text-center">
                                <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-3xl dark:bg-slate-700">
                                    📄
                                </div>

                                <p class="font-semibold text-slate-700 dark:text-white">
                                    Tidak ada siswa yang sesuai
                                </p>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    Coba ubah periode atau filter pencarian.
                                </p>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- FILTER JURUSAN → TINGKAT → KELAS --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const jurusanSelect = document.getElementById('filter-jurusan');
    const tingkatSelect = document.getElementById('filter-tingkat');
    const kelasSelect = document.getElementById('filter-kelas');

    if (!jurusanSelect || !tingkatSelect || !kelasSelect) {
        return;
    }

    const semuaKelas = Array.from(kelasSelect.options)
        .filter(option => option.value !== '')
        .map(option => ({
            nama: option.value,
            jurusan: option.dataset.jurusan || '',
            tingkat: option.dataset.tingkat || ''
        }));

    const tingkatAwal = @json((string) request('tingkat'));
    const kelasAwal = @json((string) request('kelas'));

    function perbaruiTingkat(pilihanTingkat = '') {
        const jurusan = jurusanSelect.value;

        const tingkatTersedia = [...new Set(
            semuaKelas
                .filter(k => !jurusan || k.jurusan === jurusan)
                .map(k => k.tingkat)
                .filter(Boolean)
        )];

        tingkatSelect.innerHTML = '';

        const opsiSemua = document.createElement('option');
        opsiSemua.value = '';
        opsiSemua.textContent = 'Semua Tingkat';
        tingkatSelect.appendChild(opsiSemua);

        tingkatTersedia.forEach(tingkat => {
            const option = document.createElement('option');
            option.value = tingkat;
            option.textContent = tingkat;
            tingkatSelect.appendChild(option);
        });

        tingkatSelect.value = tingkatTersedia.includes(pilihanTingkat)
            ? pilihanTingkat
            : '';

        perbaruiKelas(kelasAwal);
    }

    function perbaruiKelas(pilihanKelas = '') {
        const jurusan = jurusanSelect.value;
        const tingkat = tingkatSelect.value;

        const kelasTersedia = semuaKelas.filter(k =>
            (!jurusan || k.jurusan === jurusan) &&
            (!tingkat || k.tingkat === tingkat)
        );

        kelasSelect.innerHTML = '';

        const opsiSemua = document.createElement('option');
        opsiSemua.value = '';
        opsiSemua.textContent = 'Semua Kelas';
        kelasSelect.appendChild(opsiSemua);

        kelasTersedia.forEach(k => {
            const option = document.createElement('option');
            option.value = k.nama;
            option.textContent = k.nama;
            kelasSelect.appendChild(option);
        });

        kelasSelect.value = kelasTersedia.some(k => k.nama === pilihanKelas)
            ? pilihanKelas
            : '';
    }

    perbaruiTingkat(tingkatAwal);

    jurusanSelect.addEventListener('change', function () {
        perbaruiTingkat('');
    });

    tingkatSelect.addEventListener('change', function () {
        perbaruiKelas('');
    });
});
</script>
@endsection
