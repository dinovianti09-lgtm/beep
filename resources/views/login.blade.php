<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Sistem Akademik Mini</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .pastel-gradient {
            background: linear-gradient(
                135deg,
                #f5f7fa 0%,
                #e4e8f0 50%,
                #c3cfe2 100%
            );
        }

        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 600ms linear;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        .modern-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow:
                0 8px 32px 0 rgba(31, 38, 135, 0.12),
                0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .input-elegant:focus {
            box-shadow:
                0 0 0 4px rgba(99, 102, 241, 0.12),
                0 4px 12px rgba(0, 0, 0, 0.08);
            border-color: #6366f1;
            transform: translateY(-2px);
        }

        .transition-all-smooth {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .decorative-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.35;
            animation: float-gentle 8s ease-in-out infinite;
        }

        @keyframes float-gentle {
            0%, 100% {
                transform: translateY(0px) scale(1);
            }

            50% {
                transform: translateY(-20px) scale(1.05);
            }
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .btn-shine {
            position: relative;
            overflow: hidden;
        }

        .btn-shine::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255,255,255,0.3),
                transparent
            );
            transition: left 0.6s;
        }

        .btn-shine:hover::before {
            left: 100%;
        }
    </style>
</head>

<body class="pastel-gradient min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    {{-- Decorative Background Circles --}}
    <div class="decorative-circle w-96 h-96 bg-indigo-300 top-0 left-0 -translate-x-1/2 -translate-y-1/2"></div>

    <div
        class="decorative-circle w-80 h-80 bg-purple-300 bottom-0 right-0 translate-x-1/3 translate-y-1/3"
        style="animation-delay: 2s;"
    ></div>

    <div
        class="decorative-circle w-72 h-72 bg-blue-300 top-1/2 right-1/4"
        style="animation-delay: 4s;"
    ></div>


    {{-- Main Card --}}
    <div class="modern-card w-full max-w-md rounded-3xl p-8 md:p-10 relative z-10">

        {{-- Header & Logo --}}
        <div class="text-center mb-8">

            <div class="inline-block mb-4 relative group">

                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl blur-lg opacity-25 group-hover:opacity-40 transition-all-smooth"></div>

                {{-- LOGO SISTEM AKADEMIK --}}
                <div class="relative w-20 h-20 mx-auto rounded-2xl overflow-hidden shadow-lg group-hover:shadow-xl transition-all-smooth group-hover:scale-105 bg-white">

                    <img
                        src="{{ asset('images/Logo sistem akademik mini.jpeg') }}"
                        alt="Logo Sistem Akademik Mini"
                        class="w-full h-full object-cover"
                    >

                </div>

            </div>


            <h1 class="text-3xl font-bold bg-gradient-to-r from-slate-800 to-slate-600 bg-clip-text text-transparent mb-2">
                Masuk ke Sistem
            </h1>

            <p class="text-sm text-slate-500 font-medium">
                Silakan masukkan kredensial Anda untuk melanjutkan
            </p>

        </div>


        {{-- Pesan Error jika Login Gagal --}}
        @if ($errors->any())

            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm shadow-sm flex items-start gap-3 animate-pulse">

                <svg
                    class="w-5 h-5 flex-shrink-0 mt-0.5"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd"
                    />
                </svg>

                <span>
                    {{ $errors->first() }}
                </span>

            </div>

        @endif


        {{-- Form Login --}}
        <form
            action="{{ route('login.process') }}"
            method="POST"
            class="space-y-5"
        >

            @csrf


            {{-- Username --}}
            <div class="group">

                <div class="relative">

                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-indigo-500 transition-all-smooth">

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                            ></path>
                        </svg>

                    </span>

                    <input
                        type="text"
                        name="username"
                        required
                        placeholder="Masukkan username"
                        class="input-elegant w-full pl-11 pr-4 py-3 bg-slate-50/80 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:bg-white transition-all-smooth"
                    >

                </div>

            </div>


            {{-- Password --}}
            <div class="group">

                <div class="relative">

                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-indigo-500 transition-all-smooth">

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                            ></path>
                        </svg>

                    </span>

                    <input
                        type="password"
                        name="password"
                        required
                        placeholder="••••••••"
                        class="input-elegant w-full pl-11 pr-4 py-3 bg-slate-50/80 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:bg-white transition-all-smooth"
                    >

                </div>

            </div>


            {{-- Masuk Sebagai --}}
            <div class="group">

                <label class="block text-xs font-semibold text-slate-600 mb-1.5 ml-1">
                    Masuk Sebagai:
                </label>

                <div class="relative">

                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-indigo-500 transition-all-smooth pointer-events-none">

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                            ></path>
                        </svg>

                    </span>

                    <select
                        name="role"
                        required
                        class="input-elegant w-full pl-11 pr-10 py-3 bg-slate-50/80 border border-slate-200 rounded-xl text-sm text-slate-800 focus:outline-none focus:bg-white transition-all-smooth appearance-none cursor-pointer"
                    >

                        <option value="admin">
                            Admin
                        </option>

                        <option value="guru">
                            Guru
                        </option>

                        <option value="siswa">
                            Siswa
                        </option>

                    </select>

                    <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 pointer-events-none">

                        <svg
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            ></path>
                        </svg>

                    </span>

                </div>

            </div>


            {{-- Remember + Lupa Password --}}
            <div class="flex items-center justify-between text-sm pt-1">

                <label class="flex items-center text-slate-600 cursor-pointer hover:text-slate-800 transition-all-smooth">

                    <input
                        type="checkbox"
                        name="remember"
                        class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 focus:ring-2 mr-2 transition-all-smooth w-4 h-4"
                    >

                    <span class="font-medium select-none">
                        Ingat Saya
                    </span>

                </label>


                <a
                    href="#"
                    class="text-indigo-600 hover:text-indigo-700 font-semibold hover:underline transition-all-smooth"
                >
                    Lupa Password?
                </a>

            </div>


            {{-- Tombol Login --}}
            <button
                type="submit"
                class="ripple-btn btn-shine relative w-full bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-600 hover:from-indigo-700 hover:via-purple-700 hover:to-indigo-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/50 transform hover:-translate-y-0.5 active:translate-y-0 transition-all-smooth overflow-hidden mt-2"
            >
                Masuk Sekarang
            </button>

        </form>


        {{-- Register --}}
        <p class="text-center text-sm text-slate-500 mt-8 font-medium">

            Belum punya akun?

            <a
                href="{{ route('register') }}"
                class="text-indigo-600 hover:text-indigo-700 font-bold hover:underline transition-all-smooth inline-block transform hover:scale-105 duration-200"
            >
                Daftar disini
            </a>

        </p>

    </div>


    {{-- Footer Credit --}}
    <div class="absolute bottom-4 text-slate-500/60 text-xs font-medium text-center w-full z-10">

        &copy; {{ date('Y') }} Sistem Akademik Mini

    </div>


    {{-- Ripple Effect JavaScript --}}
    <script>

        document.addEventListener('DOMContentLoaded', function() {

            function createRipple(event) {

                const button = event.currentTarget;

                const circle = document.createElement("span");

                const diameter = Math.max(
                    button.clientWidth,
                    button.clientHeight
                );

                const radius = diameter / 2;

                const rect = button.getBoundingClientRect();

                circle.style.width = circle.style.height = `${diameter}px`;

                circle.style.left =
                    `${event.clientX - rect.left - radius}px`;

                circle.style.top =
                    `${event.clientY - rect.top - radius}px`;

                circle.style.backgroundColor =
                    "rgba(255, 255, 255, 0.6)";

                circle.classList.add("ripple-effect");


                const ripple =
                    button.getElementsByClassName("ripple-effect")[0];

                if (ripple) {
                    ripple.remove();
                }

                button.appendChild(circle);

            }


            const buttons =
                document.querySelectorAll(".ripple-btn");


            for (const button of buttons) {
                button.addEventListener("click", createRipple);
            }

        });

    </script>

</body>
</html>