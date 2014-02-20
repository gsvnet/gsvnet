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
            <li class="top-level-menuitem {{ Request::is('de-gsv*') ? 'active-menu' : '' }} has-sub-menu">
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

            @if(Auth::guest() || !Auth::user()->isMember())
            <li class="top-level-menuitem {{ Request::is('word-lid*') ? 'active-menu' : '' }} has-sub-menu">
                <a class="top-level-link" href="{{ URL::action('HomeController@wordLid')}}">Lid worden?</a>
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
                    <a class="top-level-link" href="{{ URL::action('UserController@showProfile') }}">{{Gravatar::image(Auth::user()->email, 'Profiel', array('class' => 'nav-profile-image', 'width' => 72, 'height' => 72))}}</a>
                    <i class="fa fa-caret-down top-caret"></i>
                    <ul class="sub-level-menu">
                        @if(Auth::check() && Auth::user()->can('viewMemberlist'))
                        <li><a href="{{ URL::action('UserController@showUsers') }}" class="sub-level-link">Jaarbundel</a></li>
                        @endif
                        <li><a class="sub-level-link" href="{{ URL::action('FilesController@index') }}">GSVdocs</a></li>
                        <li><a class="sub-level-link" href="{{ URL::action('SessionController@getLogout') }}">Uitloggen</a></li>
                    </ul>
                </li>
            @else
                <li class="top-level-menuitem"><a class="top-level-link login-link" href="/login" data-mfp-src="#login-dialog">Inloggen</a></li>
            @endif
        </ul>
    </nav>
</header>