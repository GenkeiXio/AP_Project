<?php

namespace App\Models\Module_3;

use Illuminate\Database\Eloquent\Model;

class Module3PerformanceTask extends Model
{
    protected $table = 'module3_performance_tasks';

    protected $fillable = [
        'student_id',
        'score',
        'completion_time',
        'badges_earned',
        'selected_items',
        'answers',
        'kit_score',
        'evacuation_score',
        'communication_score',
        'safe_score',
        'is_completed',
    ];

    protected $casts = [
        'badges_earned'  => 'array',
        'selected_items' => 'array',
        'answers'        => 'array',
        'is_completed'   => 'boolean',
    ];

    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class, 'student_id');
    }
}
