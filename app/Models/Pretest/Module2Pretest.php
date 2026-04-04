<?php

namespace App\Models\Pretest;

use Illuminate\Database\Eloquent\Model;

class Module2Pretest extends Model
{
    protected $table = 'module2_pretest_table';

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
        return $this->hasMany(Module2PretestAnswer::class, 'module2_pretest_id');
    }
}
