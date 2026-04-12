@extends('Teachers.teacherslayout')

@section('title','Student Results')

@push('styles')
<style>
body {
    background: linear-gradient(135deg, #f8fafc, #eef2ff);
    color: #1e293b;
}

/* BACK */
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 20px;

    font-size: 14px;
    font-weight: 600;
    color: #64748b;
    text-decoration: none;

    transition: all 0.2s ease;
}
.back-link:hover {
    color: #111827;
    transform: translateX(-3px);
}

/* HEADER */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;

    background: white;
    padding: 18px 22px;
    border-radius: 16px;

    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    margin-bottom: 20px;
}

.student-info {
    display: flex;
    align-items: center;
    gap: 14px;
}

.student-info h2 {
    font-size: 20px;
    font-weight: 700;
}

/* AVATAR */
.avatar {
    width: 58px;
    height: 58px;
    border-radius: 50%;

    background: linear-gradient(135deg,#6366f1,#3b82f6);
    color: white;

    display:flex;
    align-items:center;
    justify-content:center;

    font-weight:800;
    font-size:18px;
}

/* BUTTON */
.btn {
    background: linear-gradient(135deg,#3b82f6,#6366f1);
    color:white;
    border:none;
    padding:10px 16px;
    border-radius:12px;

    font-size:14px;
    font-weight:600;
    cursor:pointer;

    display:inline-flex;
    align-items:center;
    gap:6px;

    box-shadow:0 8px 18px rgba(59,130,246,0.25);
    transition:0.25s ease;
}
.btn:hover {
    transform: translateY(-2px);
    box-shadow:0 12px 25px rgba(59,130,246,0.35);
}
.btn:active {
    transform: scale(0.96);
}

/* SECTION */
.section {
    background: rgba(255,255,255,0.8);
    backdrop-filter: blur(12px);

    padding:20px;
    border-radius:16px;
    margin-top:20px;

    box-shadow: 0 10px 25px rgba(0,0,0,0.04);
}

/* TABS */
.tabs {
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    margin-top:8px;
}

.tab {
    padding:7px 14px;
    border-radius:999px;

    background:#e5e7eb;
    color:#475569;

    font-size:13px;
    font-weight:600;
    cursor:pointer;

    transition:all 0.2s ease;
}
.tab:hover {
    background:#d1d5db;
}
.tab.active {
    background:linear-gradient(135deg,#3b82f6,#6366f1);
    color:white;
    box-shadow:0 6px 14px rgba(59,130,246,0.25);
}

/* STATS */
.stats {
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:18px;
    margin-top:20px;
}

.stat {
    background:white;
    border-radius:14px;
    padding:18px;
    text-align:center;

    box-shadow:0 10px 20px rgba(0,0,0,0.05);
    transition:0.25s ease;
}
.stat:hover {
    transform:translateY(-3px);
}

.stat p {
    font-size:13px;
    color:#64748b;
}

.stat h2 {
    font-size:22px;
    font-weight:700;
    margin-top:5px;
}

/* TABLE */
.table {
    margin-top:20px;
    background:white;
    border-radius:14px;
    overflow:hidden;

    box-shadow:0 10px 25px rgba(0,0,0,0.05);
}

table {
    width:100%;
    border-collapse: collapse;
    font-size:14px;
}

thead {
    background:#f1f5f9;
}

th {
    text-align:left;
    font-weight:600;
    color:#64748b;
}

td {
    font-weight:500;
    color:#111827;
}

th, td {
    padding:14px;
}

tbody tr {
    border-top:1px solid #f1f5f9;
}

tbody tr:hover {
    background:#f9fafb;
}

/* BADGE */
.badge {
    padding:5px 10px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
}

.correct {
    background:#dcfce7;
    color:#16a34a;
}

.wrong {
    background:#fee2e2;
    color:#dc2626;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .header {
        flex-direction: column;
        align-items: flex-start;
        gap:12px;
    }

    .stats {
        grid-template-columns:1fr;
    }
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    margin-bottom: 20px;

    padding: 8px 14px;
    border-radius: 10px;

    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(10px);

    border: 1px solid #e5e7eb;

    font-size: 13px;
    font-weight: 600;
    color: #475569;

    text-decoration: none;

    transition: all 0.25s ease;
}

/* hover */
.back-link:hover {
    background: #ffffff;
    color: #111827;

    transform: translateX(-4px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.06);
}

/* active click */
.back-link:active {
    transform: scale(0.96);
}

/* optional icon spacing fix */
.back-link i {
    font-size: 14px;
}
</style>
@endpush

@section('content')

<a href="{{ route('teacher.module2.results') }}" class="back-link">
    ← Back to Student List
</a>

<div class="header">
    <div class="student-info">
        <div class="avatar">
            {{ strtoupper(substr($student->username,0,2)) }}
        </div>
        <div>
            <h2>{{ $student->username }}</h2>
        </div>
    </div>

    <a href="{{ route('teacher.module2.export.full', $student->id) }}">
        <button class="btn">⬇ Export Full Report</button>
    </a>
</div>

<!-- MODULE -->
<div class="section">
    <p><strong>MODULE</strong></p>
    <div class="tabs">
        <div class="tab active">Module 2</div>
    </div>

    <p style="margin-top:15px;"><strong>ACTIVITY</strong></p>
    <div class="tabs" id="activityTabs">
        <div class="tab active" onclick="showTab('pretest')">Pretest</div>
        <div class="tab" onclick="showTab('node1')">Node 1</div>
        <div class="tab" onclick="showTab('node2')">Node 2</div>
        <div class="tab" onclick="showTab('node3')">Node 3</div>
        <div class="tab" onclick="showTab('final')">Final</div>
        <div class="tab" onclick="showTab('posttest')">Posttest</div>
        <div class="tab" onclick="showTab('essay')">Essay</div>
    </div>
</div>

<!-- PRETEST -->
<div id="pretest" class="content">
    <div class="stats">
        <div class="stat">
            <p>Score</p>
            <h2>{{ $pretest->score ?? 0 }}</h2>
        </div>
        <div class="stat">
            <p>Percentage</p>
            <h2 style="color:#f59e0b">{{ $pretest->percentage ?? 0 }}%</h2>
        </div>
        <div class="stat">
            <p>Status</p>
            <h2 style="color:#f59e0b">
                {{ ($pretest->percentage ?? 0) >= 75 ? 'Passed' : 'Needs Improvement' }}
            </h2>
        </div>
    </div>

    <div class="table">
        <table>
            <tr>
                <th>Q#</th>
                <th>Selected</th>
                <th>Correct</th>
                <th>Result</th>
            </tr>
            @foreach($pretestAnswers as $a)
            <tr>
                <td>{{ $a->question_number }}</td>
                <td>{{ $a->selected_answer }}</td>
                <td>{{ $a->correct_answer }}</td>
                <td>
                    <span class="badge {{ $a->is_correct ? 'correct' : 'wrong' }}">
                        {{ $a->is_correct ? 'Correct' : 'Wrong' }}
                    </span>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

<!-- NODE1 -->
<div id="node1" class="content" style="display:none;">
    @foreach($node1 as $n)
        <div class="section">
            <b>Sanhi:</b> {{ $n->sanhi_text }} <br>
            <b>Bunga:</b> {{ $n->bunga_text }} <br>
            <b>Solusyon:</b> {{ $n->solusyon_text }}
        </div>
    @endforeach
</div>

<!-- NODE2 -->
<div id="node2" class="content" style="display:none;">
    @foreach($node2 as $n)
        <div class="section">
            {{ $n->sanhi }} → {{ $n->bunga }} → {{ $n->solusyon }}
        </div>
    @endforeach
</div>

<!-- NODE3 -->
<div id="node3" class="content" style="display:none;">
    @foreach($node3 as $n)
        <div class="section">
            {{ $n->sanhi }} → {{ $n->bunga }} → {{ $n->solusyon }}
        </div>
    @endforeach
</div>

<!-- FINAL -->
<div id="final" class="content" style="display:none;">
    <div class="stats">
        <div class="stat"><p>Score</p><h2>{{ $final->score ?? 0 }}</h2></div>
        <div class="stat"><p>XP</p><h2>{{ $final->total_xp ?? 0 }}</h2></div>
        <div class="stat"><p>Time</p><h2>{{ $final->time_taken ?? 0 }}s</h2></div>
    </div>
</div>

<!-- POSTTEST -->
<div id="posttest" class="content" style="display:none;">
    <div class="stats">
        <div class="stat"><p>Score</p><h2>{{ $posttest->score ?? 0 }}</h2></div>
        <div class="stat"><p>Percentage</p><h2>{{ $posttest->percentage ?? 0 }}%</h2></div>
    </div>
</div>

<!-- ESSAY -->
<div id="essay" class="content" style="display:none;">
    <div class="section">
        {{ $essay->essay_answer ?? 'No submission' }}
    </div>
</div>

@endsection

@push('scripts')
<script>
function showTab(tab){
    document.querySelectorAll('.content').forEach(c => c.style.display='none');
    document.getElementById(tab).style.display='block';

    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    event.target.classList.add('active');
}
</script>
@endpush