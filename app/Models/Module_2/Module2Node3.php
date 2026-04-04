<?php

namespace App\Models\Module_2;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Module2Node3 extends Model
{
    protected $table = 'module2_node3_table';

    protected $fillable = [
        'student_id',
        'problem_number',
        'sanhi',
        'bunga',
        'solusyon',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
