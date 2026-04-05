<?php

namespace App\Models\Module_2;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;


class Module2FinalActivity extends Model
{
    protected $table = 'module2_final_activity_table';

    protected $fillable = [
        'student_id',
        'total_xp',
        'score',
        'total_questions',
        'correct_answers',
        'time_taken'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function answers()
    {
        return $this->hasMany(Module2FinalActivityAnswer::class, 'module2_final_activity_id');
    }
}
