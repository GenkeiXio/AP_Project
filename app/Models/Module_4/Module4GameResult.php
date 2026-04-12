<?php

namespace App\Models\Module_4;

use Illuminate\Database\Eloquent\Model;

class Module4GameResult extends Model
{
    protected $table = 'module4_game_results_table';

    protected $fillable = [
        'student_id',
        'game_type',
        'score',
        'total_items',
        'rank',
        'is_completed',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
    ];
}
