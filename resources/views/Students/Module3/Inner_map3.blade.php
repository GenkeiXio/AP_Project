{{-- filepath: c:\Users\jella\AP Project\AP_Project\resources\views\Students\Module3\Inner_map3.blade.php --}}
@extends('Students.studentslayout')
@section('title', 'InnerMap3')

@push('styles')
<style>
body, html {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.page-content, .container, .main-wrapper {
    max-width: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
}

.map-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
}

.map-container {
    position: relative;
    width: 100%;
    height: 100%;
    transition: transform 0.7s ease;
    transform-origin: center center;
}

.background-map {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* NODE STYLE (CIRCLE) */
.node {
    position: absolute;
    width: fit-content;      /* ← change this */
    height: fit-content;     /* ← add this */
    background: transparent;
    border: none;
    outline: none;
    box-shadow: none;
    cursor: pointer;
    z-index: 5;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transform: translate(-50%, -50%);
    transition: transform .2s ease;
    -webkit-appearance: none;
    appearance: none;
}

.node img {
    width: clamp(120px, 18vw, 240px); /* scales down proportionally */
    height: auto;
    object-fit: contain;
    transform: translateY(10px);
}


.node-tri-top-left  { top: 35%; left: 30%; }
.node-tri-top-right { top: 35%; left: 70%; }
.node-tri-bottom    { top: 80%; left: 50%; }

.center-design {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: clamp(200px, 32vw, 480px); /* scales down on smaller screens */
    z-index: 1; /* keep it behind nodes */
}

.node:hover {
    transform: translate(-50%, -50%) scale(1.1); /* ← include translate! */
}

/* POSITIONS */


/* LOCK */
.locked {
    filter: grayscale(100%);
    opacity: 0.6;
    pointer-events: none;
}

.locked img {
    filter: grayscale(100%) brightness(0.8) drop-shadow(0 8px 10px rgba(0,0,0,0.5));
}

.lock-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 40px;
    background: rgba(0,0,0,0.4);
    color: white;
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 15px; /* Square with rounded corners looks better for icons */
    z-index: 3;
    pointer-events: none;
}

/* CENTER BUTTON */
.module-entry {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 5;
    border: 0;
    border-radius: 16px;
    padding: 14px 20px;
    font-weight: 900;
    font-size: 1rem;
    cursor: pointer;
    background: rgba(255, 255, 255, 0.92);
    box-shadow: 0 8px 18px rgba(0,0,0,0.25);
    
}

.node:focus {
    outline: none;
}

.node:focus-visible {
    outline: none;
}

.module-entry.active {
    animation: pinSelect 0.6s ease;
}

@keyframes pinSelect {
    0% { transform: translate(-50%, -50%) scale(1); }
    50% { transform: translate(-50%, -50%) scale(1.12); }
    100% { transform: translate(-50%, -50%) scale(1.06); }
}

/* BACK */
.back-button {
    position: fixed;
    top: 80px;
    left: 20px;
    z-index: 100;
    background: white;
    padding: 10px 15px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
}

/* FINAL ACTIVITY BUTTON (MODULE 2-STYLE) */
.final-key {
    display: none;
    position: fixed;
    bottom: 30px;
    right: 30px;
    padding: 15px 20px;
    background: gold;
    border: none;
    border-radius: 12px;
    font-weight: bold;
    cursor: pointer;
    z-index: 100;
    box-shadow: 0 8px 18px rgba(0,0,0,0.3);
}

/* FINAL MODAL (MODULE 2-STYLE) */
.modal {
    display: none;
    position: fixed;
    z-index: 999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: white;
    padding: 30px;
    border-radius: 16px;
    text-align: center;
    width: 350px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    position: relative;
}

.modal-btn {
    margin-top: 15px;
    padding: 12px 20px;
    border: none;
    border-radius: 10px;
    background: #5eae4e;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

.modal-close {
    position: absolute;
    top: 10px;
    right: 10px;
    border: none;
    background: none;
    font-size: 18px;
    cursor: pointer;
}

.node.locked {
    transform: translate(-50%, -50%) scale(0.8); /* ← include translate! */
}

.node.locked:hover {
    transform: translate(-50%, -50%) scale(0.85); /* ← include translate! */
}
</style>
@endpush

@section('content')
<div class="map-wrapper">

    <div id="finalModal" class="modal">
        <div class="modal-content">
            <h2>🎉 Mission Complete!</h2>
            <p>Kumpleto mo na ang lahat ng node sa Module 3.</p>
            <button class="modal-btn" onclick="goToActivities()">🚀 Pumunta sa Mga Gawain</button>
            <button class="modal-close" onclick="closeModal()">✖</button>
        </div>
    </div>

    <div class="map-container">

        <img src="{{ asset('pictures/mod3_innermap.png') }}" class="background-map" alt="Mapa ng Module 3">

        <!-- CENTER START -->
       <img src="{{ asset('pictures/mod3_center_node.png') }}" class="center-design" alt="Simulan">

        <button class="node node-tri-top-left" onclick="goNode1()">
            <img src="{{ asset('pictures/mod3_disaster_node.png') }}" alt="Node 1">
        </button>

        <button class="node node-tri-top-right locked" id="node2" onclick="goNode2()">
            <img src="{{ asset('pictures/mod3_approaches_node.png') }}" alt="Node 2">
            <span class="lock-icon">🔒</span>
        </button>

        <button class="node node-tri-bottom locked" id="node3" onclick="goNode3()">
            <img src="{{ asset('pictures/mod3_cbdrrm_node.png') }}" alt="Node 3">
            <span class="lock-icon">🔒</span>
        </button>

        <button id="final-key" class="final-key" onclick="goFinal()">🔑 Unlock Mga Gawain</button>

        <a href="{{ route('student.map') }}" class="back-button">⬅️ Bumalik</a>
    </div>
</div>

<script>
const M3_PROGRESS_KEYS = {
    node1: "m3v2_node1",
    node2: "m3v2_node2",
    node3: "m3v2_node3"
};

function getDone(key){
    const sessionDone = sessionStorage.getItem(key) === "true";
    const localDone = localStorage.getItem(key) === "true";

    // Sync from localStorage so map unlock survives page/session reloads.
    if (!sessionDone && localDone) {
        sessionStorage.setItem(key, "true");
    }

    return sessionDone || localDone;
}

function getM3Done(nodeKey) {
    return getDone(M3_PROGRESS_KEYS[nodeKey]);
}

function updateMapProgress(){
    const node2 = document.getElementById("node2");
    const node3 = document.getElementById("node3");
    const finalBtn = document.getElementById("final-key");

    lockNode(node2);
    lockNode(node3);

    const n1 = getM3Done("node1");
    const n2 = getM3Done("node2");
    const n3 = getM3Done("node3");

    if(n1) unlockNode(node2);
    if(n1 && n2) unlockNode(node3);

    // Module 2-style final activity unlock button.
    if(n1 && n2 && n3) {
        finalBtn.style.display = "block";
    } else {
        finalBtn.style.display = "none";
    }
}

function lockNode(node){
    node.classList.add("locked");
    const img = node.querySelector("img");
    if(img) 

    if(!node.querySelector(".lock-icon")){
        const lock = document.createElement("span");
        lock.className = "lock-icon";
        lock.innerText = "🔒";
        node.appendChild(lock);
    }
}

function unlockNode(node){
    node.classList.remove("locked");
    node.querySelector(".lock-icon")?.remove();
}

function goNode1(){
    window.location.href = "{{ route('module3.node1') }}";
}

function goNode2(){
    if(getM3Done("node1")){
        window.location.href = "{{ route('module3.node2') }}";
    } else {
        alert("Tapusin muna ang Node 1!");
    }
}

function goNode3(){
    if(getM3Done("node2")){
        window.location.href = "{{ route('module3.node3') }}";
    } else {
        alert("Tapusin muna ang Node 2!");
    }
}

function goFinal(){
    document.getElementById("finalModal").style.display = "flex";
}

function closeModal(){
    document.getElementById("finalModal").style.display = "none";
}

function goToActivities(){
    window.location.href = "{{ route('apply.activity') }}";
}

function moduleTransition(target, url) {
    const map = document.querySelector('.map-container');
    const rect = map.getBoundingClientRect();
    const targetRect = target.getBoundingClientRect();

    const targetCenterX = targetRect.left + targetRect.width / 2;
    const targetCenterY = targetRect.top + targetRect.height / 2;
    const mapCenterX = rect.left + rect.width / 2;
    const mapCenterY = rect.top + rect.height / 2;

    const offsetX = mapCenterX - targetCenterX;
    const offsetY = mapCenterY - targetCenterY;

    map.style.transform = `translate(${offsetX}px, ${offsetY}px) scale(1.8)`;
    target.classList.add('active');

    setTimeout(() => {
        document.body.style.opacity = "0";
    }, 400);

    setTimeout(() => {
        window.location.href = url;
    }, 900);
}

window.onload = updateMapProgress;
</script>
@endsection