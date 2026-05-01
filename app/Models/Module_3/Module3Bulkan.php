<?php

namespace App\Models\Module_3;

use Illuminate\Database\Eloquent\Model;

class Module3Bulkan extends Model
{
    protected $table = 'module3_bulkan_table';

    protected $fillable = [
        'student_id',
        'progress',
        'is_success',
        'mistakes',
        'final_state',
        'completed'
    ];

    protected $casts = [
        'is_success' => 'boolean',
        'completed' => 'boolean',
        'final_state' => 'array',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
