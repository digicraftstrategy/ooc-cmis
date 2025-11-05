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
        Schema::create('literatures', function (Blueprint $table) {
            $table->id();
            $table->string('literature_title');
            $table->string('slug')->unique();
            $table->string('author')->nullable();
            $table->string('publisher')->nullable();
            $table->year('publication_year')->nullable();
            $table->string('genre')->nullable();
            $table->string('language')->nullable();
            $table->enum('subtitle', ['Yes', 'No'])->nullable();
            $table->text('theme')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('literatures');
    }
};
