@section('content')
    <div class="page-header">
    	<h1>Activiteiten</h1>
    </div>
    <p class="delta">Voeg een activiteit toe of bewerk een activiteit</p>
    <div class="spacer row">
        <div class="col-xs-12 col-md-6">
           @include('admin.events.create')
        </div>
        <div class="col-xs-12 col-md-6">
    	   <h2>Tips voor het toevoegen</h2>
           <ul>
               <li>Je titel moet even goed zijn</li>
               <li>De beschrijving wordt straks opgedeeld in korte en lange beschrijving, dat is handig.</li>
               <li>De soort die je kiest bepaalt het plaatje dat erbij komt</li>
               <li><strong>Niet iedereen kan publiceren!</strong> Alleen de senaat/webcie kan een activiteit publiceren :)</li>
           </ul>
        </div>
    </div>

	<h2>Activiteiten bewerken</h2>
	<table class='table table-striped table-hover'>
		<thead>
			<tr>
				<th>Titel</th>
				<th>Datum en tijd</th>
                <th>Publiek</th>
                <th>Gepubliceerd</th>
                <th>Laatst bewerkt</th>
                <th>Acties</th>
			</tr>
		</thead>
		<tbody>
			@foreach($events as $event)
			<tr>
				<td><a href="{{ URL::action('Admin\EventController@show', $event->id) }}" alt="{{ $event->title }}">
					{{{ $event->title }}}
				</a></td>
				<td>
					{{{ $event->from_to_long(true) }}}
				</td>
                <td>
                    {{ $event->public ? '<span class="label label-danger">Ja</span>' : '<span class="label label-success">Nee</span>' }}
                </td>
                <td>
                    {{ $event->published ? '<span class="label label-success">Ja</span>' : '<span class="label label-danger">Nee</span>' }}
                </td>
                <td>
                    {{{ $event->updated_at }}}
                </td>
                <td>
                    <a href="{{ URL::action('Admin\EventController@edit', $event->id) }}" class="btn btn-primary btn-xs" role="button">Bewerk</a>
                    <a href="{{ URL::action('Admin\EventController@destroy', $event->id) }}" class="btn btn-danger btn-xs" role="button">Verwijder</a>
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