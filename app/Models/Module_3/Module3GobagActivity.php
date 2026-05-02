<?php

namespace App\Models\Module_3;

use Illuminate\Database\Eloquent\Model;

class Module3GobagActivity extends Model
{
    protected $table = 'module3_gobagact_table';

    protected $fillable = [
        'student_id',
        'score',
        'correct_items',
        'wrong_attempts',
        'total_items',
        'time_taken',
        'accuracy',
        'rating',
        'is_completed',
        'is_success',
        'attempts',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'is_success' => 'boolean',
        'accuracy' => 'float',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
