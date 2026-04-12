<?php

namespace App\Models\Module_4;

use Illuminate\Database\Eloquent\Model;

class Module4Pretest extends Model
{
    protected $table = 'module4_pretest_table';

    protected $fillable = [
        'student_id',
        'score',
        'total_items',
        'level',
        'is_completed',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
    ];
}
