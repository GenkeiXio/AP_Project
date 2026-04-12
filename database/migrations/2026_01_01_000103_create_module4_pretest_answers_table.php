<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('module4_pretest_answers_table', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module4_pretest_id')->constrained('module4_pretest_table')->onDelete('cascade');
            $table->unsignedInteger('question_number');
            $table->unsignedInteger('selected_option');
            $table->unsignedInteger('correct_option');
            $table->boolean('is_correct')->default(false);
            $table->timestamps();

            $table->index(['module4_pretest_id', 'question_number'], 'pretest_answer_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module4_pretest_answers_table');
    }
};
