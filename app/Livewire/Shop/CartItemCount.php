<?php

namespace App\Livewire\Shop;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class CartItemCount extends Component
{
    public $itemCount = 0;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $this->itemCount = $this->getCartItemCount();
    }

    public function updateCartCount()
    {
        $this->itemCount = $this->getCartItemCount();
    }

    public function getCartItemCount()
    {
        $cart = Session::get('cart', []);
        $count = 0;

        foreach ($cart as $item) {
            $count += $item['quantity'];
        }

        return $count;
    }

    public function render()
    {
        return view('livewire.shop.cart-item-count');
    }
}

