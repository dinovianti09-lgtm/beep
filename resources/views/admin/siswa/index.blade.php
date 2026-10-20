@extends('layouts.admin')

@section('title', 'Data Siswa - Sistem Akademik Mini')
@section('page-title', 'Data Siswa')
@section('page-subtitle', 'Kelola data siswa berdasarkan kelas')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-800 dark:text-white">
                Data Siswa
            </h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                Daftar siswa, kelas, jenis kelamin, dan status akun login.
            </p>
        </div>

        <div class="flex flex-col gap-2 sm:flex-row">
            <a href="{{ route('admin.siswa.export', request()->only(['search', 'kelas'])) }}"
               class="inline-flex items-center justify-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-3 text-sm font-bold text-emerald-700 shadow-sm transition hover:bg-emerald-100 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-300 dark:hover:bg-emerald-500/20">
                <span>📊</span>
                Export Excel
            </a>

            <a href="{{ route('admin.siswa.create') }}"
               class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-blue-700">
                <span class="text-lg">+</span>
                Tambah Siswa
            </a>
        </div>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-semibold text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

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
                        Password Siswa Berhasil Direset
                    </h3>

                    <p class="mt-1 text-sm text-amber-800 dark:text-amber-300">
                        Berikan password sementara ini kepada siswa yang bersangkutan.
                    </p>

                    <div class="mt-4 rounded-xl border border-amber-200 bg-white p-4 dark:border-amber-500/20 dark:bg-slate-900">
                        <div class="grid gap-3 sm:grid-cols-2">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                    Nama Siswa
                                </p>
                                <p class="mt-1 font-bold text-slate-800 dark:text-white">
                                    {{ $hasilReset['nama'] ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                    NIS
                                </p>
                                <p class="mt-1 font-bold text-slate-800 dark:text-white">
                                    {{ $hasilReset['nis'] ?? '-' }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="passwordSementaraSiswa"
                                   class="block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                Password Sementara
                            </label>

                            <div class="mt-2 flex flex-col gap-2 sm:flex-row">
                                <input id="passwordSementaraSiswa"
                                       type="text"
                                       readonly
                                       value="{{ $hasilReset['password'] ?? '' }}"
                                       onclick="this.select()"
                                       class="min-w-0 flex-1 rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 font-mono text-sm font-bold text-slate-800 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                                <button type="button"
                                        onclick="salinPasswordSiswa()"
                                        class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-blue-700">
                                    Salin Password
                                </button>
                            </div>

                            <p id="statusSalinPasswordSiswa"
                               class="mt-2 text-xs font-semibold text-slate-500 dark:text-slate-400"
                               aria-live="polite">
                                Simpan password ini sebelum meninggalkan halaman.
                            </p>
                        </div>

                        <div class="mt-4 rounded-lg bg-amber-50 p-3 text-sm text-amber-800 dark:bg-amber-500/10 dark:text-amber-200">
                            Siswa harus mengganti password setelah berhasil login.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- IMPORT DATA SISWA --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <div class="mb-5">
            <h3 class="text-lg font-extrabold text-slate-800 dark:text-white">
                Import Data Siswa dari Excel
            </h3>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                Tambahkan banyak data siswa sekaligus tanpa mengisi formulir satu per satu.
            </p>
        </div>

        <div class="mb-5 rounded-xl border border-blue-200 bg-blue-50 p-4 dark:border-blue-500/20 dark:bg-blue-500/10">
            <p class="text-sm font-bold text-blue-800 dark:text-blue-300">
                Petunjuk sebelum import
            </p>

            <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-blue-700 dark:text-blue-200">
                <li>Download template Excel terlebih dahulu.</li>
                <li>Isi kolom sesuai format template.</li>
                <li>Pastikan NIS terisi dan belum terdaftar.</li>
                <li>Nama kelas harus sesuai dengan data di menu Data Kelas.</li>
                <li>Jangan mengubah nama kolom pada template.</li>
                <li>Format yang didukung: XLSX, XLS, atau CSV, maksimal 5 MB.</li>
            </ul>
        </div>

        <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
            <div class="flex-1">
                <p class="mb-2 text-sm font-bold text-slate-700 dark:text-slate-200">
                    Langkah 1 — Download template
                </p>

                <p class="mb-3 text-sm text-slate-500 dark:text-slate-400">
                    Gunakan format kolom yang telah disediakan.
                </p>

                <a href="{{ route('admin.siswa.template') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-xl border border-blue-200 bg-blue-50 px-4 py-3 text-sm font-bold text-blue-700 transition hover:bg-blue-100 dark:border-blue-500/20 dark:bg-blue-500/10 dark:text-blue-300 dark:hover:bg-blue-500/20">
                    📥 Download Template Excel
                </a>
            </div>

            <div class="flex-1">
                <p class="mb-2 text-sm font-bold text-slate-700 dark:text-slate-200">
                    Langkah 2 — Upload file
                </p>

                <form action="{{ route('admin.siswa.import') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      onsubmit="return confirm('Yakin ingin mengimport data siswa dari file ini?')">
                    @csrf

                    <input type="file"
                           id="file_excel"
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
                        📤 Import Data Siswa
                    </button>
                </form>
            </div>
        </div>

        <p class="mt-4 text-xs text-slate-500 dark:text-slate-400">
            Catatan: NIS yang sudah terdaftar akan dilewati. Periksa data dan nama kelas sebelum mengunggah file.
        </p>
    </div>

    {{-- LAPORAN IMPORT --}}
    @if(session('import_errors'))
        <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 dark:border-amber-500/20 dark:bg-amber-500/10">
            <h3 class="font-extrabold text-amber-800 dark:text-amber-300">
                Periksa Data yang Belum Berhasil Diimport
            </h3>

            <p class="mt-1 text-sm text-amber-700 dark:text-amber-200">
                Sebagian data mungkin dilewati karena NIS sudah terdaftar atau datanya tidak sesuai.
            </p>

            <div class="mt-4 space-y-2">
                @foreach(session('import_errors') as $error)
                    <div class="rounded-lg border border-amber-200 bg-white p-3 text-sm dark:border-amber-500/20 dark:bg-slate-900">
                        @if(is_array($error))
                            <p class="font-bold text-slate-800 dark:text-white">
                                Baris {{ $error['baris'] ?? '-' }}
                            </p>
                            <p class="mt-1 text-slate-600 dark:text-slate-300">
                                {{ $error['pesan'] ?? json_encode($error) }}
                            </p>
                        @else
                            <p class="text-slate-600 dark:text-slate-300">{{ $error }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- PENCARIAN DAN FILTER --}}
    @php
        $search = trim(request('search', ''));
        $kelasTerpilih = trim(request('kelas', ''));
        $siswaHasil = $siswaList;

        if ($search !== '') {
            $keyword = mb_strtolower($search);

            $siswaHasil = $siswaHasil->filter(function ($siswa) use ($keyword) {
                return str_contains(mb_strtolower($siswa->nama_siswa ?? ''), $keyword)
                    || str_contains(mb_strtolower($siswa->nis ?? ''), $keyword)
                    || str_contains(mb_strtolower($siswa->kelas ?? ''), $keyword);
            });
        }

        if ($kelasTerpilih !== '') {
            $filterKelas = mb_strtolower($kelasTerpilih);

            $siswaHasil = $siswaHasil->filter(function ($siswa) use ($filterKelas) {
                return mb_strtolower($siswa->kelas ?? '') === $filterKelas;
            });
        }
    @endphp

    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <form action="{{ route('admin.siswa.index') }}"
              method="GET"
              class="flex flex-col gap-3 lg:flex-row">

            <div class="relative flex-1">
                <input type="text"
                       name="search"
                       value="{{ $search }}"
                       placeholder="Cari nama siswa, NIS, atau kelas..."
                       class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:focus:ring-blue-900">
            </div>

            <div class="lg:w-56">
                <select name="kelas"
                        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:focus:ring-blue-900">
                    <option value="">Semua Kelas</option>

                    @foreach($kelasList as $kelas)
                        <option value="{{ $kelas->nama_kelas }}"
                            {{ mb_strtolower($kelasTerpilih) === mb_strtolower($kelas->nama_kelas) ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 text-sm font-bold text-white transition hover:bg-blue-700">
                Cari
            </button>

            @if($search !== '' || $kelasTerpilih !== '')
                <a href="{{ route('admin.siswa.index') }}"
                   class="rounded-xl border border-slate-300 px-5 py-3 text-center text-sm font-bold text-slate-600 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                    Reset
                </a>
            @endif
        </form>

        @if($search !== '' || $kelasTerpilih !== '')
            <p class="mt-4 border-t border-slate-100 pt-4 text-xs text-slate-500 dark:border-slate-700 dark:text-slate-400">
                Menampilkan
                <strong class="text-slate-800 dark:text-slate-100">{{ $siswaHasil->count() }}</strong>
                siswa
                @if($search !== '')
                    untuk pencarian <strong>"{{ $search }}"</strong>
                @endif
                @if($kelasTerpilih !== '')
                    pada kelas <strong>"{{ $kelasTerpilih }}"</strong>
                @endif
            </p>
        @endif
    </div>

    {{-- TABEL DATA SISWA --}}
    <div class="overflow-hidden rounded-2xl border border-slate-300 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

        <div class="flex flex-col gap-1 border-b border-slate-300 px-5 py-4 dark:border-slate-700 sm:flex-row sm:items-center sm:justify-between">
            <h3 class="font-bold text-slate-800 dark:text-white">
                Daftar Siswa
            </h3>

            <p class="text-sm text-slate-500 dark:text-slate-400">
                Total hasil: {{ $siswaHasil->count() }} siswa
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[1250px] border-collapse border border-slate-300 text-left text-sm dark:border-slate-700">

                <thead class="bg-slate-100 text-xs uppercase tracking-wider text-slate-600 dark:bg-slate-950 dark:text-slate-300">
                    <tr>
                        <th class="whitespace-nowrap border border-slate-300 px-4 py-4 dark:border-slate-700">No.</th>
                        <th class="whitespace-nowrap border border-slate-300 px-4 py-4 dark:border-slate-700">NIS</th>
                        <th class="border border-slate-300 px-4 py-4 dark:border-slate-700">Nama Siswa</th>
                        <th class="border border-slate-300 px-4 py-4 dark:border-slate-700">Kelas</th>
                        <th class="border border-slate-300 px-4 py-4 dark:border-slate-700">Jenis Kelamin</th>
                        <th class="whitespace-nowrap border border-slate-300 px-4 py-4 dark:border-slate-700">Status Akun</th>
                        <th class="border border-slate-300 px-4 py-4 text-center dark:border-slate-700">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-slate-700 dark:text-slate-200">
                    @forelse($siswaHasil as $index => $siswa)
                        @php
                            $statusAkun = mb_strtolower(trim($siswa->status_akun ?? 'tanpa akun'));

                            $akunAktif = $statusAkun === 'aktif';
                            $akunNonaktif = $statusAkun === 'nonaktif';
                            $akunSudahAktivasi = $akunAktif || $akunNonaktif;

                            $akunBelumAktivasi = in_array(
                                $statusAkun,
                                ['belum aktif', 'belum aktivasi', 'pending'],
                                true
                            );
                        @endphp

                        <tr class="transition hover:bg-slate-50 dark:hover:bg-slate-800/50">

                            <td class="whitespace-nowrap border border-slate-300 px-4 py-4 text-slate-500 dark:border-slate-700 dark:text-slate-400">
                                {{ $index + 1 }}
                            </td>

                            <td class="whitespace-nowrap border border-slate-300 px-4 py-4 font-semibold dark:border-slate-700">
                                {{ $siswa->nis ?: '-' }}
                            </td>

                            <td class="border border-slate-300 px-4 py-4 dark:border-slate-700">
                                <div class="font-bold text-slate-800 dark:text-white">
                                    {{ $siswa->nama_siswa }}
                                </div>
                            </td>

                            <td class="border border-slate-300 px-4 py-4 dark:border-slate-700">
                                @if($siswa->kelas)
                                    <span class="inline-flex rounded-lg bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700 dark:bg-blue-500/10 dark:text-blue-300">
                                        {{ $siswa->kelas }}
                                    </span>
                                @else
                                    <span class="text-slate-400">Belum ada kelas</span>
                                @endif
                            </td>

                            <td class="whitespace-nowrap border border-slate-300 px-4 py-4 dark:border-slate-700">
                                @if($siswa->jenis_kelamin === 'L')
                                    Laki-laki
                                @elseif($siswa->jenis_kelamin === 'P')
                                    Perempuan
                                @else
                                    {{ $siswa->jenis_kelamin ?: '-' }}
                                @endif
                            </td>

                            {{-- STATUS AKUN --}}
                            <td class="whitespace-nowrap border border-slate-300 px-4 py-4 dark:border-slate-700">
                                @if($akunAktif)
                                    <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">
                                        Aktif
                                    </span>
                                @elseif($akunNonaktif)
                                    <span class="inline-flex rounded-full bg-red-50 px-3 py-1.5 text-xs font-bold text-red-700 dark:bg-red-500/10 dark:text-red-300">
                                        Nonaktif
                                    </span>
                                @elseif($akunBelumAktivasi)
                                    <span class="inline-flex rounded-full bg-amber-50 px-3 py-1.5 text-xs font-bold text-amber-700 dark:bg-amber-500/10 dark:text-amber-300">
                                        Belum Aktivasi
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-slate-100 px-3 py-1.5 text-xs font-bold text-slate-600 dark:bg-slate-800 dark:text-slate-300">
                                        Belum Ada Akun
                                    </span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td class="border border-slate-300 px-4 py-4 dark:border-slate-700">
                                <div class="flex min-w-[140px] flex-col items-stretch justify-center gap-2">

                                    <a href="{{ route('admin.siswa.edit', $siswa->id_siswa) }}"
                                       class="rounded-lg bg-amber-50 px-3 py-2 text-center text-xs font-bold text-amber-700 transition hover:bg-amber-100 dark:bg-amber-500/10 dark:text-amber-300 dark:hover:bg-amber-500/20">
                                        Edit
                                    </a>

                                    @if($akunSudahAktivasi)
                                        <form action="{{ route('admin.siswa.resetPassword', $siswa->id_siswa) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin mereset password siswa ini?')">
                                            @csrf

                                            <button type="submit"
                                                    class="w-full rounded-lg bg-blue-50 px-3 py-2 text-xs font-bold text-blue-700 transition hover:bg-blue-100 dark:bg-blue-500/10 dark:text-blue-300 dark:hover:bg-blue-500/20">
                                                Reset Password
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.siswa.toggleStatus', $siswa->id_siswa) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin {{ $akunAktif ? 'menonaktifkan' : 'mengaktifkan kembali' }} akun siswa ini?')">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                    class="w-full rounded-xl px-3 py-2 text-xs font-bold transition {{ $akunAktif ? 'bg-red-50 text-red-700 hover:bg-red-100 dark:bg-red-500/10 dark:text-red-300 dark:hover:bg-red-500/20' : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-300 dark:hover:bg-emerald-500/20' }}">
                                                {{ $akunAktif ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>
                                    @elseif($akunBelumAktivasi)
                                        <span class="rounded-lg bg-amber-50 px-3 py-2 text-center text-xs font-semibold text-amber-700 dark:bg-amber-500/10 dark:text-amber-300">
                                            Belum Aktivasi
                                        </span>
                                    @else
                                        <span class="rounded-lg bg-slate-100 px-3 py-2 text-center text-xs font-semibold text-slate-500 dark:bg-slate-800 dark:text-slate-400">
                                            Belum Ada Akun
                                        </span>
                                    @endif

                                    <form action="{{ route('admin.siswa.destroy', $siswa->id_siswa) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus data siswa {{ addslashes($siswa->nama_siswa) }}? Jika siswa memiliki nilai atau rapor, penghapusan akan ditolak.')">
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
                            <td colspan="7" class="border border-slate-300 px-4 py-12 text-center dark:border-slate-700">
                                <div class="text-3xl">📋</div>

                                <p class="mt-3 font-bold text-slate-700 dark:text-slate-200">
                                    Data siswa belum ditemukan
                                </p>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    @if($search !== '' || $kelasTerpilih !== '')
                                        Coba kata kunci atau filter kelas yang berbeda.
                                    @else
                                        Belum ada data siswa yang tersedia.
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
    async function salinPasswordSiswa() {
        const field = document.getElementById('passwordSementaraSiswa');
        const status = document.getElementById('statusSalinPasswordSiswa');

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