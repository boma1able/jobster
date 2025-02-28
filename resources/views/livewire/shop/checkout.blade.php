<div>
    <input type="text" wire:model="name" placeholder="Ваше ім'я">
    <input type="email" wire:model="email" placeholder="Ваш email">
    <button wire:click="placeOrder">Оформити замовлення</button>
    @if(session()->has('message'))
        <p>{{ session('message') }}</p>
    @endif
</div>
