
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Kendala Sistem | EDUVIA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center p-4 text-slate-800">
    <main class="w-full max-w-md rounded-2xl border border-slate-200 bg-white p-8 text-center shadow-lg">
        <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-rose-100 text-rose-600 text-3xl font-bold">
            !
        </div>

        <p class="text-sm font-bold uppercase tracking-widest text-teal-700">EDUVIA</p>

        <h1 class="mt-2 text-2xl font-extrabold text-slate-900">
            Mohon Maaf, Terjadi Kendala
        </h1>

        <p class="mt-3 text-sm leading-6 text-slate-600">
            Terjadi kendala koneksi server. Silakan hubungi admin.
        </p>

        <div class="mt-5 rounded-xl border border-slate-200 bg-slate-50 p-3 text-left text-xs text-slate-600">
            <p class="font-semibold">Status: Kesalahan internal server</p>
            <p class="mt-1">Detail teknis dicatat untuk pemeriksaan oleh pengelola sistem.</p>
        </div>

        <a href="{{ url('/') }}"
           class="mt-6 inline-block w-full rounded-xl bg-teal-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-teal-700">
            Kembali ke Beranda
        </a>

        <p class="mt-5 text-xs text-slate-400">EDUVIA — Sistem Akademik Mini</p>
    </main>
</body>
</html>
