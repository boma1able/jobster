<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['name', 'description', 'price', 'image', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product_categories()
    {
        return $this -> belongsToMany(ProductCategory::class, 'category_product');
    }
}
