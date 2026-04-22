<?php

namespace App\Models\Module_2;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Module2Node1 extends Model
{
    protected $table = 'module2_node1_table';

    protected $fillable = [
        'student_id',
        'problem_number',
        'sanhi_image',
        'bunga_image',
        'solusyon_image',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
