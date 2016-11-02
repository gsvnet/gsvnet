<?php namespace GSV\Events\Events;

use Illuminate\Queue\SerializesModels;

class EventWasUnparticipated extends Event {

    use SerializesModels;

    public $eventId;
    public $userId;

    public function __construct($eventId, $userId)
    {
        $this->eventId = $eventId;
        $this->userId = $userId;
    }
}