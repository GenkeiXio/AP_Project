<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module2_final_activity_answers_table', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('module2_final_activity_id');

            $table->foreign('module2_final_activity_id', 'm2_final_answers_fk')
                ->references('id')
                ->on('module2_final_activity_table')
                ->cascadeOnDelete();

            $table->integer('scenario_number');
            $table->text('choice_text');
            $table->boolean('selected');
            $table->boolean('is_correct');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module2_final_activity_answers_table');
    }
};
