<?php

namespace App\Livewire\Dashboard\Products;

use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;

class ManageProduct extends Component
{
    public ?int $id = null;
    public $name, $price, $description, $selectedCategories = [];
    public $isEditing = false;


    public function mount($id = null)
    {
        if ($id) {
            $this->edit($id);
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->id = $id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->description = $product->description;
        $this->selectedCategories = $product->product_categories->pluck('id')->toArray();
        $this->isEditing = true;
    }

    public function store()
    {
        $this->validate([
            'name'         => 'required|min:2',
            'price'         => 'required|numeric|min:0',
            'description'   => 'required',
        ]);

        $product = Product::updateOrCreate(['id' => $this->id], [
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
        ]);

        $product->product_categories()->sync($this->selectedCategories);

        $message = $this->id ? 'Product updated!' : 'Product created!';
        $this->dispatch('showToast', message: $message);

        $this->id = null;
        $this->resetInput();

        $this->redirect('/dashboard/products', navigate: true);
    }

    public function cancel()
    {
        $this->resetInput();
        $this->redirect('/dashboard/products', navigate: true);
    }

    private function resetInput()
    {
        $this->name = '';
        $this->price = '';
        $this->description = '';
        $this->id = null;
        $this->isEditing = false;
        $this->selectedCategories = [];
    }

    public function render()
    {
        return view('livewire.dashboard.products.manage-product', [
            'product_categories' => ProductCategory::all(),
        ]);
    }
}
