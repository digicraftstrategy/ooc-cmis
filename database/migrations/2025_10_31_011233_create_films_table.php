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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('film_title');
            $table->string('slug')->unique();
            $table->string('casts')->nullable();
            $table->string('director')->nullable();
            $table->string('producer')->nullable();
            $table->string('production_company')->nullable();
            $table->year('release_year')->nullable();
            $table->string('genre')->nullable();
            $table->string('language')->nullable();
            $table->integer('duration');
            $table->boolean('has_subtitle')->default(false);
            $table->text('theme')->nullable();
            //$table->text('synopsis')->nullable();
            $table->string('poster_path')->nullable(); // path to the film poster image
            $table->string('trailer_url')->nullable(); // URL to the film trailer

            $table->foreignId('film_type_id')->constrained('film_types')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();

            // Indexes for better query performance
            $table->index('film_title');
            $table->index('release_year');
            $table->index('director');
            $table->index('genre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
