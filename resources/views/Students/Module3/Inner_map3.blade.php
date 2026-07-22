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
    background: #0b1220;
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

/* NODE STYLE */
.node {
    position: absolute;
    width: fit-content;
    height: fit-content;
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
    width: clamp(180px, 28vw, 380px);
    height: auto;
    object-fit: contain;
    transform: translateY(10px);
}

/* Desktop node positions */
.node-tri-top-left  { 
    top: 32%; 
    left: 18%; 
}

.node-tri-top-right { 
    top: 32%; 
    left: 82%; 
}

.node-tri-bottom    { 
    top: 80%; 
    left: 50%; 
}

.center-design {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: clamp(250px, 40vw, 580px);
    z-index: 1;
}

.node:hover {
    transform: translate(-50%, -50%) scale(1.1);
}

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
    font-size: clamp(40px, 7vw, 65px);
    background: rgba(0,0,0,0.65);
    color: white;
    width: clamp(80px, 14vw, 120px);
    height: clamp(80px, 14vw, 120px);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 20px;
    z-index: 3;
    pointer-events: none;
    box-shadow: 0 4px 20px rgba(0,0,0,0.5);
    border: 3px solid rgba(255,255,255,0.1);
}

/* BACK */
.back-button {
    position: fixed;
    top: 20px;
    left: 15px;
    z-index: 100;
    background: white;
    padding: 10px 18px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    font-size: 16px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

/* FINAL ACTIVITY BUTTON */
.final-key {
    display: none;
    position: fixed;
    bottom: 35px;
    left: 50%;
    transform: translateX(-50%);
    padding: 20px 40px;
    background: linear-gradient(135deg, #f5a623, #f7c948);
    border: none;
    border-radius: 18px;
    font-weight: bold;
    cursor: pointer;
    z-index: 100;
    box-shadow: 0 8px 30px rgba(0,0,0,0.4);
    font-size: 20px;
    white-space: nowrap;
    color: #1a1a1a;
    letter-spacing: 0.5px;
    transition: transform 0.2s ease;
}

.final-key:hover {
    transform: translateX(-50%) scale(1.05);
}

/* FINAL MODAL */
.modal {
    display: none;
    position: fixed;
    z-index: 999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7);
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.modal-content {
    background: white;
    padding: 35px;
    border-radius: 20px;
    text-align: center;
    width: 90%;
    max-width: 420px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    position: relative;
}

.modal-content h2 {
    font-size: 1.8rem;
    margin-bottom: 10px;
}

.modal-content p {
    font-size: 1.1rem;
    margin-bottom: 15px;
}

.modal-btn {
    margin-top: 15px;
    padding: 14px 25px;
    border: none;
    border-radius: 12px;
    background: #5eae4e;
    color: white;
    font-weight: bold;
    font-size: 1.1rem;
    cursor: pointer;
    width: 100%;
}

.modal-btn:hover {
    background: #4a8f3d;
}

.modal-close {
    position: absolute;
    top: 10px;
    right: 15px;
    border: none;
    background: none;
    font-size: 22px;
    cursor: pointer;
}

.node.locked {
    transform: translate(-50%, -50%) scale(0.8);
}

.node.locked:hover {
    transform: translate(-50%, -50%) scale(0.85);
}

/* ===== DESKTOP MODE - SMALLER NODES ===== */
@media (min-width: 769px) {
    .node img {
        width: clamp(140px, 16vw, 220px);
    }
    
    .node-tri-top-left  { 
        top: 28%; 
        left: 14%; 
    }
    
    .node-tri-top-right { 
        top: 28%; 
        left: 86%; 
    }
    
    .node-tri-bottom    { 
        top: 76%; 
        left: 50%; 
    }
    
    .center-design {
        width: clamp(180px, 25vw, 350px);
    }
    
    .lock-icon {
        font-size: clamp(28px, 4vw, 42px);
        width: clamp(55px, 8vw, 75px);
        height: clamp(55px, 8vw, 75px);
        border-radius: 14px;
    }
    
    .final-key {
        padding: 14px 28px;
        font-size: 16px;
        bottom: 25px;
    }
}

/* ===== MOBILE MODE - LARGER NODES, CLOSER TOGETHER ===== */
@media (max-width: 768px) {
    .node img {
        width: clamp(150px, 25vw, 220px);
    }
    
    /* Node 1 and Node 2 - closer together at the center */
    .node-tri-top-left  { 
        top: 28%; 
        left: 30%; 
    }
    
    .node-tri-top-right { 
        top: 28%; 
        left: 70%; 
    }
    
    /* Node 3 at the bottom center */
    .node-tri-bottom    { 
        top: 78%; 
        left: 50%; 
    }
    
    .center-design {
        width: clamp(180px, 32vw, 300px);
    }
    
    .lock-icon {
        font-size: clamp(32px, 6vw, 48px);
        width: clamp(65px, 12vw, 90px);
        height: clamp(65px, 12vw, 90px);
        border-radius: 16px;
    }
    
    .final-key {
        padding: 18px 32px;
        font-size: 18px;
        bottom: 25px;
        white-space: normal;
        width: 85%;
        max-width: 340px;
    }
    
    .back-button {
        top: 15px;
        left: 10px;
        padding: 8px 15px;
        font-size: 14px;
    }
    
    .modal-content {
        padding: 25px;
        width: 95%;
        max-width: 380px;
    }
    
    .modal-content h2 {
        font-size: 1.5rem;
    }
    
    .modal-content p {
        font-size: 1rem;
    }
}

/* ===== SMALLER PHONES ===== */
@media (max-width: 480px) {
    .node img {
        width: clamp(120px, 22vw, 170px);
    }
    
    .node-tri-top-left  { 
        top: 25%; 
        left: 33%; 
    }
    
    .node-tri-top-right { 
        top: 25%; 
        left: 67%; 
    }
    
    .node-tri-bottom    { 
        top: 76%; 
        left: 50%; 
    }
    
    .center-design {
        width: clamp(140px, 26vw, 220px);
    }
    
    .lock-icon {
        font-size: clamp(26px, 5.5vw, 38px);
        width: clamp(55px, 11vw, 75px);
        height: clamp(55px, 11vw, 75px);
        border-radius: 14px;
    }
    
    .final-key {
        padding: 16px 26px;
        font-size: 16px;
        bottom: 20px;
        width: 90%;
        max-width: 300px;
        border-radius: 16px;
    }
    
    .back-button {
        padding: 6px 12px;
        font-size: 12px;
    }
    
    .modal-content {
        padding: 20px;
    }
    
    .modal-content h2 {
        font-size: 1.3rem;
    }
    
    .modal-content p {
        font-size: 0.9rem;
    }
    
    .modal-btn {
        padding: 12px 20px;
        font-size: 1rem;
    }
}

/* ===== VERY SMALL SCREENS ===== */
@media (max-width: 360px) {
    .node img {
        width: clamp(95px, 20vw, 130px);
    }
    
    .node-tri-top-left  { 
        top: 22%; 
        left: 36%; 
    }
    
    .node-tri-top-right { 
        top: 22%; 
        left: 64%; 
    }
    
    .node-tri-bottom    { 
        top: 74%; 
        left: 50%; 
    }
    
    .center-design {
        width: clamp(110px, 22vw, 170px);
    }
    
    .lock-icon {
        font-size: clamp(20px, 5vw, 28px);
        width: clamp(45px, 10vw, 60px);
        height: clamp(45px, 10vw, 60px);
        border-radius: 12px;
    }
    
    .final-key {
        padding: 14px 20px;
        font-size: 14px;
        width: 92%;
        max-width: 270px;
    }
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

        <img src="{{ asset('pictures/mod3_center_node.png') }}" class="center-design" alt="Simulan">

        <!-- Node 1 - Always Unlocked -->
        <button class="node node-tri-top-left" onclick="goNode1()">
            <img src="{{ asset('pictures/mod3_disaster_node.png') }}" alt="Node 1">
        </button>

        <!-- Node 2 - Initially Locked, Unlocks after Node 1 -->
        <button class="node node-tri-top-right locked" id="node2" onclick="goNode2()">
            <img src="{{ asset('pictures/mod3_approaches_node.png') }}" alt="Node 2">
            <span class="lock-icon">🔒</span>
        </button>

        <!-- Node 3 - Initially Locked, Unlocks after Node 2 -->
        <button class="node node-tri-bottom locked" id="node3" onclick="goNode3()">
            <img src="{{ asset('pictures/mod3_cbdrrm_node.png') }}" alt="Node 3">
            <span class="lock-icon">🔒</span>
        </button>

        <button id="final-key" class="final-key" onclick="goFinal()">🔑 Unlock Mga Gawain</button>

        <a href="{{ route('student.map') }}" class="back-button">⬅️ Bumalik</a>
    </div>

    <div id="progressModal" class="modal">
        <div class="modal-content">
            <h2 id="progressTitle">Magaling!</h2>
            <p>Natapos mo ang isang bahagi ng aralin.</p>
            <div id="percentText" style="font-size:48px; font-weight:bold; color:#5eae4e;">0%</div>
            <p id="progressMessage">Tapusin ang lahat para ma-unlock ang final activity.</p>
            <button class="modal-btn" onclick="closeProgressModal()">Ipagpatuloy</button>
        </div>
    </div>
</div>

<script>
// Define progress keys
const M3_PROGRESS_KEYS = {
    node1: "m3_node1_completed",
    node2: "m3_node2_completed", 
    node3: "m3_node3_completed"
};

// Check if a node is completed
function isNodeCompleted(nodeKey) {
    return localStorage.getItem(nodeKey) === "true";
}

// Mark a node as completed
function markNodeComplete(nodeKey) {
    localStorage.setItem(nodeKey, "true");
}

// Initialize all nodes to false if not set
function initializeProgress() {
    Object.values(M3_PROGRESS_KEYS).forEach(key => {
        if (localStorage.getItem(key) === null) {
            localStorage.setItem(key, "false");
        }
    });
}

// Update the map based on progress
function updateMapProgress() {
    const node2 = document.getElementById("node2");
    const node3 = document.getElementById("node3");
    const finalBtn = document.getElementById("final-key");

    // Reset all nodes to locked state first
    lockNode(node2);
    lockNode(node3);

    // Get completion status
    const n1Done = isNodeCompleted(M3_PROGRESS_KEYS.node1);
    const n2Done = isNodeCompleted(M3_PROGRESS_KEYS.node2);
    const n3Done = isNodeCompleted(M3_PROGRESS_KEYS.node3);

    // Sequential unlocking logic
    if (n1Done) {
        unlockNode(node2);
        console.log("Node 2 unlocked!");
    }

    if (n1Done && n2Done) {
        unlockNode(node3);
        console.log("Node 3 unlocked!");
    }

    // Count completed nodes
    let completedCount = 0;
    if (n1Done) completedCount++;
    if (n2Done) completedCount++;
    if (n3Done) completedCount++;

    // Show progress
    let percentage = 0;
    if (completedCount === 1) percentage = 33;
    if (completedCount === 2) percentage = 66;
    if (completedCount === 3) percentage = 100;

    const lastReported = parseInt(localStorage.getItem("m3_last_progress") || "0");

    if (percentage > lastReported && percentage < 100) {
        showProgressModal(percentage);
        localStorage.setItem("m3_last_progress", percentage.toString());
    } 
    else if (percentage === 100 && lastReported < 100) {
        showFinalUnlockMessage();
        localStorage.setItem("m3_last_progress", "100");
    }

    // Show/hide final button
    if (n1Done && n2Done && n3Done) {
        finalBtn.style.display = "block";
        localStorage.setItem("m3_final_unlocked", "true");
    } else {
        finalBtn.style.display = "none";
        localStorage.setItem("m3_final_unlocked", "false");
    }
}

function lockNode(node) {
    if (!node) return;
    node.classList.add("locked");
    
    // Add lock icon if not present
    if (!node.querySelector(".lock-icon")) {
        const lock = document.createElement("span");
        lock.className = "lock-icon";
        lock.innerText = "🔒";
        node.appendChild(lock);
    }
}

function unlockNode(node) {
    if (!node) return;
    node.classList.remove("locked");
    const lockIcon = node.querySelector(".lock-icon");
    if (lockIcon) {
        lockIcon.remove();
    }
}

// Navigation functions
function goNode1() {
    // Node 1 is always accessible
    window.location.href = "{{ route('module3.node1') }}";
}

function goNode2() {
    const n1Done = isNodeCompleted(M3_PROGRESS_KEYS.node1);
    if (n1Done) {
        window.location.href = "{{ route('module3.node2') }}";
    } else {
        alert("🔒 Kailangan mong tapusin muna ang Node 1 bago buksan ito!");
    }
}

function goNode3() {
    const n1Done = isNodeCompleted(M3_PROGRESS_KEYS.node1);
    const n2Done = isNodeCompleted(M3_PROGRESS_KEYS.node2);
    
    if (n1Done && n2Done) {
        window.location.href = "{{ route('module3.node3') }}";
    } else if (!n1Done) {
        alert("🔒 Kailangan mong tapusin muna ang Node 1 bago buksan ito!");
    } else if (!n2Done) {
        alert("🔒 Kailangan mong tapusin muna ang Node 2 bago buksan ito!");
    }
}

function goFinal() {
    document.getElementById("finalModal").style.display = "flex";
}

function closeModal() {
    document.getElementById("finalModal").style.display = "none";
}

function goToActivities() {
    window.location.href = "{{ route('apply.activity') }}";
}

function showProgressModal(percent) {
    document.getElementById("percentText").innerText = percent + "%";
    document.getElementById("progressModal").style.display = "flex";
}

function closeProgressModal() {
    document.getElementById("progressModal").style.display = "none";
}

function showFinalUnlockMessage() {
    document.getElementById("progressTitle").innerText = "🎉 Magaling!";
    document.getElementById("percentText").innerText = "100%";
    document.getElementById("progressMessage").innerHTML = 
        "Natapos mo na ang lahat ng nodes! <br> Na-unlock mo na ang Final Activity. <br> I-click ang button sa ibaba para magpatuloy.";

    document.getElementById("progressModal").style.display = "flex";
}

// ===== FIXED: Global completeNode function =====
function completeNode(nodeNumber) {
    const keyMap = {
        1: M3_PROGRESS_KEYS.node1,
        2: M3_PROGRESS_KEYS.node2,
        3: M3_PROGRESS_KEYS.node3
    };
    
    console.log("completeNode called for node:", nodeNumber);
    
    if (keyMap[nodeNumber]) {
        markNodeComplete(keyMap[nodeNumber]);
        console.log("Node " + nodeNumber + " marked as completed!");
        updateMapProgress();
        return true;
    }
    return false;
}

// ===== FIXED: Initialize on load =====
document.addEventListener('DOMContentLoaded', function() {
    initializeProgress();
    updateMapProgress();
    
    // Check if we need to complete a node (from URL parameter)
    const urlParams = new URLSearchParams(window.location.search);
    const completeParam = urlParams.get('complete');
    if (completeParam) {
        const nodeNum = parseInt(completeParam);
        if (nodeNum >= 1 && nodeNum <= 3) {
            completeNode(nodeNum);
            // Remove the parameter after processing
            const newUrl = window.location.pathname;
            window.history.replaceState({}, document.title, newUrl);
        }
    }
});

// Also keep window.onload for compatibility
window.onload = function() {
    // Already handled by DOMContentLoaded, but keep for safety
    console.log("Window loaded - map ready");
};
</script>
@endsection