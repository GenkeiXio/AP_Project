<?php

namespace App\Models\Module_3;

use Illuminate\Database\Eloquent\Model;

class Module3Explore extends Model
{
    protected $table = 'module3_explore_table';

    protected $fillable = [
        'student_id',
        'xp',
        'badge',
        'is_completed'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
    ];
}
