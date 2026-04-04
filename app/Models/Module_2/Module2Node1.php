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
        'sanhi_text',
        'bunga_image',
        'bunga_text',
        'solusyon_image',
        'solusyon_text',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
