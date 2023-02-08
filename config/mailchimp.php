<?php

use App\Helpers\Users\User;

return [
    'key' => env('MAILCHIMP_APIKEY'),
    'lists' => [
        User::MEMBER => env('MAILCHIMP_MEMBERS', 'c5f9a07ee4'),
        User::REUNIST => env('MAILCHIMP_FORMERMEMBERS', 'f844adabde'),
    ],
];
