<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module3_node3_table', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');

            $table->integer('final_budget')->default(0);
            $table->integer('safety_score')->default(0);

            $table->enum('status', [
                'not_ready',
                'partially_ready',
                'ready'
            ])->default('not_ready');

            $table->json('selected_strategies')->nullable();

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
        Schema::dropIfExists('module3_node3_table');
    }
};
