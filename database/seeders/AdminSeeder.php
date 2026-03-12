<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Teacher;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Pre-made Admin Account
        Admin::create([
            'name'        => 'Admin',
            'email'       => 'admin@school.com',
            'password'    => Hash::make('Admin@1234'),
            'access_code' => 'ADM001',
        ]);

        // Sample Teacher Account
        Teacher::create([
            'name'        => 'Teacher Juan',
            'email'       => 'teacher@school.com',
            'password'    => Hash::make('Teacher@1234'),
            'access_code' => 'TCH001',
            'avatar'      => 'teacher_male',
            'is_active'   => true,
        ]);
    }
}
