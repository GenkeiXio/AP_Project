<!DOCTYPE html>
<html lang="fil">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="verify-credentials" content="{{ route('staff.verify-credentials') }}">
    <meta name="verify-access" content="{{ route('staff.verify-access-code') }}">
    <meta name="clear-pending" content="{{ route('staff.clear-pending') }}">
    <title>Hamon at Tugon: Araling Panlipunan 10</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

<style>
    /* --- ORIGINAL STYLES --- */
    
    html, body {
        height: 100%;
        overflow: hidden;
    }
        
    body {
        margin: 0;
        padding: 0;
        background: url('{{ asset("pictures/landingpage_bg.png") }}') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .login-section {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .hero-content {
        position: absolute;
        left: 40px;
        top: 50%;
        transform: translateY(-50%);
        width: 50%;
    }

    .right-panel {
        position: absolute;
        right: 0;
        top: 0;
        height: 100vh;
        width: 35%;
        background: rgba(15, 47, 58, 0.75);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        padding: 25px 20px;
        gap: 5px;
        z-index: 2;
        border-left: 4px solid #f2c94c;
    }

    .right-panel::before,
    .right-panel::after {
        display: none !important;
    }

    .title-image {
        width: 100%;
        max-width: 320px;
        display: block;
        margin-top: -20px;
    }

    .card {
        padding: 20px;
    }

    .login-container {
        width: 100%;
        max-width: 320px;
        margin-top: 10px;
    }

    .features {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        margin-top: 10px;
        width: 100%;
        max-width: 360px;
        flex-shrink: 0;
    }

    .top-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        flex: 1;
        justify-content: center;
    }

    .feature {
        text-align: center;
        color: #fff;
        font-size: 12px;
    }

    .feature .icon {
        font-size: 26px;
        margin-bottom: 8px;
    }

    .feature h4 {
        margin: 5px 0;
        font-size: 14px;
    }

    .feature p {
        font-size: 10px;
        opacity: 0.8;
    }

    /* --- FIX: GREEN BUTTON --- */
    .btn-primary {
        background: #28a745 !important; /* GREEN */
        border: none;
        border-radius: 60px;
        padding: 10px 20px;
        font-weight: 700;
        font-size: 1rem;
        color: #fff !important; /* white text on green */
        cursor: pointer;
        transition: 0.2s;
        width: 100%;
        margin-top: 6px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .btn-primary:hover {
        background: #218838 !important;
        transform: scale(1.01);
    }

    /* --- FIX: FOOTER HINT TEXT COLOR (BLACK) --- */
    .footer-hint {
        color: #000000 !important; /* BLACK */
        font-size: 0.9rem;
        text-align: center;
    }

    /* --- FIX: TIGHTEN INPUT AND BUTTON SPACING --- */
    .input-wrap {
        width: 100%;
        margin: 8px 0 4px 0 !important; /* reduced spacing */
    }
    .input-wrap input {
        width: 100%;
        padding: 8px 14px;
        border-radius: 60px;
        border: 2px solid #d4b68a;
        background: rgba(255,255,255,0.5);
        font-size: 1rem;
        outline: none;
        color: #1e2a2e;
    }
    .input-wrap input:focus {
        border-color: #f2c94c;
        background: rgba(255,255,255,0.7);
    }
    .error-message {
        color: #b33c1f;
        font-size: 0.8rem;
        margin-top: 2px;
        min-height: 16px;
    }
    
    /* Remove extra spacing between form elements */
    #studentForm {
        margin-top: 5px;
    }
    #studentForm .btn-primary {
        margin-top: 4px !important;
    }
    
    .card h2 {
        margin-bottom: 5px;
    }
    .card p {
        margin-top: 2px;
        margin-bottom: 8px;
    }

    /* --- MODAL STYLES --- */
    .modal-overlay {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(4px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 999;
    }
    .modal-overlay.active {
        display: flex;
    }
    .modal {
        background: #fbf5e8;
        width: 400px;
        max-width: 94%;
        padding: 30px 28px;
        border-radius: 32px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.5);
        position: relative;
        max-height: 90vh;
        overflow-y: auto;
    }
    .modal-close {
        position: absolute;
        top: 12px;
        right: 18px;
        font-size: 1.6rem;
        background: transparent;
        border: none;
        cursor: pointer;
        color: #4a2e1b;
    }
    .modal-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1e3a3f;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .modal-alert {
        background: #fef3d7;
        padding: 6px 12px;
        border-radius: 40px;
        font-size: 0.8rem;
        color: #7a4e1f;
        margin-bottom: 12px;
        min-height: 24px;
    }
    .modal-input-wrap {
        background: white;
        border-radius: 60px;
        padding: 6px 18px;
        margin: 6px 0 14px 0;
        display: flex;
        align-items: center;
        border: 1px solid #d4b68a;
    }
    .modal-input-wrap input {
        border: none;
        outline: none;
        flex: 1;
        padding: 10px 6px;
        font-size: 1rem;
        background: transparent;
        color: #1e2a2e;
    }
    .modal-input-wrap .icon {
        margin-right: 10px;
        font-size: 1.2rem;
    }
    .password-wrap {
        position: relative;
    }
    .password-toggle {
        background: transparent;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 5px;
    }
    .back-link {
        display: block;
        text-align: center;
        margin-top: 14px;
        color: #4a2e1b;
        text-decoration: underline;
        cursor: pointer;
        font-size: 0.9rem;
        opacity: 0.8;
    }
    .back-link:hover {
        opacity: 1;
    }
    #step-credentials, #step-verify {
        display: block;
    }
    #step-verify {
        display: none;
    }

    /* --- LOCK BUTTON --- */
    .lock-btn {
        position: fixed;
        bottom: 25px;
        right: 25px;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border: 2px solid #f2c94c;
        background: rgba(15, 47, 58, 0.85);
        backdrop-filter: blur(6px);
        color: #f2c94c;
        font-size: 24px;
        cursor: pointer;
        z-index: 99;
        transition: 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.4);
    }
    .lock-btn:hover {
        transform: scale(1.05);
        background: rgba(15, 47, 58, 0.95);
    }

    /* --- DECORATIVE EMOJIS --- */
    .deco {
        position: fixed;
        font-size: 2rem;
        opacity: 0.3;
        pointer-events: none;
        z-index: 0;
    }
    .deco-1 { top: 10%; left: 5%; }
    .deco-2 { top: 20%; right: 12%; }
    .deco-3 { bottom: 15%; left: 8%; }
    .deco-4 { bottom: 25%; right: 20%; }

    /* --- MOBILE RESPONSIVE: FULL SCREEN CARD, NO BG --- */
    @media screen and (max-width: 820px) {
        body {
            background: #0f2f3a !important;
            background-image: none !important;
        }
        
        .right-panel {
            width: 100% !important;
            height: 100vh !important;
            border-left: none !important;
            border-radius: 0 !important;
            padding: 20px 15px !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
            background: #0f2f3a !important;
            position: relative !important;
        }
        
        .title-image {
            max-width: 280px;
        }
        
        .features {
            gap: 10px;
            max-width: 320px;
        }
        
        .feature .icon {
            font-size: 22px;
        }
        .feature h4 {
            font-size: 13px;
        }
        .feature p {
            font-size: 9px;
        }
        
        .deco {
            display: none !important;
        }
    }

    @media screen and (max-width: 700px) {
        .right-panel {
            padding: 15px 12px !important;
        }
        .title-image {
            max-width: 240px;
            margin-top: -10px;
        }
        .features {
            gap: 8px;
            max-width: 300px;
        }
        .feature .icon {
            font-size: 20px;
        }
        .feature h4 {
            font-size: 12px;
        }
        .feature p {
            font-size: 8px;
        }
        .card {
            padding: 15px;
        }
    }

    @media screen and (max-width: 550px) {
        .right-panel {
            padding: 12px 10px !important;
        }
        .title-image {
            max-width: 200px;
            margin-top: -5px;
        }
        .features {
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
            gap: 6px;
            max-width: 260px;
        }
        .feature {
            flex: 1 1 30%;
            min-width: 60px;
        }
        .feature .icon {
            font-size: 18px;
            margin-bottom: 4px;
        }
        .feature h4 {
            font-size: 11px;
            margin: 3px 0;
        }
        .feature p {
            font-size: 7px;
            line-height: 1.2;
        }
        .card {
            padding: 10px;
        }
        .card h2 {
            font-size: 1.3rem;
            margin: 5px 0;
        }
        .card p {
            font-size: 0.9rem;
            margin: 5px 0;
        }
        .btn-primary {
            font-size: 0.9rem;
            padding: 8px 14px;
        }
        .footer-hint {
            font-size: 0.8rem;
            margin-top: 15px !important;
        }
        .input-wrap input {
            font-size: 0.9rem;
            padding: 8px 10px;
        }
        .lock-btn {
            bottom: 15px !important;
            right: 15px !important;
            width: 40px !important;
            height: 40px !important;
            font-size: 20px !important;
        }
        .modal {
            width: 92% !important;
            padding: 20px !important;
        }
    }

    @media screen and (max-width: 420px) {
        .right-panel {
            padding: 10px 8px !important;
        }
        .title-image {
            max-width: 160px;
            margin-top: 0;
        }
        .features {
            gap: 5px;
            max-width: 220px;
        }
        .feature .icon {
            font-size: 16px;
        }
        .feature h4 {
            font-size: 10px;
        }
        .feature p {
            font-size: 6.5px;
        }
        .card {
            padding: 8px;
        }
        .card h2 {
            font-size: 1.1rem;
        }
        .card p {
            font-size: 0.8rem;
        }
        .btn-primary {
            font-size: 0.8rem;
            padding: 6px 12px;
        }
        .footer-hint {
            font-size: 0.7rem;
        }
        .input-wrap input {
            font-size: 0.8rem;
            padding: 6px 8px;
        }
        .modal-title {
            font-size: 1.2rem !important;
        }
        .modal-input-wrap input {
            font-size: 0.9rem;
        }
        .modal-close {
            font-size: 1.3rem !important;
        }
        .lock-btn {
            bottom: 10px !important;
            right: 10px !important;
            width: 36px !important;
            height: 36px !important;
            font-size: 18px !important;
        }
    }
</style>
</head>

<body>

    <!-- Decorative emojis -->
    <span class="deco deco-1">🌿</span>
    <span class="deco deco-2">🦋</span>
    <span class="deco deco-3">🌸</span>
    <span class="deco deco-4">🗺️</span>

    <!-- Main wrapper -->
    <div class="main-wrapper">

        <!-- Login Card below -->
        <div class="right-panel">
            <div class="top-content">
                <img src="{{ asset('pictures/landingpage_titleimage.png') }}" class="title-image" alt="Title">

                <div class="login-section">
                    <div class="card">
                        <h2>Mag-aaral?</h2>
                        <p>Simulan ang iyong pakikipagsapalaran!</p>

                        <form method="POST" action="{{ route('student.login') }}" id="studentForm">
                            @csrf
                            <div class="input-wrap">
                                <input type="text" name="username" id="usernameInput" placeholder="Username..." required />
                                <div id="usernameError" class="error-message"></div>
                            </div>
                            <button type="submit" class="btn-primary" id="startBtn">
                                Magsimula! 🚀
                            </button>
                        </form>

                        <div class="footer-hint" style="margin-top: 15px;">
                            Para sa mga Guro, i-click ang 🔒 sa gilid.
                        </div>
                    </div>
                </div>
            </div>    

            <div class="features">
                <div class="feature">
                    <div class="icon">🗺️</div>
                    <h4>Tuklasin</h4>
                    <p>Tuklasin ang bayan at mga isyu sa ating komunidad.</p>
                </div>

                <div class="feature">
                    <div class="icon">👥</div>
                    <h4>Makibahagi</h4>
                    <p>Makilahok sa mga aktibidad at gumawa ng tamang desisyon.</p>
                </div>

                <div class="feature">
                    <div class="icon">🛡️</div>
                    <h4>Magtagumpay</h4>
                    <p>Bumuo ng mas malakas at mas maunlad na komunidad.</p>
                </div>
            </div>

        </div>

        
    </div>

    <!-- Lock button for teachers -->
    <button class="lock-btn" onclick="openStaffModal()" title="Teacher Login">🔒</button>

    <!-- Staff login modal -->
    <div class="modal-overlay" id="staffModal">
        <div class="modal">
            <button class="modal-close" onclick="closeStaffModal()">✕</button>

            <!-- Step 1: Credentials -->
            <div id="step-credentials">
                <div class="modal-title">
                    <span class="icon">🔒</span> Log-in para sa Guro
                </div>
                <div class="modal-alert" id="credAlert"></div>

                <label for="staffEmail">Email</label>
                <div class="modal-input-wrap">
                    <span class="icon">✉️</span>
                    <input type="email" id="staffEmail" placeholder="teacher@school.com" autocomplete="off" />
                </div>

                <label for="staffPassword">Password</label>
                <div class="modal-input-wrap password-wrap">
                    <span class="icon">🔑</span>
                    <input type="password" id="staffPassword" placeholder="••••••••" />
                    <button type="button" class="password-toggle" onclick="togglePasswordVisibility()" title="Show/Hide password">👁️</button>
                </div>

                <button class="btn-primary" id="continueBtn" onclick="verifyCredentials()">Magpatuloy →</button>
            </div>

            <!-- Step 2: Access Code -->
            <div id="step-verify">
                <div class="modal-title">
                    <span class="icon">🔒</span> Verify Identity
                </div>
                <div class="modal-alert" id="verifyAlert"></div>

                <p style="font-size:0.93rem; color:#6a5035; margin-bottom:18px; line-height:1.5;">
                    Kumusta, <strong id="staffNameDisplay">Guro</strong>! Ipasok ang iyong access code para magpatuloy.
                </p>

                <label for="accessCode">Access Code</label>
                <div class="modal-input-wrap access-input">
                    <span class="icon">🛡️</span>
                    <input type="text" id="accessCode" placeholder="XXXXXX" maxlength="10" autocomplete="off" />
                </div>

                <button class="btn-primary" id="loginBtn" onclick="verifyAccessCode()">🔓 Login</button>
                <a class="back-link" onclick="goBackToCredentials()">← Bumalik sa credentials</a>
            </div>
        </div>
    </div>
    <!-- Background music -->
    <audio id="bgMusic" loop>
        <source src="/audio/home-bg-music.mp3" type="audio/mpeg">
    </audio>
    <!-- JS -->
    <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>