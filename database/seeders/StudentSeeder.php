<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::create([
            'username' => 'student1',
            'avatar' => 'explorer_boy'
        ]);

        Student::create([
            'username' => 'student2',
            'avatar' => 'explorer_girl'
        ]);
    }
}