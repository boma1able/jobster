<?php

namespace App\Livewire\Dashboard;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $title, $slug, $content, $postId, $userId, $categories, $selectedCategories = [], $tags = [], $featured_obj;
    public $isEditing = false;
    public $isCreating = false;
    public $featured_img = '';
    public $tag = '';

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->categories = Category::latest()->get();
        $this->tags = [];
    }

    public function removeImage()
    {
        $this->featured_img = null;
        $this->featured_obj = null;
    }

    public function create()
    {
        $this->resetInput();
        $this->isEditing = false;
        $this->isCreating = true;
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->postId = $id;
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->content = $post->content;
        $this->selectedCategories = $post->categories->pluck('id')->toArray();
        $this->tags = $post->tags->pluck('name')->toArray();
        $this->featured_img = $post->featured_img;
        $this->isEditing = true;
        $this->isCreating = false;
    }

    public function store()
    {
        $this->validate([
            'title'         => 'required|unique:posts,title,' . $this->postId,
            'content'       => 'nullable|string',
            'featured_obj'  => $this->featured_obj ? 'image|max:1024' : '',
        ]);

        if ($this->featured_obj) {
            $originalName = pathinfo($this->featured_obj->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $this->featured_obj->getClientOriginalExtension();
            $filename = "{$originalName}.{$extension}";
            $counter = 1;

            while (Storage::disk('public')->exists("media/{$filename}")) {
                $filename = "{$originalName}-{$counter}.{$extension}";
                $counter++;
            }

            $this->featured_obj->storeAs('media', $filename, 'public');
            $this->featured_img = $filename;
        }

        if (empty($this->selectedCategories)) {
            $this->selectedCategories = [];
        }

        $post = Post::updateOrCreate(['id' => $this->postId], [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'user_id' => auth()->id(),
            'featured_img' => $this->featured_img,
        ]);

        if (!empty($this->selectedCategories)) {
            $post->categories()->sync($this->selectedCategories);
        } else {
            $post->categories()->detach();
        }

        if (!empty($this->tags)) {
            $tagIds = [];

            foreach ($this->tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }

            $post->tags()->sync($tagIds);
        }

        $message = $this->postId ? "Post #{$this->postId} updated!" : "New post was created!";
        $this->dispatch('showToast', message: $message);

        $this->resetInput();
        $this->resetPage();
    }

    public function addTag()
    {
        if (!empty($this->tag) && !in_array($this->tag, $this->tags)) {
            $this->tags[] = $this->tag;
            $this->tag = '';
        }
    }

    public function removeTag($tag)
    {
        $this->tags = array_filter($this->tags, fn($t) => $t !== $tag);
    }

    public function delete($id)
    {
        Post::findOrFail($id)->delete();
        $this->dispatch('showToast', message: "Post #{$id} deleted!");

        if ($this->postId == $id) {
            $this->resetInput();
        }

        $this->resetPage();
    }

    private function resetInput()
    {
        $this->title = '';
        $this->slug = '';
        $this->content = '';
        $this->postId = null;
        $this->selectedCategories = [];
        $this->tags = [];
        $this->isEditing = false;
        $this->isCreating = false;
    }

    public function cancel()
    {
        $this->resetInput();
    }

    public function render()
    {
        return view('livewire.dashboard.posts', [
            'posts' => Post::latest()->paginate(5)
        ]);
    }
}
