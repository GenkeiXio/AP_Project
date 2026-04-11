<?php

namespace App\Models\Module_3;

use Illuminate\Database\Eloquent\Model;

class Module3Node2 extends Model
{
    protected $table = 'module3_node2_table';

    protected $fillable = [
        'student_id',
        'chosen_side',
        'score',
        'lives_remaining',
        'is_passed',
        'attempts',
    ];

    protected $casts = [
        'is_passed' => 'boolean',
    ];

    // Relationship
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
