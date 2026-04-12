<?php

namespace App\Models\Module_2;

use Illuminate\Database\Eloquent\Model;

class Module3PerformanceTask extends Model
{
    protected $table = 'module3_performance_tasks';

    protected $fillable = [
        'student_id',
        'score',
        'badges_earned',
        'completion_time',
    ];

    protected $casts = [
        'badges_earned' => 'array',
    ];

    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class, 'student_id');
    }
}
