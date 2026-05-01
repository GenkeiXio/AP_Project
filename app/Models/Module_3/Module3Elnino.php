<?php

namespace App\Models\Module_3;

use Illuminate\Database\Eloquent\Model;

class Module3Elnino extends Model
{
    protected $table = 'module3_elnino_table';

    protected $fillable = [
        'student_id',
        'completed_points',
        'is_success',
        'selections',
        'completed'
    ];

    protected $casts = [
        'is_success' => 'boolean',
        'completed' => 'boolean',
        'selections' => 'array',
    ];
}
