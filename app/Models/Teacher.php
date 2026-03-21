<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'access_code',
        'avatar',
        'gender',
        'subject_specialization',
        'phone',
        'school_name',
        'bio',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'access_code',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function classes()
    {
        return $this->hasMany(SchoolClass::class);
    }

    /**
     * Get avatar emoji based on avatar type and gender.
     */
    public function getAvatarEmojiAttribute(): string
    {
        $map = [
            'teacher_male'   => '👨‍🏫',
            'teacher_female' => '👩‍🏫',
            'scientist'      => $this->gender === 'female' ? '👩‍🔬' : '👨‍🔬',
            'explorer'       => $this->gender === 'female' ? '🧭' : '🧭',
        ];
        return $map[$this->avatar] ?? ($this->gender === 'female' ? '👩‍🏫' : '👨‍🏫');
    }

    /**
     * Get avatar display label.
     */
    public function getAvatarLabelAttribute(): string
    {
        $map = [
            'teacher_male'   => 'Teacher (Male)',
            'teacher_female' => 'Teacher (Female)',
            'scientist'      => 'Scientist',
            'explorer'       => 'Explorer',
        ];
        return $map[$this->avatar] ?? 'Teacher';
    }
}
