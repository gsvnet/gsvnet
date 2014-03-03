@section('content')
    <div class="column-holder" role="main">

        <h1>{{ $event->title }}</h1>
        <div class="main-content">
            <h3>
                {{{ $event->start_long() }}}
            </h3>
            <p class="delta">
                {{ $event->description }}
            </p>

            @if (! empty($event->location))
            <strong>Locatie: {{ $event->location }}</strong>
            @endif

            @if (! $event->public)
                <strong>Prive activiteit</strong>
            @endif
        </div>

        <div class="secondary-column">
            @if (isset($types[$event->type]))
                <div class="single-event-details {{$types[$event->type]}}">
                    Dit is nou typische een activiteit met zo'n kleur
                </div>
            @endif
        </div>
    </div>
    <div class="column-holder">
        <p><a class="button" href="{{ URL::previous() }}">Terug</a></p>
    </div>
@stop