<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name',
        'discount_type',
        'value',
        'is_active'
    ];

    
    protected $appends = ['total_product_price', 'final_price'];

    // 🔗 RELATION
    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('quantity');
    }

    // 🧮 TOTAL PRODUCTS PRICE (AFTER PRODUCT DISCOUNT)
    public function getTotalProductPriceAttribute()
    {
        $this->load('products');
        return $this->products->sum(function ($product) {
            return $product->final_price * $product->pivot->quantity;
        });
    }

    // 💰 PACKAGE FINAL PRICE (AFTER PACKAGE DISCOUNT)
    public function getFinalPriceAttribute()
    {
        $total = $this->total_product_price;

        if (!$this->discount_type || !$this->value) {
            return $total;
        }

        if ($this->discount_type === 'percent') {
            return $total - ($total * $this->value / 100);
        }

        return max(0, $total - $this->value);
    }
}