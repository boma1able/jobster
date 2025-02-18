<?php

namespace App\Livewire\Dashboard\Comments;

use App\Models\Comment;
use Livewire\Component;

class NewCommentsCounter extends Component
{
    public $pending;

    protected $listeners = ['refreshCounter' => 'refreshCounter'];


    public function mount()
    {
        $this->pending = Comment::where('approved', false)->count();
    }

    public function refreshCounter()
    {
        $this->pending = Comment::where('approved', false)->count();
    }

    public function render()
    {

        return view('livewire.dashboard.comments.new-comments-counter');
    }
}
