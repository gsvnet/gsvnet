@extends('layouts.default')

@section('content')
<div class="column-holder">
    <div class="header">
        <h1>Bewerk onderwerp</h1>
    </div>

    <div class="main-content has-border-bottom">
        <div class="padding">

            {{ Former::open()->action(action('ForumThreadsController@postEditThread', [$thread->id])) }}
            {{ Former::populate($thread) }}
            {{ Former::text('subject')->label('Onderwerp')->placeholder('Onderwerp')->class('form-control wide') }}
            {{ Former::textarea('body')->label('Tekst')->placeholder('Tekst')->rows(10) }}

            <div class="form-row tags">
                @include('forum._tag_chooser', ['comment' => $thread])
            </div>

            @if (Permission::has('threads.show-private'))
            <div>
                {{ Former::checkbox('public')->text('Maak topic publiek voor niet-GSV leden')->label('Publiek') }}
            </div>
            @endif

            <div class="control-group">
                <input type="submit" value="Bewerk" class="button">
            </div>

            {{ Former::close() }}
        </div>
    </div>


    <div class="secondary-column">
        @include('forum._sidebar')
    </div>
</div>
@stop
