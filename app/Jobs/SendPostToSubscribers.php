<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use App\Models\PostSubscriber;
use Illuminate\Queue\SerializesModels;
use App\Notifications\NewPostPublished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendPostToSubscribers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Subscribers
     *
     * @var Collection
     */
    protected $subscribers;

    /**
     * Post
     *
     * @var Post
     */
    protected $post;

    /**
     * Create a new job instance.
     * @param Collection $subscribers
     * @param Post $post
     * 
     * @return void
     */
    public function __construct($subscribers, $post)
    {
        $this->subscribers = $subscribers;
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->subscribers as $subscriber) {
            PostSubscriber::create([
                'post_id' => $this->post->id,
                'subscriber_id' => $subscriber->id,
            ]);
            
            $subscriber->notify(new NewPostPublished($this->post));
        }
    }
}
