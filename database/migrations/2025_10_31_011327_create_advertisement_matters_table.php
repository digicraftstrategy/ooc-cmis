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
        Schema::create('advertisement_matters', function (Blueprint $table) {
            $table->id();
            $table->string('advertising_matter');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('casts')->nullable();
            $table->string('director')->nullable();
            $table->string('producer')->nullable();
            $table->string('production_company')->nullable();
            $table->string('client_company')->nullable(); // Company for whom the advertisement is made
            $table->year('release_year')->nullable();
            $table->integer('duration'); // duration in seconds
            $table->string('genre')->nullable();
            $table->string('language')->nullable();
            $table->boolean('has_subtitle')->default(false);
            $table->string('brand_promoted')->nullable(); // Brand being promoted in the advertisement
            $table->string('product_promoted')->nullable(); // Product being promoted in the advertisement
            $table->text('theme')->nullable();
            $table->string('poster_path')->nullable(); // path to the advertisement poster image
            $table->boolean('has_classified')->default(false);
            $table->timestamps();

            // Indexes for better query performance
            $table->index('advertising_matter');
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
        Schema::dropIfExists('advertisement_matters');
    }
};
