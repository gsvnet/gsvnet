<?php namespace GSVnet\Users\ProfileActions;

use GSV\Events\Members\AddressWasChanged;
use GSV\Events\Members\BirthDayWasChanged;
use GSV\Events\Members\BusinessWasChanged;
use GSV\Events\Members\MemberEmailWasChanged;
use GSV\Events\Members\GenderWasChanged;
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
            return self::$map[$this->entity->action] . ' gewijzigd';
        }

        if (array_key_exists($this->entity->action, self::$verifications)) {
            return self::$verifications[$this->entity->action] . ' geverifieerd';
        }

        return 'Onbekend';
    }
}