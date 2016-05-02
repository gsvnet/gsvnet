<?php namespace GSV\Handlers\Events;

use GSV\Events\Members\AddressWasChanged;
use GSV\Events\Members\BirthDayWasChanged;
use GSV\Events\Members\BusinessWasChanged;
use GSV\Events\Members\GenderWasChanged;
use GSV\Events\Members\MemberEmailWasChanged;
use GSV\Events\Members\MembershipStatusWasChanged;
use GSV\Events\Members\NameWasChanged;
use GSV\Events\Members\ParentDetailsWereChanged;
use GSV\Events\Members\PeriodOfMembershipWasChanged;
use GSV\Events\Members\PhoneNumberWasChanged;
use GSV\Events\Members\ProfilePictureWasChanged;
use GSV\Events\Members\RegionWasChanged;
use GSV\Events\Members\StudyWasChanged;
use GSV\Events\Members\Verifications\EmailWasVerified;
use GSV\Events\Members\Verifications\FamilyWasVerified;
use GSV\Events\Members\Verifications\GenderWasVerified;
use GSV\Events\Members\Verifications\NameWasVerified;
use GSV\Events\Members\Verifications\YearGroupWasVerified;
use GSV\Events\Members\YearGroupWasChanged;
use GSV\Events\Potentials\PotentialSignedUp;
use GSV\Events\Users\UserWasRegistered;
use Illuminate\Contracts\Events\Dispatcher;

class UserEventHandler
{
    static $profileChanges = [
        AddressWasChanged::class,
        BirthDayWasChanged::class,
        BusinessWasChanged::class,
        GenderWasChanged::class,
        MemberEmailWasChanged::class,
        NameWasChanged::class,
        ParentDetailsWereChanged::class,
        PeriodOfMembershipWasChanged::class,
        PhoneNumberWasChanged::class,
        ProfilePictureWasChanged::class,
        RegionWasChanged::class,
        StudyWasChanged::class,
        YearGroupWasChanged::class,
        MembershipStatusWasChanged::class,

        EmailWasVerified::class,
        GenderWasVerified::class,
        NameWasVerified::class,
        YearGroupWasVerified::class,
        FamilyWasVerified::class,
    ];

    static $informAbactisFor = [
        AddressWasChanged::class,
        BirthDayWasChanged::class,
        BusinessWasChanged::class,
        MemberEmailWasChanged::class,
        ParentDetailsWereChanged::class,
        PhoneNumberWasChanged::class,
        StudyWasChanged::class,
    ];

    static $informNewsletterFor = [
        NameWasChanged::class,
        MemberEmailWasChanged::class,
        GenderWasChanged::class,
        MembershipStatusWasChanged::class,
    ];

    static $verifyAccountWhen = [
        MemberEmailWasChanged::class,
        EmailWasVerified::class
    ];

    public function subscribe(Dispatcher $events)
    {
        $events->listen(UserWasRegistered::class, 'GSV\Handlers\Events\Users\UserMailer@sendWelcomeEmail');
        $events->listen(UserWasRegistered::class, 'GSV\Handlers\Events\Users\UserMailer@notifyFormerMember');
        $events->listen(PotentialSignedUp::class, 'GSV\Handlers\Events\Potentials\PotentialMailer@sendWelcomeMail');

        $events->listen(self::$profileChanges, 'GSV\Handlers\Events\Members\ProfileUpdates@changedProfile');
        $events->listen(self::$verifyAccountWhen, 'GSV\Handlers\Events\Members\ProfileUpdates@tookAccountInUse');
        $events->listen(self::$informAbactisFor, AbactisInformer::class);
        $events->listen(self::$informNewsletterFor, NewsletterInformer::class);

        $events->listen('user.registered', 'GSVnet\Users\UserMailer@registered');
        $events->listen('user.activated', 'GSVnet\Users\UserMailer@activated');

        $events->listen('potential.registered', 'GSVnet\Users\UserMailer@membership');
        $events->listen('potential.accepted', 'GSVnet\Users\UserMailer@membershipAccepted');

    }
}