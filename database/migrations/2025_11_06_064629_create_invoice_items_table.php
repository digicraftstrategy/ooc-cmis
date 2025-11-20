<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('invoice_id')
                ->constrained('invoices')
                ->cascadeOnDelete();

            // Ties this line to a PrescribedActivity (fee schedule)
            $table->foreignId('prescribed_activity_id')->constrained('prescribed_activities')->restrictOnDelete();

            // (NEW) Optional classification item per line
            $table->foreignId('classification_item_id')->nullable()->constrained('classifications')->nullOnDelete();

            $table->string('description');
            $table->integer('quantity')->default(1);
            $table->decimal('unit_amount', 10, 2);
            $table->decimal('line_total', 10, 2);

            $table->timestamps();

            $table->index('invoice_id');
            $table->index('prescribed_activity_id');
            $table->index('classification_item_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
