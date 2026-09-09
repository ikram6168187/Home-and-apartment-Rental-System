<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'booking_id',
        'user_id',
        'amount',
        'payment_method',
        'transaction_id',
        'payment_proof',
        'status',
        'verified_by',
        'verified_at',
        'rejection_reason',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'verified_at' => 'datetime',
    ];

    // Payment kis booking ki hai
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    // Payment kis user ne submit ki
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Payment kis owner/admin ne verify ki
    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}