<?php

namespace App\Livewire\Dashboard\Comments;

use App\Models\Comment;
use Livewire\Component;

class EditComment extends Component
{
    public Comment $comment;
    public string $content;

    protected function rules()
    {
        return [
            'content' => 'required|string|max:1000',
        ];
    }

    public function mount(Comment $comment)
    {
        $this->comment = $comment;
        $this->content = $comment->content ?? '';
    }

    public function updateComment()
    {
        $this->validate();

        $this->comment->update([
            'content' => $this->content,
        ]);

        $this->dispatch('showToast', message: "Comment #{$this->comment->id} was successfully updated!");
        $this->dispatch('commentUpdated');
    }

    public function render()
    {
        return view('livewire.dashboard.comments.edit-comment');
    }
}
