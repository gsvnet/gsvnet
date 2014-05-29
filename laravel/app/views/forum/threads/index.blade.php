@extends('layouts.default')

@section('content')
<div class="column-holder">
    <h1>Forum</h1>
    @if(Input::get('tags', null))
        <p class="delta">
            Onderwerpen met de tags {{ Input::get('tags') }}
        </p>
    @else
        <p class="delta">Dit is het forum van de GSV hier kan worden gepost over activiteiten, vraag en aanbod, interne en externe aangelegenheid en praktisch alles wat je kwijt wil.</p>
    @endif

    <section class="main-content forum">

        <div class="threads media-rows has-counters">
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

        {{ $threads->links() }}
    </section>

    <div class="secondary-column">
        @include('forum._sidebar')
    </div>
</div>
@stop