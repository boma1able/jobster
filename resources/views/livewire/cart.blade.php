<div>
    <h2>Кошик</h2>
    <ul>
        @foreach($cart as $id => $item)
            <li>
                {{ $item['name'] }} - {{ $item['price'] }} грн × {{ $item['quantity'] }}
                <button wire:click="removeFromCart({{ $id }})">Видалити</button>
            </li>
        @endforeach
    </ul>
</div>
