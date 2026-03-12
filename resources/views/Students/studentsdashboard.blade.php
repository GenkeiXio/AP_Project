@extends('Students.studentslayout')

@section('title', 'Aking Dashboard')

@push('styles')
<style>
    .welcome-card {
        background: rgba(255,255,255,0.85);
        backdrop-filter: blur(12px);
        border-radius: 22px;
        padding: 36px 40px;
        box-shadow: 0 8px 40px rgba(80,50,10,0.12);
        text-align: center;
        margin-bottom: 28px;
        border: 1.5px solid rgba(255,255,255,0.7);
        animation: slideUp 0.5s cubic-bezier(.22,1,.36,1) both;
    }
    @keyframes slideUp { from { opacity:0; transform: translateY(24px); } to { opacity:1; transform: translateY(0); } }

    .welcome-card .avatar-big { font-size: 5rem; margin-bottom: 12px; display: block; }
    .welcome-card h1 { font-family: 'Baloo 2', cursive; font-size: 2rem; font-weight: 800; color: #3d2a1a; }
    .welcome-card .sub { color: #9a8060; font-size: 0.95rem; margin-top: 6px; }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 18px;
        margin-bottom: 28px;
    }

    .info-card {
        background: rgba(255,255,255,0.82);
        border-radius: 16px;
        padding: 22px 24px;
        box-shadow: 0 4px 16px rgba(80,50,10,0.08);
        border: 1.5px solid rgba(255,255,255,0.6);
        animation: slideUp 0.5s cubic-bezier(.22,1,.36,1) both;
    }
    .info-card:nth-child(2) { animation-delay: 0.1s; }
    .info-card:nth-child(3) { animation-delay: 0.2s; }

    .info-card .label { font-size: 0.78rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; color: #b5a48a; margin-bottom: 6px; }
    .info-card .value { font-family: 'Baloo 2', cursive; font-size: 1.3rem; font-weight: 700; color: #3d2a1a; }

    .avatar-section {
        background: rgba(255,255,255,0.82);
        border-radius: 22px;
        padding: 28px;
        box-shadow: 0 4px 20px rgba(80,50,10,0.08);
        border: 1.5px solid rgba(255,255,255,0.6);
    }
    .avatar-section h2 { font-family: 'Baloo 2', cursive; font-size: 1.2rem; font-weight: 800; color: #3d2a1a; margin-bottom: 18px; }

    .avatar-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; }

    .avatar-option {
        border: 2.5px solid #e8dcc8;
        border-radius: 16px;
        padding: 18px 10px;
        text-align: center;
        cursor: pointer;
        transition: border-color 0.2s, transform 0.2s, box-shadow 0.2s;
        background: #fff;
    }
    .avatar-option:hover { border-color: #6dbf7e; transform: translateY(-3px); box-shadow: 0 6px 20px rgba(109,191,126,0.2); }
    .avatar-option.selected { border-color: #6dbf7e; background: #f0faf3; box-shadow: 0 4px 14px rgba(109,191,126,0.25); }

    .avatar-option .emo  { font-size: 2.5rem; display: block; margin-bottom: 8px; }
    .avatar-option .name { font-size: 0.78rem; font-weight: 700; color: #5a4030; }

    .btn-save {
        margin-top: 20px;
        padding: 13px 32px;
        background: linear-gradient(135deg, #6dbf7e, #4da862);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-family: 'Baloo 2', cursive;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 16px rgba(77,168,98,0.3);
    }
    .btn-save:hover { transform: translateY(-2px); box-shadow: 0 7px 22px rgba(77,168,98,0.38); }

    .save-msg { display: none; margin-top: 10px; font-size: 0.88rem; font-weight: 700; color: #1e7a3a; }
    .save-msg.show { display: block; }
</style>
@endpush

@section('content')

<div class="welcome-card">
    @php
        $avatarIcons = [
            'explorer_boy'  => '🧭',
            'explorer_girl' => '🗺️',
            'scientist'     => '🔬',
            'adventurer'    => '⚔️',
        ];
        $icon = $avatarIcons[$student->avatar ?? ''] ?? '🎒';
    @endphp
    <span class="avatar-big">{{ $icon }}</span>
    <h1>Kumusta, {{ $student->username }}! 🌟</h1>
    <p class="sub">Handa ka na bang magsimula ng iyong pakikipagsapalaran sa Araling Panlipunan?</p>
</div>

<div class="info-grid">
    <div class="info-card">
        <div class="label">📛 Username</div>
        <div class="value">{{ $student->username }}</div>
    </div>
    <div class="info-card">
        <div class="label">⏱️ Huling Nilaro</div>
        <div class="value">{{ $student->last_played ? $student->last_played->diffForHumans() : 'Ngayon!' }}</div>
    </div>
    <div class="info-card">
        <div class="label">📅 Sumali</div>
        <div class="value">{{ $student->created_at->format('M d, Y') }}</div>
    </div>
</div>

<div class="avatar-section">
    <h2>🎭 Piliin ang iyong Avatar</h2>
    <div class="avatar-grid">
        @php
            $avatars = [
                'explorer_boy'  => ['icon' => '🧭', 'name' => 'Explorer Boy'],
                'explorer_girl' => ['icon' => '🗺️', 'name' => 'Explorer Girl'],
                'scientist'     => ['icon' => '🔬', 'name' => 'Scientist'],
                'adventurer'    => ['icon' => '⚔️', 'name' => 'Adventurer'],
            ];
        @endphp
        @foreach($avatars as $key => $av)
            <div class="avatar-option {{ $student->avatar === $key ? 'selected' : '' }}" onclick="selectAvatar('{{ $key }}', this)">
                <span class="emo">{{ $av['icon'] }}</span>
                <div class="name">{{ $av['name'] }}</div>
            </div>
        @endforeach
    </div>

    <button class="btn-save" onclick="saveAvatar()">💾 I-save ang Avatar</button>
    <div class="save-msg" id="saveMsg">✅ Na-save na ang iyong avatar!</div>
</div>

@endsection

@push('scripts')
<script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;
    let selectedAvatar = '{{ $student->avatar ?? "" }}';

    function selectAvatar(key, el) {
        document.querySelectorAll('.avatar-option').forEach(o => o.classList.remove('selected'));
        el.classList.add('selected');
        selectedAvatar = key;
    }

    async function saveAvatar() {
        if (!selectedAvatar) return;
        try {
            const res = await fetch('/student/avatar', {
                method:  'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
                body:    JSON.stringify({ avatar: selectedAvatar }),
            });
            const data = await res.json();
            if (data.success) {
                const msg = document.getElementById('saveMsg');
                msg.classList.add('show');
                setTimeout(() => msg.classList.remove('show'), 3000);
            }
        } catch(e) {}
    }
</script>
@endpush
