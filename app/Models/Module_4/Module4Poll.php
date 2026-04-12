<?php

namespace App\Models\Module_4;

use Illuminate\Database\Eloquent\Model;

class Module4Poll extends Model
{
    protected $table = 'module4_poll_table';

    protected $fillable = [
        'student_id',
        'selected_options',
        'selected_count',
    ];

    protected $casts = [
        'selected_options' => 'array',
    ];
}
