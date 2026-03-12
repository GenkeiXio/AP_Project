<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        Teacher::create([
            'name' => 'Sample Teacher',
            'email' => 'teacher@school.com',
            'password' => Hash::make('teacher123'),
            'access_code' => strtoupper(Str::random(6)),
            'avatar' => 'teacher_female'
        ]);
    }
}
