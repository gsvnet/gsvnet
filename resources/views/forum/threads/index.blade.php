@extends('layouts.default')

@section('title')
    Forum - pagina {{$threads->currentPage()}}
@stop

@section('description', 'Op zoek naar een kamer in Groningen? Vind het op het forum van de GSV. Ook voor activiteiten en discussies.')
@section('body-id', 'thread-index-page')

@section('content')
<div class="column-holder">
    <h1>Forum</h1>
    @if(Request::filled('tags'))
        <p class="delta">
            Onderwerpen met de tags {{{ str_replace(',', ', ', Request::get('tags')) }}}
        </p>
    @elseif(!Auth::check() or Auth::user()->isVisitor())
        <p class="delta">Op het actieve forum van de GSV staat informatie over activiteiten en aanbod van kamers in Groningen. Je kunt er praktisch alles kwijt. Dit is het externe deel van het forum. Er is ook nog een intern deel, dat bruist van activiteit!</p>
    @else
        <p class="delta">Op het actieve forum van de GSV staat informatie over activiteiten en aanbod van kamers in Groningen. Je kunt er praktisch alles kwijt.</p>
    @endif

    <section class="main-content forum has-border-bottom">
        <p class="online-users-row">
            <span class="online-indicator"></span>
            <strong class="online-number">?</strong> <span class="online-number-term">GSV'ers</span> online
        </p>

        <div class="threads media-rows has-counters">
            {{-- Loop over the threads and display the thread summary partial --}}
            @each('forum.threads._index_summary', $threads, 'thread')

            {{-- If no comments are found display a message --}}
            @if( ! $threads->count())
                <div class="empty-state">
                    @if(Request::filled('tags'))
                        <h3>Geen onderwerpen gevonden met de tags {{{ str_replace(',', ', ', Request::get('tags')) }}}</h3>
                    @else
                        <h3>Geen onderwerpen gevonden.</h3>
                    @endif
                    <a class="button" href="{{ action('ForumThreadsController@getCreateThread') }}">Maak een nieuw topic</a>
                </div>
            @endif
        </div>

        {!! $threads->render() !!}
    </section>

    <div class="secondary-column">
        @include('forum._sidebar')
    </div>
</div>
@stop