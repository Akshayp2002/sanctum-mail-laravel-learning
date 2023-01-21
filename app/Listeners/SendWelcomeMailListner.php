<?php

namespace App\Listeners;

use App\Events\NewUserCreatedEvent;
use App\Mail\LoginMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMailListner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    // public $user;
    public function __construct()
    {
      
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewUserCreatedEvent  $event
     * @return void
     */
    public function handle(NewUserCreatedEvent $event)
    {
        info($event->user);
        Mail::to($event->user->email)->send(new LoginMail($event->user));
    }
}
