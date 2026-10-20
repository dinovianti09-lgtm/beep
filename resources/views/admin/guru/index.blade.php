@extends('layouts.admin')

@section('title', 'Data Guru - Sistem Akademik Mini')

@section('page-title', 'Data Guru')

@section('page-subtitle', 'Kelola data guru dan kelas yang diajar')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-800 dark:text-white">
                Data Guru
            </h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                Daftar guru, kelas yang diajar, status akun, dan status wali kelas.
            </p>
        </div>

        <div class="flex flex-col gap-2 sm:flex-row">
            <a href="{{ route('admin.guru.export', request()->only('search')) }}"
               class="inline-flex items-center justify-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-3 text-sm font-bold text-emerald-700 shadow-sm transition hover:bg-emerald-100 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-300 dark:hover:bg-emerald-500/20">
                <span>📊</span>
                Export Excel
            </a>

            <a href="{{ route('admin.guru.create') }}"
               class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-blue-700">
                <span class="text-lg">+</span>
                Tambah Guru
            </a>
        </div>
    </div>

    {{-- NOTIFIKASI SUKSES --}}
    @if(session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-semibold text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- NOTIFIKASI ERROR --}}
    @if(session('error'))
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm font-semibold text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-300">
            {{ session('error') }}
        </div>
    @endif

    {{-- HASIL RESET PASSWORD --}}
    @if(session('reset_password_result'))
        @php
            $hasilReset = session('reset_password_result');
        @endphp

        <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 shadow-sm dark:border-amber-500/20 dark:bg-amber-500/10">
            <div class="flex items-start gap-3">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-xl dark:bg-amber-500/20">
                    🔑
                </div>

                <div class="min-w-0 flex-1">
                    <h3 class="text-lg font-extrabold text-amber-900 dark:text-amber-200">
                        Password Guru Berhasil Direset
                    </h3>

                    <p class="mt-1 text-sm text-amber-800 dark:text-amber-300">
                        Berikan password sementara ini kepada guru yang bersangkutan.
                    </p>

                    <div class="mt-4 rounded-xl border border-amber-200 bg-white p-4 dark:border-amber-500/20 dark:bg-slate-900">
                        <div class="grid gap-3 sm:grid-cols-2">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                    Nama Guru
                                </p>
                                <p class="mt-1 font-bold text-slate-800 dark:text-white">
                                    {{ $hasilReset['nama'] ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                    NIP
                                </p>
                                <p class="mt-1 font-bold text-slate-800 dark:text-white">
                                    {{ $hasilReset['nip'] ?? '-' }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="passwordSementaraGuru"
                                   class="block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                Password Sementara
                            </label>

                            <div class="mt-2 flex flex-col gap-2 sm:flex-row">
                                <input id="passwordSementaraGuru"
                                       type="text"
                                       readonly
                                       value="{{ $hasilReset['password'] ?? '' }}"
                                       class="min-w-0 flex-1 rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 font-mono text-sm font-bold text-slate-800 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                                <button type="button"
                                        onclick="salinPasswordGuru()"
                                        class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-blue-700">
                                    Salin Password
                                </button>
                            </div>

                            <p id="statusSalinPasswordGuru"
                               class="mt-2 text-xs font-semibold text-slate-500 dark:text-slate-400"
                               aria-live="polite">
                                Simpan password ini sebelum meninggalkan halaman.
                            </p>
                        </div>

                        <div class="mt-4 rounded-lg bg-amber-50 p-3 text-sm text-amber-800 dark:bg-amber-500/10 dark:text-amber-200">
                            Guru harus mengganti password setelah berhasil login jika sistem login sudah menerapkan kewajiban ganti password.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- IMPORT DATA GURU --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <div class="mb-5">
            <h3 class="text-lg font-extrabold text-slate-800 dark:text-white">
                Import Data Guru dari Excel
            </h3>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                Tambahkan banyak data guru sekaligus tanpa mengisi formulir satu per satu.
            </p>
        </div>

        <div class="mb-5 rounded-xl border border-blue-200 bg-blue-50 p-4 dark:border-blue-500/20 dark:bg-blue-500/10">
            <p class="text-sm font-bold text-blue-800 dark:text-blue-300">
                Petunjuk sebelum import
            </p>

            <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-blue-700 dark:text-blue-200">
                <li>Download template Excel terlebih dahulu.</li>
                <li>Isi kolom NIP, nama guru, mata pelajaran, dan kelas.</li>
                <li>Nama kelas harus sama persis dengan data di menu Data Kelas.</li>
                <li>Jika guru mengajar beberapa kelas, pisahkan nama kelas dengan koma.</li>
                <li>NIP tidak boleh sama dengan NIP guru lain atau username akun yang sudah terdaftar.</li>
                <li>Import hanya menambahkan data Guru. Guru dapat membuat akun sendiri melalui Register menggunakan NIP.</li>
                <li>File yang didukung: XLSX, XLS, atau CSV, maksimal 5 MB.</li>
            </ul>
        </div>

        <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
            <div class="flex-1">
                <p class="mb-2 text-sm font-bold text-slate-700 dark:text-slate-200">
                    Langkah 1 — Download template
                </p>

                <p class="mb-3 text-sm text-slate-500 dark:text-slate-400">
                    Gunakan format kolom yang sudah disediakan agar data terbaca dengan benar.
                </p>

                <a href="{{ route('admin.guru.template') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-xl border border-blue-200 bg-blue-50 px-4 py-3 text-sm font-bold text-blue-700 transition hover:bg-blue-100 dark:border-blue-500/20 dark:bg-blue-500/10 dark:text-blue-300 dark:hover:bg-blue-500/20">
                    <span>📥</span>
                    Download Template Excel
                </a>
            </div>

            <div class="flex-1">
                <p class="mb-2 text-sm font-bold text-slate-700 dark:text-slate-200">
                    Langkah 2 — Upload file
                </p>

                <form action="{{ route('admin.guru.import') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      onsubmit="return confirm('Yakin ingin mengimport data guru dari file ini?')">
                    @csrf

                    <input type="file"
                           name="file"
                           accept=".xlsx,.xls,.csv"
                           required
                           class="block w-full rounded-xl border border-slate-300 bg-slate-50 p-3 text-sm text-slate-700 file:mr-3 file:rounded-lg file:border-0 file:bg-blue-100 file:px-3 file:py-2 file:text-sm file:font-bold file:text-blue-700 hover:file:bg-blue-200 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200 dark:file:bg-slate-800 dark:file:text-blue-300">

                    @error('file')
                        <p class="mt-2 text-sm font-semibold text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                    <button type="submit"
                            class="mt-3 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-emerald-700 sm:w-auto">
                        <span>📤</span>
                        Import Data Guru
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- LAPORAN BARIS YANG GAGAL DIIMPORT --}}
    @if(session('import_errors'))
        <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 dark:border-amber-500/20 dark:bg-amber-500/10">
            <h3 class="font-extrabold text-amber-800 dark:text-amber-300">
                Periksa Data yang Belum Berhasil Diimport
            </h3>

            <p class="mt-1 text-sm text-amber-700 dark:text-amber-200">
                Sebagian baris mungkin dilewati karena data tidak lengkap, NIP sudah digunakan, atau nama kelas tidak ditemukan.
            </p>

            <div class="mt-4 space-y-2">
                @foreach(session('import_errors') as $error)
                    <div class="rounded-lg border border-amber-200 bg-white p-3 text-sm dark:border-amber-500/20 dark:bg-slate-900">
                        <p class="font-bold text-slate-800 dark:text-white">
                            Baris {{ $error['baris'] ?? '-' }}
                        </p>
                        <p class="mt-1 text-slate-600 dark:text-slate-300">
                            {{ $error['pesan'] ?? 'Data tidak dapat diimport.' }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- PENCARIAN --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <form action="{{ route('admin.guru.index') }}"
              method="GET"
              class="flex flex-col gap-3 sm:flex-row">

            <div class="relative flex-1">
                <input type="text"
                       name="search"
                       value="{{ $search ?? request('search') }}"
                       placeholder="Cari nama guru, NIP, atau mata pelajaran..."
                       class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:focus:ring-blue-900">
            </div>

            <button type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 text-sm font-bold text-white transition hover:bg-blue-700">
                Cari
            </button>

            @if(request('search'))
                <a href="{{ route('admin.guru.index') }}"
                   class="rounded-xl border border-slate-300 px-5 py-3 text-center text-sm font-bold text-slate-600 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- TABEL DATA GURU --}}
    <div class="overflow-hidden rounded-2xl border border-slate-300 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

        <div class="flex flex-col gap-1 border-b border-slate-300 px-5 py-4 dark:border-slate-700 sm:flex-row sm:items-center sm:justify-between">
            <h3 class="font-bold text-slate-800 dark:text-white">
                Daftar Guru
            </h3>

            <p class="text-sm text-slate-500 dark:text-slate-400">
                Total hasil: {{ $guruList->count() }} guru
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[1400px] border-collapse border border-slate-300 text-left text-sm dark:border-slate-700">

                <thead class="bg-slate-100 text-xs uppercase tracking-wider text-slate-600 dark:bg-slate-950 dark:text-slate-300">
                    <tr>
                        <th class="border border-slate-300 px-4 py-4 dark:border-slate-700">No.</th>
                        <th class="border border-slate-300 px-4 py-4 dark:border-slate-700">NIP</th>
                        <th class="border border-slate-300 px-4 py-4 dark:border-slate-700">Nama Guru</th>
                        <th class="border border-slate-300 px-4 py-4 dark:border-slate-700">Mata Pelajaran</th>
                        <th class="border border-slate-300 px-4 py-4 dark:border-slate-700">Kelas yang Diajar</th>
                        <th class="border border-slate-300 px-4 py-4 dark:border-slate-700">Status Akun</th>
                        <th class="border border-slate-300 px-4 py-4 dark:border-slate-700">Status Wali Kelas</th>
                        <th class="border border-slate-300 px-4 py-4 dark:border-slate-700">Kelas yang Diwakili</th>
                        <th class="border border-slate-300 px-4 py-4 text-center dark:border-slate-700">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-slate-700 dark:text-slate-200">
                    @forelse($guruList as $guru)
                        @php
                            $statusAkunGuru = strtolower(trim($guru->status_akun ?? 'tanpa akun'));

                            $punyaAkunAktif = in_array(
                                $statusAkunGuru,
                                ['aktif', 'nonaktif'],
                                true
                            );

                            $akunAktif = $statusAkunGuru === 'aktif';

                            $belumAktivasi = $statusAkunGuru === 'belum aktif';
                        @endphp

                        <tr class="transition hover:bg-slate-50 dark:hover:bg-slate-800/50">

                            <td class="whitespace-nowrap border border-slate-300 px-4 py-4 text-slate-500 dark:border-slate-700 dark:text-slate-400">
                                {{ $loop->iteration }}
                            </td>

                            <td class="whitespace-nowrap border border-slate-300 px-4 py-4 font-semibold dark:border-slate-700">
                                {{ $guru->nip ?: '-' }}
                            </td>

                            <td class="border border-slate-300 px-4 py-4 dark:border-slate-700">
                                <div class="font-bold text-slate-800 dark:text-white">
                                    {{ $guru->nama_guru }}
                                </div>
                            </td>

                            <td class="border border-slate-300 px-4 py-4 dark:border-slate-700">
                                {{ $guru->mapel_diampu ?: '-' }}
                            </td>

                            {{-- KELAS YANG DIAJAR --}}
                            <td class="border border-slate-300 px-4 py-4 dark:border-slate-700">
                                @if($guru->kelasDiajar && $guru->kelasDiajar->count())
                                    <div class="flex max-w-xs flex-wrap gap-1.5">
                                        @foreach($guru->kelasDiajar as $kelas)
                                            <span class="rounded-lg bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700 dark:bg-blue-500/10 dark:text-blue-300">
                                                {{ $kelas->nama_kelas }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-slate-400">Belum ada kelas</span>
                                @endif
                            </td>

                            {{-- STATUS AKUN --}}
                            <td class="whitespace-nowrap border border-slate-300 px-4 py-4 dark:border-slate-700">
                                @if($statusAkunGuru === 'aktif')
                                    <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">
                                        Aktif
                                    </span>
                                @elseif($statusAkunGuru === 'nonaktif')
                                    <span class="inline-flex rounded-full bg-red-50 px-3 py-1.5 text-xs font-bold text-red-700 dark:bg-red-500/10 dark:text-red-300">
                                        Nonaktif
                                    </span>
                                @elseif($belumAktivasi)
                                    <span class="inline-flex rounded-full bg-amber-50 px-3 py-1.5 text-xs font-bold text-amber-700 dark:bg-amber-500/10 dark:text-amber-300">
                                        Belum Aktivasi
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-slate-100 px-3 py-1.5 text-xs font-bold text-slate-600 dark:bg-slate-800 dark:text-slate-300">
                                        Belum Ada Akun
                                    </span>
                                @endif
                            </td>

                            {{-- STATUS WALI KELAS --}}
                            <td class="whitespace-nowrap border border-slate-300 px-4 py-4 dark:border-slate-700">
                                @if($guru->status_wali_kelas)
                                    <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">
                                        Wali Kelas
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-slate-100 px-3 py-1.5 text-xs font-bold text-slate-600 dark:bg-slate-800 dark:text-slate-300">
                                        Belum menjadi wali kelas
                                    </span>
                                @endif
                            </td>

                            {{-- KELAS YANG DIWAKILI --}}
                            <td class="border border-slate-300 px-4 py-4 dark:border-slate-700">
                                @if($guru->status_wali_kelas && $guru->nama_kelas_wali)
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach(explode(', ', $guru->nama_kelas_wali) as $namaKelasWali)
                                            <span class="rounded-lg bg-purple-50 px-2.5 py-1 text-xs font-semibold text-purple-700 dark:bg-purple-500/10 dark:text-purple-300">
                                                {{ $namaKelasWali }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-slate-400">
                                        Belum ditugaskan
                                    </span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td class="border border-slate-300 px-4 py-4 dark:border-slate-700">
                                <div class="flex min-w-[140px] flex-col items-stretch justify-center gap-2">

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.guru.edit', $guru->id_guru) }}"
                                       class="rounded-lg bg-amber-50 px-3 py-2 text-center text-xs font-bold text-amber-700 transition hover:bg-amber-100 dark:bg-amber-500/10 dark:text-amber-300 dark:hover:bg-amber-500/20">
                                        Edit
                                    </a>

                                    {{-- AKUN SUDAH AKTIF ATAU NONAKTIF --}}
                                    @if($punyaAkunAktif)

                                        <form action="{{ route('admin.guru.resetPassword', $guru->id_guru) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin mereset password guru ini? Password sementara yang baru akan dibuat.')">
                                            @csrf

                                            <button type="submit"
                                                    class="w-full rounded-lg bg-blue-50 px-3 py-2 text-xs font-bold text-blue-700 transition hover:bg-blue-100 dark:bg-blue-500/10 dark:text-blue-300 dark:hover:bg-blue-500/20">
                                                Reset Password
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.guru.toggleStatus', $guru->id_guru) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin {{ $akunAktif ? 'menonaktifkan' : 'mengaktifkan kembali' }} akun guru ini?')">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                    class="w-full rounded-lg px-3 py-2 text-xs font-bold transition {{ $akunAktif ? 'bg-red-50 text-red-700 hover:bg-red-100 dark:bg-red-500/10 dark:text-red-300 dark:hover:bg-red-500/20' : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-300 dark:hover:bg-emerald-500/20' }}">
                                                {{ $akunAktif ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>

                                    {{-- AKUN SUDAH TERHUBUNG TAPI BELUM AKTIVASI --}}
                                    @elseif($belumAktivasi)
                                        <span class="rounded-lg bg-amber-50 px-3 py-2 text-center text-xs font-semibold text-amber-700 dark:bg-amber-500/10 dark:text-amber-300">
                                            Menunggu Aktivasi
                                        </span>

                                    {{-- BELUM PUNYA AKUN --}}
                                    @else
                                        <span class="rounded-lg bg-slate-100 px-3 py-2 text-center text-xs font-semibold text-slate-500 dark:bg-slate-800 dark:text-slate-400">
                                            Belum Ada Akun
                                        </span>
                                    @endif

                                    {{-- HAPUS --}}
                                    <form action="{{ route('admin.guru.destroy', $guru->id_guru) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus data Guru {{ addslashes($guru->nama_guru) }}? Jika akun sudah terhubung, akun login Guru tersebut juga akan dihapus.')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="w-full rounded-lg bg-red-50 px-3 py-2 text-xs font-bold text-red-700 transition hover:bg-red-100 dark:bg-red-500/10 dark:text-red-300 dark:hover:bg-red-500/20">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="border border-slate-300 px-4 py-12 text-center dark:border-slate-700">
                                <div class="text-3xl">📋</div>

                                <p class="mt-3 font-bold text-slate-700 dark:text-slate-200">
                                    Data guru belum ditemukan
                                </p>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    @if(request('search'))
                                        Coba kata kunci pencarian yang berbeda.
                                    @else
                                        Belum ada data guru yang tersedia.
                                    @endif
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>

<script>
    async function salinPasswordGuru() {
        const field = document.getElementById('passwordSementaraGuru');
        const status = document.getElementById('statusSalinPasswordGuru');

        if (!field || !status) {
            return;
        }

        try {
            if (navigator.clipboard && window.isSecureContext) {
                await navigator.clipboard.writeText(field.value);
            } else {
                field.focus();
                field.select();
                field.setSelectionRange(0, field.value.length);

                const berhasil = document.execCommand('copy');

                if (!berhasil) {
                    throw new Error('Penyalinan otomatis gagal');
                }
            }

            status.textContent = 'Password berhasil disalin!';
            status.className = 'mt-2 text-xs font-semibold text-emerald-600 dark:text-emerald-400';
        } catch (error) {
            field.focus();
            field.select();

            status.textContent = 'Password sudah dipilih. Tekan Ctrl+C untuk menyalin.';
            status.className = 'mt-2 text-xs font-semibold text-amber-600 dark:text-amber-400';
        }
    }
</script>

@endsection