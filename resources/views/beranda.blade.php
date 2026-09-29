<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Akademik Mini</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased flex min-h-screen">

    <!-- SIDEBAR (Sesuaikan dengan Wireframe Kamu) -->
    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between p-4 min-h-screen">
        <div>
            <!-- LOGO & BRANDING -->
            <div class="flex items-center space-x-3 px-2 py-4 border-b border-slate-800 mb-6">
                <div class="bg-blue-600 text-white font-bold p-2 rounded-lg text-sm">
                    LOGO
                </div>
                <span class="font-bold text-sm tracking-wide text-white">Sistem Akademik Mini</span>
            </div>

            <!-- MENU NAVIGASI -->
            <nav class="space-y-1">
                <a href="/beranda" class="block px-4 py-2 hover:bg-slate-800 rounded">Beranda</a>
<a href="/siswa" class="block px-4 py-2 hover:bg-slate-800 rounded">Data Siswa</a>
<a href="/guru" class="block px-4 py-2 hover:bg-slate-800 rounded">Data Guru</a>
<a href="/nilai" class="block px-4 py-2 hover:bg-slate-800 rounded">Input Nilai</a>
<a href="/rapor" class="block px-4 py-2 hover:bg-slate-800 rounded">Cetak Rapor</a>
</nav>
    
        </div>

        <!-- LOGOUT -->
        <div class="border-t border-slate-800 pt-4">
            <a href="/login" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-red-500/10 hover:text-red-500 font-medium text-sm transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <!-- CONTENT AREA -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <!-- TOP HEADER -->
        <header class="bg-white border-b border-slate-200 px-8 py-4 flex items-center justify-end">
            <div class="flex items-center space-x-3">
                <span class="text-sm font-medium text-slate-700">Nama User</span>
                <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-bold text-xs">
                    U
                </div>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <main class="p-8 overflow-y-auto flex-1">
            <h1 class="text-2xl font-bold text-slate-800 mb-6">Dashboard</h1>

            <!-- CARDS RINGKASAN (3 BOX) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Siswa -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                    <p class="text-sm font-medium text-slate-500 mb-1">Total Siswa</p>
                    <h3 class="text-3xl font-bold text-slate-800">120</h3>
                </div>

                <!-- Total Kelas -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                    <p class="text-sm font-medium text-slate-500 mb-1">Total Kelas</p>
                    <h3 class="text-3xl font-bold text-slate-800">6</h3>
                </div>

                <!-- Total Mapel -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                    <p class="text-sm font-medium text-slate-500 mb-1">Total Mapel</p>
                    <h3 class="text-3xl font-bold text-slate-800">10</h3>
                </div>
            </div>

            <!-- TABEL DATA TERBARU (Sesuai Wireframe) -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h2 class="text-lg font-bold text-slate-800">Data Terbaru</h2>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-slate-700 font-semibold border-b border-slate-200">
                            <tr>
                                <th class="p-4 pl-6 w-16">No</th>
                                <th class="p-4">Nama</th>
                                <th class="p-4">Kelas</th>
                                <th class="p-4 pr-6">Mapel</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr class="hover:bg-slate-50 transition">
                                <td class="p-4 pl-6 font-medium text-slate-800">1</td>
                                <td class="p-4 font-medium text-slate-800">Sopi Pitriani</td>
                                <td class="p-4"><span class="bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md text-xs font-semibold">XII RPL</span></td>
                                <td class="p-4 pr-6">Pemrograman Web</td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition">
                                <td class="p-4 pl-6 font-medium text-slate-800">2</td>
                                <td class="p-4 font-medium text-slate-800">Ahmad Sahid</td>
                                <td class="p-4"><span class="bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md text-xs font-semibold">XI BR</span></td>
                                <td class="p-4 pr-6">Pemasaran Digital</td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition">
                                <td class="p-4 pl-6 font-medium text-slate-800">3</td>
                                <td class="p-4 font-medium text-slate-800">Rina Melati</td>
                                <td class="p-4"><span class="bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md text-xs font-semibold">X DKV</span></td>
                                <td class="p-4 pr-6">Desain Grafis</td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition">
                                <td class="p-4 pl-6 font-medium text-slate-800">4</td>
                                <td class="p-4 font-medium text-slate-800">Budi Santoso</td>
                                <td class="p-4"><span class="bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md text-xs font-semibold">XII RPL</span></td>
                                <td class="p-4 pr-6">Basis Data</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION (Tombol < 1 2 3 4 > Sesuai Wireframe) -->
                <div class="p-4 border-t border-slate-100 flex items-center justify-end">
                    <div class="flex items-center space-x-1 text-sm font-medium text-slate-600">
                        <button class="px-3 py-1 border border-slate-200 rounded hover:bg-slate-100">&lt;</button>
                        <button class="px-3 py-1 bg-blue-600 text-white rounded">1</button>
                        <button class="px-3 py-1 border border-slate-200 rounded hover:bg-slate-100">2</button>
                        <button class="px-3 py-1 border border-slate-200 rounded hover:bg-slate-100">3</button>
                        <button class="px-3 py-1 border border-slate-200 rounded hover:bg-slate-100">4</button>
                        <button class="px-3 py-1 border border-slate-200 rounded hover:bg-slate-100">&gt;</button>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>