<?php

namespace App\Models\Module_3;

use Illuminate\Database\Eloquent\Model;

class Module3SafeHome extends Model
{
    protected $table = 'module3_safehome_table';

    protected $fillable = [
        'student_id',
        'correct_count',
        'wrong_count',
        'total_clicks',
        'is_perfect',
        'is_completed',
        'selected_options',
        'attempts',
    ];

    protected $casts = [
        'is_perfect' => 'boolean',
        'is_completed' => 'boolean',
        'selected_options' => 'array',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
