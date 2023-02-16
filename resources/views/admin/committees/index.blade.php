@extends('layouts.admin')

@section('content')
    <div class="page-header">
		<h1>Commissies</h1>
	</div>
	<p class="delta">Voeg een commissie toe of bewerk oude commissies</p>

	<div class="spacer row">
		<div class="col-xs-12 col-md-6">
			<h2>Commissies bewerken</h2>
			<table class='table table-striped table-hover sort-table'>
				<thead>
					<tr>
						<th>Naam</th>
                        <th>Openbaar</th>
						<th>Totaal aantal leden</th>
		                <th>Laatst bewerkt</th>
					</tr>
				</thead>
				<tbody>
					@foreach($committees as $committee)
					<tr>
						<td>
                            <a href="{{ URL::action([\App\Http\Controllers\Admin\CommitteeController::class, 'show'], $committee->id) }}" alt="{{ $committee->name }}">
							    {{ $committee->name }}
						    </a>
                        </td>
                        <td>{{ $committee->public ? 'ja' : 'nee' }}</td>
						<td>{{ $committee->users->count() }}</td>
		                <td>{{ $committee->updated_at }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			{!! $committees->render() !!}
		</div>

		<div class="col-xs-12 col-md-6">
			@include('admin.committees.create')
		</div>
	</div>

@stop