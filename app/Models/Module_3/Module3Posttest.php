<?php

namespace App\Models\Module_3;

use Illuminate\Database\Eloquent\Model;

class Module3Posttest extends Model
{
    protected $table = 'module3_posttest_table';

    protected $fillable = [
        'student_id',
        'score',
        'total_items',
        'performance_level',
        'is_passed',
        'answers'
    ];

    protected $casts = [
        'answers' => 'array',
        'is_passed' => 'boolean',
    ];
}
