@extends('layouts.default')

@section('content')
<div class="column-holder">
{{ Former::open()->action(action('ForumThreadsController@postEditThread', [$thread->id])) }}
    {{ Former::populate($thread->resource) }}
    <div class="header">
        <h1>Bewerk onderwerp</h1>
    </div>

    <div class="main-content">
        <div class="padding">
            
            {{ Former::text('subject')->label('Onderwerp')->placeholder('Onderwerp')->class('form-control wide') }}
            {{ Former::textarea('body')->label('Tekst')->placeholder('Tekst')->rows(10) }}

            <div class="form-row">
                {{ Form::label('is_question', 'What type of thread is this?', ['class' => 'field-title']) }}
                <ul class="version tags _question_tags">
                    <li>
                        <label class="tag">
                            Question
                            {{ Form::radio('is_question', 1, $thread->is_question) }}
                        </label>
                    </li>
                    <li>
                        <label class="tag">
                            Conversation
                            {{ Form::radio('is_question', 0, $thread->is_question) }}
                        </label>
                    </li>
                </ul>
                {{ $errors->first('is_question', '<small class="error">:message</small>') }}
            </div>

            <div class="form-row">
                {{ Form::label('laravel_version', 'Laravel Version', ['class' => 'field-title']) }}
                <ul class="version tags _version_tags">
                    @foreach($versions as $value => $version)
                        <li>
                            <label class="tag">
                                {{ $version }}
                                {{ Form::radio('laravel_version', $value) }}
                            </label>
                        </li>
                    @endforeach
                </ul>
                {{ $errors->first('laravel_version', '<small class="error">:message</small>') }}
            </div>

            <div class="form-row tags">
                @include('forum._tag_chooser', ['comment' => $thread])
            </div>

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
