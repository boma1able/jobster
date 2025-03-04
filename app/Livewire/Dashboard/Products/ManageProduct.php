<?php

namespace App\Livewire\Dashboard\Products;

use App\Livewire\Dashboard\Products\ProductQuillEditor;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;


class ManageProduct extends Component
{
    use WithFileUploads;

    public ?int $id = null;
    public $name, $price, $description = '', $selectedCategories = [], $product_img, $product_obj_img = '';
    public $isEditing = false;

    public function mount($id = null)
    {
        if ($id) {
            $this->edit($id);
        }
    }

    public function removeImage()
    {
        $this->product_img = null;
        $this->product_obj_img = null;
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->id = $id;
        $this->name = $product->name;
        $this->product_img = $product->image;
        $this->price = $product->price;
        $this->description = $product->description;
        $this->selectedCategories = $product->product_categories->pluck('id')->toArray();
        $this->isEditing = true;
    }

    public function store()
    {

        $this->validate([
            'name'              => 'required|min:2',
            'price'             => 'required|numeric|min:0',
            'description'       => 'required',
            'product_obj_img'   => $this->product_obj_img ? 'nullable|image|max:1024|mimes:jpg,jpeg,png,gif,webp' : '',
        ]);

        if ($this->product_obj_img) {
            $originalName = pathinfo($this->product_obj_img->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $this->product_obj_img->getClientOriginalExtension();
            $filename = "{$originalName}.{$extension}";
            $counter = 1;

            while (Storage::disk('public')->exists("products/{$filename}")) {
                $filename = "{$originalName}-{$counter}.{$extension}";
                $counter++;
            }

            $this->product_obj_img->storeAs('products', $filename, 'public');
            $this->product_img = $filename;
        }

        $product = Product::updateOrCreate(['id' => $this->id], [
            'name'          => $this->name,
            'price'         => $this->price,
            'description'   => $this->description,
            'image'         => $this->product_img ?? '',
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
        $this->product_obj_img = null;
        $this->isEditing = false;
        $this->selectedCategories = [];
    }

    public function render()
    {
        return view('livewire.dashboard.products.manage-product', [
            'product_categories' => ProductCategory::all(),
            'description' => $this->description,
        ]);
    }
}
