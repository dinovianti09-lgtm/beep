<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapor Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans antialiased flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between p-4 min-h-screen flex-shrink-0">
        <div>
            <!-- LOGO -->
            <div class="flex items-center space-x-3 px-2 py-4 border-b border-slate-800 mb-6">
                <div class="bg-blue-600 text-white font-bold px-3 py-1.5 rounded-lg text-sm">
                    RPL
                </div>
                <span class="font-bold text-sm tracking-wide text-white">Sistem Akademik</span>
            </div>

            <!-- MENU NAVIGASI -->
            <nav class="space-y-1">
                <a href="#" class="block px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white font-medium text-sm">Dashboard</a>
                <a href="#" class="block px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white font-medium text-sm">Data Guru</a>
                <a href="#" class="block px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white font-medium text-sm">Data Siswa</a>
                <a href="#" class="block px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white font-medium text-sm">Data Nilai</a>
                <a href="#" class="block px-3 py-2.5 rounded-xl bg-blue-600 text-white font-medium text-sm">Rapor</a>
            </nav>
        </div>

        <!-- LOGOUT -->
        <div class="border-t border-slate-800 pt-4">
            <a href="#" class="block px-3 py-2.5 rounded-xl text-slate-400 hover:bg-red-500/10 hover:text-red-500 font-medium text-sm">Logout</a>
        </div>
    </aside>

    <!-- CONTENT AREA -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <!-- HEADER -->
        <header class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-end">
            <div class="flex items-center space-x-3">
                <span class="text-sm font-medium text-slate-700">Sopi Pitriani</span>
                <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs">S</div>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <main class="p-6 overflow-y-auto flex-1">
            
            <!-- INFORMASI SISWA CARD -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 mb-6 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-lg font-bold text-slate-800 mb-3">Informasi Siswa</h2>
                    <table class="text-sm text-slate-600">
                        <tr>
                            <td class="font-medium pr-4 py-1 text-slate-500">NISN</td>
                            <td class="pr-2">:</td>
                            <td class="font-mono text-slate-800 font-semibold">0061234567</td>
                        </tr>
                        <tr>
                            <td class="font-medium pr-4 py-1 text-slate-500">Nama</td>
                            <td class="pr-2">:</td>
                            <td class="font-semibold text-slate-800">Sopi Pitriani</td>
                        </tr>
                        <tr>
                            <td class="font-medium pr-4 py-1 text-slate-500">Kelas</td>
                            <td class="pr-2">:</td>
                            <td class="font-semibold text-slate-800">XII RPL</td>
                        </tr>
                    </table>
                </div>

                <!-- ACTION BUTTONS -->
                <div class="flex items-center space-x-3">
                    <button onclick="window.print()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium px-4 py-2 rounded-xl text-sm border border-slate-300">Download PDF</button>
                    <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded-xl text-sm shadow-sm">Cetak</button>
                </div>
            </div>

            <!-- TABEL NILAI -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600 border-collapse">
                    <thead class="bg-slate-50 text-slate-700 font-semibold border-b border-slate-200">
                        <tr>
                            <th rowspan="2" class="p-3 pl-4 w-12 border-r border-slate-200 text-center">NO</th>
                            <th rowspan="2" class="p-3 border-r border-slate-200">Mata Pelajaran</th>
                            <th colspan="4" class="p-2 text-center border-b border-r border-slate-200">Semester 1</th>
                            <th colspan="4" class="p-2 text-center border-b border-slate-200">Semester 2</th>
                        </tr>
                        <tr>
                            <th class="p-2 text-center w-16 border-r border-slate-200">Tugas</th>
                            <th class="p-2 text-center w-16 border-r border-slate-200">UTS</th>
                            <th class="p-2 text-center w-16 border-r border-slate-200">UAS</th>
                            <th class="p-2 text-center w-16 border-r border-slate-200 bg-slate-100/50">Akhir</th>

                            <th class="p-2 text-center w-16 border-r border-slate-200">Tugas</th>
                            <th class="p-2 text-center w-16 border-r border-slate-200">UTS</th>
                            <th class="p-2 text-center w-16 border-r border-slate-200">UAS</th>
                            <th class="p-2 text-center w-16 bg-slate-100/50">Akhir</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50">
                            <td class="p-3 pl-4 text-center font-medium border-r border-slate-100">1</td>
                            <td class="p-3 font-medium text-slate-800 border-r border-slate-100">Pemrograman Web</td>
                            <td class="p-3 text-center border-r border-slate-100">90</td>
                            <td class="p-3 text-center border-r border-slate-100">88</td>
                            <td class="p-3 text-center border-r border-slate-100">92</td>
                            <td class="p-3 text-center font-bold text-slate-800 border-r border-slate-100 bg-slate-50">90.0</td>
                            <td class="p-3 text-center border-r border-slate-100">92</td>
                            <td class="p-3 text-center border-r border-slate-100">90</td>
                            <td class="p-3 text-center border-r border-slate-100">94</td>
                            <td class="p-3 text-center font-bold text-slate-800 bg-slate-50">92.0</td>
                        </tr>
                        <tr class="hover:bg-slate-50">
                            <td class="p-3 pl-4 text-center font-medium border-r border-slate-100">2</td>
                            <td class="p-3 font-medium text-slate-800 border-r border-slate-100">Basis Data</td>
                            <td class="p-3 text-center border-r border-slate-100">85</td>
                            <td class="p-3 text-center border-r border-slate-100">82</td>
                            <td class="p-3 text-center border-r border-slate-100">88</td>
                            <td class="p-3 text-center font-bold text-slate-800 border-r border-slate-100 bg-slate-50">85.0</td>
                            <td class="p-3 text-center border-r border-slate-100">88</td>
                            <td class="p-3 text-center border-r border-slate-100">85</td>
                            <td class="p-3 text-center border-r border-slate-100">90</td>
                            <td class="p-3 text-center font-bold text-slate-800 bg-slate-50">87.7</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </main>
    </div>

</body>
</html>