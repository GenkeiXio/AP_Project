<?php

namespace App\Models\Pretest;

use Illuminate\Database\Eloquent\Model;

class Module3Pretest extends Model
{
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
        return $this->hasMany(Module3PretestAnswer::class);
    }
}
