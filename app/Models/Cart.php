<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'guest_token',
        'product_id',
        'size',
        'quantity',
        'price',
        'total',
    ];

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }
}