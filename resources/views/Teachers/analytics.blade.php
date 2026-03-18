@extends('Teachers.teacherslayout')

@section('title', 'My Analytics')
@section('page-title', 'Analytics')

@push('styles')
<style>
    .filter-bar { background:#fff; border-radius:16px; padding:20px 24px; box-shadow:0 4px 16px rgba(0,0,0,0.06); margin-bottom:24px; display:flex; align-items:center; gap:14px; flex-wrap:wrap; }
    .filter-bar label { font-size:0.82rem; font-weight:800; color:#9a8060; text-transform:uppercase; letter-spacing:0.6px; }
    .filter-select { padding:9px 14px; border:2px solid #e0d0ba; border-radius:10px; font-family:'Nunito',sans-serif; font-size:0.88rem; color:#3d2a1a; outline:none; transition:border-color 0.2s; min-width:200px; }
    .filter-select:focus { border-color:#3a9e8c; }

    .stats-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:16px; margin-bottom:24px; }
    .stat-card { background:#fff; border-radius:14px; padding:20px; box-shadow:0 3px 12px rgba(0,0,0,0.06); display:flex; align-items:center; gap:12px; }
    .stat-icon { width:46px; height:46px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.4rem; flex-shrink:0; }
    .stat-icon.teal   { background:#e0f5f2; }
    .stat-icon.orange { background:#fff3e0; }
    .stat-icon.green  { background:#e8f8ed; }
    .stat-icon.blue   { background:#e8f0ff; }
    .stat-info .val { font-family:'Baloo 2',cursive; font-size:1.7rem; font-weight:800; color:#3d2a1a; line-height:1; }
    .stat-info .lbl { font-size:0.75rem; color:#9a8060; font-weight:600; margin-top:2px; }

    .grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px; }
    @media(max-width:900px){ .grid-2 { grid-template-columns:1fr; } }

    .section-card { background:#fff; border-radius:16px; padding:24px; box-shadow:0 4px 16px rgba(0,0,0,0.06); }
    .section-card h2 { font-family:'Baloo 2',cursive; font-size:1.05rem; font-weight:800; color:#3d2a1a; margin-bottom:16px; display:flex; align-items:center; gap:8px; }
    .chart-wrap { position:relative; height:250px; }

    .data-table { width:100%; border-collapse:collapse; }
    .data-table th { text-align:left; font-size:0.7rem; font-weight:800; text-transform:uppercase; letter-spacing:0.8px; color:#9a8060; padding:0 12px 10px; border-bottom:2px solid #f0e8d8; }
    .data-table td { padding:11px 12px; font-size:0.87rem; border-bottom:1px solid #f5ede0; color:#5a4030; vertical-align:middle; }
    .data-table tr:last-child td { border-bottom:none; }
    .data-table tbody tr:hover { background:#fdfaf5; }

    .rank-badge { display:inline-flex; align-items:center; justify-content:center; width:26px; height:26px; border-radius:50%; font-size:0.75rem; font-weight:800; }
    .rank-1 { background:#ffd700; color:#7a5800; }
    .rank-2 { background:#e0e0e0; color:#5a5a5a; }
    .rank-3 { background:#cd7f32; color:#fff; }
    .rank-n { background:#f0ebe0; color:#9a8060; }

    .score-bar-wrap { display:flex; align-items:center; gap:10px; }
    .score-bar-bg { flex:1; height:7px; background:#f0e8d8; border-radius:4px; overflow:hidden; }
    .score-bar-fill { height:100%; border-radius:4px; }
    .score-pct { font-size:0.8rem; font-weight:800; color:#3d2a1a; width:38px; text-align:right; }

    .badge { display:inline-block; padding:3px 10px; border-radius:20px; font-size:0.72rem; font-weight:700; }
    .badge-green  { background:#e8f8ed; color:#1a7a38; }
    .badge-orange { background:#fff3e0; color:#b05800; }

    .empty-state { text-align:center; padding:36px; color:#c0ad90; }
    .empty-state .emoji { font-size:2.5rem; margin-bottom:8px; }

    .export-btn { display:inline-flex; align-items:center; gap:7px; padding:9px 18px; border-radius:10px; border:2px solid #3a9e8c; background:transparent; color:#3a9e8c; font-family:'Nunito',sans-serif; font-size:0.85rem; font-weight:700; cursor:pointer; transition:background 0.2s,color 0.2s; text-decoration:none; }
    .export-btn:hover { background:#3a9e8c; color:#fff; }

    .sessions-wrap { max-height:320px; overflow-y:auto; }
    .sessions-wrap::-webkit-scrollbar { width:4px; }
    .sessions-wrap::-webkit-scrollbar-thumb { background:#ddd; border-radius:2px; }
</style>
@endpush

@section('content')

<div class="filter-bar">
    <span style="font-size:1.1rem;">🔍</span>
    <form method="GET" action="{{ route('teacher.analytics') }}" style="display:flex;align-items:center;gap:14px;flex-wrap:wrap;flex:1;">
        <div>
            <label>Filter by Class</label><br>
            <select name="class_id" class="filter-select" onchange="this.form.submit()">
                <option value="">All My Classes</option>
                @foreach($classes as $c)
                    <option value="{{ $c->id }}" {{ $classId == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        @if($classId)
        <div style="align-self:flex-end;">
            <a href="{{ route('teacher.analytics') }}" style="font-size:0.82rem;color:#c0392b;font-weight:700;text-decoration:none;">✕ Clear</a>
        </div>
        @endif
        <div style="margin-left:auto; align-self:flex-end;">
            <a href="{{ route('teacher.analytics.export', ['class_id'=>$classId]) }}" class="export-btn">📥 Export CSV</a>
        </div>
    </form>
</div>

<div class="stats-grid">
    <div class="stat-card"><div class="stat-icon teal">📝</div><div class="stat-info"><div class="val">{{ $stats['total_sessions'] }}</div><div class="lbl">Quiz Attempts</div></div></div>
    <div class="stat-card"><div class="stat-icon orange">📊</div><div class="stat-info"><div class="val">{{ $stats['avg_score'] }}%</div><div class="lbl">Avg Score</div></div></div>
    <div class="stat-card"><div class="stat-icon green">🎒</div><div class="stat-info"><div class="val">{{ $stats['total_students'] }}</div><div class="lbl">Students Attempted</div></div></div>
    <div class="stat-card"><div class="stat-icon blue">🎮</div><div class="stat-info"><div class="val">{{ $stats['total_quizzes'] }}</div><div class="lbl">Quizzes Played</div></div></div>
</div>

<div class="grid-2">
    <div class="section-card">
        <h2>📊 Avg Score per Class</h2>
        @if($chartData->isEmpty())
            <div class="empty-state"><div class="emoji">📭</div><p>No data yet.</p></div>
        @else
            <div class="chart-wrap"><canvas id="barChart"></canvas></div>
        @endif
    </div>
    <div class="section-card">
        <h2>🎯 Score Distribution</h2>
        @if($sessions->isEmpty())
            <div class="empty-state"><div class="emoji">📭</div><p>No attempts yet.</p></div>
        @else
            <div class="chart-wrap"><canvas id="donutChart"></canvas></div>
        @endif
    </div>
</div>

<div class="grid-2">
    <div class="section-card">
        <h2>🏆 Top Students</h2>
        @if($topStudents->isEmpty())
            <div class="empty-state"><div class="emoji">🌱</div><p>No data yet.</p></div>
        @else
        <table class="data-table">
            <thead><tr><th>#</th><th>Student</th><th>Avg Score</th><th>Attempts</th></tr></thead>
            <tbody>
            @foreach($topStudents as $i => $ts)
            <tr>
                <td><span class="rank-badge {{ $i===0?'rank-1':($i===1?'rank-2':($i===2?'rank-3':'rank-n')) }}">{{ $i===0?'🥇':($i===1?'🥈':($i===2?'🥉':$i+1)) }}</span></td>
                <td><strong>{{ $ts->student->username ?? '?' }}</strong></td>
                <td>
                    <div class="score-bar-wrap">
                        <div class="score-bar-bg"><div class="score-bar-fill" style="width:{{ round($ts->avg_pct) }}%;background:{{ $ts->avg_pct>=75?'#4da862':($ts->avg_pct>=50?'#e8922a':'#e05050') }};"></div></div>
                        <span class="score-pct">{{ round($ts->avg_pct) }}%</span>
                    </div>
                </td>
                <td><span class="badge badge-blue" style="background:#e8f0ff;color:#2a4aaa;">{{ $ts->attempts }}x</span></td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </div>

    <div class="section-card">
        <h2>🕐 Recent Attempts</h2>
        @if($sessions->isEmpty())
            <div class="empty-state"><div class="emoji">📭</div><p>No attempts yet.</p></div>
        @else
        <div class="sessions-wrap">
        <table class="data-table">
            <thead><tr><th>Student</th><th>Quiz</th><th>Score</th><th>Date</th></tr></thead>
            <tbody>
            @foreach($sessions->sortByDesc('completed_at')->take(30) as $s)
            @php $pct = $s->total_points>0?round(($s->score/$s->total_points)*100):0; @endphp
            <tr>
                <td><strong>{{ $s->student->username ?? '?' }}</strong></td>
                <td style="font-size:0.8rem;">{{ Str::limit($s->quiz->title??'?',22) }}</td>
                <td><span class="badge {{ $pct>=75?'badge-green':($pct>=50?'badge-orange':'') }}" style="{{ $pct<50?'background:#fde8e8;color:#c0392b;':'' }}">{{ $pct }}%</span></td>
                <td style="font-size:0.75rem;color:#9a8060;">{{ $s->completed_at?->format('M d') }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
@if(!$chartData->isEmpty())
new Chart(document.getElementById('barChart').getContext('2d'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($chartData->pluck('label')) !!},
        datasets:[{ label:'Avg Score (%)', data:{!! json_encode($chartData->pluck('avg')) !!},
            backgroundColor:{!! json_encode($chartData->map(fn($d)=>$d['avg']>=75?'rgba(58,158,140,0.8)':($d['avg']>=50?'rgba(232,146,42,0.8)':'rgba(224,80,80,0.8)'))->values()) !!},
            borderRadius:8, borderSkipped:false }]
    },
    options:{ responsive:true, maintainAspectRatio:false,
        plugins:{ legend:{ display:false } },
        scales:{ y:{ min:0,max:100,ticks:{callback:v=>v+'%'},grid:{color:'#f0e8d8'} }, x:{grid:{display:false}} }
    }
});
@endif

@if(!$sessions->isEmpty())
@php
    $excellent = $sessions->filter(fn($s)=>$s->total_points>0&&($s->score/$s->total_points)*100>=75)->count();
    $passing   = $sessions->filter(fn($s)=>$s->total_points>0&&($s->score/$s->total_points)*100>=50&&($s->score/$s->total_points)*100<75)->count();
    $failing   = $sessions->filter(fn($s)=>$s->total_points>0&&($s->score/$s->total_points)*100<50)->count();
@endphp
new Chart(document.getElementById('donutChart').getContext('2d'), {
    type:'doughnut',
    data:{
        labels:['Excellent (75%+)','Passing (50–74%)','Needs Help (<50%)'],
        datasets:[{ data:[{{$excellent}},{{$passing}},{{$failing}}],
            backgroundColor:['rgba(58,158,140,0.85)','rgba(232,146,42,0.85)','rgba(224,80,80,0.85)'],
            borderWidth:0, hoverOffset:8 }]
    },
    options:{ responsive:true, maintainAspectRatio:false,
        plugins:{ legend:{ position:'bottom', labels:{ padding:14, font:{family:'Nunito',size:11} } } },
        cutout:'65%'
    }
});
@endif
</script>
@endpush
