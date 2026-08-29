<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'user_id', 'title', 'type', 'price',
        'location', 'city', 'address', 'description',
        'bedrooms', 'bathrooms', 'area_sqft', 'image', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // average nikalne ka helper
    public function getAvgRatingAttribute()
    {
        return $this->ratings()->avg('stars');
    }

    public function getRatingCountAttribute()
    {
        return $this->ratings()->count();
    }
}