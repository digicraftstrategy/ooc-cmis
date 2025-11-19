<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    public const STATUS_PENDING   = 'pending';
    public const STATUS_PAID      = 'paid';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_OVERDUE   = 'overdue';

    public const TYPE_PREMISES       = 'premises';
    public const TYPE_CLASSIFICATION = 'classification';

    protected $fillable = [
        'invoice_number',
        'invoice_date',
        'due_date',
        'invoice_type',
        'subtotal',
        'tax',
        'total',
        'billing_email',
        'billing_address',
        'status',
        'notes',
        'owner_id',
        'premises_id',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date'     => 'date',
        'subtotal'     => 'decimal:2',
        'tax'          => 'decimal:2',
        'total'        => 'decimal:2',
    ];

    protected $appends = [
        'type',
        'is_overdue',
        'balance',
    ];

    // Relationships
    public function owner(): BelongsTo
    {
        return $this->belongsTo(PremisesOwner::class, 'owner_id');
    }

    public function premises(): BelongsTo
    {
        return $this->belongsTo(PublicationPremises::class, 'premises_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    // Scopes
    public function scopePaid($q)      { return $q->where('status', self::STATUS_PAID); }
    public function scopePending($q)   { return $q->where('status', self::STATUS_PENDING); }
    public function scopeCancelled($q) { return $q->where('status', self::STATUS_CANCELLED); }
    public function scopeOverdue($q)   { return $q->where('status', self::STATUS_OVERDUE); }

    public function scopePremises($q)       { return $q->where('invoice_type', self::TYPE_PREMISES); }
    public function scopeClassification($q) { return $q->where('invoice_type', self::TYPE_CLASSIFICATION); }

    // Accessors
    public function getTypeAttribute(): ?string
    {
        return $this->invoice_type;
    }

    public function getIsOverdueAttribute(): bool
    {
        if (! $this->due_date || $this->status === self::STATUS_PAID) {
            return false;
        }

        return $this->due_date->isPast();
    }

    public function getBalanceAttribute(): string
    {
        if ($this->status === self::STATUS_PAID) {
            return number_format(0, 2, '.', '');
        }

        return number_format($this->total ?? 0, 2, '.', '');
    }

    // Domain logic
    public function markAsPaid(): void
    {
        $this->status = self::STATUS_PAID;
        $this->save();
    }

    public function markAsCancelled(): void
    {
        $this->status = self::STATUS_CANCELLED;
        $this->save();
    }

    public function refreshTotalsFromItems(): void
    {
        if (! $this->relationLoaded('items')) {
            $this->load('items');
        }

        $subtotal = $this->items->sum('line_total');

        $this->subtotal = $subtotal;
        $this->total    = $subtotal + ($this->tax ?? 0);

        $this->save();
    }
}
