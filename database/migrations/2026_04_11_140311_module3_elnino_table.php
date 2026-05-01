<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module3_elnino_table', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                  ->constrained('students')
                  ->onDelete('cascade');

            // GAME PROGRESS
            $table->integer('completed_points')->default(0); // 0–5

            // RESULT
            $table->boolean('is_success')->default(false);

            // STORE ALL PLAYER CHOICES
            $table->json('selections')->nullable();

            $table->boolean('completed')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module3_elnino_table');
    }
};
