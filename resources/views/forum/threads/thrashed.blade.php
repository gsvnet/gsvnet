@extends('layouts.default')

@section('body-id', 'thread-index-page')

@section('content')
<div class="column-holder">
    <h1>Forum: verwijderde topics</h1>

    <section class="main-content forum has-border-bottom">

        <div class="threads media-rows has-counters">
            @each('forum.threads._index_summary', $threads, 'thread')

            @if( ! $threads->count())
                <div class="empty-state">
                    <h3>Prullenbak is leeg.</h3>
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