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
        Schema::create('video_games', function (Blueprint $table) {
            $table->id();
            $table->string('video_game_title');
            $table->string('slug')->unique();
            $table->string('main_characters')->nullable();
            $table->string('developer')->nullable();
            $table->string('publisher')->nullable();
            $table->year('release_year')->nullable();
            $table->date('release_date')->nullable();
            $table->string('genre')->nullable();
            $table->string('platform')->nullable();
            $table->integer('average_playtime')->nullable(); // in hours
            $table->enum('game_mode', ['Single-player', 'Multi-player', 'Both'])->nullable();
            $table->string('language')->nullable();
            $table->boolean('has_subtitle')->default(false);
            $table->string('cover_art_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_games');
    }
};
