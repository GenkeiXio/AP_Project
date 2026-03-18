<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameSession extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'quiz_id', 'student_id', 'score', 'total_points',
        'correct_answers', 'total_questions', 'status',
        'started_at', 'completed_at',
    ];

    protected $casts = [
        'started_at'   => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function scores()
    {
        return $this->hasMany(StudentScore::class);
    }

    public function getPercentageAttribute(): int
    {
        if ($this->total_points === 0) return 0;
        return (int) round(($this->score / $this->total_points) * 100);
    }
}
