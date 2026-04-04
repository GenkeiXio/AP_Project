<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('module2_pretest_answers_table', function (Blueprint $table) {
            $table->id();

            $table->foreignId('module2_pretest_id')
                ->constrained('module2_pretest_table')
                ->cascadeOnDelete();

            $table->integer('question_number');
            $table->string('selected_answer');
            $table->string('correct_answer');
            $table->boolean('is_correct');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module2_pretest_answers_table');
    }
};
