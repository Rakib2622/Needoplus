<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'images',   // ✅ add
        'colors',   // ✅ add
        'is_active'
    ];

    protected $casts = [
        'colors' => 'array',
        'images' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getFinalPriceAttribute()
{
    $price = $this->price;

    $discount = \App\Models\Discount::getApplicableDiscount($this);

    if (!$discount) return $price;

    if ($discount->discount_type == 'percent') {
        $finalPrice = $price - ($price * $discount->value / 100);
    } else {
        $finalPrice = $price - $discount->value;
    }

    return max(0, $finalPrice); // ✅ here
}

public function getDiscountAmountAttribute()
{
    return max(0, $this->price - $this->final_price);
}

public function getDiscountPercentAttribute()
{
    if ($this->price <= 0) return 0;

    return round((($this->price - $this->final_price) / $this->price) * 100);
}
}
