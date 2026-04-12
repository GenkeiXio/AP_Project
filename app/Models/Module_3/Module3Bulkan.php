<?php

namespace App\Models\Module_3;

use Illuminate\Database\Eloquent\Model;

class Module3Bulkan extends Model
{
    protected $table = 'module3_bulkan_table';

    protected $fillable = [
        'student_id',
        'score',
        'is_completed',
        'selected_answers',
        'total_correct',
        'total_items',
    ];

    protected $casts = [
        'selected_answers' => 'array',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
