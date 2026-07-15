@extends('Teachers.teacherslayout')

@section('title', $student->username . ' — Module 3 Results')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">

<style>
/* ─── TOKENS ─────────────────────────────────────────────── */
:root {
    --bg:          #f0f4ff;
    --surface:     #ffffff;
    --surface-2:   #f8faff;
    --border:      #e4e9f7;

    --blue:        #4361ee;
    --blue-light:  #eef1ff;
    --blue-dark:   #2d46c7;

    --green:       #10b981;
    --green-light: #d1fae5;

    --amber:       #f59e0b;
    --amber-light: #fef3c7;

    --red:         #ef4444;
    --red-light:   #fee2e2;

    --purple:      #8b5cf6;
    --purple-light:#ede9fe;

    --teal:        #14b8a6;
    --teal-light:  #ccfbf1;

    --orange:      #f97316;
    --orange-light:#ffedd5;

    --text-1:  #0f172a;
    --text-2:  #334155;
    --text-3:  #64748b;
    --text-4:  #94a3b8;

    --radius:     14px;
    --shadow-sm:  0 1px 3px rgba(15,23,42,.06), 0 1px 2px rgba(15,23,42,.04);
    --shadow:     0 4px 16px rgba(67,97,238,.08), 0 1px 4px rgba(15,23,42,.06);
    --shadow-lg:  0 12px 40px rgba(67,97,238,.12), 0 4px 12px rgba(15,23,42,.08);
}

/* ─── BASE ───────────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text-1); }
h1,h2,h3,h4,h5 { font-family: 'Outfit', sans-serif; }

.page-wrap { max-width: 1100px; margin: 0 auto; padding: 28px 20px 60px; }

/* ─── BACK ───────────────────────────────────────────────── */
.back-btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 8px 16px; border-radius: 999px;
    background: var(--surface); border: 1px solid var(--border);
    color: var(--text-3); font-family: 'Outfit', sans-serif;
    font-weight: 600; font-size: 13px; text-decoration: none;
    margin-bottom: 22px; transition: all .2s; box-shadow: var(--shadow-sm);
}
.back-btn svg { transition: transform .2s; }
.back-btn:hover { color: var(--text-1); border-color: var(--blue); transform: translateX(-2px); box-shadow: var(--shadow); }
.back-btn:hover svg { transform: translateX(-3px); }

/* ─── HERO ───────────────────────────────────────────────── */
.hero {
    display: grid; grid-template-columns: 1fr auto;
    align-items: center; gap: 20px;
    background: var(--surface); border-radius: 20px;
    padding: 24px 28px; box-shadow: var(--shadow);
    margin-bottom: 22px; border: 1px solid var(--border);
    position: relative; overflow: hidden;
}
.hero::before {
    content: '';
    position: absolute; top: 0; left: 0;
    width: 6px; height: 100%;
    background: linear-gradient(180deg, var(--teal), var(--blue));
    border-radius: 20px 0 0 20px;
}
.hero-left { display: flex; align-items: center; gap: 18px; padding-left: 10px; min-width: 0; }
.avatar-ring {
    width: 64px; height: 64px; border-radius: 50%;
    background: linear-gradient(135deg, var(--teal), var(--blue));
    display: flex; align-items: center; justify-content: center;
    color: white; font-family: 'Outfit', sans-serif;
    font-weight: 800; font-size: 22px;
    box-shadow: 0 6px 20px rgba(20,184,166,.3); flex-shrink: 0;
}
.hero-meta { min-width: 0; }
.hero-meta h1 { font-size: 22px; font-weight: 800; letter-spacing: -.4px; overflow-wrap: break-word; }
.hero-meta p   { font-size: 13px; color: var(--text-3); margin-top: 3px; }
.hero-pills { display: flex; gap: 8px; margin-top: 8px; flex-wrap: wrap; }

.pill {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 4px 10px; border-radius: 999px;
    font-size: 12px; font-weight: 600; font-family: 'Outfit', sans-serif;
}
.pill-blue   { background: var(--blue-light);   color: var(--blue-dark); }
.pill-green  { background: var(--green-light);  color: #059669; }
.pill-amber  { background: var(--amber-light);  color: #b45309; }
.pill-purple { background: var(--purple-light); color: #6d28d9; }
.pill-teal   { background: var(--teal-light);   color: #0f766e; }
.pill-red    { background: var(--red-light);    color: #dc2626; }

.export-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    padding: 11px 20px; border-radius: 12px;
    background: linear-gradient(135deg, var(--teal), var(--blue));
    color: white; font-family: 'Outfit', sans-serif;
    font-weight: 700; font-size: 13px; text-decoration: none;
    box-shadow: 0 6px 20px rgba(20,184,166,.3);
    transition: all .2s; white-space: nowrap; flex-shrink: 0;
}
.export-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(20,184,166,.4); }
.export-btn:active { transform: scale(.97); }

/* ─── SNAPSHOT ROW ───────────────────────────────────────── */
.snapshot { display: grid; grid-template-columns: repeat(4,1fr); gap: 14px; margin-bottom: 22px; }

.snap-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius); padding: 18px 20px;
    box-shadow: var(--shadow-sm); position: relative; overflow: hidden;
    transition: transform .2s, box-shadow .2s;
}
.snap-card:hover { transform: translateY(-2px); box-shadow: var(--shadow); }
.snap-card .icon { width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-bottom: 12px; }
.snap-card .label { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: .8px; color: var(--text-3); font-family: 'Outfit', sans-serif; }
.snap-card .value { font-size: 28px; font-weight: 800; font-family: 'Outfit', sans-serif; letter-spacing: -1px; margin-top: 2px; line-height: 1; }
.snap-card .sub   { font-size: 12px; color: var(--text-3); margin-top: 4px; }

.snap-teal   .icon { background: var(--teal-light); }
.snap-green  .icon { background: var(--green-light); }
.snap-amber  .icon { background: var(--amber-light); }
.snap-purple .icon { background: var(--purple-light); }
.snap-teal   .value { color: var(--teal); }
.snap-green  .value { color: var(--green); }
.snap-amber  .value { color: var(--amber); }
.snap-purple .value { color: var(--purple); }

.improvement { display: inline-flex; align-items: center; gap: 3px; font-size: 13px; font-weight: 700; font-family: 'Outfit', sans-serif; padding: 2px 8px; border-radius: 999px; margin-top: 6px; }
.improvement.up   { background: var(--green-light); color: #059669; }
.improvement.down { background: var(--red-light);   color: #dc2626; }
.improvement.flat { background: #f1f5f9; color: var(--text-3); }

.prog-track { height: 7px; background: var(--border); border-radius: 999px; overflow: hidden; margin-top: 8px; }
.prog-fill  { height: 100%; border-radius: 999px; background: linear-gradient(90deg, var(--teal), var(--blue)); transition: width 1.2s cubic-bezier(.25,.8,.25,1); }

/* ─── TAB NAV ────────────────────────────────────────────── */
.tab-nav-wrap {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius); padding: 6px;
    display: flex; gap: 4px; margin-bottom: 20px;
    box-shadow: var(--shadow-sm); overflow-x: auto;
    scrollbar-width: thin; scrollbar-color: var(--border) transparent;
    -webkit-overflow-scrolling: touch;
}
.tab-nav-wrap::-webkit-scrollbar { height: 4px; }
.tab-nav-wrap::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }

.tab-btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 14px; border-radius: 10px;
    font-family: 'Outfit', sans-serif; font-size: 12.5px; font-weight: 600;
    color: var(--text-3); cursor: pointer; border: none;
    background: transparent; white-space: nowrap; transition: all .2s; flex-shrink: 0;
    scroll-snap-align: start;
}
.tab-btn .badge-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--green); flex-shrink: 0; }
.tab-btn .badge-dot.empty { background: var(--text-4); }
.tab-btn:hover { color: var(--text-1); background: var(--surface-2); }
.tab-btn.active {
    background: linear-gradient(135deg, var(--teal), var(--blue));
    color: white; box-shadow: 0 4px 14px rgba(20,184,166,.28);
}
.tab-btn.active .badge-dot { background: rgba(255,255,255,.7); }

/* ─── PANEL ──────────────────────────────────────────────── */
.panel { display: none; animation: panelIn .22s ease; }
.panel.active { display: block; }
@keyframes panelIn { from { opacity:0; transform:translateY(6px); } to { opacity:1; transform:translateY(0); } }

/* ─── SCORE RINGS ────────────────────────────────────────── */
.score-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 14px; margin-bottom: 20px; }
.score-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 20px; text-align: center; box-shadow: var(--shadow-sm); }
.score-card .sc-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .8px; color: var(--text-3); font-family: 'Outfit', sans-serif; margin-bottom: 10px; }
.score-ring-wrap { display: flex; justify-content: center; margin-bottom: 8px; }
.score-ring { position: relative; width: 80px; height: 80px; }
.score-ring svg { transform: rotate(-90deg); }
.score-ring .ring-bg   { stroke: var(--border); stroke-width: 7; fill: none; }
.score-ring .ring-fill { stroke-width: 7; fill: none; stroke-linecap: round; }
.score-ring .ring-text { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; flex-direction: column; font-family: 'Outfit', sans-serif; }
.score-ring .ring-text strong { font-size: 18px; font-weight: 800; }
.score-ring .ring-text span   { font-size: 10px; color: var(--text-3); }
.score-card .sc-correct { font-size: 13px; color: var(--text-3); margin-top: 2px; }

/* ─── ANSWER TABLE ───────────────────────────────────────── */
.answer-table-wrap { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-sm); }
.table-scroll { overflow-x: auto; -webkit-overflow-scrolling: touch; }
.answer-table-wrap table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
.answer-table-wrap thead { background: var(--surface-2); }
.answer-table-wrap th { font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 11px; text-transform: uppercase; letter-spacing: .7px; color: var(--text-3); padding: 12px 16px; text-align: left; white-space: nowrap; }
.answer-table-wrap td { padding: 11px 16px; color: var(--text-2); font-weight: 500; vertical-align: middle; }
.answer-table-wrap tbody tr { border-top: 1px solid var(--border); transition: background .15s; }
.answer-table-wrap tbody tr:hover { background: var(--surface-2); }

.q-num { display: inline-flex; align-items: center; justify-content: center; width: 26px; height: 26px; border-radius: 8px; background: var(--blue-light); color: var(--blue-dark); font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 12px; }

.tag { display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: 700; font-family: 'Outfit', sans-serif; white-space: nowrap; }
.tag-correct { background: var(--green-light); color: #059669; }
.tag-wrong   { background: var(--red-light);   color: #dc2626; }
.tag-pass    { background: #dbeafe; color: #1e40af; }
.tag-fail    { background: var(--red-light); color: #dc2626; }
.tag-done    { background: var(--green-light); color: #059669; }
.tag-pending { background: var(--amber-light); color: #b45309; }
.tag-neutral { background: var(--surface-2); color: var(--text-3); border: 1px solid var(--border); }
.tag-teal    { background: var(--teal-light); color: #0f766e; }
.tag-purple  { background: var(--purple-light); color: #6d28d9; }
.tag-orange  { background: var(--orange-light); color: #c2410c; }

/* ─── SECTION HEADER ─────────────────────────────────────── */
.sec-header { display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 14px; flex-wrap: wrap; }
.sec-title { font-family: 'Outfit', sans-serif; font-size: 15px; font-weight: 700; color: var(--text-1); display: flex; align-items: center; gap: 8px; }
.sec-title .line { width: 4px; height: 18px; border-radius: 99px; background: linear-gradient(180deg, var(--teal), var(--blue)); }
.summary-badge { font-size: 12px; font-weight: 600; font-family: 'Outfit', sans-serif; color: var(--text-3); background: var(--surface-2); border: 1px solid var(--border); padding: 4px 10px; border-radius: 999px; white-space: nowrap; }

/* ─── STAT GRID ──────────────────────────────────────────── */
.stat-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 14px; margin-bottom: 20px; }

.stat-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius); padding: 18px 16px;
    box-shadow: var(--shadow-sm); border-top: 3px solid var(--blue);
    transition: transform .15s;
}
.stat-card:hover { transform: translateY(-2px); }
.stat-card.green  { border-top-color: var(--green); }
.stat-card.red    { border-top-color: var(--red); }
.stat-card.amber  { border-top-color: var(--amber); }
.stat-card.purple { border-top-color: var(--purple); }
.stat-card.teal   { border-top-color: var(--teal); }
.stat-card.orange { border-top-color: var(--orange); }

.stat-card .s-label { font-size: 11px; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--text-3); margin-bottom: 6px; font-family: 'Outfit', sans-serif; }
.stat-card .s-value { font-size: 26px; font-weight: 800; color: var(--text-1); line-height: 1; font-family: 'Outfit', sans-serif; }
.stat-card .s-sub   { font-size: 12px; color: var(--text-3); margin-top: 3px; }

/* ─── INFO TABLE ─────────────────────────────────────────── */
.info-table-wrap { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-sm); }
.info-table-wrap table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
.info-table-wrap tr { border-bottom: 1px solid var(--border); }
.info-table-wrap tr:last-child { border-bottom: none; }
.info-table-wrap tr:hover { background: var(--surface-2); }
.info-table-wrap .i-label { padding: 12px 18px; width: 220px; font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 11px; text-transform: uppercase; letter-spacing: .7px; color: var(--text-3); background: var(--surface-2); }
.info-table-wrap .i-value { padding: 12px 18px; color: var(--text-2); font-weight: 500; }

/* ─── SCORE BAND (performance task) ─────────────────────── */
.score-band {
    display: grid; grid-template-columns: repeat(5, 1fr);
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius); overflow: hidden;
    box-shadow: var(--shadow-sm); margin-bottom: 20px;
}
.seg { padding: 18px 12px; text-align: center; border-right: 1px solid var(--border); }
.seg:last-child { border-right: none; background: var(--surface-2); }
.seg .seg-label { font-size: 10px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: var(--text-3); font-family: 'Outfit', sans-serif; margin-bottom: 6px; }
.seg .seg-val   { font-size: 28px; font-weight: 800; color: var(--text-1); font-family: 'Outfit', sans-serif; letter-spacing: -1px; }
.seg:last-child .seg-val { color: var(--teal); }

/* ─── EMPTY STATE ────────────────────────────────────────── */
.empty-state { text-align: center; padding: 40px 20px; background: var(--surface); border: 1px dashed var(--border); border-radius: var(--radius); color: var(--text-3); }
.empty-state .empty-icon { font-size: 32px; margin-bottom: 8px; }
.empty-state p { font-family: 'Outfit', sans-serif; font-weight: 600; font-size: 14px; }

/* ─── RESPONSIVE ─────────────────────────────────────────── */
@media (max-width: 900px) {
    .score-band { grid-template-columns: repeat(3,1fr); }
}
@media (max-width: 768px) {
    .page-wrap { padding: 22px 16px 48px; }
    .hero { grid-template-columns: 1fr; padding: 20px; }
    .hero::before { width: 100%; height: 6px; border-radius: 20px 20px 0 0; }
    .export-btn { width: 100%; margin-top: 4px; }
    .snapshot { grid-template-columns: repeat(2,1fr); }
    .score-grid { grid-template-columns: 1fr; }
    .score-band { grid-template-columns: repeat(2,1fr); }
    .stat-grid { grid-template-columns: repeat(auto-fill, minmax(135px, 1fr)); }
}
@media (max-width: 560px) {
    .info-table-wrap tr { display: flex; flex-direction: column; }
    .info-table-wrap .i-label { width: 100%; padding-bottom: 4px; }
    .info-table-wrap .i-value { padding-top: 0 18px 12px; }
}
@media (max-width: 520px) {
    .hero-left { gap: 14px; padding-left: 4px; }
    .avatar-ring { width: 54px; height: 54px; font-size: 18px; }
    .hero-meta h1 { font-size: 19px; }
    .snapshot { grid-template-columns: 1fr; }
    .snap-card .value { font-size: 24px; }
    .score-band { grid-template-columns: 1fr; }
    .seg { border-right: none; border-bottom: 1px solid var(--border); }
    .seg:last-child { border-bottom: none; }
    .back-btn { margin-bottom: 16px; }
    .tab-btn { font-size: 12px; padding: 8px 12px; }
    .answer-table-wrap th, .answer-table-wrap td { padding: 10px 12px; }
}
</style>
@endpush

@section('content')
<div class="page-wrap">

{{-- BACK --}}
<a href="{{ route('teacher.module3.results') }}" class="back-btn">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M19 12H5M12 5l-7 7 7 7"/>
    </svg>
    Back to Student List
</a>

{{-- HERO --}}
<div class="hero">
    <div class="hero-left">
        <div class="avatar-ring">{{ strtoupper(substr($student->username, 0, 2)) }}</div>
        <div class="hero-meta">
            <h1>{{ $student->username }}</h1>
            <p>Module 3 — Detailed Performance Report</p>
            <div class="hero-pills">
                @if($pretest)
                    <span class="pill pill-teal">📝 Pre: {{ $pretest->score }}/{{ $stats['pre_total'] }}</span>
                @endif
                @if($posttest && $stats['improvement'] !== null)
                    @php $imp = $stats['improvement']; @endphp
                    <span class="pill {{ $imp > 0 ? 'pill-green' : ($imp < 0 ? 'pill-red' : 'pill-blue') }}">
                        {{ $imp > 0 ? '↑' : ($imp < 0 ? '↓' : '→') }} {{ abs($imp) }}% vs Pre
                    </span>
                @endif
                @if($performance)
                    <span class="pill pill-purple">🎯 Perf: {{ $stats['perf_total'] }}</span>
                @endif
                <span class="pill {{ $stats['completion_pct'] >= 80 ? 'pill-green' : 'pill-amber' }}">
                    ✅ {{ $stats['activities_done'] }}/{{ $stats['total_activities'] }} Done
                </span>
            </div>
        </div>
    </div>
    <a href="{{ route('teacher.module3.export', $student->id) }}" class="export-btn">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
        </svg>
        Export CSV
    </a>
</div>

{{-- SNAPSHOT --}}
<div class="snapshot">
    <div class="snap-card snap-teal">
        <div class="icon">📝</div>
        <div class="label">Pre-test</div>
        <div class="value">{{ $pretest ? round($pretest->percentage) : '—' }}{{ $pretest ? '%' : '' }}</div>
        <div class="sub">{{ $pretest ? $stats['pre_correct'].'/'.$stats['pre_total'].' correct' : 'Not submitted' }}</div>
    </div>

    <div class="snap-card snap-green">
        <div class="icon">📋</div>
        <div class="label">Post-test</div>
        <div class="value">{{ $posttest ? $stats['post_pct'] : '—' }}{{ $posttest ? '%' : '' }}</div>
        <div class="sub">{{ $posttest ? $stats['post_correct'].'/'.$stats['post_total'].' correct' : 'Not submitted' }}</div>
        @if($pretest && $posttest && $stats['improvement'] !== null)
            @php $imp = $stats['improvement']; @endphp
            <div class="improvement {{ $imp > 0 ? 'up' : ($imp < 0 ? 'down' : 'flat') }}">
                {{ $imp > 0 ? '▲' : ($imp < 0 ? '▼' : '—') }} {{ abs($imp) }}%
            </div>
        @endif
    </div>

    <div class="snap-card snap-purple">
        <div class="icon">🎯</div>
        <div class="label">Performance Task</div>
        <div class="value">{{ $performance ? $stats['perf_total'] : '—' }}</div>
        <div class="sub">{{ $performance ? 'Kit · Evacuation · Comms · Safe' : 'Not submitted' }}</div>
    </div>

    <div class="snap-card snap-amber">
        <div class="icon">✅</div>
        <div class="label">Completion</div>
        <div class="value">{{ $stats['completion_pct'] }}<span style="font-size:16px;font-weight:500;color:var(--text-3)">%</span></div>
        <div class="prog-track">
            <div class="prog-fill" style="width:{{ $stats['completion_pct'] }}%"></div>
        </div>
        <div class="sub" style="margin-top:6px">{{ $stats['activities_done'] }} of {{ $stats['total_activities'] }} activities</div>
    </div>
</div>

{{-- TAB NAV --}}
@php
$tabs = [
    ['id'=>'pretest',    'label'=>'Pre-test',    'icon'=>'📝', 'has'=> !!$pretest],
    ['id'=>'node1',      'label'=>'Node 1',      'icon'=>'🗂️', 'has'=> !!$node1],
    ['id'=>'node2',      'label'=>'Node 2',      'icon'=>'⚔️', 'has'=> !!$node2],
    ['id'=>'node3',      'label'=>'Node 3',      'icon'=>'💰', 'has'=> !!$node3],
    ['id'=>'balikaral',  'label'=>'Balik-Aral',  'icon'=>'🔄', 'has'=> !!$balikaral],
    ['id'=>'bulkan',     'label'=>'Bulkan',       'icon'=>'🌋', 'has'=> !!$bulkan],
    ['id'=>'elnino',     'label'=>'El Niño',      'icon'=>'☀️', 'has'=> !!$elnino],
    ['id'=>'explore',    'label'=>'Explore',      'icon'=>'🧭', 'has'=> !!$explore],
    ['id'=>'flood',      'label'=>'Flood',        'icon'=>'🌊', 'has'=> !!$flood],
    ['id'=>'gabay',      'label'=>'Gabay',        'icon'=>'🗺️', 'has'=> !!$gabay],
    ['id'=>'gobag',      'label'=>'Go Bag',       'icon'=>'🎒', 'has'=> !!$gobagact],
    ['id'=>'lindol',     'label'=>'Lindol',       'icon'=>'🌍', 'has'=> !!$lindol],
    ['id'=>'safehome',   'label'=>'Safe Home',    'icon'=>'🏠', 'has'=> !!$safehome],
    ['id'=>'posttest',   'label'=>'Post-test',    'icon'=>'📋', 'has'=> !!$posttest],
    ['id'=>'performance','label'=>'Perf. Task',   'icon'=>'🎯', 'has'=> !!$performance],
];
@endphp
<div class="tab-nav-wrap">
    @foreach($tabs as $i => $tab)
        <button class="tab-btn {{ $i === 0 ? 'active' : '' }}" onclick="switchTab('{{ $tab['id'] }}', this)">
            {{ $tab['icon'] }} {{ $tab['label'] }}
            <span class="badge-dot {{ $tab['has'] ? '' : 'empty' }}"></span>
        </button>
    @endforeach
</div>

{{-- ════════════════════════════════════════
     PRETEST
════════════════════════════════════════ --}}
<div id="panel-pretest" class="panel active">
    @if($pretest)
        @php $pct = round($pretest->percentage ?? 0); @endphp
        <div class="score-grid" style="margin-bottom:20px">
            <div class="score-card">
                <div class="sc-label">Score</div>
                <div class="score-ring-wrap">
                    <div class="score-ring">
                        <svg viewBox="0 0 80 80" width="80" height="80">
                            <circle class="ring-bg" cx="40" cy="40" r="33"/>
                            <circle class="ring-fill" cx="40" cy="40" r="33" stroke="var(--teal)"
                                stroke-dasharray="{{ 2*pi()*33 }}"
                                stroke-dashoffset="{{ 2*pi()*33*(1 - $pct/100) }}"/>
                        </svg>
                        <div class="ring-text">
                            <strong style="color:var(--teal)">{{ $pretest->score }}</strong>
                            <span>pts</span>
                        </div>
                    </div>
                </div>
                <div class="sc-correct">{{ $stats['pre_correct'] }}/{{ $stats['pre_total'] }} correct</div>
            </div>
            <div class="score-card">
                <div class="sc-label">Percentage</div>
                <div class="score-ring-wrap">
                    @php $col = $pct >= 75 ? '#10b981' : ($pct >= 50 ? '#f59e0b' : '#ef4444'); @endphp
                    <div class="score-ring">
                        <svg viewBox="0 0 80 80" width="80" height="80">
                            <circle class="ring-bg" cx="40" cy="40" r="33"/>
                            <circle class="ring-fill" cx="40" cy="40" r="33" stroke="{{ $col }}"
                                stroke-dasharray="{{ 2*pi()*33 }}"
                                stroke-dashoffset="{{ 2*pi()*33*(1 - $pct/100) }}"/>
                        </svg>
                        <div class="ring-text"><strong style="color:{{ $col }}">{{ $pct }}%</strong></div>
                    </div>
                </div>
                <div class="sc-correct">{{ $pct >= 75 ? 'Passed ✓' : ($pct >= 50 ? 'Average' : 'Needs Improvement') }}</div>
            </div>
            <div class="score-card">
                <div class="sc-label">Submitted</div>
                <div style="margin-top:14px">
                    <div style="font-size:13px;color:var(--text-3);margin-bottom:4px">Date</div>
                    <div style="font-family:'Outfit',sans-serif;font-weight:700;font-size:14px">
                        {{ $pretest->created_at ? \Carbon\Carbon::parse($pretest->created_at)->format('M j, Y') : '—' }}
                    </div>
                    <div style="font-size:13px;color:var(--text-3);margin-top:10px;margin-bottom:4px">Time</div>
                    <div style="font-family:'Outfit',sans-serif;font-weight:700;font-size:14px">
                        {{ $pretest->created_at ? \Carbon\Carbon::parse($pretest->created_at)->format('g:i A') : '—' }}
                    </div>
                </div>
            </div>
        </div>
        @if($pretestAnswers->count())
            <div class="sec-header">
                <div class="sec-title"><span class="line"></span> Answer Breakdown</div>
                <span class="summary-badge">{{ $stats['pre_total'] }} Questions</span>
            </div>
            <div class="answer-table-wrap">
                <div class="table-scroll">
                <table>
                    <thead><tr><th>#</th><th>Student's Answer</th><th>Correct Answer</th><th>Result</th></tr></thead>
                    <tbody>
                        @foreach($pretestAnswers as $a)
                        <tr>
                            <td><span class="q-num">{{ $a->question_number }}</span></td>
                            <td>{{ $a->selected_answer ?? '—' }}</td>
                            <td style="color:var(--green);font-weight:600">{{ $a->correct_answer }}</td>
                            <td><span class="tag {{ $a->is_correct ? 'tag-correct' : 'tag-wrong' }}">{{ $a->is_correct ? '✓ Correct' : '✗ Wrong' }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        @endif
    @else
        <div class="empty-state"><div class="empty-icon">📝</div><p>Pre-test not submitted yet.</p></div>
    @endif
</div>

{{-- ════════════════════════════════════════
     NODE 1
════════════════════════════════════════ --}}
<div id="panel-node1" class="panel">
    @if($node1)
        <div class="stat-grid">
            <div class="stat-card teal"><div class="s-label">Score</div><div class="s-value">{{ $node1->score }}</div></div>
            <div class="stat-card green"><div class="s-label">Correct</div><div class="s-value">{{ $node1->correct_answers }}</div><div class="s-sub">of {{ $node1->total_items }} items</div></div>
            <div class="stat-card red"><div class="s-label">Wrong</div><div class="s-value">{{ $node1->wrong_answers }}</div></div>
            <div class="stat-card {{ ($node1->accuracy ?? 0) >= 75 ? 'green' : 'amber' }}"><div class="s-label">Accuracy</div><div class="s-value">{{ round($node1->accuracy ?? 0) }}%</div></div>
            <div class="stat-card purple"><div class="s-label">Time</div><div class="s-value">{{ $node1->time_spent ?? 0 }}<span style="font-size:14px">s</span></div></div>
            <div class="stat-card"><div class="s-label">Attempts</div><div class="s-value">{{ $node1->attempts }}</div></div>
        </div>
        <div class="sec-header"><div class="sec-title"><span class="line"></span> Summary</div></div>
        <div class="info-table-wrap">
            <table>
                <tr><td class="i-label">Status</td><td class="i-value"><span class="tag {{ $node1->is_completed ? 'tag-done' : 'tag-pending' }}">{{ $node1->is_completed ? 'Completed' : 'In Progress' }}</span></td></tr>
                <tr><td class="i-label">Perfect Score</td><td class="i-value"><span class="tag {{ $node1->is_perfect ? 'tag-correct' : 'tag-wrong' }}">{{ $node1->is_perfect ? '⭐ Yes' : 'No' }}</span></td></tr>
                <tr><td class="i-label">Max Attempts Reached</td><td class="i-value"><span class="tag {{ $node1->max_attempt_reached ? 'tag-wrong' : 'tag-correct' }}">{{ $node1->max_attempt_reached ? 'Yes' : 'No' }}</span></td></tr>
            </table>
        </div>
    @else
        <div class="empty-state"><div class="empty-icon">🗂️</div><p>No Node 1 data yet.</p></div>
    @endif
</div>

{{-- ════════════════════════════════════════
     NODE 2
════════════════════════════════════════ --}}
<div id="panel-node2" class="panel">
    @if($node2)
        <div class="stat-grid">
            <div class="stat-card teal"><div class="s-label">Score</div><div class="s-value">{{ $node2->score }}</div></div>
            <div class="stat-card purple"><div class="s-label">Chosen Side</div><div class="s-value" style="font-size:18px;text-transform:capitalize">{{ $node2->chosen_side ?? 'N/A' }}</div></div>
            <div class="stat-card {{ ($node2->lives_remaining ?? 0) > 1 ? 'green' : 'red' }}"><div class="s-label">Lives Left</div><div class="s-value">{{ $node2->lives_remaining }}</div></div>
            <div class="stat-card"><div class="s-label">Attempts</div><div class="s-value">{{ $node2->attempts }}</div></div>
        </div>
        <div class="info-table-wrap">
            <table>
                <tr><td class="i-label">Result</td><td class="i-value"><span class="tag {{ $node2->is_passed ? 'tag-pass' : 'tag-fail' }}">{{ $node2->is_passed ? '✓ Passed' : '✗ Failed' }}</span></td></tr>
            </table>
        </div>
    @else
        <div class="empty-state"><div class="empty-icon">⚔️</div><p>No Node 2 data yet.</p></div>
    @endif
</div>

{{-- ════════════════════════════════════════
     NODE 3
════════════════════════════════════════ --}}
<div id="panel-node3" class="panel">
    @if($node3)
        <div class="stat-grid">
            <div class="stat-card teal"><div class="s-label">Remaining Budget</div><div class="s-value" style="font-size:20px">₱{{ number_format($node3->remaining_budget ?? 0) }}</div></div>
            <div class="stat-card {{ ($node3->readiness_score ?? 0) >= 75 ? 'green' : 'amber' }}"><div class="s-label">Readiness Score</div><div class="s-value">{{ $node3->readiness_score }}</div></div>
            <div class="stat-card purple"><div class="s-label">Choices Selected</div><div class="s-value">{{ $node3->choices_selected }}</div></div>
            <div class="stat-card"><div class="s-label">Attempts</div><div class="s-value">{{ $node3->attempts }}</div></div>
        </div>
        <div class="info-table-wrap">
            <table>
                <tr><td class="i-label">Passed</td><td class="i-value"><span class="tag {{ $node3->is_passed ? 'tag-pass' : 'tag-fail' }}">{{ $node3->is_passed ? '✓ Passed' : '✗ Failed' }}</span></td></tr>
                <tr><td class="i-label">Status</td><td class="i-value"><span class="tag {{ $node3->is_completed ? 'tag-done' : 'tag-pending' }}">{{ $node3->is_completed ? 'Completed' : 'In Progress' }}</span></td></tr>
            </table>
        </div>
    @else
        <div class="empty-state"><div class="empty-icon">💰</div><p>No Node 3 data yet.</p></div>
    @endif
</div>

{{-- ════════════════════════════════════════
     BALIK-ARAL
════════════════════════════════════════ --}}
<div id="panel-balikaral" class="panel">
    @if($balikaral)
        <div class="stat-grid">
            <div class="stat-card red"><div class="s-label">Health</div><div class="s-value">{{ $balikaral->health }}</div></div>
            <div class="stat-card teal"><div class="s-label">Budget</div><div class="s-value" style="font-size:20px">₱{{ number_format($balikaral->budget ?? 0) }}</div></div>
            <div class="stat-card purple"><div class="s-label">Trust</div><div class="s-value">{{ $balikaral->trust }}</div></div>
            <div class="stat-card"><div class="s-label">Time</div><div class="s-value">{{ $balikaral->time_spent ?? 0 }}<span style="font-size:14px">s</span></div></div>
        </div>
        <div class="info-table-wrap">
            <table>
                <tr><td class="i-label">Outcome</td><td class="i-value"><span class="tag {{ $balikaral->is_success ? 'tag-pass' : 'tag-fail' }}">{{ $balikaral->is_success ? '✓ Successful' : '✗ Unsuccessful' }}</span></td></tr>
                <tr><td class="i-label">Completed</td><td class="i-value"><span class="tag {{ $balikaral->completed ? 'tag-done' : 'tag-pending' }}">{{ $balikaral->completed ? 'Yes' : 'No' }}</span></td></tr>
            </table>
        </div>
    @else
        <div class="empty-state"><div class="empty-icon">🔄</div><p>No Balik-Aral data yet.</p></div>
    @endif
</div>

{{-- ════════════════════════════════════════
     BULKAN
════════════════════════════════════════ --}}
<div id="panel-bulkan" class="panel">
    @if($bulkan)
        <div class="stat-grid">
            <div class="stat-card {{ ($bulkan->progress ?? 0) >= 7 ? 'green' : 'amber' }}"><div class="s-label">Progress</div><div class="s-value">{{ $bulkan->progress }}</div><div class="s-sub">out of 10</div></div>
            <div class="stat-card red"><div class="s-label">Mistakes</div><div class="s-value">{{ $bulkan->mistakes }}</div></div>
        </div>
        <div class="info-table-wrap">
            <table>
                <tr><td class="i-label">Outcome</td><td class="i-value"><span class="tag {{ $bulkan->is_success ? 'tag-pass' : 'tag-fail' }}">{{ $bulkan->is_success ? '✓ Successful' : '✗ Unsuccessful' }}</span></td></tr>
                <tr><td class="i-label">Completed</td><td class="i-value"><span class="tag {{ $bulkan->completed ? 'tag-done' : 'tag-pending' }}">{{ $bulkan->completed ? 'Yes' : 'No' }}</span></td></tr>
            </table>
        </div>
    @else
        <div class="empty-state"><div class="empty-icon">🌋</div><p>No Bulkan data yet.</p></div>
    @endif
</div>

{{-- ════════════════════════════════════════
     EL NIÑO
════════════════════════════════════════ --}}
<div id="panel-elnino" class="panel">
    @if($elnino)
        <div class="stat-grid">
            <div class="stat-card {{ ($elnino->completed_points ?? 0) >= 4 ? 'green' : 'amber' }}">
                <div class="s-label">Completed Points</div>
                <div class="s-value">{{ $elnino->completed_points }}</div>
                <div class="s-sub">out of 5</div>
            </div>
        </div>
        <div class="info-table-wrap">
            <table>
                <tr><td class="i-label">Outcome</td><td class="i-value"><span class="tag {{ $elnino->is_success ? 'tag-pass' : 'tag-fail' }}">{{ $elnino->is_success ? '✓ Successful' : '✗ Unsuccessful' }}</span></td></tr>
                <tr><td class="i-label">Completed</td><td class="i-value"><span class="tag {{ $elnino->completed ? 'tag-done' : 'tag-pending' }}">{{ $elnino->completed ? 'Yes' : 'No' }}</span></td></tr>
            </table>
        </div>
    @else
        <div class="empty-state"><div class="empty-icon">☀️</div><p>No El Niño data yet.</p></div>
    @endif
</div>

{{-- ════════════════════════════════════════
     EXPLORE
════════════════════════════════════════ --}}
<div id="panel-explore" class="panel">
    @if($explore)
        <div class="stat-grid">
            <div class="stat-card purple"><div class="s-label">XP Earned</div><div class="s-value">{{ $explore->xp ?? 0 }}</div></div>
            <div class="stat-card amber"><div class="s-label">Badge</div><div class="s-value" style="font-size:16px">{{ $explore->badge ?? 'None' }}</div></div>
        </div>
        <div class="info-table-wrap">
            <table>
                <tr><td class="i-label">Status</td><td class="i-value"><span class="tag {{ $explore->is_completed ? 'tag-done' : 'tag-pending' }}">{{ $explore->is_completed ? 'Completed' : 'In Progress' }}</span></td></tr>
            </table>
        </div>
    @else
        <div class="empty-state"><div class="empty-icon">🧭</div><p>No Explore data yet.</p></div>
    @endif
</div>

{{-- ════════════════════════════════════════
     FLOOD
════════════════════════════════════════ --}}
<div id="panel-flood" class="panel">
    @if($flood)
        <div class="stat-grid">
            <div class="stat-card teal"><div class="s-label">Score</div><div class="s-value">{{ $flood->score }}</div></div>
            <div class="stat-card {{ ($flood->hp_remaining ?? 0) >= 50 ? 'green' : 'red' }}"><div class="s-label">HP Remaining</div><div class="s-value">{{ $flood->hp_remaining }}</div><div class="s-sub">out of 100</div></div>
            <div class="stat-card"><div class="s-label">Questions</div><div class="s-value">{{ $flood->total_questions }}</div></div>
        </div>
        <div class="info-table-wrap">
            <table>
                <tr><td class="i-label">Status</td><td class="i-value"><span class="tag {{ $flood->is_completed ? 'tag-done' : 'tag-pending' }}">{{ $flood->is_completed ? 'Completed' : 'In Progress' }}</span></td></tr>
                <tr><td class="i-label">Game Over</td><td class="i-value"><span class="tag {{ $flood->is_game_over ? 'tag-wrong' : 'tag-correct' }}">{{ $flood->is_game_over ? '✗ Yes' : '✓ No' }}</span></td></tr>
            </table>
        </div>
    @else
        <div class="empty-state"><div class="empty-icon">🌊</div><p>No Flood data yet.</p></div>
    @endif
</div>

{{-- ════════════════════════════════════════
     GABAY
════════════════════════════════════════ --}}
<div id="panel-gabay" class="panel">
    @if($gabay)
        @php
            $lvl = $gabay->performance_level ?? '';
            $lvlTag = match($lvl) { 'excellent' => 'tag-correct', 'good' => 'tag-teal', 'needs_improvement' => 'tag-wrong', default => 'tag-pending' };
        @endphp
        <div class="stat-grid">
            <div class="stat-card teal"><div class="s-label">Score</div><div class="s-value">{{ $gabay->score }}</div><div class="s-sub">of {{ $gabay->total_items }} items</div></div>
            <div class="stat-card {{ ($gabay->accuracy ?? 0) >= 75 ? 'green' : 'amber' }}"><div class="s-label">Accuracy</div><div class="s-value">{{ round($gabay->accuracy ?? 0) }}%</div></div>
            <div class="stat-card"><div class="s-label">Attempts</div><div class="s-value">{{ $gabay->attempts }}</div></div>
        </div>
        <div class="info-table-wrap">
            <table>
                <tr><td class="i-label">Performance Level</td><td class="i-value"><span class="tag {{ $lvlTag }}">{{ ucwords(str_replace('_', ' ', $lvl ?: 'N/A')) }}</span></td></tr>
                <tr><td class="i-label">Status</td><td class="i-value"><span class="tag {{ $gabay->is_completed ? 'tag-done' : 'tag-pending' }}">{{ $gabay->is_completed ? 'Completed' : 'In Progress' }}</span></td></tr>
            </table>
        </div>
    @else
        <div class="empty-state"><div class="empty-icon">🗺️</div><p>No Gabay data yet.</p></div>
    @endif
</div>

{{-- ════════════════════════════════════════
     GO BAG
════════════════════════════════════════ --}}
<div id="panel-gobag" class="panel">
    @if($gobagact)
        @php
            $rating = $gobagact->rating ?? '';
            $ratingTag = match($rating) { 'excellent' => 'tag-correct', 'good' => 'tag-teal', 'needs_improvement' => 'tag-wrong', default => 'tag-pending' };
        @endphp
        <div class="stat-grid">
            <div class="stat-card teal"><div class="s-label">Score</div><div class="s-value">{{ $gobagact->score }}</div><div class="s-sub">of {{ $gobagact->total_items }} items</div></div>
            <div class="stat-card purple"><div class="s-label">Time Taken</div><div class="s-value">{{ $gobagact->time_taken ?? 0 }}<span style="font-size:14px">s</span></div></div>
            <div class="stat-card"><div class="s-label">Attempts</div><div class="s-value">{{ $gobagact->attempts }}</div></div>
        </div>
        <div class="info-table-wrap">
            <table>
                <tr><td class="i-label">Rating</td><td class="i-value"><span class="tag {{ $ratingTag }}">{{ ucwords(str_replace('_', ' ', $rating ?: 'N/A')) }}</span></td></tr>
                <tr><td class="i-label">Status</td><td class="i-value"><span class="tag {{ $gobagact->is_completed ? 'tag-done' : 'tag-pending' }}">{{ $gobagact->is_completed ? 'Completed' : 'In Progress' }}</span></td></tr>
            </table>
        </div>
    @else
        <div class="empty-state"><div class="empty-icon">🎒</div><p>No Go Bag data yet.</p></div>
    @endif
</div>

{{-- ════════════════════════════════════════
     LINDOL
════════════════════════════════════════ --}}
<div id="panel-lindol" class="panel">
    @if($lindol)
        <div class="stat-grid">
            <div class="stat-card teal"><div class="s-label">Score</div><div class="s-value">{{ $lindol->score }}</div></div>
            <div class="stat-card green"><div class="s-label">Correct Items</div><div class="s-value">{{ $lindol->correct_items }}</div><div class="s-sub">of {{ $lindol->total_items }}</div></div>
            <div class="stat-card purple"><div class="s-label">Time Spent</div><div class="s-value">{{ $lindol->time_spent ?? 0 }}<span style="font-size:14px">s</span></div></div>
        </div>
        <div class="info-table-wrap">
            <table>
                <tr><td class="i-label">Status</td><td class="i-value"><span class="tag {{ $lindol->completed ? 'tag-done' : 'tag-pending' }}">{{ $lindol->completed ? 'Completed' : 'In Progress' }}</span></td></tr>
            </table>
        </div>
    @else
        <div class="empty-state"><div class="empty-icon">🌍</div><p>No Lindol data yet.</p></div>
    @endif
</div>

{{-- ════════════════════════════════════════
     SAFE HOME
════════════════════════════════════════ --}}
<div id="panel-safehome" class="panel">
    @if($safehome)
        <div class="stat-grid">
            <div class="stat-card green"><div class="s-label">Correct</div><div class="s-value">{{ $safehome->correct_count }}</div></div>
            <div class="stat-card red"><div class="s-label">Wrong</div><div class="s-value">{{ $safehome->wrong_count }}</div></div>
            <div class="stat-card teal"><div class="s-label">Total Clicks</div><div class="s-value">{{ $safehome->total_clicks }}</div></div>
            <div class="stat-card"><div class="s-label">Attempts</div><div class="s-value">{{ $safehome->attempts }}</div></div>
        </div>
        <div class="info-table-wrap">
            <table>
                <tr><td class="i-label">Perfect Score</td><td class="i-value"><span class="tag {{ $safehome->is_perfect ? 'tag-correct' : 'tag-wrong' }}">{{ $safehome->is_perfect ? '⭐ Yes' : 'No' }}</span></td></tr>
                <tr><td class="i-label">Status</td><td class="i-value"><span class="tag {{ $safehome->is_completed ? 'tag-done' : 'tag-pending' }}">{{ $safehome->is_completed ? 'Completed' : 'In Progress' }}</span></td></tr>
            </table>
        </div>
    @else
        <div class="empty-state"><div class="empty-icon">🏠</div><p>No Safe Home data yet.</p></div>
    @endif
</div>

{{-- ════════════════════════════════════════
     POSTTEST
════════════════════════════════════════ --}}
<div id="panel-posttest" class="panel">
    @if($posttest)
        @php
            $ppct  = $stats['post_pct'] ?? 0;
            $pcol  = $ppct >= 75 ? '#10b981' : ($ppct >= 50 ? '#f59e0b' : '#ef4444');
            $ptLvl = $posttest->performance_level ?? '';
            $ptTag = match($ptLvl) { 'excellent' => 'tag-correct', 'good' => 'tag-teal', 'needs_improvement' => 'tag-wrong', default => 'tag-pending' };
        @endphp
        <div class="score-grid" style="margin-bottom:20px">
            <div class="score-card">
                <div class="sc-label">Score</div>
                <div class="score-ring-wrap">
                    <div class="score-ring">
                        <svg viewBox="0 0 80 80" width="80" height="80">
                            <circle class="ring-bg" cx="40" cy="40" r="33"/>
                            <circle class="ring-fill" cx="40" cy="40" r="33" stroke="var(--green)"
                                stroke-dasharray="{{ 2*pi()*33 }}"
                                stroke-dashoffset="{{ 2*pi()*33*(1 - $ppct/100) }}"/>
                        </svg>
                        <div class="ring-text"><strong style="color:var(--green)">{{ $posttest->score }}</strong><span>pts</span></div>
                    </div>
                </div>
                <div class="sc-correct">of {{ $posttest->total_items }} items</div>
            </div>
            <div class="score-card">
                <div class="sc-label">Percentage</div>
                <div class="score-ring-wrap">
                    <div class="score-ring">
                        <svg viewBox="0 0 80 80" width="80" height="80">
                            <circle class="ring-bg" cx="40" cy="40" r="33"/>
                            <circle class="ring-fill" cx="40" cy="40" r="33" stroke="{{ $pcol }}"
                                stroke-dasharray="{{ 2*pi()*33 }}"
                                stroke-dashoffset="{{ 2*pi()*33*(1 - $ppct/100) }}"/>
                        </svg>
                        <div class="ring-text"><strong style="color:{{ $pcol }}">{{ $ppct }}%</strong></div>
                    </div>
                </div>
                <div class="sc-correct">{{ $ppct >= 75 ? 'Passed ✓' : ($ppct >= 50 ? 'Average' : 'Needs Improvement') }}</div>
            </div>
            <div class="score-card">
                <div class="sc-label">Improvement</div>
                @if($pretest && $stats['improvement'] !== null)
                    @php $imp = $stats['improvement']; @endphp
                    <div style="margin-top:14px;text-align:center">
                        <div style="font-size:36px;font-family:'Outfit',sans-serif;font-weight:800;color:{{ $imp > 0 ? 'var(--green)' : ($imp < 0 ? 'var(--red)' : 'var(--text-3)') }}">
                            {{ $imp > 0 ? '+' : '' }}{{ $imp }}%
                        </div>
                        <div style="font-size:12px;color:var(--text-3);margin-top:6px">vs Pre-test ({{ round($pretest->percentage) }}%)</div>
                        <div style="margin-top:10px">
                            <span class="tag {{ $imp > 0 ? 'tag-correct' : ($imp < 0 ? 'tag-wrong' : 'tag-neutral') }}">
                                {{ $imp > 0 ? '▲ Improved' : ($imp < 0 ? '▼ Declined' : '→ No change') }}
                            </span>
                        </div>
                    </div>
                @else
                    <div style="margin-top:20px;color:var(--text-3);font-size:13px">No pre-test to compare</div>
                @endif
            </div>
        </div>

        <div class="info-table-wrap" style="margin-bottom:20px">
            <table>
                <tr><td class="i-label">Performance Level</td><td class="i-value"><span class="tag {{ $ptTag }}">{{ ucwords(str_replace('_', ' ', $ptLvl ?: 'N/A')) }}</span></td></tr>
                <tr><td class="i-label">Result</td><td class="i-value"><span class="tag {{ $posttest->is_passed ? 'tag-pass' : 'tag-fail' }}">{{ $posttest->is_passed ? '✓ Passed' : '✗ Failed' }}</span></td></tr>
            </table>
        </div>

        @if(count($posttestAnswers))
            <div class="sec-header">
                <div class="sec-title"><span class="line"></span> Answer Breakdown</div>
                <span class="summary-badge">{{ count($posttestAnswers) }} Questions</span>
            </div>
            <div class="answer-table-wrap">
                <div class="table-scroll">
                <table>
                    <thead><tr><th>#</th><th>Student's Answer</th><th>Correct Answer</th><th>Result</th></tr></thead>
                    <tbody>
                        @foreach($posttestAnswers as $i => $ans)
                        @php $ans = (object)$ans; @endphp
                        <tr>
                            <td><span class="q-num">{{ $ans->question_number ?? ($i+1) }}</span></td>
                            <td>{{ $ans->selected_answer ?? '—' }}</td>
                            <td style="color:var(--green);font-weight:600">{{ $ans->correct_answer ?? '—' }}</td>
                            <td><span class="tag {{ ($ans->is_correct ?? false) ? 'tag-correct' : 'tag-wrong' }}">{{ ($ans->is_correct ?? false) ? '✓ Correct' : '✗ Wrong' }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        @endif
    @else
        <div class="empty-state"><div class="empty-icon">📋</div><p>Post-test not submitted yet.</p></div>
    @endif
</div>

{{-- ════════════════════════════════════════
     PERFORMANCE TASK
════════════════════════════════════════ --}}
<div id="panel-performance" class="panel">
    @if($performance)
        <div class="sec-header" style="margin-bottom:16px">
            <div class="sec-title"><span class="line"></span> Score Breakdown</div>
            <span class="summary-badge">Total: {{ $stats['perf_total'] }}</span>
        </div>
        <div class="score-band">
            <div class="seg">
                <div class="seg-label">🎒 Kit</div>
                <div class="seg-val">{{ $performance->kit_score ?? 0 }}</div>
            </div>
            <div class="seg">
                <div class="seg-label">🚨 Evacuation</div>
                <div class="seg-val">{{ $performance->evacuation_score ?? 0 }}</div>
            </div>
            <div class="seg">
                <div class="seg-label">📡 Communication</div>
                <div class="seg-val">{{ $performance->communication_score ?? 0 }}</div>
            </div>
            <div class="seg">
                <div class="seg-label">🏠 Safe</div>
                <div class="seg-val">{{ $performance->safe_score ?? 0 }}</div>
            </div>
            <div class="seg">
                <div class="seg-label">Total Score</div>
                <div class="seg-val">{{ $stats['perf_total'] }}</div>
            </div>
        </div>
        <div class="info-table-wrap">
            <table>
                <tr><td class="i-label">Status</td><td class="i-value"><span class="tag {{ $performance->is_completed ? 'tag-done' : 'tag-pending' }}">{{ $performance->is_completed ? 'Completed' : 'In Progress' }}</span></td></tr>
                @if($performance->selected_items)
                <tr><td class="i-label">Items Selected</td><td class="i-value" style="font-size:13px;color:var(--text-3)">{{ is_string($performance->selected_items) ? $performance->selected_items : json_encode($performance->selected_items) }}</td></tr>
                @endif
            </table>
        </div>
    @else
        <div class="empty-state"><div class="empty-icon">🎯</div><p>Performance Task not submitted yet.</p></div>
    @endif
</div>

</div>{{-- /page-wrap --}}
@endsection

@push('scripts')
<script>
function switchTab(id, btn) {
    document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(t => t.classList.remove('active'));
    const panel = document.getElementById('panel-' + id);
    if (panel) panel.classList.add('active');
    if (btn) {
        btn.classList.add('active');
        if (typeof btn.scrollIntoView === 'function') {
            btn.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    // Animate SVG rings on load
    document.querySelectorAll('.ring-fill').forEach(el => {
        const target = el.getAttribute('stroke-dashoffset');
        const circ   = parseFloat(el.getAttribute('stroke-dasharray'));
        el.style.strokeDashoffset = circ;
        setTimeout(() => {
            el.style.transition = 'stroke-dashoffset 1s cubic-bezier(.25,.8,.25,1)';
            el.style.strokeDashoffset = target;
        }, 120);
    });
});
</script>
@endpush
