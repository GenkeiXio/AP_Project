<!DOCTYPE html>
<html lang="fil">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katibayan ng Pagmamay-Ari ng Lupa at Bahay</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Crimson+Text:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <style>
        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        }

        body {
            font-family: 'Crimson Text', Georgia, serif;
            background: #e8edf0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .certificate-wrapper {
            width: 720px;
            max-width: 100%;
            background: linear-gradient(160deg, #e8f4e2 0%, #d4ecd0 30%, #c8e8f8 70%, #b8e0f8 100%);
            border-radius: 18px;
            padding: 6px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.18);
            position: relative;
            overflow: hidden;
        }

        /* Sky background top */
        .certificate-wrapper::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 55%;
            background: linear-gradient(180deg, #b8e4f8 0%, #cceeff 40%, #ddf4e8 100%);
            z-index: 0;
            border-radius: 15px 15px 0 0;
        }

        /* Grass bottom */
        .certificate-wrapper::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 45%;
            background: linear-gradient(180deg, #c8e8a0 0%, #8bc34a 60%, #689f38 100%);
            z-index: 0;
            border-radius: 0 0 15px 15px;
        }

        .certificate {
            position: relative;
            z-index: 2;
            padding: 28px 36px 32px;
        }

        /* Decorative border */
        .border-frame {
            position: absolute;
            top: 8px; left: 8px; right: 8px; bottom: 8px;
            border: 3px solid rgba(255,255,255,0.6);
            border-radius: 14px;
            pointer-events: none;
            z-index: 3;
        }

        /* Header */
        .republic-header {
            text-align: center;
            font-family: 'Crimson Text', serif;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #1a4a7a;
            margin-bottom: 4px;
            text-shadow: 1px 1px 0 rgba(255,255,255,0.5);
        }

        .flag-icon {
            font-size: 22px;
            vertical-align: middle;
            margin-right: 6px;
        }

        /* Main title */
        .main-title {
            text-align: center;
            margin: 6px 0 4px;
        }

        .main-title .line1 {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 900;
            color: #c0392b;
            text-shadow: 2px 2px 0 rgba(255,255,255,0.8), 0 2px 8px rgba(192,57,43,0.15);
            display: block;
            letter-spacing: 1px;
        }

        .main-title .line2 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: #c0392b;
            text-shadow: 1px 1px 0 rgba(255,255,255,0.8);
            display: block;
            letter-spacing: 0.5px;
            margin-top: -2px;
        }

        /* House illustration area */
        .house-section {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            margin: 8px 0 0;
            gap: 20px;
        }

        .house-svg {
            width: 160px;
            max-width: 100%;
            filter: drop-shadow(2px 4px 8px rgba(0,0,0,0.15));
        }

        /* White content card */
        .content-card {
            background: rgba(255, 255, 255, 0.88);
            border-radius: 14px;
            padding: 22px 28px 24px;
            margin-top: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            backdrop-filter: blur(6px);
            border: 1.5px solid rgba(255,255,255,0.9);
        }

        .certify-text {
            text-align: center;
            font-size: 16px;
            color: #3a3a3a;
            margin-bottom: 4px;
            font-style: italic;
        }

        .name-field {
            border-bottom: 3px solid #1a4a7a;
            width: 80%;
            margin: 0 auto 2px;
            min-height: 32px;
            display: block;
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            color: #1a3a5c;
            font-family: 'Playfair Display', serif;
            padding: 2px 8px;
            background: rgba(255,255,255,0.3);
            border-radius: 0 0 4px 4px;
        }

        .name-label {
            text-align: center;
            font-size: 12px;
            color: #666;
            font-style: italic;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        .description-text {
            font-size: 14px;
            color: #333;
            text-align: center;
            line-height: 1.7;
            margin-bottom: 14px;
            padding: 0 4px;
        }

        .description-text strong {
            color: #1a4a7a;
        }

        /* Details box */
        .details-box {
            background: linear-gradient(135deg, rgba(240, 255, 240, 0.9), rgba(220, 255, 220, 0.8));
            border: 2px solid #66bb6a;
            border-radius: 10px;
            padding: 12px 18px;
            margin-bottom: 12px;
        }

        .details-title {
            font-weight: 700;
            font-size: 14px;
            color: #2e7d32;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .details-title .icon { font-size: 18px; }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13.5px;
            color: #333;
            padding: 2px 0;
        }

        .check-icon {
            color: #27ae60;
            font-weight: bold;
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        /* Location box */
        .location-box {
            background: linear-gradient(135deg, rgba(255, 248, 220, 0.9), rgba(255, 243, 200, 0.8));
            border: 2px solid #f0b942;
            border-radius: 10px;
            padding: 10px 16px;
            margin-bottom: 14px;
            font-size: 13.5px;
            color: #5a3e00;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .location-icon { font-size: 20px; margin-top: 1px; }

        /* Date & Signature section */
        .date-sig-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 16px;
        }

        .date-field-group,
        .sig-field-group {
            flex: 1;
        }

        .field-label {
            font-size: 12px;
            color: #555;
            margin-bottom: 2px;
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 600;
        }

        .field-label .icon { font-size: 14px; }

        .field-line {
            border-bottom: 2px solid #1a4a7a;
            width: 100%;
            min-height: 28px;
            display: block;
            background: rgba(255,255,255,0.2);
            border-radius: 0 0 4px 4px;
        }

        .sig-label {
            font-size: 11px;
            color: #666;
            text-align: center;
            margin-top: 2px;
            font-style: italic;
        }

        /* Congratulations footer */
        .congrats-footer {
            margin-top: 16px;
            text-align: center;
            background: linear-gradient(135deg, #fff9e6, #fff3cc);
            border-radius: 12px;
            padding: 14px 20px;
            border: 2px solid #f0c040;
            box-shadow: 0 2px 12px rgba(240,180,0,0.12);
        }

        .congrats-title {
            font-size: 18px;
            font-weight: 700;
            color: #b8860b;
            margin-bottom: 4px;
        }

        .congrats-text {
            font-size: 13.5px;
            color: #5a4000;
            line-height: 1.6;
            font-style: italic;
        }

        /* Decorative corner houses/icons */
        .deco-tl, .deco-tr {
            position: absolute;
            top: 16px;
            font-size: 32px;
            z-index: 4;
            filter: drop-shadow(1px 2px 3px rgba(0,0,0,0.1));
            opacity: 0.8;
        }
        .deco-tl { left: 18px; }
        .deco-tr { right: 18px; }

        /* Clouds */
        .cloud {
            position: absolute;
            background: rgba(255,255,255,0.75);
            border-radius: 50px;
            z-index: 1;
            box-shadow: 0 2px 10px rgba(255,255,255,0.3);
        }
        .cloud-1 { 
            width: 80px; 
            height: 24px; 
            top: 50px; 
            left: 35px; 
        }
        .cloud-1::before {
            content: '';
            position: absolute;
            width: 40px; 
            height: 40px;
            background: rgba(255,255,255,0.75);
            border-radius: 50%;
            top: -18px; 
            left: 10px;
        }
        .cloud-1::after {
            content: '';
            position: absolute;
            width: 28px; 
            height: 28px;
            background: rgba(255,255,255,0.7);
            border-radius: 50%;
            top: -12px; 
            left: 40px;
        }
        .cloud-2 { 
            width: 60px; 
            height: 20px; 
            top: 42px; 
            right: 45px; 
        }
        .cloud-2::before {
            content: '';
            position: absolute;
            width: 32px; 
            height: 32px;
            background: rgba(255,255,255,0.75);
            border-radius: 50%;
            top: -14px; 
            left: 8px;
        }
        .cloud-2::after {
            content: '';
            position: absolute;
            width: 22px; 
            height: 22px;
            background: rgba(255,255,255,0.7);
            border-radius: 50%;
            top: -10px; 
            left: 32px;
        }

        /* Keys decoration */
        .keys-deco {
            position: absolute;
            bottom: 18px;
            right: 24px;
            font-size: 30px;
            z-index: 4;
            opacity: 0.6;
            transform: rotate(-15deg);
        }

        /* Scroll decoration */
        .scroll-deco {
            position: absolute;
            bottom: 16px;
            left: 24px;
            font-size: 28px;
            z-index: 4;
            opacity: 0.6;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .certificate-wrapper {
                width: 100%;
                border-radius: 12px;
                padding: 4px;
            }

            .certificate {
                padding: 20px 20px 24px;
            }

            .main-title .line1 {
                font-size: 24px;
            }

            .main-title .line2 {
                font-size: 18px;
            }

            .house-svg {
                width: 130px;
            }

            .content-card {
                padding: 16px 18px 18px;
            }

            .name-field {
                font-size: 20px;
                min-height: 28px;
                width: 85%;
            }

            .description-text {
                font-size: 13px;
            }

            .details-box {
                padding: 10px 14px;
            }

            .detail-item {
                font-size: 12.5px;
            }

            .location-box {
                font-size: 12.5px;
                padding: 8px 14px;
            }

            .date-sig-section {
                flex-direction: column;
                gap: 10px;
            }

            .congrats-footer {
                padding: 12px 16px;
            }

            .congrats-title {
                font-size: 16px;
            }

            .congrats-text {
                font-size: 12.5px;
            }

            .deco-tl, .deco-tr {
                font-size: 24px;
                top: 12px;
            }
            .deco-tl { left: 12px; }
            .deco-tr { right: 12px; }

            .cloud-1 {
                width: 60px;
                height: 18px;
                top: 38px;
                left: 25px;
            }
            .cloud-1::before {
                width: 30px;
                height: 30px;
                top: -14px;
                left: 8px;
            }
            .cloud-1::after {
                width: 20px;
                height: 20px;
                top: -10px;
                left: 30px;
            }
            .cloud-2 {
                width: 45px;
                height: 16px;
                top: 32px;
                right: 30px;
            }
            .cloud-2::before {
                width: 24px;
                height: 24px;
                top: -10px;
                left: 6px;
            }
            .cloud-2::after {
                width: 16px;
                height: 16px;
                top: -8px;
                left: 24px;
            }

            .keys-deco {
                font-size: 22px;
                bottom: 12px;
                right: 16px;
            }
            .scroll-deco {
                font-size: 20px;
                bottom: 12px;
                left: 16px;
            }
        }

        @media (max-width: 480px) {
            .certificate {
                padding: 14px 12px 18px;
            }

            .main-title .line1 {
                font-size: 20px;
            }

            .main-title .line2 {
                font-size: 15px;
            }

            .house-svg {
                width: 100px;
            }

            .content-card {
                padding: 12px 14px 14px;
                border-radius: 10px;
            }

            .republic-header {
                font-size: 11px;
                letter-spacing: 1.5px;
            }

            .name-field {
                font-size: 18px;
                min-height: 24px;
                width: 90%;
            }

            .certify-text {
                font-size: 14px;
            }

            .description-text {
                font-size: 12px;
                line-height: 1.5;
            }

            .details-title {
                font-size: 13px;
            }
            .detail-item {
                font-size: 11.5px;
            }
            .location-box {
                font-size: 11.5px;
            }

            .field-label {
                font-size: 11px;
            }
            .field-line {
                min-height: 22px;
            }

            .congrats-title {
                font-size: 14px;
            }
            .congrats-text {
                font-size: 11.5px;
            }

            .deco-tl, .deco-tr {
                font-size: 18px;
                top: 8px;
            }
            .deco-tl { left: 8px; }
            .deco-tr { right: 8px; }

            .cloud-1 {
                display: none;
            }
            .cloud-2 {
                display: none;
            }

            .keys-deco {
                font-size: 18px;
                bottom: 8px;
                right: 10px;
            }
            .scroll-deco {
                font-size: 16px;
                bottom: 8px;
                left: 10px;
            }

            .border-frame {
                top: 4px; left: 4px; right: 4px; bottom: 4px;
                border-width: 2px;
            }
        }

        /* Print styles */
        @media print {
            body {
                background: white;
                padding: 0;
            }
            .certificate-wrapper {
                box-shadow: none;
                border-radius: 0;
                padding: 0;
            }
            .certificate {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="certificate-wrapper">
        <div class="border-frame"></div>

        <!-- Decorative clouds -->
        <div class="cloud cloud-1"></div>
        <div class="cloud cloud-2"></div>

        <!-- Corner decorations -->
        <div class="deco-tl">🏠</div>
        <div class="deco-tr">🏡</div>

        <!-- Bottom decorations -->
        <div class="scroll-deco">📜</div>
        <div class="keys-deco">🔑</div>

        <div class="certificate">

            <!-- Header -->
            <div class="republic-header">
                🇵🇭 Republika ng Pilipinas
            </div>

            <!-- Main Title -->
            <div class="main-title">
                <span class="line1">Katibayan ng</span>
                <span class="line2">Pagmamay-Ari ng Lupa at Bahay</span>
            </div>

            <!-- House Illustration (SVG) -->
            <div class="house-section">
                <svg class="house-svg" viewBox="0 0 200 160" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="House illustration">
                    <!-- Sky background -->
                    <rect width="200" height="160" fill="none"/>
                    <!-- Sun -->
                    <circle cx="170" cy="25" r="18" fill="#ffd700" opacity="0.9"/>
                    <line x1="170" y1="3" x2="170" y2="0" stroke="#ffd700" stroke-width="2"/>
                    <line x1="188" y1="10" x2="190" y2="8" stroke="#ffd700" stroke-width="2"/>
                    <line x1="192" y1="25" x2="196" y2="25" stroke="#ffd700" stroke-width="2"/>
                    <!-- Trees -->
                    <rect x="10" y="95" width="8" height="30" fill="#8B5E3C"/>
                    <ellipse cx="14" cy="88" rx="16" ry="20" fill="#2d8a2d"/>
                    <rect x="168" y="98" width="7" height="27" fill="#8B5E3C"/>
                    <ellipse cx="171" cy="90" rx="14" ry="18" fill="#2d8a2d"/>
                    <!-- House foundation -->
                    <rect x="52" y="90" width="96" height="55" fill="#f5e6d0" rx="2"/>
                    <!-- Roof -->
                    <polygon points="45,92 100,45 155,92" fill="#c0392b"/>
                    <polygon points="50,92 100,50 150,92" fill="#e74c3c"/>
                    <!-- Chimney -->
                    <rect x="120" y="52" width="10" height="22" fill="#8B5E3C"/>
                    <rect x="117" y="50" width="16" height="5" fill="#6B3E1C"/>
                    <!-- Door -->
                    <rect x="85" y="112" width="30" height="33" fill="#8B4513" rx="3"/>
                    <rect x="86" y="113" width="28" height="31" fill="#a0522d" rx="2"/>
                    <circle cx="109" cy="129" r="2.5" fill="#ffd700"/>
                    <!-- Windows -->
                    <rect x="58" y="100" width="20" height="18" fill="#87ceeb" rx="2"/>
                    <line x1="68" y1="100" x2="68" y2="118" stroke="white" stroke-width="1.5"/>
                    <line x1="58" y1="109" x2="78" y2="109" stroke="white" stroke-width="1.5"/>
                    <rect x="122" y="100" width="20" height="18" fill="#87ceeb" rx="2"/>
                    <line x1="132" y1="100" x2="132" y2="118" stroke="white" stroke-width="1.5"/>
                    <line x1="122" y1="109" x2="142" y2="109" stroke="white" stroke-width="1.5"/>
                    <!-- Ground / grass -->
                    <ellipse cx="100" cy="147" rx="62" ry="8" fill="#5aaa5a" opacity="0.5"/>
                    <!-- Pathway -->
                    <polygon points="90,145 110,145 118,155 82,155" fill="#d4b483"/>
                    <!-- Flower decorations -->
                    <circle cx="55" cy="140" r="4" fill="#ff69b4"/>
                    <circle cx="145" cy="138" r="4" fill="#ff8c00"/>
                    <circle cx="52" cy="140" r="2" fill="#ffff00"/>
                    <circle cx="148" cy="138" r="2" fill="#ffff00"/>
                </svg>
            </div>

            <!-- Content Card -->
            <div class="content-card">

                <p class="certify-text">Ito ay nagpapatunay na si:</p>

                <div class="name-field">{{ $name ?? '____________________________' }}</div>
                <p class="name-label">(Pangalan ng Mag-aaral)</p>

                <p class="description-text">
                    Ay opisyal na may-ari ng isang matibay at ligtas na bahay
                    na kanyang <strong>pinaghirapan</strong> at itinayo sa pamamagitan ng
                    tamang pagpaplano at matalinong pagpapalago ng gantimpala.
                </p>

                <!-- Details Box -->
                <div class="details-box">
                    <div class="details-title">
                        <span class="icon">🏠</span>
                        <span>Detalye ng Bahay:</span>
                    </div>
                    <div class="detail-item">
                        <span class="check-icon">✓</span>
                        <span>Kumpletong Istruktura</span>
                    </div>
                    <div class="detail-item">
                        <span class="check-icon">✓</span>
                        <span>Kaligtasan at Seguridad</span>
                    </div>
                    <div class="detail-item">
                        <span class="check-icon">✓</span>
                        <span>Katatagan at Tibay</span>
                    </div>
                </div>

                <!-- Location Box -->
                <div class="location-box">
                    <span class="location-icon">📍</span>
                    <div>
                        <strong>Lokasyon ng Ari-arian:</strong><br>
                        Isang ligtas at maaasahang pamayanan para sa kanyang pamilya
                    </div>
                </div>

                <!-- Date & Signature -->
                <div class="date-sig-section">
                    <div class="date-field-group">
                        <div class="field-label">
                            <span class="icon">📅</span>
                            <span>Petsa ng Pagkakaloob:</span>
                        </div>
                        <div class="field-line">{{ $date ?? '________________________' }}</div>
                    </div>
                    <div class="sig-field-group">
                        <div class="field-label">
                            <span class="icon">✍️</span>
                            <span>Pirmado ni:</span>
                        </div>
                        <div class="field-line">{{ $signature ?? '________________________' }}</div>
                        <div class="sig-label">(Guro / Tagapamahala)</div>
                    </div>
                </div>

            </div>

            <!-- Congratulations Footer -->
            <div class="congrats-footer">
                <div class="congrats-title">🌟 Pagbati!</div>
                <div class="congrats-text">
                    Ikaw ay isang responsableng tagapagplano at handa sa
                    pagbuo ng isang matibay at ligtas na tahanan.
                </div>
            </div>

        </div><!-- end .certificate -->
    </div>
</body>
</html>