@extends('Students.studentslayout')
@section('title', 'Module 2 : Node 4')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Baloo+2:wght@700;800&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .background-map {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        object-fit: cover;
        z-index: -1;
    }

    html, body {
        scroll-behavior: smooth;
        background: radial-gradient(circle at 12% 18%, rgba(91,192,255,.22), transparent 34%),
                    radial-gradient(circle at 88% 20%, rgba(127,212,106,.22), transparent 34%),
                    radial-gradient(circle at 50% 82%, rgba(47,155,87,.20), transparent 36%),
                    linear-gradient(160deg, #0e2b1f 0%, #154733 38%, #1b5a42 68%, #24684d 100%);
    }

    body {
        overflow-x: hidden;
        font-family: 'Poppins', sans-serif;
        color: #1a3a2a;
    }

    /* Main Container */
    .page {
        max-width: 1100px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Hero Section */
    .hero {
        background: rgba(255, 255, 255, 0.88);
        border: 2px solid #c5e0c9;
        border-radius: 24px;
        padding: 28px 24px;
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(2px);
    }

    .title {
        font-family: 'Baloo 2', cursive;
        color: #1a5c38;
        font-size: 2rem;
        text-align: center;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }

    /* Info Cards */
    .info-cards {
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .info-card {
        background: #ffffff;
        border-left: 6px solid #2e8b57;
        border-radius: 14px;
        padding: 16px 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        transition: transform 0.2s ease;
    }

    .info-card:hover {
        transform: translateY(-2px);
    }

    .card-title {
        font-weight: 800;
        color: #2e7d32;
        font-size: 1.1rem;
        margin-bottom: 8px;
    }

    .info-card p {
        color: #2d4a3a;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    /* Cards Grid */
    .cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin: 28px 0 20px;
    }

    .card-btn {
        background: linear-gradient(135deg, #4caf50, #2e7d32);
        border: none;
        border-radius: 20px;
        padding: 20px 12px;
        cursor: pointer;
        transition: all 0.25s ease;
        text-align: center;
        color: white;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    .card-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.2);
        background: linear-gradient(135deg, #5cbf60, #3e9142);
    }

    .card-btn.opened {
        background: #9ca3af;
        opacity: 0.7;
        cursor: default;
        transform: none;
        box-shadow: none;
    }

    .card-btn.opened:hover {
        transform: none;
        background: #9ca3af;
    }

    .card-icon {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .card-title-main {
        font-weight: 800;
        font-size: 1rem;
        margin-bottom: 4px;
    }

    .card-sub {
        font-size: 0.7rem;
        opacity: 0.85;
    }

    /* Progress Badge */
    .progress-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .progress-badge {
        display: inline-block;
        background: #fbbf24;
        color: #92400e;
        font-size: 0.85rem;
        font-weight: 700;
        padding: 8px 20px;
        border-radius: 40px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Back Button */
    .back-button {
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 100;
        background-color: rgba(255, 255, 255, 0.92);
        padding: 10px 18px;
        border-radius: 10px;
        text-decoration: none;
        color: #1a1a1a;
        font-weight: 700;
        font-family: monospace;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        transition: transform 0.2s;
        font-size: 0.9rem;
    }

    .back-button:hover {
        transform: translateX(-4px);
    }

    .back-button.disabled {
        pointer-events: none;
        opacity: 0.5;
    }

    /* Modal Overlay */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(6px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.25s ease, visibility 0.25s ease;
        padding: 20px;
    }

    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .modal-container {
        background: white;
        border-radius: 32px;
        width: 100%;
        max-width: 900px;
        max-height: 85vh;
        overflow-y: auto;
        transform: scale(0.96);
        transition: transform 0.25s ease;
        box-shadow: 0 30px 50px rgba(0, 0, 0, 0.4);
    }

    .modal-overlay.active .modal-container {
        transform: scale(1);
    }

    .modal-container::-webkit-scrollbar {
        width: 8px;
    }

    .modal-container::-webkit-scrollbar-track {
        background: #e8f5e9;
        border-radius: 10px;
    }

    .modal-container::-webkit-scrollbar-thumb {
        background: #4caf50;
        border-radius: 10px;
    }

    /* Modal Content */
    .modal-inner {
        padding: 28px 30px;
    }

    .modal-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: #1a5c38;
        text-align: center;
        margin-bottom: 12px;
        font-family: 'Baloo 2', cursive;
    }

    .modal-sub {
        text-align: center;
        color: #4a6a5a;
        margin-bottom: 24px;
        font-size: 0.9rem;
    }

    .modal-body-grid {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    @media (min-width: 768px) {
        .modal-body-grid {
            flex-direction: row;
            gap: 28px;
        }
    }

    .modal-image {
        flex: 1;
    }

    .modal-image img {
        width: 100%;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        object-fit: cover;
    }

    .modal-text {
        flex: 1;
        color: #2d4a3a;
        line-height: 1.7;
        font-size: 0.95rem;
    }

    .modal-text strong {
        color: #2e7d32;
        display: block;
        margin-top: 12px;
        margin-bottom: 6px;
        font-size: 1rem;
    }

    .modal-text ul {
        padding-left: 20px;
        margin-bottom: 12px;
    }

    .modal-text li {
        margin-bottom: 6px;
    }

    .modal-source {
        font-size: 0.75rem;
        color: #7a9a8a;
        margin-top: 16px;
    }

    .modal-source a {
        color: #2e7d32;
        text-decoration: none;
    }

    .modal-source a:hover {
        text-decoration: underline;
    }

    .understand-btn {
        width: 100%;
        margin-top: 24px;
        background: #2e7d32;
        border: none;
        color: white;
        font-weight: 700;
        font-size: 1rem;
        padding: 14px;
        border-radius: 50px;
        cursor: pointer;
        transition: background 0.2s;
        font-family: 'Poppins', sans-serif;
    }

    .understand-btn:hover {
        background: #1b5e20;
    }

    /* Completion Modal */
    .completion-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1a5c38;
        text-align: center;
        margin-bottom: 20px;
        font-family: 'Baloo 2', cursive;
    }

    .completion-box {
        background: #e8f5e9;
        padding: 24px;
        border-radius: 20px;
        border: 1px solid #c8e6c9;
        text-align: left;
        margin-bottom: 24px;
        line-height: 1.7;
        color: #2d4a3a;
    }

    .completion-box p {
        margin-bottom: 14px;
    }

    .completion-btn {
        width: 100%;
        background: #2e7d32;
        border: none;
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
        padding: 14px;
        border-radius: 50px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .completion-btn:hover {
        background: #1b5e20;
    }

    @media (max-width: 640px) {
        .modal-inner {
            padding: 20px;
        }
        .modal-title {
            font-size: 1.4rem;
        }
        .cards {
            gap: 12px;
        }
        .card-btn {
            padding: 14px 8px;
        }
        .card-icon {
            font-size: 1.8rem;
        }
    }
</style>
@endpush

@section('content')
<img src="{{ asset('pictures/module2_inner_map2.png') }}" class="background-map">
<a href="{{ route('inner.map2') }}" class="back-button" id="backButton">⬅️ Bumalik</a>

<div class="page">
    <section class="hero">
        <h1 class="title">🏛️ Kilalanin ang Tugon ng Pamahalaan</h1>

        <div class="info-cards">
            <div class="info-card">
                <div class="card-title">Gabay na Tanong</div>
                <p>Paano nakakatulong ang mga batas at programa ng pamahalaan sa paghahanda at pagtugon sa mga kalamidad?</p>
            </div>

            <div class="info-card">
                <div class="card-title">📘 Alamin Natin</div>
                <p>Ang Republic Act 10121 (Disaster Risk Reduction and Management Act), Republic Act 9729 (Climate Change Act), Republic Act 9003 (Ecological Solid Waste Management Act), kasama ang mga ahensya tulad ng APSEMO, ay nagsisilbing gabay at sandigan ng mga mamamayan upang maging handa at ligtas sa panahon ng sakuna.</p>
            </div>
        </div>

        <!-- Cards Grid -->
        <div class="cards">
            <button onclick="openCard(0)" class="card-btn" data-index="0">
                <div class="card-icon">🛡️</div>
                <div class="card-title-main">RA 10121</div>
                <div class="card-sub">Disaster Law</div>
            </button>

            <button onclick="openCard(1)" class="card-btn" data-index="1">
                <div class="card-icon">📡</div>
                <div class="card-title-main">Early Warning System</div>
                <div class="card-sub">Alert System</div>
            </button>

            <button onclick="openCard(2)" class="card-btn" data-index="2">
                <div class="card-icon">🚨</div>
                <div class="card-title-main">Evacuation Program</div>
                <div class="card-sub">Safe Movement</div>
            </button>

            <button onclick="openCard(3)" class="card-btn" data-index="3">
                <div class="card-icon">🌍</div>
                <div class="card-title-main">RA 9729</div>
                <div class="card-sub">Climate Act</div>
            </button>

            <button onclick="openCard(4)" class="card-btn" data-index="4">
                <div class="card-icon">♻️</div>
                <div class="card-title-main">RA 9003</div>
                <div class="card-sub">Waste Law</div>
            </button>

            <button onclick="openCard(5)" class="card-btn" data-index="5">
                <div class="card-icon">🚑</div>
                <div class="card-title-main">APSEMO</div>
                <div class="card-sub">Emergency Team</div>
            </button>
        </div>

        <!-- Progress Indicator -->
        <div class="progress-wrapper">
            <div class="progress-badge">
                Nabuksan: <span id="progress">0</span> / 6 cards
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div id="modal" class="modal-overlay">
    <div class="modal-container">
        <div id="modalContent" class="modal-inner"></div>
    </div>
</div>

<script>
const data = [
    {
        title: "Republic Act 10121",
        img: "{{ asset('pictures/Node4/ra10121.png') }}",
        content: `
            <div class="modal-body-grid">
                <div class="modal-image">
                    <img src="{{ asset('pictures/Node4/ra10121.png') }}" alt="RA 10121">
                </div>
                <div class="modal-text">
                    <strong>📌 Layunin:</strong>
                    <ul>
                        <li>Paghahanda bago, habang, at pagkatapos ng sakuna</li>
                        <li>Pagtukoy sa mga hazard-prone areas</li>
                        <li>Pagtatag ng Disaster Risk Reduction and Management (DRRM) councils</li>
                    </ul>
                    <strong>📍 Halimbawa sa Albay:</strong>
                    <ul>
                        <li>Regular na pagsasagawa ng disaster drills</li>
                        <li>Koordinadong rescue operations sa panahon ng bagyo at pagputok ng bulkan</li>
                    </ul>
                    <strong>💡 Mahalagang Tandaan:</strong>
                    <ul>
                        <li>Ito ang pangunahing batas na nagtataguyod ng komprehensibong disaster management sa bansa</li>
                    </ul>
                    <div class="modal-source">Source: <a href="https://lawphil.net/statutes/repacts/ra2010/ra_10121_2010.html" target="_blank">lawphil.net</a></div>
                </div>
            </div>
        `
    },
    {
        title: "Early Warning System",
        img: "{{ asset('pictures/Node4/early_warning_system.png') }}",
        content: `
            <div class="modal-body-grid">
                <div class="modal-image">
                    <img src="{{ asset('pictures/Node4/early_warning_system.png') }}" alt="Early Warning System">
                </div>
                <div class="modal-text">
                    <strong>📌 Layunin:</strong>
                    <ul>
                        <li>Magbigay ng maagang impormasyon upang makapaghanda ang mga mamamayan</li>
                        <li>Bawasan ang pinsala sa buhay at ari-arian</li>
                    </ul>
                    <strong>📍 Halimbawa sa Albay:</strong>
                    <ul>
                        <li>Text alerts mula sa pamahalaang panlalawigan</li>
                        <li>Pagtunog ng sirena bilang babala ng paparating na bagyo o lahar</li>
                        <li>Regular na abiso mula sa PAGASA at PHIVOLCS</li>
                    </ul>
                    <strong>💡 Mahalagang Tandaan:</strong>
                    <ul>
                        <li>Ang maagang babala ay susi sa pagliligtas ng buhay at pagbabawas ng pinsala</li>
                    </ul>
                    <div class="modal-source">Source: <a href="https://www.gsma.com/solutions-and-impact/connectivity-for-good/mobile-for-development/gsma-resources/ews-philippines-mobile-and-digital-technologies/" target="_blank">gsma.com</a></div>
                </div>
            </div>
        `
    },
    {
        title: "Evacuation Program",
        img: "{{ asset('pictures/Node4/evacuation.png') }}",
        content: `
            <div class="modal-body-grid">
                <div class="modal-image">
                    <img src="{{ asset('pictures/Node4/evacuation.png') }}" alt="Evacuation Program">
                </div>
                <div class="modal-text">
                    <strong>📌 Layunin:</strong>
                    <ul>
                        <li>Ilipat ang mga residente mula sa peligrosong lugar patungo sa ligtas na evacuation centers</li>
                        <li>Siguruhin ang kaligtasan ng mga pamilya sa panahon ng kalamidad</li>
                    </ul>
                    <strong>📍 Halimbawa sa Albay:</strong>
                    <ul>
                        <li>Preemptive evacuation ng mga residente sa paligid ng Bulkang Mayon</li>
                        <li>Pagtungo sa mga designated evacuation centers bago dumating ang bagyo</li>
                        <li>Koordinadong transportasyon para sa mga vulnerable na sektor</li>
                    </ul>
                    <strong>💡 Mahalagang Tandaan:</strong>
                    <ul>
                        <li>Ang maagang paglikas ay napatunayang nakapagliligtas ng libu-libong buhay</li>
                    </ul>
                    <div class="modal-source">Source: <a href="https://legazpi.gov.ph/wp-content/uploads/2023/09/CDRRMO-PAGE-189-224.pdf" target="_blank">legazpi.gov.ph</a></div>
                </div>
            </div>
        `
    },
    {
        title: "Republic Act 9729",
        img: "{{ asset('pictures/Node4/ra9729.png') }}",
        content: `
            <div class="modal-body-grid">
                <div class="modal-image">
                    <img src="{{ asset('pictures/Node4/ra9729.png') }}" alt="RA 9729">
                </div>
                <div class="modal-text">
                    <strong>📌 Layunin:</strong>
                    <ul>
                        <li>Maglatag ng mga hakbang upang matugunan ang epekto ng climate change</li>
                        <li>Palakasin ang kakayahan ng mga komunidad na umangkop sa pagbabago ng klima</li>
                    </ul>
                    <strong>📍 Halimbawa sa Albay:</strong>
                    <ul>
                        <li>Paghahanda sa mas malalakas at madalas na bagyo</li>
                        <li>Pagpapatupad ng mga programang pangkalikasan at disaster preparedness</li>
                    </ul>
                    <strong>💡 Mahalagang Tandaan:</strong>
                    <ul>
                        <li>Ang batas na ito ay nagtataguyod ng pangmatagalang proteksyon ng kalikasan at komunidad</li>
                    </ul>
                    <div class="modal-source">Source: <a href="https://lawphil.net/statutes/repacts/ra2009/ra_9729_2009.html" target="_blank">lawphil.net</a></div>
                </div>
            </div>
        `
    },
    {
        title: "Republic Act 9003",
        img: "{{ asset('pictures/Node4/ra9003.png') }}",
        content: `
            <div class="modal-body-grid">
                <div class="modal-image">
                    <img src="{{ asset('pictures/Node4/ra9003.png') }}" alt="RA 9003">
                </div>
                <div class="modal-text">
                    <strong>📌 Layunin:</strong>
                    <ul>
                        <li>Magpatupad ng wastong pamamahala ng solid waste</li>
                        <li>Mapanatili ang kalinisan at kalusugan ng kapaligiran</li>
                    </ul>
                    <strong>📍 Halimbawa sa Albay:</strong>
                    <ul>
                        <li>Paghihiwalay ng basura sa barangay (waste segregation)</li>
                        <li>Pagkakaroon ng Materials Recovery Facility (MRF)</li>
                        <li>Regular na clean-up drive sa mga komunidad at baybayin</li>
                    </ul>
                    <strong>💡 Mahalagang Tandaan:</strong>
                    <ul>
                        <li>Ang tamang pamamahala ng basura ay nakatutulong upang maiwasan ang pagbaha at sakit</li>
                    </ul>
                    <div class="modal-source">Source: <a href="https://pepp.emb.gov.ph/wp-content/uploads/2016/06/RA-9003-Ecological-Solid-Waste-Management-Act-of-2000.pdf" target="_blank">emb.gov.ph</a></div>
                </div>
            </div>
        `
    },
    {
        title: "APSEMO",
        img: "{{ asset('pictures/Node4/apsemo.png') }}",
        content: `
            <div class="modal-body-grid">
                <div class="modal-image">
                    <img src="{{ asset('pictures/Node4/apsemo.png') }}" alt="APSEMO">
                </div>
                <div class="modal-text">
                    <strong>📌 Mandato:</strong>
                    <ul>
                        <li>Manguna sa paghahanda, pagtugon, at pagbawas ng panganib dulot ng sakuna sa Albay</li>
                        <li>Koordinahin ang mga rescue at relief operations</li>
                    </ul>
                    <strong>📍 Mga Programa sa Albay:</strong>
                    <ul>
                        <li>Pagpapatupad ng preemptive evacuation sa mga bulkan at bahaing lugar</li>
                        <li>Pagsasagawa ng disaster drills at capability trainings</li>
                        <li>Mabilis na koordinasyon ng rescue at relief operations</li>
                    </ul>
                    <strong>💡 Mahalagang Tandaan:</strong>
                    <ul>
                        <li>Ang APSEMO ay kinikilalang modelo ng disaster preparedness sa buong bansa</li>
                    </ul>
                    <div class="modal-source">Source: <a href="https://albay.gov.ph/provincial-public-safety-and-emergency-management-office-apsemo/" target="_blank">albay.gov.ph</a></div>
                </div>
            </div>
        `
    }
];

let openedCards = new Set();
let currentCardIndex = null;

function openCard(index) {
    if (openedCards.has(index)) return;

    const backBtn = document.getElementById('backButton');
    if (backBtn) backBtn.classList.add('disabled');

    currentCardIndex = index;

    const modal = document.getElementById('modal');
    const modalContent = document.getElementById('modalContent');

    modalContent.innerHTML = `
        <div class="modal-title">${data[index].title}</div>
        <div class="modal-sub">${getSubtitle(index)}</div>
        ${data[index].content}
        <button class="understand-btn" id="modalUnderstandBtn">Naiintindihan ko ✔</button>
    `;

    modal.classList.add('active');

    const understandBtn = document.getElementById('modalUnderstandBtn');
    if (understandBtn) {
        understandBtn.onclick = closeModal;
    }
}

function getSubtitle(index) {
    const subtitles = [
        "Disaster Risk Reduction and Management Act of 2010",
        "Sistema ng Babala bago ang Sakuna",
        "Programa sa Maagang Paglikas",
        "Climate Change Act of 2009",
        "Ecological Solid Waste Management Act of 2000",
        "Albay Public Safety and Emergency Management Office"
    ];
    return subtitles[index] || "";
}

function closeModal() {
    const modal = document.getElementById('modal');
    const backBtn = document.getElementById('backButton');

    if (currentCardIndex !== null && !openedCards.has(currentCardIndex)) {
        openedCards.add(currentCardIndex);

        const progressSpan = document.getElementById('progress');
        if (progressSpan) {
            progressSpan.textContent = openedCards.size;
        }

        const cardButtons = document.querySelectorAll('.card-btn');
        if (cardButtons[currentCardIndex]) {
            cardButtons[currentCardIndex].classList.add('opened');
            cardButtons[currentCardIndex].disabled = true;
        }
    }

    modal.classList.remove('active');
    if (backBtn) backBtn.classList.remove('disabled');

    if (openedCards.size === data.length) {
        sessionStorage.setItem("node4_done", "true");
        setTimeout(() => {
            showCompletionMessage();
        }, 300);
    }

    currentCardIndex = null;
}

function showCompletionMessage() {
    const modal = document.getElementById('modal');
    const modalContent = document.getElementById('modalContent');
    const backBtn = document.getElementById('backButton');

    if (backBtn) backBtn.classList.add('disabled');

    modalContent.innerHTML = `
        <div class="completion-title">🎉 Magaling!</div>
        <div class="completion-box">
            <p>Mahusay! Naunawaan mo ang kahalagahan ng mga batas, programa, at ahensya ng pamahalaan sa paghahanda at pagtugon sa sakuna.</p>
            <p>Ang Republic Act 10121, RA 9729, RA 9003, at ang APSEMO ay ilan lamang sa mga hakbang na isinagawa upang maprotektahan ang mga mamamayan laban sa epekto ng kalamidad at pagbabago ng klima.</p>
            <p>Ang maagang paglikas, tamang babala, at wastong pamamahala ng basura ay mahahalagang gawi na dapat isabuhay ng bawat isa upang mabawasan ang pinsala at mailigtas ang buhay.</p>
            <p>Patuloy na maging handa, makilahok sa mga programa ng pamahalaan, at pangalagaan ang kalikasan — dahil ang kaligtasan ng bawat isa ay responsibilidad ng lahat.</p>
            <p class="font-semibold" style="font-weight: 700; margin-top: 12px;">Tandaan: Ang kahandaan ay susi sa kaligtasan.</p>
        </div>
        <button class="completion-btn" id="completionBackBtn">Bumalik sa Mapa 🗺️</button>
    `;

    modal.classList.add('active');

    const completionBtn = document.getElementById('completionBackBtn');
    if (completionBtn) {
        completionBtn.onclick = function() {
            window.location.href = "{{ route('inner.map2') }}";
        };
    }
}

// Close modal when clicking outside
document.getElementById('modal').addEventListener('click', function(e) {
    if (e.target === this && currentCardIndex !== null) {
        closeModal();
    }
});

// Escape key to close modal
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('modal');
        if (modal.classList.contains('active') && currentCardIndex !== null) {
            closeModal();
        }
    }
});

// Initialize progress display
document.addEventListener('DOMContentLoaded', function() {
    const progressSpan = document.getElementById('progress');
    if (progressSpan) {
        progressSpan.textContent = openedCards.size;
    }
});
</script>
@endsection