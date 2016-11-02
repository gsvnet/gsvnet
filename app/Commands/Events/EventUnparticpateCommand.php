<?php namespace GSV\Handlers\Commands\Events;

use GSV\Commands\Command;

class EventUnparticpateCommand extends Command {

    public $eventId;
    public $userId;

    function __construct($eventId, $userId)
    {
        $this->eventId = $eventId;
        $this->userId = $userId;
    }
}