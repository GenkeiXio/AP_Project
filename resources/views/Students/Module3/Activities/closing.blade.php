<!DOCTYPE html>
<html lang="tl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 3 Completed!</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Lexend:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #003973 0%, #0056ad 100%);
            --accent-yellow: #ffcc00;
            --glass: rgba(255, 255, 255, 0.95);
        }

        body {
            background: #0f172a;
            background-image: 
                radial-gradient(at 0% 0%, rgba(0, 57, 115, 0.5) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(0, 86, 173, 0.3) 0px, transparent 50%);
            font-family: 'Lexend', sans-serif;
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow-x: hidden;
            margin: 0;
        }

        .container {
            max-width: 1100px;
            z-index: 1;
        }

        /* Floating Card Design */
        .closing-card {
            background: var(--glass);
            border-radius: 30px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: transform 0.3s ease;
        }

        @media (max-width: 992px) {
            .closing-card {
                grid-template-columns: 1fr;
                margin: 20px;
            }
        }

        /* Image Section */
        .closing-image {
            position: relative;
            background: #000;
            overflow: hidden;
        }

        .closing-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.9);
            transition: transform 0.5s ease;
        }

        .closing-card:hover .closing-image img {
            transform: scale(1.05);
        }

        .image-badge {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: var(--accent-yellow);
            color: #000;
            padding: 8px 20px;
            border-radius: 50px;
            font-family: 'Bungee';
            font-size: 0.85rem;
            box-shadow: 0 4px 15px rgba(255, 204, 0, 0.4);
        }

        /* Content Section */
        .closing-content {
            padding: 60px;
            color: #1e293b;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2 {
            font-family: 'Bungee', cursive;
            color: #003973;
            margin-bottom: 25px;
            line-height: 1.2;
            font-size: 2rem;
        }

        .closing-text p {
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 20px;
            color: #334155;
        }

        .highlight-box {
            background: #f1f5f9;
            border-left: 5px solid var(--accent-yellow);
            padding: 20px;
            border-radius: 0 15px 15px 0;
            font-weight: 400;
            color: #475569 !important;
            font-style: italic;
        }

        /* Button */
        .btn-next {
            background: var(--primary-gradient);
            color: white;
            padding: 18px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-family: 'Bungee';
            display: inline-block;
            margin-top: 15px;
            text-align: center;
            box-shadow: 0 10px 20px rgba(0, 57, 115, 0.3);
            transition: all 0.3s ease;
            border: none;
        }

        .btn-next:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(0, 57, 115, 0.4);
            color: white;
            filter: brightness(1.1);
        }

        .blob {
            position: absolute;
            width: 400px;
            height: 400px;
            background: #003973;
            filter: blur(100px);
            opacity: 0.2;
            border-radius: 50%;
            z-index: -1;
        }
    </style>
</head>
<body>

<div class="blob animate__animated animate__pulse animate__infinite" style="top: -10%; right: -5%;"></div>
<div class="blob animate__animated animate__pulse animate__infinite" style="bottom: -10%; left: -5%; background: #ffcc00;"></div>

<div class="container py-5">
    <div class="closing-card animate__animated animate__zoomIn">
        
        <div class="closing-image">
            <img src="/pictures/Module 3/closing.png" alt="Mission Completed">
            <div class="image-badge">✨ MODULE COMPLETE</div>
        </div>

        <div class="closing-content">
            <h2 class="animate__animated animate__fadeInRight animate__delay-1s">
                🎉 Natapos mo ang Module 3!
            </h2>

            <div class="closing-text">
                <p>
                    Laging tandaan na <strong>ligtas ang may alam</strong>, kaya’t dapat kang maging mapanuri at alerto lalo na sa pagdating ng mga kalamidad at anumang panganib.
                </p>

                <p class="highlight-box">
                    Narito ang ilan sa mga ahensiya ng pamahalaan na dapat mong tandaan lalo na ang mga bahaging ginagampanan ng mga ito tungo sa ligtas na bansa.
                </p>

                <div class="text-center text-md-start mt-4">
                    <a href="/next-topic" class="btn-next">
                        Tuklasin ang mga Ahensiya ➜
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>