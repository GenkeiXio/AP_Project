z`<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module3_node1_table', function (Blueprint $table) {
            $table->id();

            // FK
            $table->unsignedBigInteger('student_id');

            // Core Game Data
            $table->integer('score')->default(0);
            $table->integer('total_items')->default(4);
            $table->integer('correct_answers')->default(0);
            $table->integer('wrong_answers')->default(0);

            // Metrics
            $table->float('accuracy')->nullable();
            $table->integer('time_spent')->nullable(); // seconds

            // Game Status
            $table->boolean('is_completed')->default(false);
            $table->boolean('is_perfect')->default(false);
            $table->boolean('max_attempt_reached')->default(false);

            // Attempts
            $table->integer('attempts')->default(1);

            $table->timestamps();

            // FK Constraint
            $table->foreign('student_id')
                  ->references('id')
                  ->on('students')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module3_node1_table');
    }
};
