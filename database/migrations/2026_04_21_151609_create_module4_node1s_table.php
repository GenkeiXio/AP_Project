<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('module4_node1s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->integer('problem_number');

            $table->text('sanhi_image')->nullable();
            $table->text('sanhi_text')->nullable();

            $table->text('bunga_image')->nullable();
            $table->text('bunga_text')->nullable();

            $table->text('solusyon_image')->nullable();
            $table->text('solusyon_text')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module4_node1s');
    }
};
