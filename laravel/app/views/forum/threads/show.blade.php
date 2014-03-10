@extends('layouts.default')

@section('sidebar')
@stop

@section('content')
    <div class="column-holder">
        <div class="main-content">
            <div class="forum">
                <div class="header">
                    <h2>Forum</h2>
                    <div class="tags">
                        {{ $thread->tags->getTagList() }}
                    </div>
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
                    <p>Want to reply to this thread?</p> <a class="button" href="{{ action('AuthController@getLogin') }}">Login with github.</a>
                </div>
            @endif
        </div>
        <div class="secondary-column">
            @include('forum._sidebar')
        </div>
    </div>
@stop