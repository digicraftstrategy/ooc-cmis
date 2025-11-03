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
        Schema::create('premises_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('premises_id')->constrained('premises')->onDelete('cascade');
            $table->foreignId('activity_id')->constrained('prescribed_activities')->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['premises_id', 'activity_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premises_activities');
    }
};
