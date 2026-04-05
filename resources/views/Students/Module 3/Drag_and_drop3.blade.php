{{-- filepath: c:\Users\jella\AP Project\AP_Project\resources\views\Students\Module 3\Drag_and_drop3.blade.php --}}
@extends('Students.studentslayout')
@section('title', 'Balik-Aral Modyul 3')

@push('styles')
<style>
:root{
    --bg1:#0b1710;
    --bg2:#12261b;
    --kard:rgba(255,255,255,.08);
    --linya:rgba(255,255,255,.15);
    --teksto:#edf7f0;
    --maputla:#b9cdbf;
    --tama:#41c171;
    --mali:#ff7f7f;
    --anino:0 14px 30px rgba(0,0,0,.22);
    --radius:16px;
}
*{box-sizing:border-box}
html,body{
    margin:0;padding:0;min-height:100%;
    color:var(--teksto);
    background:
      radial-gradient(circle at 12% 0%, rgba(65,193,113,.14), transparent 25%),
      linear-gradient(145deg,var(--bg1),var(--bg2));
}
body{overflow-x:hidden}
.lalagyan{max-width:1140px;margin:18px auto;padding:0 14px 24px}
.kahon{
    background:var(--kard);
    border:1px solid var(--linya);
    border-radius:var(--radius);
    box-shadow:var(--anino);
    backdrop-filter:blur(8px);
    -webkit-backdrop-filter:blur(8px);
}
.ulo{padding:16px}
.tatak{
    display:inline-flex;gap:8px;align-items:center;
    padding:7px 11px;border-radius:999px;
    font-size:.8rem;font-weight:900;
    border:1px solid rgba(65,193,113,.35);
    background:rgba(65,193,113,.15);
}
.pamagat{margin:10px 0 6px;font-size:clamp(1.3rem,3vw,2.1rem);font-weight:900;line-height:1.15}
.sub{margin:0;color:var(--maputla);line-height:1.55}
.hanay{margin-top:12px;display:flex;gap:8px;flex-wrap:wrap}
.pildoras{
    padding:7px 11px;border-radius:999px;font-weight:800;font-size:.9rem;
    background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);
}
.btns{margin-top:12px;display:flex;gap:8px;flex-wrap:wrap}
.btn{
    border:none;border-radius:12px;padding:10px 14px;font-weight:900;cursor:pointer;
    text-decoration:none;display:inline-flex;align-items:center;justify-content:center;gap:7px;
}
.btn-abo{background:rgba(255,255,255,.09);color:var(--teksto);border:1px solid rgba(255,255,255,.15)}
.btn-berde{background:linear-gradient(180deg,#95f2ab,#4ccf73);color:#0f2a1a}
.btn[disabled]{opacity:.55;cursor:not-allowed}

.panel{margin-top:12px;padding:14px}
.titulo{
    margin:0 0 10px;font-size:.98rem;font-weight:900;
    display:flex;gap:8px;align-items:center
}
.titulo::before{
    content:"";width:8px;height:8px;border-radius:999px;background:var(--tama);
    box-shadow:0 0 0 4px rgba(65,193,113,.12);
}
.grid3{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:10px}

.kard-drag{
    border-radius:14px;border:1px solid rgba(255,255,255,.16);
    background:rgba(255,255,255,.07);overflow:hidden;cursor:grab;
    transition:.15s ease;display:flex;flex-direction:column
}
.kard-drag:hover{transform:translateY(-2px);border-color:rgba(65,193,113,.45)}
.kard-drag.dragging{opacity:.55;transform:scale(.985)}
.kard-drag.locked{cursor:default;opacity:.96}
.larawan{width:100%;height:116px;object-fit:cover;display:block;border-bottom:1px solid rgba(255,255,255,.1)}
.katawan{padding:10px 11px}
.pangalan{font-weight:900;font-size:.95rem}
.paliwanag{margin-top:4px;color:var(--maputla);font-size:.86rem;line-height:1.45}
.tatak2{
    margin-top:8px;display:inline-flex;font-size:.76rem;font-weight:800;
    padding:5px 9px;border-radius:999px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12)
}

.zona{
    border-radius:14px;border:1px solid rgba(255,255,255,.16);
    background:rgba(255,255,255,.06);padding:10px;min-height:220px;
    display:flex;flex-direction:column;gap:8px;transition:.15s ease
}
.zona.over{border-color:rgba(65,193,113,.6);box-shadow:0 0 0 3px rgba(65,193,113,.12)}
.zona.tama{border-color:rgba(65,193,113,.55);background:rgba(65,193,113,.08)}
.zona-ulo{display:flex;justify-content:space-between;gap:8px}
.zona-pangalan{font-weight:900;font-size:.92rem;line-height:1.35}
.zona-kalagay{
    font-size:.73rem;font-weight:900;padding:4px 8px;border-radius:999px;
    color:#fff5cf;background:rgba(255,212,106,.14);border:1px solid rgba(255,212,106,.24)
}
.zona-katawan{
    flex:1;border:1px dashed rgba(255,255,255,.2);border-radius:12px;
    display:flex;align-items:center;justify-content:center;text-align:center;
    padding:8px;color:#9eb6a7;font-weight:800;font-size:.86rem
}
.zona-katawan.puno{border-style:solid;border-color:rgba(65,193,113,.30)}

.gabay{
    margin-top:10px;padding:10px 12px;border-radius:12px;
    background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);
    font-weight:800;line-height:1.45
}
.mensahe-mali{color:#ffd2d2}
.mensahe-tama{color:#d9ffe7}

.resulta{margin-top:12px;padding:14px}
.resulta-ulo{display:grid;grid-template-columns:64px 1fr;gap:10px;align-items:center}
.puntos-bilog{
    width:64px;height:64px;border-radius:14px;display:grid;place-items:center;
    font-weight:900;font-size:1.25rem;background:rgba(65,193,113,.16);border:1px solid rgba(65,193,113,.3)
}
.resulta-pamagat{font-weight:900}
.resulta-talata{color:var(--maputla);line-height:1.5}
.stats{margin-top:10px;display:flex;gap:8px;flex-wrap:wrap}
.stat{
    padding:7px 11px;border-radius:999px;font-weight:800;font-size:.88rem;
    background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12)
}
.susi{margin-top:10px;display:grid;gap:7px}
.susi-item{
    border-radius:10px;padding:8px 10px;background:rgba(255,255,255,.07);
    border:1px solid rgba(255,255,255,.11);font-size:.9rem;line-height:1.45
}
.nakatago{display:none !important}
.alog{animation:alog .28s ease}
@keyframes alog{0%,100%{transform:translateX(0)}25%{transform:translateX(-6px)}75%{transform:translateX(6px)}}

@media (max-width:980px){
    .grid3{grid-template-columns:1fr}
    .zona{min-height:168px}
    .larawan{height:136px}
}
</style>
@endpush

@section('content')
<div class="lalagyan">
    <section class="kahon ulo">
        <div class="tatak"><span></span><span>BALIK-ARAL</span></div>
        <h1 class="pamagat">Iugnay Mo Ako!</h1>
        <p class="sub">Gabay na tanong: “Paano nagiging sanhi ng sakuna ang mga suliraning pangkapaligiran?”</p>

        <div class="hanay">
            <div class="pildoras">⏱️ Oras: <span id="orasTeksto">30</span>s</div>
            <div class="pildoras">🎯 Layunin: 3 tamang tugma</div>
        </div>

        <div class="btns">
            <button class="btn btn-abo" id="resetBtn" type="button">🔁 Magsimulang muli</button>
            <a class="btn btn-abo" href="{{ route('module3.home') }}">← Bumalik</a>
        </div>

        <div class="gabay" id="gabayTeksto">
            I-drag ang bawat larawan papunta sa tamang epekto.
        </div>
    </section>

    <section class="kahon panel">
        <h3 class="titulo">Mga I-drag na Item</h3>
        <div class="grid3" id="cardsRoot">
            <article class="kard-drag" draggable="true" data-id="solid" data-tag="♻️ Suliraning pangkapaligiran">
                <img class="larawan" src="{{ asset('pictures/solidwaste.png') }}" alt="Basurang Solido">
                <div class="katawan">
                  
                    <div class="paliwanag">Hindi tamang pagtatapon ng basura sa komunidad.</div>
                    <div class="tatak2">♻️ Suliraning pangkapaligiran</div>
                </div>
            </article>

            <article class="kard-drag" draggable="true" data-id="forest" data-tag="🌳 Suliraning pangkapaligiran">
                <img class="larawan" src="{{ asset('pictures/deforestation.png') }}" alt="Pagkakalbo ng Kagubatan">
                <div class="katawan">
                    
                    <div class="paliwanag">Pagkawala ng mga punong kumakapit sa lupa.</div>
                    <div class="tatak2">🌳 Suliraning pangkapaligiran</div>
                </div>
            </article>

            <article class="kard-drag" draggable="true" data-id="climate" data-tag="🌍 Suliraning pangkapaligiran">
                <img class="larawan" src="{{ asset('pictures/climate.png') }}" alt="Pagbabago ng Klima">
                <div class="katawan">
                    
                    <div class="paliwanag">Pag-init ng mundo at mas matitinding panahon.</div>
                    <div class="tatak2">🌍 Suliraning pangkapaligiran</div>
                </div>
            </article>
        </div>
    </section>

    <section class="kahon panel">
        <h3 class="titulo">Mga Paglalagyan ng Epekto</h3>
        <div class="grid3">
            <div class="zona" data-zone="flood">
                <div class="zona-ulo">
                    <div class="zona-pangalan">Pagbaha at paglaganap ng sakit</div>
                    <div class="zona-kalagay" id="kalagayan-flood">Hintay...</div>
                </div>
                <div class="zona-katawan">I-drop ang tamang item dito</div>
            </div>

            <div class="zona" data-zone="landslide">
                <div class="zona-ulo">
                    <div class="zona-pangalan">Pagguho ng lupa at pagbaha</div>
                    <div class="zona-kalagay" id="kalagayan-landslide">Hintay...</div>
                </div>
                <div class="zona-katawan">I-drop ang tamang item dito</div>
            </div>

            <div class="zona" data-zone="storm">
                <div class="zona-ulo">
                    <div class="zona-pangalan">Mas malalakas na bagyo at matinding init</div>
                    <div class="zona-kalagay" id="kalagayan-storm">Hintay...</div>
                </div>
                <div class="zona-katawan">I-drop ang tamang item dito</div>
            </div>
        </div>
    </section>

    <section class="kahon resulta nakatago" id="resultaKahon">
        <div class="resulta-ulo">
            <div class="puntos-bilog" id="bilangTama">0</div>
            <div>
                <div class="resulta-pamagat" id="resultaPamagat"></div>
                <div class="resulta-talata" id="resultaTalata"></div>
            </div>
        </div>

        <div class="stats">
            <div class="stat">⭐ Puntos: <span id="puntosTeksto">0</span></div>
            <div class="stat">✅ Tamang Sagot: <span id="tamaTeksto">0</span>/3</div>
        </div>

        <div class="susi" id="susiSagot"></div>

        <div class="btns">
            <button class="btn btn-berde" id="nextBtn" type="button">➡️ Magpatuloy</button>
        </div>
    </section>
</div>

<script>
const tugma = {
    solid: {
        zone: 'flood',
        label: 'Solid Waste',
        image: '{{ asset("pictures/solidwaste.png") }}',
        detail: 'Solid Waste→ Pagbaha at paglaganap ng sakit'
    },
    forest: {
        zone: 'landslide',
        label: 'Deforestation',
        image: '{{ asset("pictures/deforestation.png") }}',
        detail: 'Deforestation → Pagguho ng lupa at pagbaha'
    },
    climate: {
        zone: 'storm',
        label: 'Climate Change',
        image: '{{ asset("pictures/climate.png") }}',
        detail: 'Climate Change → Mas malalakas na bagyo at matinding init'
    }
};

const ayos = ['solid','forest','climate'];

const orasTeksto = document.getElementById('orasTeksto');
const gabayTeksto = document.getElementById('gabayTeksto');
const cardsRoot = document.getElementById('cardsRoot');

const resultaKahon = document.getElementById('resultaKahon');
const resultaPamagat = document.getElementById('resultaPamagat');
const resultaTalata = document.getElementById('resultaTalata');
const bilangTama = document.getElementById('bilangTama');
const puntosTeksto = document.getElementById('puntosTeksto');
const tamaTeksto = document.getElementById('tamaTeksto');
const susiSagot = document.getElementById('susiSagot');

let puntos = 0;
let tama = 0;
let segundo = 30;
let timer = null;
let taposNa = false;
let hawak = null;

/* Tunog */
let ctx = null;
function tunog(freq, haba = 0.10, lakas = 0.05, uri = 'sine', antala = 0){
    const AC = window.AudioContext || window.webkitAudioContext;
    if(!AC) return;
    if(!ctx) ctx = new AC();
    if(ctx.state === 'suspended') ctx.resume();

    const osc = ctx.createOscillator();
    const gain = ctx.createGain();
    const start = ctx.currentTime + antala;

    osc.type = uri;
    osc.frequency.setValueAtTime(freq, start);
    gain.gain.setValueAtTime(lakas, start);
    gain.gain.exponentialRampToValueAtTime(0.0001, start + haba);

    osc.connect(gain);
    gain.connect(ctx.destination);
    osc.start(start);
    osc.stop(start + haba);
}
function tunogTama(){
    tunog(680, 0.11, 0.05, 'sine');
    tunog(900, 0.11, 0.05, 'sine', 0.10);
}
function tunogMali(){
    tunog(180, 0.14, 0.055, 'square');
}

function updateOras(){ orasTeksto.textContent = segundo; }

function lagayKalagayan(zona, text){
    const el = document.getElementById(`kalagayan-${zona}`);
    if(el) el.textContent = text;
}

function buoSusi(){
    susiSagot.innerHTML = Object.values(tugma)
        .map(i => `<div class="susi-item">👉 ${i.detail}</div>`)
        .join('');
}

function lockLahat(){
    document.querySelectorAll('.kard-drag').forEach(k => {
        k.setAttribute('draggable', 'false');
        k.classList.add('locked');
    });
}

function punanZona(zonaEl, item, sagotLang = false){
    const katawan = zonaEl.querySelector('.zona-katawan');
    katawan.classList.add('puno');
    zonaEl.classList.add('tama');
    zonaEl.dataset.filled = 'true';
    katawan.innerHTML = `
        <article class="kard-drag locked" style="width:100%">
            <img class="larawan" src="${item.image}" alt="${item.label}">
            <div class="katawan">
                <div class="pangalan">${sagotLang ? 'Tamang Sagot' : item.label}</div>
                <div class="paliwanag">${item.detail}</div>
            </div>
        </article>
    `;
}

function ipakitaResulta(galingSaOras = false){
    if(!resultaKahon.classList.contains('nakatago')) return;

    if(tama === 3){
        resultaPamagat.textContent = '“Magaling!” 🎉';
        resultaTalata.textContent = 'Natukoy mo ang tamang ugnayan ng suliranin at epekto. Tandaan: Ang mga problemang ito ay magkakaugnay at kadalasang dulot ng gawain ng tao. Ngunit may magagawa tayo upang maiwasan ang mas matinding pinsala.';
    }else{
        resultaPamagat.textContent = '“Subukan muli!”';
        resultaTalata.textContent = galingSaOras
            ? 'May ilang hindi tugma. Basahing muli ang mga konsepto at i-drag ulit.'
            : 'May ilang hindi tugma. Basahing muli ang mga konsepto at i-drag ulit.';
    }

    bilangTama.textContent = tama;
    puntosTeksto.textContent = puntos;
    tamaTeksto.textContent = tama;
    buoSusi();

    resultaKahon.classList.remove('nakatago');
}

function tapusin(galingSaOras = false){
    if(taposNa) return;
    taposNa = true;
    clearInterval(timer);
    lockLahat();

    // Ipakita ang kulang na tamang sagot kapag oras na o hindi kumpleto
    document.querySelectorAll('.zona').forEach(zona => {
        if(zona.dataset.filled === 'true') return;
        const key = zona.dataset.zone;
        const pares = Object.values(tugma).find(v => v.zone === key);
        if(pares){
            punanZona(zona, pares, true);
            lagayKalagayan(key, 'Sagot');
        }
    });

    ipakitaResulta(galingSaOras);
}

function resetLaro(){
    clearInterval(timer);

    puntos = 0;
    tama = 0;
    segundo = 30;
    taposNa = false;
    hawak = null;
    updateOras();

    gabayTeksto.className = 'gabay';
    gabayTeksto.textContent = 'I-drag ang bawat larawan papunta sa tamang epekto.';
    resultaKahon.classList.add('nakatago');
    susiSagot.innerHTML = '';

    ayos.forEach(id => {
        const card = document.querySelector(`.kard-drag[data-id="${id}"]`);
        if(card){
            card.classList.remove('locked','dragging','alog');
            card.setAttribute('draggable','true');
            const tag = card.querySelector('.tatak2');
            if(tag) tag.textContent = card.dataset.tag || 'Suliraning pangkapaligiran';
            cardsRoot.appendChild(card);
        }
    });

    document.querySelectorAll('.zona').forEach(zona => {
        zona.classList.remove('tama','over');
        zona.dataset.filled = 'false';
        const katawan = zona.querySelector('.zona-katawan');
        katawan.className = 'zona-katawan';
        katawan.textContent = 'I-drop ang tamang item dito';
        lagayKalagayan(zona.dataset.zone, 'Hintay...');
    });

    timer = setInterval(() => {
        if(taposNa) return;
        segundo--;
        updateOras();

        if(segundo <= 0){
            segundo = 0;
            updateOras();
            tapusin(true);
        }
    }, 1000);
}

function subokDrop(card, zona){
    if(taposNa || !card || !zona) return;
    if(zona.dataset.filled === 'true') return;

    const id = card.dataset.id;
    const inaasahan = tugma[id].zone;
    const target = zona.dataset.zone;

    if(target === inaasahan){
        puntos += 1; // +1 bawat tamang sagot
        tama += 1;
        tunogTama();

        lagayKalagayan(target, 'Tama ✓');
        zona.dataset.filled = 'true';
        zona.classList.add('tama');

        const katawan = zona.querySelector('.zona-katawan');
        katawan.classList.add('puno');
        katawan.innerHTML = '';
        card.classList.add('locked');
        card.setAttribute('draggable', 'false');
        katawan.appendChild(card);

        gabayTeksto.className = 'gabay mensahe-tama';
        gabayTeksto.textContent = 'Magaling! Tama ang iyong inilagay.';

        if(tama === 3){
            tapusin(false);
        }
    }else{
        puntos = Math.max(0, puntos - 0);
        tunogMali();

        card.classList.add('alog');
        setTimeout(() => card.classList.remove('alog'), 280);

        gabayTeksto.className = 'gabay mensahe-mali';
        gabayTeksto.textContent = '“Subukan muli!” May ilang hindi tugma. Basahing muli ang mga konsepto at i-drag ulit.';
    }
}

document.querySelectorAll('.kard-drag').forEach(card => {
    card.addEventListener('dragstart', () => {
        if(taposNa || card.classList.contains('locked')) return;
        hawak = card;
        card.classList.add('dragging');
    });
    card.addEventListener('dragend', () => {
        card.classList.remove('dragging');
        hawak = null;
    });
});

document.querySelectorAll('.zona').forEach(zona => {
    zona.addEventListener('dragover', e => {
        e.preventDefault();
        if(!taposNa && zona.dataset.filled !== 'true') zona.classList.add('over');
    });
    zona.addEventListener('dragleave', () => zona.classList.remove('over'));
    zona.addEventListener('drop', e => {
        e.preventDefault();
        zona.classList.remove('over');
        subokDrop(hawak, zona);
    });
});

document.getElementById('resetBtn').addEventListener('click', resetLaro);
document.getElementById('nextBtn').addEventListener('click', () => {
    window.location.href = '{{ route("module3.iv_explore") }}';
});

resetLaro();
</script>
@endsection