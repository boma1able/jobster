<?php

namespace App\Jobs;

use App\Mail\NewContentNotification;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewContentNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $content;
    public $type;

    public function __construct($content, $type)
    {
        $this->content = $content;
        $this->type = $type;
    }

    public function handle()
    {
        $emails = Subscription::where($this->type === 'post' ? 'subscribe_to_posts' : 'subscribe_to_jobs', true)
            ->pluck('email')
            ->unique();

        foreach ($emails as $email) {
            Mail::to($email)->send(new NewContentNotification($this->content, $this->type));
        }
    }
}
