<!DOCTYPE html>
<html lang="fil">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hamon at Tugon: Poll</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <style>
        .poll-container {
            max-width: 900px; /* slightly narrower for readability */
            margin: auto;
            text-align: center;
            padding: 30px 20px; /* slightly less padding */
        }

        .poll-question {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 30px; /* less than before */
        }

        .poll-options {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px; /* smaller gap between options */
            margin-bottom: 30px; /* less space before button */
        }

        .poll-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 200px; /* slightly narrower */
            padding: 15px; /* less padding for tighter look */
            border: 2px solid #e0d6c5;
            border-radius: 12px;
            background: #fff;
            cursor: pointer;
            transition: border-color 0.3s ease, transform 0.2s ease;
        }

        .poll-option:hover {
            border-color: #d4a574;
            transform: translateY(-3px); /* subtle hover lift */
        }

        .poll-option img {
            width: 160px; /* slightly smaller */
            height: 160px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 12px; /* less space under image */
        }

        .poll-option label {
            font-weight: 600;
            cursor: pointer;
            text-align: center;
        }

        button.btn-primary {
            padding: 12px 25px;
            font-size: 1rem;
            border-radius: 12px;
        }

        .home-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            font-size: 1.8rem;
            text-decoration: none;
            color: #000;
            padding: 10px 14px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
            z-index: 1000;
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
<span class="deco deco-2">🦋</span>
<span class="deco deco-3">🌸</span>
<span class="deco deco-4">🗺️</span>

<a href="{{ route('home') }}" class="home-btn">🏠</a>

<div class="main-wrapper">

    <div class="poll-container">

        <!-- Header -->
        <div class="header">
            <div class="header-icons">🧭 🗺️ ✨</div>
            <div class="subtitle">Module 2</div>
            <h1>Poll</h1>
        </div>

        <div class="poll-question">
            Ano ang pinakakaraniwang suliraning pangkapaligiran sa inyong lugar?
        </div>

        <form id="pollForm">
            <div class="poll-options">
                <div class="poll-option" onclick="selectOption('a')">
                    <input type="radio" id="a" name="poll" value="a">
                    <img src="/pictures/basura.jpg" alt="Basura">
                    <label for="a">a. Basura</label>
                </div>
                <div class="poll-option" onclick="selectOption('b')">
                    <input type="radio" id="b" name="poll" value="b">
                    <img src="/pictures/pagbabaha.jpg" alt="Pagbaha">
                    <label for="b">b. Pagbaha</label>
                </div>
                <div class="poll-option" onclick="selectOption('c')">
                    <input type="radio" id="c" name="poll" value="c">
                    <img src="/pictures/putol_puno.jpg" alt="Pagputol ng Puno">
                    <label for="c">c. Pagputol ng puno</label>
                </div>
                <div class="poll-option" onclick="selectOption('d')">
                    <input type="radio" id="d" name="poll" value="d">
                    <img src="https://via.placeholder.com/150x150?text=Polusyon+sa+Hangin" alt="Polusyon sa Hangin">
                    <label for="d">d. Polusyon sa hangin</label>
                </div>
            </div>

            <button type="button" onclick="proceed()" class="btn-primary">
                Proceed 🚀
            </button>
        </form>

    </div>

</div>

<script>
function selectOption(option) {
    // Remove selected class from all
    document.querySelectorAll('.poll-option').forEach(opt => opt.classList.remove('selected'));
    // Add to clicked
    document.querySelector(`input[id="${option}"]`).parentElement.classList.add('selected');
    // Check the radio
    document.getElementById(option).checked = true;
}

function proceed() {
    const selected = document.querySelector('input[name="poll"]:checked');
    if (!selected) {
        alert('Please select an option.');
        return;
    }
    alert('Selected: ' + selected.value + ' - Next: Quiz or something');
    // For now, just alert. Later redirect to next page.
}
</script>

</body>
</html>