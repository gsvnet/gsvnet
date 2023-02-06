<?php

namespace App\Helpers\Users\ProfileActions;

use App\Events\Members\AddressWasChanged;
use App\Events\Members\BirthDayWasChanged;
use App\Events\Members\BusinessWasChanged;
use App\Events\Members\GenderWasChanged;
use App\Events\Members\MemberEmailWasChanged;
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
use Laracasts\Presenter\Presenter;

class ProfileActionPresenter extends Presenter
{
    /**
     * @var ProfileAction
     */
    protected $entity;

    public static $map = [
        AddressWasChanged::class => 'Adres',
        BirthDayWasChanged::class => 'Geboortedatum',
        BusinessWasChanged::class => 'Werk',
        MemberEmailWasChanged::class => 'Email',
        GenderWasChanged::class => 'Geslacht',
        NameWasChanged::class => 'Naam',
        ParentDetailsWereChanged::class => 'Gegevens ouders',
        PhoneNumberWasChanged::class => 'Telefoonnummer',
        YearGroupWasChanged::class => 'Jaarverband',
        ProfilePictureWasChanged::class => 'Profielfoto',
        PeriodOfMembershipWasChanged::class => 'Periode van lidmaatschap',
        StudyWasChanged::class => 'Studie',
        RegionWasChanged::class => 'Regio',
        MembershipStatusWasChanged::class => 'Lidmaatschapsstatus',
    ];

    public static $verifications = [
        EmailWasVerified::class => 'Email',
        GenderWasVerified::class => 'Geslacht',
        NameWasVerified::class => 'Naam',
        YearGroupWasVerified::class => 'Jaarverband',
        FamilyWasVerified::class => 'GSV-familie',
    ];

    public function actionName()
    {
        if (array_key_exists($this->entity->action, self::$map)) {
            return self::$map[$this->entity->action].' gewijzigd';
        }

        if (array_key_exists($this->entity->action, self::$verifications)) {
            return self::$verifications[$this->entity->action].' geverifieerd';
        }

        return 'Onbekend';
    }
}
