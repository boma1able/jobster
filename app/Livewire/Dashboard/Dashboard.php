<?php

namespace App\Livewire\Dashboard;

use App\Models\Comment;
use App\Models\Job;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public $posts, $jobs, $comments, $users, $totalViews;

    public function mount()
    {
        $this->users = User::all();
        $this->posts = Post::all();
        $this->jobs = Job::all();
        $this->comments = Comment::latest()->limit(4)->get();
        $this->totalViews = Post::sum('unique_views');
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}
