<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'prescribed_activity_id',
        'classification_item_id',
        'description',
        'quantity',
        'unit_amount',
        'line_total',
    ];

    protected $casts = [
        'quantity'    => 'integer',
        'unit_amount' => 'decimal:2',
        'line_total'  => 'decimal:2',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function prescribedActivity(): BelongsTo
    {
        return $this->belongsTo(PrescribedActivity::class, 'prescribed_activity_id');
    }

    public function classificationItem(): BelongsTo
    {
        return $this->belongsTo(Classification::class, 'classification_item_id');
    }

    public function recalculateLineTotal(): void
    {
        $qty  = $this->quantity ?? 0;
        $unit = $this->unit_amount ?? 0;

        $this->line_total = $qty * $unit;
    }
}
