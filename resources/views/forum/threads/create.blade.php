@extends('layouts._forum')

@section('body-id', 'thread-create-page')
@section('title', 'Nieuw onderwerp')
@section('description', 'Nieuw onderwerp')

@section('content')
<div class="column-holder">
    <div class="header">
        <h1>Nieuw onderwerp</h1>
    </div>

    <div class="main-content">

        {!! Former::open() !!}
        <section class="padding">
            {!! Former::text('subject')->placeholder('Onderwerp')->label('Onderwerp')->class('form-control wide') !!}
            @include('forum._editor')
            <div class="vertical-spacing"></div>

            <div class="control-group tags">
                @include('forum._tag_chooser')
            </div>

            @if(Gate::allows('threads.show-internal') and Gate::denies('threads.show-private'))
                <div>
                    {!! Former::checkbox('visibility')
                        ->value('public')
                        ->text('Maak topic zichtbaar voor externen')
                        ->label('Publiek?') !!}
                </div>
            @elseif(Gate::allows('threads.show-private'))
                <div>
                    {!! Former::radios('Toegang')
                        ->radios([
                            'Privé' => ['name' => 'visibility', 'value' => 'private'],
                            'Intern' => ['name' => 'visibility', 'value' => 'internal'],
                            'Publiek' => ['name' => 'visibility', 'value' => 'public']
                        ])
                        ->check('internal') !!}
                    <p>Privé: alleen toegang voor leden. Intern: tevens toegang voor reünisten. Publiek: toegang voor iedereen.</p>
                </div>
            @endif

            <div class="control-group">
                <input type="submit" value="Opslaan" class="button">
            </div>

        </section>
        {!! Former::close() !!}
    </div>
    <div class="secondary-column">
        <h2>ijoaegj ooeaijgro</h2>
        <p>Probeer een titel te verzinnen die een goede beschrijving is van het onderwerp.</p>
    </div>
</div>
@stop
