<div>
    <input type="number" wire:model="quantity" min="1" max="99" class="border p-2 w-16">
    <button wire:click="addToCart" class="bg-gray-800 text-white px-4 py-2 border border-gray-800">Add to Cart</button>

    @if (session()->has('message'))
        <p class="text-green-500 text-xs">{{ session('message') }}</p>
    @endif
</div>
