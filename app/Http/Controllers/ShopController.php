<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(8);

        return view('shop.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }

    public function cart()
    {
        return view('shop.cart');
    }

}
