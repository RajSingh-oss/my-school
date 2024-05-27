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
        Schema::create('Classs', function (Blueprint $table) {
            $table->id();
            $table->string('class', 50)->nullable();
            $table->string('No_of_students', 50)->nullable();
            $table->string('div', 50)->nullable();
            $table->json('subjects')->nullable();
            $table->json('teachers')->nullable();
            $table->json('class_teachers')->nullable();
            $table->boolean('class_status')->nullable();
            $table->string('other', 100)->nullable();
            $table->timestamp('starts')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
