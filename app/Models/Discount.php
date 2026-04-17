<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'name',
        'type',
        'category_id',
        'product_id',
        'discount_type',
        'value',
        'image',
        'start_date',
        'end_date',
        'is_active'
    ];

    public static function getApplicableDiscount($product)
{
    $now = now();

    // 1. Product discount
    $discount = self::where('type', 'product')
        ->where('product_id', $product->id)
        ->where('is_active', true)
        ->where(function ($q) use ($now) {
            $q->whereNull('start_date')->orWhere('start_date', '<=', $now);
        })
        ->where(function ($q) use ($now) {
            $q->whereNull('end_date')->orWhere('end_date', '>=', $now);
        })
        ->first();

    if ($discount) return $discount;

    // 2. Category discount
    $discount = self::where('type', 'category')
        ->where('category_id', $product->category_id)
        ->where('is_active', true)
        ->first();

    if ($discount) return $discount;

    // 3. Global discount
    return self::where('type', 'global')
        ->where('is_active', true)
        ->first();
}

public function category()
{
    return $this->belongsTo(\App\Models\Category::class);
}

public function product()
{
    return $this->belongsTo(\App\Models\Product::class);
}
}