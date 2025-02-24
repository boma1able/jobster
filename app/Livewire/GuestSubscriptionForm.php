<?php

namespace App\Livewire;

use App\Models\Subscription;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class GuestSubscriptionForm extends Component
{

    public $email;
    public $subscribeToPosts = true;
    public $subscribeToJobs = true;

    public function subscribe()
    {
        $validated = Validator::make(
            ['email' => $this->email],
            ['email' => 'required|email|unique:subscriptions,email']
        )->validate();

        Subscription::create([
            'email' => $this->email,
            'subscribe_to_posts' => $this->subscribeToPosts,
            'subscribe_to_jobs' => $this->subscribeToJobs,
        ]);

        $this->dispatch('notify', 'Ви успішно підписалися!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.guest-subscription-form');
    }
}
