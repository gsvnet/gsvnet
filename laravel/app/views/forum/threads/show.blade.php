@extends('layouts.default')

@section('content')
    <div class="column-holder">
        <a href="/forum" title="Terug naar het forum" class="back-link i-back"></a>
        <h1>{{{ $thread->subject }}}</h1>
        
        <p class="delta">Een onderwerp gestart door {{{ $thread->author->username }}} </p>
        <div class="main-content has-border-bottom">

            {{-- $replies->links() --}}

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

            {{ $replies->links() }}

            <div id="reageer" class="{{$replies->getCurrentPage() != $replies->getLastPage() && $replies->getLastPage() > 1 ? 'hidden-form' : ''}}">
                @if(Auth::check())
                    @include('forum.replies._create')
                @else
                    <p><a class="button" href="{{ action('SessionController@getLogin') }}">Log in om te reageren</a>
                @endif
            </div>
        </div>
        <div class="secondary-column">
            <div class="content-columns">
                <div class="content-column">
                    <h2>Tags</h2>
                    <div class="tags">
                        {{ $thread->tags->getTagList() }}
                    </div>  
                </div>
            </div>
        </div>
    </div>
@stop