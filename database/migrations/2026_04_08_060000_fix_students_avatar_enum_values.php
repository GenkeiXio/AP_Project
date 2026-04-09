<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Allow both legacy and new values first so we can safely normalize data.
        DB::statement("ALTER TABLE students MODIFY avatar ENUM('boy', 'girl', 'boy_uniform', 'girl_uniform') NULL");

        // Normalize legacy values to the new app values.
        DB::statement("UPDATE students SET avatar = 'boy_uniform' WHERE avatar = 'boy'");
        DB::statement("UPDATE students SET avatar = 'girl_uniform' WHERE avatar = 'girl'");

        // Keep only the values used by the current application.
        DB::statement("ALTER TABLE students MODIFY avatar ENUM('boy_uniform', 'girl_uniform') NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE students MODIFY avatar ENUM('boy', 'girl', 'boy_uniform', 'girl_uniform') NULL");
    }
};
