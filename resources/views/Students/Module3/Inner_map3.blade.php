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
    width: 180px;
    height: 180px;
    border-radius: 50%;
    background: white;
    border: 5px solid #fff;
    box-shadow: 0 8px 15px rgba(0,0,0,0.3);
    cursor: pointer;
    overflow: hidden;
    z-index: 2;
    transition: transform .2s ease;
}

.node img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    display: block;
}

.node:hover {
    transform: scale(1.08);
}

/* POSITIONS */
.node-top-left { top: 15%; left: 20%; }
.node-top-right { top: 15%; left: 65%; }
.node-bottom-left { top: 60%; left: 20%; }
.node-bottom-right { top: 60%; left: 65%; }

/* LOCK */
.locked {
    filter: grayscale(100%);
    opacity: 0.6;
    pointer-events: none;
}

.lock-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 34px;
    background: rgba(0,0,0,0.6);
    color: white;
    width: 64px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    z-index: 3;
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
        <button class="module-entry" onclick="moduleTransition(this, '{{ route('module3.home') }}')">
            Simulan ang Module 3
        </button>

        <!-- NODE 1 -->
        <button class="node node-top-left" onclick="goNode1()">
            <img src="{{ asset('pictures/node1_innermap_mod3.png') }}" alt="Node 1">
        </button>

        <!-- NODE 2 -->
        <button class="node node-top-right locked" id="node2" onclick="goNode2()">
            <img src="{{ asset('pictures/node2.png') }}" alt="Node 2">
            <span class="lock-icon">🔒</span>
        </button>

        <!-- NODE 3 -->
        <button class="node node-bottom-left locked" id="node3" onclick="goNode3()">
            <img src="{{ asset('pictures/node3.png') }}" alt="Node 3">
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