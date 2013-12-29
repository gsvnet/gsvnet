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
				<td>Van</td>
				<td>Tot</td>
				<td>Hele dag?</td>
                <td>Laatst bewerkt</td>
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
				</td>
				<td>
					{{{ $event->end_date }}}
				</td>

				<td>...</td>

                <td>
                    {{{ $event->updated_at }}}
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

            $('.add-item').on('click', function () {
                $('.add-form').toggle('fast');
            });

            // Hide success message after 2.5 seconds
            $('.alert.alert-success').delay(2500).slideUp(500);

            function toggleTimeBoxes() {
            	startTime.disabled = $wholeDay[0].checked;
            	endTime.disabled = $wholeDay[0].checked;
            }

            $wholeDay.change(toggleTimeBoxes);
            toggleTimeBoxes();
        });
    </script>
@stop