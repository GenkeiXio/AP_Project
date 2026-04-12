<?php

namespace App\Models\Module_4;

use Illuminate\Database\Eloquent\Model;

class Module4Explore extends Model
{
    protected $table = 'module4_explore_table';

    protected $fillable = [
        'student_id',
        'completed_stories',
        'progress_percent',
        'is_completed',
    ];

    protected $casts = [
        'completed_stories' => 'array',
        'is_completed' => 'boolean',
    ];
}
