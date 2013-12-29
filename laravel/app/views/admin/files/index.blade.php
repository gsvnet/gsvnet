@section('stylesheets')
	@parent
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
@stop

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
			</tr>
		</thead>
		<tbody>
			@foreach($files as $file)
			<tr>
				<td>
                    <a href="{{ URL::action('Admin\FilesController@show', $file->id) }}" alt="{{ $file->name }}">
					   {{{ $file->name }}}
                    </a>
                </td>
                <td>
                    {{{ $file->created_at }}}
                </td>
                <td>
                    {{{ $file->updated_at }}}
                </td>
                <td>
                    <a href="{{{ $file->file_path }}}"><i class="glyphicon glyphicon-download-alt"></i>Download</a>
                </td>
			</tr>
			@endforeach
		</tbody>
	</table>

	{{ $files->links() }}

@stop

@section('javascripts')
	@parent

	<script>
        $(document).ready(function() {
            $('.add-item').on('click', function () {
                $('.add-form').toggle('fast');
            });
            // Hide success message after 2.5 seconds
            $('.alert.alert-success').delay(2500).slideUp(500);
        });
    </script>
@stop