<?php

namespace App\Models\Module_3;

use Illuminate\Database\Eloquent\Model;

class Module3BalikAral extends Model
{
    protected $table = 'module3_balikaral_table';

    protected $fillable = [
        'student_id',
        'health',
        'budget',
        'trust',
        'is_success',
        'final_state',
        'time_spent',
        'completed'
    ];

    protected $casts = [
        'completed' => 'boolean',
        'is_success' => 'boolean',
        'final_state' => 'array',
    ];
}
