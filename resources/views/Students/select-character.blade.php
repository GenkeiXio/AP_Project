<!DOCTYPE html>
<html lang="fil">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Piliin ang Iyong Karakter – Araling Panlipunan</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green:      #6dbf7e;
            --green-dark: #4da862;
            --orange:     #e8922a;
            --brown:      #3d2a1a;
            --cream:      #fdf9f0;
        }

        html, body {
            height: 100%;
            font-family: 'Nunito', sans-serif;
            overflow: hidden;
        }

        body {
            background: linear-gradient(135deg, #c8e89a 0%, #f0e0b0 45%, #fde3a3 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            position: relative;
        }

        /* ── Floating decorations ── */
        .deco {
            position: fixed; pointer-events: none;
            animation: float 5s ease-in-out infinite; z-index: 0;
        }
        .deco-1 { top: 4%;  left: 3%;  font-size: 2.4rem; animation-delay: 0s;   }
        .deco-2 { top: 5%;  right: 3%; font-size: 2.8rem; animation-delay: 1s;   }
        .deco-3 { bottom: 6%; left: 4%;  font-size: 2rem;   animation-delay: 2s;   }
        .deco-4 { bottom: 5%; right: 3%; font-size: 2.6rem; animation-delay: 0.5s; }
        .deco-5 { top: 40%; left: 1%;  font-size: 1.6rem; animation-delay: 1.5s; }
        .deco-6 { top: 45%; right: 1%; font-size: 1.8rem; animation-delay: 0.8s; }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg);   }
            50%       { transform: translateY(-14px) rotate(3deg); }
        }

        /* ── Header ── */
        .header {
            text-align: center;
            margin-bottom: 32px;
            position: relative; z-index: 1;
            animation: fadeDown 0.6s ease both;
        }
        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .welcome-line {
            font-size: 1rem; font-weight: 700;
            color: var(--orange); margin-bottom: 6px;
            letter-spacing: 0.5px;
        }
        .welcome-line span { color: var(--brown); }

        .header h1 {
            font-family: 'Baloo 2', cursive;
            font-size: clamp(1.6rem, 4vw, 2.4rem);
            font-weight: 800; color: var(--brown);
            line-height: 1.15;
        }
        .header p {
            font-size: 0.95rem; color: #7a6040;
            margin-top: 6px;
        }

        /* ── Characters grid ── */
        .characters-wrap {
            display: flex;
            gap: 28px;
            justify-content: center;
            align-items: stretch;
            position: relative; z-index: 1;
            animation: fadeUp 0.6s ease 0.2s both;
            flex-wrap: wrap;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Character card ── */
        .char-card {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(16px);
            border-radius: 24px;
            padding: 32px 28px 28px;
            width: 260px;
            text-align: center;
            border: 3px solid transparent;
            box-shadow: 0 8px 32px rgba(80, 50, 10, 0.12);
            cursor: pointer;
            transition: transform 0.25s, border-color 0.25s, box-shadow 0.25s, background 0.25s;
            position: relative;
            overflow: hidden;
            user-select: none;
        }
        .char-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 5px;
            background: var(--card-accent, #e8dcc8);
            transition: background 0.25s;
        }
        .char-card.boy  { --card-accent: linear-gradient(90deg, #6dbf7e, #4da862); }
        .char-card.girl { --card-accent: linear-gradient(90deg, #f09050, #e8922a); }
        .char-card.boy::before  { background: linear-gradient(90deg, #6dbf7e, #4da862); }
        .char-card.girl::before { background: linear-gradient(90deg, #f09050, #e8922a); }

        .char-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 48px rgba(80, 50, 10, 0.18);
        }
        .char-card.selected {
            border-color: var(--green);
            background: rgba(255, 255, 255, 0.96);
            transform: translateY(-8px);
            box-shadow: 0 20px 52px rgba(77, 168, 98, 0.3);
        }
        .char-card.girl.selected {
            border-color: var(--orange);
            box-shadow: 0 20px 52px rgba(232, 146, 42, 0.3);
        }

        /* Selected checkmark */
        .selected-check {
            position: absolute; top: 14px; right: 16px;
            width: 28px; height: 28px; border-radius: 50%;
            background: var(--green);
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; color: #fff;
            opacity: 0; transform: scale(0);
            transition: opacity 0.2s, transform 0.2s;
        }
        .char-card.girl .selected-check { background: var(--orange); }
        .char-card.selected .selected-check { opacity: 1; transform: scale(1); }

        /* Character illustration area */
        .char-illustration {
            width: 140px; height: 170px;
            margin: 0 auto 18px;
            position: relative;
            display: flex; align-items: flex-end; justify-content: center;
        }

        /* SVG character - boy in school uniform */
        .char-svg { width: 100%; height: 100%; }

        .char-name {
            font-family: 'Baloo 2', cursive;
            font-size: 1.5rem; font-weight: 800;
            color: var(--brown); margin-bottom: 6px;
        }
        .char-role {
            font-size: 0.8rem; font-weight: 800;
            text-transform: uppercase; letter-spacing: 1px;
            color: var(--green); margin-bottom: 10px;
        }
        .char-card.girl .char-role { color: var(--orange); }

        .char-desc {
            font-size: 0.84rem; color: #7a6040;
            line-height: 1.5; margin-bottom: 16px;
        }

        .char-traits {
            display: flex; flex-wrap: wrap; gap: 6px;
            justify-content: center;
        }
        .trait {
            font-size: 0.72rem; font-weight: 700;
            padding: 4px 10px; border-radius: 20px;
            background: rgba(109, 191, 126, 0.15);
            color: #2d6a3c;
        }
        .char-card.girl .trait {
            background: rgba(232, 146, 42, 0.13);
            color: #8a4a00;
        }

        /* ── Confirm button ── */
        .confirm-wrap {
            margin-top: 32px;
            text-align: center;
            position: relative; z-index: 1;
            animation: fadeUp 0.6s ease 0.4s both;
        }

        .btn-confirm {
            padding: 16px 52px;
            background: linear-gradient(135deg, #6dbf7e, #4da862);
            color: #fff; border: none; border-radius: 16px;
            font-family: 'Baloo 2', cursive;
            font-size: 1.1rem; font-weight: 800;
            cursor: pointer;
            box-shadow: 0 6px 24px rgba(77, 168, 98, 0.35);
            transition: transform 0.2s, box-shadow 0.2s, opacity 0.2s;
            opacity: 0.45;
            pointer-events: none;
            letter-spacing: 0.3px;
        }
        .btn-confirm.active {
            opacity: 1; pointer-events: auto;
        }
        .btn-confirm.active:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 32px rgba(77, 168, 98, 0.45);
        }
        .btn-confirm.active:active { transform: translateY(0); }

        .confirm-hint {
            font-size: 0.82rem; color: #a09070;
            margin-top: 10px;
        }

        /* ── Loading state ── */
        @keyframes spin { to { transform: rotate(360deg); } }
        .spinner {
            display: inline-block; width: 18px; height: 18px;
            border: 2.5px solid rgba(255,255,255,0.4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            vertical-align: middle; margin-right: 8px;
        }
    </style>
</head>
<body>

    {{-- Decorations --}}
    <span class="deco deco-1">🌿</span>
    <span class="deco deco-2">🌟</span>
    <span class="deco deco-3">🌸</span>
    <span class="deco deco-4">🗺️</span>
    <span class="deco deco-5">📚</span>
    <span class="deco deco-6">✨</span>

    {{-- Header --}}
    <div class="header">
        <div class="welcome-line">Maligayang pagdating, <span>{{ $student->username }}</span>! 🎉</div>
        <h1>Piliin ang Iyong Karakter</h1>
        <p>Ang iyong karakter ay sasama sa iyo sa buong pakikipagsapalaran!</p>
    </div>

    {{-- Character Cards --}}
    <div class="characters-wrap">

        {{-- BOY CHARACTER --}}
        <div class="char-card boy" id="card-boy" onclick="selectChar('boy_uniform', this)">
            <div class="selected-check">✓</div>

            <div class="char-illustration">
                {{-- Boy in school uniform SVG --}}
                <svg class="char-svg" viewBox="0 0 140 170" xmlns="http://www.w3.org/2000/svg">
                    <!-- Shadow -->
                    <ellipse cx="70" cy="165" rx="35" ry="5" fill="rgba(0,0,0,0.08)"/>
                    <!-- Shoes -->
                    <ellipse cx="56" cy="158" rx="13" ry="6" fill="#2c1a0e"/>
                    <ellipse cx="84" cy="158" rx="13" ry="6" fill="#2c1a0e"/>
                    <!-- Pants -->
                    <rect x="50" y="118" width="16" height="38" rx="4" fill="#2a4080"/>
                    <rect x="74" y="118" width="16" height="38" rx="4" fill="#2a4080"/>
                    <!-- Belt -->
                    <rect x="48" y="114" width="44" height="7" rx="3" fill="#1a2a50"/>
                    <rect x="67" y="114" width="6" height="7" rx="1" fill="#c8a850"/>
                    <!-- Shirt / Barong-style top -->
                    <rect x="44" y="72" width="52" height="46" rx="8" fill="#f0f4ff"/>
                    <!-- Collar -->
                    <polygon points="70,75 63,88 70,84 77,88" fill="#dde4ff"/>
                    <!-- Shirt buttons -->
                    <circle cx="70" cy="92" r="2" fill="#c0c8e0"/>
                    <circle cx="70" cy="101" r="2" fill="#c0c8e0"/>
                    <circle cx="70" cy="110" r="2" fill="#c0c8e0"/>
                    <!-- Tie -->
                    <polygon points="70,78 67,94 70,96 73,94" fill="#c03030"/>
                    <!-- Arms -->
                    <rect x="30" y="74" width="16" height="34" rx="7" fill="#f5c5a0"/>
                    <rect x="94" y="74" width="16" height="34" rx="7" fill="#f5c5a0"/>
                    <!-- Cuffs -->
                    <rect x="30" y="100" width="16" height="8" rx="4" fill="#f0f4ff"/>
                    <rect x="94" y="100" width="16" height="8" rx="4" fill="#f0f4ff"/>
                    <!-- Hands -->
                    <ellipse cx="38" cy="113" rx="8" ry="7" fill="#f5c5a0"/>
                    <ellipse cx="102" cy="113" rx="8" ry="7" fill="#f5c5a0"/>
                    <!-- Neck -->
                    <rect x="62" y="58" width="16" height="18" rx="4" fill="#f5c5a0"/>
                    <!-- Head -->
                    <ellipse cx="70" cy="44" rx="28" ry="30" fill="#f5c5a0"/>
                    <!-- Hair -->
                    <ellipse cx="70" cy="20" rx="29" ry="16" fill="#3d1f0a"/>
                    <rect x="41" y="16" width="10" height="22" rx="5" fill="#3d1f0a"/>
                    <rect x="89" y="16" width="10" height="22" rx="5" fill="#3d1f0a"/>
                    <!-- Eyes -->
                    <ellipse cx="60" cy="46" rx="5" ry="5.5" fill="#fff"/>
                    <ellipse cx="80" cy="46" rx="5" ry="5.5" fill="#fff"/>
                    <circle cx="61" cy="47" r="3" fill="#2c1a0e"/>
                    <circle cx="81" cy="47" r="3" fill="#2c1a0e"/>
                    <circle cx="62" cy="46" r="1" fill="#fff"/>
                    <circle cx="82" cy="46" r="1" fill="#fff"/>
                    <!-- Eyebrows -->
                    <path d="M55 39 Q60 36 65 39" stroke="#3d1f0a" stroke-width="2" fill="none" stroke-linecap="round"/>
                    <path d="M75 39 Q80 36 85 39" stroke="#3d1f0a" stroke-width="2" fill="none" stroke-linecap="round"/>
                    <!-- Smile -->
                    <path d="M63 57 Q70 63 77 57" stroke="#c07050" stroke-width="2" fill="none" stroke-linecap="round"/>
                    <!-- Cheeks -->
                    <ellipse cx="55" cy="54" rx="6" ry="4" fill="rgba(255,160,100,0.25)"/>
                    <ellipse cx="85" cy="54" rx="6" ry="4" fill="rgba(255,160,100,0.25)"/>
                    <!-- Book in hand -->
                    <rect x="22" y="104" width="18" height="22" rx="3" fill="#4da862"/>
                    <rect x="24" y="106" width="14" height="18" rx="2" fill="#6dbf7e"/>
                    <line x1="31" y1="106" x2="31" y2="124" stroke="#3a8050" stroke-width="1.5"/>
                </svg>
            </div>

            <div class="char-name">Juan</div>
            <div class="char-role">Mag-aaral na Lalaki</div>
            <div class="char-desc">
                Masigla at palaging handa sa aralin. Si Juan ay mapaghanap ng kaalaman at mahilig sa kasaysayan ng Pilipinas.
            </div>
            <div class="char-traits">
                <span class="trait">🧠 Matalino</span>
                <span class="trait">💪 Masigla</span>
                <span class="trait">📚 Matiyaga</span>
            </div>
        </div>

        {{-- GIRL CHARACTER --}}
        <div class="char-card girl" id="card-girl" onclick="selectChar('girl_uniform', this)">
            <div class="selected-check">✓</div>

            <div class="char-illustration">
                {{-- Girl in school uniform SVG --}}
                <svg class="char-svg" viewBox="0 0 140 170" xmlns="http://www.w3.org/2000/svg">
                    <!-- Shadow -->
                    <ellipse cx="70" cy="165" rx="35" ry="5" fill="rgba(0,0,0,0.08)"/>
                    <!-- Shoes -->
                    <ellipse cx="57" cy="158" rx="12" ry="5" fill="#2c1a0e"/>
                    <ellipse cx="83" cy="158" rx="12" ry="5" fill="#2c1a0e"/>
                    <!-- Socks -->
                    <rect x="51" y="148" width="12" height="10" rx="3" fill="#fff"/>
                    <rect x="77" y="148" width="12" height="10" rx="3" fill="#fff"/>
                    <!-- Skirt -->
                    <path d="M46 112 Q70 130 94 112 L90 155 Q70 165 50 155 Z" fill="#1a3a7a"/>
                    <!-- Pleats -->
                    <line x1="57" y1="116" x2="53" y2="152" stroke="#142e60" stroke-width="1.5"/>
                    <line x1="70" y1="118" x2="70" y2="154" stroke="#142e60" stroke-width="1.5"/>
                    <line x1="83" y1="116" x2="87" y2="152" stroke="#142e60" stroke-width="1.5"/>
                    <!-- Blouse -->
                    <rect x="44" y="68" width="52" height="48" rx="8" fill="#fff5f5"/>
                    <!-- Collar -->
                    <polygon points="70,71 62,86 70,82 78,86" fill="#ffd0d0"/>
                    <!-- Necktie / bow -->
                    <polygon points="65,72 75,72 72,82 68,82" fill="#e83060"/>
                    <ellipse cx="70" cy="72" rx="7" ry="4" fill="#e83060"/>
                    <!-- Shirt buttons -->
                    <circle cx="70" cy="90" r="2" fill="#e0c0c0"/>
                    <circle cx="70" cy="100" r="2" fill="#e0c0c0"/>
                    <!-- Arms -->
                    <rect x="30" y="70" width="16" height="34" rx="7" fill="#f5c5a0"/>
                    <rect x="94" y="70" width="16" height="34" rx="7" fill="#f5c5a0"/>
                    <!-- Cuffs -->
                    <rect x="30" y="96" width="16" height="8" rx="4" fill="#fff5f5"/>
                    <rect x="94" y="96" width="16" height="8" rx="4" fill="#fff5f5"/>
                    <!-- Hands -->
                    <ellipse cx="38" cy="109" rx="8" ry="7" fill="#f5c5a0"/>
                    <ellipse cx="102" cy="109" rx="8" ry="7" fill="#f5c5a0"/>
                    <!-- Neck -->
                    <rect x="62" y="56" width="16" height="16" rx="4" fill="#f5c5a0"/>
                    <!-- Head -->
                    <ellipse cx="70" cy="40" rx="27" ry="29" fill="#f5c5a0"/>
                    <!-- Hair (long) -->
                    <ellipse cx="70" cy="18" rx="28" ry="15" fill="#2c1206"/>
                    <rect x="41" y="14" width="10" height="50" rx="5" fill="#2c1206"/>
                    <rect x="89" y="14" width="10" height="50" rx="5" fill="#2c1206"/>
                    <path d="M41 50 Q36 70 40 90" stroke="#2c1206" stroke-width="10" fill="none" stroke-linecap="round"/>
                    <path d="M99 50 Q104 70 100 90" stroke="#2c1206" stroke-width="10" fill="none" stroke-linecap="round"/>
                    <!-- Hair clip -->
                    <ellipse cx="88" cy="28" rx="5" ry="4" fill="#e83060"/>
                    <ellipse cx="88" cy="28" rx="3" ry="2" fill="#ff80a0"/>
                    <!-- Eyes -->
                    <ellipse cx="60" cy="42" rx="5" ry="5.5" fill="#fff"/>
                    <ellipse cx="80" cy="42" rx="5" ry="5.5" fill="#fff"/>
                    <circle cx="61" cy="43" r="3" fill="#2c1a0e"/>
                    <circle cx="81" cy="43" r="3" fill="#2c1a0e"/>
                    <circle cx="62" cy="42" r="1" fill="#fff"/>
                    <circle cx="82" cy="42" r="1" fill="#fff"/>
                    <!-- Lashes -->
                    <path d="M55 38 Q57 35 60 37" stroke="#2c1206" stroke-width="1.5" fill="none"/>
                    <path d="M75 38 Q77 35 82 37" stroke="#2c1206" stroke-width="1.5" fill="none"/>
                    <!-- Eyebrows -->
                    <path d="M55 36 Q60 33 65 36" stroke="#2c1206" stroke-width="2" fill="none" stroke-linecap="round"/>
                    <path d="M75 36 Q80 33 85 36" stroke="#2c1206" stroke-width="2" fill="none" stroke-linecap="round"/>
                    <!-- Smile -->
                    <path d="M63 53 Q70 59 77 53" stroke="#c07050" stroke-width="2" fill="none" stroke-linecap="round"/>
                    <!-- Cheeks -->
                    <ellipse cx="54" cy="50" rx="7" ry="5" fill="rgba(255,130,130,0.28)"/>
                    <ellipse cx="86" cy="50" rx="7" ry="5" fill="rgba(255,130,130,0.28)"/>
                    <!-- Notebook -->
                    <rect x="96" y="100" width="20" height="24" rx="3" fill="#e83060"/>
                    <rect x="98" y="102" width="16" height="20" rx="2" fill="#ff8090"/>
                    <line x1="107" y1="102" x2="107" y2="122" stroke="#e83060" stroke-width="1.5"/>
                    <line x1="100" y1="108" x2="114" y2="108" stroke="#e83060" stroke-width="1"/>
                    <line x1="100" y1="113" x2="114" y2="113" stroke="#e83060" stroke-width="1"/>
                </svg>
            </div>

            <div class="char-name">Maria</div>
            <div class="char-role">Mag-aaral na Babae</div>
            <div class="char-desc">
                Masisigasig at mapanuri. Si Maria ay malikhaing mag-isip at palaging handang tumulong sa kanyang mga kaklase.
            </div>
            <div class="char-traits">
                <span class="trait">🌟 Malikhain</span>
                <span class="trait">🤝 Matulungin</span>
                <span class="trait">🔍 Mapanuri</span>
            </div>
        </div>
    </div>

    {{-- Confirm Button --}}
    <div class="confirm-wrap">
        <form method="POST" action="{{ route('student.save-character') }}" id="charForm">
            @csrf
            <input type="hidden" name="avatar" id="avatarInput" value="" />
            <button type="submit" class="btn-confirm" id="confirmBtn" disabled>
                Piliin si <span id="confirmName">—</span>! 🚀
            </button>
        </form>
        <div class="confirm-hint" id="confirmHint">👆 Pumili muna ng karakter</div>
    </div>

    <script>
        let selected = null;

        function selectChar(avatarVal, card) {
            // Remove selection from all cards
            document.querySelectorAll('.char-card').forEach(c => c.classList.remove('selected'));

            // Select this card
            card.classList.add('selected');
            selected = avatarVal;

            // Update form
            document.getElementById('avatarInput').value = avatarVal;

            // Update button
            const name = avatarVal === 'boy_uniform' ? 'Juan' : 'Maria';
            const btn  = document.getElementById('confirmBtn');
            btn.innerHTML  = `Piliin si ${name}! 🚀`;
            btn.disabled   = false;
            btn.classList.add('active');

            // Update hint
            document.getElementById('confirmHint').textContent =
                avatarVal === 'boy_uniform'
                    ? '✅ Pinili: Juan — Handa ka na bang magsimula?'
                    : '✅ Pinili: Maria — Handa ka na bang magsimula?';
        }

        // Show loading on submit
        document.getElementById('charForm').addEventListener('submit', function() {
            const btn = document.getElementById('confirmBtn');
            btn.innerHTML = '<span class="spinner"></span> Sinisimula...';
            btn.disabled  = true;
        });
    </script>
</body>
</html>
