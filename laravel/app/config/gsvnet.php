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
		4 => 'Regio IV'
	),

	'events' => array(
		'maxYear' => date('Y') + 1,
		'minYear' => date('Y') - 2
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

    // 'email' => array(
    //     'admin'         => 'webcie@gsvnet.nl',
    //     'senate'        => 'senaat@gsvnet.nl',
    //     'membership'    => 'novcie@gsvnet.nl',
    //     'profile'       => 'abactis@gsvnet.nl'
    // ),

    'email' => array(
        'admin'         => 'haampie@gmail.com',
        'senate'        => 'haampie@gmail.com',
        'membership'    => 'haampie@gmail.com',
        'profile'       => 'haampie@gmail.com'
    ),

    'menuItems' => [
	    'de-gsv' => [
	        'url' => URL::action('AboutController@showAbout'),
	        'title' => 'De GSV',
	        'submenu' => [
	            'over-de-gsv' => [
	                'title' => 'Over de GSV',
	                'url' => URL::action('AboutController@showAbout')
	            ],
	            'geschiedenis' => [
	                'title' => 'Geschiedenis',
	                'url' => URL::action('AboutController@showHistory')
	            ],
	            'pijlers' => [
	                'title' => 'Pijlers',
	                'url' => URL::action('AboutController@showPillars')
	            ],
	            'senaten' => [
	                'title' => 'Senaten',
	                'url' => URL::action('AboutController@showSenates')
	            ],
	            'commissies' => [
	                'title' => 'Commissies',
	                'url' => URL::action('AboutController@showCommittees')
	            ],
	            'contact' => [
	                'title' => 'Contact',
	                'url' => URL::action('AboutController@showContact')
	            ]
	        ]
	    ],

	    'forum' => [
	        'title' => 'Forum',
	        'url' => URL::action('ForumThreadsController@getIndex')
	    ],

	    'foto-album' => [
	        'title' => 'Fotoalbum',
	        'url' => URL::action('PhotoController@showAlbums')
	    ],

	    'activiteiten' => [
	        'title' => 'Activiteiten',
	        'url' => URL::action('EventController@showIndex')
	    ],

	    'lid-worden' => [
	        'title' => 'Lid worden?',
	        'url' => URL::action('MemberController@index'),
	        'visible' => function(){return Auth::guest() || !Auth::user()->wasOrIsMember();},
	        'submenu' => [
	            'lid-worden' => [
	                'url' => URL::action('MemberController@index'),
	                'title' => 'Lid worden?'
	            ],
	            'inschrijven' => [
	                'url' => URL::action('MemberController@becomeMember'),
	                'title' => 'Inschrijven'
	            ]
	        ]
	    ],

	    'inloggen' => [
	        'title' => 'Inloggen',
	        'url' => URL::action('SessionController@getLogin'),
	        'params' => ['data-mfp-src' => '#login-dialog', 'id' => 'login-link'],
	        'visible' => function(){return Auth::guest();},
	        'submenu' => [
	            'registreren' => [
	                'title' => 'Registreren',
	                'url' => URL::action('RegisterController@create')
	            ],
	            'inloggen' => [
	                'title' => 'Inloggen',
	                'url' => URL::action('SessionController@getLogin'),
	            ]
	        ]
	    ],

	    'intern' => [
	        'title' => function(){
	            return Gravatar::image(Auth::user()->email, 'Profiel', array('class' => 'nav-profile-image', 'width' => 24, 'height' => 24)) . Auth::user()->firstname;
	        },
	        'url' => URL::action('UserController@showProfile'),
	        'visible' => function(){return Auth::check();},
	        'submenu' => [
	            'jaarbundel' => [
	                'title' => 'Jaarbundel',
	                'url' => URL::action('UserController@showUsers'),
	                'visible' => function(){
	                    return Permission::has('users.show');
	                }
	            ],
	            'docs' => [
	                'title' => 'GSVdocs',
	                'url' => URL::action('FilesController@index'),
	                'visible' => function(){
	                    return Permission::has('docs.show');
	                }
	            ],
	            'uitloggen' => [
	                'title' => 'Uitloggen',
	                'url' => URL::action('SessionController@getLogout')
	            ]
	        ]
	    ]
	]
);