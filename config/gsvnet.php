<?php

return array(
    /**
    *   User Types
    *
    *   visitor:      ingelogd maar niet word lid ingevuld
    *   potential:    ingelogd, heeft word lid ingevuld, maar is nog niet confirmed
    *   member:       ingelogd, en is confirmed lid van vereniging
    *   formerMember: ingelogd, oud lid van vereninging
    */
	'userTypes' => array(
		'visitor' => 0,
		'potential' => 1,
		'member' => 2,
		'formerMember' => 3,
        'internalCommittee' => 4
	),

	'userTypesFormatted' => array(
		0 => 'Gast',
		1 => 'Noviet',
		2 => 'Lid',
		3 => 'Oud-lid',
        4 => 'Interne commissie'
	),

	'eventTypes' => array(
		'intellectual',
		'social',
		'collegiate',
		'christian',
		'gsv'
	),

	'eventTypesPresented' => array(
		'Intellectueel',
		'Sociaal',
		'Studentikoos',
		'Christelijk',
		'GSV'
	),

	'regions' => array(
		1 => 'Regio 1',
		2 => 'Regio 2',
		3 => 'Regio 3',
        4 => 'Regio IV',
        5 => 'Rood',
        6 => 'Oranje',
        7 => 'Geel',
        8 => 'Groen',
        9 => 'Blauw',
        10 => 'Paars',
        11 => 'A',
        12 => 'B',
        13 => 'C',
        14 => 'D'
	),

	'events' => array(
		'maxYear' => date('Y') + 1,
		'minYear' => 2013
	),

	'senateFunctions' => array(
		1 => 'Praeses',
		2 => 'Abactis',
		3 => 'Fiscus',
		4 => 'Assessor Primus',
		5 => 'Assessor Secundus'
	),

	'months' => array(
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
    ),

    'email' => array(
        'admin' => env('ADMIN_MAIL', 'webcie@gsvnet.nl'),
        'senate' => env('SENATE_MAIL', 'abactis@gsvnet.nl'),
        'membership' => env('NOVCIE_MAIL', 'novcie2014@gmail.com'),
        'profile' => env('PROFILE_MAIL', 'abactis@gsvnet.nl')
    ),
);