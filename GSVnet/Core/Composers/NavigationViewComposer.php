<?php namespace GSVnet\Core\Composers;

use forxer\Gravatar\Gravatar;
use GSVnet\Permissions\Permission;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class NavigationViewComposer {

    private $structure;
    private $activeMenu;
    private $activeSubMenu;

    public function compose(View $view)
    {
        $this->structure = $this->getStructure();
        $this->setActiveMenuItem();

        $view->menu = $this->render();
        $view->additionalMenu = $this->renderAdditionalMenu();
    }

    private function render()
    {
        $menu = '<ul id="main-menu" class="nav-bar-links">';

        foreach($this->structure as $item => $details)
            $menu .= $this->makeItem($item, $details);

        $menu .= '</ul>';

        return $menu;
    }

    private function makeItem($item, $details)
    {
        $html = '';
        $itemClassNames = ['top-level-menuitem'];
        $params = '';

        // Check if item is not visible
        if(array_key_exists('visible', $details) && is_callable($details['visible']) && !$details['visible']())
            return '';

        // Get the title
        if(is_callable($details['title']))
            $title = $details['title']();
        else
            $title = $details['title'];

        // Add submenu class
        if(array_key_exists('submenu', $details))
            $itemClassNames[] = 'has-sub-menu';

        // Check if menu is active
        if($item == $this->activeMenu)
            $itemClassNames[] = 'active-menu';

        if(array_key_exists('params', $details) && is_array($details['params']))
            foreach($details['params'] as $key => $value)
                $params .= ' ' . $key . '="' . $value . '"';

        // Print the item
        $html .= '<li class="' . implode(' ', $itemClassNames) . '">';
        $html .= '<a class="top-level-link" href="' . e($details['url']) . '"'. $params . '>' . $title . '</a>';

        // Show sub menu
        if(array_key_exists('submenu', $details))
            $html .= $this->makeSubMenu($details['submenu']);

        $html .= '</li>';

        return $html;
    }

    private function makeSubMenu($subMenu)
    {
        $html = '<span class="top-caret"><i class="caret"></i></span>';
        $html .= '<ul class="sub-level-menu">';

        foreach($subMenu as $subItem)
        {
            $params = '';

            // Check if item is not visible
            if(array_key_exists('visible', $subItem) && is_callable($subItem['visible']) && !$subItem['visible']())
                continue;

            if(array_key_exists('params', $subItem) && is_array($subItem['params']))
                foreach($subItem['params'] as $key => $value)
                    $params .= ' ' . $key . '="' . $value . '"';

            // Print item
            $html .= '<li><a class="sub-level-link" href="' . e($subItem['url']) . '"' . $params . '>' . e($subItem['title']) . '</a></li>';
        }
        $html .= '</ul>';

        return $html;
    }

    private function renderAdditionalMenu()
    {
        if(!array_key_exists($this->activeMenu, $this->structure) || !array_key_exists('submenu', $this->structure[$this->activeMenu]))
            return '';

        $html = '<nav class="extra-submenu-nav">';
        $html .= '<ul class="extra-submenu">';

        foreach($this->structure[$this->activeMenu]['submenu'] as $name => $item)
            $html .= $this->renderAdditionalMenuItem($name, $item);

        $html .= ' </ul>';
        $html .= '</nav>';

        return $html;
    }

    private function renderAdditionalMenuItem($name, $item)
    {
        // Check if item is not visible
        if(array_key_exists('visible', $item) && is_callable($item['visible']) && !$item['visible']())
            return '';

        // Print item
        $html = '<li class="top-level-menuitem' . ($this->activeSubMenu == $name ? ' active' :  '') . '">';
        $html .= '<a class="top-level-link" href="' . e($item['url']) . '">' . e($item['title']) . '</a></li>';

        return $html;
    }

    private function setActiveMenuItem()
    {
        $this->activeMenu = '';
        $this->activeSubMenu = '';

        $segments = explode('/', \Request::path());
        $sub = '';
        $menu = '';

        if(count($segments) > 0)
            $menu = $segments[0];

        if(count($segments) > 1)
            $sub = $segments[1];

        if(array_key_exists($menu, $this->structure))
            $this->activeMenu = $menu;
        else
            return;

        if(array_key_exists('submenu', $this->structure[$menu]) && array_key_exists($sub, $this->structure[$menu]['submenu']))
            $this->activeSubMenu = $sub;
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

            'albums' => [
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
                    'bestanden' => [
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