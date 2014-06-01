<div class="event-row" itemscope itemtype="http://data-vocabulary.org/Event">
    <div class="event-details">
        <div class="event-image {{{$types[$event->type] ? 'i-' . $types[$event->type] : ''}}}"></div>
    </div>
    <div class="event-body">
        <h3>
            <a href="{{ $event->present()->url }}" itemprop="url">
                {{{ $event->title}}}
            </a>
        </h3>
        <ul class="inline-list grey">
            <li>{{{ $event->present()->from_to_long }}}
            <time itemprop="startDate" datetime="{{{ $event->present()->startDateISO8601 }}}"></time>
            <time itemprop="endDate" datetime="{{{ $event->present()->endDateISO8601 }}}"></time></li>
            @if( !empty($event->location) )
                <li itemprop="location">{{{ $event->location }}}</li>
            @endif
        </ul>
        <p itemprop="summary">{{ $event->meta_description }}</p>
    </div>
</div>