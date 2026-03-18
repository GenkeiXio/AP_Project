<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'teacher_id', 'name', 'description',
        'class_code', 'subject', 'grade_level', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'class_student', 'class_id', 'student_id')
                    ->withPivot('joined_at');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'class_id');
    }
}
