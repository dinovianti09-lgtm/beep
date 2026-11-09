
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#edf5ff">
    <title>500 — Kendala Sistem | Sistem Akademik Mini</title>

    <style>
        :root {
            color-scheme: light;
            --primary: #5984d4;
            --primary-dark: #345fa9;
            --heading: #25436e;
            --muted: #7286a5;
            --border: #dce8fa;
        }

        * {
            box-sizing: border-box;
        }

        html {
            min-height: 100%;
        }

        body {
            margin: 0;
            min-height: 100vh;
            min-height: 100dvh;
            padding: 24px 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            font-family: "Segoe UI", Arial, sans-serif;
            color: var(--heading);
            background:
                radial-gradient(
                    circle at 10% 12%,
                    #dceaff 0,
                    transparent 38%
                ),
                radial-gradient(
                    circle at 90% 88%,
                    #d8e7ff 0,
                    transparent 35%
                ),
                #f5f9ff;
        }

        .background-circle {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            background: #c8ddff80;
            filter: blur(4px);
            animation: floating 7s ease-in-out infinite;
        }

        .background-circle.first {
            width: 150px;
            height: 150px;
            top: 7%;
            left: 5%;
        }

        .background-circle.second {
            width: 105px;
            height: 105px;
            right: 6%;
            bottom: 9%;
            animation-delay: -3s;
        }

        .error-card {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 510px;
            padding: 32px 36px 27px;
            border: 1px solid #fff;
            border-radius: 26px;
            background: #ffffffed;
            box-shadow:
                0 20px 55px #4a75b51a,
                0 4px 14px #4a75b50a;
            text-align: center;
            animation: card-enter .65s ease both;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: #315a99;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.8px;
        }

        .brand-icon {
            display: grid;
            place-items: center;
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: #e8f1ff;
            color: #527dce;
            flex-shrink: 0;
        }

        .illustration {
            position: relative;
            display: grid;
            place-items: center;
            width: 170px;
            height: 150px;
            margin: 15px auto 3px;
        }

        .illustration-bg {
            position: absolute;
            width: 137px;
            height: 137px;
            border-radius: 50%;
            background: #e7f0ff;
            animation: breathing 4s ease-in-out infinite;
        }

        .server-svg {
            position: relative;
            z-index: 1;
            width: 135px;
            height: 135px;
            animation: floating 4.5s ease-in-out infinite;
            filter: drop-shadow(0 10px 10px #4a75b52a);
        }

        .error-number {
            margin: 0 0 8px;
            font-size: 69px;
            font-weight: 900;
            letter-spacing: -4px;
            line-height: 1;
            color: #a8c6f7;
        }

        h1 {
            margin: 0;
            font-size: 25px;
            font-weight: 800;
            letter-spacing: -.5px;
            line-height: 1.35;
        }

        .description {
            max-width: 390px;
            margin: 12px auto 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.8;
        }

        .status {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
            padding: 13px 12px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: #f5f9ff;
            color: #5677a6;
            font-size: 12px;
            font-weight: 650;
        }

        .status-dot {
            width: 9px;
            height: 9px;
            flex-shrink: 0;
            border-radius: 50%;
            background: #eeb778;
            box-shadow: 0 0 0 4px #fff0df;
            animation: blinking 2s infinite;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .button {
            display: inline-flex;
            flex: 1;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 45px;
            padding: 11px 13px;
            border-radius: 11px;
            border: 1px solid transparent;
            font-family: inherit;
            font-size: 13px;
            font-weight: 750;
            text-decoration: none;
            cursor: pointer;
            transition:
                background .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }

        .button:hover {
            transform: translateY(-2px);
        }

        .button:focus-visible {
            outline: 3px solid #a2c1f8;
            outline-offset: 3px;
        }

        .button-retry {
            color: #466fae;
            background: #f1f7ff;
            border-color: #dbe8fb;
        }

        .button-retry:hover {
            background: #e5f0ff;
        }

        .button-home {
            color: #fff;
            background: var(--primary);
            box-shadow: 0 7px 16px #5984d42b;
        }

        .button-home:hover {
            background: var(--primary-dark);
        }

        .footer {
            margin-top: 22px;
            padding-top: 17px;
            border-top: 1px solid #edf2fa;
            color: #98a9c0;
            font-size: 11px;
        }

        @keyframes floating {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        @keyframes breathing {
            0%, 100% {
                transform: scale(1);
                opacity: .8;
            }

            50% {
                transform: scale(1.07);
                opacity: 1;
            }
        }

        @keyframes blinking {
            0%, 100% {
                opacity: 1;
            }

            50% {
                opacity: .45;
            }
        }

        @keyframes card-enter {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* LAYAR HP */
        @media (max-width: 480px) {
            body {
                padding: 12px;
                align-items: center;
            }

            .error-card {
                max-width: 390px;
                padding: 23px 18px 20px;
                border-radius: 20px;
            }

            .brand {
                font-size: 10px;
                letter-spacing: 1px;
                gap: 7px;
            }

            .brand-icon {
                width: 30px;
                height: 30px;
            }

            .illustration {
                width: 135px;
                height: 120px;
                margin: 10px auto 0;
            }

            .illustration-bg {
                width: 110px;
                height: 110px;
            }

            .server-svg {
                width: 112px;
                height: 112px;
            }

            .error-number {
                font-size: 54px;
                margin-bottom: 6px;
            }

            h1 {
                font-size: 20px;
            }

            .description {
                margin-top: 9px;
                font-size: 12px;
                line-height: 1.65;
            }

            .status {
                margin: 15px 0;
                padding: 11px 9px;
                font-size: 11px;
            }

            .actions {
                gap: 8px;
            }

            .button {
                font-size: 11px;
                min-height: 42px;
                padding: 9px 7px;
            }

            .footer {
                margin-top: 17px;
                padding-top: 13px;
            }
        }

        /* HP DENGAN LAYAR PENDEK */
        @media (max-width: 480px) and (max-height: 650px) {
            body {
                align-items: flex-start;
                padding: 10px;
            }

            .error-card {
                padding: 16px;
            }

            .illustration {
                height: 95px;
                margin-top: 5px;
            }

            .illustration-bg {
                width: 90px;
                height: 90px;
            }

            .server-svg {
                width: 95px;
                height: 95px;
            }

            .error-number {
                font-size: 46px;
            }

            .description {
                line-height: 1.5;
            }

            .status {
                margin: 10px 0;
            }

            .footer {
                margin-top: 12px;
            }
        }

        /* LAPTOP DENGAN LAYAR PENDEK */
        @media (min-width: 481px) and (max-height: 760px) {
            body {
                padding: 12px;
            }

            .error-card {
                padding: 22px 32px;
            }

            .illustration {
                height: 120px;
                margin-top: 8px;
            }

            .illustration-bg {
                width: 115px;
                height: 115px;
            }

            .server-svg {
                width: 115px;
                height: 115px;
            }

            .error-number {
                font-size: 56px;
            }

            .description {
                margin-top: 8px;
            }

            .status {
                margin: 14px 0;
            }

            .footer {
                margin-top: 15px;
                padding-top: 12px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="background-circle first" aria-hidden="true"></div>
    <div class="background-circle second" aria-hidden="true"></div>

    <main class="error-card">

        <!-- IDENTITAS SISTEM -->
        <div class="brand">
            <span class="brand-icon" aria-hidden="true">
                <svg width="19" height="19"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     stroke-linecap="round"
                     stroke-linejoin="round">
                    <path d="M12 7.5C9 5.5 5.5 5 2.5 6v12c3-1 6.5-.5 9.5 1.5"/>
                    <path d="M12 7.5c3-2 6.5-2.5 9.5-1.5v12c-3-1-6.5-.5-9.5 1.5"/>
                    <path d="M12 7.5v12"/>
                </svg>
            </span>

            <span>SISTEM AKADEMIK MINI</span>
        </div>

        <!-- ILUSTRASI SERVER -->
        <div class="illustration" aria-hidden="true">
            <div class="illustration-bg"></div>

            <svg class="server-svg"
                 viewBox="0 0 160 160"
                 fill="none">

                <rect x="26" y="33" width="108" height="32"
                      rx="10" fill="#8DB4F0"/>
                <rect x="32" y="38" width="96" height="22"
                      rx="6" fill="#DDEAFF"/>

                <circle cx="46" cy="49" r="4" fill="#70B6A8"/>
                <circle cx="60" cy="49" r="4" fill="#9DBEF0"/>

                <path d="M94 49h22"
                      stroke="#8FADE0"
                      stroke-width="4"
                      stroke-linecap="round"/>

                <rect x="26" y="72" width="108" height="32"
                      rx="10" fill="#729EE0"/>
                <rect x="32" y="77" width="96" height="22"
                      rx="6" fill="#DDEAFF"/>

                <circle cx="46" cy="88" r="4" fill="#70B6A8"/>
                <circle cx="60" cy="88" r="4" fill="#9DBEF0"/>

                <path d="M94 88h22"
                      stroke="#8FADE0"
                      stroke-width="4"
                      stroke-linecap="round"/>

                <rect x="26" y="111" width="108" height="26"
                      rx="9" fill="#5D8ACF"/>
                <rect x="32" y="116" width="96" height="16"
                      rx="5" fill="#DDEAFF"/>

                <circle cx="46" cy="124" r="3.5" fill="#70B6A8"/>

                <path d="M94 124h22"
                      stroke="#8FADE0"
                      stroke-width="4"
                      stroke-linecap="round"/>

                <circle cx="125" cy="36" r="19" fill="#FFF1E2"/>

                <path d="M125 26v12"
                      stroke="#E9A765"
                      stroke-width="4"
                      stroke-linecap="round"/>

                <circle cx="125" cy="44" r="2.5" fill="#E9A765"/>
            </svg>
        </div>

        <!-- KODE ERROR -->
        <div class="error-number">500</div>

        <!-- JUDUL -->
        <h1>Ups, Ada Sedikit Kendala!</h1>

        <!-- DESKRIPSI -->
        <p class="description">
            Sepertinya sistem akademik sedang mengalami gangguan.
            Jangan khawatir, kamu bisa mencoba kembali
            beberapa saat lagi.
        </p>

        <!-- STATUS -->
        <div class="status" role="status">
            <span class="status-dot"></span>
            <span>Terjadi kendala internal pada sistem</span>
        </div>

        <!-- TOMBOL AKSI -->
        <div class="actions">
            <button type="button"
                    class="button button-retry"
                    onclick="window.location.reload()">

                <svg width="16" height="16"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     aria-hidden="true">
                    <path d="M3 12a9 9 0 1 0 3-6.7L3 8"/>
                    <path d="M3 3v5h5"/>
                </svg>

                Coba Lagi
            </button>

            <a href="/" class="button button-home">
                <svg width="16" height="16"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     aria-hidden="true">
                    <path d="m3 10 9-7 9 7"/>
                    <path d="M5 9v12h14V9"/>
                    <path d="M9 21v-7h6v7"/>
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
