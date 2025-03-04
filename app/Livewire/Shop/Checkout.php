<?php

namespace App\Livewire\Shop;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Checkout extends Component
{
    public $cart = [];
    public $billing = [
        'name' => '',
        'email' => '',
        'address' => '',
        'city' => '',
        'zip' => '',
        'country' => '',
    ];

    public function mount()
    {
        $this->cart = session()->get('cart', []);
    }

    public function placeOrder()
    {
        $this->validate([
            'billing.name' => 'required',
            'billing.email' => 'required|email',
            'billing.address' => 'required',
            'billing.city' => 'required',
            'billing.zip' => 'required',
            'billing.country' => 'required',
        ]);

        if (empty($this->cart)) {
            session()->flash('error', 'Cart is empty.');
            return;
        }

        $products = json_encode($this->cart ?? []);

        $order = Order::create([
            'user_id' => auth()->id(),
            'customer_name' => $this->billing['name'],
            'customer_email' => $this->billing['email'],
            'customer_address' => $this->billing['address'],
            'customer_city' => $this->billing['city'],
            'customer_zip' => $this->billing['zip'],
            'customer_country' => $this->billing['country'],
            'total' => $this->getTotalAmount(),
            'products' => $products,
        ]);

        foreach ($this->cart as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'description' => $item['description'] ?? null,
                'image' => $item['image'] ?? null,
                'total' => $item['price'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');
        $this->cart = [];

        session()->flash('success', 'Замовлення оформлено успішно!');
    }


    public function getTotalAmount()
    {
        return collect($this->cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    public function render()
    {
        return view('livewire.shop.checkout');
    }
}
