<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Akun - Sistem Akademik Mini</title>

    <script>
        tailwind = {
            config: {
                darkMode: 'class'
            }
        }
    </script>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        body,
        .register-card,
        .input-field,
        .select-field,
        .logo-box,
        .brand-title,
        .brand-subtitle,
        .main-title,
        .description-text,
        .label-text,
        .helper-text,
        .link-text,
        .back-link,
        .footer-text,
        .theme-button {
            transition:
                background-color 0.3s ease,
                color 0.3s ease,
                border-color 0.3s ease,
                box-shadow 0.3s ease;
        }

        .background-light {
            background-color: #f8fafc;
        }

        .blob-blue {
            background-color: rgba(191, 219, 254, 0.4);
        }

        .blob-indigo {
            background-color: rgba(199, 210, 254, 0.4);
        }

        .blob-light {
            background-color: rgba(219, 234, 254, 0.5);
        }

        .theme-button {
            cursor: pointer;
        }

        html.dark body {
            background-color: #020617;
            color: #e2e8f0;
        }

        html.dark .background-light {
            background-color: #020617;
        }

        html.dark .blob-blue {
            background-color: rgba(30, 64, 175, 0.18);
        }

        html.dark .blob-indigo {
            background-color: rgba(67, 56, 202, 0.18);
        }

        html.dark .blob-light {
            background-color: rgba(30, 64, 175, 0.12);
        }

        html.dark .brand-title {
            color: #f8fafc;
        }

        html.dark .brand-subtitle {
            color: #60a5fa;
        }

        html.dark .logo-box {
            background-color: #1e293b;
            border-color: #334155;
        }

        html.dark .register-card {
            background-color: rgba(15, 23, 42, 0.96);
            border-color: #1e293b;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
        }

        html.dark .main-title {
            color: #f8fafc;
        }

        html.dark .description-text {
            color: #94a3b8;
        }

        html.dark .label-text {
            color: #cbd5e1;
        }

        html.dark .helper-text {
            color: #64748b;
        }

        html.dark .link-text {
            color: #94a3b8;
        }

        html.dark .back-link {
            color: #94a3b8;
        }

        html.dark .back-link:hover {
            color: #60a5fa;
        }

        html.dark .footer-text {
            color: #64748b;
        }

        html.dark .input-field,
        html.dark .select-field {
            background-color: #1e293b;
            border-color: #334155;
            color: #f8fafc;
        }

        html.dark .input-field::placeholder {
            color: #64748b;
        }

        html.dark .input-field:focus,
        html.dark .select-field:focus {
            background-color: #1e293b;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        html.dark .select-field option {
            background-color: #1e293b;
            color: #f8fafc;
        }

        html.dark .theme-button {
            background-color: #1e293b;
            border-color: #334155;
            color: #f8fafc;
        }

        html.dark .theme-button:hover {
            background-color: #334155;
        }

        html.dark .error-box {
            background-color: rgba(127, 29, 29, 0.25);
            border-color: #7f1d1d;
        }

        html.dark .error-title {
            color: #fca5a5;
        }

        html.dark .error-text {
            color: #f87171;
        }

        html.dark .success-box {
            background-color: rgba(6, 78, 59, 0.25);
            border-color: #065f46;
        }

        html.dark .success-text {
            color: #6ee7b7;
        }
    </style>
</head>

<body class="min-h-screen overflow-y-auto background-light text-slate-800 antialiased">

    {{-- Background --}}
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="blob-blue absolute -top-32 -left-32 w-80 h-80 rounded-full blur-3xl"></div>
        <div class="blob-indigo absolute top-1/3 -right-32 w-96 h-96 rounded-full blur-3xl"></div>
        <div class="blob-light absolute -bottom-32 left-1/3 w-80 h-80 rounded-full blur-3xl"></div>
    </div>

    {{-- Navbar --}}
    <nav class="w-full px-5 sm:px-8 py-5">
        <div class="max-w-6xl mx-auto flex items-center justify-between">

            <a href="{{ route('landing') }}" class="flex items-center gap-3">

                <div class="logo-box w-10 h-10 rounded-xl overflow-hidden shadow-lg shadow-blue-900/10 bg-white">
                    <img
                        src="{{ asset('images/Logo sistem akademik mini.jpeg') }}"
                        alt="Logo Sistem Akademik Mini"
                        class="w-full h-full object-cover"
                    >
                </div>

                <div>
                    <p class="brand-title font-extrabold text-slate-800 leading-tight">
                        Rapor Digital
                    </p>

                    <p class="brand-subtitle text-[10px] font-semibold tracking-[0.2em] text-blue-600">
                        SISTEM AKADEMIK MINI
                    </p>
                </div>

            </a>

            <button
                type="button"
                onclick="toggleTheme()"
                class="theme-button w-11 h-11 rounded-xl border border-slate-200 bg-white flex items-center justify-center text-lg shadow-sm hover:bg-slate-100 hover:scale-105 active:scale-95"
                title="Ganti tema"
                aria-label="Ganti tema"
            >
                <span id="themeIcon">🌙</span>
            </button>

        </div>
    </nav>

    {{-- Main --}}
    <main class="min-h-[calc(100vh-90px)] flex items-start justify-center px-5 py-6 sm:py-10">

        <div class="w-full max-w-md">

            {{-- Register Card --}}
            <div class="register-card bg-white/95 backdrop-blur-sm rounded-[2rem] shadow-2xl shadow-blue-900/10 border border-white p-6 sm:p-8">

                {{-- Logo --}}
                <div class="flex justify-center mb-5">
                    <div class="logo-box w-20 h-20 rounded-2xl overflow-hidden shadow-lg shadow-blue-900/10 border border-slate-100 bg-white">
                        <img
                            src="{{ asset('images/Logo sistem akademik mini.jpeg') }}"
                            alt="Logo Sistem Akademik Mini"
                            class="w-full h-full object-cover"
                        >
                    </div>
                </div>

                {{-- Title --}}
                <div class="text-center mb-6">

                    <h1 class="main-title text-2xl sm:text-3xl font-extrabold text-slate-900">
                        Buat Akun Baru
                    </h1>

                    <p class="description-text mt-2 text-sm text-slate-500">
                        Daftarkan akun menggunakan data yang sudah terdaftar di sekolah
                    </p>

                </div>

                {{-- Error --}}
                @if ($errors->any())
                    <div class="error-box mb-5 rounded-xl bg-red-50 border border-red-200 px-4 py-3">

                        <p class="error-title text-sm font-semibold text-red-700 mb-1">
                            Pendaftaran gagal
                        </p>

                        <ul class="error-text text-sm text-red-600 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>
                @endif

                {{-- Success --}}
                @if (session('success'))
                    <div class="success-box mb-5 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3">

                        <p class="success-text text-sm font-medium text-emerald-700">
                            {{ session('success') }}
                        </p>

                    </div>
                @endif

                {{-- Form --}}
                <form
                    action="{{ route('register.process') }}"
                    method="POST"
                    class="space-y-4"
                >

                    @csrf

                    {{-- Role --}}
                    <div>

                        <label
                            for="role"
                            class="label-text block text-sm font-semibold text-slate-700 mb-2"
                        >
                            Daftar Sebagai
                        </label>

                        <select
                            id="role"
                            name="role"
                            required
                            class="select-field w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 outline-none transition focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                        >

                            <option value="">-- Pilih Role --</option>

                            <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>
                                Siswa
                            </option>

                            <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>
                                Guru
                            </option>

                        </select>

                    </div>

                    {{-- Username --}}
                    <div>

                        <label
                            for="identifier"
                            class="label-text block text-sm font-semibold text-slate-700 mb-2"
                        >
                            Username
                        </label>

                        <input
                            type="text"
                            id="identifier"
                            name="identifier"
                            value="{{ old('identifier') }}"
                            maxlength="30"
                            required
                            autocomplete="username"
                            placeholder="Masukkan username"
                            class="input-field w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 placeholder-slate-400 outline-none transition focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                        >

                        <p
                            id="identifierHelper"
                            class="helper-text text-xs text-slate-400 mt-2"
                        >
                            Username Siswa diisi menggunakan NIS yang sudah terdaftar.
                        </p>

                    </div>

                    {{-- Password --}}
                    <div>

                        <label
                            for="password"
                            class="label-text block text-sm font-semibold text-slate-700 mb-2"
                        >
                            Password
                        </label>

                        <div class="relative">

                            <input
                                type="password"
                                id="password"
                                name="password"
                                minlength="8"
                                autocomplete="new-password"
                                required
                                placeholder="Masukkan password"
                                class="input-field w-full px-4 py-3.5 pr-12 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 placeholder-slate-400 outline-none transition focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                            >

                            <button
                                type="button"
                                id="togglePassword"
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 hover:text-blue-600 transition"
                                aria-label="Tampilkan password"
                                title="Tampilkan password"
                            >

                                <svg
                                    id="eyeIcon"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="w-5 h-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 4.5 12 4.5c4.64 0 8.577 3.01 9.964 7.178.08.24.08.498 0 .644C20.577 16.49 16.64 19.5 12 19.5c-4.64 0-8.577-3.01-9.964-7.178z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                </svg>

                                <svg
                                    id="eyeOffIcon"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="w-5 h-5 hidden"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.39 7.28 19.5 12 19.5c1.79 0 3.47-.47 4.92-1.29"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6.228 6.228A10.45 10.45 0 0112 4.5c4.72 0 8.774 3.11 10.066 7.5a10.523 10.523 0 01-4.132 5.411"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6.228 6.228L3 3m3.228 3.228l4.242 4.242m0 0a3 3 0 004.242 4.242m-4.242-4.242L3 21m7.47-7.47l4.242 4.242"
                                    />
                                </svg>

                            </button>

                        </div>

                        <p class="helper-text text-xs text-slate-400 mt-2">
                            Minimal 8 karakter, harus mengandung huruf besar, huruf kecil, dan angka.
                        </p>

                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>

                        <label
                            for="password_confirmation"
                            class="label-text block text-sm font-semibold text-slate-700 mb-2"
                        >
                            Konfirmasi Password
                        </label>

                        <div class="relative">

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                minlength="8"
                                autocomplete="new-password"
                                required
                                placeholder="Ulangi password"
                                class="input-field w-full px-4 py-3.5 pr-12 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 placeholder-slate-400 outline-none transition focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                            >

                            <button
                                type="button"
                                id="togglePasswordConfirmation"
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 hover:text-blue-600 transition"
                                aria-label="Tampilkan konfirmasi password"
                                title="Tampilkan konfirmasi password"
                            >

                                <svg
                                    id="eyeConfirmationIcon"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="w-5 h-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 4.5 12 4.5c4.64 0 8.577 3.01 9.964 7.178.08.24.08.498 0 .644C20.577 16.49 16.64 19.5 12 19.5c-4.64 0-8.577-3.01-9.964-7.178z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                </svg>

                                <svg
                                    id="eyeConfirmationOffIcon"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="w-5 h-5 hidden"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.39 7.28 19.5 12 19.5c1.79 0 3.47-.47 4.92-1.29"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6.228 6.228A10.45 10.45 0 0112 4.5c4.72 0 8.774 3.11 10.066 7.5a10.523 10.523 0 01-4.132 5.411"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6.228 6.228L3 3m3.228 3.228l4.242 4.242m0 0a3 3 0 004.242 4.242m0 0L3 21m7.47-7.47l4.242 4.242"
                                    />
                                </svg>

                            </button>

                        </div>

                        <p class="helper-text text-xs text-slate-400 mt-2">
                            Masukkan kembali password yang sama.
                        </p>

                    </div>

                    {{-- Button --}}
                    <button
                        type="submit"
                        class="w-full py-3.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold shadow-lg shadow-blue-600/20 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-blue-600/25 active:translate-y-0 mt-5"
                    >
                        Daftar Sekarang
                    </button>

                </form>

                {{-- Login Link --}}
                <div class="mt-6 text-center">

                    <p class="link-text text-sm text-slate-500">
                        Sudah punya akun?

                        <a
                            href="{{ route('login') }}"
                            class="font-bold text-blue-600 hover:text-indigo-600 dark:text-blue-400 dark:hover:text-indigo-400 transition"
                        >
                            Masuk di sini
                        </a>
                    </p>

                </div>

                {{-- Back --}}
                <div class="mt-4 text-center">

                    <a
                        href="{{ route('landing') }}"
                        class="back-link inline-flex items-center gap-1 text-sm font-medium text-slate-500 hover:text-blue-600 transition"
                    >
                        ← Kembali ke halaman utama
                    </a>

                </div>

            </div>

            {{-- Footer --}}
            <p class="footer-text text-center text-xs text-slate-400 mt-6">
                © {{ date('Y') }} Sistem Akademik Mini
            </p>

        </div>

    </main>

    <script>
        // =========================
        // SHOW / HIDE PASSWORD
        // =========================

        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');

        togglePassword.addEventListener('click', function () {

            const isPassword = passwordInput.type === 'password';

            passwordInput.type = isPassword ? 'text' : 'password';

            eyeIcon.classList.toggle('hidden', isPassword);
            eyeOffIcon.classList.toggle('hidden', !isPassword);

            togglePassword.setAttribute(
                'aria-label',
                isPassword ? 'Sembunyikan password' : 'Tampilkan password'
            );

            togglePassword.setAttribute(
                'title',
                isPassword ? 'Sembunyikan password' : 'Tampilkan password'
            );
        });


        // =========================
        // SHOW / HIDE KONFIRMASI
        // =========================

        const togglePasswordConfirmation =
            document.getElementById('togglePasswordConfirmation');

        const passwordConfirmationInput =
            document.getElementById('password_confirmation');

        const eyeConfirmationIcon =
            document.getElementById('eyeConfirmationIcon');

        const eyeConfirmationOffIcon =
            document.getElementById('eyeConfirmationOffIcon');

        togglePasswordConfirmation.addEventListener('click', function () {

            const isPassword =
                passwordConfirmationInput.type === 'password';

            passwordConfirmationInput.type =
                isPassword ? 'text' : 'password';

            eyeConfirmationIcon.classList.toggle(
                'hidden',
                isPassword
            );

            eyeConfirmationOffIcon.classList.toggle(
                'hidden',
                !isPassword
            );

            togglePasswordConfirmation.setAttribute(
                'aria-label',
                isPassword
                    ? 'Sembunyikan konfirmasi password'
                    : 'Tampilkan konfirmasi password'
            );

            togglePasswordConfirmation.setAttribute(
                'title',
                isPassword
                    ? 'Sembunyikan konfirmasi password'
                    : 'Tampilkan konfirmasi password'
            );
        });


        // =========================
        // ROLE → USERNAME
        // =========================

        const roleSelect =
            document.getElementById('role');

        const identifierInput =
            document.getElementById('identifier');

        const identifierHelper =
            document.getElementById('identifierHelper');


        function updateIdentifierField() {

            if (roleSelect.value === 'guru') {

                identifierInput.placeholder =
                    'Masukkan username';

                identifierHelper.textContent =
                    'Username Guru diisi menggunakan NIP yang sudah terdaftar pada data Guru.';

            } else if (roleSelect.value === 'siswa') {

                identifierInput.placeholder =
                    'Masukkan username';

                identifierHelper.textContent =
                    'Username Siswa diisi menggunakan NIS yang sudah terdaftar pada data Siswa.';

            } else {

                identifierInput.placeholder =
                    'Masukkan username';

                identifierHelper.textContent =
                    'Username diisi menggunakan NIP untuk Guru atau NIS untuk Siswa.';

            }
        }


        roleSelect.addEventListener(
            'change',
            updateIdentifierField
        );

        updateIdentifierField();


        // =========================
        // DARK / LIGHT MODE
        // =========================

        function updateThemeIcon() {

            const icon =
                document.getElementById('themeIcon');

            const isDark =
                document.documentElement.classList.contains('dark');

            if (isDark) {
                icon.textContent = '☀️';
            } else {
                icon.textContent = '🌙';
            }
        }


        function toggleTheme() {

            const html =
                document.documentElement;

            const isDark =
                html.classList.toggle('dark');

            if (isDark) {

                localStorage.setItem(
                    'theme',
                    'dark'
                );

            } else {

                localStorage.setItem(
                    'theme',
                    'light'
                );
            }

            updateThemeIcon();
        }


        updateThemeIcon();
    </script>

</body>

</html>