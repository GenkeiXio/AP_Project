<!DOCTYPE html>
<html lang="fil">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Node 4 - Government Response</title>

<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<script src="https://cdn.tailwindcss.com"></script>

<style>
body {
    background: linear-gradient(180deg, #e6f4d7, #f5e6c8);
    overflow-x: hidden;
}

/* 🎮 CENTER EVERYTHING */
.main-container {
    min-height: 100vh;
    display: flex;
    flex-direction: column;

    justify-content: center;   /* 👈 center vertically */
    align-items: center;
}

/* 🎯 HEADER */
.header {
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
    max-width: 600px;

    isolation: isolate; /* 👈 prevents blending/overlap */
    position: relative;   /* 👈 ADD THIS */
    z-index: 1;           /* 👈 KEEP BELOW MODAL */
}

/* 🎮 CARD STYLE */
.card-btn {
    width: 100%;   /* 👈 fills grid space */
    min-height: 120px;
    background: linear-gradient(135deg, #4ade80, #22c55e);

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    animation: popIn 0.4s ease;
}

.card-btn:hover {
    transform: translateY(-6px) scale(1.08);
    box-shadow: 0 15px 30px rgba(0,0,0,0.25);
}

.card-btn.opened {
    background: #9ca3af;
    opacity: 0.8;
}

/* 🎮 CARDS GRID */
.cards {
    display: grid;
    margin-bottom: 40px;

    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 25px;

    width: 100%;
    max-width: 900px;   /* 👈 allows expansion */
}

@keyframes popIn {
    from { transform: scale(0.8); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

/* 📱 RESPONSIVE */
@media(max-width: 768px){
    .cards {
        grid-template-columns: repeat(2, 180px);
    }
}

/* 🎯 MODAL */
.modal-content {
    transition: 0.3s;
    font-size: 1.2rem;
}

.modal-content ul li {
    margin-bottom: 6px;
}

.back-button {
	position: absolute;
	top: 20px;
	left: 20px;
	z-index: 100;
	background-color: rgba(255, 255, 255, 0.9);
	padding: 10px 15px;
	border-radius: 8px;
	text-decoration: none;
	color: #1a1a1a;
	font-weight: bold;
	font-family: 'Courier New', Courier, monospace;
	box-shadow: 0 4px 6px rgba(0,0,0,0.3);
	transition: transform 0.2s;
}

</style>
</head>

<body>
<a href="{{ route('inner.map2') }}" class="back-button">⬅️ Bumalik</a>

<!-- 🌿 DECOR -->
<span class="deco deco-1">🌿</span>
<span class="deco deco-2">🦋</span>
<span class="deco deco-3">🌸</span>
<span class="deco deco-4">🗺️</span>

<div class="main-container">

    <!-- 🎯 HEADER -->
    <div class="header">

        <div class="text-xl mb-2">🏛️ 🗺️ ✨</div>

        <h1 class="text-4xl font-extrabold text-green-900 mb-3" style="font-family:'Baloo 2'">
            Kilalanin ang Tugon ng Pamahalaan
        </h1>

        <p class="text-gray-700 text-sm mb-4">
            Tuklasin kung paano tumutulong ang mga batas at programa sa paghahanda at pagtugon sa sakuna.
        </p>

        <div class="inline-block bg-yellow-200 text-yellow-900 text-sm px-4 py-1 rounded-full font-semibold shadow">
            Nabuksan: <span id="progress">0</span> / 6 cards
        </div>

    </div>

    <!-- 🎮 CARDS -->
    <div class="cards">

        <button onclick="openCard(0)" class="card-btn text-white p-4 rounded-xl text-center">
            <div class="text-3xl">🛡️</div>
            <div class="font-bold text-base">RA 10121</div>
            <div class="text-xs opacity-80">Disaster Law</div>
        </button>

        <button onclick="openCard(1)" class="card-btn text-white p-4 rounded-xl text-center">
            <div class="text-2xl">📡</div>
            <div class="font-bold text-sm">Early Warning</div>
            <div class="text-xs opacity-80">Alert System</div>
        </button>

        <button onclick="openCard(2)" class="card-btn text-white p-4 rounded-xl text-center">
            <div class="text-2xl">🚨</div>
            <div class="font-bold text-sm">Evacuation</div>
            <div class="text-xs opacity-80">Safe Movement</div>
        </button>

        <button onclick="openCard(3)" class="card-btn text-white p-4 rounded-xl text-center">
            <div class="text-2xl">🌍</div>
            <div class="font-bold text-sm">RA 9729</div>
            <div class="text-xs opacity-80">Climate Act</div>
        </button>

        <button onclick="openCard(4)" class="card-btn text-white p-4 rounded-xl text-center">
            <div class="text-2xl">♻️</div>
            <div class="font-bold text-sm">RA 9003</div>
            <div class="text-xs opacity-80">Waste Law</div>
        </button>

        <button onclick="openCard(5)" class="card-btn text-white p-4 rounded-xl text-center">
            <div class="text-2xl">🚑</div>
            <div class="font-bold text-sm">APSEMO</div>
            <div class="text-xs opacity-80">Emergency Team</div>
        </button>

    </div>

</div>

<!-- 🎯 MODAL -->
<div id="modal" class="fixed inset-0 flex items-center justify-center bg-black/70 opacity-0 invisible transition p-6 z-50">

    <div class="bg-white rounded-2xl w-full max-w-5xl modal-content scale-95 opacity-0 overflow-hidden shadow-2xl">

        <!-- 📄 CONTENT -->
        <div id="modalContent" class="max-h-[85vh] overflow-y-auto p-8"></div>

    </div>
</div>

<script>
const data = [
    {
        title:"Republic Act 10121",
        img:"{{ asset('pictures/Node4/ra10121.png') }}",
        content:`
        <b>Republic Act 10121</b><br>
        ➡️ Disaster Risk Reduction and Management Act of 2010

        <br><br>

        📌 <b>Layunin:</b>
        <ul style="padding-left:18px;">
            <li>Paghahanda bago, habang, at pagkatapos ng sakuna</li>
        </ul>

        📍 <b>Halimbawa sa Albay:</b>
        <ul style="padding-left:18px;">
            <li>Disaster drills</li>
            <li>Rescue operations</li>
        </ul>

        💡 <b>Tandaan:</b>
        <ul style="padding-left:18px;">
            <li>Ito ang pangunahing batas sa disaster management</li>
        </ul>

        <br>
        <small>Source: 
        <a href="https://lawphil.net/statutes/repacts/ra2010/ra_10121_2010.html" target="_blank">
        lawphil.net
        </a>
        </small>
        `
    },
    {
        title:"Early Warning System",
        img:"{{ asset('pictures/Node4/early_warning_system.png') }}",
        content:`
        <b>Early Warning System</b><br>
        ➡️ Sistema ng Babala bago ang Sakuna

        <br><br>

        📌 <b>Layunin:</b>
        <ul style="padding-left:18px;">
            <li>Magbigay ng maagang babala upang makapaghanda ang mga mamamayan</li>
        </ul>

        📍 <b>Halimbawa sa Albay:</b>
        <ul style="padding-left:18px;">
            <li>📱 Text alerts mula sa pamahalaan</li>
            <li>🔊 Pagtunog ng sirena</li>
            <li>🌦️ Abiso mula sa PAGASA</li>
        </ul>

        💡 <b>Tandaan:</b>
        <ul style="padding-left:18px;">
            <li>Mahalaga ito upang maiwasan ang pinsala at mailigtas ang buhay</li>
        </ul>

        <br>
        <small>Source:
        <a href="https://www.gsma.com/solutions-and-impact/connectivity-for-good/mobile-for-development/gsma-resources/ews-philippines-mobile-and-digital-technologies/" target="_blank">
        gsma.com
        </a>
        </small>
        `
    },
    {
        title:"Evacuation Program",
        img:"{{ asset('pictures/Node4/evacuation.png') }}",
        content:`
        <b>Evacuation Program</b><br>
        ➡️ Programa sa Maagang Paglikas

        <br><br>

        📌 <b>Layunin:</b>
        <ul style="padding-left:18px;">
            <li>Ilipat ang mga tao sa ligtas na lugar bago at habang may sakuna</li>
        </ul>

        📍 <b>Halimbawa sa Albay:</b>
        <ul style="padding-left:18px;">
            <li>Paglikas ng mga residente sa paligid ng Bulkang Mayon</li>
            <li>Pagtungo sa mga evacuation centers bago ang bagyo</li>
        </ul>

        💡 <b>Tandaan:</b>
        <ul style="padding-left:18px;">
            <li>Ang maagang paglikas ay nakapagliligtas ng buhay at nakababawas ng pinsala</li>
        </ul>

        <br>
        <small>Source:
        <a href="https://legazpi.gov.ph/wp-content/uploads/2023/09/CDRRMO-PAGE-189-224.pdf" target="_blank">
        legazpi.gov.ph
        </a>
        </small>
        `
    },
    {
        title:"Republic Act 9729",
        img:"{{ asset('pictures/Node4/ra9729.png') }}",
        content:`
        <b>Republic Act 9729</b><br>
        ➡️ Climate Change Act of 2009

        <br><br>

        📌 <b>Layunin:</b>
        <ul style="padding-left:18px;">
            <li>Maglatag ng mga hakbang upang matugunan at mapaghandaan ang epekto ng climate change</li>
        </ul>

        📍 <b>Halimbawa sa Albay:</b>
        <ul style="padding-left:18px;">
            <li>Paghahanda sa mas malalakas na bagyo</li>
            <li>Pagpapatupad ng mga programang pangkalikasan at disaster preparedness</li>
        </ul>

        💡 <b>Tandaan:</b>
        <ul style="padding-left:18px;">
            <li>Tumutulong ang batas na ito sa pangmatagalang proteksyon ng kalikasan at komunidad</li>
        </ul>

        <br>
        <small>Source:
        <a href="https://lawphil.net/statutes/repacts/ra2009/ra_9729_2009.html" target="_blank">
        lawphil.net
        </a>
        </small>
        `
    },
    {
        title:"Republic Act 9003",
        img:"{{ asset('pictures/Node4/ra9003.png') }}",
        content:`
        <b>Republic Act 9003</b><br>
        ➡️ Ecological Solid Waste Management Act of 2000

        <br><br>

        📌 <b>Layunin:</b>
        <ul style="padding-left:18px;">
            <li>Magpatupad ng wastong pamamahala ng basura upang mapanatili ang kalinisan ng kapaligiran</li>
        </ul>

        📍 <b>Halimbawa sa Albay:</b>
        <ul style="padding-left:18px;">
            <li>Paghihiwalay ng basura sa barangay (waste segregation)</li>
            <li>Pagkakaroon ng Materials Recovery Facility (MRF)</li>
            <li>Mga clean-up drive sa komunidad</li>
        </ul>

        💡 <b>Tandaan:</b>
        <ul style="padding-left:18px;">
            <li>Ang tamang pamamahala ng basura ay nakatutulong upang maiwasan ang pagbaha at sakit</li>
        </ul>

        <br>
        <small>Source:
        <a href="https://pepp.emb.gov.ph/wp-content/uploads/2016/06/RA-9003-Ecological-Solid-Waste-Management-Act-of-2000.pdf" target="_blank">
        emb.gov.ph
        </a>
        </small>
        `
    },
    {
        title:"APSEMO",
        img:"{{ asset('pictures/Node4/apsemo.png') }}",
        content:`
        <b>APSEMO</b><br>
        ➡️ Albay Public Safety and Emergency Management Office

        <br><br>

        📌 <b>Layunin:</b>
        <ul style="padding-left:18px;">
            <li>Manguna sa paghahanda, pagtugon, at pagbawas ng panganib dulot ng sakuna</li>
        </ul>

        📍 <b>Halimbawa sa Albay:</b>
        <ul style="padding-left:18px;">
            <li>Pagpapatupad ng preemptive evacuation</li>
            <li>Pagsasagawa ng disaster drills at trainings</li>
            <li>Koordinasyon ng rescue at relief operations</li>
        </ul>

        💡 <b>Tandaan:</b>
        <ul style="padding-left:18px;">
            <li>Ang APSEMO ang pangunahing ahensya sa Albay na modelo sa disaster preparedness</li>
        </ul>

        <br>
        <small>Source:
        <a href="https://albay.gov.ph/provincial-public-safety-and-emergency-management-office-apsemo/" target="_blank">
        albay.gov.ph
        </a>
        </small>
        `
    }
];

let openedCards = new Set();
let currentCardIndex = null;

/* 🎮 OPEN CARD */
function openCard(index){
    document.querySelector(".back-button").classList.add("disabled");
    currentCardIndex = index; // ✅ TRACK CURRENT

    const modal = document.getElementById("modal");
    const content = document.getElementById("modalContent");
    
    content.innerHTML = `
        <h2 style="
            font-weight:900;
            font-size:28px;
            margin-bottom:20px;
            text-align:center;
            color:#14532d;
        ">
            ${data[index].title}
        </h2>

        <div style="
            display:flex;
            gap:30px;
            align-items:flex-start;
            flex-wrap:wrap;
        ">

            <!-- LEFT: IMAGE -->
            <div style="
                flex:1;
                min-width:280px;
            ">
                <img src="${data[index].img}" style="
                    width:100%;
                    border-radius:16px;
                    object-fit:cover;
                    box-shadow:0 10px 20px rgba(0,0,0,0.15);
                ">
            </div>

            <!-- RIGHT: TEXT -->
            <div style="
                flex:1;
                min-width:280px;
                font-size:18px;
                line-height:1.9;
                color:#333;
            ">
                ${data[index].content}
            </div>

        </div>

        <!-- BUTTON -->
        <button onclick="closeModal()" style="
            margin-top:25px;
            width:100%;
            padding:16px;
            background:#16a34a;
            color:white;
            border:none;
            border-radius:12px;
            font-weight:800;
            font-size:16px;
            cursor:pointer;
            box-shadow:0 6px 12px rgba(0,0,0,0.2);
            transition:0.2s;
        " 
        onmouseover="this.style.transform='scale(1.03)'"
        onmouseout="this.style.transform='scale(1)'"
        >
            Naiintindihan ko ✔
        </button>
    `;

    modal.classList.remove("opacity-0","invisible");
    modal.querySelector(".modal-content").classList.remove("scale-95","opacity-0");
}

/* ❌ CLOSE MODAL (COUNT HERE ONLY) */
function closeModal(){

    const modal = document.getElementById('modal');

    // ✅ COUNT AFTER USER CLOSES
    if(currentCardIndex !== null && !openedCards.has(currentCardIndex)){

        openedCards.add(currentCardIndex);

        document.getElementById("progress").innerText = openedCards.size;

        // 🎮 turn card gray
        document.querySelectorAll('.card-btn')[currentCardIndex]?.classList.add("opened");
    }

    modal.classList.add('invisible','opacity-0');

    // 🎉 IF COMPLETE
    if(openedCards.size === data.length){

        sessionStorage.setItem("node4_done", "true");

        setTimeout(() => {
            showCompletionMessage();
        }, 300);
    }

    currentCardIndex = null;
}

/* 🎉 COMPLETION */
function showCompletionMessage(){

    const modal = document.getElementById('modal');
    const box = modal.querySelector('.modal-content');

    document.getElementById('modalContent').innerHTML = `
        <div class="text-center">

            <h2 class="text-2xl font-extrabold text-green-800 mb-4">
                🎉 Magaling!
            </h2>

            <div class="bg-green-50 p-6 rounded-xl border shadow text-base md:text-lg leading-relaxed text-gray-800 text-left mb-6">

                <p class="mb-3">
                Naunawaan mo ang kahalagahan ng mga batas, programa, at ahensya sa paghahanda at pagtugon sa sakuna.
                </p>

                <p class="mb-3">
                Ang mga ito ay gabay sa tamang pag-iwas, paghahanda, at pagkilos sa panahon ng kalamidad.
                </p>

                <p class="mb-3">
                Sa early warning, evacuation, at tamang pangangalaga sa kalikasan, nababawasan ang pinsala.
                </p>

                <p class="mb-3">
                Mahalaga ang pakikiisa ng bawat mamamayan upang maging ligtas ang komunidad.
                </p>

                <p class="font-semibold text-green-900 mt-4">
                Tandaan—ang kaligtasan ay nagsisimula sa kahandaan.
                </p>

            </div>

            <button onclick="goToMap()" 
                class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold text-lg">
                Bumalik sa Mapa 🗺️
            </button>

        </div>
    `;

    modal.classList.remove('invisible','opacity-0');
    box.classList.remove('scale-95','opacity-0');
}

/* 🔁 BACK TO MAP */
function goToMap(){
    window.location.href = "{{ route('inner.map2') }}";
}
</script>

</body>
</html>