@extends('Students.studentslayout')
@section('title', 'InnerMap2')

@push('styles')
<style>
    /* 1. Ensure the page has no scrollbars or margins */
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

    /* 2. Create the full-screen container */
    .map-wrapper {
        position: fixed; /* Changed from relative to fixed */
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 1; /* Keep it behind the navbar if necessary */
    }

    /* 3. The Background Image Styles */
    .background-map {
        width: 100%;
        height: 100%;
        object-fit: cover; /* This makes it fill the screen like a wallpaper */
        display: block;
    }

    .node {
        position: absolute;
        width: 180px; /* Adjust size based on your image */
        height: 180px;
        border-radius: 50%;
        background: white;
        border: 4px solid #fff;
        box-shadow: 0 8px 15px rgba(0,0,0,0.3);
        cursor: pointer;
        padding: 0;
        overflow: visible; /* Allows the labels below to show */
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        z-index: 5;
    }

    .node img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .node:hover {
        transform: scale(1.1);
        z-index: 10;
    }

    /* Labels at the bottom of circles */
    .label {
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        padding: 5px 15px;
        border-radius: 20px;
        color: white;
        font-weight: bold;
        white-space: nowrap;
        font-size: 14px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.2);
    }

    /* Colors based on your 2nd image */
    .label-blue { background: #1e3799; }
    .label-brown { background: #784521; }
    .label-orange { background: #e67e22; }
    .label-green { background: #27ae60; }

    /* Center Node (Static) */
    .center-node {
        width: 250px;
        height: 180px;
        border-radius: 25px; /* Rounded rectangle like the image */
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        cursor: default;
    }
    .center-node:hover { transform: translate(-50%, -50%); } /* No scale for center */

    /* POSITIONS (Adjust these percentages to fit your background) */
    .node-top-left { top: 15%; left: 20%; }
    .node-top-right { top: 15%; left: 65%; }
    .node-bottom-left { top: 60%; left: 20%; }
    .node-bottom-right { top: 60%; left: 65%; }

    /* 4. The Back Button Styling */
    .back-button {
        position: fixed;
        top: 80px;
        left: 20px;
        z-index: 100;
        background-color: rgba(255, 255, 255, 0.9);
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        color: #333;
        font-weight: bold;
        font-family: 'Courier New', Courier, monospace;
        box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        transition: transform 0.2s;
    }

    .back-button:hover {
        transform: scale(1.05);
        background-color: #ffffff;
    }
</style>
@endpush

@section('content')
<div class="map-wrapper">
    <img src="{{ asset('pictures/module2_inner_map.png') }}" class="background-map" alt="Module 2 Map">

    <div class="node center-node">
        <img src="{{ asset('pictures/center_title.png') }}" alt="Albay Issues">
    </div>

    <button class="node node-top-left" onclick="showTopic('Basura')">
        <img src="{{ asset('pictures/node_basura.png') }}" alt="Basura">
        <div class="label label-blue">Basura</div>
    </button>

    <button class="node node-top-right" onclick="showTopic('Kagubatan')">
        <img src="{{ asset('pictures/node_forest.png') }}" alt="Kagubatan">
        <div class="label label-brown">Pagkakalbo ng Kagubatan</div>
    </button>

    <button class="node node-bottom-left" onclick="showTopic('Klima')">
        <img src="{{ asset('pictures/node_klima.png') }}" alt="Klima">
        <div class="label label-orange">Pagbabago ng Klima</div>
    </button>

    <button class="node node-bottom-right" onclick="showTopic('Pamahalaan')">
        <img src="{{ asset('pictures/node_gov.png') }}" alt="Pamahalaan">
        <div class="label label-green">Tugon ng Pamahalaan</div>
    </button>

    <a href="{{ url()->previous() }}" class="back-button">⬅ Bumalik</a>

    </div>
@endsection