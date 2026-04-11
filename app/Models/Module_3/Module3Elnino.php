<?php

namespace App\Models\Module_3;

use Illuminate\Database\Eloquent\Model;

class Module3Elnino extends Model
{
    protected $table = 'module3_elnino_table';

    protected $fillable = [
        'student_id',
        'score',
        'is_completed',
        'zone1',
        'zone2',
        'zone3',
        'zone4',
        'zone5',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
