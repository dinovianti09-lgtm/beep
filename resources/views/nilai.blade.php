<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai - Sistem Akademik Mini</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between p-4 min-h-screen">
        <div>
            <!-- LOGO -->
            <div class="flex items-center space-x-3 px-2 py-4 border-b border-slate-800 mb-6">
                <div class="bg-blue-600 text-white font-bold p-2 rounded-lg text-sm">
                    LOGO
                </div>
                <span class="font-bold text-sm tracking-wide text-white">Sistem Akademik Mini</span>
            </div>

            <!-- MENU NAVIGASI -->
            <nav class="space-y-1">
                <a href="{{ route('beranda') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white font-medium text-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('guru') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white font-medium text-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span>Data Guru</span>
                </a>
                <a href="{{ route('siswa') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white font-medium text-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span>Data Siswa</span>
                </a>
                <a href="{{ route('nilai') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl bg-blue-600 text-white font-medium text-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 012.828 0L20.5 5.586a2 2 0 010 2.828l-8.5 8.5H9v-3.572l8.586-8.586z"></path></svg>
                    <span>Data Nilai</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white font-medium text-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span>Rapor</span>
                </a>
            </nav>
        </div>

        <!-- LOGOUT -->
        <div class="border-t border-slate-800 pt-4">
            <a href="#" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-red-500/10 hover:text-red-500 font-medium text-sm transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <!-- CONTENT AREA -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <!-- HEADER -->
        <header class="bg-white border-b border-slate-200 px-8 py-4 flex items-center justify-end">
            <div class="flex items-center space-x-3">
                <span class="text-sm font-medium text-slate-700">Sopi Pitriani</span>
                <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-bold text-xs">
                    S
                </div>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <main class="p-8 overflow-y-auto flex-1">
            <h1 class="text-2xl font-bold text-slate-800 mb-6">Input Nilai</h1>

            <!-- FILTER DROPDOWN (PILIH KELAS & PILIH MAPEL) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 max-w-2xl">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Pilih Kelas</label>
                    <select class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">-- Pilih Kelas --</option>
                        <option value="XII RPL">XII RPL</option>
                        <option value="XI BR">XI BR</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Pilih Mapel</label>
                    <select class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">-- Pilih Mapel --</option>
                        <option value="Pemrograman Web">Pemrograman Web</option>
                        <option value="Pemasaran Digital">Pemasaran Digital</option>
                    </select>
                </div>
            </div>

            <!-- TABEL INPUT NILAI -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600 border-collapse">
                        <thead class="bg-slate-50 text-slate-700 font-semibold border-b border-slate-200">
                            <tr>
                                <th rowspan="2" class="p-4 pl-6 w-16 border-r border-slate-200 text-center">NO</th>
                                <th rowspan="2" class="p-4 border-r border-slate-200">NISN</th>
                                <th rowspan="2" class="p-4 border-r border-slate-200">Nama Siswa</th>
                                <th colspan="3" class="p-2 text-center border-b border-r border-slate-200">Nilai</th>
                                <th rowspan="2" class="p-4 text-center border-r border-slate-200">Nilai Akhir</th>
                                <th rowspan="2" class="p-4 text-center">Predikat</th>
                            </tr>
                            <tr>
                                <th class="p-2 text-center w-24 border-r border-slate-200">Tugas</th>
                                <th class="p-2 text-center w-24 border-r border-slate-200">UTS</th>
                                <th class="p-2 text-center w-24 border-r border-slate-200">UAS</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr class="hover:bg-slate-50 transition">
                                <td class="p-4 pl-6 text-center font-medium text-slate-800 border-r border-slate-100">1</td>
                                <td class="p-4 font-mono text-xs text-slate-500 border-r border-slate-100">0061234567</td>
                                <td class="p-4 font-medium text-slate-800 border-r border-slate-100">Sopi Pitriani</td>
                                <td class="p-2 border-r border-slate-100">
                                    <input type="number" value="90" class="w-full text-center bg-slate-50 border border-slate-200 rounded-lg py-1.5 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                </td>
                                <td class="p-2 border-r border-slate-100">
                                    <input type="number" value="88" class="w-full text-center bg-slate-50 border border-slate-200 rounded-lg py-1.5 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                </td>
                                <td class="p-2 border-r border-slate-100">
                                    <input type="number" value="92" class="w-full text-center bg-slate-50 border border-slate-200 rounded-lg py-1.5 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                </td>
                                <td class="p-4 text-center font-bold text-slate-800 border-r border-slate-100">90.0</td>
                                <td class="p-4 text-center font-bold text-blue-600">A</td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition">
                                <td class="p-4 pl-6 text-center font-medium text-slate-800 border-r border-slate-100">2</td>
                                <td class="p-4 font-mono text-xs text-slate-500 border-r border-slate-100">0067654321</td>
                                <td class="p-4 font-medium text-slate-800 border-r border-slate-100">Ahmad Sahid</td>
                                <td class="p-2 border-r border-slate-100">
                                    <input type="number" value="80" class="w-full text-center bg-slate-50 border border-slate-200 rounded-lg py-1.5 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                </td>
                                <td class="p-2 border-r border-slate-100">
                                    <input type="number" value="85" class="w-full text-center bg-slate-50 border border-slate-200 rounded-lg py-1.5 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                </td>
                                <td class="p-2 border-r border-slate-100">
                                    <input type="number" value="82" class="w-full text-center bg-slate-50 border border-slate-200 rounded-lg py-1.5 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                </td>
                                <td class="p-4 text-center font-bold text-slate-800 border-r border-slate-100">82.3</td>
                                <td class="p-4 text-center font-bold text-green-600">B</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TOMBOL SIMPAN DI KANAN BAWAH -->
            <div class="flex justify-end">
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2.5 rounded-xl text-sm transition shadow-sm">
                    Simpan
                </button>
            </div>
        </main>
    </div>

</body>
</html>