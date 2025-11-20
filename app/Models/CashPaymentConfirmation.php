<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashPaymentConfirmation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'invoice_id',
        'bank_receipt_file',
        'ooc_receipt_file',
        'ooc_receipt_number',
        'payment_date',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'payment_date' => 'date',
    ];

    /**
     * Relationship: A payment confirmation belongs to an invoice.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
