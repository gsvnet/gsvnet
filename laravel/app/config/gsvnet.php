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

    'email' => array(
        'admin'         => 'webcie@gsvnet.nl',
        'senate'        => 'abactis@gsvnet.nl',
        'membership'    => 'novcie2014@gmail.com',
        'profile'       => 'abactis@gsvnet.nl'
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

	    'op-kamers' => [
	    	'title' => 'Op kamers!',
	    	'url' => 'http://gsvnet.nl/forum/03-07-2014-kamer-aanbodvraag-overzicht'
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
	        'title' => 'Word lid!',
	        'url' => URL::action('MemberController@index'),
	        'visible' => function(){return Auth::guest() || !Auth::user()->wasOrIsMember();},
	        'submenu' => [
	            'lid-worden' => [
	                'url' => URL::action('MemberController@index'),
	                'title' => 'Lid worden?'
	            ],
	            'faq' => [
	            	'url' => URL::action('MemberController@faq'),
	            	'title' => 'Veel gestelde vragen'
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
	        'params' => ['data-mfp-src' => '#login-dialog', 'id' => 'login-link', 'rel' => 'nofollow'],
	        'visible' => function(){return Auth::guest();},
	        'rel' => 'nofollow',
	        'submenu' => [
	            'registreren' => [
	                'title' => 'Registreren',
	       			'params' => ['rel' => 'nofollow'],
	                'url' => URL::action('RegisterController@create')
	            ],
	            'inloggen' => [
	                'title' => 'Inloggen',
	       			'params' => ['rel' => 'nofollow'],
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
	            'profiel' => [
	                'title' => 'Profiel',
	                'url' => URL::action('UserController@showProfile'),
	                'visible' => function(){
	                    return Permission::has('users.edit-profile');
	                }
	            ],
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