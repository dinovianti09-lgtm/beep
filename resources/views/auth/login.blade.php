
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Akademik Mini</title>

    <script>
        tailwind = {
            config: {
                darkMode: 'class'
            }
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        body, nav, .login-card, .input-field, .theme-button,
        .logo-box, .brand-title, .brand-subtitle, .main-title,
        .description-text, .label-text, .helper-text, .select-field,
        .register-text, .back-link, .footer-text, .forgot-box {
            transition: background-color 0.3s ease, color 0.3s ease,
                border-color 0.3s ease, box-shadow 0.3s ease;
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

        html.dark .brand-title,
        html.dark .main-title {
            color: #f8fafc;
        }

        html.dark .brand-subtitle {
            color: #60a5fa;
        }

        html.dark .login-card {
            background-color: rgba(15, 23, 42, 0.96);
            border-color: #1e293b;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
        }

        html.dark .logo-box {
            background-color: #1e293b;
            border-color: #334155;
        }

        html.dark .description-text {
            color: #94a3b8;
        }

        html.dark .label-text {
            color: #cbd5e1;
        }

        html.dark .helper-text,
        html.dark .footer-text {
            color: #64748b;
        }

        html.dark .register-text,
        html.dark .back-link {
            color: #94a3b8;
        }

        html.dark .back-link:hover {
            color: #60a5fa;
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

        .theme-button {
            cursor: pointer;
        }

        html.dark .theme-button {
            background-color: #1e293b;
            border-color: #334155;
            color: #f8fafc;
        }

        html.dark .theme-button:hover {
            background-color: #334155;
        }

        html.dark .success-box {
            background-color: rgba(6, 78, 59, 0.25);
            border-color: #065f46;
        }

        html.dark .success-text {
            color: #6ee7b7;
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

        html.dark .forgot-box {
            background-color: rgba(30, 41, 59, 0.85);
            border-color: #334155;
        }
    </style>

    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>

<body class="min-h-screen overflow-y-auto background-light text-slate-800 antialiased">

    {{-- BACKGROUND --}}
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="blob-blue absolute -top-32 -left-32 w-80 h-80 rounded-full blur-3xl"></div>
        <div class="blob-indigo absolute top-1/3 -right-32 w-96 h-96 rounded-full blur-3xl"></div>
        <div class="blob-light absolute -bottom-32 left-1/3 w-80 h-80 rounded-full blur-3xl"></div>
    </div>

    {{-- NAVBAR --}}
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

    {{-- MAIN --}}
    <main class="min-h-[calc(100vh-90px)] flex items-start sm:items-center justify-center px-5 py-8 sm:py-12">
        <div class="w-full max-w-md">

            {{-- LOGIN CARD --}}
            <div class="login-card bg-white/95 backdrop-blur-sm rounded-[2rem] shadow-2xl shadow-blue-900/10 border border-white p-6 sm:p-8">

                {{-- LOGO --}}
                <div class="flex justify-center mb-6">
                    <div class="logo-box w-20 h-20 rounded-2xl overflow-hidden shadow-lg shadow-blue-900/10 border border-slate-100 bg-white">
                        <img
                            src="{{ asset('images/Logo sistem akademik mini.jpeg') }}"
                            alt="Logo Sistem Akademik Mini"
                            class="w-full h-full object-cover"
                        >
                    </div>
                </div>

                {{-- TITLE --}}
                <div class="text-center mb-7">
                    <h1 class="main-title text-2xl sm:text-3xl font-extrabold text-slate-900">
                        Selamat Datang 👋
                    </h1>
                    <p class="description-text mt-2 text-sm text-slate-500">
                        Silakan masuk ke akun Sistem Akademik Mini
                    </p>
                </div>

                {{-- SUCCESS MESSAGE --}}
                @if (session('success'))
                    <div class="success-box mb-5 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3">
                        <p class="success-text text-sm font-medium text-emerald-700">
                            {{ session('success') }}
                        </p>
                    </div>
                @endif

                {{-- ERROR MESSAGE --}}
                @if ($errors->any())
                    <div class="error-box mb-5 rounded-xl bg-red-50 border border-red-200 px-4 py-3">
                        <p class="error-title text-sm font-semibold text-red-700 mb-1">
                            Login gagal
                        </p>
                        <ul class="error-text text-sm text-red-600 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- FORM LOGIN --}}
                <form action="{{ route('login.process') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- USERNAME / NIP / NIS --}}
                    <div>
                        <label
                            for="username"
                            id="identifierLabel"
                            class="label-text block text-sm font-semibold text-slate-700 mb-2"
                        >
                            Username
                        </label>

                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="{{ old('username') }}"
                            placeholder="Masukkan username"
                            required
                            autocomplete="username"
                            class="input-field w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 placeholder-slate-400 outline-none transition focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                        >

                        <p id="identifierHelper" class="helper-text text-xs text-slate-400 mt-2">
                            Admin menggunakan username untuk login.
                        </p>
                    </div>

                    {{-- PASSWORD --}}
                    <div>
                        <label for="password" class="label-text block text-sm font-semibold text-slate-700 mb-2">
                            Password
                        </label>

                        <div class="relative">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Masukkan password"
                                required
                                autocomplete="current-password"
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
                    </div>

                    {{-- LUPA PASSWORD --}}
                    <div class="flex justify-end -mt-2">
                        <button
                            type="button"
                            onclick="toggleForgotPassword()"
                            class="text-sm font-semibold text-blue-600 hover:text-indigo-600 dark:text-blue-400 transition"
                            aria-expanded="false"
                            id="forgotPasswordButton"
                        >
                            Lupa Password?
                        </button>
                    </div>

                    {{-- PETUNJUK LUPA PASSWORD --}}
                    <div
                        id="forgotPasswordInfo"
                        class="forgot-box hidden rounded-xl border border-blue-200 bg-blue-50 p-4"
                    >
                        <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">
                            Lupa password akunmu?
                        </p>

                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">
                            Silakan hubungi Admin sekolah melalui WhatsApp untuk meminta reset password.
                            Sertakan identitas sesuai jenis akun agar Admin dapat memeriksa akunmu.
                        </p>

                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">
                            Admin akan membuat password sementara. Setelah login, ikuti petunjuk
                            untuk mengganti password jika diminta oleh sistem.
                        </p>

                        <p class="mt-3 text-xs text-slate-500 dark:text-slate-400">
                            Jangan bagikan password kepada orang lain atau melalui grup umum.
                        </p>

                        {{-- TOMBOL WHATSAPP ADMIN --}}
                        <a
                            id="whatsappAdminLink"
                            href="https://wa.me/6285645075402?text=Halo%20Admin%2C%20saya%20ingin%20meminta%20bantuan%20untuk%20reset%20password%20akun%20Sistem%20Akademik%20Mini.%0A%0ABerikut%20identitas%20saya%3A%0A-%20Jika%20siswa%3A%20Nama%20lengkap%2C%20kelas%2C%20dan%20NIS.%0A-%20Jika%20guru%3A%20Nama%20lengkap%20dan%20NIP.%0A%0AMohon%20bantuannya%20untuk%20melakukan%20reset%20password%20akun%20saya.%20Terima%20kasih%20%F0%9F%99%8F"

                            target="_blank"
                            rel="noopener noreferrer"
                            class="mt-4 flex w-full items-center justify-center gap-2 rounded-xl bg-green-600 px-4 py-3 text-sm font-bold text-white transition hover:bg-green-700"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                                class="h-5 w-5"
                                aria-hidden="true"
                            >
                                <path d="M12.04 2a9.87 9.87 0 0 0-8.48 14.93L2 22l5.25-1.38A10 10 0 1 0 12.04 2Zm0 18.2a8.2 8.2 0 0 1-4.18-1.14l-.3-.18-3.12.82.83-3.04-.2-.31a8.17 8.17 0 1 1 6.97 3.85Zm4.49-6.12c-.25-.13-1.47-.73-1.7-.81-.23-.08-.4-.13-.56.13-.17.25-.65.81-.8.98-.15.17-.3.19-.55.06-.25-.12-1.05-.39-2-.1-.74-.68-1.23-1.52-1.38-1.77-.15-.25-.02-.39.11-.52.11-.11.25-.3.37-.44.12-.15.16-.25.25-.42.08-.17.04-.31-.02-.44-.06-.12-.56-1.35-.77-1.85-.2-.48-.4-.42-.56-.43h-.48c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.09s.9 2.43 1.03 2.6c.12.17 1.77 2.7 4.29 3.79.6.26 1.07.41 1.44.52.6.19 1.15.16 1.58.1.48-.07 1.47-.6 1.68-1.19.21-.59.21-1.1.15-1.2-.06-.11-.23-.17-.48-.3Z"/>
                            </svg>

                            Hubungi Admin via WhatsApp
                        </a>
                    </div>

                    {{-- ROLE --}}
                    <div>
                        <label for="role" class="label-text block text-sm font-semibold text-slate-700 mb-2">
                            Login sebagai
                        </label>

                        <select
                            id="role"
                            name="role"
                            required
                            class="select-field w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 outline-none transition focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                        >
                            <option value="">-- Pilih Role --</option>

                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>

                            <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>
                                Guru
                            </option>

                            <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>
                                Siswa
                            </option>
                        </select>
                    </div>

                    {{-- LOGIN BUTTON --}}
                    <button
                        type="submit"
                        class="w-full py-3.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold shadow-lg shadow-blue-600/20 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-blue-600/25 active:translate-y-0"
                    >
                        Masuk
                    </button>
                </form>

                {{-- REGISTER --}}
                <div class="mt-7 text-center">
                    <p class="register-text text-sm text-slate-500">
                        Belum punya akun?
                        <a
                            href="{{ route('register') }}"
                            class="font-bold text-blue-600 hover:text-indigo-600 dark:text-blue-400 dark:hover:text-indigo-400 transition"
                        >
                            Daftar sekarang
                        </a>
                    </p>
                </div>

                {{-- BACK TO LANDING --}}
                <div class="mt-4 text-center">
                    <a
                        href="{{ route('landing') }}"
                        class="back-link inline-flex items-center gap-1 text-sm font-medium text-slate-500 hover:text-blue-600 transition"
                    >
                        ← Kembali ke halaman utama
                    </a>
                </div>
            </div>

            {{-- FOOTER --}}
            <p class="footer-text text-center text-xs text-slate-400 mt-6">
                © {{ date('Y') }} Sistem Akademik Mini
            </p>
        </div>
    </main>

    {{-- JAVASCRIPT --}}
    <script>
        // Tampilkan / sembunyikan password
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

        // Lupa password
        function toggleForgotPassword() {
            const info = document.getElementById('forgotPasswordInfo');
            const button = document.getElementById('forgotPasswordButton');
            const isHidden = info.classList.contains('hidden');

            info.classList.toggle('hidden');
            button.setAttribute('aria-expanded', String(isHidden));
        }

        // Role mengubah label username menjadi NIP atau NIS
        const roleSelect = document.getElementById('role');
        const identifierLabel = document.getElementById('identifierLabel');
        const identifierInput = document.getElementById('username');
        const identifierHelper = document.getElementById('identifierHelper');

        function updateIdentifierField() {
            if (roleSelect.value === 'guru') {
                identifierLabel.textContent = 'NIP';
                identifierInput.placeholder = 'Masukkan NIP';
                identifierHelper.textContent = 'Guru menggunakan NIP untuk login.';
            } else if (roleSelect.value === 'siswa') {
                identifierLabel.textContent = 'NIS';
                identifierInput.placeholder = 'Masukkan NIS';
                identifierHelper.textContent = 'Siswa menggunakan NIS untuk login.';
            } else {
                identifierLabel.textContent = 'Username';
                identifierInput.placeholder = 'Masukkan username';
                identifierHelper.textContent = 'Admin menggunakan username untuk login.';
            }
        }

        roleSelect.addEventListener('change', updateIdentifierField);
        updateIdentifierField();

        // Dark / light mode
        function updateThemeIcon() {
            const icon = document.getElementById('themeIcon');
            const isDark = document.documentElement.classList.contains('dark');

            icon.textContent = isDark ? '☀️' : '🌙';
        }

        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');

            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            updateThemeIcon();
        }

        updateThemeIcon();
    </script>
</body>

</html>
