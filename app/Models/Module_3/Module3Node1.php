<?php

namespace App\Models\Module_3;

use Illuminate\Database\Eloquent\Model;

class Module3Node1 extends Model
{
    protected $table = 'module3_node1_table';

    protected $fillable = [
        'student_id',
        'score',
        'total_items',
        'correct_answers',
        'wrong_answers',
        'accuracy',
        'time_spent',
        'is_completed',
        'is_perfect',
        'max_attempt_reached',
        'attempts',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'is_perfect' => 'boolean',
        'max_attempt_reached' => 'boolean',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
