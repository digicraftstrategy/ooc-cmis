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
            $table->string('second_opinion_by')->nullable();
            $table->text('notes')->nullable();

            $table->string('classifiable_type');

            $table->unsignedBigInteger('classifiable_id');

            $table->unsignedBigInteger('classification_rating_id');
            $table->foreign('classification_rating_id')->references('id')->on('classification_ratings')->onDelete('cascade');

            $table->unsignedBigInteger('classification_category_id');
            $table->foreign('classification_category_id')->references('id')->on('classification_categories')->onDelete('cascade');

            $table->unsignedBigInteger('classification_status_id');
            $table->foreign('classification_status_id')->references('id')->on('classification_statuses')->onDelete('cascade');
            $table->timestamps();

            // Index for polymorphic relation
            $table->index('classifiable_id', 'classification_type_id');
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
