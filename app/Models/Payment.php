<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'invoice_id',
        'payment_method_id',
        'bank_receipt_file',
        'ooc_receipt_file',
        'ooc_receipt_number',
        'amount',
        'payment_date',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'payment_date' => 'date',
        'amount' => 'decimal:2',
        'status' => 'string',
    ];

    /**
     * The possible payment status values.
     *
     * @var array<string>
     */
    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_FAILED = 'failed';

    /**
     * Get the invoice that the payment belongs to.
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Get the payment method associated with the payment.
     */
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Scope a query to only include pending payments.
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope a query to only include confirmed payments.
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', self::STATUS_CONFIRMED);
    }

    /**
     * Scope a query to only include failed payments.
     */
    public function scopeFailed($query)
    {
        return $query->where('status', self::STATUS_FAILED);
    }

    /**
     * Check if the payment is pending.
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if the payment is confirmed.
     */
    public function isConfirmed(): bool
    {
        return $this->status === self::STATUS_CONFIRMED;
    }

    /**
     * Check if the payment is failed.
     */
    public function isFailed(): bool
    {
        return $this->status === self::STATUS_FAILED;
    }

    /**
     * Get the formatted amount with currency symbol.
     */
    public function getFormattedAmountAttribute(): string
    {
        // You can customize the currency based on your application needs
        return 'K' . number_format($this->amount, 2);
    }

    /**
     * Get the bank receipt file URL.
     */
    public function getBankReceiptUrlAttribute(): ?string
    {
        return $this->bank_receipt_file ? asset('storage/' . $this->bank_receipt_file) : null;
    }

    /**
     * Get the OOC receipt file URL.
     */
    public function getOocReceiptUrlAttribute(): ?string
    {
        return $this->ooc_receipt_file ? asset('storage/' . $this->ooc_receipt_file) : null;
    }

    /**
     * Boot the model and register event listeners.
     */
    protected static function boot()
    {
        parent::boot();

        // When a payment is confirmed, update the related invoice status to paid
        static::updated(function ($payment) {
            if ($payment->isDirty('status') && $payment->isConfirmed()) {
                $payment->invoice()->update(['status' => \App\Models\Invoice::STATUS_PAID]);
            }
            
            // If payment status changes from confirmed to something else, revert invoice status
            if ($payment->isDirty('status') && 
                $payment->getOriginal('status') === self::STATUS_CONFIRMED && 
                !$payment->isConfirmed()) {
                $payment->invoice()->update(['status' => \App\Models\Invoice::STATUS_PENDING]);
            }
        });

        // When a payment is created, ensure the invoice status is in sync
        static::created(function ($payment) {
            if ($payment->isConfirmed()) {
                $payment->invoice()->update(['status' => \App\Models\Invoice::STATUS_PAID]);
            }
        });
    }
}