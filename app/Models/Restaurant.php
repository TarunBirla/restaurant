<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'email',
        'slug',
        'phone',
        'location',
        'latitude',
        'longitude',
        'description',
        'image',
        'status',
        'dine_in',
        'home_delivery',
        'transactworld_member_id',
        'transactworld_account_id',
        'transactworld_terminal_id',
        'transactworld_checksum_key',
        'transactworld_mode'
    ];


    public function users()
    {
        return $this->hasMany(User::class);
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function getQrUrlAttribute()
    {
        return route('restaurant.products', $this->slug);
    }
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
    public function featuredOffer()
    {
        return $this->hasOne(Offer::class)
            ->where('is_active', 1)
            ->where('is_featured', 1)
            ->latest();
    }
    public function reviews()
{
    return $this->hasMany(\App\Models\Review::class);
}
}
