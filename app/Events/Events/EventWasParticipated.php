<?php namespace GSV\Events\Events;

use Illuminate\Queue\SerializesModels;

class EventWasParticipated extends Event {

    use SerializesModels;

    public $eventId;

    public function __construct($eventId)
    {
        $this->eventId = $eventId;
    }
}