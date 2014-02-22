@section('content')
    <div class="page-header">
    	<h1>Activiteiten</h1>
    </div>
	<p class="delta">Voeg een activiteit toe of bewerk een activiteit</p>

	@include('admin.events.create')

	<h2>Activiteiten bewerken</h2>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>Titel</th>
				<th>Van</th>
				<th>Tot</th>
				<th>Hele dag?</th>
                <th>Laatst bewerkt</th>
                <th>Prive activiteit</th>
                <th>Gepubliceerd</th>
			</tr>
		</thead>
		<tbody>
			@foreach($events as $event)
			<tr>
				<td><a href="{{ URL::action('Admin\EventController@show', $event->id) }}" alt="{{ $event->title }}">
					{{{ $event->title }}}
				</a></td>
				<td>
					{{{ $event->start_date }}}
					@if($event->whole_day == '0')
					{{{ $event->start_time }}}
					@endif
				</td>
				<td>
					{{{ $event->end_date }}}
					@if($event->whole_day == '0')
					{{{ $event->end_time }}}
					@endif
				</td>

				<td>{{ $event->whole_day == '1' ? '<span class="glyphicon glyphicon-check"></span>' : '<span class="glyphicon glyphicon-unchecked"></span>' }}</td>

                <td>
                    {{{ $event->updated_at }}}
                </td>

                <td>
                    {{{ $event->public ? 'Nee' : 'Ja' }}}
                </td>
                <td>
                    {{{ $event->published ? 'Ja' : 'Nee' }}}
                </td>


			</tr>
			@endforeach
		</tbody>
	</table>

	{{ $events->links() }}

@stop

@section('javascripts')
	@parent

	<script>
        $(document).ready(function() {
			var startTime = $('#start_time')[0];
            var endTime = $('#end_time')[0];
            var $wholeDay = $('#whole_day');

            function toggleTimeBoxes() {
            	startTime.disabled = $wholeDay[0].checked;
            	endTime.disabled = $wholeDay[0].checked;
            }

            $wholeDay.change(toggleTimeBoxes);
            toggleTimeBoxes();
        });
    </script>
@stop