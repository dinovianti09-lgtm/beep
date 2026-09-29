<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Guru & Mapel - Sistem Akademik Mini</title>
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
                <a href="{{ route('guru') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl bg-blue-600 text-white font-medium text-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span>Data Guru</span>
                </a>
                <a href="{{ route('siswa') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white font-medium text-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span>Data Siswa</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white font-medium text-sm transition">
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
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Data Guru & Mata Pelajaran</h1>
                    <p class="text-sm text-slate-500">Kelola data guru pengajar dan mata pelajaran</p>
                </div>
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2.5 rounded-xl text-sm flex items-center space-x-2 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>Tambah Guru</span>
                </button>
            </div>

            <!-- TABEL GURU -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-slate-700 font-semibold border-b border-slate-200">
                            <tr>
                                <th class="p-4 pl-6 w-16">No</th>
                                <th class="p-4">NIP / NUPTK</th>
                                <th class="p-4">Nama Guru</th>
                                <th class="p-4">Mata Pelajaran (Mapel)</th>
                                <th class="p-4 text-center pr-6">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr class="hover:bg-slate-50 transition">
                                <td class="p-4 pl-6 font-medium text-slate-800">1</td>
                                <td class="p-4">19850112 201001 1 001</td>
                                <td class="p-4 font-medium text-slate-800">Budi Hendrawan, S.Kom</td>
                                <td class="p-4"><span class="bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md text-xs font-semibold">Pemrograman Web</span></td>
                                <td class="p-4 text-center pr-6">
                                    <button class="text-amber-600 hover:text-amber-800 font-medium text-xs mr-3">Edit</button>
                                    <button class="text-red-600 hover:text-red-800 font-medium text-xs">Hapus</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition">
                                <td class="p-4 pl-6 font-medium text-slate-800">2</td>
                                <td class="p-4">19880324 201202 2 004</td>
                                <td class="p-4 font-medium text-slate-800">Siti Rahmawati, M.Pd</td>
                                <td class="p-4"><span class="bg-green-50 text-green-700 px-2.5 py-1 rounded-md text-xs font-semibold">Pemasaran Digital</span></td>
                                <td class="p-4 text-center pr-6">
                                    <button class="text-amber-600 hover:text-amber-800 font-medium text-xs mr-3">Edit</button>
                                    <button class="text-red-600 hover:text-red-800 font-medium text-xs">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

</body>
</html>