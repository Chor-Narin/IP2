<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'pricing',
        'description',
        'images',

    ];
    // Cast the 'images' column to JSON (Laravel automatically converts it)
    protected $casts = [
        // 'images' => 'array'
    ];
    // Define relationship with Category model
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
