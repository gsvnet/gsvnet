<?php namespace GSVnet\Users;

use GSVnet\Users\ValueObjects\Gender;
use Illuminate\Support\Collection;

class UserTransformer {

    static $genderMap = [
        Gender::MALE => 'Amice',
        Gender::FEMALE => 'Amica'
    ];

    /**
     * @param User $user
     * @return array
     */
    public function mailchimpSubscribe(User $user)
    {
        if ($user->profile && ! is_null($user->profile->gender)) {
            $titel = self::$genderMap[$user->profile->gender];
        } else {
            $titel = 'Amice of amica';
        }

        return [
            'FNAME' => $user->firstname,
            'LNAME' => $user->present()->fullLastname,
            'TITEL' => $titel,
            'TITEL_LOW' => strtolower($titel)
        ];
    }

    /**
     * @param Collection $users
     * @return array
     */
    public function batchMailchimpSubscribe(Collection $users)
    {
        $batch = [];

        foreach($users as $user)
        {
            $batch[] = [
                'email' => ['email' => $user->email],
                'merge_vars' => $this->mailchimpSubscribe($user)
            ];
        }

        return $batch;
    }

    /**
     * @param User $user
     * @return array
     */
    public function mailchimpUnsubscribe(User $user)
    {
        return [
            ['email' => $user->email]
        ];
    }

    /**
     * @param Collection $users
     * @return array
     */
    public function batchMailchimpUnsubscribe(Collection $users)
    {
        $batch = [];
        foreach($users as $user)
        {
            $batch[] = $this->mailchimpUnsubscribe($user);
        }

        return $batch;
    }

    public function csv(User $user)
    {
        $hasProfile = ! empty($user->profile);
        $hasYearGroup = $hasProfile && ! empty($user->profile->yearGroup);

        return [
            'Voornaam' => $user->firstname,
            'Tussenvoegsel' => $user->middlename,
            'Achternaam' => $user->lastname,
            'Regio' => $hasProfile ? $user->profile->present()->regionName : '',
            'Jaarverband' => $hasYearGroup ? $user->profile->yearGroup->name : '',
            'Jaar van lidmaatschap' => $hasYearGroup ? (int) $user->profile->yearGroup->year : '',
            'Inauguratiedatum' => $hasProfile ? $user->profile->present()->inaugurationDateSimple : '',
            'Status' => $user->present()->membershipType(false),
            'Bedankdatum' => $hasProfile ? $user->profile->present()->resignationDateSimple : '',
            'Reunist' => $hasProfile && $user->profile->reunist ? 'Ja' : 'Nee',
            'Email' => $user->email,
            'Geslacht' => $hasProfile ? $user->profile->present()->genderLocalized : '',
            'Geboortedatum' => $hasProfile ? $user->profile->birthdate : '',
            'Telefoon' => $hasProfile ? $user->profile->phone : '',
            'Adres' => $hasProfile ? $user->profile->address : '',
            'Postcode' => $hasProfile ? $user->profile->zip_code : '',
            'Woonplaats' => $hasProfile ? $user->profile->town : '',
            'Studie' => $hasProfile ? $user->profile->study : '',
            'Studentnummer' => $hasProfile ? $user->profile->student_number : '',
            'Bedrijf' => $hasProfile ? $user->profile->company : '',
            'Functie' => $hasProfile ? $user->profile->profession : '',
            'Telefoon ouders' => $hasProfile ? $user->profile->parent_phone : '',
            'Adres ouders' => $hasProfile ? $user->profile->parent_address : '',
            'Postcode ouders' => $hasProfile ? $user->profile->parent_zip_code : '',
            'Woonplaats ouders' => $hasProfile ? $user->profile->parent_town : '',
            'Gebruikersnaam' => $user->username
        ];
    }

    public function batchCsv(Collection $users)
    {
        $batch = [];
        foreach($users as $user)
        {
            $batch[] = $this->csv($user);
        }

        return $batch;
    }
}