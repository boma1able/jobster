<?php

namespace App\Livewire\Dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class Categories extends Component
{

    public $categories, $name, $slug, $description, $categoryId;
    public $isEditing = false;

    public function render()
    {
        $this->categories = Category::latest()->get();
        return view('livewire.dashboard.categories');
    }

    public function create()
    {
        $this->resetInput();
        $this->isEditing = false;
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->description = $category->description;
        $this->isEditing = true;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|unique:categories,name,' . $this->categoryId,
            'description' => 'nullable|string'
        ]);

        Category::updateOrCreate(['id' => $this->categoryId], [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
        ]);

        $message = $this->categoryId ? 'Category updated!' : 'Category created!';
        $this->dispatch('showToast', message: $message);

        $this->resetInput();
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
        $this->dispatch('showToast', message: 'Category deleted!');

        if ($this->categoryId == $id) {
            $this->resetInput();
        }
    }

    private function resetInput()
    {
        $this->name = '';
        $this->slug = '';
        $this->description = '';
        $this->categoryId = null;
        $this->isEditing = false;
    }

}
