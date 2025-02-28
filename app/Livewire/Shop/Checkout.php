<?php

namespace App\Livewire\Shop;

use App\Models\Order;
use Livewire\Component;

class Checkout extends Component
{
    public $name, $email, $cart;

    public function mount($cart)
    {
        $this->cart = $cart;
    }

    public function placeOrder()
    {
        Order::create([
            'products' => json_encode($this->cart),
            'customer_name' => $this->name,
            'customer_email' => $this->email
        ]);

        session()->flash('message', 'Замовлення оформлене!');
        $this->cart = [];
    }

    public function render()
    {
        return view('livewire.shop.checkout');
    }
}
