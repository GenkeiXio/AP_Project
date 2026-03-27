@extends('Students.studentslayout')

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
    display: flex;
    justify-content: center;
    align-items: flex-start; /* Aligns map toward the top of the content area */
    width: 100%;
    min-height: 85vh;        /* Gives it plenty of vertical space */
    padding: 20px 0;         /* Space between the nav and the map */
    background: transparent;
}

.map-container {
    position: relative;
    display: inline-block;
    width: 95%;              /* Takes up 95% of the available width */
    max-width: 1150px;       /* Increased from 900px to make it much bigger */
    aspect-ratio: 16 / 9;    /* Keeps the map proportions perfect */
    box-shadow: 0 15px 45px rgba(0,0,0,0.4); /* Stronger shadow for the floating effect */
    border-radius: 20px;     /* Matches the rounded corners in your goal image */
    overflow: hidden;
    border: 4px solid rgba(255, 255, 255, 0.3); /* Adds a subtle frame */
}

.background-map {
    width: 100%;
    height: 100%;
    object-fit: cover;       /* Ensures the map fills the entire container */
    display: block;
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
.location-1 { top: 59%; left: 82%;}
.location-2 { top: 50%; left: 25%; }
.location-3 { top: 53%; left: 50%; }

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

@keyframes pinPulse {
    0% { filter: drop-shadow(0 0 5px rgba(255, 71, 87, 0.4)); }
    50% { filter: drop-shadow(0 0 20px rgba(255, 71, 87, 0.9)); }
    100% { filter: drop-shadow(0 0 5px rgba(255, 71, 87, 0.4)); }
}
</style>
@endpush

@section('content')
<div class="map-wrapper">
    <div class="map-container" style="position: relative; display: inline-block;">
        <img src="{{ asset('pictures/main_map.png') }}" class="background-map" alt="Main Map">

        <button class="pin location-1" onclick="showDetails('Module 2')">
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

document.querySelector('.map-wrapper').addEventListener('click', function(e) {
        const rect = this.getBoundingClientRect();
        const x = ((e.clientX - rect.left) / rect.width) * 100;
        const y = ((e.clientY - rect.top) / rect.height) * 100;
        console.log(`top: ${y.toFixed(2)}%; left: ${x.toFixed(2)}%;`);
    });
</script>
@endsection