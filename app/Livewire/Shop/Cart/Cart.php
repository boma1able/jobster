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

        // Якщо товар вже є в кошику, збільшуємо кількість
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'product_id' => $productId,
                'quantity' => $quantity,
            ];
        }

        // Оновлюємо кошик в сесії
        session()->put('cart', $cart);
        $this->cart = session()->get('cart'); // Оновлюємо кошик з сесії
    }

    public function getTotalAmount()
    {
        $total = 0;

        foreach ($this->cart as $item) {
            $product = Product::find($item['product_id']); // знаходимо продукт за ID
            $total += $product->price * $item['quantity']; // додаємо до загальної суми
        }

        return $total;
    }

    public function removeItem($productId)
    {
        // Видаляємо товар з кошика за ID
        $cart = session()->get('cart', []);
        unset($cart[$productId]);

        // Оновлюємо кошик в сесії
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

