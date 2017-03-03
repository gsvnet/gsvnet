@extends('layouts.default')

@section('body-id', 'thread-search-page')

@section('content')
    <div class="column-holder">
        @if($query)
            <h1>Zoekresultaten voor "{{ $query }}"</h1>
            <p class="delta">Als je niet kan vinden wat je zoekt moet je contact opnemen met de webcie.</p>
        @else
            <h1>Forum doorzoeken</h1>
            <p class="delta">Je doorzoek alleen het forum</p>
        @endif
        <section class="main-content forum">

            @if($query)
                <div class="threads media-rows has-counters">
                    @if($results->count() > 0)
                        {{-- Loop over the threads and display the thread summary partial --}}
                        @foreach($results as $result)
                            @if($result->parent)
                                @include('forum.threads._index_summary', ['thread' => $result->parent])
                            @else
                                @include('forum.threads._index_summary', ['thread' => $result])
                            @endif
                        @endforeach
                    @else
                        {{-- If no comments are found display a message --}}
                        <div class="empty-state">
                            <h3>Geen resultaten voor "{{ $query }}"</h3>
                        </div>
                    @endif
                </div>

                <div class="pagination">
                    {!! $results->render() !!}
                </div>
            @else
                <div class="padding">
                    {!! Form::open(['action' => 'ForumThreadsController@getSearch', 'method' => 'GET']) !!}
                        <div class="form-row">
                            {!! Form::label('query', 'Search the laravel.io forum', ['class' => 'field-title']) !!}
                            {!! Form::text('query', null, ['placeholder' => 'search the laravel.io forum'] )!!}
                        </div>
                        <div class="form-row">
                            {!! Form::button('Go Find Stuff!', ['type' => 'submit', 'class' => 'button']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            @endif
        </section>
        <div class="secondary-column">
            @include('forum._sidebar', ['query' => $query])
        </div>
    </div>
@stop