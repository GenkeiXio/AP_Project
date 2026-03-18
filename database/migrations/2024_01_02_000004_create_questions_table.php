<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade');
            $table->text('question_text');
            $table->string('correct_answer');
            $table->integer('points')->default(1);
            $table->integer('order')->default(0);
            // For drag_drop: JSON pairs like [{"term":"X","match":"Y"}]
            // For word_scramble: the word is stored in correct_answer, scrambled shown to student
            $table->json('extra_data')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
