<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Rapor Siswa - Sistem Akademik Mini</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>

<body class="bg-slate-50 antialiased">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-72 bg-slate-900 text-slate-300 flex flex-col min-h-screen">

        <div class="p-6 border-b border-slate-800">

            <div class="flex items-center space-x-3">

                <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-xl">
                    🎓
                </div>

                <span class="font-bold text-sm text-white leading-tight">
                    Sistem Akademik<br>
                    Mini
                </span>

            </div>

        </div>


        <nav class="flex-1 p-4">

            <a
                href="{{ route('admin.dashboard') }}"
                class="block px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white text-sm"
            >
                🏠 Dashboard
            </a>

            <a
                href="{{ route('admin.rapor_siswa.index') }}"
                class="block px-4 py-3 rounded-xl text-white bg-indigo-600 text-sm font-semibold mt-1"
            >
                📄 Rapor Siswa
            </a>

        </nav>


        <div class="p-4 border-t border-slate-800">

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button
                    type="submit"
                    class="w-full px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/10 text-sm text-left"
                >
                    🚪 Logout
                </button>

            </form>

        </div>

    </aside>


    <!-- CONTENT -->
    <div class="flex-1">

        <header class="bg-white border-b border-slate-200 px-8 py-6">

            <h1 class="text-2xl font-bold text-slate-800">
                Tambah Rapor Siswa
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Buat data rapor untuk siswa dan periode tertentu
            </p>

        </header>


        <main class="p-8">

            <div class="max-w-3xl mx-auto">

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">

                    @if($errors->any())

                        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl">

                            <ul class="list-disc list-inside text-sm space-y-1">

                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>

                        </div>

                    @endif


                    <form
                        action="{{ route('admin.rapor_siswa.store') }}"
                        method="POST"
                        class="space-y-6"
                    >

                        @csrf


                        <!-- SISWA -->
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Siswa
                            </label>

                            <select
                                name="id_siswa"
                                required
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            >

                                <option value="">
                                    -- Pilih Siswa --
                                </option>

                                @foreach($siswaList as $siswa)

                                    <option
                                        value="{{ $siswa->id_siswa }}"
                                        {{ old('id_siswa') == $siswa->id_siswa ? 'selected' : '' }}
                                    >
                                        {{ $siswa->nama_siswa }}
                                        - NIS {{ $siswa->nis }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <!-- PERIODE RAPOR -->
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Periode Rapor
                            </label>

                            <select
                                name="id_rapor"
                                required
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            >

                                <option value="">
                                    -- Pilih Periode Rapor --
                                </option>

                                @foreach($raporList as $rapor)

                                    <option
                                        value="{{ $rapor->id_rapor }}"
                                        {{ old('id_rapor') == $rapor->id_rapor ? 'selected' : '' }}
                                    >
                                        {{ $rapor->semester }}
                                        — {{ $rapor->tahun_ajaran }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <!-- TANGGAL CETAK -->
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Tanggal Cetak
                            </label>

                            <input
                                type="date"
                                name="tgl_cetak"
                                value="{{ old('tgl_cetak', date('Y-m-d')) }}"
                                required
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            >

                        </div>


                        <!-- FILE PDF -->
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                File PDF
                            </label>

                            <input
                                type="text"
                                name="file_pdf"
                                value="{{ old('file_pdf') }}"
                                placeholder="Opsional"
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            >

                            <p class="text-xs text-slate-500 mt-2">
                                Untuk sementara boleh dikosongkan.
                            </p>

                        </div>


                        <!-- BUTTON -->
                        <div class="flex justify-end gap-3 pt-4">

                            <a
                                href="{{ route('admin.rapor_siswa.index') }}"
                                class="px-5 py-3 rounded-xl border border-slate-300 text-slate-600 font-semibold text-sm hover:bg-slate-50"
                            >
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="gradient-primary text-white px-6 py-3 rounded-xl font-semibold text-sm shadow-lg hover:opacity-90"
                            >
                                Simpan Rapor
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </main>

    </div>

</div>

</body>
</html>