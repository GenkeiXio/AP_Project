<?php

namespace App\Models\Module_4;

use Illuminate\Database\Eloquent\Model;

class Module4Performance extends Model
{
    protected $table = 'module4_performance_table';

    protected $fillable = [
        'student_id',
        'reflection',
        'format',
        'file_path',
        'is_submitted',
    ];

    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class);
    }
}
