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
        Schema::create('prescribed_activities', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('activity_type')->unique();
            $table->decimal('prescribed_fee', 8, 2)->default(0.00);
            //$table->string('description')->nullable();
            $table->boolean('is_active')->default(true);

            $table->unsignedBigInteger('prescribed_activity_type_id');
            $table->foreign('prescribed_activity_type_id')->references('id')->on('prescribed_activity_types')->onDelete('cascade');
            $table->timestamps();
           // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescribed_activities');
    }
};
