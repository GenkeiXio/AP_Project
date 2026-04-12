<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module3_elnino_table', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');

            $table->integer('score')->default(0);
            $table->boolean('is_completed')->default(false);

            $table->string('zone1')->nullable();
            $table->string('zone2')->nullable();
            $table->string('zone3')->nullable();
            $table->string('zone4')->nullable();
            $table->string('zone5')->nullable();

            $table->timestamps();

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module3_elnino_table');
    }
};
