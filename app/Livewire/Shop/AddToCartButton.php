<?php

namespace App\Livewire\Shop;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AddToCartButton extends Component
{
    public $productId;
    public $quantity = 1;

    public function addToCart()
    {
        $cart = Session::get('cart', []);
        $product = Product::find($this->productId);

        if (!$product) {
            return;
        }

        if (isset($cart[$this->productId])) {
            $cart[$this->productId]['quantity'] += $this->quantity;
        } else {
            $cart[$this->productId] = [
                'product_id' => $this->productId,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'description' => $product->description,
                'quantity' => $this->quantity,
            ];
        }

        Session::put('cart', $cart);
        $this->dispatch('cartUpdated');
        session()->flash('message', 'Product added to cart!');
    }


    public function render()
    {
        return view('livewire.shop.add-to-cart-button');
    }
}
