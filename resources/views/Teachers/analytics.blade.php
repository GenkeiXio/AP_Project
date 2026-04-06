@extends('Teachers.teacherslayout')

@section('title', 'My Analytics')
@section('page-title', 'Analytics')

@push('styles')
<style>
/* ---------- GLOBAL ---------- */
body {
    background: #f8fafc;
}

.page-header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:28px;
}

.page-header h1 {
    font-size:1.8rem;
    font-weight:800;
}

.page-header p {
    color:#64748b;
}

/* ---------- BUTTONS ---------- */
.btn {
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:10px 16px;
    border-radius:12px;
    font-size:0.85rem;
    font-weight:600;
    cursor:pointer;
    border:none;
    transition:0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg,#3b82f6,#6366f1);
    color:#fff;
}

.btn-outline {
    background:#eef2ff;
    color:#3b82f6;
}

.btn:hover {
    transform:translateY(-2px);
    box-shadow:0 8px 20px rgba(99,102,241,0.2);
}

/* ---------- STATS ---------- */
.stats-grid {
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-bottom:26px;
}

.stat-card {
    background:rgba(255,255,255,0.7);
    backdrop-filter:blur(10px);
    border-radius:18px;
    padding:22px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
    transition:0.3s;
    opacity:0;
    transform:translateY(20px);
}

.stat-card:hover {
    transform:translateY(-6px) scale(1.02);
}

.stat-info h3 {
    font-size:1.8rem;
    font-weight:800;
}

.stat-info span {
    font-size:0.85rem;
    color:#64748b;
}

.trend.up { color:#16a34a; }
.trend.down { color:#dc2626; }

/* ---------- ICON ---------- */
.icon-box {
    width:48px;
    height:48px;
    border-radius:12px;
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
    background:rgba(255,255,255,0.75);
    backdrop-filter:blur(12px);
    border-radius:18px;
    padding:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
    transition:0.3s;
    opacity:0;
    transform:translateY(30px);
}

.card:hover {
    transform:translateY(-4px);
}

.card h2 {
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

.chart-wrap {
    height:260px;
}

/* ---------- TABLE ---------- */
.table {
    width:100%;
    border-collapse:collapse;
}

.table td {
    padding:12px 0;
    border-bottom:1px solid #f1f5f9;
}

.table tr:hover {
    background:#f8fafc;
}

/* ---------- BADGES ---------- */
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
        <button id="btn-monthly" class="btn btn-outline time-btn" onclick="switchView('monthly', this)">Monthly</button>
        <button id="btn-quarterly" class="btn btn-outline time-btn" onclick="switchView('quarterly', this)">Quarterly</button>
        <button id="btn-yearly" class="btn btn-primary time-btn" onclick="switchView('yearly', this)">Yearly</button>

        <a href="{{ route('teacher.analytics.export', ['class_id'=>$classId]) }}" class="btn btn-primary">
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
            <div class="trend up">+12.5%</div>
        </div>
        <div class="icon-box blue"><i data-lucide="book-open"></i></div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h3 id="stat-students">{{ $stats['total_students'] }}</h3>
            <span>Students Attempted</span>
            <div class="trend up">+8.2%</div>
        </div>
        <div class="icon-box green"><i data-lucide="users"></i></div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h3 id="stat-avg">{{ $stats['avg_score'] }}%</h3>
            <span>Average Score</span>
            <div class="trend down">-2.1%</div>
        </div>
        <div class="icon-box orange"><i data-lucide="trophy"></i></div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h3 id="stat-modules">{{ $stats['total_quizzes'] }}</h3>
            <span>Modules Played</span>
            <div class="trend up">+15.3%</div>
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

<!-- TABLE + DONUT -->
<div class="grid-2">

    <div class="card">
        <h2>Detailed Analytics</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Module</th>
                    <th>Attempts</th>
                    <th>Students</th>
                    <th>Avg Score</th>
                    <th>Completion</th>
                </tr>
            </thead>

            <tbody>
                @foreach($topStudents as $ts)
                <tr>
                    <td>Module</td>
                    <td>{{ $ts->attempts }}</td>
                    <td>{{ $ts->student->username ?? '?' }}</td>
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

/* ---------------- DATA ---------------- */
const analyticsData = {
    monthly: {
        stats: {
            attempts: 1200,
            students: 120,
            avg: 78,
            modules: 320
        },
        bar: {
            labels: ['Week 1','Week 2','Week 3','Week 4'],
            data: [300, 400, 250, 250]
        },
        line: [10,20,30,50,80,120,90,60]
    },

    quarterly: {
        stats: {
            attempts: 3500,
            students: 320,
            avg: 74,
            modules: 860
        },
        bar: {
            labels: ['Jan','Feb','Mar'],
            data: [900, 1200, 1400]
        },
        line: [20,40,60,90,130,160,120,80]
    },

    yearly: {
        stats: {
            attempts: 7070,
            students: 580,
            avg: 75,
            modules: 1170
        },
        bar: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            data: [400,380,500,460,580,620,540,680,710,650,720,790]
        },
        line: [5,10,20,40,80,110,150,100,40]
    }
};

/* ---------------- INIT CHARTS ---------------- */
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
                borderRadius:8
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
            labels:['0-10','20','30','40','50','60','70','80','90','100'],
            datasets:[{
                data: dataset.line,
                borderColor:'#22c55e',
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

/* ---------------- UPDATE STATS ---------------- */
function updateStats(dataset){
    document.getElementById('stat-attempts').innerText = dataset.stats.attempts;
    document.getElementById('stat-students').innerText = dataset.stats.students;
    document.getElementById('stat-avg').innerText = dataset.stats.avg + '%';
    document.getElementById('stat-modules').innerText = dataset.stats.modules;
}

/* ---------------- BUTTON HANDLER ---------------- */
function setActive(button){
    document.querySelectorAll('.time-btn').forEach(btn=>{
        btn.classList.remove('btn-primary');
        btn.classList.add('btn-outline');
    });

    button.classList.remove('btn-outline');
    button.classList.add('btn-primary');
}

/* ---------------- SWITCH VIEW ---------------- */
function switchView(type, el){
    const dataset = analyticsData[type];

    updateStats(dataset);
    createCharts(dataset);
    setActive(el);
}

/* ---------------- INIT DEFAULT ---------------- */
window.onload = () => {
    switchView('monthly', document.getElementById('btn-monthly'));
};
</script>
@endpush