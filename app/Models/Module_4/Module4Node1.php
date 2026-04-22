<?php

namespace App\Models\Module_4;

use Illuminate\Database\Eloquent\Model;

class Module4Node1 extends Model
{
    protected $fillable = [
        'student_id',
        'problem_number',

        'sanhi_image',
        'sanhi_text',

        'bunga_image',
        'bunga_text',

        'solusyon_image',
        'solusyon_text',
    ];
}