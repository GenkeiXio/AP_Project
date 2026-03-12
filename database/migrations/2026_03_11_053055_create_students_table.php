<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {

            $table->id();

            $table->string('username')->unique();

            $table->enum('avatar', [
                'explorer_boy',
                'explorer_girl',
                'scientist',
                'adventurer'
            ])->nullable();

            $table->timestamp('last_played')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};