<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module4_performance_table', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');

            $table->text('reflection');
            $table->string('format')->nullable();
            $table->string('file_path')->nullable();

            $table->boolean('is_submitted')->default(false);

            $table->timestamps();

            $table->foreign('student_id')
                  ->references('id')
                  ->on('students')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module4_performance_table');
    }
};
