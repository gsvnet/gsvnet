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

    <div id="reageer" class="hero-unit grey {{$replies->getCurrentPage() != $replies->getLastPage() && $replies->getLastPage() > 1 ? 'hidden-form' : ''}}">
        <div class="column-holder">
            <h2>U hebt ook een mening!</h2>
            <p>Uw mening is mogelijk belangrijker, dus reageer!</p>
            @if(Auth::check())
                @include('forum.replies._create')
            @else
                <p><a class="button" href="{{ action('SessionController@getLogin') }}">Log in om te reageren</a>
            @endif
        </div>
    </div>
@stop