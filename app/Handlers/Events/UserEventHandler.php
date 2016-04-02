<?php namespace GSV\Handlers\Events;

use GSV\Events\Members\AddressWasChanged;
use GSV\Events\Members\BirthDayWasChanged;
use GSV\Events\Members\BusinessWasChanged;
use GSV\Events\Members\EmailWasChanged;
use GSV\Events\Members\GenderWasChanged;
use GSV\Events\Members\NameWasChanged;
use GSV\Events\Members\ParentDetailsWereChanged;
use GSV\Events\Members\PhoneNumberWasChanged;
use GSV\Events\Members\ProfilePictureWasChanged;
use GSV\Events\Members\YearGroupWasChanged;
use GSV\Events\Potentials\PotentialSignedUp;
use GSV\Events\Users\UserWasRegistered;
use Illuminate\Contracts\Events\Dispatcher;

class UserEventHandler {
    public function subscribe(Dispatcher $events)
    {
        $events->listen(UserWasRegistered::class, 'GSV\Handlers\Events\Users\UserMailer@sendWelcomeEmail');
        $events->listen(UserWasRegistered::class, 'GSV\Handlers\Events\Users\UserMailer@notifyFormerMember');
        $events->listen(PotentialSignedUp::class, 'GSV\Handlers\Events\Potentials\PotentialMailer@sendWelcomeMail');

        $events->listen([
            EmailWasChanged::class,
            NameWasChanged::class,
            YearGroupWasChanged::class,
            GenderWasChanged::class,
            AddressWasChanged::class,
            BirthDayWasChanged::class,
            BusinessWasChanged::class,
            ParentDetailsWereChanged::class,
            PhoneNumberWasChanged::class,
            ProfilePictureWasChanged::class
        ], 'GSV\Handlers\Events\Members\ProfileUpdates@changedProfile');

        $events->listen('user.registered', 'GSVnet\Users\UserMailer@registered');
        $events->listen('user.activated', 'GSVnet\Users\UserMailer@activated');

        $events->listen('potential.registered', 'GSVnet\Users\UserMailer@membership');
        $events->listen('potential.accepted', 'GSVnet\Users\UserMailer@membershipAccepted');

        $events->listen('user.updated', 'GSVnet\Newsletters\NewsletterManager@userUpdated');
        $events->listen('profile.updatedByOwner', 'GSVnet\Users\UserMailer@updatedByOwner');
    }
}