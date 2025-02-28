<?php

namespace App\Livewire\Dashboard;


use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\Component;

class Tags extends Component
{
    public $tags, $name, $slug, $description, $tagId;
    public $isEditing = false;

    public function render()
    {
        $this->tags = Tag::latest()->get();
        return view('livewire.dashboard.tags');
    }

    public function create()
    {
        $this->resetInput();
        $this->isEditing = false;
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        $this->tagId = $id;
        $this->name = $tag->name;
        $this->slug = $tag->slug;
        $this->description = $tag->description;
        $this->isEditing = true;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|unique:tags,name,' . $this->tagId,
            'description' => 'nullable|string'
        ]);

        Tag::updateOrCreate(['id' => $this->tagId], [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
        ]);

        $message = $this->tagId ? 'Tag ' . e($this->name) . ' updated!' : 'Tag ' . e($this->name) . ' created!';
        $this->dispatch('showToast', message: $message);

        $this->resetInput();
    }

    public function delete($id)
    {
        $tag = Tag::findOrFail($id);
        $message = 'Tag ' . e($tag->name) . ' deleted!';
        $this->dispatch('showToast', message: $message);
        $tag->delete();

        if ($this->tagId == $id) {
            $this->resetInput();
        }
    }

    private function resetInput()
    {
        $this->name = '';
        $this->slug = '';
        $this->description = '';
        $this->tagId = null;
        $this->isEditing = false;
    }
}
