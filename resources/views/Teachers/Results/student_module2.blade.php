@extends('Teachers.teacherslayout')

@section('title','Student Results')

@push('styles')
<style>
body {
    background: linear-gradient(135deg, #f8fafc, #eef2ff);
}

/* BACK */
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #64748b;
    text-decoration: none;
    font-weight: 600;
    margin-bottom: 15px;
}
.back-link:hover {
    color: #111827;
}

/* HEADER */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.student-info {
    display: flex;
    align-items: center;
    gap: 16px;
}

.avatar {
    width: 60px;
    height: 60px;
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
    padding:12px 20px;
    border-radius:12px;
    font-weight:600;
    cursor:pointer;
    box-shadow:0 8px 20px rgba(59,130,246,0.3);
}
.btn:hover {
    transform: translateY(-2px);
}

/* SECTION */
.section {
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(10px);
    padding:20px;
    border-radius:16px;
    margin-top:20px;
}

/* TABS */
.tabs {
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}
.tab {
    padding:8px 14px;
    border-radius:999px;
    background:#e5e7eb;
    cursor:pointer;
}
.tab.active {
    background:#3b82f6;
    color:white;
}

/* STATS */
.stats {
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
    margin-top:20px;
}
.stat {
    background:white;
    border-radius:14px;
    padding:20px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
}

/* TABLE FIX */
.table-wrapper {
    margin-top:20px;
    background:white;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
}

table {
    width:100%;
    border-collapse: collapse;
}

thead {
    background:#f1f5f9;
}

th, td {
    padding:14px;
    text-align:left;
}

tbody tr {
    border-top:1px solid #f1f5f9;
}

tbody tr:hover {
    background:#f9fafb;
}

/* BADGE */
.badge {
    padding:6px 12px;
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