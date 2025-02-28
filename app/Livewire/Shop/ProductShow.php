<?php

namespace App\Livewire\Shop;

use App\Models\Product;
use Livewire\Component;

class ProductShow extends Component
{
    public $product;
    public $quantity = 1;
    public $productId;
    public $relatedProducts;

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->fetchRelatedProducts();
        $this->product = Product::find($productId);
    }

    protected function fetchRelatedProducts()
    {
        $product = Product::find($this->productId);
        $categoryIds = $product->product_categories->pluck('id')->toArray();

        $this->relatedProducts = Product::whereHas('product_categories', function($query) use ($categoryIds) {
            $query->whereIn('product_categories.id', $categoryIds);
        })
            ->where('id', '!=', $this->productId)
            ->latest()
            ->take(4)
            ->get();
    }

    public function addToCart()
    {
        $this->dispatch('addToCart', $this->product->id, $this->quantity);
    }

    public function render()
    {
        return view('livewire.shop.product-show');
    }
}
