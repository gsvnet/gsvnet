<?php namespace GSV\Handlers\Commands\Events;

use GSV\Commands\Command;

class EventParticipateCommand extends Command {

    public $eventId;
    public $userId;

    function __construct($eventId, $userId)
    {
        $this->event_id = $eventId;
        $this->user_id = $userId;
    }
}