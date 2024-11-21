<?php

namespace App\Listeners;

use App\Events\BookCreated;
use Illuminate\Support\Facades\Log;

class SendBookCreatedNotification
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(BookCreated $event)
    {
        Log::channel('custom')->info('New book with title: "' . $event->book->title . '" has added by ' . $event->book->owner->email);
    }
}
