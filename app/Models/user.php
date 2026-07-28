<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];


    protected $attributes = [
        'role' => 'user',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // User ki properties
    public function properties()
    {
        return $this->hasMany(Property::class);
    }


    // User ki bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


    // User ki notifications
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}