<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'access_code',
    ];

    protected $hidden = [
        'password',
        'access_code',
    ];
}
