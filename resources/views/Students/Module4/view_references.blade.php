<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mga Sanggunian - Module 4</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0b1b2b 0%, #11384f 45%, #173d2c 100%);
            min-height: 100vh;
            color: #eaf4ff;
            padding: 40px 20px;
        }

        .ref-container {
            max-width: 900px;
            margin: auto;
            background: rgba(3, 18, 30, 0.7);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(124, 231, 255, 0.2);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        }

        .header-section {
            border-bottom: 2px solid rgba(124, 231, 255, 0.1);
            margin-bottom: 30px;
            padding-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h1 {
            color: #7ce7ff;
            font-weight: 800;
            font-size: 28px;
            margin: 0;
        }

        .btn-back {
            background: rgba(124, 231, 255, 0.1);
            color: #7ce7ff;
            border: 1px solid #7ce7ff;
            padding: 8px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-back:hover {
            background: #7ce7ff;
            color: #0b1b2b;
        }

        .ref-list {
            list-style: none;
            padding: 0;
        }

        .ref-item {
            background: rgba(255, 255, 255, 0.03);
            margin-bottom: 15px;
            padding: 20px;
            border-radius: 12px;
            border-left: 5px solid #9dfdba;
            transition: transform 0.2s;
        }

        .ref-item:hover {
            transform: translateX(10px);
            background: rgba(255, 255, 255, 0.06);
        }

        .ref-category {
            color: #9dfdba;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
            display: block;
        }

        .ref-content {
            font-size: 15px;
            line-height: 1.6;
            color: #d8eefb;
        }

        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 13px;
            color: rgba(216, 238, 251, 0.5);
        }
    </style>
</head>
<body>

    <div class="ref-container">
        <div class="header-section">
            <h1>📚 Mga Sanggunian</h1>
            <a href="{{ url()->previous() }}" class="btn-back">← Bumalik</a>
        </div>

        <ul class="ref-list">
            
            <li class="ref-item">
                <div class="ref-content">
                    https://www.youtube.com/watch?v=UaRrDZWhtWA&list=RDUaRrDZWhtWA&start_radio=1
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.facebook.com/reel/847766111132161
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.facebook.com/photo/?fbid=1216101583895678&set=pcb.1216104043895432
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.facebook.com/tagkarotv/posts/tambak-na-basura-sa-purok-9-tagas-daraga-albay-dakula-nang-problema-renz-luna-dz/513408732626558/
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.facebook.com/reel/25161448763539025
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.rappler.com/philippines/220275-expert-says-declare-no-build-zones-landslide-hit-roads-albay/
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.facebook.com/photo.php?fbid=4219952541362365&set=a.589691729852777&id=100064358662594
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.youtube.com/watch?v=mtf1JAQ2hq4
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.abs-cbn.com/news/11/05/20/mas-masahol-po-ito-sa-reming-typhoon-battered-tabaco-city-seeks-food-housing-materials
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://lawphil.net/statutes/repacts/ra2010/ra_10121_2010.html
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.gsma.com/solutions-and-impact/connectivity-for-good/mobile-for-development/gsma_resources/ews-philippines-mobile-and-digital-technologies/
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://legazpi.gov.ph/wp-content/uploads/2023/09/CDRRMO-PAGE-189-224.pdf
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://lawphil.net/statutes/repacts/ra2009/ra_9729_2009.html
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://pepp.emb.gov.ph/wp-content/uploads/2016/06/RA-9003-Ecological-Solid-Waste-Management-Act-of-2000.pdf
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://albay.gov.ph/provincial-public-safety-and-emergency-management-office-apsemo/
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.youtube.com/watch?v=y16aMLeh91Q
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.pagasa.dost.gov.ph/learning-tools/tropical-cyclone-wind-signa
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.youtube.com/watch?v=5MP0TxfEWyA
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://canva.link/hqckhdfkd5k3pjf
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.youtube.com/watch?v=yurhT4mPjps
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.youtube.com/watch?v=G4svwU0twEw
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.youtube.com/watch?v=dJpIU1rSOFY
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.youtube.com/watch?v=AxpSZSsxvf8
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.youtube.com/watch?v=Hg1ktHeXaPU
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.youtube.com/watch?v=UFz2fLrqZuk
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.youtube.com/watch?v=9hQZCiZ21fk
                </div>
            </li>
            <li class="ref-item">
                <div class="ref-content">
                    https://www.youtube.com/watch?v=AoraXNrMp48
                </div>
            </li>
           
        </ul>

        <footer>
            Hamon at Tugon: An Interactive Digital Learning Material in Araling Panlipunan 10
        </footer>
    </div>

</body>
</html>