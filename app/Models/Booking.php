<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
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

    // Booking kis property ki hai
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // Booking kisne ki
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
