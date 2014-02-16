<?php

return array(
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
    )
);