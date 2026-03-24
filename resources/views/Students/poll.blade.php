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
            max-width: 800px;
            margin: auto;
            text-align: center;
        }

        .poll-question {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .poll-options {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .poll-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 150px;
            padding: 15px;
            border: 2px solid #e0d6c5;
            border-radius: 12px;
            background: #fff;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        .poll-option:hover {
            border-color: #d4a574;
        }

        .poll-option input[type="radio"] {
            display: none;
        }

        .poll-option img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .poll-option label {
            font-weight: 600;
            cursor: pointer;
        }

        .poll-option.selected {
            border-color: #d4a574;
            background: #fdfaf5;
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

        <form id="pollForm" action="{{ route('pretest.module2') }}" method="GET">
            <div class="poll-options">
                <div class="poll-option" onclick="selectOption('a')">
                    <input type="radio" id="a" name="poll" value="a">
                    <img src="https://via.placeholder.com/150x150?text=Basura" alt="Basura">
                    <label for="a">a. Basura</label>
                </div>
                <div class="poll-option" onclick="selectOption('b')">
                    <input type="radio" id="b" name="poll" value="b">
                    <img src="https://via.placeholder.com/150x150?text=Pagbaha" alt="Pagbaha">
                    <label for="b">b. Pagbaha</label>
                </div>
                <div class="poll-option" onclick="selectOption('c')">
                    <input type="radio" id="c" name="poll" value="c">
                    <img src="https://via.placeholder.com/150x150?text=Pagputol+ng+Puno" alt="Pagputol ng Puno">
                    <label for="c">c. Pagputol ng puno</label>
                </div>
                <div class="poll-option" onclick="selectOption('d')">
                    <input type="radio" id="d" name="poll" value="d">
                    <img src="https://via.placeholder.com/150x150?text=Polusyon+sa+Hangin" alt="Polusyon sa Hangin">
                    <label for="d">d. Polusyon sa hangin</label>
                </div>
            </div>

            <button type="submit" class="btn-primary">
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

function proceed(e) {
    const selected = document.querySelector('input[name="poll"]:checked');
    if (!selected) {
        if (e) e.preventDefault();
        alert('Pumili muna ng sagot bago magpatuloy.');
        return;
    }
}

document.getElementById('pollForm').addEventListener('submit', proceed);
</script>

</body>
</html>