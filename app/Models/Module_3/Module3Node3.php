<?php

namespace App\Models\Module_3;

use Illuminate\Database\Eloquent\Model;

class Module3Node3 extends Model
{
    protected $table = 'module3_node3_table';

    protected $fillable = [
        'student_id',
        'choices_selected',
        'remaining_budget',
        'readiness_score',
        'is_passed',
        'is_completed',
        'attempts',
    ];

    protected $casts = [
        'is_passed' => 'boolean',
        'is_completed' => 'boolean',
    ];

    // relationship
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
