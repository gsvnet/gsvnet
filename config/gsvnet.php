<?php

return [
    /**
     *   User Types
     *
     *   visitor:      geregistreerd maar niet word lid ingevuld
     *   potential:    geregistreerd, heeft word lid ingevuld, maar is nog geen lid
     *   member:       lid bij de vereniging
     *   reunist:      reünist bij de vereninging
     *   exMember:     oud-lid van de vereniging
     *   
     */
    'userTypes' => [
        'visitor' => 0,
        'potential' => 1,
        'member' => 2,
        'reunist' => 3,
        'internalCommittee' => 4,
        'exMember' => 5
    ],

    'userTypesFormatted' => [
        0 => 'Gast',
        1 => 'Noviet',
        2 => 'Lid',
        3 => 'Reünist',
        4 => 'Interne commissie',
        5 => 'Oud-lid'
    ],

    'eventTypes' => [
        'intellectual',
        'social',
        'collegiate',
        'christian',
        'gsv'
    ],

    'eventTypesPresented' => [
        'Intellectueel',
        'Sociaal',
        'Studentikoos',
        'Christelijk',
        'GSV'
    ],

    'events' => [
        'maxYear' => date('Y') + 1,
        'minYear' => 2013
    ],

    'senateFunctions' => [
        1 => 'Praeses',
        2 => 'Abactis',
        3 => 'Fiscus',
        4 => 'Assessor Primus',
        5 => 'Assessor Secundus'
    ],

    'months' => [
        'januari' => '01',
        'februari' => '02',
        'maart' => '03',
        'april' => '04',
        'mei' => '05',
        'juni' => '06',
        'juli' => '07',
        'augustus' => '08',
        'september' => '09',
        'oktober' => '10',
        'november' => '11',
        'december' => '12'
    ],

    'email' => [
        'admin' => env('ADMIN_MAIL', 'webcie@gsvnet.nl'),
        'senate' => env('SENATE_MAIL', 'abactis@gsvnet.nl'),
        'membership' => env('NOVCIE_MAIL', 'novcie@gsvnet.nl'),
        'prescie' => env('PRESCIE_MAIL', 'prescie@gsvnet.nl'),
        'profile' => env('PROFILE_MAIL', 'abactis@gsvnet.nl')
    ],

    'notificationsUrl' => env('NOTIFICATIONS', 'https://notifications.gsvnet.nl/'),

    'malfondsUrl' => env('MALFONDS_URL', 'https://www.malfonds.nl'),
];