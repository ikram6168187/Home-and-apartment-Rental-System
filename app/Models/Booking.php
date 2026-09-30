<?php

namespace App\Models;
use App\Models\Payment;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // Jin statuses par property ki dates block hoti hain
    public const BLOCKING_STATUSES = ['approved', 'payment_submitted', 'confirmed'];

    protected $fillable = [
        'property_id',
        'user_id',
        'check_in',
        'check_out',
        'guests',
        'message',
        'status',
    ];

    protected $casts = [
        'check_in'  => 'date',
        'check_out' => 'date',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    // Sirf woh bookings jo dates block karti hain
    public function scopeBlocking($query)
    {
        return $query->whereIn('status', self::BLOCKING_STATUSES);
    }

    // Dates overlap check (check-out wale din dusra check-in ho sakta hai)
    public function scopeOverlapping($query, $checkIn, $checkOut)
    {
        return $query->where('check_in', '<', $checkOut)
                     ->where('check_out', '>', $checkIn);
    }

    // Pending booking jis ki dates kisi aur ne approve/confirm karva li hon
    public function getIsUnavailableAttribute(): bool
    {
        if ($this->status !== 'pending') {
            return false;
        }

        return static::where('property_id', $this->property_id)
                     ->where('id', '!=', $this->id)
                     ->blocking()
                     ->overlapping($this->check_in, $this->check_out)
                     ->exists();
    }
}