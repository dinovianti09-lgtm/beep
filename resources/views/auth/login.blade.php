<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#E3F0FA">

    <title>Login - Sistem Akademik Mini</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        (() => {
            try {
                const theme = localStorage.getItem('admin-theme') || localStorage.getItem('theme');
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                }
            } catch (error) {}
        })();
    </script>

    <style>
        :root {
            color-scheme: light;
            --primary: #3478BD;
            --primary-hover: #285F96;
            --primary-soft: #E3F0FA;
            --page: #EAF3FA;
            --surface: #FFFFFF;
            --surface-soft: #F5F9FD;
            --left-panel: #DCECF8;
            --left-panel-end: #EAF3FA;
            --text: #293F57;
            --heading: #203B57;
            --muted: #526982;
            --border: #D5E1ED;
            --border-focus: #78AFE0;
            --input-bg: #F7FAFD;
            --success-bg: #E9F8F0;
            --success-border: #B8E5CC;
            --success-text: #21744B;
            --error-bg: #FEF0F0;
            --error-border: #F2C5C5;
            --error-text: #B93838;
            --shadow: 0 22px 65px rgba(48, 91, 130, 0.12);
        }

        html.dark {
            color-scheme: dark;
            --primary: #3478BD;
            --primary-hover: #5B99D2;
            --primary-soft: #243E59;
            --page: #17283D;
            --surface: #1C3049;
            --surface-soft: #243E59;
            --left-panel: #203B57;
            --left-panel-end: #243E59;
            --text: #E6EEF7;
            --heading: #F0F6FC;
            --muted: #B6C8DA;
            --border: #354962;
            --border-focus: #78AFE0;
            --input-bg: #243E59;
            --success-bg: rgba(22, 101, 52, 0.22);
            --success-border: #276346;
            --success-text: #86D8A9;
            --error-bg: rgba(127, 29, 29, 0.22);
            --error-border: #773A43;
            --error-text: #F2A0A0;
            --shadow: 0 22px 65px rgba(0, 0, 0, 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 16px;
            background: var(--page);
            color: var(--text);
            transition: background 0.4s ease, color 0.4s ease;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button, input, select {
            font-family: inherit;
        }

        button {
            cursor: pointer;
        }

        .hidden {
            display: none !important;
        }

        .page-background {
            position: fixed;
            inset: 0;
            z-index: -1;
            pointer-events: none;
            overflow: hidden;
            background:
                radial-gradient(circle at 10% 12%, rgba(120, 175, 224, 0.16), transparent 30%),
                radial-gradient(circle at 90% 85%, rgba(52, 120, 189, 0.08), transparent 32%),
                var(--page);
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
        }

        .auth-container {
            width: 100%;
            max-width: 1000px;
        }

        .auth-card {
            display: grid;
            grid-template-columns: 1fr 1.1fr;
            min-height: 600px;
            overflow: hidden;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            box-shadow: var(--shadow);
            animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
            transition: background 0.4s ease, border-color 0.4s ease, box-shadow 0.4s ease;
        }

        .intro-panel {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px 40px;
            overflow: hidden;
            background: linear-gradient(145deg, var(--left-panel), var(--left-panel-end));
            transition: background 0.4s ease;
        }

        .intro-panel::before {
            content: "";
            position: absolute;
            width: 350px;
            height: 350px;
            top: -150px;
            right: -150px;
            border: 1px solid rgba(52, 120, 189, 0.1);
            border-radius: 50%;
            pointer-events: none;
        }

        .intro-panel::after {
            content: "";
            position: absolute;
            width: 400px;
            height: 400px;
            bottom: -250px;
            left: -200px;
            border: 1px solid rgba(52, 120, 189, 0.08);
            border-radius: 50%;
            pointer-events: none;
        }

        .intro-brand {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-logo {
            width: 56px;
            height: 56px;
            flex-shrink: 0;
            padding: 4px;
            border-radius: 14px;
            background: #FFFFFF;
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 8px 20px rgba(38, 83, 122, 0.1);
            overflow: hidden;
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            object-fit: cover;
        }

        .brand-name {
            color: #293F57;
            font-size: 16px;
            font-weight: 800;
            line-height: 1.3;
        }

        .brand-subtitle {
            margin-top: 4px;
            color: #526982;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        html.dark .brand-name {
            color: #F0F6FC;
        }

        html.dark .brand-subtitle {
            color: #C1D2E2;
        }

        .intro-content {
            position: relative;
            z-index: 2;
            margin: 40px 0;
        }

        .intro-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border: 1px solid rgba(52, 120, 189, 0.15);
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(8px);
            color: #285F96;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        html.dark .intro-label {
            background: rgba(255, 255, 255, 0.08);
            color: #B8D8F4;
            border-color: rgba(255, 255, 255, 0.12);
        }

        .intro-label span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #3478BD;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .intro-content h1 {
            max-width: 380px;
            margin-top: 24px;
            color: #203B57;
            font-size: clamp(32px, 4vw, 40px);
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .intro-content h1 span {
            color: #3478BD;
        }

        .intro-content p {
            max-width: 360px;
            margin-top: 16px;
            color: #526982;
            font-size: 15px;
            line-height: 1.7;
        }

        html.dark .intro-content h1 {
            color: #F0F6FC;
        }

        html.dark .intro-content h1 span {
            color: #9BCBF0;
        }

        html.dark .intro-content p {
            color: #C1D2E2;
        }

        .intro-decoration {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 280px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 40px;
        }

        .intro-decoration span {
            height: 6px;
            border-radius: 20px;
            background: #3478BD;
        }

        .intro-decoration span:nth-child(1) { width: 50px; }
        .intro-decoration span:nth-child(2) { width: 30px; opacity: 0.5; }
        .intro-decoration span:nth-child(3) { width: 15px; opacity: 0.25; }

        .intro-footer {
            position: relative;
            z-index: 2;
            padding-top: 20px;
            border-top: 1px solid rgba(52, 95, 135, 0.15);
            color: #526982;
            font-size: 12px;
        }

        html.dark .intro-footer {
            color: #B6C8DA;
            border-color: #405872;
        }

        .form-panel {
            display: flex;
            flex-direction: column;
            padding: 48px 56px;
            background: var(--surface);
        }

        .form-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .form-top-label {
            color: var(--muted);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .theme-button {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--surface-soft);
            color: var(--text);
            font-size: 18px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .theme-button:hover {
            background: var(--primary-soft);
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .form-inner {
            width: 100%;
            max-width: 400px;
            margin: auto;
            padding: 32px 0;
        }

        .form-heading {
            margin-bottom: 32px;
        }

        .form-heading h2 {
            color: var(--heading);
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.5px;
            line-height: 1.3;
        }

        .form-heading p {
            margin-top: 8px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
        }

        .alert {
            margin-bottom: 24px;
            padding: 14px 16px;
            border: 1px solid;
            border-radius: 12px;
        }

        .success-box {
            background: var(--success-bg);
            border-color: var(--success-border);
        }

        .success-text {
            color: var(--success-text);
            font-size: 13px;
            font-weight: 600;
        }

        .error-box {
            background: var(--error-bg);
            border-color: var(--error-border);
        }

        .error-title {
            margin-bottom: 6px;
            color: var(--error-text);
            font-size: 13px;
            font-weight: 800;
        }

        .error-text {
            color: var(--error-text);
            font-size: 12px;
            line-height: 1.7;
        }

        .error-text li {
            list-style: none;
            margin-bottom: 4px;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            width: 100%;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--text);
            font-size: 13px;
            font-weight: 700;
        }

        .input-wrapper {
            position: relative;
        }

        .input-field, .select-field {
            display: block;
            width: 100%;
            min-height: 50px;
            padding: 12px 16px;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            background: var(--input-bg);
            color: var(--text);
            font-size: 14px;
            font-weight: 500;
            outline: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-field::placeholder {
            color: #94A7B9;
        }

        html.dark .input-field::placeholder {
            color: #A0B3C7;
        }

        .input-field:focus, .select-field:focus {
            border-color: var(--primary);
            background: var(--surface);
            box-shadow: 0 0 0 4px rgba(52, 120, 189, 0.1);
            transform: translateY(-1px);
        }

        .select-field {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23526982'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 18px;
            padding-right: 40px;
        }

        .select-field option {
            background: var(--surface);
            color: var(--text);
        }

        .helper-text {
            display: block;
            margin-top: 8px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .password-input {
            padding-right: 50px;
        }

        .password-toggle {
            position: absolute;
            top: 0;
            right: 0;
            width: 50px;
            height: 50px;
            display: grid;
            place-items: center;
            border: 0;
            background: transparent;
            color: var(--muted);
            transition: color 0.2s ease;
        }

        .password-toggle:hover {
            color: var(--primary);
        }

        .password-toggle svg {
            width: 20px;
            height: 20px;
        }

        .password-toggle svg.hidden {
            display: none;
        }

        .forgot-row {
            display: flex;
            justify-content: flex-end;
            margin-top: -8px;
        }

        .forgot-button {
            padding: 4px 0;
            border: none;
            background: transparent;
            color: var(--primary);
            font-size: 13px;
            font-weight: 700;
            transition: color 0.2s ease;
        }

        .forgot-button:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        .forgot-box {
            padding: 20px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: var(--surface-soft);
            margin-top: 16px;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .forgot-box h3 {
            color: var(--text);
            font-size: 14px;
            font-weight: 800;
        }

        .forgot-box p {
            margin-top: 10px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .whatsapp-button {
            width: 100%;
            min-height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 18px;
            padding: 12px;
            border: none;
            border-radius: 12px;
            background: #25D366;
            color: white;
            font-size: 13px;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .whatsapp-button:hover {
            background: #128C7E;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 211, 102, 0.25);
        }

        .whatsapp-button svg {
            width: 18px;
            height: 18px;
        }

        .submit-button {
            position: relative;
            width: 100%;
            min-height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 8px;
            padding: 14px 20px;
            border: none;
            border-radius: 12px;
            background: var(--primary);
            color: white;
            font-size: 15px;
            font-weight: 700;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(52, 120, 189, 0.25);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .submit-button:hover {
            background: var(--primary-hover);
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(52, 120, 189, 0.35);
        }

        .submit-button:active {
            transform: translateY(-1px) scale(0.98);
        }

        .register-area {
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--border);
            text-align: center;
        }

        .register-text {
            color: var(--muted);
            font-size: 13px;
        }

        .register-link {
            margin-left: 4px;
            color: var(--primary);
            font-weight: 700;
            transition: color 0.2s ease;
        }

        .register-link:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        .back-link-wrapper {
            margin-top: 16px;
            text-align: center;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .back-link:hover {
            color: var(--primary);
            transform: translateX(-4px);
        }

        .page-footer {
            padding-top: 24px;
            color: var(--muted);
            text-align: center;
            font-size: 12px;
        }

        .ripple {
            position: absolute;
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s linear;
            background: rgba(255, 255, 255, 0.3);
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 850px) {
            .auth-card {
                grid-template-columns: 0.9fr 1.1fr;
            }

            .intro-panel {
                padding: 36px 28px;
            }

            .form-panel {
                padding: 36px 32px;
            }
        }

        @media (max-width: 650px) {
            .page-wrapper {
                padding: 20px 16px;
            }

            .auth-card {
                grid-template-columns: 1fr;
                min-height: auto;
                border-radius: 20px;
            }

            .intro-panel {
                min-height: 260px;
                padding: 32px 24px;
            }

            .intro-content {
                margin: 32px 0 16px;
            }

            .intro-content h1 {
                font-size: 28px;
            }

            .intro-content p {
                font-size: 14px;
            }

            .intro-footer {
                display: none;
            }

            .form-panel {
                padding: 32px 24px 40px;
            }

            .form-inner {
                max-width: 100%;
                padding: 24px 0 0;
            }
        }

        @media (max-width: 390px) {
            .page-wrapper {
                padding: 12px;
            }

            .intro-panel {
                padding: 24px 20px;
            }

            .form-panel {
                padding: 24px 20px 32px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>

<body>
    <div class="page-background"></div>

    <main class="page-wrapper">
        <div class="auth-container">
            <div class="auth-card">

                <!-- PANEL KIRI -->
                <aside class="intro-panel">
                    <a href="{{ route('landing') }}" class="intro-brand">
                        <div class="brand-logo">
                            <img src="{{ asset('images/Logo sistem akademik mini.jpeg') }}" alt="Logo Sistem Akademik Mini">
                        </div>

                        <div>
                            <div class="brand-name">Sistem Akademik Mini</div>
                            <div class="brand-subtitle">SISTEM INFORMASI AKADEMIK SEKOLAH</div>
                        </div>
                    </a>

                    <div class="intro-content">
                        <div class="intro-label">
                            <span></span>
                            PORTAL AKADEMIK SEKOLAH
                        </div>

                        <h1>Selamat Datang di <span>Sistem Akademik Mini.</span></h1>

                        <p>
                            Silakan masuk menggunakan akun yang telah terdaftar
                            untuk mengakses sistem akademik sesuai dengan hak
                            akses masing-masing.
                        </p>

                        <div class="intro-decoration">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>

                    <div class="intro-footer">
                        Sistem Informasi Akademik Sekolah
                    </div>
                </aside>

                <!-- PANEL KANAN -->
                <section class="form-panel">

                    <div class="form-topbar">
                        <span class="form-top-label">LOGIN AKUN</span>

                        <button
                            type="button"
                            onclick="toggleTheme()"
                            class="theme-button"
                            id="themeButton"
                            aria-label="Ganti tema"
                            title="Ganti tema"
                        >
                            <span id="themeIcon">🌙</span>
                        </button>
                    </div>

                    <div class="form-inner">

                        <div class="form-heading">
                            <h2>Masuk ke Akun</h2>
                            <p>Masukkan informasi username dan password untuk melanjutkan.</p>
                        </div>

                        @if (session('success'))
                            <div class="alert success-box">
                                <p class="success-text">{{ session('success') }}</p>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert error-box">
                                <p class="error-title">Login gagal</p>

                                <ul class="error-text">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('login.process') }}" method="POST" class="login-form">
                            @csrf

                            <!-- USERNAME -->
                            <div class="form-group">
                                <label for="username" id="identifierLabel" class="form-label">
                                    Username
                                </label>

                                <input
                                    type="text"
                                    id="username"
                                    name="username"
                                    value="{{ old('username') }}"
                                    placeholder="Masukkan username Anda"
                                    required
                                    autocomplete="username"
                                    class="input-field"
                                >

                                <small id="identifierHelper" class="helper-text">
                                Pilih role di bawah untuk menentukan identitas login.
                                </small>
                            </div>

                            <!-- PASSWORD -->
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>

                                <div class="input-wrapper">
                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        placeholder="Masukkan password"
                                        required
                                        autocomplete="current-password"
                                        class="input-field password-input"
                                    >

                                    <button
                                        type="button"
                                        id="togglePassword"
                                        class="password-toggle"
                                        aria-label="Tampilkan password"
                                        title="Tampilkan password"
                                    >
                                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 4.5 12 4.5c4.64 0 8.577 3.01 9.964 7.178.08.24.08.498 0 .644C20.577 16.49 16.64 19.5 12 19.5c-4.64 0-8.577-3.01-9.964-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>

                                        <svg id="eyeOffIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="hidden">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.58 10.58a2 2 0 002.84 2.84" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 5.09A10.8 10.8 0 0112 4.5c4.64 0 8.58 3.01 9.96 7.18a10.8 10.8 0 01-3.06 4.4" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.61 6.61a10.8 10.8 0 00-4.57 5.07 10.8 10.8 0 005.09 5.83A10.8 10.8 0 0012 19.5" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- ROLE -->
                            <div class="form-group">
                                <label for="role" class="form-label">Login sebagai</label>

                                <select id="role" name="role" required class="select-field">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                                    <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                </select>
                            </div>

                            <!-- LUPA PASSWORD -->
                            <div class="forgot-row">
                                <button
                                    type="button"
                                    onclick="toggleForgotPassword()"
                                    class="forgot-button"
                                    id="forgotPasswordButton"
                                    aria-expanded="false"
                                >
                                    Lupa Password?
                                </button>
                            </div>

                            <div id="forgotPasswordInfo" class="forgot-box hidden">
                                <h3>Lupa password akunmu?</h3>

                                <p>
                                    Silakan hubungi Admin sekolah melalui WhatsApp
                                    untuk meminta reset password. Sertakan identitas
                                    sesuai jenis akun agar Admin dapat memeriksa akunmu.
                                </p>

                                <p>
                                    Admin akan membuat password sementara. Setelah login,
                                    ikuti petunjuk untuk mengganti password jika diminta sistem.
                                </p>

                                <p>
                                    Jangan membagikan password kepada orang lain
                                    atau melalui grup umum.
                                </p>

                                <a
                                    id="whatsappAdminLink"
                                    href="https://wa.me/6285645075402?text=Halo%20Admin%2C%20saya%20ingin%20meminta%20bantuan%20untuk%20reset%20password%20akun%20Sistem%20Akademik%20Mini.%0A%0ABerikut%20identitas%20saya%3A%0A-%20Jika%20siswa%3A%20Nama%20lengkap%2C%20kelas%2C%20dan%20NIS.%0A-%20Jika%20guru%3A%20Nama%20lengkap%20dan%20NIP.%0A%0AMohon%20bantuannya%20untuk%20melakukan%20reset%20password%20akun%20saya.%20Terima%20kasih."
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="whatsapp-button"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12.04 2a9.87 9.87 0 0 0-8.48 14.93L2 22l5.25-1.38A10 10 0 1 0 12.04 2Zm0 18.2a8.2 8.2 0 0 1-4.18-1.14l-.3-.18-3.12.82.83-3.04-.2-.31a8.17 8.17 0 1 1 6.97 3.85Zm4.49-6.12c-.25-.13-1.47-.73-1.7-.81-.23-.08-.4-.13-.56.13-.17.25-.65.81-.8.98-.15.17-.3.19-.55.06-.25-.12-1.05-.39-2-.1-.74-.68-1.23-1.52-1.38-1.77-.15-.25-.02-.39.11-.52.11-.11.25-.3.37-.44.12-.15.16-.25.25-.42.08-.17.04-.31-.02-.44-.06-.12-.56-1.35-.77-1.85-.2-.48-.4-.42-.56-.43h-.48c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.09s.9 2.43 1.03 2.6c.12.17 1.77 2.7 4.29 3.79.6.26 1.07.41 1.44.52.6.19 1.15.16 1.58.1.48-.07 1.47-.6 1.68-1.19.21-.59.21-1.1.15-1.2-.06-.11-.23-.17-.48-.3Z"/>
                                    </svg>

                                    Hubungi Admin via WhatsApp
                                </a>
                            </div>

                            <!-- TOMBOL LOGIN -->
                            <button type="submit" class="submit-button ripple-button">
                                Masuk ke Akun
                                <span>→</span>
                            </button>
                        </form>

                        <!-- REGISTER -->
                        <div class="register-area">
                            <p class="register-text">
                                Belum punya akun?
                                <a href="{{ route('register') }}" class="register-link">
                                    Daftar sekarang
                                </a>
                            </p>

                            <div class="back-link-wrapper">
                                <a href="{{ route('landing') }}" class="back-link">
                                    <span>←</span>
                                    Kembali ke halaman utama
                                </a>
                            </div>
                        </div>

                    </div>
                </section>

            </div>

            <div class="page-footer">
                © {{ date('Y') }} Sistem Akademik Mini
            </div>
        </div>
    </main>

    <script>
        // 1. TAMPILKAN / SEMBUNYIKAN PASSWORD

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


        // 2. LUPA PASSWORD

        function toggleForgotPassword() {
            const info = document.getElementById('forgotPasswordInfo');
            const button = document.getElementById('forgotPasswordButton');

            const isHidden = info.classList.contains('hidden');

            info.classList.toggle('hidden');

            button.setAttribute(
                'aria-expanded',
                isHidden ? 'true' : 'false'
            );
        }


        // 3. MENYESUAIKAN IDENTITAS BERDASARKAN ROLE

        const roleSelect = document.getElementById('role');
        const identifierLabel = document.getElementById('identifierLabel');
        const identifierInput = document.getElementById('username');
        const identifierHelper = document.getElementById('identifierHelper');

        function updateIdentifierField() {

            if (roleSelect.value === 'admin') {

                identifierLabel.textContent = 'Username';
                identifierInput.placeholder = 'Masukkan username';
                identifierHelper.textContent = 'Admin menggunakan username untuk login.';

            } else if (roleSelect.value === 'guru') {

                identifierLabel.textContent = 'NIP';
                identifierInput.placeholder = 'Masukkan NIP';
                identifierHelper.textContent = 'Guru menggunakan NIP untuk login.';

            } else if (roleSelect.value === 'siswa') {

                identifierLabel.textContent = 'NIS';
                identifierInput.placeholder = 'Masukkan NIS';
                identifierHelper.textContent = 'Siswa menggunakan NIS untuk login.';

           } else {

    identifierLabel.textContent = 'Username';
    identifierInput.placeholder = 'Pilih role terlebih dahulu';
    identifierHelper.textContent = 'Pilih role di bawah untuk menentukan identitas login.';

}
        }

        roleSelect.addEventListener('change', updateIdentifierField);

        // Menyesuaikan juga ketika halaman dibuka kembali setelah validasi gagal.
        updateIdentifierField();


        // 4. DARK / LIGHT MODE

        function updateThemeIcon() {
            const icon = document.getElementById('themeIcon');
            const isDark = document.documentElement.classList.contains('dark');

            icon.textContent = isDark ? '☀️' : '🌙';

            document.querySelector('meta[name="theme-color"]').setAttribute(
                'content',
                isDark ? '#17283D' : '#E3F0FA'
            );
        }

        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');

            try {
                localStorage.setItem('admin-theme', isDark ? 'dark' : 'light');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
            } catch (error) {
                console.warn('Pengaturan tema tidak dapat disimpan.');
            }

            updateThemeIcon();
        }

        updateThemeIcon();


        // 5. RIPPLE EFFECT

        document.querySelectorAll('.ripple-button').forEach(function (button) {

            button.addEventListener('click', function (event) {

                const rect = button.getBoundingClientRect();
                const size = Math.max(button.clientWidth, button.clientHeight);

                const circle = document.createElement('span');

                circle.className = 'ripple';
                circle.style.width = size + 'px';
                circle.style.height = size + 'px';

                circle.style.left =
                    (event.clientX - rect.left - size / 2) + 'px';

                circle.style.top =
                    (event.clientY - rect.top - size / 2) + 'px';

                const oldRipple = button.querySelector('.ripple');

                if (oldRipple) {
                    oldRipple.remove();
                }

                button.appendChild(circle);

                setTimeout(function () {
                    circle.remove();
                }, 650);

            });

        });

    </script>

</body>
</html>