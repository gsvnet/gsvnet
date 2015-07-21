<?php namespace GSV\Handlers\Events;

use GSV\Events\Potentials\PotentialSignedUp;

class UserEventHandler {
    public function subscribe($events)
    {
        $events->listen('GSV\Events\Users\UserWasRegistered', 'GSV\Handlers\Events\Users\UserMailer@sendWelcomeEmail');
        $events->listen('GSV\Events\Users\UserWasRegistered', 'GSV\Handlers\Events\Users\UserMailer@notifyFormerMember');

        $events->listen(PotentialSignedUp::class, 'GSV\Handlers\Events\Potentials\PotentialMailer@sendWelcomeMail');
    }
}