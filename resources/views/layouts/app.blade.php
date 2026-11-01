<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Sistem Akademik Mini')</title>

    {{-- PERTAHANKAN TEMA YANG DIPILIH --}}
    <script>
        try {
            if (localStorage.getItem('admin-theme') === 'dark') {
                document.documentElement.classList.add('dark');
            }
        } catch (error) {
            // Aplikasi tetap berjalan jika localStorage tidak tersedia.
        }
    </script>

    {{-- FONT UTAMA --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    {{-- IKON --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

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

            --edu-primary: #3478BD;
            --edu-primary-dark: #285F96;

            --edu-page: #F3F6FA;
            --edu-card: #F8FAFC;
            --edu-input: #F1F5F9;

            --edu-text: #293F57;
            --edu-muted: #526982;
            --edu-border: #D5E1ED;

            --edu-radius: 16px;
        }

        /* =========================================
           RESET DAN FONT
        ========================================= */

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            min-height: 100%;
            scroll-behavior: smooth;
            scroll-padding-top: 90px;
        }

        body {
            min-height: 100vh;
            margin: 0;

            display: flex;

            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            line-height: 1.65;

            background: var(--edu-page);
            color: var(--edu-text);

            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }

        button,
        a {
            -webkit-tap-highlight-color: transparent;
        }

        a {
            color: inherit;
        }

        /* =========================================
           ANIMASI GLOBAL
        ========================================= */

        @keyframes edu-enter {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes edu-wave-back {
            from {
                transform: translateX(-5px);
            }

            to {
                transform: translateX(5px);
            }
        }

        @keyframes edu-wave-front {
            from {
                transform: translateX(4px);
            }

            to {
                transform: translateX(-4px);
            }
        }

        /* =========================================
           SIDEBAR
        ========================================= */

        .sidebar {
            position: fixed;
            z-index: 100;

            top: 0;
            bottom: 0;
            left: 0;

            display: flex;
            flex-direction: column;

            width: 260px;
            padding: 24px 16px;

            overflow-x: hidden;
            overflow-y: auto;

            background: linear-gradient(
                160deg,
                #B8D8F8 0%,
                #C5DFFA 52%,
                #D5E8FC 100%
            );

            color: #304863;

            border-right: 1px solid #A8CBEF;

            box-shadow: 4px 0 20px rgba(42, 87, 135, .045);

            scrollbar-width: thin;
            scrollbar-color: #89AAD7 transparent;
        }

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #89AAD7;
            border-radius: 10px;
        }

        /* =========================================
           BRAND DAN LOGO
        ========================================= */

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;

            margin-bottom: 29px;
            padding: 0 9px 23px;

            color: #24466A;
            font-size: 16px;
            font-weight: 800;
            line-height: 1.45;
            letter-spacing: -.35px;

            border-bottom: 1px solid rgba(69, 115, 163, .24);
        }

        .brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 43px;
            height: 43px;
            flex-shrink: 0;

            border: 1px solid rgba(255, 255, 255, .75);
            border-radius: 13px;

            background: #89AAD7;
            color: #FFFFFF;

            font-size: 21px;

            box-shadow:
                0 4px 0 rgba(52, 95, 145, .10),
                0 8px 15px rgba(52, 95, 145, .10);

            transition: transform .25s ease;
        }

        .brand:hover .brand-icon {
            transform: translateY(-2px);
        }

        /* =========================================
           MENU NAVIGASI
        ========================================= */

        .menu-list {
            display: flex;
            flex-direction: column;
            gap: 6px;

            padding: 0;
            margin: 0;

            list-style: none;
        }

        .menu-item a {
            position: relative;

            display: flex;
            align-items: center;
            gap: 12px;

            min-height: 45px;
            padding: 11px 14px;

            border: 1px solid transparent;
            border-radius: 11px;

            color: #38536F;

            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            line-height: 1.5;

            transition:
                background .2s ease,
                color .2s ease,
                border-color .2s ease,
                box-shadow .2s ease,
                transform .2s ease;
        }

        .menu-item a i {
            width: 20px;
            flex-shrink: 0;

            font-size: 17px;
            text-align: center;
        }

        .menu-item a:hover {
            transform: translateX(2px);

            background: rgba(248, 250, 252, .82);
            border-color: #B7D5F3;

            color: #24466A;

            box-shadow: 0 3px 8px rgba(52, 104, 163, .06);
        }

        /* Menu aktif */
        .menu-item.active a {
            background: linear-gradient(
                115deg,
                #3478BD 0%,
                #5799DC 100%
            );

            border-color: #3478BD;

            color: #FFFFFF;

            font-weight: 800;

            box-shadow:
                0 4px 9px rgba(42, 104, 174, .18),
                inset 0 1px 0 rgba(255, 255, 255, .16);
        }

        .menu-item.active a:hover {
            color: #FFFFFF;
        }

        /* =========================================
           TOMBOL LOGOUT
        ========================================= */

        .logout-btn {
            margin-top: auto;
            padding-top: 18px;

            border-top: 1px solid rgba(69, 115, 163, .24);
        }

        .logout-btn form {
            display: none;
        }

        .logout-btn a {
            display: flex;
            align-items: center;
            gap: 12px;

            padding: 12px 14px;
            min-height: 44px;

            border: 1px solid transparent;
            border-radius: 11px;

            color: #38536F;
            font-size: 13px;
            font-weight: 700;

            text-decoration: none;

            transition: all .2s ease;
        }

        .logout-btn a i {
            width: 20px;
            font-size: 17px;
            text-align: center;
        }

        .logout-btn a:hover {
            background: rgba(248, 250, 252, .82);
            border-color: #B7D5F3;
            color: #24466A;
        }

        /* =========================================
           KONTEN UTAMA
        ========================================= */

        .main-content {
            flex: 1;
            min-width: 0;
            min-height: 100vh;

            margin-left: 260px;
            padding: 0;

            overflow-x: hidden;

            background:
                radial-gradient(
                    ellipse at 95% 0%,
                    rgba(195, 224, 244, .22),
                    transparent 40%
                ),
                linear-gradient(
                    135deg,
                    #F3F6FA 0%,
                    #EDF4FA 56%,
                    #F6F5F0 100%
                );
        }

        /* =========================================
           HEADER DENGAN GELOMBANG TIPIS
        ========================================= */

        .header {
            position: relative;
            isolation: isolate;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;

            min-height: 112px;
            padding: 24px 36px;

            margin: 0 0 28px;

            overflow: hidden;

            border-bottom: 1px solid #BBD5EF;

            background: linear-gradient(
                115deg,
                #DCEBFA 0%,
                #C5DFFA 55%,
                #E3F0FA 100%
            );

            box-shadow: 0 4px 12px rgba(41, 77, 119, .055);
        }

        .header-wave {
            position: absolute;
            z-index: -1;
            inset: 0;

            overflow: hidden;
            pointer-events: none;
        }

        .header-wave svg {
            display: block;

            width: 100%;
            height: 100%;

            position: absolute;
            inset: 0;
        }

        .header-wave-back {
            animation: edu-wave-back 12s ease-in-out infinite alternate;
        }

        .header-wave-front {
            animation: edu-wave-front 9s ease-in-out infinite alternate;
        }

        .header-title,
        .user-profile,
        .header-controls {
            position: relative;
            z-index: 2;
        }

        .header-title {
            min-width: 0;
        }

        .header-title h1 {
            margin: 0;

            color: #24466A;

            font-size: clamp(26px, 2vw, 30px);
            font-weight: 800;
            line-height: 1.35;
            letter-spacing: -.65px;

            overflow-wrap: anywhere;
        }

        .header-title p {
            margin: 6px 0 0;

            color: #425F7E;

            font-size: 14px;
            font-weight: 600;
            line-height: 1.6;
        }

        /* =========================================
           PROFIL PENGGUNA
        ========================================= */

        .header-controls {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;

            padding: 8px 11px;

            border: 1px solid rgba(255, 255, 255, .72);
            border-radius: 13px;

            background: rgba(248, 250, 252, .66);

            box-shadow: 0 3px 8px rgba(52, 104, 163, .04);
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            color: #29435F;
            font-size: 14px;
            font-weight: 800;
            line-height: 1.5;
        }

        .user-role {
            margin-top: 2px;
            color: #526982;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.5;
        }

        .avatar {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 43px;
            height: 43px;
            flex-shrink: 0;

            border: 1px solid rgba(255, 255, 255, .6);
            border-radius: 13px;

            background: #3478BD;
            color: #FFFFFF;

            font-size: 16px;
            font-weight: 800;

            box-shadow:
                0 4px 0 rgba(40, 95, 150, .12),
                0 7px 13px rgba(40, 95, 150, .12);
        }

        .app-theme-toggle {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 42px;
            height: 42px;
            flex-shrink: 0;

            border: 1px solid #B5CDE5;
            border-radius: 12px;

            background: #E3F0FA;
            color: #294F79;

            cursor: pointer;
            font-size: 18px;

            transition: all .2s ease;
        }

        .app-theme-toggle:hover {
            transform: translateY(-2px);
            background: #C3E0F4;
            border-color: #89AAD7;
        }

        /* =========================================
           AREA ISI HALAMAN
        ========================================= */

        .main-content > *:not(.header) {
            animation: edu-enter .3s ease-out both;
        }

        .main-content > :last-child {
            margin-bottom: 32px;
        }

        /* =========================================
           KARTU UNIVERSAL
        ========================================= */

        .section-card,
        .dashboard-card,
        .main-card {
            border: 1px solid #D5E1ED;
            border-radius: 16px;

            background: #F8FAFC;
            color: #293F57;

            box-shadow:
                0 3px 0 rgba(73, 112, 155, .035),
                0 7px 18px rgba(47, 82, 124, .045);

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                transform .2s ease;
        }

        .section-card {
            padding: 24px;
        }

        .section-card:hover,
        .dashboard-card:hover,
        .main-card:hover {
            border-color: #BDD6F0;

            box-shadow:
                0 5px 0 rgba(73, 112, 155, .035),
                0 10px 22px rgba(47, 82, 124, .065);
        }

        /* =========================================
           JUDUL DAN TEKS UMUM
        ========================================= */

        .main-content h1,
        .main-content h2,
        .main-content h3,
        .main-content h4,
        .main-content h5 {
            color: #29435F;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .main-content h1 {
            font-size: clamp(26px, 2vw, 30px);
            font-weight: 800;
            line-height: 1.35;
            letter-spacing: -.6px;
        }

        .main-content h2 {
            font-size: clamp(22px, 1.8vw, 25px);
            font-weight: 800;
            line-height: 1.4;
        }

        .main-content h3 {
            font-size: 19px;
            font-weight: 800;
            line-height: 1.45;
        }

        .main-content h4,
        .main-content h5 {
            font-size: 16px;
            font-weight: 800;
            line-height: 1.5;
        }

        /* =========================================
           TOMBOL UTAMA
        ========================================= */

        .action-bar {
            display: flex;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 22px;
        }

        .btn-action-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            min-height: 43px;
            padding: 10px 18px;

            border: 1px solid #285F96;
            border-radius: 11px;

            background: #3478BD;
            color: #FFFFFF;

            text-decoration: none;
            font-size: 13px;
            font-weight: 800;

            box-shadow: 0 4px 0 rgba(40, 95, 150, .15);

            transition: all .2s ease;
        }

        .btn-action-primary:hover {
            transform: translateY(-2px);
            background: #285F96;
            color: #FFFFFF;

            box-shadow: 0 6px 0 rgba(40, 95, 150, .13);
        }

        .btn-action-primary:active {
            transform: translateY(2px);
            box-shadow: none;
        }

        /* =========================================
           TABEL
        ========================================= */

        .table-wrap {
            width: 100%;
            overflow-x: auto;
            border-radius: 12px;
        }

        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            text-align: left;
        }

        .table th {
            padding: 14px 16px;

            background: #DCEBFA;
            color: #294F79;

            border-bottom: 1px solid #C5D9EC;

            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .035em;

            white-space: nowrap;
        }

        .table td {
            padding: 15px 16px;

            border-bottom: 1px solid #DCE5EF;

            color: #344F6D;
            font-size: 13px;
            font-weight: 500;
            vertical-align: middle;
        }

        .table tbody tr {
            transition: background-color .18s ease;
        }

        .table tbody tr:hover {
            background: #EDF4FA;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        /* =========================================
           BADGE
        ========================================= */

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;

            padding: 5px 11px;

            border: 1px solid #C3D8EB;
            border-radius: 999px;

            background: #E3F0FA;
            color: #294F79;

            font-size: 12px;
            font-weight: 800;
            line-height: 1.5;
        }

        .badge-class {
            border-color: #C3D8EB;
            background: #E3F0FA;
            color: #294F79;
        }

        /* =========================================
           TOMBOL IKON
        ========================================= */

        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-width: 34px;
            min-height: 34px;
            padding: 6px 9px;

            border: 1px solid transparent;
            border-radius: 9px;

            background: transparent;
            color: #3478BD;

            cursor: pointer;
            font-size: 16px;

            transition: all .2s ease;
        }

        .btn-edit {
            color: #3478BD;
        }

        .btn-edit:hover {
            background: #E3F0FA;
            border-color: #C3D8EB;
            color: #285F96;
        }

        .btn-delete {
            color: #547BA8;
        }

        .btn-delete:hover {
            background: #E3F0FA;
            border-color: #C3D8EB;
            color: #285F96;
        }

        /* =========================================
           FORMULIR
        ========================================= */

        .form-group {
            width: 100%;
            min-width: 0;
            margin-bottom: 21px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;

            color: #344F6D;
            font-size: 13px;
            font-weight: 800;
            line-height: 1.5;
        }

        .form-control {
            display: block;
            width: 100%;
            min-width: 0;
            min-height: 45px;

            padding: 11px 14px;

            border: 1.5px solid #D5E1ED;
            border-radius: 11px;

            background: #F8FAFC;
            color: #293F57;

            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .form-control::placeholder {
            color: #8496A9;
            font-weight: 500;
        }

        .form-control:focus {
            outline: none;
            border-color: #547BA8;
            background: #FFFFFF;

            box-shadow: 0 0 0 4px rgba(137, 170, 215, .19);
        }

        input,
        select,
        textarea {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        input:focus-visible,
        select:focus-visible,
        textarea:focus-visible,
        button:focus-visible,
        a:focus-visible {
            outline: 3px solid rgba(52, 120, 189, .35);
            outline-offset: 3px;
        }

        /* =========================================
           PERBAIKAN DASHBOARD ADMIN
        ========================================= */

        .admin-dashboard .welcome-box {
            background: linear-gradient(
                115deg,
                #3478BD 0%,
                #477FB8 55%,
                #547BA8 100%
            ) !important;

            border: 1px solid #2F6FAA;
            color: #FFFFFF;

            box-shadow:
                0 4px 0 rgba(40, 95, 150, .12),
                0 10px 23px rgba(41, 89, 139, .12);
        }

        .admin-dashboard .stat-icon,
        .admin-dashboard .quick-icon,
        .admin-dashboard .stat-icon[style],
        .admin-dashboard .quick-icon[style] {
            background: #E3F0FA !important;
            color: #355779 !important;
            border-color: #C3D8EB;
        }

        .admin-dashboard .quick-action {
            border-color: #D5E1ED;
            background: #F3F6FA;
            color: #304B69;
        }

        .admin-dashboard .quick-action:hover {
            border-color: #A4BFDF;
            background: #E3F0FA;
            color: #29435F;
        }

        .admin-dashboard .date-badge {
            background: #E3F0FA !important;
            color: #294F79 !important;
            border-color: #BDD2E7;
        }

        /* =========================================
           TOMBOL HAMBURGER DAN OVERLAY
        ========================================= */

        .mobile-menu-toggle,
        .mobile-sidebar-close {
            display: none;
        }

        .sidebar-overlay {
            display: none;
        }

        /* =========================================
           MODE GELAP
        ========================================= */

        html.dark,
        html.dark body,
        body.dark-mode {
            background: #172334;
            color: #E4ECF6;
        }

        html.dark .sidebar,
        body.dark-mode .sidebar {
            background: linear-gradient(
                160deg,
                #17263E 0%,
                #1D304A 52%,
                #253A56 100%
            );

            color: #E2EAF5;
            border-color: #34445C;
        }

        html.dark .brand,
        body.dark-mode .brand {
            color: #F1F6FF;
            border-color: #34445C;
        }

        html.dark .menu-item a,
        body.dark-mode .menu-item a {
            color: #C3D1E3;
        }

        html.dark .menu-item a:hover,
        body.dark-mode .menu-item a:hover {
            background: #263A54;
            color: #FFFFFF;
            border-color: #3A5270;
        }

        html.dark .menu-item.active a,
        body.dark-mode .menu-item.active a {
            background: linear-gradient(
                115deg,
                #3478BD 0%,
                #557FAF 100%
            );

            border-color: #648DBB;
            color: #FFFFFF;
        }

        html.dark .logout-btn,
        body.dark-mode .logout-btn {
            border-color: #34445C;
        }

        html.dark .logout-btn a,
        body.dark-mode .logout-btn a {
            color: #C3D1E3;
        }

        html.dark .logout-btn a:hover,
        body.dark-mode .logout-btn a:hover {
            background: #263A54;
            border-color: #3A5270;
            color: #FFFFFF;
        }

        html.dark .main-content,
        body.dark-mode .main-content {
            background:
                radial-gradient(
                    ellipse at 95% 0%,
                    rgba(137, 170, 215, .08),
                    transparent 40%
                ),
                #172334;
        }

        html.dark .header,
        body.dark-mode .header {
            background: linear-gradient(
                115deg,
                #192B40 0%,
                #20364E 55%,
                #263D57 100%
            );

            border-color: #354A62;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .12);
        }

        html.dark .header-title h1,
        body.dark-mode .header-title h1 {
            color: #F1F6FC;
        }

        html.dark .header-title p,
        body.dark-mode .header-title p {
            color: #C2D0E0;
        }

        html.dark .user-profile,
        body.dark-mode .user-profile {
            background: rgba(20, 34, 51, .68);
            border-color: #40536B;
            box-shadow: none;
        }

        html.dark .user-name,
        body.dark-mode .user-name {
            color: #F1F6FC;
        }

        html.dark .user-role,
        body.dark-mode .user-role {
            color: #B8C9DD;
        }

        html.dark .avatar,
        body.dark-mode .avatar {
            background: #547BA8;
            color: #FFFFFF;
            box-shadow: none;
        }

        html.dark .app-theme-toggle,
        body.dark-mode .app-theme-toggle {
            border-color: #465B77;
            background: #263A53;
            color: #F1D58A;
        }

        html.dark .section-card,
        html.dark .dashboard-card,
        html.dark .main-card,
        body.dark-mode .section-card,
        body.dark-mode .dashboard-card,
        body.dark-mode .main-card {
            background: #1C2B3E;
            border-color: #354A62;
            color: #E4ECF6;
            box-shadow: none;
        }

        html.dark .main-content h1,
        html.dark .main-content h2,
        html.dark .main-content h3,
        html.dark .main-content h4,
        html.dark .main-content h5,
        body.dark-mode .main-content h1,
        body.dark-mode .main-content h2,
        body.dark-mode .main-content h3,
        body.dark-mode .main-content h4,
        body.dark-mode .main-content h5 {
            color: #E6EFFA;
        }

        html.dark .table th,
        body.dark-mode .table th {
            background: #263A53;
            color: #E1EDFC;
            border-color: #40536B;
        }

        html.dark .table td,
        body.dark-mode .table td {
            color: #D4E0EF;
            border-color: #354A62;
        }

        html.dark .table tbody tr:hover,
        body.dark-mode .table tbody tr:hover {
            background: #24384F;
        }

        html.dark .badge,
        html.dark .badge-class,
        body.dark-mode .badge,
        body.dark-mode .badge-class {
            border-color: #435E7C;
            background: #263E59;
            color: #DFECFB;
        }

        html.dark .btn-edit,
        html.dark .btn-delete,
        body.dark-mode .btn-edit,
        body.dark-mode .btn-delete {
            color: #BAD1EC;
        }

        html.dark .btn-edit:hover,
        html.dark .btn-delete:hover,
        body.dark-mode .btn-edit:hover,
        body.dark-mode .btn-delete:hover {
            background: #263E59;
            border-color: #435E7C;
            color: #FFFFFF;
        }

        html.dark .form-label,
        body.dark-mode .form-label {
            color: #D4E0EF;
        }

        html.dark .form-control,
        body.dark-mode .form-control {
            background: #203247;
            color: #E4ECF6;
            border-color: #40536B;
        }

        html.dark .form-control::placeholder,
        body.dark-mode .form-control::placeholder {
            color: #94A8BF;
        }

        html.dark .form-control:focus,
        body.dark-mode .form-control:focus {
            border-color: #89AAD7;
            box-shadow: 0 0 0 4px rgba(137, 170, 215, .15);
        }

        /* Dashboard selaras dengan mode gelap */
        html.dark .admin-dashboard .welcome-box,
        body.dark-mode .admin-dashboard .welcome-box {
            background: linear-gradient(
                115deg,
                #192B40 0%,
                #20364E 55%,
                #263D57 100%
            ) !important;

            border-color: #405773;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .18);
        }

        html.dark .admin-dashboard .welcome-box h3,
        html.dark .admin-dashboard .welcome-box h3 *,
        body.dark-mode .admin-dashboard .welcome-box h3,
        body.dark-mode .admin-dashboard .welcome-box h3 * {
            color: #F1F6FC !important;
        }

        html.dark .admin-dashboard .welcome-box p,
        html.dark .admin-dashboard .welcome-box p *,
        body.dark-mode .admin-dashboard .welcome-box p,
        body.dark-mode .admin-dashboard .welcome-box p * {
            color: #D0DDED !important;
        }

        html.dark .admin-dashboard .stat-icon,
        html.dark .admin-dashboard .quick-icon,
        body.dark-mode .admin-dashboard .stat-icon,
        body.dark-mode .admin-dashboard .quick-icon {
            background: #263E59 !important;
            color: #D8E9FC !important;
            border-color: #405B78;
        }

        html.dark .admin-dashboard .quick-action,
        body.dark-mode .admin-dashboard .quick-action {
            background: #203247;
            border-color: #354A62;
            color: #E4ECF6;
        }

        html.dark .admin-dashboard .quick-action:hover,
        body.dark-mode .admin-dashboard .quick-action:hover {
            background: #293F58;
            border-color: #58789D;
            color: #FFFFFF;
        }

        html.dark .admin-dashboard .date-badge,
        body.dark-mode .admin-dashboard .date-badge {
            background: #263E59 !important;
            color: #DFECFB !important;
            border-color: #435E7C;
        }

        /* =========================================
           RESPONSIVE DESKTOP KECIL
        ========================================= */

        @media (max-width: 900px) {
            .sidebar {
                width: 225px;
                padding: 20px 12px;
            }

            .main-content {
                margin-left: 225px;
            }

            .header {
                padding: 22px 24px;
            }
        }

        /* =========================================
           RESPONSIVE TABLET DAN HP
        ========================================= */

        @media (max-width: 767px) {

            body {
                display: block;
            }

            body.sidebar-open {
                overflow: hidden;
            }

            /* SIDEBAR MENJADI MENU GESER */
            .sidebar {
                position: fixed;
                z-index: 120;

                top: 0;
                right: auto;
                bottom: 0;
                left: 0;

                display: flex;
                flex-direction: column;

                width: min(285px, 86vw);
                height: 100vh;
                height: 100dvh;

                max-height: none;

                padding: 18px 14px;

                overflow-x: hidden;
                overflow-y: auto;

                border-right: 1px solid #A8CBEF;
                border-bottom: none;

                transform: translateX(-105%);
                visibility: hidden;

                transition:
                    transform .28s ease,
                    visibility .28s ease;
            }

            .sidebar.is-open {
                transform: translateX(0);
                visibility: visible;
            }

            /* BRAND */
            .brand {
                display: flex;
                align-items: center;
                justify-content: space-between;

                margin-bottom: 20px;
                padding: 0 5px 17px;
            }

            /* TOMBOL TUTUP SIDEBAR */
            .mobile-sidebar-close {
                display: inline-flex;
                align-items: center;
                justify-content: center;

                width: 34px;
                height: 34px;
                flex-shrink: 0;

                border: 1px solid rgba(69, 115, 163, .25);
                border-radius: 9px;

                background: rgba(248, 250, 252, .7);
                color: #294F79;

                cursor: pointer;
                font-size: 17px;
            }

            /* MENU */
            .menu-list {
                display: flex;
                flex-direction: column;
                gap: 6px;

                grid-template-columns: none;
            }

            .menu-item a {
                min-height: 46px;
                padding: 11px 13px;
                font-size: 13px;
            }

            .logout-btn {
                margin-top: auto;
                padding-top: 15px;
            }

            /* LATAR BELAKANG MENU */
            .sidebar-overlay {
                display: block;

                position: fixed;
                z-index: 110;
                inset: 0;

                width: 100%;
                height: 100%;

                padding: 0;
                border: none;

                background: rgba(16, 30, 48, .48);

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

            /* KONTEN UTAMA */
            .main-content {
                width: 100%;
                min-height: 100vh;
                margin-left: 0;
            }

            /* TOMBOL HAMBURGER */
            .mobile-menu-toggle {
                display: inline-flex;
                align-items: center;
                justify-content: center;

                width: 42px;
                height: 42px;
                flex-shrink: 0;

                border: 1px solid #B5CDE5;
                border-radius: 11px;

                background: #F8FAFC;
                color: #294F79;

                cursor: pointer;
                font-size: 20px;
            }

            .mobile-menu-toggle:hover {
                background: #E3F0FA;
            }

            /* HEADER */
            .header {
                min-height: 95px;

                align-items: center;
                justify-content: space-between;
                gap: 10px;

                padding: 16px;
                margin-bottom: 22px;
            }

            .header-title {
                flex: 1;
                min-width: 0;
            }

            .header-title h1 {
                font-size: 21px;
            }

            .header-title p {
                font-size: 11px;
            }

            .header-controls {
                gap: 6px;
            }

            .user-profile {
                padding: 4px;
                gap: 6px;

                border: none;
                background: transparent;
                box-shadow: none;
            }

            .user-info {
                display: none;
            }

            .avatar {
                width: 38px;
                height: 38px;
            }

            .app-theme-toggle {
                width: 38px;
                height: 38px;
            }

            .section-card {
                padding: 17px;
            }
        }

        /* =========================================
           RESPONSIVE HP KECIL
        ========================================= */

        @media (max-width: 420px) {

            .header {
                gap: 7px;
                padding: 13px;
            }

            .mobile-menu-toggle {
                width: 38px;
                height: 38px;
            }

            .header-title h1 {
                font-size: 18px;
            }

            .header-title p {
                font-size: 10px;
            }

            .header-controls {
                gap: 5px;
            }

            .avatar,
            .app-theme-toggle {
                width: 35px;
                height: 35px;
            }
        }

        /* =========================================
           TEMA GELAP UNTUK NAVBAR HP
        ========================================= */

        html.dark .mobile-menu-toggle,
        body.dark-mode .mobile-menu-toggle {
            background: #263A53;
            color: #E1EDFC;
            border-color: #465B77;
        }

        html.dark .mobile-menu-toggle:hover,
        body.dark-mode .mobile-menu-toggle:hover {
            background: #344D6B;
        }

        html.dark .mobile-sidebar-close,
        body.dark-mode .mobile-sidebar-close {
            background: #263A53;
            color: #E1EDFC;
            border-color: #465B77;
        }

        html.dark .sidebar-overlay,
        body.dark-mode .sidebar-overlay {
            background: rgba(0, 0, 0, .62);
        }

        /* =========================================
           AKSESIBILITAS
        ========================================= */

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation: none !important;
                transition: none !important;
                scroll-behavior: auto !important;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="app-body">

{{-- SINKRONKAN MODE GELAP SEBELUM KONTEN --}}
<script>
    if (document.documentElement.classList.contains('dark')) {
        document.body.classList.add('dark-mode');
    }
</script>


{{-- =========================================
     OVERLAY MENU HP
========================================= --}}

<button
    type="button"
    class="sidebar-overlay"
    id="sidebarOverlay"
    aria-label="Tutup menu navigasi"
></button>


{{-- =========================================
     SIDEBAR UTAMA
     MENU BERDASARKAN ROLE PENGGUNA
========================================= --}}

<aside class="sidebar" id="appSidebar">

    {{-- BRAND --}}
    <div class="brand">

        <div style="display: flex; align-items: center; gap: 12px; min-width: 0;">

            <div class="brand-icon">
                <i class="bi bi-mortarboard-fill" aria-hidden="true"></i>
            </div>

            <span>Sistem Akademik Mini</span>

        </div>

        {{-- TOMBOL TUTUP KHUSUS HP --}}
        <button
            type="button"
            class="mobile-sidebar-close"
            id="mobileSidebarClose"
            aria-label="Tutup menu"
        >
            <i class="bi bi-x-lg" aria-hidden="true"></i>
        </button>

    </div>


    {{-- MENU NAVIGASI --}}
    <ul class="menu-list">


        {{-- ==================================
             MENU ADMIN
        ================================== --}}

        @if (auth()->user()->role === 'admin')

            <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-grid-1x2-fill" aria-hidden="true"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                <a href="{{ route('admin.siswa.index') }}">
                    <i class="bi bi-people-fill" aria-hidden="true"></i>
                    <span>Data Siswa</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}">
                <a href="{{ route('admin.guru.index') }}">
                    <i class="bi bi-person-badge-fill" aria-hidden="true"></i>
                    <span>Data Guru</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('admin.mapel.*') ? 'active' : '' }}">
                <a href="{{ route('admin.mapel.index') }}">
                    <i class="bi bi-book-half" aria-hidden="true"></i>
                    <span>Mata Pelajaran</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">
                <a href="{{ route('admin.kelas.index') }}">
                    <i class="bi bi-door-open-fill" aria-hidden="true"></i>
                    <span>Data Kelas</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('admin.nilai.*') ? 'active' : '' }}">
                <a href="{{ route('admin.nilai.index') }}">
                    <i class="bi bi-clipboard-data-fill" aria-hidden="true"></i>
                    <span>Data Nilai</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('admin.rapor.*') ? 'active' : '' }}">
                <a href="{{ route('admin.rapor.index') }}">
                    <i class="bi bi-calendar-check-fill" aria-hidden="true"></i>
                    <span>Periode Rapor</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('admin.rapor_siswa.*') ? 'active' : '' }}">
                <a href="{{ route('admin.rapor_siswa.index') }}">
                    <i class="bi bi-file-earmark-text-fill" aria-hidden="true"></i>
                    <span>Rapor Siswa</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('admin.pengaturan-sekolah.*') ? 'active' : '' }}">
                <a href="{{ route('admin.pengaturan-sekolah.index') }}">
                    <i class="bi bi-gear-fill" aria-hidden="true"></i>
                    <span>Pengaturan Sekolah</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('admin.profil') ? 'active' : '' }}">
                <a href="{{ route('admin.profil') }}">
                    <i class="bi bi-person-circle" aria-hidden="true"></i>
                    <span>Profil</span>
                </a>
            </li>


        {{-- ==================================
             MENU GURU
        ================================== --}}

        @elseif (auth()->user()->role === 'guru')

            <li class="menu-item {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                <a href="{{ route('guru.dashboard') }}">
                    <i class="bi bi-grid-1x2-fill" aria-hidden="true"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('guru.siswa.*') ? 'active' : '' }}">
                <a href="{{ route('guru.siswa.index') }}">
                    <i class="bi bi-people-fill" aria-hidden="true"></i>
                    <span>Data Siswa</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('guru.nilai.*') ? 'active' : '' }}">
                <a href="{{ route('guru.nilai.create') }}">
                    <i class="bi bi-pencil-square" aria-hidden="true"></i>
                    <span>Input Nilai</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('guru.bobot-nilai.*') ? 'active' : '' }}">
                <a href="{{ route('guru.bobot-nilai.index') }}">
                    <i class="bi bi-sliders" aria-hidden="true"></i>
                    <span>Bobot Nilai</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('guru.rekap.*') ? 'active' : '' }}">
                <a href="{{ route('guru.rekap.index') }}">
                    <i class="bi bi-clipboard-data-fill" aria-hidden="true"></i>
                    <span>Rekap Nilai</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('guru.rapor.*') ? 'active' : '' }}">
                <a href="{{ route('guru.rapor.index') }}">
                    <i class="bi bi-file-earmark-text-fill" aria-hidden="true"></i>
                    <span>Rapor Wali Kelas</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('guru.profil') ? 'active' : '' }}">
                <a href="{{ route('guru.profil') }}">
                    <i class="bi bi-person-circle" aria-hidden="true"></i>
                    <span>Profil</span>
                </a>
            </li>


        {{-- ==================================
             MENU SISWA
        ================================== --}}

        @elseif (auth()->user()->role === 'siswa')

            <li class="menu-item {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                <a href="{{ route('siswa.dashboard') }}">
                    <i class="bi bi-grid-1x2-fill" aria-hidden="true"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('siswa.nilai.*') ? 'active' : '' }}">
                <a href="{{ route('siswa.nilai.index') }}">
                    <i class="bi bi-journal-check" aria-hidden="true"></i>
                    <span>Nilai Saya</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('siswa.rapor.*') ? 'active' : '' }}">
                <a href="{{ route('siswa.rapor.index') }}">
                    <i class="bi bi-file-earmark-text-fill" aria-hidden="true"></i>
                    <span>Transkrip Rapor</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('siswa.profil') ? 'active' : '' }}">
                <a href="{{ route('siswa.profil') }}">
                    <i class="bi bi-person-circle" aria-hidden="true"></i>
                    <span>Profil</span>
                </a>
            </li>

        @endif


        {{-- ==================================
             LOGOUT
        ================================== --}}

        <li class="menu-item logout-btn">

            <form
                action="{{ route('logout') }}"
                method="POST"
                id="logout-form"
            >
                @csrf
            </form>

            <a
                href="{{ route('logout') }}"
                onclick="event.preventDefault(); if (confirm('Yakin ingin keluar dari akun?')) document.getElementById('logout-form').submit();"
            >
                <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
                <span>Keluar</span>
            </a>

        </li>

    </ul>

</aside>


{{-- =========================================
     KONTEN UTAMA
========================================= --}}

<main class="main-content">

    {{-- HEADER --}}
    <header class="header">

        {{-- TOMBOL HAMBURGER KHUSUS HP --}}
        <button
            type="button"
            class="mobile-menu-toggle"
            id="mobileMenuToggle"
            aria-label="Buka menu navigasi"
            aria-controls="appSidebar"
            aria-expanded="false"
        >
            <i class="bi bi-list" id="mobileMenuIcon" aria-hidden="true"></i>
        </button>


        {{-- GELOMBANG BIRU LEMBUT --}}
        <div class="header-wave" aria-hidden="true">

            <svg viewBox="0 0 1200 180" preserveAspectRatio="xMidYMid slice">

                <defs>
                    <linearGradient id="appWaveBack" x1="0" y1="0" x2="1" y2="1">
                        <stop offset="0%" stop-color="#A4BFDF" stop-opacity=".36"/>
                        <stop offset="100%" stop-color="#E3F0FA" stop-opacity=".12"/>
                    </linearGradient>

                    <linearGradient id="appWaveFront" x1="0" y1="0" x2="1" y2="0">
                        <stop offset="0%" stop-color="#BAD1EC" stop-opacity=".34"/>
                        <stop offset="55%" stop-color="#C3E0F4" stop-opacity=".28"/>
                        <stop offset="100%" stop-color="#89AAD7" stop-opacity=".24"/>
                    </linearGradient>
                </defs>

                <path
                    class="header-wave-back"
                    d="M0 42 C180 5 320 80 500 48 S840 5 1020 42 S1140 58 1200 32 L1200 180 L0 180Z"
                    fill="url(#appWaveBack)"
                />

                <path
                    class="header-wave-front"
                    d="M0 78 C170 42 320 115 520 77 S850 40 1010 77 S1140 100 1200 66 L1200 180 L0 180Z"
                    fill="url(#appWaveFront)"
                />

                <path
                    d="M0 78 C170 42 320 115 520 77 S850 40 1010 77 S1140 100 1200 66"
                    fill="none"
                    stroke="#89AAD7"
                    stroke-opacity=".35"
                    stroke-width="1.5"
                />

            </svg>

        </div>


        {{-- JUDUL HEADER --}}
        <div class="header-title">

            <h1>
                @yield(
                    'page_title',
                    'Dashboard ' . ucfirst(auth()->user()->role ?? '')
                )
            </h1>

            <p>
                @yield(
                    'page_description',
                    'Kelola dan pantau aktivitas akademik sekolah melalui satu dashboard.'
                )
            </p>

        </div>


        {{-- KONTROL HEADER --}}
        <div class="header-controls">

            {{-- TOMBOL MODE GELAP --}}
            <button
                type="button"
                id="appThemeToggle"
                class="app-theme-toggle"
                title="Ganti tema"
                aria-label="Ganti tema"
            >
                <i
                    id="appThemeIcon"
                    class="bi bi-moon-stars-fill"
                    aria-hidden="true"
                ></i>
            </button>


            {{-- INFORMASI PENGGUNA --}}
            <div class="user-profile">

                <div class="user-info">

                    <div class="user-name">
                        {{ ucfirst(auth()->user()->username ?? 'Pengguna') }}
                    </div>

                    <div class="user-role">
                        @if (auth()->user()->role === 'admin')
                            Administrator
                        @elseif (auth()->user()->role === 'guru')
                            Guru
                        @elseif (auth()->user()->role === 'siswa')
                            Siswa
                        @else
                            Pengguna
                        @endif
                    </div>

                </div>


                {{-- AVATAR --}}
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->username ?? 'P', 0, 1)) }}
                </div>

            </div>

        </div>

    </header>


    {{-- ISI KONTEN SETIAP HALAMAN --}}
    @yield('content')

</main>


{{-- =========================================
     MODE GELAP / TERANG GLOBAL
========================================= --}}

<script>
    (function () {

        const root = document.documentElement;
        const body = document.body;

        const appToggle = document.getElementById('appThemeToggle');
        const appIcon = document.getElementById('appThemeIcon');


        function isDarkMode() {
            return root.classList.contains('dark') ||
                body.classList.contains('dark-mode');
        }


        function syncThemeIcons() {

            const isDark = isDarkMode();

            if (appIcon) {
                appIcon.className = isDark
                    ? 'bi bi-sun-fill'
                    : 'bi bi-moon-stars-fill';
            }

            const dashboardIcon = document.getElementById('themeIcon');

            if (dashboardIcon) {
                dashboardIcon.textContent = isDark ? '☀️' : '🌙';
            }

            if (appToggle) {

                appToggle.setAttribute(
                    'aria-label',
                    isDark ? 'Ganti ke mode terang' : 'Ganti ke mode gelap'
                );

                appToggle.setAttribute(
                    'title',
                    isDark ? 'Ganti ke mode terang' : 'Ganti ke mode gelap'
                );

            }

        }


        function applyTheme(theme) {

            const isDark = theme === 'dark';

            root.classList.toggle('dark', isDark);
            body.classList.toggle('dark-mode', isDark);

            try {

                localStorage.setItem(
                    'admin-theme',
                    isDark ? 'dark' : 'light'
                );

            } catch (error) {
                // Tema tetap diterapkan pada halaman yang sedang dibuka.
            }

            syncThemeIcons();

        }


        if (appToggle) {

            appToggle.addEventListener('click', function () {

                applyTheme(
                    isDarkMode() ? 'light' : 'dark'
                );

            });

        }


        /*
         * Dashboard lama memiliki tombol tema sendiri.
         * Pantau perubahan class agar ikon pada header ikut sinkron.
         */
        if (typeof MutationObserver !== 'undefined') {

            const observer = new MutationObserver(syncThemeIcons);

            observer.observe(root, {
                attributes: true,
                attributeFilter: ['class']
            });

            observer.observe(body, {
                attributes: true,
                attributeFilter: ['class']
            });

        }


        let savedTheme = 'light';

        try {

            savedTheme = localStorage.getItem('admin-theme') || 'light';

        } catch (error) {

            savedTheme = root.classList.contains('dark')
                ? 'dark'
                : 'light';

        }

        applyTheme(savedTheme);

    })();
</script>


{{-- =========================================
     JAVASCRIPT NAVBAR RESPONSIF
========================================= --}}

<script>
    (function () {

        const sidebar = document.getElementById('appSidebar');
        const toggle = document.getElementById('mobileMenuToggle');
        const close = document.getElementById('mobileSidebarClose');
        const overlay = document.getElementById('sidebarOverlay');
        const icon = document.getElementById('mobileMenuIcon');


        // Pastikan elemen navbar tersedia.
        if (!sidebar || !toggle || !overlay) {
            return;
        }


        // BUKA MENU
        function openMenu() {

            sidebar.classList.add('is-open');
            overlay.classList.add('is-visible');

            document.body.classList.add('sidebar-open');

            toggle.setAttribute('aria-expanded', 'true');
            toggle.setAttribute(
                'aria-label',
                'Tutup menu navigasi'
            );

            if (icon) {
                icon.className = 'bi bi-x-lg';
            }

        }


        // TUTUP MENU
        function closeMenu() {

            sidebar.classList.remove('is-open');
            overlay.classList.remove('is-visible');

            document.body.classList.remove('sidebar-open');

            toggle.setAttribute('aria-expanded', 'false');
            toggle.setAttribute(
                'aria-label',
                'Buka menu navigasi'
            );

            if (icon) {
                icon.className = 'bi bi-list';
            }

        }


        // KLIK TOMBOL HAMBURGER
        toggle.addEventListener('click', function () {

            if (sidebar.classList.contains('is-open')) {
                closeMenu();
            } else {
                openMenu();
            }

        });


        // KLIK TOMBOL X
        if (close) {

            close.addEventListener('click', function () {
                closeMenu();
            });

        }


        // KLIK AREA DI LUAR SIDEBAR
        overlay.addEventListener('click', function () {
            closeMenu();
        });


        // MENU TERTUTUP SETELAH LINK DIPILIH
        sidebar.querySelectorAll('.menu-item a').forEach(function (link) {

            link.addEventListener('click', function () {
                closeMenu();
            });

        });


        // TUTUP MENU DENGAN TOMBOL ESCAPE
        document.addEventListener('keydown', function (event) {

            if (event.key === 'Escape') {
                closeMenu();
            }

        });


        // RESET MENU KETIKA KEMBALI KE DESKTOP
        window.addEventListener('resize', function () {

            if (window.innerWidth > 767) {
                closeMenu();
            }

        });

    })();
</script>


@stack('scripts')

</body>
</html>