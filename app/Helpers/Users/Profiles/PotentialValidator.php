<?php

namespace App\Helpers\Users\Profiles;

use App\Helpers\Core\Validator;

class PotentialValidator extends Validator
{
    public static $rules = [
        'photo_path' => 'image',
        'firstname' => 'required',
        'lastname' => 'required',
        'gender' => 'required|in:0,1',
        'birthdate' => 'required|date_format:Y-m-d',
        'address' => 'required',
        'zipCode' => 'required',
        'town' => 'required',
        'email' => 'required_if:new_user,1|email',
        'phone' => 'required',
        'studentNumber' => '',
        'study' => 'required',
        'username' => 'required_if:new_user,1',
        'password' => 'required_if:new_user,1|confirmed',
        'parentsAddress' => 'required_if:parents-same-address,0',
        'parentsZipCode' => 'required_if:parents-same-address,0',
        'parentsTown' => 'required_if:parents-same-address,0',
        'parentsPhone' => 'required',
        'parentsEmail' => 'required|email',
        'g-recaptcha-response' => 'required|recaptcha',
    ];

    public static $messages = [
        'photo_path.required' => 'Selecteer een foto van jezelf',
        'photo_path.image' => 'Selecteer een foto van jezelf',
        'firstname.required' => 'Vul je voornaam in',
        'lastname.required' => 'Vul je achternaam in',
        'gender.required' => 'Selecteer je geslacht',
        'gender.in' => 'Selecteer je geslacht',
        'birthdate.required' => 'Vul een geboortedatum in',
        'birthdate.date_format' => 'Vul een geldige geboortedatum in',
        'address.required' => 'Vul een adres in',
        'zipCode.required' => 'Vul een postcode in',
        'town.required' => 'Vul een woonplaats in',
        'email.required_if' => 'Vul een emailadres in',
        'email.email' => 'Vul een geldig emailadres in',
        'phone.required' => 'Vul een telefoonnummer in',
        'study.required' => 'Vul een studie in',
        'username.required_if' => 'Kies een gebruikersnaam',
        'password.required_if' => 'Kies een wachtwoord',
        'password.confirmed' => 'Kies een wachtwoord',
        'parentsAddress.required_if' => 'Vul het adres van je ouders in',
        'parentsZipCode.required_if' => 'Vul de postcode van je ouders in',
        'parentsTown.required_if' => 'Vul de woonplaats van je ouders in',
        'parentsPhone.required' => 'Vul het telefoonnummer van je ouders in',
        'parentsEmail.required' => 'Vul het emailadres van je ouders in',
        'parentsEmail.email' => 'Vul een geldig emailadres van je ouders in',
        'g-recaptcha-response.required' => 'Vul de verificatie van recaptcha in',
        'g-recaptcha-response.recaptcha' => 'Vul de verificatie van recaptcha in',
    ];
}
