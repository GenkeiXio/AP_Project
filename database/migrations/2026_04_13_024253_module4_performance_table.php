<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module4_performance_table', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');

            // MAIN RESULT
            $table->integer('score')->default(0);
            $table->integer('completion_time')->default(0);

            // GAME DATA
            $table->json('badges_earned')->nullable();
            $table->json('selected_items')->nullable();
            $table->json('answers')->nullable();

            // SECTION SCORES
            $table->integer('kit_score')->default(0);
            $table->integer('evacuation_score')->default(0);
            $table->integer('communication_score')->default(0);
            $table->integer('safe_score')->default(0);

            // META
            $table->boolean('is_completed')->default(false);

            $table->timestamps();

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module4_performance_table');
    }
};
