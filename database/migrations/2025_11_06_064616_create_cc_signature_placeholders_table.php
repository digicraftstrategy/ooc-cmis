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
        Schema::create('cc_signature_placeholders', function (Blueprint $table) {
            $table->id();
            $table->enum('title', ['Mr', 'Mrs', 'Ms']);
            $table->string('name');
            $table->string('signature_placeholder');
            $table->string('designation');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cc_signature_placeholders');
    }
};
