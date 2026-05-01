<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module3_bulkan_table', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                  ->constrained('students')
                  ->onDelete('cascade');

            // GAME PROGRESS
            $table->integer('progress')->default(0); // 0–10

            // RESULT
            $table->boolean('is_success')->default(false);

            // OPTIONAL METRICS
            $table->integer('mistakes')->default(0);

            // FLEXIBLE STORAGE
            $table->json('final_state')->nullable();

            $table->boolean('completed')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module3_bulkan_table');
    }
};
