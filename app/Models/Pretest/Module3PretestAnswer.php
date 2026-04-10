<?php

namespace App\Models\Pretest;

use Illuminate\Database\Eloquent\Model;

class Module3PretestAnswer extends Model
{
    protected $fillable = [
        'module3_pretest_id',
        'question_number',
        'selected_answer',
        'correct_answer',
        'is_correct',
    ];

    public function pretest()
    {
        return $this->belongsTo(Module3Pretest::class, 'module3_pretest_id');
    }
}
