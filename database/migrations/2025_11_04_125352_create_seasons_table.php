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
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tv_series_id')->constrained('tv_serieses')->onDelete('cascade');
            $table->string('season_title');
            $table->string('slug')->unique();
            $table->integer('season_number');
            $table->string('number_of_episodes');
            $table->integer('duration'); // average duration in minutes of all episodes of the season
            $table->year('release_year')->nullable();
            $table->string('casts')->nullable();
            $table->string('director')->nullable();
            $table->string('producer')->nullable();
            $table->string('production_company')->nullable();
            $table->string('genre')->nullable();
            $table->string('language')->nullable();
            $table->boolean('has_subtitle')->default(false);
            $table->text('theme')->nullable();
            $table->string('poster_path')->nullable();
            //$table->string('theme')->nullable(); // summarized theme of all episode of the season
            $table->timestamps();

            // Indexes for better query performance
            $table->index('tv_series_title');
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
        Schema::dropIfExists('seasons');
    }
};
