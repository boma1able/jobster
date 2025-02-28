<div>
    @if (!empty($cart))
        @foreach ($cart as $item)
            <div>
                <p>Product ID: {{ $item['product_id'] }} - Quantity: {{ $item['quantity'] }}</p>
                <button wire:click="removeItem({{ $item['product_id'] }})">Remove</button>
            </div>
        @endforeach
    @else
        <p>Your cart is empty.</p>
    @endif

    Total amount: ${{ $this->getTotalAmount() }}
        <br>

    <button wire:click="clearCart">Clear Cart</button>


    <a href="/checkout">Proceed to Checkout</a>
</div>



