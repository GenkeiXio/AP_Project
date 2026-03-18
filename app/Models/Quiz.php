<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'class_id', 'teacher_id', 'title', 'description',
        'type', 'game_format', 'time_limit', 'is_published',
    ];

    protected $casts = ['is_published' => 'boolean'];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order');
    }

    public function gameSessions()
    {
        return $this->hasMany(GameSession::class);
    }

    public function getFormatLabelAttribute(): string
    {
        return match($this->game_format) {
            'mcq'          => 'Multiple Choice',
            'drag_drop'    => 'Drag & Drop',
            'fill_blank'   => 'Fill in the Blank',
            'word_scramble'=> 'Word Scramble',
            default        => $this->game_format,
        };
    }
}
