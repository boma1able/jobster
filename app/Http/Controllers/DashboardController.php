<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $posts = Post::latest()->Paginate(3);
        $jobs = Job::latest()->simplePaginate(3);
        $users = User::all();

        return view('dashboard.index', compact('posts', 'jobs', 'users'));
    }
}
