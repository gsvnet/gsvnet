<?php

namespace App\Helpers\Core\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NavigationViewComposer
{
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

        foreach ($this->structure as $item => $details) {
            $menu .= $this->makeItem($item, $details);
        }

        $menu .= '</ul>';

        return $menu;
    }

    private function makeItem($item, $details)
    {
        $html = '';
        $itemClassNames = ['top-level-menuitem'];
        $params = '';

        // Check if item is not visible
        if (array_key_exists('visible', $details) && is_callable($details['visible']) && ! $details['visible']()) {
            return '';
        }

        // Get the title
        if (is_callable($details['title'])) {
            $title = $details['title']();
        } else {
            $title = $details['title'];
        }

        // Add submenu class
        if (array_key_exists('submenu', $details)) {
            $itemClassNames[] = 'has-sub-menu';
        }

        // Check if menu is active
        if ($item == $this->activeMenu) {
            $itemClassNames[] = 'active-menu';
        }

        if (array_key_exists('params', $details) && is_array($details['params'])) {
            foreach ($details['params'] as $key => $value) {
                $params .= ' '.$key.'="'.$value.'"';
            }
        }

        // Print the item
        $html .= '<li class="'.implode(' ', $itemClassNames).'">';
        $html .= '<a class="top-level-link" href="'.e($details['url']).'"'.$params.'>'.$title.'</a>';

        // Show sub menu
        if (array_key_exists('submenu', $details)) {
            $html .= $this->makeSubMenu($details['submenu']);
        }

        $html .= '</li>';

        return $html;
    }

    private function makeSubMenu($subMenu)
    {
        $html = '<span class="top-caret" role="button" aria-expanded="false"><i class="caret"></i></span>';
        $html .= '<ul class="sub-level-menu">';

        foreach ($subMenu as $subItem) {
            $params = '';

            // Check if item is not visible
            if (array_key_exists('visible', $subItem) && is_callable($subItem['visible']) && ! $subItem['visible']()) {
                continue;
            }

            if (array_key_exists('params', $subItem) && is_array($subItem['params'])) {
                foreach ($subItem['params'] as $key => $value) {
                    $params .= ' '.$key.'="'.$value.'"';
                }
            }

            // Print item
            $html .= '<li><a class="sub-level-link" href="'.e($subItem['url']).'"'.$params.'>'.e($subItem['title']).'</a></li>';
        }
        $html .= '</ul>';

        return $html;
    }

    private function renderAdditionalMenu()
    {
        if (! array_key_exists($this->activeMenu, $this->structure) || ! array_key_exists('submenu', $this->structure[$this->activeMenu])) {
            return '';
        }

        $html = '<nav class="extra-submenu-nav">';
        $html .= '<ul class="extra-submenu">';

        foreach ($this->structure[$this->activeMenu]['submenu'] as $name => $item) {
            $html .= $this->renderAdditionalMenuItem($name, $item);
        }

        $html .= ' </ul>';
        $html .= '</nav>';

        return $html;
    }

    private function renderAdditionalMenuItem($name, $item)
    {
        // Check if item is not visible
        if (array_key_exists('visible', $item) && is_callable($item['visible']) && ! $item['visible']()) {
            return '';
        }

        // Print item
        $html = '<li class="top-level-menuitem'.($this->activeSubMenu == $name ? ' active' : '').'">';
        $html .= '<a class="top-level-link" href="'.e($item['url']).'">'.e($item['title']).'</a></li>';

        return $html;
    }

    private function setActiveMenuItem()
    {
        $this->activeMenu = '';
        $this->activeSubMenu = '';

        $segments = explode('/', \Request::path());
        $sub = '';
        $menu = '';

        if (count($segments) > 0) {
            $menu = $segments[0];
        }

        if (count($segments) > 1) {
            $sub = $segments[1];
        }

        if (array_key_exists($menu, $this->structure)) {
            $this->activeMenu = $menu;
        } else {
            return;
        }

        // Stop if there is no sub menu
        if (! array_key_exists('submenu', $this->structure[$menu])) {
            return;
        }

        if (empty($sub)) {
            $firstItem = reset($this->structure[$menu]['submenu']);

            // Set active sub element to the first submenu item
            if ($firstItem['url'] == $this->structure[$menu]['url']) {
                $this->activeSubMenu = key($this->structure[$menu]['submenu']);

                return;
            }
        }

        if (array_key_exists($sub, $this->structure[$menu]['submenu'])) {
            $this->activeSubMenu = $sub;
        }
    }

    private function getStructure()
    {
        return [
            'gsvgroningen' => [
                'title' => 'GSV Groningen',
                'url' => action([\App\Http\Controllers\HomeController::class, 'showIndex']),
            ],

            //            'de-gsv' => [
            //                'url' => action([\App\Http\Controllers\AboutController::class, 'showAbout']),
            //                'title' => 'De GSV',
            //                'submenu' => [
            //                    'over-de-gsv' => [
            //                        'title' => 'Over de GSV',
            //                        'url' => action([\App\Http\Controllers\AboutController::class, 'showAbout'])
            //                    ],
            //                    'geschiedenis' => [
            //                        'title' => 'Geschiedenis',
            //                        'url' => action([\App\Http\Controllers\AboutController::class, 'showHistory'])
            //                    ],
            //                    'pijlers' => [
            //                        'title' => 'Pijlers',
            //                        'url' => action([\App\Http\Controllers\AboutController::class, 'showPillars'])
            //                    ],
            //                    'senaten' => [
            //                        'title' => 'Senaten',
            //                        'url' => action([\App\Http\Controllers\AboutController::class, 'showSenates'])
            //                    ],
            //                    'vertrouwenspersonen' => [
            //                        'title' => 'Vertrouwenspersonen',
            //                        'url' => action([\App\Http\Controllers\AboutController::class, 'showConfidants'])
            //                    ],
            //                    'commissies' => [
            //                        'title' => 'Commissies',
            //                        'url' => action([\App\Http\Controllers\AboutController::class, 'showCommittees'])
            //                    ],
            //                    'contact' => [
            //                        'title' => 'Contact',
            //                        'url' => action([\App\Http\Controllers\AboutController::class, 'showContact'])
            //                    ],
            ////                    'oud-leden' => [
            ////                        'title' => 'Oud-leden',
            ////                        'url' => action([\App\Http\Controllers\AboutController::class, 'showFormerMembers'])
            ////                    ]
            //                ]
            //            ],

            //            'kei' => [
            //                'title' => 'KEI-week',
            //                'url' => action([\App\Http\Controllers\HomeController::class, 'showKei'])
            //            ],

            'forum' => [
                'title' => 'Forum',
                'url' => action([\App\Http\Controllers\ForumThreadsController::class, 'getIndex']),
            ],

            //            'albums' => [
            //                'title' => 'Fotoalbum',
            //                'url' => action([\App\Http\Controllers\PhotoController::class, 'showAlbums'])
            //            ],
            //
            //            'activiteiten' => [
            //                'title' => 'Activiteiten',
            //                'url' => action([\App\Http\Controllers\EventController::class, 'showIndex'])
            //            ],

            //            'word-lid' => [
            //                'title' => 'Word lid!',
            //                'url' => action([\App\Http\Controllers\MemberController::class, 'index']),
            //                'visible' => function(){
            //                    return Auth::guest() || Gate::allows('user.become-member');
            //                },
            //                'submenu' => [
            //                    'lid-worden' => [
            //                        'url' => action([\App\Http\Controllers\MemberController::class, 'index']),
            //                        'title' => 'Lid worden?'
            //                    ],
            //                    'studie' => [
            //                        'url' => action([\App\Http\Controllers\MemberController::class, 'study']),
            //                        'title' => 'Studie & Vereniging'
            //                    ],
            //                    'corona' => [
            //                        'url' => action([\App\Http\Controllers\MemberController::class, 'showCorona']),
            //                        'title' => 'Q&A Corona'
            //                    ],
            //                    'veel-gestelde-vragen' => [
            //                        'url' => action([\App\Http\Controllers\MemberController::class, 'faq']),
            //                        'title' => 'Veelgestelde vragen'
            //                    ],
            //                    'klachtencommissie' => [
            //                        'url' => action([\App\Http\Controllers\MemberController::class, 'complaints']),
            //                        'title' => 'Klachtencommissie'
            //                    ],
            //                    'inschrijven' => [
            //                        'url' => action([\App\Http\Controllers\MemberController::class, 'becomeMember']),
            //                        'title' => 'Inschrijven'
            //                    ]
            //                ]
            //            ],

            'activiteiten' => [
                'title' => 'Activiteiten',
                'url' => action([\App\Http\Controllers\EventController::class, 'showIndex']),
                'visible' => function () {
                    return Auth::check() && Gate::allows('events.show-private');
                },
            ],

            'jaarbundel' => [
                'title' => 'Jaarbundel',
                'url' => action([\App\Http\Controllers\UserController::class, 'showUsers']),
                'visible' => function () {
                    return Auth::check() && Gate::allows('users.show');
                },
            ],

            'gsv-fotos' => [
                'title' => 'GSV-foto\'s',
                'url' => 'https://www.dropbox.com/sh/35nn6690kcvk7wx/AACnG0OpTvw4I1WcvwUhOZYaa?dl=0',
                'visible' => function () {
                    return Auth::check() && Gate::allows('dropbox.show');
                },
            ],

            'inloggen' => [
                'title' => 'Inloggen',
                'url' => action([\App\Http\Controllers\SessionController::class, 'getLogin']),
                'params' => ['data-mfp-src' => '#login-dialog', 'id' => 'login-link', 'rel' => 'nofollow'],
                'visible' => function () {
                    return Auth::guest();
                },
                'rel' => 'nofollow',
            ],

            'intern' => [
                'title' => function () {
                    return '<img src="'.Auth::user()->present()->avatar(24).'" width="24" height="24" class="nav-profile-image">'.Auth::user()->firstname;
                },
                'url' => action([\App\Http\Controllers\UserController::class, 'showProfile']),
                'visible' => function () {
                    return Auth::check();
                },
                'submenu' => [
                    'profiel' => [
                        'title' => 'Profiel',
                        'url' => action([\App\Http\Controllers\UserController::class, 'showProfile']),
                        'visible' => function () {
                            return Gate::allows('users.edit-profile');
                        },
                    ],
                    'commissies' => [
                        'title' => 'Commissies',
                        'url' => action([\App\Http\Controllers\AboutController::class, 'showCommittees']),
                    ],
                    'senaten' => [
                        'title' => 'Senaten',
                        'url' => action([\App\Http\Controllers\AboutController::class, 'showSenates']),
                    ],
                    'bk-materiaal' => [
                        'title' => 'BK-materiaal',
                        'url' => 'https://www.dropbox.com/sh/o06lxxza7u6a5ka/AACsPUF-MisVV3DSvrpb2B32a?dl=0',
                        'visible' => function () {
                            return Gate::allows('dropbox.show');
                        },
                    ],
                    'bestanden' => [
                        'title' => 'GSVdocs',
                        'url' => action([\App\Http\Controllers\FilesController::class, 'index']),
                        'visible' => function () {
                            return Gate::allows('docs.show');
                        },
                    ],
                    'admin' => [
                        'title' => 'Admin',
                        'url' => action([\App\Http\Controllers\Admin\AdminController::class, 'index']),
                        'visible' => function () {
                            return Gate::allows('admin.show');
                        },
                    ],
                    'sponsorprogramma' => [
                        'title' => 'Sponsors',
                        'url' => action([\App\Http\Controllers\HomeController::class, 'sponsorProgram']),
                    ],
                    'uitloggen' => [
                        'title' => 'Uitloggen',
                        'url' => action([\App\Http\Controllers\SessionController::class, 'getLogout']),
                    ],
                ],
            ],
        ];
    }
}
