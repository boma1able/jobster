<?php

namespace App\Livewire\Dashboard\Products;

use App\Models\ProductCategory;
use Illuminate\Support\Str;
use Livewire\Component;

class ProductCategories extends Component
{
    public $name, $slug, $product_categoryId;
    public $isEditing = false;
    public $selectedCategories = [];

    public function create()
    {
        $this->resetInput();
        $this->isEditing = false;
    }

    public function edit($id)
    {
        $product_category = ProductCategory::findOrFail($id);
        $this->product_categoryId = $id;
        $this->name = $product_category->name;
        $this->slug = $product_category->slug;
        $this->isEditing = true;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|unique:product_categories,name,' . $this->product_categoryId,
        ]);

        $slug = $this->slug ?: Str::slug($this->name);

        if (ProductCategory::where('slug', $slug)->where('id', '!=', $this->product_categoryId)->exists()) {
            $slug = $slug . '-' . time();
        }

        ProductCategory::updateOrCreate(['id' => $this->product_categoryId], [
            'name' => $this->name,
            'slug' => $slug,
        ]);

        $message = $this->product_categoryId ? 'Category updated!' : 'Category created!';
        $this->dispatch('showToast', message: $message);

        $this->resetInput();
    }

    public function delete($id)
    {
        ProductCategory::findOrFail($id)->delete();
        $this->dispatch('showToast', message: 'Category deleted!');

        if ($this->product_categoryId == $id) {
            $this->resetInput();
        }
    }

    private function resetInput()
    {
        $this->name = '';
        $this->slug = '';
        $this->product_categoryId = null;
        $this->isEditing = false;
    }

    public function render()
    {
        return view('livewire.dashboard.products.products-categories', [
            'product_categories' => ProductCategory::latest()->get(),
        ]);
    }
}
