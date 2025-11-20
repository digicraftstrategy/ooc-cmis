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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade');
            $table->foreignId('payment_method_id')->constrained('payment_methods')->onDelete('cascade');
           //$table->string('payment_reference')->unique();
            $table->string('bank_receipt_file'); // Store path of the uploaded bank receipt
            $table->string('ooc_receipt_file'); // Store path of the uploaded OOC receipt
            $table->string('ooc_receipt_number')->unique(); // Unique OOC receipt number to identify the OOC receipt from the uploaded ooc receipt file
            $table->decimal('amount', 10, 2)->default(0.00); // Payment amount from the Invoice
            $table->date('payment_date');
            $table->enum('status', ['pending', 'confirmed', 'failed'])->default('pending'); // When the payment is confimed here, the invocie status automatically change to paid, otherwise it will remain pending
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
