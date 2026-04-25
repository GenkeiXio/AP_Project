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
    /* This targets the body to set the background */

html, body {
height: 100%;
overflow: hidden;
}
        
body {
    margin: 0;
    padding: 0;        /* Replace the URL below with your image path */
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

    /* This ensures your content stays readable over the image */

.right-panel {
    position: absolute;
    right: 0;
    top: 0;
    height: 100vh;
    width: 35%;

    background: rgba(15, 47, 58, 0.75); /* semi-transparent */
    backdrop-filter: blur(18px);        /* THIS creates the blur */
    -webkit-backdrop-filter: blur(18px);

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    padding: 25px 20px;
    gap: 5px; 

    z-index: 2;
    border-left: 4px solid #f2c94c; /* yellow line */
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

/* LOGIN CONTAINER */
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

    flex: 1;                /* takes remaining space */
    justify-content: center; /* centers nicely */
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

                        <div class="footer-hint" style="margin-top: 25px;">
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