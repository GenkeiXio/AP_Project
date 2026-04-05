<?php

namespace App\Models\Module_2;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Module2Posttest extends Model
{
    protected $table = 'module2_posttest_table';

    protected $fillable = [
        'student_id',
        'score',
        'percentage',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function answers()
    {
        return $this->hasMany(Module2PosttestAnswer::class, 'module2_posttest_id');
    }
}
