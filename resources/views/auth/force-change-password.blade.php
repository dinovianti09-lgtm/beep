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
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .password-input {
            padding-right: 3.25rem;
        }

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
            color: #64748b;
            border-radius: 0.5rem;
            transition: background-color 0.2s, color 0.2s;
        }

        .eye-button:hover {
            background-color: #eef2ff;
            color: #4f46e5;
        }

        .eye-button:focus-visible {
            outline: 2px solid #6366f1;
            outline-offset: 2px;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-100 px-4 py-8 text-slate-800">

    <main class="flex min-h-[calc(100vh-4rem)] items-center justify-center">

        <div class="w-full max-w-md">

            {{-- LOGO / IDENTITAS --}}
            <div class="mb-6 text-center">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-lg shadow-indigo-200">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         width="34"
                         height="34"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         aria-hidden="true">
                        <path d="M12 3 3 8l9 5 9-5-9-5Z"/>
                        <path d="m7 10.2 0 5.3c3.3 2.4 6.7 2.4 10 0v-5.3"/>
                        <path d="M21 8v6"/>
                    </svg>
                </div>

                <h1 class="text-2xl font-extrabold tracking-tight text-slate-800">
                    Sistem Akademik Mini
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Satu langkah lagi untuk mengamankan akunmu.
                </p>
            </div>

            {{-- KARTU GANTI PASSWORD --}}
            <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-200/70">

                <div class="h-1.5 bg-indigo-600"></div>

                <div class="p-6 sm:p-8">

                    <div class="mb-7">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
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

                        <h2 class="text-2xl font-extrabold text-slate-800">
                            Ganti Password
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Password akunmu sudah direset oleh Admin.
                            Buat password baru untuk melanjutkan ke dashboard.
                        </p>
                    </div>

                    {{-- PESAN ERROR --}}
                    @if ($errors->any())
                        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700" role="alert">
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

                    {{-- FORM --}}
                    <form method="POST" action="{{ route('password.force-change.process') }}">
                        @csrf

                        {{-- PASSWORD BARU --}}
                        <div class="mb-5">
                            <label for="password" class="mb-2 block text-sm font-bold text-slate-700">
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
                                    class="password-input w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100"
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

                            <p class="mt-2 text-xs text-slate-500">
                                Gunakan minimal 8 karakter, huruf besar, huruf kecil, dan angka.
                            </p>
                        </div>

                        {{-- KONFIRMASI PASSWORD --}}
                        <div class="mb-5">
                            <label for="password_confirmation" class="mb-2 block text-sm font-bold text-slate-700">
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
                                    class="password-input w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100"
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
                        <div class="mb-6 rounded-xl border border-indigo-100 bg-indigo-50/70 p-4">
                            <p class="mb-2 text-xs font-extrabold uppercase tracking-wide text-indigo-800">
                                Ketentuan Password
                            </p>

                            <ul class="space-y-2 text-xs leading-5 text-slate-600">
                                <li class="flex items-start gap-2">
                                    <span class="mt-0.5 font-bold text-indigo-600">✓</span>
                                    Minimal 8 karakter
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-0.5 font-bold text-indigo-600">✓</span>
                                    Mengandung huruf besar dan huruf kecil
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-0.5 font-bold text-indigo-600">✓</span>
                                    Mengandung angka
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-0.5 font-bold text-indigo-600">✓</span>
                                    Kedua kolom harus berisi password yang sama
                                </li>
                            </ul>
                        </div>

                        {{-- TOMBOL SIMPAN --}}
                        <button
                            type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3.5 text-sm font-extrabold text-white shadow-lg shadow-indigo-200 transition hover:-translate-y-0.5 hover:bg-indigo-700 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-indigo-200 active:translate-y-0"
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
                    <div class="mt-6 border-t border-slate-100 pt-5 text-center">
                        <p class="mb-2 text-xs text-slate-400">
                            Tidak ingin melanjutkan sekarang?
                        </p>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button
                                type="submit"
                                class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-bold text-slate-500 transition hover:bg-slate-100 hover:text-slate-800"
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
            <p class="mt-6 text-center text-xs text-slate-400">
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