<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module3_safehome_table', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');

            $table->integer('correct_count')->default(0);
            $table->integer('wrong_count')->default(0);
            $table->integer('total_clicks')->default(0);

            $table->boolean('is_perfect')->default(false);
            $table->boolean('is_completed')->default(false);

            $table->json('selected_options')->nullable();

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
        Schema::dropIfExists('module3_safehome_table');
    }
};
