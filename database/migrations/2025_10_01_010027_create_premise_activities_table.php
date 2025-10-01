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
        Schema::create('premise_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prescribed_activity_id')->nullable();
            $table->foreign('prescribed_activity_id')->references('id')->on('prescribed_activities')->onDelete('cascade');

            $table->unsignedBigInteger('premises_id')->nullable();
            $table->foreign('premises_id')->references('id')->on('premises')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['prescribed_activity_id', 'premises_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premise_activities');
    }
};
