@extends('Teachers.teacherslayout')

@section('title', $student->username . ' — Module 2 Results')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">

<style>
/* ─── TOKENS ────────────────────────────────────────────── */
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

    --text-1:  #0f172a;
    --text-2:  #334155;
    --text-3:  #64748b;
    --text-4:  #94a3b8;

    --radius:  14px;
    --shadow-sm: 0 1px 3px rgba(15,23,42,.06), 0 1px 2px rgba(15,23,42,.04);
    --shadow:    0 4px 16px rgba(67,97,238,.08), 0 1px 4px rgba(15,23,42,.06);
    --shadow-lg: 0 12px 40px rgba(67,97,238,.12), 0 4px 12px rgba(15,23,42,.08);
}

/* ─── BASE ───────────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    font-family: 'DM Sans', sans-serif;
    background: var(--bg);
    color: var(--text-1);
    min-height: 100vh;
}

h1,h2,h3,h4,h5 { font-family: 'Outfit', sans-serif; }

.page-wrap {
    max-width: 1100px;
    margin: 0 auto;
    padding: 28px 20px 60px;
}

/* ─── BACK ───────────────────────────────────────────────── */
.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 8px 16px;
    border-radius: 999px;
    background: var(--surface);
    border: 1px solid var(--border);
    color: var(--text-3);
    font-family: 'Outfit', sans-serif;
    font-weight: 600;
    font-size: 13px;
    text-decoration: none;
    margin-bottom: 22px;
    transition: all .2s;
    box-shadow: var(--shadow-sm);
}
.back-btn svg { transition: transform .2s; }
.back-btn:hover { color: var(--text-1); border-color: var(--blue); transform: translateX(-2px); box-shadow: var(--shadow); }
.back-btn:hover svg { transform: translateX(-3px); }

/* ─── HERO CARD ──────────────────────────────────────────── */
.hero {
    display: grid;
    grid-template-columns: 1fr auto;
    align-items: center;
    gap: 20px;
    background: var(--surface);
    border-radius: 20px;
    padding: 24px 28px;
    box-shadow: var(--shadow);
    margin-bottom: 22px;
    border: 1px solid var(--border);
    position: relative;
    overflow: hidden;
}
.hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 6px; height: 100%;
    background: linear-gradient(180deg, var(--blue), var(--purple));
    border-radius: 20px 0 0 20px;
}

.hero-left { display: flex; align-items: center; gap: 18px; padding-left: 10px; }

.avatar-ring {
    width: 64px; height: 64px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--blue), var(--purple));
    display: flex; align-items: center; justify-content: center;
    color: white;
    font-family: 'Outfit', sans-serif;
    font-weight: 800;
    font-size: 22px;
    box-shadow: 0 6px 20px rgba(67,97,238,.35);
    flex-shrink: 0;
}

.hero-meta h1 {
    font-size: 22px;
    font-weight: 800;
    letter-spacing: -.4px;
    color: var(--text-1);
}
.hero-meta p {
    font-size: 13px;
    color: var(--text-3);
    margin-top: 3px;
}

.hero-pills {
    display: flex;
    gap: 8px;
    margin-top: 8px;
    flex-wrap: wrap;
}

.pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    font-family: 'Outfit', sans-serif;
}
.pill-blue   { background: var(--blue-light); color: var(--blue-dark); }
.pill-green  { background: var(--green-light); color: #059669; }
.pill-amber  { background: var(--amber-light); color: #b45309; }
.pill-purple { background: var(--purple-light); color: #6d28d9; }
.pill-red    { background: var(--red-light); color: #dc2626; }

.export-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 20px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--blue), #6366f1);
    color: white;
    font-family: 'Outfit', sans-serif;
    font-weight: 700;
    font-size: 13px;
    text-decoration: none;
    box-shadow: 0 6px 20px rgba(67,97,238,.3);
    transition: all .2s;
    white-space: nowrap;
    flex-shrink: 0;
}
.export-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(67,97,238,.4); }
.export-btn:active { transform: scale(.97); }

/* ─── SNAPSHOT ROW ───────────────────────────────────────── */
.snapshot {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-bottom: 22px;
}

.snap-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 18px 20px;
    box-shadow: var(--shadow-sm);
    position: relative;
    overflow: hidden;
    transition: transform .2s, box-shadow .2s;
}
.snap-card:hover { transform: translateY(-2px); box-shadow: var(--shadow); }

.snap-card .icon {
    width: 38px; height: 38px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
    margin-bottom: 12px;
}
.snap-card .label {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .8px;
    color: var(--text-3);
    font-family: 'Outfit', sans-serif;
}
.snap-card .value {
    font-size: 28px;
    font-weight: 800;
    font-family: 'Outfit', sans-serif;
    letter-spacing: -1px;
    margin-top: 2px;
    line-height: 1;
}
.snap-card .sub {
    font-size: 12px;
    color: var(--text-3);
    margin-top: 4px;
}

.snap-blue   .icon { background: var(--blue-light); }
.snap-green  .icon { background: var(--green-light); }
.snap-amber  .icon { background: var(--amber-light); }
.snap-purple .icon { background: var(--purple-light); }
.snap-blue   .value { color: var(--blue); }
.snap-green  .value { color: var(--green); }
.snap-amber  .value { color: var(--amber); }
.snap-purple .value { color: var(--purple); }

/* improvement arrow */
.improvement {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    font-size: 13px;
    font-weight: 700;
    font-family: 'Outfit', sans-serif;
    padding: 2px 8px;
    border-radius: 999px;
    margin-top: 6px;
}
.improvement.up   { background: var(--green-light); color: #059669; }
.improvement.down { background: var(--red-light); color: #dc2626; }
.improvement.flat { background: #f1f5f9; color: var(--text-3); }

/* ─── TAB NAV ────────────────────────────────────────────── */
.tab-nav-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 6px;
    display: flex;
    gap: 4px;
    margin-bottom: 20px;
    box-shadow: var(--shadow-sm);
    overflow-x: auto;
}

.tab-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 16px;
    border-radius: 10px;
    font-family: 'Outfit', sans-serif;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-3);
    cursor: pointer;
    border: none;
    background: transparent;
    white-space: nowrap;
    transition: all .2s;
    position: relative;
}
.tab-btn .badge-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: var(--green);
    flex-shrink: 0;
}
.tab-btn .badge-dot.empty { background: var(--text-4); }
.tab-btn:hover { color: var(--text-1); background: var(--surface-2); }
.tab-btn.active {
    background: linear-gradient(135deg, var(--blue), #6366f1);
    color: white;
    box-shadow: 0 4px 14px rgba(67,97,238,.28);
}
.tab-btn.active .badge-dot { background: rgba(255,255,255,.7); }

/* ─── PANEL ──────────────────────────────────────────────── */
.panel { display: none; animation: panelIn .22s ease; }
.panel.active { display: block; }

@keyframes panelIn {
    from { opacity: 0; transform: translateY(6px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ─── SCORE COMPARE ──────────────────────────────────────── */
.score-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    margin-bottom: 20px;
}

.score-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px;
    text-align: center;
    box-shadow: var(--shadow-sm);
}
.score-card .sc-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .8px;
    color: var(--text-3);
    font-family: 'Outfit', sans-serif;
    margin-bottom: 10px;
}
.score-ring-wrap { display: flex; justify-content: center; margin-bottom: 8px; }

.score-ring {
    position: relative;
    width: 80px; height: 80px;
}
.score-ring svg { transform: rotate(-90deg); }
.score-ring .ring-bg { stroke: var(--border); stroke-width: 7; fill: none; }
.score-ring .ring-fill { stroke-width: 7; fill: none; stroke-linecap: round; transition: stroke-dashoffset 1s ease; }
.score-ring .ring-text {
    position: absolute;
    inset: 0;
    display: flex; align-items: center; justify-content: center;
    flex-direction: column;
    font-family: 'Outfit', sans-serif;
}
.score-ring .ring-text strong { font-size: 18px; font-weight: 800; }
.score-ring .ring-text span   { font-size: 10px; color: var(--text-3); }

.score-card .sc-correct { font-size: 13px; color: var(--text-3); margin-top: 2px; }

/* ─── ANSWER TABLE ───────────────────────────────────────── */
.answer-table-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.answer-table-wrap table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
}
.answer-table-wrap thead {
    background: var(--surface-2);
}
.answer-table-wrap th {
    font-family: 'Outfit', sans-serif;
    font-weight: 700;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: .7px;
    color: var(--text-3);
    padding: 12px 16px;
    text-align: left;
}
.answer-table-wrap td {
    padding: 11px 16px;
    color: var(--text-2);
    font-weight: 500;
    vertical-align: middle;
}
.answer-table-wrap tbody tr {
    border-top: 1px solid var(--border);
    transition: background .15s;
}
.answer-table-wrap tbody tr:hover { background: var(--surface-2); }

.q-num {
    display: inline-flex;
    align-items: center; justify-content: center;
    width: 26px; height: 26px;
    border-radius: 8px;
    background: var(--blue-light);
    color: var(--blue-dark);
    font-family: 'Outfit', sans-serif;
    font-weight: 700;
    font-size: 12px;
}

.tag {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    font-family: 'Outfit', sans-serif;
}
.tag-correct { background: var(--green-light); color: #059669; }
.tag-wrong   { background: var(--red-light); color: #dc2626; }

/* ─── SECTION HEADER ─────────────────────────────────────── */
.sec-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 14px;
}
.sec-title {
    font-family: 'Outfit', sans-serif;
    font-size: 15px;
    font-weight: 700;
    color: var(--text-1);
    display: flex;
    align-items: center;
    gap: 8px;
}
.sec-title .line {
    width: 4px; height: 18px;
    border-radius: 99px;
    background: linear-gradient(180deg, var(--blue), var(--purple));
}

.summary-badge {
    font-size: 12px;
    font-weight: 600;
    font-family: 'Outfit', sans-serif;
    color: var(--text-3);
    background: var(--surface-2);
    border: 1px solid var(--border);
    padding: 4px 10px;
    border-radius: 999px;
}

/* ─── NODE CARDS ─────────────────────────────────────────── */
.node-list { display: flex; flex-direction: column; gap: 14px; }

.node-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: box-shadow .2s;
}
.node-card:hover { box-shadow: var(--shadow); }

.node-card-head {
    background: var(--surface-2);
    border-bottom: 1px solid var(--border);
    padding: 12px 18px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.node-card-head .num {
    width: 28px; height: 28px;
    border-radius: 8px;
    background: linear-gradient(135deg, var(--blue), #6366f1);
    color: white;
    font-family: 'Outfit', sans-serif;
    font-weight: 800;
    font-size: 13px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.node-card-head .title {
    font-family: 'Outfit', sans-serif;
    font-weight: 700;
    font-size: 14px;
    color: var(--text-1);
}

.node-card-body {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    divide-x: 1px solid var(--border);
}

.node-field {
    padding: 14px 18px;
    border-right: 1px solid var(--border);
}
.node-field:last-child { border-right: none; }
.node-field .nf-label {
    font-family: 'Outfit', sans-serif;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .8px;
    margin-bottom: 5px;
}
.node-field .nf-value {
    font-size: 13.5px;
    color: var(--text-2);
    font-weight: 500;
    line-height: 1.4;
    word-break: break-word;
}

.sanhi-col  .nf-label { color: #dc2626; }
.bunga-col  .nf-label { color: #d97706; }
.solusyon-col .nf-label { color: #059669; }

.empty-state {
    text-align: center;
    padding: 40px 20px;
    background: var(--surface);
    border: 1px dashed var(--border);
    border-radius: var(--radius);
    color: var(--text-3);
}
.empty-state .empty-icon { font-size: 32px; margin-bottom: 8px; }
.empty-state p { font-family: 'Outfit', sans-serif; font-weight: 600; font-size: 14px; }

/* ─── FINAL ACTIVITY ─────────────────────────────────────── */
.final-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-bottom: 20px;
}
.final-kpi {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 18px;
    text-align: center;
    box-shadow: var(--shadow-sm);
}
.final-kpi .fk-icon { font-size: 22px; margin-bottom: 6px; }
.final-kpi .fk-val {
    font-family: 'Outfit', sans-serif;
    font-size: 26px;
    font-weight: 800;
    letter-spacing: -1px;
}
.final-kpi .fk-label {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .7px;
    color: var(--text-3);
    font-family: 'Outfit', sans-serif;
    margin-top: 2px;
}

/* ─── ESSAY ──────────────────────────────────────────────── */
.essay-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}
.essay-head {
    padding: 14px 20px;
    background: linear-gradient(135deg, #f5f3ff, #ede9fe);
    border-bottom: 1px solid #ddd6fe;
    display: flex;
    align-items: center;
    gap: 8px;
}
.essay-head span {
    font-family: 'Outfit', sans-serif;
    font-weight: 700;
    font-size: 14px;
    color: #5b21b6;
}
.essay-body {
    padding: 22px;
    font-size: 14.5px;
    line-height: 1.75;
    color: var(--text-2);
    min-height: 120px;
    font-style: italic;
}
.essay-meta {
    padding: 10px 20px;
    background: var(--surface-2);
    border-top: 1px solid var(--border);
    font-size: 12px;
    color: var(--text-3);
    font-weight: 500;
    display: flex;
    justify-content: space-between;
}

/* ─── PROGRESS BAR ───────────────────────────────────────── */
.prog-bar-wrap { margin-top: 12px; }
.prog-label {
    display: flex; justify-content: space-between;
    font-size: 12px; color: var(--text-3); font-weight: 600;
    margin-bottom: 5px;
    font-family: 'Outfit', sans-serif;
}
.prog-track {
    height: 7px;
    background: var(--border);
    border-radius: 999px;
    overflow: hidden;
}
.prog-fill {
    height: 100%;
    border-radius: 999px;
    background: linear-gradient(90deg, var(--blue), var(--purple));
    transition: width 1.2s cubic-bezier(.25,.8,.25,1);
}

/* ─── RESPONSIVE ─────────────────────────────────────────── */
@media (max-width: 768px) {
    .hero { grid-template-columns: 1fr; }
    .snapshot { grid-template-columns: repeat(2, 1fr); }
    .score-grid { grid-template-columns: 1fr; }
    .final-grid { grid-template-columns: repeat(2, 1fr); }
    .node-card-body { grid-template-columns: 1fr; }
    .node-field { border-right: none; border-bottom: 1px solid var(--border); }
    .node-field:last-child { border-bottom: none; }
}
@media (max-width: 520px) {
    .snapshot { grid-template-columns: 1fr; }
    .final-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')
<div class="page-wrap">

{{-- BACK --}}
<a href="{{ route('teacher.module2.results') }}" class="back-btn">
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
            <p>Module 2 — Detailed Performance Report</p>
            <div class="hero-pills">
                @if($pretest)
                    <span class="pill pill-blue">
                        📝 Pre: {{ $pretest->score }}/{{ $stats['pre_total'] }}
                    </span>
                @endif
                @if($posttest)
                    @php $imp = $stats['improvement']; @endphp
                    <span class="pill {{ $imp > 0 ? 'pill-green' : ($imp < 0 ? 'pill-red' : 'pill-blue') }}">
                        {{ $imp > 0 ? '↑' : ($imp < 0 ? '↓' : '→') }} {{ abs($imp) }}% vs Pre
                    </span>
                @endif
                @if($essay)
                    <span class="pill pill-purple">✍️ Essay Submitted</span>
                @endif
                <span class="pill {{ $stats['nodes_done'] >= 3 ? 'pill-green' : 'pill-amber' }}">
                    📊 {{ $stats['nodes_done'] }}/3 Nodes
                </span>
            </div>
        </div>
    </div>

    <a href="{{ route('teacher.module2.export.full', $student->id) }}" class="export-btn">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
        </svg>
        Export CSV
    </a>
</div>

{{-- SNAPSHOT ROW --}}
<div class="snapshot">
    {{-- Pre-test --}}
    <div class="snap-card snap-blue">
        <div class="icon">📝</div>
        <div class="label">Pre-test</div>
        <div class="value">{{ $pretest ? $pretest->percentage : '—' }}{{ $pretest ? '%' : '' }}</div>
        <div class="sub">{{ $pretest ? $stats['pre_correct'].'/'.$stats['pre_total'].' correct' : 'Not submitted' }}</div>
    </div>

    {{-- Post-test --}}
    <div class="snap-card snap-green">
        <div class="icon">📋</div>
        <div class="label">Post-test</div>
        <div class="value">{{ $posttest ? $posttest->percentage : '—' }}{{ $posttest ? '%' : '' }}</div>
        <div class="sub">{{ $posttest ? $stats['post_correct'].'/'.$stats['post_total'].' correct' : 'Not submitted' }}</div>
        @if($pretest && $posttest)
            @php $imp = $stats['improvement']; @endphp
            <div class="improvement {{ $imp > 0 ? 'up' : ($imp < 0 ? 'down' : 'flat') }}">
                {{ $imp > 0 ? '▲' : ($imp < 0 ? '▼' : '—') }} {{ abs($imp) }}%
            </div>
        @endif
    </div>

    {{-- Final Activity --}}
    <div class="snap-card snap-amber">
        <div class="icon">🎯</div>
        <div class="label">Final Activity</div>
        <div class="value">{{ $final ? $final->score : '—' }}</div>
        <div class="sub">{{ $final ? $final->total_xp.' XP earned' : 'Not submitted' }}</div>
    </div>

    {{-- Nodes Progress --}}
    <div class="snap-card snap-purple">
        <div class="icon">🗂️</div>
        <div class="label">Node Progress</div>
        <div class="value">{{ $stats['nodes_done'] }}<span style="font-size:16px;font-weight:500;color:var(--text-3)">/3</span></div>
        <div class="prog-bar-wrap">
            <div class="prog-track">
                <div class="prog-fill" style="width:{{ ($stats['nodes_done']/3)*100 }}%"></div>
            </div>
        </div>
    </div>
</div>

{{-- TAB NAV --}}
<div class="tab-nav-wrap">
    @php
        $tabs = [
            ['id' => 'pretest',  'label' => 'Pre-test',    'icon' => '📝', 'has' => !!$pretest],
            ['id' => 'node1',    'label' => 'Node 1',       'icon' => '🗂️', 'has' => $node1->count() > 0],
            ['id' => 'node2',    'label' => 'Node 2',       'icon' => '🗂️', 'has' => $node2->count() > 0],
            ['id' => 'node3',    'label' => 'Node 3',       'icon' => '🗂️', 'has' => $node3->count() > 0],
            ['id' => 'final',    'label' => 'Final',        'icon' => '🎯', 'has' => !!$final],
            ['id' => 'posttest', 'label' => 'Post-test',   'icon' => '📋', 'has' => !!$posttest],
            ['id' => 'essay',    'label' => 'Essay',        'icon' => '✍️', 'has' => !!$essay],
        ];
    @endphp

    @foreach($tabs as $i => $tab)
        <button class="tab-btn {{ $i === 0 ? 'active' : '' }}" onclick="switchTab('{{ $tab['id'] }}', this)">
            {{ $tab['icon'] }} {{ $tab['label'] }}
            <span class="badge-dot {{ $tab['has'] ? '' : 'empty' }}"></span>
        </button>
    @endforeach
</div>

{{-- ═══════════════════════════════════════════
     PANEL: PRETEST
════════════════════════════════════════════ --}}
<div id="panel-pretest" class="panel active">
    @if($pretest)
        <div class="score-grid" style="margin-bottom:20px;">
            <div class="score-card">
                <div class="sc-label">Score</div>
                <div class="score-ring-wrap">
                    @php $pct = $pretest->percentage ?? 0; @endphp
                    <div class="score-ring" data-pct="{{ $pct }}" data-color="#4361ee">
                        <svg viewBox="0 0 80 80" width="80" height="80">
                            <circle class="ring-bg" cx="40" cy="40" r="33"/>
                            <circle class="ring-fill" cx="40" cy="40" r="33"
                                stroke="#4361ee"
                                stroke-dasharray="{{ 2 * 3.14159 * 33 }}"
                                stroke-dashoffset="{{ 2 * 3.14159 * 33 * (1 - $pct/100) }}"
                            />
                        </svg>
                        <div class="ring-text">
                            <strong style="color:#4361ee">{{ $pretest->score }}</strong>
                            <span>pts</span>
                        </div>
                    </div>
                </div>
                <div class="sc-correct">{{ $stats['pre_correct'] }}/{{ $stats['pre_total'] }} correct</div>
            </div>

            <div class="score-card">
                <div class="sc-label">Percentage</div>
                <div class="score-ring-wrap">
                    <div class="score-ring">
                        <svg viewBox="0 0 80 80" width="80" height="80">
                            <circle class="ring-bg" cx="40" cy="40" r="33"/>
                            <circle class="ring-fill" cx="40" cy="40" r="33"
                                stroke="{{ $pct >= 75 ? '#10b981' : ($pct >= 50 ? '#f59e0b' : '#ef4444') }}"
                                stroke-dasharray="{{ 2 * 3.14159 * 33 }}"
                                stroke-dashoffset="{{ 2 * 3.14159 * 33 * (1 - $pct/100) }}"
                            />
                        </svg>
                        <div class="ring-text">
                            <strong style="color:{{ $pct >= 75 ? '#10b981' : ($pct >= 50 ? '#f59e0b' : '#ef4444') }}">{{ $pct }}%</strong>
                        </div>
                    </div>
                </div>
                <div class="sc-correct">{{ $pct >= 75 ? 'Passed ✓' : ($pct >= 50 ? 'Average' : 'Needs Improvement') }}</div>
            </div>

            <div class="score-card">
                <div class="sc-label">Submitted</div>
                <div style="margin-top:14px;">
                    <div style="font-size:13px;color:var(--text-3);margin-bottom:4px;">Date</div>
                    <div style="font-family:'Outfit',sans-serif;font-weight:700;font-size:14px;color:var(--text-1)">
                        {{ $pretest->created_at ? \Carbon\Carbon::parse($pretest->created_at)->format('M j, Y') : '—' }}
                    </div>
                    <div style="font-size:13px;color:var(--text-3);margin-top:10px;margin-bottom:4px;">Time</div>
                    <div style="font-family:'Outfit',sans-serif;font-weight:700;font-size:14px;color:var(--text-1)">
                        {{ $pretest->created_at ? \Carbon\Carbon::parse($pretest->created_at)->format('g:i A') : '—' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="sec-header">
            <div class="sec-title"><span class="line"></span> Answer Breakdown</div>
            <span class="summary-badge">{{ $stats['pre_total'] }} Questions</span>
        </div>
        <div class="answer-table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student's Answer</th>
                        <th>Correct Answer</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pretestAnswers as $a)
                    <tr>
                        <td><span class="q-num">{{ $a->question_number }}</span></td>
                        <td>{{ $a->selected_answer }}</td>
                        <td style="color:var(--green);font-weight:600">{{ $a->correct_answer }}</td>
                        <td>
                            <span class="tag {{ $a->is_correct ? 'tag-correct' : 'tag-wrong' }}">
                                {{ $a->is_correct ? '✓ Correct' : '✗ Wrong' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center;color:var(--text-3);padding:24px;">No answers recorded.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">📝</div>
            <p>Pre-test not submitted yet.</p>
        </div>
    @endif
</div>

{{-- ═══════════════════════════════════════════
     PANEL: NODE 1
════════════════════════════════════════════ --}}
<div id="panel-node1" class="panel">
    <div class="sec-header">
        <div class="sec-title"><span class="line"></span> Node 1 — Sanhi, Bunga, Solusyon</div>
        <span class="summary-badge">{{ $node1->count() }} entries</span>
    </div>
    @if($node1->count())
        <div class="node-list">
            @foreach($node1 as $n)
            <div class="node-card">
                <div class="node-card-head">
                    <div class="num">{{ $n->problem_number }}</div>
                    <div class="title">Problem {{ $n->problem_number }}</div>
                </div>
                <div class="node-card-body">
                    <div class="node-field sanhi-col">
                        <div class="nf-label">Sanhi</div>
                        <div class="nf-value">{{ $n->sanhi_image ?: '—' }}</div>
                    </div>
                    <div class="node-field bunga-col">
                        <div class="nf-label">Bunga</div>
                        <div class="nf-value">{{ $n->bunga_image ?: '—' }}</div>
                    </div>
                    <div class="node-field solusyon-col">
                        <div class="nf-label">Solusyon</div>
                        <div class="nf-value">{{ $n->solusyon_image ?: '—' }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="empty-state"><div class="empty-icon">🗂️</div><p>No Node 1 submissions yet.</p></div>
    @endif
</div>

{{-- ═══════════════════════════════════════════
     PANEL: NODE 2
════════════════════════════════════════════ --}}
<div id="panel-node2" class="panel">
    <div class="sec-header">
        <div class="sec-title"><span class="line"></span> Node 2 — Sanhi, Bunga, Solusyon</div>
        <span class="summary-badge">{{ $node2->count() }} entries</span>
    </div>
    @if($node2->count())
        <div class="node-list">
            @foreach($node2 as $n)
            <div class="node-card">
                <div class="node-card-head">
                    <div class="num">{{ $n->problem_number }}</div>
                    <div class="title">Problem {{ $n->problem_number }}</div>
                </div>
                <div class="node-card-body">
                    <div class="node-field sanhi-col">
                        <div class="nf-label">Sanhi</div>
                        <div class="nf-value">{{ $n->sanhi ?: '—' }}</div>
                    </div>
                    <div class="node-field bunga-col">
                        <div class="nf-label">Bunga</div>
                        <div class="nf-value">{{ $n->bunga ?: '—' }}</div>
                    </div>
                    <div class="node-field solusyon-col">
                        <div class="nf-label">Solusyon</div>
                        <div class="nf-value">{{ $n->solusyon ?: '—' }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="empty-state"><div class="empty-icon">🗂️</div><p>No Node 2 submissions yet.</p></div>
    @endif
</div>

{{-- ═══════════════════════════════════════════
     PANEL: NODE 3
════════════════════════════════════════════ --}}
<div id="panel-node3" class="panel">
    <div class="sec-header">
        <div class="sec-title"><span class="line"></span> Node 3 — Sanhi, Bunga, Solusyon</div>
        <span class="summary-badge">{{ $node3->count() }} entries</span>
    </div>
    @if($node3->count())
        <div class="node-list">
            @foreach($node3 as $n)
            <div class="node-card">
                <div class="node-card-head">
                    <div class="num">{{ $n->problem_number }}</div>
                    <div class="title">Problem {{ $n->problem_number }}</div>
                </div>
                <div class="node-card-body">
                    <div class="node-field sanhi-col">
                        <div class="nf-label">Sanhi</div>
                        <div class="nf-value">{{ $n->sanhi ?: '—' }}</div>
                    </div>
                    <div class="node-field bunga-col">
                        <div class="nf-label">Bunga</div>
                        <div class="nf-value">{{ $n->bunga ?: '—' }}</div>
                    </div>
                    <div class="node-field solusyon-col">
                        <div class="nf-label">Solusyon</div>
                        <div class="nf-value">{{ $n->solusyon ?: '—' }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="empty-state"><div class="empty-icon">🗂️</div><p>No Node 3 submissions yet.</p></div>
    @endif
</div>

{{-- ═══════════════════════════════════════════
     PANEL: FINAL ACTIVITY
════════════════════════════════════════════ --}}
<div id="panel-final" class="panel">
    @if($final)
        <div class="final-grid">
            <div class="final-kpi">
                <div class="fk-icon">🎯</div>
                <div class="fk-val" style="color:var(--blue)">{{ $final->score }}</div>
                <div class="fk-label">Score</div>
            </div>
            <div class="final-kpi">
                <div class="fk-icon">⚡</div>
                <div class="fk-val" style="color:var(--amber)">{{ number_format($final->total_xp) }}</div>
                <div class="fk-label">XP Earned</div>
            </div>
            <div class="final-kpi">
                <div class="fk-icon">✅</div>
                <div class="fk-val" style="color:var(--green)">{{ $final->correct_answers }}/{{ $final->total_questions }}</div>
                <div class="fk-label">Correct Answers</div>
            </div>
            <div class="final-kpi">
                <div class="fk-icon">⏱️</div>
                <div class="fk-val" style="color:var(--purple)">
                    @php
                        $t = $final->time_taken ?? 0;
                        echo $t >= 60 ? floor($t/60).'m '.($t%60).'s' : $t.'s';
                    @endphp
                </div>
                <div class="fk-label">Time Taken</div>
            </div>
        </div>

        @if($finalAnswers->count())
            <div class="sec-header">
                <div class="sec-title"><span class="line"></span> Activity Answers</div>
                <span class="summary-badge">{{ $finalAnswers->count() }} entries</span>
            </div>
            <div class="answer-table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Scenario</th>
                            <th>Choice</th>
                            <th>Selected</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($finalAnswers as $a)
                        <tr>
                            <td><span class="q-num">{{ $a->scenario_number }}</span></td>
                            <td>{{ $a->choice_text }}</td>
                            <td>
                                <span class="tag {{ $a->selected ? 'tag-correct' : '' }}"
                                      style="{{ !$a->selected ? 'background:var(--surface-2);color:var(--text-3)' : '' }}">
                                    {{ $a->selected ? 'Selected' : 'Not chosen' }}
                                </span>
                            </td>
                            <td>
                                @if($a->selected)
                                    <span class="tag {{ $a->is_correct ? 'tag-correct' : 'tag-wrong' }}">
                                        {{ $a->is_correct ? '✓ Correct' : '✗ Wrong' }}
                                    </span>
                                @else
                                    <span style="color:var(--text-4);font-size:13px;">—</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @else
        <div class="empty-state"><div class="empty-icon">🎯</div><p>Final activity not submitted yet.</p></div>
    @endif
</div>

{{-- ═══════════════════════════════════════════
     PANEL: POSTTEST
════════════════════════════════════════════ --}}
<div id="panel-posttest" class="panel">
    @if($posttest)
        @php $ppct = $posttest->percentage ?? 0; @endphp
        <div class="score-grid" style="margin-bottom:20px;">
            <div class="score-card">
                <div class="sc-label">Score</div>
                <div class="score-ring-wrap">
                    <div class="score-ring">
                        <svg viewBox="0 0 80 80" width="80" height="80">
                            <circle class="ring-bg" cx="40" cy="40" r="33"/>
                            <circle class="ring-fill" cx="40" cy="40" r="33"
                                stroke="#10b981"
                                stroke-dasharray="{{ 2 * 3.14159 * 33 }}"
                                stroke-dashoffset="{{ 2 * 3.14159 * 33 * (1 - $ppct/100) }}"
                            />
                        </svg>
                        <div class="ring-text">
                            <strong style="color:#10b981">{{ $posttest->score }}</strong>
                            <span>pts</span>
                        </div>
                    </div>
                </div>
                <div class="sc-correct">{{ $stats['post_correct'] }}/{{ $stats['post_total'] }} correct</div>
            </div>

            <div class="score-card">
                <div class="sc-label">Percentage</div>
                <div class="score-ring-wrap">
                    <div class="score-ring">
                        <svg viewBox="0 0 80 80" width="80" height="80">
                            <circle class="ring-bg" cx="40" cy="40" r="33"/>
                            <circle class="ring-fill" cx="40" cy="40" r="33"
                                stroke="{{ $ppct >= 75 ? '#10b981' : ($ppct >= 50 ? '#f59e0b' : '#ef4444') }}"
                                stroke-dasharray="{{ 2 * 3.14159 * 33 }}"
                                stroke-dashoffset="{{ 2 * 3.14159 * 33 * (1 - $ppct/100) }}"
                            />
                        </svg>
                        <div class="ring-text">
                            <strong style="color:{{ $ppct >= 75 ? '#10b981' : ($ppct >= 50 ? '#f59e0b' : '#ef4444') }}">{{ $ppct }}%</strong>
                        </div>
                    </div>
                </div>
                <div class="sc-correct">{{ $ppct >= 75 ? 'Passed ✓' : ($ppct >= 50 ? 'Average' : 'Needs Improvement') }}</div>
            </div>

            {{-- Pre vs Post comparison --}}
            <div class="score-card">
                <div class="sc-label">Improvement</div>
                @if($pretest)
                    @php $imp = $stats['improvement']; @endphp
                    <div style="margin-top:14px;text-align:center;">
                        <div style="font-size:36px;font-family:'Outfit',sans-serif;font-weight:800;
                            color:{{ $imp > 0 ? 'var(--green)' : ($imp < 0 ? 'var(--red)' : 'var(--text-3)') }}">
                            {{ $imp > 0 ? '+' : '' }}{{ $imp }}%
                        </div>
                        <div style="font-size:12px;color:var(--text-3);margin-top:6px;">vs Pre-test ({{ $pretest->percentage }}%)</div>
                        <div style="margin-top:10px;">
                            <span class="tag {{ $imp > 0 ? 'tag-correct' : ($imp < 0 ? 'tag-wrong' : '') }}"
                                  style="{{ $imp == 0 ? 'background:var(--surface-2);color:var(--text-3)' : '' }}">
                                {{ $imp > 0 ? '▲ Improved' : ($imp < 0 ? '▼ Declined' : '→ No change') }}
                            </span>
                        </div>
                    </div>
                @else
                    <div style="margin-top:20px;color:var(--text-3);font-size:13px;">No pre-test to compare</div>
                @endif
            </div>
        </div>

        <div class="sec-header">
            <div class="sec-title"><span class="line"></span> Answer Breakdown</div>
            <span class="summary-badge">{{ $stats['post_total'] }} Questions</span>
        </div>
        <div class="answer-table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student's Answer</th>
                        <th>Correct Answer</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posttestAnswers as $a)
                    <tr>
                        <td><span class="q-num">{{ $a->question_number }}</span></td>
                        <td>{{ $a->selected_answer }}</td>
                        <td style="color:var(--green);font-weight:600">{{ $a->correct_answer }}</td>
                        <td>
                            <span class="tag {{ $a->is_correct ? 'tag-correct' : 'tag-wrong' }}">
                                {{ $a->is_correct ? '✓ Correct' : '✗ Wrong' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center;color:var(--text-3);padding:24px;">No answers recorded.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state"><div class="empty-icon">📋</div><p>Post-test not submitted yet.</p></div>
    @endif
</div>

{{-- ═══════════════════════════════════════════
     PANEL: ESSAY
════════════════════════════════════════════ --}}
<div id="panel-essay" class="panel">
    @if($essay)
        <div class="essay-card">
            <div class="essay-head">
                <span>✍️</span>
                <span>Student Essay Response</span>
            </div>
            <div class="essay-body">{{ $essay->essay_answer }}</div>
            <div class="essay-meta">
                <span>
                    {{ str_word_count($essay->essay_answer) }} words
                    · {{ strlen($essay->essay_answer) }} characters
                </span>
                <span>
                    Submitted {{ $essay->submitted_at
                        ? \Carbon\Carbon::parse($essay->submitted_at)->format('M j, Y · g:i A')
                        : \Carbon\Carbon::parse($essay->created_at)->format('M j, Y · g:i A') }}
                </span>
            </div>
        </div>
    @else
        <div class="empty-state"><div class="empty-icon">✍️</div><p>Essay not submitted yet.</p></div>
    @endif
</div>

</div>{{-- /page-wrap --}}
@endsection

@push('scripts')
<script>
function switchTab(id, btn) {
    // Hide all panels
    document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
    // Deactivate all tabs
    document.querySelectorAll('.tab-btn').forEach(t => t.classList.remove('active'));

    // Activate target
    const panel = document.getElementById('panel-' + id);
    if (panel) panel.classList.add('active');
    if (btn) btn.classList.add('active');
}

// Animate rings on load
document.addEventListener('DOMContentLoaded', () => {
    // SVG rings are already statically rendered via PHP, no JS animation needed
    // but we can add a subtle entrance
    document.querySelectorAll('.ring-fill').forEach(el => {
        const target = el.getAttribute('stroke-dashoffset');
        const circumference = parseFloat(el.getAttribute('stroke-dasharray'));
        el.style.strokeDashoffset = circumference;
        setTimeout(() => {
            el.style.transition = 'stroke-dashoffset 1s cubic-bezier(.25,.8,.25,1)';
            el.style.strokeDashoffset = target;
        }, 100);
    });
});
</script>
@endpush