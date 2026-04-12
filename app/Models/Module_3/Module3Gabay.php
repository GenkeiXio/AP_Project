<?php

namespace App\Models\Module_3;

use Illuminate\Database\Eloquent\Model;

class Module3Gabay extends Model
{
    protected $table = 'module3_gabay_table';

    protected $fillable = [
        'student_id',
        'score',
        'total_items',
        'accuracy',
        'performance_level',
        'placements',
        'is_completed',
        'attempts',
    ];

    protected $casts = [
        'placements' => 'array',
        'is_completed' => 'boolean',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
