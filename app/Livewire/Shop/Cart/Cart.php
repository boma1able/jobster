<?php

namespace App\Livewire\Shop\Cart;

use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public $cart = [];

    public function mount()
    {
        $this->cart = session()->get('cart', []);
    }

    protected $listeners = ['addToCart' => 'handleAddToCart'];

    public function handleAddToCart($productId, $quantity)
    {
        $cart = session()->get('cart', []);
        $product = Product::find($productId);

        if (!$product) {
            return;
        }

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'product_id' => $productId,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'description' => $product->description,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);
        $this->cart = $cart;
    }


    public function getTotalAmount()
    {
        $total = 0;

        foreach ($this->cart as $item) {
            $product = Product::find($item['product_id']);
            $total += $product->price * $item['quantity'];
        }

        return $total;
    }

    public function removeItem($productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);

        session()->put('cart', $cart);
        $this->cart = session()->get('cart');
        $this->dispatch('cartUpdated');
    }

    public function clearCart()
    {
        session()->forget('cart');
        $this->dispatch('cartUpdated');
        $this->cart = [];
    }

    public function render()
    {
        return view('livewire.shop.cart');
    }
}

