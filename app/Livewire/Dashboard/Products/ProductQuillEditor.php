<?php

namespace App\Livewire\Dashboard\Products;

use Livewire\Component;

class ProductQuillEditor extends Component
{
    public $description;

    public function mount($description = '')
    {
        $this->description = $description;
    }

    public function render()
    {
        return view('livewire.products.product-quill-editor');
    }
}


