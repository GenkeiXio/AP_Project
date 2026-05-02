<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('module3_performance_tasks', function (Blueprint $table) {

            // Remove the old mismatched columns if they exist
            $columns = Schema::getColumnListing('module3_performance_tasks');

            if (in_array('kit_items', $columns))              $table->dropColumn('kit_items');
            if (in_array('evacuation_answers', $columns))     $table->dropColumn('evacuation_answers');
            if (in_array('communication_answers', $columns))  $table->dropColumn('communication_answers');
            if (in_array('safe_answers', $columns))           $table->dropColumn('safe_answers');
            if (in_array('total_questions_answered', $columns)) $table->dropColumn('total_questions_answered');
        });

        Schema::table('module3_performance_tasks', function (Blueprint $table) {

            // Add the correct columns the controller actually saves
            if (!in_array('selected_items', Schema::getColumnListing('module3_performance_tasks'))) {
                $table->json('selected_items')->nullable();
            }
            if (!in_array('answers', Schema::getColumnListing('module3_performance_tasks'))) {
                $table->json('answers')->nullable();
            }
            if (!in_array('kit_score', Schema::getColumnListing('module3_performance_tasks'))) {
                $table->integer('kit_score')->default(0);
            }
            if (!in_array('evacuation_score', Schema::getColumnListing('module3_performance_tasks'))) {
                $table->integer('evacuation_score')->default(0);
            }
            if (!in_array('communication_score', Schema::getColumnListing('module3_performance_tasks'))) {
                $table->integer('communication_score')->default(0);
            }
            if (!in_array('safe_score', Schema::getColumnListing('module3_performance_tasks'))) {
                $table->integer('safe_score')->default(0);
            }
            if (!in_array('is_completed', Schema::getColumnListing('module3_performance_tasks'))) {
                $table->boolean('is_completed')->default(false);
            }
        });
    }

    public function down(): void
    {
        Schema::table('module3_performance_tasks', function (Blueprint $table) {
            $table->dropColumn([
                'selected_items',
                'answers',
                'kit_score',
                'evacuation_score',
                'communication_score',
                'safe_score',
                'is_completed',
            ]);
        });
    }
};
