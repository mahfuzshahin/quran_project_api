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
        Schema::create('surahs', function (Blueprint $table) {
            $table->id();
            $table->string('name_in_english')->nullable();
            $table->string('name_in_bengali')->nullable();
            $table->string('name_in_arabic')->nullable();
            $table->string('type')->nullable();
            $table->string('description')->nullable();
            $table->integer('surah_no_in_quran')->nullable();
            $table->integer('no_of_ayat')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surahs');
    }
};