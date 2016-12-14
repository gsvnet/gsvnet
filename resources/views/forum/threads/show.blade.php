@extends('layouts._forum')

@section('body-id', 'thread-page')

@section('title')
    {{ $thread->subject }} - pagina {{$replies->currentPage()}}
@stop

@section('description')
    {{ $thread->subject }}
@stop

@section('content')
    <div class="column-holder">
        <a href="/forum" title="Terug naar het forum" class="back-link i-back"></a>
        <h1>{{ $thread->subject }}</h1>
        
        <p class="delta">Een onderwerp gestart door {{{ $thread->author->username }}} </p>

        <div class="main-content has-border-bottom">
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

            {!! $replies->render() !!}

            <div id="reageer">
                @if(Auth::check())
                    @if(Auth::user()->approved)
                        @if($replies->currentPage() != $replies->lastPage() && $replies->lastPage() > 1)
                            <p>Dit is niet de laatste pagina!</p>
                        @endif
                        @include('forum.replies._create')
                    @else
                        <p>Je kan nog niet reageren omdat je account nog niet is goedgekeurd.</p>
                    @endif
                @else
                    <p><a class="button" href="{{ action('SessionController@getLogin') }}" rel="nofollow">Log in om te reageren</a>
                @endif
            </div>
        </div>
        <div class="secondary-column">
            <div class="content-columns">
                <div class="content-column">

                    @if($thread->trashed())
                        <h2>VERWIJDERD!</h2>
                        <p>DIT TOPIC IS VERWIJDERD!</p>
                        <p>Een volgende webcie kan dit misschien duidelijker aangeven met mooie rode letters, maar dit topic is dus verwijderd en alleen zichtbaar voor mensen met speciale rechten.</p>
                    @endif

                    @can('threads.show-private')
                        @if($thread->public)
                            <h2>Extern</h2>
                            <p>Dit topic staat extern en is dus door iedereen te bekijken.</p>
                        @else
                            <h2>Intern</h2>
                            <p>Dit topic staat intern en is dus alleen te bekijken door leden.</p>
                        @endif
                    @endcan

                    <h2>Tags</h2>
                    <div class="tags">
                        {!! $thread->tags->getTagList() !!}
                    </div>  
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascripts')
    @parent
@endsection