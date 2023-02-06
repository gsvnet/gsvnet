<?php

namespace App\Events\Forum;

use App\Events\Event;
use App\Helpers\Forum\Threads\Thread;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ThreadWasStarted extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $thread;

    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['activity'];
    }

    public function broadcastAs()
    {
        return 'app.thread';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'user_id' => $this->thread->author_id,
            'username' => $this->thread->author->username,
            'subject' => $this->thread->subject,
        ];
    }
}
