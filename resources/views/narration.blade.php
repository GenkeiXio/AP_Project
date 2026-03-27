<!DOCTYPE html>
<html lang="fil">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hamon at Tugon: Narration</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/narration.css') }}">
</head>
<body>

    <!-- Decorative emojis -->
    <span class="deco deco-1">🌿</span>
    <span class="deco deco-2">🦋</span>
    <span class="deco deco-3">🌸</span>
    <span class="deco deco-4">🗺️</span>

    <!-- Main wrapper -->
    <div class="main-wrapper">

        <!-- Narration Content -->
        <div class="narration-container">
            <div class="header">
                <div class="header-icons">🧭 🗺️ ✨</div>
                <div class="subtitle">Araling Panlipunan 10: Mga Kontemporaryong Isyu</div>
                <h1>Hamon at Tugon:</h1>
                <h2>Narration</h2>
            </div>

            <!-- Description slider -->
            <div class="description-scroll">
                <div class="desc-pages">
                    <div class="desc-page active">
                        Sa harap ng patuloy na pagdanas ng Pilipinas ng iba’t ibang kalamidad tulad ng bagyo, lindol, baha, at pagputok ng bulkan, mahalagang maunawaan ng bawat mag-aaral ang kahalagahan ng kahandaan, disiplina, at kooperasyon sa pagtugon sa mga hamong pangkapaligiran.
                    </div>
                    <div class="desc-page">
                        Ang <i>interactive instructional material</i> na ito ay idinisenyo upang gawing mas makabuluhan, masigla, at mas malalim ang pagkatuto sa pamamagitan ng mga sitwasyong batay sa tunay na pangyayari, pagsusuri ng sanhi at epekto, at pagbuo ng angkop na plano ng pagtugon.
                    </div>
                    <div class="desc-page">
                        Layunin nitong hindi lamang mapalawak ang kaalaman ng mga mag-aaral tungkol sa kalagayan at suliraning pangkapaligiran ng bansa, kundi malinang din ang kanilang kritikal na pag-iisip at pananagutan bilang aktibong kabahagi sa pagpapabuti ng pamumuhay ng tao at komunidad.
                    </div>
                </div>

                <!-- Dots -->
                <div class="desc-dots">
                    <span class="dot active" onclick="showPage(0)"></span>
                    <span class="dot" onclick="showPage(1)"></span>
                    <span class="dot" onclick="showPage(2)"></span>
                </div>
            </div>

            <button onclick="proceedToModule()" class="btn-primary" style="margin-top: 20px;">Magpatuloy sa Mapa ng Albay 🚀</button>
        </div>

    </div>

    <!-- JS -->
    <script src="{{ asset('js/home.js') }}"></script>
    <script>
    function proceedToModule() {
        window.location.href = '{{ route("student.map") }}';
    }
    </script>

</body>
</html>