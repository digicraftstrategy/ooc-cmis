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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->date('invoice_date');
            $table->date('due_date');
            $table->decimal('amount', 10,2)->default(0.00); // This amount will come from the amount from the activity using the foreign key reference
            $table->decimal('subtotal', 10, 2)->default(0.00); // This is the total after calculating from the amount
            $table->decimal('tax', 10, 2)->default(0.00); // Tax
            $table->decimal('total', 10, 2)->default(0.00); // Amount after tax

            $table->string('billing_email'); // Can come from the premsies if no new email if provided
            $table->string('billing_address')->nullable(); // Can come from premsiess if no new address is provided

            $table->enum('status', ['pending', 'paid', 'cancelled','overdue'])->default('pending');
            $table->text('notes')->nullable();

            $table->unsignedBigInteger('premises_id');
            $table->foreign('premises_id')->references('id')->on('premises')->onDelete('cascade');

            $table->unsignedBigInteger('activity_id');
            $table->foreign('activity_id')->references('id')->on('premises_activities')->onDelete('cascade');

            $table->unsignedBigInteger('classification_item_id');
            $table->foreign('classification_item_id')->references('id')->on('classifications')->cascadeOnDelete();
            $table->timestamps();

            //$table->index(['premises_id', 'activity_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
