@extends('layouts.default')

@section('title', 'Commissies van de GSV')
@section('description', 'Binnen de GSV zijn er veel verschillende commissies die samen de vereniging tot een bruisend geheel maken door allerlei activiteiten te organiseren en belangrijke taken te vervullen.')
@section('body-id', 'committees-page')

@section('content')


    <div class="column-holder" role="main">
        
        <h1>Commissies</h1>

        <div class="main-content">
            <p class="delta">De GSV heeft heel veel commissies die de vele activiteiten van de vereniging organiseren waarin gemotiveerde leden zich inzetten om de vereniging tot een groot succes te maken.</p>
        </div>

        <div class="secondary-column">
            <div id="committees">
                <div class="form-group">
                    <label class="control-label" for="inputSearch">Zoeken</label>
                    <input type="text" class="search form-control" id="inputSearch" name="inputSearch" placeholder="Zoeken">
                </div>
                <ul class="list secondary-menu">
                    @foreach ($committees as $committee)
                        <li><a class="committee" href="{{ URL::action('AboutController@showCommittee', $committee->unique_name) }}">{{ $committee->name }}</a> <span class="hide slug">({{{$committee->unique_name}}})</span></li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
@stop