<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    use HasFactory;

    const TYPE_FULL = 'full_payment';

    const STATUS_PENDING = 'pending';
    const STATUS_SETTLEMENT = 'settlement';
    const STATUS_FAILED = 'failed';
    const STATUS_EXPIRE = 'expire';
    const STATUS_CANCEL = 'cancel';
    const STATUS_REFUNDED = 'refunded';

    protected $fillable = [
        'booking_id',
        'payment_method_id',
        'external_id',
        'snap_token',
        'payment_url',
        'amount',
        'admin_fee',
        'payment_type',
        'status',
        'notes',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'admin_fee' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function scopeSettlement($query)
    {
        return $query->where('status', self::STATUS_SETTLEMENT);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }
}
