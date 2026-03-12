<!DOCTYPE html>
<html lang="fil">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Araling Panlipunan – Grade 10 Adventure</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green:       #6dbf7e;
            --green-dark:  #4da862;
            --orange:      #e8922a;
            --brown:       #3d2a1a;
            --cream:       #fdf9f0;
            --card-bg:     rgba(255,255,255,0.82);
            --shadow:      0 8px 40px rgba(80,50,10,0.13);
            --radius:      22px;
        }

        html, body {
            height: 100%;
            font-family: 'Nunito', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #d4edaa 0%, #f5e8c0 45%, #fde3a3 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* ── Floating decorations ── */
        .deco {
            position: fixed;
            pointer-events: none;
            user-select: none;
            font-size: 2.2rem;
            animation: float 5s ease-in-out infinite;
            z-index: 0;
        }
        .deco-1  { top: 3%;  left: 2%;  animation-delay: 0s;    font-size: 2.5rem; }
        .deco-2  { top: 6%;  right: 2%; animation-delay: 1s;    font-size: 2.8rem; }
        .deco-3  { bottom: 8%; left: 4%; animation-delay: 2s;   font-size: 2rem;   }
        .deco-4  { bottom: 5%; right: 3%; animation-delay: 0.5s; font-size: 2.6rem; }

        @keyframes float {
            0%, 100% { transform: translateY(0);   }
            50%       { transform: translateY(-12px); }
        }

        /* ── Header ── */
        .header {
            text-align: center;
            margin-bottom: 28px;
            position: relative;
            z-index: 1;
        }

        .header-icons {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 10px;
            font-size: 1.8rem;
        }

        .header h1 {
            font-family: 'Baloo 2', cursive;
            font-size: clamp(2rem, 5vw, 3.2rem);
            font-weight: 800;
            color: var(--brown);
            line-height: 1.1;
        }

        .header .subtitle {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--orange);
            margin-top: 4px;
        }

        .header .tagline {
            font-size: 0.95rem;
            color: #7a6040;
            margin-top: 6px;
        }

        /* ── Card ── */
        .card {
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 40px 44px;
            width: min(440px, 90vw);
            text-align: center;
            position: relative;
            z-index: 1;
            border: 1.5px solid rgba(255,255,255,0.7);
            animation: slideUp 0.5s cubic-bezier(.22,1,.36,1) both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .card-compass {
            font-size: 3.2rem;
            margin-bottom: 14px;
            display: block;
            animation: spin-slow 8s linear infinite;
        }
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }

        .card h2 {
            font-family: 'Baloo 2', cursive;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--brown);
            margin-bottom: 4px;
        }

        .card p {
            font-size: 0.9rem;
            color: #8a7055;
            margin-bottom: 22px;
        }

        /* ── Input ── */
        .input-wrap {
            position: relative;
            margin-bottom: 14px;
        }

        .input-wrap input {
            width: 100%;
            padding: 14px 20px;
            border: 2px solid #e8dcc8;
            border-radius: 14px;
            font-size: 1rem;
            font-family: 'Nunito', sans-serif;
            color: var(--brown);
            background: #fff;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .input-wrap input:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(109,191,126,0.18);
        }

        .input-wrap input::placeholder { color: #b5a48a; }

        /* Error message */
        .input-error {
            color: #e05050;
            font-size: 0.82rem;
            text-align: left;
            margin-top: -8px;
            margin-bottom: 10px;
            padding-left: 4px;
            display: none;
        }
        .input-error.show { display: block; }

        /* ── Buttons ── */
        .btn-primary {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #6dbf7e, #4da862);
            color: #fff;
            border: none;
            border-radius: 14px;
            font-size: 1.05rem;
            font-family: 'Baloo 2', cursive;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.15s, opacity 0.2s;
            box-shadow: 0 4px 18px rgba(77,168,98,0.35);
            letter-spacing: 0.3px;
        }

        .btn-primary:hover  { transform: translateY(-2px); box-shadow: 0 7px 24px rgba(77,168,98,0.4); }
        .btn-primary:active { transform: translateY(0);    box-shadow: 0 3px 12px rgba(77,168,98,0.3); }
        .btn-primary:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

        /* ── Footer hint ── */
        .footer-hint {
            margin-top: 20px;
            font-size: 0.82rem;
            color: #a09070;
            position: relative;
            z-index: 1;
        }

        /* ── Lock button (admin/teacher) ── */
        .lock-btn {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: rgba(255,255,255,0.85);
            border: none;
            box-shadow: 0 4px 16px rgba(80,50,10,0.18);
            font-size: 1.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s, box-shadow 0.2s;
            z-index: 10;
            backdrop-filter: blur(8px);
        }
        .lock-btn:hover { transform: scale(1.1); box-shadow: 0 6px 22px rgba(80,50,10,0.25); }

        /* ── Modal Overlay ── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(40,25,10,0.45);
            backdrop-filter: blur(6px);
            z-index: 100;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.active { display: flex; }

        .modal {
            background: var(--cream);
            border-radius: var(--radius);
            padding: 36px 38px;
            width: min(420px, 92vw);
            box-shadow: 0 20px 60px rgba(40,25,10,0.25);
            position: relative;
            animation: modalIn 0.35s cubic-bezier(.22,1,.36,1) both;
        }
        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.9) translateY(20px); }
            to   { opacity: 1; transform: scale(1)   translateY(0);    }
        }

        .modal-close {
            position: absolute;
            top: 14px;
            right: 16px;
            background: none;
            border: none;
            font-size: 1.3rem;
            cursor: pointer;
            color: #9a8060;
            line-height: 1;
            transition: color 0.2s;
        }
        .modal-close:hover { color: var(--brown); }

        .modal-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Baloo 2', cursive;
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--brown);
            margin-bottom: 22px;
        }
        .modal-title .icon { font-size: 1.4rem; color: var(--green-dark); }

        .modal label {
            display: block;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--brown);
            margin-bottom: 7px;
        }

        .modal-input-wrap {
            display: flex;
            align-items: center;
            border: 2px solid #e2d5be;
            border-radius: 12px;
            background: #fff;
            padding: 0 14px;
            gap: 10px;
            margin-bottom: 16px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .modal-input-wrap:focus-within {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(109,191,126,0.18);
        }
        .modal-input-wrap .icon { font-size: 1rem; color: #b5a48a; flex-shrink: 0; }
        .modal-input-wrap input {
            flex: 1;
            padding: 13px 0;
            border: none;
            outline: none;
            font-family: 'Nunito', sans-serif;
            font-size: 0.97rem;
            color: var(--brown);
            background: transparent;
        }
        .modal-input-wrap input::placeholder { color: #c0ad90; }

        /* Alert in modal */
        .modal-alert {
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 0.87rem;
            margin-bottom: 14px;
            display: none;
            font-weight: 600;
        }
        .modal-alert.error   { background: #fde8e8; color: #c0392b; border: 1px solid #f5c6cb; display: block; }
        .modal-alert.success { background: #e8f8ed; color: #1e7a3a; border: 1px solid #b8e0c4; display: block; }

        .back-link {
            display: block;
            text-align: center;
            font-size: 0.88rem;
            color: #9a8060;
            margin-top: 12px;
            cursor: pointer;
            transition: color 0.2s;
            text-decoration: none;
        }
        .back-link:hover { color: var(--brown); }

        /* Access code input styling */
        .access-input input {
            text-align: center;
            font-size: 1.3rem;
            font-weight: 800;
            letter-spacing: 8px;
            color: var(--brown);
        }

        /* Loading spinner inside button */
        @keyframes spin { to { transform: rotate(360deg); } }
        .btn-spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255,255,255,0.4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            vertical-align: middle;
            margin-right: 6px;
        }

        /* Verify step hidden by default */
        #step-verify { display: none; }
    </style>
</head>
<body>

    {{-- Floating decorations --}}
    <span class="deco deco-1">🌿</span>
    <span class="deco deco-2">🦋</span>
    <span class="deco deco-3">🌸</span>
    <span class="deco deco-4">🗺️</span>

    {{-- Header --}}
    <div class="header">
        <div class="header-icons">🧭 🗺️ ✨</div>
        <h1>Araling Panlipunan</h1>
        <div class="subtitle">Grade 10 Adventure 🌴</div>
        <div class="tagline">Tuklasin ang mundo ng kaalaman!</div>
    </div>

    {{-- Student Login Card --}}
    <div class="card">
        <span class="card-compass">🧭</span>
        <h2>Simulan ang Paglalakbay!</h2>
        <p>Ilagay ang iyong pangalan para makapagsimula</p>

        @if(session('error'))
            <div class="modal-alert error" style="display:block;">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('student.login') }}" id="studentForm">
            @csrf
            <div class="input-wrap">
                <input
                    type="text"
                    name="username"
                    id="usernameInput"
                    placeholder="Ilagay ang iyong username..."
                    value="{{ old('username') }}"
                    autocomplete="off"
                    maxlength="50"
                />
                <div class="input-error {{ $errors->has('username') ? 'show' : '' }}" id="usernameError">
                    {{ $errors->first('username') ?: 'Pakiusap ilagay ang iyong username.' }}
                </div>
            </div>
            <button type="submit" class="btn-primary" id="startBtn">
                Magsimula! 🚀
            </button>
        </form>
    </div>

    <div class="footer-hint">
        Kung may existing username ka, i-type lang ito para magpatuloy ✨
    </div>

    {{-- Lock Button --}}
    <button class="lock-btn" onclick="openStaffModal()" title="Staff Login">🔒</button>

    {{-- ===== STAFF LOGIN MODAL ===== --}}
    <div class="modal-overlay" id="staffModal">
        <div class="modal">
            <button class="modal-close" onclick="closeStaffModal()">✕</button>

            {{-- Step 1: Credentials --}}
            <div id="step-credentials">
                <div class="modal-title">
                    <span class="icon">🔒</span> Staff Login
                </div>

                <div class="modal-alert" id="credAlert"></div>

                <label for="staffEmail">Email</label>
                <div class="modal-input-wrap">
                    <span class="icon">✉️</span>
                    <input type="email" id="staffEmail" placeholder="teacher@school.com" autocomplete="off" />
                </div>

                <label for="staffPassword">Password</label>
                <div class="modal-input-wrap">
                    <span class="icon">🔑</span>
                    <input type="password" id="staffPassword" placeholder="••••••••" />
                </div>

                <button class="btn-primary" id="continueBtn" onclick="verifyCredentials()">
                    Continue →
                </button>
            </div>

            {{-- Step 2: Access Code --}}
            <div id="step-verify">
                <div class="modal-title">
                    <span class="icon">🔒</span> Verify Identity
                </div>

                <div class="modal-alert" id="verifyAlert"></div>

                <p style="font-size:0.93rem; color:#6a5035; margin-bottom:18px; line-height:1.5;">
                    Kumusta, <strong id="staffNameDisplay">Admin</strong>! Enter your access code to confirm your identity.
                </p>

                <label for="accessCode">Access Code</label>
                <div class="modal-input-wrap access-input">
                    <span class="icon">🛡️</span>
                    <input type="text" id="accessCode" placeholder="XXXXXX" maxlength="10" autocomplete="off" />
                </div>

                <button class="btn-primary" id="loginBtn" onclick="verifyAccessCode()">
                    🔓 Login
                </button>
                <a class="back-link" onclick="goBackToCredentials()">← Back to credentials</a>
            </div>
        </div>
    </div>

    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;

        // ── Student form ──
        const studentForm = document.getElementById('studentForm');
        const usernameInput = document.getElementById('usernameInput');
        const usernameError = document.getElementById('usernameError');
        const startBtn = document.getElementById('startBtn');

        usernameInput.addEventListener('input', () => {
            usernameError.classList.remove('show');
        });

        studentForm.addEventListener('submit', function(e) {
            const val = usernameInput.value.trim();
            if (!val) {
                e.preventDefault();
                usernameError.textContent = 'Pakiusap ilagay ang iyong username.';
                usernameError.classList.add('show');
                usernameInput.focus();
                return;
            }
            startBtn.disabled = true;
            startBtn.innerHTML = '<span class="btn-spinner"></span> Naghahanap...';
        });

        // ── Staff Modal ──
        function openStaffModal() {
            document.getElementById('staffModal').classList.add('active');
            document.getElementById('staffEmail').focus();
        }

        function closeStaffModal() {
            document.getElementById('staffModal').classList.remove('active');
            resetModal();
        }

        function resetModal() {
            document.getElementById('staffEmail').value    = '';
            document.getElementById('staffPassword').value = '';
            document.getElementById('accessCode').value    = '';
            document.getElementById('credAlert').className   = 'modal-alert';
            document.getElementById('verifyAlert').className = 'modal-alert';
            document.getElementById('credAlert').textContent   = '';
            document.getElementById('verifyAlert').textContent = '';
            showStep('credentials');
        }

        function showStep(step) {
            document.getElementById('step-credentials').style.display = step === 'credentials' ? 'block' : 'none';
            document.getElementById('step-verify').style.display      = step === 'verify'      ? 'block' : 'none';
        }

        // Close modal on overlay click
        document.getElementById('staffModal').addEventListener('click', function(e) {
            if (e.target === this) closeStaffModal();
        });

        // ── Step 1: Verify credentials ──
        async function verifyCredentials() {
            const email    = document.getElementById('staffEmail').value.trim();
            const password = document.getElementById('staffPassword').value;
            const btn      = document.getElementById('continueBtn');
            const alert    = document.getElementById('credAlert');

            if (!email || !password) {
                showAlert(alert, 'error', 'Please enter your email and password.');
                return;
            }

            btn.disabled = true;
            btn.innerHTML = '<span class="btn-spinner"></span> Verifying...';

            try {
                const res = await fetch('{{ route("staff.verify-credentials") }}', {
                    method:  'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
                    body:    JSON.stringify({ email, password }),
                });
                const data = await res.json();

                if (data.success) {
                    document.getElementById('staffNameDisplay').textContent = data.name;
                    showStep('verify');
                    setTimeout(() => document.getElementById('accessCode').focus(), 100);
                } else {
                    showAlert(alert, 'error', data.message || 'Invalid credentials.');
                }
            } catch (err) {
                showAlert(alert, 'error', 'Something went wrong. Please try again.');
            } finally {
                btn.disabled = false;
                btn.innerHTML = 'Continue →';
            }
        }

        // ── Step 2: Verify access code ──
        async function verifyAccessCode() {
            const access_code = document.getElementById('accessCode').value.trim();
            const btn         = document.getElementById('loginBtn');
            const alert       = document.getElementById('verifyAlert');

            if (!access_code) {
                showAlert(alert, 'error', 'Please enter your access code.');
                return;
            }

            btn.disabled = true;
            btn.innerHTML = '<span class="btn-spinner"></span> Logging in...';

            try {
                const res = await fetch('{{ route("staff.verify-access-code") }}', {
                    method:  'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
                    body:    JSON.stringify({ access_code }),
                });
                const data = await res.json();

                if (data.success) {
                    showAlert(alert, 'success', 'Login successful! Redirecting...');
                    setTimeout(() => { window.location.href = data.redirect; }, 800);
                } else {
                    showAlert(alert, 'error', data.message || 'Invalid access code.');
                    btn.disabled = false;
                    btn.innerHTML = '🔓 Login';
                }
            } catch (err) {
                showAlert(alert, 'error', 'Something went wrong. Please try again.');
                btn.disabled = false;
                btn.innerHTML = '🔓 Login';
            }
        }

        async function goBackToCredentials() {
            await fetch('{{ route("staff.clear-pending") }}', {
                method:  'POST',
                headers: { 'X-CSRF-TOKEN': CSRF },
            });
            showStep('credentials');
            document.getElementById('accessCode').value = '';
            document.getElementById('verifyAlert').className = 'modal-alert';
        }

        function showAlert(el, type, msg) {
            el.className   = 'modal-alert ' + type;
            el.textContent = msg;
        }

        // Enter key support
        document.getElementById('staffEmail').addEventListener('keydown', e => { if (e.key === 'Enter') document.getElementById('staffPassword').focus(); });
        document.getElementById('staffPassword').addEventListener('keydown', e => { if (e.key === 'Enter') verifyCredentials(); });
        document.getElementById('accessCode').addEventListener('keydown', e => { if (e.key === 'Enter') verifyAccessCode(); });
    </script>
</body>
</html>
