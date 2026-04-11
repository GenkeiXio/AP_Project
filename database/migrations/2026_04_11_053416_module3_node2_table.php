<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module3_node2_table', function (Blueprint $table) {
            $table->id();

            // Foreign Key
            $table->unsignedBigInteger('student_id');

            // Game Data
            $table->enum('chosen_side', ['top', 'bottom'])->nullable();
            $table->integer('score')->default(0);
            $table->integer('lives_remaining')->default(3);
            $table->boolean('is_passed')->default(false);

            // Optional tracking
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
        Schema::dropIfExists('module3_node2_table');
    }
};
