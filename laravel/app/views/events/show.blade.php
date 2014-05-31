@section('content')
    <div class="column-holder" role="main" itemscope itemtype="http://data-vocabulary.org/Event">

        <h1>{{{ $event->title }}}</h1>
        <div class="main-content">
            <meta itemprop="summary" content="{{{$event->meta_description}}}">
            <ul class="inline-list delta">
                <li>{{{ $event->present()->from_to_long() }}}
                    <time itemprop="startDate" datetime="{{{ $event->present()->startDateISO8601 }}}"></time>
                    <time itemprop="endDate" datetime="{{{ $event->present()->endDateISO8601 }}}"></time>
                </li> 
                @if( !empty($event->location) )
                    <li itemprop="location">{{{ $event->location }}}</li>
                @endif
            </ul>
            <p itemprop="description">
                {{ $event->description }}
            </p>
        </div>

        <div class="secondary-column">
            @if (! $event->public)
                <h2>Privé</h2>
                <p>Deze activiteit is alleen zichtbaar voor GSV'ers</p>
            @endif
            <div class="icon-scale{{{$types[$event->type] ? ' i-' . $types[$event->type] : ''}}}"></div>
        </div>
    </div>
@stop