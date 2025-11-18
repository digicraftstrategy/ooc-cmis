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
            $table->integer('pages')->nullable();
            $table->string('genre')->nullable();
            $table->text('summary')->nullable();
            $table->string('cover_art_path')->nullable(); // URL to the cover art image
            $table->boolean('has_classified')->default(false);
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
