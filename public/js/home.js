const CSRF = document.querySelector('meta[name="csrf-token"]').content;

// Get routes from HTML
const VERIFY_CREDENTIALS_URL = document.querySelector('meta[name="verify-credentials"]').content;
const VERIFY_ACCESS_URL      = document.querySelector('meta[name="verify-access"]').content;
const CLEAR_PENDING_URL      = document.querySelector('meta[name="clear-pending"]').content;

// ── Student form ──
const studentForm   = document.getElementById('studentForm');
const usernameInput = document.getElementById('usernameInput');
const usernameError = document.getElementById('usernameError');
const startBtn      = document.getElementById('startBtn');

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
    document.getElementById('staffEmail').value = '';
    document.getElementById('staffPassword').value = '';
    document.getElementById('accessCode').value = '';
    showStep('credentials');
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