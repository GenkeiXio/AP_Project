<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module4_posttest_table', function (Blueprint $table) {
            $table->id();

            // FK
            $table->unsignedBigInteger('student_id');

            // Score
            $table->integer('score');
            $table->integer('total_items')->default(15);

            // Status
            $table->enum('status', ['passed', 'failed']);

            // Answers JSON
            $table->json('answers')->nullable();

            // Attempt count
            $table->integer('attempt')->default(1);

            $table->timestamps();

            // FK constraint
            $table->foreign('student_id')
                  ->references('id')
                  ->on('students')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module4_posttest_table');
    }
};
