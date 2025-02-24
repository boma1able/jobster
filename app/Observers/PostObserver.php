<?php

namespace App\Observers;

use App\Jobs\SendNewContentNotification;
use App\Models\Post;

class PostObserver
{
    public function created(Post $post)
    {
        dispatch(new SendNewContentNotification($post, 'post'));
    }
}
