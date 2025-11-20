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
        Schema::create('cash_payment_confirmations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade');
            $table->string('bank_receipt_file'); // Store path of the uploaded bank receipt
            $table->string('ooc_receipt_file'); // Store path of the uploaded OOC receipt
            $table->string('ooc_receipt_number')->unique(); // Unique OOC receipt number to identify the OOC receipt from the uploaded ooc receipt file
            $table->date('payment_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_payment_confirmations');
    }
};
