@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<style>
    .admin-dashboard {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .dashboard-card {
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        background: #ffffff;
        transition: all 0.25s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .quick-action {
        border: 1px solid #e2e8f0;
        background: #fff;
        border-radius: 14px;
        padding: 18px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 14px;
        transition: all 0.25s ease;
        height: 100%;
    }

    .quick-action:hover {
        transform: translateY(-2px);
        border-color: #c7d2fe;
        background: #f8faff;
        text-decoration: none;
    }

    .quick-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .info-row {
        padding: 14px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    /* DARK MODE */

    body.dark-mode {
        background: #020617 !important;
        color: #e2e8f0;
    }

    body.dark-mode .admin-dashboard {
        color: #e2e8f0;
    }

    body.dark-mode .dashboard-card {
        background: #0f172a;
        border-color: #1e293b;
        color: #e2e8f0;
    }

    body.dark-mode .dashboard-card:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
    }

    body.dark-mode .quick-action {
        background: #0f172a;
        border-color: #1e293b;
        color: #e2e8f0;
    }

    body.dark-mode .quick-action:hover {
        background: #172033;
        border-color: #3730a3;
    }

    body.dark-mode .text-muted {
        color: #94a3b8 !important;
    }

    body.dark-mode .info-row {
        border-color: #1e293b;
    }

    body.dark-mode .date-badge {
        background: #312e81 !important;
        color: #c7d2fe !important;
    }

    body.dark-mode .theme-button {
        background: #1e293b;
        color: #facc15;
        border-color: #334155;
    }

    .theme-button {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        color: #475569;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .theme-button:hover {
        transform: translateY(-1px);
    }

    .welcome-box {
        background: linear-gradient(
            135deg,
            #4f46e5 0%,
            #7c3aed 100%
        );
        border-radius: 20px;
        color: white;
        padding: 26px;
        margin-bottom: 24px;
        box-shadow: 0 12px 30px rgba(79, 70, 229, 0.18);
    }
</style>


<div class="admin-dashboard container-fluid py-4 px-3 px-lg-4">


    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <p
                class="text-primary fw-semibold small mb-1"
                style="letter-spacing: .08em; text-transform: uppercase;">

                Sistem Akademik Mini

            </p>

            <h2 class="fw-bold mb-1">
                Dashboard Admin
            </h2>

            <p class="text-muted mb-0">
                Selamat datang, {{ Auth::user()->username ?? 'Admin' }} 👋
            </p>

        </div>


        <div class="d-flex align-items-center gap-3">

            {{-- DARK LIGHT --}}

            <button
                type="button"
                id="themeToggle"
                class="theme-button"
                title="Ganti tema">

                <span id="themeIcon">
                    🌙
                </span>

            </button>


            {{-- TANGGAL --}}

            <span
                class="date-badge badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-3 d-none d-sm-inline-block">

                {{ now()->format('d M Y') }}

            </span>

        </div>

    </div>



    {{-- =====================================================
        WELCOME
    ====================================================== --}}

    <div class="welcome-box">

        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">

            <div>

                <p class="mb-1 opacity-75 small">
                    Selamat datang kembali
                </p>

                <h3 class="fw-bold mb-2">
                    Halo, {{ Auth::user()->username ?? 'Admin' }}! 👋
                </h3>

                <p class="mb-0 opacity-75 small">
                    Kelola data akademik sekolah dengan mudah melalui dashboard ini.
                </p>

            </div>


            <div
                class="rounded-4 px-4 py-3"
                style="background: rgba(255,255,255,.12);">

                <div class="small opacity-75">
                    Role
                </div>

                <div class="fw-bold">
                    Administrator
                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
        STATISTIK
    ====================================================== --}}

    <div class="row g-4 mb-4">


        {{-- SISWA --}}

        <div class="col-12 col-sm-6 col-xl-3">

            <div class="dashboard-card h-100 p-4">

                <div
                    class="d-flex justify-content-between align-items-start">

                    <div>

                        <p class="text-muted small mb-2">
                            Total Siswa
                        </p>

                        <h3 class="fw-bold mb-1">
                            {{ $totalSiswa ?? 0 }}
                        </h3>

                        <small class="text-muted">
                            Data siswa terdaftar
                        </small>

                    </div>


                    <div
                        class="stat-icon"
                        style="background:#eef2ff; color:#4f46e5;">

                        👨‍🎓

                    </div>

                </div>

            </div>

        </div>



        {{-- GURU --}}

        <div class="col-12 col-sm-6 col-xl-3">

            <div class="dashboard-card h-100 p-4">

                <div
                    class="d-flex justify-content-between align-items-start">

                    <div>

                        <p class="text-muted small mb-2">
                            Total Guru
                        </p>

                        <h3 class="fw-bold mb-1">
                            {{ $totalGuru ?? 0 }}
                        </h3>

                        <small class="text-muted">
                            Guru terdaftar
                        </small>

                    </div>


                    <div
                        class="stat-icon"
                        style="background:#ecfdf5; color:#059669;">

                        👨‍🏫

                    </div>

                </div>

            </div>

        </div>



        {{-- MAPEL --}}

        <div class="col-12 col-sm-6 col-xl-3">

            <div class="dashboard-card h-100 p-4">

                <div
                    class="d-flex justify-content-between align-items-start">

                    <div>

                        <p class="text-muted small mb-2">
                            Mata Pelajaran
                        </p>

                        <h3 class="fw-bold mb-1">
                            {{ $totalMapel ?? 0 }}
                        </h3>

                        <small class="text-muted">
                            Mata pelajaran tersedia
                        </small>

                    </div>


                    <div
                        class="stat-icon"
                        style="background:#fffbeb; color:#d97706;">

                        📚

                    </div>

                </div>

            </div>

        </div>



        {{-- USER --}}

        <div class="col-12 col-sm-6 col-xl-3">

            <div class="dashboard-card h-100 p-4">

                <div
                    class="d-flex justify-content-between align-items-start">

                    <div>

                        <p class="text-muted small mb-2">
                            Total User
                        </p>

                        <h3 class="fw-bold mb-1">
                            {{ $totalUser ?? 0 }}
                        </h3>

                        <small class="text-muted">
                            Akun pengguna sistem
                        </small>

                    </div>


                    <div
                        class="stat-icon"
                        style="background:#eff6ff; color:#2563eb;">

                        👤

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
        BAWAH
    ====================================================== --}}

    <div class="row g-4">


        {{-- =================================================
            AKSI CEPAT
        ================================================== --}}

        <div class="col-12 col-xl-8">

            <div class="dashboard-card h-100">

                <div class="p-4 border-bottom">

                    <h5 class="fw-bold mb-1">
                        Aksi Cepat
                    </h5>

                    <p class="text-muted small mb-0">
                        Akses fitur administrasi yang sering digunakan.
                    </p>

                </div>


                <div class="p-4">

                    <div class="row g-3">


                        {{-- SISWA --}}

                        <div class="col-12 col-md-6">

                            <a
                                href="{{ route('admin.siswa.index') }}"
                                class="quick-action">

                                <div
                                    class="quick-icon"
                                    style="background:#eef2ff; color:#4f46e5;">

                                    👨‍🎓

                                </div>

                                <div>

                                    <div class="fw-bold">
                                        Data Siswa
                                    </div>

                                    <div class="text-muted small mt-1">
                                        Kelola data siswa
                                    </div>

                                </div>

                            </a>

                        </div>



                        {{-- GURU --}}

                        <div class="col-12 col-md-6">

                            <a
                                href="{{ route('admin.guru.index') }}"
                                class="quick-action">

                                <div
                                    class="quick-icon"
                                    style="background:#ecfdf5; color:#059669;">

                                    👨‍🏫

                                </div>

                                <div>

                                    <div class="fw-bold">
                                        Data Guru
                                    </div>

                                    <div class="text-muted small mt-1">
                                        Kelola data guru
                                    </div>

                                </div>

                            </a>

                        </div>



                        {{-- NILAI --}}

                        <div class="col-12 col-md-6">

                            <a
                                href="{{ route('admin.nilai.index') }}"
                                class="quick-action">

                                <div
                                    class="quick-icon"
                                    style="background:#fffbeb; color:#d97706;">

                                    📝

                                </div>

                                <div>

                                    <div class="fw-bold">
                                        Data Nilai
                                    </div>

                                    <div class="text-muted small mt-1">
                                        Kelola nilai siswa
                                    </div>

                                </div>

                            </a>

                        </div>



                        {{-- RAPOR --}}

                        <div class="col-12 col-md-6">

                            <a
                                href="{{ route('admin.rapor.index') }}"
                                class="quick-action">

                                <div
                                    class="quick-icon"
                                    style="background:#eff6ff; color:#2563eb;">

                                    📄

                                </div>

                                <div>

                                    <div class="fw-bold">
                                        Data Rapor
                                    </div>

                                    <div class="text-muted small mt-1">
                                        Kelola dan lihat rapor
                                    </div>

                                </div>

                            </a>

                        </div>


                    </div>

                </div>

            </div>

        </div>



        {{-- =================================================
            INFORMASI SISTEM
        ================================================== --}}

        <div class="col-12 col-xl-4">

            <div class="dashboard-card h-100">

                <div class="p-4 border-bottom">

                    <h5 class="fw-bold mb-1">
                        Informasi Sistem
                    </h5>

                    <p class="text-muted small mb-0">
                        Informasi aplikasi saat ini.
                    </p>

                </div>


                <div class="px-4">


                    <div class="info-row d-flex justify-content-between align-items-center">

                        <span class="text-muted small">
                            Aplikasi
                        </span>

                        <strong class="small">
                            Sistem Akademik Mini
                        </strong>

                    </div>


                    <div class="info-row d-flex justify-content-between align-items-center">

                        <span class="text-muted small">
                            Versi
                        </span>

                        <strong class="small">
                            1.0.0
                        </strong>

                    </div>


                    <div class="info-row d-flex justify-content-between align-items-center">

                        <span class="text-muted small">
                            Role
                        </span>

                        <span class="badge bg-primary rounded-pill px-3">

                            {{ Auth::user()->role ?? 'admin' }}

                        </span>

                    </div>


                    <div class="info-row d-flex justify-content-between align-items-center">

                        <span class="text-muted small">
                            Waktu
                        </span>

                        <strong class="small">
                            {{ now()->format('H:i') }}
                        </strong>

                    </div>


                    <div class="info-row d-flex justify-content-between align-items-center">

                        <span class="text-muted small">
                            Status
                        </span>

                        <span class="badge bg-success rounded-pill px-3">

                            Aktif

                        </span>

                    </div>


                </div>

            </div>

        </div>

    </div>

</div>



{{-- =========================================================
    DARK / LIGHT MODE
========================================================= --}}

<script>

    const themeButton = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');


    function applyTheme(theme) {

        if (theme === 'dark') {

            document.body.classList.add('dark-mode');

            themeIcon.textContent = '☀️';

            localStorage.setItem('admin-theme', 'dark');

        } else {

            document.body.classList.remove('dark-mode');

            themeIcon.textContent = '🌙';

            localStorage.setItem('admin-theme', 'light');

        }

    }


    const savedTheme = localStorage.getItem('admin-theme');


    if (savedTheme) {

        applyTheme(savedTheme);

    } else {

        applyTheme('light');

    }


    themeButton.addEventListener('click', function () {

        const isDark =
            document.body.classList.contains('dark-mode');

        applyTheme(
            isDark ? 'light' : 'dark'
        );

    });

</script>

@endsection