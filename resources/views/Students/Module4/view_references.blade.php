<!DOCTYPE html>
<html lang="fil">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mga Sanggunian - Module 4</title>

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Crimson+Pro:ital,wght@0,400;0,600;1,400&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --parchment:     #f5e6c8;
            --parchment-mid: #ede0c0;
            --parchment-dark:#d4b896;
            --ink:           #2b1a0e;
            --ink-mid:       #4a2f1a;
            --ink-light:     #6b4226;
            --accent-red:    #c0392b;
            --accent-gold:   #d4880e;
            --accent-green:  #2e6b35;
            --accent-blue:   #1a5276;
            --accent-purple: #6c3483;
            --accent-teal:   #148080;
            --tag-video:     #c0392b;
            --tag-social:    #1a5276;
            --tag-news:      #d4880e;
            --tag-law:       #6c3483;
            --tag-gov:       #2e6b35;
            --tag-org:       #148080;
            --tag-design:    #a04000;
            --shadow-warm:   rgba(43,26,14,0.45);
            --border-ink:    rgba(43,26,14,0.25);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Nunito', sans-serif;
            min-height: 100vh;
            color: var(--ink);
            padding: 0;
            position: relative;
            overflow-x: hidden;

            /* Map background */
            background-image: url('{{ asset("pictures/new_main_map.png") }}');
            background-size: cover;
            background-position: center top;
            background-attachment: fixed;
        }

        /* Warm overlay so text stays readable over the busy map */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse at 50% 30%, rgba(210,170,100,0.25) 0%, transparent 70%),
                linear-gradient(180deg,
                    rgba(20,15,8,0.65) 0%,
                    rgba(20,15,8,0.50) 40%,
                    rgba(20,15,8,0.60) 100%
                );
            pointer-events: none;
            z-index: 0;
        }

        /* Subtle paper grain texture */
        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
        }

        /* ─────────────────────────────────────── */
        /*  SCROLL WRAPPER                          */
        /* ─────────────────────────────────────── */
        .page-scroll {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            padding: 40px 20px 64px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* ─────────────────────────────────────── */
        /*  MAIN PARCHMENT CARD                     */
        /* ─────────────────────────────────────── */
        .ref-container {
            width: 100%;
            max-width: 900px;
            background:
                linear-gradient(160deg, #f9edd5 0%, #f0ddb8 40%, #ecdbb0 100%);
            border-radius: 6px;
            padding: 48px 52px;
            position: relative;

            box-shadow:
                0 0 0 3px var(--parchment-dark),
                0 0 0 6px rgba(43,26,14,0.30),
                0 30px 80px rgba(0,0,0,0.70),
                inset 0 0 60px rgba(180,130,70,0.15);

            /* Folded corner effect */
            clip-path: polygon(0 0, calc(100% - 28px) 0, 100% 28px, 100% 100%, 0 100%);
        }

        /* Folded corner triangle */
        .ref-container::before {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 0; height: 0;
            border-style: solid;
            border-width: 0 28px 28px 0;
            border-color: transparent var(--parchment-dark) transparent transparent;
            filter: drop-shadow(-2px 2px 3px rgba(0,0,0,0.25));
        }

        /* Decorative inner border */
        .ref-container::after {
            content: '';
            position: absolute;
            inset: 10px;
            border: 1.5px solid rgba(100,70,30,0.20);
            border-radius: 3px;
            pointer-events: none;
        }

        /* ─────────────────────────────────────── */
        /*  HEADER                                  */
        /* ─────────────────────────────────────── */
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            flex-wrap: wrap;
            padding-bottom: 24px;
            margin-bottom: 28px;
            border-bottom: 2px solid var(--border-ink);
            position: relative;
        }

        /* Small decorative wax seal accent */
        .header-section::after {
            content: '📜';
            position: absolute;
            bottom: -18px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 22px;
            background: var(--parchment);
            padding: 0 10px;
            line-height: 1;
        }

        .header-left h1 {
            font-family: 'Cinzel', serif;
            font-weight: 700;
            font-size: 26px;
            letter-spacing: 1px;
            color: var(--ink);
            text-shadow: 1px 1px 0 rgba(255,255,255,0.4);
            line-height: 1.2;
        }

        .header-left p {
            font-size: 11.5px;
            color: var(--ink-light);
            margin-top: 5px;
            letter-spacing: 1px;
            font-family: 'Cinzel', serif;
            text-transform: uppercase;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--ink);
            color: var(--parchment);
            border: 2px solid var(--ink-mid);
            padding: 8px 18px;
            border-radius: 4px;
            text-decoration: none;
            font-family: 'Cinzel', serif;
            font-weight: 600;
            font-size: 12px;
            letter-spacing: 0.5px;
            transition: all 0.2s ease;
            white-space: nowrap;
            box-shadow: 3px 3px 0 rgba(0,0,0,0.25);
        }

        .btn-back:hover {
            background: var(--accent-gold);
            border-color: var(--accent-gold);
            color: var(--ink);
            transform: translate(-2px, -2px);
            box-shadow: 5px 5px 0 rgba(0,0,0,0.25);
        }

        /* ─────────────────────────────────────── */
        /*  APA NOTE BANNER                         */
        /* ─────────────────────────────────────── */
        .apa-note {
            background: rgba(43,26,14,0.07);
            border: 1px solid rgba(100,70,30,0.30);
            border-left: 4px solid var(--accent-gold);
            border-radius: 4px;
            padding: 12px 18px;
            margin-bottom: 32px;
            font-size: 12.5px;
            color: var(--ink-mid);
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-style: italic;
        }

        /* ─────────────────────────────────────── */
        /*  SECTION TITLES                          */
        /* ─────────────────────────────────────── */
        .ref-section-title {
            font-family: 'Cinzel', serif;
            font-weight: 600;
            font-size: 11.5px;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--ink);
            padding: 4px 0 12px;
            border-bottom: 2px solid var(--border-ink);
            margin-bottom: 14px;
            margin-top: 36px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .ref-section-title:first-of-type { margin-top: 8px; }

        /* ─────────────────────────────────────── */
        /*  REFERENCE LIST                          */
        /* ─────────────────────────────────────── */
        .ref-list {
            list-style: none;
            padding: 0;
        }

        .ref-item {
            background: rgba(255,255,255,0.40);
            margin-bottom: 10px;
            padding: 15px 18px 15px 18px;
            border-radius: 3px;
            border-left: 5px solid var(--ink);
            transition: transform 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
            position: relative;

            /* Staggered appear */
            opacity: 0;
            transform: translateX(-8px);
            animation: slideIn 0.35s ease forwards;

            box-shadow: 2px 2px 0 rgba(0,0,0,0.08);
        }

        .ref-item:hover {
            transform: translateX(5px);
            background: rgba(255,255,255,0.62);
            box-shadow: 3px 3px 0 rgba(0,0,0,0.12);
        }

        /* Border color by category */
        .ref-item.cat-video   { border-left-color: var(--tag-video); }
        .ref-item.cat-social  { border-left-color: var(--tag-social); }
        .ref-item.cat-news    { border-left-color: var(--tag-news); }
        .ref-item.cat-law     { border-left-color: var(--tag-law); }
        .ref-item.cat-gov     { border-left-color: var(--tag-gov); }
        .ref-item.cat-org     { border-left-color: var(--tag-org); }
        .ref-item.cat-design  { border-left-color: var(--tag-design); }

        /* ── TAGS ── */
        .ref-tag {
            display: inline-block;
            font-size: 9px;
            font-family: 'Cinzel', serif;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 2px 9px;
            border-radius: 2px;
            margin-bottom: 7px;
            color: #fff;
        }

        .cat-video  .ref-tag { background: var(--tag-video); }
        .cat-social .ref-tag { background: var(--tag-social); }
        .cat-news   .ref-tag { background: var(--tag-news); }
        .cat-law    .ref-tag { background: var(--tag-law); }
        .cat-gov    .ref-tag { background: var(--tag-gov); }
        .cat-org    .ref-tag { background: var(--tag-org); }
        .cat-design .ref-tag { background: var(--tag-design); }

        /* ── CITATION TEXT ── */
        .ref-content {
            font-family: 'Crimson Pro', Georgia, serif;
            font-size: 15.5px;
            line-height: 1.75;
            color: var(--ink);
            word-break: break-word;
        }

        .ref-content .author { font-weight: 600; }
        .ref-content .title  { font-style: italic; }
        .ref-content .url    {
            font-family: 'Nunito', monospace;
            font-size: 12px;
            color: var(--accent-blue);
            word-break: break-all;
            display: block;
            margin-top: 3px;
            letter-spacing: 0.1px;
            opacity: 0.85;
        }

        /* ─────────────────────────────────────── */
        /*  FOOTER                                  */
        /* ─────────────────────────────────────── */
        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 11px;
            color: var(--ink-light);
            letter-spacing: 1.5px;
            padding-top: 18px;
            border-top: 1.5px solid var(--border-ink);
            font-family: 'Cinzel', serif;
            text-transform: uppercase;
        }

        /* ─────────────────────────────────────── */
        /*  ANIMATION                               */
        /* ─────────────────────────────────────── */
        @keyframes slideIn {
            to { opacity: 1; transform: translateX(0); }
        }

        /* ─────────────────────────────────────── */
        /*  RESPONSIVE                              */
        /* ─────────────────────────────────────── */
        @media (max-width: 680px) {
            .ref-container {
                padding: 28px 22px;
                clip-path: polygon(0 0, calc(100% - 20px) 0, 100% 20px, 100% 100%, 0 100%);
            }
            .header-left h1 { font-size: 19px; }
            .ref-content { font-size: 14px; }
            .ref-container::before {
                border-width: 0 20px 20px 0;
            }
        }
    </style>
</head>
<body>

<div class="page-scroll">
<div class="ref-container">

    <div class="header-section">
        <div class="header-left">
            <h1>📚 Mga Sanggunian</h1>
            <p>APA 7th Edition &nbsp;·&nbsp; Module 4 &nbsp;·&nbsp; Araling Panlipunan 10</p>
        </div>
        <a href="javascript:history.back()" class="btn-back">← Bumalik</a>
    </div>

    <div class="apa-note">
        <span>ℹ️</span>
        <span>Ang lahat ng sanggunian ay nakalista ayon sa <strong>APA 7th Edition</strong> na pamantayan. Para sa mga walang nakilalang may-akda, ginamit ang pangalan ng organisasyon o website.</span>
    </div>


    <!-- ══════════════════════════════════
         LEGAL / BATAS
    ══════════════════════════════════════ -->
    <div class="ref-section-title">⚖️ Mga Batas at Legal na Dokumento</div>
    <ul class="ref-list">

        <li class="ref-item cat-law" style="animation-delay:.05s">
            <span class="ref-tag">Batas</span>
            <div class="ref-content">
                <span class="author">Republic Act No. 10121.</span> (2010).
                <span class="title">Philippine Disaster Risk Reduction and Management Act of 2010.</span>
                LawPhil.
                <span class="url">https://lawphil.net/statutes/repacts/ra2010/ra_10121_2010.html</span>
            </div>
        </li>

        <li class="ref-item cat-law" style="animation-delay:.10s">
            <span class="ref-tag">Batas</span>
            <div class="ref-content">
                <span class="author">Republic Act No. 9729.</span> (2009).
                <span class="title">Climate Change Act of 2009.</span>
                LawPhil.
                <span class="url">https://lawphil.net/statutes/repacts/ra2009/ra_9729_2009.html</span>
            </div>
        </li>

        <li class="ref-item cat-law" style="animation-delay:.15s">
            <span class="ref-tag">Batas</span>
            <div class="ref-content">
                <span class="author">Republic Act No. 9003.</span> (2001).
                <span class="title">Ecological Solid Waste Management Act of 2000.</span>
                Environmental Management Bureau, Department of Environment and Natural Resources.
                <span class="url">https://pepp.emb.gov.ph/wp-content/uploads/2016/06/RA-9003-Ecological-Solid-Waste-Management-Act-of-2000.pdf</span>
            </div>
        </li>

    </ul>


    <!-- ══════════════════════════════════
         PAMAHALAAN
    ══════════════════════════════════════ -->
    <div class="ref-section-title">🏛️ Mga Sangguniang Pang-gobyerno</div>
    <ul class="ref-list">

        <li class="ref-item cat-gov" style="animation-delay:.20s">
            <span class="ref-tag">Gobyerno</span>
            <div class="ref-content">
                <span class="author">Province of Albay.</span> (n.d.).
                <span class="title">Provincial Public Safety and Emergency Management Office (APSEMO).</span>
                Albay Provincial Government.
                <span class="url">https://albay.gov.ph/provincial-public-safety-and-emergency-management-office-apsemo/</span>
            </div>
        </li>

        <li class="ref-item cat-gov" style="animation-delay:.25s">
            <span class="ref-tag">Gobyerno</span>
            <div class="ref-content">
                <span class="author">City Government of Legazpi, City Disaster Risk Reduction and Management Office.</span> (2023).
                <span class="title">CDRRMO annual report [pp. 189–224].</span>
                <span class="url">https://legazpi.gov.ph/wp-content/uploads/2023/09/CDRRMO-PAGE-189-224.pdf</span>
            </div>
        </li>

        <li class="ref-item cat-gov" style="animation-delay:.30s">
            <span class="ref-tag">Gobyerno</span>
            <div class="ref-content">
                <span class="author">Philippine Atmospheric, Geophysical and Astronomical Services Administration.</span> (n.d.).
                <span class="title">Tropical cyclone wind signals.</span>
                PAGASA-DOST.
                <span class="url">https://www.pagasa.dost.gov.ph/learning-tools/tropical-cyclone-wind-signa</span>
            </div>
        </li>

    </ul>


    <!-- ══════════════════════════════════
         BALITA / NEWS
    ══════════════════════════════════════ -->
    <div class="ref-section-title">📰 Mga Artikulo sa Balita</div>
    <ul class="ref-list">

        <li class="ref-item cat-news" style="animation-delay:.35s">
            <span class="ref-tag">Balita</span>
            <div class="ref-content">
                <span class="author">ABS-CBN News.</span> (2020, November 5).
                <span class="title">'Mas masahol po ito sa Reming': Typhoon-battered Tabaco City seeks food, housing materials.</span>
                ABS-CBN News.
                <span class="url">https://www.abs-cbn.com/news/11/05/20/mas-masahol-po-ito-sa-reming-typhoon-battered-tabaco-city-seeks-food-housing-materials</span>
            </div>
        </li>

        <li class="ref-item cat-news" style="animation-delay:.40s">
            <span class="ref-tag">Balita</span>
            <div class="ref-content">
                <span class="author">Rappler.</span> (n.d.).
                <span class="title">Expert says declare no-build zones on landslide-hit roads in Albay.</span>
                Rappler.
                <span class="url">https://www.rappler.com/philippines/220275-expert-says-declare-no-build-zones-landslide-hit-roads-albay/</span>
            </div>
        </li>

    </ul>


    <!-- ══════════════════════════════════
         ORGANISASYON
    ══════════════════════════════════════ -->
    <div class="ref-section-title">🌐 Mga Organisasyon at Institusyon</div>
    <ul class="ref-list">

        <li class="ref-item cat-org" style="animation-delay:.45s">
            <span class="ref-tag">Organisasyon</span>
            <div class="ref-content">
                <span class="author">GSMA.</span> (n.d.).
                <span class="title">Early warning systems in the Philippines: Mobile and digital technologies.</span>
                GSMA Mobile for Development.
                <span class="url">https://www.gsma.com/solutions-and-impact/connectivity-for-good/mobile-for-development/gsma_resources/ews-philippines-mobile-and-digital-technologies/</span>
            </div>
        </li>

    </ul>


    <!-- ══════════════════════════════════
         SOCIAL MEDIA
    ══════════════════════════════════════ -->
    <div class="ref-section-title">📱 Mga Post sa Social Media</div>
    <ul class="ref-list">

        <li class="ref-item cat-social" style="animation-delay:.50s">
            <span class="ref-tag">Facebook</span>
            <div class="ref-content">
                <span class="author">TagKaro TV.</span> (n.d.).
                <span class="title">Tambak na basura sa Purok 9, Tagas, Daraga, Albay: Dakula nang problema</span>
                [Status update]. Facebook.
                <span class="url">https://www.facebook.com/tagkarotv/posts/tambak-na-basura-sa-purok-9-tagas-daraga-albay-dakula-nang-problema-renz-luna-dz/513408732626558/</span>
            </div>
        </li>

        <li class="ref-item cat-social" style="animation-delay:.55s">
            <span class="ref-tag">Facebook</span>
            <div class="ref-content">
                <span class="author">Facebook.</span> (n.d.).
                <span class="title">[Reel – kapaligiran]</span>
                [Video]. Facebook.
                <span class="url">https://www.facebook.com/reel/847766111132161</span>
            </div>
        </li>

        <li class="ref-item cat-social" style="animation-delay:.60s">
            <span class="ref-tag">Facebook</span>
            <div class="ref-content">
                <span class="author">Facebook.</span> (n.d.).
                <span class="title">[Larawan – kapaligiran ng Albay]</span>
                [Photograph]. Facebook.
                <span class="url">https://www.facebook.com/photo/?fbid=1216101583895678&set=pcb.1216104043895432</span>
            </div>
        </li>

        <li class="ref-item cat-social" style="animation-delay:.65s">
            <span class="ref-tag">Facebook</span>
            <div class="ref-content">
                <span class="author">Facebook.</span> (n.d.).
                <span class="title">[Larawan – isyu sa kapaligiran]</span>
                [Photograph]. Facebook.
                <span class="url">https://www.facebook.com/photo.php?fbid=4219952541362365&set=a.589691729852777&id=100064358662594</span>
            </div>
        </li>

        <li class="ref-item cat-social" style="animation-delay:.70s">
            <span class="ref-tag">Facebook</span>
            <div class="ref-content">
                <span class="author">Facebook.</span> (n.d.).
                <span class="title">[Reel – kapaligiran]</span>
                [Video]. Facebook.
                <span class="url">https://www.facebook.com/reel/25161448763539025</span>
            </div>
        </li>

    </ul>


    <!-- ══════════════════════════════════
         YOUTUBE
    ══════════════════════════════════════ -->
    <div class="ref-section-title">▶️ Mga Video sa YouTube</div>
    <ul class="ref-list">

        <li class="ref-item cat-video" style="animation-delay:.75s">
            <span class="ref-tag">YouTube</span>
            <div class="ref-content">
                <span class="author">YouTube.</span> (n.d.).
                <span class="title">[Video – kapaligiran at kalikasan]</span>
                [Video]. YouTube.
                <span class="url">https://www.youtube.com/watch?v=UaRrDZWhtWA</span>
            </div>
        </li>

        <li class="ref-item cat-video" style="animation-delay:.80s">
            <span class="ref-tag">YouTube</span>
            <div class="ref-content">
                <span class="author">YouTube.</span> (n.d.).
                <span class="title">[Video – aralin sa kapaligiran]</span>
                [Video]. YouTube.
                <span class="url">https://www.youtube.com/watch?v=mtf1JAQ2hq4</span>
            </div>
        </li>

        <li class="ref-item cat-video" style="animation-delay:.85s">
            <span class="ref-tag">YouTube</span>
            <div class="ref-content">
                <span class="author">YouTube.</span> (n.d.).
                <span class="title">[Video – aralin sa kapaligiran]</span>
                [Video]. YouTube.
                <span class="url">https://www.youtube.com/watch?v=y16aMLeh91Q</span>
            </div>
        </li>

        <li class="ref-item cat-video" style="animation-delay:.90s">
            <span class="ref-tag">YouTube</span>
            <div class="ref-content">
                <span class="author">YouTube.</span> (n.d.).
                <span class="title">[Video – aralin sa kapaligiran]</span>
                [Video]. YouTube.
                <span class="url">https://www.youtube.com/watch?v=5MP0TxfEWyA</span>
            </div>
        </li>

        <li class="ref-item cat-video" style="animation-delay:.95s">
            <span class="ref-tag">YouTube</span>
            <div class="ref-content">
                <span class="author">YouTube.</span> (n.d.).
                <span class="title">[Video – aralin sa kapaligiran]</span>
                [Video]. YouTube.
                <span class="url">https://www.youtube.com/watch?v=yurhT4mPjps</span>
            </div>
        </li>

        <li class="ref-item cat-video" style="animation-delay:1.00s">
            <span class="ref-tag">YouTube</span>
            <div class="ref-content">
                <span class="author">YouTube.</span> (n.d.).
                <span class="title">[Video – aralin sa kapaligiran]</span>
                [Video]. YouTube.
                <span class="url">https://www.youtube.com/watch?v=G4svwU0twEw</span>
            </div>
        </li>

        <li class="ref-item cat-video" style="animation-delay:1.05s">
            <span class="ref-tag">YouTube</span>
            <div class="ref-content">
                <span class="author">YouTube.</span> (n.d.).
                <span class="title">[Video – aralin sa kapaligiran]</span>
                [Video]. YouTube.
                <span class="url">https://www.youtube.com/watch?v=dJpIU1rSOFY</span>
            </div>
        </li>

        <li class="ref-item cat-video" style="animation-delay:1.10s">
            <span class="ref-tag">YouTube</span>
            <div class="ref-content">
                <span class="author">YouTube.</span> (n.d.).
                <span class="title">[Video – aralin sa kapaligiran]</span>
                [Video]. YouTube.
                <span class="url">https://www.youtube.com/watch?v=AxpSZSsxvf8</span>
            </div>
        </li>

        <li class="ref-item cat-video" style="animation-delay:1.15s">
            <span class="ref-tag">YouTube</span>
            <div class="ref-content">
                <span class="author">YouTube.</span> (n.d.).
                <span class="title">[Video – aralin sa kapaligiran]</span>
                [Video]. YouTube.
                <span class="url">https://www.youtube.com/watch?v=Hg1ktHeXaPU</span>
            </div>
        </li>

        <li class="ref-item cat-video" style="animation-delay:1.20s">
            <span class="ref-tag">YouTube</span>
            <div class="ref-content">
                <span class="author">YouTube.</span> (n.d.).
                <span class="title">[Video – aralin sa kapaligiran]</span>
                [Video]. YouTube.
                <span class="url">https://www.youtube.com/watch?v=UFz2fLrqZuk</span>
            </div>
        </li>

        <li class="ref-item cat-video" style="animation-delay:1.25s">
            <span class="ref-tag">YouTube</span>
            <div class="ref-content">
                <span class="author">YouTube.</span> (n.d.).
                <span class="title">[Video – aralin sa kapaligiran]</span>
                [Video]. YouTube.
                <span class="url">https://www.youtube.com/watch?v=9hQZCiZ21fk</span>
            </div>
        </li>

        <li class="ref-item cat-video" style="animation-delay:1.30s">
            <span class="ref-tag">YouTube</span>
            <div class="ref-content">
                <span class="author">YouTube.</span> (n.d.).
                <span class="title">[Video – aralin sa kapaligiran]</span>
                [Video]. YouTube.
                <span class="url">https://www.youtube.com/watch?v=AoraXNrMp48</span>
            </div>
        </li>

    </ul>


    <!-- ══════════════════════════════════
         DISENYO
    ══════════════════════════════════════ -->
    <div class="ref-section-title">🎨 Disenyo at Visual na Materyales</div>
    <ul class="ref-list">

        <li class="ref-item cat-design" style="animation-delay:1.35s">
            <span class="ref-tag">Disenyo</span>
            <div class="ref-content">
                <span class="author">Canva.</span> (n.d.).
                <span class="title">[Visual na materyales para sa aralin]</span>
                [Digital design]. Canva.
                <span class="url">https://canva.link/hqckhdfkd5k3pjf</span>
            </div>
        </li>

    </ul>


    <footer>
        Hamon at Tugon: An Interactive Digital Learning Material in Araling Panlipunan 10
    </footer>

</div><!-- /.ref-container -->
</div><!-- /.page-scroll -->

</body>
</html>