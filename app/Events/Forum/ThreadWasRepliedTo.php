<?php namespace GSV\Events\Forum;

use GSV\Events\Event;
use GSV\Helpers\Forum\Replies\Reply;
use GSV\Helpers\Forum\Threads\Thread;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ThreadWasRepliedTo extends Event implements ShouldBroadcast {

    use SerializesModels;

    public $thread;
    public $reply;

    public function __construct(Thread $thread, Reply $reply)
    {
        $this->thread = $thread;
        $this->reply = $reply;
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
        return 'app.reply';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
	        'user_id' => $this->reply->author_id,
            'username' => $this->reply->author->username,
            'subject' => $this->thread->subject
        ];
    }
}
