<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Step 1: Allow ALL possible values (old + new)
        DB::statement("ALTER TABLE students MODIFY avatar ENUM(
            'boy',
            'girl',
            'rizal',
            'bonifacio',
            'gabriela',
            'boy_uniform',
            'girl_uniform',
            'neutral_hero'
        ) NULL");

        // Step 2: Normalize legacy values
        DB::statement("UPDATE students SET avatar = 'boy_uniform' WHERE avatar = 'boy'");
        DB::statement("UPDATE students SET avatar = 'girl_uniform' WHERE avatar = 'girl'");

        // Step 3: Final ENUM (ALL valid values in your app)
        DB::statement("ALTER TABLE students MODIFY avatar ENUM(
            'rizal',
            'bonifacio',
            'gabriela',
            'boy_uniform',
            'girl_uniform',
            'neutral_hero'
        ) NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE students MODIFY avatar ENUM(
            'boy',
            'girl',
            'boy_uniform',
            'girl_uniform'
        ) NULL");
    }
};