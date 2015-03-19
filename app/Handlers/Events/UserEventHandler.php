<?php namespace GSV\Handlers\Events;

class UserEventHandler {
    public function subscribe($events)
    {
        $events->listen('GSV\Events\Users\UserWasRegistered', 'GSV\Handlers\Events\Users\UserMailer@sendWelcomeEmail');
        $events->listen('GSV\Events\Users\UserWasRegistered', 'GSV\Handlers\Events\Users\UserMailer@notifyFormerMember');
    }
}