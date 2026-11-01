@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<style>
    /* =========================================
       EDUVIA ADMIN DASHBOARD
       Professional Pastel Blue
    ========================================= */

    .admin-dashboard {
        --edu-blue-light: #E3F0FA;
        --edu-blue-soft: #C3E0F4;
        --edu-blue-medium: #BAD1EC;
        --edu-blue: #A4BFDF;
        --edu-blue-accent: #89AAD7;
        --edu-blue-primary: #3478BD;
        --edu-blue-deep: #285F96;

        --edu-page: #F5F8FC;
        --edu-card: #FFFFFF;
        --edu-border: #D8E4F0;
        --edu-text: #293F57;
        --edu-muted: #60758B;

        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 14px;
        line-height: 1.65;
        color: var(--edu-text);
        animation: edu-dashboard-enter .25s ease-out both;
    }

    .admin-dashboard *,
    .admin-dashboard *::before,
    .admin-dashboard *::after {
        box-sizing: border-box;
    }

    .admin-dashboard svg {
        display: block;
        flex-shrink: 0;
    }

    @keyframes edu-dashboard-enter {
        from {
            opacity: 0;
            transform: translateY(4px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* =========================================
       HEADER
    ========================================= */

    .admin-dashboard .dashboard-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 18px;
        margin-bottom: 23px;
    }

    .admin-dashboard .dashboard-eyebrow {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0 0 5px;
        color: var(--edu-blue-primary);
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .09em;
        text-transform: uppercase;
    }

    .admin-dashboard .dashboard-eyebrow::before {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: var(--edu-blue-primary);
        content: "";
    }

    .admin-dashboard .dashboard-title {
        margin: 0;
        color: #29435F;
        font-size: clamp(25px, 2.2vw, 30px);
        font-weight: 800;
        line-height: 1.35;
        letter-spacing: -.6px;
    }

    .admin-dashboard .dashboard-subtitle {
        margin: 7px 0 0;
        color: var(--edu-muted);
        font-size: 13px;
        font-weight: 500;
    }

    .admin-dashboard .header-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .admin-dashboard .theme-button {
        display: inline-flex;
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        border: 1px solid #C8D9EA;
        border-radius: 11px;
        background: #FFFFFF;
        color: #355779;
        cursor: pointer;
        transition: background .2s ease, border-color .2s ease;
    }

    .admin-dashboard .theme-button svg {
        width: 19px;
        height: 19px;
    }

    .admin-dashboard .theme-button:hover {
        border-color: #8FB5DC;
        background: var(--edu-blue-light);
    }

    .admin-dashboard .theme-button:focus-visible,
    .admin-dashboard .quick-action:focus-visible {
        outline: 3px solid rgba(52,120,189,.35);
        outline-offset: 3px;
    }

    .admin-dashboard .date-badge {
        display: inline-flex;
        min-height: 42px;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 8px 13px;
        border: 1px solid #C8D9EA;
        border-radius: 11px;
        background: #FFFFFF;
        color: #355779;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    .admin-dashboard .date-badge svg {
        width: 17px;
        height: 17px;
        color: var(--edu-blue-primary);
    }

    /* =========================================
       WELCOME
    ========================================= */

    .admin-dashboard .welcome-box {
        position: relative;
        isolation: isolate;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 25px;
        padding: 27px 29px;
        border: 1px solid #2F6FAA;
        border-radius: 17px;
        background: linear-gradient(
            115deg,
            #3478BD 0%,
            #407CB8 55%,
            #527CA8 100%
        );
        color: #FFFFFF;
        box-shadow: 0 5px 14px rgba(41,89,139,.10);
    }

    .admin-dashboard .welcome-box::before {
        position: absolute;
        z-index: -1;
        top: -145px;
        right: 15%;
        width: 245px;
        height: 245px;
        border: 1px solid rgba(255,255,255,.15);
        border-radius: 50%;
        box-shadow:
            0 0 0 25px rgba(255,255,255,.035),
            0 0 0 50px rgba(255,255,255,.025);
        content: "";
        pointer-events: none;
    }

    .admin-dashboard .welcome-content {
        position: relative;
        z-index: 1;
        min-width: 0;
    }

    .admin-dashboard .welcome-label {
        margin: 0 0 5px;
        color: #EAF4FF;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .09em;
    }

    .admin-dashboard .welcome-title {
        margin: 0 0 8px;
        color: #FFFFFF;
        font-size: clamp(23px, 2vw, 28px);
        font-weight: 800;
        line-height: 1.4;
        letter-spacing: -.5px;
    }

    .admin-dashboard .welcome-description {
        max-width: 580px;
        margin: 0;
        color: #EAF4FF;
        font-size: 13px;
        font-weight: 500;
        line-height: 1.8;
    }

    .admin-dashboard .welcome-role {
        position: relative;
        z-index: 1;
        flex-shrink: 0;
        min-width: 180px;
        padding: 13px 16px;
        border: 1px solid rgba(255,255,255,.24);
        border-radius: 11px;
        background: rgba(255,255,255,.09);
    }

    .admin-dashboard .welcome-role-label {
        color: #DDEEFF;
        font-size: 11px;
        font-weight: 600;
    }

    .admin-dashboard .welcome-role-value {
        margin-top: 4px;
        color: #FFFFFF;
        font-size: 13px;
        font-weight: 800;
        line-height: 1.6;
    }

    /* =========================================
       KARTU STATISTIK
    ========================================= */

    .admin-dashboard .dashboard-card {
        height: 100%;
        overflow: hidden;
        border: 1px solid var(--edu-border);
        border-radius: 15px;
        background: var(--edu-card);
        color: var(--edu-text);
        box-shadow: 0 3px 10px rgba(47,82,124,.035);
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .admin-dashboard .dashboard-card:hover {
        border-color: #B5CDE5;
        box-shadow: 0 5px 14px rgba(47,82,124,.065);
    }

    .admin-dashboard .stat-card {
        position: relative;
        min-height: 140px;
    }

    .admin-dashboard .stat-card::before {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        width: 3px;
        background: var(--edu-blue-accent);
        content: "";
    }

    .admin-dashboard .stat-label {
        margin: 0 0 9px;
        color: var(--edu-muted);
        font-size: 12px;
        font-weight: 800;
    }

    .admin-dashboard .stat-number {
        margin: 0 0 5px;
        color: #29435F;
        font-size: clamp(27px, 2.2vw, 32px);
        font-weight: 800;
        letter-spacing: -.7px;
        line-height: 1.25;
        font-variant-numeric: tabular-nums;
        overflow-wrap: anywhere;
    }

    .admin-dashboard .stat-description {
        display: block;
        color: #718399;
        font-size: 11px;
        font-weight: 500;
        line-height: 1.6;
    }

    .admin-dashboard .stat-icon {
        display: flex;
        width: 45px;
        height: 45px;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        border: 1px solid #D4E4F3;
        border-radius: 11px;
        background: #EAF4FC;
        color: #3478BD;
    }

    .admin-dashboard .stat-icon svg {
        width: 22px;
        height: 22px;
    }

    /* =========================================
       JUDUL BAGIAN
    ========================================= */

    .admin-dashboard .section-heading {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .admin-dashboard .section-icon {
        display: flex;
        width: 40px;
        height: 40px;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        border: 1px solid #D3E4F3;
        border-radius: 11px;
        background: #EAF4FC;
        color: #3478BD;
    }

    .admin-dashboard .section-icon svg {
        width: 21px;
        height: 21px;
    }

    .admin-dashboard .section-title {
        margin: 0 0 4px;
        color: #304B69;
        font-size: 16px;
        font-weight: 800;
        line-height: 1.5;
    }

    .admin-dashboard .section-description {
        margin: 0;
        color: #718399;
        font-size: 12px;
        font-weight: 500;
        line-height: 1.7;
    }

    .admin-dashboard .section-divider {
        border-color: #DCE5EF !important;
    }

    /* =========================================
       AKSI CEPAT
    ========================================= */

    .admin-dashboard .quick-action {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        height: 100%;
        min-height: 78px;
        padding: 14px;
        border: 1px solid #D8E4F0;
        border-radius: 12px;
        background: #F8FAFD;
        color: #304B69;
        text-decoration: none;
        transition: background .2s ease, border-color .2s ease;
    }

    .admin-dashboard .quick-action:hover {
        border-color: #A9C9E8;
        background: #EDF6FF;
        color: #29435F;
        text-decoration: none;
    }

    .admin-dashboard .quick-icon {
        display: flex;
        width: 43px;
        height: 43px;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        border: 1px solid #D3E4F3;
        border-radius: 11px;
        background: #EAF4FC;
        color: #3478BD;
    }

    .admin-dashboard .quick-icon svg {
        width: 21px;
        height: 21px;
    }

    .admin-dashboard .quick-action-content {
        min-width: 0;
        flex: 1;
    }

    .admin-dashboard .quick-action-title {
        color: #304B69;
        font-size: 13px;
        font-weight: 800;
        line-height: 1.5;
    }

    .admin-dashboard .quick-action-description {
        margin-top: 4px;
        color: #718399;
        font-size: 11px;
        font-weight: 500;
        line-height: 1.6;
    }

    .admin-dashboard .quick-arrow {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
        color: #8BA4BE;
        transition: transform .2s ease;
    }

    .admin-dashboard .quick-action:hover .quick-arrow {
        transform: translateX(2px);
        color: #3478BD;
    }

    /* =========================================
       INFORMASI SISTEM
    ========================================= */

    .admin-dashboard .info-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 13px 0;
        border-bottom: 1px solid #E4EBF3;
    }

    .admin-dashboard .info-row:last-child {
        border-bottom: none;
    }

    .admin-dashboard .info-label {
        color: #718399;
        font-size: 12px;
        font-weight: 600;
    }

    .admin-dashboard .info-value {
        color: #344F6D;
        font-size: 12px;
        font-weight: 800;
        text-align: right;
        overflow-wrap: anywhere;
    }

    .admin-dashboard .system-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 9px;
        border: 1px solid #C8DFF2;
        border-radius: 7px;
        background: #EDF6FF;
        color: #2C6399;
        font-size: 11px;
        font-weight: 800;
        text-transform: capitalize;
    }

    .admin-dashboard .system-status {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 5px 9px;
        border: 1px solid #B9E5CC;
        border-radius: 7px;
        background: #ECFDF3;
        color: #187447;
        font-size: 11px;
        font-weight: 800;
    }

    .admin-dashboard .status-dot {
        width: 7px;
        height: 7px;
        flex-shrink: 0;
        border-radius: 50%;
        background: #22A06B;
    }

    /* =========================================
       DARK MODE
    ========================================= */

    html.dark .admin-dashboard,
    body.dark-mode .admin-dashboard {
        --edu-card: #1C2B3E;
        --edu-border: #354A62;
        --edu-text: #E4ECF6;
        --edu-muted: #B4C3D4;
        color: #E4ECF6;
    }

    html.dark .admin-dashboard .dashboard-eyebrow,
    body.dark-mode .admin-dashboard .dashboard-eyebrow {
        color: #A9C9EC;
    }

    html.dark .admin-dashboard .dashboard-eyebrow::before,
    body.dark-mode .admin-dashboard .dashboard-eyebrow::before {
        background: #89AAD7;
    }

    html.dark .admin-dashboard .dashboard-title,
    body.dark-mode .admin-dashboard .dashboard-title {
        color: #F1F6FC;
    }

    html.dark .admin-dashboard .dashboard-subtitle,
    body.dark-mode .admin-dashboard .dashboard-subtitle {
        color: #C2D0E0;
    }

    html.dark .admin-dashboard .theme-button,
    body.dark-mode .admin-dashboard .theme-button,
    html.dark .admin-dashboard .date-badge,
    body.dark-mode .admin-dashboard .date-badge {
        border-color: #435A74;
        background: #263A53;
        color: #DFECFB;
    }

    html.dark .admin-dashboard .theme-button:hover,
    body.dark-mode .admin-dashboard .theme-button:hover {
        background: #304965;
    }

    html.dark .admin-dashboard .date-badge svg,
    body.dark-mode .admin-dashboard .date-badge svg {
        color: #B9D8F7;
    }

    html.dark .admin-dashboard .welcome-box,
    body.dark-mode .admin-dashboard .welcome-box {
        border-color: #405773;
        background: linear-gradient(
            115deg,
            #192B40 0%,
            #20364E 55%,
            #263D57 100%
        );
        color: #F1F5F9;
        box-shadow: 0 5px 14px rgba(0,0,0,.15);
    }

    html.dark .admin-dashboard .welcome-label,
    body.dark-mode .admin-dashboard .welcome-label,
    html.dark .admin-dashboard .welcome-role-label,
    body.dark-mode .admin-dashboard .welcome-role-label {
        color: #C3D8EE;
    }

    html.dark .admin-dashboard .welcome-title,
    body.dark-mode .admin-dashboard .welcome-title,
    html.dark .admin-dashboard .welcome-role-value,
    body.dark-mode .admin-dashboard .welcome-role-value {
        color: #F1F6FC;
    }

    html.dark .admin-dashboard .welcome-description,
    body.dark-mode .admin-dashboard .welcome-description {
        color: #D0DDED;
    }

    html.dark .admin-dashboard .welcome-role,
    body.dark-mode .admin-dashboard .welcome-role {
        border-color: #455E79;
        background: rgba(38,60,84,.8);
    }

    html.dark .admin-dashboard .dashboard-card,
    body.dark-mode .admin-dashboard .dashboard-card {
        border-color: #354A62;
        background: #1C2B3E;
        color: #E4ECF6;
        box-shadow: 0 3px 10px rgba(0,0,0,.08);
    }

    html.dark .admin-dashboard .dashboard-card:hover,
    body.dark-mode .admin-dashboard .dashboard-card:hover {
        border-color: #526F90;
        background: #203247;
    }

    html.dark .admin-dashboard .stat-card::before,
    body.dark-mode .admin-dashboard .stat-card::before {
        background: #6E98C6;
    }

    html.dark .admin-dashboard .stat-label,
    body.dark-mode .admin-dashboard .stat-label {
        color: #C2D1E2;
    }

    html.dark .admin-dashboard .stat-number,
    body.dark-mode .admin-dashboard .stat-number {
        color: #EDF5FF;
    }

    html.dark .admin-dashboard .stat-description,
    body.dark-mode .admin-dashboard .stat-description {
        color: #AABBD0;
    }

    html.dark .admin-dashboard .stat-icon,
    body.dark-mode .admin-dashboard .stat-icon,
    html.dark .admin-dashboard .section-icon,
    body.dark-mode .admin-dashboard .section-icon,
    html.dark .admin-dashboard .quick-icon,
    body.dark-mode .admin-dashboard .quick-icon {
        border-color: #405B78;
        background: #263E59;
        color: #D8E9FC;
    }

    html.dark .admin-dashboard .section-title,
    body.dark-mode .admin-dashboard .section-title {
        color: #E6EFFA;
    }

    html.dark .admin-dashboard .section-description,
    body.dark-mode .admin-dashboard .section-description {
        color: #AABBD0;
    }

    html.dark .admin-dashboard .section-divider,
    body.dark-mode .admin-dashboard .section-divider {
        border-color: #354A62 !important;
    }

    html.dark .admin-dashboard .quick-action,
    body.dark-mode .admin-dashboard .quick-action {
        border-color: #354A62;
        background: #203247;
        color: #E4ECF6;
    }

    html.dark .admin-dashboard .quick-action:hover,
    body.dark-mode .admin-dashboard .quick-action:hover {
        border-color: #58789D;
        background: #293F58;
        color: #FFFFFF;
    }

    html.dark .admin-dashboard .quick-action-title,
    body.dark-mode .admin-dashboard .quick-action-title {
        color: #E4ECF6;
    }

    html.dark .admin-dashboard .quick-action-description,
    body.dark-mode .admin-dashboard .quick-action-description {
        color: #AABBD0;
    }

    html.dark .admin-dashboard .quick-arrow,
    body.dark-mode .admin-dashboard .quick-arrow {
        color: #9AB5D1;
    }

    html.dark .admin-dashboard .info-row,
    body.dark-mode .admin-dashboard .info-row {
        border-color: #354A62;
    }

    html.dark .admin-dashboard .info-label,
    body.dark-mode .admin-dashboard .info-label {
        color: #AABBD0;
    }

    html.dark .admin-dashboard .info-value,
    body.dark-mode .admin-dashboard .info-value {
        color: #E0EAF6;
    }

    html.dark .admin-dashboard .system-badge,
    body.dark-mode .admin-dashboard .system-badge {
        border-color: #435E7C;
        background: #263E59;
        color: #DFECFB;
    }

    html.dark .admin-dashboard .system-status,
    body.dark-mode .admin-dashboard .system-status {
        border-color: #286749;
        background: #163B2B;
        color: #9DE2BB;
    }

    html.dark .admin-dashboard .status-dot,
    body.dark-mode .admin-dashboard .status-dot {
        background: #4BC58A;
    }

    /* =========================================
       RESPONSIVE
    ========================================= */

    @media (max-width: 767px) {
        .admin-dashboard {
            font-size: 13px;
        }

        .admin-dashboard .dashboard-header {
            align-items: flex-start;
        }

        .admin-dashboard .header-actions {
            width: 100%;
            justify-content: flex-start;
        }

        .admin-dashboard .welcome-box {
            flex-direction: column;
            align-items: stretch;
            gap: 18px;
            padding: 22px 20px;
        }

        .admin-dashboard .welcome-title {
            font-size: 23px;
        }

        .admin-dashboard .welcome-role {
            width: 100%;
            min-width: 0;
        }

        .admin-dashboard .stat-card {
            min-height: 128px;
        }

        .admin-dashboard .stat-icon {
            width: 41px;
            height: 41px;
        }

        .admin-dashboard .stat-icon svg {
            width: 20px;
            height: 20px;
        }

        .admin-dashboard .quick-action {
            padding: 13px;
        }
    }

    @media (max-width: 420px) {
        .admin-dashboard .stat-card {
            padding: 16px !important;
        }

        .admin-dashboard .stat-number {
            font-size: 26px;
        }

        .admin-dashboard .info-row {
            align-items: flex-start;
        }

        .admin-dashboard .date-badge {
            padding: 8px 10px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .admin-dashboard,
        .admin-dashboard *,
        .admin-dashboard *::before,
        .admin-dashboard *::after {
            animation: none !important;
            transition: none !important;
        }
    }
</style>

<div class="admin-dashboard container-fluid py-4 px-3 px-lg-4">

    {{-- HEADER DASHBOARD --}}
    <div class="dashboard-header">
        <div>
            <p class="dashboard-eyebrow">
                Sistem Akademik Mini
            </p>

            <h2 class="dashboard-title">
                Dashboard Admin
            </h2>

            <p class="dashboard-subtitle">
                Selamat datang, {{ Auth::user()->username ?? 'Admin' }}!
            </p>
        </div>

        <div class="header-actions">
            <button
                type="button"
                id="themeToggle"
                class="theme-button"
                title="Ganti tema"
                aria-label="Ganti ke mode gelap"
                aria-pressed="false"
            >
                <span id="themeIcon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.9 13A8.5 8.5 0 0 1 11 3.1 8.5 8.5 0 1 0 20.9 13Z"/>
                    </svg>
                </span>
            </button>

            <span class="date-badge">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                     aria-hidden="true">
                    <rect x="3" y="5" width="18" height="16" rx="2"/>
                    <path d="M16 3v4M8 3v4M3 10h18"/>
                </svg>
                {{ now()->format('d M Y') }}
            </span>
        </div>
    </div>

    {{-- KARTU SELAMAT DATANG --}}
    <div class="welcome-box">
        <div class="welcome-content">
            <p class="welcome-label">
                SELAMAT DATANG KEMBALI
            </p>

            <h3 class="welcome-title">
                Halo, {{ Auth::user()->username ?? 'Admin' }}!
            </h3>

            <p class="welcome-description">
                Kelola dan pantau seluruh data akademik sekolah melalui satu dashboard.
            </p>
        </div>

        <div class="welcome-role">
            <div class="welcome-role-label">
                Sistem Akademik
            </div>

            <div class="welcome-role-value">
                Panel Administrasi
            </div>
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-4 mb-4">

        {{-- TOTAL SISWA --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="dashboard-card stat-card p-4">
                <div class="d-flex justify-content-between align-items-start gap-3">
                    <div class="min-w-0">
                        <p class="stat-label">Total Siswa</p>

                        <h3 class="stat-number">
                            {{ $jumlahSiswa ?? $totalSiswa ?? 0 }}
                        </h3>

                        <small class="stat-description">
                            Data siswa terdaftar
                        </small>
                    </div>

                    <div class="stat-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="8" r="3.5"/>
                            <path d="M2.5 20v-1.5A5.5 5.5 0 0 1 8 13h2a5.5 5.5 0 0 1 5.5 5.5V20z"/>
                            <path d="M16 5a3.5 3.5 0 0 1 0 6.8"/>
                            <path d="M18 14a4.5 4.5 0 0 1 3.5 4.4V20"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- TOTAL GURU --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="dashboard-card stat-card p-4">
                <div class="d-flex justify-content-between align-items-start gap-3">
                    <div class="min-w-0">
                        <p class="stat-label">Total Guru</p>

                        <h3 class="stat-number">
                            {{ $jumlahGuru ?? $totalGuru ?? 0 }}
                        </h3>

                        <small class="stat-description">
                            Guru terdaftar
                        </small>
                    </div>

                    <div class="stat-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="7" r="4"/>
                            <path d="M4 21v-2a8 8 0 0 1 16 0v2z"/>
                            <path d="M9 14h6"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- MATA PELAJARAN --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="dashboard-card stat-card p-4">
                <div class="d-flex justify-content-between align-items-start gap-3">
                    <div class="min-w-0">
                        <p class="stat-label">Mata Pelajaran</p>

                        <h3 class="stat-number">
                            {{ $jumlahMapel ?? $totalMapel ?? 0 }}
                        </h3>

                        <small class="stat-description">
                            Mata pelajaran tersedia
                        </small>
                    </div>

                    <div class="stat-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v17H6.5A2.5 2.5 0 0 1 4 17.5z"/>
                            <path d="M4 17.5A2.5 2.5 0 0 1 6.5 15H20"/>
                            <path d="M8 7h8M8 10h7"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- TOTAL KELAS --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="dashboard-card stat-card p-4">
                <div class="d-flex justify-content-between align-items-start gap-3">
                    <div class="min-w-0">
                        <p class="stat-label">Total Kelas</p>

                        <h3 class="stat-number">
                            {{ $jumlahKelas ?? $totalKelas ?? 0 }}
                        </h3>

                        <small class="stat-description">
                            Kelas terdaftar
                        </small>
                    </div>

                    <div class="stat-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 21h18"/>
                            <path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"/>
                            <path d="M9 7h1m4 0h1M9 11h1m4 0h1M9 15h1m4 0h1"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- AKSI CEPAT DAN INFORMASI SISTEM --}}
    <div class="row g-4">

        {{-- AKSI CEPAT --}}
        <div class="col-12 col-xl-8">
            <div class="dashboard-card h-100">

                <div class="p-4 border-bottom section-divider">
                    <div class="section-heading">
                        <div class="section-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 3v18M3 12h18"/>
                                <path d="m5 5 14 14M19 5 5 19"/>
                            </svg>
                        </div>

                        <div>
                            <h5 class="section-title">
                                Aksi Cepat
                            </h5>

                            <p class="section-description">
                                Akses fitur administrasi yang sering digunakan.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-4">
                    <div class="row g-3">

                        {{-- DATA SISWA --}}
                        <div class="col-12 col-md-6">
                            <a href="{{ route('admin.siswa.index') }}" class="quick-action">
                                <div class="quick-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="9" cy="8" r="3.5"/>
                                        <path d="M2.5 20v-1.5A5.5 5.5 0 0 1 8 13h2a5.5 5.5 0 0 1 5.5 5.5V20z"/>
                                        <path d="M16 5a3.5 3.5 0 0 1 0 6.8"/>
                                        <path d="M18 14a4.5 4.5 0 0 1 3.5 4.4V20"/>
                                    </svg>
                                </div>

                                <div class="quick-action-content">
                                    <div class="quick-action-title">Data Siswa</div>
                                    <div class="quick-action-description">Kelola data siswa</div>
                                </div>

                                <svg class="quick-arrow" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round"
                                     aria-hidden="true">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </a>
                        </div>

                        {{-- DATA GURU --}}
                        <div class="col-12 col-md-6">
                            <a href="{{ route('admin.guru.index') }}" class="quick-action">
                                <div class="quick-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="7" r="4"/>
                                        <path d="M4 21v-2a8 8 0 0 1 16 0v2z"/>
                                    </svg>
                                </div>

                                <div class="quick-action-content">
                                    <div class="quick-action-title">Data Guru</div>
                                    <div class="quick-action-description">Kelola data guru</div>
                                </div>

                                <svg class="quick-arrow" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round"
                                     aria-hidden="true">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </a>
                        </div>

                        {{-- DATA NILAI --}}
                        <div class="col-12 col-md-6">
                            <a href="{{ route('admin.nilai.index') }}" class="quick-action">
                                <div class="quick-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 3h9l4 4v14H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/>
                                        <path d="M14 3v5h5"/>
                                        <path d="m8 14 2.5 2.5L16 11"/>
                                    </svg>
                                </div>

                                <div class="quick-action-content">
                                    <div class="quick-action-title">Data Nilai</div>
                                    <div class="quick-action-description">Lihat nilai siswa</div>
                                </div>

                                <svg class="quick-arrow" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round"
                                     aria-hidden="true">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </a>
                        </div>

                        {{-- DATA RAPOR --}}
                        <div class="col-12 col-md-6">
                            <a href="{{ route('admin.rapor.index') }}" class="quick-action">
                                <div class="quick-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 3h9l4 4v14H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/>
                                        <path d="M14 3v5h5M8 13h8M8 17h8"/>
                                    </svg>
                                </div>

                                <div class="quick-action-content">
                                    <div class="quick-action-title">Data Rapor</div>
                                    <div class="quick-action-description">Kelola dan lihat rapor</div>
                                </div>

                                <svg class="quick-arrow" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round"
                                     aria-hidden="true">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        {{-- INFORMASI SISTEM --}}
        <div class="col-12 col-xl-4">
            <div class="dashboard-card h-100">

                <div class="p-4 border-bottom section-divider">
                    <div class="section-heading">
                        <div class="section-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 11v5M12 8h.01"/>
                            </svg>
                        </div>

                        <div>
                            <h5 class="section-title">
                                Informasi Sistem
                            </h5>

                            <p class="section-description">
                                Informasi aplikasi saat ini.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="px-4">

                    <div class="info-row">
                        <span class="info-label">Aplikasi</span>
                        <strong class="info-value">Sistem Akademik Mini</strong>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Versi</span>
                        <strong class="info-value">1.0.0</strong>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Role</span>

                        <span class="system-badge">
                            {{ Auth::user()->role ?? 'admin' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Total User</span>

                        <strong class="info-value">
                            {{ $totalUser ?? 0 }} akun
                        </strong>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Waktu</span>

                        <strong class="info-value">
                            {{ now()->format('H:i') }}
                        </strong>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Status</span>

                        <span class="system-status">
                            <span class="status-dot"></span>
                            Aktif
                        </span>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>

{{-- =========================================
     MODE GELAP DAN TERANG
========================================= --}}

<script>
(function () {
    const root = document.documentElement;
    const body = document.body;

    const themeButton = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');

    const moonIcon = `
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
             aria-hidden="true">
            <path d="M20.9 13A8.5 8.5 0 0 1 11 3.1 8.5 8.5 0 1 0 20.9 13Z"/>
        </svg>
    `;

    const sunIcon = `
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
             aria-hidden="true">
            <circle cx="12" cy="12" r="4"/>
            <path d="M12 2v2M12 20v2M4.93 4.93l1.42 1.42M17.65 17.65l1.42 1.42"/>
            <path d="M2 12h2M20 12h2M4.93 19.07l1.42-1.42M17.65 6.35l1.42-1.42"/>
        </svg>
    `;

    function isDarkMode() {
        return root.classList.contains('dark') ||
            body.classList.contains('dark-mode');
    }

    function updateThemeIcon() {
        const dark = isDarkMode();

        if (themeIcon) {
            themeIcon.innerHTML = dark ? sunIcon : moonIcon;
        }

        if (themeButton) {
            const label = dark
                ? 'Ganti ke mode terang'
                : 'Ganti ke mode gelap';

            themeButton.setAttribute('aria-label', label);
            themeButton.setAttribute('title', label);
            themeButton.setAttribute('aria-pressed', dark ? 'true' : 'false');
        }
    }

    function applyTheme(isDark) {
        root.classList.toggle('dark', isDark);
        body.classList.toggle('dark-mode', isDark);

        try {
            localStorage.setItem(
                'admin-theme',
                isDark ? 'dark' : 'light'
            );
        } catch (error) {
            // Tema tetap berubah untuk halaman yang sedang dibuka.
        }

        updateThemeIcon();
    }

    if (themeButton) {
        themeButton.addEventListener('click', function () {
            applyTheme(!isDarkMode());
        });
    }

    /*
     * Sinkronisasi ikon dengan perubahan tema dari layout.
     */
    if (typeof MutationObserver !== 'undefined') {
        const observer = new MutationObserver(updateThemeIcon);

        observer.observe(root, {
            attributes: true,
            attributeFilter: ['class']
        });

        observer.observe(body, {
            attributes: true,
            attributeFilter: ['class']
        });
    }

    updateThemeIcon();
})();
</script>

@endsection