<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'package_id',
        'name',
        'price',
        'quantity',
        'subtotal',
        'color'
    ];

    // 🔗 Item → Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // 🔗 Item → Product (optional)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // 🔗 Item → Package (optional)
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function orderItems()
    {
        return $this->hasMany(\App\Models\OrderItem::class);
    }
}
