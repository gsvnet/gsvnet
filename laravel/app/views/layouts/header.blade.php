<?php
$menuitems = [
    'de-gsv' => [
        'url' => URL::action('AboutController@showAbout'),
        'title' => 'De GSV',
        'submenu' => [
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
        'url' => '#'
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
            'groningen' => [
                'url' => URL::action('AboutController@showHistory'),
                'title' => 'Groningen'
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
                'url' => URL::action('RegisterController@create')
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
];
?>


<header class="top-header">
    <nav class="nav-bar">
        <div class="nav-bar-extras">
            <button id="navbar-toggler" class="nav-toggle">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <h1 class="logo">
            <a class="logo-link" href="/"><span>Gereformeerde Studentenvereniging Groningen</span></a>
        </h1>
        <ul id="main-menu" class="nav-bar-links">
<?php
foreach($menuitems as $name => $item)
{
    $itemClassNames = ['top-level-menuitem'];
    $title = '';
    $params = '';

    // Check if item is not visible
    if(array_key_exists('visible', $item) && is_callable($item['visible']) && !$item['visible']())
    {
        continue;
    }

    // Get the title
    if(is_callable($item['title']))
    {
        $title = $item['title']();
    } else
    {
        $title = $item['title'];
    }

    // Add submenu class
    if(array_key_exists('submenu', $item))
    {
        $itemClassNames[] = 'has-sub-menu';
    }

    // Check if menu is active
    if($name == $activeMenuItem)
    {
        $itemClassNames[] = 'active-menu';
    }

    if(array_key_exists('params', $item) && is_array($item['params']))
    {

        foreach($item['params'] as $key => $value)
        {
            $params .= ' ' . $key . '="' . $value . '"';
        }
    }

    // Print the item
    echo '<li class="' . implode(' ', $itemClassNames) . '">';
    echo '<a class="top-level-link" href="' . htmlentities($item['url']) . '"'. $params . '>' . $title . '</a>';
    
    // Show sub menu
    if(array_key_exists('submenu', $item))
    {
        echo '<span class="top-caret"><i class="caret"></i></span>';
        echo '<ul class="sub-level-menu">';
        foreach($item['submenu'] as $subItem)
        {
            // Check if item is not visible
            if(array_key_exists('visible', $subItem) && is_callable($subItem['visible']) && !$subItem['visible']())
            {
                continue;
            }

            // Print item
            echo '<li><a class="sub-level-link" href="' . htmlentities($subItem['url']) . '">' . htmlentities($subItem['title']) . '</a></li>';
        }
        echo '</ul>';

    }

    echo '</li>';

}
?>


<!--             <li class="top-level-menuitem {{ Request::is('de-gsv*') ? 'active-menu' : '' }} has-sub-menu">
                <a class="top-level-link" href="/de-gsv">De GSV</a>
                <i class="fa fa-caret-down top-caret"></i>
                <ul class="sub-level-menu">
                    <li><a class="sub-level-link" href="{{{ URL::action('AboutController@showHistory')}}}">Geschiedenis</a></li>
                    <li><a class="sub-level-link" href="{{{ URL::action('AboutController@showPillars')}}}">Pijlers</a></li>
                    <li><a class="sub-level-link" href="{{{ URL::action('AboutController@showSenates')}}}">Senaten</a></li>
                    <li><a class="sub-level-link" href="{{{ URL::action('AboutController@showCommittees')}}}">Commissies</a></li>
                    <li><a class="sub-level-link" href="{{{ URL::action('AboutController@showContact')}}}">Contact</a></li>
                </ul>
            </li>
            <li class="top-level-menuitem {{ Request::is('forum*') ? 'active-menu' : '' }}">
                <a class="top-level-link" href="/#">Forum</a>
            </li>
            <li class="top-level-menuitem {{ Request::is('albums*') ? 'active-menu' : '' }}">
                <a class="top-level-link" href="{{ URL::action('PhotoController@showAlbums') }}">Fotoalbum</a>
            </li>
            <li class="top-level-menuitem {{ Request::is('activiteiten*') ? 'active-menu' : '' }}">
                <a class="top-level-link" href="{{ URL::action('EventController@showIndex')}}">Activiteiten</a>
            </li>

            @if(Auth::guest() || !Auth::user()->wasOrIsMember())
            <li class="top-level-menuitem {{ Request::is('word-lid*') ? 'active-menu' : '' }} has-sub-menu">
                <a class="top-level-link" href="{{ URL::action('MemberController@index')}}">Lid worden?</a>
                <i class="fa fa-caret-down top-caret"></i>
                <ul class="sub-level-menu">
                    <li><a class="sub-level-link" href="#">Waarom</a></li>
                    <li><a class="sub-level-link" href="#">Wat</a></li>
                    <li><a class="sub-level-link" href="#">Que</a></li>
                </ul>
            </li>
            @endif

            @if (Auth::check())
                <li class="top-level-menuitem {{ Request::is('intern*') ? 'active-menu' : '' }} has-sub-menu">
                    <a class="top-level-link" href="{{ URL::action('UserController@showProfile') }}">{{Gravatar::image(Auth::user()->email, 'Profiel', array('class' => 'nav-profile-image', 'width' => 24, 'height' => 24))}} {{{Auth::user()->firstname}}}</a>
                    <i class="fa fa-caret-down top-caret"></i>
                    <ul class="sub-level-menu">
                        @if (Permission::has('users.show'))
                        <li>
                            <a href="{{ URL::action('UserController@showUsers') }}" class="sub-level-link">
                                Jaarbundel
                            </a>
                        </li>
                        @endif

                        @if (Permission::has('docs.show'))
                        <li>
                            <a class="sub-level-link" href="{{ URL::action('FilesController@index') }}">
                                GSVdocs
                            </a>
                        </li>
                        @endif

                        <li><a class="sub-level-link" href="{{ URL::action('SessionController@getLogout') }}">Uitloggen</a></li>
                    </ul>
                </li>
            @else
                <li class="top-level-menuitem has-sub-menu">
                    <a class="top-level-link login-link" href="{{{ URL::action('SessionController@getLogin') }}}" data-mfp-src="#login-dialog">
                        Inloggen
                    </a>
                    <i class="fa fa-caret-down top-caret"></i>
                    <ul class="sub-level-menu">
                        <li><a class="sub-level-link" href="{{ URL::action('RegisterController@create') }}">Registreren</a></li>
                        <li><a class="sub-level-link" href="{{ URL::action('SessionController@getLogin') }}" data-mfp-src="#login-dialog">Inloggen</a></li>
                    </ul>
                </li>
            @endif
        </ul>
 -->
    </nav>
    @if(array_key_exists($activeMenuItem, $menuitems) && array_key_exists('submenu', $menuitems[$activeMenuItem]))
    <nav class="extra-submenu-nav">
        <ul class="extra-submenu">
<?php
        foreach($menuitems[$activeMenuItem]['submenu'] as $subItem)
        {
            // Check if item is not visible
            if(array_key_exists('visible', $subItem) && is_callable($subItem['visible']) && !$subItem['visible']())
            {
                continue;
            }

            // Print item
            echo '<li class="top-level-menuitem"><a class="top-level-link" href="' . htmlentities($subItem['url']) . '">' . htmlentities($subItem['title']) . '</a></li>';
        }
?>
        </ul>
    </nav>
    @endif
</header>