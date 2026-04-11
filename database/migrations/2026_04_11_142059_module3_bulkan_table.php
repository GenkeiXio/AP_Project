<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module3_bulkan_table', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');

            $table->integer('score')->default(0);
            $table->boolean('is_completed')->default(false);

            $table->json('selected_answers')->nullable();

            $table->integer('total_correct')->default(4);
            $table->integer('total_items')->default(7);

            $table->timestamps();

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module3_bulkan_table');
    }
};
