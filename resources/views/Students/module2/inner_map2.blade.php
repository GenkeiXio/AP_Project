@extends('Students.studentslayout')
@section('title', 'InnerMap2')

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

.background-map {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.node {
    position: absolute;
    width: 220px;   /* 🔥 bigger */
    height: 160px;  /* 🔥 rectangular */

    border-radius: 20px; /* 🔥 not circle anymore */
    background: white;

    border: 4px solid #fff;
    box-shadow: 0 8px 15px rgba(0,0,0,0.3);

    cursor: pointer;
    overflow: hidden;
}

.node img {
    width: 100%;
    height: 100%;
    object-fit: contain; /* 🔥 show full image */
    border-radius: 0;    /* 🔥 remove circle */
}

.node:hover {
    transform: scale(1.1);
}

.label {
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    padding: 5px 15px;
    border-radius: 20px;
    color: white;
    font-weight: bold;
    font-size: 14px;
}

.label-blue { background: #1e3799; }
.label-brown { background: #784521; }
.label-orange { background: #e67e22; }
.label-green { background: #27ae60; }

/* LOCKED */
.locked {
    filter: grayscale(100%) brightness(0.7);
    pointer-events: none;
    opacity: 0.6;
}

.lock-icon {
    position: absolute;
    top: -10px;
    right: -10px;
    background: red;
    color: white;
    border-radius: 50%;
    padding: 5px;
}

.center-node {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%); /* 🔥 TRUE CENTER */

    width: 320px;   /* bigger for visibility */
    height: 220px;

    border-radius: 20px;
    overflow: hidden;

    display: flex;
    justify-content: center;
    align-items: center;

    background: white;
}

.center-node img {
    width: 100%;
    height: 100%;

    object-fit: contain; /* 🔥 SHOW FULL IMAGE (NO CROP) */
}

.center-node:hover {
    transform: translate(-50%, -50%) scale(1); /* keep it fixed */
}

.node-top-left { top: 15%; left: 20%; }
.node-top-right { top: 15%; left: 65%; }
.node-bottom-left { top: 60%; left: 20%; }
.node-bottom-right { top: 60%; left: 65%; }

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

/* 🔑 Final Button */
.final-key {
    display: none;
    position: fixed;
    bottom: 30px;
    right: 30px;
    padding: 15px 20px;
    background: gold;
    border-radius: 12px;
    font-weight: bold;
    cursor: pointer;
    z-index: 100;
}
</style>
@endpush

@section('content')
<div class="map-wrapper">

    <img src="{{ asset('pictures/module2_inner_map2.png') }}" class="background-map">

    <div class="node center-node">
        <img src="{{ asset('pictures/innermap_logo.png') }}">
    </div>

    <!-- NODE 1 -->
    <button class="node node-top-left"
        onclick="window.location.href='{{ route('node1.solid-waste') }}'">
        <img src="{{ asset('pictures/basura_node.png') }}">
        <!-- <div class="label label-blue">Basura</div> -->
    </button>

    <!-- NODE 2 -->
    <button class="node node-top-right locked" id="node2" onclick="goNode2()">
        <img src="{{ asset('pictures/node_forest.png') }}">
        <!-- <div class="label label-brown">Pagkakalbo ng Kagubatan</div> -->
        <span class="lock-icon">🔒</span>
    </button>

    <!-- NODE 3 -->
    <button class="node node-bottom-left locked" id="node3" onclick="goNode3()">
        <img src="{{ asset('pictures/node_klima.png') }}">
        <!-- <div class="label label-orange">Pagbabago ng Klima</div> -->
        <span class="lock-icon">🔒</span>
    </button>

    <!-- NODE 4 -->
    <button class="node node-bottom-right locked" id="node4" onclick="goNode4()">
        <img src="{{ asset('pictures/node_gov.png') }}">
        <!-- <div class="label label-green">Tugon ng Pamahalaan</div> -->
        <span class="lock-icon">🔒</span>
    </button>

    <!-- 🔑 FINAL -->
    <button id="final-key" class="final-key" onclick="goFinal()">
        🔑 Unlock Final Activity
    </button>

    <a href="{{ url()->previous() }}" class="back-button">⬅️ Bumalik</a>

</div>

<script>
function getDone(key){
    return sessionStorage.getItem(key) === "true";
}

function updateMapProgress(){

    const node2 = document.getElementById("node2");
    const node3 = document.getElementById("node3");
    const node4 = document.getElementById("node4");
    const finalBtn = document.getElementById("final-key");

    // RESET LOCKS
    lockNode(node2);
    lockNode(node3);
    lockNode(node4);

    const n1 = getDone("node1_done");
    const n2 = getDone("node2_done");
    const n3 = getDone("node3_done");
    const n4 = getDone("node4_done");

    // 🔓 PROGRESSION
    if(n1){
        unlockNode(node2);
    }

    if(n1 && n2){
        unlockNode(node3);
    }

    if(n1 && n2 && n3){
        unlockNode(node4);
    }

    // ✅ FINAL BUTTON (ONLY WHEN ALL DONE)
    if(n1 && n2 && n3 && n4){
        finalBtn.style.display = "block";
    } else {
        finalBtn.style.display = "none";
    }
}

/* LOCK */
function lockNode(node){
    node.classList.add("locked");

    if(!node.querySelector(".lock-icon")){
        const lock = document.createElement("span");
        lock.className = "lock-icon";
        lock.innerText = "🔒";
        node.appendChild(lock);
    }
}

/* UNLOCK */
function unlockNode(node){
    node.classList.remove("locked");
    node.querySelector(".lock-icon")?.remove();
}

/* NAVIGATION */
function goNode2(){
    if(getDone("node1_done")){
        window.location.href="{{ route('node2') }}";
    } else alert("Tapusin muna ang Node 1!");
}

function goNode3(){
    if(getDone("node2_done")){
        window.location.href="{{ route('node3') }}";
    } else alert("Tapusin muna ang Node 2!");
}

function goNode4(){
    if(getDone("node3_done")){
        window.location.href="{{ route('node4') }}";
    } else alert("Tapusin muna ang Node 3!");
}

/* FINAL */
function goFinal(){
    alert("🎉 Kumpleto mo na ang lahat ng nodes!");
    window.location.href = "{{ route('module2.intro') }}";
}

window.onload = updateMapProgress;
</script>
</script>
@endsection