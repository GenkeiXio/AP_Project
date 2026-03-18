<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('game_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->integer('score')->default(0);
            $table->integer('total_points')->default(0);
            $table->integer('correct_answers')->default(0);
            $table->integer('total_questions')->default(0);
            $table->enum('status', ['started', 'completed'])->default('started');
            $table->timestamp('started_at')->useCurrent();
            $table->timestamp('completed_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_sessions');
    }
};
