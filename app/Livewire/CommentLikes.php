<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Support\Facades\Auth;

class CommentLikes extends Component
{
    public Comment $comment;
    public int $likesCount;
    public bool $isLiked;

    public function mount(Comment $comment)
    {
        $this->comment = $comment;
        $this->likesCount = $comment->likes()->count();
        $this->isLiked = Auth::check() && $comment->isLikedByUser(Auth::id());
    }

    public function toggleLike()
    {
        if (!Auth::check()) {
            return;
        }

        if ($this->isLiked) {
            CommentLike::where('comment_id', $this->comment->id)
                ->where('user_id', Auth::id())
                ->delete();
            $this->likesCount--;
        } else {
            CommentLike::create([
                'comment_id' => $this->comment->id,
                'user_id' => Auth::id(),
            ]);
            $this->likesCount++;
        }

        $this->isLiked = !$this->isLiked;
    }

    public function render()
    {
        return view('livewire.comment-likes');
    }
}

