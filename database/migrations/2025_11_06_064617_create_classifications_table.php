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
        Schema::create('classifications', function (Blueprint $table) {
            $table->id();

            $table->string('classification_reason')->nullable();
            $table->date('classification_date')->nullable();
            $table->string('viewed_by')->nullable();
            $table->boolean('is_second_opinion')->default(false);
            $table->string('second_opinion_by')->nullable();
            $table->enum('classification_status', ['Approved', 'Rejected'])->default('Approved');
            $table->text('notes')->nullable();

            // Polymorphic relation: creates classifiable_id + classifiable_type (+ index)
            $table->morphs('classifiable');

            //  Enforce only ONE classification per classifiable (Film, Season, etc.)
            $table->unique(['classifiable_id', 'classifiable_type']);

            // Foreign keys to parent tables
            $table->foreignId('classification_rating_id')
                  ->constrained('classification_ratings')
                  ->cascadeOnDelete();

            $table->foreignId('classification_category_id')
                  ->constrained('classification_categories')
                  ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classifications');
    }
};
