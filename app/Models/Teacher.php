<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'access_code',
        'avatar',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'access_code',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function classes()
    {
        return $this->hasMany(SchoolClass::class);
    }
}
