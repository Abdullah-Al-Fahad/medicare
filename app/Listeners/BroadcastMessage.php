<?php

namespace App\Listeners;

use App\Events\MessageSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BroadcastMessage
{
    public function handle(MessageSent $event)
    {
        $message = $event->message;
        $user = $event->user;

        event(new MessageSent($message, $user));
    }
}
