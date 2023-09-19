<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Cart;

class Product extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image',
        'status',
        'stock',

    ];
    public function orderItem(){
        return $this->hasMany(OrderItem::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function cart(){
        return $this->hasMany(Cart::class);
    }
}
