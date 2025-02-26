<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public $cart = [];

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        $this->cart[$productId] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => ($this->cart[$productId]['quantity'] ?? 0) + 1
        ];
    }

    public function removeFromCart($productId)
    {
        unset($this->cart[$productId]);
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
