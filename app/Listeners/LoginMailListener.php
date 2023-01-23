<?php

namespace App\Listeners;

use App\Events\LoginUserEvent;
use App\Mail\LoginMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class LoginMailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LoginUserEvent  $event
     * @return void
     */
    public function handle(LoginUserEvent $event)
    {
        //
        // sleep(60*1000);
            Mail::to($event->user->email)->send(new LoginMail($event->user));

    }
}
