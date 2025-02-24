<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->paginate(9);

        return view('jobs.index', compact('jobs'));
    }

    public function show($id)
    {
        $job = Job::where('id', $id)->with('user')->firstOrFail();

        return view('jobs.show', compact('job'));
    }
}
