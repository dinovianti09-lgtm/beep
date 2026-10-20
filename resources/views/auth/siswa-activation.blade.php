<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi Akun Siswa - Sistem Akademik Mini</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center p-5" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="w-full max-w-md rounded-2xl bg-white p-8 shadow-xl">
        <div class="mb-6 text-center">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-2xl">
                🎓
            </div>

            <h1 class="text-2xl font-extrabold text-slate-900">
                Aktivasi Akun Siswa
            </h1>

            <p class="mt-2 text-sm leading-6 text-slate-500">
                Masukkan kode aktivasi dari Admin, lalu buat password akun Siswa kamu.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('siswa.activation.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="token" class="mb-2 block text-sm font-semibold text-slate-700">
                    Kode Aktivasi
                </label>
                <input
                    id="token"
                    name="token"
                    type="text"
                    value="{{ old('token', $token) }}"
                    required
                    autocomplete="off"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    placeholder="Masukkan kode dari Admin"
                >
            </div>

            <div>
                <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">
                    Password Baru
                </label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    minlength="8"
                    autocomplete="new-password"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    placeholder="Minimal 8 karakter"
                >
                <p class="mt-2 text-xs text-slate-500">
                    Gunakan huruf besar, huruf kecil, dan angka.
                </p>
            </div>

            <div>
                <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">
                    Konfirmasi Password
                </label>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    minlength="8"
                    autocomplete="new-password"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    placeholder="Ulangi password baru"
                >
            </div>

            <button
                type="submit"
                class="w-full rounded-xl bg-blue-600 px-4 py-3 font-bold text-white transition hover:bg-blue-700"
            >
                Aktifkan Akun
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-slate-500">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-700">
                Login
            </a>
        </p>
    </div>
</body>
</html>