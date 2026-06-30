
const CSRF = document.querySelector('meta[name="csrf-token"]').content;

// Get routes from HTML
const VERIFY_CREDENTIALS_URL = document.querySelector('meta[name="verify-credentials"]').content;
const VERIFY_ACCESS_URL      = document.querySelector('meta[name="verify-access"]').content;
const CLEAR_PENDING_URL      = document.querySelector('meta[name="clear-pending"]').content;

// ── Student form ──
const studentForm      = document.getElementById('studentForm');
const usernameInput    = document.getElementById('usernameInput');
const usernameError    = document.getElementById('usernameError');
const usernameAvailability = document.getElementById('usernameAvailability');
const passwordInput    = document.getElementById('passwordInput');
const regPasswordInput = document.getElementById('regPasswordInput');
const confirmPasswordInput = document.getElementById('confirmPasswordInput');
const passwordError    = document.getElementById('passwordError');
const regPasswordError = document.getElementById('regPasswordError');
const confirmPasswordError = document.getElementById('confirmPasswordError');
const formSubmitError  = document.getElementById('formSubmitError');
const authModeField    = document.getElementById('authMode');
const authTitle        = document.getElementById('authTitle');
const authSubtitle     = document.getElementById('authSubtitle');
const authSwitchButtons = document.querySelectorAll('.auth-switch button');
const loginUrl         = document.querySelector('meta[name="student-login"]').content;
const registerUrl      = document.querySelector('meta[name="student-register"]').content;
const checkUsernameUrl = document.querySelector('meta[name="check-username"]').content;
const initialAuthMode  = document.querySelector('meta[name="initial-auth-mode"]').content || 'login';
const startBtn         = document.getElementById('startBtn');

const authPanels = {
    login: document.querySelector('.login-panel'),
    register: document.querySelector('.register-panel'),
};

const authLabels = {
    login: {
        title: 'Mag-login',
        subtitle: 'Gumamit ng username at password para mag-login.',
        button: 'Mag-login',
    },
    register: {
        title: 'Magrehistro',
        subtitle: 'Gumawa ng bagong account gamit ang username at password.',
        button: 'Magrehistro',
    },
};

function setAuthMode(mode) {
    authModeField.value = mode;
    studentForm.action = mode === 'register' ? registerUrl : loginUrl;

    authSwitchButtons.forEach(btn => {
        btn.classList.toggle('active', btn.dataset.mode === mode);
    });

    authPanels.login.classList.toggle('active', mode === 'login');
    authPanels.register.classList.toggle('active', mode === 'register');

    passwordInput.required = mode === 'login';
    passwordInput.disabled = mode !== 'login';

    regPasswordInput.required = mode === 'register';
    regPasswordInput.disabled = mode !== 'register';
    confirmPasswordInput.required = mode === 'register';
    confirmPasswordInput.disabled = mode !== 'register';

    if (mode === 'login') {
        regPasswordInput.value = '';
        confirmPasswordInput.value = '';
        setUsernameAvailability('', '');
    } else {
        passwordInput.value = '';
    }

    authTitle.textContent = authLabels[mode].title;
    authSubtitle.textContent = authLabels[mode].subtitle;
    startBtn.textContent = authLabels[mode].button;

    clearFieldErrors();
}

let usernameIsAvailable = false;
let usernameCheckTimer = null;

function clearFieldErrors() {
    [usernameError, passwordError, regPasswordError, confirmPasswordError, formSubmitError].forEach(el => {
        if (el) {
            el.textContent = '';
            el.classList.remove('show');
        }
    });
}

function setUsernameAvailability(message, state) {
    if (!usernameAvailability) return;

    usernameAvailability.textContent = message || '';
    usernameAvailability.classList.remove('show', 'available', 'unavailable');

    if (message) {
        usernameAvailability.classList.add('show', state);
    }
}

async function checkUsernameAvailability() {
    const username = usernameInput.value.trim();

    if (authModeField.value !== 'register' || !username) {
        usernameIsAvailable = false;
        setUsernameAvailability('', '');
        return;
    }

    usernameIsAvailable = false;
    setUsernameAvailability('Sinusuri ang username...', 'unavailable');

    try {
        const response = await fetch(checkUsernameUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF,
            },
            body: JSON.stringify({ username }),
        });

        const data = await response.json();

        if (data.available) {
            usernameIsAvailable = true;
            setUsernameAvailability('Available username', 'available');
        } else {
            usernameIsAvailable = false;
            setUsernameAvailability(data.message || 'Ang username na ito ay ginagamit na ng ibang mag-aaral.', 'unavailable');
        }
    } catch {
        usernameIsAvailable = false;
        setUsernameAvailability('Hindi ma-verify ang username sa ngayon.', 'unavailable');
    }
}

authSwitchButtons.forEach(button => {
    button.addEventListener('click', () => setAuthMode(button.dataset.mode));
});

usernameInput.addEventListener('input', () => {
    usernameError.classList.remove('show');
    if (authModeField.value === 'register') {
        clearTimeout(usernameCheckTimer);
        usernameCheckTimer = setTimeout(() => checkUsernameAvailability(), 400);
    } else {
        setUsernameAvailability('', '');
    }
});
if (passwordInput) passwordInput.addEventListener('input', () => passwordError.classList.remove('show'));
if (regPasswordInput) regPasswordInput.addEventListener('input', () => regPasswordError.classList.remove('show'));
if (confirmPasswordInput) confirmPasswordInput.addEventListener('input', () => confirmPasswordError.classList.remove('show'));

studentForm.addEventListener('submit', function(e) {
    clearFieldErrors();

    const username = usernameInput.value.trim();
    const mode = authModeField.value;
    const password = passwordInput.value.trim();
    const regPassword = regPasswordInput.value.trim();
    const confirmPassword = confirmPasswordInput.value.trim();
    let hasError = false;

    if (!username) {
        hasError = true;
        usernameError.textContent = 'Pakiusap ilagay ang iyong username.';
        usernameError.classList.add('show');
        usernameInput.focus();
    }

    if (mode === 'login') {
        if (!password) {
            hasError = true;
            passwordError.textContent = 'Pakiusap ilagay ang iyong password.';
            passwordError.classList.add('show');
            if (!username) passwordInput.focus();
        }
    } else {
        if (!usernameIsAvailable && username) {
            hasError = true;
            usernameError.textContent = 'Ang username na ito ay ginagamit na ng ibang mag-aaral.';
            usernameError.classList.add('show');
        }

        if (!regPassword) {
            hasError = true;
            regPasswordError.textContent = 'Pakiusap ilagay ang iyong password.';
            regPasswordError.classList.add('show');
            if (!username) regPasswordInput.focus();
        }
        if (!confirmPassword) {
            hasError = true;
            confirmPasswordError.textContent = 'Pakiusap kumpirmahin ang password.';
            confirmPasswordError.classList.add('show');
        }
        if (regPassword && confirmPassword && regPassword !== confirmPassword) {
            hasError = true;
            confirmPasswordError.textContent = 'Hindi magkatugma ang password at kumpirmasyon.';
            confirmPasswordError.classList.add('show');
        }
    }

    if (hasError) {
        e.preventDefault();
        return;
    }

    startBtn.disabled = true;
    startBtn.innerHTML = '<span class="btn-spinner"></span> Pumapasok...';
});

setAuthMode(initialAuthMode);

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
    document.getElementById('staffEmail').value = '';
    document.getElementById('staffPassword').value = '';
    document.getElementById('accessCode').value = '';
    showStep('credentials');
}

function togglePasswordVisibility() {
    const passwordInput = document.getElementById('staffPassword');
    const toggleBtn = document.querySelector('.password-toggle');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleBtn.textContent = '👁️‍🗨️';
    } else {
        passwordInput.type = 'password';
        toggleBtn.textContent = '👁️';
    }
}

function showStep(step) {
    document.getElementById('step-credentials').style.display = step === 'credentials' ? 'block' : 'none';
    document.getElementById('step-verify').style.display = step === 'verify' ? 'block' : 'none';
}

document.getElementById('staffModal').addEventListener('click', function(e) {
    if (e.target === this) closeStaffModal();
});

// ── Step 1 ──
async function verifyCredentials() {
    const email    = document.getElementById('staffEmail').value.trim();
    const password = document.getElementById('staffPassword').value;
    const btn      = document.getElementById('continueBtn');
    const alert    = document.getElementById('credAlert');

    if (!email || !password) {
        showAlert(alert, 'error', 'Pakiusap ilagay ang iyong email at password.');
        return;
    }

    btn.disabled = true;
    btn.innerHTML = '<span class="btn-spinner"></span> Verifying...';

    try {
        const res = await fetch(VERIFY_CREDENTIALS_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF
            },
            body: JSON.stringify({ email, password })
        });

        const data = await res.json();

        if (data.success) {
            document.getElementById('staffNameDisplay').textContent = data.name;
            showStep('verify');
            setTimeout(() => document.getElementById('accessCode').focus(), 100);
        } else {
            showAlert(alert, 'error', data.message || 'Maling credentials.');
        }
    } catch {
        showAlert(alert, 'error', 'May nagkaproblema. Paki-ulit muli.');
    } finally {
        btn.disabled = false;
        btn.innerHTML = 'Magpatuloy →';
    }
}

// ── Step 2 ──
async function verifyAccessCode() {
    const access_code = document.getElementById('accessCode').value.trim();
    const btn   = document.getElementById('loginBtn');
    const alert = document.getElementById('verifyAlert');

    if (!access_code) {
        showAlert(alert, 'error', 'Pakiusap ilagay ang iyong access code.');
        return;
    }

    btn.disabled = true;
    btn.innerHTML = '<span class="btn-spinner"></span> Logging in...';

    try {
        const res = await fetch(VERIFY_ACCESS_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF
            },
            body: JSON.stringify({ access_code })
        });

        const data = await res.json();

        if (data.success) {
            showAlert(alert, 'success', 'Login successful! Redirecting...');
            setTimeout(() => window.location.href = data.redirect, 800);
        } else {
            showAlert(alert, 'error', data.message || 'Maling access code.');
        }
    } catch {
        showAlert(alert, 'error', 'May nagkaproblema. Paki-ulit muli.');
    } finally {
        btn.disabled = false;
        btn.innerHTML = '🔓 Login';
    }
}

async function goBackToCredentials() {
    await fetch(CLEAR_PENDING_URL, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF }
    });

    showStep('credentials');
}

function showAlert(el, type, msg) {
    el.className = 'modal-alert ' + type;
    el.textContent = msg;
}

// Enter key shortcuts
document.getElementById('staffEmail').addEventListener('keydown', e => {
    if (e.key === 'Enter') document.getElementById('staffPassword').focus();
});
document.getElementById('staffPassword').addEventListener('keydown', e => {
    if (e.key === 'Enter') verifyCredentials();
});
document.getElementById('accessCode').addEventListener('keydown', e => {
    if (e.key === 'Enter') verifyAccessCode();
});

let currentPage = 0;

function showPage(index) {
    const pages = document.querySelectorAll('.desc-page');
    const dots  = document.querySelectorAll('.dot');

    pages.forEach(p => p.classList.remove('active'));
    dots.forEach(d => d.classList.remove('active'));

    pages[index].classList.add('active');
    dots[index].classList.add('active');

    currentPage = index;
}

//Background music 
// Background music 
document.addEventListener('DOMContentLoaded', () => {
    const bgMusic = document.getElementById('bgMusic');
    if (!bgMusic) return;

    // Wait for the first click anywhere
    document.addEventListener('click', () => {
        bgMusic.volume = 0; // start silent
        bgMusic.play().catch(err => console.log("Playback blocked:", err));

        // fade in
        let vol = 0;
        const fade = setInterval(() => {
            if (vol < 0.3) {
                vol += 0.05;
                bgMusic.volume = vol;
            } else {
                clearInterval(fade);
            }
        }, 200);
    }, { once: true }); // ensures it only triggers on the first click
});
