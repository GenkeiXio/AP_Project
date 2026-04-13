@extends('Teachers.teacherslayout')

@section('title', 'My Results')
@section('page-title', 'Results')

@push('styles')
<style>
    body {
    background: #f8fafc;
}

/* HEADER */
.header-row h1 {
    font-size: 28px;
    font-weight: 700;
}

.header-row p {
    color: #64748b;
}

/* STATS */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 35px;
}

.stat-card {
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(10px);
    border-radius: 18px;
    padding: 22px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    transition: 0.3s ease;
    opacity: 0;
    transform: translateY(20px);
}

.stat-card:hover {
    transform: translateY(-5px) scale(1.02);
}

.stat-icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* MODULES */
.modules-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 22px;
}

.module-card {
    position: relative;
    background: rgba(255,255,255,0.8);
    backdrop-filter: blur(12px);
    border-radius: 18px;
    padding: 22px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    cursor: pointer;
    overflow: hidden;
    transition: 0.3s ease;
    opacity: 0;
    transform: translateY(30px);
}

/* gradient glow effect */
.module-card::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg, transparent, rgba(255,255,255,0.4), transparent);
    opacity: 0;
    transition: 0.4s;
}

.module-card:hover::before {
    opacity: 1;
}

.module-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
}

/* COLORS */
.module-card.blue { border-top: 4px solid #3b82f6; }
.module-card.green { border-top: 4px solid #22c55e; }
.module-card.purple { border-top: 4px solid #8b5cf6; }

.module-title {
    font-size: 18px;
    font-weight: 600;
    margin-top: 12px;
}

.module-sub {
    color: #64748b;
    font-size: 14px;
    margin-bottom: 16px;
}

/* BADGES */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 500;
}

.badge.blue { background: #dbeafe; color: #2563eb; }
.badge.green { background: #dcfce7; color: #16a34a; }
.badge.purple { background: #ede9fe; color: #7c3aed; }
</style>
@endpush

    @section('content')

    <div class="header-row">
        <div>
            <h1>Results</h1>
            <p>Select a module to view student results</p>
        </div>
    </div>

    <!-- STATS -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background:#dbeafe;">
                <i data-lucide="book-open"></i>
            </div>
            <div>
                <p>Total Modules</p>
                <h2>{{ $totalModules }}</h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background:#dcfce7;">
                <i data-lucide="users"></i>
            </div>
            <div>
                <p>Total Students</p>
                <h2>{{ $totalStudents }}</h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background:#ede9fe;">
                <i data-lucide="trophy"></i>
            </div>
            <div>
                <p>Avg. Completion</p>
                <h2>{{ round($avgCompletion) }}%</h2>
            </div>
        </div>
    </div>

    <!-- MODULES -->
    <div class="modules-grid">

        <a href="{{ route('teacher.module2.results') }}" style="text-decoration:none; color:inherit;">
            <div class="module-card blue">
                <div class="stat-icon" style="background:#dbeafe;">
                    <i data-lucide="book-open"></i>
                </div>
                <div class="module-title">Module 2</div>
                <div class="module-sub">Sanhi at Bunga</div>

                <span class="badge blue">
                    <i data-lucide="users"></i> 
                </span>
            </div>
        </a>

        <a href="{{ route('teacher.module3.results') }}" style="text-decoration:none; color:inherit;">
            <div class="module-card green">
                <div class="stat-icon" style="background:#dcfce7;">
                    <i data-lucide="book-open"></i>
                </div>
                <div class="module-title">Module 3</div>
                <div class="module-sub">Pag-unawa sa Teksto</div>

                <span class="badge green">
                    <i data-lucide="users"></i> 
                </span>
            </div>
        </a>

        <a href="{{ route('teacher.module4.results') }}" style="text-decoration:none; color:inherit;">
            <div class="module-card purple">
                <div class="stat-icon" style="background:#ede9fe;">
                    <i data-lucide="book-open"></i>
                </div>
                <div class="module-title">Module 4</div>
                <div class="module-sub">Pagsusuri ng Datos</div>

                <span class="badge purple">
                    <i data-lucide="users"></i> 
                </span>
            </div>
        </a>
    </div>

    @endsection


    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();

        // FADE-IN STAGGER ANIMATION
        const cards = document.querySelectorAll('.stat-card, .module-card');

        cards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = "1";
                card.style.transform = "translateY(0)";
            }, index * 120);
        });

        // COUNT-UP ANIMATION
        const counters = document.querySelectorAll('h2');

        counters.forEach(counter => {
            const target = +counter.innerText.replace('%','');
            let count = 0;

            const update = () => {
                const increment = target / 30;
                count += increment;

                if (count < target) {
                    counter.innerText = Math.floor(count) + (counter.innerText.includes('%') ? '%' : '');
                    requestAnimationFrame(update);
                } else {
                    counter.innerText = target + (counter.innerText.includes('%') ? '%' : '');
                }
            };

            update();
        });
    </script>
@endpush