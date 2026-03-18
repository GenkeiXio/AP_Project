@extends('Students.studentslayout')

@section('title', $class->name)

@push('styles')
<style>
    .back-link { display:inline-flex; align-items:center; gap:6px; color:#6dbf7e; font-weight:700; font-size:0.88rem; text-decoration:none; margin-bottom:20px; }
    .back-link:hover { text-decoration:underline; }

    .class-hero { background:rgba(255,255,255,0.88); backdrop-filter:blur(12px); border-radius:20px; padding:26px 30px; box-shadow:0 6px 24px rgba(80,50,10,0.1); border:1.5px solid rgba(255,255,255,0.7); margin-bottom:26px; position:relative; overflow:hidden; }
    .class-hero::before { content:''; position:absolute; top:0; left:0; right:0; height:4px; background:linear-gradient(90deg,#6dbf7e,#e8922a,#6dbf7e); }
    .class-hero h2 { font-family:'Baloo 2',cursive; font-size:1.6rem; font-weight:800; color:#3d2a1a; margin-bottom:4px; }
    .class-hero .teacher { font-size:0.88rem; color:#9a8060; }

    .section-title { font-family:'Baloo 2',cursive; font-size:1.2rem; font-weight:800; color:#3d2a1a; margin-bottom:16px; }

    .quiz-card {
        background:rgba(255,255,255,0.88); backdrop-filter:blur(12px);
        border-radius:18px; padding:22px 24px;
        box-shadow:0 6px 20px rgba(80,50,10,0.08);
        border:2px solid rgba(255,255,255,0.7);
        margin-bottom:16px;
        transition:transform 0.2s,box-shadow 0.2s,border-color 0.2s;
        display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:14px;
    }
    .quiz-card:hover { transform:translateY(-2px); box-shadow:0 10px 28px rgba(80,50,10,0.12); border-color:rgba(109,191,126,0.4); }

    .quiz-left {}
    .quiz-title { font-family:'Baloo 2',cursive; font-size:1.1rem; font-weight:800; color:#3d2a1a; margin-bottom:6px; }
    .quiz-meta  { display:flex; gap:8px; flex-wrap:wrap; }
    .qchip { font-size:0.73rem; font-weight:700; padding:3px 10px; border-radius:7px; }
    .qchip-green  { background:rgba(109,191,126,0.18); color:#2d6a40; }
    .qchip-orange { background:#fff3e0; color:#b05800; }
    .qchip-blue   { background:#e8f0ff; color:#2a4aaa; }

    .quiz-right { display:flex; flex-direction:column; align-items:flex-end; gap:8px; }
    .last-score { font-size:0.82rem; font-weight:700; }
    .score-high { color:#1e7a3a; }
    .score-mid  { color:#b05800; }
    .score-low  { color:#c0392b; }

    .play-btn { padding:11px 22px; background:linear-gradient(135deg,#6dbf7e,#4da862); color:#fff; border:none; border-radius:12px; font-family:'Baloo 2',cursive; font-size:0.95rem; font-weight:700; cursor:pointer; transition:transform 0.2s,box-shadow 0.2s; text-decoration:none; display:inline-flex; align-items:center; gap:6px; box-shadow:0 3px 12px rgba(77,168,98,0.3); }
    .play-btn:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(77,168,98,0.38); }
    .retry-btn { background:linear-gradient(135deg,#f0a040,#e07020); box-shadow:0 3px 12px rgba(224,112,32,0.3); }

    .empty-state { text-align:center; padding:50px 20px; color:#b5a48a; }
    .empty-state .emoji { font-size:3rem; margin-bottom:12px; }
</style>
@endpush

@section('content')

<a href="{{ route('student.classes') }}" class="back-link">← Back to My Classes</a>

<div class="class-hero">
    <h2>{{ $class->name }}</h2>
    <div class="teacher">👩‍🏫 {{ $class->teacher->name ?? 'Unknown Teacher' }} &nbsp;·&nbsp; {{ $class->description }}</div>
</div>

@php
    $pretests = $quizzes->where('type', 'pre_test');
    $regular  = $quizzes->where('type', 'quiz');
@endphp

{{-- Pre-tests --}}
@if($pretests->count())
<div class="section-title">📋 Pre-Tests</div>
@foreach($pretests as $quiz)
@php
    $ls  = $quiz->last_session;
    $pct = $ls ? ($ls->total_points>0 ? round(($ls->score/$ls->total_points)*100) : 0) : null;
    $icons = ['mcq'=>'❓','drag_drop'=>'🧲','fill_blank'=>'✏️','word_scramble'=>'🔤'];
@endphp
<div class="quiz-card">
    <div class="quiz-left">
        <div class="quiz-title">{{ $icons[$quiz->game_format]??'🎮' }} {{ $quiz->title }}</div>
        <div class="quiz-meta">
            <span class="qchip qchip-orange">📋 Pre-Test</span>
            <span class="qchip qchip-blue">{{ $quiz->questions_count }} questions</span>
            @if($quiz->time_limit)<span class="qchip qchip-green">⏱️ {{ $quiz->time_limit }} min</span>@endif
        </div>
    </div>
    <div class="quiz-right">
        @if($pct !== null)
            <span class="last-score {{ $pct>=75?'score-high':($pct>=50?'score-mid':'score-low') }}">
                Last: {{ $pct }}% ({{ $ls->correct_answers }}/{{ $ls->total_questions }})
            </span>
        @endif
        <a href="{{ route('student.quiz.play', $quiz) }}" class="play-btn {{ $ls?'retry-btn':'' }}">
            {{ $ls ? '🔄 Retry' : '▶ Start' }}
        </a>
    </div>
</div>
@endforeach
@endif

{{-- Regular Quizzes --}}
<div class="section-title" style="margin-top:{{ $pretests->count()?'24px':'0' }}">🎮 Quizzes & Games</div>

@if($regular->isEmpty())
    <div class="empty-state"><div class="emoji">🎮</div><p>No quizzes yet. Check back later!</p></div>
@else
    @foreach($regular as $quiz)
    @php
        $ls  = $quiz->last_session;
        $pct = $ls ? ($ls->total_points>0 ? round(($ls->score/$ls->total_points)*100) : 0) : null;
        $formatLabels = ['mcq'=>'Multiple Choice','drag_drop'=>'Drag & Drop','fill_blank'=>'Fill in the Blank','word_scramble'=>'Word Scramble'];
        $icons = ['mcq'=>'❓','drag_drop'=>'🧲','fill_blank'=>'✏️','word_scramble'=>'🔤'];
    @endphp
    <div class="quiz-card">
        <div class="quiz-left">
            <div class="quiz-title">{{ $icons[$quiz->game_format]??'🎮' }} {{ $quiz->title }}</div>
            <div class="quiz-meta">
                <span class="qchip qchip-green">🎯 {{ $formatLabels[$quiz->game_format]??$quiz->game_format }}</span>
                <span class="qchip qchip-blue">{{ $quiz->questions_count }} questions</span>
                @if($quiz->time_limit)<span class="qchip qchip-orange">⏱️ {{ $quiz->time_limit }} min</span>@endif
            </div>
        </div>
        <div class="quiz-right">
            @if($pct !== null)
                <span class="last-score {{ $pct>=75?'score-high':($pct>=50?'score-mid':'score-low') }}">
                    Last: {{ $pct }}% ({{ $ls->correct_answers }}/{{ $ls->total_questions }})
                </span>
            @endif
            <a href="{{ route('student.quiz.play', $quiz) }}" class="play-btn {{ $ls?'retry-btn':'' }}">
                {{ $ls ? '🔄 Play Again' : '▶ Play' }}
            </a>
        </div>
    </div>
    @endforeach
@endif

@endsection
