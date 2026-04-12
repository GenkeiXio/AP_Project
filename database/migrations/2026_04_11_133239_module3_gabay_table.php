<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module3_gabay_table', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');

            $table->integer('score')->default(0);
            $table->integer('total_items')->default(12);
            $table->float('accuracy')->nullable();

            $table->enum('performance_level', [
                'excellent',
                'good',
                'needs_improvement'
            ])->nullable();

            $table->json('placements')->nullable();

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
        Schema::dropIfExists('module3_gabay_table');
    }
};
