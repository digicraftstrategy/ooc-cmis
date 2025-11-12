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
        Schema::create('tv_serieses', function (Blueprint $table) {
            $table->id();
            $table->string('tv_series_title');
            $table->string('slug')->unique();
            //$table->integer('season_number'); ---> moved to seasons table
            //$table->string('season_title')->nullable(); ---> moved to seasons table
           // $table->string('number_of_episodes')->nullable();  // total number of episodes in the season
            //$table->string('episode_title'); --> moved to episodes table
            //$table->integer('duration'); // duration in minutes of the episode --> moved to seasons table
            $table->year('release_year')->nullable();
            $table->string('casts')->nullable();
            $table->string('director')->nullable();
            $table->string('producer')->nullable();
            $table->string('production_company')->nullable();
            $table->string('genre')->nullable();
            $table->string('language')->nullable();
            $table->boolean('has_subtitle')->default(false);
            $table->text('theme')->nullable();
            $table->string('poster_path')->nullable(); // path to the tv series poster image
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
        Schema::dropIfExists('tv_serieses');
    }
};
