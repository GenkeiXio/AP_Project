<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'username',
        'avatar',
        'last_played',
    ];

    protected $casts = [
        'last_played' => 'datetime',
    ];
}
