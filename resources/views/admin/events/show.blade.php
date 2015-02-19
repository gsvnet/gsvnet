@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>{{ $event->title }}</h1>
        <p>{{ $event->description ? $event->description : 'Geen beschrijving...' }}</p>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Locatie</h3>
        </div>
        <div class="panel-body">
            {{ $event->location ? $event->location : 'Geen locatie opgegeven' }}
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Begin en eind</h3>
        </div>
        <div class="panel-body">
            @if($event->start_date == $event->end_date)
                Het evenement vindt plaats op <span class="label label-primary">{{ $event->start_date }}</span> en 
                @if($event->whole_day == 1)
                    duurt de hele dag.
                @else
                    duurt van <span class="label label-primary">{{ $event->start_time }}</span> tot <span class="label label-primary">{{ $event->end_time }}</span>.
                @endif
            @else
                @if($event->whole_day == 1)
                    Het evenement begint op <span class="label label-primary">{{ $event->start_date }}</span> en eindigt op <span class="label label-primary">{{ $event->end_date }}</span>.
                @else
                    Het evenement begint op <span class="label label-primary">{{ $event->start_date }}</span> om <span class="label label-primary">{{ $event->start_time }}</span> en eindigt op <span class="label label-primary">{{ $event->end_date }}</span> om <span class="label label-primary">{{ $event->end_time }}</span>
                @endif
            @endif
        </div>
    </div>

    <a href="{{ URL::action('Admin\EventController@edit', $event->id) }}" alt="Bewerk {{{ $event->title }}}" class='btn btn-default'>
        <i class="fa fa-pencil"></i> Activiteit informatie bewerken
    </a>
@stop
