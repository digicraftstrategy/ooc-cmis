<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->string('invoice_number')->unique();
            $table->date('invoice_date');
            $table->date('due_date');

            // Explicit type: premises | classification
            $table->enum('invoice_type', ['premises', 'classification']);

            $table->decimal('subtotal', 10, 2)->default(0.00);
            $table->decimal('tax', 10, 2)->default(0.00);
            $table->decimal('total', 10, 2)->default(0.00);

            $table->string('billing_email')->nullable();
            $table->string('billing_address')->nullable();

            $table->enum('status', ['pending', 'paid', 'cancelled', 'overdue'])
                  ->default('pending');

            $table->text('notes')->nullable();

            // Who is billed
            $table->foreignId('owner_id')
                ->constrained('premises_owners')
                ->cascadeOnDelete();

            // Premises invoice (registration/renewal)
            $table->foreignId('premises_id')
                ->nullable()
                ->constrained('premises')
                ->nullOnDelete();

            // NOTE: no classification_item_id here anymore

            $table->timestamps();

            $table->index('status');
            $table->index('owner_id');
            $table->index('premises_id');
            $table->index('invoice_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
