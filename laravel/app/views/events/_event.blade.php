<div class="event-row">
    <div class="event-details">
        <div class="event-image {{{$types[$event->type] ? 'i-' . $types[$event->type] : ''}}}"></div>
    </div>
    <div class="event-body">
        <h3>
            <a href="{{ URL::action('EventController@showEvent', $event->id) }}">
                {{{ $event->title}}}
            </a>
        </h3>
        <ul class="inline-list grey">
            <li>{{{ $event->start_short }}}</li>
            @if( !empty($event->location) )
                <li>{{{ $event->location }}}</li>
            @endif
        </ul>
        <p>{{ $event->description }}</p>
    </div>
</div>