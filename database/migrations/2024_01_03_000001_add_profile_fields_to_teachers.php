<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->enum('gender', ['male', 'female'])->default('male')->after('avatar');
            $table->string('subject_specialization')->nullable()->after('gender');
            $table->string('phone', 20)->nullable()->after('subject_specialization');
            $table->string('school_name')->nullable()->after('phone');
            $table->text('bio')->nullable()->after('school_name');
        });
    }

    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn(['gender', 'subject_specialization', 'phone', 'school_name', 'bio']);
        });
    }
};
