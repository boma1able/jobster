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
        $query = Comment::all();
        $all = $query->count();
        $mine = $query->where('user_id', auth()->id())->count();
        $pending =  $query->where('approved', false)->count();
        $approved =  $query->where('approved', true)->count();

        $this->counts = [
            'all' => $all,
            'mine' => $mine,
            'pending' => $pending,
            'approved' => $approved,
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
        $query = Comment::with('user', 'post')
            ->when($this->filter === 'mine', function ($query){
                return $query->where('user_id', auth()->id());
            })
            ->when($this->filter === 'pending', function ($query){
                return $query->where('approved', false);
            })
            ->when($this->filter === 'approved', function ($query){
                return  $query->where('approved', true);
            })
            ->latest();

        return view('livewire.dashboard.comments.comments-table', [
            'comments' => $query->paginate(10),
        ]);
    }
}


