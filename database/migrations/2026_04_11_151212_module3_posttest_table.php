<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module3_posttest_table', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');

            $table->integer('score')->default(0);
            $table->integer('total_items')->default(15);

            $table->string('performance_level')->nullable();
            $table->boolean('is_passed')->default(false);

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
        Schema::dropIfExists('module3_posttest_table');
    }
};
