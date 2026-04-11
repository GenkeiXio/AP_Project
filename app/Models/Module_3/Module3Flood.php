<?php

namespace App\Models\Module_3;

use Illuminate\Database\Eloquent\Model;

class Module3Flood extends Model
{
    protected $table = 'module3_flood_table';

    protected $fillable = [
        'student_id',
        'score',
        'hp_remaining',
        'total_questions',
        'is_completed',
        'is_game_over',
        'answers',
    ];

    protected $casts = [
        'answers' => 'array',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
