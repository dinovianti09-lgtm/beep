@extends('layouts.guru')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
            Pengaturan Bobot Nilai
        </h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Atur persentase nilai Harian, UTS, dan UAS untuk setiap periode rapor.
        </p>
    </div>

    {{-- Notifikasi berhasil --}}
    @if (session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error validasi --}}
    @if ($errors->any())
        <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <p class="mb-2 font-semibold">Periksa kembali pengaturan:</p>
            <ul class="list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Informasi mata pelajaran --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Mata Pelajaran yang Diampu
        </p>
        <h2 class="mt-1 text-xl font-semibold text-gray-800 dark:text-white">
            {{ $mapel->nama_mapel }}
        </h2>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Guru: {{ $guru->nama_guru }}
        </p>
    </div>

    {{-- Pilih periode rapor --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <h2 class="mb-4 font-semibold text-gray-800 dark:text-white">
            Pilih Periode Rapor
        </h2>

        @if ($raporList->isEmpty())
            <p class="text-sm text-amber-600">
                Belum ada periode rapor. Tambahkan periode rapor terlebih dahulu.
            </p>
        @else
            <form method="GET"
                  action="{{ route('guru.bobot-nilai.index') }}"
                  class="flex flex-col gap-3 sm:flex-row sm:items-end">

                <div class="flex-1">
                    <label for="id_rapor"
                           class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Semester / Tahun Ajaran
                    </label>

                    <select name="id_rapor"
                            id="id_rapor"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-gray-800 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        @foreach ($raporList as $raporItem)
                            <option value="{{ $raporItem->id_rapor }}"
                                @selected(
                                    $raporTerpilih &&
                                    (int) $raporTerpilih->id_rapor ===
                                    (int) $raporItem->id_rapor
                                )>
                                Semester {{ $raporItem->semester }}
                                — {{ $raporItem->tahun_ajaran }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                        class="rounded-lg bg-gray-700 px-5 py-2.5 font-medium text-white hover:bg-gray-800">
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

        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="mb-5">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                    Bobot Penilaian
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Periode: Semester {{ $raporTerpilih->semester }}
                    — {{ $raporTerpilih->tahun_ajaran }}
                </p>
            </div>

            <form method="POST" action="{{ route('guru.bobot-nilai.update') }}">
                @csrf

                <input type="hidden"
                       name="id_rapor"
                       value="{{ $raporTerpilih->id_rapor }}">

                <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                    <div class="rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                        <label for="bobot_harian"
                               class="mb-2 block font-medium text-gray-700 dark:text-gray-200">
                            Nilai Harian (%)
                        </label>
                        <input type="number"
                               id="bobot_harian"
                               name="bobot_harian"
                               min="0"
                               max="100"
                               step="1"
                               required
                               value="{{ $harian }}"
                               class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-gray-800 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div class="rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                        <label for="bobot_uts"
                               class="mb-2 block font-medium text-gray-700 dark:text-gray-200">
                            Nilai UTS (%)
                        </label>
                        <input type="number"
                               id="bobot_uts"
                               name="bobot_uts"
                               min="0"
                               max="100"
                               step="1"
                               required
                               value="{{ $uts }}"
                               class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-gray-800 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div class="rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                        <label for="bobot_uas"
                               class="mb-2 block font-medium text-gray-700 dark:text-gray-200">
                            Nilai UAS (%)
                        </label>
                        <input type="number"
                               id="bobot_uas"
                               name="bobot_uas"
                               min="0"
                               max="100"
                               step="1"
                               required
                               value="{{ $uas }}"
                               class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-gray-800 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200 dark:border-gray-600 dark:bg-gray-700 dark:bg-gray-700 dark:text-white">
                    </div>
                </div>

                <div class="mt-5 rounded-lg bg-indigo-50 p-4 dark:bg-indigo-950">
                    <p class="text-sm text-indigo-800 dark:text-indigo-200">
                        <strong>Contoh:</strong>
                        Harian 20%, UTS 30%, dan UAS 50%.
                        Totalnya harus tepat 100%.
                    </p>
                    <p id="total-bobot"
                       class="mt-2 font-semibold text-indigo-800 dark:text-indigo-200">
                        Total bobot: 100%
                    </p>
                </div>

                <div class="mt-5 flex flex-wrap gap-3">
                    <button type="submit"
                            class="rounded-lg bg-indigo-600 px-5 py-2.5 font-semibold text-white hover:bg-indigo-700">
                        Simpan Bobot
                    </button>

                    <a href="{{ route('guru.rekap.index') }}"
                       class="rounded-lg border border-gray-300 px-5 py-2.5 font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">
                        Kembali ke Rekap
                    </a>
                </div>
            </form>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const harian = document.getElementById('bobot_harian');
    const uts = document.getElementById('bobot_uts');
    const uas = document.getElementById('bobot_uas');
    const total = document.getElementById('total-bobot');

    if (!harian || !uts || !uas || !total) return;

    function hitungTotal() {
        const jumlah =
            (Number(harian.value) || 0) +
            (Number(uts.value) || 0) +
            (Number(uas.value) || 0);

        total.textContent = 'Total bobot: ' + jumlah + '%';

        total.classList.toggle('text-red-600', jumlah !== 100);
        total.classList.toggle('text-green-600', jumlah === 100);
    }

    harian.addEventListener('input', hitungTotal);
    uts.addEventListener('input', hitungTotal);
    uas.addEventListener('input', hitungTotal);

    hitungTotal();
});
</script>
@endsection
