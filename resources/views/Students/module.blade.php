<!DOCTYPE html>
<html lang="fil">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hamon at Tugon: Module 2</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <style>
        .module-container {
            max-width: 700px;
            margin: auto;
            text-align: center;
        }

        .module-title {
            margin-top: 10px;
            font-size: 1.2rem;
            font-weight: 700;
        }

        .accordion {
            margin-top: 25px;
        }

        .accordion-item {
            border: 1px solid #e0d6c5;
            margin-bottom: 10px;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
        }

        /* ✅ CENTERED HEADER + BETTER DESIGN */
        .accordion-header {
            width: 100%;
            padding: 16px;
            border: none;
            background: #fdfaf5;
            cursor: pointer;
            font-weight: 800;
            font-size: 0.95rem;
            text-align: center; /* 👈 CENTERED */
            transition: background 0.3s ease;
        }

        .accordion-header:hover {
            background: #f5efe4;
        }

        /* ✅ SMOOTH ANIMATION */
        .accordion-content {
            max-height: 0;
            overflow: hidden;
            padding: 0 16px;
            background: #fff;
            font-size: 0.95rem;
            line-height: 1.6;
            transition: max-height 0.4s ease, padding 0.3s ease;
        }

        /* OPEN STATE */
        .accordion-item.active .accordion-content {
            max-height: 200px; /* enough height */
            padding: 16px;
        }

        .home-btn {
            position: fixed; /* stays visible even on scroll */
            top: 20px;
            left: 20px; /* move to top-left for visibility */
            font-size: 1.8rem; /* bigger icon */
            text-decoration: none;
            
            color: #000; /* black icon for contrast */
            padding: 10px 14px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
            z-index: 1000; /* ensure it’s on top of other elements */
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .home-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 10px rgba(0,0,0,0.3);
        }
    </style>
</head>

<body>

<!-- Decorations -->
<!-- <span class="deco deco-1">🌿</span> -->
<span class="deco deco-2">🦋</span>
<span class="deco deco-3">🌸</span>
<span class="deco deco-4">🗺️</span>

<a href="{{ route('home') }}" class="home-btn">🏠</a>

<div class="main-wrapper">

    <div class="module-container">

        <!-- Header -->
        <div class="header">
            <div class="header-icons">🧭 🗺️ ✨</div>
            <div class="subtitle">Module 2</div>
            <h1>Kalagayan, Suliranin at Pagtugon sa Isyung Pangkapaligiran ng Pilipinas</h1>
        </div>

        

        <!-- Accordion -->
        <div class="accordion">

            <div class="accordion-item">
                <button class="accordion-header">PAMANTAYANG PANGNILALAMAN</button>
                <div class="accordion-content">
                    Ang mag-aaral ay nakapagsusuri ng mga sanhi at implikasyon ng mga hamong pangkapaligiran upang maging bahagi ng mga pagtugon na makapagpapabuti sa pamumuhay ng tao.
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">PAMANTAYAN SA PAGGANAP</button>
                <div class="accordion-content">
                    Ang mag-aaral ay nakabubuo ng angkop na plano sa pagtugon sa mga hamong pangkapaligiran tungo sa pagpapabuti ng pamumuhay ng tao.
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">KASANAYAN SA PAGKATUTO</button>
                <div class="accordion-content">
                    Natatalakay ang kalagayan, suliranin at pagtugon sa isyung pangkapaligiran ng Pilipinas.
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">PAKSANG ARALIN</button>
                <div class="accordion-content">
                    • Kalagayan at Suliranin sa mga Isyung Pangkapaligiran sa Pilipinas <br>
                    • Pagtugon sa mga Isyung Pangkapaligiran sa Pilipinas
                </div>
            </div>

        </div>

        <!-- Start Button -->
        <button onclick="startLesson()" class="btn-primary" style="margin-top: 25px;">
            Simulan 🚀
        </button>

    </div>

</div>

<script>
function startLesson() {
    window.location.href = '{{ route("pretest.module2") }}';
}

// FIXED ACCORDION
document.querySelectorAll('.accordion-header').forEach(btn => {
    btn.addEventListener('click', () => {
        const item = btn.parentElement;

        // Close all first
        document.querySelectorAll('.accordion-item').forEach(i => {
            if (i !== item) i.classList.remove('active');
        });

        // Toggle current
        item.classList.toggle('active');
    });
});
</script>

</body>
</html>