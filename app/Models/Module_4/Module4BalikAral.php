<?php

namespace App\Models\Module_4;

use Illuminate\Database\Eloquent\Model;

class Module4BalikAral extends Model
{
    protected $table = 'module4_balikaral_table';

    protected $fillable = [
        'student_id',
        'score',
        'correct_answers',
        'total_items',
        'time_spent',
        'completed',
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];
}
