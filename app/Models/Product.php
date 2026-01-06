<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','subcategory_id', 'category_id' ,'slug','description','price','weight','sku','offer_price','stock','status', 'rating'
    ];

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function default_image()
    {
        return $this->hasOne(ProductImage::class)->where('is_default', true);
    }
    

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id')->withDefault();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    
    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

}