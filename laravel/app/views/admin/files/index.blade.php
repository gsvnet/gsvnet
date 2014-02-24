@section('content')
    <div class="page-header">
    	<h1>GSVdocs</h1>
    </div>

	@include('admin.files.create')

	<h2>Bestanden</h2>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>Naam</th>
                <td>Toegevoegd op</td>
                <td>Laatst bewerkt</td>
				<td>Download</td>
                <td>
                    Gepubliceerd
                </td>
			</tr>
		</thead>
		<tbody>
			@foreach($files as $file)
			<tr>
				<td>
                    <a href="{{ URL::action('Admin\FilesController@edit', $file->id) }}" alt="{{ $file->name }}">
					   {{{ $file->name }}} <i class="fa fa-pencil"></i>
                    </a>
                </td>
                <td>
                    {{{ $file->created_at }}}
                </td>
                <td>
                    {{{ $file->updated_at }}}
                </td>
                <td>
                    <a href="{{ URL::action('FilesController@show', $file->id) }}"><i class="glyphicon glyphicon-download-alt"></i>Download</a>
                </td>
                <td>
                    {{{ $file->published ? 'Ja' : 'Nee' }}}
                </td>
			</tr>
			@endforeach
		</tbody>
	</table>

	{{ $files->links() }}

@stop