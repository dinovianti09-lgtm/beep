@extends('layouts.guru')

@section('title', 'Detail Rapor - Sistem Akademik Mini')
@section('page-title', 'Detail Rapor')
@section('page-subtitle', 'Lihat nilai dan rata-rata hasil belajar siswa di kelas wali Anda.')

@section('content')
<div class="p-6 lg:p-8">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">
                Detail Rapor Siswa
            </h1>
            <p class="text-sm text-slate-400 dark:text-slate-500 mt-2">
                Kelas {{ $kelasWali->nama_kelas }}
                · Semester {{ $rapor->semester }}
                · Tahun Ajaran {{ $rapor->tahun_ajaran }}
            </p>
        </div>

        <a href="{{ route('guru.rapor.index') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-sm font-bold hover:bg-slate-200 dark:hover:bg-slate-700 transition">
            ← Kembali
        </a>
    </div>

    {{-- PESAN SUKSES --}}
    @if(session('success'))
        <div class="bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/30 rounded-xl p-4 mb-6">
            <p class="text-sm font-semibold text-emerald-700 dark:text-emerald-300">
                ✓ {{ session('success') }}
            </p>
        </div>
    @endif

    {{-- PESAN VALIDASI --}}
    @if($errors->any())
        <div class="bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/30 rounded-xl p-4 mb-6">
            <p class="font-bold text-red-700 dark:text-red-300 mb-2">
                Data belum berhasil disimpan:
            </p>
            <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-300 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- PILIH SISWA --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm p-6 mb-6">
        <h3 class="font-extrabold text-slate-900 dark:text-white mb-4">
            Pilih Siswa
        </h3>

        <form action="{{ route('guru.rapor.show', $rapor->id_rapor) }}"
              method="GET"
              class="flex flex-col sm:flex-row gap-3">
            <select name="id_siswa"
                    required
                    class="w-full sm:flex-1 px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih siswa --</option>

                @foreach($siswaList as $item)
                    <option value="{{ $item->id_siswa }}"
                        {{ (string) request('id_siswa') === (string) $item->id_siswa ? 'selected' : '' }}>
                        {{ $item->nis }} - {{ $item->nama_siswa }}
                    </option>
                @endforeach
            </select>

            <button type="submit"
                    class="px-5 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-bold hover:opacity-90 transition">
                Lihat Nilai
            </button>
        </form>
    </div>

    {{-- HASIL RAPOR --}}
    @if($siswa)

        {{-- IDENTITAS SISWA --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm p-6 mb-6">
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-2">
                Nama Siswa
            </p>

            <h2 class="text-xl font-extrabold text-slate-900 dark:text-white">
                {{ $siswa->nama_siswa }}
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-5">
                <div>
                    <p class="text-xs text-slate-400 dark:text-slate-500">NIS</p>
                    <p class="text-sm font-bold text-slate-800 dark:text-slate-200 mt-1">
                        {{ $siswa->nis }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Kelas</p>
                    <p class="text-sm font-bold text-slate-800 dark:text-slate-200 mt-1">
                        {{ $siswa->kelas }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-400 dark:text-slate-500">
                        Jumlah Mata Pelajaran dengan Nilai Lengkap
                    </p>
                    <p class="text-sm font-bold text-slate-800 dark:text-slate-200 mt-1">
                        {{ $jumlahMapel }} / {{ $totalMapel }}
                    </p>
                </div>
            </div>
        </div>

        {{-- PERINGATAN NILAI BELUM LENGKAP --}}
        @if($belumLengkapMapel->isNotEmpty())
            <div class="bg-amber-50 dark:bg-amber-500/10 border border-amber-200 dark:border-amber-500/30 rounded-2xl p-5 mb-6">
                <div class="flex items-start gap-3">
                    <span class="text-xl">⚠️</span>
                    <div>
                        <h3 class="font-extrabold text-amber-800 dark:text-amber-300">
                            Nilai Rapor Belum Lengkap
                        </h3>

                        <p class="text-sm text-amber-700 dark:text-amber-200 mt-2">
                            Beberapa mata pelajaran wajib belum memiliki nilai lengkap. Rata-rata rapor belum dapat ditampilkan.
                        </p>

                        <p class="text-sm font-bold text-amber-800 dark:text-amber-300 mt-3">
                            Mata pelajaran yang perlu dilengkapi:
                        </p>

                        <ul class="list-disc list-inside text-sm text-amber-700 dark:text-amber-200 mt-2 space-y-1">
                            @foreach($belumLengkapMapel as $namaMapel)
                                <li>{{ $namaMapel }}</li>
                            @endforeach
                        </ul>

                        <p class="text-xs text-amber-700 dark:text-amber-200 mt-3">
                            Pastikan nilai Harian, UTS, dan UAS sudah diinput oleh guru mata pelajaran terkait.
                        </p>
                    </div>
                </div>
            </div>
        @elseif($totalMapel > 0 && $jumlahMapel === $totalMapel)
            <div class="bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/30 rounded-2xl p-4 mb-6">
                <p class="text-sm font-semibold text-emerald-700 dark:text-emerald-300">
                    ✓ Nilai seluruh mata pelajaran wajib sudah lengkap.
                </p>
            </div>
        @endif

        {{-- RINGKASAN NILAI --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm p-6">
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    Rata-rata Rapor
                </p>
                <h2 class="text-3xl font-extrabold text-blue-600 dark:text-blue-400 mt-3">
                    {{ $rataRataRapor !== null ? number_format($rataRataRapor, 2, ',', '.') : '-' }}
                </h2>

                @if($belumLengkapMapel->isNotEmpty())
                    <p class="text-xs text-amber-600 dark:text-amber-400 mt-2">
                        Menunggu nilai seluruh mata pelajaran wajib lengkap.
                    </p>
                @endif
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm p-6">
                <p class="text-sm text-slate-500 dark:text-slate-400">Periode</p>
                <h2 class="text-xl font-extrabold text-slate-900 dark:text-white mt-3">
                    Semester {{ $rapor->semester }}
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Tahun Ajaran {{ $rapor->tahun_ajaran }}
                </p>
            </div>
        </div>

        {{-- TABEL NILAI --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden mb-6">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800">
                <h3 class="font-extrabold text-slate-900 dark:text-white">Daftar Nilai</h3>
                <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">
                    Nilai mata pelajaran siswa pada periode ini, beserta KKM dan status ketuntasannya.
                </p>
            </div>

            <div class="w-full overflow-x-auto">
                <table class="w-full min-w-[900px]">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-800 border-b border-slate-100 dark:border-slate-700">
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">No</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">Mata Pelajaran</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">Harian</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">UTS</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">UAS</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">Nilai Akhir</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">KKM</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">Predikat</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @forelse($nilaiList as $index => $nilai)
                            @php
                                $nilaiAkhir = $nilai->nilai_akhir;
                                $kkm = $nilai->mapel->kkm ?? null;
                                $nilaiValid = is_numeric($nilaiAkhir) && is_numeric($kkm);
                                $tuntas = $nilaiValid && (float) $nilaiAkhir >= (float) $kkm;
                            @endphp

                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/70 transition">
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400">
                                    {{ $index + 1 }}
                                </td>

                                <td class="px-6 py-4 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                    {{ $nilai->mapel->nama_mapel ?? 'Mapel tidak ditemukan' }}
                                </td>

                                <td class="px-6 py-4 text-center text-sm text-slate-700 dark:text-slate-300">
                                    {{ $nilai->nilai_harian ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-center text-sm text-slate-700 dark:text-slate-300">
                                    {{ $nilai->nilai_uts ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-center text-sm text-slate-700 dark:text-slate-300">
                                    {{ $nilai->nilai_uas ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-center text-sm font-extrabold text-blue-600 dark:text-blue-400">
                                    {{ $nilaiAkhir ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-center text-sm font-semibold text-slate-700 dark:text-slate-300">
                                    {{ $kkm ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-center text-sm font-bold">
                                    @if($nilaiValid)
                                        @if($tuntas)
                                            <span class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">
                                                Tuntas
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 rounded-full bg-red-100 text-red-800 dark:bg-red-500/10 dark:text-red-300">
                                                Remedial
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-slate-400">-</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center text-sm font-bold text-slate-700 dark:text-slate-300">
                                    {{ $nilai->predikat ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center text-sm text-slate-400 dark:text-slate-500">
                                    Belum ada nilai untuk siswa pada periode ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- FORM KEHADIRAN --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm p-6 mb-6">
            <div class="mb-5">
                <h3 class="text-lg font-extrabold text-slate-900 dark:text-white">
                    Kehadiran Siswa
                </h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Isi jumlah hari ketidakhadiran siswa selama periode rapor ini.
                </p>
            </div>

            <form action="{{ route('guru.rapor.kehadiran.simpan') }}" method="POST">
                @csrf
                <input type="hidden" name="id_siswa" value="{{ $siswa->id_siswa }}">
                <input type="hidden" name="id_rapor" value="{{ $rapor->id_rapor }}">

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="sakit" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                            Sakit (hari)
                        </label>
                        <input id="sakit" type="number" name="sakit" min="0" max="366" required
                               value="{{ old('sakit', $kehadiran?->sakit ?? 0) }}"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="izin" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                            Izin (hari)
                        </label>
                        <input id="izin" type="number" name="izin" min="0" max="366" required
                               value="{{ old('izin', $kehadiran?->izin ?? 0) }}"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="tanpa_keterangan" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                            Tanpa Keterangan (hari)
                        </label>
                        <input id="tanpa_keterangan" type="number" name="tanpa_keterangan" min="0" max="366" required
                               value="{{ old('tanpa_keterangan', $kehadiran?->tanpa_keterangan ?? 0) }}"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <button type="submit"
                        class="mt-5 px-5 py-3 rounded-xl bg-blue-600 text-white text-sm font-bold hover:bg-blue-700 transition">
                    Simpan Kehadiran
                </button>
            </form>
        </div>

        {{-- FORM EKSTRAKURIKULER --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm p-6 mb-6">
            <div class="mb-5">
                <h3 class="text-lg font-extrabold text-slate-900 dark:text-white">
                    Ekstrakurikuler Siswa
                </h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Tambahkan kegiatan ekstrakurikuler, pilih predikat, dan isi keterangan jika ada.
                </p>
            </div>

            <form action="{{ route('guru.rapor.ekstrakurikuler.simpan') }}" method="POST">
                @csrf
                <input type="hidden" name="id_siswa" value="{{ $siswa->id_siswa }}">
                <input type="hidden" name="id_rapor" value="{{ $rapor->id_rapor }}">

                <div id="daftar-ekskul" class="space-y-4">
                    @forelse($ekstrakurikulerList as $index => $ekskul)
                        <div class="ekskul-row rounded-xl border border-slate-200 dark:border-slate-700 p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                        Nama Ekstrakurikuler
                                    </label>
                                    <input type="text"
                                           name="ekstrakurikuler[{{ $index }}][nama]"
                                           maxlength="100"
                                           value="{{ $ekskul->nama_ekstrakurikuler }}"
                                           placeholder="Contoh: Pramuka"
                                           class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                        Predikat
                                    </label>
                                    <select name="ekstrakurikuler[{{ $index }}][predikat]"
                                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">-- Pilih predikat --</option>
                                        <option value="Sangat Baik" {{ $ekskul->predikat === 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                                        <option value="Baik" {{ $ekskul->predikat === 'Baik' ? 'selected' : '' }}>Baik</option>
                                        <option value="Cukup Baik" {{ $ekskul->predikat === 'Cukup Baik' ? 'selected' : '' }}>Cukup Baik</option>
                                        <option value="Kurang" {{ $ekskul->predikat === 'Kurang' ? 'selected' : '' }}>Kurang</option>
                                    </select>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                        Keterangan
                                    </label>
                                    <textarea name="ekstrakurikuler[{{ $index }}][keterangan]"
                                              rows="2"
                                              maxlength="2000"
                                              placeholder="Keterangan kegiatan (opsional)"
                                              class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $ekskul->keterangan }}</textarea>
                                </div>
                            </div>

                            <button type="button"
                                    class="hapus-ekskul mt-3 text-sm font-bold text-red-600 hover:text-red-700">
                                Hapus baris
                            </button>
                        </div>
                    @empty
                        <div class="ekskul-row rounded-xl border border-slate-200 dark:border-slate-700 p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                        Nama Ekstrakurikuler
                                    </label>
                                    <input type="text"
                                           name="ekstrakurikuler[0][nama]"
                                           maxlength="100"
                                           placeholder="Contoh: Pramuka"
                                           class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                        Predikat
                                    </label>
                                    <select name="ekstrakurikuler[0][predikat]"
                                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">-- Pilih predikat --</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Cukup Baik">Cukup Baik</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                        Keterangan
                                    </label>
                                    <textarea name="ekstrakurikuler[0][keterangan]"
                                              rows="2"
                                              maxlength="2000"
                                              placeholder="Keterangan kegiatan (opsional)"
                                              class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                                </div>
                            </div>

                            <button type="button"
                                    class="hapus-ekskul mt-3 text-sm font-bold text-red-600 hover:text-red-700">
                                Hapus baris
                            </button>
                        </div>
                    @endforelse
                </div>

                <div class="flex flex-col sm:flex-row gap-3 mt-5">
                    <button type="button" id="tambah-ekskul"
                            class="px-5 py-3 rounded-xl border border-blue-200 dark:border-blue-500/30 text-blue-700 dark:text-blue-300 text-sm font-bold hover:bg-blue-50 dark:hover:bg-blue-500/10 transition">
                        + Tambah Ekstrakurikuler
                    </button>

                    <button type="submit"
                            class="px-5 py-3 rounded-xl bg-blue-600 text-white text-sm font-bold hover:bg-blue-700 transition">
                        Simpan Ekstrakurikuler
                    </button>
                </div>
            </form>
        </div>

        {{-- TEMPLATE BARIS EKSTRAKURIKULER --}}
        <template id="template-ekskul">
            <div class="ekskul-row rounded-xl border border-slate-200 dark:border-slate-700 p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                            Nama Ekstrakurikuler
                        </label>
                        <input type="text"
                               name="ekstrakurikuler[__INDEX__][nama]"
                               maxlength="100"
                               placeholder="Contoh: Pramuka"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                            Predikat
                        </label>
                        <select name="ekstrakurikuler[__INDEX__][predikat]"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Pilih predikat --</option>
                            <option value="Sangat Baik">Sangat Baik</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup Baik">Cukup Baik</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                            Keterangan
                        </label>
                        <textarea name="ekstrakurikuler[__INDEX__][keterangan]"
                                  rows="2"
                                  maxlength="2000"
                                  placeholder="Keterangan kegiatan (opsional)"
                                  class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                </div>

                <button type="button"
                        class="hapus-ekskul mt-3 text-sm font-bold text-red-600 hover:text-red-700">
                    Hapus baris
                </button>
            </div>
        </template>

        {{-- JAVASCRIPT TAMBAH/HAPUS BARIS --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const daftar = document.getElementById('daftar-ekskul');
                const template = document.getElementById('template-ekskul');
                const tombolTambah = document.getElementById('tambah-ekskul');

                if (!daftar || !template || !tombolTambah) {
                    return;
                }

                // TAMBAH BARIS EKSTRAKURIKULER
                tombolTambah.addEventListener('click', function () {
                    const jumlahBaris = daftar.querySelectorAll('.ekskul-row').length;

                    if (jumlahBaris >= 20) {
                        alert('Maksimal 20 baris ekstrakurikuler.');
                        return;
                    }

                    const html = template.innerHTML.replaceAll(
                        '__INDEX__',
                        String(Date.now()) + '_' + String(jumlahBaris)
                    );

                    daftar.insertAdjacentHTML('beforeend', html);
                });

                // HAPUS BARIS EKSTRAKURIKULER
                daftar.addEventListener('click', function (event) {
                    const tombolHapus = event.target.closest('.hapus-ekskul');

                    if (!tombolHapus) {
                        return;
                    }

                    const jumlahBaris = daftar.querySelectorAll('.ekskul-row').length;

                    // Minimal satu baris harus tetap tersedia.
                    if (jumlahBaris <= 1) {
                        alert('Minimal harus ada satu baris ekstrakurikuler.');
                        return;
                    }

                    const baris = tombolHapus.closest('.ekskul-row');

                    if (baris) {
                        baris.remove();
                    }
                });
            });
        </script>

    @else
        <div class="bg-blue-50 dark:bg-blue-500/10 border border-blue-100 dark:border-blue-500/20 rounded-2xl p-6 text-center">
            <p class="text-sm font-semibold text-blue-700 dark:text-blue-400">
                Pilih siswa terlebih dahulu untuk melihat nilai rapornya.
            </p>
        </div>
    @endif

    {{-- FOOTER --}}
    <p class="text-center text-xs text-slate-400 dark:text-slate-600 mt-8">
        © {{ date('Y') }} Sistem Akademik Mini
    </p>

</div>
@endsection