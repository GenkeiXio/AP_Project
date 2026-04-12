<?php

namespace App\Models\Module_4;

use Illuminate\Database\Eloquent\Model;

class Module4PretestAnswer extends Model
{
    protected $table = 'module4_pretest_answers_table';

    protected $fillable = [
        'module4_pretest_id',
        'question_number',
        'selected_option',
        'correct_option',
        'is_correct',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];
}
