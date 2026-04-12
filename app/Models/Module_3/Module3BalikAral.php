<?php

namespace App\Models\Module_3;

use Illuminate\Database\Eloquent\Model;

class Module3BalikAral extends Model
{
    protected $table = 'module3_balikaral_table';

    protected $fillable = [
        'student_id',
        'score',
        'correct_answers',
        'total_items',
        'completed',
        'time_spent'
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];
}
