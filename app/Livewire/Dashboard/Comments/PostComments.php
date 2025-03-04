<?php
namespace App\Livewire\Dashboard\Comments;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class PostComments extends Component
{
    public $slug;
    public $content = '';
    public $successMessage = '';
    public $comments;
    public $post;

    protected $rules = [
        'content' => 'required|string|max:1000',
    ];

    public function mount($slug)
    {
        $this->slug = $slug;

        $this->post = Post::whereSlug($this->slug)->firstOrFail();

//      $this->comments = $post->comments()->where('approved', true)->latest()->get();
        $this->comments = $this->post->comments()->whereAproved(true)->latest()->get();
    }

    public function submitComment()
    {
        $this->validate();

        $post = Post::whereSlug($this->slug)->firstOrFail();

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
        return view('livewire.dashboard.comments.post-comments');
    }
}



