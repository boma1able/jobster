<?php

namespace App\Livewire\Dashboard\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public function redirectToEdit($id)
    {
        return $this->redirectRoute('dashboard.products.manage', ['id' => $id], navigate: true);
    }

    public function delete($id)
    {
        Product::destroy($id);
        $this->dispatch('showToast', message: 'Product deleted!');
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::latest()->paginate(10);
        return view('livewire.dashboard.products.products', [
            'products' => $products
        ]);
    }
}
