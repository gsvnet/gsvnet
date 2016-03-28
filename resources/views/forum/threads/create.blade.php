@extends('layouts.default')

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
                {!! Former::textarea('body')->placeholder('Tekst')->label('Tekst')->rows(10) !!}

                <div class="control-group tags">
                    @include('forum._tag_chooser')
                </div>

                @can('threads.show-private')
                <div>
                    {!! Former::checkbox('public')->text('Maak topic zichtbaar voor externen')->label('Publiek?') !!}
                </div>
                @endcan

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
