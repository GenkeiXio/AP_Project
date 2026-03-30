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
    width: 180px;
    height: 180px;
    border-radius: 50%;
    background: white;
    border: 4px solid #fff;
    box-shadow: 0 8px 15px rgba(0,0,0,0.3);
    cursor: pointer;
    overflow: visible;
    transition: 0.3s;
}

.node img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
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

/* LOCKED STYLE */
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
    font-size: 14px;
}

.center-node {
    width: 250px;
    height: 180px;
    border-radius: 25px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    cursor: default;
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
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
}
</style>
@endpush

@section('content')
<div class="map-wrapper">
    <img src="{{ asset('pictures/module2_inner_map.png') }}" class="background-map">

    <div class="node center-node">
        <img src="{{ asset('pictures/center_title.png') }}">
    </div>

    <!-- NODE 1 -->
    <button class="node node-top-left"
        onclick="window.location.href='{{ route('node1.solid-waste') }}'">
        <img src="{{ asset('pictures/node_basura.png') }}">
        <div class="label label-blue">Basura</div>
    </button>

    <!-- NODE 2 -->
    <button class="node node-top-right locked" id="node2" onclick="goNode2()">
        <img src="{{ asset('pictures/node_forest.png') }}">
        <div class="label label-brown">Pagkakalbo ng Kagubatan</div>
        <span class="lock-icon">🔒</span>
    </button>

    <!-- NODE 3 -->
    <button class="node node-bottom-left locked" id="node3">
        <img src="{{ asset('pictures/node_klima.png') }}">
        <div class="label label-orange">Pagbabago ng Klima</div>
        <span class="lock-icon">🔒</span>
    </button>

    <!-- NODE 4 -->
    <button class="node node-bottom-right locked">
        <img src="{{ asset('pictures/node_gov.png') }}">
        <div class="label label-green">Tugon ng Pamahalaan</div>
        <span class="lock-icon">🔒</span>
    </button>

    <a href="{{ url()->previous() }}" class="back-button">⬅ Bumalik</a>
</div>

<script>
function unlockNodes() {
    if (sessionStorage.getItem("node1_done") === "true") {
        const node2 = document.getElementById("node2");
        node2.classList.remove("locked");
        node2.querySelector(".lock-icon")?.remove();
    }
}

function goNode2() {
    if (sessionStorage.getItem("node1_done") === "true") {
        window.location.href = "{{ route('node2') }}";
    } else {
        alert("Tapusin muna ang Node 1!");
    }
}

window.onload = unlockNodes;
</script>
@endsection