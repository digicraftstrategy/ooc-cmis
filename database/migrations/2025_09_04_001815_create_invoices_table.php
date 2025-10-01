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
            $table->decimal('subtotal', 10, 2)->default(0.00);
            $table->decimal('tax', 10, 2)->default(0.00);
            $table->decimal('total', 10, 2)->default(0.00);
            $table->enum('status', ['pending', 'paid', 'cancelled','overdue'])->default('pending');
            $table->text('notes')->nullable();

            $table->unsignedBigInteger('premises_id');
            $table->foreign('premises_id')->references('id')->on('premises')->onDelete('cascade');

            //$table->unsignedBigInteger('activity_id');
            //$table->foreign('activity_id')->references('id')->on('premises_activities')->onDelete('cascade');
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
