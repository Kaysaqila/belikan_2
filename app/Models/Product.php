<?php

namespace App\Models;

use App\Models\User;
use App\Models\Review;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = ['seller_id', 'name', 'category_id', 'price', 'stock', 'description', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function order_item()
    {
        return $this->hasMany(OrderItem::class);
    }
}
