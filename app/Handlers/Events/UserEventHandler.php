<?php namespace App\Handlers\Events;

use App\Events\Members\AddressWasChanged;
use App\Events\Members\BirthDayWasChanged;
use App\Events\Members\BusinessWasChanged;
use App\Events\Members\GenderWasChanged;
use App\Events\Members\MemberEmailWasChanged;
use App\Events\Members\MemberFileWasCreated;
use App\Events\Members\MembershipStatusWasChanged;
use App\Events\Members\NameWasChanged;
use App\Events\Members\ParentDetailsWereChanged;
use App\Events\Members\PeriodOfMembershipWasChanged;
use App\Events\Members\PhoneNumberWasChanged;
use App\Events\Members\ProfilePictureWasChanged;
use App\Events\Members\RegionWasChanged;
use App\Events\Members\StudyWasChanged;
use App\Events\Members\Verifications\EmailWasVerified;
use App\Events\Members\Verifications\FamilyWasVerified;
use App\Events\Members\Verifications\GenderWasVerified;
use App\Events\Members\Verifications\NameWasVerified;
use App\Events\Members\Verifications\YearGroupWasVerified;
use App\Events\Members\YearGroupWasChanged;
use App\Events\Potentials\PotentialSignedUp;
use App\Events\Users\UserWasRegistered;
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
        YearGroupWasChanged::class,
    ];

    static $verifyAccountWhen = [
        MemberEmailWasChanged::class,
        EmailWasVerified::class
    ];

    public function subscribe(Dispatcher $events)
    {
        $events->listen(UserWasRegistered::class, 'App\Handlers\Events\Users\UserMailer@sendWelcomeEmail');
        $events->listen(UserWasRegistered::class, 'App\Handlers\Events\Users\UserMailer@notifyReunist');
        $events->listen(PotentialSignedUp::class, 'App\Handlers\Events\Potentials\PotentialMailer@sendWelcomeMail');

        $events->listen(self::$profileChanges, 'App\Handlers\Events\Members\ProfileUpdates@changedProfile');
        $events->listen(self::$verifyAccountWhen, 'App\Handlers\Events\Members\ProfileUpdates@tookAccountInUse');

        // Disable this for now, since a lot of mails are coming in
        // $events->listen(self::$informAbactisFor, AbactisInformer::class);
        $events->listen(MemberFileWasCreated::class, 'App\Handlers\Events\AbactisInformer@sendMemberFile');
        
        $events->listen(self::$informNewsletterFor, NewsletterInformer::class);

        $events->listen('user.registered', 'App\Helpers\Users\UserMailer@registered');
        $events->listen('user.activated', 'App\Helpers\Users\UserMailer@activated');

        $events->listen('potential.registered', 'App\Helpers\Users\UserMailer@membership');
        $events->listen('potential.accepted', 'App\Helpers\Users\UserMailer@membershipAccepted');

    }
}