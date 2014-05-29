@section('content')
    <div class="column-holder" role="main">

        <h1>{{{ $event->title }}}</h1>
        <div class="main-content">
            <ul class="inline-list delta">
               <li>{{{ $event->present()->from_to_long() }}}</li> 
                @if( !empty($event->location) )
                    <li>{{{ $event->location }}}</li>
                @endif
            </ul>
            <p>
                {{ $event->description }}
            </p>
        </div>

        <div class="secondary-column">
            @if (! $event->public)
                <h2>Privé</h2>
                <p>Deze activiteit is alleen zichtbaar voor GSV'ers</p>
            @endif
        </div>
    </div>
    <div class="column-holder">
        <p><a class="button" href="{{ URL::previous() }}">Terug</a></p>
    </div>
@stop