@extends('Students.studentslayout')

@section('title', 'Dashboard')

@push('styles')
<style>
    .welcome-card {
        background: rgba(255,255,255,0.88); backdrop-filter: blur(12px);
        border-radius: 22px; padding: 28px 32px;
        box-shadow: 0 8px 36px rgba(80,50,10,0.11);
        border: 1.5px solid rgba(255,255,255,0.7);
        margin-bottom: 22px;
        display: flex; align-items: center; gap: 24px;
        animation: slideUp 0.5s cubic-bezier(.22,1,.36,1) both;
        position: relative; overflow: hidden;
    }
    .welcome-card::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px;
        background: linear-gradient(90deg, #6dbf7e, #e8922a, #6dbf7e);
    }
    @keyframes slideUp { from{opacity:0;transform:translateY(22px)} to{opacity:1;transform:translateY(0)} }

    .welcome-avatar {
        width: 110px; height: 130px; flex-shrink: 0;
    }
    .welcome-avatar svg { width: 100%; height: 100%; }

    .welcome-text h1 {
        font-family: 'Baloo 2', cursive;
        font-size: clamp(1.4rem, 3vw, 1.9rem); font-weight: 800;
        color: #3d2a1a; margin-bottom: 5px;
    }
    .welcome-text p { color: #9a8060; font-size: 0.9rem; margin-bottom: 12px; }
    .welcome-badges { display: flex; gap: 8px; flex-wrap: wrap; }
    .w-badge {
        font-size: 0.75rem; font-weight: 700;
        padding: 4px 12px; border-radius: 20px;
    }
    .w-badge.green  { background: #e8f8ed; color: #1e7a3a; }
    .w-badge.orange { background: #fff3e0; color: #b05800; }
    .w-badge.blue   { background: #e8f0ff; color: #2a4aaa; }

    /* Info grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 14px; margin-bottom: 20px;
    }
    .info-card {
        background: rgba(255,255,255,0.82); border-radius: 15px;
        padding: 18px 20px; box-shadow: 0 3px 14px rgba(80,50,10,0.07);
        border: 1.5px solid rgba(255,255,255,0.6);
        animation: slideUp 0.5s cubic-bezier(.22,1,.36,1) both;
    }
    .info-card:nth-child(2) { animation-delay: 0.08s; }
    .info-card:nth-child(3) { animation-delay: 0.16s; }
    .info-card .lbl { font-size: 0.72rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.6px; color: #b5a48a; margin-bottom: 4px; }
    .info-card .val { font-family: 'Baloo 2', cursive; font-size: 1.2rem; font-weight: 800; color: #3d2a1a; }

    /* Quick cards */
    .quick-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        gap: 16px;
    }
    .quick-card {
        background: rgba(255,255,255,0.85); border-radius: 18px;
        padding: 20px; box-shadow: 0 4px 16px rgba(80,50,10,0.08);
        border: 2px solid rgba(255,255,255,0.6);
        text-decoration: none;
        display: flex; align-items: center; gap: 14px;
        transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s;
        animation: slideUp 0.5s cubic-bezier(.22,1,.36,1) both;
    }
    .quick-card:nth-child(2) { animation-delay: 0.08s; }
    .quick-card:nth-child(3) { animation-delay: 0.16s; }
    .quick-card:hover {
        transform: translateY(-3px); border-color: rgba(109,191,126,0.45);
        box-shadow: 0 10px 26px rgba(80,50,10,0.12);
    }
    .quick-icon {
        width: 50px; height: 50px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem; flex-shrink: 0;
    }
    .qi-green  { background: rgba(109,191,126,0.2); }
    .qi-orange { background: rgba(232,146,42,0.15); }
    .qi-teal   { background: rgba(58,158,140,0.15); }
    .quick-card .qt { font-family: 'Baloo 2', cursive; font-size: 0.98rem; font-weight: 800; color: #3d2a1a; }
    .quick-card .qs { font-size: 0.76rem; color: #9a8060; margin-top: 2px; }
</style>
@endpush

@section('content')

@php
    $isBoy  = ($student->avatar ?? '') === 'boy_uniform';
    $isGirl = ($student->avatar ?? '') === 'girl_uniform';
    $charName = $isBoy ? 'Juan' : ($isGirl ? 'Maria' : '');
@endphp

{{-- Welcome Banner --}}
<div class="welcome-card">
    <div class="welcome-avatar">
        @if($isBoy)
            <svg viewBox="0 0 140 170" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="70" cy="165" rx="30" ry="4" fill="rgba(0,0,0,0.07)"/>
                <ellipse cx="57" cy="155" rx="11" ry="5" fill="#2c1a0e"/>
                <ellipse cx="83" cy="155" rx="11" ry="5" fill="#2c1a0e"/>
                <rect x="51" y="118" width="14" height="36" rx="4" fill="#2a4080"/>
                <rect x="75" y="118" width="14" height="36" rx="4" fill="#2a4080"/>
                <rect x="47" y="113" width="46" height="8" rx="3" fill="#1a2a50"/>
                <rect x="67" y="113" width="6" height="8" rx="1" fill="#c8a850"/>
                <rect x="44" y="70" width="52" height="46" rx="7" fill="#f0f4ff"/>
                <polygon points="70,73 63,86 70,82 77,86" fill="#dde4ff"/>
                <polygon points="70,76 67,92 70,94 73,92" fill="#c03030"/>
                <circle cx="70" cy="98" r="2" fill="#c0c8e0"/>
                <circle cx="70" cy="107" r="2" fill="#c0c8e0"/>
                <rect x="30" y="72" width="16" height="32" rx="7" fill="#f5c5a0"/>
                <rect x="94" y="72" width="16" height="32" rx="7" fill="#f5c5a0"/>
                <rect x="30" y="96" width="16" height="8" rx="4" fill="#f0f4ff"/>
                <rect x="94" y="96" width="16" height="8" rx="4" fill="#f0f4ff"/>
                <ellipse cx="38" cy="109" rx="8" ry="6" fill="#f5c5a0"/>
                <ellipse cx="102" cy="109" rx="8" ry="6" fill="#f5c5a0"/>
                <rect x="22" y="102" width="18" height="20" rx="3" fill="#4da862"/>
                <rect x="24" y="104" width="14" height="16" rx="2" fill="#6dbf7e"/>
                <line x1="31" y1="104" x2="31" y2="120" stroke="#3a8050" stroke-width="1.5"/>
                <rect x="62" y="57" width="16" height="16" rx="4" fill="#f5c5a0"/>
                <ellipse cx="70" cy="42" rx="27" ry="28" fill="#f5c5a0"/>
                <ellipse cx="70" cy="20" rx="28" ry="14" fill="#3d1f0a"/>
                <rect x="42" y="16" width="9" height="20" rx="5" fill="#3d1f0a"/>
                <rect x="89" y="16" width="9" height="20" rx="5" fill="#3d1f0a"/>
                <ellipse cx="60" cy="44" rx="4.5" ry="5" fill="#fff"/>
                <ellipse cx="80" cy="44" rx="4.5" ry="5" fill="#fff"/>
                <circle cx="61" cy="45" r="2.5" fill="#2c1a0e"/>
                <circle cx="81" cy="45" r="2.5" fill="#2c1a0e"/>
                <circle cx="62" cy="44" r="1" fill="#fff"/>
                <circle cx="82" cy="44" r="1" fill="#fff"/>
                <path d="M55 37 Q60 34 65 37" stroke="#3d1f0a" stroke-width="2" fill="none" stroke-linecap="round"/>
                <path d="M75 37 Q80 34 85 37" stroke="#3d1f0a" stroke-width="2" fill="none" stroke-linecap="round"/>
                <path d="M63 55 Q70 61 77 55" stroke="#c07050" stroke-width="2" fill="none" stroke-linecap="round"/>
                <ellipse cx="55" cy="52" rx="5" ry="4" fill="rgba(255,160,100,0.25)"/>
                <ellipse cx="85" cy="52" rx="5" ry="4" fill="rgba(255,160,100,0.25)"/>
            </svg>
        @elseif($isGirl)
            <svg viewBox="0 0 140 170" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="70" cy="165" rx="30" ry="4" fill="rgba(0,0,0,0.07)"/>
                <ellipse cx="57" cy="156" rx="10" ry="4" fill="#2c1a0e"/>
                <ellipse cx="83" cy="156" rx="10" ry="4" fill="#2c1a0e"/>
                <rect x="51" y="148" width="12" height="8" rx="3" fill="#fff"/>
                <rect x="77" y="148" width="12" height="8" rx="3" fill="#fff"/>
                <path d="M46 110 Q70 128 94 110 L90 153 Q70 163 50 153 Z" fill="#1a3a7a"/>
                <line x1="57" y1="114" x2="53" y2="150" stroke="#142e60" stroke-width="1.5"/>
                <line x1="70" y1="116" x2="70" y2="152" stroke="#142e60" stroke-width="1.5"/>
                <line x1="83" y1="114" x2="87" y2="150" stroke="#142e60" stroke-width="1.5"/>
                <rect x="44" y="66" width="52" height="47" rx="7" fill="#fff5f5"/>
                <polygon points="70,69 63,83 70,79 77,83" fill="#ffd0d0"/>
                <ellipse cx="70" cy="69" rx="7" ry="4" fill="#e83060"/>
                <circle cx="70" cy="88" r="2" fill="#e0c0c0"/>
                <circle cx="70" cy="98" r="2" fill="#e0c0c0"/>
                <rect x="30" y="68" width="16" height="32" rx="7" fill="#f5c5a0"/>
                <rect x="94" y="68" width="16" height="32" rx="7" fill="#f5c5a0"/>
                <rect x="30" y="92" width="16" height="8" rx="4" fill="#fff5f5"/>
                <rect x="94" y="92" width="16" height="8" rx="4" fill="#fff5f5"/>
                <ellipse cx="38" cy="105" rx="8" ry="6" fill="#f5c5a0"/>
                <ellipse cx="102" cy="105" rx="8" ry="6" fill="#f5c5a0"/>
                <rect x="96" y="98" width="18" height="22" rx="3" fill="#e83060"/>
                <rect x="98" y="100" width="14" height="18" rx="2" fill="#ff8090"/>
                <line x1="105" y1="100" x2="105" y2="118" stroke="#e83060" stroke-width="1.5"/>
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
                <circle cx="62" cy="40" r="1" fill="#fff"/>
                <circle cx="82" cy="40" r="1" fill="#fff"/>
                <path d="M55 34 Q57 31 60 33" stroke="#2c1206" stroke-width="1.5" fill="none"/>
                <path d="M75 34 Q77 31 82 33" stroke="#2c1206" stroke-width="1.5" fill="none"/>
                <path d="M55 34 Q60 31 65 34" stroke="#2c1206" stroke-width="2" fill="none" stroke-linecap="round"/>
                <path d="M75 34 Q80 31 85 34" stroke="#2c1206" stroke-width="2" fill="none" stroke-linecap="round"/>
                <path d="M63 51 Q70 57 77 51" stroke="#c07050" stroke-width="2" fill="none" stroke-linecap="round"/>
                <ellipse cx="54" cy="48" rx="6" ry="4" fill="rgba(255,130,130,0.28)"/>
                <ellipse cx="86" cy="48" rx="6" ry="4" fill="rgba(255,130,130,0.28)"/>
            </svg>
        @else
            <div style="font-size:4.5rem;line-height:130px;text-align:center;">🎒</div>
        @endif
    </div>

    <div class="welcome-text">
        <h1>
            @if($charName) Kumusta, {{ $charName }}! @else Kumusta, {{ $student->username }}! @endif
            🌟
        </h1>
        <p>
            @if($charName) ({{ $student->username }}) — @endif
            Handa ka na bang matuto ngayon?
        </p>
        <div class="welcome-badges">
            <span class="w-badge green">📚 Grade 10</span>
            <span class="w-badge orange">
                {{ $student->last_played ? '⏱️ ' . $student->last_played->diffForHumans() : '🆕 Bago!' }}
            </span>
            <span class="w-badge blue">📅 {{ $student->created_at->format('M Y') }}</span>
        </div>
    </div>
</div>

{{-- Info Cards --}}
<div class="info-grid">
    <div class="info-card">
        <div class="lbl">👤 Username</div>
        <div class="val">{{ $student->username }}</div>
    </div>
    <div class="info-card">
        <div class="lbl">⏱️ Huling Nilaro</div>
        <div class="val" style="font-size:1rem;">{{ $student->last_played ? $student->last_played->diffForHumans() : 'Ngayon!' }}</div>
    </div>
    <div class="info-card">
        <div class="lbl">📅 Sumali</div>
        <div class="val" style="font-size:1rem;">{{ $student->created_at->format('M d, Y') }}</div>
    </div>
</div>

{{-- Quick Access --}}
<div class="quick-grid">
    <a href="{{ route('student.classes') }}" class="quick-card">
        <div class="quick-icon qi-green">🏫</div>
        <div>
            <div class="qt">Classes</div>
            <div class="qs">Hanapin at sumali sa klase</div>
        </div>
    </a>
    <a href="{{ route('student.classes') }}" class="quick-card">
        <div class="quick-icon qi-orange">🎮</div>
        <div>
            <div class="qt">Play Quizzes</div>
            <div class="qs">Maglaro ng quiz o pre-test</div>
        </div>
    </a>
    <a href="{{ route('student.profile') }}" class="quick-card">
        <div class="quick-icon qi-teal">👤</div>
        <div>
            <div class="qt">Aking Profile</div>
            <div class="qs">Baguhin ang karakter o username</div>
        </div>
    </a>

    <a href="{{ route('student.map') }}" class="quick-card">
        <div class="quick-icon qi-teal">🗺️</div> <div>
            <div class="qt">DEMO MAP</div>
            <div class="qs">Pumunta sa mapa</div>
        </div>
    </a>
</div>

@endsection
