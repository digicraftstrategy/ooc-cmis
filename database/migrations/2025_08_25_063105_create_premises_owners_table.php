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
        Schema::create('premises_owners', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('owners_name');
            $table->string('phone')->nullable();
            $table->longText('address')->nullable();
            $table->string('email')->unique();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();

            $table->unsignedBigInteger('premises_owner_type_id');
            $table->foreign('premises_owner_type_id')->references('id')->on('premises_owner_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premises_owners');
    }
};
