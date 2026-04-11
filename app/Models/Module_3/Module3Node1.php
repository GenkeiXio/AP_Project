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
        'accuracy',
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
