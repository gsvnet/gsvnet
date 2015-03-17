@extends('layouts.admin')

@section('content')
    <div class="page-header">
    	<h1>Activiteiten</h1>
    </div>

	<table class='table table-striped table-hover sort-table'>
		<thead>
			<tr>
                <th>Titel</th>
                <th>Locatie</th>
                <th>Startdatum</th>
                <th>Starttijd</th>
                <th>Einddatum</th>
                <th>Publiek</th>
                <th>Gepubliceerd</th>
                <th>Laatst bewerkt</th>
			</tr>
		</thead>
		<tbody>
			@foreach($events as $event)
			<tr>
				<td>
                    <a href="{{ URL::action('Admin\EventController@edit', $event->id) }}" alt="{{ $event->title }}">
                        {{ $event->title }}
                    </a>
                </td>
                <td>
                    {{ $event->location }}
                </td>
                <td>
                    {{ $event->start_date }}
                </td>
                <td>
                    {!! $event->whole_day ? '' : $event->present()->startHourMinute !!}
                </td>
                <td>
                    {{ $event->end_date }}
                </td>
                <td class="{!! $event->public ? 'text-warning' : 'text-success' !!}">
                    {!! $event->public ? 'Ja' : 'Nee' !!}
                </td>
                <td>
                    {!! $event->published ? '<i class="fa fa-check"></i>' : '<i class="fa fa-exclamation"></i>' !!}
                </td>
                <td class="text-muted">
                    {{ $event->updated_at }}
                </td>
			</tr>
			@endforeach
		</tbody>
	</table>

	{!! $events->render() !!}

@stop