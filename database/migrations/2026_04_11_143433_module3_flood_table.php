<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module3_flood_table', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');

            $table->integer('score')->default(0);
            $table->integer('hp_remaining')->default(100);
            $table->integer('total_questions')->default(19);

            $table->boolean('is_completed')->default(false);
            $table->boolean('is_game_over')->default(false);

            $table->json('answers')->nullable();

            $table->timestamps();

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module3_flood_table');
    }
};
