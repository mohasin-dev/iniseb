<?php

namespace App\Listeners;

use App\Models\Subscriber;
use App\Jobs\SendPostToSubscribers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewPostNotification
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if (Cache::has('subscribers_' . $event->post->website_id)) {
            $subscribers = Cache::get('subscribers_' . $event->post->website_id);
        } else {
            $subscribers = Subscriber::active()->whereWebsiteId($event->post->website_id)->get();

            Cache::put('subscribers_' . $event->post->website_id, $subscribers);
        };

        SendPostToSubscribers::dispatch($subscribers, $event->post);
    }
}
