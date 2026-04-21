<!DOCTYPE html>
<html lang="fil">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PILIIN ANG IYONG BAYANI</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;900&family=Montserrat:wght@400;700&family=Oswald:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    <style>
        :root {
            --blue-rizal: #2980b9;
            --red-bonifacio: #c0392b;
            --gold-gabriela: #d4af37;
            --green-juan: #27ae60;
            --orange-maria: #d35400;
            --gray-hero: #7f8c8d;
            --parchment-dark: #e5d3b3;
            --parchment-light: #fdf5e6;
            --ink: #2c3e50;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background-color: #d2b48c;
            background-image: url('https://www.transparenttextures.com/patterns/p6.png');
            color: var(--ink);
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top:0; left:0; width: 100%; height: 100%;
            background-image: url('https://www.transparenttextures.com/patterns/old-map.png');
            opacity: 0.3;
            z-index: 1;
            pointer-events: none;
        }

        .game-container {
            position: relative;
            z-index: 10;
            width: 95%;
            max-width: 1100px;
            height: 85vh;
            background: var(--parchment-light);
            border: 8px double #8b4513;
            border-radius: 10px;
            display: flex;
            box-shadow: 0 0 40px rgba(0,0,0,0.5), inset 0 0 100px rgba(139,69,19,0.2);
            overflow: hidden;
        }

        /* --- LEFT SIDE: HERO PREVIEW --- */
        .hero-display {
            flex: 1.5;
            padding: 40px;
            display: flex;
            flex-direction: column;
            position: relative;
            border-right: 4px solid #8b4513;
        }

        .game-label {
            font-family: 'Cinzel', serif;
            font-size: 0.9rem;
            letter-spacing: 2px;
            color: #8b4513;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        #heroName {
            font-family: 'Cinzel', serif;
            font-size: clamp(2rem, 5vw, 3.5rem);
            color: var(--accent-color);
            text-shadow: 2px 2px 0px rgba(0,0,0,0.1);
            line-height: 1;
            margin-bottom: 20px;
        }

        .stat-box {
            background: rgba(139, 69, 19, 0.1);
            padding: 15px;
            border-radius: 5px;
            border: 1px solid rgba(139, 69, 19, 0.2);
            max-width: 350px;
            backdrop-filter: blur(2px);
        }

        #heroBio {
            font-style: italic;
            font-size: 0.95rem;
            line-height: 1.5;
            color: #5d4037;
        }

        .hero-image-container {
            position: absolute;
            right: -20px;
            bottom: 0;
            height: 90%;
            width: 60%;
            pointer-events: none;
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
        }

        .hero-main-img {
            height: 100%;
            width: 100%;
            object-fit: contain;
            object-position: bottom right;
            filter: drop-shadow(5px 15px 10px rgba(0,0,0,0.3));
            transition: all 0.5s ease;
        }

        /* Container for the Lihim SVG in the preview area */
        #lihimSvgPreview {
            display: none; /* Hidden by default, shown by JS */
            height: 90%;
            width: auto;
            filter: drop-shadow(5px 15px 10px rgba(0,0,0,0.2));
            transition: all 0.5s ease;
            position: absolute;
            right: 0;
            bottom: 0;
        }

        .btn-confirm {
            margin-top: auto;
            background: #8b4513;
            color: white;
            border: 3px solid #5d4037;
            padding: 15px 40px;
            font-family: 'Oswald', sans-serif;
            font-size: 1.5rem;
            cursor: pointer;
            transition: 0.3s;
            text-transform: uppercase;
            box-shadow: 0 5px 0 #5d4037;
            z-index: 20;
            width: fit-content;
        }

        .btn-confirm:hover {
            background: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 7px 0 #5d4037;
        }

        .btn-confirm:active {
            transform: translateY(3px);
            box-shadow: 0 2px 0 #5d4037;
        }

        /* --- RIGHT SIDE: ROSTER --- */
        .hero-roster {
            flex: 1;
            background: var(--parchment-dark);
            padding: 20px;
            overflow-y: auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            align-content: start;
        }

        .char-card {
            background: var(--parchment-light);
            border: 2px solid #a0522d;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 130px;
        }

        .char-card img {
            width: 100%;
            height: 80px;
            object-fit: contain;
            margin-bottom: 8px;
            filter: grayscale(0.5);
            transition: 0.3s;
        }

        /* Styles for SVG inside the small roster card */
        .char-card svg {
            height: 70px;
            width: auto;
            margin-bottom: 8px;
            transition: 0.3s;
        }

        .char-card h3 {
            font-family: 'Oswald', sans-serif;
            font-size: 0.8rem;
            color: #5d4037;
            margin-top: auto;
        }

        .char-card:hover {
            transform: scale(1.05);
            background: #fff;
        }

        .char-card.selected {
            border: 4px solid var(--accent-color);
            background: #fff;
            box-shadow: 0 0 15px rgba(var(--accent-rgb), 0.3);
        }

        .char-card.selected img {
            filter: grayscale(0);
        }

        /* Make selected Lihim SVG match the gray theme */
        .char-card.lihim-theme.selected svg path {
            fill: #5d4037; /* Dark ink color when selected */
        }

        /* --- MOBILE FIX --- */
        @media (max-width: 768px) {
            .game-container {
                flex-direction: column;
                height: 95vh;
            }

            .hero-display {
                flex: 1.5;
                border-right: none;
                border-bottom: 4px solid #8b4513;
                padding: 20px;
                align-items: center;
                text-align: center;
            }

            .hero-image-container {
                position: relative;
                width: 100%;
                height: 180px; 
                right: 0;
                margin: 10px 0;
                justify-content: center;
            }

            .hero-main-img {
                object-position: center;
            }

            #lihimSvgPreview {
                position: relative;
                height: 100%;
                right: auto;
            }

            .hero-roster {
                flex: 1;
                grid-template-columns: repeat(3, 1fr);
                gap: 8px;
                padding: 10px;
            }

            .char-card {
                min-height: 100px;
            }

            .char-card img {
                height: 50px;
            }

            .char-card svg {
                height: 45px;
            }

            .stat-box {
                max-width: 100%;
            }

            .btn-confirm {
                width: 100%;
                padding: 10px;
                font-size: 1.2rem;
            }
        }

        /* Themes */
        .rizal-theme { --accent-color: var(--blue-rizal); --accent-rgb: 41, 128, 185; }
        .bonifacio-theme { --accent-color: var(--red-bonifacio); --accent-rgb: 192, 57, 43; }
        .gabriela-theme { --accent-color: var(--gold-gabriela); --accent-rgb: 212, 175, 55; }
        .juan-theme { --accent-color: var(--green-juan); --accent-rgb: 39, 174, 96; }
        .maria-theme { --accent-color: var(--orange-maria); --accent-rgb: 211, 84, 0; }
        .lihim-theme { --accent-color: var(--gray-hero); --accent-rgb: 127, 140, 141; }
    </style>
</head>
<body class="rizal-theme">

    <div class="game-container animate__animated animate__fadeIn">
        
        <div class="hero-display">
            <div class="header-group">
                <p class="game-label">NAPILING BAYANI</p>
                <h1 id="heroName">JOSE RIZAL</h1>
                <div class="stat-box">
                    <p id="heroBio">"Ang panulat ay mas matalas kaysa sa tabak." Matalas na kaisipan para sa kalayaan.</p>
                </div>
            </div>

            <div class="hero-image-container">
                <img src="{{ asset('pictures/Jose Rizal.png') }}" id="heroMainImg" class="hero-main-img animate__animated animate__fadeInRight">
                
                <div id="lihimSvgPreview" class="animate__animated">
                    <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M32 2C24.3 2 18 8.3 18 16C18 20.9 20.6 25.2 24.5 27.7C20 29.8 16.5 33.7 15 38.5C13.8 37.8 12.5 37.3 11 37.3C6.6 37.3 3 40.9 3 45.3C3 49.7 6.6 53.3 11 53.3C12.5 53.3 13.8 52.8 15 52.1V58C15 60.2 16.8 62 19 62H45C47.2 62 49 60.2 49 58V51.3C50.2 51.9 51.6 52.3 53 52.3C57.4 52.3 61 48.7 61 44.3C61 39.9 57.4 36.3 53 36.3C51.6 36.3 50.2 36.7 49 37.3C47.7 33.1 44.8 29.6 41 27.5C44.1 24.9 46 21 46 16C46 8.3 39.7 2 32 2ZM32 6C37.5 6 42 10.5 42 16C42 19.5 40.2 22.5 37.5 24.3C35.8 25.4 33.9 26 32 26C30.1 26 28.2 25.4 26.5 24.3C23.8 22.5 22 19.5 22 16C22 10.5 26.5 6 32 6ZM27 31H37C41.4 31 45 34.6 45 39V58H19V39C19 34.6 22.6 31 27 31ZM11 41.3C13.2 41.3 15 43.1 15 45.3C15 47.5 13.2 49.3 11 49.3C8.8 49.3 7 47.5 7 45.3C7 43.1 8.8 41.3 11 41.3ZM53 40.3C55.2 40.3 57 42.1 57 44.3C57 46.5 55.2 48.3 53 48.3C50.8 48.3 49 46.5 49 44.3C49 42.1 50.8 40.3 53 40.3Z" fill="#8b4513" fill-opacity="0.4"/>
                        <rect x="13" y="44" width="4" height="10" rx="1" fill="#5d4037"/>
                        <path d="M15 44V34C15 34 16 31 19 31C22 31 23 34 23 34V44H15Z" fill="#a0a0a0"/>
                        <rect x="47" y="44" width="4" height="10" rx="1" fill="#5d4037"/>
                        <path d="M49 44C49 44 47 38 47 34C47 30 49 27 49 27C49 27 51 30 51 34C51 38 49 44 49 44Z" fill="#e0e0e0"/>
                    </svg>
                </div>
            </div>

            <form method="POST" action="{{ route('student.save-character') }}" style="margin-top:auto;">
                @csrf
                <input type="hidden" name="avatar" id="avatarInput" value="rizal">
                <button type="submit" class="btn-confirm" id="readyBtn">MAGSIMULA: RIZAL</button>
            </form>
        </div>

        <div class="hero-roster">
            <div class="char-card selected rizal-theme" data-avatar="rizal" data-name="JOSE RIZAL" data-bio='"Ang panulat ay mas matalas kaysa sa tabak." Matalas na kaisipan para sa kalayaan.' data-theme="rizal-theme">
                <img src="{{ asset('pictures/Jose Rizal.png') }}">
                <h3>RIZAL</h3>
            </div>

            <div class="char-card bonifacio-theme" data-avatar="bonifacio" data-name="ANDRES BONIFACIO" data-bio='"Alab ng puso sa gitna ng digmaan." Katapangan para sa inang bayan.' data-theme="bonifacio-theme">
                <img src="{{ asset('pictures/Bonifacio.png') }}">
                <h3>BONIFACIO</h3>
            </div>

            <div class="char-card gabriela-theme" data-avatar="gabriela" data-name="GABRIELA SILANG" data-bio='"Henerala ng Ilocos." Lakas ng loob ng kababaihang manlalaban.' data-theme="gabriela-theme">
                <img src="{{ asset('pictures/Gabriela silang (2).png') }}">
                <h3>GABRIELA</h3>
            </div>

            <div class="char-card juan-theme" data-avatar="boy_uniform" data-name="JUAN " data-bio='Ang masipag at madiskarteng Pilipino sa makabagong hamon ng buhay.' data-theme="juan-theme">
                <img src="{{ asset('pictures/chibi_boy.png') }}">
                <h3>JUAN</h3>
            </div>

            <div class="char-card maria-theme" data-avatar="girl_uniform" data-name="MARIA CLARA" data-bio='Simbolo ng dangal at malikhaing kaisipan ng kabataang Pilipina.' data-theme="maria-theme">
                <img src="{{ asset('pictures/girl_pink.png') }}">
                <h3>MARIA</h3>
            </div>

            <div class="char-card lihim-theme" data-avatar="neutral_hero" data-name="LIHIM NA BAYANI" data-bio='Ang iyong kwento ay hindi pa naisusulat. Ikaw ang susunod na alamat.' data-theme="lihim-theme">
                <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M32 2C24.3 2 18 8.3 18 16C18 20.9 20.6 25.2 24.5 27.7C20 29.8 16.5 33.7 15 38.5C13.8 37.8 12.5 37.3 11 37.3C6.6 37.3 3 40.9 3 45.3C3 49.7 6.6 53.3 11 53.3C12.5 53.3 13.8 52.8 15 52.1V58C15 60.2 16.8 62 19 62H45C47.2 62 49 60.2 49 58V51.3C50.2 51.9 51.6 52.3 53 52.3C57.4 52.3 61 48.7 61 44.3C61 39.9 57.4 36.3 53 36.3C51.6 36.3 50.2 36.7 49 37.3C47.7 33.1 44.8 29.6 41 27.5C44.1 24.9 46 21 46 16C46 8.3 39.7 2 32 2ZM32 6C37.5 6 42 10.5 42 16C42 19.5 40.2 22.5 37.5 24.3C35.8 25.4 33.9 26 32 26C30.1 26 28.2 25.4 26.5 24.3C23.8 22.5 22 19.5 22 16C22 10.5 26.5 6 32 6Z" fill="#cdbca0"/>
                </svg>
                <h3>LIHIM</h3>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.char-card').forEach(card => {
            card.addEventListener('click', () => {
                // UI update
                document.querySelectorAll('.char-card').forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');

                const name = card.dataset.name;
                const bio = card.dataset.bio;
                const avatar = card.dataset.avatar;
                const theme = card.dataset.theme;
                const imgSource = card.querySelector('img') ? card.querySelector('img').src : null;

                // Apply theme
                document.body.className = theme;
                document.getElementById('heroName').innerText = name;
                document.getElementById('heroBio').innerText = bio;
                document.getElementById('avatarInput').value = avatar;
                document.getElementById('readyBtn').innerText = `MAGSIMULA: ${name.split(' ')[0]}`;

                const mainImg = document.getElementById('heroMainImg');
                const svgPreview = document.getElementById('lihimSvgPreview');

                // Handle Image/SVG toggle based on selection
                if (avatar === 'neutral_hero') {
                    // Hide PNG, Show SVG
                    mainImg.style.display = 'none';
                    svgPreview.style.display = 'block';
                    
                    // Trigger SVG animation
                    svgPreview.classList.remove('animate__fadeInRight');
                    void svgPreview.offsetWidth; // Trigger reflow
                    svgPreview.classList.add('animate__fadeInRight');
                } else {
                    // Show PNG, Hide SVG
                    mainImg.style.display = 'block';
                    svgPreview.style.display = 'none';
                    
                    // Change source and trigger PNG animation
                    mainImg.src = imgSource;
                    mainImg.classList.remove('animate__fadeInRight');
                    void mainImg.offsetWidth; // Trigger reflow
                    mainImg.classList.add('animate__fadeInRight');
                }
            });
        });
    </script>
</body>
</html>