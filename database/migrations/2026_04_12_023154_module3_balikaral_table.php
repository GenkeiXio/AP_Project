<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module3_balikaral_table', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                  ->constrained('students')
                  ->onDelete('cascade');

            $table->integer('score')->default(0);
            $table->integer('correct_answers')->default(0);
            $table->integer('total_items')->default(3);

            $table->boolean('completed')->default(false);
            $table->integer('time_spent')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module3_balikaral_table');
    }
};
