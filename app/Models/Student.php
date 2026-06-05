<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'username',
        'password',
        'avatar',
        'last_played',
        'unlocked_avatars',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'last_played' => 'datetime',
        'unlocked_avatars' => 'array',
    ];

    public function getUnlockedAvatarsAttribute($value): array
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_null($value) || $value === '') {
            return ['boy_uniform', 'girl_uniform', 'neutral_hero'];
        }

        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }

        return ['boy_uniform', 'girl_uniform', 'neutral_hero'];
    }

    public function hasUnlockedAvatar(string $avatar): bool
    {
        return in_array($avatar, $this->unlocked_avatars, true);
    }

    public function unlockAvatar(string $avatar): void
    {
        $avatars = $this->unlocked_avatars;
        if (!in_array($avatar, $avatars, true)) {
            $avatars[] = $avatar;
            $this->update(['unlocked_avatars' => $avatars]);
        }
    }

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
