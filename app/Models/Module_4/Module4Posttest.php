<?php

namespace App\Models\Module_4;

use Illuminate\Database\Eloquent\Model;

class Module4Posttest extends Model
{
    protected $table = 'module4_posttest_table';

    protected $fillable = [
        'student_id',
        'score',
        'total_items',
        'status',
        'answers',
        'attempt',
    ];

    protected $casts = [
        'answers' => 'array',
    ];

    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class);
    }
}
