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
    z-index: 1;
}

.map-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
    z-index: 1;
    pointer-events: none;
}

.background-map {
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 0;
}

.node {
    position: absolute;
    width: 286px;  
    height: 208px;
    background: transparent; 
    border: none;            
    cursor: pointer;
    overflow: visible;       
    z-index: 2;
}

.node img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    position: relative;
    z-index: 2;
}

.node:hover {
    transform: scale(1.1);
}

.node, .center-node, .back-button, .final-key {
    z-index: 5 !important; 
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
    font-size: 40px;
    background: rgba(0,0,0,0.6);
    color: white;
    width: 70px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    z-index: 3;
}

.center-node {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%); 
    width: 544px;   
    height: 374px;
    overflow: visible; 
    background: transparent;
    border: none;
    display: flex;
    justify-content: center;
    align-items: center;
}

.center-node img {
    width: 100%;
    height: 100%;
    object-fit: contain; 
}

.center-node:hover {
    transform: translate(-50%, -50%) scale(1); 
}

.node-top-left     { top: 15%; left: 20%; }
.node-bottom-left  { top: 60%; left: 20%; }
.node-top-right    { top: 15%; right: 20%; } 
.node-bottom-right { top: 60%; right: 20%; }

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

.modal{
    display: none;
    position: fixed;
    z-index: 999;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background: rgba(0,0,0,0.6);
    justify-content: center;
    align-items: center;
}

.modal-content{
    background: white;
    padding: 30px;
    border-radius: 16px;
    text-align: center;
    width: 380px;
    max-width: 90%;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    position: relative;
}

.progress-circle-container {
    margin: 15px auto;
    width: 140px;
    height: 140px;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}

.circular-chart {
    width: 100%;
    height: 100%;
    transform: rotate(-90deg);
}

.circle-bg {
    stroke: #e6e6e6;
    stroke-width: 8;
    fill: none;
}

.circle-progress {
    stroke: #5eae4e;
    stroke-width: 8;
    fill: none;
    stroke-linecap: round;
    transition: stroke-dasharray 0.6s ease-out;
}

.percentage-text-inside {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 28px;
    font-weight: bold;
    color: #5eae4e;
    margin: 0;
    padding: 0;
    line-height: 1;
}

#percentText {
    display: none;
}

.modal-btn{
    margin-top: 15px;
    padding: 12px 20px;
    border: none;
    border-radius: 10px;
    background: #5eae4e;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

.modal-close{
    position: absolute;
    top: 10px;
    right: 10px;
    border: none;
    background: none;
    font-size: 18px;
    cursor: pointer;
}

@media (max-width: 768px) {
    body, html {
        overflow: auto;
    }

    .node {
        width: 140px;
        height: 100px;
    }

    .center-node {
        width: 260px;
        height: 180px;
    }

    .node-top-left     { top: 18%; left: 10%; }
    .node-top-right    { top: 18%; right: 10%; }
    .node-bottom-left  { top: 65%; left: 10%; }
    .node-bottom-right { top: 65%; right: 10%; }

    .lock-icon {
        width: 45px;
        height: 45px;
        font-size: 22px;
    }

    .modal-content {
        width: 85%;
        max-width: none;
        padding: 20px;
    }

    .progress-circle-container {
        width: 100px;
        height: 100px;
    }

    .percentage-text-inside {
        font-size: 22px;
    }

    .modal-btn {
        padding: 10px;
        font-size: 14px;
    }

    .final-key {
        bottom: 20px;
        right: 15px;
        padding: 12px 16px;
        font-size: 14px;
    }

    .back-button {
        top: 70px;
        left: 10px;
        padding: 8px 12px;
        font-size: 14px;
    }
}
</style>
@endpush

@section('content')
<div class="map-wrapper">

    <div id="progressModal" class="modal">
        <div class="modal-content">
            <h2 id="progressTitle">Magaling!</h2>
            <p>Natapos mo ang isang bahagi ng aralin.</p>
            
            <div class="progress-circle-container">
                <svg viewBox="0 0 100 100" class="circular-chart">
                    <circle cx="50" cy="50" r="42" class="circle-bg" />
                    <circle cx="50" cy="50" r="42" class="circle-progress" id="progressCircle" />
                </svg>
                <div class="percentage-text-inside" id="circlePercentage">0%</div>
            </div>
            
            <p>Tapusin ang lahat para ma-unlock ang Final Activity.</p>
            <button class="modal-btn" onclick="closeProgressModal()">Ipagpatuloy</button>
        </div>
    </div>

    <div id="finalModal" class="modal">
        <div class="modal-content">
            <h2>🎉 Mission Complete!</h2>
            <p>Kumpleto mo na ang lahat ng aralin!</p>
            <button class="modal-btn" onclick="goToFinal()">
                🚀 Pumunta sa Final Activity
            </button>
            <button class="modal-close" onclick="closeModal()">✖</button>
        </div>
    </div>

    <img src="{{ asset('pictures/mod2_innermap2.png') }}" class="background-map">

    <div class="map-overlay"></div>

    <div class="node center-node">
        <img src="{{ asset('pictures/isyualbay_node.png') }}">
    </div>

    <button class="node node-top-left"
        onclick="window.location.href='{{ route('node1.solid-waste') }}'">
        <img src="{{ asset('pictures/mod2_basura_node.png') }}">
    </button>

    <button class="node node-top-right locked" id="node2" onclick="goNode2()">
        <img src="{{ asset('pictures/mod2_kagubatan_node.png') }}">
        <span class="lock-icon">🔒</span>
    </button>

    <button class="node node-bottom-left locked" id="node3" onclick="goNode3()">
        <img src="{{ asset('pictures/mod2_klima_node.png') }}">
        <span class="lock-icon">🔒</span>
    </button>

    <button class="node node-bottom-right locked" id="node4" onclick="goNode4()">
        <img src="{{ asset('pictures/mod2_tugon_node.png') }}">
        <span class="lock-icon">🔒</span>
    </button>

    <button id="final-key" class="final-key" onclick="goFinal()">
        🔑 Unlock Final Activity
    </button>

    <a href="{{ route('student.map') }}" class="back-button">⬅️ Bumalik</a>

</div>

<x-vn />

<script>
function updateCircularProgress(percentage) {
    const circle = document.getElementById('progressCircle');
    const percentText = document.getElementById('circlePercentage');
    
    if (circle && percentText) {
        const radius = 42;
        const circumference = 2 * Math.PI * radius;
        const offset = circumference - (percentage / 100) * circumference;
        circle.style.strokeDasharray = `${circumference} ${circumference}`;
        circle.style.strokeDashoffset = offset;
        percentText.innerText = Math.round(percentage) + '%';
        
        // Always keep it green
        circle.style.stroke = "#5eae4e";
        
        // Also update the text color to match
        percentText.style.color = "#5eae4e";
    }
}

function getDone(key){
    return sessionStorage.getItem(key) === "true";
}

function updateMapProgress(){
    const node2 = document.getElementById("node2");
    const node3 = document.getElementById("node3");
    const node4 = document.getElementById("node4");
    const finalBtn = document.getElementById("final-key");

    const nodes = ["node1_done", "node2_done", "node3_done", "node4_done"];
    let completedCount = 0;
    nodes.forEach(key => {
        if (getDone(key)) completedCount++;
    });

    const percentage = (completedCount / nodes.length) * 100;

    const n1 = getDone("node1_done");
    const n2 = getDone("node2_done");
    const n3 = getDone("node3_done");
    const n4 = getDone("node4_done");

    if(n1) unlockNode(node2);
    if(n1 && n2) unlockNode(node3);
    if(n1 && n2 && n3) unlockNode(node4);

    const lastReported = parseInt(sessionStorage.getItem("last_reported_progress") || "0");
    
    if (percentage > lastReported && percentage < 100) {
        showProgressModal(percentage);
        sessionStorage.setItem("last_reported_progress", percentage);
    } else if (percentage === 100 && lastReported < 100) {
        goFinal();
        sessionStorage.setItem("last_reported_progress", 100);
    }

    if(percentage === 100){
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

function showProgressModal(percent) {
    updateCircularProgress(percent);
    document.getElementById("progressModal").style.display = "flex";
}

function closeProgressModal() {
    document.getElementById("progressModal").style.display = "none";
}

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

function closeModal(){
    document.getElementById("finalModal").style.display = "none";
}

function goFinal(){
    document.getElementById("finalModal").style.display = "flex";
}

function goToFinal(){
    window.location.href = "{{ route('module2.intro') }}";
}

window.onload = updateMapProgress;

document.addEventListener("DOMContentLoaded", function () {
    const dialogueKey = "module2_innermap";
    if (!hasSeen(dialogueKey)) {
        startDialogue([
            {
                text: "Ngayon, sisimulan na natin ang iyong paglalakbay sa modyul na ito. Makikita mo ang iba't ibang nodes sa mapa—ito ang mga bahagi o paksa na kailangan mong tapusin.",
                name: "Mga Guro",
                image: "{{ asset('pictures/vn_box_teacher3.png') }}"
            },
            {
                text: "Ang bawat node ay may sariling aralin at mga gawaing makakatulong sa iyong pag-unawa. Subukan mong sagutan ang mga ito at matuto habang ikaw ay naglalaro.",
                image: "{{ asset('pictures/vn_box_teacher1.png') }}"
            },
            {
                text: "Kapag natapos mo ang lahat ng nodes, maa-unlock ang huling gawain para subukin ang iyong natutunan.",
                image: "{{ asset('pictures/vn_box_teacher4.png') }}"
            }
        ], dialogueKey);
    }
});
</script>
@endsection