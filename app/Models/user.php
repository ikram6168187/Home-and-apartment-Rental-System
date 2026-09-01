<?php

namespace App\Models;
use App\Models\Blog;
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
        'otp',
        'otp_expires_at',
        'provider',
        'provider_id',
    ];

    protected $attributes = [
        'role' => 'user',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'otp_expires_at'    => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function properties() { return $this->hasMany(Property::class); }
    public function bookings() { return $this->hasMany(Booking::class); }
    public function notifications() { return $this->hasMany(Notification::class); }

    public function serviceRequests()
{
    return $this->hasMany(ServiceRequest::class);
}
public function blogs()
{
    return $this->hasMany(Blog::class);
}

}