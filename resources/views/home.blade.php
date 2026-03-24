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
</head>
<body>

    <!-- Decorative emojis -->
    <span class="deco deco-1">🌿</span>
    <span class="deco deco-2">🦋</span>
    <span class="deco deco-3">🌸</span>
    <span class="deco deco-4">🗺️</span>

    <!-- Main wrapper -->
    <div class="main-wrapper">

        <!-- Left: Description Area -->
        <div class="hero-content">
            <div class="header">
                <div class="header-icons">🧭 🗺️ ✨</div>
                <div class="subtitle">Araling Panlipunan 10: Mga Kontemporaryong Isyu</div>
                <h1>Hamon at Tugon:</h1>
                <h2>An Interactive Digital Learning Material in Araling Panlipunan 10</h2>
            </div>
        </div>

        <!-- Right: Login Card -->
        <div class="login-section">
            <div class="card">
                <span class="card-compass">🧭</span>
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

                <div class="footer-hint" style="margin-top: 25px;">
                    Para sa mga Guro, i-click ang 🔒 sa gilid.
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