<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('module4_balikaral_table', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->unsignedInteger('score')->default(0);
            $table->unsignedInteger('correct_answers')->default(0);
            $table->unsignedInteger('total_items')->default(0);
            $table->unsignedInteger('time_spent')->default(0);
            $table->boolean('completed')->default(false);
            $table->timestamps();

            $table->unique('student_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module4_balikaral_table');
    }
};
