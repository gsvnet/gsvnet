@extends('layouts.default')

@section('content')
<div class="column-holder">
    <h1>Forum</h1>
    <p class="delta">Dit is het GSV-forum, waar het een en ander besproken wordt. Het is hier vreselijk gezellig; eigenlijk net zo gezellig als op soos zelf. Er zijn mensen die liever achter de pc zitten en hier contact houden, dan dat ze naar soos gaan.</p>

    <section class="main-content forum">
        <div class="header">
            {{-- Display select tags --}}
            @if(Input::get('tags', null))
                <div class="tags">
                    {{ Input::get('tags') }}
                </div>
            @endif
        </div>

        <div class="threads">
            {{-- Loop over the threads and display the thread summary partial --}}
            @each('forum.threads._index_summary', $threads, 'thread')

            {{-- If no comments are found display a message --}}
            @if( ! $threads->count())
                <div class="empty-state">
                    @if(Input::get('tags'))
                        <h3>Geen onderwerpen gevonden met de tags {{ Input::get('tags') }}</h3>
                    @else
                        <h3>Geen onderwerpen gevonden.</h3>
                    @endif
                    <a class="button" href="{{ action('ForumThreadsController@getCreateThread') }}">Maak een nieuw topic</a>
                </div>
            @endif
        </div>
    </section>

    <div class="secondary-column">
        @include('forum._sidebar')
    </div>
</div>

<div class="column-holder">
    {{ $threads->links() }}
</div>
@stop