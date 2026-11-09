
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password - Sistem Akademik Mini</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --edu-blue-1: #E3F0FA;
            --edu-blue-2: #C3E0F4;
            --edu-blue-3: #BAD1EC;
            --edu-blue-4: #A4BFDF;
            --edu-blue-5: #89AAD7;

            --edu-blue: #89AAD7;
            --edu-blue-dark: #527BA9;
            --edu-page: #F3F6FA;
            --edu-card: #F8FAFC;
            --edu-text: #293F57;
            --edu-muted: #60758B;
            --edu-border: #D7E3EF;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--edu-text);
            background:
                radial-gradient(
                    circle at 10% 12%,
                    rgba(195, 224, 244, 0.55),
                    transparent 32%
                ),
                radial-gradient(
                    circle at 90% 85%,
                    rgba(186, 209, 236, 0.4),
                    transparent 35%
                ),
                linear-gradient(
                    135deg,
                    #F3F6FA 0%,
                    #EDF4FA 55%,
                    #F6F5F0 100%
                );
            -webkit-font-smoothing: antialiased;
        }

        .auth-container {
            width: 100%;
            max-width: 470px;
            margin: 0 auto;
        }

        /* IDENTITAS EDUVIA */

        .brand-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 76px;
            height: 76px;
            margin: 0 auto 18px;
            padding: 9px;
            background: #FFFFFF;
            border: 1px solid #D7E3EF;
            border-radius: 20px;
            box-shadow:
                0 5px 14px rgba(70, 113, 160, 0.08),
                0 12px 28px rgba(70, 113, 160, 0.06);
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 12px;
        }

        .brand-title {
            color: #244B79;
            font-size: 25px;
            font-weight: 800;
            line-height: 1.35;
            letter-spacing: -0.8px;
        }

        .brand-subtitle {
            margin-top: 8px;
            color: #60758B;
            font-size: 13px;
            font-weight: 500;
            line-height: 1.7;
        }

        /* KARTU FORM */

        .auth-card {
            position: relative;
            overflow: hidden;
            background: rgba(248, 250, 252, 0.98);
            border: 1px solid #D7E3EF;
            border-radius: 22px;
            box-shadow:
                0 6px 18px rgba(47, 82, 124, 0.045),
                0 20px 45px rgba(47, 82, 124, 0.055);
        }

        .auth-card-top {
            height: 5px;
            background: linear-gradient(
                90deg,
                #89AAD7 0%,
                #A4BFDF 50%,
                #C3E0F4 100%
            );
        }

        .security-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            margin-bottom: 18px;
            color: #527BA9;
            background: #E3F0FA;
            border: 1px solid #C3E0F4;
            border-radius: 14px;
        }

        .form-title {
            color: #29435F;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.6px;
            line-height: 1.4;
        }

        .form-description {
            margin-top: 9px;
            color: #60758B;
            font-size: 13px;
            font-weight: 500;
            line-height: 1.85;
        }

        /* LABEL DAN INPUT */

        .form-label {
            display: block;
            margin-bottom: 9px;
            color: #344F6D;
            font-size: 13px;
            font-weight: 800;
        }

        .password-input {
            display: block;
            width: 100%;
            height: 51px;
            padding: 0 3.25rem 0 15px;
            color: #293F57;
            background: #FFFFFF;
            border: 1px solid #C9D8E8;
            border-radius: 12px;
            outline: none;
            font-size: 13px;
            font-weight: 500;
            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background-color 0.2s ease;
        }

        .password-input::placeholder {
            color: #91A2B6;
            font-weight: 400;
        }

        .password-input:hover {
            border-color: #A4BFDF;
        }

        .password-input:focus {
            background: #FFFFFF;
            border-color: #89AAD7;
            box-shadow: 0 0 0 4px rgba(137, 170, 215, 0.18);
        }

        /* TOMBOL MATA */

        .eye-button {
            position: absolute;
            right: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            color: #60758B;
            border-radius: 0.5rem;
            transition:
                background-color 0.2s,
                color 0.2s;
        }

        .eye-button:hover {
            background-color: #E3F0FA;
            color: #294F79;
        }

        .eye-button:focus-visible {
            outline: 2px solid #89AAD7;
            outline-offset: 2px;
        }

        .input-hint {
            margin-top: 8px;
            color: #71869B;
            font-size: 11px;
            font-weight: 500;
            line-height: 1.7;
        }

        /* KETENTUAN PASSWORD */

        .password-rules {
            padding: 17px;
            background: linear-gradient(
                135deg,
                #E3F0FA 0%,
                #EDF5FC 100%
            );
            border: 1px solid #C3E0F4;
            border-radius: 13px;
        }

        .rules-title {
            margin-bottom: 11px;
            color: #294F79;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        .rules-list {
            display: flex;
            flex-direction: column;
            gap: 9px;
            color: #526B85;
            font-size: 11px;
            font-weight: 600;
            line-height: 1.7;
        }

        .rule-check {
            flex-shrink: 0;
            color: #527BA9;
            font-weight: 800;
        }

        /* TOMBOL SIMPAN */

        .submit-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            min-height: 51px;
            padding: 13px 20px;
            color: #233B55;
            background: #89AAD7;
            border: 1px solid #89AAD7;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 5px 13px rgba(82, 123, 169, 0.15);
            transition:
                background-color 0.2s ease,
                box-shadow 0.2s ease,
                transform 0.2s ease;
        }

        .submit-button:hover {
            background: #A4BFDF;
            box-shadow: 0 7px 17px rgba(82, 123, 169, 0.18);
            transform: translateY(-1px);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        .submit-button:focus-visible {
            outline: 3px solid rgba(137, 170, 215, 0.45);
            outline-offset: 3px;
        }

        /* TOMBOL KELUAR */

        .logout-area {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #DCE6F0;
            text-align: center;
        }

        .logout-description {
            margin-bottom: 9px;
            color: #8293A5;
            font-size: 11px;
        }

        .logout-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 10px 15px;
            color: #60758B;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition:
                background-color 0.2s,
                color 0.2s;
        }

        .logout-button:hover {
            color: #29435F;
            background: #E3F0FA;
        }

        .logout-button:focus-visible {
            outline: 2px solid #89AAD7;
            outline-offset: 2px;
        }

        /* FOOTER */

        .auth-footer {
            margin-top: 23px;
            color: #8293A5;
            font-size: 11px;
            font-weight: 500;
            line-height: 1.8;
            text-align: center;
        }

        /* RESPONSIVE HP */

        @media (max-width: 640px) {
            body {
                padding: 20px 14px;
            }

            .brand-logo {
                width: 68px;
                height: 68px;
                margin-bottom: 15px;
            }

            .brand-title {
                font-size: 21px;
            }

            .brand-subtitle {
                font-size: 12px;
            }

            .auth-card {
                border-radius: 18px;
            }

            .auth-card-content {
                padding: 23px 20px;
            }

            .form-title {
                font-size: 22px;
            }

            .form-description {
                font-size: 12px;
            }

            .password-input {
                font-size: 14px;
            }
        }
    </style>
</head>

<body class="min-h-screen px-4 py-8">

    <main class="flex min-h-[calc(100vh-4rem)] items-center justify-center">

        <div class="auth-container">

            {{-- LOGO / IDENTITAS EDUVIA --}}
            <div class="mb-7 text-center">

                <div class="brand-logo">
                    <img
                        src="{{ asset('images/Logo sistem akademik mini.jpeg') }}"
                        alt="Logo Sistem Akademik Mini"
                    >
                </div>

                <h1 class="brand-title">
                    Sistem Akademik Mini
                </h1>

                <p class="brand-subtitle">
                    Satu langkah lagi untuk mengamankan akunmu.
                </p>

            </div>

            {{-- KARTU GANTI PASSWORD --}}
            <section class="auth-card">

                <div class="auth-card-top"></div>

                <div class="auth-card-content p-6 sm:p-8">

                    <div class="mb-7">

                        <div class="security-icon">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="25"
                                 height="25"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 aria-hidden="true">
                                <rect x="3" y="11" width="18" height="10" rx="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                <path d="m10 16 1.5 1.5L15 14"/>
                            </svg>
                        </div>

                        <h2 class="form-title">
                            Ganti Password
                        </h2>

                        <p class="form-description">
                            Password akunmu sudah direset oleh Admin.
                            Buat password baru untuk melanjutkan ke dashboard.
                        </p>

                    </div>

                    {{-- PESAN ERROR --}}
                    @if ($errors->any())
                        <div
                            class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700"
                            role="alert"
                        >
                            <div class="mb-2 flex items-center gap-2 font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="18"
                                     height="18"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2"
                                     aria-hidden="true">
                                    <circle cx="12" cy="12" r="10"/>
                                    <path d="M12 8v4m0 4h.01"/>
                                </svg>

                                Password belum berhasil disimpan
                            </div>

                            <ul class="list-inside list-disc space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- FORM GANTI PASSWORD --}}
                    <form method="POST" action="{{ route('password.force-change.process') }}">
                        @csrf

                        {{-- PASSWORD BARU --}}
                        <div class="mb-5">

                            <label for="password" class="form-label">
                                Password Baru
                            </label>

                            <div class="relative">

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    required
                                    minlength="8"
                                    autocomplete="new-password"
                                    class="password-input"
                                    placeholder="Masukkan password baru"
                                >

                                <button
                                    type="button"
                                    class="eye-button"
                                    data-password-toggle="password"
                                    aria-label="Lihat password baru"
                                    aria-pressed="false"
                                    title="Lihat password"
                                >
                                    <svg data-eye-icon xmlns="http://www.w3.org/2000/svg"
                                         width="20"
                                         height="20"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         aria-hidden="true">
                                        <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>

                            </div>

                            <p class="input-hint">
                                Gunakan minimal 8 karakter, huruf besar, huruf kecil, dan angka.
                            </p>

                        </div>

                        {{-- KONFIRMASI PASSWORD --}}
                        <div class="mb-5">

                            <label for="password_confirmation" class="form-label">
                                Konfirmasi Password Baru
                            </label>

                            <div class="relative">

                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    required
                                    minlength="8"
                                    autocomplete="new-password"
                                    class="password-input"
                                    placeholder="Ulangi password baru"
                                >

                                <button
                                    type="button"
                                    class="eye-button"
                                    data-password-toggle="password_confirmation"
                                    aria-label="Lihat konfirmasi password"
                                    aria-pressed="false"
                                    title="Lihat password"
                                >
                                    <svg data-eye-icon xmlns="http://www.w3.org/2000/svg"
                                         width="20"
                                         height="20"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         aria-hidden="true">
                                        <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>

                            </div>

                        </div>

                        {{-- PETUNJUK PASSWORD --}}
                        <div class="password-rules mb-6">

                            <p class="rules-title">
                                Ketentuan Password
                            </p>

                            <ul class="rules-list">

                                <li class="flex items-start gap-2">
                                    <span class="rule-check">✓</span>
                                    Minimal 8 karakter
                                </li>

                                <li class="flex items-start gap-2">
                                    <span class="rule-check">✓</span>
                                    Mengandung huruf besar dan huruf kecil
                                </li>

                                <li class="flex items-start gap-2">
                                    <span class="rule-check">✓</span>
                                    Mengandung angka
                                </li>

                                <li class="flex items-start gap-2">
                                    <span class="rule-check">✓</span>
                                    Kedua kolom harus berisi password yang sama
                                </li>

                            </ul>

                        </div>

                        {{-- TOMBOL SIMPAN --}}
                        <button
                            type="submit"
                            class="submit-button"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="19"
                                 height="19"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 aria-hidden="true">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z"/>
                                <path d="M17 21v-8H7v8M7 3v5h8"/>
                            </svg>

                            Simpan Password Baru
                        </button>

                    </form>

                    {{-- KELUAR --}}
                    <div class="logout-area">

                        <p class="logout-description">
                            Tidak ingin melanjutkan sekarang?
                        </p>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button
                                type="submit"
                                class="logout-button"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="17"
                                     height="17"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     aria-hidden="true">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                    <path d="m16 17 5-5-5-5"/>
                                    <path d="M21 12H9"/>
                                </svg>

                                Keluar dari Akun
                            </button>
                        </form>

                    </div>

                </div>
            </section>

            {{-- FOOTER --}}
            <p class="auth-footer">
                &copy; {{ date('Y') }} Sistem Akademik Mini
                <span class="mx-1">·</span>
                Semua hak dilindungi
            </p>

        </div>
    </main>

    {{-- SCRIPT LIHAT / SEMBUNYIKAN PASSWORD --}}
    <script>
        document.querySelectorAll('[data-password-toggle]').forEach(function (button) {
            button.addEventListener('click', function () {
                const inputId = button.getAttribute('data-password-toggle');
                const input = document.getElementById(inputId);

                if (!input) {
                    return;
                }

                const sedangTersembunyi = input.type === 'password';

                input.type = sedangTersembunyi ? 'text' : 'password';

                button.setAttribute('aria-pressed', String(sedangTersembunyi));
                button.setAttribute(
                    'aria-label',
                    sedangTersembunyi ? 'Sembunyikan password' : 'Lihat password'
                );
                button.setAttribute(
                    'title',
                    sedangTersembunyi ? 'Sembunyikan password' : 'Lihat password'
                );

                button.innerHTML = sedangTersembunyi
                    ? `<svg xmlns="http://www.w3.org/2000/svg"
                           width="20" height="20" viewBox="0 0 24 24"
                           fill="none" stroke="currentColor" stroke-width="1.8"
                           stroke-linecap="round" stroke-linejoin="round"
                           aria-hidden="true">
                           <path d="M3 3l18 18"/>
                           <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                           <path d="M9.9 5.2A11 11 0 0 1 12 5c6.4 0 10 7 10 7a15 15 0 0 1-4 4.8"/>
                           <path d="M6.6 6.6C3.7 8.4 2 12 2 12s3.6 7 10 7a10.5 10.5 0 0 0 3.1-.5"/>
                       </svg>`
                    : `<svg xmlns="http://www.w3.org/2000/svg"
                           width="20" height="20" viewBox="0 0 24 24"
                           fill="none" stroke="currentColor" stroke-width="1.8"
                           stroke-linecap="round" stroke-linejoin="round"
                           aria-hidden="true">
                           <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"/>
                           <circle cx="12" cy="12" r="3"/>
                       </svg>`;
            });
        });
    </script>

</body>
</html>
