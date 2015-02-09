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

	'userTypesFormatted' => array(
		0 => 'Gast',
		1 => 'Noviet',
		2 => 'Lid',
		3 => 'Oud-lid'
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

//    'menuItems' => [
//	    'de-gsv' => [
//	        'url' => action('AboutController@showAbout'),
//	        'title' => 'De GSV',
//	        'submenu' => [
//	            'over-de-gsv' => [
//	                'title' => 'Over de GSV',
//	                'url' => action('AboutController@showAbout')
//	            ],
//	            'geschiedenis' => [
//	                'title' => 'Geschiedenis',
//	                'url' => action('AboutController@showHistory')
//	            ],
//	            'pijlers' => [
//	                'title' => 'Pijlers',
//	                'url' => action('AboutController@showPillars')
//	            ],
//	            'senaten' => [
//	                'title' => 'Senaten',
//	                'url' => action('AboutController@showSenates')
//	            ],
//	            'commissies' => [
//	                'title' => 'Commissies',
//	                'url' => action('AboutController@showCommittees')
//	            ],
//	            'contact' => [
//	                'title' => 'Contact',
//	                'url' => action('AboutController@showContact')
//	            ]
//	        ]
//	    ],
//
//	    'forum' => [
//	        'title' => 'Forum',
//	        'url' => action('ForumThreadsController@getIndex')
//	    ],
//
//	    'foto-album' => [
//	        'title' => 'Fotoalbum',
//	        'url' => action('PhotoController@showAlbums')
//	    ],
//
//	    'activiteiten' => [
//	        'title' => 'Activiteiten',
//	        'url' => action('EventController@showIndex')
//	    ],
//
//	    'lid-worden' => [
//	        'title' => 'Word lid!',
//	        'url' => action('MemberController@index'),
//	        'visible' => function(){return Auth::guest() || !Auth::user()->wasOrIsMember();},
//	        'submenu' => [
//	            'lid-worden' => [
//	                'url' => action('MemberController@index'),
//	                'title' => 'Lid worden?'
//	            ],
//	            'faq' => [
//	            	'url' => action('MemberController@faq'),
//	            	'title' => 'Veel gestelde vragen'
//	            ],
//	            'inschrijven' => [
//	                'url' => action('MemberController@becomeMember'),
//	                'title' => 'Inschrijven'
//	            ]
//	        ]
//	    ],
//
//	    'inloggen' => [
//	        'title' => 'Inloggen',
//	        'url' => action('SessionController@getLogin'),
//	        'params' => ['data-mfp-src' => '#login-dialog', 'id' => 'login-link', 'rel' => 'nofollow'],
//	        'visible' => function(){return Auth::guest();},
//	        'rel' => 'nofollow',
//	        'submenu' => [
//	            'registreren' => [
//	                'title' => 'Registreren',
//	       			'params' => ['rel' => 'nofollow'],
//	                'url' => action('RegisterController@create')
//	            ],
//	            'inloggen' => [
//	                'title' => 'Inloggen',
//	       			'params' => ['rel' => 'nofollow'],
//	                'url' => action('SessionController@getLogin'),
//	            ]
//	        ]
//	    ],
//
//	    'intern' => [
//	        'title' => function(){
//	            return Gravatar::image(Auth::user()->email, 'Profiel', array('class' => 'nav-profile-image', 'width' => 24, 'height' => 24)) . Auth::user()->firstname;
//	        },
//	        'url' => action('UserController@showProfile'),
//	        'visible' => function(){return Auth::check();},
//	        'submenu' => [
//	            'profiel' => [
//	                'title' => 'Profiel',
//	                'url' => action('UserController@showProfile'),
//	                'visible' => function(){
//	                    return Permission::has('users.edit-profile');
//	                }
//	            ],
//	            'jaarbundel' => [
//	                'title' => 'Jaarbundel',
//	                'url' => action('UserController@showUsers'),
//	                'visible' => function(){
//	                    return Permission::has('users.show');
//	                }
//	            ],
//                'boek-reviews' => [
//                    'title' => 'BK-boek-reviews',
//                    'url' => 'https://www.dropbox.com/sh/o06lxxza7u6a5ka/AACsPUF-MisVV3DSvrpb2B32a?dl=0',
//                    'visible' => function(){
//                        return Permission::has('docs.show');
//                    }
//                ],
//	            'docs' => [
//	                'title' => 'GSVdocs',
//	                'url' => action('FilesController@index'),
//	                'visible' => function(){
//	                    return Permission::has('docs.show');
//	                }
//	            ],
//	            'uitloggen' => [
//	                'title' => 'Uitloggen',
//	                'url' => action('SessionController@getLogout')
//	            ]
//	        ]
//	    ]
//	]
);