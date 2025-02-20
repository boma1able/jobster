<?php

namespace App\Livewire\Dashboard\Jobs;

use App\Models\Job;
use Livewire\Component;

class Jobs extends Component
{
    public $jobs;

    public function mount(Job $job)
    {
        $this->jobs = Job::latest()->get();
    }

    public function render()
    {
        return view('livewire.dashboard.jobs.jobs', [
            'jobs' => Job::latest()->get()
        ]);
    }
}
