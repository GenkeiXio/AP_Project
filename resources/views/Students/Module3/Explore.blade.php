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
        background: url('{{ asset('pictures/typhoon_chaos.png') }}') center center / cover no-repeat;
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

    .glass {
        background: rgba(255, 255, 255, 0.86);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.65);
        box-shadow: 0 10px 28px rgba(2, 6, 23, .24);
    }

    .scene { animation: fadeIn .45s ease; }

    .choice-btn {
        transition: .18s ease;
        color: #fff;
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

    .scene-image-wrap {
        background: #e2e8f0;
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

    /* One shared intro card: image + content inside (glass style, no divider) */
    .intro-card {
        --intro-panel-bg: rgba(255, 255, 255, 0.06);
        width: 100%;
        max-width: 1080px;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,.35);
        background: rgba(255,255,255,.14);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        box-shadow: 0 12px 28px rgba(2, 6, 23, .35);
    }

    .intro-card-inner {
        display: grid;
        grid-template-columns: 340px minmax(0, 1fr);
        gap: 0;
        align-items: stretch;
        min-height: 330px;
    }

    .intro-card-image {
        background: var(--intro-panel-bg);
    }

    .intro-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
    }

    .intro-card-content {
        background: var(--intro-panel-bg);
        backdrop-filter: blur(8px);
        padding: 18px 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: #e2e8f0;
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
                <h2 class="text-lg md:text-xl font-extrabold text-red-500 mb-3">⚠️ Paunang Sitwasyon</h2>

                <div class="space-y-3 text-sm md:text-base text-slate-100 leading-relaxed">
                    <p>Isang malakas na bagyo ang paparating sa inyong komunidad. Ayon sa ulat ng PAGASA, posibleng magdulot ito ng matinding pagbaha at landslide.</p>
                    <p>Ikaw ay napili bilang Youth Disaster Leader sa inyong barangay. Nasa iyong mga kamay ang kaligtasan ng iyong pamilya at komunidad.</p>
                    <p class="font-bold text-cyan-300">Handa ka na bang harapin ang sakuna?</p>
                </div>

                <div class="mt-4 flex justify-end">
                    <button id="simulanModalBtn" class="choice-btn px-4 py-2 rounded-xl bg-gradient-to-r from-orange-500 to-amber-400 text-slate-900 font-extrabold text-sm md:text-base">
                        SIMULAN
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="relative z-10 min-h-screen text-slate-900 py-6">
    <div class="max-w-5xl mx-auto px-4">

        <section id="scene2" class="scene hidden rounded-2xl overflow-hidden glass">
            <div class="scene-image-wrap">
                <img src="{{ asset('pictures/flood.png') }}" class="scene-image" alt="Eksena 1">
            </div>
            <div class="p-5 md:p-6">
                <p class="text-cyan-700 font-bold">📍 EKSENA 1: SURIIN ANG KALAGAYAN</p>
                <p class="mt-3 font-bold">Nakatanggap ka ng impormasyon:</p>
                <ul class="list-disc pl-6 mt-2 space-y-1">
                    <li>May signal ng bagyo #3</li>
                    <li>Mataas ang posibilidad ng pagbaha</li>
                    <li>May mga pamilyang nakatira malapit sa ilog</li>
                </ul>
                <p class="mt-3 font-bold italic">💬 Ano ang una mong gagawin?</p>
                <div class="grid md:grid-cols-3 gap-3 mt-3">
                    <button onclick="piliinSaEksena2('A')" class="choice-btn p-3 rounded-xl bg-red-600 font-bold">A. Balewalain ang babala</button>
                    <button onclick="piliinSaEksena2('B')" class="choice-btn p-3 rounded-xl bg-emerald-600 font-bold">B. Makinig sa balita at maghanda</button>
                    <button onclick="piliinSaEksena2('C')" class="choice-btn p-3 rounded-xl bg-blue-600 font-bold">C. Maghintay kung ano ang mangyayari</button>
                </div>
                <div id="scene2Feedback" class="hidden mt-4 p-4 rounded-xl border"></div>
            </div>
        </section>

        <section id="scene3" class="scene hidden mt-6 rounded-2xl overflow-hidden glass">
            <div class="scene-image-wrap">
                <img src="{{ asset('pictures/Emergency_.png') }}" class="scene-image" alt="Eksena 2">
            </div>
            <div class="p-5 md:p-6">
                <p class="text-emerald-700 font-extrabold">✔ Tama! Nagsimula kang maghanda.</p>
                <p class="mt-2 text-slate-700">📍Maghanda ng emergency kit<br>📍I-alert ang pamilya<br>📍Makipag-ugnayan sa barangay<br>👉 +10 XP</p>
                <button onclick="lumipatSaEksena(4)" class="choice-btn mt-4 px-6 py-3 rounded-xl bg-cyan-600 font-bold">Ipagpatuloy ang Misyon →</button>
            </div>
        </section>

        <section id="scene4" class="scene hidden mt-6 rounded-2xl overflow-hidden glass">
            <div class="relative scene-image-wrap">
                <img src="{{ asset('pictures/Rescue.png') }}" class="scene-image" alt="Eksena 3">
                <div class="rain absolute inset-0 opacity-45"></div>
                <p class="absolute bottom-4 left-4 z-10 font-black text-lg md:text-2xl text-white">🌧 EKSENA 3: TUMAMA ANG SAKUNA</p>
            </div>
            <div class="p-5 md:p-6">
                <p class="mt-2 font-bold">💬 Ano ang susunod mong gagawin?</p>
                <div class="grid md:grid-cols-3 gap-3 mt-3">
                    <button onclick="piliinSaEksena4('A')" class="choice-btn p-3 rounded-xl bg-red-600 font-bold">A. Manatili sa bahay kahit baha na</button>
                    <button onclick="piliinSaEksena4('B')" class="choice-btn p-3 rounded-xl bg-emerald-600 font-bold">B. Lumikas sa sentro ng paglikas</button>
                    <button onclick="piliinSaEksena4('C')" class="choice-btn p-3 rounded-xl bg-blue-600 font-bold">C. Maghintay ng rescuer</button>
                </div>
                <div id="scene4Feedback" class="hidden mt-4 p-4 rounded-xl border"></div>
            </div>
        </section>

        <section id="scene5" class="scene hidden mt-6 rounded-2xl overflow-hidden glass">
            <div class="relative scene-image-wrap">
                <img src="{{ asset('pictures/disaster_strike.png') }}" class="scene-image" alt="Eksena 4">
                <div class="absolute inset-0 bg-black/25"></div>
                <p class="absolute bottom-4 left-4 z-10 font-black text-lg md:text-2xl text-white">🌤 EKSENA 4: MATAPOS ANG SAKUNA</p>
            </div>
            <div class="p-5 md:p-6">
                <p class="mt-2 font-bold">💬 Ano ang gagawin mo?</p>
                <div class="grid md:grid-cols-3 gap-3 mt-3">
                    <button onclick="piliinSaEksena5('A')" class="choice-btn p-3 rounded-xl bg-emerald-600 font-bold">A. Tumulong sa paglilinis</button>
                    <button onclick="piliinSaEksena5('B')" class="choice-btn p-3 rounded-xl bg-slate-600 font-bold">B. Manood lamang</button>
                    <button onclick="piliinSaEksena5('C')" class="choice-btn p-3 rounded-xl bg-orange-600 font-bold">C. Umalis agad</button>
                </div>
                <div id="scene5Feedback" class="hidden mt-4 p-4 rounded-xl border"></div>
            </div>
        </section>

        <section id="scene6" class="scene hidden mt-6 rounded-2xl overflow-hidden glass">
            <div class="h-[210px] bg-gradient-to-r from-slate-800 to-sky-900 flex items-center justify-center">
                <p class="font-black text-3xl text-amber-300">🏆 NATAPOS ANG MISYON!</p>
            </div>
            <div class="p-5 md:p-6">
                <p>📊 Iyong Iskor: <span id="finalScore" class="font-bold text-lime-600">0 XP</span></p>
                <p class="mt-2">🎖 Natamong Badge: <span id="finalBadge" class="font-bold text-amber-600">Wala pang badge</span></p>
                <p id="autoRedirectText" class="mt-2 text-sm text-slate-600"></p>

                <div class="mt-4 flex flex-wrap gap-3">
                    <button onclick="ulitinMisyon()" class="choice-btn px-6 py-3 rounded-xl bg-amber-400 text-slate-900 font-bold">🔄 Ulitin ang Laro</button>
                    <a href="{{ route('students.module3.termino_konsepto') }}" class="inline-flex items-center px-6 py-3 rounded-xl bg-cyan-600 text-white font-bold hover:bg-cyan-700 transition">
                        📘 Magpatuloy sa Termino at Konsepto
                    </a>
                </div>
            </div>
        </section>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
let currentScene = 1, xp = 0, streak = 0, soundOn = true, audioUnlocked = false;
let flags = { s2:false, s4:false, s5:false };
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
    if (scene === 4) play('rain');
    if (scene === 5) play('calm');
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
    xp += 10;
    play('start');
    lumipatSaEksena(2);
}

function piliinSaEksena2(c) {
    const box = document.getElementById('scene2Feedback');
    box.classList.remove('hidden');

    if (c === 'B') {
        flags.s2 = true;
        xp += 20;
        play('correct');
        box.className = 'mt-4 p-4 rounded-xl border border-emerald-500 bg-emerald-50';
        box.innerHTML = '🎉 Tama! +20 XP';
        setTimeout(() => lumipatSaEksena(3), 900);
    } else {
        xp = Math.max(0, xp - 5);
        play('wrong');
        box.className = 'mt-4 p-4 rounded-xl border border-red-500 bg-red-50';
        box.innerHTML = '❌ Mali. -5 XP. Subukan muli!';
    }
}

function piliinSaEksena4(c) {
    const box = document.getElementById('scene4Feedback');
    box.classList.remove('hidden');

    if (c === 'B') {
        flags.s4 = true;
        xp += 25;
        play('correct');
        box.className = 'mt-4 p-4 rounded-xl border border-emerald-500 bg-emerald-50';
        box.innerHTML = '🎉 Tama! +25 XP';
    } else {
        xp = Math.max(0, xp - 10);
        play('wrong');
        box.className = 'mt-4 p-4 rounded-xl border border-red-500 bg-red-50';
        box.innerHTML = '🚨 Nahuli ang paglikas! -10 XP';
    }

    setTimeout(() => lumipatSaEksena(5), 1000);
}

function piliinSaEksena5(c) {
    const box = document.getElementById('scene5Feedback');
    box.classList.remove('hidden');

    if (c === 'A') {
        flags.s5 = true;
        xp += 20;
        play('correct');
        box.className = 'mt-4 p-4 rounded-xl border border-emerald-500 bg-emerald-50';
        box.innerHTML = '🎉 Responsableng mamamayan! +20 XP';
    } else {
        play('wrong');
        box.className = 'mt-4 p-4 rounded-xl border border-amber-500 bg-amber-50';
        box.innerHTML = '⚠ Kailangan pa ng mas aktibong pagtulong.';
    }

    setTimeout(taposNa, 900);
}

function taposNa() {
    clearRedirectTimers();

    if (flags.s2 && flags.s4 && flags.s5) xp += 10;
    lumipatSaEksena(6);
    play('success');

    document.getElementById('finalScore').textContent = `${xp} XP`;

    let badge = 'Wala pang badge';
    if (xp >= 80) badge = '🏆 Bayani ng Komunidad';
    else if (xp >= 60) badge = '🏅 Pinuno sa Paghahanda';
    else if (xp >= 40) badge = '🏅 Nakaligtas sa Sakuna';

    document.getElementById('finalBadge').textContent = badge;

    // SAVE HERE
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

    xp = 0;
    streak = 0;
    flags = { s2:false, s4:false, s5:false };

    ['scene2Feedback', 'scene4Feedback', 'scene5Feedback'].forEach(id => {
        const el = document.getElementById(id);
        el.classList.add('hidden');
        el.innerHTML = '';
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