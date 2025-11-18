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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->decimal('unit_price', 10, 2)->default(0.00); //snapshot of activity cost at time of invoicing
            $table->integer('quantity')->default(1);
            $table->decimal('total', 10, 2)->default(0.00);

            //$table->unsignedBigInteger('invoice_id');
            //$table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');

            //$table->unsignedBigInteger('prescribed_activity_id');
            //$table->foreign('prescribed_activity_id')->references('id')->on('prescribed_activities')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
