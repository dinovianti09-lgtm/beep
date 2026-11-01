
@extends('layouts.guru')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center gap-3">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-500/15 dark:text-blue-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m12 12a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
            </svg>
        </div>
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-800 dark:text-white">
                Pengaturan Bobot Nilai
            </h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Atur persentase nilai Harian, UTS, dan UAS untuk setiap periode rapor.
            </p>
        </div>
    </div>

    {{-- Notifikasi berhasil --}}
    @if (session('success'))
        <div class="flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800 dark:border-green-800/60 dark:bg-green-950/40 dark:text-green-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Error validasi --}}
    @if ($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800 dark:border-red-800/60 dark:bg-red-950/40 dark:text-red-300">
            <p class="font-semibold">Periksa kembali pengaturan:</p>
            <ul class="mt-2 list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Informasi mata pelajaran --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    Mata Pelajaran yang Diampu
                </p>
                <h2 class="mt-1 break-words text-xl font-bold text-gray-800 dark:text-white">
                    {{ $mapel->nama_mapel }}
                </h2>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Guru:
                    <span class="font-medium text-gray-700 dark:text-gray-300">
                        {{ $guru->nama_guru }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    {{-- Pilih periode rapor --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="mb-4 flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v14H4V6a1 1 0 011-1z" />
                </svg>
            </div>
            <div>
                <h2 class="font-semibold text-gray-800 dark:text-white">
                    Pilih Periode Rapor
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Tentukan semester dan tahun ajaran yang ingin diatur.
                </p>
            </div>
        </div>

        @if ($raporList->isEmpty())
            <div class="rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800 dark:border-amber-800/60 dark:bg-amber-950/30 dark:text-amber-300">
                Belum ada periode rapor. Tambahkan periode rapor terlebih dahulu.
            </div>
        @else
            <form method="GET" action="{{ route('guru.bobot-nilai.index') }}" class="flex flex-col gap-4 sm:flex-row sm:items-end">
                <div class="min-w-0 flex-1">
                    <label for="id_rapor" class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Semester / Tahun Ajaran
                    </label>

                    <select name="id_rapor" id="id_rapor" required
                            class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        @foreach ($raporList as $raporItem)
                            <option value="{{ $raporItem->id_rapor }}"
                                @selected(
                                    $raporTerpilih &&
                                    (int) $raporTerpilih->id_rapor === (int) $raporItem->id_rapor
                                )>
                                Semester {{ $raporItem->semester }} — {{ $raporItem->tahun_ajaran }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7l7 7-7 7" />
                    </svg>
                    Pilih Periode
                </button>
            </form>
        @endif
    </div>

    {{-- Form bobot nilai --}}
    @if ($raporTerpilih)
        @php
            $harian = old('bobot_harian', $bobot->bobot_harian ?? 30);
            $uts = old('bobot_uts', $bobot->bobot_uts ?? 30);
            $uas = old('bobot_uas', $bobot->bobot_uas ?? 40);
        @endphp

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">

            <div class="border-b border-gray-200 p-5 dark:border-gray-700">
                <h2 class="text-lg font-bold text-gray-800 dark:text-white">
                    Bobot Penilaian
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Periode: Semester {{ $raporTerpilih->semester }} — {{ $raporTerpilih->tahun_ajaran }}
                </p>
            </div>

            <div class="p-5">
                <form method="POST" action="{{ route('guru.bobot-nilai.update') }}">
                    @csrf

                    <input type="hidden" name="id_rapor" value="{{ $raporTerpilih->id_rapor }}">

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                        {{-- Nilai Harian --}}
                        <div class="rounded-xl border border-gray-200 p-4 transition hover:border-blue-300 dark:border-gray-700 dark:hover:border-blue-500">
                            <div class="mb-4 flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                                    </svg>
                                </div>
                                <div>
                                    <label for="bobot_harian" class="block font-semibold text-gray-800 dark:text-white">
                                        Nilai Harian
                                    </label>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        Tugas dan penilaian harian
                                    </p>
                                </div>
                            </div>

                            <div class="relative">
                                <input type="number" id="bobot_harian" name="bobot_harian" min="0" max="100" step="1" required value="{{ $harian }}"
                                       class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 pr-12 text-lg font-bold text-gray-800 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:bg-gray-700">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 font-semibold text-gray-500 dark:text-gray-400">%</span>
                            </div>
                        </div>

                        {{-- Nilai UTS --}}
                        <div class="rounded-xl border border-gray-200 p-4 transition hover:border-blue-300 dark:border-gray-700 dark:hover:border-blue-500">
                            <div class="mb-4 flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5h6m-7 4h8m-9 4h10m-9 4h8M6 3h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5a2 2 0 012-2z" />
                                    </svg>
                                </div>
                                <div>
                                    <label for="bobot_uts" class="block font-semibold text-gray-800 dark:text-white">
                                        Nilai UTS
                                    </label>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        Ujian tengah semester
                                    </p>
                                </div>
                            </div>

                            <div class="relative">
                                <input type="number" id="bobot_uts" name="bobot_uts" min="0" max="100" step="1" required value="{{ $uts }}"
                                       class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 pr-12 text-lg font-bold text-gray-800 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:bg-gray-700">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 font-semibold text-gray-500 dark:text-gray-400">%</span>
                            </div>
                        </div>

                        {{-- Nilai UAS --}}
                        <div class="rounded-xl border border-gray-200 p-4 transition hover:border-blue-300 dark:border-gray-700 dark:hover:border-blue-500">
                            <div class="mb-4 flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5-3.5A12 12 0 0112 3a12 12 0 01-8 3.5V12a12 12 0 008 9 12 12 0 008-9V7.5z" />
                                    </svg>
                                </div>
                                <div>
                                    <label for="bobot_uas" class="block font-semibold text-gray-800 dark:text-white">
                                        Nilai UAS
                                    </label>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        Ujian akhir semester
                                    </p>
                                </div>
                            </div>

                            <div class="relative">
                                <input type="number" id="bobot_uas" name="bobot_uas" min="0" max="100" step="1" required value="{{ $uas }}"
                                       class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 pr-12 text-lg font-bold text-gray-800 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:bg-gray-700">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 font-semibold text-gray-500 dark:text-gray-400">%</span>
                            </div>
                        </div>

                    </div>

                    {{-- Total bobot --}}
                    <div class="mt-5 rounded-xl border border-blue-100 bg-blue-50/80 p-4 dark:border-blue-900/70 dark:bg-blue-950/40">
                        <div class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M12 14a3 3 0 10-3-3m3 3v-1m0-10a10 10 0 100 20 10 10 0 000-20z" />
                            </svg>

                            <div>
                                <p class="text-sm text-blue-900 dark:text-blue-200">
                                    <strong>Perhatian:</strong>
                                    Jumlah bobot Harian, UTS, dan UAS harus tepat 100%.
                                    Contoh: Harian 20%, UTS 30%, dan UAS 50%.
                                </p>

                                <p id="total-bobot" aria-live="polite" class="mt-3 font-bold text-blue-700 dark:text-blue-300">
                                    Total bobot: 100%
                                </p>
                                <p id="status-bobot" class="mt-1 text-xs text-blue-700 dark:text-blue-300">
                                    Total bobot sudah sesuai.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol aksi --}}
                    <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Bobot
                        </button>

                        <a href="{{ route('guru.rekap.index') }}"
                           class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali ke Rekap
                        </a>
                    </div>
                </form>
            </div>
        </div>
    @endif

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const harian = document.getElementById('bobot_harian');
    const uts = document.getElementById('bobot_uts');
    const uas = document.getElementById('bobot_uas');
    const total = document.getElementById('total-bobot');
    const status = document.getElementById('status-bobot');

    if (!harian || !uts || !uas || !total || !status) return;

    function hitungTotal() {
        const jumlah =
            (Number(harian.value) || 0) +
            (Number(uts.value) || 0) +
            (Number(uas.value) || 0);

        total.textContent = 'Total bobot: ' + jumlah + '%';

        total.classList.remove(
            'text-green-700', 'dark:text-green-300',
            'text-red-600', 'dark:text-red-300',
            'text-blue-700', 'dark:text-blue-300'
        );

        status.classList.remove(
            'text-green-700', 'dark:text-green-300',
            'text-red-600', 'dark:text-red-300',
            'text-blue-700', 'dark:text-blue-300'
        );

        if (jumlah === 100) {
            total.classList.add('text-green-700', 'dark:text-green-300');
            status.classList.add('text-green-700', 'dark:text-green-300');
            status.textContent = 'Total bobot sudah sesuai dan siap disimpan.';
        } else {
            total.classList.add('text-red-600', 'dark:text-red-300');
            status.classList.add('text-red-600', 'dark:text-red-300');

            status.textContent = 'Total harus tepat 100%. Saat ini ' +
    (jumlah < 100
        ? 'kurang ' + (100 - jumlah) + '%.'
        : 'lebih ' + (jumlah - 100) + '%.');
        }
    }

    harian.addEventListener('input', hitungTotal);
    uts.addEventListener('input', hitungTotal);
    uas.addEventListener('input', hitungTotal);

    hitungTotal();
});
</script>
@endsection
