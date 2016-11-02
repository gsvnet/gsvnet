<?php namespace GSV\Handlers\Commands\Events;

use GSV\Handlers\Commands\Events\EventParticipateCommand;
use GSV\Events\Events\EventWasParticipated;
use GSVnet\Events\Event;
use GSVnet\Events\EventsRepository;
use GSVnet\Users\UsersRepository;

class EventParticipateCommandHandler {

    private $events;

    function __construct(EventsRepository $events, UsersRepository $users)
    {
        $this->events = $events;
        $this->users = $users;
    }

    public function handle(EventParticipateCommand $command)
    {
        $event = $this->events->byId($command->eventId);
        $user = $this->users->byId($command->userId);
        $event->users()->save($user);

        event(new EventWasParticipated($command->eventId));
    }
}