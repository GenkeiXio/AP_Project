<?php

namespace App\Models\Module_2;

use Illuminate\Database\Eloquent\Model;

class Module2PosttestAnswer extends Model
{
    protected $table = 'module2_posttest_answers_table';

    protected $fillable = [
        'module2_posttest_id',
        'question_number',
        'selected_answer',
        'correct_answer',
        'is_correct',
    ];
}
