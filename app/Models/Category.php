<?php
namespace App\Models;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'status', 'image',
    ];

    // Category → Subcategories
    public function subcategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }

    // Products directly under category
    public function directProducts()
    {
        return $this->hasMany(Product::class, 'category_id')
                    ->whereNull('subcategory_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
    // Products inside subcategories
    public function subcategoryProducts()
    {
        return $this->hasManyThrough(
            Product::class,
            SubCategory::class,
            'category_id',   // foreign key on subcategories table
            'subcategory_id' // foreign key on products table
        );
    }

    // ✅ All products (direct + subcategories)
    public function allProducts()
    {
        return Product::where('category_id', $this->id)
                      ->orWhereIn('subcategory_id', $this->subcategories()->pluck('id'))
                      ->get();
    }
}
