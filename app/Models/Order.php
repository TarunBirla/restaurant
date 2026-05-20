<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'restaurant_id',
        'total_amount',
        'order_type',

        'address',
        'phone',
        'pincode',

        'payment_method',
        'status',
        'stuart_job_id',
        'tracking_url',
        'delivery_status',
        'driver_name',
        'driver_phone',
        'driver_id',
        'picked_at',
        'delivered_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    public function review()
{
    return $this->hasOne(\App\Models\Review::class);
}
    
}