<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module2_posttest_table', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->integer('score');
            $table->float('percentage');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module2_posttest_table');
    }
};
