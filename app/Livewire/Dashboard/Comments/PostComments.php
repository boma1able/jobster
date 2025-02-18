<?php
namespace App\Livewire\Dashboard\Comments;

use App\Models\Post;
use Livewire\Component;

class PostComments extends Component
{
    public $slug;
    public $content = '';
    public $successMessage = '';

    protected $rules = [
        'content' => 'required|string|max:1000',
    ];

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function submitComment()
    {
        $this->validate();

        $post = Post::where('slug', $this->slug)->firstOrFail();

        $post->comments()->create([
            'content' => $this->content,
            'user_id' => auth()->id(),
            'approved' => auth()->user()->isAdmin() ? true : false,
        ]);

        $this->successMessage = 'Your comment has been submitted for approval!';

        $this->reset('content');
    }

    public function render()
    {
        $post = Post::where('slug', $this->slug)->firstOrFail();
        $comments = $post->comments()->where('approved', true)->latest()->get();

        return view('livewire.dashboard.comments.post-comments', [
            'comments' => $comments,
            'post' => $post,
        ]);
    }
}



