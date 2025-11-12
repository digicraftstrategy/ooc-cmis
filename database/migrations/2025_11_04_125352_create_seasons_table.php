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
            $table->string('theme')->nullable(); // summarized theme of all episode of the season
            $table->timestamps();
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
