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
            $table->string('main_actor_actress')->nullable();
            $table->string('director')->nullable();
            $table->string('producer')->nullable();
            $table->string('production_company')->nullable();
            $table->year('release_year')->nullable();
            $table->string('genre')->nullable();
            $table->string('language')->nullable();
            $table->integer('duration');
            $table->enum('subtitle', ['Yes', 'No'])->nullable();
            $table->text('theme')->nullable();

            $table->foreignId('film_type_id')->constrained('film_types')->onDelete('cascade');
            $table->timestamps();
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
