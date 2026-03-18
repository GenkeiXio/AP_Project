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

    public function classes()
    {
        return $this->belongsToMany(SchoolClass::class, 'class_student', 'student_id', 'class_id')
                    ->withPivot('joined_at');
    }

    public function gameSessions()
    {
        return $this->hasMany(GameSession::class);
    }
}
