<?php

namespace App\Livewire\Dashboard\Comments;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;

    public $search = '';
    public $user_comments = false;
    public $pending = false;
    public $approved = false;

    protected $queryString = ['search', 'user_comments', 'pending', 'approved'];

//    public function mount()
//    {
//        $this->comments = Comment::latest()->get();
//    }

    public function render()
    {

        return view('livewire.dashboard.comments.comments', [
            'comments' => Comment::latest()->paginate(9)
        ]);
    }

}
