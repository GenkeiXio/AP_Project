z`<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module3_node1_table', function (Blueprint $table) {
            $table->id();

            // Foreign Key
            $table->unsignedBigInteger('student_id');

            // Game Results
            $table->integer('score')->default(0);
            $table->integer('total_items')->default(4);
            $table->float('accuracy')->nullable();

            // Status
            $table->boolean('is_completed')->default(false);

            // Attempts tracking
            $table->integer('attempts')->default(1);

            $table->timestamps();

            // FK Constraint
            $table->foreign('student_id')
                  ->references('id')
                  ->on('students')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module3_node1_table');
    }
};
