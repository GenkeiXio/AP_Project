<?php

namespace App\Models\Module_2;

use Illuminate\Database\Eloquent\Model;

class Module2Essay extends Model
{
    protected $table = 'module2_essay_table';

    protected $fillable = [
        'student_id',
        'essay_answer',
        'evidence_path',
        'evidence_type',
        'submitted_by',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
