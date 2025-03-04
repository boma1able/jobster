<?php

namespace App\Livewire\Shop;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.dashboard.products.orders', [
            'orders' => Order::paginate(1)
        ]);
    }
}
