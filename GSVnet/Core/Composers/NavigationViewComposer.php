<?php namespace GSVnet\Core\Composers;

use forxer\Gravatar\Gravatar;
use GSVnet\Permissions\Permission;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class NavigationViewComposer {

    public function compose(View $view)
    {
        $view->menu = $this->getStructure();
    }

    private function getStructure()
    {
        return [
            'de-gsv' => [
                'url' => action('AboutController@showAbout'),
                'title' => 'De GSV',
                'submenu' => [
                    'over-de-gsv' => [
                        'title' => 'Over de GSV',
                        'url' => action('AboutController@showAbout')
                    ],
                    'geschiedenis' => [
                        'title' => 'Geschiedenis',
                        'url' => action('AboutController@showHistory')
                    ],
                    'pijlers' => [
                        'title' => 'Pijlers',
                        'url' => action('AboutController@showPillars')
                    ],
                    'senaten' => [
                        'title' => 'Senaten',
                        'url' => action('AboutController@showSenates')
                    ],
                    'commissies' => [
                        'title' => 'Commissies',
                        'url' => action('AboutController@showCommittees')
                    ],
                    'contact' => [
                        'title' => 'Contact',
                        'url' => action('AboutController@showContact')
                    ]
                ]
            ],

            'forum' => [
                'title' => 'Forum',
                'url' => action('ForumThreadsController@getIndex')
            ],

            'foto-album' => [
                'title' => 'Fotoalbum',
                'url' => action('PhotoController@showAlbums')
            ],

            'activiteiten' => [
                'title' => 'Activiteiten',
                'url' => action('EventController@showIndex')
            ],

            'lid-worden' => [
                'title' => 'Word lid!',
                'url' => action('MemberController@index'),
                'visible' => function(){return Auth::guest() || !Auth::user()->wasOrIsMember();},
                'submenu' => [
                    'lid-worden' => [
                        'url' => action('MemberController@index'),
                        'title' => 'Lid worden?'
                    ],
                    'faq' => [
                        'url' => action('MemberController@faq'),
                        'title' => 'Veel gestelde vragen'
                    ],
                    'inschrijven' => [
                        'url' => action('MemberController@becomeMember'),
                        'title' => 'Inschrijven'
                    ]
                ]
            ],

            'inloggen' => [
                'title' => 'Inloggen',
                'url' => action('SessionController@getLogin'),
                'params' => ['data-mfp-src' => '#login-dialog', 'id' => 'login-link', 'rel' => 'nofollow'],
                'visible' => function(){return Auth::guest();},
                'rel' => 'nofollow',
                'submenu' => [
                    'registreren' => [
                        'title' => 'Registreren',
                        'params' => ['rel' => 'nofollow'],
                        'url' => action('RegisterController@create')
                    ],
                    'inloggen' => [
                        'title' => 'Inloggen',
                        'params' => ['rel' => 'nofollow'],
                        'url' => action('SessionController@getLogin'),
                    ]
                ]
            ],

            'intern' => [
                'title' => function(){
                    return '<img src="' . Gravatar::image(Auth::user()->email, 24, 'mm') . '" width="24" height="24" class="nav-profile-image">' . Auth::user()->firstname;
                },
                'url' => action('UserController@showProfile'),
                'visible' => function(){return Auth::check();},
                'submenu' => [
                    'profiel' => [
                        'title' => 'Profiel',
                        'url' => action('UserController@showProfile'),
                        'visible' => function(){
                            return Permission::has('users.edit-profile');
                        }
                    ],
                    'jaarbundel' => [
                        'title' => 'Jaarbundel',
                        'url' => action('UserController@showUsers'),
                        'visible' => function(){
                            return Permission::has('users.show');
                        }
                    ],
                    'boek-reviews' => [
                        'title' => 'BK-boek-reviews',
                        'url' => 'https://www.dropbox.com/sh/o06lxxza7u6a5ka/AACsPUF-MisVV3DSvrpb2B32a?dl=0',
                        'visible' => function(){
                            return Permission::has('docs.show');
                        }
                    ],
                    'docs' => [
                        'title' => 'GSVdocs',
                        'url' => action('FilesController@index'),
                        'visible' => function(){
                            return Permission::has('docs.show');
                        }
                    ],
                    'uitloggen' => [
                        'title' => 'Uitloggen',
                        'url' => action('SessionController@getLogout')
                    ]
                ]
            ]
        ];
    }
}