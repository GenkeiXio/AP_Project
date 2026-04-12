<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Module 4 - Buod ng Aralin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #0b1b2b 0%, #11384f 45%, #173d2c 100%);
    min-height: 100vh;
    overflow-x: hidden;
    color: #eaf4ff;
}

.container-box {
    max-width: 1200px;
    margin: auto;
    padding: 30px 20px;
}

/* ============ SUMMARY SECTION ============ */
.summary-title {
    text-align: center;
    color: #f8fdff;
    font-weight: 900;
    font-size: 36px;
    letter-spacing: 1px;
    text-shadow: 0 4px 18px rgba(0,0,0,.35);
    margin-bottom: 30px;
}

.summary-container {
    display: flex;
    gap: 30px;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 40px;
    background: rgba(3, 18, 30, 0.5);
    border: 2px solid rgba(124, 231, 255, 0.2);
    border-radius: 18px;
    padding: 30px;
}

.summary-image {
    flex: 1;
    min-width: 300px;
}

.summary-image img {
    width: 100%;
    border-radius: 15px;
    box-shadow: 0 15px 35px rgba(124, 231, 255, 0.2);
    border: 2px solid rgba(124, 231, 255, 0.3);
}

.summary-text {
    flex: 1;
    min-width: 300px;
}

.summary-text p {
    color: #d8eefb;
    line-height: 1.8;
    margin-bottom: 16px;
    font-size: 16px;
}

.highlight {
    color: #7ce7ff;
    font-weight: 800;
}

.summary-text hr {
    border: 1px solid rgba(124, 231, 255, 0.2);
    margin: 20px 0;
}

.summary-text strong {
    color: #9dfdba;
}

/* ============ CELEBRATION SECTION ============ */
.celebration-container {
    text-align: center;
    padding: 40px 20px;
    margin-bottom: 30px;
}

.celebration-icon {
    font-size: 80px;
    animation: bounce 1s infinite;
    display: inline-block;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

@keyframes pulse {
    0% { transform: scale(0.8); opacity: 0; }
    50% { opacity: 1; }
    100% { transform: scale(1.1); opacity: 0; }
}

.pulse-badge {
    display: inline-block;
    animation: pulse 1.5s ease-out;
}

.completion-title {
    color: #7ce7ff;
    font-weight: 900;
    font-size: 48px;
    margin-bottom: 10px;
    text-shadow: 0 4px 20px rgba(124, 231, 255, 0.4);
}

.completion-subtitle {
    color: #9dfdba;
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 30px;
}

/* ============ STATS SECTION ============ */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
    margin-bottom: 30px;
}

.stat-card {
    background: linear-gradient(135deg, rgba(124, 231, 255, 0.15), rgba(57, 255, 20, 0.1));
    border: 2px solid rgba(124, 231, 255, 0.3);
    border-radius: 15px;
    padding: 20px;
    text-align: center;
    color: #eaf4ff;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    border-color: rgba(124, 231, 255, 0.6);
    box-shadow: 0 10px 30px rgba(124, 231, 255, 0.2);
}

.stat-number {
    font-size: 32px;
    font-weight: 900;
    color: #7ce7ff;
}

.stat-label {
    font-size: 14px;
    color: #b8d4e8;
    font-weight: 600;
}

/* ============ ACHIEVEMENTS ============ */
.achievements-section {
    background: rgba(3, 18, 30, 0.6);
    border: 2px solid rgba(124, 231, 255, 0.2);
    border-radius: 18px;
    padding: 30px;
    margin-bottom: 30px;
}

.achievements-title {
    color: #7ce7ff;
    font-weight: 800;
    font-size: 24px;
    margin-bottom: 20px;
    text-align: center;
}

.achievement-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 15px;
}

.achievement-badge {
    background: linear-gradient(135deg, rgba(157, 253, 186, 0.2), rgba(124, 231, 255, 0.15));
    border: 2px solid rgba(157, 253, 186, 0.4);
    border-radius: 12px;
    padding: 15px;
    text-align: center;
    color: #eaf4ff;
    font-weight: 700;
    font-size: 14px;
    transition: all 0.3s ease;
}

.achievement-badge:hover {
    transform: scale(1.05);
    border-color: rgba(157, 253, 186, 0.8);
    box-shadow: 0 8px 20px rgba(157, 253, 186, 0.2);
}

.achievement-icon {
    font-size: 32px;
    margin-bottom: 8px;
}

/* ============ KEY LEARNINGS ============ */
.learnings-section {
    background: rgba(3, 18, 30, 0.6);
    border: 2px solid rgba(124, 231, 255, 0.2);
    border-radius: 18px;
    padding: 30px;
    margin-bottom: 30px;
}

.learnings-title {
    color: #7ce7ff;
    font-weight: 800;
    font-size: 24px;
    margin-bottom: 20px;
}

.learning-item {
    display: flex;
    gap: 15px;
    margin-bottom: 16px;
    padding: 12px;
    background: rgba(157, 253, 186, 0.08);
    border-left: 4px solid #9dfdba;
    border-radius: 8px;
}

.learning-check {
    font-size: 20px;
    color: #9dfdba;
    font-weight: 900;
    min-width: 25px;
}

.learning-text {
    color: #d8eefb;
    line-height: 1.5;
}

/* ============ BUTTONS ============ */
.button-container {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 30px;
}

.btn-primary, .btn-secondary {
    padding: 14px 30px;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.btn-primary {
    background: linear-gradient(135deg, #7ce7ff, #9dfdba);
    color: #0b1b2b;
    box-shadow: 0 12px 30px rgba(124, 231, 255, 0.25);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 40px rgba(124, 231, 255, 0.35);
}

.btn-secondary {
    background: linear-gradient(135deg, #28a745, #45b358);
    color: white;
    box-shadow: 0 12px 30px rgba(40, 167, 69, 0.25);
}

.btn-secondary:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 40px rgba(40, 167, 69, 0.35);
}

/* ============ RESPONSIVE ============ */
@media (max-width: 768px) {
    .summary-title {
        font-size: 28px;
    }
    
    .completion-title {
        font-size: 32px;
    }
    
    .completion-subtitle {
        font-size: 16px;
    }
    
    .summary-container {
        padding: 20px;
        gap: 15px;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .achievement-list {
        grid-template-columns: repeat(3, 1fr);
    }
}
</style>
</head>

<body>

<div class="container-box">

    <!-- ============ SUMMARY SECTION ============ -->
    <h1 class="summary-title">VI. BUOD NG ARALIN</h1>
    
    <div class="summary-container">
        <!-- LEFT IMAGE -->
        <div class="summary-image">
            <img src="{{ asset('pictures/Module4/buod.png') }}" alt="Buod ng Aralin">
        </div>

        <!-- RIGHT TEXT -->
        <div class="summary-text">

            <p>
            Mahusay! Sa araling ito natutunan mo ang kahalagahan ng 
            <span class="highlight">kahandaan</span>, 
            <span class="highlight">disiplina</span>, at 
            <span class="highlight">kooperasyon</span> 
            sa pagtugon sa mga hamong pangkapaligiran.
            </p>

            <p>
            Nalalaman mo na ang pagiging handa bago ang sakuna, pagsunod sa mga babala habang ito ay nangyayari,
            at pakikiisa sa komunidad pagkatapos nito ay mahalaga upang mapanatili ang kaligtasan ng lahat.
            </p>

            <hr>

            <p>
            Nauunawaan mo rin na kahit hindi mapipigilan ang sakuna, maaari nating mabawasan ang pinsala kung tayo ay
            <strong>handa, disiplinado, at nagtutulungan.</strong>
            </p>

        </div>
    </div>

    <!-- ============ GAMIFIED COMPLETION ============ -->
    
    <!-- CELEBRATION -->
    <div class="celebration-container">
        <div class="celebration-icon pulse-badge">🎉</div>
        <div class="completion-title">TAPOS NA!</div>
        <div class="completion-subtitle">Matagumpay mong natapos ang Module 4</div>
    </div>

    <!-- STATS -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">11</div>
            <div class="stat-label">Mga Kartas</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">4</div>
            <div class="stat-label">Seksyon</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">100%</div>
            <div class="stat-label">Kumpleto</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">⭐</div>
            <div class="stat-label">Achiever</div>
        </div>
    </div>

    <!-- ACHIEVEMENTS -->
    <div class="achievements-section">
        <div class="achievements-title">🏆 Mga Nakamit</div>
        <div class="achievement-list">
            <div class="achievement-badge">
                <div class="achievement-icon">🧠</div>
                <div>Matuto</div>
            </div>
            <div class="achievement-badge">
                <div class="achievement-icon">⚡</div>
                <div>Handa</div>
            </div>
            <div class="achievement-badge">
                <div class="achievement-icon">💪</div>
                <div>Disiplinado</div>
            </div>
            <div class="achievement-badge">
                <div class="achievement-icon">🤝</div>
                <div>Kooperatibo</div>
            </div>
            <div class="achievement-badge">
                <div class="achievement-icon">✅</div>
                <div>Master</div>
            </div>
            <div class="achievement-badge">
                <div class="achievement-icon">🔥</div>
                <div>Champion</div>
            </div>
        </div>
    </div>

    <!-- KEY LEARNINGS -->
    <div class="learnings-section">
        <div class="learnings-title">📚 Mahahalagang Natutuhan</div>
        
        <div class="learning-item">
            <div class="learning-check">✓</div>
            <div class="learning-text"><strong>Kahandaan:</strong> Ang paghahanda bago ang sakuna ay nagsisiguro ng kaligtasan ng pamilya at komunidad.</div>
        </div>
        
        <div class="learning-item">
            <div class="learning-check">✓</div>
            <div class="learning-text"><strong>Disiplina:</strong> Ang pagsunod sa mga panuntunan at babala ay nakakaiwas ng aksidente at pinsala.</div>
        </div>
        
        <div class="learning-item">
            <div class="learning-check">✓</div>
            <div class="learning-text"><strong>Kooperasyon:</strong> Ang pagtutulungan ng komunidad ay nagpapabilis ng pagbangon at pagtulong sa mga nangangailangan.</div>
        </div>
        
        <div class="learning-item">
            <div class="learning-check">✓</div>
            <div class="learning-text"><strong>DRRM System:</strong> Ang batas at sistema para sa disaster risk reduction ay nakatutulong sa organisadong pagtugon.</div>
        </div>
    </div>

    <!-- CALL TO ACTION -->
    <div class="button-container">
        <a href="{{ route('module4.home') }}" class="btn-secondary">
            ↶ Bumalik sa Module
        </a>
        <a href="/dashboard" class="btn-primary">
            🏠 Balik sa Dashboard →
        </a>
    </div>

</div>

<script>
    // Play celebration animation on page load
    window.addEventListener('load', function() {
        // Could add confetti or additional animations here
    });
</script>

</body>
</html>