<!-- @extends('Students.studentslayout') -->

@section('title', 'World Map')

@push('styles')
<style>
body, html {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    overflow: hidden; /* Prevents scrollbars if you want a fixed game screen */
}

.page-content {
    max-width: 1350px !important; 
}

.map-wrapper {
    width: 100vw;
    height: 100vh;
    padding: 0; /* ❌ remove spacing */
    margin: 0;
}

.map-container {
    position: relative;
    width: 100vw;   /* FULL WIDTH */
    height: 100vh;  /* FULL HEIGHT */
    
    border-radius: 0; /* remove rounded edges */
    overflow: hidden;
    box-shadow: none; /* optional: remove floating effect */
}

.background-map {
    width: 100%;
    height: 100%;
    object-fit: cover; /* fills screen nicely */
}

.pin {
    position: absolute;
    width: 120px; 
    height: 160px; 
    
    background-image: url('{{ asset('pictures/map_pin.png') }}');
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center bottom;
    background-color: transparent;
    border: none;
    cursor: pointer;
    z-index: 10;
    
    /* Anchor at Tip */
    transform: translate(-50%, -100%); 
    
    /* FIXED: Changed 'pulse' to 'pinPulse' to match your keyframes */
    animation: pinPulse 2s infinite ease-in-out;
    transition: transform 0.2s ease;
}

/* Hover Effects */
.pin:hover {
    transform: translate(-50%, -100%) scale(1.1);
}

/* Positioning the 3 pins (Adjust these % values to fit your map) */
.location-1 { top: 50%; left: 25%;}
.location-2 { top: 53%; left: 50%; }
.location-3 { top: 59%; left: 82%; }


/* Simple Tooltip */
.pin .tooltip {
    visibility: visible;
    position: absolute;
    /* FIXED: Reduced from 145px to 125px to sit right above the pin head */
    bottom: 125px; 
    left: 50%;
    transform: translateX(-50%);
    
    background-color: rgba(26, 26, 26, 0.9);
    color: #fff;
    padding: 5px 15px;
    border-radius: 8px;
    font-family: 'Courier New', Courier, monospace;
    font-size: 18px;
    font-weight: bold;
    white-space: nowrap;
    box-shadow: 0 4px 6px rgba(0,0,0,0.3);
    transition: all 0.2s ease;
}

.pin:hover .tooltip {
    background-color: #ffa502; /* Turns orange on hover */
    color: #000;
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

.back-button:hover {
    transform: scale(1.05);
    background-color: #ffffff;
}

.page-content {
    max-width: 100% !important;
    padding: 0 !important;
}

@keyframes pinPulse {
    0% { filter: drop-shadow(0 0 5px rgba(255, 71, 87, 0.4)); }
    50% { filter: drop-shadow(0 0 20px rgba(255, 71, 87, 0.9)); }
    100% { filter: drop-shadow(0 0 5px rgba(255, 71, 87, 0.4)); }
}

/* MODAL (matches your theme) */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 9999;

    background: rgba(0,0,0,0.6);
    backdrop-filter: blur(4px);

    display: none;
    justify-content: center;
    align-items: center;
}

.modal.show {
    display: flex;
}

.modal-content {
    background: #ffffff;
    padding: 25px;
    width: 90%;
    max-width: 600px;
    border-radius: 18px;
    text-align: left;
    box-shadow: 0 15px 40px rgba(0,0,0,0.25);
    animation: popIn 0.3s ease;
}

.modal-section {
    background: #f8fdf8;
    border-left: 6px solid #2e7d32;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 10px;
}

.modal-section h3 {
    margin-bottom: 8px;
    font-weight: 800;
    color: #1b5e20;
}

.modal-section p {
    font-size: 0.95rem;
    line-height: 1.6;
}

.close-btn {
    float: right;
    font-size: 1.5rem;
    cursor: pointer;
}

@keyframes popIn {
    from {
        transform: scale(0.8);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}
</style>
@endpush

@section('content')
<!-- INTRO MODAL -->
<div id="introModal" class="modal show">
    <div class="modal-content">

        <span class="close-btn" onclick="closeIntro()">✖</span>

        <div class="modal-section">
            <h3>🧭 III. EXPLORE (CONCEPT MAP)</h3>
            <p><strong>Create a clickable concept map with 4 nodes</strong></p>
        </div>

        <div class="modal-section">
            <h3>📘 Paglalarawan</h3>
            <p>
                Ang Albay ay nahaharap sa iba’t ibang suliraning pangkapaligiran tulad ng basura,
                pagkakalbo ng kagubatan, at climate change. Dahil sa lokasyon nito at presensya ng
                Bulkang Mayon, mahalaga ang wastong pangangalaga sa kalikasan upang maiwasan ang sakuna
                at mapanatili ang kaayusan ng pamumuhay.
            </p>
        </div>

        <button onclick="closeIntro()" class="btn-primary" style="width:100%; margin-top:10px;">
            Simulan 🚀
        </button>

    </div>
</div>

<div class="map-wrapper">
    <div class="map-container" style="position: relative; display: inline-block;">
        <img src="{{ asset('pictures/main_map.png') }}" class="background-map" alt="Main Map">

        <button class="pin location-1" onclick="window.location.href='{{ route('inner.map2') }}'">
            <span class="tooltip">Module 2</span>
        </button>

        <button class="pin location-2" onclick="showDetails('Module 3')">
             <span class="tooltip">Module 3</span>
        </button>

        <button class="pin location-3" onclick="showDetails('Module 4')">
             <span class="tooltip">Module 4</span>
        </button>

        <a href="{{ url()->previous() }}" class="back-button">⬅ Bumalik</a>
    </div> 
</div>

<script>
function showDetails(locationName) {
    alert("You clicked on the " + locationName);
}

// CLOSE INTRO MODAL
function closeIntro() {
    document.getElementById("introModal").classList.remove("show");
}

document.querySelector('.map-wrapper').addEventListener('click', function(e) {
        const rect = this.getBoundingClientRect();
        const x = ((e.clientX - rect.left) / rect.width) * 100;
        const y = ((e.clientY - rect.top) / rect.height) * 100;
        console.log(`top: ${y.toFixed(2)}%; left: ${x.toFixed(2)}%;`);
    });
</script>
@endsection