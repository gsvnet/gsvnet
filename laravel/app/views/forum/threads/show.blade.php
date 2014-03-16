@extends('layouts.default')

@section('content')
    <div class="column-holder">
        <h1>{{{ $thread->subject }}}</h1>
        <p class="delta">Een onderwerp gestart door {{{ $thread->author->username }}} </p>
        <div class="main-content">
            <div class="forum">

                @if(Input::get('page') < 2)
                    @include('forum.threads._thread')
                @endif

                <div class="comments">
                    @foreach($replies as $reply)
                        @include('forum.replies._show')
                    @endforeach
                </div>
            </div>
        </div>
        <div class="secondary-column">
            <h2>Iets specifiekers</h2>
            <p>Hier kan misschien iets specifiekers staan</p>

            <h2>Zoals tags</h2>
            <div class="tags">
                {{ $thread->tags->getTagList() }}
            </div>
        </div>
    </div>

    <div class="column-holder">
        {{ $replies->links() }}
    </div>

    <div class="hero-unit grey">
        <div class="column-holder">
            <h2>U hebt ook een mening natuurlijk</h2>
            <p>Wie schrijft, die blijft, he he he</p>
            <div class="main-content">
                @if(Auth::check())
                    @include('forum.replies._create')
                @else
                    <div class="login-cta">
                        <p>Wil je hierop reageren?</p> <a class="button" href="{{ action('SessionController@getLogin') }}">Log dan in.</a>
                    </div>
                @endif
            </div>
            <div class="secondary-column">
                <h2>Een reactie schrijven</h2>
                <p>De opmaak van je reactie gaat met behulp van Markdown. Dat heeft er vooral mee te maken dat de mede-oprichter van de site Mark heet, maar het is ook handig. Lees [hier] meer.</p>
            </div>
        </div>
    </div>
@stop