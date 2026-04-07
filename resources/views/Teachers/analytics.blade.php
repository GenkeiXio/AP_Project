@extends('Teachers.teacherslayout')

@section('title', 'My Analytics')
@section('page-title', 'Analytics')

@push('styles')
<style>
/* ---------- GLOBAL ---------- */
.page-header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:24px;
}

.page-header h1 {
    font-size:1.6rem;
    font-weight:800;
    color:#1f2937;
}

.page-header p {
    font-size:0.9rem;
    color:#6b7280;
}

/* ---------- BUTTONS ---------- */
.btn {
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:10px 16px;
    border-radius:10px;
    font-size:0.85rem;
    font-weight:600;
    cursor:pointer;
    border:none;
}

.btn-primary {
    background:#3b82f6;
    color:#fff;
}

.btn-outline {
    background:#eef2ff;
    color:#3b82f6;
}

/* ---------- FILTER BAR ---------- */
.filter-bar {
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
    flex-wrap:wrap;
    gap:12px;
}

.filter-select {
    padding:10px 14px;
    border-radius:10px;
    border:1px solid #e5e7eb;
}

/* ---------- STATS ---------- */
.stats-grid {
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:18px;
    margin-bottom:24px;
}

.stat-card {
    background:#fff;
    border-radius:14px;
    padding:20px;
    box-shadow:0 6px 18px rgba(0,0,0,0.05);
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.stat-info h3 {
    font-size:1.6rem;
    font-weight:800;
}

.stat-info span {
    font-size:0.8rem;
    color:#6b7280;
}

.trend {
    font-size:0.75rem;
    margin-top:6px;
}

.trend.up { color:#16a34a; }
.trend.down { color:#dc2626; }

/* ---------- ICON ---------- */
.icon-box {
    width:44px;
    height:44px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
}

.blue { background:#eef2ff; color:#3b82f6; }
.green { background:#ecfdf5; color:#16a34a; }
.orange { background:#fff7ed; color:#ea580c; }
.purple { background:#f5f3ff; color:#7c3aed; }

/* ---------- CARDS ---------- */
.card {
    background:#fff;
    border-radius:14px;
    padding:20px;
    box-shadow:0 6px 18px rgba(0,0,0,0.05);
}

.card h2 {
    font-size:1rem;
    font-weight:700;
    margin-bottom:16px;
}

.grid-2 {
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
    margin-bottom:20px;
}

@media(max-width:900px){
    .grid-2 { grid-template-columns:1fr; }
}

.chart-wrap { height:260px; }

/* ---------- TABLE ---------- */
.table {
    width:100%;
    border-collapse:collapse;
}

.table th {
    font-size:0.7rem;
    color:#9ca3af;
    text-transform:uppercase;
    padding-bottom:10px;
}

.table td {
    padding:12px 0;
    border-bottom:1px solid #f1f5f9;
}

.badge {
    padding:4px 10px;
    border-radius:20px;
    font-size:0.75rem;
    font-weight:600;
}

.badge-green { background:#dcfce7; color:#166534; }
.badge-yellow { background:#fef3c7; color:#92400e; }
.badge-red { background:#fee2e2; color:#991b1b; }

/* ---------- DONUT ---------- */
.donut-card {
    display:flex;
    justify-content:center;
    align-items:center;
    height:100%;
}
</style>
@endpush

@section('content')

<!-- HEADER -->
<div class="page-header">
    <div>
        <h1>Analytics</h1>
        <p>Track student performance and module engagement</p>
    </div>

    <div style="display:flex; gap:10px;">
        <button id="btn-monthly" class="btn btn-primary time-btn"onclick="switchView('monthly', this)">Monthly</button>
        <button class="btn btn-outline time-btn" onclick="switchView('quarterly', this)">Quarterly</button>
        <button class="btn btn-outline time-btn" onclick="switchView('yearly', this)">Yearly</button>

        <a href="{{ route('teacher.analytics') }}" class="btn btn-primary">
            <i data-lucide="download"></i> Export CSV
        </a>
    </div>
</div>

<!-- STATS -->
<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-info">
            <h3 id="stat-attempts">{{ $stats['total_sessions'] }}</h3>
            <span>Module Attempts</span>
        </div>
        <div class="icon-box blue"><i data-lucide="book-open"></i></div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h3 id="stat-students">{{ $stats['total_students'] }}</h3>
            <span>Students Attempted</span>
        </div>
        <div class="icon-box green"><i data-lucide="users"></i></div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h3 id="stat-avg">{{ $stats['avg_score'] }}%</h3>
            <span>Average Score</span>
        </div>
        <div class="icon-box orange"><i data-lucide="trophy"></i></div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h3 id="stat-modules">{{ $stats['total_quizzes'] }}</h3>
            <span>Modules Played</span>
        </div>
        <div class="icon-box purple"><i data-lucide="gamepad-2"></i></div>
    </div>

</div>

<!-- CHARTS -->
<div class="grid-2">

    <div class="card">
        <h2>Module Attempts Over Time</h2>
        <div class="chart-wrap">
            <canvas id="barChart"></canvas>
        </div>
    </div>

    <div class="card">
        <h2>Average Score Distribution</h2>
        <div class="chart-wrap">
            <canvas id="donutChart"></canvas>
        </div>
    </div>

</div>

<!-- TABLE -->
<div class="grid-2">

    <div class="card">
        <h2>Detailed Analytics</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Module</th>
                    <th>Attempts</th>
                    <th>Student</th>
                    <th>Avg Score</th>
                    <th>Completion</th>
                </tr>
            </thead>

            <tbody>
                @foreach($topStudents as $ts)
                    <tr>
                        <td>Module 2</td>
                        <td>{{ $ts->attempts }}</td>
                        <td>{{ $ts->username }}</td> {{-- ✅ FIXED --}}
                        <td>{{ round($ts->avg_pct) }}%</td>
                        <td>
                            <span class="badge badge-green">82%</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <div class="card donut-card">
        <canvas id="donutChart2"></canvas>
    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>

<!-- LUCIDE -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
lucide.createIcons();

/* ---------------- REAL DATA ---------------- */
const analyticsData = {

    monthly: {
        stats: {
            attempts: {{ $stats['total_sessions'] }},
            students: {{ $stats['total_students'] }},
            avg: {{ $stats['avg_score'] }},
            modules: {{ $stats['total_quizzes'] }}
        },
        bar: {
            labels: {!! json_encode($barLabelsMonthly) !!},
            data: {!! json_encode($barDataMonthly) !!}
        },
        line: {!! json_encode($lineData) !!}
    },

    quarterly: {
        stats: {
            attempts: {{ $stats['total_sessions'] }},
            students: {{ $stats['total_students'] }},
            avg: {{ $stats['avg_score'] }},
            modules: {{ $stats['total_quizzes'] }}
        },
        bar: {
            labels: {!! json_encode($barLabelsQuarterly) !!},
            data: {!! json_encode($barDataQuarterly) !!}
        },
        line: {!! json_encode($lineData) !!}
    },

    yearly: {
        stats: {
            attempts: {{ $stats['total_sessions'] }},
            students: {{ $stats['total_students'] }},
            avg: {{ $stats['avg_score'] }},
            modules: {{ $stats['total_quizzes'] }}
        },
        bar: {
            labels: {!! json_encode($barLabelsYearly) !!},
            data: {!! json_encode($barDataYearly) !!}
        },
        line: {!! json_encode($lineData) !!}
    }
};

/* ---------------- CHARTS ---------------- */
let barChart, lineChart;

function createCharts(dataset) {

    if(barChart) barChart.destroy();
    if(lineChart) lineChart.destroy();

    barChart = new Chart(document.getElementById('barChart'), {
        type:'bar',
        data:{
            labels: dataset.bar.labels,
            datasets:[{
                data: dataset.bar.data,
                backgroundColor:'#3b82f6',
                borderRadius:10
            }]
        },
        options:{
            responsive:true,
            maintainAspectRatio:false,
            plugins:{ legend:{display:false} }
        }
    });

    lineChart = new Chart(document.getElementById('donutChart'), {
        type:'line',
        data:{
            labels:['0-49','50-69','70-84','85-100'],
            datasets:[{
                data: dataset.line,
                borderColor:'#22c55e',
                backgroundColor:'rgba(34,197,94,0.15)',
                fill:true,
                tension:0.4
            }]
        },
        options:{
            responsive:true,
            maintainAspectRatio:false,
            plugins:{ legend:{display:false} }
        }
    });
}

/* ---------------- COUNT-UP ---------------- */
function animateValue(el, start, end, duration, suffix='') {
    let startTime = null;

    function step(timestamp) {
        if (!startTime) startTime = timestamp;
        const progress = Math.min((timestamp - startTime) / duration, 1);
        const value = Math.floor(progress * (end - start) + start);
        el.innerText = value + suffix;

        if (progress < 1) requestAnimationFrame(step);
    }

    requestAnimationFrame(step);
}

/* ---------------- UPDATE STATS ---------------- */
function updateStats(dataset){
    animateValue(document.getElementById('stat-attempts'), 0, dataset.stats.attempts, 800);
    animateValue(document.getElementById('stat-students'), 0, dataset.stats.students, 800);
    animateValue(document.getElementById('stat-avg'), 0, dataset.stats.avg, 800, '%');
    animateValue(document.getElementById('stat-modules'), 0, dataset.stats.modules, 800);
}

/* ---------------- SWITCH ---------------- */
function switchView(type, el){

    const dataset = analyticsData[type];

    updateStats(dataset);
    createCharts(dataset);

    document.querySelectorAll('.time-btn').forEach(btn=>{
        btn.classList.remove('btn-primary');
        btn.classList.add('btn-outline');
    });

    el.classList.remove('btn-outline');
    el.classList.add('btn-primary');
}

/* ---------------- INIT ---------------- */
window.onload = () => {
    switchView('monthly', document.getElementById('btn-monthly'));
};
</script>
@endpush