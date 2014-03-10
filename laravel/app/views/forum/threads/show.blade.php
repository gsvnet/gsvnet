@extends('layouts.default')

@section('content')
    <div class="column-holder">
        <h1>{{ $thread->subject }}</h1>
        <div class="main-content">
            <div class="forum">
                <div class="header">
                    {{ $replies->links() }}
                </div>

                @if(Input::get('page') < 2)
                    @include('forum.threads._thread')
                @endif

                <div class="comments">
                    @foreach($replies as $reply)
                        @include('forum.replies._show')
                    @endforeach
                </div>
                {{ $replies->links() }}
            </div>

            @if(Auth::check())
                @include('forum.replies._create')
            @else
                <div class="login-cta">
                    <p>Wil je hierop reageren?</p> <a class="button" href="{{ action('AuthController@getLogin') }}">Log dan in.</a>
                </div>
            @endif
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
@stop