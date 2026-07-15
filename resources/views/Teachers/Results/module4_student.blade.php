@extends('Teachers.teacherslayout')

@section('title', 'Student Progress')
@section('page-title', 'Module 4 Student')

@push('styles')
<style>
*, *::before, *::after { box-sizing: border-box; }
body { background: #eef2f7; color: #1e293b; }

/* ── BACK LINK ─────────────────────────────────── */
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 20px;
    padding: 8px 16px;
    border-radius: 10px;
    background: white;
    border: 1px solid #e2e8f0;
    text-decoration: none;
    font-weight: 600;
    font-size: 13px;
    color: #64748b;
    transition: all 0.2s;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06);
}
.back-link:hover {
    color: #1e293b;
    transform: translateX(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* ── HEADER CARD ───────────────────────────────── */
.student-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    background: white;
    padding: 20px 24px;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 8px 24px rgba(0,0,0,0.04);
    margin-bottom: 20px;
    border-left: 5px solid #14b8a6;
    position: relative;
    overflow: hidden;
}
.student-header::after {
    content: '';
    position: absolute;
    top: 0; right: 0;
    width: 220px; height: 100%;
    background: linear-gradient(135deg, transparent, rgba(20,184,166,0.04));
    pointer-events: none;
}
.student-info { display: flex; align-items: center; gap: 16px; min-width: 0; }
.student-info-text { min-width: 0; }
.student-info-text h2 {
    font-size: 22px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 2px 0;
    overflow-wrap: break-word;
}
.student-subtitle { font-size: 12px; color: #94a3b8; font-weight: 500; margin-bottom: 8px; }
.student-badges { display: flex; gap: 6px; flex-wrap: wrap; }

.badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 10px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}
.badge-green  { background: #dcfce7; color: #16a34a; }
.badge-blue   { background: #dbeafe; color: #2563eb; }
.badge-amber  { background: #fef3c7; color: #d97706; }
.badge-red    { background: #fee2e2; color: #dc2626; }
.badge-slate  { background: #f1f5f9; color: #64748b; }

.avatar {
    width: 58px;
    height: 58px;
    border-radius: 16px;
    background: linear-gradient(135deg, #14b8a6, #0ea5e9);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 18px;
    flex-shrink: 0;
    box-shadow: 0 4px 14px rgba(20,184,166,0.35);
}

.btn-export {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 11px 20px;
    border-radius: 12px;
    background: linear-gradient(135deg, #14b8a6, #0ea5e9);
    color: white;
    font-weight: 700;
    font-size: 13px;
    text-decoration: none;
    box-shadow: 0 4px 14px rgba(14,165,233,0.3);
    transition: all 0.25s;
    white-space: nowrap;
    flex-shrink: 0;
}
.btn-export:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(14,165,233,0.4);
    color: white;
}
.btn-export svg { width: 15px; height: 15px; }

/* ── SUMMARY GRID ──────────────────────────────── */
.summary-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-bottom: 20px;
}
.summary-card {
    background: white;
    padding: 18px 20px;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 4px 12px rgba(0,0,0,0.04);
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.summary-card-header { display: flex; align-items: center; gap: 10px; }
.summary-icon {
    width: 38px; height: 38px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; flex-shrink: 0;
}
.icon-teal   { background: #ccfbf1; }
.icon-blue   { background: #dbeafe; }
.icon-purple { background: #ede9fe; }
.icon-amber  { background: #fef3c7; }

.summary-label {
    font-size: 10px; font-weight: 700;
    letter-spacing: .08em; color: #94a3b8; text-transform: uppercase;
}
.summary-value { font-size: 28px; font-weight: 800; line-height: 1; }
.val-teal   { color: #0d9488; }
.val-blue   { color: #2563eb; }
.val-purple { color: #7c3aed; }
.val-amber  { color: #d97706; }
.val-red    { color: #dc2626; }
.val-muted  { color: #cbd5e1; }

.summary-sub { font-size: 12px; color: #94a3b8; font-weight: 500; }
.summary-bar-track { height: 4px; background: #f1f5f9; border-radius: 999px; overflow: hidden; }
.summary-bar-fill  { height: 100%; border-radius: 999px; transition: width 0.6s ease; }
.bar-teal   { background: linear-gradient(to right, #14b8a6, #0ea5e9); }
.bar-red    { background: #ef4444; }
.bar-amber  { background: #f59e0b; }
.bar-purple { background: linear-gradient(to right, #8b5cf6, #6366f1); }

/* ── TABS ──────────────────────────────────────── */
.tabs-wrapper {
    background: white;
    padding: 10px 14px;
    border-radius: 14px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    margin-bottom: 20px;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: thin;
    scrollbar-color: #e2e8f0 transparent;
}
.tabs-wrapper::-webkit-scrollbar { height: 4px; }
.tabs-wrapper::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 4px; }
.tabs { display: flex; gap: 4px; min-width: max-content; }
.tab {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 8px 16px; border-radius: 10px; cursor: pointer;
    font-size: 13px; font-weight: 600; color: #64748b;
    transition: all 0.2s; white-space: nowrap; user-select: none;
    scroll-snap-align: start;
}
.tab:hover { background: #f1f5f9; color: #334155; }
.tab.active {
    background: linear-gradient(135deg, #14b8a6, #0ea5e9);
    color: white;
    box-shadow: 0 4px 12px rgba(14,165,233,0.25);
}

/* ── CONTENT ───────────────────────────────────── */
.content { display: none; }
.content.active { display: block; }

/* ── STAT ROW ──────────────────────────────────── */
.stat-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    margin-bottom: 16px;
}
.stat-row-2 { grid-template-columns: repeat(2, 1fr); }

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 24px 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 4px 12px rgba(0,0,0,0.04);
    display: flex; flex-direction: column; align-items: center;
    gap: 10px; text-align: center;
}
.stat-label {
    font-size: 10px; font-weight: 700;
    letter-spacing: .1em; text-transform: uppercase; color: #94a3b8;
}
.stat-sub { font-size: 12px; color: #94a3b8; font-weight: 500; }

/* ── CIRCULAR GAUGE ─────────────────────────────── */
.gauge-wrap {
    position: relative; width: 100px; height: 100px;
    display: flex; align-items: center; justify-content: center;
}
.gauge-svg { position: absolute; top: 0; left: 0; transform: rotate(-90deg); }
.gauge-center {
    position: relative; z-index: 1;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
}
.gauge-number { font-size: 26px; font-weight: 800; line-height: 1; color: #0f172a; }
.gauge-unit   { font-size: 10px; color: #94a3b8; font-weight: 600; }

/* ── TABLE BOX ─────────────────────────────────── */
.table-box {
    background: white; border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 4px 12px rgba(0,0,0,0.04);
    overflow: hidden; margin-bottom: 16px;
}
.table-box-header {
    display: flex; justify-content: space-between; align-items: center;
    padding: 16px 20px; border-bottom: 1px solid #f1f5f9;
    flex-wrap: wrap; gap: 8px;
}
.table-box-title { font-size: 14px; font-weight: 700; color: #0f172a; }
.question-count  { font-size: 12px; font-weight: 600; color: #94a3b8; white-space: nowrap; }

.table-scroll { overflow-x: auto; -webkit-overflow-scrolling: touch; }

table { width: 100%; border-collapse: collapse; font-size: 13px; }
thead { background: #f8fafc; }
th {
    padding: 11px 20px; text-align: left;
    font-size: 10px; font-weight: 700;
    letter-spacing: .08em; text-transform: uppercase; color: #94a3b8;
    white-space: nowrap;
}
td {
    padding: 13px 20px; color: #334155;
    font-weight: 500; border-bottom: 1px solid #f8fafc;
}
tbody tr:hover { background: #fafbfc; }
tbody tr:last-child td { border-bottom: none; }

.q-number {
    display: inline-flex; align-items: center; justify-content: center;
    width: 28px; height: 28px; border-radius: 8px;
    background: #f1f5f9; font-size: 12px; font-weight: 700; color: #64748b;
}

.result-badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 4px 10px; border-radius: 999px;
    font-size: 11px; font-weight: 700;
    white-space: nowrap;
}
.badge-correct { background: #dcfce7; color: #16a34a; }
.badge-wrong   { background: #fee2e2; color: #dc2626; }

/* ── DETAIL CARD ────────────────────────────────── */
.detail-card {
    background: white; border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05); overflow: hidden; margin-bottom: 16px;
}
.detail-row {
    display: flex; align-items: flex-start;
    padding: 14px 20px; border-bottom: 1px solid #f8fafc; gap: 16px;
}
.detail-row:last-child { border-bottom: none; }
.detail-key {
    width: 140px; flex-shrink: 0;
    font-size: 11px; font-weight: 700;
    color: #94a3b8; text-transform: uppercase; letter-spacing: .06em;
    padding-top: 2px;
}
.detail-val { font-size: 14px; font-weight: 600; color: #0f172a; flex: 1; min-width: 0; overflow-wrap: break-word; }

/* ── STATUS PILL ────────────────────────────────── */
.status-pill {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 4px 12px; border-radius: 999px;
    font-size: 12px; font-weight: 700;
    white-space: nowrap;
}
.pill-pass    { background: #dcfce7; color: #16a34a; }
.pill-fail    { background: #fee2e2; color: #dc2626; }
.pill-done    { background: #dbeafe; color: #2563eb; }
.pill-pending { background: #f1f5f9; color: #64748b; }

/* ── EMPTY STATE ────────────────────────────────── */
.empty-state {
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    padding: 48px 20px; gap: 10px;
    background: white; border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
.empty-state-icon { font-size: 40px; }
.empty-state-text { font-size: 14px; color: #94a3b8; font-weight: 600; }

/* ── RESPONSIVE ─────────────────────────────────── */
@media (max-width: 1024px) {
    .summary-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 900px) {
    .stat-row { grid-template-columns: repeat(2, 1fr); }
    .stat-row-2 { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
    .stat-row, .stat-row-2 { grid-template-columns: 1fr; }
    .student-header { flex-direction: column; align-items: stretch; }
    .student-info { padding-right: 0; }
    .btn-export { width: 100%; }
    .summary-grid { grid-template-columns: 1fr; }
}
@media (max-width: 560px) {
    .student-header { padding: 18px; }
    .avatar { width: 50px; height: 50px; font-size: 16px; border-radius: 14px; }
    .student-info-text h2 { font-size: 19px; }
    .stat-card { padding: 20px 16px; }
    .gauge-wrap { width: 88px; height: 88px; }
    .gauge-svg { width: 88px; height: 88px; }
    .detail-row { flex-direction: column; gap: 4px; }
    .detail-key { width: 100%; }
    th, td { padding: 10px 14px; }
}
</style>
@endpush

@section('content')

@php
$pretestScore  = $pretest->score ?? 0;
$pretestTotal  = $pretest->total_items ?? 0;
$pretestPct    = $pretestTotal > 0 ? round(($pretestScore / $pretestTotal) * 100) : 0;

$posttestScore = $posttest->score ?? 0;
$posttestTotal = $posttest->total_items ?? 0;
$posttestPct   = $posttestTotal > 0 ? round(($posttestScore / $posttestTotal) * 100) : 0;

$balikaralScore = $balikaral->score ?? 0;
$balikaralTotal = $balikaral->total_items ?? 0;
$balikaralPct   = $balikaralTotal > 0 ? round(($balikaralScore / $balikaralTotal) * 100) : 0;

$explorePct  = $explore->progress_percent ?? 0;
$performDone = $performance && $performance->is_submitted;

$circ = 2 * M_PI * 45;

$colorFor = fn($pct) => $pct >= 75 ? '#14b8a6' : ($pct >= 50 ? '#f59e0b' : '#ef4444');
$labelFor = fn($pct) => $pct >= 75 ? 'Good' : ($pct >= 50 ? 'Average' : 'Needs Improvement');
$barFor   = fn($pct) => $pct >= 75 ? 'bar-teal' : ($pct >= 50 ? 'bar-amber' : 'bar-red');
$valFor   = fn($pct) => $pct >= 75 ? 'val-teal' : ($pct >= 50 ? 'val-amber' : 'val-red');
$dashOff  = fn($pct) => $circ - ($circ * $pct / 100);
@endphp

{{-- BACK --}}
<a href="{{ route('teacher.module4.results') }}" class="back-link">
    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24"
         stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
    </svg>
    Back to Student List
</a>

{{-- ── HEADER ──────────────────────────────────────── --}}
<div class="student-header">
    <div class="student-info">
        <div class="avatar">{{ strtoupper(substr($student->username, 0, 2)) }}</div>
        <div class="student-info-text">
            <h2>{{ $student->username }}</h2>
            <div class="student-subtitle">Module 4 — Detailed Performance Report</div>
            <div class="student-badges">
                <span class="badge badge-green">📝 Pre: {{ $pretestScore }}/{{ $pretestTotal }}</span>
                @if($posttest)
                    <span class="badge {{ $posttest->status === 'passed' ? 'badge-green' : 'badge-red' }}">
                        {{ $posttest->status === 'passed' ? '✅' : '❌' }} Post: {{ $posttestScore }}/{{ $posttestTotal }}
                    </span>
                @else
                    <span class="badge badge-slate">📋 Post: N/A</span>
                @endif
                <span class="badge badge-blue">📋 {{ $explorePct }}% Done</span>
            </div>
        </div>
    </div>
    <a href="{{ route('teacher.module4.export', $student->id) }}" class="btn-export">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
        </svg>
        Export CSV
    </a>
</div>

{{-- ── SUMMARY CARDS ───────────────────────────────── --}}
<div class="summary-grid">

    {{-- PRE-TEST --}}
    <div class="summary-card">
        <div class="summary-card-header">
            <div class="summary-icon icon-teal">📝</div>
            <span class="summary-label">Pre-Test</span>
        </div>
        <div>
            <div class="summary-value {{ $valFor($pretestPct) }}">{{ $pretestPct }}%</div>
            <div class="summary-sub">{{ $pretestScore }}/{{ $pretestTotal }} correct</div>
        </div>
        <div class="summary-bar-track">
            <div class="summary-bar-fill {{ $barFor($pretestPct) }}" style="width:{{ $pretestPct }}%"></div>
        </div>
    </div>

    {{-- POST-TEST --}}
    <div class="summary-card">
        <div class="summary-card-header">
            <div class="summary-icon icon-blue">📊</div>
            <span class="summary-label">Post-Test</span>
        </div>
        @if($posttest)
        <div>
            <div class="summary-value {{ $valFor($posttestPct) }}">{{ $posttestPct }}%</div>
            <div class="summary-sub">{{ $posttestScore }}/{{ $posttestTotal }} correct</div>
        </div>
        <div class="summary-bar-track">
            <div class="summary-bar-fill {{ $barFor($posttestPct) }}" style="width:{{ $posttestPct }}%"></div>
        </div>
        @else
        <div>
            <div class="summary-value val-muted" style="font-size:20px;">—</div>
            <div class="summary-sub">Not submitted</div>
        </div>
        <div class="summary-bar-track"><div class="summary-bar-fill" style="width:0"></div></div>
        @endif
    </div>

    {{-- PERFORMANCE TASK --}}
    <div class="summary-card">
        <div class="summary-card-header">
            <div class="summary-icon icon-purple">🎯</div>
            <span class="summary-label">Performance Task</span>
        </div>
        <div>
            @if($performDone)
                <div class="summary-value val-teal">Done</div>
            @else
                <div class="summary-value val-muted" style="font-size:20px;">—</div>
            @endif
            <div class="summary-sub">{{ $performDone ? 'Submitted' : 'Not submitted' }}</div>
        </div>
        <div class="summary-bar-track">
            <div class="summary-bar-fill bar-purple" style="width:{{ $performDone ? 100 : 0 }}%"></div>
        </div>
    </div>

    {{-- COMPLETION --}}
    <div class="summary-card">
        <div class="summary-card-header">
            <div class="summary-icon icon-amber">✅</div>
            <span class="summary-label">Completion</span>
        </div>
        <div>
            <div class="summary-value val-amber">{{ $explorePct }}%</div>
            <div class="summary-sub">Explore progress</div>
        </div>
        <div class="summary-bar-track">
            <div class="summary-bar-fill bar-amber" style="width:{{ $explorePct }}%"></div>
        </div>
    </div>

</div>

{{-- ── TABS ─────────────────────────────────────────── --}}
<div class="tabs-wrapper">
    <div class="tabs">
        <div class="tab active" data-tab="pretest">📝 Pretest</div>
        <div class="tab" data-tab="balikaral">🔄 Balik-Aral</div>
        <div class="tab" data-tab="explore">🌍 Explore</div>
        <div class="tab" data-tab="games">🎮 Games</div>
        <div class="tab" data-tab="poll">📊 Poll</div>
        <div class="tab" data-tab="performance">🎯 Performance</div>
        <div class="tab" data-tab="posttest">📋 Post Test</div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════ --}}
{{-- PRETEST                                            --}}
{{-- ══════════════════════════════════════════════════ --}}
<div class="content active" id="pretest">

    <div class="stat-row">
        {{-- Score gauge --}}
        <div class="stat-card">
            <div class="stat-label">Score</div>
            <div class="gauge-wrap">
                <svg class="gauge-svg" width="100" height="100" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="#f1f5f9" stroke-width="8"/>
                    <circle cx="50" cy="50" r="45" fill="none"
                            stroke="{{ $colorFor($pretestPct) }}" stroke-width="8"
                            stroke-dasharray="{{ $circ }}"
                            stroke-dashoffset="{{ $dashOff($pretestPct) }}"
                            stroke-linecap="round"/>
                </svg>
                <div class="gauge-center">
                    <span class="gauge-number">{{ $pretestScore }}</span>
                    <span class="gauge-unit">pts</span>
                </div>
            </div>
            <div class="stat-sub">{{ $pretestScore }}/{{ $pretestTotal }} correct</div>
        </div>

        {{-- Percentage gauge --}}
        <div class="stat-card">
            <div class="stat-label">Percentage</div>
            <div class="gauge-wrap">
                <svg class="gauge-svg" width="100" height="100" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="#f1f5f9" stroke-width="8"/>
                    <circle cx="50" cy="50" r="45" fill="none"
                            stroke="{{ $colorFor($pretestPct) }}" stroke-width="8"
                            stroke-dasharray="{{ $circ }}"
                            stroke-dashoffset="{{ $dashOff($pretestPct) }}"
                            stroke-linecap="round"/>
                </svg>
                <div class="gauge-center">
                    <span class="gauge-number">{{ $pretestPct }}<span style="font-size:14px">%</span></span>
                </div>
            </div>
            <div class="stat-sub">{{ $labelFor($pretestPct) }}</div>
        </div>

        {{-- Submitted --}}
        <div class="stat-card">
            <div class="stat-label">Submitted</div>
            @if($pretest && $pretest->created_at)
                <div style="display:flex;flex-direction:column;align-items:center;gap:4px;width:100%;margin-top:6px;">
                    <span style="font-size:11px;color:#94a3b8;font-weight:600;">Date</span>
                    <span style="font-size:17px;font-weight:800;color:#0f172a;">
                        {{ \Carbon\Carbon::parse($pretest->created_at)->format('M d, Y') }}
                    </span>
                    <span style="font-size:11px;color:#94a3b8;font-weight:600;margin-top:6px;">Time</span>
                    <span style="font-size:17px;font-weight:800;color:#0f172a;">
                        {{ \Carbon\Carbon::parse($pretest->created_at)->format('g:i A') }}
                    </span>
                </div>
                <div class="stat-sub" style="margin-top:6px;">
                    Level: <strong>{{ $pretest->level ?? 'N/A' }}</strong>
                </div>
            @else
                <div style="font-size:34px;margin:14px 0;">📭</div>
                <div class="stat-sub">Not submitted</div>
            @endif
        </div>
    </div>

    {{-- Answer Breakdown --}}
    @if($pretestAnswers->count())
    <div class="table-box">
        <div class="table-box-header">
            <span class="table-box-title">Answer Breakdown</span>
            <span class="question-count">{{ $pretestAnswers->count() }} Questions</span>
        </div>
        <div class="table-scroll">
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
                @foreach($pretestAnswers as $a)
                <tr>
                    <td><span class="q-number">{{ $a->question_number }}</span></td>
                    <td>{{ $a->selected_option }}</td>
                    <td>{{ $a->correct_option }}</td>
                    <td>
                        <span class="result-badge {{ $a->is_correct ? 'badge-correct' : 'badge-wrong' }}">
                            {{ $a->is_correct ? '✓ Correct' : '✗ Wrong' }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    @else
    <div class="empty-state">
        <div class="empty-state-icon">📭</div>
        <div class="empty-state-text">No answers recorded</div>
    </div>
    @endif

</div>

{{-- ══════════════════════════════════════════════════ --}}
{{-- BALIK-ARAL                                         --}}
{{-- ══════════════════════════════════════════════════ --}}
<div class="content" id="balikaral">
    <div class="stat-row">
        <div class="stat-card">
            <div class="stat-label">Score</div>
            <div class="gauge-wrap">
                <svg class="gauge-svg" width="100" height="100" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="#f1f5f9" stroke-width="8"/>
                    <circle cx="50" cy="50" r="45" fill="none"
                            stroke="{{ $colorFor($balikaralPct) }}" stroke-width="8"
                            stroke-dasharray="{{ $circ }}"
                            stroke-dashoffset="{{ $dashOff($balikaralPct) }}"
                            stroke-linecap="round"/>
                </svg>
                <div class="gauge-center">
                    <span class="gauge-number">{{ $balikaralScore }}</span>
                    <span class="gauge-unit">pts</span>
                </div>
            </div>
            <div class="stat-sub">{{ $balikaralScore }}/{{ $balikaralTotal }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Percentage</div>
            <div class="gauge-wrap">
                <svg class="gauge-svg" width="100" height="100" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="#f1f5f9" stroke-width="8"/>
                    <circle cx="50" cy="50" r="45" fill="none"
                            stroke="{{ $colorFor($balikaralPct) }}" stroke-width="8"
                            stroke-dasharray="{{ $circ }}"
                            stroke-dashoffset="{{ $dashOff($balikaralPct) }}"
                            stroke-linecap="round"/>
                </svg>
                <div class="gauge-center">
                    <span class="gauge-number">{{ $balikaralPct }}<span style="font-size:14px">%</span></span>
                </div>
            </div>
            <div class="stat-sub">{{ $labelFor($balikaralPct) }}</div>
        </div>

        <div class="stat-card" style="align-items:flex-start;padding:20px;">
            <div class="stat-label" style="align-self:center;">Details</div>
            <div style="width:100%;margin-top:10px;">
                <div style="display:flex;justify-content:space-between;align-items:center;
                            padding:10px 0;border-bottom:1px solid #f1f5f9;">
                    <span style="font-size:12px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.06em;">Correct</span>
                    <span style="font-size:16px;font-weight:800;color:#0f172a;">{{ $balikaral->correct_answers ?? 0 }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;
                            padding:10px 0;border-bottom:1px solid #f1f5f9;">
                    <span style="font-size:12px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.06em;">Total</span>
                    <span style="font-size:16px;font-weight:800;color:#0f172a;">{{ $balikaralTotal }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;">
                    <span style="font-size:12px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.06em;">Time Spent</span>
                    <span style="font-size:16px;font-weight:800;color:#0f172a;">{{ $balikaral->time_spent ?? 0 }}s</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════ --}}
{{-- EXPLORE                                            --}}
{{-- ══════════════════════════════════════════════════ --}}
<div class="content" id="explore">
    @php $exploreColor = $colorFor($explorePct); @endphp
    <div class="stat-row stat-row-2">
        <div class="stat-card">
            <div class="stat-label">Progress</div>
            <div class="gauge-wrap">
                <svg class="gauge-svg" width="100" height="100" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="#f1f5f9" stroke-width="8"/>
                    <circle cx="50" cy="50" r="45" fill="none"
                            stroke="{{ $exploreColor }}" stroke-width="8"
                            stroke-dasharray="{{ $circ }}"
                            stroke-dashoffset="{{ $dashOff($explorePct) }}"
                            stroke-linecap="round"/>
                </svg>
                <div class="gauge-center">
                    <span class="gauge-number">{{ $explorePct }}<span style="font-size:14px">%</span></span>
                </div>
            </div>
            <div class="stat-sub">{{ $explorePct }}% explored</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Status</div>
            <div style="font-size:44px;margin:12px 0;">
                {{ ($explore && $explore->is_completed) ? '✅' : '⏳' }}
            </div>
            <span class="status-pill {{ ($explore && $explore->is_completed) ? 'pill-pass' : 'pill-pending' }}">
                {{ ($explore && $explore->is_completed) ? 'Completed' : 'In Progress' }}
            </span>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════ --}}
{{-- GAMES                                              --}}
{{-- ══════════════════════════════════════════════════ --}}
<div class="content" id="games">
    @forelse($games as $g)
    <div class="table-box">
        <div class="table-box-header">
            <span class="table-box-title">🎮 {{ $g->game_type }}</span>
            <span class="badge badge-blue">Rank #{{ $g->rank }}</span>
        </div>
        <div class="table-scroll">
        <table>
            <thead>
                <tr><th>Score</th><th>Total Items</th><th>Rank</th></tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong style="font-size:15px;">{{ $g->score }}</strong></td>
                    <td>{{ $g->total_items }}</td>
                    <td><span class="badge badge-blue">#{{ $g->rank }}</span></td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
    @empty
    <div class="empty-state">
        <div class="empty-state-icon">🎮</div>
        <div class="empty-state-text">No game data available</div>
    </div>
    @endforelse
</div>

{{-- ══════════════════════════════════════════════════ --}}
{{-- POLL                                               --}}
{{-- ══════════════════════════════════════════════════ --}}
<div class="content" id="poll">
    @if($poll)
    <div class="detail-card">
        <div class="table-box-header">
            <span class="table-box-title">Poll Response</span>
            <span class="badge badge-blue">{{ $poll->selected_count ?? 0 }} selected</span>
        </div>
        <div class="detail-row">
            <div class="detail-key">Selected Count</div>
            <div class="detail-val">{{ $poll->selected_count ?? 0 }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-key">Options</div>
            <div class="detail-val" style="display:flex;flex-wrap:wrap;gap:6px;">
                @foreach(json_decode($poll->selected_options ?? '[]') as $opt)
                    <span class="badge badge-blue">{{ $opt }}</span>
                @endforeach
            </div>
        </div>
    </div>
    @else
    <div class="empty-state">
        <div class="empty-state-icon">📊</div>
        <div class="empty-state-text">No poll response recorded</div>
    </div>
    @endif
</div>

{{-- ══════════════════════════════════════════════════ --}}
{{-- PERFORMANCE TASK                                   --}}
{{-- ══════════════════════════════════════════════════ --}}
<div class="content" id="performance">
    @if($performance)
    <div class="detail-card">
        <div class="table-box-header">
            <span class="table-box-title">Performance Task</span>
            <span class="status-pill {{ $performance->is_submitted ? 'pill-pass' : 'pill-pending' }}">
                {{ $performance->is_submitted ? '✓ Submitted' : 'Not Submitted' }}
            </span>
        </div>
        <div class="detail-row">
            <div class="detail-key">Format</div>
            <div class="detail-val">{{ $performance->format ?? 'N/A' }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-key">Submitted At</div>
            <div class="detail-val">
                @if($performance->created_at)
                    {{ \Carbon\Carbon::parse($performance->created_at)->format('M d, Y · g:i A') }}
                @else N/A @endif
            </div>
        </div>
        <div class="detail-row">
            <div class="detail-key">File</div>
            <div class="detail-val">
                @if($performance->file_path)
                    <a href="{{ asset('storage/' . $performance->file_path) }}" target="_blank"
                       style="color:#0ea5e9;font-weight:700;text-decoration:none;">
                        📎 View File
                    </a>
                @else N/A @endif
            </div>
        </div>
        @if($performance->reflection)
        <div class="detail-row" style="flex-direction:column;align-items:flex-start;gap:8px;">
            <div class="detail-key">Reflection</div>
            <div class="detail-val"
                 style="background:#f8fafc;padding:14px;border-radius:10px;width:100%;
                        line-height:1.7;font-size:13px;color:#334155;font-weight:400;">
                {{ $performance->reflection }}
            </div>
        </div>
        @endif
    </div>
    @else
    <div class="empty-state">
        <div class="empty-state-icon">🎯</div>
        <div class="empty-state-text">No performance task submitted</div>
    </div>
    @endif
</div>

{{-- ══════════════════════════════════════════════════ --}}
{{-- POST TEST                                          --}}
{{-- ══════════════════════════════════════════════════ --}}
<div class="content" id="posttest">
    @if($posttest)
    <div class="stat-row">
        <div class="stat-card">
            <div class="stat-label">Score</div>
            <div class="gauge-wrap">
                <svg class="gauge-svg" width="100" height="100" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="#f1f5f9" stroke-width="8"/>
                    <circle cx="50" cy="50" r="45" fill="none"
                            stroke="{{ $colorFor($posttestPct) }}" stroke-width="8"
                            stroke-dasharray="{{ $circ }}"
                            stroke-dashoffset="{{ $dashOff($posttestPct) }}"
                            stroke-linecap="round"/>
                </svg>
                <div class="gauge-center">
                    <span class="gauge-number">{{ $posttestScore }}</span>
                    <span class="gauge-unit">pts</span>
                </div>
            </div>
            <div class="stat-sub">{{ $posttestScore }}/{{ $posttestTotal }} correct</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Percentage</div>
            <div class="gauge-wrap">
                <svg class="gauge-svg" width="100" height="100" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="#f1f5f9" stroke-width="8"/>
                    <circle cx="50" cy="50" r="45" fill="none"
                            stroke="{{ $colorFor($posttestPct) }}" stroke-width="8"
                            stroke-dasharray="{{ $circ }}"
                            stroke-dashoffset="{{ $dashOff($posttestPct) }}"
                            stroke-linecap="round"/>
                </svg>
                <div class="gauge-center">
                    <span class="gauge-number">{{ $posttestPct }}<span style="font-size:14px">%</span></span>
                </div>
            </div>
            <div class="stat-sub">{{ $labelFor($posttestPct) }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Details</div>
            <span class="status-pill {{ $posttest->status === 'passed' ? 'pill-pass' : 'pill-fail' }}" style="margin-top:6px;">
                {{ $posttest->status === 'passed' ? '✅ Passed' : '❌ Failed' }}
            </span>
            <div style="display:flex;flex-direction:column;align-items:center;gap:4px;margin-top:8px;">
                <span style="font-size:11px;color:#94a3b8;font-weight:600;">Attempt</span>
                <span style="font-size:22px;font-weight:800;color:#0f172a;">{{ $posttest->attempt }}</span>
                @if($posttest->created_at)
                <span style="font-size:11px;color:#94a3b8;font-weight:600;margin-top:6px;">Date Taken</span>
                <span style="font-size:13px;font-weight:700;color:#334155;">
                    {{ \Carbon\Carbon::parse($posttest->created_at)->format('M d, Y') }}
                </span>
                @endif
            </div>
        </div>
    </div>

    @if($posttest->answers)
    <div class="table-box">
        <div class="table-box-header">
            <span class="table-box-title">Answer Breakdown</span>
            <span class="question-count">{{ count(json_decode($posttest->answers)) }} Questions</span>
        </div>
        <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Selected Answer</th>
                </tr>
            </thead>
            <tbody>
                @foreach(json_decode($posttest->answers) as $index => $ans)
                <tr>
                    <td><span class="q-number">{{ $index + 1 }}</span></td>
                    <td>{{ $ans }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    @else
    <div class="empty-state">
        <div class="empty-state-icon">📭</div>
        <div class="empty-state-text">No answers recorded</div>
    </div>
    @endif

    @else
    <div class="empty-state">
        <div class="empty-state-icon">📋</div>
        <div class="empty-state-text">No post-test record found</div>
    </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', () => {
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.content').forEach(c => c.classList.remove('active'));
        tab.classList.add('active');
        document.getElementById(tab.dataset.tab).classList.add('active');
        if (typeof tab.scrollIntoView === 'function') {
            tab.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
        }
    });
});
</script>
@endpush