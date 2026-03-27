<!DOCTYPE html>
<html lang="fil">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Node 2: Deforestation</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Nunito", sans-serif;
            background: linear-gradient(180deg, #eff8ff 0%, #f6fff6 45%, #fff8ea 100%);
            color: #2e2e2e;
            min-height: 100vh;
            padding: 20px 14px 32px;
        }

        .page { max-width: 1100px; margin: 0 auto; }

        .hero {
            background: rgba(255,255,255,0.95);
            border: 2px solid #d9e9dc;
            border-radius: 18px;
            padding: 18px;
            box-shadow: 0 10px 24px rgba(50,90,50,0.12);
        }

        .title {
            font-family: "Baloo 2", cursive;
            color: #214f33;
            font-size: clamp(1.4rem, 3vw, 2rem);
            text-align: center;
        }

        .desc {
            text-align: center;
            color: #43624d;
            line-height: 1.6;
        }

        .start-wrap {
            margin-top: 15px;
            display: flex;
            justify-content: center;
        }

        .start-btn {
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 900;
            background: linear-gradient(180deg,#88d777,#5eae4e);
            border: 2px solid #4a8f3d;
            box-shadow: 0 4px 0 #3f7f36;
            text-decoration: none;
            color: #10311f;
        }

        .local-grid {
            margin-top: 16px;
            display: grid;
            grid-template-columns: repeat(2,1fr);
            gap: 12px;
        }

        .source-card {
            background:#fff;
            border:1px solid #deeadf;
            border-radius:12px;
            padding:10px;
        }

        .source-title {
            font-weight:800;
            color:#2e5e3d;
            font-size:0.9rem;
        }

        .source-img {
            width:100%;
            border-radius:10px;
            margin-top:8px;
        }
    </style>
</head>

<body>
<div class="page">
    <section class="hero">

        <h1 class="title">NODE 2: DEFORESTATION 🌳</h1>

        <p class="desc">
            Ang deforestation ay ang patuloy na pagputol ng mga puno nang walang sapat na kapalit.
            Sa Albay, nagdudulot ito ng pagguho ng lupa, pagbaha, at pagkasira ng kalikasan.
        </p>

        <div class="start-wrap">
            <a class="start-btn" href="{{ route('node2.activity') }}">
                Simulan ang Activity 🚀
            </a>
        </div>

        <div class="local-grid">

            <div class="source-card">
                <div class="source-title">Landslide sa Albay</div>
                <img src="{{ asset('pictures/deforestation1.png') }}" class="source-img">
            </div>

            <div class="source-card">
                <div class="source-title">Illegal Logging</div>
                <img src="{{ asset('pictures/deforestation2.png') }}" class="source-img">
            </div>

        </div>

    </section>
</div>
</body>
</html>