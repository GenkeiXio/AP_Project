@extends('Students.studentslayout')

@section('title', 'Aking Profile')

@push('styles')
<style>
    .profile-layout {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 24px;
        align-items: start;
    }
    @media(max-width: 860px) { .profile-layout { grid-template-columns: 1fr; } }

    /* ── Left: Character Card ── */
    .char-card-profile {
        background: rgba(255,255,255,0.88);
        border-radius: 22px;
        padding: 28px 22px;
        box-shadow: 0 6px 24px rgba(80,50,10,0.1);
        border: 1.5px solid rgba(255,255,255,0.7);
        text-align: center;
        position: sticky;
        top: 80px;
    }

    .current-char-wrap {
        width: 120px; height: 145px;
        margin: 0 auto 16px;
        position: relative;
    }
    .current-char-wrap svg { width: 100%; height: 100%; }

    .char-name-big {
        font-family: 'Baloo 2', cursive;
        font-size: 1.35rem; font-weight: 800;
        color: #3d2a1a; margin-bottom: 2px;
    }
    .char-role-label {
        font-size: 0.76rem; font-weight: 800;
        text-transform: uppercase; letter-spacing: 0.8px;
        color: #9a8060; margin-bottom: 18px;
    }

    /* ── Change character section ── */
    .change-char-label {
        font-size: 0.78rem; font-weight: 800;
        text-transform: uppercase; letter-spacing: 0.6px;
        color: #b5a48a; margin-bottom: 12px;
    }

    .char-options {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 16px;
    }

    .char-opt {
        border: 2.5px solid #e8dcc8;
        border-radius: 14px;
        padding: 14px 8px 10px;
        cursor: pointer;
        transition: border-color 0.2s, transform 0.15s, background 0.2s;
        background: #fdfaf5;
        text-align: center;
    }
    .char-opt:hover { border-color: #6dbf7e; transform: scale(1.04); background: #f0faf5; }
    .char-opt.selected { border-color: #6dbf7e; background: #e8f8ed; }
    .char-opt.girl-opt.selected { border-color: #e8922a; background: #fff3e0; }

    .char-opt-svg { width: 60px; height: 72px; margin: 0 auto 6px; display: block; }
    .char-opt-name { font-family: 'Baloo 2', cursive; font-size: 0.9rem; font-weight: 800; color: #3d2a1a; }

    .btn-save-char {
        width: 100%; padding: 12px;
        background: linear-gradient(135deg, #6dbf7e, #4da862);
        color: #fff; border: none; border-radius: 12px;
        font-family: 'Baloo 2', cursive; font-size: 0.95rem; font-weight: 700;
        cursor: pointer;
        box-shadow: 0 3px 12px rgba(77,168,98,0.28);
        transition: transform 0.15s, box-shadow 0.15s;
    }
    .btn-save-char:hover { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(77,168,98,0.38); }

    /* ── Right sections ── */
    .section-card {
        background: rgba(255,255,255,0.88);
        border-radius: 18px;
        padding: 24px 26px;
        box-shadow: 0 4px 18px rgba(80,50,10,0.08);
        border: 1.5px solid rgba(255,255,255,0.7);
        margin-bottom: 20px;
    }
    .section-card h2 {
        font-family: 'Baloo 2', cursive;
        font-size: 1.1rem; font-weight: 800;
        color: #3d2a1a; margin-bottom: 18px;
        padding-bottom: 12px;
        border-bottom: 2px solid rgba(109,191,126,0.2);
        display: flex; align-items: center; gap: 8px;
    }

    /* Stats */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }
    .stat-box {
        background: #f8f4ee;
        border-radius: 14px; padding: 16px 10px;
        text-align: center;
        border: 1.5px solid #f0e8d8;
    }
    .stat-box .sv {
        font-family: 'Baloo 2', cursive;
        font-size: 1.8rem; font-weight: 800;
        color: #3d2a1a; line-height: 1;
    }
    .stat-box .sl { font-size: 0.72rem; color: #9a8060; font-weight: 700; margin-top: 3px; }

    /* Form */
    .form-group { margin-bottom: 14px; }
    .form-group label {
        display: block; font-size: 0.8rem; font-weight: 800;
        text-transform: uppercase; letter-spacing: 0.5px;
        color: #9a8060; margin-bottom: 7px;
    }
    .input-row {
        display: flex; gap: 10px; align-items: center;
    }
    .form-group input {
        flex: 1; padding: 11px 14px;
        border: 2px solid #e0d0ba; border-radius: 11px;
        font-family: 'Nunito', sans-serif; font-size: 0.93rem;
        outline: none; transition: border-color 0.2s;
        background: #fff;
    }
    .form-group input:focus { border-color: #6dbf7e; box-shadow: 0 0 0 3px rgba(109,191,126,0.12); }

    .btn-update {
        padding: 11px 20px;
        background: linear-gradient(135deg, #6dbf7e, #4da862);
        color: #fff; border: none; border-radius: 11px;
        font-family: 'Nunito', sans-serif; font-size: 0.88rem; font-weight: 700;
        cursor: pointer; white-space: nowrap;
        transition: opacity 0.2s, transform 0.15s;
        box-shadow: 0 3px 10px rgba(77,168,98,0.28);
    }
    .btn-update:hover { opacity: 0.88; transform: translateY(-1px); }
    .btn-update:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }

    /* Alert */
    .inline-alert {
        font-size: 0.84rem; font-weight: 700;
        padding: 8px 13px; border-radius: 9px;
        margin-top: 10px; display: none;
    }
    .inline-alert.success { background: #e8f8ed; color: #1e7a3a; display: block; }
    .inline-alert.error   { background: #fde8e8; color: #c0392b; display: block; }

    /* Account info */
    .info-row {
        display: flex; justify-content: space-between; align-items: center;
        padding: 10px 0; border-bottom: 1px solid #f5ede0;
        font-size: 0.88rem;
    }
    .info-row:last-child { border-bottom: none; }
    .info-label { color: #9a8060; font-weight: 700; }
    .info-val   { color: #3d2a1a; font-weight: 800; }

    /* Toast */
    .toast {
        position: fixed; bottom: 28px; right: 28px;
        padding: 13px 22px; border-radius: 13px;
        font-size: 0.9rem; font-weight: 700; color: #fff;
        box-shadow: 0 6px 24px rgba(0,0,0,0.18);
        z-index: 9999; opacity: 0; transform: translateY(12px);
        transition: opacity 0.3s, transform 0.3s; pointer-events: none;
    }
    .toast.show { opacity: 1; transform: translateY(0); }
    .toast.success { background: linear-gradient(135deg, #4da862, #3a8050); }
    .toast.error   { background: linear-gradient(135deg, #e05050, #c03030); }

    @keyframes spin { to { transform: rotate(360deg); } }
    .btn-spinner {
        display: inline-block; width: 13px; height: 13px;
        border: 2px solid rgba(255,255,255,0.4); border-top-color: #fff;
        border-radius: 50%; animation: spin 0.7s linear infinite;
    }
</style>
@endpush

@section('content')

@php
    $isBoy    = ($student->avatar ?? '') === 'boy_uniform';
    $isGirl   = ($student->avatar ?? '') === 'girl_uniform';
    $charName = $isBoy ? 'Juan' : ($isGirl ? 'Maria' : 'Explorer');
    $charRole = $isBoy ? 'Mag-aaral na Lalaki' : ($isGirl ? 'Mag-aaral na Babae' : 'Mag-aaral');
@endphp

<div class="profile-layout">

    {{-- ── LEFT: Character card ── --}}
    <div>
        <div class="char-card-profile">

            {{-- Current character display --}}
            <div class="current-char-wrap" id="currentCharDisplay">
                @if($isBoy)
                    @include('Students._char_boy_svg')
                @elseif($isGirl)
                    @include('Students._char_girl_svg')
                @else
                    <div style="font-size:5rem;line-height:145px;">🎒</div>
                @endif
            </div>
            <div class="char-name-big" id="currentCharName">{{ $charName }}</div>
            <div class="char-role-label" id="currentCharRole">{{ $charRole }}</div>

            {{-- Change character --}}
            <div class="change-char-label">Palitan ang Karakter</div>
            <div class="char-options">
                <div class="char-opt {{ $isBoy ? 'selected' : '' }}" id="opt-boy" onclick="selectProfileChar('boy_uniform', this)">
                    <svg class="char-opt-svg" viewBox="0 0 140 170" xmlns="http://www.w3.org/2000/svg">
                        <ellipse cx="70" cy="165" rx="30" ry="4" fill="rgba(0,0,0,0.07)"/>
                        <ellipse cx="57" cy="155" rx="11" ry="5" fill="#2c1a0e"/>
                        <ellipse cx="83" cy="155" rx="11" ry="5" fill="#2c1a0e"/>
                        <rect x="51" y="118" width="14" height="36" rx="4" fill="#2a4080"/>
                        <rect x="75" y="118" width="14" height="36" rx="4" fill="#2a4080"/>
                        <rect x="47" y="113" width="46" height="8" rx="3" fill="#1a2a50"/>
                        <rect x="44" y="70" width="52" height="46" rx="7" fill="#f0f4ff"/>
                        <polygon points="70,73 63,86 70,82 77,86" fill="#dde4ff"/>
                        <polygon points="70,76 67,92 70,94 73,92" fill="#c03030"/>
                        <rect x="30" y="72" width="16" height="32" rx="7" fill="#f5c5a0"/>
                        <rect x="94" y="72" width="16" height="32" rx="7" fill="#f5c5a0"/>
                        <ellipse cx="38" cy="109" rx="8" ry="6" fill="#f5c5a0"/>
                        <ellipse cx="102" cy="109" rx="8" ry="6" fill="#f5c5a0"/>
                        <rect x="62" y="57" width="16" height="16" rx="4" fill="#f5c5a0"/>
                        <ellipse cx="70" cy="42" rx="27" ry="28" fill="#f5c5a0"/>
                        <ellipse cx="70" cy="20" rx="28" ry="14" fill="#3d1f0a"/>
                        <rect x="42" y="16" width="9" height="20" rx="5" fill="#3d1f0a"/>
                        <rect x="89" y="16" width="9" height="20" rx="5" fill="#3d1f0a"/>
                        <ellipse cx="60" cy="44" rx="4.5" ry="5" fill="#fff"/>
                        <ellipse cx="80" cy="44" rx="4.5" ry="5" fill="#fff"/>
                        <circle cx="61" cy="45" r="2.5" fill="#2c1a0e"/>
                        <circle cx="81" cy="45" r="2.5" fill="#2c1a0e"/>
                        <path d="M63 55 Q70 61 77 55" stroke="#c07050" stroke-width="2" fill="none" stroke-linecap="round"/>
                        <ellipse cx="55" cy="52" rx="5" ry="4" fill="rgba(255,160,100,0.25)"/>
                        <ellipse cx="85" cy="52" rx="5" ry="4" fill="rgba(255,160,100,0.25)"/>
                    </svg>
                    <div class="char-opt-name">Juan</div>
                </div>
                <div class="char-opt girl-opt {{ $isGirl ? 'selected' : '' }}" id="opt-girl" onclick="selectProfileChar('girl_uniform', this)">
                    <svg class="char-opt-svg" viewBox="0 0 140 170" xmlns="http://www.w3.org/2000/svg">
                        <ellipse cx="70" cy="165" rx="30" ry="4" fill="rgba(0,0,0,0.07)"/>
                        <ellipse cx="57" cy="156" rx="10" ry="4" fill="#2c1a0e"/>
                        <ellipse cx="83" cy="156" rx="10" ry="4" fill="#2c1a0e"/>
                        <rect x="51" y="148" width="12" height="8" rx="3" fill="#fff"/>
                        <rect x="77" y="148" width="12" height="8" rx="3" fill="#fff"/>
                        <path d="M46 110 Q70 128 94 110 L90 153 Q70 163 50 153 Z" fill="#1a3a7a"/>
                        <rect x="44" y="66" width="52" height="47" rx="7" fill="#fff5f5"/>
                        <polygon points="70,69 63,83 70,79 77,83" fill="#ffd0d0"/>
                        <ellipse cx="70" cy="69" rx="7" ry="4" fill="#e83060"/>
                        <rect x="30" y="68" width="16" height="32" rx="7" fill="#f5c5a0"/>
                        <rect x="94" y="68" width="16" height="32" rx="7" fill="#f5c5a0"/>
                        <ellipse cx="38" cy="105" rx="8" ry="6" fill="#f5c5a0"/>
                        <ellipse cx="102" cy="105" rx="8" ry="6" fill="#f5c5a0"/>
                        <rect x="62" y="53" width="16" height="16" rx="4" fill="#f5c5a0"/>
                        <ellipse cx="70" cy="38" rx="26" ry="27" fill="#f5c5a0"/>
                        <ellipse cx="70" cy="17" rx="27" ry="13" fill="#2c1206"/>
                        <rect x="42" y="13" width="9" height="46" rx="5" fill="#2c1206"/>
                        <rect x="89" y="13" width="9" height="46" rx="5" fill="#2c1206"/>
                        <path d="M42 48 Q38 65 42 84" stroke="#2c1206" stroke-width="9" fill="none" stroke-linecap="round"/>
                        <path d="M98 48 Q102 65 98 84" stroke="#2c1206" stroke-width="9" fill="none" stroke-linecap="round"/>
                        <ellipse cx="88" cy="25" rx="5" ry="3.5" fill="#e83060"/>
                        <ellipse cx="60" cy="40" rx="4.5" ry="5" fill="#fff"/>
                        <ellipse cx="80" cy="40" rx="4.5" ry="5" fill="#fff"/>
                        <circle cx="61" cy="41" r="2.5" fill="#2c1a0e"/>
                        <circle cx="81" cy="41" r="2.5" fill="#2c1a0e"/>
                        <path d="M63 51 Q70 57 77 51" stroke="#c07050" stroke-width="2" fill="none" stroke-linecap="round"/>
                        <ellipse cx="54" cy="48" rx="6" ry="4" fill="rgba(255,130,130,0.28)"/>
                        <ellipse cx="86" cy="48" rx="6" ry="4" fill="rgba(255,130,130,0.28)"/>
                    </svg>
                    <div class="char-opt-name">Maria</div>
                </div>
            </div>

            <button class="btn-save-char" id="saveCharBtn" onclick="saveCharacter()">
                💾 I-save ang Karakter
            </button>
            <div class="inline-alert" id="charAlert"></div>
        </div>
    </div>

    {{-- ── RIGHT: Info sections ── --}}
    <div>

        {{-- Stats ──────────────────── --}}
        <div class="section-card">
            <h2>📊 Iyong Progreso</h2>
            <div class="stats-grid">
                <div class="stat-box">
                    <div class="sv">{{ $totalClasses }}</div>
                    <div class="sl">🏫 Klase</div>
                </div>
                <div class="stat-box">
                    <div class="sv">{{ $totalQuizzes }}</div>
                    <div class="sl">🎮 Quizzes</div>
                </div>
                <div class="stat-box">
                    <div class="sv">{{ $avgScore }}%</div>
                    <div class="sl">📈 Avg Score</div>
                </div>
            </div>
        </div>

        {{-- Change Username ──────────── --}}
        <div class="section-card">
            <h2>✏️ Palitan ang Username</h2>
            <div class="form-group">
                <label>Username</label>
                <div class="input-row">
                    <input type="text" id="usernameInput"
                        value="{{ $student->username }}"
                        placeholder="Bagong username..."
                        maxlength="50"
                        autocomplete="off" />
                    <button class="btn-update" id="usernameBtn" onclick="updateUsername()">
                        I-save
                    </button>
                </div>
                <div class="inline-alert" id="usernameAlert"></div>
            </div>
            <p style="font-size:0.78rem; color:#b5a48a; margin-top:4px;">
                ⚠️ Mga letra, numero, at underscore lamang. Hindi maaaring gamitin ang username ng ibang mag-aaral.
            </p>
        </div>

        {{-- Account Info ──────────────── --}}
        <div class="section-card">
            <h2>ℹ️ Impormasyon ng Account</h2>
            <div class="info-row">
                <span class="info-label">Username</span>
                <span class="info-val" id="displayUsername">{{ $student->username }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Karakter</span>
                <span class="info-val">{{ $student->avatar_emoji }} {{ $charName }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Sumali</span>
                <span class="info-val">{{ $student->created_at->format('F d, Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Huling nilaro</span>
                <span class="info-val">{{ $student->last_played ? $student->last_played->diffForHumans() : 'Ngayon' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Mga klase</span>
                <span class="info-val">{{ $totalClasses }} klase{{ $totalClasses !== 1 ? '' : '' }}</span>
            </div>
        </div>

    </div>
</div>

<div class="toast" id="toast"></div>

@endsection

@push('scripts')
<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;
let selectedChar = '{{ $student->avatar ?? "" }}';

// ── Character selection ──
function selectProfileChar(val, card) {
    document.querySelectorAll('.char-opt').forEach(c => c.classList.remove('selected'));
    card.classList.add('selected');
    selectedChar = val;
}

async function saveCharacter() {
    const btn   = document.getElementById('saveCharBtn');
    const alert = document.getElementById('charAlert');
    if (!selectedChar) { showAlert(alert, 'error', 'Pumili muna ng karakter.'); return; }
    btn.disabled  = true;
    btn.innerHTML = '<span class="btn-spinner"></span> Sine-save...';
    try {
        const res  = await fetch('{{ route("student.profile.avatar") }}', {
            method:  'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body:    JSON.stringify({ avatar: selectedChar }),
        });
        const data = await res.json();
        if (data.success) {
            showToast('✅ Karakter na-update!', 'success');
            showAlert(alert, 'success', '✅ Na-save na ang iyong karakter!');
            // Update display name
            document.getElementById('currentCharName').textContent = selectedChar === 'boy_uniform' ? 'Juan' : 'Maria';
            document.getElementById('currentCharRole').textContent = selectedChar === 'boy_uniform' ? 'Mag-aaral na Lalaki' : 'Mag-aaral na Babae';
        } else {
            showAlert(alert, 'error', 'Hindi na-save. Subukan ulit.');
        }
    } catch(e) { showAlert(alert, 'error', 'Nagkaroon ng error.'); }
    btn.disabled  = false;
    btn.innerHTML = '💾 I-save ang Karakter';
}

// ── Username update ──
async function updateUsername() {
    const input = document.getElementById('usernameInput');
    const btn   = document.getElementById('usernameBtn');
    const alert = document.getElementById('usernameAlert');
    const val   = input.value.trim();

    if (!val) { showAlert(alert, 'error', 'Pakiusap ilagay ang username.'); return; }

    btn.disabled  = true;
    btn.innerHTML = '<span class="btn-spinner"></span>';
    try {
        const res  = await fetch('{{ route("student.profile.username") }}', {
            method:  'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body:    JSON.stringify({ username: val }),
        });
        const data = await res.json();
        if (data.success) {
            showToast('✅ Username na-update!', 'success');
            showAlert(alert, 'success', `✅ Username na-update: ${data.username}`);
            document.getElementById('displayUsername').textContent = data.username;
            // Update nav chip
            const chip = document.querySelector('.user-chip');
            if (chip) chip.innerHTML = `🎒 ${data.username}`;
        } else {
            const msg = data.errors?.username?.[0] || data.message || 'Hindi na-save.';
            showAlert(alert, 'error', msg);
        }
    } catch(e) { showAlert(alert, 'error', 'Nagkaroon ng error.'); }
    btn.disabled  = false;
    btn.innerHTML = 'I-save';
}

let toastTimer;
function showToast(msg, type = 'success') {
    const t = document.getElementById('toast');
    t.textContent = msg; t.className = `toast ${type} show`;
    clearTimeout(toastTimer); toastTimer = setTimeout(() => t.classList.remove('show'), 3000);
}
function showAlert(el, type, msg) { el.className = `inline-alert ${type}`; el.textContent = msg; }
</script>
@endpush
