<?php
namespace App\Livewire\Dashboard\Comments;

use Livewire\WithPagination;
use App\Models\Comment;
use Livewire\Component;

class CommentsTable extends Component
{
    use WithPagination;

    public $filter = 'all';
    public $counts = [];
    public ?Comment $editingComment = null;
    public $newContent;

    public function mount()
    {
        $this->updateCounts();
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function approve($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->approved = true;
        $comment->save();

        $this->updateCounts();
        $this->dispatch('refreshCounter');
    }

    public function reject($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->approved = false;
        $comment->save();

        $this->updateCounts();
        $this->dispatch('refreshCounter');
    }

    public function editComment($commentId)
    {
        $this->editingComment = Comment::findOrFail($commentId);
        $this->newContent = $this->editingComment->content;
    }

    public function updateComment()
    {
        if (!$this->editingComment) {
            return;
        }

        $this->validate([
            'newContent' => 'required|string|max:1000',
        ]);

        $this->editingComment->update([
            'content' => $this->newContent,
        ]);

        $this->dispatch('showToast', message: "Comment #{$this->editingComment->id} was successfully updated!");
        $this->dispatch('refreshCounter');

        $this->cancelEdit();
    }

    public function cancelEdit()
    {
        $this->editingComment = null;
        $this->newContent = '';
    }

    private function updateCounts()
    {
        $this->counts = [
            'all' => Comment::count(),
            'mine' => Comment::where('user_id', auth()->id())->count(),
            'pending' => Comment::where('approved', false)->count(),
            'approved' => Comment::where('approved', true)->count(),
        ];
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();

        $message = 'Comment #' . $commentId . ' deleted!';
        $this->dispatch('showToast', message: $message);
        $this->dispatch('refreshCounter');
    }

    public function render()
    {
        $query = Comment::with('user', 'post')->latest();

        if ($this->filter === 'mine') {
            $query->where('user_id', auth()->id());
        } elseif ($this->filter === 'pending') {
            $query->where('approved', false);
        } elseif ($this->filter === 'approved') {
            $query->where('approved', true);
        }

        return view('livewire.dashboard.comments.comments-table', [
            'comments' => $query->paginate(10),
        ]);
    }
}


