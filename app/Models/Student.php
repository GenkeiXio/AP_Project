<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'username',
        'avatar',
        'last_played',
    ];

    protected $casts = [
        'last_played' => 'datetime',
    ];

    public function gameSessions()
    {
        return $this->hasMany(GameSession::class);
    }

    public function classes()
    {
        return $this->belongsToMany(SchoolClass::class, 'class_student', 'student_id', 'class_id')
            ->withPivot('joined_at');
    }

    public function getAvatarEmojiAttribute(): string
    {
        return match ($this->avatar) {
            'boy_uniform' => '🧑‍🎓',
            'girl_uniform' => '👩‍🎓',
            'rizal' => '📜',
            'bonifacio' => '🔥',
            'gabriela' => '🛡️',
            'neutral_hero' => '🧩',
            default => '🎒',
        };
    }

    public function getAvatarNameAttribute(): string
    {
        return match ($this->avatar) {
            'boy_uniform' => 'Juan',
            'girl_uniform' => 'Maria',
            'rizal' => 'Rizal',
            'bonifacio' => 'Bonifacio',
            'gabriela' => 'Gabriela',
            'neutral_hero' => 'Lihim',
            default => 'Explorer',
        };
    }
}
