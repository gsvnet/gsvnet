<?php

use App\Helpers\Users\User;

return [
    'key' => 'secret', //env('MAILCHIMP_APIKEY'),
    'server' => 'LOOKUPINACCOUNT', //env('MAILCHIMP_SERVER')
    'lists' => [
        User::MEMBER => 'listnr', // env('MAILCHIMP_MEMBERS', 'c5f9a07ee4'),
        User::REUNIST => 'listnr', // env('MAILCHIMP_FORMERMEMBERS', 'f844adabde'),
    ],
];
