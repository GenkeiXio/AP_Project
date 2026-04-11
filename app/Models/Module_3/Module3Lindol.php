<?php

namespace App\Models\Module_3;

use Illuminate\Database\Eloquent\Model;

class Module3Lindol extends Model
{
    protected $table = 'module3_lindol_table';

    protected $fillable = [
        'student_id',
        'score',
        'total_items',
        'correct_items',
        'completed',
        'time_spent'
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];
}
