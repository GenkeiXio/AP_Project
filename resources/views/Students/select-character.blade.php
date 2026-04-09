<!DOCTYPE html>
<html lang="fil">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Piliin ang Iyong Karakter – Araling Panlipunan</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green: #6dbf7e;
            --green-dark: #4da862;
            --orange: #e8922a;
            --orange-light: #fde3a3;
            --blue-sky: #87CEEB;
            --glass: rgba(255, 255, 255, 0.07);
            --border: rgba(255, 255, 255, 0.15);
        }

        body {
            background: #0f1215;
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(109, 191, 126, 0.1) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(232, 146, 42, 0.1) 0%, transparent 40%),
                url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: white;
            font-family: 'Nunito', sans-serif;
            overflow-x: hidden;
            padding: 40px 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 50px;
            z-index: 10;
        }

        .header h1 {
            font-family: 'Baloo 2', cursive;
            font-size: clamp(2rem, 5vw, 3.5rem);
            letter-spacing: 2px;
            color: #fff;
            text-shadow: 0 5px 15px rgba(0,0,0,0.5);
            text-transform: uppercase;
        }

        .welcome-badge {
            background: var(--glass);
            padding: 6px 18px;
            border-radius: 4px;
            border-left: 4px solid var(--blue-sky);
            font-size: 0.9rem;
            font-weight: 700;
            display: inline-block;
            margin-bottom: 10px;
        }

        /* ── Main Container ── */
        .selection-container {
            display: flex;
            flex-direction: column;
            gap: 40px;
            width: 100%;
            max-width: 1000px;
            z-index: 5;
        }

        /* ── Character Row (Side by Side) ── */
        .char-row {
            display: flex;
            align-items: center;
            background: var(--glass);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 20px;
            transition: all 0.4s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        /* Flip orientation for the second character */
        .char-row.reverse { flex-direction: row-reverse; }

        .char-row:hover {
            border-color: rgba(255,255,255,0.4);
            background: rgba(255,255,255,0.12);
            transform: scale(1.02);
        }

        .char-row.selected {
            border-color: var(--accent-color);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.3), inset 0 0 20px var(--accent-color);
        }

        /* ── Visual Side (The Image) ── */
        .char-visual {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            min-height: 250px;
        }

        .char-visual img {
            max-height: 280px;
            width: auto;
            z-index: 2;
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.5));
            transition: 0.5s;
        }

        .char-row.selected .char-visual img {
            transform: scale(1.1) translateY(-10px);
        }

        .glow-circle {
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: var(--accent-color);
            filter: blur(60px);
            opacity: 0.2;
            z-index: 1;
        }

        /* ── Info Side (The Content) ── */
        .char-info {
            flex: 1.5;
            padding: 20px 40px;
        }

        .char-row.reverse .char-info { text-align: right; }

        .role-tag {
            font-size: 0.75rem;
            font-weight: 800;
            color: var(--accent-color);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 8px;
            display: block;
        }

        .char-info h2 {
            font-family: 'Baloo 2';
            font-size: 2.5rem;
            line-height: 1;
            margin-bottom: 15px;
            text-shadow: 2px 2px 0px rgba(0,0,0,0.5);
        }

        .char-info .desc {
            font-size: 0.95rem;
            color: #ccc;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        /* ── Stats/Skills ── */
        .skills-grid {
            display: flex;
            gap: 10px;
            justify-content: flex-start;
        }

        .char-row.reverse .skills-grid { justify-content: flex-end; }

        .skill-node {
            background: rgba(0,0,0,0.3);
            border: 1px solid var(--border);
            padding: 8px 15px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .skill-node i { color: var(--accent-color); }

        /* ── Footer / Submit ── */
        .footer-actions {
            margin-top: 50px;
            text-align: center;
        }

        .btn-ready {
            padding: 20px 80px;
            font-family: 'Baloo 2';
            font-size: 1.4rem;
            border-radius: 12px;
            border: none;
            background: #222;
            color: #555;
            cursor: not-allowed;
            transition: 0.4s;
            position: relative;
            overflow: hidden;
        }

        .btn-ready.active {
            background: #fff;
            color: #000;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(255,255,255,0.2);
        }

        .btn-ready.active:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(255,255,255,0.3);
        }

        #hintText {
            margin-top: 20px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Accent Colors */
        .boy-accent { --accent-color: var(--green); }
        .girl-accent { --accent-color: var(--orange); }

        @media (max-width: 768px) {
            .char-row, .char-row.reverse {
                flex-direction: column;
                text-align: center !important;
                padding: 30px 15px;
            }
            .char-row.reverse .skills-grid { justify-content: center; }
            .skills-grid { justify-content: center; }
        }
    </style>
</head>
<body>

    <div class="header animate__animated animate__fadeIn">
        <div class="welcome-badge">PLAYER READY: {{ $student->username }}</div>
        <h1>Piliin ang Iyong Bayani</h1>
    </div>

    <div class="selection-container">
        <div class="char-row boy-accent" id="stage-boy" onclick="chooseHero('boy_uniform', 'Juan', this)">
            <div class="char-visual">
                <div class="glow-circle"></div>
                <img src="{{ asset('pictures/chibi_boy.png') }}" alt="Juan">
            </div>
            <div class="char-info">
                
                <h2>JUAN</h2>
                <p class="desc">Isang masigla at disiplinadong mag-aaral. Mahusay sa pag-unawa ng kasaysayan at kilala sa pagbuo ng mga malinaw na estratehiya sa bawat hamon.</p>
                <div class="skills-grid">
                    <div class="skill-node"><i class="bi bi-cpu"></i> Lohikal</div>
                    <div class="skill-node"><i class="bi bi-shield-check"></i> Disiplinado</div>
                    <div class="skill-node"><i class="bi bi-lightning-fill"></i> Mabilis</div>
                </div>
            </div>
        </div>

        <div class="char-row girl-accent reverse" id="stage-girl" onclick="chooseHero('girl_uniform', 'Maria', this)">
            <div class="char-visual">
                <div class="glow-circle"></div>
                <img src="{{ asset('pictures/girl_pink.png') }}" alt="Maria">
            </div>
            <div class="char-info">
               
                <h2>MARIA</h2>
                <p class="desc">Isang mapanuri at malikhaing isipan. Si Maria ay maaasahan sa mga gawaing nangangailangan ng masusing pag-aanalisa at pagtulong sa kapwa.</p>
                <div class="skills-grid">
                    <div class="skill-node"><i class="bi bi-palette"></i> Malikhain</div>
                    <div class="skill-node"><i class="bi bi-eye"></i> Mapanuri</div>
                    <div class="skill-node"><i class="bi bi-heart-fill"></i> Maawain</div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-actions animate__animated animate__fadeInUp">
        <form method="POST" action="{{ route('student.save-character') }}" id="heroForm">
            @csrf
            <input type="hidden" name="avatar" id="avatarInput">
            <button type="submit" class="btn-ready" id="readyBtn" disabled>PUMILI NG KARAKTER</button>
        </form>
        <p id="hintText" style="color: #444;">Piliin ang iyong magiging kinatawan sa paglalakbay</p>
    </div>

    <script>
        function chooseHero(val, name, el) {
            // Remove selection from all
            document.querySelectorAll('.char-row').forEach(s => s.classList.remove('selected'));
            
            // Add selection to clicked
            el.classList.add('selected');

            // Logic for Form
            document.getElementById('avatarInput').value = val;
            const btn = document.getElementById('readyBtn');
            btn.classList.add('active');
            btn.disabled = false;
            btn.innerText = `MAGSIMULA BILANG SI ${name}`;

            // Update Hint text
            const accent = val === 'boy_uniform' ? '#6dbf7e' : '#e8922a';
            const hint = document.getElementById('hintText');
            hint.style.color = accent;
            hint.innerText = `Napiling Karakter: ${name}`;
            hint.classList.add('animate__animated', 'animate__pulse');
            
            // Remove animation class after it plays to allow re-triggering
            setTimeout(() => hint.classList.remove('animate__animated', 'animate__pulse'), 1000);
        }

        document.getElementById('heroForm').addEventListener('submit', function() {
            const btn = document.getElementById('readyBtn');
            btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> LOADING...';
            btn.style.opacity = '0.7';
            btn.disabled = true;
        });
    </script>
</body>
</html>