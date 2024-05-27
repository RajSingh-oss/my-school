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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('class', 50)->nullable();
            $table->string('div', 50)->nullable();
            $table->string('name', 150)->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('FathPhone', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('father', 150)->nullable();
            $table->string('mother', 150)->nullable();
            $table->string('mot', 150)->nullable();
            $table->timestamp('DoB')->nullable();
            $table->string('Roll', 150)->unique()->nullable();
            $table->string('Addr', 250)->nullable();
            $table->string('image', 100)->nullable();
            $table->string('Cat', 100)->nullable();
            $table->string('addBy', 10)->nullable();
            $table->string('Password', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
