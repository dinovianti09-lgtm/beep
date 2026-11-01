<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDUVIA - Sistem Informasi Akademik</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #3478BD;
            --primary-dark: #285F96;
            --navy: #193B5B;
            --navy-deep: #142F49;
            --blue-soft: #E3F0FA;
            --blue-pale: #F2F7FC;
            --white: #FFFFFF;
            --text: #293F57;
            --muted: #526982;
            --border: #D5E1ED;
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
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--blue-pale);
            color: var(--text);
            line-height: 1.7;
        }

        a {
            text-decoration: none;
        }

        button {
            font-family: inherit;
        }

        .container {
            width: min(1140px, calc(100% - 48px));
            margin: auto;
        }

        /* NAVBAR */

        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
        }

        .navbar-inner {
            min-height: 78px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            background: var(--primary);
            color: white;
            font-size: 17px;
            font-weight: 800;
            box-shadow: 0 5px 13px rgba(52, 120, 189, 0.22);
        }

        .brand-name {
            color: var(--navy);
            font-size: 21px;
            font-weight: 800;
            letter-spacing: -0.8px;
        }

        .brand-name span {
            color: var(--primary);
        }

        .brand-caption {
            color: var(--muted);
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 32px;
        }

        .nav-menu a {
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
            transition: 0.2s;
        }

        .nav-menu a:hover {
            color: var(--primary);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 12px 21px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            transition: 0.25s;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 5px 13px rgba(52, 120, 189, 0.19);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-outline {
            border: 1px solid var(--border);
            color: var(--navy);
            background: white;
        }

        .btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .mobile-toggle {
            display: none;
            border: 0;
            background: var(--blue-soft);
            color: var(--navy);
            width: 42px;
            height: 42px;
            border-radius: 10px;
            font-size: 22px;
            cursor: pointer;
        }

        /* HERO */

        .hero {
            padding: 78px 0 88px;
            background:
                radial-gradient(circle at 85% 15%, rgba(126, 183, 229, 0.35), transparent 27%),
                linear-gradient(135deg, #F2F7FC 0%, #E3F0FA 100%);
            overflow: hidden;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            align-items: center;
            gap: 55px;
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 30px;
            background: white;
            border: 1px solid var(--border);
            color: var(--primary-dark);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.5px;
            margin-bottom: 23px;
        }

        .hero-label span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #54A0DB;
        }

        .hero h1 {
            max-width: 570px;
            color: var(--navy-deep);
            font-size: clamp(36px, 5vw, 57px);
            line-height: 1.18;
            letter-spacing: -2px;
            font-weight: 800;
            margin-bottom: 22px;
        }

        .hero h1 span {
            color: var(--primary);
        }

        .hero-description {
            max-width: 490px;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.9;
            margin-bottom: 30px;
        }

        .hero-buttons {
            display: flex;
            align-items: center;
            gap: 13px;
            flex-wrap: wrap;
        }

        .hero-note {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-top: 27px;
            color: var(--muted);
            font-size: 11px;
            font-weight: 600;
        }

        .hero-note span {
            color: var(--primary);
            font-size: 16px;
        }

        /* HERO DASHBOARD PREVIEW */

        .preview-wrapper {
            position: relative;
            padding: 18px;
        }

        .preview-decoration {
            position: absolute;
            width: 115px;
            height: 115px;
            background: rgba(52, 120, 189, 0.13);
            border-radius: 28px;
            top: -8px;
            right: -8px;
            transform: rotate(13deg);
        }

        .preview-card {
            position: relative;
            z-index: 1;
            padding: 23px;
            background: white;
            border: 1px solid #DCE8F3;
            border-radius: 20px;
            box-shadow: 0 22px 55px rgba(30, 70, 105, 0.13);
        }

        .preview-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 18px;
            border-bottom: 1px solid #E9F0F7;
        }

        .preview-title {
            color: var(--navy);
            font-size: 15px;
            font-weight: 800;
        }

        .preview-status {
            padding: 6px 10px;
            border-radius: 20px;
            background: var(--blue-soft);
            color: var(--primary-dark);
            font-size: 9px;
            font-weight: 800;
        }

        .preview-greeting {
            margin: 21px 0 16px;
        }

        .preview-greeting small {
            color: var(--muted);
            font-size: 11px;
        }

        .preview-greeting h3 {
            color: var(--navy);
            font-size: 19px;
            font-weight: 800;
            margin-top: 3px;
        }

        .preview-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .preview-stat {
            padding: 14px 10px;
            border-radius: 12px;
            background: var(--blue-pale);
            border: 1px solid #E5EEF7;
        }

        .preview-stat small {
            display: block;
            color: var(--muted);
            font-size: 9px;
            font-weight: 600;
        }

        .preview-stat strong {
            display: block;
            color: var(--navy);
            font-size: 21px;
            margin-top: 6px;
        }

        .preview-section-title {
            margin: 23px 0 12px;
            color: var(--navy);
            font-size: 12px;
            font-weight: 800;
        }

        .preview-list {
            display: flex;
            flex-direction: column;
            gap: 11px;
        }

        .preview-item {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .preview-item-icon {
            width: 34px;
            height: 34px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            background: var(--blue-soft);
            color: var(--primary);
            font-size: 15px;
        }

        .preview-item-text {
            flex: 1;
        }

        .preview-item-text strong {
            display: block;
            color: var(--navy);
            font-size: 10px;
        }

        .preview-item-text small {
            color: var(--muted);
            font-size: 9px;
        }

        .preview-item-status {
            color: var(--primary);
            font-size: 9px;
            font-weight: 800;
        }

        .preview-footer {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 20px;
            padding: 13px;
            border-radius: 10px;
            background: var(--navy);
            color: white;
            font-size: 10px;
            font-weight: 700;
        }

        /* SECTION GENERAL */

        .section {
            padding: 85px 0;
        }

        .section-heading {
            max-width: 620px;
            margin: 0 auto 43px;
            text-align: center;
        }

        .section-label {
            display: inline-block;
            color: var(--primary);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 12px;
        }

        .section-heading h2 {
            color: var(--navy);
            font-size: clamp(27px, 4vw, 36px);
            line-height: 1.3;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 13px;
        }

        .section-heading p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.9;
        }

        /* FEATURES */

        .features-section {
            background: white;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .feature-card {
            padding: 25px;
            border-radius: 16px;
            background: white;
            border: 1px solid var(--border);
            transition: 0.25s;
        }

        .feature-card:hover {
            border-color: #9AC3E5;
            box-shadow: 0 13px 30px rgba(30, 70, 105, 0.08);
            transform: translateY(-5px);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            display: grid;
            place-items: center;
            margin-bottom: 19px;
            border-radius: 13px;
            background: var(--blue-soft);
            color: var(--primary);
            font-size: 21px;
        }

        .feature-card h3 {
            color: var(--navy);
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .feature-card p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.85;
        }

        /* ABOUT */

        .about-section {
            background: var(--blue-pale);
        }

        .about-grid {
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            align-items: center;
            gap: 65px;
        }

        .about-visual {
            min-height: 330px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 22px;
            background: linear-gradient(145deg, var(--primary), var(--navy));
            box-shadow: 0 18px 35px rgba(30, 70, 105, 0.16);
        }

        .about-circle {
            position: absolute;
            width: 260px;
            height: 260px;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 50%;
        }

        .about-circle::before {
            content: "";
            position: absolute;
            inset: 25px;
            border: 1px solid rgba(255,255,255,0.16);
            border-radius: 50%;
        }

        .about-center {
            position: relative;
            text-align: center;
            color: white;
        }

        .about-center .about-logo {
            width: 75px;
            height: 75px;
            display: grid;
            place-items: center;
            margin: 0 auto 15px;
            background: rgba(255,255,255,0.16);
            border: 1px solid rgba(255,255,255,0.28);
            border-radius: 22px;
            font-size: 30px;
            font-weight: 800;
        }

        .about-center h3 {
            font-size: 25px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .about-center p {
            color: #DDECF9;
            font-size: 11px;
            margin-top: 4px;
        }

        .about-content .section-label {
            margin-bottom: 11px;
        }

        .about-content h2 {
            color: var(--navy);
            font-size: 33px;
            line-height: 1.35;
            letter-spacing: -1px;
            font-weight: 800;
            margin-bottom: 17px;
        }

        .about-content > p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.95;
            margin-bottom: 23px;
        }

        .about-points {
            display: flex;
            flex-direction: column;
            gap: 13px;
        }

        .about-point {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            color: var(--text);
            font-size: 12px;
            font-weight: 700;
        }

        .about-check {
            flex-shrink: 0;
            width: 23px;
            height: 23px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: var(--blue-soft);
            color: var(--primary);
            font-size: 12px;
        }

        /* CTA */

        .cta-section {
            padding: 68px 0;
            background: white;
        }

        .cta-box {
            position: relative;
            overflow: hidden;
            padding: 48px 35px;
            text-align: center;
            border-radius: 22px;
            background: linear-gradient(120deg, var(--navy), var(--primary-dark));
        }

        .cta-box::before,
        .cta-box::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            border: 1px solid rgba(255,255,255,0.13);
            border-radius: 50%;
        }

        .cta-box::before {
            top: -110px;
            left: -55px;
        }

        .cta-box::after {
            bottom: -130px;
            right: -35px;
        }

        .cta-box h2 {
            position: relative;
            z-index: 1;
            color: white;
            font-size: clamp(24px, 4vw, 34px);
            font-weight: 800;
            margin-bottom: 12px;
        }

        .cta-box p {
            position: relative;
            z-index: 1;
            max-width: 550px;
            margin: 0 auto 24px;
            color: #DDECF9;
            font-size: 13px;
            line-height: 1.8;
        }

        .cta-box .btn {
            position: relative;
            z-index: 1;
            background: white;
            color: var(--navy);
        }

        .cta-box .btn:hover {
            background: var(--blue-soft);
            transform: translateY(-2px);
        }

        /* FOOTER */

        .footer {
            padding: 29px 0;
            background: var(--navy-deep);
            color: #D7E6F4;
        }

        .footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .footer-brand {
            color: white;
            font-size: 16px;
            font-weight: 800;
        }

        .footer-brand span {
            color: #8FC5F0;
        }

        .footer p {
            font-size: 11px;
            color: #B8CADB;
        }

        /* RESPONSIVE */

        @media (max-width: 850px) {
            .hero-grid {
                grid-template-columns: 1fr;
                gap: 35px;
            }

            .hero-content {
                text-align: center;
            }

            .hero h1,
            .hero-description {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-buttons,
            .hero-note {
                justify-content: center;
            }

            .preview-wrapper {
                max-width: 540px;
                width: 100%;
                margin: auto;
            }

            .about-grid {
                grid-template-columns: 1fr;
                gap: 35px;
            }

            .about-visual {
                min-height: 280px;
            }

            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 650px) {
            .container {
                width: min(100% - 30px, 540px);
            }

            .navbar-inner {
                min-height: 70px;
                flex-wrap: wrap;
            }

            .mobile-toggle {
                display: block;
            }

            .nav-menu {
                display: none;
                order: 3;
                width: 100%;
                flex-direction: column;
                align-items: stretch;
                gap: 0;
                padding: 10px 0 15px;
            }

            .nav-menu.active {
                display: flex;
            }

            .nav-menu a {
                padding: 11px 4px;
            }

            .nav-actions {
                margin-left: auto;
                margin-right: 10px;
            }

            .nav-actions .btn {
                padding: 10px 13px;
                font-size: 11px;
            }

            .hero {
                padding: 55px 0 65px;
            }

            .hero h1 {
                font-size: 38px;
            }

            .hero-description {
                font-size: 13px;
            }

            .preview-card {
                padding: 17px;
            }

            .preview-stats {
                gap: 6px;
            }

            .preview-stat {
                padding: 11px 7px;
            }

            .preview-stat strong {
                font-size: 17px;
            }

            .section {
                padding: 65px 0;
            }

            .features-grid {
                grid-template-columns: 1fr;
                gap: 13px;
            }

            .feature-card {
                padding: 21px;
            }

            .about-content h2 {
                font-size: 27px;
            }

            .cta-box {
                padding: 40px 20px;
            }

            .footer-inner {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <header class="navbar">
        <div class="container navbar-inner">

            <a href="#" class="brand">
                <div class="brand-icon">E</div>
                <div>
                    <div class="brand-name">EDU<span>VIA</span></div>
                    <div class="brand-caption">Sistem Informasi Akademik</div>
                </div>
            </a>

            <nav class="nav-menu" id="navMenu">
                <a href="#">Beranda</a>
                <a href="#fitur">Fitur</a>
                <a href="#tentang">Tentang</a>
            </nav>

            <div class="nav-actions">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                        Dashboard →
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        Masuk →
                    </a>
                @endauth
            </div>

            <button class="mobile-toggle" id="mobileToggle" type="button" aria-label="Buka menu">
                ☰
            </button>

        </div>
    </header>


    <!-- HERO -->
    <main>
        <section class="hero">
            <div class="container hero-grid">

                <div class="hero-content">
                    <div class="hero-label">
                        <span></span>
                        PLATFORM AKADEMIK SEKOLAH
                    </div>

                    <h1>
                        Kelola Akademik Sekolah Jadi Lebih <span>Mudah.</span>
                    </h1>

                    <p class="hero-description">
                        EDUVIA membantu sekolah mengelola data siswa, guru,
                        kelas, mata pelajaran, nilai, hingga rapor dalam
                        satu sistem yang terintegrasi.
                    </p>

                    <div class="hero-buttons">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                                Buka Dashboard →
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                Mulai Sekarang →
                            </a>
                        @endauth

                        <a href="#fitur" class="btn btn-outline">
                            Jelajahi Fitur
                        </a>
                    </div>

                    <div class="hero-note">
                        <span>✓</span>
                        Pengelolaan data akademik lebih teratur dan praktis
                    </div>
                </div>


                <!-- PREVIEW TAMPILAN -->
                <div class="preview-wrapper">
                    <div class="preview-decoration"></div>

                    <div class="preview-card">

                        <div class="preview-top">
                            <div class="preview-title">EDUVIA Dashboard</div>
                            <div class="preview-status">SISTEM AKADEMIK</div>
                        </div>

                        <div class="preview-greeting">
                            <small>Selamat datang di</small>
                            <h3>Sistem Akademik EDUVIA</h3>
                        </div>

                        <div class="preview-stats">
                            <div class="preview-stat">
                                <small>Data Siswa</small>
                                <strong>01</strong>
                            </div>

                            <div class="preview-stat">
                                <small>Data Guru</small>
                                <strong>02</strong>
                            </div>

                            <div class="preview-stat">
                                <small>Data Kelas</small>
                                <strong>03</strong>
                            </div>
                        </div>

                        <div class="preview-section-title">
                            Pengelolaan Akademik
                        </div>

                        <div class="preview-list">
                            <div class="preview-item">
                                <div class="preview-item-icon">▦</div>
                                <div class="preview-item-text">
                                    <strong>Data Siswa</strong>
                                    <small>Pengelolaan informasi siswa</small>
                                </div>
                                <div class="preview-item-status">Kelola</div>
                            </div>

                            <div class="preview-item">
                                <div class="preview-item-icon">♙</div>
                                <div class="preview-item-text">
                                    <strong>Data Guru</strong>
                                    <small>Informasi dan data pengajar</small>
                                </div>
                                <div class="preview-item-status">Kelola</div>
                            </div>

                            <div class="preview-item">
                                <div class="preview-item-icon">▤</div>
                                <div class="preview-item-text">
                                    <strong>Data Nilai</strong>
                                    <small>Pengelolaan hasil belajar</small>
                                </div>
                                <div class="preview-item-status">Kelola</div>
                            </div>
                        </div>

                        <div class="preview-footer">
                            <span>EDUVIA Academic System</span>
                            <span>● Active</span>
                        </div>

                    </div>
                </div>

            </div>
        </section>


        <!-- FITUR -->
        <section class="section features-section" id="fitur">
            <div class="container">

                <div class="section-heading">
                    <span class="section-label">Fitur EDUVIA</span>

                    <h2>Semua Kebutuhan Akademik dalam Satu Sistem</h2>

                    <p>
                        Berbagai fitur untuk membantu pengelolaan administrasi
                        dan kegiatan akademik sekolah agar lebih terorganisir.
                    </p>
                </div>

                <div class="features-grid">

                    <div class="feature-card">
                        <div class="feature-icon">♙</div>
                        <h3>Data Siswa</h3>
                        <p>
                            Mengelola informasi siswa, identitas, kelas,
                            serta data akademik secara terstruktur.
                        </p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">♧</div>
                        <h3>Data Guru</h3>
                        <p>
                            Mengelola informasi guru dan data pengajar
                            dalam sistem akademik sekolah.
                        </p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">▦</div>
                        <h3>Data Kelas</h3>
                        <p>
                            Mengatur informasi kelas, tingkat, jurusan,
                            dan wali kelas.
                        </p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">▤</div>
                        <h3>Mata Pelajaran</h3>
                        <p>
                            Mengelola daftar mata pelajaran beserta
                            informasi KKM setiap mata pelajaran.
                        </p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">✎</div>
                        <h3>Pengelolaan Nilai</h3>
                        <p>
                            Mencatat nilai harian, UTS, UAS, serta
                            perhitungan nilai akhir siswa.
                        </p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">▧</div>
                        <h3>Rapor Siswa</h3>
                        <p>
                            Menyajikan rekap hasil belajar siswa
                            berdasarkan periode semester.
                        </p>
                    </div>

                </div>
            </div>
        </section>


        <!-- TENTANG -->
        <section class="section about-section" id="tentang">
            <div class="container about-grid">

                <div class="about-visual">
                    <div class="about-circle"></div>

                    <div class="about-center">
                        <div class="about-logo">E</div>
                        <h3>EDUVIA</h3>
                        <p>Academic Management System</p>
                    </div>
                </div>

                <div class="about-content">
                    <span class="section-label">Tentang Kami</span>

                    <h2>Mengenal EDUVIA Lebih Dekat</h2>

                    <p>
                        EDUVIA merupakan sistem informasi akademik sekolah
                        yang dirancang untuk membantu proses pengelolaan
                        data pendidikan secara digital. Melalui satu
                        platform, informasi akademik dapat dikelola
                        dengan lebih terstruktur.
                    </p>

                    <div class="about-points">
                        <div class="about-point">
                            <span class="about-check">✓</span>
                            <span>Pengelolaan data akademik dalam satu platform.</span>
                        </div>

                        <div class="about-point">
                            <span class="about-check">✓</span>
                            <span>Informasi siswa, guru, dan nilai lebih terorganisir.</span>
                        </div>

                        <div class="about-point">
                            <span class="about-check">✓</span>
                            <span>Mendukung pengelolaan rapor berdasarkan semester.</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>


        <!-- CTA -->
        <section class="cta-section">
            <div class="container">

                <div class="cta-box">
                    <h2>Mulai Kelola Akademik Bersama EDUVIA</h2>

                    <p>
                        Akses sistem informasi akademik untuk mengelola
                        data dan mendukung kegiatan administrasi sekolah.
                    </p>

                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn">
                            Masuk ke Dashboard →
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn">
                            Masuk ke Sistem →
                        </a>
                    @endauth
                </div>

            </div>
        </section>
    </main>


    <!-- FOOTER -->
    <footer class="footer">
        <div class="container footer-inner">

            <div class="footer-brand">
                EDU<span>VIA</span>
            </div>

            <p>
                © {{ date('Y') }} EDUVIA. Sistem Informasi Akademik Sekolah.
            </p>

        </div>
    </footer>


    <script>
        const mobileToggle = document.getElementById('mobileToggle');
        const navMenu = document.getElementById('navMenu');

        mobileToggle.addEventListener('click', function () {
            navMenu.classList.toggle('active');
        });

        document.querySelectorAll('.nav-menu a').forEach(function (link) {
            link.addEventListener('click', function () {
                navMenu.classList.remove('active');
            });
        });
    </script>

</body>
</html>