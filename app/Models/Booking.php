<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    const PAYMENT_UNPAID = 'unpaid';
    const PAYMENT_SETTLEMENT = 'fully_paid';
    const PAYMENT_EXPIRED = 'expired';
    const PAYMENT_FAILED = 'failed';

    protected $fillable = [
        'booking_code',
        'client_id',
        'service_id',
        'package_id',
        'team_member_id',
        'booking_date',
        'booking_time',
        'location_type',
        'location_address',
        'total_price',
        'admin_fee',
        'status',
        'payment_status',
        'production_progress',
        'notes',
        'confirmed_at',
        'completed_at',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'booking_time' => 'datetime:H:i:s',
        'total_price' => 'decimal:2',
        'admin_fee' => 'decimal:2',
        'confirmed_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(ServicePackage::class);
    }

    public function teamMember(): BelongsTo
    {
        return $this->belongsTo(TeamMember::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByDate($query, $date)
    {
        return $query->whereDate('booking_date', $date);
    }

    public function isConfirmed()
    {
        return $this->status === 'confirmed';
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }
}
