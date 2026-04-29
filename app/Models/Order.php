<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'note',
        'total_amount',
        'payment_method',
        'status'
    ];

    // 🔗 Order → Items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // 🔗 Order → User (optional)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
