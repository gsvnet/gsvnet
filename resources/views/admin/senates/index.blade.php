@extends('layouts.admin')

@section('content')
    <div class="page-header">
    	<h1>Senaten</h1>
    </div>
	<p class="delta">Voeg een senaat toe of bewerk er een. Thomas en Loran zijn Awesome</p>

	@include('admin.senates.create')

	<h2>Senaten bewerken</h2>
	<table class='table table-striped table-hover sort-table'>
		<thead>
			<tr>
				<th>Naam</th>
				<th>Jaar</th>
				<td>Leden</td>
                <td>Laatst bewerkt</td>
			</tr>
		</thead>
		<tbody>
			@foreach($senates as $senate)
			<tr>
				<td><a href="{{ URL::action([\App\Http\Controllers\Admin\SenateController::class, 'show'], $senate->id) }}" alt="{{ $senate->name }}">
					{{ $senate->name }}
				</a></td>

				<td>
					{{ $senate->present()->year }}
				</td>
				<td>
					<ul>
						@foreach($senate->members as $member)
							<li>{{ $member->present()->fullName }}</li>
						@endforeach
					</ul>
				</td>

                <td>
                    {{ $senate->updated_at }}
                </td>

			</tr>
			@endforeach
		</tbody>
	</table>

	{!! $senates->render() !!}

@stop