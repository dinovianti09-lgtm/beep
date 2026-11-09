
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>404 — Halaman Tidak Ditemukan | Sistem Akademik Mini</title>

    <style>
        :root {
            --primary: #5b84d6;
            --primary-dark: #315c9c;
            --text: #25436f;
            --muted: #7089b5;
            --border: #d7e5ff;
            --soft: #f2f7ff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 11% 28%,
                    rgba(178, 208, 255, .36) 0 75px,
                    transparent 100px),
                radial-gradient(circle at 91% 88%,
                    rgba(178, 208, 255, .35) 0 75px,
                    transparent 110px),
                linear-gradient(120deg, #e4efff, #f7faff 65%, #e6f0ff);
        }

        .error-card {
            width: 100%;
            max-width: 510px;
            padding: 24px 33px 23px;
            background: #fff;
            border-radius: 25px;
            text-align: center;
            box-shadow: 0 20px 55px rgba(64, 104, 166, .12);
            animation: fadeIn .6s ease both;
        }

        /* Header seperti Error 500 */
        .brand {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }

        .brand-icon {
            width: 34px;
            height: 34px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            background: #e8f1ff;
            color: #5483d4;
        }

        .brand-name {
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.8px;
            color: #315b9c;
        }

        /* Ilustrasi dalam lingkaran */
        .illustration {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 8px auto 7px;
            border-radius: 50%;
            background: #eaf2ff;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: floating 4s ease-in-out infinite;
        }

        .illustration svg {
            width: 100px;
            height: 100px;
        }

        .error-code {
            font-size: 54px;
            line-height: 1.05;
            font-weight: 900;
            letter-spacing: -2px;
            color: #aac8fa;
        }

        .error-title {
            margin-top: 7px;
            font-size: 24px;
            line-height: 1.3;
            font-weight: 800;
            color: #25436f;
        }

        .error-description {
            max-width: 395px;
            margin: 10px auto 0;
            font-size: 12.5px;
            line-height: 1.9;
            color: #6f87b0;
        }

        /* Kotak informasi */
        .status-box {
            min-height: 44px;
            margin-top: 13px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: #f3f7ff;
            color: #4b73ad;
            font-size: 11.5px;
            font-weight: 700;
        }

        .status-dot {
            width: 9px;
            height: 9px;
            flex-shrink: 0;
            border-radius: 50%;
            background: #b8d2fa;
            box-shadow: 0 0 0 4px #e7f0ff;
        }

        /* Tombol sama lebar */
        .actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 14px;
        }

        .btn {
            min-height: 45px;
            padding: 11px 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 11px;
            border: 1px solid var(--border);
            font-family: inherit;
            font-size: 12.5px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: .2s ease;
        }

        .btn svg {
            width: 17px;
            height: 17px;
            flex-shrink: 0;
        }

        .btn-outline {
            color: #4b73b6;
            background: #f1f6ff;
        }

        .btn-outline:hover {
            background: #e5efff;
            transform: translateY(-2px);
        }

        .btn-primary {
            color: #fff;
            background: #5b84d6;
            border-color: #5b84d6;
            box-shadow: 0 6px 15px rgba(91, 132, 214, .12);
        }

        .btn-primary:hover {
            background: #4874c8;
            transform: translateY(-2px);
        }

        /* Footer dengan garis */
        .footer {
            margin-top: 15px;
            padding-top: 14px;
            border-top: 1px solid #e8effb;
            font-size: 10.5px;
            color: #91a7c8;
        }

        @keyframes floating {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 520px) {
            body {
                padding: 16px;
            }

            .error-card {
                padding: 23px 20px 20px;
                border-radius: 22px;
            }

            .brand-name {
                font-size: 10.5px;
                letter-spacing: 1.2px;
            }

            .illustration {
                width: 108px;
                height: 108px;
            }

            .illustration svg {
                width: 90px;
                height: 90px;
            }

            .error-code {
                font-size: 49px;
            }

            .error-title {
                font-size: 21px;
            }

            .error-description {
                font-size: 12px;
            }

            .status-box {
                font-size: 11px;
            }

            .btn {
                font-size: 11.5px;
                padding: 10px 7px;
            }
        }

        @media (max-width: 340px) {
            .actions {
                grid-template-columns: 1fr;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>

<body>

    <main class="error-card">

        <!-- HEADER -->
        <div class="brand">
            <div class="brand-icon">
                <svg width="20" height="20"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.7"
                     stroke-linecap="round"
                     stroke-linejoin="round">
                    <path d="M12 7
                             C9 5 5 5 3 6
                             V19
                             C6 18 9 18 12 20
                             C15 18 18 18 21 19
                             V6
                             C18 5 15 5 12 7Z"/>
                    <path d="M12 7V20"/>
                </svg>
            </div>

            <span class="brand-name">
                SISTEM AKADEMIK MINI
            </span>
        </div>

        <!-- ILUSTRASI 404 -->
        <div class="illustration">
            <svg viewBox="0 0 120 120"
                 xmlns="http://www.w3.org/2000/svg"
                 role="img"
                 aria-label="Ilustrasi buku yang sedang dicari">

                <!-- Buku kiri -->
                <path d="M58 41
                         Q39 31 17 40
                         V85
                         Q39 78 58 91Z"
                      fill="#9dc5f4"
                      stroke="#6a9ddd"
                      stroke-width="3"/>

                <!-- Buku kanan -->
                <path d="M58 41
                         Q78 31 100 40
                         V85
                         Q78 78 58 91Z"
                      fill="#d0e5ff"
                      stroke="#6a9ddd"
                      stroke-width="3"/>

                <path d="M58 41V91"
                      stroke="#6a9ddd"
                      stroke-width="3"/>

                <!-- Garis halaman -->
                <path d="M26 53 Q39 48 49 55
                         M26 65 Q39 60 49 67
                         M26 77 Q39 72 49 79"
                      stroke="#ffffff"
                      stroke-width="3"
                      stroke-linecap="round"
                      fill="none"/>

                <!-- Kaca pembesar -->
                <circle cx="85" cy="35" r="19"
                        fill="#f7fbff"
                        stroke="#6596d8"
                        stroke-width="5"/>

                <line x1="99" y1="49"
                      x2="113" y2="63"
                      stroke="#6596d8"
                      stroke-width="7"
                      stroke-linecap="round"/>

                <!-- Tanda tanya -->
                <text x="85" y="43"
                      font-size="26"
                      font-weight="bold"
                      text-anchor="middle"
                      font-family="Arial"
                      fill="#6596d8">?</text>

                <circle cx="17" cy="24" r="4"
                        fill="#a9cafa"/>
            </svg>
        </div>

        <!-- KODE ERROR -->
        <div class="error-code">404</div>

        <h1 class="error-title">
            Ups, Halamannya Tidak Ada!
        </h1>

        <p class="error-description">
            Halaman yang kamu cari tidak ditemukan.
            Mungkin alamatnya kurang tepat atau
            halaman sudah dipindahkan.
        </p>

        <!-- INFORMASI -->
        <div class="status-box">
            <span class="status-dot"></span>
            <span>Halaman yang diminta tidak ditemukan</span>
        </div>

        <!-- TOMBOL -->
        <div class="actions">

            <button type="button"
                    class="btn btn-outline"
                    onclick="window.history.back()">

                <svg viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round">
                    <path d="M9 14L4 9L9 4"/>
                    <path d="M4 9H14A6 6 0 0 1 14 21H11"/>
                </svg>

                Kembali
            </button>

            <a href="{{ url('/') }}"
               class="btn btn-primary">

                <svg viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round">
                    <path d="M3 10L12 3L21 10V21H3Z"/>
                    <path d="M9 21V13H15V21"/>
                </svg>

                Ke Beranda
            </a>

        </div>

        <!-- FOOTER -->
        <div class="footer">
            Sistem Akademik Mini
        </div>

    </main>

</body>
</html>
