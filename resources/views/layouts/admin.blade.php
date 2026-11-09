<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard Admin - Sistem Akademik Mini')</title>

    {{-- PENGATURAN TEMA --}}
    <script>
        try {
            if (localStorage.getItem('admin-theme') === 'dark') {
                document.documentElement.classList.add('dark');
            }
        } catch (e) {}
    </script>

    <script src="https://cdn.tailwindcss.com"></script>

    {{-- FONT --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif']
                    }
                }
            }
        };
    </script>

    <style>
        /* =========================================
           PALET WARNA EDUVIA
        ========================================= */

        :root {
            --edu-blue-1: #E3F0FA;
            --edu-blue-2: #C3E0F4;
            --edu-blue-3: #BAD1EC;
            --edu-blue-4: #A4BFDF;
            --edu-blue-5: #89AAD7;

            --edu-blue: #89AAD7;
            --edu-blue-dark: #89AAD7;
            --edu-blue-soft: #E3F0FA;

            --edu-page: #F3F6FA;
            --edu-card: #F8FAFC;

            --edu-text: #293F57;
            --edu-muted: #60758B;
            --edu-border: #D7E3EF;
        }

        /* =========================================
           FONT DASAR
        ========================================= */

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 100px;
        }

        body {
            margin: 0;
            background: var(--edu-page);
            color: var(--edu-text);
            font-size: 14px;
            line-height: 1.65;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body.sidebar-open {
            overflow: hidden;
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }

        a {
            -webkit-tap-highlight-color: transparent;
        }

        /* =========================================
           LATAR HALAMAN
        ========================================= */

        .page-surface {
            min-height: 100vh;
            min-width: 0;

            background: linear-gradient(
                135deg,
                #F3F6FA 0%,
                #EDF4FA 55%,
                #F6F5F0 100%
            );
        }

        /* =========================================
           HIERARKI FONT KONTEN
        ========================================= */

        .admin-content h1 {
            color: #29435F;
            font-size: clamp(25px, 2vw, 28px);
            font-weight: 800;
            line-height: 1.3;
            letter-spacing: -.65px;
        }

        .admin-content h2 {
            color: #304B69;
            font-size: clamp(21px, 1.7vw, 24px);
            font-weight: 800;
            line-height: 1.35;
            letter-spacing: -.4px;
        }

        .admin-content h3 {
            color: #304B69;
            font-size: 18px;
            font-weight: 800;
            line-height: 1.45;
        }

        .admin-content h4 {
            color: #344F6D;
            font-size: 15px;
            font-weight: 800;
            line-height: 1.5;
        }

        .admin-content label {
            color: #3C526A;
            font-size: 13px;
            font-weight: 800;
            line-height: 1.55;
        }

        /* =========================================
           SIDEBAR
        ========================================= */

        .admin-sidebar {
            position: relative;
            isolation: isolate;

            display: flex;
            flex-direction: column;

            overflow: hidden;

            color: #304863;

            background: linear-gradient(
                160deg,
                #E3F0FA 0%,
                #C3E0F4 52%,
                #BAD1EC 100%
            );

            border-right: 1px solid #A4BFDF;
        }

        .admin-sidebar::before {
            content: "";
            position: absolute;
            z-index: -1;

            width: 260px;
            height: 260px;

            right: -150px;
            top: 180px;

            border-radius: 50%;

            background: radial-gradient(
                circle,
                rgba(255, 255, 255, .35),
                rgba(255, 255, 255, 0) 70%
            );

            pointer-events: none;
        }

        /* =========================================
           SIDEBAR DESKTOP
        ========================================= */

        @media (min-width: 768px) {

            .admin-sidebar {
                position: sticky;
                top: 0;

                width: 16rem;
                height: 100vh;
                min-height: 100vh;
                max-height: 100vh;

                flex: 0 0 16rem;

                align-self: flex-start;
            }

            .sidebar-scroll {
                min-height: 0;
                flex: 1 1 auto;

                overflow-x: hidden;
                overflow-y: auto;

                overscroll-behavior: contain;
            }

            .sidebar-brand,
            .sidebar-footer,
            .sidebar-profile-wrapper {
                flex-shrink: 0;
            }
        }

        /* =========================================
           LOGO DAN NAMA APLIKASI
        ========================================= */

        .sidebar-brand {
            border-bottom: 1px solid rgba(89, 137, 190, .26);
        }

        .brand-logo {
            border: 1px solid rgba(255, 255, 255, .95);

            box-shadow:
                0 3px 0 rgba(82, 142, 208, .10),
                0 7px 15px rgba(65, 112, 175, .12);
        }

        .brand-name {
            color: #244B79;
            font-size: 14px;
            font-weight: 800;
            line-height: 1.4;
            letter-spacing: -.4px;
        }

        .brand-subtitle {
            color: #496887;
            font-weight: 700;
        }

        /* =========================================
           KARTU PROFIL SIDEBAR
        ========================================= */

        .profile-card {
            background: rgba(255, 255, 255, .68);
            border: 1px solid rgba(255, 255, 255, .85);
            border-radius: 14px;

            box-shadow: 0 3px 10px rgba(54, 100, 151, .06);
        }

        /* =========================================
           MENU SIDEBAR
        ========================================= */

        .sidebar-heading {
            color: #536F8D;
        }

        .sidebar-link,
        .sidebar-active {
            display: flex;
            align-items: center;
            gap: 12px;

            min-height: 44px;
            padding: 10px 13px;

            border: 1px solid transparent;
            border-radius: 10px;

            text-decoration: none;

            transition:
                background .2s ease,
                color .2s ease,
                border-color .2s ease,
                box-shadow .2s ease,
                transform .2s ease;
        }

        .sidebar-link {
            color: #3C5877;
            font-weight: 700;
        }

        .sidebar-link:hover {
            color: #29435F;
            background: #E3F0FA;
            border-color: #A4BFDF;

            box-shadow: 0 3px 9px rgba(52, 104, 163, .08);

            transform: translateX(2px);
        }

        .sidebar-active {
            color: #233B55 !important;
            background: #89AAD7;
            border-color: #89AAD7;

            box-shadow:
                0 4px 10px rgba(42, 104, 174, .16),
                inset 0 1px 0 rgba(255, 255, 255, .18);

            font-weight: 800;
        }

        .sidebar-active svg {
            color: #233B55;
        }

        /* =========================================
           SCROLLBAR SIDEBAR
        ========================================= */

        .sidebar-scroll {
            scrollbar-width: thin;
            scrollbar-color: #89AAD7 transparent;
        }

        .sidebar-scroll::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #89AAD7;
            border-radius: 20px;
        }

        .sidebar-footer {
            border-top: 1px solid rgba(89, 137, 190, .26);
        }

        /* =========================================
           TOMBOL TUTUP SIDEBAR
        ========================================= */

        .mobile-sidebar-close {
            display: none;
        }

        /* =========================================
           TOMBOL HAMBURGER
        ========================================= */

        .mobile-menu-toggle {
            display: none;

            width: 42px;
            height: 42px;
            flex-shrink: 0;

            align-items: center;
            justify-content: center;

            border: 1px solid #A4BFDF;
            border-radius: 11px;

            background: rgba(255, 255, 255, .9);
            color: #294F79;

            cursor: pointer;
            font-size: 21px;

            transition: all .2s ease;
        }

        .mobile-menu-toggle:hover {
            background: #E3F0FA;
            border-color: #89AAD7;
            transform: translateY(-1px);
        }

        /* =========================================
           OVERLAY SIDEBAR HP
        ========================================= */

        .sidebar-overlay {
            display: none;
        }

        /* =========================================
           HEADER ATAS
        ========================================= */

        .admin-topbar {
            position: sticky;
            top: 0;
            z-index: 40;
            isolation: isolate;
            overflow: hidden;

            background: linear-gradient(
                115deg,
                #E3F0FA 0%,
                #C3E0F4 58%,
                #F8FAFC 100%
            );

            border-bottom: 1px solid #BAD1EC;

            box-shadow: 0 4px 14px rgba(64, 91, 124, .08);
        }

        .admin-topbar::before,
        .admin-topbar::after {
            content: none !important;
            display: none !important;
        }

        .topbar-inner {
            position: relative;
            z-index: 2;
        }

        .topbar-title {
            color: #25466F;
            font-size: clamp(21px, 1.8vw, 25px);
            font-weight: 800;
            line-height: 1.3;
            letter-spacing: -.5px;
        }

        .topbar-subtitle {
            color: #526F90;
            font-size: 13px;
            font-weight: 600;
        }

        .topbar-user {
            padding: 8px 12px;
            border: 1px solid rgba(255, 255, 255, .8);
            border-radius: 12px;
            background: rgba(255, 255, 255, .65);
            backdrop-filter: blur(8px);
        }

        /* =========================================
           TOMBOL MODE GELAP
        ========================================= */

        #adminThemeToggle {
            position: relative;
            z-index: 5;

            border: 1px solid #A4BFDF;

            box-shadow: 0 3px 9px rgba(55, 105, 170, .10);

            transition:
                background .2s ease,
                border-color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }

        #adminThemeToggle:hover {
            transform: translateY(-1px);
            border-color: #89AAD7;

            box-shadow: 0 5px 12px rgba(55, 105, 170, .16);
        }

        /* =========================================
           KONTEN DAN KARTU
        ========================================= */

        .admin-content {
            animation: soft-enter .3s ease-out both;
        }

        .main-card {
            background: #F8FAFC;
            border: 1px solid #D7E3EF;
            border-radius: 16px;

            box-shadow:
                0 3px 8px rgba(47, 82, 124, .035),
                0 8px 18px rgba(47, 82, 124, .035);

            transition:
                box-shadow .2s ease,
                border-color .2s ease;
        }

        .main-card:hover {
            border-color: #A4BFDF;

            box-shadow: 0 5px 16px rgba(47, 82, 124, .08);
        }

        .admin-content .bg-white {
            background-color: #F8FAFC !important;
        }

        .admin-content .bg-slate-50 {
            background-color: #F1F5F9;
        }

        /* =========================================
           TABEL
        ========================================= */

        table {
            border-collapse: separate;
            border-spacing: 0;
        }

        thead th {
            background: #C3E0F4;
            color: #294F79;
            font-weight: 800;
        }

        th,
        td {
            border-color: #D4E2F1;
        }

        tbody tr {
            transition: background-color .18s ease;
        }

        tbody tr:hover {
            background-color: #E3F0FA;
        }

        .admin-content thead th {
            background: #C3E0F4;
            color: #294F79;
            font-size: 12px;
            font-weight: 800;
            border-color: #D2E1F0;
        }

        .admin-content tbody td {
            color: #3B5068;
            font-size: 13px;
            border-color: #DCE5EF;
        }

        /* =========================================
           FORM DAN INPUT
        ========================================= */

        input,
        select,
        textarea {
            transition:
                border-color .2s ease,
                box-shadow .2s ease;
        }

        .admin-content input,
        .admin-content select,
        .admin-content textarea {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px;
            border-color: #D5E1ED;
        }

        .admin-content input::placeholder,
        .admin-content textarea::placeholder {
            color: #8496A9;
            font-weight: 500;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #89AAD7 !important;

            box-shadow: 0 0 0 3px rgba(137, 170, 215, .22);
        }

        button:focus-visible,
        a:focus-visible {
            outline: 3px solid rgba(137, 170, 215, .75);
            outline-offset: 3px;
        }

        /* =========================================
           NOTIFIKASI
        ========================================= */

        .notice-card {
            border-radius: 11px;
            box-shadow: 0 3px 9px rgba(70, 100, 140, .045);
        }

        .transition-smooth {
            transition: all .2s ease;
        }

        /* =========================================
           ANIMASI KONTEN
        ========================================= */

        @keyframes soft-enter {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* =========================================
           MODE GELAP
        ========================================= */

        .dark body {
            background: #172334;
            color: #E4ECF6;
        }

        .dark .page-surface {
            background: #172334 !important;
        }

        .dark .admin-sidebar {
            color: #E2EAF5;

            background: linear-gradient(
                160deg,
                #17263E 0%,
                #1D304A 52%,
                #253A56 100%
            );

            border-color: #34445C;
        }

        .dark .admin-sidebar::before {
            background: radial-gradient(
                circle,
                rgba(148, 181, 225, .08),
                rgba(148, 181, 225, 0) 70%
            );
        }

        .dark .sidebar-brand,
        .dark .sidebar-footer {
            border-color: #34445C;
        }

        .dark .brand-name {
            color: #F1F6FF;
        }

        .dark .brand-subtitle,
        .dark .sidebar-heading {
            color: #B6C8DF;
        }

        .dark .profile-card {
            background: rgba(255, 255, 255, .045);
            border-color: #35445D;
            box-shadow: none;
        }

        .dark .sidebar-link {
            color: #C3D1E3;
        }

        .dark .sidebar-link:hover {
            color: #FFFFFF;
            background: #263A54;
            border-color: #3A5270;
            box-shadow: none;
        }

        .dark .sidebar-active {
            color: #233B55 !important;
            background: #89AAD7;
            border-color: #89AAD7;
        }

        .dark .sidebar-active svg {
            color: #233B55;
        }

        .dark .sidebar-scroll {
            scrollbar-color: #425773 transparent;
        }

        .dark .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #425773;
        }

        /* HEADER MODE GELAP */

        .dark .admin-topbar {
            background: linear-gradient(
                115deg,
                #1D304A 0%,
                #263D58 58%,
                #202F41 100%
            );

            border-color: #354A62;
        }

        .dark .admin-topbar::before,
        .dark .admin-topbar::after {
            content: none !important;
            display: none !important;
        }

        .dark .topbar-title {
            color: #F1F6FF;
            text-shadow: none;
        }

        .dark .topbar-subtitle {
            color: #C1CEE0;
        }

        .dark .topbar-user {
            background: rgba(15, 23, 42, .45);
            border-color: rgba(148, 163, 184, .25);
        }

        .dark #adminThemeToggle {
            border-color: #465B77;
        }

        /* DARK MODE KONTEN */

        .dark .main-card {
            background: #1C2B3E;
            border-color: #354A62;
            box-shadow: none;
        }

        .dark .main-card:hover {
            border-color: #526F90;
        }

        .dark .admin-content .bg-white {
            background-color: #1C2B3E !important;
        }

        .dark .admin-content .bg-slate-50 {
            background-color: #203247;
        }

        .dark .admin-content h1,
        .dark .admin-content h2,
        .dark .admin-content h3,
        .dark .admin-content h4 {
            color: #E6EFFA;
        }

        .dark .admin-content label {
            color: #D4E0EF;
        }

        .dark .text-slate-800,
        .dark .text-slate-900 {
            color: #F1F5F9 !important;
        }

        .dark .text-slate-600,
        .dark .text-slate-500 {
            color: #B3C0D2 !important;
        }

        .dark .admin-content thead th,
        .dark thead th {
            background: #263A53;
            color: #E1EDFC;
        }

        .dark th,
        .dark td {
            border-color: #35465D;
        }

        .dark .admin-content tbody td {
            color: #D4E0EF;
            border-color: #354A62;
        }

        .dark tbody tr:hover {
            background-color: #24384F;
        }

        .dark input,
        .dark select,
        .dark textarea {
            color: #E5EDF7;
            background-color: #203247;
            border-color: #40536B;
        }

        .dark input::placeholder,
        .dark textarea::placeholder {
            color: #94A8BF;
        }

        .dark .mobile-menu-toggle {
            color: #E1EDFC;
            background: #263A53;
            border-color: #465B77;
        }

        .dark .mobile-menu-toggle:hover {
            background: #344D6B;
        }

        .dark .mobile-sidebar-close {
            color: #E1EDFC;
            background: #263A53;
            border-color: #465B77;
        }

        /* =========================================
           RESPONSIVE TABLET DAN HP
        ========================================= */

        @media (max-width: 767px) {

            body {
                overflow-x: hidden;
            }

            body.sidebar-open {
                overflow: hidden;
            }

            /*
             * SIDEBAR BERUBAH MENJADI DRAWER
             * Tersembunyi di luar layar sebelum hamburger diklik.
             */

            .admin-sidebar {
                position: fixed !important;

                z-index: 100;

                top: 0;
                right: auto;
                bottom: 0;
                left: 0;

                width: min(285px, 86vw) !important;

                height: 100vh !important;
                height: 100dvh !important;

                min-height: 100vh !important;
                max-height: 100vh !important;

                flex: none !important;

                display: flex;
                flex-direction: column;

                overflow: hidden;

                box-shadow: 8px 0 30px rgba(25, 55, 90, .16);

                transform: translateX(-105%);
                visibility: hidden;

                transition:
                    transform .28s ease,
                    visibility .28s ease;
            }

            .admin-sidebar.is-open {
                transform: translateX(0);
                visibility: visible;
            }

            /*
             * AREA MENU DAPAT DI-SCROLL
             */

            .sidebar-scroll {
                min-height: 0;
                flex: 1 1 auto;

                overflow-x: hidden !important;
                overflow-y: auto !important;

                overscroll-behavior: contain;
            }

            .sidebar-brand,
            .sidebar-profile-wrapper,
            .sidebar-footer {
                flex-shrink: 0;
            }

            /*
             * TOMBOL X DI SIDEBAR
             */

            .mobile-sidebar-close {
                display: inline-flex;

                width: 34px;
                height: 34px;
                flex-shrink: 0;

                align-items: center;
                justify-content: center;

                border: 1px solid #A4BFDF;
                border-radius: 9px;

                background: rgba(255, 255, 255, .8);
                color: #294F79;

                cursor: pointer;
                font-size: 17px;
            }

            /*
             * TOMBOL HAMBURGER MUNCUL DI HEADER
             */

            .mobile-menu-toggle {
                display: inline-flex;
            }

            /*
             * OVERLAY DI BELAKANG SIDEBAR
             */

            .sidebar-overlay {
                display: block;

                position: fixed;
                z-index: 90;

                inset: 0;

                width: 100%;
                height: 100%;

                padding: 0;
                border: none;

                background: rgba(16, 30, 48, .5);

                opacity: 0;
                visibility: hidden;
                pointer-events: none;

                transition:
                    opacity .25s ease,
                    visibility .25s ease;
            }

            .sidebar-overlay.is-visible {
                opacity: 1;
                visibility: visible;
                pointer-events: auto;
            }

            /*
             * HEADER HP
             */

            .admin-topbar {
                z-index: 40;
            }

            .topbar-inner {
                padding-top: 14px;
                padding-bottom: 14px;
            }

            .topbar-title {
                font-size: 19px;
            }

            .topbar-subtitle {
                font-size: 11px;
            }

            .topbar-user {
                padding: 6px 8px;
            }

            /*
             * UKURAN JUDUL KONTEN
             */

            .admin-content h1 {
                font-size: 23px;
            }

            .admin-content h2 {
                font-size: 20px;
            }

            .admin-content h3 {
                font-size: 17px;
            }

        }

        /* =========================================
           RESPONSIVE HP KECIL
        ========================================= */

        @media (max-width: 380px) {

            .mobile-menu-toggle {
                width: 38px;
                height: 38px;
            }

            .topbar-inner {
                gap: 8px;
                padding-left: 12px;
                padding-right: 12px;
            }

            .topbar-title {
                font-size: 17px;
            }

            .topbar-subtitle {
                font-size: 10px;
            }

        }

        /* =========================================
           PREFERENSI GERAKAN
        ========================================= */

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
            }

        }
    </style>

    {{-- CSS TAMBAHAN DARI HALAMAN --}}
    @stack('styles')
</head>

<body class="min-h-screen text-slate-800">


{{-- =========================================
     OVERLAY SIDEBAR HP
========================================== --}}

<button
    type="button"
    id="adminSidebarOverlay"
    class="sidebar-overlay"
    aria-label="Tutup menu navigasi"
></button>


<div class="min-h-screen md:flex">

    {{-- =========================================
         SIDEBAR ADMIN
    ========================================== --}}

    <aside class="admin-sidebar w-full md:w-64 md:min-h-screen" id="adminSidebar">

        {{-- LOGO DAN NAMA APLIKASI --}}
        <div class="sidebar-brand px-5 py-5">

            <div class="flex items-center justify-between gap-3">

                <div class="flex items-center gap-3 min-w-0">

                    <div class="brand-logo w-12 h-12 bg-white rounded-xl flex items-center justify-center overflow-hidden flex-shrink-0">

                        <img
                            src="{{ asset('images/Logo sistem akademik mini.jpeg') }}"
                            alt="Logo Sistem Akademik Mini"
                            class="w-full h-full object-contain"
                        >

                    </div>

                    <div class="min-w-0">

                        <h1 class="brand-name text-sm font-extrabold">
                            Sistem Akademik Mini
                        </h1>

                        <div class="flex items-center gap-2 mt-1">

                            <span class="w-2 h-2 rounded-full bg-[#89AAD7]"></span>

                            <span class="brand-subtitle text-xs font-semibold">
                                Administrator
                            </span>

                        </div>

                    </div>

                </div>

                {{-- TOMBOL TUTUP SIDEBAR HP --}}
                <button
                    type="button"
                    id="adminSidebarClose"
                    class="mobile-sidebar-close"
                    aria-label="Tutup menu"
                >
                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 6l12 12M18 6 6 18"
                        />
                    </svg>
                </button>

            </div>

        </div>


        {{-- PROFIL SINGKAT --}}
        <div class="sidebar-profile-wrapper px-4 py-4">

            <div class="profile-card flex items-center gap-3 p-3">

                <div class="w-10 h-10 rounded-xl bg-[#89AAD7] flex items-center justify-center font-bold text-[#233B55] flex-shrink-0 shadow-sm">
                    {{ strtoupper(substr(auth()->user()->username ?? 'A', 0, 1)) }}
                </div>

                <div class="min-w-0">

                    <p class="text-sm font-bold truncate text-slate-800 dark:text-slate-100">
                        {{ ucfirst(auth()->user()->username ?? 'Admin') }}
                    </p>

                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">
                        Administrator
                    </p>

                </div>

            </div>

        </div>


        {{-- MENU NAVIGASI --}}
        <nav class="sidebar-scroll flex-1 px-3 pb-5 overflow-y-auto">

            {{-- MENU UTAMA --}}
            <p class="sidebar-heading px-3 mb-2 text-[10px] font-extrabold tracking-[.16em] uppercase">
                Menu Utama
            </p>


            <a
                href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'sidebar-active' : 'sidebar-link' }} mb-1"
            >
                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24"
                     aria-hidden="true">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V10Z"/>

                </svg>

                <span class="text-sm font-semibold">
                    Dashboard
                </span>
            </a>


            {{-- DATA MASTER --}}
            <p class="sidebar-heading px-3 mt-6 mb-2 text-[10px] font-extrabold tracking-[.16em] uppercase">
                Data Master
            </p>


            <a
                href="{{ route('admin.mapel.index') }}"
                class="{{ request()->routeIs('admin.mapel.*') ? 'sidebar-active' : 'sidebar-link' }} mb-1"
            >
                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24"
                     aria-hidden="true">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21V5.5Z"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M4 17a2.5 2.5 0 0 1 2.5-2.5H20"/>

                </svg>

                <span class="text-sm font-semibold">
                    Mata Pelajaran
                </span>
            </a>


            <a
                href="{{ route('admin.guru.index') }}"
                class="{{ request()->routeIs('admin.guru.*') ? 'sidebar-active' : 'sidebar-link' }} mb-1"
            >
                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24"
                     aria-hidden="true">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>

                    <circle cx="10" cy="7" r="4"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M20 8v6m-3-3h6"/>

                </svg>

                <span class="text-sm font-semibold">
                    Data Guru
                </span>
            </a>


            <a
                href="{{ route('admin.kelas.index') }}"
                class="{{ request()->routeIs('admin.kelas.*') ? 'sidebar-active' : 'sidebar-link' }} mb-1"
            >
                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24"
                     aria-hidden="true">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M3 5h18v14H3z"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M3 10h18M9 5v14"/>

                </svg>

                <span class="text-sm font-semibold">
                    Data Kelas
                </span>
            </a>


            <a
                href="{{ route('admin.siswa.index') }}"
                class="{{ request()->routeIs('admin.siswa.*') ? 'sidebar-active' : 'sidebar-link' }} mb-1"
            >
                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24"
                     aria-hidden="true">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-3 4v2"/>

                    <circle cx="10" cy="7" r="4"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M20 8v6m-3-3h6"/>

                </svg>

                <span class="text-sm font-semibold">
                    Data Siswa
                </span>
            </a>


            <a
                href="{{ route('admin.pengaturan-sekolah.index') }}"
                class="{{ request()->routeIs('admin.pengaturan-sekolah.*') ? 'sidebar-active' : 'sidebar-link' }} mb-1"
            >
                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24"
                     aria-hidden="true">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6M9 9h.01M15 9h.01"/>

                </svg>

                <span class="text-sm font-semibold">
                    Kepala Sekolah
                </span>
            </a>


            {{-- AKADEMIK --}}
            <p class="sidebar-heading px-3 mt-6 mb-2 text-[10px] font-extrabold tracking-[.16em] uppercase">
                Akademik
            </p>


            <a
                href="{{ route('admin.nilai.index') }}"
                class="{{ request()->routeIs('admin.nilai.*') ? 'sidebar-active' : 'sidebar-link' }} mb-1"
            >
                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24"
                     aria-hidden="true">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M5 3h14v18H5z"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M8 8h8M8 12h8M8 16h5"/>

                </svg>

                <span class="text-sm font-semibold">
                    Data Nilai
                </span>
            </a>


            <a
                href="{{ route('admin.rapor.index') }}"
                class="{{ request()->routeIs('admin.rapor.*') && !request()->routeIs('admin.rapor_siswa.*') ? 'sidebar-active' : 'sidebar-link' }} mb-1"
            >
                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24"
                     aria-hidden="true">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M6 3h9l3 3v15H6V3Z"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M15 3v4h3M9 12h6M9 16h6"/>

                </svg>

                <span class="text-sm font-semibold">
                    Periode Rapor
                </span>
            </a>


            <a
                href="{{ route('admin.rapor_siswa.index') }}"
                class="{{ request()->routeIs('admin.rapor_siswa.*') ? 'sidebar-active' : 'sidebar-link' }} mb-1"
            >
                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24"
                     aria-hidden="true">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M6 3h9l3 3v15H6V3Z"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M15 3v4h3M9 12h6M9 16h6"/>

                </svg>

                <span class="text-sm font-semibold">
                    Rapor Siswa
                </span>
            </a>


            {{-- AKUN --}}
            <p class="sidebar-heading px-3 mt-6 mb-2 text-[10px] font-extrabold tracking-[.16em] uppercase">
                Akun
            </p>


            <a
                href="{{ route('admin.profil') }}"
                class="{{ request()->routeIs('admin.profil') ? 'sidebar-active' : 'sidebar-link' }} mb-1"
            >
                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24"
                     aria-hidden="true">

                    <circle cx="12" cy="8" r="4"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M4 21a8 8 0 0 1 16 0"/>

                </svg>

                <span class="text-sm font-semibold">
                    Profil Admin
                </span>
            </a>


            {{-- LOGOUT --}}
            <form action="{{ route('logout') }}" method="POST" class="mt-2">

                @csrf

                <button
                    type="submit"
                    class="sidebar-link w-full text-left hover:!bg-[#E3F0FA] hover:!text-[#29435F] dark:hover:!bg-slate-700 dark:hover:!text-white"
                    onclick="return confirm('Yakin ingin keluar dari akun?')"
                >
                    <svg class="w-5 h-5 flex-shrink-0"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24"
                         aria-hidden="true">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M10 17l5-5-5-5M15 12H3"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7"/>

                    </svg>

                    <span class="text-sm font-semibold">
                        Keluar
                    </span>
                </button>

            </form>

        </nav>


        {{-- FOOTER SIDEBAR --}}
        <div class="sidebar-footer px-4 py-4">

            <p class="text-[11px] text-slate-600 dark:text-slate-400 text-center">
                © {{ date('Y') }} Sistem Akademik Mini
            </p>

        </div>

    </aside>


    {{-- =========================================
         KONTEN UTAMA
    ========================================== --}}

    <main class="flex-1 min-w-0 page-surface">


        {{-- HEADER --}}
        <header class="admin-topbar">

            <div class="topbar-inner px-5 md:px-8 py-4 flex items-center justify-between gap-4">


                {{-- BAGIAN KIRI: HAMBURGER + JUDUL --}}
                <div class="flex min-w-0 items-center gap-3">

                    {{-- TOMBOL HAMBURGER KHUSUS HP --}}
                    <button
                        type="button"
                        id="adminMenuToggle"
                        class="mobile-menu-toggle"
                        aria-label="Buka menu navigasi"
                        aria-controls="adminSidebar"
                        aria-expanded="false"
                    >
                        <svg
                            id="adminMenuIcon"
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>
                    </button>


                    {{-- JUDUL HALAMAN --}}
                    <div class="min-w-0">

                        <h2 class="topbar-title text-lg md:text-xl font-extrabold truncate">
                            @yield('page-title', 'Dashboard')
                        </h2>

                        <p class="topbar-subtitle text-xs md:text-sm mt-1 truncate">
                            @yield('page-subtitle', 'Kelola dan pantau sistem akademik sekolah')
                        </p>

                    </div>

                </div>


                {{-- BAGIAN KANAN --}}
                <div class="flex items-center gap-3 flex-shrink-0">

                    {{-- TOMBOL MODE GELAP --}}
                    <button
                        type="button"
                        id="adminThemeToggle"
                        class="w-10 h-10 rounded-xl bg-white/90 dark:bg-slate-800 flex items-center justify-center transition-smooth"
                        aria-label="Ganti tema"
                        title="Ganti tema"
                    >

                        <svg
                            id="themeSun"
                            class="w-5 h-5 hidden dark:block text-amber-400"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <circle cx="12" cy="12" r="4"/>
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 2v2m0 16v2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M2 12h2m16 0h2M4.93 19.07l1.42-1.42m11.3-11.3 1.42-1.42"/>
                        </svg>


                        <svg
                            id="themeMoon"
                            class="w-5 h-5 block dark:hidden text-slate-700"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M20.9 13A9 9 0 0 1 11 3.1 9 9 0 1 0 20.9 13Z"/>
                        </svg>

                    </button>


                    {{-- INFORMASI ADMIN --}}
                    <div class="topbar-user hidden sm:block text-right">

                        <p class="text-sm font-bold text-slate-800 dark:text-slate-100">
                            {{ ucfirst(auth()->user()->username ?? 'Admin') }}
                        </p>

                        <p class="text-xs text-slate-600 dark:text-slate-300 mt-0.5">
                            Administrator
                        </p>

                    </div>

                </div>

            </div>

        </header>


        {{-- =========================================
             ISI HALAMAN
        ========================================== --}}

        <div class="admin-content px-5 md:px-8 py-6 md:py-8">
            {{-- S3-07 BREADCRUMB ADMIN --}}
            @php
                $routeName = request()->route()?->getName() ?? '';
                $segments = explode('.', $routeName);
                $section = $segments[1] ?? null;
                $action = $segments[2] ?? null;
                $labels = [
                    'siswa' => 'Data Siswa', 'guru' => 'Data Guru',
                    'kelas' => 'Data Kelas', 'mapel' => 'Mata Pelajaran',
                    'nilai' => 'Nilai', 'rapor' => 'Rapor',
                    'rapor_siswa' => 'Rapor Siswa',
                    'pengaturan-sekolah' => 'Pengaturan Sekolah',
                    'profil' => 'Profil',
                ];
                $actions = ['create' => 'Tambah', 'edit' => 'Edit', 'show' => 'Detail'];
                $sectionLabel = $labels[$section] ?? null;
                $actionLabel = $actions[$action] ?? null;
                $sectionRoute = $section ? 'admin.' . $section . '.index' : null;
            @endphp
            <nav aria-label="Breadcrumb" class="mb-5 text-sm text-slate-500 dark:text-slate-400">
                <ol class="flex flex-wrap items-center gap-2">
                    <li>
                        @if($routeName === 'admin.dashboard')
                            <span aria-current="page" class="font-semibold text-slate-700 dark:text-slate-200">Dashboard</span>
                        @else
                            <a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a>
                        @endif
                    </li>
                    @if($sectionLabel)
                        <li aria-hidden="true">›</li>
                        <li>
                            @if($actionLabel && $sectionRoute && Route::has($sectionRoute))
                                <a href="{{ route($sectionRoute) }}" class="hover:underline">{{ $sectionLabel }}</a>
                            @else
                                <span aria-current="page" class="font-semibold text-slate-700 dark:text-slate-200">{{ $sectionLabel }}</span>
                            @endif
                        </li>
                        @if($actionLabel)
                            <li aria-hidden="true">›</li>
                            <li aria-current="page" class="font-semibold text-slate-700 dark:text-slate-200">{{ $actionLabel }}</li>
                        @endif
                    @elseif($routeName === 'admin.profil')
                        <li aria-hidden="true">›</li>
                        <li aria-current="page" class="font-semibold text-slate-700 dark:text-slate-200">Profil</li>
                    @endif
                </ol>
            </nav>


            {{-- NOTIFIKASI BERHASIL --}}
            @if(session('success'))

                <div class="notice-card mb-6 border border-[#A4BFDF] bg-[#E3F0FA] px-4 py-3 text-sm font-medium text-[#29435F] dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100">
                    {{ session('success') }}
                </div>

            @endif


            {{-- NOTIFIKASI ERROR --}}
            @if(session('error'))

                <div class="notice-card mb-6 border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700 dark:bg-rose-900/20 dark:border-rose-800 dark:text-rose-300">
                    {{ session('error') }}
                </div>

            @endif


            {{-- NOTIFIKASI VALIDASI --}}
            @if($errors->any())

                <div class="notice-card mb-6 border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700 dark:bg-rose-900/20 dark:border-rose-800 dark:text-rose-300">

                    <p class="font-bold mb-2">
                        Ada data yang perlu diperbaiki:
                    </p>

                    <ul class="list-disc pl-5 space-y-1">

                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- KONTEN DARI SETIAP HALAMAN --}}
            @yield('content')

        </div>

    </main>

</div>


{{-- =========================================
     SCRIPT MODE GELAP DAN TERANG
========================================== --}}

<script>
    (function () {

        const themeToggle = document.getElementById('adminThemeToggle');

        if (!themeToggle) {
            return;
        }

        themeToggle.addEventListener('click', function () {

            const isDark = document.documentElement.classList.toggle('dark');

            try {

                localStorage.setItem(
                    'admin-theme',
                    isDark ? 'dark' : 'light'
                );

            } catch (e) {}

        });

    })();
</script>


{{-- =========================================
     SCRIPT NAVBAR RESPONSIF
========================================== --}}

<script>
    (function () {

        const sidebar = document.getElementById('adminSidebar');
        const toggle = document.getElementById('adminMenuToggle');
        const close = document.getElementById('adminSidebarClose');
        const overlay = document.getElementById('adminSidebarOverlay');
        const icon = document.getElementById('adminMenuIcon');

        if (!sidebar || !toggle || !overlay) {
            return;
        }


        // BUKA SIDEBAR
        function openSidebar() {

            sidebar.classList.add('is-open');
            overlay.classList.add('is-visible');

            document.body.classList.add('sidebar-open');

            toggle.setAttribute('aria-expanded', 'true');
            toggle.setAttribute('aria-label', 'Tutup menu navigasi');

            if (icon) {
                icon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 6l12 12M18 6 6 18"
                    />
                `;
            }

        }


        // TUTUP SIDEBAR
        function closeSidebar() {

            sidebar.classList.remove('is-open');
            overlay.classList.remove('is-visible');

            document.body.classList.remove('sidebar-open');

            toggle.setAttribute('aria-expanded', 'false');
            toggle.setAttribute('aria-label', 'Buka menu navigasi');

            if (icon) {
                icon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                `;
            }

        }


        // KLIK HAMBURGER
        toggle.addEventListener('click', function () {

            if (sidebar.classList.contains('is-open')) {
                closeSidebar();
            } else {
                openSidebar();
            }

        });


        // KLIK TOMBOL X
        if (close) {
            close.addEventListener('click', closeSidebar);
        }


        // KLIK AREA DI LUAR MENU
        overlay.addEventListener('click', closeSidebar);


        // KLIK LINK MENU
        sidebar.querySelectorAll('a').forEach(function (link) {

            link.addEventListener('click', function () {
                closeSidebar();
            });

        });


        // TOMBOL ESCAPE
        document.addEventListener('keydown', function (event) {

            if (event.key === 'Escape') {
                closeSidebar();
            }

        });


        // KEMBALI KE TAMPILAN DESKTOP
        window.addEventListener('resize', function () {

            if (window.innerWidth >= 768) {
                closeSidebar();
            }

        });

    })();
</script>


@stack('scripts')

</body>
</html>