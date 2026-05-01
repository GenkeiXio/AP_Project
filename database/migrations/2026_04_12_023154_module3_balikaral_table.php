<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module3_balikaral_table', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                  ->constrained('students')
                  ->onDelete('cascade');

            // GAME STATS
            $table->integer('health')->default(100);
            $table->integer('budget')->default(70000);
            $table->integer('trust')->default(80);

            // RESULT
            $table->boolean('is_success')->default(false);

            // OPTIONAL FLEXIBLE STORAGE (for future scaling)
            $table->json('final_state')->nullable();

            $table->integer('time_spent')->nullable();

            $table->boolean('completed')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module3_balikaral_table');
    }
};
