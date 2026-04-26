<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module3_pretest_answers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('module3_pretest_id')
                  ->constrained('module3_pretests')
                  ->cascadeOnDelete();

            $table->integer('question_number');
            $table->string('selected_answer')->nullable();
            $table->string('correct_answer');
            $table->boolean('is_correct')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module3_pretest_answers');
    }
};
