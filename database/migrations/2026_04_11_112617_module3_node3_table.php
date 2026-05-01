<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module3_node3_table', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');

            // NEW GAME DATA
            $table->integer('choices_selected')->default(0);
            $table->integer('remaining_budget')->default(0);
            $table->integer('readiness_score')->default(0);
            $table->boolean('is_passed')->default(false);

            // TRACKING
            $table->boolean('is_completed')->default(false);
            $table->integer('attempts')->default(1);

            $table->timestamps();

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module3_node3_table');
    }
};
