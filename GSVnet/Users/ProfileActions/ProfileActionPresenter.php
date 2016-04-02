<?php namespace GSVnet\Users\ProfileActions;

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
use Laracasts\Presenter\Presenter;

class ProfileActionPresenter extends Presenter
{
    /**
     * @var ProfileAction
     */
    protected $entity;

    private static $map = [
        AddressWasChanged::class => 'Adreswijziging',
        BirthDayWasChanged::class => 'Geboortedatum',
        BusinessWasChanged::class => 'Werk',
        EmailWasChanged::class => 'Email',
        GenderWasChanged::class => 'Geslacht',
        NameWasChanged::class => 'Naamsverandering',
        ParentDetailsWereChanged::class => 'Gegevens ouders',
        PhoneNumberWasChanged::class => 'Telefoonnummer',
        YearGroupWasChanged::class => 'Jaarverband',
        ProfilePictureWasChanged::class => 'Profielfoto'
    ];

    public function actionName()
    {
        if (array_key_exists($this->entity->action, self::$map)) {
            return self::$map[$this->entity->action];
        }

        return 'Onbekend';
    }
}