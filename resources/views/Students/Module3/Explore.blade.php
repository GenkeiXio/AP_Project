{{-- filepath: c:\Users\jella\AP Project\AP_Project\resources\views\Students\Module 3\Explore.blade.php --}}
@extends('Students.studentslayout')
@section('title', 'IV. Suriin')

@push('styles')
    <style>
        html, body { background: #0b1220 !important; }

        body {
            position: relative;
            overflow-x: hidden;
        }

        .page-bg {
            position: fixed;
            inset: 0;
            background: url('{{ asset('pictures/mod3_innermap.png') }}') center center / cover no-repeat;
            pointer-events: none;
            z-index: 0;
        }

        .page-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.42);
            pointer-events: none;
            z-index: 1;
        }

        body::before, body::after {
            content: none !important;
            display: none !important;
            background: none !important;
        }

        /* WOOD THEME STYLES - Applied to cards only */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Nunito:wght@700;800&display=swap');

        :root {
            --vintage-leather: #2b1b17;
            --gold-trim: #c5a059;
            --old-paper: #d9c5a3;
            --ink: #1a1a1a;
            --danger: #b71c1c;
        }

        .glass {
            background: #d9c5a3 !important;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png') !important;
            backdrop-filter: none !important;
            border: 2px solid #c5a059 !important;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.9), inset 0 0 50px rgba(0, 0, 0, 0.2) !important;
            border-radius: 8px !important;
        }

        .scene {
            animation: fadeIn .45s ease;
            background: #d9c5a3 !important;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png') !important;
            border: 2px solid #c5a059 !important;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.9), inset 0 0 50px rgba(0, 0, 0, 0.2) !important;
        }

        /* Intro card wood styling */
        .intro-card {
            --intro-panel-bg: #d9c5a3;
            width: 100%;
            max-width: 1080px;
            border-radius: 8px;
            overflow: hidden;
            border: 2px solid #c5a059;
            background: #d9c5a3;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.9), inset 0 0 50px rgba(0, 0, 0, 0.2);
        }

        .intro-card-inner {
            display: grid;
            grid-template-columns: 340px minmax(0, 1fr);
            gap: 0;
            align-items: stretch;
            min-height: 330px;
        }

        .intro-card-image {
            background: #c9b58a;
        }

        .intro-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }

        .intro-card-content {
            background: #d9c5a3;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
            padding: 18px 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #1a1a1a;
        }

        .intro-card-content h2 {
            color: #b71c1c;
        }

        .intro-card-content p {
            color: #1a1a1a;
        }

        .scene-image-wrap {
            background: #c9b58a;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .scene-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }

        .choice-btn {
            transition: .18s ease;
            font-family: 'Nunito', sans-serif;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .choice-btn.text-slate-900 { color: #0f172a !important; }

        .choice-btn:hover {
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 10px 20px rgba(15, 23, 42, .28);
        }

        .rain {
            background-image: repeating-linear-gradient(
                105deg,
                rgba(255,255,255,.24) 0 2px,
                transparent 2px 11px
            );
            animation: rainMove 1.05s linear infinite;
        }

        #scene2, #scene3, #scene4, #scene5, #scene6 {
            max-width: 820px;
            margin-left: auto;
            margin-right: auto;
        }

        #scene2 .scene-image-wrap,
        #scene3 .scene-image-wrap,
        #scene4 .scene-image-wrap,
        #scene5 .scene-image-wrap {
            width: 100%;
            height: clamp(200px, 42vw, 420px);
        }

        .storm-top { background: linear-gradient(135deg, #334155, #0f172a); }

        /* Text color overrides for wood theme */
        .scene .p-5,
        .scene .p-5 p,
        .scene .p-5 .font-bold,
        .scene .p-5 .text-slate-700,
        .scene .p-5 .text-cyan-700,
        .scene .p-5 .text-emerald-700 {
            color: #1a1a1a !important;
        }

        .scene .list-disc {
            color: #1a1a1a;
        }

        .scene-description {
            margin-top: 12px;
            line-height: 1.6;
            color: #1a1a1a;
        }

        @media (max-width: 900px) {
            .intro-card { max-width: 640px; }

            .intro-card-inner {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .intro-card-image img {
                min-height: 210px;
                max-height: 260px;
            }

            .intro-card-content {
                padding: 16px;
            }
        }

        @keyframes rainMove {
            from { background-position: 0 0 }
            to { background-position: -220px 240px }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px) }
            to { opacity: 1; transform: translateY(0) }
        }
    </style>
@endpush

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<div class="page-bg"></div>
<div class="page-overlay"></div>

<div id="panimulangModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/70 px-4 py-6 overflow-y-auto">
    <div class="intro-card">
        <div class="intro-card-inner">
            <div class="intro-card-image">
                <img src="{{ asset('pictures/Youth disaster leader in action.png') }}" alt="Youth disaster leader in action">
            </div>

            <div class="intro-card-content">
                <h2 class="text-lg md:text-xl font-extrabold text-red-600 mb-3 uppercase">⚠️ Paunang Sitwasyon</h2>

                <div class="space-y-3 text-sm md:text-base leading-relaxed">
                    <p>Isang malakas na bagyo ang paparating sa inyong komunidad. Ayon sa ulat ng PAGASA, posibleng magdulot ito ng matinding pagbaha at landslide.</p>
                    <p>Ikaw ay napili bilang Youth Disaster Leader sa inyong barangay. Nasa iyong mga kamay ang kaligtasan ng iyong pamilya at komunidad.</p>
                    <p class="font-bold text-amber-700">Handa ka na bang harapin ang sakuna?</p>
                </div>

                <div class="mt-4 flex justify-end">
                    <button id="simulanModalBtn" class="choice-btn px-4 py-2 rounded-xl bg-gradient-to-r from-amber-600 to-amber-500 text-white font-extrabold text-sm md:text-base shadow-md">
                        SIMULAN
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="relative z-10 min-h-screen py-6">
    <div class="max-w-5xl mx-auto px-4">

        <!-- SCENE 2: EKSENA 1 (PAGHAHANDA) - PARAGRAPH MODE -->
        <section id="scene2" class="scene hidden rounded-xl overflow-hidden">
            <div class="scene-image-wrap">
                <img src="{{ asset('pictures/flood.png') }}" class="scene-image" alt="Eksena 1">
            </div>
            <div class="p-5 md:p-6">
                <p class="font-bold text-red-700">📍 EKSENA 1: PAGHAHANDA</p>
                <p class="mt-3 font-bold">Nakatanggap ka ng impormasyon mula sa PAGASA:</p>
                <p class="scene-description">May signal ng bagyo #3. Mataas ang posibilidad ng pagbaha sa inyong lugar. May mga pamilyang nakatira malapit sa ilog na nasa panganib.</p>
                <p class="mt-3 font-bold italic">💬 Ano ang una mong gagawin?</p>
                <div class="grid md:grid-cols-3 gap-3 mt-3">
                    <button onclick="piliinSaEksena2('A')" class="choice-btn p-3 rounded-xl bg-red-700 text-white font-bold shadow-md">A. Balewalain ang babala</button>
                    <button onclick="piliinSaEksena2('B')" class="choice-btn p-3 rounded-xl bg-emerald-700 text-white font-bold shadow-md">B. Makinig sa balita at maghanda</button>
                    <button onclick="piliinSaEksena2('C')" class="choice-btn p-3 rounded-xl bg-blue-700 text-white font-bold shadow-md">C. Maghintay kung ano ang mangyayari</button>
                </div>
                <div id="scene2Feedback" class="hidden mt-4 p-4 rounded-xl border"></div>
            </div>
        </section>

        <!-- SCENE 3: EKSENA 2 (PAGTUGON) - PARAGRAPH MODE -->
        <section id="scene3" class="scene hidden mt-6 rounded-xl overflow-hidden">
            <div class="scene-image-wrap">
                <img src="{{ asset('pictures/Rescue.png') }}" class="scene-image" alt="Eksena 2">
            </div>
            <div class="p-5 md:p-6">
                <p class="font-bold text-red-700">📍 EKSENA 2: PAGTUGON</p>
                <p class="mt-3 font-bold">Tumama na ang bagyo. Narito ang sitwasyon:</p>
                <p class="scene-description">Patuloy ang malakas na ulan at hangin. Mabilis na tumataas ang tubig baha sa inyong lugar. Ang evacuation center ay ligtas at may sapat na suplay, ngunit may mga naiwan pang matatanda at batang hindi agad nailikas dahil sa biglaang pagtaas ng baha.</p>
                <p class="mt-3 font-bold italic">💬 Ano ang gagawin mo?</p>
                <div class="grid md:grid-cols-3 gap-3 mt-3">
                    <button onclick="piliinSaEksena3('A')" class="choice-btn p-3 rounded-xl bg-red-700 text-white font-bold shadow-md">A. Manatili sa evacuation center</button>
                    <button onclick="piliinSaEksena3('B')" class="choice-btn p-3 rounded-xl bg-emerald-700 text-white font-bold shadow-md">B. Tumulong sa pagsagip sa mga naiwan</button>
                    <button onclick="piliinSaEksena3('C')" class="choice-btn p-3 rounded-xl bg-blue-700 text-white font-bold shadow-md">C. Maghintay ng utos mula sa barangay</button>
                </div>
                <div id="scene3Feedback" class="hidden mt-4 p-4 rounded-xl border"></div>
            </div>
        </section>

        <!-- SCENE 4: EKSENA 3 (PAGBANGON) - PARAGRAPH MODE -->
        <section id="scene4" class="scene hidden mt-6 rounded-xl overflow-hidden">
            <div class="relative scene-image-wrap">
                <img src="{{ asset('pictures/disaster_strike.png') }}" class="scene-image" alt="Eksena 3">
                <div class="absolute inset-0 bg-black/25"></div>
                <p class="absolute bottom-4 left-4 z-10 font-black text-lg md:text-2xl text-white drop-shadow-lg">🌤 MATAPOS ANG SAKUNA</p>
            </div>
            <div class="p-5 md:p-6">
                <p class="font-bold text-red-700">📍 EKSENA 3: PAGBANGON</p>
                <p class="mt-3 font-bold">Humupa na ang bagyo. Narito ang sitwasyon:</p>
                <p class="scene-description">Unti-unting bumababa ang baha ngunit maraming bahay ang nasira at nangangailangan ng tulong. Kulang ang pagkain at inuming tubig sa evacuation center. Maraming boluntaryo ang gustong tumulong sa paglilinis at pamamahagi ng tulong.</p>
                <p class="mt-3 font-bold italic">💬 Ano ang gagawin mo?</p>
                <div class="grid md:grid-cols-3 gap-3 mt-3">
                    <button onclick="piliinSaEksena4('A')" class="choice-btn p-3 rounded-xl bg-emerald-700 text-white font-bold shadow-md">A. Manguna sa pagtulong</button>
                    <button onclick="piliinSaEksena4('B')" class="choice-btn p-3 rounded-xl bg-red-700 text-white font-bold shadow-md">B. Umuwi na lamang</button>
                    <button onclick="piliinSaEksena4('C')" class="choice-btn p-3 rounded-xl bg-orange-700 text-white font-bold shadow-md">C. Hintaying may mag-utos</button>
                </div>
                <div id="scene4Feedback" class="hidden mt-4 p-4 rounded-xl border"></div>
            </div>
        </section>

        <!-- SCENE 5: RESULT -->
        <section id="scene5" class="scene hidden mt-6 rounded-xl overflow-hidden">
            <div class="h-[210px] bg-gradient-to-r from-amber-700 to-amber-500 flex items-center justify-center">
                <p class="font-black text-3xl text-white drop-shadow-lg">🏆 NATAPOS ANG MISYON!</p>
            </div>
            <div class="p-5 md:p-6">
                <p>📊 Iyong Iskor: <span id="finalScore" class="font-bold text-emerald-700">0 XP</span></p>
                <p class="mt-2">🎖 Natamong Badge: <span id="finalBadge" class="font-bold text-amber-700">Wala pang badge</span></p>
                <p id="autoRedirectText" class="mt-2 text-sm text-slate-700"></p>

                <div class="mt-4 flex flex-wrap gap-3">
                    <button onclick="ulitinMisyon()" class="choice-btn px-6 py-3 rounded-xl bg-amber-600 text-white font-bold shadow-md">🔄 Ulitin ang Laro</button>
                    <a href="{{ route('students.module3.termino_konsepto') }}" class="inline-flex items-center px-6 py-3 rounded-xl bg-emerald-700 text-white font-bold hover:bg-emerald-800 transition shadow-md">
                        📘 Magpatuloy sa Termino at Konsepto
                    </a>
                </div>
            </div>
        </section>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
let currentScene = 1, xp = 10, soundOn = true, audioUnlocked = false;
let flags = { s2:false, s3:false, s4:false };
let redirectTimer = null;
let countdownTimer = null;

const sfx = {
    click: new Audio('{{ asset("sounds/module3/click.mp3") }}'),
    correct: new Audio('{{ asset("sounds/module3/correct.mp3") }}'),
    wrong: new Audio('{{ asset("sounds/module3/wrong.mp3") }}'),
    start: new Audio('{{ asset("sounds/module3/start.mp3") }}'),
    success: new Audio('{{ asset("sounds/module3/success.mp3") }}'),
    rain: new Audio('{{ asset("sounds/module3/rain.mp3") }}'),
    calm: new Audio('{{ asset("sounds/module3/calm.mp3") }}')
};

Object.values(sfx).forEach(a => {
    a.preload = 'auto';
    a.volume = 0.55;
    a.setAttribute('playsinline', 'true');
});
sfx.rain.loop = true;
sfx.calm.loop = true;
sfx.rain.volume = 0.22;
sfx.calm.volume = 0.22;

async function unlockAudio() {
    if (audioUnlocked) return;
    try {
        const tasks = Object.values(sfx).map(async a => {
            const old = a.volume;
            a.volume = 0;
            await a.play();
            a.pause();
            a.currentTime = 0;
            a.volume = old;
        });
        await Promise.all(tasks);
        audioUnlocked = true;
    } catch (_) {
        audioUnlocked = false;
    }
}

function play(name) {
    if (!soundOn || !audioUnlocked || !sfx[name]) return;
    try {
        sfx[name].currentTime = 0;
        sfx[name].play().catch(() => {});
    } catch (_) {}
}

function stopAmbience() {
    try {
        sfx.rain.pause(); sfx.rain.currentTime = 0;
        sfx.calm.pause(); sfx.calm.currentTime = 0;
    } catch (_) {}
}

function playAmbience(scene) {
    if (!soundOn || !audioUnlocked) return;
    stopAmbience();
    if (scene === 3) play('rain');
    if (scene === 4) play('calm');
}

function clearRedirectTimers() {
    if (redirectTimer) clearTimeout(redirectTimer);
    if (countdownTimer) clearInterval(countdownTimer);
    redirectTimer = null;
    countdownTimer = null;
    const label = document.getElementById('autoRedirectText');
    if (label) label.textContent = '';
}

function lumipatSaEksena(n) {
    currentScene = n;
    document.querySelectorAll('.scene').forEach(s => s.classList.add('hidden'));
    const target = document.getElementById(`scene${n}`);
    if (target) target.classList.remove('hidden');
    playAmbience(n);
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function simulanMisyon() {
    play('start');
    lumipatSaEksena(2);
}

// EKSENA 1
function piliinSaEksena2(c) {
    const box = document.getElementById('scene2Feedback');
    box.classList.remove('hidden');

    if (c === 'B') {
        flags.s2 = true;
        xp += 20;
        play('correct');
        box.className = 'mt-4 p-4 rounded-xl border border-emerald-600 bg-emerald-100 text-emerald-800';
        box.innerHTML = '🎉 Tama! +20 XP';
        setTimeout(() => lumipatSaEksena(3), 900);
    } else {
        xp = Math.max(0, xp - 5);
        play('wrong');
        box.className = 'mt-4 p-4 rounded-xl border border-red-600 bg-red-100 text-red-800';
        box.innerHTML = '❌ Mali. -5 XP. Subukan muli!';
    }
}

// EKSENA 2
function piliinSaEksena3(c) {
    const box = document.getElementById('scene3Feedback');
    box.classList.remove('hidden');

    if (c === 'B') {
        flags.s3 = true;
        xp += 25;
        play('correct');
        box.className = 'mt-4 p-4 rounded-xl border border-emerald-600 bg-emerald-100 text-emerald-800';
        box.innerHTML = '🎉 Tama! +25 XP';
        setTimeout(() => lumipatSaEksena(4), 1000);
    } else {
        xp = Math.max(0, xp - 10);
        play('wrong');
        box.className = 'mt-4 p-4 rounded-xl border border-red-600 bg-red-100 text-red-800';
        if (c === 'A') {
            box.innerHTML = '❌ Mali. Hindi dapat manatili lamang kung may mga nangangailangan ng tulong. -10 XP';
        } else {
            box.innerHTML = '❌ Mali. Bilang lider, kailangan mong kumilos at huwag lamang maghintay. -10 XP';
        }
    }
}

// EKSENA 3
function piliinSaEksena4(c) {
    const box = document.getElementById('scene4Feedback');
    box.classList.remove('hidden');

    if (c === 'A') {
        flags.s4 = true;
        xp += 25;
        play('correct');
        box.className = 'mt-4 p-4 rounded-xl border border-emerald-600 bg-emerald-100 text-emerald-800';
        box.innerHTML = '🎉 Tama! +25 XP';
    } else {
        xp = Math.max(0, xp - 10);
        play('wrong');
        box.className = 'mt-4 p-4 rounded-xl border border-red-600 bg-red-100 text-red-800';
        if (c === 'B') {
            box.innerHTML = '❌ Mali. Hindi dapat iwanan ang komunidad sa oras ng pangangailangan. -10 XP';
        } else {
            box.innerHTML = '❌ Mali. Huwag hintayang may mag-utos bago tumulong. -10 XP';
        }
    }

    setTimeout(taposNa, 1200);
}

function taposNa() {
    clearRedirectTimers();

    if (flags.s2 && flags.s3 && flags.s4) xp += 15;
    lumipatSaEksena(5);
    play('success');

    document.getElementById('finalScore').textContent = `${xp} XP`;

    let badge = 'Wala pang badge';
    if (xp >= 90) badge = '🏆 Bayani ng Komunidad';
    else if (xp >= 70) badge = '🏅 Pinuno sa Paghahanda';
    else if (xp >= 50) badge = '🏅 Nakaligtas sa Sakuna';

    document.getElementById('finalBadge').textContent = badge;

    saveExplore(xp, badge);

    const nextUrl = '{{ route("students.module3.termino_konsepto") }}';
    let seconds = 3;
    const label = document.getElementById('autoRedirectText');
    if (label) label.textContent = `Awtomatikong lilipat sa Termino at Konsepto sa ${seconds}s...`;

    countdownTimer = setInterval(() => {
        seconds--;
        if (seconds <= 0) {
            clearInterval(countdownTimer);
            countdownTimer = null;
            return;
        }
        if (label) label.textContent = `Awtomatikong lilipat sa Termino at Konsepto sa ${seconds}s...`;
    }, 1000);

    redirectTimer = setTimeout(() => {
        window.location.href = nextUrl;
    }, 3000);
}

function ulitinMisyon() {
    clearRedirectTimers();

    xp = 10;
    flags = { s2:false, s3:false, s4:false };

    ['scene2Feedback', 'scene3Feedback', 'scene4Feedback'].forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.classList.add('hidden');
            el.innerHTML = '';
        }
    });

    stopAmbience();
    currentScene = 1;
    document.querySelectorAll('.scene').forEach(s => s.classList.add('hidden'));
    buksanPanimulangModal();
}

function buksanPanimulangModal() {
    const modal = document.getElementById('panimulangModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function isaraPanimulangModal() {
    const modal = document.getElementById('panimulangModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
}

document.getElementById('simulanModalBtn').addEventListener('click', async () => {
    await unlockAudio();
    play('click');
    isaraPanimulangModal();
    simulanMisyon();
});

function saveExplore(xp, badge) {
    fetch("{{ route('student.module3.explore.save') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            xp: xp,
            badge: badge
        })
    })
    .then(res => res.json())
    .then(data => console.log("Explore Saved:", data))
    .catch(err => console.error(err));
}

buksanPanimulangModal();
</script>
@endsection