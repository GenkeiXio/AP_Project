<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'quiz_id', 'question_text', 'correct_answer',
        'points', 'order', 'extra_data',
    ];

    protected $casts = ['extra_data' => 'array'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function options()
    {
        return $this->hasMany(QuestionOption::class)->orderBy('order');
    }
}
