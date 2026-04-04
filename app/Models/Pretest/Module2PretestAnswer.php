<?php

namespace App\Models\Pretest;

use Illuminate\Database\Eloquent\Model;

class Module2PretestAnswer extends Model
{
    protected $table = 'module2_pretest_answers_table';

    protected $fillable = [
        'module2_pretest_id',
        'question_number',
        'selected_answer',
        'correct_answer',
        'is_correct',
    ];

    public function pretest()
    {
        return $this->belongsTo(Module2Pretest::class, 'module2_pretest_id');
    }
}
