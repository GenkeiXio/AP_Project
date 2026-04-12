<?php

namespace App\Models\Module_3;

use Illuminate\Database\Eloquent\Model;

class Module3Node3 extends Model
{
    protected $table = 'module3_node3_table';

    protected $fillable = [
        'student_id',
        'final_budget',
        'safety_score',
        'status',
        'selected_strategies',
        'is_completed',
        'attempts',
    ];

    protected $casts = [
        'selected_strategies' => 'array',
        'is_completed' => 'boolean',
    ];

    // relationship
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
