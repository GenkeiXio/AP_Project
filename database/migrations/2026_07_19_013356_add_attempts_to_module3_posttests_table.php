<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('module3_posttest_table', function (Blueprint $table) {
            $table->integer('attempts')->default(1)->after('answers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('module3_posttest_table', function (Blueprint $table) {
            $table->dropColumn('attempts');
        });
    }
};
