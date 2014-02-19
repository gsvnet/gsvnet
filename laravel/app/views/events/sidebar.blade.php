<div class="secondary-column">
    <h2>
    @if($showPrevYear)
        {{link_to_action('EventController@showMonth', $year - 1, $year - 1)}} |
    @endif
    {{link_to_action('EventController@showMonth', $year, $year)}}
    @if($showNextYear)
        | {{link_to_action('EventController@showMonth', $year + 1, $year + 1)}}
    @endif
    </h2>

    <ul class="list secondary-menu">
        @foreach ($months as $month)
            <li>
                {{ link_to_action(
                    'EventController@showMonth',
                    $month,
                    array($year, $month))
                }}
            </li>
        @endforeach
    </ul>
</div>