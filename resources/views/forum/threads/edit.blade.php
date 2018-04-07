@extends('layouts.default')

@section('body-id', 'thread-update-page')
@section('title', 'Topic bewerken')
@section('description', 'Topic bewerken.')

@section('content')
<div class="column-holder">
    <div class="header">
        <h1>Bewerk onderwerp</h1>
    </div>

    <div class="main-content has-border-bottom">
        <div class="padding">

            {!! Former::open()->action(action('ForumThreadsController@postEditThread', [$thread->id])) !!}
            {!! Former::populate($thread) !!}
            {!! Former::text('subject')->label('Onderwerp')->placeholder('Onderwerp')->class('form-control wide') !!}
            @include('forum._editor')
            <div class="vertical-spacing"></div>

            <div class="form-row tags">
                @include('forum._tag_chooser', ['comment' => $thread])
            </div>

            @can('threads.show-private')
            <div>
                {!! Former::checkbox('public')->value('yes')->text('Maak topic zichtbaar voor externen')->label('Publiek?') !!}
            </div>
            <div>
                {!! Former::checkbox('atv')->value('yes')->text('Maak topic zichtbaar voor ATV&apos;ers (niet nodig als topic al publiek is)')->label('Zichtbaar voor ATV?') !!}
            </div>
            @endcan

            <div class="control-group">
                <input type="submit" value="Bewerk" class="button">
            </div>

            {!! Former::close() !!}
        </div>
    </div>


    <div class="secondary-column">
        @include('forum._sidebar')
    </div>
</div>
@stop
