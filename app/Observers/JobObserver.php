<?php

namespace App\Observers;

use App\Jobs\SendNewContentNotification;
use App\Models\Job;

class JobObserver
{
    public function created(Job $job)
    {
        dispatch(new SendNewContentNotification($job, 'job'));
    }
}
