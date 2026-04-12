<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('module4_game_results_table', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('game_type', 30);
            $table->unsignedInteger('score')->default(0);
            $table->unsignedInteger('total_items')->default(0);
            $table->string('rank')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->timestamps();

            $table->unique(['student_id', 'game_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module4_game_results_table');
    }
};
