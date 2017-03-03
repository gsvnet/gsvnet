<div class="secondary-column">
    <h2>Activiteiten in ...</h2>
    <ul id="years-list" class="inline-list to-select-box">
        @foreach ($visibleYears as $visibleYear)
            <li>{!!link_to_action('EventController@showMonth', $visibleYear, $visibleYear, array(
                'class' => $searchTimeRange && $visibleYear == $year ? 'active' : ''
            ))!!}</li>
        @endforeach
    </ul>

    <ul id="months-list" class="list secondary-menu to-select-box">
        @foreach ($months as $monthName)
            <li>
                {!! link_to_action(
                    'EventController@showMonth',
                    $monthName,
                    array($year, $monthName),
                    array('class' => ($searchTimeRange && $month == $monthName)  ? 'active' : '')
                    )
                !!}
            </li>
        @endforeach
    </ul>
</div>