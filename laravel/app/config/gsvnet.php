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
		'formerMember' => 3
	),

	'eventTypes' => array(
		'intellectual',
		'social',
		'collegiate',
		'christian'
	),

	'regions' => array(
		1 => 'Regio 1',
		2 => 'Regio 2',
		3 => 'Regio 3',
		4 => 'Regio IV'
	),

	'events' => array(
		'maxYear' => date('Y') + 1,
		'minYear' => date('Y') - 2
	),

	'senateFunctions' => array(
		1 => 'Praeses',
		2 => 'Assessor Primus',
		3 => 'Assessor Secundus',
		4 => 'Abactis',
		5 => 'Fiscus'
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
        'admin'  => 'markredeman@gmail.com', //'webcie@gsvnet.nl',
        'senate' => 'senaat@gsvnet.nl',
    )
);