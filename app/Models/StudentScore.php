<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentScore extends Model
{
    protected $fillable = [
        'game_session_id', 'question_id',
        'student_answer', 'is_correct', 'points_earned',
    ];

    protected $casts = ['is_correct' => 'boolean'];

    public function gameSession()
    {
        return $this->belongsTo(GameSession::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
