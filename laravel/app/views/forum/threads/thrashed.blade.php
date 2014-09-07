@extends('layouts.default')

@section('content')
<div class="column-holder">
    <h1>Forum: verwijderde topics</h1>

    <section class="main-content forum has-border-bottom">

        <div class="threads media-rows has-counters">
            {{-- Loop over the threads and display the thread summary partial --}}
            @each('forum.threads._index_summary', $threads, 'thread')

            {{-- If no comments are found display a message --}}
            @if( ! $threads->count())
                <div class="empty-state">
                    <h3>Prullenbak is leeg.</h3>
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