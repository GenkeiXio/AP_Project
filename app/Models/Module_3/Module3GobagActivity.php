<?php

namespace App\Models\Module_3;

use Illuminate\Database\Eloquent\Model;

class Module3GobagActivity extends Model
{
    protected $table = 'module3_gobagact_table';

    protected $fillable = [
        'student_id',
        'score',
        'total_items',
        'time_taken',
        'rating',
        'is_completed',
        'attempts',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
